<div id="slider-<?=$slide['slider_name']?>" class="carousel slide" data-ride="carousel" data-interval="4500">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <?php for($i=0; $i < count($sliders); $i++) { ?>
        <li data-target="#slider-<?=$slide['slider_name']?>" data-slide-to="<?=$i?>" <?=($i==0) ? 'class="active"' : '';?>></li>
        <?php } ?>
    </ol>

    <div class="carousel-inner">
        <?php if(isset($sliders)) foreach ($sliders as $key => $slider):?>
            <div class="item <?=($key==0) ? 'active' : ''?>">
                <?php if ($slider["picture"] != ""){ ?>
                    <img src="<?=$slider["picture"]?>" alt="<?=$slider["name"]?>" title="<?=$slider["name"]?>">
                <?php } ?>
                <div class="carousel-caption  hidden-xs hidden-sm">
                    <p class="carousel_header"><?=$slider["name"]?></p>
                    <span class="carousel_text"><?=($slider["text"] != '') ? $slider['text'] : ''?></span>
                    <?php if ($slider["url"] != ""){ ?>
                       <!-- <a href="<?=($slider["url"] != '') ? $slider["url"] : '/'?>" class="btn btn-info carousel_button"><?=($slider["button_name"] != '') ? $slider["button_name"] : 'Подробнее'?></a> -->
						<a href="<?=($slider["url"] != '') ? $slider["url"] : '/'?>" class="btn btn-primary open_popup"><?=($slider["button_name"] != '') ? $slider["button_name"] : 'Подробнее'?></a>                
                       <!-- это для всплыв окна --- class="btn btn-primary open_popup" -->
                    <?php } ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <a class="carousel-control left" href="#slider-<?=$slide['slider_name']?>" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    <a class="carousel-control right" href="#slider-<?=$slide['slider_name']?>" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
    </a>
</div>
