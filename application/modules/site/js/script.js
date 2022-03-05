/**
 * Created by Zhenya on 16.11.2015.
 */
// ========================================================================= menu active
$(document).ready(function() {
    $('nav.blog-nav a').each(function () {
        var location = window.location.href;
        var link = this.href;
        if(location == link) {
            $(this).addClass('active');
        }
    });
    $('#right_menu a').each(function () {
        var location = window.location.href;
        var link = this.href;
        if(location == link) {
            $(this).parent('li').addClass('active');
        }
    });
});

// ========================================================================= popup
function show_popup(url) {
    vars = '';
    $.ajax({
        url: url,
        type: "post",
        cache: false,
        dataType: "html",
        success: function(html){
            $('body').append(html);
            $('#popup').fadeIn();
            $('#popup').append('<a id="popup_close"></a>');
            q_width = $('#popup').outerWidth()/-2;
            q_height = $('#popup').outerHeight()/-2;
            $('#popup').css({
                'margin-left': q_width,
                'margin-top': q_height
            });
            $('body').append('<div id="fade"></div>');
            $('#fade').css({'filter' : 'alpha(opacity=40)'}).fadeIn();
        }
    });
}

$(function() {
    $('body').on('click', '#fade, #popup #popup_close', function() {
        $('#fade , #popup').fadeOut(function() {
            $('#popup').remove();
            $('#fade').remove();
        });
    });

    $('.open_popup').on('click', function() {
        bt_open_popup_url = $(this).attr('href')
        show_popup(bt_open_popup_url);
        return false;
    });
});

// ========================================================================= bootstrap validator
$(document).on('click', '.form_submit', function () {
    $('#popup .form-callback').bootstrapValidator({
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
                        min: 3,
                        max: 40
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                    },
                    emailAddress: {
                    }
                }
            }
        }
    }).on('success.form.bv', function(e) {
        // Prevent form submission
        e.preventDefault();
        // Get the form instance
        var $form = $(e.target);
        // Get the FormValidation instance
        var bv = $form.data('formValidation');

        // Use Ajax to submit form data
        $.post(
            $form.attr('action'),
            $form.serialize(),
            function(html){
                $("#popup .form-callback").hide();
                $("#popup").html(html);
                $('#popup').append('<a id="popup_close"></a>');
            },
            'html');
    });

});

// ========================================================================= comment reply form load
$(".btn_reply_comment").on("click", function() {
    if($(this).hasClass('opened')){
        $('.reply_form').fadeOut(2000).remove();
        $(this).removeClass('opened');
    }
    else {
        $(this).addClass('opened');
        var article_id = $(this).data('article-id'),
            comment_id = $(this).data('comment-id'),
            comment_type = $(this).data('comment-type'),
            comment_block_id = $('#post_comment_' + comment_id);

        var formData = {
            article_id: article_id,
            comment_id: comment_id,
            comment_type: comment_type
        };

        $.ajax({
            type: "POST",
            url: "/comments/comments/get_reply_comment_form",
            data: formData,
            cache: false,
            success: function (html) {
                $('.reply_form').fadeOut(2000).remove();
                $(comment_block_id).append(html);
            }
        });
        return false;
    }
});

// ========================================================================= comment send validator
$(document).on('click', '.comment-submit', function () {
    $('.comment-form').bootstrapValidator({
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
                        min: 3,
                        max: 60
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                    },
                    emailAddress: {
                    }
                }
            },
            message: {
                validators: {
                    notEmpty: {
                    },
                    stringLength: {
                        min: 3,
                        max: 500
                    }
                }
            }
        }
    }).on('success.form.bv', function(e) {
        // Prevent form submission
        e.preventDefault();
        // Get the form instance
        var $form = $(e.target);
        // Get the FormValidation instance
        var bv = $form.data('formValidation');

        // Use Ajax to submit form data
        $.post(
            $form.attr('action'),
            $form.serialize(),
            function(html){
                //$("#site-order").hide();
                $(".leave-comments").html(html);
            },
            'html');
    });

});

//======================================== reply_comment form
$(document).on('click', '.reply-comment-submit', function () {
    $('.reply-comment-form').bootstrapValidator({
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
                        min: 3,
                        max: 60
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                    },
                    emailAddress: {
                    }
                }
            },
            message: {
                validators: {
                    notEmpty: {
                    },
                    stringLength: {
                        min: 3,
                        max: 1500
                    }
                }
            }
        }
    }).on('success.form.bv', function(e) {
        // Prevent form submission
        e.preventDefault();
        // Get the form instance
        var $form = $(e.target);
        // Get the FormValidation instance
        var bv = $form.data('formValidation');

        // Use Ajax to submit form data
        $.post(
            $form.attr('action'),
            $form.serialize(),
            function(html){
                $(".reply-comment-form").hide();
                $(".reply_form").html(html);
            },
            'html');
    });

});
