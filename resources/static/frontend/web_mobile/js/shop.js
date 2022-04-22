$(function() {
	// 首页banner
	var swiper_banner = new Swiper('.swiper-banner', {
		pagination: '.swiper-pagination',
		paginationClickable: true,
		autoplay: 3000,
		autoplayDisableOnInteraction: false,
		lazyLoadingInPrevNext: true,
		lazyLoading: true
	});
	// 菜单轮播
	var swiper = new Swiper('.nav-list-container', {
		pagination: '.swiper-pagination',
		paginationClickable: true,
		autoplay: false,
		autoplayDisableOnInteraction: false,
		lazyLoadingInPrevNext: true,
		lazyLoading: true,
	});
	var bannerSwiper = new Swiper(".swiper-banner-3d", {
		slidesPerView: "auto",
		lazyLoading: true,
		centeredSlides: !0,
		autoplay: 3000,
		watchSlidesProgress: !0,
		onProgress: function(a) {
			var b, c, d;
			for (b = 0; b < a.slides.length; b++)
				c = a.slides[b], d = c.progress, scale = 1 - Math.min(Math.abs(.2 * d), 1), es = c.style, es.opacity = 1 - Math.min(Math.abs(d / 2), 1), es.webkitTransform = es.MsTransform = es.msTransform = es.MozTransform = es.OTransform = es.transform = "translate3d(0px,0," + -Math.abs(150 * d) + "px)"
		},
		onSetTransition: function(a, b) {
			for (var c = 0; c < a.slides.length; c++)
				es = a.slides[c].style, es.webkitTransitionDuration = es.MsTransitionDuration = es.msTransitionDuration = es.MozTransitionDuration = es.OTransitionDuration = es.transitionDuration = b + "ms"
		}
	});

	// 一行广告
	var swiper_ad = new Swiper('.one-ad-container', {
		pagination: '.one-ad-pagination',
		paginationClickable: true,
		autoplay: 5000,
		autoplayDisableOnInteraction: false,
		lazyLoading: true,
		lazyLoadingInPrevNext: true,
	})
	// 商城热点
	function comments_scroll() {
		var liLen = $('.hot ul li').length;
		var num3 = 0;
		$('.hot ul').append($('.hot ul').html());

		function autoplay() {
			if (num3 > liLen) {
				num3 = 1;
				$('.hot ul').css('top', 0);
			}
			$('.hot ul').stop().animate({
				'top': -60 * num3
			}, 500);
			num3++;
		}
		var mytime = setInterval(autoplay, 5000)
	}
	comments_scroll();
	// 推荐商品
	$(".goods-promotion").each(function() {
		$(this).swiper({
			pagination: '.pagination',
			paginationClickable: true,
			lazyLoading: true,
		});
	});
	// 滚动菜单
	var mySwiper = new Swiper('.scroll-y-menu', {
		// loop : true,
		slidesPerView: 4,
		freeMode: true,
	});
	//无缝滚动
	$('.seamless-rolling').each(function() {
		$(this).swiper({
			slidesPerView: 3.5,
			freeMode: true,
			lazyLoading: true,
		});
	});
	// 处理红包模板
	var bonus_ids = [];
	$.each($('.coupon-list'), function() {
		var bonus_id = $(this).data('bonus_id');
		if ($.inArray(bonus_id, bonus_ids) == -1) {
			bonus_ids.push(bonus_id);
		}
	});
	if (bonus_ids.length > 0) {

		$.get('/shop/bonus/bonus-info', {
			ids: bonus_ids
		}, function(result) {

		});
	}
});