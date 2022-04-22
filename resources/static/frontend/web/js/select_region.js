/*这是从小京东拿过来的代码，代码简单，参考小京东详情页面*/


//鼠标经过、离开地区文字，显示、隐藏地区选择层，点击关闭按钮隐藏地区选择层
$(function () {
	var city_time=null;
	$('.region,.region-chooser-box').mouseover(function(){
	  clearTimeout(city_time);
	  $('.region-chooser-box').show();    
	  $('.region').addClass('active');
	});
	$('.region,.region-chooser-box').mouseout(function(){
	  city_time=setTimeout(function(){
	  	$('.region-chooser-box').hide();
		$('.region').removeClass('active');
		},200);
	});
	$('.region-chooser-close').click(function(){
		$('.region-chooser-box').hide();	
		$('.region').removeClass('active');
	})
})
//点击地区click时间，用ajax读取数据库获得所点击地区的下级地区列表
     function get_regions(level, rid)
     {
		var obj_num = $('.region-items').length;
		for(var i=1;i<=obj_num;i++){
			$('#city_li_'+i).attr('class','region-tab');
			$('#city_box_'+i).hide();
			if(level == i){
				$('#city_li_'+i).attr('class','region-tab selected');
				$('#city_box_'+i).show();
			}
		}
		if(rid)
		{
			//如果有传参，则用ajax调用数据，get_regions_response方式为回调函数
			Ajax.call('region_city.php', 'act=get_regions&level='+level+'&rid=' + rid , get_regions_response, 'GET', 'JSON');
		}
     }
	 
     function get_regions_response(result)
     {	
	 /*存储在cookie，根据实际应用来选择是否需要，去掉对js没有影响
	  */
		 if(result.cookeinfo){
			 document.cookie=result.cookeinfo.key+"="+result.cookeinfo.value;
			 for(i=1;i<=5;i++){
				 if(i>=result.level){
					  document.cookie="region_"+i+"=0";
				 }
			 }
		 }
		 /*查询出来的列表是空，说明没有下级分类，则页面刷新
	 	 */
		 if(result.result == ''){
			 location.reload();
		 }
		  /*将查询出来的列表，也就是result.result，加载到相应的div中
	 	 */
		 var obj_num = $('.region-items').length;
		 for(var i=1;i<=obj_num;i++){
			 $('#city_box_'+i).hide();
			 $('#city_li_'+i).attr('class','li');
			 if(result.level == i && result.result!=''){
				$('#city_li_'+i).attr('class','licur').html('请选择').show();
				$('#city_box_'+i).html(result.result).show();
			 }else if(result.level < i){
				 $('#city_li_'+i).hide();
			 }
		 }
		 $('#city_li_'+(--result.level)).html(result.parent_name).show();
      }