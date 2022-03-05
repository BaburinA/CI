<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu_model extends CI_Model {

    function __construct()
    {
        parent::__construct();

    }

    //выбираем все меню сортируем по position
    public function get_menus($id) {
        $query = $this->db->where('menu_id', $id)->order_by('id asc, order desc')->get('menus_data');
        if ($query->num_rows() > 0) {
            $menu = $query->result_array();
            return $menu;
        }
        return FALSE;
    }

    //выбираем все меню для nestable сортируем по position
    public function get_child_menu($id) {
        $query = $this->db->where('parent_id', $id)->order_by('order')->get('menus_data');
        if ($query->num_rows() > 0) {
            $menu = $query->result_array();
            return $menu;
        }
        return FALSE;
    }

    //выбираем все меню сортируем по position
    public function get_parent_menus($id) {
        $query = $this->db->order_by('order')->where('parent_id', 0)->where('menu_id', $id)->get('menus_data');
        if ($query->num_rows() > 0) {
            $menu = $query->result_array();
            return $menu;
        }
        return FALSE;
    }



	function get_menu_query($menu_name){
       $result = $this->db->select('menus.*, menus_data.*')
           ->where('menus.menu_name', $menu_name)
           ->where('menus_data.visible', '1')
           ->from('menus')
           ->join('menus_data', 'menus.id = menus_data.menu_id', 'right')
           ->order_by('menus_data.order asc, menus_data.id asc')
           ->get();
       return $result;
   }

}