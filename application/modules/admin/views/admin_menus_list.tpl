<div class="panel panel-default">
    <div class="panel-heading panel-crud">
        <div class="row">
            <div class="panel-title col-sm-12">
                <h3 class="col-sm-2 text-primary">Список меню</h3>
                <div id="options-content" class="col-sm-10 text-right">
                    <a class="btn btn-danger btn-sm" href="/admin/delete_menus" onclick="CMSApi.deleteFunction('deleteCheckbox', '/admin/menus_list'); return false;" title="Удалить" class="add-anchor btn" id="deleteCheckbox" disabled="disabled">
                        <i class="fa user-times"></i>
                        Удалить
                    </a>
                    <a class="btn btn-success btn-sm" href="/admin/add_menus" title="Создать меню" class="add-anchor btn">
                        <i class="fa fa-plus-circle"></i> Создать
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-hover ">
            <thead>
            <tr>
                <th>
                    <div class="checkbox-del" id="allCheckbox">
                        <input type="checkbox" id="checkbox"><label for="checkbox"></label>
                    </div>
                </th>
                <th>ID</th>
                <th>Название</th>
                <th>Системное имя</th>
                <th>Описание</th>
                <th class="text-center">Действия</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($menus as $menu):?>
                <tr>
                    <td>
                        <div class="checkbox-del">
                            <input type="checkbox" name="ids[<?=$menu['id']?>]" value="<?=$menu['id']?>"  id="checkbox-<?=$menu['id']?>"><label for="checkbox-<?=$menu['id']?>"></label>
                        </div>
                    </td>
                    <td><?=$menu['id']?></td>
                    <td class="col-sm-3">
                        <i class="fa fa-navicon"></i>&nbsp;
                        <a href="/admin/menu_list/<?=$menu['id']?>" data-rel="tooltip" data-placement="top" data-original-title="Редактировать список и содержание меню"><?=$menu['name']?></a>
                    </td>
                    <td class="col-sm-3"><?=$menu['menu_name']?></td>
                    <td class="col-sm-5"><?=$menu['description']?></td>
                    <td class="col-sm-1">
                        <a href="/admin/edit_menus/<?=$menu['id']?>" class="btn btn-sm btn-link remove-image" data-rel="tooltip" data-placement="top" data-original-title="Редактировать параметры меню">
                            <i class="glyphicon glyphicon-pencil"></i> Редактировать
                        </a>
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>

