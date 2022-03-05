<div class="panel panel-default">
    <div class="panel-heading panel-crud">
        <div class="row">
            <div class="panel-title col-lg-12">
                <h3 class="col-lg-2 text-primary">Главное меню</h3>
                <div id="options-content" class="col-lg-10 text-right">
                    <a class="btn btn-success btn-sm" href="/admin/add" title="Создать страницу" class="add-anchor btn">
                        <i class="fa fa-plus-circle"></i>
                        Добавить пункт меню
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-hover ">
            <thead>
            <tr>
                <th class="col-lg-1">ID</th>
                <th>Название</th>
                <th>URL</th>
                <th class="col-lg-2 text-right">Действия</th>
            </tr>
            </thead>
            <tbody>
            {menus}
                <tr>
                    <td class="col-lg-1">{id}</td>
                    <td>{name}</td>
                    <td>{url}</td>
                    <td class="col-lg-2 text-right">
                        <div class="btn-group">
                            <button class="btn btn-sm btn-primary">Действия</button>
                            <button class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="/admin/edit/{id}" title="Редактировать">
                                        <i class="fa fa-pencil"></i> Редактировать</a>
                                </li>
                                <li>
                                    <a href="/admin/delete/{id}" title="Удалить" class="delete-row">
                                        <i class="fa fa-trash"></i> Удалить</a>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            {/menus}
            </tbody>
        </table>
    </div>
</div>