<form id="UserAddressModel" class="form-horizontal" name="UserAddressModel" action="/user/address/edit.html?address_id={{ $address_info->address_id }}&checkout={{ $checkout }}" method="post">
    @csrf
    <input type="hidden" id="useraddressmodel-zipcode" class="form-control" name="UserAddressModel[zipcode]" placeholder="邮政编码">
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
    </div><!-- 要实名认证的
-->
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

            <textarea id="useraddressmodel-address_detail" class="form-control address_detail" name="UserAddressModel[address_detail]" rows="5" placeholder="请如实填写详细收货地址">{{ $address_info->address_detail }}</textarea>

        </div>

        <div class="invalid"></div>
    </div>
    <div class="form-group form-group-spe" >
        <label for="useraddressmodel-address_house" class="input-left">

            <span>门牌号：</span>
        </label>
        <div class="form-control-box">

            <input type="text" id="useraddressmodel-address_house" class="form-control" name="UserAddressModel[address_house]" value="{{ $address_info->address_house }}" placeholder="例：5号楼301室">

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

    <!-- 地址别名 -->
    <div class="form-group form-group-spe" >
        <label for="useraddressmodel-address_label" class="input-left">

            <span>标签：</span>
        </label>
        <div class="form-control-box">

            <input type="text" id="useraddressmodel-address_label" class="form-control valid" name="UserAddressModel[address_label]" value="{{ $address_info->address_label }}" placeholder="建议填写常用名称" style="width: 120px;">
            <span class="addr-alias m-l-10">
            <a class="address-alias-label">家里</a>
            <a class="address-alias-label">公司</a>
            <a class="address-alias-label">父母家</a>
            </span>

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
<div class="address-copy">
    <h2>粘贴地址</h2>
    <textarea class="address-copy-panel address-parse-content" placeholder="粘帖收件人姓名、电话、地址、邮箱" style="width: 358px; height: 80px"></textarea>
    <a class="btn fr address-parse disabled">自动匹配地址</a>
</div>
<div class="address-picker">
    <div id="map_container" class="amap-container"></div>
    <p class="map-footer" style="display: none;">
        <a href="javascript:;" class="save-map-new" style='background-color: #ffaa45;color: #fff;'>保存位置</a>
        <a href="javascript:;" class="back-map">回原位置</a>
    </p>
</div>
<script id="client_rules" type="text">
[{"id": "useraddressmodel-region_code", "name": "UserAddressModel[region_code]", "attribute": "region_code", "rules": {"required":true,"messages":{"required":"收货地址不能为空。"}}},{"id": "useraddressmodel-user_id", "name": "UserAddressModel[user_id]", "attribute": "user_id", "rules": {"required":true,"messages":{"required":"用户ID不能为空。"}}},{"id": "useraddressmodel-consignee", "name": "UserAddressModel[consignee]", "attribute": "consignee", "rules": {"required":true,"messages":{"required":"收货人不能为空。"}}},{"id": "useraddressmodel-address_detail", "name": "UserAddressModel[address_detail]", "attribute": "address_detail", "rules": {"required":true,"messages":{"required":"详细地址不能为空。"}}},{"id": "useraddressmodel-mobile", "name": "UserAddressModel[mobile]", "attribute": "mobile", "rules": {"required":true,"messages":{"required":"手机号码不能为空。"}}},{"id": "useraddressmodel-user_id", "name": "UserAddressModel[user_id]", "attribute": "user_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"用户ID必须是整数。"}}},{"id": "useraddressmodel-real", "name": "UserAddressModel[real]", "attribute": "real", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否实名认证必须是整数。"}}},{"id": "useraddressmodel-address_name", "name": "UserAddressModel[address_name]", "attribute": "address_name", "rules": {"string":true,"messages":{"string":"地址别名必须是一条字符串。","maxlength":"地址别名只能包含至多60个字符。","match":"地址别名中含有非法字符"},"maxlength":60,"match":{"pattern":/<|>|<script|<img|<svg|alert|prompt|cookie|@eval|@ini_set|@set_time_limit|\$_SERVER|@set_magic_quotes_runtime/,"not":true}}},{"id": "useraddressmodel-email", "name": "UserAddressModel[email]", "attribute": "email", "rules": {"string":true,"messages":{"string":"邮件地址必须是一条字符串。","maxlength":"邮件地址只能包含至多60个字符。","match":"邮件地址中含有非法字符"},"maxlength":60,"match":{"pattern":/<|>|<script|<img|<svg|alert|prompt|cookie|@eval|@ini_set|@set_time_limit|\$_SERVER|@set_magic_quotes_runtime/,"not":true}}},{"id": "useraddressmodel-address_lng", "name": "UserAddressModel[address_lng]", "attribute": "address_lng", "rules": {"string":true,"messages":{"string":"地址经度必须是一条字符串。","maxlength":"地址经度只能包含至多60个字符。","match":"地址经度中含有非法字符"},"maxlength":60,"match":{"pattern":/<|>|<script|<img|<svg|alert|prompt|cookie|@eval|@ini_set|@set_time_limit|\$_SERVER|@set_magic_quotes_runtime/,"not":true}}},{"id": "useraddressmodel-address_lat", "name": "UserAddressModel[address_lat]", "attribute": "address_lat", "rules": {"string":true,"messages":{"string":"地址纬度必须是一条字符串。","maxlength":"地址纬度只能包含至多60个字符。","match":"地址纬度中含有非法字符"},"maxlength":60,"match":{"pattern":/<|>|<script|<img|<svg|alert|prompt|cookie|@eval|@ini_set|@set_time_limit|\$_SERVER|@set_magic_quotes_runtime/,"not":true}}},{"id": "useraddressmodel-consignee", "name": "UserAddressModel[consignee]", "attribute": "consignee", "rules": {"string":true,"messages":{"string":"收货人必须是一条字符串。","maxlength":"收货人只能包含至多30个字符。","match":"收货人中含有非法字符"},"maxlength":30,"match":{"pattern":/<|>|<script|<img|<svg|alert|prompt|cookie|@eval|@ini_set|@set_time_limit|\$_SERVER|@set_magic_quotes_runtime/,"not":true}}},{"id": "useraddressmodel-mobile", "name": "UserAddressModel[mobile]", "attribute": "mobile", "rules": {"string":true,"messages":{"string":"手机号码必须是一条字符串。","maxlength":"手机号码只能包含至多20个字符。"},"maxlength":20}},{"id": "useraddressmodel-tel", "name": "UserAddressModel[tel]", "attribute": "tel", "rules": {"string":true,"messages":{"string":"固定电话必须是一条字符串。","maxlength":"固定电话只能包含至多20个字符。"},"maxlength":20}},{"id": "useraddressmodel-region_code", "name": "UserAddressModel[region_code]", "attribute": "region_code", "rules": {"string":true,"messages":{"string":"收货地址必须是一条字符串。","maxlength":"收货地址只能包含至多255个字符。"},"maxlength":255}},{"id": "useraddressmodel-card_id", "name": "UserAddressModel[card_id]", "attribute": "card_id", "rules": {"string":true,"messages":{"string":"身份证号必须是一条字符串。","maxlength":"身份证号只能包含至多255个字符。"},"maxlength":255}},{"id": "useraddressmodel-address_detail", "name": "UserAddressModel[address_detail]", "attribute": "address_detail", "rules": {"string":true,"messages":{"string":"详细地址必须是一条字符串。","maxlength":"详细地址只能包含至多50个字符。","match":"详细地址中含有非法字符"},"maxlength":50,"match":{"pattern":/<|>|<script|<img|<svg|alert|prompt|cookie|@eval|@ini_set|@set_time_limit|\$_SERVER|@set_magic_quotes_runtime/,"not":true}}},{"id": "useraddressmodel-address_house", "name": "UserAddressModel[address_house]", "attribute": "address_house", "rules": {"string":true,"messages":{"string":"门牌号必须是一条字符串。","maxlength":"门牌号只能包含至多50个字符。","match":"门牌号中含有非法字符"},"maxlength":50,"match":{"pattern":/<|>|<script|<img|<svg|alert|prompt|cookie|@eval|@ini_set|@set_time_limit|\$_SERVER|@set_magic_quotes_runtime/,"not":true}}},{"id": "useraddressmodel-zipcode", "name": "UserAddressModel[zipcode]", "attribute": "zipcode", "rules": {"string":true,"messages":{"string":"邮编必须是一条字符串。","maxlength":"邮编只能包含至多6个字符。","match":"邮编中含有非法字符"},"maxlength":6,"match":{"pattern":/<|>|<script|<img|<svg|alert|prompt|cookie|@eval|@ini_set|@set_time_limit|\$_SERVER|@set_magic_quotes_runtime/,"not":true}}},{"id": "useraddressmodel-address_label", "name": "UserAddressModel[address_label]", "attribute": "address_label", "rules": {"string":true,"messages":{"string":"标签必须是一条字符串。","maxlength":"标签只能包含至多5个字符。","match":"标签中含有非法字符"},"maxlength":5,"match":{"pattern":/<|>|<script|<img|<svg|alert|prompt|cookie|@eval|@ini_set|@set_time_limit|\$_SERVER|@set_magic_quotes_runtime/,"not":true}}},{"id": "useraddressmodel-mobile", "name": "UserAddressModel[mobile]", "attribute": "mobile", "rules": {"match":{"pattern":/^((13|15|18|17|14)\d{9}|(199|198|166|191|167)\d{8})$/,"not":false,"skipOnEmpty":1},"messages":{"match":"手机号码是无效的。"}}},{"id": "useraddressmodel-tel", "name": "UserAddressModel[tel]", "attribute": "tel", "rules": {"match":{"pattern":/^0[0-9]{2,3}-[0-9]{7,8}$/,"not":false,"skipOnEmpty":1},"messages":{"match":"固定电话是无效的。"}}},{"id": "useraddressmodel-email", "name": "UserAddressModel[email]", "attribute": "email", "rules": {"email":{"pattern":/^[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/,"fullPattern":/^[^@]*<[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?>$/,"allowName":false,"enableIDN":false,"skipOnEmpty":1},"messages":{"email":"邮件地址不是有效的邮箱地址。"}}},{"id": "useraddressmodel-zipcode", "name": "UserAddressModel[zipcode]", "attribute": "zipcode", "rules": {"match":{"pattern":/^[0-9]{6}$/,"not":false,"skipOnEmpty":1},"messages":{"match":"邮编是无效的。"}}},{"id": "useraddressmodel-region_code", "name": "UserAddressModel[region_code]", "attribute": "region_code", "rules": {"region":{"min":3},"messages":{"region":"收货地址 请选择到区/县"}}},]
</script>
<script type="text/javascript">
    $().ready(function() {
//如果未认证 先去认证
        var is_cross_border="0";
        if(is_cross_border==1){

            var card_id=$('#useraddressmodel-card_id').val();
            if(card_id==''){
                $.confirm("根据规定，购买跨境商品需先进行实名认证。", function() {
                    $.go('/user/profile.html');

                },function(){
                    $.go('/cart.html');
                });
                $('#btn_save').attr('disabled','disabled');
            }

        }
        var regionselector_init = true;
        var regionselector_reload = false;
        var regionselector_adcode = null;
// 地区选择
        var regionselector = $("#region_code_containter").regionchooser({
            value: "{{ $address_info->region_code }}",
            select_class: "select",
            change: function(value, names, is_last) {

                this.setTitle(names.join(" "));

                $("#region_code").val(value);
                $("#region_code").data("is_last", is_last);
                $("#region_code").valid();

                addresspicker.setCity(names.join(""));

                regionselector_adcode = value.split(",", 3).join("");

                if (regionselector_reload) {
                    regionselector_reload = false;
                    return;
                }

                if (regionselector_init) {
                    regionselector_init = false;
                    return;
                }

                if (value != "") {
                    addresspicker.search(names.join(""), regionselector_adcode);
                }
            }
        });

//
        var position = {
            lng: "{{ $address_info->address_lng }}",
            lat: "{{ $address_info->address_lat }}"
        };
//

// 地址选择器
        var addresspicker = $("#map_container").addresspicker({
// 当前位置
            position: position,
// 自动提示
            input: "useraddressmodel-address_detail",
// 当前地区编码
            city: "1302",
// 定位当前位置
            geolocation_callback: function(data, region_code, address) {
                if ("{{ $address_info->address_id }}" == "") {
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
            },
            win_content_callback: function(infoWindow, content, is_address) {
                if (!is_address) {
                    infoWindow.setContent("<font color='#FF7C00'>" + content + "</font>");
                } else {
//

                    var color = $("#btn_save").css("background-color");

                    infoWindow.setContent("当前位置：<label style='color: #ff4500;'><span class='map_address_info'>" + content + "</span><a href='javascript:void(0);' data-content='" + content + "' class='use-this-location' style='color: " + color + ";'>[使用此位置]</a></label>");

//
                }
            }
        });

// 解绑
        $(".address_detail").off("click");
        $("body").on("blur", ".address_detail", function() {
            if ($.trim($(this).val()) != "") {
                addresspicker.search($.trim($(this).val()), regionselector_adcode);
            }
            return false;
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

            return false;
        });

// 地址别名
        $("body").on("click", ".address-alias-label", function() {
            $("#useraddressmodel-address_label").val($.trim($(this).text())).blur();
        });

//

// 解绑
        $(".use-this-location").off("click");
        $("body").on("click", ".use-this-location", function() {
            var address=$('.map_address_info').html();
            save_map(address);

        });
        $("body").on("click", ".save-map-new", function() {
            var address=$('.map_address_info').html();
            save_map(address);
        });
        var save_map=function(address){
// 加载
            $.loading.start();
// 解析地址
            $.post("/site/address-parse.html", {
                address: address
            }, function(result) {
                if (result.code == 0) {
                    var data = result.data;
                    if (data.address) {
                        $("#useraddressmodel-address_detail").val(data.address);
                    }
                    if (data.postcode) {
                        $("#useraddressmodel-zipcode").val(data.postcode);
                    }
                    if (data.region_code) {
                        regionselector.value = data.region_code;
                        regionselector_reload = true;
                        regionselector.reload(data.region_code);
                    }
// 隐藏
                    $("#map_container").parents(".address-picker").find(".map-footer").hide();
                } else {
                    $.msg(result.message, {
                        time: 5000
                    })
                }
            }, "JSON").always(function() {
                $.loading.stop();
            });

            return false;
        }

// 解绑
        $(".address-parse-content").off("click");
        $("body").on("keyup", ".address-parse-content", function() {
            var address = $(this).val();
            if ($.trim(address) == "") {
                $(".address-parse").addClass("disabled");
                $(".address-parse").prop("disabled", true);
            } else {
                $(".address-parse").removeClass("disabled");
                $(".address-parse").prop("disabled", false);
            }
            return false;
        });

// 解绑
        $(".address-parse").off("click");
        $("body").on("click", ".address-parse", function() {
            var address = $(".address-parse-content").val();
            if ($.trim(address) == "") {
                $(".address-parse-content").focus();
                return false;
            }

            $(".address-parse").addClass("disabled");
            $(".address-parse").prop("disabled", true);

// 加载
            $.loading.start();
// 解析地址
            $.post("/site/address-parse.html", {
                address: address
            }, function(result) {
                if (result.code == 0) {
                    var data = result.data;
                    if (data.person_name) {
                        $("#useraddressmodel-consignee").val(data.person_name);
                    }
                    if (data.mobile) {
                        $("#useraddressmodel-mobile").val(data.mobile);
                    }
                    if (data.tel) {
                        $("#useraddressmodel-tel").val(data.tel);
                    }
                    if (data.email) {
                        $("#useraddressmodel-email").val(data.email);
                    }
                    if (data.postcode) {
                        $("#useraddressmodel-zipcode").val(data.postcode);
                    }

                    var adcode = null;

                    if (data.region_code) {
                        regionselector.value = data.region_code;
                        regionselector_reload = true;
                        regionselector.reload(data.region_code);
                        adcode = data.region_code.split(",", 3).join("");
                    }
                    if (data.address) {
                        $("#useraddressmodel-address_detail").val(data.address);
                        addresspicker.search($.trim(data.address), adcode);
                    }
                } else {
                    $.msg(result.message, {
                        time: 5000
                    })
                }
            }, "JSON").always(function() {
                $.loading.stop();
                $(".address-parse").removeClass("disabled");
                $(".address-parse").prop("disabled", false);
            });

            return false;
        });

//
    });
</script>