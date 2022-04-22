$(function() {
	
	// 首页banner图轮播
	function banner_play(a, b, c, d) {
		var blength = $(a).length;
		if (blength > 1) {
			$(b).mouseover(function() {
				$(this).addClass(c).siblings().removeClass(c);
				$(a).eq($(this).index()).hide().fadeIn().siblings().fadeOut();

				num = $(this).index();
				clearInterval(bannerTime);
			});
			var num = 0;
			function bannerPlay() {
				num++;
				if (num > blength - 1) {
					num = 0;
				}
				$(b).eq(num).addClass(c).siblings().removeClass(c);
				$(a).eq(num).hide().fadeIn().siblings().fadeOut();
			}
			var bannerTime = setInterval(bannerPlay, 6000);
			$(d).hover(function() {
				clearInterval(bannerTime);
			}, function() {
				bannerTime = setInterval(bannerPlay, 6000);
			})
		}
	}
	banner_play('.full-screen-slides li', '.full-screen-slides-pagination li', 'current', '#fullScreenSlides');// 首页主广告轮播

});

// 首页左侧楼层定位
$(function() {
	if ($(".floor-list")) {
		var elevatorfloor = $(".elevator-floor");
		$.each($('.floor-list'), function(i, v) {
			var fnum = $.trim($(v).find('.SZY-FLOOR-NAME').text());
			var short_name = $.trim($(v).find('.SZY-SHORT-NAME').val());
			if (short_name == '')
				short_name = fnum;
			var $el = $("<a class='smooth' href='javascript:;'><b class='fs'>" + fnum + "</b><em class='fs-name'>" + short_name + "</em></a>")
			var $i = $("<i class='fs-line'></i>");
			if (i < $('.floor-list').length - 1) {
				$el.append($i);
			}
			elevatorfloor.append($el);
		});

		var conTop = 0;
		if ($(".floor-list").length > 0) {
			conTop = $(".floor-list").offset().top;
		}
		$(window).scroll(function() {
			var scrt = $(window).scrollTop();
			if (scrt > conTop) {

				$(".elevator").show("fast", function() {
					$(".elevator-floor").css({

						"-webkit-transform": "scale(1)",
						"-moz-transform": "scale(1)",
						"transform": "scale(1)",
						"opacity": "1"
					})
				}).css({
					"visibility": "visible"
				})
			} else {
				$(".elevator-floor").css({
					"-webkit-transform": "scale(1.2)",
					"-moz-transform": "scale(1.2)",
					"transform": "scale(1.2)",
					"opacity": "0"
				});
				$(".elevator").css({
					"visibility": "hidden"
				});
			}
			setTab();
		});

		var arr = [], fsOffset = 0;
		for (var i = 1; i < $(".floor").length; i++) {
			arr.push(parseInt($(".floor").eq(i).offset().top) + 30)
		}
		$(".elevator-floor a.smooth").on("click", function() {
			var _th = $(this);
			_th.blur();
			var index = $(".elevator-floor a.smooth").index(this);
			if (index > 0) {
				fsOffset = 50
			}
			var hh = arr[index];
			$("html,body").stop().animate({
				scrollTop: hh - fsOffset + "px"
			}, 400)
		});
		$(".elevator-floor a.fsbacktotop").click(function() {
			$("html,body").stop().animate({
				scrollTop: 0
			}, 400)
		});

		function setTab() {
			var Objs = $(".floor:gt(0)");
			var textSt = $(window).scrollTop();
			for (var i = Objs.length - 1; i >= 0; i--) {
				if (textSt >= $(Objs[i]).offset().top - $(Objs[i - 1]).height() / 2) {
					$(".elevator-floor a").eq(i).addClass("active").siblings().removeClass("active");
					return;
				}
			}
		}
	}
});


//处理轮播图片
$(function() {
if($('.SZY-FLOOR-HISLIDER').length >0)
{
	$.each($('.SZY-FLOOR-HISLIDER'),function(i,v){
		$(v).hiSlider();
		$.imgloading.loading();
	});
}	
});
