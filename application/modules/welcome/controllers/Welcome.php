<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MX_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->library('common/main_lib');
    }

	public function index()
	{
		//$this->load->view('welcome_message');
		$this->hmvc();
	//echo base_url();
	}

    public function hmvc()
    {
        $data = array();
        $data['url']='../application/site/';
	//echo $this->uri->uri_string();
        $data['content'] = ' Welcome page with new controllers';
        $this->main_lib->render_main_page($data);
    }


}

