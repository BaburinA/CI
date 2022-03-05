<form class="form-horizontal form-menu p-t-20" id="formurl" action="/admin/menu/save_menu/true" method="post" role="form">
    <div class="panel panel-default">
        <div class="panel-heading panel-crud">
            <div class="row">
                <div class="panel-title col-sm-12">
                    <h3 class="col-sm-4 text-primary">Создание пункта меню</h3>
                    <div id="options-content" class="col-sm-8 text-right">
                        <a href="/admin/menu/menu_list/<?=$menu['menu_id']?>" class="panel-href" title="Вернутся">
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
                <li class="active"><a href="#url" data-url="url" data-toggle="tab" aria-expanded="false">URL</a></li>
                <li class=""><a href="#page" data-url="page" data-toggle="tab" aria-expanded="false">Страница</a></li>
                <li class=""><a href="#category" data-url="category" data-toggle="tab" aria-expanded="true">Категория</a></li>
            </ul>
            <div id="menuTabContent" class="tab-content">
                <div class="tab-pane active" id="url">
                    <legend class="col-sm-10 col-sm-offset-2">URL</legend>
                    <div class="form-group">
                        <label for="url" class="col-sm-2 control-label">URL</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="url" name="url">
                        </div>
                    </div>
                    <legend class="col-sm-10 col-sm-offset-2">Параметры</legend>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Имя</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="name" name="name">
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
                            <input type="text" class="form-control" id="inputOrder" name="order">
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="page">
                    <legend class="col-sm-10 col-sm-offset-2">Страница</legend>
                    <div class="form-group">
                        <label for="inputURL" class="col-sm-2 control-label">Выберите страницу</label>
                        <div class="col-sm-8">
                            <?=$menu['page']?>
                        </div>
                    </div>
                    <legend class="col-sm-10 col-sm-offset-2">Параметры</legend>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Имя</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="name" name="name" >
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
                            <input type="text" class="form-control" id="inputOrder" name="order" >
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="category">
                    <legend class="col-sm-10 col-sm-offset-2">Категория</legend>
                    <div class="form-group">
                        <label for="inputURL" class="col-sm-2 control-label">Выберите категорию</label>
                        <div class="col-sm-8">
                            <?=$menu['categories']?>
                        </div>
                    </div>
                    <legend class="col-sm-10 col-sm-offset-2">Параметры</legend>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Имя</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="name" name="name" >
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
                            <input type="text" class="form-control" id="inputOrder" name="order">
                        </div>
                    </div>
                </div>

                <input type="hidden" value="" name="id">
                <input type="hidden" value="1" name="visible">
                <input type="hidden" value="url" name="menu_type" id="menu_type">
                <input type="hidden" value="<?=$menu['menu_id']?>" name="menu_id">
            </div>
        </div>
    </div>
</form>
