// JavaScript Document
$(function(){

	//二维码、PC登录切换
	$('.qrcode-target').click(function(){
		if($(this).hasClass('btn-qrcode')){
			$(this).removeClass('btn-qrcode').addClass('btn-login').attr('title','去电脑登录');
			$('.login-wrap').hide();
			$('.login-mobile').show();
			return;
		}
		if($(this).hasClass('btn-login')){
			$(this).removeClass('btn-login').addClass('btn-qrcode').attr('title','去手机扫码登录');
			$('.login-wrap').show();
			$('.login-mobile').hide();
		}
	});
	
});

//动态、普通登录切换
function setTab(name,cursel,n){
	for(i=1;i<=n;i++){
		var menu=document.getElementById(name+i);
		var con=document.getElementById("con_"+name+"_"+i);
		con.style.display=i==cursel?"block":"none";
		menu.className=i==cursel?"active":"";
	}
}