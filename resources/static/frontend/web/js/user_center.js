// JavaScript Document
function show_surplus(user_id) {
	$.ajax({
		type: 'GET',
		url: '/user/center/get-surplus',
		data: {
			user_id: user_id
		},
		dataType: 'json',
		success: function(data) {
			if (data.code == 0) {
				$("#surplus_div").html(data.data)
			}
		}
	});
}
