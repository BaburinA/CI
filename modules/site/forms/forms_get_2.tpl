<div id="popup">
    <h3>Заказать услугу</h3>
    <form class="form-callback" role="form" method="post" action="/forms/forms/send_form1">
        <div class="form-group">
            <input class="form-control" type="text" id="name" name="name" placeholder="Как к вам обращаться">
        </div>
        <div class="form-group">
         <input class="form-control" type="text" id="email" name="email" placeholder="Ваш e-mail"></br>
         <input class="form-control" type="text" id="teleph" name="teleph" placeholder="Ваш телефон" value="+7___________">
        </div>
        <div class="form-group">
           <!-- <textarea class="form-control" id="message" rows="6" name="message" placeholder="Ваш вопрос"></textarea> -->
           <select id="usluga" name="usluga">
				<option>Стрижка</option>
				<option>Укладка</option>
				<option>Маникюр</option>
				<option>Педикюр</option>
				</select><br>
				<select>
				<option>09:30</option>
				<option>10:00</option>
				<option>10:30</option>
				<option>11:00</option>
				</select>
        </div>
        <?php if(isset($captcha) && $captcha == 1) { ?>
            <div class="form-group">
                <div id="imgcode" class="pull-left"> <img src="/forms/captcha" />
                <input type="text" name="code" style="float: left;width: 50px;display: inline-block;margin: 0px 10px;"/></div>
            </div>
        <?php } ?>
        <button type="submit" class="btn btn-success form_submit">Отправить</button>
    </form>
</div>