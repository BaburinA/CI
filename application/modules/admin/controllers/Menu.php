<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends MX_Controller {

	var $module_name = "menu";

	function __construct()
	{
		parent::__construct();
		$this->load->library('common/main_lib');
	}

    // генерация меню
    function get_menu($menu_name){
        $menus = $this->db->select('*')->where('menu_name', $menu_name)->get('menus')->row_array();
        $query = $this->db->select('*')->from('menus_data')->where('visible', '1')->where('menu_id', $menus['id'])->order_by('order asc, id asc')->get(); //пока сортируем по id

        foreach($query->result_array() as $cat)
        {
            $cats_ID[$cat['id']][] = $cat;
            $cats[$cat['parent_id']][$cat['id']] =  $cat;
        }

        $menu = $this->build_tree($cats, '0');
        return $menu;
    }



    function build_tree($cats,$parent_id,$only_parent = false){
        if(is_array($cats) and isset($cats[$parent_id])){
            $tree = '<ul>';
            if($only_parent==false){
                foreach($cats[$parent_id] as $cat){
                    $tree .= '<li><a href="'.$cat['url'].'">'.$cat['name'].'</a>';
                    $tree .=  $this->build_tree($cats,$cat['id']);
                    $tree .= '</li>';
                }
            }elseif(is_numeric($only_parent)){
                $cat = $cats[$parent_id][$only_parent];
                $tree .= '<li>'.$cat['name'].' #'.$cat['id'];
                $tree .=  $this->build_tree($cats,$cat['id']);
                $tree .= '</li>';
            }
            $tree .= '</ul>';
        }
        else return null;
        return $tree;
    }
    
    // генерация меню
    /*
	function get_main_menu(){
		$this->db->select('*')->from('menu')->where('visible', '1')->order_by('order asc, id asc'); //пока сортируем по id
		$query = $this->db->get();

		foreach($query->result_array() as $cat)
		{
			$cats_ID[$cat['id']][] = $cat;
			$cats[$cat['parent_id']][$cat['id']] =  $cat;
		}

		function build_tree($cats,$parent_id,$only_parent = false){
			if(is_array($cats) and isset($cats[$parent_id])){
				$tree = '<ul>';
				if($only_parent==false){
					foreach($cats[$parent_id] as $cat){
						$tree .= '<li><a href="'.$cat['url'].'">'.$cat['name'].'</a>';
						$tree .=  build_tree($cats,$cat['id']);
						$tree .= '</li>';
					}
				}elseif(is_numeric($only_parent)){
					$cat = $cats[$parent_id][$only_parent];
					$tree .= '<li>'.$cat['name'].' #'.$cat['id'];
					$tree .=  build_tree($cats,$cat['id']);
					$tree .= '</li>';
				}
				$tree .= '</ul>';
			}
			else return null;
			return $tree;
		}
		$menu = build_tree($cats, '0');
		return $menu;
	}
    */

    // генерация меню каталогов
    function get_catalog_menu(){
        $this->db->select('*')->from('shop_catalog')->where('active', '1')->order_by('position asc, id asc'); //пока сортируем по id
        $query = $this->db->get();

        foreach($query->result_array() as $cat)
        {
            $cats_ID[$cat['id']][] = $cat;
            $cats[$cat['parent_id']][$cat['id']] =  $cat;
        }

        function build_catalog_tree($cats,$parent_id,$only_parent = false){
            if(is_array($cats) and isset($cats[$parent_id])){
                $tree = '<ul>';
                if($only_parent==false){
                    foreach($cats[$parent_id] as $cat){
                        $tree .= '<li><a href="/shop/catalog/'.$cat['meta_url'].'">'.$cat['name'].'</a>';
                        $tree .=  build_catalog_tree($cats,$cat['id']);
                        $tree .= '</li>';
                    }
                }elseif(is_numeric($only_parent)){
                    $cat = $cats[$parent_id][$only_parent];
                    $tree .= '<li>'.$cat['name'].' #'.$cat['id'];
                    $tree .=  build_catalog_tree($cats,$cat['id']);
                    $tree .= '</li>';
                }
                $tree .= '</ul>';
            }
            else return null;
            return $tree;
        }
        $menu = build_catalog_tree($cats, '0');
        return $menu;
    }
    
 
}