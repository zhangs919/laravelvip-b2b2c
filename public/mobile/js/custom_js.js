$(document).ready(function(){
	//当滚动条的位置处于距顶部6000像素以下时，跳转链接出现，否则消失
	$(function ()
	{
		$(window).on('scroll', function()
		{
			if ($(document).scrollTop()>500)
			{
				$(".index-icon").addClass('tab-gotop-icon');
			}
			else
			{
				$(".index-icon").removeClass('tab-gotop-icon');
			}
		});
		//当点击跳转链接后，回到页面顶部位置
		$('body').on('click', '.tab-gotop-icon', function()
		{
			$('body,html').animate(
			{
				scrollTop:0
			}
			,600);
			return false;
			});
		});
});