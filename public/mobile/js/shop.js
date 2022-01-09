$(function() {
	// 首页banner
	var swiper_banner = new Swiper('.swiper-banner', {
		pagination: '.swiper-pagination',
		paginationClickable: true,
		autoplay: 3000,
		autoplayDisableOnInteraction: false,
		lazyLoading: true,
		lazyLoadingInPrevNext: true,
	});
	// $('.swiper-banner').find(' .swiper-wrapper .swiper-slide a
	// img').width($(window).width());
	
   var swiper_bonus = new Swiper('.coupon-template');
	//菜单轮播
	var swiper = new Swiper('.nav-list-container', {
		pagination: '.swiper-pagination',
		paginationClickable: true,
		autoplay:false,
		autoplayDisableOnInteraction:false,
		lazyLoading: true,
		lazyLoadingInPrevNext: true,
	});
	var bannerSwiper=new Swiper(".swiper-banner-3d",{
		slidesPerView: "auto",
		centeredSlides: !0,
		autoplay: 3000,
		lazyLoading: true,
		lazyLoadingInPrevNext: true,
		watchSlidesProgress: !0,
		onProgress: function(a) {
			var b, c, d;
			for (b = 0; b < a.slides.length; b++) 
				c = a.slides[b],
				d = c.progress,
				scale = 1 - Math.min(Math.abs(.2 * d), 1),
				es = c.style,
				es.opacity = 1 - Math.min(Math.abs(d / 2), 1),
				es.webkitTransform = es.MsTransform = es.msTransform = es.MozTransform = es.OTransform = es.transform = "translate3d(0px,0," + -Math.abs(150 * d) + "px)"
		},
		onSetTransition:function(a,b){
			for(var c=0;c<a.slides.length;c++)
				es=a.slides[c].style,
				es.webkitTransitionDuration=es.MsTransitionDuration=es.msTransitionDuration=es.MozTransitionDuration=es.OTransitionDuration=es.transitionDuration=b+"ms"
			}
		});
	// 一行广告
	var swiper_ad = new Swiper('.one-ad-container', {
		pagination: '.one-ad-pagination',
		paginationClickable: true,
		lazyLoading: true,
		lazyLoadingInPrevNext: true,
		autoplay: 5000,
		autoplayDisableOnInteraction: false,
	});
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
	var goodsPromotion = new Swiper('.goods-promotion', {
		pagination: '.pagination',
		paginationClickable: true,
		preloadImages: true,
		lazyLoading : true,
		updateOnImagesReady:true,
	// autoplay : 5000,//可选选项，自动滑动
	// loop : true,//可选选项，开启循
	});
	//滚动菜单
	var scrollMenu = new Swiper('.scroll-y-menu', {
		//loop: true,
		//slidesPerView: 'auto',
		//loopedSlides: 10,
		slidesPerView :4,
	});
	$('.scroll-y-menu').each(function() {
        $(this).find('li').click(function() {
			$(this).addClass('active').siblings().removeClass('active');
			$(this).parents('.tab-container').find('.tab-con').eq($(this).index()).show().siblings('.tab-con').hide();
			//$(this).parents('.tab-container').find('.tab-con').eq($(this).index()).siblings('.tab-con').hide();
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
		});
    });
	// 处理红包模板
	var bonus_ids = [];
	$.each($('.coupon-list'),function(){
		var bonus_id = $(this).data('bonus_id');
		if($.inArray(bonus_id,bonus_ids) == -1){
			bonus_ids.push(bonus_id);
		}
	});
	if(bonus_ids.length > 0){
		
		$.get('/shop/bonus/bonus-info',{
			ids : bonus_ids
		},function(result){
			
		});	
	}
});
