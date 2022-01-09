// JavaScript Document
//banner图轮播
function banner_play(a,b,c,d){
	var blength = $(a).length;
	if(blength > 1){
		$(b).mouseover(function(){
			$(this).addClass(c).siblings().removeClass(c);
			$(a).eq($(this).index()).hide().fadeIn().siblings().fadeOut();
			
			num=$(this).index();
			clearInterval(bannerTime);	
		});
		var num=0;
		function bannerPlay(){
			num++;
			if(num>blength-1){
				num=0;	
			}
			$(b).eq(num).addClass(c).siblings().removeClass(c);
			$(a).eq(num).hide().fadeIn().siblings().fadeOut();	
		}
		var bannerTime = setInterval(bannerPlay,6000);
		$(d).hover(function(){
			clearInterval(bannerTime);	
		},function(){
			bannerTime = setInterval(bannerPlay,6000);	
		})
	}
}
banner_play('.full-screen-slides li','.full-screen-slides-pagination li','current','#fullScreenSlides');//首页主广告轮播
