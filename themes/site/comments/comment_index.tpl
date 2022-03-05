<?php if(!empty($comments)) { ?>
    <header>
        <p class="header-comments"> Комментариев - <?=$total_comments?></p>
    </header>

    <div class="conmments-block">
        <?=$comments?>
    </div>
<?php } ?>