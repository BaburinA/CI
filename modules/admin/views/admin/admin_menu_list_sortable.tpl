<div class="panel panel-default">
    <div class="panel-heading panel-crud">
        <div class="row">
            <div class="panel-title col-sm-12">
                <h3 class="col-sm-2 text-primary">Главное меню</h3>
                <div id="options-content" class="col-sm-10 text-right">
                    <menu id="nestable-menu">
                        <button class="btn btn-info btn-sm" type="button" data-action="expand-all">
                            <i class="fa fa-arrow-down"></i> Раскрыть меню
                        </button>
                        <button class="btn btn-danger btn-sm" type="button" data-action="collapse-all">
                            <i class="fa fa-arrow-up"></i> Сложить меню
                        </button>
                        <a class="btn btn-success btn-sm" href="/admin/menu/add_menu/<?=$menu_id?>" title="Добавить пункт меню" class="add-anchor btn">
                            <i class="fa fa-plus-circle"></i> Добавить пункт меню
                        </a>
                        <a class="btn btn-primary btn-sm" href="/admin/menu/menu_list/<?=$menu_id?>" title="Редактировать меню" class="add-anchor btn">
                            <i class="fa fa-sliders"></i> Редактировать меню
                        </a>
                    </menu>

                </div>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <div class="frame_table">
            <div id="menu">
                <h4 class="col-sm-6 text-primary">Сортировка меню</h4>
                <div class="row row-category head margin-0">
                    <?=$menuTreeHTML?>
                </div>

            </div>

        </div>
    </div>
</div>
