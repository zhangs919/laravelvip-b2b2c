$(function(){
	
	//店铺评分鼠标经过事件
	$(".shop-info").hover(function(){
		$('.extra-info').toggleClass('active');
    });
	
	//店铺手机版鼠标经过事件
    $(".mobile-shop").hover(function(){
		$(this).toggleClass('active');
    });
	
	//店铺全部分类鼠标经过事件
	$(".all-category").hover(function(){
		$(this).find('.all-category-coupon').show();
    },function(){
		$(this).find('.all-category-coupon').hide();
	});
	
	//客服鼠标经过事件
    $(".customer-service-box").hover(function(){
		$(this).toggleClass('active');
    });
	
	//左侧分类树点击展开收缩效果
	$('.tree li:has(ul)').addClass('parent_li');
    $('.tree li.parent_li > span').on('click', function (e) {
        var children = $(this).parent('li.parent_li').find(' > ul > li');
        if (children.is(":visible")) {
            children.hide('fast');
            $(this).find(' > i').addClass('icon-plus-sign').removeClass('icon-minus-sign');
        } else {
            children.show('fast');
            $(this).find(' > i').addClass('icon-minus-sign').removeClass('icon-plus-sign');
        }
        e.stopPropagation();
    });

	//筛选条件色块	
	 $('.color-value li span').click(function(){
			var seled_num = $(this).parents('ul').find('.selected').length;
			if(seled_num > 0){
				$(this).parents('dd').find('.select-button').eq(0).attr('class','select-button select-button-sumbit');	
			}else if(seled_num == 0){
				$(this).parents('dd').find('.select-button').eq(0).attr('class','select-button disabled');	
			}
		 })
		 $('.other-value li input[type="checkbox"]').bind('click',function(){
			 var seled_input_num = $(this).parents('ul').find('input[type="checkbox"]:checked').length;
			 if(seled_input_num>0){
				 $(this).parents('dd').find('.select-button').eq(0).attr('class','select-button select-button-sumbit');	
			 }else if(seled_input_num == 0){
				 $(this).parents('dd').find('.select-button').eq(0).attr('class','select-button disabled');
			 }
		 })  
		 
		 $('.collet-btn').click(function(){
		 $('.pop-login,.pop-mask').show();	
	});
	

	/*	var scroll_height = $('#filter').offset().top;
		$(window).scroll(function(){
			var this_scrollTop = $(this).scrollTop();
			if(this_scrollTop > scroll_height){
				$('#filter').addClass('filter-fixed').css({'left':($(window).width()-$('.filter-fixed').outerWidth())/2});
			}else{
				$('#filter').removeClass('filter-fixed').css('left','');	
			}
		});	
		*/
	
});

