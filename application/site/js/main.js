var md = new MobileDetect(window.navigator.userAgent);

(function getPerspective(){
	var element = document.createElement('p'),
		html = document.getElementsByTagName('html')[0],
		body = document.getElementsByTagName('body')[0],
		propertys = {
			'webkitTransformStyle':'-webkit-transform-style',
			'MozTransformStyle':'-moz-transform-style',
			'msTransformStyle':'-ms-transform-style',
			'transformStyle':'transform-style'
		};

	body.insertBefore(element, null);

	for (var i in propertys) {
		if (element.style[i] !== undefined) {
			element.style[i] = "preserve-3d";
		}
	}

	var st = window.getComputedStyle(element, null),
		transform = st.getPropertyValue("-webkit-transform-style") ||
			st.getPropertyValue("-moz-transform-style") ||
			st.getPropertyValue("-ms-transform-style") ||
			st.getPropertyValue("transform-style");

	if(transform!=='preserve-3d'){
		html.className += ' no-preserve-3d';
	} else {
		html.className += ' preserve-3d';
	}
	document.body.removeChild(element);

})();

/*
* Функция scrollTo(to, [container], [speed])
* @param {number|string\object} to - Позиция или объект к которым нужно скролить
* @param {string\object} container - Контейнер который нужно скролить
* @param {number} speed - Скорость анимации
* */

function scrollTo(to) {
	var $obj = jQuery('html, body');
	var top = 0;
	var speed = 500;
	var offsetX = 50;

	if (typeof to == 'object') {
		top = to.offset().top;
	} else if (typeof to == 'string') {
		top = jQuery(to).offset().top;
	} else if (typeof to == 'number') {
		top = to;
	}

	if (arguments.length > 1) {
		if (typeof arguments[0] == 'number' && typeof arguments[1] == 'number') {
			speed = arguments[1];
		} else if (typeof arguments[1] == 'string' || typeof arguments[1] == 'object') {
			if (typeof arguments[1] == 'object') {
				$obj = arguments[1];
			} else if (typeof arguments[1] == 'string') {
				$obj = jQuery(arguments[1]);
			}
		}
		if (typeof arguments[2] == 'number') {
			speed = arguments[2];
		}
	}

	if (jQuery(window).width() < 1000) {
		offsetX = 130;
	}

	if (speed == 0) {
		speed = 1;
	}

	$obj.animate(
		{
			scrollTop: top - offsetX
		},
		speed
	);
}

