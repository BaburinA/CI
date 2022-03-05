<div id="popup">
    <h3>Обратная связь</h3>
    <form class="form-callback" role="form" method="post" action="/forms/forms/send_form1">
        <div class="form-group">
            <input class="form-control" type="text" id="name" name="name" placeholder="Как к вам обращаться">
        </div>
        <div class="form-group">
            <input class="form-control" type="text" id="email" name="email" placeholder="Ваш e-mail">
        </div>
        <div class="form-group">
            <textarea class="form-control" id="message" rows="6" name="message" placeholder="Ваш вопрос"></textarea>
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