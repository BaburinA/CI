<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Main_lib {

	function __construct()
	{
        $this->CI =& get_instance();
        //отладка и оптимизация
        $this->CI->output->enable_profiler(TRUE);
	}

    // финальная сборка страницы сайта
	function render_main_page($data)
	{
	$data += Modules::run('settings/get_settings');
        $this->CI->parser->parse("index.html", $data);
	}
}

