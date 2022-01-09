/*!
 @Name：popbox 弹框
 @Author：梁蕾
 @data：2015-12-28
*/
$(function(){
	// 批量设置价格、库存、预警值
    $('.batch > .batch-edit').click(function(){
        $('.batch > .batch-input').hide();
        $(this).next().show();
    });
    $('.batch-input > .batch-close').click(function(){
        $(this).parent().hide();
    });
	
	// 商品描述手机端详情导入弹框
    $('.size-tip > .leading-in').click(function(){
        $('.size-tip > .build-mdetail').show();
		return false;
    });
    $('.size-tip').find('.btn-close').click(function(){
        $('.size-tip > .build-mdetail').hide();
		return false;
    });
	 $('.size-tip').find('.btn-default').click(function(){
        $('.size-tip > .build-mdetail').hide();
		return false;
    });
	
	
})