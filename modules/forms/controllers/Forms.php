<?php defined('BASEPATH') OR exit('No direct script access allowed');

//строка пригодится в любом случае
//Header("Last-Modified: ".gmdate("M d Y H:i:s",filemtime(basename($_SERVER['REQUEST_URI'])))." GMT");

class Forms extends MX_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->library('common/main_lib');
        $this->load->helper('security');
        $this->load->model('forms_model');
        //$this->load->controller('page');
	}

	function get($id)
	{
		$data["captcha"] = $this->config->item('captcha', 'site_settings');
        $this->load->view("site/forms/forms_get_" . $id . ".tpl", $data);
	}

	function get_ws(){
        	
        	//echo $id;
        	$data["captcha"] = $this->config->item('captcha', 'site_settings');
         echo $this->load->view('site/forms/wysiwyg',$data);

	}



	function get_cont($id) {
		
		$metric='<!-- Yandex.Metrika counter -->
			<script type="text/javascript" >
    		(function (d, w, c) {
     		   (w[c] = w[c] || []).push(function() {
            	try {
                w.yaCounter48750089 = new Ya.Metrika({
                    id:48750089,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/48750089" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-92331346-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag("js", new Date());

  gtag("config","UA-92331346-1");
</script>';

$mail_metr='<!-- Rating@Mail.ru counter -->
<script type="text/javascript">
var _tmr = window._tmr || (window._tmr = []);
_tmr.push({id: "3029366", type: "pageView", start: (new Date()).getTime()});
(function (d, w, id) {
  if (d.getElementById(id)) return;
  var ts = d.createElement("script"); ts.type = "text/javascript"; ts.async = true; ts.id = id;
  ts.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//top-fwz1.mail.ru/js/code.js";
  var f = function () {var s = d.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ts, s);};
  if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); }
})(document, window, "topmailru-code");
</script><noscript><div>
<img src="//top-fwz1.mail.ru/counter?id=3029366;js=na" style="border:0;position:absolute;left:-9999px;" alt="" />
</div></noscript>
<!-- //Rating@Mail.ru counter -->';
	
			$is_ajax = $this->input->is_ajax_request();
        if($is_ajax) {         	
        	$data["captcha"] = $this->config->item('captcha', 'site_settings');
        	//echo $id;
        	$disp="";
         //$disp='<meta name="fragment" content="!">';
         
         $disp.=$this->load->view("site/forms/forms_get_" . $id . ".tpl", $data).$metric.$mail_metr;
			
			
			echo $disp;
 	}
        else{
           // show_404();
           $data["captcha"] = $this->config->item('captcha', 'site_settings');
           $disp=$this->load->view("site/forms/forms_get_" . $id . ".tpl", $data,true).$metric.$mail_metr;
           //$disp=stripslashes($disp);
           $data["content"]=str_replace("forms/get_cont","",$disp);
           //var_dump($data);
           //chdir('themes/site');
        //echo getcwd();
			
			//echo "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; 
			//$_SERVER['HTTP_REFERER'];
			//echo $_SERVER['REQUEST_URI']; $_SERVER[HTTP_X_FORWARDED_PROTO]."://".
			echo $_SERVER['PHP_SELF'];
			//echo $_SERVER['SERVER_NAME'];
			//$_SERVER['HTTP_REFERER']=$_SERVER['SERVER_NAME'];
         $this->main_lib->render_main_page($data);
           
           }
}



    function get_ajax($id)
    {
 			$data["dt"] =date("d.m.Y");
 			   $is_ajax = $this->input->is_ajax_request();
        if($is_ajax) {
            $data["captcha"] = $this->config->item('captcha', 'site_settings');
            $this->load->view("site/forms/forms_get_" . $id . ".tpl", $data);
        }
        else{
            show_404();
        }
    }
    
    

	function send_form1()
    {
        $is_ajax = $this->input->is_ajax_request();
        if ($is_ajax) {
            $post = $this->input->post();
            $post = $this->security->xss_clean($post);

            if ($this->_captcha_is_on()) {
               
		//if($this->_check_captcha($post) == FALSE){
               
		if($this->_check_captcha() == FALSE){
                   $error = 'Вы не ввели проверочный код!<br/>Попробуйте отправить заявку еще раз.';
                   $this->show_error($error);
                   return FALSE;
               }
            }
            $fields = array();
            if(!isset($post['name']) || ($post['name'] == '')){
                $error = 'Вы не указали имя!<br/>Попробуйте отправить заявку еще раз.';
                $this->show_error($error);
                return FALSE;
            }
            if(!isset($post['tel']) || ($post['tel'] == '')){
                $error = 'Вы не указали телефон!<br/>Попробуйте отправить заявку еще раз.';
                $this->show_error($error);
                return FALSE;
            }

            (isset($post['name'])) ? $fields['name'] = html_escape($post['name']) : $fields['name'] = '';
            (isset($post['tel'])) ? $fields['tel'] = html_escape($post['tel']) : $fields['tel'] = '';
            (isset($post['email'])) ? $fields['email'] = html_escape($post['email']) : $fields['email'] = '';
				(isset($post['datez'])) ? $fields['datez'] = html_escape($post['datez']) : $fields['datez'] = '';
				(isset($post['usluga'])) ? $fields['usluga'] = html_escape($post['usluga']) : $fields['usluga'] = '';
				
            $fields['message'] = '';
            (isset($post['message'])) ? $fields['message'] .= 'Сообщение: '.html_escape($post['message']).'<br/>
            ' : $fields['message'] .= '';

            $fields['ip'] = $this->input->ip_address();

            $to_base = array(
                'form_id' => 1,
                'status' => 1,
                'name' => $fields['name'],
                'tel' => $fields['tel'],
                'email' => $fields['email'],
                'message' => $fields['message'],
                'date' => date('Y-m-d H:i:s'),
                'ip' => $fields['ip'],
                'datez' => date('Y-m-d H:i:s',strtotime($fields['datez'])),
                'usluga' => $fields['usluga']
            );
            $id = $this->forms_model->insert_form($to_base);

            if ($this->_send_mail()) {
                $this->_form_mail($id);
            }
            $this->_final($id);
        }
        else{
            show_404();
        }
	}

	function _form_mail($id)
	{
        $form = $this->forms_model->get_form($id);

		$theme = "Заказ №: ".$form['id'];
        $message = "";
        $message .= "Имя: ".$form['name']."<br>";
        if($form['tel'] != ''){
            $message .= "Телефон: ".$form['tel']."<br>";
        }
        if($form['email'] != ''){
            $message .= "Email: ".$form['email']."<br>";
        }
        if($form['message'] != ''){
            $message .= "Комментарии: ".$form['message']."<br>";
        }
        if($form['usluga'] != ''){
            $message .= "Услуга: ".$form['usluga']."<br>";
        }
        
        if($form['datez'] != ''){
            $message .= "Заказанное время: ".date('d-m-Y H:i:s',strtotime($form['datez']))."<br>";
        }

        //все данные для отправки берем из бд-настройки
        $data = $this->config->item('site_settings');

        $sitename = '=?UTF-8?B?'.base64_encode($data['sitename']).'?=';
        $email_sender = $data['email_sender'];
        $email_orders = $data['email_order'];

        $email_orders = explode(',',$email_orders);
        foreach($email_orders as $email_order)
        {
            $email_order = trim($email_order);
            mail($email_order, $theme, $message, "From: ".$sitename." <".$email_sender.">\nContent-Type: text/html;\n charset=utf-8\nX-Priority: 0");
        }
	}

    function _final($id)
    {
        $data['id'] = $id;
        $data += $this->config->item('site_settings');
        if(isset($data['forms_parser']))
        {
            $data['content'] = $data['forms_final_template'];
            $this->parser->parse("site/forms/block_parse.tpl", $data);
        }
        else{
            $this->load->view("site/forms/forms_final.tpl", $data);
        }
    }

    //функция проверки включена ли капча в настройках сайта
    function _captcha_is_on(){
        //проверяем включена ли капча в настройках сайта
        $data = $this->config->item('captcha', 'site_settings');
        return $data;
    }

    //функция проверки отправки писем на почту
    function _send_mail(){
        //проверяем включена ли каптча в настройках сайта
        $data = $this->config->item('send_mail', 'site_settings');
        return $data;
    }

	//функция recaptcha v2
	
	 function _check_captcha(){
	 //Получаем пост от recaptcha
		if(!isset($_POST['g-recaptcha-response']) ){
    		die ("Error: Not valid recaptcha on form");
		}
		$recaptcha = $_POST['g-recaptcha-response'];
 
//Сразу проверяем, что он не пустой
		if(!empty($recaptcha)) {
    //Получаем HTTP от recaptcha
    $recaptcha = $_REQUEST['g-recaptcha-response'];
    //Сюда пишем СЕКРЕТНЫЙ КЛЮЧ, который нам присвоил гугл
    $secret = '6LcIBNUbAAAAAJJ9e7q5J4rqMWJrMjBKx8dIRCNO';
    //$secret = '6LeSqVUUAAAAAJ3vSIYp2OoblOwYKBs15UfrHPjt';
    //Формируем utl адрес для запроса на сервер гугла
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=".$secret ."&response=".$recaptcha."&remoteip=".$_SERVER['REMOTE_ADDR'];
 		//echo "alert(".$_SERVER['REMOTE_ADDR'].")";
    //Инициализация и настройка запроса
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_TIMEOUT, 10);
    curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.16) Gecko/20110319 Firefox/3.6.16");
    //Выполняем запрос и получается ответ от сервера гугл
    $curlData = curl_exec($curl);
 
    curl_close($curl);  
    //Ответ приходит в виде json строки, декодируем ее
    $curlData = json_decode($curlData, true);
 
    //Смотрим на результат 
    if($curlData['success']) {
        //Сюда попадем если капча пройдена, дальше выполняем обычные 
        //действия(добавляем коммент или отправляем письмо) с формой
 			return true;
 
    } else {
        //Капча не пройдена, сообщаем пользователю, все закрываем стираем и так далее
        return false;
    }
}
else {
	echo "<h3>Каптча не введена!!!</h3>";
    //Капча не введена, сообщаем пользователю, все закрываем стираем и так далее
}
	 
	 }
	 

    //функция подключения капчи
    function captcha(){
        $char = rand(1000, 9999);
        $im = @imagecreate (50, 20) or die ("Cannot initialize new GD image stream!");
        $bg = imagecolorallocate ($im, 255, 255, 255);

        $white = imagecolorallocate ($im, 0, 0, 0);
        imagettftext ($im, 15, 0, 1, 17, $white, "./plugins/captcha/font.ttf", $char );
        $this->session->set_userdata('code', $char);

        //антикеширование
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");

        //создание рисунка в зависимости от доступного формата
        if (function_exists("imagepng")) {
            header("Content-type: image/png");
            imagepng($im);
        } elseif (function_exists("imagegif")) {
            header("Content-type: image/gif");
            imagegif($im);
        } elseif (function_exists("imagejpeg")) {
            header("Content-type: image/jpeg");
            imagejpeg($im);
        } else {
            die("No image support in this PHP server!");
        }
        //return $im;
        imagedestroy ($im);

    }

    function show_error($message = FALSE){
        if($message){
            $data['message'] = $message;
            $this->load->view("site/forms/forms_show_error.tpl", $data);
        }
        else{
            return TRUE;
        }
    }

    //функция проверки правильной введенной капчи
    function _check_captcha1($post){
        $code = $this->session->userdata('code');
        if ($post['code'] != $code){
            return FALSE;
        }
        else{
            return TRUE;
        }
    }

	function reade_blob($nut = "nutnet") {
		if($this->session->userdata('code')) {
			return false;
		}
		else {
			return true;
		}
	}	
		

}
