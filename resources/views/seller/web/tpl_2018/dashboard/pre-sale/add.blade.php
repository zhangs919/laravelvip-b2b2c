{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20180702"/>
@stop

{{--content--}}
@section('content')

    <form id="PreSaleModel" class="form-horizontal" name="PreSaleModel" action="/dashboard/pre-sale/add.html" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_csrf" value="8ISTX4q7FfERJGMZq8Af7O188G8I3CdoWnieNTqJPx-i1vE5voxPkF10BlDPi0uB1QiqOkO3aS9iD-16YtFeVw==">	<div class="table-content m-t-30 clearfix pre-sale-goods">
            <div class="form-horizontal">
                <!-- 隐藏域 -->
                <input type="hidden" id="presalemodel-act_id" class="form-control" name="PreSaleModel[act_id]">
                <!-- 预售类型 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="presalemodel-pre_sale_mode" class="col-sm-4 control-label">

                            <span class="ng-binding">预售类型：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">


                                <label class="control-label cur-p"><input type="radio" class="pre_sale_mode" name="PreSaleModel[pre_sale_mode]" value="1" checked> 定金预售</label> <label class="control-label cur-p"><input type="radio" class="pre_sale_mode" name="PreSaleModel[pre_sale_mode]" value="2"> 全款预售</label>


                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>

                <!-- 开始时间 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="presalemodel-start_time" class="col-sm-3 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">预售开始时间：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">

                                <input type="text" id="presalemodel-start_time" class="form-control form_datetime large" name="PreSaleModel[start_time]" value="2019-06-09">


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">预售活动开始时间</div></div>
                        </div>
                    </div>
                </div>
                <!-- 结束时间 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="presalemodel-end_time" class="col-sm-3 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">预售结束时间：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">

                                <input type="text" id="presalemodel-end_time" class="form-control form_datetime large" name="PreSaleModel[end_time]" value="2019-06-16">


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">预售活动截止时间，该时间点也是作为订单第二阶段尾款支付时间起始点</div></div>
                        </div>
                    </div>
                </div>
                <!-- 尾款提醒 -->
                <div id="tail_money_remind_box" class="">
                    <div class="simple-form-field" >
                        <div class="form-group">
                            <label for="presalemodel-tail_money_remind" class="col-sm-4 control-label">

                                <span class="ng-binding">尾款消息提醒：</span>
                            </label>
                            <div class="col-sm-8">
                                <div class="form-control-box">

                                    <input type="text" id="presalemodel-tail_money_remind" class="form-control ipt m-r-10" name="PreSaleModel[tail_money_remind]" value="0">小时


                                </div>

                                <div class="help-block help-block-t"><div class="help-block help-block-t">通过消息向客户发送尾款支付提醒, 可以设置提前几个小时给客户发送提醒消息，0则不提醒</div></div>
                            </div>
                        </div>
                    </div>			</div>

                <!-- 发货时间 -->
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="liveauthmodel-all_number" class="col-sm-3 control-label">
                            <span class="ng-binding">发货时间：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">




                                <input type="radio" name="PreSaleModel[deliver_time_type]" value="0" checked="checked">
                                付款成功
                                <input type="text" class="form-control w100 m-l-10 m-r-10 deliver-time" name="PreSaleModel[deliver_time_0]" value="">
                                天后发货



                                <input class="m-l-30" type="radio" name="PreSaleModel[deliver_time_type]" value="1">
                                <input type="text" class="form-control w100 m-r-10 form_datetime deliver-time" name="PreSaleModel[deliver_time_1]" value="">
                                开始发货
                            </div>
                            <div class="help-block help-block-t">
                                约定几号开始发货，适合批量加工，集中采买类业务，请务必按照约定时间发货以免引起客户投诉。
                                </br>
                                设置付款成功x天后发货，适合定制类业务，比如服装定制，付款完成10天后发货。
                            </div>
                            <input type="hidden" id="presalemodel-deliver_time" class="form-control" name="PreSaleModel[deliver_time]">
                        </div>
                    </div>
                </div>
                <!-- 限购 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="presalemodel-purchase_num" class="col-sm-4 control-label">

                            <span class="ng-binding">限购数量：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">

                                <input type="text" id="presalemodel-purchase_num" class="form-control ipt m-r-10" name="PreSaleModel[purchase_num]" value="0">件


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">限制会员购买活动中的每件商品的限购数量，为0或空时，则不限购</div></div>
                        </div>
                    </div>
                </div>
                <div class="simple-form-field">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">预售商品：</span>
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
                            <div id="sku_list_container"></div>
                            <input type="hidden" id="select_goods_id" name="select_goods_id" value="" />
                        </div>
                    </div>
                </div>
                <input type="hidden" id="goods_stock" class="form-control" name="PreSaleModel[act_stock]">
                <!-- 确认提交 -->
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
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.css?v=2019042333"/> <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.js?v=201902541"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=201902541"></script>
    <!-- 时间插件引入 end -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=201902541"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=201902541"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=201902541"></script>
    <!-- 商品选择器 -->
    <!-- AJAX上传 -->
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=201902541"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=201902541"></script>
    <script id="client_rules" type="text">
[{"id": "presalemodel-goods_id", "name": "PreSaleModel[goods_id]", "attribute": "goods_id", "rules": {"required":true,"messages":{"required":"商品ID不能为空。"}}},{"id": "presalemodel-act_price", "name": "PreSaleModel[act_price]", "attribute": "act_price", "rules": {"required":true,"messages":{"required":"预售价格不能为空。"}}},{"id": "presalemodel-start_time", "name": "PreSaleModel[start_time]", "attribute": "start_time", "rules": {"required":true,"messages":{"required":"预售开始时间不能为空。"}}},{"id": "presalemodel-end_time", "name": "PreSaleModel[end_time]", "attribute": "end_time", "rules": {"required":true,"messages":{"required":"预售结束时间不能为空。"}}},{"id": "presalemodel-deliver_time", "name": "PreSaleModel[deliver_time]", "attribute": "deliver_time", "rules": {"required":true,"messages":{"required":"发货时间不能为空。"}}},{"id": "presalemodel-shop_id", "name": "PreSaleModel[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"店铺ID必须是整数。"}}},{"id": "presalemodel-pre_sale_mode", "name": "PreSaleModel[pre_sale_mode]", "attribute": "pre_sale_mode", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"预售类型必须是整数。"}}},{"id": "presalemodel-purchase_num", "name": "PreSaleModel[purchase_num]", "attribute": "purchase_num", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"限购数量必须是整数。","min":"限购数量必须不小于0。"},"min":0}},{"id": "presalemodel-tail_money_remind", "name": "PreSaleModel[tail_money_remind]", "attribute": "tail_money_remind", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"尾款消息提醒必须是整数。","min":"尾款消息提醒必须不小于0。"},"min":0}},{"id": "presalemodel-deliver_time_0", "name": "PreSaleModel[deliver_time_0]", "attribute": "deliver_time_0", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"天数必须是整数。","min":"天数必须不小于1。"},"min":1}},{"id": "presalemodel-deliver_time_1", "name": "PreSaleModel[deliver_time_1]", "attribute": "deliver_time_1", "rules": {"compare":{"operator":">","type":"date","compareAttribute":"presalemodel-end_time","skipOnEmpty":1},"messages":{"compare":"发货时间不能小于结束时间"}}},{"id": "presalemodel-ext_info", "name": "PreSaleModel[ext_info]", "attribute": "ext_info", "rules": {"string":true,"messages":{"string":"扩展字段必须是一条字符串。"}}},{"id": "presalemodel-act_price", "name": "PreSaleModel[act_price]", "attribute": "act_price", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"预售价格必须是一个数字。","max":"预售价格必须不大于999999。"},"max":999999}},{"id": "presalemodel-earnest_money", "name": "PreSaleModel[earnest_money]", "attribute": "earnest_money", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"定金必须是一个数字。","max":"定金必须不大于999999。"},"max":999999}},{"id": "presalemodel-tail_money", "name": "PreSaleModel[tail_money]", "attribute": "tail_money", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"尾款必须是一个数字。","max":"尾款必须不大于999999。"},"max":999999}},{"id": "presalemodel-act_price", "name": "PreSaleModel[act_price]", "attribute": "act_price", "rules": {"compare":{"operator":">","type":"string","compareValue":0,"skipOnEmpty":1},"messages":{"compare":"预售价格的值必须大于\"0\"。"}}},{"id": "presalemodel-earnest_money", "name": "PreSaleModel[earnest_money]", "attribute": "earnest_money", "rules": {"compare":{"operator":">","type":"string","compareValue":0,"skipOnEmpty":1},"messages":{"compare":"定金的值必须大于\"0\"。"}}},{"id": "presalemodel-tail_money", "name": "PreSaleModel[tail_money]", "attribute": "tail_money", "rules": {"compare":{"operator":">","type":"string","compareValue":0,"skipOnEmpty":1},"messages":{"compare":"尾款的值必须大于\"0\"。"}}},{"id": "presalemodel-number", "name": "PreSaleModel[number]", "attribute": "number", "rules": {"compare":{"operator":">","type":"string","compareValue":0,"skipOnEmpty":1},"messages":{"compare":"Number的值必须大于\"0\"。"}}},{"id": "presalemodel-act_price", "name": "PreSaleModel[act_price]", "attribute": "act_price", "rules": {"match":{"pattern":/^[0-9]+(.[0-9]{1,2})?$/,"not":false,"skipOnEmpty":1},"messages":{"match":"请输入整数或小数点后2位的数字"}}},{"id": "presalemodel-earnest_money", "name": "PreSaleModel[earnest_money]", "attribute": "earnest_money", "rules": {"match":{"pattern":/^[0-9]+(.[0-9]{1,2})?$/,"not":false,"skipOnEmpty":1},"messages":{"match":"请输入整数或小数点后2位的数字"}}},{"id": "presalemodel-tail_money", "name": "PreSaleModel[tail_money]", "attribute": "tail_money", "rules": {"match":{"pattern":/^[0-9]+(.[0-9]{1,2})?$/,"not":false,"skipOnEmpty":1},"messages":{"match":"请输入整数或小数点后2位的数字"}}},{"id": "presalemodel-start_time", "name": "PreSaleModel[start_time]", "attribute": "start_time", "rules": {"compare":{"operator":"<","type":"date","compareAttribute":"presalemodel-end_time","skipOnEmpty":1},"messages":{"compare":"开始时间不能大于结束时间"}}},{"id": "presalemodel-end_time", "name": "PreSaleModel[end_time]", "attribute": "end_time", "rules": {"compare":{"operator":">=","type":"date","compareAttribute":"presalemodel-start_time","skipOnEmpty":1},"messages":{"compare":"结束时间不能小于开始时间"}}},]
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
                var container = $(this).parents(".pre-sale-goods").find(".widget_goods");
                var values = [];

                /*todo */
                @if(isset($model['act_id']))
                    values['{{ $goods_info['goods_id'] }}-{{ $goods_info['sku_id'] }}'] = {
                        goods_id: '{{ $goods_info['goods_id'] }}',
                        sku_id: '{{ $goods_info['sku_id'] }}',
                    };
                @endif


                if (!$.goodspicker(container)) {
                    // 初始化组件，为容器绑定组件
                    var goodspicker = $(container).goodspicker({
                        url: '/dashboard/pre-sale/picker',
                        data: {
                            page: {},
                            is_sku: 0,
                            current_act_type: '2'
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
                                var pre_sale_mode = $("input[name='PreSaleModel[pre_sale_mode]']:checked").val();
                                showSkuList(sku.goods_id, pre_sale_mode);
                            }else{
                                $("#select_goods_id").val('');
                                $('#goods_stock').val('');
                                $('#sku_list_container').html('');
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

            $("input[name='PreSaleModel[pre_sale_mode]']").change(function() {
                var pre_sale_mode = $(this).val();
                if(pre_sale_mode == '2'){
                    $('#tail_money_remind_box').addClass('hide');
                }else{
                    $('#tail_money_remind_box').removeClass('hide');
                }
                var goods_id = $("#select_goods_id").val();
                showSkuList(goods_id, pre_sale_mode);
            });

            function showSkuList(goods_id, pre_sale_mode) {
                // 获取sku列表
                if (goods_id > 0) {
                    $.get('/dashboard/pre-sale/sku-list', {
                        /*todo */
                        @if(isset($model['act_id']))
                            act_id : '{{ $model['act_id'] }}',
                        @endif
                        goods_id: goods_id,
                        pre_sale_mode: pre_sale_mode
                    }, function(result) {
                        $('#sku_list_container').html(result.data);
                    }, 'JSON');
                }
            }


            /*todo */
            @if(isset($model['act_id']))
                showSkuList('{{ $goods_info['goods_id'] }}', '1');
            @endif

            var validator = $("#PreSaleModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                var goods_id = $("#select_goods_id").val();
                $.each($("input[name='PreSaleModel[deliver_time_type]']"), function() {
                    if ($(this).is(':checked')) {
                        $('#presalemodel-deliver_time').val($(this).next('.deliver-time').val());
                    }
                });

                // 计算数据
                $.each($('.sku-list-tr'),function(i,v){
                    if(!$(v).hasClass('disabled')){
                        var act_price = parseFloat($(v).find('td .act_price_input').val());
                        var earnest_money = parseFloat($(v).find('td .earnest_money_input').val());
                        if(act_price > 0  && earnest_money > 0 && act_price > earnest_money && ($.trim($(v).find('td .tail_money_input').val()) == '' || parseInt($(v).find('td .tail_money_input').val()) == 0)){
                            $(v).find('td .tail_money_input').val(Math.floor((act_price - earnest_money) * 100) / 100);
                        }
                    }

                });
                if (goods_id == "" || goods_id == 0) {
                    $.msg("请选择商品！");
                    return false;
                }

                if (!validator.form()) {
                    return;
                }

                $.loading.start();



                $.post('/dashboard/pre-sale/@if(!isset($model['act_id'])){{ 'add' }}@else{{ 'edit?id='.$model['act_id'] }}@endif', $("#PreSaleModel").serializeJson(), function(result) {
                    // 停止加载
                    $.loading.stop();
                    if (result.code == 0) {
                        $.msg(result.message, {
                            time: 3000
                        });
                        // 加载
                        $.loading.start();
                        $.go('/dashboard/pre-sale/list');
                    } else {
                        $('#sku_list_container').find('#sku_list_'+result.data).find('input').addClass('error');
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, 'json');

            });

            $('.form_datetime').datetimepicker({
                language: 'zh-CN',
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                forceParse: 0,
                minView: 2, // 只选年月日
                showMeridian: 1,
                format: 'yyyy-mm-dd',
            }).on('changeDate', function(ev) {
                $(this).trigger("blur");
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
                    var batch_type = '.earnest_money_input';
                    var val = $(".batch_set_earnest_money").val();
                } else {
                    var batch_type = '.tail_money_input';
                    var val = $(".batch_set_tail_money").val();
                }
                $(batch_type).each(function() {
                    if($(this).prop("disabled") == false){
                        $(this).val(val);
                        $(this).blur();
                    }
                });
                $(this).parent().hide();
            });

            // 自动计算尾款
            $('body').on('blur', '.earnest_money_input' , function(){
                var act_price = parseFloat($(this).parents('.sku-list-tr').find('td .act_price_input').val());
                var earnest_money = parseFloat($(this).parents('.sku-list-tr').find('td .earnest_money_input').val());
                if(act_price > 0  && earnest_money > 0 && act_price > earnest_money && ($.trim($(this).parents('.sku-list-tr').find('td .tail_money_input').val()) == '' || parseInt($(this).parents('.sku-list-tr').find('td .tail_money_input').val()) == 0)){
                    $(this).parents('.sku-list-tr').find('td .tail_money_input').val(Math.floor((act_price - earnest_money) * 100) / 100);
                }

            });

        });
    </script>

    <script type='text/javascript'>
        function clearNoNum(obj){
            obj.value = obj.value.replace(/[^\d.]/g,"");  //清除“数字”和“.”以外的字符
            obj.value = obj.value.replace(/\.{2,}/g,"."); //只保留第一个. 清除多余的
            obj.value = obj.value.replace(".","$#$").replace(/\./g,"").replace("$#$",".");
            obj.value = obj.value.replace(/^(\-)*(\d+)\.(\d\d).*$/,'$1$2.$3');//只能输入两个小数
            if(obj.value.indexOf(".")< 0 && obj.value !=""){//以上已经过滤，此处控制的是如果没有小数点，首位不能为类似于 01、02的金额
                obj.value= parseFloat(obj.value);
            }
        }
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop