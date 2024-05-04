<form id="UserAddressModel" class="form-horizontal" name="UserAddressModel" action="/user/address/edit.html?address_id={{ $address_info->address_id }}" method="post">
    @csrf
    <input type="hidden" id="useraddressmodel-address_lng" class="address_lng" name="UserAddressModel[address_lng]" value="{{ $address_info->address_lng }}">
    <input type="hidden" id="useraddressmodel-address_lat" class="address_lat" name="UserAddressModel[address_lat]" value="{{ $address_info->address_lat }}">
    <div class="form-group form-group-spe" >
        <label for="useraddressmodel-consignee" class="input-left">
            <span class="spark">*</span>
            <span>收货人：</span>
        </label>
        <div class="form-control-box">

            <input type="text" id="useraddressmodel-consignee" class="form-control" name="UserAddressModel[consignee]" value="{{ $address_info->consignee }}">

        </div>

        <div class="invalid"></div>
    </div>

    <div class="form-group form-group-spe" >
        <label for="useraddressmodel-region_code" class="input-left">
            <span class="spark">*</span>
            <span>收货地址：</span>
        </label>
        <div class="form-control-box">

            <span id="region_code_containter" class="region-select"></span>
            <input type="hidden" id="region_code" name="UserAddressModel[region_code]" value="{{ $address_info->region_code }}">

        </div>

        <div class="invalid"></div>
    </div>

    <div class="form-group form-group-spe" >
        <label for="useraddressmodel-address_detail" class="input-left">
            <span class="spark">*</span>
            <span>详细地址：</span>
        </label>
        <div class="form-control-box">

            <textarea id="useraddressmodel-address_detail" class="form-control address_detail" name="UserAddressModel[address_detail]" rows="5" placeholder="建议您如实填写详细收货地址，例如街道名称，门牌号码，楼层和房间号等信息">{{ $address_info->address_detail }}</textarea>

        </div>

        <div class="invalid"></div>
    </div>

    <div class="form-group form-group-spe" >
        <label for="useraddressmodel-mobile" class="input-left">
            <span class="spark">*</span>
            <span>手机号码：</span>
        </label>
        <div class="form-control-box">

            <input type="text" id="useraddressmodel-mobile" class="form-control" name="UserAddressModel[mobile]" value="{{ $address_info->mobile }}" placeholder="手机号码">

        </div>

        <div class="invalid"></div>
    </div>

    <div class="form-group form-group-spe" >
        <label for="useraddressmodel-tel" class="input-left">

            <span>固定电话：</span>
        </label>
        <div class="form-control-box">

            <input type="text" id="useraddressmodel-tel" class="form-control" name="UserAddressModel[tel]" value="{{ $address_info->tel }}" placeholder="固定电话">

        </div>

        <div class="invalid"></div>
    </div>

    <div class="form-group form-group-spe" >
        <label for="useraddressmodel-email" class="input-left">

            <span>邮件地址：</span>
        </label>
        <div class="form-control-box">

            <input type="text" id="useraddressmodel-email" class="form-control" name="UserAddressModel[email]" value="{{ $address_info->email }}" placeholder="xxx@xx.xx">

        </div>

        <div class="invalid"></div>
    </div>
    <!--
    <div class="form-group form-group-spe">
    <label class="input-left">
    <span> </span>
    </label>
    <span class="checkbox">
    <label>
    <input type="checkbox" name="defaultAddress" >
    <span>设置为默认收货地址</span>
    </label>
    </span>
    </div>
    -->
    <div class="act">
        <input type="button" id="btn_save" value="保存收货地址">
        <input type="hidden" name="address_id" value="{{ $address_info->address_id }}">
        <input type="button" value="取消" class="m-l-10" onclick="cancel()">
    </div>
</form>
<div class="address-picker">
    <div id="map_container" class="amap-container"></div>
    <p class="map-footer" style="display: none;">
        <a href="javascript:;" class="save-map">保存位置</a>
        <a href="javascript:;" class="back-map">回原位置</a>
    </p>
</div>
<script id="client_rules" type="text">
[{"id": "useraddressmodel-region_code", "name": "UserAddressModel[region_code]", "attribute": "region_code", "rules": {"required":true,"messages":{"required":"收货地址不能为空。"}}},{"id": "useraddressmodel-user_id", "name": "UserAddressModel[user_id]", "attribute": "user_id", "rules": {"required":true,"messages":{"required":"用户ID不能为空。"}}},{"id": "useraddressmodel-consignee", "name": "UserAddressModel[consignee]", "attribute": "consignee", "rules": {"required":true,"messages":{"required":"收货人不能为空。"}}},{"id": "useraddressmodel-address_detail", "name": "UserAddressModel[address_detail]", "attribute": "address_detail", "rules": {"required":true,"messages":{"required":"详细地址不能为空。"}}},{"id": "useraddressmodel-mobile", "name": "UserAddressModel[mobile]", "attribute": "mobile", "rules": {"required":true,"messages":{"required":"手机号码不能为空。"}}},{"id": "useraddressmodel-user_id", "name": "UserAddressModel[user_id]", "attribute": "user_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"用户ID必须是整数。"}}},{"id": "useraddressmodel-address_name", "name": "UserAddressModel[address_name]", "attribute": "address_name", "rules": {"string":true,"messages":{"string":"地址别名必须是一条字符串。","maxlength":"地址别名只能包含至多60个字符。"},"maxlength":60}},{"id": "useraddressmodel-consignee", "name": "UserAddressModel[consignee]", "attribute": "consignee", "rules": {"string":true,"messages":{"string":"收货人必须是一条字符串。","maxlength":"收货人只能包含至多60个字符。"},"maxlength":60}},{"id": "useraddressmodel-email", "name": "UserAddressModel[email]", "attribute": "email", "rules": {"string":true,"messages":{"string":"邮件地址必须是一条字符串。","maxlength":"邮件地址只能包含至多60个字符。"},"maxlength":60}},{"id": "useraddressmodel-address_lng", "name": "UserAddressModel[address_lng]", "attribute": "address_lng", "rules": {"string":true,"messages":{"string":"地址经度必须是一条字符串。","maxlength":"地址经度只能包含至多60个字符。"},"maxlength":60}},{"id": "useraddressmodel-address_lat", "name": "UserAddressModel[address_lat]", "attribute": "address_lat", "rules": {"string":true,"messages":{"string":"地址纬度必须是一条字符串。","maxlength":"地址纬度只能包含至多60个字符。"},"maxlength":60}},{"id": "useraddressmodel-mobile", "name": "UserAddressModel[mobile]", "attribute": "mobile", "rules": {"string":true,"messages":{"string":"手机号码必须是一条字符串。","maxlength":"手机号码只能包含至多20个字符。"},"maxlength":20}},{"id": "useraddressmodel-tel", "name": "UserAddressModel[tel]", "attribute": "tel", "rules": {"string":true,"messages":{"string":"固定电话必须是一条字符串。","maxlength":"固定电话只能包含至多20个字符。"},"maxlength":20}},{"id": "useraddressmodel-region_code", "name": "UserAddressModel[region_code]", "attribute": "region_code", "rules": {"string":true,"messages":{"string":"收货地址必须是一条字符串。","maxlength":"收货地址只能包含至多255个字符。"},"maxlength":255}},{"id": "useraddressmodel-address_detail", "name": "UserAddressModel[address_detail]", "attribute": "address_detail", "rules": {"string":true,"messages":{"string":"详细地址必须是一条字符串。","maxlength":"详细地址只能包含至多50个字符。"},"maxlength":50}},{"id": "useraddressmodel-zipcode", "name": "UserAddressModel[zipcode]", "attribute": "zipcode", "rules": {"string":true,"messages":{"string":"邮编必须是一条字符串。","maxlength":"邮编只能包含至多6个字符。"},"maxlength":6}},{"id": "useraddressmodel-mobile", "name": "UserAddressModel[mobile]", "attribute": "mobile", "rules": {"match":{"pattern":/^(13[0-9]{1}[0-9]{8}|15[0-9]{1}[0-9]{8}|18[0-9]{1}[0-9]{8}|17[0-9]{1}[0-9]{8}|14[0-9]{1}[0-9]{8}|199[0-9]{8}|198[0-9]{8}|166[0-9]{8})$/,"not":false,"skipOnEmpty":1},"messages":{"match":"手机号码是无效的。"}}},{"id": "useraddressmodel-tel", "name": "UserAddressModel[tel]", "attribute": "tel", "rules": {"match":{"pattern":/^0[0-9]{2,3}-[0-9]{7,8}$/,"not":false,"skipOnEmpty":1},"messages":{"match":"固定电话是无效的。"}}},{"id": "useraddressmodel-email", "name": "UserAddressModel[email]", "attribute": "email", "rules": {"email":{"pattern":/^[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/,"fullPattern":/^[^@]*<[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?>$/,"allowName":false,"enableIDN":false,"skipOnEmpty":1},"messages":{"email":"邮件地址不是有效的邮箱地址。"}}},{"id": "useraddressmodel-zipcode", "name": "UserAddressModel[zipcode]", "attribute": "zipcode", "rules": {"match":{"pattern":/^[0-9]{6}$/,"not":false,"skipOnEmpty":1},"messages":{"match":"邮编是无效的。"}}},{"id": "useraddressmodel-region_code", "name": "UserAddressModel[region_code]", "attribute": "region_code", "rules": {"region":{"min":5},"messages":{"region":"收货地址 请选择到街道/村"}}},]
</script>
<script type="text/javascript">
    $().ready(function() {
        var regionselector_init = true;
        var regionselector_reload = false;
// 地区选择
        var regionselector = $("#region_code_containter").regionselector({
            value: "{{ $address_info->region_code }}",
            select_class: "select",
            change: function(value, names, is_last) {

                $("#region_code").val(value);
                $("#region_code").data("is_last", is_last);
                $("#region_code").valid();

                addresspicker.setCity(names.join(""));

                if (regionselector_reload) {
                    regionselector_reload = false;
                    return;
                }

                if (regionselector_init) {
                    regionselector_init = false;
                    return;
                }

                if (value != "") {
                    var adcode = value.split(",");
                    adcode = adcode.slice(0, 2).join("");
                    addresspicker.search(names.join(""), adcode);
                }

            }
        });

// 地址选择器
        var addresspicker = $("#map_container").addresspicker({
// 当前位置
            position: {
                lng: "{{ $address_info->address_lng }}",
                lat: "{{ $address_info->address_lat }}"
            },
// 自动提示
            input: "useraddressmodel-address_detail",
// 当前地区编码
            city: "1101",
// 定位当前位置
            geolocation_callback: function(data, region_code, address) {
                if ("11" == "") {
// 重新加载
                    regionselector.value = region_code;
                    regionselector_reload = true;
                    regionselector.reload(region_code);
                }
            },
            save_callback: function() {
                var position = this.marker.getPosition();
                this.getRegionCode(position, function(region_code, region_name) {
// 重新加载
                    regionselector.value = region_code;
                    regionselector_reload = true;
                    regionselector.reload(region_code);
                });
            },
            back_callback: function() {
                var position = this.marker.getPosition();
                this.getRegionCode(position, function(region_code, region_name) {
// 重新加载
                    regionselector.value = region_code;
                    regionselector_reload = true;
                    regionselector.reload(region_code);
                });
            }
        });

        $("body").on("blur", ".address_detail", function() {
            if ($.trim($(this).val()) != "") {
                addresspicker.search($.trim($(this).val()), null, function(result) {
                    if (result.poiList) {
                        var poi = result.poiList.pois[0];
                        var position = poi.location;
                        this.getRegionCode(position, function(region_code, region_name) {
// 搜索完成不重新加载
                        });
                    }
                });
            }
        });

        var validator = $("#UserAddressModel").validate();
// 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules($("#client_rules").html());
        $("#btn_save").click(function() {
            if (!validator.form()) {
                return false;
            }

            map = addresspicker.map;

            $(".address_lng").val(map.getCenter().lng);
            $(".address_lat").val(map.getCenter().lat);

            var data = $("#UserAddressModel").serializeJson();
            var action = $("#UserAddressModel").attr('action');

            $.post(action, data, function(result) {
                if (result.code == 0) {
                    $.msg(result.message);

// 判断添加收货地址回调函数是否可用
                    var add_address_callback = $("body").data("add_address_callback");

                    if ($.isFunction(add_address_callback)) {
                        add_address_callback.call(result, result.data.address_id);
                    } else {
                        $.go(window.location.href);
                    }

// 关闭
                    cancel();
                } else {
                    $.msg(result.message, {
                        time: 3000
                    });
                }
            }, "json");
        });
    });
</script>