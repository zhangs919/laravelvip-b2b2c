// JavaScript Document
$(function(){ 
  $('.all-category-list').height($(".all-category-items").height());
  $(window).scroll(function() {
	 if($(window).scrollTop()>=230){
	  $(".all-category-items").addClass("all-category-items-fixed");
	 }else{
	  $(".all-category-items").removeClass("all-category-items-fixed");
	 } 
  });
  $('.all-category-items li.category-list').click(function() {
		$(this).addClass('current').siblings('.category-list').removeClass('current');
		$("html,body").scrollTop($('.all-category-floor').eq($(this).index()).offset().top -  $(".all-category-items").height());
	})
});

