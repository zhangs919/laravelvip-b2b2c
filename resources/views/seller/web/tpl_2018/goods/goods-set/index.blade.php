{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20180702"/>
@stop

{{--content--}}
@section('content')

    <form id="ShopConfigModel" class="form-horizontal" name="ShopConfigModel" action="/shop/config/index" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
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

@stop


{{--helper_tool--}}
@section('helper_tool')

@stop


{{--footer script page元素同级下面--}}
@section('footer_script')
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180710"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180710"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180710"></script>
    <!-- AJAX上传+图片预览 -->
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=20180710"></script>
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=20180710"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20180710"></script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
[]
</script>





    <script type="text/javascript">
        $().ready(function() {

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
                    // host: "http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/",
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