// JavaScript Document

$(function() {

	// 店铺展开的详细信息
	$("body").on('click', ".shop_item_blank", function() {

		$('.more-shop-info').toggle();
		if ($("li[class='list-row-item more-shop-info']").css("display") == "none") {
			$("li[class='list-row-item shop_item_blank']").html("展开详情信息");

		} else {
			$("li[class='list-row-item shop_item_blank']").html("收起详情信息");
		}
	});

	// 商品相册图片切换

	$('.list-item-slide').each(function() {
		$(this).rTabs({
			bind: 'hover',
			animation: 'up'
		});
	});

	// 滚动事件，显示商品信息
	$(window).bind("scroll", function() {
		var sTop = $(window).scrollTop();
		var sTop = parseInt(sTop);
		if (sTop >= 480) {
			if (!$(".fixed-nav").is(":visible")) {
				try {
					$(".fixed-nav").slideDown();
				} catch (e) {
					$(".fixed-nav").show();
				}
			}
		} else {
			if ($(".fixed-nav").is(":visible")) {
				try {
					$(".fixed-nav").slideUp();
				} catch (e) {
					$(".fixed-nav").hide();
				}
			}
		}
	});
});
