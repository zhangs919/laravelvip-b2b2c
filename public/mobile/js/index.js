$(function() {
	/* 点击关闭顶部层 */
	$(".colse-download-tip").click(function() {
		$('.app-download').find('.app-download-tip-box').addClass('current');
		$('.app-download').remove();
		sessionStorage.colse_app_download = '1';
	});
	// 首页banner
	var swiper_banner = new Swiper('.swiper-banner', {
		pagination: '.swiper-pagination',
		paginationClickable: true,
		autoplay: 3000,
		autoplayDisableOnInteraction: false,
		onSlideChangeEnd: function(swiper) {
			$.imgloading.loading();
		}
	});
	//菜单轮播
	var swiper = new Swiper('.nav-list-container', {
		pagination: '.swiper-pagination',
		paginationClickable: true,
		autoplay:false,
		autoplayDisableOnInteraction:false
	});
	// $('.swiper-banner').find(' .swiper-wrapper .swiper-slide a
	// img').width($(window).width());

	// 一行广告
	var swiper_ad = new Swiper('.one-ad-container', {
		pagination: '.one-ad-pagination',
		paginationClickable: true,
		autoplay: 5000,
		autoplayDisableOnInteraction: false,
		onSlideChangeEnd: function(swiper) {
			$.imgloading.loading();
		}
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
	// 自定义公告
	function notice_scroll() {
		var totalHeight = $('.shop-notice-info').height();
		var top = 0;
		var lineHeight = 30;
		var mytime;
		$('.shop-notice-info p').eq(0).clone().appendTo('.shop-notice-info');
		function marquee() {
			if (top >= totalHeight + lineHeight) {
				top = 0;
				$('.shop-notice-info').css('top', 0);
			}
			$('.shop-notice-info').stop().animate({
				'top': -top
			}, 600);
			top = top + lineHeight;
		}
		mytime = setInterval(marquee, 3000)
	}
	var noticeHeight = $('.shop-notice-info p').height();
	if (noticeHeight > 30) {
		notice_scroll();
	}
	// 推荐店铺
	var mySwiper = new Swiper('.shop-container', {
		// loop : true,
		slidesPerView: 'auto',
		loopedSlides: 8,
		touchRatio: 1,
	})
	//滚动菜单
	var mySwiper = new Swiper('.scroll-y-menu', {
		// loop : true,
		slidesPerView: 'auto',
		loopedSlides: 8,
		touchRatio: 1,
	})
	$('.scroll-y-menu li').click(function() {
		$(this).addClass('active').siblings().removeClass('active');
		$('.tab-con').eq($(this).index()).show().siblings('.tab-con').hide();
	});
	// 推荐商品
	$(".goods-promotion").each(function(){
		$(this).swiper({
			pagination:$('.pagination',this),
			paginationClickable: true,
			preloadImages: true,
			lazyLoading: true,
			updateOnImagesReady: true,
			observer:true,//修改swiper自己或子元素时，自动初始化swiper  
			observeParents:true,//修改swiper的父元素时，自动初始化swiper  
			onSlideChangeEnd: function(swiper) {
				$.imgloading.loading();
			}
		});
	});
	//无缝滚动
	$('.seamless-rolling').each(function() {
		$(this).swiper({
			slidesPerView: 3.5,
			freeMode: true,
			preloadImages: true,
			lazyLoading: true,
			updateOnImagesReady: true,
			observer:true,//修改swiper自己或子元素时，自动初始化swiper  
			observeParents:true,//修改swiper的父元素时，自动初始化swiper  
			onSlideChangeEnd: function(swiper) {
				$.imgloading.loading();
			}
		});
    });
});
