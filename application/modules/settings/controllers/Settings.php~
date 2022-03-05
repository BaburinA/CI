<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('common/main_lib');
	}
    
    // массив нужных для всех остальных страниц настроек
	function get_settings()
	{
	    $data = array();
	    $tbl = $this->db->get('main_set')->result_array();
	    	foreach($tbl as $ki => $tbl_t) 
			{
    			$settings = $this->db->get($tbl_t)->result_array();
    			//$settings = $this->db->get('settings')->result_array();
					foreach ($settings as $key => $value)
						{
						$data[$value['name']] = $value['value'];
						}
	    }
		return $data;
	}

	// выбор одной настройки сайта
	function get_one_setting($name,$tbl)
	{
		$this->db->where("name", $name);
		$query = $this->db->get($tbl);
		$data = $query->row_array();
		return $data['value'];
	}

}