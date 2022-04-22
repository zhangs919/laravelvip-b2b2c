{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')

@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30 clearfix">
        <form id="CustomerSetModel" class="form-horizontal" name="CustomerSetModel" action="/shop/customer/customer-set" method="post">
            {{ csrf_field() }}
            <!-- 隐藏域 -->
            <input type='hidden' value='edit' name='edit'/>
            <!-- 服务电话 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="customersetmodel-service_tel" class="col-sm-4 control-label">

                        <span class="ng-binding">客服电话：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="customersetmodel-service_tel" class="form-control" name="CustomerSetModel[service_tel]" value="{{ $model['service_tel'] }}">


                        </div>

                        <div class="help-block help-block-t">在pc端店铺首页悬浮显示、手机端店铺详情页面显示</div>
                    </div>
                </div>
            </div>
            <!-- 工作时间 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="customersetmodel-service_hours" class="col-sm-4 control-label">

                        <span class="ng-binding">工作时间：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <textarea id="customersetmodel-service_hours" class="form-control" name="CustomerSetModel[service_hours]" rows="5">{!! $model['service_hours'] !!}</textarea>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">仅在pc端店铺首页悬浮显示 例：（AM 10:00 - PM 18:00）</div></div>
                    </div>
                </div>
            </div>
            <!-- 确认提交 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="" class="col-sm-4 control-label">


                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <input type="submit" id="btn_submit" name="btn_submit" class="btn btn-primary" value="确认提交" />

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

@stop


{{--helper_tool--}}
@section('helper_tool')

@stop

{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=1.2"></script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
[{"id": "customersetmodel-service_tel", "name": "CustomerSetModel[service_tel]", "attribute": "service_tel", "rules": {"match":{"pattern":/^((0[0-9]{2,3}-[0-9]{7,8})|([0-9]{2,4}-[0-9]{2,4}-[0-9]{2,4})|([0-9]{2,4}[0-9]{2,4}[0-9]{2,4})|(13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$|17[0-9]{1}[0-9]{8}))$/,"not":false,"skipOnEmpty":1},"messages":{"match":"请输入有效电话号码。"}}},{"id": "customersetmodel-service_hours", "name": "CustomerSetModel[service_hours]", "attribute": "service_hours", "rules": {"string":true,"messages":{"string":"工作时间必须是一条字符串。","maxlength":"工作时间只能包含至多50个字符。"},"maxlength":50}},]
</script>
    <script type="text/javascript">
        $().ready(function() {
            var validator = $("#CustomerSetModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()){
                    return;
                }
                //加载提示
                $.loading.start();
                $("#CustomerSetModel").submit();

            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop