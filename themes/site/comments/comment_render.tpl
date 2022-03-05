<div class="comments-block author-info"  id="post_comment_<?=$item['id']?>">
    <div class="row">
        <div class="col-lg-1 col-xs-2 text-center">
            <i class="fa fa-comments-o"></i>
        </div>
        <div class="col-lg-3 col-xs-6">
            <?php if($item['site'] != '') { ?>
            <p class="comment-name"><noindex><a target="_blank" rel="nofollow" href="<?=$item['site']?>"><?=$item['name']?></a></noindex></p>
            <?php } else { ?>
                <p class="comment-name"><?=$item['name']?></p>
            <?php } ?>
            <p class="comment-date" datetime="<?=$item['created']?>"><?=$item['created']?></p>
        </div>
        <div class="col-lg-8 col-xs-12">
            <p><?=$item['message']?></p>
            <a href="javascript:void(0);" class="pull-right btn_reply_comment" data-comment-type="<?=$item['type']?>" data-article-id="<?=$item['article_id']?>" data-comment-id="<?=$item['id']?>">Ответить</a>

        </div>
    </div>
</div>

