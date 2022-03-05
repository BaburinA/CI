<div class="reply_form">
    <form action="/comments/send_reply_comment/<?=$comment_type?>" class="reply-comment-form validate-form" role="form" method="POST">
        <input type="hidden" name="article_id" value="<?=$article_id?>">
        <input type="hidden" name="parent_id" value="<?=$comment_id?>">
        <fieldset>
            <div class="input-row field form-group">
                <input class="form-control input-field required" type="text" name="name" placeholder="Ваше имя *">
            </div>
            <div class="input-row field form-group">
                <input class="form-control input-field required-email" type="email" name="email" placeholder="Ваш email *">
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
                        <input type="text" name="code" style="float: left;width: 50px;display: inline-block;margin: 0 10px 0 0;"/></div>
                </div>
            <?php } ?>
            <div class="input-row">
                <input class="btn btn-info reply-comment-submit" type="submit" value="Оставить комментарий">
            </div>
        </fieldset>
    </form>
</div>