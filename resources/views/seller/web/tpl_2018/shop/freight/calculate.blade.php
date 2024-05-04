{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20180702"/>
    <link rel="stylesheet" href="/css/mj-style.css?v=20180702"/>
@stop

{{--content--}}
@section('content')

    <form id="form1" class="form-horizontal" action="/shop/freight/calculate" method="POST">
        @csrf
        <div class="table-content m-t-10 clearfix">
            <div class="form-goods-gift">
                <div class="goods-summary">
                    <dl>
                        <dt class="l-h-32">配送地区：</dt>
                        <dd>
                            <div id="region_container"></div>
                            <input type="hidden" id="region_code" name="region_code" value="" />
                        </dd>
                    </dl>
                </div>
            </div>
            <div class="form-goods-gift">
                <div class="goods-summary">
                    <dl>
                        <dt class="l-h-32">收货地址：</dt>
                        <dd>
                            <div class="address-picker">
                                <div id="map_container" class="amap-container"></div>
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
            <div class="form-goods-gift">
                <div class="goods-summary">
                    <dl>
                        <dt class="l-h-32">选择商品：</dt>
                        <dd>
                            <ul class="goods-gift-list sku-list" style="width: 950px;">

                            </ul>
                            <a href="javascript:void(0);" class="btn btn-xs btn-primary goods-picker m-t-5">
                                <i class="fa fa-gift"></i>
                                选择商品
                            </a>
                        </dd>
                    </dl>
                </div>
                <!-- 商品选择器 -->
                <div class="goods-picker-container w800"></div>
            </div>
            <div id="calculate_result"></div>
        </div>
        <!--提交按钮-->
        <div class="bottom-btn p-b-30 p-l-0 text-c">
            <input type="button" id="btn_gift_submit" class="btn btn-primary btn-lg" value="计算运费" />
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
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20180710"></script>
    <script id="template" type="text">
<li>
	<input type="hidden" name="sku_id" class="sku-id"/>
	<input type="hidden" name="goods_id" class="goods-id"/>
	<input type="hidden" name="goods_price" class="goods-price"/>
	<div class="pic-thumb">
		<span>
			<img src="" alt="">
		</span>
	</div>
	<dl>
		<dt class="goods_name"></dt>
		<dd>
			商品价格：<span class="goods-price-span m-r-5"></span>
		</dd>
		<dd>
			商品数量：
			<input type="text" name="number" class="form-control text goods-number" value="1"  data-rule-min="1" data-msg-min="商品数量至少为1" data-rule-integer="true" data-msg-integer="商品数量必须为整数" data-rule-required="true" data-msg-integer="商品数量不能为空"/>
		</dd>
	</dl>
	<a class="gift-del" href="javascript:;" title="删除商品">×</a>
</li>
</script>
    <!-- 地区 -->
    <script src="/assets/d2eace91/js/jquery.region.js?v=20180710"></script>
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180710"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180710"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180710"></script>
    <!-- 鼠标滚轮 -->
    <script src="/assets/d2eace91/js/scrollBar/jquery.mousewheel.min.js?v=20180710"></script>
	<script type="text/javascript">
		window._AMapSecurityConfig = {
			securityJsCode: "{{ sysconf('amap_js_security_code') }}",
		};
	</script>
    <script type="text/javascript" src="http://webapi.amap.com/maps?v=1.4.15&key={{ sysconf('amap_js_key') }}&&plugin=AMap.Scale,AMap.PolyEditor,AMap.Geocoder,AMap.Autocomplete,AMap.PlaceSearch,AMap.InfoWindow,AMap.ToolBar"></script>
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
            /**
             * 初始化validator默认值
             */
            $.validator.setDefaults({
                errorPlacement: function(error, element) {
                    var error_id = $(error).attr("id");
                    var error_msg = $(error).text();
                    var element_id = $(error).attr("for");

                    if ($.trim(error_msg) == 0) {
                        return;
                    }

                    $.msg(error_msg);
                    $(element).focus();
                },
            });

            var validator = $("#form1").validate();

            $(".goods-picker").click(function() {
                var container = $(".goods-picker-container");
                if (!$.goodspicker(container)) {
                    var values = [];
                    var goodspicker = $(container).goodspicker({
                        data: {
                            is_sku: 1
                        },
                        // 已加载的数据
                        values: values,
                        // 选择商品和未选择商品的按钮单击事件
                        // @param selected 点击是否选中
                        // @param sku 选中的SKU对象
                        // @return 返回false代表
                        click: function(selected, sku) {
                            if (sku.goods_number && sku.goods_number <= 0) {
                                $.msg('此商品已无货');
                                return false;
                            }

                            console.info(sku);

                            if (selected == true) {
                                var html = $("#template").html();
                                var element = $($.parseHTML(html));
                                $(element).find("img").attr("src", sku.goods_image);
                                $(element).find(".goods_name").html(sku.goods_name);
                                $(element).find(".sku-id").val(sku.sku_id);
                                $(element).find(".goods-id").val(sku.goods_id);
                                $(element).find(".goods-price").val(sku.goods_price);
                                $(element).find(".goods-price-span").html("￥" + sku.goods_price);
                                $(element).attr("data-sku-id", sku.sku_id);
                                $(".sku-list").append(element);
                            } else {
                                $(container).parents(".goods-sku").find(".sku-list").find("[data-sku-id='" + sku.sku_id + "']").remove();
                            }
                            //验证
                            validator = $("#form1").validate();

                            var order_amount = 0;

                            $(".goods-price").each(function() {
                                order_amount += parseFloat($(this).val());
                            });

                            $("#order_amount").val(order_amount);
                        },
                        // 设置已选择：第二种方法，加载控件后传递已选择的商品信息
                        // 回调函数加载已选择的商品
                        callback: function() {
                            /**
                             var goodspicker = this;
                             // 已选择
                             $(container).parents(".goods-sku").find(".goods-gift-list").find("li").each(function() {
							var goods_id = $(this).find(".gift-goods-id").val();
							var sku_id = $(this).find(".gift-sku-id").val();
							goodspicker.add(goods_id, sku_id);
						});
                             **/
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

            //移除赠品
            $("body").on("click", ".gift-del", function() {
                var target = $(this).parents("li");
                var goods_id = $(target).find(".goods-id").val();
                var sku_id = $(target).find(".sku-id").val();

                var container = $(".goods-picker-container");
                var goodspicker = $.goodspicker(container);

                if (goodspicker) {
                    // 获取控件
                    goodspicker.remove(goods_id, sku_id);
                }

                $(target).remove();
            });

            // 初始化地区选择器
            var regionselector = $("#region_container").regionselector({
                value: '11,01,01',
                select_class: 'form-control',
                check_all: false,
                change: function(value, names, is_last) {
                    $("#region_code").val(value);
                    $("#region_code").data("is_last", is_last);
                    $("#region_code").valid();
                }
            });

            var addresspicker = $("#map_container").addresspicker({

            });

            $("#btn_gift_submit").click(function() {

                if (!validator.form()) {
                    return;
                }

                var sku_list = [];

                $(".sku-list").each(function() {
                    $(this).find("li").each(function() {
                        sku_list.push($(this).serializeJson());
                    });
                });

                var position = addresspicker.map.getCenter();

                var data = {
                    position: [position.lng, position.lat],
                    region_code: $("#region_code").val(),
                    sku_list: sku_list
                };

                // 加载
                $.loading.start();

                $.post('/shop/freight/calculate', data, function(result) {
                    if (result.code == 0) {
                        $.msg("计算完成");
                        $("#calculate_result").html(result.data);
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, 'json').always(function() {
                    // 加载
                    $.loading.stop();
                });
            });

        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop
