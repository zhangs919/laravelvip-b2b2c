$(function () {
	var scrollheight = 0;
	// 头部切换
	$(".filtrate-term  ul").find("li").click(function () {
		if ($(this).index() != 0) {
			$(".filtrate-more").addClass("hide");
			$('.mask-div').hide();
		}
		// 综合排序
		if ($(this).index() == 0) {
			if ($(".filtrate-more").hasClass("hide")) {
				$(".filtrate-more").removeClass("hide");
				$('.mask-div').show();
			} else {
				$(".filtrate-more").addClass("hide");
				$('.mask-div').hide();
			}
			if ($(this).hasClass('active')) {
				console.log('打开了');
			} else {
				var name = $(this).find('span').text();
				var sort = $(this).data('sort');
				$('.filtrate-more a[data-sort="' + sort + '"]').addClass('current');
				$("#searchForm").find("input[name='sort']").val(sort);
				$("#searchForm").find("input[name='order']").val('DESC');
				$(window).scrollTop("0");
				scroll = 2;
				var params = $("#searchForm").serializeJson();

				params.page = {
					cur_page: 1
				};
				params.go = 1;
				// $('html,body').scrollTop(101);
				tablelist.load(params, $.imgloading.loading);
			}

		}
		if ($(this).index() == 1) {
			$.loading.start();
			$("#searchForm").find("input[name='sort']").val($(this).data('sort'));
			$("#searchForm").find("input[name='order']").val('DESC');
			// var order = $("#searchForm").find("input[name='order']").val();
			// if (order == 'DESC') {
			//     $("#searchForm").find("input[name='order']").val('ASC');
			// } else {
			//     $("#searchForm").find("input[name='order']").val('DESC');
			// }
			$('.filtrate-more').find('a').find('b').remove();
			$('.filtrate-more').find('a').removeClass('current');
			$('.filtrate-sort').find('em').html('排序');
			$(window).scrollTop("0");
			scroll = 2;
			var params = $("#searchForm").serializeJson();

			params.page = {
				cur_page: 1
			};
			params.go = 1;
			// $('html,body').scrollTop(101);
			tablelist.load(params, $.imgloading.loading);
		}

		if ($(this).index() == 2) {
			$.loading.start();

			$("#searchForm").find("input[name='sort']").val($(this).data('sort'));
			if ($(this).hasClass('active')) {
				if ($("#searchForm").find("input[name='order']").val() == 'DESC') {
					$("#searchForm").find("input[name='order']").val('ASC');
					$(this).find('span').removeClass("icon-order-ASCending");
					$(this).find('span').removeClass("icon-order-DESCending");
					$(this).find('span').addClass("icon-order-ASCending");
				} else {
					$("#searchForm").find("input[name='order']").val('DESC');
					$(this).find('span').removeClass("icon-order-ASCending");
					$(this).find('span').removeClass("icon-order-DESCending");
					$(this).find('span').addClass("icon-order-DESCending");
				}
			} else {
				$("#searchForm").find("input[name='order']").val('DESC');
				$(this).find('span').removeClass("icon-order-ASCending");
				$(this).find('span').removeClass("icon-order-DESCending");
				$(this).find('span').addClass("icon-order-DESCending");
			}
			$('.filtrate-more').find('a').find('b').remove();
			$('.filtrate-more').find('a').removeClass('current');
			$('.filtrate-sort').find('em').html('排序');
			$(window).scrollTop("0");
			scroll = 2;
			var params = $("#searchForm").serializeJson();

			params.page = {
				cur_page: 1
			};
			params.go = 1;
			// $('html,body').scrollTop(101);
			tablelist.load(params, $.imgloading.loading);
		}
		if ($(this).index() == 3) {
			$('.filtrate-pop-section').show();
			var timer = setTimeout(function () {
				$('.filtrate-pop-section').addClass("show");
			}, 300);
			scrollheight = $(document).scrollTop();
			$("body").css("top", "-" + scrollheight + "px");
			$("body").addClass("visibly");
		}
		if ($(this).index() != 3) {
			$(this).addClass("active").siblings().removeClass("active");
		}
	});

	// 点击排序筛选后选取样式
	$('.filtrate-more').find('a').click(function () {
		$("#searchForm").find("input[name='sort']").val($(this).data('sort'));
		if ($(this).hasClass('current')) {
			$("#searchForm").find("input[name='order']").val('DESC');
		}
		$(this).addClass('current').parent('span').siblings().find('a').removeClass('current');
		$(this).parents('.filtrate-more').addClass('hide');
		$(".filtrate-term  ul").find("li").eq(0).addClass('active');
		$(".filtrate-term  ul").find("li").eq(0).find('span').html($(this).data('name'));
		$(".filtrate-term  ul").find("li").eq(0).data('sort', $(this).data('sort'));
		$('.mask-div').hide();
		$(this).parents('.filtrate-more').find('a').find('i').remove();
		$(this).parent('span').find('a').append('<i></i>');
		$(window).scrollTop("0");
		scroll = 2;
		var params = $("#searchForm").serializeJson();
		params.page = {
			cur_page: 1
		};
		params.go = 1;
		$.loading.start();
		// $('html,body').scrollTop(101);
		tablelist.load(params, $.imgloading.loading);
	});

	// 清空选项
	$('.filter-clear').click(function () {
		$('.base-filter li').removeClass('cur');
		$('.filtrate-list-ul li').removeClass('cur');
		$('.brand-list li').removeClass('cur');
		$.each($('#searchForm .search-box input'), function () {
			if (!($(this).attr('name') == 'keyword' || $(this).attr('name') == 'cat_id' || $(this).attr('name') == 'shop_id' || $(this).attr('name') == 'brand_id'))
			{
				$(this).val('');
			}
		});

		var min = $("#goods_list_price_min").val();
		var max = $("#goods_list_price_max").val();
		min = Math.floor(min);
		max = Math.ceil(max);

		$("#slider-range").slider({
			values: [min, max]
		});
		$('#slider-range-amount').text(min + ' ~ ' + max);
		var data = $("#searchForm").serializeJson();
		// Ajax加载数据
		tablelist.load(data, $.imgloading.loading);
		$.msg("清空完成")
		$(window).scrollTop("0");
		$(".category-content-section header").show();
		$(".filtrate-term").css('top', "50px");
		$('.filtrate-more').css('top', "99px");

	});

	$('.base-filter li').click(function () {
		if ($(this).attr('class') == 'cur') {
			$(this).removeClass('cur');
			$("#searchForm").find("input[name='" + $(this).data('type') + "']").val('0');
		} else {
			$(this).addClass('cur');
			$("#searchForm").find("input[name='" + $(this).data('type') + "']").val('1');
		}
	});

	// 点击遮罩层隐藏排序弹出
	// 滑动触发
	try {

		document.createEvent("TouchEvent");
		document.addEventListener('touchmove', function (event) {
			$('.mask-div').hide();
			$(".filtrate-more").addClass("hide");
		}, false);

		$('.mask-div').click(function () {
			$(this).hide();
			$(".filtrate-more").addClass("hide");
		});

	} catch (e) {
		$('.mask-div').click(function () {
			$(this).hide();
			$(".filtrate-more").addClass("hide");
		});
	}

	// 属性筛选
	$('.vattr-list li').click(function () {
		var attr_checked = [];
		var vattr_checked = [];
		if ($(this).hasClass('cur') == false) {
			$(this).addClass('cur');
		} else {
			$(this).removeClass('cur');
		}
		$.each($('.attr-lists'), function (i, v) {
			$.each($(v).find('.vattr-list li'), function (ii, vv) {
				if ($(vv).hasClass('cur')) {
					vattr_checked.push($(vv).data('value'));
				}
			});
			if (vattr_checked.length > 0) {
				attr_checked.push(vattr_checked.join('_'))
			} else {
				attr_checked.push(0);
			}
			vattr_checked = [];
		});
		$("#searchForm").find("input[name='filter_attr']").val(attr_checked.join("-"));
	});

	// 品牌筛选
	$('.brand-list li').click(function () {
		var brand_checked = [];
		if ($(this).hasClass('cur') == false) {
			$(this).addClass('cur');
		} else {
			$(this).removeClass('cur');
		}
		$.each($('.brand-list li'), function (i, v) {
			if ($(v).hasClass('cur')) {
				brand_checked.push($(v).data('brand_id'));
			}
		});
		$("#searchForm").find("input[name='brand_id']").val(brand_checked.join('_'));
	});
	$('.filtrate-list').click(function () {
		$(this).toggleClass("active");
		$(this).parents('.attr-info').find('li').not($(this).parents('.attr-info').find('li').slice(0, 3)).toggleClass('hide');
		var attr_info_ul = $(this).parents('.attr-info').siblings().find('.attr-info-ul');
		$.each(attr_info_ul, function (i, v) {
			if ($(v).find('.cur').length == 0) {
				$(v).find('li').not($(v).find('li').slice(0, 3)).addClass('hide');
				$(v).siblings('.filtrate-list').removeClass("active");
			}
		});
	});

	$('.show-type').click(function () {
		if ($('.goods-list-grid').hasClass('openList')) {
			$('.goods-list-grid').removeClass('openList');
			$.cookie('goods_list_show_style', 'list');
			$(this).removeClass('show-list');
			$("img.square").lazyload({
				skip_invisible: false,
				effect: 'fadeIn',
				failure_limit: 20,
				threshold: 200,
				load: function () {
					$(this).height($(this).width());
				}
			});
		} else {
			$('.goods-list-grid').addClass('openList');
			$(this).addClass('show-list');
			$.cookie('goods_list_show_style', 'grid');
			$("img.square").lazyload({
				skip_invisible: false,
				effect: 'fadeIn',
				failure_limit: 20,
				threshold: 200,
				load: function () {
					$(this).height($(this).width());
				}
			});
		}
	});

	$('.close-filter-content').click(function () {
		$('.filtrate-pop-section').removeClass("show");
		var timer = setTimeout(function () {
			$('.filtrate-pop-section').hide();
		}, 300);
		$("body").css("top", "auto");
		$("body").removeClass("visibly");
		$(window).scrollTop(scrollheight)
	});
	$(window).scroll(function () {
		if ($(window).scrollTop() <= 100) {
			$(".category-content-section header").show();
			$(".filtrate-term ").css('top', "44px");
			$('.filtrate-more').css('top', "84px");
		} else {
			$(".category-content-section header").hide();
			$(".filtrate-term ").css('top', "0px");
			$('.filtrate-more').css('top', "40px");
		}
	})
});
