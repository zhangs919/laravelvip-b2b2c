$(function() {
	// 滚动条

	// 图片延迟加载
	// $(".lazyload").scrollLoading({ container: $(".category-right") });
	// 点击切换2 3级分类
	$(".category-left").niceScroll({
		cursorwidth: 0,
		cursorborder: 0
	});

	$('.category-box').height($(window).height() - 99);

	// 点击切换2 3级分类
	var array = new Array();
	// 不加载隐藏区域
	$.imgloading.settings.skip_invisible = true;
	
	$('.category-left li').click(function() {
		var index = $(this).index();
		var next = parseInt(index - 3) <= 0 ? 0 : array[parseInt(index - 3)];
		$('.category-left').scrollTop(next);
		$(this).addClass('cur').siblings().removeClass('cur');
		$("#cat_chr_" + $(this).data("cat_id")).show().siblings().hide();
		$("#cat_chr_" + $(this).data("cat_id")).parent('.category-right').scrollTop(0);
		var page_url = location.href;
		page_url = page_url.split('?')[0];
		page_url = page_url + '?cat_id=' + $(this).data("cat_id");
		history.pushState({}, '', page_url);
		setTimeout(function(){
			$.imgloading.loading();
		},100);
	});

	$('.category-left li').each(function() {
		array.push($(this).position().top);
		if ($(this).hasClass('cur')) {
			var index = $(this).index();
			var next = parseInt(index - 3) <= 0 ? 0 : array[parseInt(index - 3)];
			$('.category-left').scrollTop(next);
			$("#cat_chr_" + $(this).data("cat_id")).show().siblings().hide();
			$("#cat_chr_" + $(this).data("cat_id")).parent('.category-right').scrollTop(0);
			setTimeout(function(){
				$.imgloading.loading();
			},100);
		}
	});
	// 滚动加载图片
	$('.category-right').scroll(function() {
		$.imgloading.loading();
	});
})
