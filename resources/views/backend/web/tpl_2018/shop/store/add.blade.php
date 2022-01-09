{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">

@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30 clearfix">
        <form id="StoreModel" class="form-horizontal" name="StoreModel" action="/shop/store/add" method="post">
            {{ csrf_field() }}
            <!-- 店铺 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="storemodel-shop_id" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">店铺：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="hidden" name="StoreModel[shop_id]" value="">
                            <select id="storemodel-shop_id" class="form-control chosen-select" name="StoreModel[shop_id][]" multiple="multiple" size="4">
                                @foreach($shop_list as $v)
                                    <option value="{{ $v->shop_id }}">{{ $v->shop_name }}</option>
                                @endforeach
                            </select>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">选择商城店铺</div></div>
                    </div>
                </div>
            </div>
            <!-- 网点数量 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="storemodel-store_allow_number" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">可添加网点数量：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="storemodel-store_allow_number" class="form-control ipt m-r-10" name="StoreModel[store_allow_number]">个


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">每个店铺最多添加网点的数量</div></div>
                    </div>
                </div>
            </div>

            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="" class="col-sm-4 control-label">


                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <input type="button" class="btn btn-primary" id="btn_submit" name="btn_submit" value="确认提交">

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

{{--extra html block page元素同级下面--}}
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

    <script src="/assets/d2eace91/js/individual.js?v=20180027"></script>
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180027"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180027"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180027"></script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
[{"id": "storemodel-shop_id", "name": "StoreModel[shop_id]", "attribute": "shop_id", "rules": {"required":true,"messages":{"required":"店铺不能为空。"}}},{"id": "storemodel-store_allow_number", "name": "StoreModel[store_allow_number]", "attribute": "store_allow_number", "rules": {"required":true,"messages":{"required":"可添加网点数量不能为空。"}}},{"id": "storemodel-store_allow_number", "name": "StoreModel[store_allow_number]", "attribute": "store_allow_number", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"可添加网点数量必须是整数。","min":"可添加网点数量必须不小于1。","max":"可添加网点数量必须不大于9999999。"},"min":1,"max":9999999}},]
</script>
    <script type="text/javascript">
        $().ready(function() {
            var validator = $("#StoreModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                $('input[name="StoreModel[shop_id]"]').val($(".search-choice").val());
                validator.form();
                if (!validator.form()) {
                    return;
                }

                //加载提示
                $.loading.start();
                $("#StoreModel").submit();
            });
        });
    </script>
    <a class="scroll-to-top"><i class="fa fa-chevron-up"></i></a>

@stop

{{--outside body script--}}
@section('outside_body_script')

@stop