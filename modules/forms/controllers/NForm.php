<?php defined('BASEPATH') OR exit('No direct script access allowed');

class NForm extends MX_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->library('common/main_lib');
        $this->load->helper('security');
        $this->load->model('forms_model');
        //$this->load->controller('page');
	}

    function new_formalizer() {
        $is_ajax = $this->input->is_ajax_request();
        if ($is_ajax) {
            $post = $this->input->post();
            $posta = $this->security->xss_clean($post);
        }
    }
}
?>