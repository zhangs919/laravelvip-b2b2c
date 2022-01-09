//商品详情右侧商品信息等定位切换效果
var navH = $("#main-nav-holder").offset().top;
$(window).scroll(function() {
	var scroH = $(this).scrollTop(); // 获取滚动条的滑动距离
	if (scroH >= navH) {
		$("#main-nav-holder").addClass('fixed');// 滚动条的滑动距离大于等于定位元素距离浏览器顶部的距离，就固定，反之就不固定
	} else if (scroH < navH) {
		$("#main-nav-holder").removeClass('fixed');
	}
})
$('.goods-detail .title-list').click(function() {
	$(this).addClass('current').siblings('.title-list').removeClass('current');
	$("html,body").scrollTop($('.goods-detail-tabs').eq($(this).index()).offset().top - 30);
})
$(document).ready(function() {
	var scroll_h = 0;
	window.onscroll = function() {
		scroll_h = $(this).scrollTop();
		for (var i = 0; i < 5; i++) {
			if ($('.goods-detail-con').eq(i).offset()) {
				if (scroll_h > $('.goods-detail-con').eq(i).offset().top - 150) {
					$('.right-side-ul li').eq(i).addClass('abs-active').siblings().removeClass('abs-active');
				}
			}
		}
	}
	$(".right-side-ul li").hover(function() {
		$(this).addClass("abs-hot").siblings().removeClass("abs-hot");
	}, function() {
		$(".right-side-ul li").removeClass("abs-hot");
	});
	$(".right-side-ul li").click(function() {
		$(this).addClass("abs-active").siblings().removeClass("abs-active");
		$('html,body').animate({
			scrollTop: $('.goods-detail-con').eq($(this).index()).offset().top - 30
		}, 300);
	});
});