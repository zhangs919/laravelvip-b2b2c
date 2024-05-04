// JavaScript Document
$(function() {
	$('.news-header-right').click(function() {
		$('.article-classify-box').addClass('show');
	});
	$('.back-news').click(function() {
		$('.article-classify-box').removeClass('show');
	});

	if ($('#article-category').length > 0) {

		$('#article-category ul li').click(function() {

			$(this).addClass('cur').siblings().removeClass('cur');
			var b = $(window).width();
			var d = $("#article-category li.cur").offset().left;
			var liTotalWidth1 = 0;
			$('#article-category ul li').each(function() {
				liTotalWidth1 += $(this).width() + 40;
			});
			var c = liTotalWidth1;
			var a = c - $("#article-category").width();
			if(a>0){
				if (d < a) {
					logisticsScroll.scrollTo(-d,0,200);
				
				} else {
					logisticsScroll.scrollTo(-a,0,200);
				}
			}
		});
		
		window.onload = function() {
			initLogisticsScroll();
		};
	}
	var liTotalWidth = 0;
	var logisticsScroll;
	function initLogisticsScroll() {
		$('#article-category ul li').each(function() {
			liTotalWidth += $(this).width() + 40;
		});
		$('#article-category ul').css({
			'width': liTotalWidth + 'px'
		});
		if (logisticsScroll instanceof IScroll) {
			logisticsScroll.destroy();
		}

		var scrollwidth = 0;

		logisticsScroll = new IScroll('#article-category .scroll', {
			'mouseWheel': true,
			'scrollX': true,
			'scrollY': false,
			'click': true,
			'interactiveScrollbars': true
		}, 200);

	}

});