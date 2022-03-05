<form class="form-horizontal form-menu p-t-20" id="formurl" action="/admin/save_menu" method="post" role="form">
    <div class="panel panel-default">
        <div class="panel-heading panel-crud">
            <div class="row">
                <div class="panel-title col-sm-12">
                    <h3 class="col-sm-4 text-primary">Редактирование пункта меню</h3>
                    <div id="options-content" class="col-sm-8 text-right">
                        <a href="/admin/menu_list/<?=$menu['menu_id']?>" class="panel-href" title="Вернутся">
                            <i class="fa fa-long-arrow-left"></i> Вернутся
                        </a>
                        <button type="submit" id="menu_submit" class="btn btn-success btn-sm" title="Сохранить и выйти">
                            <i class="fa fa-check"></i> Сохранить
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <ul class="nav nav-tabs">
                <li class="<?php echo ($menu['menu_type'] == "url") ? "active" : ""; ?>"><a href="#url" data-url="url" data-toggle="tab" aria-expanded="false">URL</a></li>
                <li class="<?php echo ($menu['menu_type'] == "page") ? "active" : ""; ?>"><a href="#page" data-url="page" data-toggle="tab" aria-expanded="false">Страница</a></li>
                <li class="<?php echo ($menu['menu_type'] == "category") ? "active" : ""; ?>"><a href="#category" data-url="category" data-toggle="tab" aria-expanded="true">Категория</a></li>
            </ul>

            <div id="menuTabContent" class="tab-content">
                <div class="tab-pane <?php echo ($menu['menu_type'] == "url") ? "active" : ""; ?>" id="url">
                    <div class="form-group">
                        <label for="url" class="col-sm-2 control-label">URL</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="url" name="url" value="<?=$menu['url']?>">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Имя</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="name" name="name" value="<?=$menu['name']?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputParent" class="col-sm-2 control-label">Родитель</label>
                        <div class="col-sm-8">
                            <?=$menu['parent_id']?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputOrder" class="col-sm-2 control-label">Порядок</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" id="inputOrder" name="order" value="<?=$menu['order']?>">
                        </div>
                    </div>
                </div>

                <div class="tab-pane <?php echo ($menu['menu_type'] == "page") ? "active" : ""; ?>" id="page">
                    <div class="form-group">
                        <label for="inputURL" class="col-sm-2 control-label">Выберите страницу</label>
                        <div class="col-sm-8">
                            <?=$menu['page']?>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Имя</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="name" name="name" value="<?=$menu['name']?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputParent" class="col-sm-2 control-label">Родитель</label>
                        <div class="col-sm-8">
                            <?=$menu['parent_id']?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputOrder" class="col-sm-2 control-label">Порядок</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" id="inputOrder" name="order" value="<?=$menu['order']?>">
                        </div>
                    </div>
                </div>

                <div class="tab-pane <?php echo ($menu['menu_type']) == "category" ? "active" : ""; ?>" id="category">
                    <div class="form-group">
                        <label for="inputURL" class="col-sm-2 control-label">Выберите категорию</label>
                        <div class="col-sm-8">
                            <?=$menu['categories']?>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Имя</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="name" name="name" value="<?=$menu['name']?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputParent" class="col-sm-2 control-label">Родитель</label>
                        <div class="col-sm-8">
                            <?=$menu['parent_id']?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputOrder" class="col-sm-2 control-label">Порядок</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" id="inputOrder" name="order" value="<?=$menu['order']?>">
                        </div>
                    </div>
                </div>
                <input type="hidden" value="<?=$menu['menu_type']?>" name="menu_type" id="menu_type">
                <input type="hidden" value="<?=$menu['visible']?>" name="visible">
                <input type="hidden" value="<?=$menu['id']?>" name="id">
                <input type="hidden" value="<?=$menu['menu_id']?>" name="menu_id">
            </div>
        </div>
    </div>
</form>
