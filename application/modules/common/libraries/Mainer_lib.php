<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mainer_lib {

	function __construct()
	{
        $this->CI =& get_instance();
        //отладка и оптимизация
        $this->CI->output->enable_profiler(TRUE);
	}

    // финальная сборка страницы сайта
	function render_mainer_page($data)
	{
        $data += Modules::run('settings/get_settings');
	//print_r($data);
	//echo APPPATH;
        $this->CI->parser->parse("index.html", $data);
	}
}
