{{--模板继承--}}
@extends('layouts.seller_layout')

{{--header 内 css文件--}}
@section('header_css')
@stop

{{--header 内 css文件--}}
@section('header_css_2')
    <link href="/assets/d2eace91/css/styles.css" rel="stylesheet">
@stop

{{--content--}}
@section('content')

    <form id="ShopConfigModel" class="form-horizontal" name="ShopConfigModel" action="/shop/config/index" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="group" value="goods">
        <input type="hidden" name="tabs" value="">
        <div class="table-content m-t-30">




            <h5 class="m-b-30" data-anchor="商品编辑">商品编辑</h5>



            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopconfigmodel-goods_edit_items" class="col-sm-4 control-label">

                        <span class="ng-binding">更多商品编辑项：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">





                            <input type="hidden" name="ShopConfigModel[goods_edit_items]" value="">
                            <div id="shopconfigmodel-goods_edit_items" class="" name="ShopConfigModel[goods_edit_items]">
                                <label class="control-label cur-p m-r-10"><input type="checkbox" name="ShopConfigModel[goods_edit_items][]" value="goods_stockcode" @if(in_array('goods_stockcode', $form->value)) checked @endif> 商品库位码</label>
                                <label class="control-label cur-p m-r-10"><input type="checkbox" name="ShopConfigModel[goods_edit_items][]" value="sku_weight" checked> SKU商品重量</label>
                                <label class="control-label cur-p m-r-10"><input type="checkbox" name="ShopConfigModel[goods_edit_items][]" value="sku_volume" checked> SKU商品体积</label></div>




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">用于控制商品编辑页面的编辑项，您未勾选的编辑项将不会出现在商品编辑页面，已经编辑的内容依然生效</div></div>
                    </div>
                </div>
            </div>




            <div class="simple-form-field p-b-30">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label"></label>
                    <div class="col-xs-8">
                        <input type="hidden" name="back_url" value="{{ request()->fullUrl() }}" />
                        {{--<input type="hidden" name="back_url" value="{{ $_SERVER['HTTP_REFERER'] ?? '' }}" />--}}
                        <input type="button" id="btn_submit" value="确认提交" class="btn btn-primary" />
                    </div>
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
    <script type="text/javascript">
        //
    </script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
[]
</script>
    <script type="text/javascript">
        //
    </script>
@stop


{{--helper_tool--}}
@section('helper_tool')

@stop

{{--footer_js page元素同级下面--}}
@section('footer_js')
    <script src="/assets/d2eace91/js/jquery-ui.js"></script>
    <script src="/assets/d2eace91/min/js/validate.min.js"></script>
    <script src="/assets/d2eace91/min/js/upload.min.js"></script>
@stop


{{--footer script page元素同级下面--}}
@section('footer_script')
    <script>
        $().ready(function() {
            /*商品添加页面右侧发布助手js*/
            $('.helper-icon').click(function() {
                $('.helper-icon').animate({
                    'right': '-40px'
                }, 200, function() {
                    $('.helper-wrap').animate({
                        'right': '0'
                    }, 200);
                });
            });
            $('.help-header .fa-times-circle').click(function() {
                $('.helper-wrap').animate({
                    'right': '-140px'
                }, 200, function() {
                    $('.helper-icon').animate({
                        'right': '0'
                    }, 200);
                });
            });
            //生成页面导航助手
            $("#helper_tool_nav").find("ul").html("");
            var count = 0;
            $("[data-anchor]").each(function() {
                var title = $(this).data("anchor");
                var element = $($.parseHTML("<li><a href='javascript:void(0);'>" + title + "</a></li>"));
                $("#helper_tool_nav").find("ul").append(element);
                var target = this;
                $(element).click(function() {
                    $('html, body').animate({
                        scrollTop: $(target).offset().top - 100
                    }, 500);
                    if ($(target).is(":input")) {
                        $(target).focus();
                    } else {
                        $(target).find(":input").first().focus();
                    }
                });
                count++;
            });
            $("#helper_tool_nav").find(".count").html(count);
            $('.helper-icon').click();
        });
        //
        $().ready(function() {
            $("[data-toggle='popover']").popover();
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
            var validator = $("#ShopConfigModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                validator.form();
                if (!validator.form()) {
                    return;
                }
                $.loading.start();
                $("#ShopConfigModel").submit();
                /**
                 var data = $("#SystemConfigModel").serializeJson();
                 $.post('/system/config/index', data, function(result) {
                if (result.code == 0) {
                    $.msg(result.message, {
                        icon: 1
                    });
                } else {
                    $.alert(result.message, {
                        icon: 2
                    });
                }
            }, "json");
                 **/
            });
            $(".szy-imagegroup").each(function() {
                var id = $(this).data("id");
                var size = $(this).data("size");
                var mode = $(this).data("mode");
                var labels = $(this).data("labels");
                var target = $("#" + id);
                var value = $(target).val() ;
                var options = $(this).data("options") ? $(this).data("options") : [];
                $(this).imagegroup({
                    host: "{{ get_oss_host() }}",
                    size: size,
                    mode: mode,
                    labels: labels,
                    options: options,
                    values: value.split("|"),
                    // 改变事件
                    change: function(values, type){
                        if (!values) {
                            values = [];
                        }
                        values = values.join("|");
                        target.val(values);
                    }
                });
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop