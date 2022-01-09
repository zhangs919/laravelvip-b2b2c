// JavaScript Document 

$(function() {
	$('.add_selected').click(function(){
		var obj = $(this);
		if($(this).hasClass('addl-red')){
			return;
		}
		var address_id = $(this).data('address_id');
		$.loading.start();
		$.ajax({
			type: 'GET',
			url: '/user/address/set-default',
			data: {
				address_id: address_id
			},
			dataType: 'json',
			success: function(data) {
				$.loading.stop();
				if (data.code == 0) {
					$('.add_selected').removeClass('addl-red').addClass('addl-hui');
					obj.addClass('addl-red').removeClass('addl-hui');
				}
				$.msg(data.message);
			}
		});
	});
	
	// 删除收货地址
	$("body").on('click', '.address-delete', function() {
		var obj = $(this);
		var address_id = $(this).data('address_id');
		var box = $(this).parents(".address-add-box");
		$.confirm("您确定要删除此记录吗？", function() {
			$.get('/user/address/del', {
				address_id: address_id
			}, function(result) {
				if (result.code == 0) {
					box.remove();
					if(result.data == 0){
						window.location.reload();
					}
				}
				$.msg(result.message);
			}, "json");
		});
		return false;
	});
	
});





function add() {
	window.location.href = '/user/address/add.html?back_url=/user/address.html';
}


/* 修改地址 */

function edit(address_id) {
	window.location.href = '/user/address/edit.html?address_id='+address_id+'&back_url=/user/address.html';
}
