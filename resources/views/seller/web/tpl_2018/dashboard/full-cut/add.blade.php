{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=2.0"/>
    <link rel="stylesheet" href="/css/mj-style.css?v=2.0"/>
@stop

{{--content--}}
@section('content')

	<div class="table-content m-t-30 clearfix limit-discount-goods">
		<form id="FullCutModel" class="form-horizontal" name="FullCutModel" action="/dashboard/full-cut/add" method="post" enctype="multipart/form-data">
			{{ csrf_field() }}
            <input type="hidden" id="fullcutmodel-act_id" class="form-control" name="FullCutModel[act_id]" value="{{ $model['act_id'] ?? '' }}">
			<!-- 套餐名称 -->
			<div class="simple-form-field" >
				<div class="form-group">
					<label for="fullcutmodel-act_name" class="col-sm-3 control-label">
						<span class="text-danger ng-binding">*</span>
						<span class="ng-binding">活动名称：</span>
					</label>
					<div class="col-sm-9">
						<div class="form-control-box">

							<input type="text" id="fullcutmodel-act_name" class="form-control" name="FullCutModel[act_name]" value="{{ $model['act_name'] ?? '' }}">


						</div>

						<div class="help-block help-block-t"><div class="help-block help-block-t">活动名称必须在 1~20 个字内</div></div>
					</div>
				</div>
			</div>
            <!--套餐有效期  -->
			<div class="simple-form-field" >
				<div class="form-group">
					<label for="fullcutmodel-start_time" class="col-sm-3 control-label">
						<span class="text-danger ng-binding">*</span>
						<span class="ng-binding">活动有效期：</span>
					</label>
					<div class="col-sm-9">
						<div class="form-control-box">
							<input type="text" id="fullcutmodel-start_time" class="form-control form_datetime large" name="FullCutModel[start_time]" value="{{ $start_time }}">
							<span class="ctime">至</span>
							<input type="text" id="fullcutmodel-end_time" class="form-control form_datetime large" name="FullCutModel[end_time]" value="{{ $end_time }}">
						</div>

						<div class="help-block help-block-t"></div>
					</div>
				</div>
			</div>
			<div class="simple-form-field">
				<div class="form-group">
					<label class="col-sm-3 control-label">
						<span class="text-danger ng-binding">*</span>
						<span class="ng-binding">优惠条件：</span>
					</label>
					<div class="col-sm-9">
						<div class="form-control-box">
							<table class="table">
								<thead>
								<tr>
									<th class="w70 text-c">层级</th>
									<th class="w120">优惠门槛</th>
									<th class="w450">优惠方式（可多选）</th>
									<th class="w100 text-c">操作</th>
								</tr>
								</thead>
								<tbody>

                                @if(isset($model['act_id']))
                                    @php
                                        $ii = 1;
                                    @endphp
                                    @foreach($discount as $cash=>$v)
                                        <tr class="discount_length">
                                            <td class="text-c td-num">{{ $ii }}</td>
                                            <td>
                                                满
                                                <input class="form-control form-control-xs w50 m-l-5 m-r-5" type="text" name='cash[]' value="{{ $v['cash'] }}" data-rule-callback='act_cash_callback'>
                                                元
                                            </td>
                                            <td>
                                                <div class="ng-binding">
                                                    <span>
                                                        <label class="cur-p">
                                                            <input class="cur m-r-5" type="checkbox" name='check_item_{{ $ii }}[]' value='1' @if(!empty($v['reduce_cash']))checked='checked'@endif>
                                                            减现金
                                                            <input class="form-control form-control-xs w50 m-r-5 m-l-5" type="text" name='reduce_cash[]' value="{{ $v['reduce_cash'] }}" data-rule-callback='act_reduce_callback'>
                                                            元
                                                        </label>
                                                    </span>
                                                    <span>
                                                        <label class="cur-p">
                                                            <input class="cur m-r-5" type="checkbox" name='check_item_{{ $ii }}[]' value='2' @if(!empty($v['freight_free']))checked='checked'@endif>
                                                            包邮
                                                        </label>
                                                    </span>

                                                    <span>
                                                        <label class="cur-p">
                                                            <input class="cur m-r-5" type="checkbox" name='check_item_{{ $ii }}[]' value='4' @if(!empty($v['bonus']))checked='checked'@endif>
                                                            送红包
                                                            <select class="form-control form-control-xs w100 m-l-5 bonus_list" name='bonus[]'>
                                                                <option value="0">--请选择--</option>
                                                                @if(!empty($bonus_list))
                                                                    @foreach($bonus_list as $bonus)
                                                                        <option value="{{ $bonus['bonus_id'] }}" @if($v['bonus'] == $bonus['bonus_id'])selected="selected"@endif>{{ $bonus['bonus_name'] }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </label>
                                                        <a class="btn btn-warning btn-sm m-l-5" href="/dashboard/bonus/add.html?bonus_type=4" target="blank">新建会员送红包</a>
                                                        <a class="btn btn-primary btn-sm m-l-5 reload_btn" data-type='bonus'>重新加载</a>
                                                    </span>
                                                    <span>
                                                        <label class="cur-p">
                                                            <input class="cur m-r-5" type="checkbox" name='check_item_{{ $ii }}[]' value='5' @if(!empty($v['gift']))checked='checked'@endif>
                                                            送赠品
                                                            <select class="form-control form-control-xs w100 m-l-5 gift_list" name='gift[]'>
                                                                <option value="0">--请选择--</option>
                                                                @if(!empty($gift_list))
                                                                    @foreach($gift_list as $gift)
                                                                        <option value="{{ $gift['act_id'] }}" @if($v['gift'] == $gift['act_id'])selected="selected"@endif>{{ $gift['act_name'] }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </label>
                                                        <a class="btn btn-warning btn-sm m-l-5" href="/dashboard/gift/add.html" target="blank">新建赠品活动</a>
                                                        <a class="btn btn-primary btn-sm m-l-5 reload_btn" data-type='gift'>重新加载</a>
                                                        <p class="c-999">赠品活动中如果其中有一个商品库存为0，则选择赠品中即不展示此赠品活动</p>
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="handle text-c">@if($ii > 1)<a class="del">删除</a>@endif</td>
                                        </tr>

                                        @php
                                            $ii++;
                                        @endphp
                                    @endforeach

                                @else
                                    <tr class="discount_length">
                                        <td class="text-c td-num">1</td>
                                        <td>
                                            满
                                            <input class="form-control form-control-xs w50 m-l-5 m-r-5" type="text" name='cash[]' data-rule-callback='act_cash_callback'>
                                            元
                                        </td>
                                        <td>
                                            <div class="ng-binding">
                                                    <span>
                                                        <label class="cur-p">
                                                            <input class="cur m-r-5" type="checkbox" name='check_item_1[]' value='1'>
                                                            减现金
                                                            <input class="form-control form-control-xs w50 m-r-5 m-l-5" type="text" name='reduce_cash[]' data-rule-callback='act_reduce_callback'>
                                                            元
                                                        </label>
                                                    </span>
                                                <span>
                                                        <label class="cur-p">
                                                            <input class="cur m-r-5" type="checkbox" name='check_item_1[]' value='2'>
                                                            包邮
                                                        </label>
                                                    </span>

                                                <span>
                                                        <label class="cur-p">
                                                            <input class="cur m-r-5" type="checkbox" name='check_item_1[]' value='4'>
                                                            送红包
                                                            <select class="form-control form-control-xs w100 m-l-5 bonus_list" name='bonus[]'>
                                                                <option value="0">--请选择--</option>

                                                            </select>
                                                        </label>
                                                        <a class="btn btn-warning btn-sm m-l-5" href="/dashboard/bonus/add.html?bonus_type=4" target="blank">新建会员送红包</a>
                                                        <a class="btn btn-primary btn-sm m-l-5 reload_btn" data-type='bonus'>重新加载</a>
                                                    </span>
                                                <span>
                                                        <label class="cur-p">
                                                            <input class="cur m-r-5" type="checkbox" name='check_item_1[]' value='5'>
                                                            送赠品
                                                            <select class="form-control form-control-xs w100 m-l-5 gift_list" name='gift[]'>
                                                                <option value="0">--请选择--</option>

                                                            </select>
                                                        </label>
                                                        <a class="btn btn-warning btn-sm m-l-5" href="/dashboard/gift/add.html" target="blank">新建赠品活动</a>
                                                        <a class="btn btn-primary btn-sm m-l-5 reload_btn" data-type='gift'>重新加载</a>
                                                        <p class="c-999">赠品活动中如果其中有一个商品库存为0，则选择赠品中即不展示此赠品活动</p>
                                                    </span>
                                            </div>
                                        </td>
                                        <td class="handle text-c"></td>
                                    </tr>
                                @endif

								<tr id='template_end'>
									<td colspan="4">
										<a class="btn btn-warning btn-sm m-r-20 " id='add_discount'>新增一级优惠</a>
										<span class="c-999">最多可设置五个层级</span>
									</td>
								</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!--错误提示模块 star-->
			<div class="member-handle-error"></div>
			<!--错误提示模块 end-->
			<!-- 使用范围 -->

			<div class="simple-form-field" >
				<div class="form-group">
					<label for="fullcutmodel-use_range" class="col-sm-3 control-label">

						<span class="ng-binding">参与活动商品：</span>
					</label>
					<div class="col-sm-9">
						<div class="form-control-box">

							<label class="control-label cur-p"><input type="radio" id="use_range_0" class="use_range" name="use_range_check" value="0" @if($use_range == 0){{ 'checked' }}@endif> 全部商品</label>

							<label class="control-label cur-p"><input type="radio" id="use_range_1" class="use_range" name="use_range_check" value="1" @if($use_range == 1){{ 'checked' }}@endif> 指定商品</label>
							<span>
			<p class="c-999">满减活动选择全部商品后，在活动保存成功后，店铺再添加的商品是不参与到满减活动中的</p>
		</span>
							<div id="goods_picker" class="m-t-10 w800 p-l-15 p-r-15"></div>
							<input type="hidden" id="use_range" class="form-control" name="FullCutModel[use_range]" value="0">


						</div>

						<div class="help-block help-block-t"></div>
					</div>
				</div>
			</div>

			<div class="bottom-btn p-b-30">
				<input type="button" id="btn_submit" value="确认提交" class="btn btn-primary btn-lg" />
			</div>
		</form>

        <ul class="goods-gift-list hide">
            @if(!empty($use_range_goods))
                @foreach($use_range_goods as $v)
                    <li data-gift-sku-id="{{ $v['sku_id'] }}" data-goods-id="{{ $v['goods_id'] }}" data-sku-id="{{ $v['sku_id'] }}">
                        <input type="hidden" name="gift_sku_id" value="{{ $v['sku_id'] }}" class="gift-sku-id" />
                        <input type="hidden" name="gift_goods_id" value="{{ $v['goods_id'] }}" class="gift-goods-id" />
                    </li>
                @endforeach
            @endif
		</ul>
	</div>



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
	<!--点击按钮为表格增加行-->
	<script id="discount_template" type="text">
<tr  class="discount_length">
<td class="text-c td-mun">1</td>
<td>满<input class="form-control form-control-xs w50 m-l-5 m-r-5" type="text"  name='cash[]'  data-rule-callback='act_cash_callback'>元</td>
<td>
<div class="ng-binding">
<span><label class="cur-p"><input class="cur m-r-5" type="checkbox"  name='check_item_1[]' value='1'>减现金<input class="form-control form-control-xs w50 m-r-5 m-l-5" type="text" name='reduce_cash[]'  data-rule-callback='act_reduce_callback'>元</label></span>
<span><label class="cur-p"><input class="cur m-r-5" type="checkbox"  name='check_item_1[]' value='2'>包邮</label></span>
<!-- -->
<span><label class="cur-p"><input class="cur m-r-5" type="checkbox"  name='check_item_1[]' value='4'>送红包<select class="form-control form-control-xs w100 m-l-5 bonus_list"  name='bonus[]'><option value="0">--请选择--</option></select></label><a class="btn btn-warning btn-sm m-l-5"  href="/dashboard/bonus/add.html?bonus_type=4"  target="blank">新建会员送红包</a><a class="btn btn-primary btn-sm m-l-5 reload_btn" data-type='bonus'>重新加载</a></span>
<span><label class="cur-p"><input class="cur m-r-5" type="checkbox"  name='check_item_1[]' value='5'>送赠品<select class="form-control form-control-xs w100 m-l-5 gift_list"  name='gift[]'><option value="0">--请选择--</option></select></label><a class="btn btn-warning btn-sm m-l-5"   href="/dashboard/gift/add.html"  target="blank">新建赠品活动</a><a class="btn btn-primary btn-sm m-l-5 reload_btn" data-type='gift'>重新加载</a><p class="c-999">赠品活动中如果其中有一个商品库存为0，则选择赠品中即不展示此赠品活动</p></span>
</div>
</td>
<td class="handle text-c"><a class="del">删除</a></td>
</tr>
</script>
	<script id="goods" type="text">
<div class="table-responsive m-t-10" style="max-height: 300px; overflow-y: auto;">
	<table id="table_list" class="table table-hover m-b-0 w800 limit-discount-list">
		<thead>
			<tr>
				<th class="w200">商品名称</th>
				<th class="w100 text-c">价格</th>
				<th class="w80 text-c">库存</th>
				<th class="w100 text-c">
					折扣（折）
					<div class="batch">
						<a class="batch-edit" title="批量设置">
							<i class="fa fa-edit"></i>
						</a>
						<div class="batch-input" style="display: none">
							<h6>批量设置折扣：</h6>
							<a class="batch-close">X</a>
							<input class="form-control text small batch_set_discount" type="text">
							<a class="btn btn-primary btn-sm m-l-5 btn_batch_set" data-type=0>设置</a>
							<span class="arrow"></span>
						</div>
					</div>
				</th>
				<th class="w100 text-c">
					减价（元）
					<div class="batch">
						<a class="batch-edit" title="批量设置">
							<i class="fa fa-edit"></i>
						</a>
						<div class="batch-input" style="display: none">
							<h6>批量设置减价：</h6>
							<a class="batch-close">X</a>
							<input class="form-control text small batch_set_mark_down" type="text">
							<a class="btn btn-primary btn-sm m-l-5 btn_batch_set" data-type=1>设置</a>
							<span class="arrow"></span>
						</div>
					</div>
				</th>
				<th class="w150">折扣/减价后价格（元）</th>
				<th class="handle w80">操作</th>
			</tr>
		</thead>
		<tbody id="goods_info">

		</tbody>
	</table>
</div>
<!--错误提示模块 star-->
<div class="member-handle-error"></div>
<!--错误提示模块 end-->
<script type="text/javascript">
	$().ready(function() {
		//删除商品
		$("body").on("click", ".del", function() {
			var target = $(this).parents("tr");
			var goods_id = $(this).data("goods-id");
			var sku_id = $(this).data("sku-id");
			var goods_price = $(this).data("goods-price");
			var container = $(this).parents(".limit-discount-goods").find("#widget_goods");
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

		$("body").on("click", ".after-price", function() {
			var goods_id = $(this).data("goods-id");
			var discount = $(".discount-" + goods_id).val();
			var mark_down = $(".mark_down-" + goods_id).val();

			$.open({
				title: '',
				width: '650px',
				ajax: {
					url: '/dashboard/limit-discount/sku-info',
					data: {
						goods_id: goods_id,
						discount: discount,
						mark_down: mark_down
					}
				}
			});

		});

	});
</script>

	<script type="text/javascript">
        //自定义验证规则
        function act_price_callback(element, value) {

            var goods_id = $(element).data('goods-id');
            var min_price = $(element).data('min_price');
            var max_price = $(element).data('max_price');
            var regu = /^[0-9]+\.?[0-9]*$/;

            if (isNaN($(element).val())) {
                $(element).data("msg", "折扣必须是数字。");
                return false;
            }
            if ($(element).val() < 0) {
                $(element).data("msg", "折扣必须大于0。");
                return false;
            }
            if ($(element).val() > 10) {
                $(element).data("msg", "折扣必须小于10。");
                return false;
            }
            if ($(element).val().indexOf('.') > -1) {
                if ($(element).val().split('.')[1].length > 2) {
                    $(element).data("msg", "折扣只能保留2位小数。");
                    return false;
                }
            }
            if ($(element).val() * min_price * 100 < 1 && $(element).val() != '') {
                $(element).data("msg", "折后金额不能小于0.01。");
                return false;
            }

            //设置折扣金额
            if ($(element).val() != '') {

                $("." + goods_id + "-reduce").val('');
                $("." + goods_id + "-discount").val(goods_id + '-' + $(element).val());

                $(".mark_down-" + goods_id).val('');
                if (min_price == max_price) {
                    min_price = min_price * $(element).val() * 100 / 1000;
                    $(".after-price-" + goods_id).html("￥" + min_price);
                } else {
                    min_price = min_price * $(element).val() * 100 / 1000;
                    max_price = max_price * $(element).val() * 100 / 1000;
                    $(".after-price-" + goods_id).html("￥" + min_price + "-￥" + max_price);
                }
            }

            return true;
        }
        function act_mark_down_callback(element, value) {

            var goods_id = $(element).data('goods-id');
            var min_price = $(element).data('min_price');
            var max_price = $(element).data('max_price');
            var regu = /^[0-9]+\.?[0-9]*$/;

            if (isNaN($(element).val())) {
                $(element).data("msg", "减价金额必须是数字。");
                return false;
            }
            if ($(element).val() < 0) {
                $(element).data("msg", "减价金额必须大于0。");
                return false;
            }
            if ($(element).val() * 100 > min_price * 100) {
                $(element).data("msg", "减价金额必须小于商品最低金额。");
                return false;
            }
            if ($(element).val().indexOf('.') > -1) {
                if ($(element).val().split('.')[1].length > 2) {
                    $(element).data("msg", "折扣只能保留2位小数。");
                    return false;
                }
            }
            if ($(element).val() != '') {
                $("." + goods_id + "-discount").val('');
                $("." + goods_id + "-reduce").val(goods_id + '-' + $(element).val());
                $(".discount-" + goods_id).val('');
                if (min_price == max_price) {
                    min_price = min_price - $(element).val();
                    $(".after-price-" + goods_id).html("￥" + min_price);
                } else {
                    min_price = min_price - $(element).val();
                    max_price = max_price - $(element).val();
                    $(".after-price-" + goods_id).html("￥" + min_price + "-￥" + max_price);
                }
            }

            return true;
        }

        $().ready(function() {
            /**
             * 初始化validator默认值自定义错误提示位置
             */
            var _errorPlacement = $.validator.defaults.errorPlacement;
            var _success = $.validator.defaults.success;

            /* $.validator.setDefaults({
                errorPlacement: function(error, element) {
                    var error_id = $(error).attr("id");
                    var error_msg = $(error).text();
                    var element_id = $(error).attr("for");
                    if (!error_msg && error_msg == "") {
                        return;
                    }

                // 	if (element.parents(".limit-discount-list").size() ==0) {
                //		return;
                //	}

                    if ($(element).parents(".member-container").find(".member-handle-error").find("div").size() == 0) {
                        $(".member-handle-error").html("<div class='form-control-warning error m-t-10'></div>");
                    }
                    var error_dom = $("<p id='"+error_id+"'><i class='fa fa-times-circle'></i><span class='error-msg'>" + error_msg + "</span></p>");
                    $(".member-handle-error").find("div").append(error_dom);
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
                        $("[id='" + error_id + "']").remove();
                    }

                    if ($(element).find(".member-handle-error").find("p").size() == 0) {
                        $('.form-control-warning').remove();
                        //$(element).parents(".member-container").find(".member-handle-error").find("div").remove();
                    }
                    _success.call(this, error, element);
                }
            }); */
        })
	</script>
	<!-- 时间插件引入 start -->
	<link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.css?v=20190130"/> <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.js?v=20190121"></script>
	<script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=20190121"></script>
	<!-- 时间插件引入 end -->
	<script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20190121"></script>
	<script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20190121"></script>
	<script src="/assets/d2eace91/js/validate/messages_zh.js?v=20190121"></script>
	<!-- 商品选择器 -->
	<script src="/assets/d2eace91/js/jquery.widget.js?v=20190121"></script>
	<script type="text/javascript">
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
            //添加优惠条件
            $("#add_discount").click(function() {
                if ($(".discount_length").length < 5) {
                    var html = $("#discount_template").html();
                    html = html.replace('<td class="text-c td-mun">1</td>', '<td class="text-c td-num">' + ($(".discount_length").length + 1) + '</td>');

                    var reg = new RegExp("check_item_1", "g")
                    html = html.replace(reg, "check_item_" + ($(".discount_length").length + 1));

                    var element = $($.parseHTML(html));
                    element.insertBefore($("#template_end"));
                    checkLength();
                }
            });
            //删除优惠条件
            $("body").on("click", ".del", function() {
                $(this).parents('tr').remove();
                $(".discount_length").each(function(index) {

                    var temp_num = index + 1;
                    //修改层级
                    $(this).children('td').eq(0).html(temp_num);
                    //修改层级勾选的优惠方式
                    $(this).find('input:checkbox').attr('name', "check_item_" + temp_num);
                });
                checkLength();
            });

            //优惠条件不能超过5条
            function checkLength() {
                if ($(".discount_length").length >= 5) {
                    $("#add_discount").addClass("disabled");
                } else {
                    $("#add_discount").removeClass("disabled");
                }
            }

            // 重新加载红包
            $("body").on("click", ".reload_btn", function() {
                $.loading.start();
                var type = $(this).data('type');
                $.get("/dashboard/full-cut/reload-list.html", {
                    type: type
                }, function(result) {
                    if (result.code == 0) {
                        var list = result.data;
                        var html = "";
                        for ( var name in result.data) {
                            html += "<option value='"+name+"'>" + result.data[name] + "</option>";
                        }

                        if (result.type == 'bonus') {
                            $(".bonus_list").html(html);
                        } else {
                            $(".gift_list").html(html);
                        }
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "JSON").always(function() {
                    $.loading.stop();
                });
            });

        });
	</script>
	<script id="client_rules" type="text">
[{"id": "fullcutmodel-act_name", "name": "FullCutModel[act_name]", "attribute": "act_name", "rules": {"required":true,"messages":{"required":"活动名称不能为空。"}}},{"id": "fullcutmodel-start_time", "name": "FullCutModel[start_time]", "attribute": "start_time", "rules": {"required":true,"messages":{"required":"活动有效期不能为空。"}}},{"id": "fullcutmodel-end_time", "name": "FullCutModel[end_time]", "attribute": "end_time", "rules": {"required":true,"messages":{"required":"套餐结束时间不能为空。"}}},{"id": "fullcutmodel-purchase_num", "name": "FullCutModel[purchase_num]", "attribute": "purchase_num", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Purchase Num必须是整数。"}}},{"id": "fullcutmodel-shop_id", "name": "FullCutModel[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"店铺ID必须是整数。"}}},{"id": "fullcutmodel-ext_info", "name": "FullCutModel[ext_info]", "attribute": "ext_info", "rules": {"string":true,"messages":{"string":"扩展字段必须是一条字符串。"}}},{"id": "fullcutmodel-act_name", "name": "FullCutModel[act_name]", "attribute": "act_name", "rules": {"string":true,"messages":{"string":"活动名称必须是一条字符串。","maxlength":"活动名称只能包含至多20个字符。"},"maxlength":20}},{"id": "fullcutmodel-sort", "name": "FullCutModel[sort]", "attribute": "sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于255。"},"min":0,"max":255}},{"id": "fullcutmodel-start_time", "name": "FullCutModel[start_time]", "attribute": "start_time", "rules": {"compare":{"operator":"<","type":"date","compareAttribute":"fullcutmodel-end_time","skipOnEmpty":1},"messages":{"compare":"开始时间不能大于结束时间"}}},{"id": "fullcutmodel-end_time", "name": "FullCutModel[end_time]", "attribute": "end_time", "rules": {"compare":{"operator":">=","type":"date","compareAttribute":"fullcutmodel-start_time","skipOnEmpty":1},"messages":{"compare":"结束时间不能小于开始时间"}}},]
</script>
	<script type="text/javascript">
        //自定义验证规则
        function act_cash_callback(element, value) {

            if (isNaN($(element).val())) {
                $(element).data("msg", "满减金额必须是数字。");
                return false;
            }
            if ($(element).val() == '') {
                $(element).data("msg", "满减金额不能为空。");
                return false;
            }
            if ($(element).val() <= 0) {
                $(element).data("msg", "满减金额必须大于0。");
                return false;
            }
            if ($(element).val().indexOf('.') > -1) {
                if ($(element).val().split('.')[1].length > 2) {
                    $(element).data("msg", "满减金额只能保留2位小数。");
                    return false;
                }
            }

            return true;
        }
        //自定义验证规则
        function act_reduce_callback(element, value) {

            if (isNaN($(element).val())) {
                $(element).data("msg", "减现金额必须是数字。");
                return false;
            }
            if ($(element).val() < 0) {
                $(element).data("msg", "减现金额必须大于0。");
                return false;
            }
            if ($(element).val().indexOf('.') > -1) {
                if ($(element).val().split('.')[1].length > 2) {
                    $(element).data("msg", "减现金额只能保留2位小数。");
                    return false;
                }
            }

            return true;
        }
        //自定义验证规则
        function act_point_callback(element, value) {

            if (isNaN($(element).val())) {
                $(element).data("msg", "积分必须是数字。");
                return false;
            }
            if ($(element).val() < 0) {
                $(element).data("msg", "积分金额必须大于0。");
                return false;
            }
            if ($(element).val().indexOf('.') > -1) {
                if ($(element).val().split('.')[1].length > 0) {
                    $(element).data("msg", "积分必须是整数。");
                    return false;
                }
            }

            return true;
        }
	</script>
	<script type="text/javascript">
        $().ready(function() {
            if ("{{ $model['act_id'] ?? '' }}") {
                if ("{{ $use_range ?? 0 }}" == 1) {
                    var container = $("#goods_picker");
                    var values = [];
                    $(".goods-gift-list").find("li").each(function() {
                        var goods_id = $(this).find(".gift-goods-id").val();
                        var sku_id = $(this).find(".gift-sku-id").val();
                        values[goods_id + "-" + sku_id] = {
                            goods_id: goods_id,
                            sku_id: sku_id,
                        };
                    });
                    var goodspicker = $(container).goodspicker({
                        url: '/dashboard/full-cut/picker?act_id={{ $model['act_id'] ?? '' }}',
                        data: {
                            is_sku: 0,
                        },
                        // 已加载的数据
                        values: values,
                        // 选择商品和未选择商品的按钮单击事件
                        // @param selected 点击是否选中
                        // @param sku 选中的SKU对象
                        // @return 返回false代表
                        click: function(selected, sku) {
                            $("#use_range").val(this.goods_ids.join(","));
                            $("#use_range").valid();
                        },
                    });
                    $("#goods_picker").show();
                }
            }
            $(".use_range").change(function() {
                if ($(this).val() == '1') {
                    $("#use_range").val("");
                    var container = $("#goods_picker");
                    $(container).show();
                    if (!$.goodspicker(container)) {
                        var values = [];
                        // 设置已选择：第一种方法，加载控件前传递已选择的商品信息
                        $(container).parents(".goods-sku").find(".goods-gift-list").find("li").each(function() {
                            var goods_id = $(this).find(".gift-goods-id").val();
                            var sku_id = $(this).find(".gift-sku-id").val();
                            values[goods_id + "-" + sku_id] = {
                                goods_id: goods_id,
                                sku_id: sku_id,
                            };
                        });

                        var goodspicker = $(container).goodspicker({
                            url: '/dashboard/full-cut/picker?act_id={{ $model['act_id'] ?? '' }}',
                            data: {
                                is_sku: 0,
                            },
                            // 已加载的数据
                            values: values,
                            // 选择商品和未选择商品的按钮单击事件
                            // @param selected 点击是否选中
                            // @param sku 选中的SKU对象
                            // @return 返回false代表
                            click: function(selected, sku) {
                                $("#use_range").val(this.goods_ids.join(","));
                                $("#use_range").valid();
                            },
                        });
                    } else {
                        $("#use_range").val($.goodspicker(container).goods_ids.join(","));
                    }
                } else {
                    $("#use_range").val("0");
                    $("#goods_picker").hide();
                    $("#use_range").valid();
                }
            });

            var validator = $("#FullCutModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());

            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                var valid = 1;
                $("input[name='cash[]']").each(function() {
                    if ($(this).hasClass('error')) {
                        $(this).blur();
                        valid = 0;
                    }

                });
                $("input[name='point[]']").each(function() {
                    if ($(this).hasClass('error')) {
                        $(this).blur();
                        valid = 0;
                    }

                });
                $("input[name='reduce_cash[]']").each(function() {
                    if ($(this).hasClass('error')) {
                        $(this).blur();
                        valid = 0;
                    }

                });
                if (valid == 0) {
                    return;
                }

                /* 	if (!validator.form()) {
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
                    } */
                $.loading.start();
                if ("{{ $model['act_id'] ?? '' }}" == "") {
                    $.post('/dashboard/full-cut/add', $("#FullCutModel").serializeJson(), function(result) {
                        // 停止加载
                        $.loading.stop();
                        if (result.code == 0) {
                            $.msg(result.message, {
                                time: 3000
                            });
                            // 加载
                            $.loading.start();
                            $.go('/dashboard/full-cut/list');
                        } else {
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    }, 'json');
                } else {
                    $.post('/dashboard/full-cut/edit?id={{ $model['act_id'] ?? '' }}', $("#FullCutModel").serializeJson(), function(result) {
                        // 停止加载
                        $.loading.stop();
                        if (result.code == 0) {
                            $.msg(result.message, {
                                time: 3000
                            });
                            // 加载
                            $.loading.start();
                            $.go('/dashboard/full-cut/list');
                        } else {
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    }, 'json');
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
	</script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop