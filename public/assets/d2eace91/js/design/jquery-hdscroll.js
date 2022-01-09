function IsPC() {
    var userAgentInfo = navigator.userAgent;
    var Agents = ["Android", "iPhone",
                "SymbianOS", "Windows Phone",
                "iPad", "iPod"];
    var flag = true;
    for (var v = 0; v < Agents.length; v++) {
        if (userAgentInfo.indexOf(Agents[v]) > 0) {
            flag = false;
            break;
        }
    }
    return flag;
}
if(IsPC()){

$(document).scroll(function(){
$banner = $('.swiper-container').height();//轮播图高度
$st = $(document).scrollTop(); //滚动的位置

if($st < ($banner-40)){
	$('.search-box-cover').css("opacity",$st < 40 ? 0 : 0.85*($st - 40)/($banner-40));		
	}
	else{
	$('.search-box-cover').css("opacity", 0.85);
	}
})
}
else
{
$(document).bind("touchmove", function (event) {
$banner = $('.swiper-container').height();//轮播图高度
$st = $(document).scrollTop(); //滚动的位置

if($st < ($banner-40)){
	$('.search-box-cover').css("opacity",$st < 40 ? 0 : 0.85*($st - 40)/($banner-40));		
	}
	else{
	$('.search-box-cover').css("opacity", 0.85);
	}
	
})}

