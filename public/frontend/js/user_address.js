// JavaScript Document
function set_default(address_id) {
	$.ajax({
		type: 'GET',
		url: '/user/address/set-default',
		data: {
			address_id: address_id
		},
		dataType: 'json',
		success: function(result) {
			if (result.code == 0) {
				$.msg(result.message, {
					time: 1000
				}, function() {
					$.go(window.location.href);
				});
			} else {
				$.msg(result.message);
			}
		}
	});
}

function add() {
	$.loading.start();
	$.ajax({
		type: 'GET',
		url: '/user/address/add',
		dataType: 'json',
		success: function(data) {
			if (data.code == 0) {
				$('#edit-address-div').html(data.data);
			}
		}
	}).always(function() {
		$.loading.stop();
	});
}

function cancel() {
	$('#edit-address-div').html('');
}

function edit(address_id) {
	$.ajax({
		type: 'GET',
		url: '/user/address/edit',
		data: {
			address_id: address_id
		},
		dataType: 'json',
		success: function(data) {
			if (data.code == 0) {
				$('#edit-address-div').html(data.data);
			}
		}
	});
}

function del(address_id) {

	$.confirm("您确定要删除此收货地址吗？", function() {
		$.ajax({
			type: 'GET',
			url: '/user/address/del',
			data: {
				address_id: address_id
			},
			dataType: 'json',
			success: function(result) {
				if (result.code == 0) {
					$.msg(result.message, {
						time: 1000
					}, function() {
						$.go(window.location.href);
					});
				} else {
					$.msg(result.message);
				}
			}
		});
	});
}