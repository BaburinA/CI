<html>
<a href="/"><h3>Услуги&nbsp;&nbsp;<img src="themes/site/up-pressed.png"> Заказать услугу???</h3></a>
<div id="popup" alt="Заказать услугу">
    <h2>Заказать услугу</h2>
    
    <form class="form-callback" role="form" method="post" action="/forms/forms/send_form1">
        <div class="form-group">
         <input class="form-control" type="text" id="name" name="name" placeholder="Как к вам обращаться">
        </div>
        <div class="form-group">
         <input class="form-control" type="text" id="tel" name="tel" placeholder="Ваш телефон" >
        </div>
     <!--   <div class="form-group">
         <input class="form-control" type="text" id="email" name="email" placeholder="Ваш e-mail">
        </div>-->
        
        <div class="form-group" class="form-control">
            <select id="usluga" name="usluga">
				<option selected>Маникюр без покрытия</option>
				<option >Маникюр с покрытием</option>
				<option >Наращивание ногтей</option>
				<option >Ламинирование ногтей</option>
				<option >Педикюр без покрытия</option>
				<option >Педикюр с покрытием</option>
				<option >Стрижка мужская</option>
				<option >Стрижка женская</option>
				<option >Полировка волос</option>
				<option >Окрашивание волос</option>
				<option >Химическая завивка волос</option>
				<option >Прическа</option>
				<option >Флисинг</option>
				<option >Кератиновое выпрямление волос</option>
			</select>
				</div>
				<div class="input-group date" id="datetimepicker1" >
     			 <input id="datez" name="datez" type="text" class="form-control" date-format="DD.MM.YYYY HH:mm"  size="16" >
     				 <span class="input-group-addon">
        			<span class="glyphicon-calendar glyphicon"></span>
      			</span>
    			</div>
    			<script type="text/javascript">
			
/*			  var minDate = new Date();
			  minHours = minDate.getHours()+1;
  				//текущее время + 1 час
  			  minDate.setHours(minHours);
    		minDate:moment() , minTime:'9:00' , maxTime:'19:00', language: 'ru-RU', pickDate: true, pick12HourFormat: true, timepicker:true

    		moment().add(1, 'days').calendar()
    		
    		language: 'ru-RU',     
    		startDate: new Date(3600 * 24 * 1000),
    		minDate: moment() ,
    		minTime:'9:00' , maxTime:'19:00',
    		minuteStepping:90,
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
        showMeridian: 1 enabledHours:[9,11,13,15,17],,          pickerPosition: "bottom-left" 
        
*/    		
	$(function () {
    		$("#datetimepicker1").datetimepicker({ language: 'ru-RU', inline: true, sideBySide: true, minuteStep:60,format:'dd-mm-yyyy HH:ii',
         todayBtn:  1,	autoclose: 1, todayHighlight: 1, startDate:new Date(), minDate:moment()
						  });   });
  			</script>
  			
        <script type="text/javascript">
		  var onloadCallback = function() {
   		 alert("grecaptcha is ready!");
   		 };
			</script>

          <div class="form-group">
          	<div class="g-recaptcha" data-sitekey="6LcIBNUbAAAAAPFNHiGSFtl4zija-oJ3UjOpIpmC" data-theme="light" style="transform:scale(0.77);transform-origin:0 0"></div>            
            </div>

        <button type="submit" class="btn-success form_submit">Отправить</button>
	</form>
</div>
<script type="text/javascript" src='https://www.google.com/recaptcha/api.js'></script>

</html>
