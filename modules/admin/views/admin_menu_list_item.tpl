<div class="row row-category margin-0" >
    <div class="col-sm-1 t-a_c">
        <div class="checkbox-del">
            <input type="checkbox" name="ids[<?=$item["id"];?>]" value="<?=$item["id"];?>"  id="checkbox-<?=$item["id"];?>"><label for="checkbox-<?=$item["id"];?>"></label>
        </div>
    </div>       
    <div class="col-sm-1"><?= $item["id"]; ?></div>
    <div class="col-sm-4 text-overflow">
        <div class="title <?php if($item["parent_id"] > 0) echo "lev"; ?>" >
            <?php if(isset($item["subtree"])) { ?>

                <button type="button" class="btn btn-warning btn-xs my_btn_s"
                        style="display: none;" data-rel="tooltip"
                        data-placement="top" data-original-title="Свернуть меню">
                    <i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-info btn-xs my_btn_s"
                        data-rel="tooltip" data-placement="top"
                        data-original-title="Развернуть меню">
                    <i class="fa fa-plus"></i>
                </button>
            <?php } else { ?>
                <span class="simple_tree">↳</span>
            <?php } ?>
            <a href="/admin/edit_menu/<?= $item["id"]; ?>" data-rel="tooltip" data-placement="top" data-original-title="Редактировать меню" ><?=$item["name"]; ?></a>
        </div></div>
    <div class="share_alt col-sm-4 text-overflow" >
        <i class="icon-share-alt"></i>
        <div class="o_h">
            <?php echo $item["url"]; ?>
        </div>
    </div>
    <div class="col-sm-1 text-center">
        <?php echo $item["order"]; ?>
    </div>
    <div class="col-sm-1 text-center">
        <div class="onchange">
            <input class="checkbox-slide" type="checkbox" id="checkboxs-<?=$item["id"];?>"  value="<?=$item["id"];?>" <?php echo ($item['visible'] == '1') ? 'checked="checked"' : ''; ?> /><label for="checkboxs-<?=$item["id"];?>"></label>
        </div>
    </div>
</div>
