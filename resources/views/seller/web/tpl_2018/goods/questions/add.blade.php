{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20180702"/>
@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30 clearfix">
        <form id="form1" class="form-horizontal" name="ShopQuestions" action="/goods/questions/add" method="POST">
            {{ csrf_field() }}
            <!-- 隐藏域 -->
            <input type="hidden" id="shopquestions-questions_id" class="form-control" name="ShopQuestions[questions_id]" value="{{ $info->questions_id ?? '' }}">
            <!-- 问题-->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopquestions-question" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">问题：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <textarea id="shopquestions-question" class="form-control" name="ShopQuestions[question]" rows="5">{!! $info->question ?? '' !!}</textarea>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 答案 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopquestions-answer" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">回答：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <textarea id="shopquestions-answer" class="form-control" name="ShopQuestions[answer]" rows="5">{!! $info->answer ?? '' !!}</textarea>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 排序 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopquestions-sort" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">排序：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="shopquestions-sort" class="form-control small m-r-10" name="ShopQuestions[sort]" value="{{ $info->sort ?? '255' }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">数字范围0~255，数字越小越靠前</div></div>
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


                            <input type="button" id='btn_submit' value='确认提交' class="btn btn-primary" />


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
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180710"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180710"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180710"></script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
        [{"id": "shopquestions-shop_id", "name": "ShopQuestions[shop_id]", "attribute": "shop_id", "rules": {"required":true,"messages":{"required":"店铺编号不能为空。"}}},{"id": "shopquestions-question", "name": "ShopQuestions[question]", "attribute": "question", "rules": {"required":true,"messages":{"required":"问题不能为空。"}}},{"id": "shopquestions-answer", "name": "ShopQuestions[answer]", "attribute": "answer", "rules": {"required":true,"messages":{"required":"回答不能为空。"}}},{"id": "shopquestions-sort", "name": "ShopQuestions[sort]", "attribute": "sort", "rules": {"required":true,"messages":{"required":"排序不能为空。"}}},{"id": "shopquestions-questions_id", "name": "ShopQuestions[questions_id]", "attribute": "questions_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"编号必须是整数。"}}},{"id": "shopquestions-shop_id", "name": "ShopQuestions[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"店铺编号必须是整数。"}}},{"id": "shopquestions-question", "name": "ShopQuestions[question]", "attribute": "question", "rules": {"string":true,"messages":{"string":"问题必须是一条字符串。","maxlength":"问题只能包含至多100个字符。"},"maxlength":100}},{"id": "shopquestions-answer", "name": "ShopQuestions[answer]", "attribute": "answer", "rules": {"string":true,"messages":{"string":"回答必须是一条字符串。","maxlength":"回答只能包含至多500个字符。"},"maxlength":500}},{"id": "shopquestions-sort", "name": "ShopQuestions[sort]", "attribute": "sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于255。"},"min":0,"max":255}},]
    </script>
    <script type="text/javascript">
        $().ready(function() {
            var validator = $("#form1").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());

            // 禁止回车事件
            $.stopEnterEvent($("#form1"));

            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                //加载提示
                $.loading.start();

                var url = $("#form1").attr("action");
                var data = $("#form1").serializeJson();
                $.post(url, data, function(result) {
                    $.loading.stop();
                    if (result.code == 0) {
                        $.msg(result.message, function() {
                            $.loading.start();
                            $.go('list');
                        });
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "json");

                return false;
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop