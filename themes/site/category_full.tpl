<div class="container">
    <div class="blog-header">
        <h1 class="blog-title"><?=("$meta_h1" != '') ? "$meta_h1" : "$name"?></h1>
    </div>

    <div class="row">
        <div class="col-sm-8 blog-main">
            <?php if(!empty($categories)): ?>
                <div class="row">
                <?php foreach ($categories as $category): ?>
                    <div class="col-sm-4">
                        <?=($category['image'] != '') ? '<a href="/category/'.$category['meta_url'].'"><img class="img-thumbnail" src="'.$category['image'].'"></a>':'<a href="/category/'.$category['meta_url'].'"><img class="img-thumb" src="/themes/site/images/no_photo.jpg"></a>'?>
                        <h2><a href="/category/<?=$category['meta_url']?>"><?=$category['name']?></a></h2>
                    </div>
                <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <hr>

            <?php if(empty($pages)): ?>
                <p>В категории нет страниц</p>
            <?php else: ?>
                <?php foreach ($pages as $page): ?>
                    <div class="row" style="margin-bottom:5px;">
                        <div class="col-sm-3">
                            <?=($page['image'] != '') ? '<a href="/page/'.$page['meta_url'].'"><img class="img-thumbnail" src="'.$page['image'].'"></a>':'<a href="/page/'.$page['meta_url'].'"><img class="img-thumbnail" src="/themes/site/images/no_photo.jpg"></a>'?>

                        </div>
                        <div class="col-sm-9">
                            <h4><a href="/page/<?=$page['meta_url']?>"><?=$page['name']?></a></h4>
                            <div><?=$page['content']?> <a href="/page/<?=$page['meta_url']?>">Далее</a></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <div class="row">
                <div class="col-sm-12 text-center">
                    <?=$links?>
                </div>
            </div>

            <?php if($content != '') { ?>
                <hr>
                <?php if($image != '') { ?>
                    <img class="img-thumbnail" src="<?=$image?>" alt="image description" >
                <?php } ?>
                <?=$content?>

            <?php } ?>

        </div>

        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
            <div class="sidebar-module sidebar-module-inset">
                <h4>О сайте</h4>
                <p>Текст <em>с описанием</em> зачем нам нужен этот сайт.</p>
                <a class="btn btn-primary open_popup" href="/forms/get_ajax/1">Задать вопрос</a>
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

