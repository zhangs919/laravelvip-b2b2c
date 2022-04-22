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

    <!-- 表单 -->
    <form id="UserShopRank" class="form-horizontal" name="UserShopRank" action="/user/shop/add" method="post" novalidate="novalidate">
        {{ csrf_field() }}
        <div class="table-content m-t-30 clearfix">
            <!-- 隐藏域 -->
            <input type="hidden" id="usershoprank-rank_id" class="form-control" name="UserShopRank[rank_id]" value="{{ $info->rank_id ?? '' }}">
            <!-- 等级名称 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="usershoprank-rank_name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">等级名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="usershoprank-rank_name" class="form-control" name="UserShopRank[rank_name]" value="{{ $info->rank_name ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 等级级别 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="usershoprank-rank_level" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">等级级别：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <select id="usershoprank-rank_level" class="form-control" name="UserShopRank[rank_level]">
                                <option value="">-- 请选择 --</option>
                                @foreach($rank_level_list as $v)
                                <option value="{{ $v }}" @if(@$info->rank_level == $v) selected="" @endif>{{ $v }}</option>
                                @endforeach
                            </select>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">系统提供10个等级，数字越大等级越高，每种等级级别只能对应一个店铺会员等级</div></div>
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

                            <input type="button" class="btn btn-primary" id="btn_submit" name="btn_submit" value="确认提交">

                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
        </div>
    </form>

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
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=1.2"></script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
        @if(!isset($info->rank_id))
            [{"id": "usershoprank-rank_name", "name": "UserShopRank[rank_name]", "attribute": "rank_name", "rules": {"required":true,"messages":{"required":"等级名称不能为空。"}}},{"id": "usershoprank-rank_level", "name": "UserShopRank[rank_level]", "attribute": "rank_level", "rules": {"required":true,"messages":{"required":"等级级别不能为空。"}}},{"id": "usershoprank-rank_name", "name": "UserShopRank[rank_name]", "attribute": "rank_name", "rules": {"string":true,"messages":{"string":"等级名称必须是一条字符串。","maxlength":"等级名称只能包含至多16个字符。"},"maxlength":16}},{"id": "usershoprank-rank_level", "name": "UserShopRank[rank_level]", "attribute": "rank_level", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"等级级别必须是整数。","min":"等级级别必须不小于1。","max":"等级级别必须不大于10。"},"min":1,"max":10}},{"id": "usershoprank-rank_name", "name": "UserShopRank[rank_name]", "attribute": "rank_name", "rules": {"ajax":{"url":"/user/shop/client-validate","model":"Y29tbW9uXG1vZGVsc1xVc2VyU2hvcFJhbms=","attribute":"rank_name","params":[]},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},{"id": "usershoprank-rank_level", "name": "UserShopRank[rank_level]", "attribute": "rank_level", "rules": {"ajax":{"url":"/user/shop/client-validate","model":"Y29tbW9uXG1vZGVsc1xVc2VyU2hvcFJhbms=","attribute":"rank_level","params":[]},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},]
        @else
            [{"id": "usershoprank-rank_name", "name": "UserShopRank[rank_name]", "attribute": "rank_name", "rules": {"required":true,"messages":{"required":"等级名称不能为空。"}}},{"id": "usershoprank-rank_level", "name": "UserShopRank[rank_level]", "attribute": "rank_level", "rules": {"required":true,"messages":{"required":"等级级别不能为空。"}}},{"id": "usershoprank-rank_name", "name": "UserShopRank[rank_name]", "attribute": "rank_name", "rules": {"string":true,"messages":{"string":"等级名称必须是一条字符串。","maxlength":"等级名称只能包含至多16个字符。"},"maxlength":16}},{"id": "usershoprank-rank_level", "name": "UserShopRank[rank_level]", "attribute": "rank_level", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"等级级别必须是整数。","min":"等级级别必须不小于1。","max":"等级级别必须不大于10。"},"min":1,"max":10}},{"id": "usershoprank-rank_name", "name": "UserShopRank[rank_name]", "attribute": "rank_name", "rules": {"ajax":{"url":"/user/shop/client-validate","model":"Y29tbW9uXG1vZGVsc1xVc2VyU2hvcFJhbms=","attribute":"rank_name","params":["UserShopRank[rank_id]"]},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},{"id": "usershoprank-rank_level", "name": "UserShopRank[rank_level]", "attribute": "rank_level", "rules": {"ajax":{"url":"/user/shop/client-validate","model":"Y29tbW9uXG1vZGVsc1xVc2VyU2hvcFJhbms=","attribute":"rank_level","params":["UserShopRank[rank_id]"]},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},]
        @endif
    </script>
    <script type="text/javascript">
        $().ready(function() {
            var validator = $("#UserShopRank").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                //加载提示
                $.loading.start();
                $("#UserShopRank").submit();
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop