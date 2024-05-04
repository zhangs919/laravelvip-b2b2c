<form id="{{ $uuid }}" class="form-horizontal" name="ComplaintModel" action="/trade/complaint/edit?id={{ $info->complaint_id }}" method="post">
    @csrf
    
    <!-- 店铺信誉 -->
    <div class="simple-form-field" >
        <div class="form-group">
            <label for="complaintmodel-complaint_true" class="col-sm-3 control-label">

                <span class="ng-binding">投诉结果：</span>
            </label>
            <div class="col-sm-9">
                <div class="form-control-box">

                    <input type="hidden" name="ComplaintModel[complaint_true]" value=""><div id="complaintmodel-complaint_true" class="" name="ComplaintModel[complaint_true]" selection="1"><label class="control-label cur-p m-r-10"><input type="radio" name="ComplaintModel[complaint_true]" value="1" checked> 投诉成立</label>
                        <label class="control-label cur-p m-r-10"><input type="radio" name="ComplaintModel[complaint_true]" value="0"> 投诉不成立</label></div>

                </div>

                <div class="help-block help-block-t"></div>
            </div>
        </div>
    </div>
    <div class=" deduct">
        <!-- 店铺信誉 -->
        <div class="simple-form-field" >
            <div class="form-group">
                <label for="complaintmodel-deduct_credit" class="col-sm-3 control-label">
                    <span class="text-danger ng-binding">*</span>
                    <span class="ng-binding">店铺扣分：</span>
                </label>
                <div class="col-sm-9">
                    <div class="form-control-box">


                        <input type="text" id="complaintmodel-deduct_credit" class="form-control ipt m-r-10" name="ComplaintModel[deduct_credit]" placeholder="">分


                    </div>

                    <div class="help-block help-block-t"></div>
                </div>
            </div>
        </div>
    </div>
    <div class=" deduct">
        <!-- 店铺罚款 -->
        <div class="simple-form-field" >
            <div class="form-group">
                <label for="complaintmodel-deduct_money" class="col-sm-3 control-label">
                    <span class="text-danger ng-binding">*</span>
                    <span class="ng-binding">店铺罚款：</span>
                </label>
                <div class="col-sm-9">
                    <div class="form-control-box">


                        <input type="text" id="complaintmodel-deduct_money" class="form-control ipt m-r-10" name="ComplaintModel[deduct_money]" placeholder="">元


                    </div>

                    <div class="help-block help-block-t"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="help-block help-block-t col-sm-9 col-md-offset-3" style="margin-top: -20px; margin-bottom: 10px;">投诉成立，裁决后处罚立即生效，店铺罚款在线下处理；投诉不成立，裁决后将不会影响店铺的纠纷数据</div>

    <!-- 投诉说明 -->
    <div class="simple-form-field" >
        <div class="form-group">
            <label for="complaintmodel-complaint_desc" class="col-sm-3 control-label">
                <span class="text-danger ng-binding">*</span>
                <span class="ng-binding">回复内容：</span>
            </label>
            <div class="col-sm-9">
                <div class="form-control-box">

                    <textarea id="complaintmodel-complaint_desc" class="form-control" name="ComplaintModel[complaint_desc]" rows="5" placeholder="请输入留言内容，该留言为公开信息，买家和平台方均可见"></textarea>

                </div>

                <div class="help-block help-block-t"></div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <input type='hidden' name='ComplaintModel[complaint_id]' value="{{ $info->complaint_id }}">
        <input type="button" id="btn_validate" class="btn btn-primary btn_validate" value="确定">
        </button>
        <input type="button" class="btn btn-default" data-dismiss="modal" value="取消">
        </button>

    </div>
</form>
<script id="clientRules_{{ $uuid }}" type="text">
[{"id": "complaintmodel-complaint_desc", "name": "ComplaintModel[complaint_desc]", "attribute": "complaint_desc", "rules": {"required":true,"messages":{"required":"回复内容不能为空。"}}},{"id": "complaintmodel-deduct_money", "name": "ComplaintModel[deduct_money]", "attribute": "deduct_money", "rules": {"required":true,"messages":{"required":"店铺罚款不能为空。"}}},{"id": "complaintmodel-deduct_credit", "name": "ComplaintModel[deduct_credit]", "attribute": "deduct_credit", "rules": {"required":true,"messages":{"required":"店铺扣分不能为空。"}}},{"id": "complaintmodel-complaint_id", "name": "ComplaintModel[complaint_id]", "attribute": "complaint_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"投诉ID必须是整数。"}}},{"id": "complaintmodel-order_id", "name": "ComplaintModel[order_id]", "attribute": "order_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"投诉的订单ID必须是整数。"}}},{"id": "complaintmodel-goods_id", "name": "ComplaintModel[goods_id]", "attribute": "goods_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"投诉的商品ID必须是整数。"}}},{"id": "complaintmodel-sku_id", "name": "ComplaintModel[sku_id]", "attribute": "sku_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Sku ID必须是整数。"}}},{"id": "complaintmodel-shop_id", "name": "ComplaintModel[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"投诉的店铺ID必须是整数。"}}},{"id": "complaintmodel-user_id", "name": "ComplaintModel[user_id]", "attribute": "user_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"投诉的用户ID必须是整数。"}}},{"id": "complaintmodel-parent_id", "name": "ComplaintModel[parent_id]", "attribute": "parent_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"上级投诉ID必须是整数。"}}},{"id": "complaintmodel-role_type", "name": "ComplaintModel[role_type]", "attribute": "role_type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"角色类型必须是整数。"}}},{"id": "complaintmodel-complaint_type", "name": "ComplaintModel[complaint_type]", "attribute": "complaint_type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"投诉原因必须是整数。"}}},{"id": "complaintmodel-complaint_status", "name": "ComplaintModel[complaint_status]", "attribute": "complaint_status", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"投诉处理状态必须是整数。"}}},{"id": "complaintmodel-add_time", "name": "ComplaintModel[add_time]", "attribute": "add_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"创建时间必须是整数。"}}},{"id": "complaintmodel-complaint_mobile", "name": "ComplaintModel[complaint_mobile]", "attribute": "complaint_mobile", "rules": {"string":true,"messages":{"string":"联系电话必须是一条字符串。","maxlength":"联系电话只能包含至多20个字符。"},"maxlength":20}},{"id": "complaintmodel-complaint_images", "name": "ComplaintModel[complaint_images]", "attribute": "complaint_images", "rules": {"string":true,"messages":{"string":"上传投诉凭证图片必须是一条字符串。","maxlength":"上传投诉凭证图片只能包含至多500个字符。"},"maxlength":500}},{"id": "complaintmodel-complaint_desc", "name": "ComplaintModel[complaint_desc]", "attribute": "complaint_desc", "rules": {"string":true,"messages":{"string":"回复内容必须是一条字符串。","maxlength":"回复内容只能包含至多1,500个字符。"},"maxlength":1500}},{"id": "complaintmodel-deduct_credit", "name": "ComplaintModel[deduct_credit]", "attribute": "deduct_credit", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"店铺扣分必须是整数。","min":"店铺扣分必须不小于0。"},"min":0}},{"id": "complaintmodel-deduct_money", "name": "ComplaintModel[deduct_money]", "attribute": "deduct_money", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"店铺罚款必须是一个数字。","min":"店铺罚款必须不小于0。"},"min":0}},{"id": "complaintmodel-complaint_true", "name": "ComplaintModel[complaint_true]", "attribute": "complaint_true", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"投诉结果必须是整数。"}}},{"id": "complaintmodel-deduct_money", "name": "ComplaintModel[deduct_money]", "attribute": "deduct_money", "rules": {"match":{"pattern":/^[0-9]+(.[0-9]{1,2})?$/,"not":false,"skipOnEmpty":1},"messages":{"match":"店铺罚款最多两位小数。"}}},]
</script>
<script type="text/javascript">
    $().ready(function() {
        var validator = $("#{{ $uuid }}").validate();
// 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules($("#clientRules_{{ $uuid }}").html());

        $("#{{ $uuid }}").find(".btn_validate").click(function() {
            if (!validator.form()) {
                return false;
            }
            $.loading.start();
            var data = $("#{{ $uuid }}").serializeJson();
            $(this).addClass("disabled");

            $.post('/trade/complaint/edit', data, function(result) {
                if (result.code == 0) {
                    $.go("/trade/complaint/list");
                    if (typeof (tablelist) !== 'undefined') {
                        tablelist.load();
                    }
                }
                $.loading.stop();
                $.msg(result.message);
            }, "json");
        });

        $("input:radio").click(function() {
            if ($(this).val() == 0) {
                $('.deduct').hide();
                $('.deduct').find('input').val('0');
            } else {
                $('.deduct').show();
            }
        });
    });
</script>