$().ready(function() {
	
	try {
		//图片放大效果 注意：依赖于 js/bubbleup.js
		$(".header-right img").bubbleup({scale:80});
	} catch (e) {
	}
	
	try {
		//头部搜索  店铺、宝贝选择切换
		$('.search-type li').click(function() {
			$(this).addClass('cur').siblings().removeClass('cur');
			$('#searchtype').val($(this).attr('num'));
		});
		$('.search-type').hover(function(){
			$(this).css({"height":"auto","overflow":"visible"});
		},function(){
			$(this).css({"height":32,"overflow":"hidden"});
		});
	} catch (e) {
	}
	
	try {
		//全部分类鼠标经过展开收缩效果
		$('.all-nav-border .home-category').hover((function(){
			$('.expand-menu').css('display','inline-block');
		}),(function(){
			$('.expand-menu').css("display","none");
		}));
	} catch (e) {
	}
	
	try {
		//全部分类展开时左侧一级分类鼠标经过弹框
		$('.list').hover(function(){
			$(this).find('.categorys').show();
		},function(){
			$(this).find('.categorys').hide(); 
		});
	} catch (e) {
	}
	
	try {
		//当前位置下拉弹框
		$('.breadcrumb .crumbs-nav').hover(function(){
			$(this).toggleClass('curr');	
		})
	} catch (e) {
	}
	
	try {	
		//左侧分类弹框
		$('.list').hover(function(){
			$(this).find('.categorys').show();
		},function(){
			$(this).find('.categorys').hide(); 
		});
	} catch (e) {
	}
	
});
