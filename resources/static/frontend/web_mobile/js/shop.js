$(function() {
	// 处理红包模板
	var bonus_ids = [];
	$.each($('.coupon-list'), function() {
		var bonus_id = $(this).data('bonus_id');
		if ($.inArray(bonus_id, bonus_ids) == -1) {
			bonus_ids.push(bonus_id);
		}
	});
	if (bonus_ids.length > 0) {

		$.get('/shop/bonus/bonus-info', {
			ids: bonus_ids
		}, function(result) {

		});
	}
});