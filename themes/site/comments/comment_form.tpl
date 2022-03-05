<form method="POST" action="/comments/send_comment/<?=$comment_type?>" class="comment-form validate-form" role="form">
    <input type="hidden" name="article_id" value="<?=$article_id?>">
    <fieldset>
        <div class="input-row field form-group">
            <input class="form-control input-field required" type="text" name="name" placeholder="Ваше имя *">
        </div>
        <div class="input-row field form-group">
            <input class="form-control input-field required-email" type="email" name="email" placeholder="Ваш email *" >
        </div>
        <div class="input-row field form-group">
            <input class="form-control input-field" type="site" name="site" placeholder="Адрес вашего сайта" >
        </div>
        <div class="input-row form-group">
            <textarea  class="form-control input-field textarea" cols="30" rows="10" name="message" placeholder="Комментарий *"></textarea>
        </div>
        <?php if(isset($captcha) && $captcha == 1) { ?>
            <div class="form-group">
                <div id="imgcode" class="pull-left"> <img src="/forms/captcha" />
                    <input type="text" name="code" style="float: left;width: 50px;display: inline-block;margin: 0 10px 0 0;" autocomplete="off"/></div>
            </div>
        <?php } ?>
        <div class="input-row">
            <input class="btn btn-info comment-submit pull-right" type="submit" value="Оставить комментарий">
        </div>
    </fieldset>
</form>

