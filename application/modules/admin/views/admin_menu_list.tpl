<div class="panel panel-default">
    <div class="panel-heading panel-crud">
        <div class="row">
            <div class="panel-title col-sm-12">
                <h3 class="col-sm-2 text-primary"><?=$menu_data['name']?></h3>
                <div id="options-content" class="col-sm-10 text-right">
                    <a href="/admin/menus_list" class="panel-href" title="Вернутся">
                        <i class="fa fa-long-arrow-left"></i> Вернутся
                    </a>
                    <a class="btn btn-danger btn-sm" href="/admin/delete_menu" onclick="CMSApi.deleteFunction('deleteCheckbox', '/admin/menu_list/<?=$menu_id?>'); return false;" title="Удалить" class="add-anchor btn" id="deleteCheckbox" disabled="disabled">
                        <i class="fa fa-trash"></i> Удалить
                    </a>
                    <a class="btn btn-info btn-sm" href="/admin/menu_list_sortable/<?=$menu_id?>" title="Сортировать меню" class="add-anchor btn">
                        <i class="fa fa-sort-amount-asc"></i> Сортировать меню
                    </a>
                    <a class="btn btn-success btn-sm" href="/admin/add_menu/<?=$menu_id?>" title="Добавить пункт меню" class="add-anchor btn">
                        <i class="fa fa-plus-circle"></i> Добавить пункт меню
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <div class="frame_table">
            <div id="category">
                <div class="row row-category head margin-0">
                    <div class="col-sm-1 t-a_c">
                        <div class="checkbox-del" id="allCheckbox">
                            <input type="checkbox" id="checkbox"><label for="checkbox"></label>
                        </div>
                    </div>
                    <div class="col-sm-1">ID</div>
                    <div class="col-sm-4">Название</div>
                    <div class="col-sm-4">Ссылка</div>
                    <div class="col-sm-1 text-center">Вес</div>
                    <th class="col-sm-1 text-center">Отображать</th>
                </div>
                <div class="body_category frame_level">
                    <div class="sortable save_positions" data-url="/admin/save_positions/">
                        <?=$menu_list?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

