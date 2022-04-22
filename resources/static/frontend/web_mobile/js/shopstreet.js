/* 店铺街 js */
$(function() {

	$('.shop-classify').click(function() {
		if ($(".classify-content").hasClass('hide')) {
			$(".classify-content").removeClass('hide');
			$(".classify-content").animate({
				height: '60%'
			}, [10000]);
			$('.mask-div').show();
		} else {
			$(".classify-content").addClass('hide');
			$('.mask-div').hide();
		}
	});
	$('.mask-div').click(function() {
		$(".shop-submenu").hide();
		$('.mask-div').hide();
		$("body").removeClass("visibly");
		$('.shop-nav a').removeClass('current')
	});
	var scrollheight = 0;

	$('.shop-nav a').click(function() {

		if ($(this).hasClass('current')) {
			$(this).removeClass('current');
			$('.shop-submenu').eq($(this).index()).hide();
			$(".mask-div").hide();
			$("body").css("top", "auto");
			$("body").removeClass("visibly");
			$(window).scrollTop(scrollheight);
		} else {
			$(this).addClass('current').siblings().removeClass('current');
			$('.shop-submenu').eq($(this).index()).show().siblings('.shop-submenu').hide();
			$(".mask-div").show();
			scrollheight = $(document).scrollTop();
			$("body").css("top", "-" + scrollheight + "px");
			$("body").addClass("visibly");
		}
	});

	/* 距离筛选 */
	$('.SZY-SHOP-STREET-DISTANCE a').click(function() {
		$(this).addClass('current').parent().siblings().find('a').removeClass('current');
		var distance = $(this).data('val');
		var $form = $("#searchForm");
		$form.find('[name="distance"]').val(distance);
		var data = $form.serializeJson();
		data.page = {
			cur_page: 1
		};
		data.go = 1;
		tablelist.load(data,function(){
			is_opening();
		});
		$(".shop-submenu").hide();
		$('.mask-div').hide();
		$('.shop-nav a').eq(1).html($(this).data('text'));
		$('.shop-nav a').eq(1).removeClass('current');
		$(window).scrollTop(0);
		$("body").removeClass("visibly");
	});

	/* 排序 */
	$('.SZY-SHOP-STREET-SORT a').click(function() {
		$(this).addClass('current').parent().siblings().find('a').removeClass('current');
		var sort = $(this).data('val');
		var text = $(this).data('text');
		if ($(this).find('b').length > 0) {
			if ($(this).find('b').hasClass('icon-ascending')) {
				$(this).find('b').addClass('icon-descending').removeClass('icon-ascending');
				sort = sort + '-' + 'desc';
				text = text + '由高到低';
			} else {
				$(this).find('b').addClass('icon-ascending').removeClass('icon-descending');
				sort = sort + '-' + 'asc';
				text = text + '由低到高';
			}
		} else {
			$(this).parent().siblings().find('b').remove();
			$(this).append('<b class="icon-descending"></b>');
			sort = sort + '-' + 'desc';
			text = text + '由高到低';
		}
		var $form = $("#searchForm");
		$form.find('[name="sort"]').val(sort);
		var data = $form.serializeJson();
		data.page = {
			cur_page: 1
		};
		data.go = 1;
		tablelist.load(data,function(){
			is_opening();
		});
		$(".shop-submenu").hide();
		$('.mask-div').hide();
		$('.shop-nav a').eq(2).html(text);
		$('.shop-nav a').eq(2).removeClass('current');
		$(window).scrollTop(0);
		$("body").removeClass("visibly");
	});

	/* 分类 */
	$('.SZY-SHOP-STREET-CLS li').click(function() {
		var cls_id = $(this).data('val');
		if ($('#cls_list_' + cls_id + ' li').length == 1) {
			$('#cls_list_' + cls_id + ' li').eq(0).click();
		}
		$(this).addClass('current').siblings().removeClass('current');
		if (cls_id == '0') {
			$('.SZY-SHOP-STREET-CLS-CHR li').removeClass('current');
			var $form = $("#searchForm");
			$form.find('[name="cls_id"]').val(cls_id);
			var data = $form.serializeJson();
			data.page = {
				cur_page: 1
			};
			data.go = 1;
			tablelist.load(data,function(){
				is_opening();
			});
			$(".shop-submenu").hide();
			$('.mask-div').hide();
			$('.shop-nav a').eq(0).html($(this).data('text'));
			$('.shop-nav a').eq(0).removeClass('current');
			$(window).scrollTop(0);
			$("body").removeClass("visibly");
		}

		$('#cls_list_' + cls_id).removeClass('hide').siblings().addClass('hide');
	});

	$('.SZY-SHOP-STREET-CLS-CHR li').click(function() {
		var cls_id = $(this).data('cls_id');
		$(this).addClass('current').parent().siblings().find('li').removeClass('current');
		$(this).addClass('current').siblings().removeClass('current');
		var $form = $("#searchForm");
		$form.find('[name="cls_id"]').val(cls_id);
		var data = $form.serializeJson();
		data.page = {
			cur_page: 1
		};
		data.go = 1;
		tablelist.load(data,function(){
			is_opening();
		});
		$(".shop-submenu").hide();
		$('.mask-div').hide();
		$('.shop-nav a').eq(0).html($(this).data('text'));
		$('.shop-nav a').eq(0).removeClass('current');
		$(window).scrollTop(0);
		$("body").removeClass("visibly");
	});

	/* 搜索店铺 */
	$('#shop_search').click(function() {
		var name = $(this).parent().find('[name="name"]').val();
		if ($.trim(name) == '') {
			$.msg('请输入店铺名称');
			return;
		}
		var $form = $("#searchForm");
		$form.find('[name="name"]').val(name);
		var data = $form.serializeJson();
		data.page = {
			cur_page: 1
		};
		data.go = 1;
		tablelist.load(data);
		$(window).scrollTop(0);
	});
});