/**
 * @copyright 2015 MSCMS
 * @author http://polyakov.co.ua <zhenya_polyakov@mail.ru>
 * @cms http://mscms.com.ua <dev@mscms.com.ua>
 */
//======================================== подсказки
$(document).ready(function() {
    $('[data-rel="tooltip"]').tooltip({
        delay: {show: 600, hide: 100}
    });
});
//======================================== Валидация полей при редактировании и создании списка меню
$(document).ready(function() {
    $('.form-menus').bootstrapValidator({
        framework: 'bootstrap',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            name: {
                validators: {
                    notEmpty: {
                    },
                    stringLength: {
                        min: 2,
                        max: 255
                    }
                }
            },
            menu_name: {
                validators: {
                    notEmpty: {
                    },
                    regexp: {
                        regexp: /^[a-z0-9_-]{3,130}$/
                    },
                    remote: {
                        message: 'Системное имя уже используется на сайте!',
                        url: '/admin/check_menu_name',
                        data: {
                            type: 'menu_name',
                            id: $("#inputID").val()
                        },
                        type: 'POST'
                    },
                    stringLength: {
                        min: 2,
                        max: 50
                    }
                }
            }
        }
    });
    $('.form-menu').bootstrapValidator({
        framework: 'bootstrap',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            name: {
                validators: {
                    notEmpty: {
                    },
                    stringLength: {
                        min: 2,
                        max: 255
                    }
                }
            },
            url: {
                validators: {
                    notEmpty: {
                    }
                }
            }
        }
    });
});

//======================================== добавляем атрибут disabled для повторяющих не активных полей
$(document).ready(function() {
    var menu_type = $('.nav-tabs > li.active > a').data('url');
    $('.tab-pane input, .tab-pane select').attr('disabled', true);
    $('#'+menu_type+' input').attr('disabled', false);
    $('#'+menu_type+' select').attr('disabled', false);
});

$(function(){
    $('.nav-tabs > li > a').on('click', function(){
        $('.form-menu').bootstrapValidator('resetForm');
        var menu_type = $(this).data('url');
        $('#menu_type').val(menu_type);
        $('.tab-pane input, .tab-pane select').attr('disabled', true);
        $('#'+menu_type+' input').attr('disabled', false);
        $('#'+menu_type+' select').attr('disabled', false);
        $('.form-menu input[name="url"], .form-menu select[name="url"]').val('');
    })
});

//========================================== Изменения статуса видимости меню
$(function(){
    $(".onchange :checkbox").change(function(){
        var page_id = $(this).val();
        $.post('/admin/change_status/' + page_id, {}, function(data) {
            //alert('/admin/page/change_status/' + page_id);
        }).fail(function() {
            CMSApi.showMessage('danger', 'Возникли ошибки на сервере');
        });
    });
});

//========================================== nestable script
function lagXHRobjekt() {
    var XHRobjekt = null;
    try {
        ajaxRequest = new XMLHttpRequest(); // Firefox, Opera, ...
    } catch(err1) {
        try {
            ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP"); // Noen IE v.
        } catch(err2) {
            try {
                ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP"); // Noen IE v.
            } catch(err3) {
                ajaxRequest = false;
            }
        }
    }
    return ajaxRequest;
}

//функция отправки методом post массива с порядком в формате json
function menu_updatesort(jsonstring) {
    mittXHRobjekt = lagXHRobjekt();
    if (mittXHRobjekt) {
        mittXHRobjekt.onreadystatechange = function() {
            if(ajaxRequest.readyState == 4){
                var ajaxDisplay = document.getElementById('sortDBfeedback');
                ajaxDisplay.innerHTML = ajaxRequest.responseText;
            } else {
                // закомментируйте эту строку если не хотите выводить спинер загрузки
                document.getElementById('sortDBfeedback').innerHTML = "<img style='height:11px;' src='/themes/images/loading.gif' alt='ajax-loader' />";
            }
        }
        var tosend = "jsonstring="+jsonstring;
        var menu_id = $('#menu_id').val();
        ajaxRequest.open("POST","/admin/menu_sortable_save/",true);
        ajaxRequest.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        ajaxRequest.send(tosend);
    }
}

$(document).ready(function()
{
    //функция обновления позиций меню
    var updateOutput = function(e)
    {
        var list   = e.length ? e : $(e.target),
            output = list.data('output');
        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
            menu_updatesort(window.JSON.stringify(list.nestable('serialize')));
        } else {
            output.val('JSON browser support required for this demo.');
        }
    };

    // вызываем функцию для записи изменения порядка меню в бд.
    $('#nestableMenu').nestable({group: 1}).on('change', updateOutput);

    // вывод начальной последовательности если элемент существует на странице
    var variable = $('#nestableMenu').data();
    if ( typeof variable !== "undefined" && variable) {
        updateOutput($('#nestableMenu').data('output', $('#nestableMenu-output')));
    }

    //кнопки развернуть светнуть меню
    $('#nestable-menu').on('click', function(e)
    {
        var target = $(e.target),
            action = target.data('action');
        if (action === 'expand-all') {
            $('.dd').nestable('expandAll');
        }
        if (action === 'collapse-all') {
            $('.dd').nestable('collapseAll');
        }
    });

    //fix позволяющий кликать на ссылки в nestable
    $(".dd a").on("mousedown", function(event) { // mousedown prevent nestable click
        event.preventDefault();
        return false;
    });
    $(".dd a").on("click", function(event) { // click event
        event.preventDefault();
        window.location = $(this).attr("href");
        return false;
    });

});