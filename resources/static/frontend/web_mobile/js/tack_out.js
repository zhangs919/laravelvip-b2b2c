$(function () {
    //滚动条

    //图片延迟加载
 //   $(".lazyload").scrollLoading({ container: $(".category-right") });
    //点击切换2 3级分类
    $("#second-category").niceScroll({ cursorwidth: 0,cursorborder:0 });
    //点击切换2 3级分类
	var array=new Array();
	$('#second-category li').each(function(){ 
		array.push($(this).position().top);
	});
})

