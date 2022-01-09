// JavaScript Document
function scroll_pic(obj){
	var bar_l = $(obj).find('.scroll-num span').length;
	$(obj).find('.scroll-num span').mouseover(function(){
		$(this).addClass('on').siblings().removeClass('on');
		$(obj).find('.scroll-pic li').eq($(this).index()).stop().fadeIn(1000).siblings().fadeOut();
		num=$(this).index();
	});
	$(obj).hover(function(){
		clearInterval(mytime);
		$(obj).find('.scroll-btn').show();
	},function(){
		mytime=setInterval(autoplay,6000);
		$(obj).find('.scroll-btn').hide();
	});
	var num=0;
	$(obj).find('.btn-right').click(function(){
		num++;
		if(num>(bar_l-1)){
			num=0;
		}
		$(obj).find('.scroll-pic li').eq(num).stop().fadeIn(1000).siblings().fadeOut();
		$(obj).find('.scroll-num span').eq(num).addClass('on').siblings().removeClass('on');
	});
	$(obj).find('.btn-left').click(function(){
		num--;
		if(num<0){
			num=bar_l-1;
		}
		$(obj).find('.scroll-pic li').eq(num).stop().fadeIn(1000).siblings().fadeOut();
		$(obj).find('.scroll-num span').eq(num).addClass('on').siblings().removeClass('on');
	});
	function autoplay(){
		num++;
		if(num>(bar_l-1)){
			num=0;
		}
		$(obj).find('.scroll-pic li').eq(num).stop().fadeIn(1000).siblings().fadeOut();
		$(obj).find('.scroll-num li').eq(num).addClass('on').siblings().removeClass('on');
	}
	var mytime=setInterval(autoplay,6000);
	$(obj).find('.scroll-num').css('margin-left',-$(obj).find('.scroll-num').width()/2);
}
$(function(){
	$('.scroll-box').each(function(){
		scroll_pic(this);
	})
});