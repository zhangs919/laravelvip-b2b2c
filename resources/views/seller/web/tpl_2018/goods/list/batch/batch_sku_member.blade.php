<div id="{{ $uuid }}" class="p-20">
    <form id="form1" class="form-horizontal" name="SkuMember" action="/goods/list/batch-sku-member.html?ids=12" method="POST">
        @csrf

        <div class="simple-form-field" >
            <div class="form-group">
                <label for="skumember-member_type" class="col-sm-3 w100 control-label">

                    <span class="ng-binding">优惠类型：</span>
                </label>
                <div class="col-sm-9">
                    <div class="form-control-box">

                        <input type="hidden" name="SkuMember[member_type]" value="0"><div id="skumember-member_type" class="" name="SkuMember[member_type]" selection="0"><label class="control-label cur-p m-r-10"><input type="radio" name="SkuMember[member_type]" value="0" checked> 打折</label>
                            <label class="control-label cur-p m-r-10"><input type="radio" name="SkuMember[member_type]" value="1"> 减价</label>
                            <label class="control-label cur-p m-r-10"><input type="radio" name="SkuMember[member_type]" value="2"> 指定价格</label></div>


                    </div>

                    <div class="help-block help-block-t"></div>
                </div>
            </div>
        </div>

        <div class="simple-form-field">
            <div class="form-group">
                <label class="col-sm-2 w100 control-label">批量设置：</label>
                <div class="col-sm-10">
                    <div class="form-control-box">
                        <select class="form-control m-r-5 rank-select w100">
                            <option value="0">全部</option>

                            <option value="6">普通会员（VIP1）</option>

                            <option value="7">特殊会员</option>

                        </select>
                        <input class="form-control batch-value m-r-5 m-l-5 w60 start-num" type="text">
                        <a class="btn btn-primary batch-submit m-r-5 m-l-20">确定</a>
                        <a class="btn btn-default clear-all">清空</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-spec-user-rank-region" style="overflow-y: auto; max-height: 300px; position: relative">
            <table class="table table-bordered table-spec pull-left w500">
                <tbody>

                <tr class="left-tr">


                    <td id="goods_id" rowspan="2" colspan="1" class="" style="height: 50px;">商品ID</td>



                    <td id="goods_name" rowspan="2" colspan="1" class="" style="height: 50px;">商品名称</td>



                    <td id="spec_name" rowspan="2" colspan="1" class="" style="height: 50px;">规格</td>



                    <td id="goods_prices" rowspan="1" colspan="2" class="" style="height: 50px;">正常售价（元）</td>


                </tr>

                <tr class="left-tr">



                </tr>

                <tr class="left-tr">


                    <td id="goods_12" rowspan="1" colspan="1" class="sku" style="height: 50px;">12</td>



                    <td id="goods_name_12" rowspan="1" colspan="1" class="sku" style="height: 50px;">苏洪鲜食越南白心火龙果5斤进口新鲜水果 特价多省包邮 坏果赔</td>



                    <td id="sku_12" rowspan="1" colspan="1" class="sku" style="height: 50px;">无</td>



                    <td id="sku_11.80" rowspan="1" colspan="2" class="sku" style="height: 50px;">￥11.8</td>


                </tr>

                <tr class="left-tr">





                </tr>

                </tbody>
            </table>
            <div class="pull-left" style="overflow-x: auto; max-width:370px; border-right: 1px solid #e9e9e9;">
                <div style='max-width: 3000px; width: 246px'>
                    <table class="table table-bordered table-spec user-rank-list" id="list">
                        <tbody>

                        <tr class="right-tr">









                        </tr>

                        <tr class="right-tr">


                            <td id="rank_6" rowspan="1" colspan="1" class="sku-rank-name w100" style="height: 50px;">
                                <!-- -->
                                普通会员（VIP1）

                            </td>



                            <td id="rank_7" rowspan="1" colspan="1" class="sku-rank-name w100" style="height: 50px;">
                                <!-- -->
                                特殊会员

                            </td>


                        </tr>

                        <tr class="right-tr">









                        </tr>

                        <tr class="right-tr">


                            <td id="sku_12_rank_6" rowspan="1" colspan="1" class="sku-rank w100" style="height: 50px;">


                                <input type="text" id="price_12_6" class="form-control small sm-height m-l-5 m-r-5 start-num" name="SkuMember[member_value]" value="" data-sku_id="12" data-goods_price="11.80" data-rank_id="6" data-rule-callback="start_number_callback">


                                <input type="hidden" id="skumember-goods_price" class="form-control" name="SkuMember[goods_price]" value="11.80">

                            </td>



                            <td id="sku_12_rank_7" rowspan="1" colspan="4" class="sku-rank w100" style="height: 50px;">


                                <input type="text" id="price_12_7" class="form-control small sm-height m-l-5 m-r-5 start-num" name="SkuMember[member_value]" value="" data-sku_id="12" data-goods_price="11.80" data-rank_id="7" data-rule-callback="start_number_callback">


                                <input type="hidden" id="skumember-goods_price" class="form-control" name="SkuMember[goods_price]" value="11.80">

                            </td>


                        </tr>


                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!--错误提示模块 star-->
        <div class="member-handle-error"></div>
        <!--错误提示模块 end-->
        <!-- 提交 -->
        <div class="m-t-30 text-c">
            <a id="btn_submit_sku_member" class="btn btn-primary" style="padding: 5px 68px !important; font-size: 15px !important; line-height: 26px !important;">确认提交</a>
        </div>


    </form>
</div>

<!-- 验证规则 -->
<script id="client_rules" type="text">
[{"id": "skumember-sku_id", "name": "SkuMember[sku_id]", "attribute": "sku_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"SKU编号必须是整数。"}}},{"id": "skumember-shop_id", "name": "SkuMember[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"店铺编号必须是整数。"}}},{"id": "skumember-shop_rank_id", "name": "SkuMember[shop_rank_id]", "attribute": "shop_rank_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"店铺会员等级编号必须是整数。"}}},{"id": "skumember-member_type", "name": "SkuMember[member_type]", "attribute": "member_type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"优惠类型必须是整数。"}}},{"id": "skumember-member_value", "name": "SkuMember[member_value]", "attribute": "member_value", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"优惠金额或折扣必须是一个数字。"}}},{"id": "skumember-member_value", "name": "SkuMember[member_value]", "attribute": "member_value", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"优惠金额或折扣必须是一个数字。","min":"优惠金额或折扣必须不小于0。","max":"优惠金额或折扣必须不大于9999999。"},"min":0,"max":9999999}},]
</script>
<script type="text/javascript">
    $().ready(function() {
        set_message();
        $("#{{ $uuid }}").find(":radio").click(function() {
            $("#{{ $uuid }}").find(".member_message").remove();
//$('.batch-set-info').show();
            set_message();
        });

        function set_message() {
            var member_type = $("#{{ $uuid }}").find('input:radio:checked').val();
            if (member_type == 0) {
                $("#{{ $uuid }}").find(".start-num").each(function() {
                    $(this).before("<span class='member_message'>打</span>");
                    $(this).after("<span class='member_message'>折</span>");
                });
            } else if (member_type == 1) {
                $("#{{ $uuid }}").find(".start-num").each(function() {
                    $(this).before("<span class='member_message'>减</span>");
                    $(this).after("<span class='member_message'>元</span>");
                });
            } else {
                $("#{{ $uuid }}").find(".start-num").each(function() {
                    $(this).after("<span class='member_message'>元</span>");
                });
            }
        }
    });
</script>
<script type='text/javascript'>
    function start_number_callback(element, value) {
        var member_type = $("#{{ $uuid }}").find('input[name="SkuMember[member_type]"]:checked ').val();
        if ($(element).val().length == 0) {
            return true;
        }
        if (member_type == 0) {
            if ($(element).val() * $(element).data('goods_price') < 0.1) {
                $(element).data("msg", '折扣后的金额不能小于0.01元');
                return false;
            } else if ($(element).val() >= 10) {
                $(element).data("msg", '折扣后的金额不能大于正常售价');
                return false;
            } else {
                return true;
            }
        } else if (member_type == 1) {
            if ($(element).val() * 100 >= $(element).data('goods_price') * 100) {
                $(element).data("msg", '最大减价金额必须小于正常售价');
                return false;
            } else if ($(element).val() < 0) {
                $(element).data("msg", '设置的减价金额不能小于0.01元');
                return false;
            } else {
                return true;
            }
        } else if (member_type == 2) {
            console.info($(element).val());
            if ($(element).val() * 100 < 1) {
                $(element).data("msg", '指定的会员价不能小于0.01元');
                return false;
            } else if ($(element).val() * 100 > $(element).data('goods_price') * 100) {
                $(element).data("msg", '指定的会员价必须小于正常售价');
                return false;
            } else {
                return true;
            }
        }
    }
    var validator = null;
    $().ready(function() {
        /**
         * 初始化validator默认值
         */
        var _errorPlacement = $.validator.defaults.errorPlacement;
        var _success = $.validator.defaults.success;
        $.validator.setDefaults({
            errorPlacement: function(error, element) {
                var error_id = $(error).attr("id");
                var error_msg = $(error).text();
                var element_id = $(error).attr("for");
                if (!error_msg && error_msg == "") {
                    return;
                }
                if ($(element).parents(".member-container").find(".member-handle-error").find("div").size() == 0) {
                    $(".member-handle-error").html("<div class='form-control-warning error m-t-10'></div>");
                }
                var error_dom = $("<p id='"+error_id+"'><i class='fa fa-times-circle'></i><span class='error-msg'>" + error_msg + "</span></p>");
                $("#{{ $uuid }}").find(".member-handle-error").find("div").append(error_dom);
            },
// 失去焦点验证
            onfocusout: function(element) {
                $(element).valid();
            },
// 成功后移除错误提示
            success: function(error, element) {
                var error_id = $(error).attr("id");
                var error_msg = $(error).text();
                var element_id = $(error).attr("for");
                var sku = $(this).data('sku_id');
                var rank = $(this).data('rank_id');
                if ($(element).parents(".member-container").size() > 0) {
                    $("#{{ $uuid }}").find("[id='" + error_id + sku + rank + "']").remove();
                }
                if ($(element).parents(".member-container").find(".member-handle-error").find("p").size() == 0) {
                    $("#{{ $uuid }}").find('.form-control-warning').remove();
//$(element).parents(".member-container").find(".member-handle-error").find("div").remove();
                }
                _success.call(this, error, element);
            }
        });
        var validator = $("#form1").validate();
// 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules($("#client_rules").html());

//提交
        $("#{{ $uuid }}").find("#btn_submit_sku_member").click(function() {

            var is_valid = true;

            var member_data = '';
            $(".start-num").each(function() {
                member_data += $(this).data('sku_id') + '_' + $(this).data('rank_id') + '_' + $(this).val() + ',';
                if ($(this).valid() == false) {
                    is_valid = false;
                }
            });

            if (!is_valid || !validator.form()) {
                return;
            }

            $.loading.start();

            var jsonData = $("#form1").serializeJson();
            var data = {
                jsonData: jsonData,
                member_data: member_data,
                goods_id: "Array"
            };

            $.post("/goods/list/batch-sku-member", data, function(result) {
                if (result.code == 0) {
// 关闭对话框
                    $("#{{ $uuid }}").parents(".layui-layer").find(".layui-layer-close").click();
// 显示信息
                    $.msg(result.message, {
                        time: 1500
                    }, function() {
//.validator.setDefaults 引起其他页面出错
                        if (typeof (tablelist) != "undefined" && tablelist &&false) {
                            tablelist.load();
                        } else {
                            $.go('/goods/list');
                        }
                    });
                } else {
                    $.msg(result.message, {
                        time: 5000
                    });
                }
            }, "json").always(function() {
                $.loading.stop();
            });

        });
//批量设置
        $("#{{ $uuid }}").find(".batch-submit").click(function() {
            var rank_id = $('.rank-select option:selected').val();//选中的值
            var batch_value = $(".batch-value").val();

            if (!batch_value) {
                return;
            }
            if (rank_id == 0) {
                $("#{{ $uuid }}").find(".start-num").each(function() {
                    $(this).val(batch_value);
                });
            } else {
                $("#{{ $uuid }}").find(".start-num").each(function() {
                    if ($(this).data('rank_id') == rank_id) {
                        $(this).val(batch_value);
                    }
                });
            }
            var is_valid = true;

            var member_data = '';
            $("#{{ $uuid }}").find(".start-num").each(function() {
                if (rank_id == 0) {
                    member_data += $(this).data('sku_id') + '_' + $(this).data('rank_id') + '_' + $(this).val() + ',';
                    if ($(this).valid() == false) {
                        is_valid = false;
                    }
                } else {
                    if ($(this).data('rank_id') == rank_id) {
                        member_data += $(this).data('sku_id') + '_' + $(this).data('rank_id') + '_' + $(this).val() + ',';
                        if ($(this).valid() == false) {
                            is_valid = false;
                        }
                    }
                }
            });

            /* if (!is_valid || !validator.form()) {
            return;
            } */

        });
//清空
        $("#{{ $uuid }}").find(".clear-all").click(function() {
            $("#{{ $uuid }}").find(".start-num").each(function() {
                $(this).val('');
            });
        });
    });
</script>