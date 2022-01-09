$(function() {

	// 商家入驻首页面 banner 轮播js
	$(".banner-slider").slide({
		titCell: ".slider-nav",
		mainCell: ".slider-pannel",
		effect: "fold",
		autoPlay: true,
		delayTime: 700,
		autoPage: true
	});

	// 商家入驻首页 "查询招商标准" 等点击定位效果
	// $(".info-box .btn-primary").click(function() {
	// $("html, body").animate({
	// scrollTop: 900
	// }, 600);
	// return false;
	// });

	// 商家入驻首页面鼠标滑过切换tab
	function mouseover_tabs(a, b, c) {
		$(a).mouseover(function() {
			$(this).addClass(c).siblings().removeClass(c);
			$(b).eq($(this).index()).show().siblings().hide();
		})
	}
	mouseover_tabs(".tabs-nav li", ".tabs-body .tabs-panel", 'selected');

});