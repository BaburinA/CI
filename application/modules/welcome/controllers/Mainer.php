<?php
class Mainer extends MX_Controller {
	
	 function __construct()
    {
        parent::__construct();
        $this->load->library('common/mainer_lib');
    }

    function index()
    {
	 $data = array();
	//echo base_url();
        $data['url']='../application/mainer/';
	echo $this->uri->uri_string();
        $data['content'] = ' Welcome page with new controllers';
        $this->mainer_lib->render_mainer_page($data);
    }

    function comments()
    {
	echo 'Взгляни сюда!';
    }
}
?>