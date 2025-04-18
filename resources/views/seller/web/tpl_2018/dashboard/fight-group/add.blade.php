{{--模板继承--}}
@extends('layouts.seller_layout')

{{--header 内 css文件--}}
@section('header_css')

@stop

{{--header 内 css文件--}}
@section('header_css_2')

@stop

{{--css style page元素同级上面--}}
@section('style')

@stop

{{--content--}}
@section('content')

    <!-- 温馨提示 -->
    <form id="FightGroupModel" class="form-horizontal" name="FightGroupModel" action="/dashboard/fight-group/add" method="post" enctype="multipart/form-data">
        @csrf
        <div class="table-content m-t-30 clearfix fight-group-goods">
            <div class="form-horizontal">
                <!-- 隐藏域 -->
                <input type="hidden" id="fightgroupmodel-act_id" class="form-control" name="FightGroupModel[act_id]">
                <input type='hidden' name="is_going" value="">
                <input type='hidden' name="start_time" id="start_time" value="">
                <input type='hidden' name="end_time" id="end_time" value="">
                <!-- 活动名称 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="fightgroupmodel-act_name" class="col-sm-3 control-label">
                            <span class="ng-binding">活动名称：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">
                                <input type="text" id="fightgroupmodel-act_name" class="form-control" name="FightGroupModel[act_name]">
                            </div>
                            <div class="help-block help-block-t"><div class="help-block help-block-t">活动名称必须在1~30个字内</div></div>
                        </div>
                    </div>
                </div>            <!-- 拼团类型 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="fightgroupmodel-groupon_mode" class="col-sm-4 control-label">
                            <span class="ng-binding">拼团类型：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">
                                <input id="fightgroupmodel-groupon_mode0" name="FightGroupModel[groupon_mode]" type="radio" value="0" checked="checked" >
                                <label for="fightgroupmodel-groupon_mode0" class="control-label cur-p m-r-10">普通拼团</label>
                                <input id="fightgroupmodel-groupon_mode1" name="FightGroupModel[groupon_mode]" type="radio" value="1" >
                                <label for="fightgroupmodel-groupon_mode1" class="control-label cur-p m-r-10">老带新拼团</label>
                            </div>
                            <div class="help-block help-block-t"><div class="help-block help-block-t">普通拼团：所有会员都可以选择开团或者凑团购买商品<br>老带新拼团：所有人都能开团，但是只有店铺的新会员，并且没有下过单的用户才能参团；</div></div>
                        </div>
                    </div>
                </div>
                <div class="simple-form-field">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">活动商品：</span>
                        </label>
                        <div class="col-sm-9">
                        <span class="control-label">
                            <span class="fight-group-pic" id="goods_image">
                                                            </span>
                            <span id="goods_name" class="va-middle m-r-10"></span>
                        </span>
                            <a href="javascript:void(0);" class="btn btn-sm btn-primary m-t-4 select_goods" id="select_goods">
                                <i class="fa fa-plus"></i>
                                选择商品
                            </a>
                        </div>
                    </div>
                </div>
                <div class="simple-form-field">
                    <div class="form-group">
                        <label class="col-sm-3 control-label"></label>
                        <div class="col-sm-9">
                            <div class="p-l-15 p-r-15 widget_goods w800"></div>
                            <input type="hidden" id="select_goods_id" name="select_goods_id" value="" />
                        </div>
                    </div>
                </div>
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="fightgroupmodel-cat_id" class="col-sm-4 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">活动分类：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">
                                <select id="fightgroupmodel-cat_id" class="form-control chosen-select w150" name="FightGroupModel[cat_id]">
                                    @foreach($cat_list as $k=>$v)
                                    <option value="{{ $k }}">{{ $v }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="help-block help-block-t"><div class="help-block help-block-t">活动分类由平台方管理员添加，如果没有您所需要的分类，请联系平台方管理人员</div></div>
                        </div>
                    </div>
                </div>
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="fightgroupmodel-start_time" class="col-sm-3 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">活动有效期：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">
                                <input type="text" id="fightgroupmodel-start_time" class="form-control form_datetime large" name="FightGroupModel[start_time]" value="{{ $start_time }}" data-rule-date="true">
                                <span class="ctime">至</span>
                                <input type="text" id="fightgroupmodel-end_time" class="form-control form_datetime large" name="FightGroupModel[end_time]" value="{{ $end_time }}" data-rule-date="true">
                            </div>
                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
                <!-- 是否开启凑团 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="fightgroupmodel-is_gather" class="col-sm-4 control-label">
                            <span class="ng-binding">是否开启凑团：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">
                                <label class="control-label control-label-switch">
                                    <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                        <input type="hidden" name="FightGroupModel[is_gather]" value="0"><label><input type="checkbox" id="fightgroupmodel-is_gather" class="form-control b-n" name="FightGroupModel[is_gather]" value="1" checked data-on-text="是" data-off-text="否"> </label>
                                    </div>
                                </label>
                            </div>
                            <div class="help-block help-block-t"><div class="help-block help-block-t">开启凑团后，对于未参团的买家，活动商品详情页会显示未成团的团列表，买家可以直接任选一个参团，提升成团率。</div></div>
                        </div>
                    </div>
                </div>            <!-- 是否开启模拟成团 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="fightgroupmodel-is_imitate" class="col-sm-4 control-label">
                            <span class="ng-binding">是否开启模拟成团：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">
                                <label class="control-label control-label-switch">
                                    <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                        <input type="hidden" name="FightGroupModel[is_imitate]" value="0"><label><input type="checkbox" id="fightgroupmodel-is_imitate" class="form-control b-n" name="FightGroupModel[is_imitate]" value="1" data-on-text="是" data-off-text="否"> </label>
                                    </div>
                                </label>
                            </div>
                            <div class="help-block help-block-t"><div class="help-block help-block-t">开启模拟成团后，拼团有效期内人数未满的团，系统将会模拟“匿名买家”凑满人数，使该团成团。您只需要对已付款参团的真实买家发货。建议合理开启，以提高成团率。</div></div>
                        </div>
                    </div>
                </div>            <!-- 是否开启团长优惠 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="fightgroupmodel-is_commander_discount" class="col-sm-4 control-label">
                            <span class="ng-binding">是否开启团长优惠：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">
                                <label class="control-label control-label-switch">
                                    <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                        <input type="hidden" name="FightGroupModel[is_commander_discount]" value="0"><label><input type="checkbox" id="fightgroupmodel-is_commander_discount" class="form-control b-n" name="FightGroupModel[is_commander_discount]" value="1" data-on-text="是" data-off-text="否"> </label>
                                    </div>
                                </label>
                            </div>
                            <div class="help-block help-block-t"><div class="help-block help-block-t">开启团长优惠后，团长将享受更优惠价格，有助于提高开团率和成团率。 注意：模拟成团的团长也能享受团长优惠，请谨慎设置，避免资金损失。</div></div>
                        </div>
                    </div>
                </div>            <!-- 优惠是否叠加使用 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="fightgroupmodel-discount_over_used" class="col-sm-4 control-label">
                            <span class="ng-binding">优惠是否叠加使用：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">
                                <input type="hidden" name="FightGroupModel[discount_over_used]" value=""><div id="fightgroupmodel-discount_over_used" class="" name="FightGroupModel[discount_over_used]" selection='["0","1"]'><label class="control-label cur-p m-r-10"><input type="checkbox" name="FightGroupModel[discount_over_used][]" value="0" checked> 可叠加使用红包</label>
                                    <label class="control-label cur-p m-r-10"><input type="checkbox" name="FightGroupModel[discount_over_used][]" value="1" checked> 可叠加使用积分</label></div>
                            </div>
                            <div class="help-block help-block-t"><div class="help-block help-block-t">未选中，则下单时不可使用红包/积分结算；选中，则下单时可使用红包/积分结算；</div></div>
                        </div>
                    </div>
                </div>
                <div class="simple-form-field">
                    <div class="form-group">
                        <label class="col-sm-3 control-label"></label>
                        <div class="col-sm-9">
                            <div id="sku_list_container"></div>
                        </div>
                    </div>
                </div>
                <!-- 限购 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="fightgroupmodel-purchase_num" class="col-sm-4 control-label">
                            <span class="ng-binding">限购：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">
                                <input type="text" id="fightgroupmodel-purchase_num" class="form-control ipt m-r-10" name="FightGroupModel[purchase_num]">件
                            </div>
                            <div class="help-block help-block-t"><div class="help-block help-block-t">限制会员购买活动中的每件商品的限购数量，为0或空时，则不限购</div></div>
                        </div>
                    </div>
                </div>
                <!-- 参团人数 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="fightgroupmodel-fight_num" class="col-sm-4 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">参团人数：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">
                                <input type="text" id="fightgroupmodel-fight_num" class="form-control ipt m-r-10" name="FightGroupModel[fight_num]">人
                            </div>
                            <div class="help-block help-block-t"><div class="help-block help-block-t">建议3人以上</div></div>
                        </div>
                    </div>
                </div>            <!-- 成团时限 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="fightgroupmodel-fight_time" class="col-sm-4 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">成团时限：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">
                                <input type="text" id="fightgroupmodel-fight_time" class="form-control ipt m-r-10" name="FightGroupModel[fight_time]">
                                <select class="" name="FightGroupModel[fight_time_unit]">
                                    <option value="0">小时</option>
                                    <option value="1">分钟</option>
                                </select>
                            </div>
                            <div class="help-block help-block-t"><div class="help-block help-block-t">组团限制时间</div></div>
                        </div>
                    </div>
                </div>            <!-- 活动规则 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="fightgroupmodel-groupon_rule" class="col-sm-4 control-label">
                            <span class="ng-binding">活动规则：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">
            <textarea id="fightgroupmodel-groupon_rule" class="form-control" name="FightGroupModel[groupon_rule]" rows="5">1、拼团有效期内达到成团人数，则拼团成功；若在有效期内未达到成团人数，则拼团失败，订单关闭并自动退款；
2、拼团有效期内，商品已提前售罄，则拼团失败；
3、高峰期间，同时支付的人数过多，团人数有限制，以接收第三方支付信息时间先后为准，超出该团人数限制的部分用户，则会拼团失败；
4、拼团失败的订单，系统会自动原路退款至支付账户中，如使用余额支付，则立即退回至余额中；</textarea>
                            </div>
                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>            <!-- 确认提交 -->
                <div class="bottom-btn p-b-30">
                    <input type="button" id="btn_submit" value="确认提交" class="btn btn-primary btn-lg"/>
                </div>
            </div>
        </div>
    </form>
    <script id="client_rules" type="text">
[{"id": "fightgroupmodel-goods_id", "name": "FightGroupModel[goods_id]", "attribute": "goods_id", "rules": {"required":true,"messages":{"required":"商品ID不能为空。"}}},{"id": "fightgroupmodel-cat_id", "name": "FightGroupModel[cat_id]", "attribute": "cat_id", "rules": {"required":true,"messages":{"required":"活动分类不能为空。"}}},{"id": "fightgroupmodel-act_price", "name": "FightGroupModel[act_price]", "attribute": "act_price", "rules": {"required":true,"messages":{"required":"拼团价格不能为空。"}}},{"id": "fightgroupmodel-act_stock", "name": "FightGroupModel[act_stock]", "attribute": "act_stock", "rules": {"required":true,"messages":{"required":"活动库存不能为空。"}}},{"id": "fightgroupmodel-fight_num", "name": "FightGroupModel[fight_num]", "attribute": "fight_num", "rules": {"required":true,"messages":{"required":"参团人数不能为空。"}}},{"id": "fightgroupmodel-fight_time", "name": "FightGroupModel[fight_time]", "attribute": "fight_time", "rules": {"required":true,"messages":{"required":"成团时限不能为空。"}}},{"id": "fightgroupmodel-start_time", "name": "FightGroupModel[start_time]", "attribute": "start_time", "rules": {"required":true,"messages":{"required":"活动有效期不能为空。"}}},{"id": "fightgroupmodel-end_time", "name": "FightGroupModel[end_time]", "attribute": "end_time", "rules": {"required":true,"messages":{"required":"活动结束时间不能为空。"}}},{"id": "fightgroupmodel-shop_id", "name": "FightGroupModel[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":/^[+-]?\d+$/},"messages":{"integer":"店铺ID必须是整数。"}}},{"id": "fightgroupmodel-discount_mode", "name": "FightGroupModel[discount_mode]", "attribute": "discount_mode", "rules": {"integer":{"pattern":/^[+-]?\d+$/},"messages":{"integer":"优惠模式必须是整数。"}}},{"id": "fightgroupmodel-fight_time_unit", "name": "FightGroupModel[fight_time_unit]", "attribute": "fight_time_unit", "rules": {"integer":{"pattern":/^[+-]?\d+$/},"messages":{"integer":"Fight Time Unit必须是整数。"}}},{"id": "fightgroupmodel-ext_info", "name": "FightGroupModel[ext_info]", "attribute": "ext_info", "rules": {"string":true,"messages":{"string":"扩展字段必须是一条字符串。"}}},{"id": "fightgroupmodel-act_price", "name": "FightGroupModel[act_price]", "attribute": "act_price", "rules": {"number":{"pattern":/^[-+]?[0-9]*\.?[0-9]+([eE][-+]?[0-9]+)?$/},"messages":{"number":"拼团价格必须是一个数字。","max":"拼团价格必须不大于999999。"},"max":999999}},{"id": "fightgroupmodel-act_price", "name": "FightGroupModel[act_price]", "attribute": "act_price", "rules": {"compare":{"operator":">","type":"string","compareValue":0,"skipOnEmpty":1},"messages":{"compare":"拼团价格的值必须大于\"0\"。"}}},{"id": "fightgroupmodel-number", "name": "FightGroupModel[number]", "attribute": "number", "rules": {"compare":{"operator":">","type":"string","compareValue":0,"skipOnEmpty":1},"messages":{"compare":"Number的值必须大于\"0\"。"}}},{"id": "fightgroupmodel-act_price", "name": "FightGroupModel[act_price]", "attribute": "act_price", "rules": {"match":{"pattern":/^[0-9]+(.[0-9]{1,2})?$/,"not":false,"skipOnEmpty":1},"messages":{"match":"请输入整数或小数点后2位的数字"}}},{"id": "fightgroupmodel-fight_num", "name": "FightGroupModel[fight_num]", "attribute": "fight_num", "rules": {"integer":{"pattern":/^[+-]?\d+$/},"messages":{"integer":"参团人数必须是整数。","min":"参团人数必须不小于2。"},"min":2}},{"id": "fightgroupmodel-act_name", "name": "FightGroupModel[act_name]", "attribute": "act_name", "rules": {"string":true,"messages":{"string":"活动名称必须是一条字符串。","maxlength":"活动名称只能包含至多30个字符。"},"maxlength":30}},{"id": "fightgroupmodel-purchase_num", "name": "FightGroupModel[purchase_num]", "attribute": "purchase_num", "rules": {"integer":{"pattern":/^[+-]?\d+$/},"messages":{"integer":"限购必须是整数。","min":"限购必须不小于0。","max":"限购必须不大于999999。"},"min":0,"max":999999}},{"id": "fightgroupmodel-fight_time", "name": "FightGroupModel[fight_time]", "attribute": "fight_time", "rules": {"match":{"pattern":/^[0-9]+(.[0-9]{1,2})?$/,"not":false,"skipOnEmpty":1},"messages":{"match":"请输入整数或小数点后2位的数字"}}},{"id": "fightgroupmodel-fight_time", "name": "FightGroupModel[fight_time]", "attribute": "fight_time", "rules": {"compare":{"operator":">","type":"string","compareValue":0,"skipOnEmpty":1},"messages":{"compare":"成团时限的值必须大于\"0\"。"}}},{"id": "fightgroupmodel-number", "name": "FightGroupModel[number]", "attribute": "number", "rules": {"compare":{"operator":">","type":"string","compareValue":0,"skipOnEmpty":1},"messages":{"compare":"Number的值必须大于\"0\"。"}}},{"id": "fightgroupmodel-fight_time", "name": "FightGroupModel[fight_time]", "attribute": "fight_time", "rules": {"compare":{"operator":"<","type":"string","compareValue":10000,"skipOnEmpty":1},"messages":{"compare":"成团时限的值必须小于\"10000\"。"}}},{"id": "fightgroupmodel-number", "name": "FightGroupModel[number]", "attribute": "number", "rules": {"compare":{"operator":"<","type":"string","compareValue":10000,"skipOnEmpty":1},"messages":{"compare":"Number的值必须小于\"10000\"。"}}},{"id": "fightgroupmodel-start_time", "name": "FightGroupModel[start_time]", "attribute": "start_time", "rules": {"compare":{"operator":"<","type":"date","compareAttribute":"fightgroupmodel-end_time","skipOnEmpty":1},"messages":{"compare":"开始时间不能大于结束时间"}}},{"id": "fightgroupmodel-end_time", "name": "FightGroupModel[end_time]", "attribute": "end_time", "rules": {"compare":{"operator":">=","type":"date","compareAttribute":"fightgroupmodel-start_time","skipOnEmpty":1},"messages":{"compare":"结束时间不能小于开始时间"}}}]
</script>
    <script type="text/javascript">
        //
    </script>
@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block--}}
@section('extra_html')

@stop


{{--helper_tool--}}
@section('helper_tool')

@stop

{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer_js page元素同级下面--}}
@section('footer_js')
    <script src="/assets/d2eace91/js/validate/jquery.metadata.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=1.1"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js?v=1.1"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/activity.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/json2csv.js?v=1.1"></script>
@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <script>
        $().ready(function() {
            //悬浮显示上下步骤按钮
            window.onscroll = function() {
                $(window).scroll(function() {
                    var scrollTop = $(document).scrollTop();
                    var height = $(".page").height();
                    var wHeight = $(window).height();
                    if (scrollTop > (height - wHeight)) {
                        $(".bottom-btn").removeClass("bottom-btn-fixed");
                    } else {
                        $(".bottom-btn").addClass("bottom-btn-fixed");
                    }
                });
            };
            var activity = $.activityInfo({
                listPageUrl: '/dashboard/fight-group/list',
                progressKey: 'shop:activity:progress:info:8',
            });
            $("#select_goods").click(function() {
                var container = $(this).parents(".fight-group-goods").find(".widget_goods");
                var values = [];
                //
                if (!$.goodspicker(container)) {
                    // 初始化组件，为容器绑定组件
                    var goodspicker = $(container).goodspicker({
                        url: '/dashboard/fight-group/picker',
                        data: {
                            page: {},
                            is_sku: 0,
                            current_act_type: '6'
                        },
                        values: values,
                        click: function(selected, sku) {
                            if (sku.goods_number == 0) {
                                $.msg('该商品库存为0！');
                                return false;
                            }
                            for ( var key in this.values) {
                                var goods_id = this.values[key].goods_id;
                                var sku_id = this.values[key].sku_id;
                                if (sku_id != sku.sku_id) {
                                    this.remove(goods_id, sku_id);
                                }
                            }
                            $("#select_goods_id").val(sku.goods_id);
                            $('#goods_stock').val(sku.goods_number);
                            if (selected == true) {
                                $("#goods_image").html("<img src='"+sku.goods_image+"'>");
                                $("#goods_name").html(sku.goods_name);
                                $(container).hide();
                                // 获取sku列表
                                var is_commander_discount = $("input[name='FightGroupModel[is_commander_discount]']:checked").val();
                                showSkuList(sku.goods_id,is_commander_discount);
                            }else{
                                $("#select_goods_id").val('');
                                $('#goods_stock').val('');
                                $('#sku_list_container').html('');
                            }
                        }
                    });
                } else {
                    if ($(container).is(":hidden")) {
                        $(container).show();
                    } else {
                        $(container).hide();
                    }
                }
            });
            $('input[name="FightGroupModel[is_commander_discount]"]').on('switchChange.bootstrapSwitch', function(event, state) {
                if(state == true){
                    var is_commander_discount = 1;
                }else{
                    var is_commander_discount = 0;
                }
                var goods_id = $("#select_goods_id").val();
                showSkuList(goods_id, is_commander_discount);
            });
            function showSkuList(goods_id,is_commander_discount) {
                // 获取sku列表
                if (goods_id > 0) {
                    $.get('/dashboard/fight-group/sku-list', {
                        goods_id: goods_id,
                        is_commander_discount: is_commander_discount,
                        is_going : ''
                    }, function(result) {
                        $('#sku_list_container').html(result.data);
                    }, 'JSON');
                }
            }
            var validator = $("#FightGroupModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                var goods_id = $("#select_goods_id").val();
                if (goods_id == "" || goods_id == 0) {
                    $.msg("请选择商品！");
                    return false;
                }
                if (!validator.form()) {
                    return;
                }
                $.loading.start();
                var target = $(this);
                $(target).prop("disabled", true);
                $(target).addClass("disabled");
                var url = null;
                var data = $("#FightGroupModel").serializeJson();
                var msg = null;
                if ("" == "") {
                    url = '/dashboard/fight-group/add';
                    msg = '您确定添加拼团活动吗？当前操作可能会花费很长时间而且请勿中断！';
                } else {
                    url = '/dashboard/fight-group/edit?id=';
                    msg = '您确定保存拼团活动吗？当前操作可能会花费很长时间而且请勿中断！';
                }
                $.confirm(msg, function () {
                    activity.request(url, data, target);
                }, function () {
                    $(target).prop("disabled", false);
                    $(target).removeClass("disabled");
                });
            });
            // 批量设置
            // 批量设置价格、库存、预警值
            $("body").on('click', ".batch > .batch-edit", function() {
                $('.batch > .batch-input').hide();
                $(this).next().show();
            });
            $("body").on('click', ".batch-input > .batch-close", function() {
                $(this).parent().hide();
            });
            // 批量设置获取焦点
            $("body").on("click", ".batch-edit", function() {
                $(this).parents(".batch").find(".batch-input").find(":text").focus();
            });
            // 批量设置获取焦点
            $("body").on("click", ".btn_batch_set", function() {
                $(this).parents(".batch").find(".batch-input").find(":text").focus();
                var type = $(this).data('type');
                if (type == 0) {
                    var batch_type = '.act_price_input';
                    var val = $(".batch_set_act_price").val();
                }else if(type == 1){
                    var batch_type = '.first_discount_input';
                    var val = $(".batch_set_first_discount").val();
                }else if(type == 2){
                    var batch_type = '.discount_price_input';
                    var val = $(".batch_set_discount_price").val();
                } else {
                    var batch_type = '.act_stock_input';
                    var val = $(".batch_set_act_stock").val();
                }
                $(batch_type).each(function() {
                    $(this).val(val);
                    $(this).blur();
                });
                if(type == 1){
                    $(".discount_price_input").each(function() {
                        $(this).attr("disabled","disabled");
                        $(this).val("0.00");
                        $('.first_discount_input').removeAttr("disabled");
                    });
                }else if(type == 2){
                    $(".first_discount_input").each(function() {
                        $(this).attr("disabled","disabled");
                        $(this).val("0.00");
                        $('.discount_price_input').removeAttr("disabled");
                    });
                }
                $(this).parent().hide();
            });
            // 菜单类型
            $("body").on("click", ".discount_mode", function() {
                var discount_mode = $(this).val();
                $.loading.start();
                $.ajax({
                    type: 'GET',
                    url: 'change-mode',
                    data: {
                        discount_mode: discount_mode
                    },
                    dataType: 'json',
                    success: function(result) {
                        $("#content").html(result.data);
                    }
                }).always(function() {
                    $.loading.stop();
                });
            });
        });
        //
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop