<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Menu_lib {

    public $categories = array();
    public $level = 0;

    function __construct()
    {
        $this->CI = get_instance();
        //$this->CI->load->module('auth')->check_access(); //проверка доступа
        $this->CI->load->model('admin/menu_model');
    }

    private $url;

    //создание древовидного списка меню
    function get_select_menu($active_id=0)
    {
        $query = $this->CI->db->where('visible', '1')->get('menus_data');
        if($query->num_rows() > 0)
        {
            $cats = array();
            foreach ($query->result_array() as $cat)
            {
                $cats[$cat['parent_id']][] = $cat;
            }

            function create_tree ($cats, $active_id, $parent_id, $level=0)
            {
                if(is_array($cats) and  isset($cats[$parent_id]))
                {
                    $tree = '';
                    foreach($cats[$parent_id] as $cat)
                    {
                        ($active_id == $cat['id']) ? $selected = " selected='selected' " : $selected = '';
                        $padding = " style=\"padding-left:".($level*10)."px;\" ";
                        $tree .= "<option".$padding."value='".$cat['id']."'".$selected.">";
                        for($i = 1; $i<=$level ;$i++){
                            $tree .= "-";
                        }
                        $tree .= "&nbsp;".$cat['name'];
                        $tree .= "</option>";
                        $tree .=  create_tree ($cats, $active_id, $cat['id'], $level+1);
                    }
                }
                else
                {
                    return null;
                }
                return $tree;
            }
            $html = '<select class="form-control" name="parent_id">';
            $html .= '<option value="0" selected="selected">&nbsp;Не указан</option>';
            $html .= create_tree ($cats, $active_id, 0);
            $html .= "</select>";
            return $html;
        }
        else
        {
            $html = '<select class="form-control" name="parent_id">';
            $html .= '<option value="0" selected="selected">&nbsp;Не указан</option>';
            $html .= "</select>";
            return $html;
        }

    }

    //создание древовидного списка категорий
    function get_select_categories($active_page=0)
    {
        if($active_page != ""){
            $fullurl = explode('/', trim($active_page, ' /'));
            if (isset($fullurl[1]) && $fullurl[0] == "category"){
                $this->url = $fullurl[1];
            }
        }
        $query = $this->CI->db->get('category');
        if($query->num_rows() > 0)
        {
            $cats = array();
            foreach ($query->result_array() as $cat)
            {
                $cats[$cat['parent_id']][] = $cat;
            }

            function create_catalog ($cats, $url, $parent_id, $level=0)
            {
                if(is_array($cats) and  isset($cats[$parent_id]))
                {
                    $tree = '';
                    foreach($cats[$parent_id] as $cat)
                    {
                        ($url == $cat['meta_url']) ? $selected = " selected='selected' " : $selected = '';
                        $tree .= "<option value='".$cat['meta_url']."'".$selected.">";
                        for($i = 1; $i<=$level ;$i++){
                            $tree .= "-";
                        }
                        $tree .= "&nbsp;".$cat['name'];
                        $tree .= "</option>";
                        $tree .=  create_catalog ($cats, $url, $cat['id'], $level+1);
                    }
                }
                else
                {
                    return null;
                }
                return $tree;
            }
            $html = '<select class="form-control" name="url" title="Выберите страницу из списка">';
            $html .= '<option value="" disabled selected>&nbsp;Без категории</option>';
            $html .= create_catalog ($cats, $this->url, 0);
            $html .= "</select>";
            return $html;
        }
        else
        {
            return "Нет категорий";
        }
    }

    //создание древовидного списка меню
    function get_select_page($active_page=0)
    {
        if($active_page != ""){
            $fullurl = explode('/', trim($active_page, ' /'));
            if (isset($fullurl[1]) && $fullurl[0] == "page"){
                $this->url = $fullurl[1];
            }
        }
        $query = $this->CI->db->get('pages');
        $result = $query->result_array();
        if($query->num_rows() > 0) {
            function create_pages($result, $url)
            {
                $tree = "";
                foreach ($result as $cat) {
                    ($url == $cat['meta_url']) ? $selected = " selected='selected' " : $selected = '';
                    $tree .= "<option value='" . $cat['meta_url'] . "'".$selected.">";
                    $tree .= $cat['name'];
                    $tree .= "</option>";
                }
                return $tree;
            }
            $html = '<select class="form-control" name="url" title="Выберите страницу из списка">';
            $html .= '<option value="" disabled selected>&nbsp;Страница не выбранна</option>';
            $html .= create_pages($result, $this->url);
            $html .= "</select>";
            return $html;
        }
        else
        {
            return "Нет категорий";
        }
    }

    //создание древовидного каталога для списка меню
    function _build_menu($id) {
        $this->menu = $this->CI->db->where('menu_id', $id)->order_by('order asc, id asc')->get('menus_data')->result_array();
        $new_cats = array();
        if ($this->menu)
            foreach ($this->menu as $cats) {
                if ($cats['parent_id'] == 0) {
                    # Category Level
                    $cats['level'] = $this->level;
                    # Category SubTree
                    $sub = $this->_get_sub_menu($cats['id']);
                    if (count($sub))
                        $cats['subtree'] = $sub;
                        array_push($new_cats, $cats);
                }
            }
        unset($this->menu);
        return $new_cats;
    }

    //выборка дочерних меню
    function _get_sub_menu($parent_id) {
        $new_sub_cats = array();
        $this->level++;
        foreach ($this->menu as $sub_cats) {
            if ($sub_cats['parent_id'] == $parent_id) {
                $sub_cats['level'] = $this->level;
                $sub = $this->_get_sub_menu($sub_cats['id']);
                if (count($sub))
                    $sub_cats['subtree'] = $sub;
                    array_push($new_sub_cats, $sub_cats);
            }
        }
        $this->level--;
        return $new_sub_cats;
    }

    //вывод дочерних пунктов меню nestable
    function menu_shownested($parent_id){
        $result = $this->CI->menu_model->get_child_menu($parent_id);
        if (!empty($result)) {
            $html = "\n";
            $html .= "<ol class='dd-list'>\n";
            foreach($result as $row) {
                $html .= "\n";
                $html .= "<li class='dd-item' data-id='{$row['id']}'>\n";
                $html .= "<div class='dd-handle'><a href='/admin/edit_menu/{$row['id']}' title='Редактировать меню' >{$row['id']}: {$row['name']}</a>
                        <a href='/admin/delete_menu/{$row['id']}' class='icon fa fa-trash'></a>
                        <a href='/admin/edit_menu/{$row['id']}' class='icon fa fa-pencil'></a>
                        <p class='icon2'>{$row['url']}</p>
                        </div>\n
                        ";
                // Run this function again (it would stop running when the mysql_num_result is 0
                $html .= $this->menu_shownested($row['id']);
                $html .= "</li>\n";            }
            $html .= "</ol>\n";
            return $html;
        }
    }

    //вывод родителей nestable меню
    function render_menu_sortable($id){
        $result = $this->CI->menu_model->get_parent_menus($id);
        $html = "<div class='cf nestable-lists'>\n";
        $html .= "<div class='dd' id='nestableMenu'>\n\n";
        $html .= "<ol class='dd-list'>\n";
        foreach($result as $row) {
            $html .= "\n";
            $html .= "<li class='dd-item' data-id='{$row['id']}'>";
            $html .= "<div class='dd-handle'><a href='/admin/edit_menu/{$row['id']}' title='Редактировать меню' >{$row['id']}: {$row['name']}</a>
                        <a href='/admin/delete_menu/{$row['id']}' class='icon fa fa-trash'></a>
                        <a href='/admin/edit_menu/{$row['id']}' class='icon fa fa-pencil'></a>
                        <p class='icon2'>{$row['url']}</p>
                        </div>\n";
            $html .= $this->menu_shownested($row['id']);
            $html .= "</li>\n";
        }
        $html .= "</ol>\n\n";
        $html .= "</div>\n";
        $html .= "</div>\n\n";
        // блок для обновления иерархии в БД
        // Блок должен быть здесь не перемещайте его
        $html .= "<div class='alert alert-dismissable alert-info mini-alert'>
              <button type='button' class='close' data-dismiss='alert'>×</button>
              <div id='sortDBfeedback' class='sort_feedback' ></div>
            </div>\n";
        $html .= '<input type="hidden" name="menu_id" id="menu_id" value="{$id}">';
        // Скрипт для отладки
        //$html .= "<textarea id='nestableMenu-output'></textarea>";
        return $html;
    }

}