/**********************筛选条件部分***************************/
var attr_group_more_txt = "版本，屏幕尺寸，分辨率";
var begin_hidden=0;
	function init_position_left(){
		var kuan1=document.getElementById('attr-list-ul').clientWidth;
		var kuan2=document.getElementById('attr-group-more').clientWidth;
		var kuan =(kuan1-kuan2)/2;
		document.getElementById('attr-group-more').style.marginLeft=kuan+"px";
	}
	function getElementsByName(tagName, eName){  
		var tags = document.getElementsByTagName(tagName);  
		var returns = new Array();  
      	if (tags != null && tags.length > 0) {  
			for (var i = 0; i < tags.length; i++) {  
				if (tags[i].getAttribute("name") == eName) {  
					returns[returns.length] = tags[i];  
				}  
			}  
		}  
		return returns;  
	}
	function Show_More_Attrgroup(){
		var attr_list_dl = getElementsByName('dl','attr-group-dl');
		var attr_group_more_text = document.getElementById('attr-group-more-text');
		if(begin_hidden==2){
			for(var i=0;i<attr_list_dl.length;i++){
				attr_list_dl[i].style.display= i >= begin_hidden ? 'none' : 'block';
			}
			attr_group_more_text.innerHTML="更多选项（" + attr_group_more_txt + "）";
			attr_group_more_text.parentNode.width="224px";
			init_position_left();			
		
			begin_hidden=0;
		}else{
			for(var i=0;i<attr_list_dl.length;i++){
				attr_list_dl[i].style.display='block';				
			}
			attr_group_more_text.innerHTML="收起";
			attr_group_more_text.parentNode.width="44px";
			init_position_left();
			
			begin_hidden=2;
		}
	}
	// 是否显示“更多”__初始化
	function init_more(boxid, moreid, height){
	     var obj_brand=document.getElementById(boxid);
	     var more_brand = document.getElementById(moreid);
	     if (obj_brand.clientHeight > height){
			obj_brand.style.height= height+ "px";
			obj_brand.style.overflow="hidden";
			more_brand.innerHTML='<a href="javascript:void(0);"  onclick="slideDiv(this, \''+boxid+'\', \''+height+'\');" class="more" >更多</a>';
	     }
	 }
	 function slideDiv(thisobj, divID,Height){  
	     var obj=document.getElementById(divID).style;  
	     if(obj.height==""){  
         	obj.height= Height+ "px";  
         	obj.overflow="hidden";
	     	thisobj.innerHTML="更多";
	     	thisobj.className="more";
	        // 如果是品牌，额外处理
			if(divID=='brand-abox'){
			   //obj.width="456px";
			   getBrand_By_Zimu(document.getElementById('brand-zimu-all'),'');
			   document.getElementById('brand-sobox').style.display = "none";
			   document.getElementById('brand-zimu').style.display = "none";
			   document.getElementById('brand-abox-father').className="";
			}
         }else{  
         	obj.height="";  
         	obj.overflow="";  
	     	thisobj.innerHTML="收起";
	     	thisobj.className="more opened";
	        // 如果是品牌，额外处理

			if(divID=='brand-abox'){
			   //obj.width="456px";
				   document.getElementById('brand-sobox').style.display = "block";
			   document.getElementById('brand-zimu').style.display = "block";
			   //getBrand_By_Zimu(document.getElementById('brand-zimu-all'),'');
			   document.getElementById('brand-abox-father').className="brand-more";
			 }
	     }  
	}
	function getBrand_By_Name(val){
	    val =val.toLocaleLowerCase();
	    var brand_list = document.getElementById('brand-abox').getElementsByTagName('li');    
	    for(var i=0;i<brand_list.length;i++){
			//document.getElementById('brand-abox').style.width="auto";
			var name_attr_value= brand_list[i].getAttribute("name").toLocaleLowerCase();
			if(brand_list[i].title.indexOf(val)==0 || name_attr_value.indexOf(val)==0 || val==''){
				brand_list[i].style.display='block';
			}else{
				brand_list[i].style.display='none';
			}
	    }
	}
	//点击字母切换品牌
	function getBrand_By_Zimu(obj, zimu)
	{
		document.getElementById('brand-sobox-input').value="可搜索拼音、汉字查找品牌";
		obj.focus();
		var brand_zimu=document.getElementById('brand-zimu');
		var zimu_span_list = brand_zimu.getElementsByTagName('span');
		for(var i=0;i<zimu_span_list.length;i++){
			zimu_span_list[i].className='';
		}
		var thisspan=obj.parentNode;
		thisspan.className='span';
		var brand_list = document.getElementById('brand-abox').getElementsByTagName('li');			
		for(var i=0;i<brand_list.length;i++){	
			//document.getElementById('brand-abox').style.width="auto";
			if(brand_list[i].getAttribute('rel') == zimu || zimu==''){
				brand_list[i].style.display='block';
			}else{
				brand_list[i].style.display='none';
			}
		}
	}
	var duoxuan_a_valid=new Array();
	// 点击多选， 显示多选区
	function showDuoXuan(dx_divid, a_valid_id){	     
	     var dx_dl_68ecshop = document.getElementById('attr-list-ul').getElementsByTagName('dl');
	     for(var i=0;i<dx_dl_68ecshop.length;i++){
			dx_dl_68ecshop[i].className='';
			dx_dl_68ecshop[0].className='selected-attr-dl';
	     }
	     var dxDiv=document.getElementById(dx_divid);
	     dxDiv.className ="duoxuan";
	     duoxuan_a_valid[a_valid_id]=1;
	     
	}
	function hiddenDuoXuan(dx_divid, a_valid_id){
		var dxDiv=document.getElementById(dx_divid);
		dxDiv.className ="";
		duoxuan_a_valid[a_valid_id]=0;
		if(a_valid_id=='brand'){
			var ul_obj_68ecshop = document.getElementById('brand-abox');
			var li_list_68ecshop = ul_obj_68ecshop.getElementsByTagName('li');
			if(li_list_68ecshop){
				for(var j=0;j<li_list_68ecshop.length;j++){
					li_list_68ecshop[j].className="";
				}
			}
		}else{
			var ul_obj_68ecshop = document.getElementById('attr-abox-'+a_valid_id);
		}
		var input_list = ul_obj_68ecshop.getElementsByTagName('input');
		var span_list = ul_obj_68ecshop.getElementsByTagName('span');
		for(var j=0;j<input_list.length;j++){
			input_list[j].checked=false;
		}
		if(span_list.length){
			for(var j=0;j<span_list.length;j++){
				span_list[j].className="";
			}
		}
	}
	function duoxuan_Onclick(a_valid_id, idid, thisobj)
	{			
		if (duoxuan_a_valid[a_valid_id]){
			if (thisobj){	
				var fatherObj = thisobj.parentNode;
				if (a_valid_id =="brand"){
					fatherObj.className = fatherObj.className == "brand-seled" ? "" : "brand-seled";
					}else{
					fatherObj.className =   fatherObj.className == "" ? "selected" : "";
				}
			}
			document.getElementById('chk-'+a_valid_id+'-'+idid).checked= !document.getElementById('chk-'+a_valid_id+'-'+idid).checked;
			return false;
		}
	}
	
	function duoxuan_Submit(dxid, indexid, attr_count, category, brand_id, price_min, price_max,  filter_attr,filter)
	{		
		var theForm =document.forms['theForm'];
		var chklist=theForm.elements['checkbox_'+ dxid+'[]'];
		var newpara="";
		var mm=0;
		for(var k=0;k<chklist.length;k++){
			if(chklist[k].checked){
				//alert(chklist[k].value);
				newpara += mm>0 ? "_" : "";
				newpara += chklist[k].value;
				mm++;
			}
		}
		if (mm==0){
			return false;
		}
		if(dxid=='brand'){
			brand_id = newpara;
		}else{
			var attr_array = new Array();
			filter_attr = filter_attr.replace(/\./g,",");
			attr_array=filter_attr.split(',');
			for(var h=0;h<attr_count;h++){
				if(indexid == h){
					attr_array[indexid] = newpara;
				}else{
					if(attr_array[h]){
					}else{
					 attr_array[h] = 0;
					}
				}
			}
			filter_attr = attr_array.toString();
		}
		filter_attr = filter_attr.replace(/,/g,".");
		var url="other.php";
		//var url="category.php";
		url += "?id="+ category;
		url += brand_id ? "&brand="+brand_id : "";
		url += price_min ? "&price_min="+price_min : "&price_min=0";
		url += price_max ? "&price_max="+price_max : "&price_max=0";
		url += filter_attr ? "&filter_attr="+filter_attr : "&filter_attr=0";
		url += filter ? "&filter="+filter : "&filter=0";
		//location.href=url;
		return_url(url,dxid);
	}
	function return_url(url,dxid){
	  $.ajax({    
		    url:url,   
		    type:'get',
		    cache:false,
		    dataType:'text',
		    success:function(data){
		        var obj = document.getElementById('button-'+dxid);
		        obj.href = data;
			obj.click();
			//location.href=data;
		     }
		});
	}
 
/*************************************/

//筛选条件品牌
 $('#brand-abox li').click(function(){
			var seled_num = $(this).parent().find('.brand-seled').length;
			if(seled_num > 0){
				$(this).parents('dd').find('.select-button').eq(0).attr('class','select-button select-button-sumbit');	
			}else if(seled_num == 0){
				$(this).parents('dd').find('.select-button').eq(0).attr('class','select-button disabled');	
			}
});


//首页banner图轮播
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

$.each($('.banner'),function(){
	var a = $(this).find('.full-screen-slides li');
	var b = $(this).find('.full-screen-slides-pagination li');
	var c = 'current';
	var d = $(this).find('#fullScreenSlides');
	banner_play(a,b,c,d);//首页主广告轮播
});