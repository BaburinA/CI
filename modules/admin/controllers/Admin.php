<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MX_Controller {

    var $module_name = "menu";

    function __construct()
    {
        parent::__construct();
        $this->load->library('common/main_lib');
        $this->load->library('admin/menu_lib');
        $this->load->model('menu_model');
    }

    function index()
    {
        $this->menus_list();
    }

//УПРАВЛЕНИЕ СПИСКОМ ВСЕХ МЕНЮ
    //вывод списка всех меню
    function menus_list()
    {
        $data['menus'] = $this->db->order_by("id", "asc")->get('menus')->result_array();
        $tpl['content'] = $this->load->view("admin/admin_menus_list.tpl", $data, true);
        $this->main_lib->render_main_page($tpl);
    }

    //редактируем данные
    function edit_menus($id)
    {
        $data['menu'] = $this->db->where("id", $id)->get('menus')->row_array();
        $tpl['content'] = $this->load->view("admin/admin_menus_edit.tpl", $data, true);
        $this->main_lib->render_main_page($tpl);
    }

    //создаем список меню
    function add_menus()
    {
        $data = array();
        $tpl['content'] = $this->load->view("admin/admin_menus_add.tpl", $data, true);
        $this->main_lib->render_main_page($tpl);
    }

    //сохраняем данные
    function save_menus($new = false)
    {
        if ($this->input->post())
        {
            $post = $this->input->post();
            $id = $this->input->post('id');
            $data['name'] = $post['name'];
            $data['menu_name'] = $post['menu_name'];
            $data['description'] = $post['description'];

            if($new == true){
                $this->db->insert('menus', $data);
            }
            else{
                $this->db->where("id", $id);
                $this->db->update('menus', $data);
            }
            //$this->main_lib->set_admin_alerts('alert_success', 'Список меню '.$data['name'].' сохранен', '/admin/menu/menus_list');
        }
        else
        {
            //$this->main_lib->set_admin_alerts('alert_danger', 'Список меню не сохранен', '/admin/menu/menus_list');
        }
    }

    //удаляем данные
    function delete_menus($id = null)
    {
        if($id != ""){
            $this->db->where('menu_id', $id)->delete('menus_data');
            $this->db->where('id', $id)->delete('menus');
            //$this->main_lib->set_admin_alerts('alert_warning', 'Список меню удален ID#'.$id.'', 'admin/menu/menus_list');
        }
        elseif ($this->input->post()) {
            $post = $this->input->post();
            $data['ids'] = $post['ids'];
            $count = 0;
            foreach($data['ids'] as $key => $value){
                $this->db->where('menu_id', $id)->delete('menus_data');
                $this->db->where('id', $value)->delete('menus');
                $count++;
            }
            //$this->main_lib->set_admin_alerts('alert_warning', 'Списки меню удалены '.$count.' шт.');
        }
        else {
            //$this->main_lib->set_admin_alerts('alert_danger', 'Ошибка списоки меню не удалены');
        }
    }

    //методом post проверяет наличие системного имени в базе данных и возвращает TRUE или FALSE
    function check_menu_name(){
        $isAvailable = true;
        if ($this->input->post()) {
            $post = $this->input->post();
            switch ($post['type']) {
                case 'menu_name':
                    $menu_name = $post['menu_name'];
                    $id = $post["id"];
                    $query = $this->db->where('id !=', $id)->where("menu_name", $menu_name)->get('menus');
                    if ($query->num_rows() == 0) {
                        $isAvailable = true;
                    } elseif ($query->num_rows() > 0) {
                        $isAvailable = false;
                    }
                    break;
                case 'name':
                default:
                    $name = $post['name'];
                    $isAvailable = true; // or false
                    break;
            }
        }
        // возвращаем true or false для валидации
        echo json_encode(array(
            'valid' => $isAvailable,
        ));
    }

//УПРАВЛЕНИЕ МЕНЮ
    //вывод содержания меню
    function menu_list($id) {
        $this->session->set_userdata('menu_id', $id);
        $data['menu_data'] = $this->db->where('id', $id)->get('menus')->row_array();

        $tree = $this->menu_lib->_build_menu($id);
        $data["menu_id"] = $id;
        $data["menu_list"] = $this->renderMenuList($tree);
        $tpl['content'] = $this->load->view("admin/admin_menu_list.tpl", $data, true);
        $this->main_lib->render_main_page($tpl);
    }

    //рендер всех каталогов по шаблону
    private function renderMenuList($tree) {
        $html = '';
        foreach ($tree as $item) {
            $html .= '<div>';
            $html .= $this->load->view('admin/admin_menu_list_item.tpl', array('item' => $item), true);
            if (isset($item['subtree'])) {
                $html .= '<div class="frame_level sortable" style="display:none;">';
                $html .= $this->renderMenuList($item['subtree']);
                $html .= '</div>';
            }
            $html .= '</div>';
        }
        return $html;
    }

    //редактируем данные
    function edit_menu($id)
    {
        $query_arr = $this->db->where("id", $id)->get('menus_data')->row_array();
        $data['menu'] = $query_arr;
        $data['menu']['parent_id'] = $this->menu_lib->get_select_menu($query_arr['parent_id']);
        $data['menu']['page'] = $this->menu_lib->get_select_page($query_arr['url']);
        $data['menu']['categories'] = $this->menu_lib->get_select_categories($query_arr['url']);

        $tpl['content'] = $this->load->view("admin/admin_menu_edit.tpl", $data, true);
        $this->main_lib->render_main_page($tpl);
    }

    function add_menu($menu_id)
    {
        $data['menu']['menu_id'] = $menu_id;
        $data['menu']['parent_id'] = $this->menu_lib->get_select_menu();
        $data['menu']['page'] = $this->menu_lib->get_select_page();
        $data['menu']['categories'] = $this->menu_lib->get_select_categories();
        $tpl['content'] = $this->load->view("admin/admin_menu_add.tpl", $data, true);
        $this->main_lib->render_main_page($tpl);
    }



    //удаляем данные
    function delete_menu($id = null)
    {
        if($id != ""){
            $this->db->where('id', $id)->delete('menus_data');
            //$this->main_lib->set_admin_alerts('alert_success', 'Меню ID#'.$id.' удалено', 'admin/menu/menus_list');
        }

        elseif ($this->input->post()) {
            $count = 0;
            $post = $this->input->post();
            $data = $post['ids'];
            $query = $this->menu_model->get_menus();
            foreach($data as $key=>$value) {
                foreach ($query as $menu) {
                    if ($menu['parent_id'] == $value) {
                        $key = array_search($menu["id"], $data); // Ищем дочерний элемент
                        if ($key) {
                            $data[] = $menu['id'];
                        } elseif (!$key) {
                            //$this->main_lib->set_admin_alerts('alert_danger', 'Внимание раздел содержит дочерние элементы!');
                            exit();
                        }
                    }
                }
            }
            $data = array_unique($data);
            foreach($data as $key => $value){
                $this->db->where('id', $value)->delete('menus_data');
                $count++;
            }
            //$this->main_lib->set_admin_alerts('alert_warning', 'Пункты меню удалены '.$count.'шт');
        }
        else {
            //$this->main_lib->set_admin_alerts('alert_danger', 'Пункты меню не удалены');
        }
    }

    //сохраняем данные
    function save_menu($new = false)
    {
        if ($this->input->post())
        {
            $post = $this->input->post();
            $id = $this->input->post('id');
            $data['name'] = $post['name'];
            $data['parent_id'] = $post['parent_id'];
            $data['menu_type'] = $post['menu_type'];
            $data['menu_id'] = $post['menu_id'];

            if($data['menu_type'] == "url") $data['url'] = $post['url'];
            elseif($data['menu_type'] == "page") $data['url'] = "/page/".$post['url'];
            elseif($data['menu_type'] == "category") $data['url'] = "/category/".$post['url'];

            $data['visible'] = $post['visible'];
            $data['order'] = $post['order'];
             
            $data['class_m'] = ''; 

            if($new == true){
                $this->db->insert('menus_data', $data);
            }
            else{
                $this->db->where("id", $id);
                $this->db->update('menus_data', $data);
            }
            //$this->main_lib->set_admin_alerts('alert_success', 'Пункт меню ID#'.$id.' сохранен', 'admin/menu/menu_list/'.$data['menu_id']);
        }
        else
        {
            //$this->main_lib->set_admin_alerts('alert_danger', 'Пункт меню не сохранен', 'admin/menu/menu_list/'.$this->session->userdata('menu_id'));
        }

    }

    //изменяем методом ajax видимость страницы
    function change_status($id){
        if ($id != "") {
            $result = $this->db->get_where('menus_data', array('id' => $id))->row_array();
            if($result['visible'] == '0'){
                $data['visible'] = '1';
            }
            elseif($result['visible'] == '1'){
                $data['visible'] = '0';
            }
            $this->db->where("id", $id)->update('menus_data', $data);
        }
    }

    //вывод меню nestable
    function menu_list_sortable($id) {
        $data['menu_id'] = $id;
        $data["menuTreeHTML"] = $this->menu_lib->render_menu_sortable($id);
        $tpl['content'] = $this->load->view("admin/admin_menu_list_sortable.tpl", $data, true);
        $this->main_lib->render_main_page($tpl);
    }

    //сохранить порядок меню nestable
    function menu_sortable_save(){
        if ($this->input->post()) {
            $jsonstring = $this->input->post('jsonstring');
            // Декодируем в массив
            $jsonDecoded = json_decode($jsonstring, true, 64);
            function parseJsonArray($jsonArray, $parentID = 0)
            {
                $return = array();
                foreach ($jsonArray as $subArray) {
                    $returnSubSubArray = array();
                    if (isset($subArray['children'])) {
                        $returnSubSubArray = parseJsonArray($subArray['children'], $subArray['id']);
                    }
                    $return[] = array('id' => $subArray['id'], 'parentID' => $parentID);
                    $return = array_merge($return, $returnSubSubArray);
                }
                return $return;
            }
            $readbleArray = parseJsonArray($jsonDecoded);
            // циклом проходимся по массиву и сохраняем в бд
            foreach ($readbleArray as $key => $value) {
                if (is_array($value)) {
                    $data = array(
                        'order' => $key,
                        'parent_id' => $value['parentID']
                    );
                    $this->db->where('id', $value['id']);
                    $this->db->update('menus_data', $data); //or $this->main_lib->set_admin_alerts('alert_danger', 'Ошибка при сортировке записей', 'admin/menu/menu_list_sortable/');
                }
            }
            // вывод сообщения на страницу
            echo "Порядок категорий успешно сохранен в " . date("y-m-d H:i:s") . "!";
        }
    }


}
