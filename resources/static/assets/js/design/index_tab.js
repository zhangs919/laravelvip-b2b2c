//楼层内的品牌切换
$('body').on('click', '.brand-right' , function(){
	var shu = 10;
	var num=0;
	var llishu=$(this).parents(".brand-con").find(".brand-list").first().children().length;
	var liwidth=$(this).parents(".brand-con").find(".brand-list").children().width();
	var boxwidth=llishu*liwidth;
	var shuliang=llishu-shu;
	$(this).parents(".brand-con").find(".brand-list").css('width',''+boxwidth+'px');
	console.info($(this).parents(".brand-con").find(".brand-list"));
		num++;
		if (num>shuliang) {
			num=shuliang;
		}
		var move=-liwidth*num;
		$(this).closest($(this).parents(".brand")).find(".brand-list").stop().animate({'left':''+move+'px'},500);
	});

$('body').on('click', '.brand-left' , function(){
	var shu = 10;
	var num=0;
	var llishu=$(this).parents(".brand-con").find(".brand-list").first().children().length;
	console.info($(this).parents(".brand-con").find(".brand-list"));
	var liwidth=$(this).parents(".brand-con").find(".brand-list").children().width();
	var boxwidth=llishu*liwidth;
	var shuliang=llishu-shu;
	$(this).parents(".brand-con").find(".brand-list").css('width',''+boxwidth+'px');
	
	num--;
	if (num<0) {
		num=0;
	}
	var move=liwidth*num;
	$(this).closest($(this).parents(".brand")).find(".yyyy").stop().animate({'left':''+-move+'px'},500);
})

function Move(btn1,btn2,box,btnparent,shu){
	var llishu=$(box).first().children().length;
	var liwidth=$(box).children().width();
	var boxwidth=llishu*liwidth;
	var shuliang=llishu-shu;
	$(box).css('width',''+boxwidth+'px');
	var num=0;
	$(btn1).click(function(){
		num++;
		if (num>shuliang) {
			num=shuliang;
		}
		var move=-liwidth*num;
		$(this).closest(btnparent).find(box).stop().animate({'left':''+move+'px'},500);
	});
	$(btn2).click(function(){
		num--;
		if (num<0) {
			num=0;
		}
		var move=liwidth*num;
		$(this).closest(btnparent).find(box).stop().animate({'left':''+-move+'px'},500);
	})
}
