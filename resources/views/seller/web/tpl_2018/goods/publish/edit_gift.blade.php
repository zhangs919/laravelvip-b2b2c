{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.6"/>
    <link rel="stylesheet" href="/css/mj-style.css?v=1.6"/>
@stop

{{--content--}}
@section('content')

    <form id="form1" class="form-horizontal" action="/goods/publish/edit-gift.html?id=43&amp;scid=0" method="POST">
        @csrf
        <div class="table-content m-t-10 clearfix goods-sku" data-sku-id="462">
            <div class="form-goods-gift">
                <div class="goods-pic">
				<span>
					<img src="http://xxx.oss-cn-beijing.aliyuncs.com/images/15164/shop/1/gallery/2018/04/13/15236100417381.jpg?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" alt="">
				</span>
                </div>
                <div class="goods-summary">
                    <h2>
                        阿三大苏打
                        <em>SKU：462</em>
                    </h2>
                    <dl>
                        <dt>商品价格：</dt>
                        <dd>￥12.00</dd>
                    </dl>
                    <dl>
                        <dt>库&nbsp;&nbsp;存&nbsp;&nbsp;量：</dt>
                        <dd>10</dd>
                    </dl>
                    <dl>
                        <dt>赠品捆绑：</dt>
                        <dd>
                            <ul class="goods-gift-list">

                            </ul>
                            <a href="javascript:void(0);" class="btn btn-xs btn-primary goods-picker" data-sku-id="462">
                                <i class="fa fa-gift"></i>
                                选择赠品
                            </a>
                        </dd>
                    </dl>
                </div>
                <!-- 商品选择器 -->
                <div class="m-t-15 w800 goods-picker-container"></div>
            </div>
        </div>

        <div class="bottom-btn p-b-30 p-l-0 text-c">
            <input type="button" id="btn_gift_submit" class="btn btn-primary btn-lg" value="确认提交" />
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
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20180418"></script>
    <script id="gift_template" type="text">
<li>
	<input type="hidden" name="gift_sku_id" class="gift-sku-id"/>
	<input type="hidden" name="gift_goods_id" class="gift-goods-id"/>
	<div class="pic-thumb">
		<span>
			<img src="" alt="">
		</span>
	</div>
	<dl>
		<dt class="goods_name"></dt>
		<dd>
			赠品数量：
			<input type="text" name="gift_number" class="form-control text gift-number" value="1"  data-rule-min="1" data-msg-min="赠品数量至少为1" data-rule-integer="true" data-msg-integer="赠品数量必须为整数" data-rule-required="true" data-msg-integer="赠品数量不能为空"/>
		</dd>
	</dl>
	<a class="gift-del" href="javascript:;" title="删除赠品">×</a>
</li>
</script>
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180418"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180418"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180418"></script>
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

            $("#btn_view").click(function() {
                $.go("http://{{ env('FRONTEND_DOMAIN') }}/goods-43.html", "_blank");
            });

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
                var container = $(this).parents(".goods-sku").find(".goods-picker-container");
                var sku_id = $(this).data("sku-id");
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
                        data: {
                            is_sku: 1
                            // 不能将自己作为赠品
                            // except_sku_ids: sku_id,
                            // except_goods_ids: "43"
                        },
                        // 已加载的数据
                        values: values,
                        // 选择商品和未选择商品的按钮单击事件
                        // @param selected 点击是否选中
                        // @param sku 选中的SKU对象
                        // @return 返回false代表
                        click: function(selected, sku) {
                            if (selected == true) {

                                if (sku.goods_number && sku.goods_number <= 0) {
                                    $.msg('此商品已无货');
                                    return false;
                                }

                                var html = $("#gift_template").html();
                                var element = $($.parseHTML(html));
                                $(element).data("sku-id", sku.sku_id);
                                $(element).data("goods-id", sku.goods_id);
                                $(element).find("img").attr("src", sku.sku_image ? sku.sku_image : sku.goods_image);
                                $(element).find(".goods_name").html(sku.sku_name);
                                $(element).find(".goods_name").attr("title", sku.sku_name);
                                $(element).find(".gift-sku-id").val(sku.sku_id);
                                $(element).find(".gift-goods-id").val(sku.goods_id);
                                $(element).attr("data-gift-sku-id", sku.sku_id);
                                $(container).parents(".goods-sku").find(".goods-gift-list").append(element);
                            } else {
                                $(container).parents(".goods-sku").find(".goods-gift-list").find("[data-gift-sku-id='" + sku.sku_id + "']").remove();
                            }
                            //验证
                            validator = $("#form1").validate();
                        },
                        // 全部取消的回调函数
                        removeAll: function() {
                            $(container).parents(".goods-sku").find(".goods-gift-list").html("");
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
                var goods_id = $(target).data("goods-id");
                var sku_id = $(target).data("sku-id");

                var container = $(this).parents(".goods-sku").find(".goods-picker-container")
                var goodspicker = $.goodspicker(container);

                if (goodspicker) {
                    // 获取控件
                    goodspicker.remove(goods_id, sku_id);
                }

                $(target).remove();
            });

            $("#btn_gift_submit").click(function() {

                if (!validator.form()) {
                    return;
                }

                var goods_gifts = new Object();

                $(".goods-gift-list").each(function() {
                    var sku_id = $(this).parents(".goods-sku").data("sku-id");
                    goods_gifts[sku_id] = [];
                    $(this).find("li").each(function() {
                        goods_gifts[sku_id].push($(this).serializeJson());
                    });
                });

                // 加载
                $.loading.start();

                $.post('/goods/publish/edit-gift?id=43', {
                    goods_gifts: goods_gifts
                }, function(result) {

                    // 加载
                    $.loading.stop();

                    if (result.code == 0) {
                        $.msg(result.message, {
                            time: 2000
                        }, function() {
                            // 加载
                            $.loading.start();
                            $.go('');
                        });
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, 'json');
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop