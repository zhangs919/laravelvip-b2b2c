/* 滚动加载js */
$(function() {
	var cur_page = 2;

	var is_loading = false;

	$.pagemore = function(settings) {
		
		if(typeof(tablelist) == 'undefined'){
			return;
		}
		var defaults = {
			// 提交的数据
			data: {},
			// 返回的数据
			callback: null
		};

		settings = $.extend(true, defaults, settings);

		if (settings.cur_page != null) {
			cur_page = settings.cur_page;
		} else {
			cur_page = tablelist.page.cur_page + 1;
		}

		if (settings.page_count != null) {
			tablelist.page.page_count = settings.page_count;
		}

		if (settings.page_size != null) {
			tablelist.page.page_size = settings.page_size;
		}

		if (parseInt(cur_page) > parseInt(tablelist.page.page_count)) {
			if (parseInt(tablelist.page.page_count) > 0) {
				$(".more-loader-spinner").html('<div class="is-loaded"><div class="loaded-bg">我是有底线的</div></div>');
			}
			return;
		}
		if (is_loading == true) {
			return;
		}
		is_loading = true;

		$(".more-loader-spinner").html('<div class="is-loading"><div class="loader-img"><div></div></div><a class="get-more" onclick="more()">数据加载中...</a></div>');
		tablelist.append({
			page: {
				cur_page: cur_page,
			},
			go: cur_page
		}, function(result) {
			this.page.cur_page = cur_page;
			// 加载完成
			is_loading = false;

			if (cur_page >= tablelist.page.page_count) {

				$(".more-loader-spinner").html('<div class="is-loaded"><div class="loaded-bg"></div></div>');
			}

			if ($.isFunction(settings.callback)) {
				settings.callback.call(settings, this.page);
			}

		}, ".tablelist-append");

	}

});