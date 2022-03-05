<form class="form-horizontal form-menus" action="/admin/save_menus/true" method="post" role="form">
    <div class="panel panel-default">
        <div class="panel-heading panel-crud">
            <div class="row">
                <div class="panel-title col-sm-12">
                    <h3 class="col-sm-4 text-primary">Создание меню</h3>
                    <div id="options-content" class="col-sm-8 text-right">
                        <a href="/admin/menus_list" class="panel-href" title="Вернутся">
                            <i class="fa fa-long-arrow-left"></i> Вернутся
                        </a>
                        <button type="submit"  class="btn btn-success btn-sm" title="Сохранить и выйти">
                            <i class="fa fa-check"></i> Сохранить
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Название</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="inputName" name="name" >
                </div>
            </div>
            <div class="form-group">
                <label for="menu_name" class="col-sm-2 control-label">Системное имя</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="menu_name" name="menu_name" >
                </div>
                <div class="col-sm-2">
                    <button type="button" class="btn btn-small col-sm-12 pull-right" onclick="CMSApi.urlTranslit('inputName', 'menu_name'); return false;"><i class="fa fa-refresh"></i> Автозаполнение</button>
                </div>
            </div>
            <div class="form-group">
                <label for="description" class="col-sm-2 control-label">Описание</label>
                <div class="col-sm-8">
                    <textarea class="form-control" id="description" rows="4" name="description"></textarea>
                </div>
            </div>
            <input type="hidden" name="id" id="inputID">
        </div>
    </div>
</form>