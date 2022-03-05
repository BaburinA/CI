<div class="container">
    <div class="blog-header">
        <h1 class="blog-title"><?=("$meta_h1" != '') ? "$meta_h1" : "$name"?></h1>
        <p class="lead blog-description"><?=date("d-m-Y", strtotime($created))?></a> by <a href="http://polyakov.co.ua/page/about-me"><?=$author?></a></p>
    </div>

    <div class="row">
        <div class="col-sm-8 blog-main">
            <?php if($image != '') { ?>
                <img class="img-thumbnail" src="<?=$image?>" alt="<?=$name?>" >
            <?php } ?>

            <?=$content?>

            <?php if($comments_on == 1) { ?>
                <div class="clearfix"></div>
                <p>&nbsp;</p>
                <?php echo Modules::run('comments/get_all_comments', $id, 'pages'); ?>
                <div class="leave-comments">
                    <div class="row">
                        <div class="col-sm-8">
                            <header>
                                <p class="leave-comments">Оставить свой отзыв</p>
                            </header>
                            <?php echo Modules::run('comments/get_comment_form', $id, 'pages'); ?>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <p>&nbsp;</p>
            <?php } ?>

        </div>

        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
            <div class="sidebar-module sidebar-module-inset">
                <h4>О сайте</h4>
                <p>О парикмахерской <em>Credo</em> .</p>
                <a class="btn btn-primary open_popup" href="/forms/get_ajax/2">Заказать услугу</a>
            </div>
            <div class="sidebar-module">
                <h4>Навигация</h4>
                <div id="right_menu">
                    <?=Modules::run('menu/get_menu', 'right_menu')?>
                </div>
            </div>
        </div>
    </div>
</div>

