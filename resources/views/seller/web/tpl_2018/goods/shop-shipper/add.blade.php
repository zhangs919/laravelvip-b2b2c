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

    <div class="table-content m-t-30 clearfix">
        <form id="ShopShipper" class="form-horizontal" name="ShopShipper" action="/goods/shop-shipper/add" method="POST">
            @csrf
            <!-- 隐藏域 -->
            <input type="hidden" id="shopshipper-id" class="form-control" name="ShopShipper[id]" value="{{ $info->id ?? '' }}">
            <!-- 名称 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="shopshipper-name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">发货方名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <input type="text" id="shopshipper-name" class="form-control" name="ShopShipper[name]" value="{{ $info->name ?? '' }}">
                        </div>
                        <div class="help-block help-block-t">
                            <div class="help-block help-block-t">建议添加2~3个字显示效果最佳，最多10个字符</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 图片 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="shopshipper-image" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">发货方图标：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <div id="image_group_container"></div>
                            <input type="hidden" id="shopshipper-image" class="form-control" name="ShopShipper[image]" value="{{ $info->image ?? '' }}">
                        </div>
                        <div class="help-block help-block-t">
                            <div class="help-block help-block-t">最佳显示尺寸为90*90像素，直角图片效果更佳</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 排序 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="shopshipper-sort" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">排序：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <input type="text" id="shopshipper-sort" class="form-control small" name="ShopShipper[sort]" value="{{ $info->sort ?? 255 }}">
                        </div>
                        <div class="help-block help-block-t">
                            <div class="help-block help-block-t">控制商家发布商品页面，规格展示顺序，数字范围为0~255，数字越小越靠前</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 确认提交 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="" class="col-sm-4 control-label">
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <input type="button" class="btn btn-primary" id="btn_submit" name="btn_submit" value="确认提交"/>
                        </div>
                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block--}}
@section('extra_html')
    <!-- JSON2 -->
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
[{"id": "shopshipper-name", "name": "ShopShipper[name]", "attribute": "name", "rules": {"required":true,"messages":{"required":"发货方名称不能为空。"}}},{"id": "shopshipper-image", "name": "ShopShipper[image]", "attribute": "image", "rules": {"required":true,"messages":{"required":"发货方图标不能为空。"}}},{"id": "shopshipper-sort", "name": "ShopShipper[sort]", "attribute": "sort", "rules": {"required":true,"messages":{"required":"排序不能为空。"}}},{"id": "shopshipper-id", "name": "ShopShipper[id]", "attribute": "id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"发货方编号必须是整数。"}}},{"id": "shopshipper-last_time", "name": "ShopShipper[last_time]", "attribute": "last_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"修改时间必须是整数。"}}},{"id": "shopshipper-name", "name": "ShopShipper[name]", "attribute": "name", "rules": {"string":true,"messages":{"string":"发货方名称必须是一条字符串。","maxlength":"发货方名称只能包含至多10个字符。"},"maxlength":10}},{"id": "shopshipper-sort", "name": "ShopShipper[sort]", "attribute": "sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于255。"},"min":0,"max":255}},]
</script>
    <script type="text/javascript">
        // 
    </script>
@stop


{{--helper_tool--}}
@section('helper_tool')

@stop

{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer_js page元素同级下面--}}
@section('footer_js')
    <script src="/assets/d2eace91/min/js/validate.min.js"></script>
    <script src="/assets/d2eace91/min/js/upload.min.js"></script>
    <script src="/assets/d2eace91/js/jquery.json-2.4.js"></script>
@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <script>
        $().ready(function() {
            $("[data-toggle='popover']").popover();
            var target = $("#shopshipper-image");
            var value = $(target).val();
            $("#image_group_container").imagegroup({
                host : "{{ get_oss_host() }}",
                size : 1,
                values : value.split("|"),
                gallery: true,
                // 回调函数
                callback : function(data) {
                    var values = this.values;
                    if (!values) {
                        values = [];
                    }
                    values = values.join("|");
                    target.val(values);
                },
                // 移除的回调函数
                remove : function(value, values) {
                    var values = this.values;
                    if (!values) {
                        values = [];
                    }
                    values = values.join("|");
                    target.val(values);
                }
            });
            var validator = $("#ShopShipper").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                var target = this;
                $(target).prop("disabled", true);
                var url = $("#ShopShipper").attr("action");
                var data = $("#ShopShipper").remove(".attr-values-area").serializeJson();
                //加载提示
                $.loading.start();
                $.post(url, data, function(result) {
                    if (result.code == 0) {
                        $.msg(result.message, function(){
                            if (result.data) {
                                $.loading.start();
                                $.go(result.data);
                            }
                        });
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                        $(target).prop("disabled", false);
                    }
                }, "json").always(function() {
                    $.loading.stop();
                });
            });
            // 删除提示
            $(".delete_label").mouseover(function() {
                var element = this;
                $.tips("被勾选“删除”的规格值将在您点击“确认提交”按钮后被系统删除，请谨慎操作！", this, {
                    time: 0
                });
            }).mouseout(function() {
                $.closeAll("tips");
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop