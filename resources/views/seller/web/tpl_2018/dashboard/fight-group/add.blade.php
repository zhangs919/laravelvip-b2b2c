{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20180702"/>
@stop

{{--content--}}
@section('content')

    <form id="FightGroupModel" class="form-horizontal" name="FightGroupModel" action="/dashboard/fight-group/add" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="table-content m-t-30 clearfix fight-group-goods">
            <div class="form-horizontal">
                <!-- 隐藏域 -->
                <input type="hidden" id="fightgroupmodel-act_id" class="form-control" name="FightGroupModel[act_id]">
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

                <!-- 活动图片 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="fightgroupmodel-act_img" class="col-sm-4 control-label">

                            <span class="ng-binding">活动图片：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">

                                <div id="act_img_container"></div>
                                <input type="hidden" id="fightgroupmodel-act_img" class="form-control" name="FightGroupModel[act_img]">


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">用拼团活动页面的图片，请使用640*260像素<br>大小1M内的图片，支持jpg、jpeg、gif、png格式上传</div></div>
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

                                <select id="fightgroupmodel-cat_id" class="form-control" name="FightGroupModel[cat_id]">
                                    <option value="395">大金智能锁</option>
                                    <option value="393">aa</option>
                                    <option value="394">点吧</option>
                                    <option value="396">123</option>
                                </select>


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">活动分类可在平台方后台->商城->促销->拼团->拼团分类添加</div></div>
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
                                <input type="text" id="fightgroupmodel-start_time" class="form-control form_datetime large" name="FightGroupModel[start_time]" value="2019-02-13 15:43:08" data-rule-date="true">
                                <span class="ctime">至</span>
                                <input type="text" id="fightgroupmodel-end_time" class="form-control form_datetime large" name="FightGroupModel[end_time]" value="2019-02-20 15:43:08" data-rule-date="true">
                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
                <!-- 拼团价格 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="fightgroupmodel-act_price" class="col-sm-4 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">拼团价格：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">

                                <input type="text" id="fightgroupmodel-act_price" class="form-control ipt m-r-10" name="FightGroupModel[act_price]">元
                                <span id="goods_price" class="m-l-20">
							</span>
                                <input type="hidden" id="shop_price">


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">拼团价不能大于店铺价</div></div>
                        </div>
                    </div>
                </div>
                <!-- 优惠模式 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="fightgroupmodel-discount_mode" class="col-sm-4 control-label">

                            <span class="ng-binding">优惠模式：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">


                                <label class="control-label cur-p"><input type="radio" class="discount_mode" name="FightGroupModel[discount_mode]" value="0" checked> 团长享受折扣</label>

                                <label class="control-label cur-p"><input type="radio" class="discount_mode" name="FightGroupModel[discount_mode]" value="1"> 团长优惠价格</label>



                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
                <div id="content">
                    <div class="simple-form-field" >
                        <div class="form-group">
                            <label for="fightgroupmodel-first_discount" class="col-sm-4 control-label">

                                <span class="ng-binding">团长享受折扣：</span>
                            </label>
                            <div class="col-sm-8">
                                <div class="form-control-box">
                                    <input type="text" id="fightgroupmodel-first_discount" class="form-control ipt m-r-10" name="FightGroupModel[first_discount]">%

                                </div>

                                <div class="help-block help-block-t"><div class="help-block help-block-t">团长享受折扣价是以拼团价格为计算基数的；例如：商品拼团价为10元，团长享受折扣为90%，那么团长购买此商品最终的价格即为9元</div></div>
                            </div>
                        </div>
                    </div>
                    <!-- 表单验证 -->
                    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20190121"></script>
                    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20190121"></script>
                    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20190121"></script>
                    <!-- 验证规则 -->
                    <script id="client_rules" type="text">
[{"id": "fightgroupmodel-goods_id", "name": "FightGroupModel[goods_id]", "attribute": "goods_id", "rules": {"required":true,"messages":{"required":"商品ID不能为空。"}}},{"id": "fightgroupmodel-cat_id", "name": "FightGroupModel[cat_id]", "attribute": "cat_id", "rules": {"required":true,"messages":{"required":"活动分类不能为空。"}}},{"id": "fightgroupmodel-act_price", "name": "FightGroupModel[act_price]", "attribute": "act_price", "rules": {"required":true,"messages":{"required":"拼团价格不能为空。"}}},{"id": "fightgroupmodel-act_stock", "name": "FightGroupModel[act_stock]", "attribute": "act_stock", "rules": {"required":true,"messages":{"required":"活动库存不能为空。"}}},{"id": "fightgroupmodel-fight_num", "name": "FightGroupModel[fight_num]", "attribute": "fight_num", "rules": {"required":true,"messages":{"required":"参团人数不能为空。"}}},{"id": "fightgroupmodel-fight_time", "name": "FightGroupModel[fight_time]", "attribute": "fight_time", "rules": {"required":true,"messages":{"required":"成团时限不能为空。"}}},{"id": "fightgroupmodel-start_time", "name": "FightGroupModel[start_time]", "attribute": "start_time", "rules": {"required":true,"messages":{"required":"活动有效期不能为空。"}}},{"id": "fightgroupmodel-end_time", "name": "FightGroupModel[end_time]", "attribute": "end_time", "rules": {"required":true,"messages":{"required":"活动结束时间不能为空。"}}},{"id": "fightgroupmodel-shop_id", "name": "FightGroupModel[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"店铺ID必须是整数。"}}},{"id": "fightgroupmodel-discount_mode", "name": "FightGroupModel[discount_mode]", "attribute": "discount_mode", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"优惠模式必须是整数。"}}},{"id": "fightgroupmodel-ext_info", "name": "FightGroupModel[ext_info]", "attribute": "ext_info", "rules": {"string":true,"messages":{"string":"扩展字段必须是一条字符串。"}}},{"id": "fightgroupmodel-act_price", "name": "FightGroupModel[act_price]", "attribute": "act_price", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"拼团价格必须是一个数字。","max":"拼团价格必须不大于999999。"},"max":999999}},{"id": "fightgroupmodel-act_price", "name": "FightGroupModel[act_price]", "attribute": "act_price", "rules": {"compare":{"operator":">","type":"string","compareValue":0,"skipOnEmpty":1},"messages":{"compare":"拼团价格的值必须大于\"0\"。"}}},{"id": "fightgroupmodel-number", "name": "FightGroupModel[number]", "attribute": "number", "rules": {"compare":{"operator":">","type":"string","compareValue":0,"skipOnEmpty":1},"messages":{"compare":"Number的值必须大于\"0\"。"}}},{"id": "fightgroupmodel-act_price", "name": "FightGroupModel[act_price]", "attribute": "act_price", "rules": {"match":{"pattern":/^[0-9]+(.[0-9]{1,2})?$/,"not":false,"skipOnEmpty":1},"messages":{"match":"请输入整数或小数点后2位的数字"}}},{"id": "fightgroupmodel-act_stock", "name": "FightGroupModel[act_stock]", "attribute": "act_stock", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"活动库存必须是整数。","min":"活动库存必须不小于2。","max":"活动库存必须不大于999999。"},"min":2,"max":999999}},{"id": "fightgroupmodel-fight_num", "name": "FightGroupModel[fight_num]", "attribute": "fight_num", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"参团人数必须是整数。","min":"参团人数必须不小于2。"},"min":2}},{"id": "fightgroupmodel-purchase_num", "name": "FightGroupModel[purchase_num]", "attribute": "purchase_num", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"限购必须是整数。","min":"限购必须不小于0。","max":"限购必须不大于999999。"},"min":0,"max":999999}},{"id": "fightgroupmodel-first_discount", "name": "FightGroupModel[first_discount]", "attribute": "first_discount", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"团长享受折扣必须是整数。","min":"团长享受折扣必须不小于1。","max":"团长享受折扣必须不大于100。"},"min":1,"max":100}},{"id": "fightgroupmodel-fight_time", "name": "FightGroupModel[fight_time]", "attribute": "fight_time", "rules": {"compare":{"operator":">","type":"string","compareValue":0,"skipOnEmpty":1},"messages":{"compare":"成团时限的值必须大于\"0\"。"}}},{"id": "fightgroupmodel-number", "name": "FightGroupModel[number]", "attribute": "number", "rules": {"compare":{"operator":">","type":"string","compareValue":0,"skipOnEmpty":1},"messages":{"compare":"Number的值必须大于\"0\"。"}}},{"id": "fightgroupmodel-fight_time", "name": "FightGroupModel[fight_time]", "attribute": "fight_time", "rules": {"compare":{"operator":"<","type":"string","compareValue":10000,"skipOnEmpty":1},"messages":{"compare":"成团时限的值必须小于\"10000\"。"}}},{"id": "fightgroupmodel-number", "name": "FightGroupModel[number]", "attribute": "number", "rules": {"compare":{"operator":"<","type":"string","compareValue":10000,"skipOnEmpty":1},"messages":{"compare":"Number的值必须小于\"10000\"。"}}},{"id": "fightgroupmodel-fight_time", "name": "FightGroupModel[fight_time]", "attribute": "fight_time", "rules": {"match":{"pattern":/^[0-9]+(.[0-9]{1,2})?$/,"not":false,"skipOnEmpty":1},"messages":{"match":"请输入整数或小数点后2位的数字"}}},{"id": "fightgroupmodel-start_time", "name": "FightGroupModel[start_time]", "attribute": "start_time", "rules": {"compare":{"operator":"<","type":"date","compareAttribute":"fightgroupmodel-end_time","skipOnEmpty":1},"messages":{"compare":"开始时间不能大于结束时间"}}},{"id": "fightgroupmodel-end_time", "name": "FightGroupModel[end_time]", "attribute": "end_time", "rules": {"compare":{"operator":">=","type":"date","compareAttribute":"fightgroupmodel-start_time","skipOnEmpty":1},"messages":{"compare":"结束时间不能小于开始时间"}}},]
</script>
                    <script type="text/javascript">
                        $().ready(function() {
                            var validator = $("#FightGroupModel").validate();
                            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
                            $.validator.addRules($("#client_rules").html());
                        });
                    </script>
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
                <!-- 活动库存 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="fightgroupmodel-act_stock" class="col-sm-4 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">活动库存：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">

                                <input type="text" id="fightgroupmodel-act_stock" class="form-control ipt m-r-10" name="FightGroupModel[act_stock]">件
                                <span id="number" class="m-l-20">
							</span>
                                <input type="hidden" id="goods_number" value="">


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">活动库存不能大于总库存</div></div>
                        </div>
                    </div>
                </div>			<!-- 参团人数 -->
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
                </div>			<!-- 成团时限 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="fightgroupmodel-fight_time" class="col-sm-4 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">成团时限：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">

                                <input type="text" id="fightgroupmodel-fight_time" class="form-control ipt m-r-10" name="FightGroupModel[fight_time]">时


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">组团限制时间，单位为小时</div></div>
                        </div>
                    </div>
                </div>			<!-- 确认提交 -->
                <div class="bottom-btn p-b-30">
                    <input type="button" id="btn_submit" name="btn_submit" class="btn btn-primary btn-lg" value="确认提交" />
                </div>

            </div>
        </div>
    </form>

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

{{--footer script page元素同级下面--}}
@section('footer_script')
    <!-- 时间插件引入 start -->
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.css?v=20190130"/> <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.js?v=20190121"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=20190121"></script>
    <!-- 时间插件引入 end -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20190121"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20190121"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20190121"></script>
    <!-- 商品选择器 -->
    <!-- AJAX上传 -->
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=20190121"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20190121"></script>
    <script id="client_rules" type="text">
[{"id": "fightgroupmodel-goods_id", "name": "FightGroupModel[goods_id]", "attribute": "goods_id", "rules": {"required":true,"messages":{"required":"商品ID不能为空。"}}},{"id": "fightgroupmodel-cat_id", "name": "FightGroupModel[cat_id]", "attribute": "cat_id", "rules": {"required":true,"messages":{"required":"活动分类不能为空。"}}},{"id": "fightgroupmodel-act_price", "name": "FightGroupModel[act_price]", "attribute": "act_price", "rules": {"required":true,"messages":{"required":"拼团价格不能为空。"}}},{"id": "fightgroupmodel-act_stock", "name": "FightGroupModel[act_stock]", "attribute": "act_stock", "rules": {"required":true,"messages":{"required":"活动库存不能为空。"}}},{"id": "fightgroupmodel-fight_num", "name": "FightGroupModel[fight_num]", "attribute": "fight_num", "rules": {"required":true,"messages":{"required":"参团人数不能为空。"}}},{"id": "fightgroupmodel-fight_time", "name": "FightGroupModel[fight_time]", "attribute": "fight_time", "rules": {"required":true,"messages":{"required":"成团时限不能为空。"}}},{"id": "fightgroupmodel-start_time", "name": "FightGroupModel[start_time]", "attribute": "start_time", "rules": {"required":true,"messages":{"required":"活动有效期不能为空。"}}},{"id": "fightgroupmodel-end_time", "name": "FightGroupModel[end_time]", "attribute": "end_time", "rules": {"required":true,"messages":{"required":"活动结束时间不能为空。"}}},{"id": "fightgroupmodel-shop_id", "name": "FightGroupModel[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"店铺ID必须是整数。"}}},{"id": "fightgroupmodel-discount_mode", "name": "FightGroupModel[discount_mode]", "attribute": "discount_mode", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"优惠模式必须是整数。"}}},{"id": "fightgroupmodel-ext_info", "name": "FightGroupModel[ext_info]", "attribute": "ext_info", "rules": {"string":true,"messages":{"string":"扩展字段必须是一条字符串。"}}},{"id": "fightgroupmodel-act_price", "name": "FightGroupModel[act_price]", "attribute": "act_price", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"拼团价格必须是一个数字。","max":"拼团价格必须不大于999999。"},"max":999999}},{"id": "fightgroupmodel-act_price", "name": "FightGroupModel[act_price]", "attribute": "act_price", "rules": {"compare":{"operator":">","type":"string","compareValue":0,"skipOnEmpty":1},"messages":{"compare":"拼团价格的值必须大于\"0\"。"}}},{"id": "fightgroupmodel-number", "name": "FightGroupModel[number]", "attribute": "number", "rules": {"compare":{"operator":">","type":"string","compareValue":0,"skipOnEmpty":1},"messages":{"compare":"Number的值必须大于\"0\"。"}}},{"id": "fightgroupmodel-act_price", "name": "FightGroupModel[act_price]", "attribute": "act_price", "rules": {"match":{"pattern":/^[0-9]+(.[0-9]{1,2})?$/,"not":false,"skipOnEmpty":1},"messages":{"match":"请输入整数或小数点后2位的数字"}}},{"id": "fightgroupmodel-act_stock", "name": "FightGroupModel[act_stock]", "attribute": "act_stock", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"活动库存必须是整数。","min":"活动库存必须不小于2。","max":"活动库存必须不大于999999。"},"min":2,"max":999999}},{"id": "fightgroupmodel-fight_num", "name": "FightGroupModel[fight_num]", "attribute": "fight_num", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"参团人数必须是整数。","min":"参团人数必须不小于2。"},"min":2}},{"id": "fightgroupmodel-purchase_num", "name": "FightGroupModel[purchase_num]", "attribute": "purchase_num", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"限购必须是整数。","min":"限购必须不小于0。","max":"限购必须不大于999999。"},"min":0,"max":999999}},{"id": "fightgroupmodel-first_discount", "name": "FightGroupModel[first_discount]", "attribute": "first_discount", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"团长享受折扣必须是整数。","min":"团长享受折扣必须不小于1。","max":"团长享受折扣必须不大于100。"},"min":1,"max":100}},{"id": "fightgroupmodel-fight_time", "name": "FightGroupModel[fight_time]", "attribute": "fight_time", "rules": {"compare":{"operator":">","type":"string","compareValue":0,"skipOnEmpty":1},"messages":{"compare":"成团时限的值必须大于\"0\"。"}}},{"id": "fightgroupmodel-number", "name": "FightGroupModel[number]", "attribute": "number", "rules": {"compare":{"operator":">","type":"string","compareValue":0,"skipOnEmpty":1},"messages":{"compare":"Number的值必须大于\"0\"。"}}},{"id": "fightgroupmodel-fight_time", "name": "FightGroupModel[fight_time]", "attribute": "fight_time", "rules": {"compare":{"operator":"<","type":"string","compareValue":10000,"skipOnEmpty":1},"messages":{"compare":"成团时限的值必须小于\"10000\"。"}}},{"id": "fightgroupmodel-number", "name": "FightGroupModel[number]", "attribute": "number", "rules": {"compare":{"operator":"<","type":"string","compareValue":10000,"skipOnEmpty":1},"messages":{"compare":"Number的值必须小于\"10000\"。"}}},{"id": "fightgroupmodel-fight_time", "name": "FightGroupModel[fight_time]", "attribute": "fight_time", "rules": {"match":{"pattern":/^[0-9]+(.[0-9]{1,2})?$/,"not":false,"skipOnEmpty":1},"messages":{"match":"请输入整数或小数点后2位的数字"}}},{"id": "fightgroupmodel-start_time", "name": "FightGroupModel[start_time]", "attribute": "start_time", "rules": {"compare":{"operator":"<","type":"date","compareAttribute":"fightgroupmodel-end_time","skipOnEmpty":1},"messages":{"compare":"开始时间不能大于结束时间"}}},{"id": "fightgroupmodel-end_time", "name": "FightGroupModel[end_time]", "attribute": "end_time", "rules": {"compare":{"operator":">=","type":"date","compareAttribute":"fightgroupmodel-start_time","skipOnEmpty":1},"messages":{"compare":"结束时间不能小于开始时间"}}},]
</script>
    <script type='text/javascript'>
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

            $("#select_goods").click(function() {
                var container = $(this).parents(".fight-group-goods").find(".widget_goods");

                if (!$.goodspicker(container)) {
                    // 初始化组件，为容器绑定组件
                    var goodspicker = $(container).goodspicker({
                        url: '/dashboard/fight-group/picker',
                        data: {
                            page: {},
                            is_sku: 0
                        },
                        click: function(selected, sku) {
                            console.info(sku);
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
                            if (selected == true) {
                                $("#goods_image").html("<img src='"+sku.goods_image+"'>");
                                $("#goods_name").html(sku.goods_name);
                                $("#goods_price").html("店铺价：" + '<strong class="order-amount c-orange m-r-5">' + sku.goods_price + '</strong>元');
                                $("#shop_price").val(sku.goods_price);
                                $("#number").html("总库存：" + '<strong class="order-amount c-orange m-r-5">' + sku.goods_number + '</strong>件');
                                $("#goods_number").val(sku.goods_number);
                                $(container).hide();
                            }
                        },

                    });
                } else {
                    if ($(container).is(":hidden")) {
                        $(container).show();
                    } else {
                        $(container).hide();
                    }
                }
            });

            var validator = $("#FightGroupModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                var goods_id = $("#select_goods_id").val();
                var shop_price = parseFloat($("#shop_price").val());
                var act_price = parseFloat($("#fightgroupmodel-act_price").val());
                var goods_number = parseInt($("#goods_number").val());
                var act_stock = parseInt($("#fightgroupmodel-act_stock").val());

                if (goods_id == "" || goods_id == 0) {
                    $.msg("请选择商品！");
                    return false;
                }
                if (act_price > shop_price) {
                    $.msg("拼团价格不能大于店铺价格！");
                    return false;
                }
                if (act_stock > goods_number) {
                    $.msg("活动库存不能大于总库存！");
                    return false;
                }

                if (!validator.form()) {
                    return;
                }
                $.loading.start();
                $("#FightGroupModel").submit();
            });

            $("#act_img_container").imagegroup({
                host: 'http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/',
                size: 1,
                values: [''],
                callback: function(data) {
                    $("#fightgroupmodel-act_img").val(data.path);
                },
                remove: function(value, values) {
                    $("#fightgroupmodel-act_img").val('');
                }
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
            })

            $('.form_datetime').datetimepicker({
                language: 'zh-CN',
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                forceParse: 0,
                showMeridian: 1,
                format: 'yyyy-mm-dd hh:ii:00',
            }).on('changeDate', function(ev) {
                $(this).trigger("blur");
            });

        })
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop