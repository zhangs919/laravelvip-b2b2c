// JavaScript Document
$(function() {
	$("body").on('click', '.delete a', function() {
		var arr = $(this).attr('name');
		var str = arr.split('shop');
		var this_div = $(this).parent();
		var all_shop = $("#all_shop em").html();
		var buy_shop_list = $("#buy_shop_list em").html();
		$.confirm("是否删除选中内容？", function(s) {
			if (s) {
				$.ajax({
					type: 'GET',
					url: '/user/collect/delete-collect?id=' + str[1],
					dataType: 'json',
					success: function(result) {
						if (result.code == 0) {
							$("#all_shop em").html(result.shop_count);
							$("#buy_shop_list em").html(result.buy_count);
							tablelist.load();
							$.msg("删除成功");
						}
					}
				})
			}
		});
	})
})
$(function() {
	$("body").on('click', '.del-btn', function() {
		var this_tip = $(this);
		var arr = $(this).attr('name');
		var shop = arr.split(',');
		var fig = $(this).data("fig");
		$.confirm("是否删除选中内容？", function(s) {
			if (s) {
				$.ajax({
					type: 'GET',
					url: '/user/collect/delete-collect?del=1&id=' + shop[0],
					dataType: 'json',
					success: function(result) {
						if (result.code == 0) {
							$("#goods_list em").html(result.collect_count);
							$("#invalid_list em").html(result.invalid_count);
							$("#shop_same em").html(result.shop_count_list);
							tablelist.load();
							$.msg("删除成功");

						}
					}
				})
			}
		});
	})
})
$(function() {
	// 头部账户设置鼠标经过事件
	try {
		$(".navitems .dl").hover(function() {
			$(this).addClass("hover")
		}, function() {
			$(this).removeClass("hover")
		});
	} catch (e) {
	}

	// 欢迎页 我的账户相关信息 鼠标经过效果
	$(".myInfo").mouseenter(function() {
		if (!$(this).hasClass("noneInfo")) {
			$(this).find(".tipsBox").stop().animate({
				left: "230px"
			})
		}
		try {
			require(["base_observer"], function(e) {
				var d = $(".myInfo");
				e.fire("impressionEvent", d)
			})
		} catch (c) {
		}
	});
	$(".myInfo").mouseleave(function() {
		if (!$(this).hasClass("noneInfo")) {
			$(this).find(".tipsBox").stop().animate({
				left: "-298px"
			})
		}
	});

	// 欢迎页 我的账户相关信息 鼠标经过效果
	$(".myInfo").find(".imgHeaderBox").hover(function() {
		$(this).toggleClass("showUpdateInfo")
	});

	// 欢迎页 店铺收藏鼠标经过效果
	$(".collect-shop li").hover(function() {
		$(this).find('.mask').addClass('mask-big');
	}, function() {
		$(this).find('.mask').removeClass('mask-big');
	});

	if ($(".con-right").height() > $(".con-left").height()) {
		$(".con-left").height($(".con-right").height());
	}

	// 欢迎页 店铺收藏、商品收藏tab切换
	$(".tab-con").hide();
	$("ul.tabs li:first").addClass("active").show();
	$(".tab-con:first").show();
	$("ul.tabs li").hover(function() {
		$("ul.tabs li").removeClass("active");
		$(this).addClass("active");
		$(".tab-con").hide();
		var activeTab = $(this).find("a").attr("href");
		$(activeTab).show();
		if ($("ul.tabs li:first-child").hasClass("active")) {
			$(".more").attr("href", "/user/collect/goods.html");
			$(".more").attr("title", "查看全部收藏的商品");
		} else {
			$(".more").attr("href", "/user/collect/shop.html");
			$(".more").attr("title", "查看全部收藏的店铺");
		}

	});

	// 鼠标经过表格行，行变色----收货地址列表
	$(".shipping-list tr").mouseover(function() {
		$(this).css("background", "#f2f2f2");
		$(this).find('a.note').css('display', 'inline-block');
	})
	$(".shipping-list tr").mouseout(function() {
		$(this).css("background", "#ffffff");
		$(this).find('a.note').css('display', 'none');
	})

	/* 权限设置添加管理员密码设定是否明密文显示 */
	// $(".pwd-toggle").click(function() {
	// 	if ($('.pwd-toggle').hasClass('fa-eye')) {
	// 		$('.pwd-toggle').removeClass('fa-eye');
	// 		$('.pwd-toggle').addClass('fa-eye-slash');
	// 		$('#pwdInput').attr("type", "password");
	// 	} else {
	// 		$('.pwd-toggle').addClass('fa-eye');
	// 		$('.pwd-toggle').removeClass('fa-eye-slash');
	// 		$('#pwdInput').attr("type", "text");
	// 	}
	// });

	// 账户安全 支付开启、关闭等用到的弹框
	$("#btn").click(function() {
		$('#bg').css('display', 'block');
		$("#popDiv").show();
	});
	$("#close").click(function() {
		$('#bg').css('display', 'none');
		$("#popDiv").hide();
	});

	// 订单详情鼠标经过更多显示层效果
	$('.drop-down-container').mousemove(function() {
		$(this).find('.drop-down-content').show();// 可以自己修改速度
	});
	$('.drop-down-container').mouseleave(function() {
		$(this).find('.drop-down-content').hide();
	});
	
	// 商家拒绝取消订单申请
	try {
		$(".shop-cancel-reason ").hover(function() {
			$(this).find('.cancel-reason-box').show();
		}, function() {
			$(this).find('.cancel-reason-box').hide();
		});
	} catch (e) {
	}

	// 全选

	$("body").on('click', '.tool-list li:first-child', function() {
		$(this).toggleClass('tool-item-selall');
		if ($(this).hasClass('tool-item-selall')) {
			$(this).find("i").html("&#xe6ae;");
			$(".edit-pop").addClass('edit-pop-select');
		} else {
			$(this).find("i").html("&#xe715;");
			$(".edit-pop").removeClass('edit-pop-select');

		}

	});

	// 我的收藏“批量管理”点击效果
	$("body").on('click', '.tool-showbtn', function() {

		$(".price-box").each(function() {

			if ($(this).children().attr("class") == "price-icon invalid") {
				if ($(this).parent().next().hasClass("edit-pop") == false) {

					$(this).parent().next().addClass("edit-pop");
				}

			}
		});

		$(this).hide().next().show();
		$(this).parents('.collect-list').addClass('collect-list-items');
		$('.compare').hide();
	});
	// $('.tool-hidebtn').click(function(){
	// $("body").on('click', '.tool-hidebtn', function(){
	$("body").on('click', '.tool-hidebtn', function() {
		$('.edit-pop').removeClass('edit-pop-select');
		if ($(this).siblings('li').hasClass('tool-item-selall')) {
			$(this).siblings('li').removeClass('tool-item-selall');
		}
		$(this).parents('.tool-list').hide().prev().show();
		$(this).parents('.collect-list').removeClass('collect-list-items');
		$('.compare').show();
	});
	// $('.edit-pop').click(function(){
	// $("body").on('click', '.edit-pop', function(){
	// 我的收藏“批量管理”点击开商品选择的效果
	$("body").on('click', '.edit-pop', function() {
		var this_text = $(this);
		if ($(".tool-showbtn").css("display") == "none") {
			this_text.toggleClass('edit-pop-select');
			var tool_item_selall = true;
			$.each($('.edit-pop'),function(){
				if(!$(this).hasClass('edit-pop-select')){
					tool_item_selall = false;
				}
			});
			if(tool_item_selall == true){
				$('.tool-list li:first-child').addClass('tool-item-selall');
			}else{
				$('.tool-list li:first-child').removeClass('tool-item-selall');
			}
		} else {

			//这里不明白什么意思
			//if ($(this).children().next().next().children().next().length == 0) {
			//	this_text.toggleClass('edit-pop-select');
			//}
			this_text.toggleClass('edit-pop-select');
			var len = $("div[class='edit-pop edit-pop-select']").length;
			if (len <= 3) {
				if (len >= 2) {
					$(".compare-start").removeClass("disable");
				}else{
					$(".compare-start").addClass("disable");
				}
				$(".compare-txt span").html(len);
			} else {
				$.msg("最多选择3个");
				$(this).toggleClass('edit-pop-select');
			}
		}
	});

	$("body").on("click", ".compare-start", function() {
		var int = 0;
		var arr = new Array();
		$("div[class='edit-pop edit-pop-select']").each(function() {

			arr[int] = $(this).children(".edit-pop-bg").children().val();

			int++;
		});
		if ($(".compare-start").hasClass("disable") == false) {

			window.location.href = "/compare.html?&ids=" + arr;
		}
	})
	// 我的收藏“宝贝对比”点击效果
	$("body").on("click", ".compare-open", function() {

		$(".price-box").each(function() {

			if ($(this).children().attr("class") == "price-icon invalid") {
				if ($(this).parent().next().hasClass("edit-pop")) {

					// $(this).parent().next().removeClass("edit-pop");
					$(".error-txt").css("display", "block");
				}
			}
		});
		$(this).hide().siblings().show();
		$(this).parents('.collect-list').addClass('collect-list-items');
		$('.tools').hide();
	});
	$("body").on("click", ".compare-close", function() {
		// $('.compare-close').click(function(){
		$(".error-txt").css("display", "none");
		$(this).hide().siblings().hide();
		$(this).parents('.collect-list').removeClass('collect-list-items');
		$('.compare-open').show();
		$('.tools').show();
	});

	// $('.collect-list li').hover(function(){
	// $("body").on('hover', '.collect-list li', function(){
	// 我的收藏鼠标经过收藏商品的效果
	// $("body").on('mouseover mouseout', '.collect-list li', function(){
	// if(!$(this).parents('.collect-list').hasClass('collect-list-items')){
	// $(this).toggleClass('fav-item-hover');
	// }
	// })
	//	
	// fav-item fav-item-hover
	//	

	// //$('.fav-shop .item-box').hover(function(){
	// //$("body").on('hover', '.fav-shop .item-box', function(){
	// 修改
	$("body").on('mouseover mouseout', '.fav-item', function() {
		$(this).toggleClass('fav-item-hover');
	})

	$("body").on('mouseover mouseout', '.fav-shop .item-box', function() {
		$(this).toggleClass('fav-item-hover');
	})

	// 我的评价查看评价
	$("body").on("click", ".see-evaluate", function() {

		// $(".see-evaluate").click(function() {
		$(this).parents('.evaluate-plist').find('.evaluate-box').toggle();
	});

	// 我的足迹鼠标经过收藏商品的效果
	try {
		$('.history-list li').hover(function() {
			$(this).toggleClass('fav-item-hover');
		})
	} catch (e) {
	}

	// 我的评价回复弹框
	$("body").on("click", ".reply", function() {
		var id = $(this).next("input").val();
		$("#comment_id").val(id);
		$(".reply-con textarea").val("");
		$('.reply-coupon').show(id);
		$('.bg').show();
	});
	// 我的评价回复弹框关闭事件
	$('.reply-oprate').click(function() {
		$('.reply-coupon').hide();
		$('.bg').hide();
	});

	// 我的评价点击评价
	$("body").on("click", ".go-to-evaluate", function() {
		$(this).parents('.evaluate-plist').find('.evaluate-box').toggle().parent().siblings().find('.evaluate-box').hide();
	});

	$(".mg-select").hover(function() {
		$(this).find('.mg-operate').removeClass('hide');
	}, function() {
		$(this).find('.mg-operate').addClass('hide');
	});
	$('.history-list li').hover(function() {
		$(this).toggleClass('fav-item-hover');
	})

	// 我的红包
	$("body").on("mouseover", ".coupon-item", function() {
		$(this).addClass('coupon-item-hover');
	}).on("mouseout", ".coupon-item", function() {
		$(this).removeClass('coupon-item-hover');
	});

	// 店铺储值卡
	if($('.recharge-goods-box ul').height() > 410){
            $(this).find('li').addClass("goods-item-spe");
     }

});

// 个人资料tab切换
function setTab(name, cursel, n) {
	for (i = 1; i <= n; i++) {
		var menu = document.getElementById(name + i);
		var con = document.getElementById("con_" + name + "_" + i);
		con.style.display = i == cursel ? "block" : "none";
		menu.className = i == cursel ? "active" : "";
	}
}
