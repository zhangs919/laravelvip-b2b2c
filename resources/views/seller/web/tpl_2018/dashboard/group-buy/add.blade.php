{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20180702"/>
@stop

{{--content--}}
@section('content')

    <form id="ActivityModel" class="form-horizontal" name="ActivityModel" action="/dashboard/group-buy/add" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="table-content m-t-30 clearfix group-buy-goods">
            <div class="form-horizontal">
                <!-- 隐藏域 -->
                <input type="hidden" id="activitymodel-act_id" class="form-control" name="ActivityModel[act_id]">
                <!-- 活动名称 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="activitymodel-act_name" class="col-sm-3 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">活动名称：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">


                                <input type="text" id="activitymodel-act_name" class="form-control" name="ActivityModel[act_name]">


                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
                <!-- 活动标题 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="activitymodel-act_title" class="col-sm-3 control-label">

                            <span class="ng-binding">活动标题：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">


                                <input type="text" id="activitymodel-act_title" class="form-control" name="ActivityModel[act_title]">


                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>  <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="activitymodel-start_time" class="col-sm-3 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">活动有效期：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">
                                <input type="text" id="activitymodel-start_time" class="form-control form_datetime large" name="ActivityModel[start_time]" value="2018-09-22 12:52:25">
                                <span class="ctime">至</span>
                                <input type="text" id="activitymodel-end_time" class="form-control form_datetime large" name="ActivityModel[end_time]" value="2018-09-29 12:52:25">
                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div> 			<!-- 限购数量 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="activitymodel-purchase_num" class="col-sm-3 control-label">

                            <span class="ng-binding">限购数量：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">


                                <input type="text" id="activitymodel-purchase_num" class="form-control ipt" name="ActivityModel[purchase_num]">


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">限制会员购买活动中的每件商品的限购数量，为0则不限购</div></div>
                        </div>
                    </div>
                </div>


                <!-- 活动图片 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="activitymodel-act_img" class="col-sm-3 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">活动图片：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">



                                <div id="act_img_container"></div>
                                <input type="hidden" id="activitymodel-act_img" class="form-control" name="ActivityModel[act_img]">


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">用户团购活动页面的图片，请使用400*200像素<br>大小1M内的图片，支持jpg、jpeg、gif、png格式上传</div></div>
                        </div>
                    </div>
                </div>



                <div class="simple-form-field">
                    <div class="form-group m-b-0">
                        <label class="col-sm-3 control-label"></label>
                        <div class="col-sm-9">
                            <div id="widget_goods" class="p-l-15 p-r-15"></div>
                            <div id="goods_list">

                            </div>
                        </div>
                    </div>
                </div>
                <!-- 排序 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="activitymodel-sort" class="col-sm-3 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">排序：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">


                                <input type="text" id="activitymodel-sort" class="form-control small" name="ActivityModel[sort]" value="255">


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">数字范围为0~255，数字越小越靠前</div></div>
                        </div>
                    </div>
                </div>
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
    <script id="goods" type="text">

<table id="table_list" class="table table-hover group-buy-list">
	<thead>
		<tr>
			<th class="w200">商品名称</th>
			<th class="w150">商品分类</th>
			<th class="w100 text-c">
				<span class="text-danger ng-binding">*</span>
				促销价
			</th>
			<th class="w80">商品售价</th>
			<th class="w70">库存</th>
			<th class="w80 text-c">
				<span class="text-danger ng-binding">*</span>
				活动库存
			</th>
			<th class="w100 text-c">
				历史销量
			</th>
			<th class="handle w90">操作</th>
		</tr>
	</thead>
	<tbody id="goods_info">
			</tbody>
</table>

<script type="text/javascript">
	$().ready(function() {
		//删除团购商品
		$("body").on("click", ".del", function() {
			var target = $(this).parents("tr");
			var goods_id = $(this).data("goods-id");
			var sku_id = $(this).data("sku-id");

			var container = $(this).parents(".group-buy-goods").find("#widget_goods");
			var goodspicker = $.goodspicker(container);

			if (goodspicker) {
				// 获取控件
				goodspicker.remove(goods_id, sku_id);
				var selected_number = goodspicker.goods_ids.length;
				if (selected_number == 0) {
					$(this).parents("table").remove();
				}
			}
			$(target).remove();
		});

	});
</script>

    </script>
    <script id="add_goods" type="text">
        <tr data-group-buy-sku-id="" data-group-buy-goods-id="">
        <td>

        <input type="hidden" name="goods_sku[]" value="">
        <input type="hidden" name="goods_spu[]" value="">
        </td>
        <td>
        <select id="categorymodel-parent_id" name="cat_id[]" data-rule-required="true" class="chosen-select form-control">

        </select>
        </td>
        <td class="text-c">
        <input class="form-control w60" type="text" name="activity_price[]" data-rule-required="true" data-msg-required="促销价不能为空！" data-rule-min="0.01" data-rule-max="9999999">
        </td>
        <td></td>
        <td></td>
        <td class="text-c">
        <input class="form-control w60" type="text" name="activity_stock[]" data-rule-required="true" data-msg-required="活动库存不能为空！" data-rule-min="1" data-rule-digits="true" data-rule-max="9999999">
        </td>
        <td class="text-c">
        <input class="form-control w60" type="text" name="virtual_sales_num[]" data-rule-min="0" data-rule-digits="true" data-rule-max="9999999">
        </td>
        <td class="handle">
        <a href="javascript:void(0);" data-sku-id="" data-goods-id="" class="del border-none">删除</a>
        </td>
        </tr>
    </script>

    <!-- 时间插件引入 start -->
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.css?v=2.0"/> <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.js?v=20180919"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=20180919"></script>
    <!-- 时间插件引入 end -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180919"></script>
    <!-- 商品选择器 -->
    <!-- AJAX上传 -->
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=20180919"></script> <script src="/assets/d2eace91/js/jquery.widget.js?v=20180919"></script>
    <script id="client_rules" type="text">
[{"id": "activitymodel-act_name", "name": "ActivityModel[act_name]", "attribute": "act_name", "rules": {"required":true,"messages":{"required":"活动名称不能为空。"}}},{"id": "activitymodel-start_time", "name": "ActivityModel[start_time]", "attribute": "start_time", "rules": {"required":true,"messages":{"required":"活动有效期不能为空。"}}},{"id": "activitymodel-end_time", "name": "ActivityModel[end_time]", "attribute": "end_time", "rules": {"required":true,"messages":{"required":"活动结束时间不能为空。"}}},{"id": "activitymodel-sort", "name": "ActivityModel[sort]", "attribute": "sort", "rules": {"required":true,"messages":{"required":"排序不能为空。"}}},{"id": "activitymodel-purchase_num", "name": "ActivityModel[purchase_num]", "attribute": "purchase_num", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"限购数量必须是整数。"}}},{"id": "activitymodel-shop_id", "name": "ActivityModel[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"店铺ID必须是整数。"}}},{"id": "activitymodel-ext_info", "name": "ActivityModel[ext_info]", "attribute": "ext_info", "rules": {"string":true,"messages":{"string":"扩展字段必须是一条字符串。"}}},{"id": "activitymodel-act_name", "name": "ActivityModel[act_name]", "attribute": "act_name", "rules": {"string":true,"messages":{"string":"活动名称必须是一条字符串。","maxlength":"活动名称只能包含至多20个字符。"},"maxlength":20}},{"id": "activitymodel-act_title", "name": "ActivityModel[act_title]", "attribute": "act_title", "rules": {"string":true,"messages":{"string":"活动标题必须是一条字符串。","maxlength":"活动标题只能包含至多20个字符。"},"maxlength":20}},{"id": "activitymodel-act_img", "name": "ActivityModel[act_img]", "attribute": "act_img", "rules": {"required":true,"messages":{"required":"活动图片不能为空。"}}},{"id": "activitymodel-sort", "name": "ActivityModel[sort]", "attribute": "sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于255。"},"min":0,"max":255}},{"id": "activitymodel-purchase_num", "name": "ActivityModel[purchase_num]", "attribute": "purchase_num", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"限购数量必须是整数。","min":"限购数量必须不小于0。","max":"限购数量必须不大于999。"},"min":0,"max":999}},{"id": "activitymodel-start_time", "name": "ActivityModel[start_time]", "attribute": "start_time", "rules": {"compare":{"operator":"<","type":"date","compareAttribute":"activitymodel-end_time","skipOnEmpty":1},"messages":{"compare":"开始时间不能大于结束时间"}}},{"id": "activitymodel-end_time", "name": "ActivityModel[end_time]", "attribute": "end_time", "rules": {"compare":{"operator":">=","type":"date","compareAttribute":"activitymodel-start_time","skipOnEmpty":1},"messages":{"compare":"结束时间不能小于开始时间"}}},]
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

            var values = [];
            $("body").find(".group-buy-list").find("#goods_info").find("tr").each(function() {
                var goods_id = $(this).find(".goods-id").val();
                var sku_id = 0;
                values[goods_id + "-" + sku_id] = {
                    goods_id: goods_id,
                    sku_id: sku_id,
                };
            });
            // 初始化组件，为容器绑定组件
            var goodspicker = $("#widget_goods").goodspicker({
                url: '/dashboard/activity-goods/picker?act_id=',
                // 组件ajax提交的数据，主要设置分页的相关设置
                data: {
                    page: {
                        // 分页唯一标识
                        // page_id: page_id
                    },
                    is_sku: 0
                    // 不能将自己作为赠品
                    //except_sku_ids: sku_id
                },
                // 已加载的数据
                values: values,
                // 选择商品和未选择商品的按钮单击事件
                // @param selected 点击是否选中
                // @param sku 选中的SKU对象
                // @return 返回false代表
                click: function(selected, sku) {
                    var goods_count = this.goods_ids.length;
                    var html = $("#goods").html();
                    if (selected == true) {
                        $.loading.start();
                        $.ajax({
                            type: "POST",
                            url: "goods-info",
                            dataType: "json",
                            data: {
                                goods_id: sku.goods_id
                            },
                            success: function(result) {
                                if (result.code == 0) {
                                    if (goods_count == 1) {
                                        $("#goods_list").html(html);
                                        $('#goods_info').html('');
                                    }
                                    $('#goods_info').prepend(result.data);
                                    $.loading.stop();
                                } else {
                                    goodspicker.remove(sku.goods_id, sku.sku_id);
                                    $.msg(result.message);
                                }
                            }
                        });
                    } else {
                        $("body").find("[data-group-buy-sku-id='" + sku.sku_id + "']").remove();
                        if (goods_count == 0) {
                            $(".group-buy-list").remove();
                        }
                    }
                },

            });

            if ($.validator) {
                $.validator.prototype.elements = function() {
                    var validator = this, rulesCache = {};
                    return $(this.currentForm).find("input, select, textarea").not(":submit, :reset, :image, [disabled]").not(this.settings.ignore).filter(function() {
                        if (!this.name && validator.settings.debug && window.console) {
                            console.error("%o has no name assigned", this);
                        }
                        rulesCache[this.name] = true;
                        return true;
                    });
                }
            }

            var validator = $("#ActivityModel").validate();

            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                /* if (!validator.form()) {
                    return;
                } */
                if (!validator.form()) {
                    var html = "";

                    error_list = validator.errorList;

                    for (var i = 0; i < validator.errorList.length; i++) {
                        var element = validator.errorList[i].element;
                        var message = validator.errorList[i].message;

                        var element = $(error_list[i].element);

                        $(element).focus();
                        $(window).scrollTop($(element).offset().top - $(window).height() + 120);

                    }

                    return false;
                }
                $.loading.start();
                if ("" == "") {
                    $.post('/dashboard/group-buy/add', $("#ActivityModel").serializeJson(), function(result) {
                        // 停止加载
                        $.loading.stop();
                        if (result.code == 0) {
                            $.msg(result.message, {
                                time: 3000
                            });
                            // 加载
                            $.loading.start();
                            $.go('/dashboard/group-buy/list');
                        } else {
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    }, 'json');
                } else {
                    $.post('/dashboard/group-buy/edit?id=', $("#ActivityModel").serializeJson(), function(result) {
                        // 停止加载
                        $.loading.stop();
                        if (result.code == 0) {
                            $.msg(result.message, {
                                time: 3000
                            });
                            // 加载
                            $.loading.start();
                            $.go('/dashboard/group-buy/list');
                        } else {
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    }, 'json');
                }
            });

            $("#act_img_container").imagegroup({
                host: 'http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/',
                size: 1,
                values: [''],
                callback: function(data) {
                    $("#activitymodel-act_img").val(data.path);
                },
                remove: function(value, values) {
                    $("#activitymodel-act_img").val('');
                }
            });

            $('.form_datetime').datetimepicker({
                language: 'zh-CN',
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                forceParse: 0,
                showMeridian: 1,
                format: 'yyyy-mm-dd hh:ii:ss',
            }).on('changeDate', function(ev) {
                $(this).trigger("blur");
            });

        })

        function validationNumber(e, num) {
            var regu = /^[0-9]+\.?[0-9]*$/;
            if (e.value != "") {
                if (!regu.test(e.value)) {
                    $.msg("请输入正确的数字");
                    e.value = '';
                    e.focus();
                } else {
                    if (e.value.indexOf('.') > -1) {
                        if (e.value.split('.')[1].length > num) {
                            $.msg("请输入小数点后2位的数字！");
                            e.value = '';
                            e.focus();
                        }
                    }
                }
            }
        }
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop