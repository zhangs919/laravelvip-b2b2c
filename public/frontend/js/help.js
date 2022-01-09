// JavaScript Document
$(function(){
	
	//左侧分类树点击展开收缩效果
	$('.tree li:has(ul)').addClass('parent_li');
    $('.tree li.parent_li > h4').on('click', function () {
        var children = $(this).parent('li.parent_li').find(' > ul > li');
        if (children.is(":visible")) {
            $(this).find('i').addClass('icon-plus-sign').removeClass('icon-minus-sign');
			$(this).parent('li.parent_li').find(' > ul').slideUp('fast');
        } else {
            children.slideDown('fast');
			$(this).parent('li').siblings().find('i').addClass('icon-plus-sign').removeClass('icon-minus-sign');
			$(this).parent('li').siblings().find(' > ul').slideUp('fast');
			$(this).find('i').addClass('icon-minus-sign').removeClass('icon-plus-sign');
			$(this).parent('li.parent_li').find(' > ul').slideDown('fast');
        }
    });
	
});