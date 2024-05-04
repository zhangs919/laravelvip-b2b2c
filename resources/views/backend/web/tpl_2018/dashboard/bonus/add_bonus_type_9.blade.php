{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <!--在这里调用内容-->
    <!-- 时间插件引入 start -->
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.css?v=20190327"/>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.js?v=20190319"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=20190319"></script>
    <!-- 时间插件引入 end -->
    <!-- 图片弹窗  star-->
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=20190319"></script>
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=20190319"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20190319"></script>
    <!-- 图片弹窗  end-->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20190319"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20190319"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20190319"></script>

    <!-- 购后送红包 -->
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20190327"/>
@stop

{{--content--}}
@section('content')

    <form id="Bonus" class="form-horizontal" name="Bonus" action="/dashboard/bonus/add?bonus_type=9" method="post" enctype="multipart/form-data" novalidate="novalidate">
        @csrf
        <input type="hidden" id="bonus-bonus_id" class="form-control" name="Bonus[bonus_id]">

        <input type="hidden" id="bonus-bonus_type" class="form-control" name="Bonus[bonus_type]" value="9">
        <div class="table-content m-t-30 clearfix">
            <div class="simple-form-field">
                <div class="form-group form-group-showcase">
                    <label for="text4" class="col-sm-3 control-label">
                        <img src="/assets/d2eace91/images/shop/bonus.png">
                    </label>
                    <div class="col-sm-9">
                        <p class="f16" id="activity_type">推荐送红包</p>
                        <p class="help-block-t">推荐会员注册，系统自动发放红包作为奖励</p>
                    </div>
                </div>
            </div>
            <div class="form-horizontal m-t-30">
                <h5 class="m-b-30">红包基本信息</h5>
                <!-- 红包名称 -->
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="bonus-bonus_name" class="col-sm-3 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">红包名称：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">


                                <input type="text" id="bonus_name" class="form-control" name="Bonus[bonus_name]">


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">红包名称不能超过30个字符</div></div>
                        </div>
                    </div>
                </div>

                <!-- 红包面额 -->
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="bonus-bonus_amount" class="col-sm-3 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">红包面值：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">


                                <input type="text" id="bonus-bonus_amount" class="form-control ipt m-r-10" name="Bonus[bonus_amount]">


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">单个红包的面值</div></div>
                        </div>
                    </div>
                </div>


                <!-- 红包发放数量 -->
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="bonus-bonus_number" class="col-sm-3 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">红包发放数量：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">


                                <input type="text" id="bonus_number" class="form-control ipt m-r-10" name="Bonus[bonus_number]">


                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>






                <!-- 红包使用有效期 -->
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="bonus-start_time" class="col-sm-3 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">红包使用有效期：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">


                                <input type="text" id="bonus-start_time" class="form-control form_datetime_start large" name="Bonus[start_time]" value="{{ $start_time }}">
                                <span class="ctime">至</span>

                                <input type="text" id="bonus-end_time" class="form-control form_datetime_end large" name="Bonus[end_time]" value="{{ $end_time }}">


                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
                <!-- 红包使用范围 -->
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="bonus-use_range" class="col-sm-3 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">使用范围：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">


                                <label class="control-label cur-p"><input type="radio" id="use_range_0" class="use_range" name="use_range_check" value="0" checked=""> 全部商品</label>

                                <label class="control-label cur-p"><input type="radio" id="use_range_1" class="use_range" name="use_range_check" value="1"> 指定商品分类</label>
                                <div class="cat_selector m-t-5"></div>
                                <input type="hidden" id="use_range" class="form-control" name="Bonus[use_range]" value="0">


                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
                <!-- 其他信息 -->




                <h5 class="m-b-30">红包使用条件</h5>
                <div class="bonus-data">
                    <!-- 是否仅限自营店铺使用 -->
                    <div class="simple-form-field">
                        <div class="form-group">
                            <label for="bonusdata-is_self_shop" class="col-sm-3 control-label">

                                <span class="ng-binding">是否仅限自营店铺使用：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">


                                    <input type="hidden" name="bonus_data[is_self_shop]" value="0"><div id="bonusdata-is_self_shop" class="" name="bonus_data[is_self_shop]"><label class="control-label cur-p m-r-10"><input type="radio" name="bonus_data[is_self_shop]" value="1" checked=""> 仅限自营店铺可用</label>
                                        <label class="control-label cur-p m-r-10"><input type="radio" name="bonus_data[is_self_shop]" value="0"> 所有店铺可用</label></div>


                                </div>

                                <div class="help-block help-block-t"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 活动限制 -->
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="bonus-is_original_price" class="col-sm-3 control-label">

                            <span class="ng-binding">仅限原价购买时使用：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">

                                <input type="hidden" name="Bonus[is_original_price]" value="1"><div id="bonus-is_original_price" class="" name="Bonus[is_original_price]"><label class="control-label cur-p m-r-10"><input type="radio" name="Bonus[is_original_price]" value="1" checked=""> 仅限原价购买可用</label>
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="Bonus[is_original_price]" value="0"> 可与其他优惠、活动一起使用</label></div>

                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
                <!-- 订单金额限制-->
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="bonus-min_goods_amount" class="col-sm-3 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">最小订单金额限制：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">

                                <span>购物满</span>
                                <input type="text" id="bonus-min_goods_amount" class="form-control ipt m-l-10 m-r-10" name="Bonus[min_goods_amount]">
                                <span>元可用</span>

                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>



                <div class="bottom-btn p-b-30">
                    <input type="button" class="btn btn-primary btn-lg" id="btn_submit" value="确认发布">
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

    <script id="client_rules" type="text">
[{"id": "bonus-shop_id", "name": "Bonus[shop_id]", "attribute": "shop_id", "rules": {"required":true,"messages":{"required":"店铺编号不能为空。"}}},{"id": "bonus-bonus_name", "name": "Bonus[bonus_name]", "attribute": "bonus_name", "rules": {"required":true,"messages":{"required":"红包名称不能为空。"}}},{"id": "bonus-bonus_amount", "name": "Bonus[bonus_amount]", "attribute": "bonus_amount", "rules": {"required":true,"messages":{"required":"红包面值不能为空。"}}},{"id": "bonus-receive_count", "name": "Bonus[receive_count]", "attribute": "receive_count", "rules": {"required":true,"messages":{"required":"每人限领数量不能为空。"}}},{"id": "bonus-bonus_number", "name": "Bonus[bonus_number]", "attribute": "bonus_number", "rules": {"required":true,"messages":{"required":"红包发放数量不能为空。"}}},{"id": "bonus-bonus_type", "name": "Bonus[bonus_type]", "attribute": "bonus_type", "rules": {"required":true,"messages":{"required":"红包类型不能为空。"}}},{"id": "bonus-use_range", "name": "Bonus[use_range]", "attribute": "use_range", "rules": {"required":true,"messages":{"required":"使用范围不能为空。"}}},{"id": "bonus-start_time", "name": "Bonus[start_time]", "attribute": "start_time", "rules": {"required":true,"messages":{"required":"红包有效起始时间不能为空。"}}},{"id": "bonus-end_time", "name": "Bonus[end_time]", "attribute": "end_time", "rules": {"required":true,"messages":{"required":"红包有效截至时间不能为空。"}}},{"id": "bonus-is_enable", "name": "Bonus[is_enable]", "attribute": "is_enable", "rules": {"required":true,"messages":{"required":"是否有效不能为空。"}}},{"id": "bonus-is_delete", "name": "Bonus[is_delete]", "attribute": "is_delete", "rules": {"required":true,"messages":{"required":"是否删除不能为空。"}}},{"id": "bonus-min_goods_amount", "name": "Bonus[min_goods_amount]", "attribute": "min_goods_amount", "rules": {"required":true,"messages":{"required":"最小订单金额限制不能为空。"}}},{"id": "bonus-add_time", "name": "Bonus[add_time]", "attribute": "add_time", "rules": {"required":true,"messages":{"required":"红包添加时间不能为空。"}}},{"id": "bonus-shop_id", "name": "Bonus[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"店铺编号必须是整数。"}}},{"id": "bonus-receive_count", "name": "Bonus[receive_count]", "attribute": "receive_count", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"每人限领数量必须是整数。"}}},{"id": "bonus-bonus_number", "name": "Bonus[bonus_number]", "attribute": "bonus_number", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"红包发放数量必须是整数。"}}},{"id": "bonus-bonus_type", "name": "Bonus[bonus_type]", "attribute": "bonus_type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"红包类型必须是整数。"}}},{"id": "bonus-is_enable", "name": "Bonus[is_enable]", "attribute": "is_enable", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否有效必须是整数。"}}},{"id": "bonus-is_delete", "name": "Bonus[is_delete]", "attribute": "is_delete", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否删除必须是整数。"}}},{"id": "bonus-bonus_data", "name": "Bonus[bonus_data]", "attribute": "bonus_data", "rules": {"string":true,"messages":{"string":"红包扩展数据必须是一条字符串。"}}},{"id": "bonus-bonus_name", "name": "Bonus[bonus_name]", "attribute": "bonus_name", "rules": {"string":true,"messages":{"string":"红包名称必须是一条字符串。","maxlength":"红包名称只能包含至多30个字符。"},"maxlength":30}},{"id": "bonus-bonus_desc", "name": "Bonus[bonus_desc]", "attribute": "bonus_desc", "rules": {"string":true,"messages":{"string":"红包描述必须是一条字符串。","maxlength":"红包描述只能包含至多255个字符。"},"maxlength":255}},{"id": "bonus-bonus_image", "name": "Bonus[bonus_image]", "attribute": "bonus_image", "rules": {"string":true,"messages":{"string":"红包图片必须是一条字符串。","maxlength":"红包图片只能包含至多255个字符。"},"maxlength":255}},{"id": "bonus-bonus_amount", "name": "Bonus[bonus_amount]", "attribute": "bonus_amount", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"红包面值必须是一个数字。","min":"红包面值必须不小于1。"},"min":1}},{"id": "bonus-bonus_number", "name": "Bonus[bonus_number]", "attribute": "bonus_number", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"红包发放数量必须是整数。","min":"红包发放数量必须不小于1。"},"min":1}},{"id": "bonus-min_goods_amount", "name": "Bonus[min_goods_amount]", "attribute": "min_goods_amount", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"最小订单金额限制必须是一个数字。","min":"最小订单金额限制必须不小于0。"},"min":0}},{"id": "bonus-min_goods_amount", "name": "Bonus[min_goods_amount]", "attribute": "min_goods_amount", "rules": {"compare":{"operator":">=","type":"number","compareAttribute":"bonus-bonus_amount","skipOnEmpty":1},"messages":{"compare":"最小订单金额不能小于红包面值"}}},{"id": "bonus-is_original_price", "name": "Bonus[is_original_price]", "attribute": "is_original_price", "rules": {"in":{"range":["0","1"]},"messages":{"in":"仅限原价购买时使用是无效的。"}}},{"id": "bonus-start_time", "name": "Bonus[start_time]", "attribute": "start_time", "rules": {"compare":{"operator":"<","type":"date","compareAttribute":"bonus-end_time","skipOnEmpty":1},"messages":{"compare":"开始时间不能大于结束时间"}}},{"id": "bonus-end_time", "name": "Bonus[end_time]", "attribute": "end_time", "rules": {"compare":{"operator":">=","type":"date","compareAttribute":"bonus-start_time","skipOnEmpty":1},"messages":{"compare":"结束时间不能小于开始时间"}}},]
</script>
    <script type="text/javascript">
        var validator = null;
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

            validator = $("#Bonus").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());

            $("#btn_submit").click(function() {

                $('.form_datetime_end').trigger("blur");

                if (!validator.form()) {
                    return;
                }

                var data = $("#Bonus").serializeJson();

                //
                //加载提示
                $.loading.start();

                $.post("", data, function(result) {
                    if (result.code == 0) {
                        $.msg(result.message, {
                            time: 3000
                        });
                        $.go("/dashboard/bonus/list");
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "JSON").always(function() {
                    $.loading.stop();
                });
            });

            $('.form_datetime_start').datetimepicker({
                language: 'zh-CN',
                todayBtn: 1,
                autoclose: 1,
                weekStart: 0,
                startView: 2,//显示的初始示图(1:hour;2:day;3:month;4:year)
                minView: 2,//日期时间选择器所能够提供的最精确的时间选择视图(1:hour;2:day;3:month;4:year)
                //maxView: 4,
                minuteStep: 5,//分钟的阶段范围
                format: 'yyyy-mm-dd 00:00:00',
            }).on('changeDate', function(ev) {
                $(this).trigger("blur");
            });
            $('.form_datetime_end').datetimepicker({
                language: 'zh-CN',
                todayBtn: 1,
                autoclose: 1,
                weekStart: 0,
                startView: 2,//显示的初始示图(1:hour;2:day;3:month;4:year)
                minView: 2,//日期时间选择器所能够提供的最精确的时间选择视图(1:hour;2:day;3:month;4:year)
                //maxView: 4,
                minuteStep: 5,//分钟的阶段范围
                format: 'yyyy-mm-dd 23:59:59',
                startDate: "{{ $start_time }}"
            }).on('changeDate', function(ev) {
                $(this).trigger("blur");
            });
        })
    </script>
    <link rel="stylesheet" href="/assets/d2eace91/js/ztree/zTreeStyle.css?v=1.2">
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
    <script src="/assets/d2eace91/js/ztree/jquery.ztree.all-3.5.min.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=1.2"></script>
    <script type="text/javascript">
        $().ready(function() {
            // 上传图片
            $("#bonus_image_container").imagegroup({
                options: {
                    extensions: ['png', 'jpg', 'gif'],
                    maxWidth: 1024,
                    maxHeight: 268,
                    maxSize: 1024 * 1024 * 1024
                },
                callback: function(data) {
                    $("#bonus_image").val(data.path);
                    $("#bonus_image").valid();
                },
                remove: function(value, values) {
                    $("#bonus_image").val("");
                    $("#bonus_image").valid();
                }
            });

            $(".use_range").change(function() {
                if ($(this).val() == '1') {
                    $("#use_range").val("");
                    $(".cat_selector").show();
                    if ($(".cat_selector").catselector()) {
                        $(".cat_selector").catselector().show();
                    } else {
                        $(".cat_selector").catselector({
                            data: {
                                deep: 1
                            },
                            change: function() {
                                var values = this.getValues();
                                $("#use_range").val(values.join(","));
                                $("#use_range").valid();
                            }
                        }).show();
                    }
                } else {
                    $("#use_range").val("0");
                    $("#use_range").valid();
                    $(".cat_selector").hide();
                }
            });

        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop