// JavaScript Document
//switch按钮点击.remarkInfo是否显示隐藏
$(".switch-on-off").on('switchChange.bootstrapSwitch', function(e, state) {
  if (state) {
	  $('.remarksInfo').addClass('hide')
  } else {
	  $('.remarksInfo').removeClass('hide');
  }
});

//文章模型创建处select value值选择和字段添加等页面,待封装整合
function selectVar() {
  var sValue =$('.selectCont').val();
  if(sValue!=''||sValue!='undefind')
  {
		 $('.toggle').addClass('hide');
		 $('.selectVar'+sValue).removeClass('hide');  
  }else{
	 alert('无此类型！') 
  }
      	  
}

//select介于、大于选择隐藏显示
function rangeSelect() {
  var selectValue =$('.rangeSelect').val();
		  if(selectValue == 0){
			  $('.between').removeClass('hide');
			  $('.form-group .big').addClass('hide');
			  }
		  else{
			  $('.between').addClass('hide');
			  $('.form-group .big').removeClass('hide');
	 		  }	
}
//会员设置处点击送红包，弹出模态框
function showModel()
{
  if($("input[type='checkbox'][name='chk']:checked").length===0)
  {
	  $('#Modal').modal('show');
  }else{
	  $('#Modal').modal('hide');	
  }	
}	
//chkValue会员设置处，当注册方式没有任何勾选的时候，remarksInfo是否显示隐藏
$(".chkValue").click(function() {
	  setTimeout(function(){
			  var num = $("input[type='checkbox'][name='chkValue']:checked").length;
	  
			  if(!num){
				  $(".remarksInfo").removeClass('hide');
			  } else {
				  //alert(num);
				  $('.remarksInfo').addClass('hide');
			  }
		  },100)
	  
});

/*权限设置添加管理员密码设定是否明密文显示*/
$(".pwd-toggle").click(function() {
	    if ($('.pwd-toggle').hasClass('fa-eye')) {
	       		$('.pwd-toggle').removeClass('fa-eye');
				$('.pwd-toggle').addClass('fa-eye-slash');
				$('#pwd-input').attr("type","password");
		} else {
			    $('.pwd-toggle').addClass('fa-eye');
				$('.pwd-toggle').removeClass('fa-eye-slash');
				$('#pwd-input').attr("type", "text");
		}
});

/*商品添加页面右侧发布助手js*/
$('.helper-icon').click(function() {
      $('.helper-icon').animate({
		  'right': '-40px'
		   },200,
       function() {
        $('.helper-wrap').animate({
			'right': '0'
		     },200);
		});
});
$('.help-header .fa-times-circle').click(function() {
      $('.helper-wrap').animate({
			'right': '-140px'
			}, 200,
      function() {
            $('.helper-icon').animate({
			'right': '0'
			},  200);	
      });            
});
