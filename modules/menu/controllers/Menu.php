<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends MX_Controller {

	var $module_name = "menu";

	function __construct()
	{
		parent::__construct();
		$this->load->library('common/main_lib');
        $this->load->model('menu_model');
	}

    // генерация меню
    function get_menu($menu_name){
    		$menu='<div class="header main-header clearfix">
        	<div>
            	<div class="main-header__top">
                    <a href="#"  class="menu-switcher">
                          <span class="bar"></span>
                          <span class="bar"></span>
                          <span class="bar"></span>
                    </a>
                </div>
            	<div class="header-menu">
            	<div class="header_menu_open">
			<nav class="nav main-menu">
         <ul class="main-menu__menu">';          
        $query = $this->menu_model->get_menu_query($menu_name);

        foreach($query->result_array() as $cat)
        {
            $cats_ID[$cat['id']][] = $cat;
            $cats[$cat['parent_id']][$cat['id']] =  $cat;
        }

        $menu.= $this->_build_tree($cats, '0');
        $menu.='</ul></nav></div><a href="#" class="menu-switcher js-close-menu">
                            <span class="bar"></span>
                            <span class="bar"></span>
                            <span class="bar"></span>
                            <span class="bar"></span>
	                </a>
                    <div class="header-menu__cover"></div>
                </div>
                <div class="head_contacts">
                		<span>Т е л е ф о н</span>
                    <p><span><a href="tel:+7 909 062-72-72"><strong>+7 909 062-72-72 </strong></span></p></div></div></div>';
        return $menu;
        print_r($menu);
    }

    function _build_tree($cats,$parent_id,$only_parent = false){
		        $tree='';
        if(is_array($cats) and isset($cats[$parent_id])){
				   //$tree= '<ul class="sub-menu">';  
             if($only_parent==false){
             	//$tree.= '<ul class="sub-menu">';
                foreach($cats[$parent_id] as $cat){
						                    
                    $tree .= '<li><a href="'.$cat['url'].'" id="men'.$cat['id'].'" class="'.$cat['class_m'].'">'.$cat['name'].'</a>';
						if($cat['class_m']=='show-sm root-item') {$tree.= '<ul class="sub-menu">';}                  
                    $tree .=  $this->_build_tree($cats,$cat['id']);
                    $tree .= '</li>';
                    
                } 
                
            }elseif(is_numeric($only_parent)){
            	
                $cat = $cats[$parent_id][$only_parent];
                $tree .= '<li>'.$cat['name'].' #'.$cat['id'];
                $tree .=  $this->_build_tree($cats,$cat['id']);
                $tree .= '</li>';
            }
            $tree .= '</ul>';
        }
        else return null;
        return $tree;
    }

    function get_simple_menu($menu_name){
        $query = $this->menu_model->get_menu_query($menu_name);

        $html ='<nav class="nav main-menu">';
        $html.= '<ul class="main-menu__menu">';
        
        foreach ($query->result() as $row)
        {
            $href = $row->url;
            $name = $row->name;
            //$html .= "<a class='blog-nav-item' href='".$href."'>";
            $html .= "<a  href='".$href."'>";
            $html .= $name;
            $html .= "</a>";
        }
        $html .= "</nav>";
        return $html;

    }
    
 
}