!function ($) {

	var $win = $(window);
	var $doc = $(document);

	$(function () {

		var $html = $('html');
		var $body = $('body');
		var $pageWrap = $body.children('div.page-wrap');
		var $header = $('div.header');
		var $menu = $('.header-menu');
		var $info = $body.find('div.info');
		var screenWidth = $win.width();
		var player;
		if (md.mobile()) {
			$html.addClass('mobile');
			if (md.is('iPhone')) {
				$html.addClass('iPhone');
			}
			if (md.is('iPad')) {
				$html.addClass('iPad');
			}
			$html.addClass(md.os());
		} else {
			$html.addClass('desktop');
		}



		function openMobileMenu() {
			var $scrollObj = $menu.children('.main-menu');
			var $menuCover = $menu.children('div.header-menu__cover');
			var scrollY = $body.scrollTop();
			var topInfoHeight = (($info.length && $info.is(':visible'))) ? $info.outerHeight() : 0;
			$body.data('top', scrollY);
			$html.addClass('no-scroll');

			$menuCover.fadeIn(500);
			var offset = $win.width() - 60;
			$pageWrap
				.css({
					top: -scrollY
				})
				.animate({
					left: offset
				});
			scrollTo(0, $scrollObj, 0);
			$menu
				.css({
					display: 'block',
					width: $win.width(),
					height: $win.height() - topInfoHeight
				})
				.addClass('js-opened');
			$header
				.animate({
					left: offset
				});
		}

		function closeMobileMenu() {
			var $menuCover = $menu.children('div.header-menu__cover');
			var $smOpened = $menu.find('ul.sub-menu:visible');
			var $smContainer = $smOpened.closest('li');
			$menu
				.removeClass('js-opened');
			$smContainer.removeClass('m-active');
			$header
				.animate({
					left: 0
				}, 300, function () {
					$menu.removeAttr('style');
					//$header.removeAttr('style');
				});
			$pageWrap
				.animate({
					left: 0
				}, 300, function () {
					$html.removeClass('no-scroll');
					$pageWrap.removeAttr('style');
					$body.scrollTop($body.data('top'));
					$smOpened.removeAttr('style');
				});
			$menuCover.fadeOut(500);
		}

		$win.on('resize', function () {
			if ($menu.hasClass('js-opened')) {
				if (screenWidth != $win.width()) {
					screenWidth = $win.width();
					closeMobileMenu();
				} else {
					$menu
						.css({
							height: $win.height()
						});
				}
			}

			if (!$html.hasClass('iOS')) {
				if ($win.width() >= 1000) {
					var infoHeight = ($info.length > 0 && $info.is(':visible')) ? $info.height() : 0;
					var margins = infoHeight + 60;

					$header.css({
						height: $win.height() - margins
					});
				} else {
					$header.removeAttr('style');
				}
			}

		}).trigger('resize');

		$('a.menu-switcher').on('click', function () {
			var $el = $(this);

			if ($el.hasClass('js-close-menu')) {
				closeMobileMenu();
			} else {
				openMobileMenu();
			}
			return false;
		});

		$('a.close-mobile-menu').on({
			click: function () {
				closeMobileMenu();
			}
		});

		$('.main-menu').each(function () {
			var $menu = $(this);
			var $linkSM = $menu.find('a.show-sm');

			$linkSM.on({
				click: function () {
					var $el = $(this);
					var $parent = $el.closest('li');
					var $menu = $parent.closest('ul.main-menu__menu');
					var $mItems = $menu.children('li');
					var $active = $mItems.filter('.active');
					var $popup = $($el.data('popup'));

					var $list = $popup.find('ul.s-menu');
					var $items = $list.children('li');
					var iNum = $items.length;
					var time = 150;
					var i = 0;

					function drawList() {
						var iTime = 0;
						if (i != 0) {
							iTime = time;
						}
						setTimeout(function () {
							$items.eq(i).addClass('done');
							$items.eq(i+1).addClass('done');
							i += 2;
							if (i < iNum) {            //  if the counter < 10, call the loop function
								drawList();             //  ..  again which will trigger another
							}
						}, iTime);
					}

					if ($win.width() >= 1000) {
						if ($popup.length) {
							$mItems.removeClass('m-active');

							if ($active.length) {
								$menu.data('activeItem', $mItems.index($active));
							}
							$active.removeClass('active');
							$parent.addClass('m-active');
							openPopupSM($popup, drawList);
							return false;
						}
					} else {
						var $subMenu = $parent.children('ul.sub-menu');
						$mItems.removeClass('m-active');
						if ($subMenu.is(':visible')) {
							$subMenu.animate({
								height: 'hide',
								opacity: 'hide'
							},300);
							$parent.removeClass('m-active');
						} else {
							$subMenu.animate({
								height: 'show',
								opacity: 'show'
							}, 300);
							$parent.addClass('m-active');
						}
						return false;
					}

				}
			});

		});

		function openPopupSM($obj) {
			var $popup = null;
			if (typeof $obj == 'object') {
				$popup = $obj;
			} else if (typeof $obj == 'string') {
				$popup = $($obj);
			}

			if (arguments.length > 1) {
				var funcCallback = (typeof arguments[1] == 'function') ? arguments[1] : null;
			}

			var $sMenu = $popup.find('ul.s-menu');
			var $smItems = $sMenu.children('li');
			if ($sMenu.length) {
				$smItems.removeClass('done');
			}
			var $openedPopup = $pageWrap.children('.popup-sm:visible');

			$html.addClass('sm-visible no-scroll');
			if ($openedPopup.attr('id') != $popup.attr('id')) {
				$openedPopup.fadeOut(300);
			}
			$popup.fadeIn(300, funcCallback);
		}

		function closePopup($obj) {
			var $popup = null;
			if (typeof $obj == 'object') {
				$popup = $obj;
			} else if (typeof $obj == 'string') {
				$popup = $($obj);
			}

			$popup.fadeOut(300);
			$html.removeClass('sm-visible no-scroll');
		}

		$('a.show-popup').on({
			click: function (event) {
				var $el = $(this);
				var $popup = $($el.data('popup'));
				openPopupSM($popup);
				return false;
			}
		});

		$('a.js-close-sm').on({
			click: function () {
				var $el = $(this);
				var $popup = $el.closest('.popup-sm');

				var $menu = $('nav.header-menu').find('ul.main-menu__menu');
				var $mItems = $menu.children('li');
				var $menuItemLinks = $menu.children('li').children('a');
				if ($menu.data('activeItem') != undefined) {
					$mItems.eq($menu.data('activeItem')).addClass('active');
				}
				$mItems.removeClass('m-active');
				closePopup($popup);
				return false;
			}
		});


	});

}(jQuery);

