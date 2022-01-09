{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')

@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30">
        <form id="UserModel" class="form-horizontal" name="UserModel" action="/shop/account/add" method="post">
            {{ csrf_field() }}
            <!-- 用户ID -->
            <input type="hidden" id="usermodel-user_id" class="form-control" name="UserModel[user_id]" value="{{ $info->user_id ?? '' }}">
            <!-- 登录名 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="usermodel-user_name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">登录名：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            @if(!isset($info->user_id))
                                <input type="text" id="usermodel-user_name" class="form-control" name="UserModel[user_name]" autocomplete="off">
                            @else
                                <input type="text" id="usermodel-user_name" class="form-control" name="UserModel[user_name]" value="{{ $info->user_name }}" disabled="" autocomplete="off">
                            @endif

                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <input style="display: none">
            <!-- 密码 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="usermodel-password" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">密码：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="password" id="pwd-input" class="form-control" name="UserModel[password]" maxlength="20" autocomplete="off">
                            <i class="fa fa-eye-slash pwd-toggle" data-id="pwd-input"></i>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 角色 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="usermodel-role_id" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">角色：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <select id="usermodel-role_id" class="form-control" name="UserModel[role_id]">
                                <option value="0">-- 请选择 --</option>
                                @foreach($role_list as $k=>$v)
                                    <option value="{{ $k }}" @if(@$info->role_id == $k) selected @endif>{{ $v }}</option>
                                @endforeach
                            </select>
                            <a href="/shop/role/add" class="btn btn-warning btn-sm m-l-10" target="_blank">创建角色</a>
                            <a id="btn_reload_role_list" class="btn btn-primary btn-sm m-l-5">重新加载</a>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 手机号码 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="usermodel-mobile" class="col-sm-4 control-label">

                        <span class="ng-binding">手机号码：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="usermodel-mobile" class="form-control" name="UserModel[mobile]" value="{{ $info->mobile ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- E-mail -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="usermodel-email" class="col-sm-4 control-label">

                        <span class="ng-binding">E-mail：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="usermodel-email" class="form-control" name="UserModel[email]" value="{{ $info->email ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            <!-- 状态 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="usermodel-status" class="col-sm-4 control-label">

                        <span class="ng-binding">状态：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="UserModel[status]" value="0">
                                    @if(!isset($info->status))
                                        <label>
                                            <input type="checkbox" id="usermodel-status"
                                                   class="form-control b-n" name="UserModel[status]"
                                                   value="1" checked data-on-text="启用" data-off-text="禁用">
                                        </label>
                                    @else
                                        <label>
                                            <input type="checkbox" id="usermodel-status"
                                                   class="form-control b-n" name="UserModel[status]"
                                                   value="1" @if($info->status == 1)checked="" @endif data-on-text="启用" data-off-text="禁用">
                                        </label>
                                    @endif
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">在禁用状态下，管理员不可登录卖家中心</div></div>
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
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180919"></script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
        @if(!isset($info->user_id))
            [{"id": "usermodel-user_name", "name": "UserModel[user_name]", "attribute": "user_name", "rules": {"required":true,"messages":{"required":"登录名不能为空。"}}},{"id": "usermodel-password", "name": "UserModel[password]", "attribute": "password", "rules": {"required":true,"messages":{"required":"密码不能为空。"}}},{"id": "usermodel-role_id", "name": "UserModel[role_id]", "attribute": "role_id", "rules": {"required":true,"messages":{"required":"角色不能为空。"}}},{"id": "usermodel-user_name", "name": "UserModel[user_name]", "attribute": "user_name", "rules": {"username":{"pattern":/^[a-zA-Z0-9_\u4e00-\u9fa5]{4,20}$/,"not":false,"skipOnEmpty":1},"match":{"pattern":/^\d+$/,"not":true,"skipOnEmpty":1},"messages":{"username":"登录名只能由4-20个字，支持汉字、字母、数字、下划线“_”构成的组合","match":"登录名不能为纯数字"}}},{"id": "usermodel-password", "name": "UserModel[password]", "attribute": "password", "rules": {"password":{"pattern":/^[^\u4e00-\u9fa5\·]{6,20}$/,"not":false,"skipOnEmpty":1},"match":{"pattern":/\s+/,"not":true,"skipOnEmpty":1},"messages":{"password":"密码长度为6-20个字符，建议由字母、数字和符号两种以上。","match":"密码不能包含空格。"}}},{"id": "usermodel-email", "name": "UserModel[email]", "attribute": "email", "rules": {"string":true,"messages":{"string":"E-mail必须是一条字符串。","maxlength":"E-mail只能包含至多60个字符。"},"maxlength":60}},{"id": "usermodel-mobile", "name": "UserModel[mobile]", "attribute": "mobile", "rules": {"match":{"pattern":/^((13|15|18|17|14)\d{9}|(199|198|166)\d{8})$/,"not":false,"skipOnEmpty":1},"messages":{"match":"手机号码是无效的。"}}},{"id": "usermodel-email", "name": "UserModel[email]", "attribute": "email", "rules": {"email":{"pattern":/^[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/,"fullPattern":/^[^@]*<[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?>$/,"allowName":false,"enableIDN":false,"skipOnEmpty":1},"messages":{"email":"E-mail不是有效的邮箱地址。"}}},{"id": "usermodel-user_name", "name": "UserModel[user_name]", "attribute": "user_name", "rules": {"ajax":{"url":"/shop/account/client-validate","model":"YXBwXG1vZHVsZXNcc2hvcFxtb2RlbHNcVXNlck1vZGVs","attribute":"user_name","params":[],"scenario":"create"},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},{"id": "usermodel-mobile", "name": "UserModel[mobile]", "attribute": "mobile", "rules": {"ajax":{"url":"/shop/account/client-validate","model":"YXBwXG1vZHVsZXNcc2hvcFxtb2RlbHNcVXNlck1vZGVs","attribute":"mobile","params":[],"scenario":"create"},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},{"id": "usermodel-email", "name": "UserModel[email]", "attribute": "email", "rules": {"ajax":{"url":"/shop/account/client-validate","model":"YXBwXG1vZHVsZXNcc2hvcFxtb2RlbHNcVXNlck1vZGVs","attribute":"email","params":[],"scenario":"create"},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},{"id": "usermodel-role_id", "name": "UserModel[role_id]", "attribute": "role_id", "rules": {"compare":{"operator":">","type":"number","compareValue":"0","skipOnEmpty":1},"messages":{"compare":"角色不能为空"}}},]
        @else
            [{"id": "usermodel-user_name", "name": "UserModel[user_name]", "attribute": "user_name", "rules": {"username":{"pattern":/^[a-zA-Z0-9_\u4e00-\u9fa5]{4,20}$/,"not":false,"skipOnEmpty":1},"match":{"pattern":/^\d+$/,"not":true,"skipOnEmpty":1},"messages":{"username":"登录名只能由4-20个字，支持汉字、字母、数字、下划线“_”构成的组合","match":"登录名不能为纯数字"}}},{"id": "usermodel-password", "name": "UserModel[password]", "attribute": "password", "rules": {"password":{"pattern":/^[^\u4e00-\u9fa5\·]{6,20}$/,"not":false,"skipOnEmpty":1},"match":{"pattern":/\s+/,"not":true,"skipOnEmpty":1},"messages":{"password":"密码长度为6-20个字符，建议由字母、数字和符号两种以上。","match":"密码不能包含空格。"}}},{"id": "usermodel-email", "name": "UserModel[email]", "attribute": "email", "rules": {"string":true,"messages":{"string":"E-mail必须是一条字符串。","maxlength":"E-mail只能包含至多60个字符。"},"maxlength":60}},{"id": "usermodel-mobile", "name": "UserModel[mobile]", "attribute": "mobile", "rules": {"match":{"pattern":/^((13|15|18|17|14)\d{9}|(199|198|166)\d{8})$/,"not":false,"skipOnEmpty":1},"messages":{"match":"手机号码是无效的。"}}},{"id": "usermodel-email", "name": "UserModel[email]", "attribute": "email", "rules": {"email":{"pattern":/^[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/,"fullPattern":/^[^@]*<[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?>$/,"allowName":false,"enableIDN":false,"skipOnEmpty":1},"messages":{"email":"E-mail不是有效的邮箱地址。"}}},{"id": "usermodel-role_id", "name": "UserModel[role_id]", "attribute": "role_id", "rules": {"compare":{"operator":">","type":"number","compareValue":"0","skipOnEmpty":1},"messages":{"compare":"角色不能为空"}}},{"id": "usermodel-mobile", "name": "UserModel[mobile]", "attribute": "mobile", "rules": {"ajax":{"url":"/shop/account/client-validate","model":"YXBwXG1vZHVsZXNcc2hvcFxtb2RlbHNcVXNlck1vZGVs","attribute":"mobile","params":["UserModel[user_id]"],"scenario":"update"},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},{"id": "usermodel-email", "name": "UserModel[email]", "attribute": "email", "rules": {"ajax":{"url":"/shop/account/client-validate","model":"YXBwXG1vZHVsZXNcc2hvcFxtb2RlbHNcVXNlck1vZGVs","attribute":"email","params":["UserModel[user_id]"],"scenario":"update"},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},]
        @endif
    </script>
    <script type="text/javascript">
        $().ready(function() {
            var validator = $("#UserModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                //加载提示
                $.loading.start();
                $("#UserModel").submit();
            });

            // 重新加载角色列表
            $("#btn_reload_role_list").click(function() {
                $.loading.start();
                $.get("/shop/account/role-list", {}, function(result) {
                    if (result.code == 0) {
                        var list = result.data;
                        var html = "";
                        for ( var name in result.data) {
                            html += "<option value='"+name+"'>" + result.data[name] + "</option>";
                        }
                        $("#usermodel-role_id").html(html);
                        $(".chosen-select").chosen("destroy").chosen();
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
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop