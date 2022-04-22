<!--点击按钮为表格增加行-->
<script id="opentime_template" type="text">
<div class="time-subtime">
	<div class="time-select">
		<select name="shippingtime[begin_hour][]" class="select form-control m-r-5">
			<!--   -->
			<option value="0">00</option>
			<!--   -->
			<option value="1">01</option>
			<!--   -->
			<option value="2">02</option>
			<!--   -->
			<option value="3">03</option>
			<!--   -->
			<option value="4">04</option>
			<!--   -->
			<option value="5">05</option>
			<!--   -->
			<option value="6">06</option>
			<!--   -->
			<option value="7">07</option>
			<!--   -->
			<option value="8">08</option>
			<!--   -->
			<option value="9">09</option>
			<!--   -->
			<option value="10">10</option>
			<!--   -->
			<option value="11">11</option>
			<!--   -->
			<option value="12">12</option>
			<!--   -->
			<option value="13">13</option>
			<!--   -->
			<option value="14">14</option>
			<!--   -->
			<option value="15">15</option>
			<!--   -->
			<option value="16">16</option>
			<!--   -->
			<option value="17">17</option>
			<!--   -->
			<option value="18">18</option>
			<!--   -->
			<option value="19">19</option>
			<!--   -->
			<option value="20">20</option>
			<!--   -->
			<option value="21">21</option>
			<!--   -->
			<option value="22">22</option>
			<!--   -->
			<option value="23">23</option>

		</select>
		:
		<select name="shippingtime[begin_minute][]" class="select form-control m-l-5">
			<!--   -->

			<option value="0">00</option>

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<option value="5">05</option>

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<option value="10">10</option>

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<option value="15">15</option>

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<option value="20">20</option>

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<option value="25">25</option>

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<option value="30">30</option>

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<option value="35">35</option>

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<option value="40">40</option>

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<option value="45">45</option>

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<option value="50">50</option>

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<option value="55">55</option>

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<option value="59">59</option>


		</select>
	</div>
	<div class="time-select">
		<select name="shippingtime[end_hour][]" class="select form-control m-r-5">
			<!--   -->
			<option value="0">00</option>
			<!--   -->
			<option value="1">01</option>
			<!--   -->
			<option value="2">02</option>
			<!--   -->
			<option value="3">03</option>
			<!--   -->
			<option value="4">04</option>
			<!--   -->
			<option value="5">05</option>
			<!--   -->
			<option value="6">06</option>
			<!--   -->
			<option value="7">07</option>
			<!--   -->
			<option value="8">08</option>
			<!--   -->
			<option value="9">09</option>
			<!--   -->
			<option value="10">10</option>
			<!--   -->
			<option value="11">11</option>
			<!--   -->
			<option value="12">12</option>
			<!--   -->
			<option value="13">13</option>
			<!--   -->
			<option value="14">14</option>
			<!--   -->
			<option value="15">15</option>
			<!--   -->
			<option value="16">16</option>
			<!--   -->
			<option value="17">17</option>
			<!--   -->
			<option value="18">18</option>
			<!--   -->
			<option value="19">19</option>
			<!--   -->
			<option value="20">20</option>
			<!--   -->
			<option value="21">21</option>
			<!--   -->
			<option value="22">22</option>
			<!--   -->
			<option value="23">23</option>

		</select>
		:
		<select name="shippingtime[end_minute][]" class="select form-control m-l-5">
			<!--   -->

			<option value="0">00</option>

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<option value="5">05</option>

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<option value="10">10</option>

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<option value="15">15</option>

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<option value="20">20</option>

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<option value="25">25</option>

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<option value="30">30</option>

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<option value="35">35</option>

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<option value="40">40</option>

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<option value="45">45</option>

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<option value="50">50</option>

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<option value="55">55</option>

			<!--   -->

			<!--   -->

			<!--   -->

			<!--   -->

			<option value="59">59</option>


		</select>
	</div>
	<div class="handle">
		<a id="del_opentime" class="c-blue" href="javascript:void(0);">删除</a>
	</div>
</div>
</script>



<!-- 表单验证 -->
<script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20190105"></script>
<script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20190105"></script>
<script src="/assets/d2eace91/js/validate/messages_zh.js?v=20190105"></script>
<!-- AJAX上传+图片预览 -->
<script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=20190105"></script>
<script src="/assets/d2eace91/js/pic/imgPreview.js?v=20190105"></script>
<script src="/assets/d2eace91/js/jquery.widget.js?v=20190105"></script>
<!-- 验证规则 -->
<script id="client_rules" type="text">
[{"id": "systemconfigmodel-shipping_time", "name": "SystemConfigModel[shipping_time]", "attribute": "shipping_time", "rules": {"string":true,"messages":{"string":"指定送货时间段必须是一条字符串。"}}},{"id": "systemconfigmodel-shipping_time", "name": "SystemConfigModel[shipping_time]", "attribute": "shipping_time", "rules": {"string":true,"messages":{"string":"指定送货时间段必须是一条字符串。"}}},{"id": "systemconfigmodel-send_time_desc", "name": "SystemConfigModel[send_time_desc]", "attribute": "send_time_desc", "rules": {"string":true,"messages":{"string":"送货时间描述必须是一条字符串。"}}},{"id": "systemconfigmodel-send_time_desc", "name": "SystemConfigModel[send_time_desc]", "attribute": "send_time_desc", "rules": {"string":true,"messages":{"string":"送货时间描述必须是一条字符串。","maxlength":"送货时间描述只能包含至多30个字符。"},"maxlength":30}},{"id": "systemconfigmodel-invoice_contents", "name": "SystemConfigModel[invoice_contents]", "attribute": "invoice_contents", "rules": {"string":true,"messages":{"string":"发票内容必须是一条字符串。"}}},{"id": "systemconfigmodel-shipping_name", "name": "SystemConfigModel[shipping_name]", "attribute": "shipping_name", "rules": {"string":true,"messages":{"string":"配送方式名称必须是一条字符串。"}}},{"id": "systemconfigmodel-shipping_name", "name": "SystemConfigModel[shipping_name]", "attribute": "shipping_name", "rules": {"string":true,"messages":{"string":"配送方式名称必须是一条字符串。","maxlength":"配送方式名称只能包含至多10个字符。"},"maxlength":10}},{"id": "systemconfigmodel-self_shipping_name", "name": "SystemConfigModel[self_shipping_name]", "attribute": "self_shipping_name", "rules": {"string":true,"messages":{"string":"必须是一条字符串。"}}},{"id": "systemconfigmodel-self_shipping_name", "name": "SystemConfigModel[self_shipping_name]", "attribute": "self_shipping_name", "rules": {"string":true,"messages":{"string":"必须是一条字符串。","maxlength":"只能包含至多10个字符。"},"maxlength":10}},{"id": "systemconfigmodel-pay_by_integral", "name": "SystemConfigModel[pay_by_integral]", "attribute": "pay_by_integral", "rules": {"string":true,"messages":{"string":"能否使用积分支付必须是一条字符串。"}}},{"id": "systemconfigmodel-pay_term_unit", "name": "SystemConfigModel[pay_term_unit]", "attribute": "pay_term_unit", "rules": {"string":true,"messages":{"string":"付款期限单位必须是一条字符串。"}}},{"id": "systemconfigmodel-pay_term", "name": "SystemConfigModel[pay_term]", "attribute": "pay_term", "rules": {"string":true,"messages":{"string":"付款期限必须是一条字符串。"}}},{"id": "systemconfigmodel-pay_term", "name": "SystemConfigModel[pay_term]", "attribute": "pay_term", "rules": {"required":true,"messages":{"required":"付款期限不能为空。"}}},{"id": "systemconfigmodel-pay_term", "name": "SystemConfigModel[pay_term]", "attribute": "pay_term", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"付款期限必须是整数。","min":"付款期限不能小于15分钟"},"min":15,"when":"function(){return $(\"#systemconfigmodel-pay_term_unit\").val() == 2;}"}},{"id": "systemconfigmodel-pay_term", "name": "SystemConfigModel[pay_term]", "attribute": "pay_term", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"付款期限必须是整数。","min":"付款期限必须不小于1。"},"min":1,"when":"function(){return $(\"#systemconfigmodel-pay_term_unit\").val() != 2;}"}},{"id": "systemconfigmodel-pay_term_unit", "name": "SystemConfigModel[pay_term_unit]", "attribute": "pay_term_unit", "rules": {"trigger":{"selector":"#systemconfigmodel-pay_term"},"messages":[]}},{"id": "systemconfigmodel-take_term_unit", "name": "SystemConfigModel[take_term_unit]", "attribute": "take_term_unit", "rules": {"string":true,"messages":{"string":"接单期限单位必须是一条字符串。"}}},{"id": "systemconfigmodel-take_term", "name": "SystemConfigModel[take_term]", "attribute": "take_term", "rules": {"string":true,"messages":{"string":"接单期限必须是一条字符串。"}}},{"id": "systemconfigmodel-take_term", "name": "SystemConfigModel[take_term]", "attribute": "take_term", "rules": {"required":true,"messages":{"required":"接单期限不能为空。"}}},{"id": "systemconfigmodel-take_term", "name": "SystemConfigModel[take_term]", "attribute": "take_term", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"接单期限必须是整数。","min":"接单期限不能小于5分钟"},"min":5,"when":"function(){return $(\"#systemconfigmodel-take_term_unit\").val() == 2;}"}},{"id": "systemconfigmodel-take_term", "name": "SystemConfigModel[take_term]", "attribute": "take_term", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"接单期限必须是整数。","min":"接单期限必须不小于1。"},"min":1,"when":"function(){return $(\"#systemconfigmodel-take_term_unit\").val() != 2;}"}},{"id": "systemconfigmodel-take_term_unit", "name": "SystemConfigModel[take_term_unit]", "attribute": "take_term_unit", "rules": {"trigger":{"selector":"#systemconfigmodel-take_term"},"messages":[]}},{"id": "systemconfigmodel-receiving_term", "name": "SystemConfigModel[receiving_term]", "attribute": "receiving_term", "rules": {"string":true,"messages":{"string":"确认收货期限必须是一条字符串。"}}},{"id": "systemconfigmodel-receiving_term", "name": "SystemConfigModel[receiving_term]", "attribute": "receiving_term", "rules": {"required":true,"messages":{"required":"确认收货期限不能为空。"}}},{"id": "systemconfigmodel-receiving_term", "name": "SystemConfigModel[receiving_term]", "attribute": "receiving_term", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"确认收货期限必须是整数。","min":"确认收货期限必须不小于0。"},"min":0}},{"id": "systemconfigmodel-extend_receiving_days", "name": "SystemConfigModel[extend_receiving_days]", "attribute": "extend_receiving_days", "rules": {"string":true,"messages":{"string":"延长收货时间(天)必须是一条字符串。"}}},{"id": "systemconfigmodel-extend_receiving_days", "name": "SystemConfigModel[extend_receiving_days]", "attribute": "extend_receiving_days", "rules": {"required":true,"messages":{"required":"延长收货时间(天)不能为空。"}}},{"id": "systemconfigmodel-extend_receiving_days", "name": "SystemConfigModel[extend_receiving_days]", "attribute": "extend_receiving_days", "rules": {"match":{"pattern":/^[0-9,\n,\r]+$/,"not":false,"skipOnEmpty":1},"messages":{"match":"只能输入整数或回车"}}},{"id": "systemconfigmodel-user_close_trad_reason", "name": "SystemConfigModel[user_close_trad_reason]", "attribute": "user_close_trad_reason", "rules": {"string":true,"messages":{"string":"买家关闭交易的理由必须是一条字符串。"}}},{"id": "systemconfigmodel-user_close_trad_reason", "name": "SystemConfigModel[user_close_trad_reason]", "attribute": "user_close_trad_reason", "rules": {"required":true,"messages":{"required":"买家关闭交易的理由不能为空。"}}},{"id": "systemconfigmodel-close_trad_reason", "name": "SystemConfigModel[close_trad_reason]", "attribute": "close_trad_reason", "rules": {"string":true,"messages":{"string":"卖家关闭交易的理由必须是一条字符串。"}}},{"id": "systemconfigmodel-close_trad_reason", "name": "SystemConfigModel[close_trad_reason]", "attribute": "close_trad_reason", "rules": {"required":true,"messages":{"required":"卖家关闭交易的理由不能为空。"}}},{"id": "systemconfigmodel-is_refund_review", "name": "SystemConfigModel[is_refund_review]", "attribute": "is_refund_review", "rules": {"string":true,"messages":{"string":"退款申请是否需要审核必须是一条字符串。"}}},{"id": "systemconfigmodel-back_seller_term", "name": "SystemConfigModel[back_seller_term]", "attribute": "back_seller_term", "rules": {"string":true,"messages":{"string":"申请退款卖家确认期限必须是一条字符串。"}}},{"id": "systemconfigmodel-back_seller_term", "name": "SystemConfigModel[back_seller_term]", "attribute": "back_seller_term", "rules": {"required":true,"messages":{"required":"申请退款卖家确认期限不能为空。"}}},{"id": "systemconfigmodel-back_seller_term", "name": "SystemConfigModel[back_seller_term]", "attribute": "back_seller_term", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"申请退款卖家确认期限必须是整数。","min":"申请退款卖家确认期限必须不小于0。"},"min":0}},{"id": "systemconfigmodel-buyer_update_back_term", "name": "SystemConfigModel[buyer_update_back_term]", "attribute": "buyer_update_back_term", "rules": {"string":true,"messages":{"string":"卖家拒绝退款申请，买家修改退款期限必须是一条字符串。"}}},{"id": "systemconfigmodel-buyer_update_back_term", "name": "SystemConfigModel[buyer_update_back_term]", "attribute": "buyer_update_back_term", "rules": {"required":true,"messages":{"required":"卖家拒绝退款申请，买家修改退款期限不能为空。"}}},{"id": "systemconfigmodel-buyer_update_back_term", "name": "SystemConfigModel[buyer_update_back_term]", "attribute": "buyer_update_back_term", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"卖家拒绝退款申请，买家修改退款期限必须是整数。","min":"卖家拒绝退款申请，买家修改退款期限必须不小于0。"},"min":0}},{"id": "systemconfigmodel-back_buyer_send_term", "name": "SystemConfigModel[back_buyer_send_term]", "attribute": "back_buyer_send_term", "rules": {"string":true,"messages":{"string":"退款退货买家发货期限必须是一条字符串。"}}},{"id": "systemconfigmodel-back_buyer_send_term", "name": "SystemConfigModel[back_buyer_send_term]", "attribute": "back_buyer_send_term", "rules": {"required":true,"messages":{"required":"退款退货买家发货期限不能为空。"}}},{"id": "systemconfigmodel-back_buyer_send_term", "name": "SystemConfigModel[back_buyer_send_term]", "attribute": "back_buyer_send_term", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"退款退货买家发货期限必须是整数。","min":"退款退货买家发货期限必须不小于0。"},"min":0}},{"id": "systemconfigmodel-back_seller_recive_term", "name": "SystemConfigModel[back_seller_recive_term]", "attribute": "back_seller_recive_term", "rules": {"string":true,"messages":{"string":"退款退货卖家确认收货期限必须是一条字符串。"}}},{"id": "systemconfigmodel-back_seller_recive_term", "name": "SystemConfigModel[back_seller_recive_term]", "attribute": "back_seller_recive_term", "rules": {"required":true,"messages":{"required":"退款退货卖家确认收货期限不能为空。"}}},{"id": "systemconfigmodel-back_seller_recive_term", "name": "SystemConfigModel[back_seller_recive_term]", "attribute": "back_seller_recive_term", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"退款退货卖家确认收货期限必须是整数。","min":"退款退货卖家确认收货期限必须不小于0。"},"min":0}},{"id": "systemconfigmodel-refund_reason", "name": "SystemConfigModel[refund_reason]", "attribute": "refund_reason", "rules": {"string":true,"messages":{"string":"申请退款的原因必须是一条字符串。"}}},{"id": "systemconfigmodel-refund_reason", "name": "SystemConfigModel[refund_reason]", "attribute": "refund_reason", "rules": {"required":true,"messages":{"required":"申请退款的原因不能为空。"}}},{"id": "systemconfigmodel-customer_service_term", "name": "SystemConfigModel[customer_service_term]", "attribute": "customer_service_term", "rules": {"string":true,"messages":{"string":"申请售后期限必须是一条字符串。"}}},{"id": "systemconfigmodel-customer_service_term", "name": "SystemConfigModel[customer_service_term]", "attribute": "customer_service_term", "rules": {"required":true,"messages":{"required":"申请售后期限不能为空。"}}},{"id": "systemconfigmodel-customer_service_term", "name": "SystemConfigModel[customer_service_term]", "attribute": "customer_service_term", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"申请售后期限必须是整数。","min":"申请售后期限必须不小于0。"},"min":0}},{"id": "systemconfigmodel-seller_service_term", "name": "SystemConfigModel[seller_service_term]", "attribute": "seller_service_term", "rules": {"string":true,"messages":{"string":"卖家处理售后期限必须是一条字符串。"}}},{"id": "systemconfigmodel-seller_service_term", "name": "SystemConfigModel[seller_service_term]", "attribute": "seller_service_term", "rules": {"required":true,"messages":{"required":"卖家处理售后期限不能为空。"}}},{"id": "systemconfigmodel-seller_service_term", "name": "SystemConfigModel[seller_service_term]", "attribute": "seller_service_term", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"卖家处理售后期限必须是整数。","min":"卖家处理售后期限必须不小于0。"},"min":0}},{"id": "systemconfigmodel-customer_modify_service_term", "name": "SystemConfigModel[customer_modify_service_term]", "attribute": "customer_modify_service_term", "rules": {"string":true,"messages":{"string":"卖家拒绝售后申请，买家修改期限必须是一条字符串。"}}},{"id": "systemconfigmodel-customer_modify_service_term", "name": "SystemConfigModel[customer_modify_service_term]", "attribute": "customer_modify_service_term", "rules": {"required":true,"messages":{"required":"卖家拒绝售后申请，买家修改期限不能为空。"}}},{"id": "systemconfigmodel-customer_modify_service_term", "name": "SystemConfigModel[customer_modify_service_term]", "attribute": "customer_modify_service_term", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"卖家拒绝售后申请，买家修改期限必须是整数。","min":"卖家拒绝售后申请，买家修改期限必须不小于0。"},"min":0}},{"id": "systemconfigmodel-customer_finish_service_term", "name": "SystemConfigModel[customer_finish_service_term]", "attribute": "customer_finish_service_term", "rules": {"string":true,"messages":{"string":"买家完成售后期限必须是一条字符串。"}}},{"id": "systemconfigmodel-customer_finish_service_term", "name": "SystemConfigModel[customer_finish_service_term]", "attribute": "customer_finish_service_term", "rules": {"required":true,"messages":{"required":"买家完成售后期限不能为空。"}}},{"id": "systemconfigmodel-customer_finish_service_term", "name": "SystemConfigModel[customer_finish_service_term]", "attribute": "customer_finish_service_term", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"买家完成售后期限必须是整数。","min":"买家完成售后期限必须不小于0。"},"min":0}},{"id": "systemconfigmodel-repair_reason", "name": "SystemConfigModel[repair_reason]", "attribute": "repair_reason", "rules": {"string":true,"messages":{"string":"申请维修的原因必须是一条字符串。"}}},{"id": "systemconfigmodel-repair_reason", "name": "SystemConfigModel[repair_reason]", "attribute": "repair_reason", "rules": {"required":true,"messages":{"required":"申请维修的原因不能为空。"}}},{"id": "systemconfigmodel-exchange_reason", "name": "SystemConfigModel[exchange_reason]", "attribute": "exchange_reason", "rules": {"string":true,"messages":{"string":"申请换货的原因必须是一条字符串。"}}},{"id": "systemconfigmodel-exchange_reason", "name": "SystemConfigModel[exchange_reason]", "attribute": "exchange_reason", "rules": {"required":true,"messages":{"required":"申请换货的原因不能为空。"}}},{"id": "systemconfigmodel-complaint_seller_term", "name": "SystemConfigModel[complaint_seller_term]", "attribute": "complaint_seller_term", "rules": {"string":true,"messages":{"string":"投诉卖家期限必须是一条字符串。"}}},{"id": "systemconfigmodel-complaint_seller_term", "name": "SystemConfigModel[complaint_seller_term]", "attribute": "complaint_seller_term", "rules": {"required":true,"messages":{"required":"投诉卖家期限不能为空。"}}},{"id": "systemconfigmodel-complaint_seller_term", "name": "SystemConfigModel[complaint_seller_term]", "attribute": "complaint_seller_term", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"投诉卖家期限必须是整数。","min":"投诉卖家期限必须不小于0。"},"min":0}},{"id": "systemconfigmodel-seller_ps_complain_term", "name": "SystemConfigModel[seller_ps_complain_term]", "attribute": "seller_ps_complain_term", "rules": {"string":true,"messages":{"string":"卖家处理投诉期限必须是一条字符串。"}}},{"id": "systemconfigmodel-seller_ps_complain_term", "name": "SystemConfigModel[seller_ps_complain_term]", "attribute": "seller_ps_complain_term", "rules": {"required":true,"messages":{"required":"卖家处理投诉期限不能为空。"}}},{"id": "systemconfigmodel-seller_ps_complain_term", "name": "SystemConfigModel[seller_ps_complain_term]", "attribute": "seller_ps_complain_term", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"卖家处理投诉期限必须是整数。","min":"卖家处理投诉期限必须不小于0。"},"min":0}},{"id": "systemconfigmodel-complaint_reason", "name": "SystemConfigModel[complaint_reason]", "attribute": "complaint_reason", "rules": {"string":true,"messages":{"string":"投诉卖家的原因必须是一条字符串。"}}},{"id": "systemconfigmodel-complaint_reason", "name": "SystemConfigModel[complaint_reason]", "attribute": "complaint_reason", "rules": {"required":true,"messages":{"required":"投诉卖家的原因不能为空。"}}},]
</script>


<script type="text/javascript">
    // $('#shipping_time_box').parents('.simple-form-field').hide();

    $().ready(function() {
        var validator = $("#SystemConfigModel").validate();
        // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules($("#client_rules").html());
        $("#btn_submit").click(function() {

            var data = $("#SystemConfigModel").serializeJson();
            // 获取配送时间
            var shipping_time = data.shippingtime;

            //数据转化json
            var shipping_time_json = JSON.stringify(shipping_time);

            $('#systemconfigmodel-shipping_time').val(shipping_time_json);

            validator.form();
            if (!validator.form()) {
                return;
            }
            $.loading.start();
            $("#SystemConfigModel").submit();
        });

        // 新建配送时间
        $("body").on("click", "#add_opentime", function() {
            //if ($(".time-subtime").length < 4) {
            var html = $("#opentime_template").html();
            var element = $($.parseHTML(html));
            element.insertBefore($(".add-btn"));
            //checkLength();
            //}
        });

        // 删除配送时间
        $("body").on("click", "#del_opentime", function() {
            var target = this;
            //$.confirm("您确定要删除当前营业时间吗？", function() {
            $(target).parent().parent().remove();
            //});
            //checkLength();
        });

        $('body').on("click", "[name='SystemConfigModel[send_time][]']", function() {
            if($(this).val() == 5){
                if($(this).is(':checked')){
                    $('#shipping_time_box').parents('.simple-form-field').show();
                }else{
                    $('#shipping_time_box').parents('.simple-form-field').hide();
                }
            }
        });


        // 配送时间不能超过三条
        function checkLength() {
            if ($(".time-subtime").length >= 4) {
                $("#add_opentime").addClass("disabled");
            } else {
                $("#add_opentime").removeClass("disabled");
            }
        }
        //checkLength();
    });
</script>