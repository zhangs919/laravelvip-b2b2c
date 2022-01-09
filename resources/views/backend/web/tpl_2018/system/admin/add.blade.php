{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')

@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30">
        <form id="form" class="form-horizontal" action="/system/admin/add" method="post" novalidate="novalidate">
            {{ csrf_field() }}

            <!--   -->
            <input type="hidden" id="adminmodel-user_id" class="form-control" name="AdminModel[user_id]" value="{{ $info->user_id ?? '' }}">

            <div class="simple-form-field">
                <div class="form-group">
                    <label for="adminmodel-user_name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">登录名：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            @if(isset($info->user_id))
                                <input type="text" id="adminmodel-user_name" class="form-control" name="AdminModel[user_name]" value="{{ $info->user_name }}" disabled="" autocomplete="off">
                            @else
                                <input type="text" id="adminmodel-user_name" class="form-control" name="AdminModel[user_name]" autocomplete="off" aria-required="true">
                            @endif


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">请填写正确的登录名</div></div>
                    </div>
                </div>
            </div>

            @if(isset($info->user_id))
                <div class="simple-form-field">
                        <div class="form-group">
                            <label for="adminmodel-password" class="col-sm-4 control-label">

                                <span class="ng-binding">密码：</span>
                            </label>
                            <div class="col-sm-8">
                                <div class="form-control-box">


                                    <input type="password" id="pwd-input" class="form-control" name="AdminModel[password]" value="" maxlength="20" autocomplete="off">
                                    <i class="fa fa-eye-slash pwd-toggle" data-id="pwd-input"></i>


                                </div>

                                <div class="help-block help-block-t"></div>
                            </div>
                        </div>
                </div>
            @else
                <div class="simple-form-field">
                        <div class="form-group">
                            <label for="adminmodel-password" class="col-sm-4 control-label">
                                <span class="text-danger ng-binding">*</span>
                                <span class="ng-binding">密码：</span>
                            </label>
                            <div class="col-sm-8">
                                <div class="form-control-box">


                                    <input type="password" id="pwd-input" class="form-control" name="AdminModel[password]" value="" maxlength="20" autocomplete="off" aria-required="true">
                                    <i class="fa fa-eye-slash pwd-toggle" data-id="pwd-input"></i>


                                </div>

                                <div class="help-block help-block-t"></div>
                            </div>
                        </div>
                    </div>
            @endif

            <div class="simple-form-field">
                <div class="form-group">
                    <label for="adminmodel-real_name" class="col-sm-4 control-label">

                        <span class="ng-binding">真实姓名：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="adminmodel-real_name" class="form-control" name="AdminModel[real_name]" value="{{ $info->real_name ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <div class="form-group">
                    <label for="adminmodel-mobile" class="col-sm-4 control-label">

                        <span class="ng-binding">手机：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="adminmodel-mobile" class="form-control" name="AdminModel[mobile]" value="{{ $info->mobile ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">手机号码和邮箱两者请至少填写一项</div></div>
                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <div class="form-group">
                    <label for="adminmodel-email" class="col-sm-4 control-label">

                        <span class="ng-binding">邮箱：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="adminmodel-email" class="form-control" name="AdminModel[email]" value="{{ $info->email ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">手机号码和邮箱两者请至少填写一项</div></div>
                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <div class="form-group">
                    <label for="adminmodel-tel" class="col-sm-4 control-label">

                        <span class="ng-binding">固话：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="adminmodel-tel" class="form-control" name="AdminModel[tel]" value="{{ $info->tel ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>



            @if(!isset($info->user_id))
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="adminmodel-role_id" class="col-sm-4 control-label">

                            <span class="ng-binding">角色：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">


                                <select id="adminmodel-role_id" class="form-control" name="AdminModel[role_id]">
                                    <option value="0">请选择</option>
                                    @foreach($role_list as $k=>$v)
                                        <option value="{{ $k }}">{{ $v }}</option>
                                    @endforeach
                                </select>
                                <a href="/system/role/add" class="btn btn-warning btn-sm m-l-10" target="_blank">创建角色</a>
                                <a id="btn_reload_role_list" class="btn btn-primary btn-sm m-l-5">重新加载</a>


                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>



                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="adminmodel-status" class="col-sm-4 control-label">

                            <span class="ng-binding">用户状态：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">

                                <!-- 管理员状态用开关表示：items定义显示的文字；value指定勾选的值，默认为1；uncheck指定取消勾选时的值，默认为0； -->
                                <label class="control-label control-label-switch">
                                    <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                        <input type="hidden" name="AdminModel[status]" value="0">
                                        <label>
                                            <input type="checkbox" id="AdminModel-status" class="form-control b-n"
                                                   name="AdminModel[status]" value="1" checked data-on-text="启用"
                                                   data-off-text="禁用">
                                        </label>
                                    </div>
                                </label>


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">启用：管理员可访问平台方后台；禁用：管理员将无法访问平台方后台</div></div>
                        </div>
                    </div>
                </div>
                <!-- 有效访问时间 -->
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="adminmodel-valid_time_format" class="col-sm-4 control-label">

                            <span class="ng-binding">有效截止时间：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">


                                <input type="text" id="adminmodel-valid_time_format" class="form-control large" name="AdminModel[valid_time_format]">


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">用于控制管理员可以访问后台的有效截止时间，超过此时间后管理员将无法登录后台</div></div>
                        </div>
                    </div>
                </div>
            @else
                <!-- 管理员不能修改自己的角色、状态、有效时间 -->
            @endif

            <div class="simple-form-field p-b-30">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label"></label>
                    <div class="col-xs-8">
                        <input type="button" id="btn_submit" value="确认提交" class="btn btn-primary">
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
    <!-- 日历控件-->
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css?v=5.0">
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js?v=6.0"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=6.0"></script>
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=6.0"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=6.0"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=6.0"></script>
    <script id="clientRules" type="text">
        @if(!isset($info->user_id))
            [{"id": "adminmodel-access_token", "name": "AdminModel[access_token]", "attribute": "access_token", "rules": {"default":"i-USLS15iK2dPbWMNUS-_4tpg1r02QKw","messages":{"default":""}}},{"id": "adminmodel-auth_key", "name": "AdminModel[auth_key]", "attribute": "auth_key", "rules": {"default":"KpAvMncqYwUElRq9","messages":{"default":""}}},{"id": "adminmodel-user_type", "name": "AdminModel[user_type]", "attribute": "user_type", "rules": {"default":0,"messages":{"default":""}}},{"id": "adminmodel-status", "name": "AdminModel[status]", "attribute": "status", "rules": {"default":1,"messages":{"default":""}}},{"id": "adminmodel-user_name", "name": "AdminModel[user_name]", "attribute": "user_name", "rules": {"username":{"pattern":/^[a-zA-Z0-9_\u4e00-\u9fa5]{4,20}$/,"not":false,"skipOnEmpty":1},"match":{"pattern":/^\d+$/,"not":true,"skipOnEmpty":1},"messages":{"username":"登录名只能由4-20个字，支持汉字、字母、数字、下划线“_”构成的组合","match":"登录名不能为纯数字"}}},{"id": "adminmodel-user_name", "name": "AdminModel[user_name]", "attribute": "user_name", "rules": {"ajax":{"url":"\/system\/admin\/client-validate","model":"YXBwXG1vZHVsZXNcc3lzdGVtXG1vZGVsc1xBZG1pbk1vZGVs","attribute":"user_name","params":[]},"messages":{"ajax":"{attribute}的值\u0022{value}\u0022已经被占用了。"}}},{"id": "adminmodel-password", "name": "AdminModel[password]", "attribute": "password", "rules": {"required":true,"messages":{"required":"密码不能为空。"}}},{"id": "adminmodel-password", "name": "AdminModel[password]", "attribute": "password", "rules": {"password":{"pattern":/^[^\u4e00-\u9fa5\·]{6,20}$/,"not":false,"skipOnEmpty":1},"match":{"pattern":/\s+/,"not":true,"skipOnEmpty":1},"messages":{"password":"密码长度为6-20个字符，建议由字母、数字和符号两种以上。","match":"密码不能包含空格。"}}},{"id": "adminmodel-email", "name": "AdminModel[email]", "attribute": "email", "rules": {"email":{"pattern":/^[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/,"fullPattern":/^[^@]*<[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?>$/,"allowName":false,"enableIDN":false,"skipOnEmpty":1},"messages":{"email":"邮箱不是有效的邮箱地址。"}}},{"id": "adminmodel-mobile", "name": "AdminModel[mobile]", "attribute": "mobile", "rules": {"match":{"pattern":/^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$|17[0-9]{1}[0-9]{8}$|14[0-9]{1}[0-9]{8}$/,"not":false,"skipOnEmpty":1},"messages":{"match":"手机是无效的。"}}},{"id": "adminmodel-user_id", "name": "AdminModel[user_id]", "attribute": "user_id", "rules": {"integer":true,"messages":{"integer":"管理员ID必须是整数。"}}},{"id": "adminmodel-user_name", "name": "AdminModel[user_name]", "attribute": "user_name", "rules": {"required":true,"messages":{"required":"登录名不能为空。"}}},{"id": "adminmodel-user_type", "name": "AdminModel[user_type]", "attribute": "user_type", "rules": {"required":true,"messages":{"required":"管理员类型 0-平台管理员 1-站点管理员不能为空。"}}},{"id": "adminmodel-user_type", "name": "AdminModel[user_type]", "attribute": "user_type", "rules": {"integer":true,"messages":{"integer":"管理员类型 0-平台管理员 1-站点管理员必须是整数。"}}},{"id": "adminmodel-role_id", "name": "AdminModel[role_id]", "attribute": "role_id", "rules": {"integer":true,"messages":{"integer":"角色必须是整数。"}}},{"id": "adminmodel-status", "name": "AdminModel[status]", "attribute": "status", "rules": {"integer":true,"messages":{"integer":"用户状态必须是整数。"}}},{"id": "adminmodel-last_time", "name": "AdminModel[last_time]", "attribute": "last_time", "rules": {"integer":true,"messages":{"integer":"最后登录时间必须是整数。"}}},{"id": "adminmodel-visit_count", "name": "AdminModel[visit_count]", "attribute": "visit_count", "rules": {"integer":true,"messages":{"integer":"登录次数必须是整数。"}}},{"id": "adminmodel-create_time", "name": "AdminModel[create_time]", "attribute": "create_time", "rules": {"integer":true,"messages":{"integer":"创建时间必须是整数。"}}},{"id": "adminmodel-update_time", "name": "AdminModel[update_time]", "attribute": "update_time", "rules": {"integer":true,"messages":{"integer":"更新时间必须是整数。"}}},{"id": "adminmodel-auth_codes", "name": "AdminModel[auth_codes]", "attribute": "auth_codes", "rules": {"string":true,"messages":{"string":"授权项 超级为all必须是一条字符串。"}}},{"id": "adminmodel-user_name", "name": "AdminModel[user_name]", "attribute": "user_name", "rules": {"string":true,"messages":{"string":"登录名必须是一条字符串。","maxlength":"登录名只能包含至多60个字符。"},"maxlength":60}},{"id": "adminmodel-password", "name": "AdminModel[password]", "attribute": "password", "rules": {"string":true,"messages":{"string":"密码必须是一条字符串。","maxlength":"密码只能包含至多60个字符。"},"maxlength":60}},{"id": "adminmodel-real_name", "name": "AdminModel[real_name]", "attribute": "real_name", "rules": {"string":true,"messages":{"string":"真实姓名必须是一条字符串。","maxlength":"真实姓名只能包含至多60个字符。"},"maxlength":60}},{"id": "adminmodel-email", "name": "AdminModel[email]", "attribute": "email", "rules": {"string":true,"messages":{"string":"邮箱必须是一条字符串。","maxlength":"邮箱只能包含至多60个字符。"},"maxlength":60}},{"id": "adminmodel-ec_salt", "name": "AdminModel[ec_salt]", "attribute": "ec_salt", "rules": {"string":true,"messages":{"string":"混淆码必须是一条字符串。","maxlength":"混淆码只能包含至多10个字符。"},"maxlength":10}},{"id": "adminmodel-mobile", "name": "AdminModel[mobile]", "attribute": "mobile", "rules": {"string":true,"messages":{"string":"手机必须是一条字符串。","maxlength":"手机只能包含至多20个字符。"},"maxlength":20}},{"id": "adminmodel-tel", "name": "AdminModel[tel]", "attribute": "tel", "rules": {"string":true,"messages":{"string":"固话必须是一条字符串。","maxlength":"固话只能包含至多20个字符。"},"maxlength":20}},{"id": "adminmodel-access_token", "name": "AdminModel[access_token]", "attribute": "access_token", "rules": {"string":true,"messages":{"string":"授权认证必须是一条字符串。","maxlength":"授权认证只能包含至多200个字符。"},"maxlength":200}},{"id": "adminmodel-auth_key", "name": "AdminModel[auth_key]", "attribute": "auth_key", "rules": {"string":true,"messages":{"string":"授权Key必须是一条字符串。","maxlength":"授权Key只能包含至多200个字符。"},"maxlength":200}},{"id": "adminmodel-last_ip", "name": "AdminModel[last_ip]", "attribute": "last_ip", "rules": {"string":true,"messages":{"string":"最后登录IP必须是一条字符串。","maxlength":"最后登录IP只能包含至多15个字符。"},"maxlength":15}},{"id": "adminmodel-valid_time", "name": "AdminModel[valid_time]", "attribute": "valid_time", "rules": {"integer":true,"messages":{"integer":"有效截止时间必须是整数。"}}},{"id": "adminmodel-valid_time_format", "name": "AdminModel[valid_time_format]", "attribute": "valid_time_format", "rules": {"string":true,"messages":{"string":"有效截止时间必须是一条字符串。"}}},]
        @else
            [{"id": "adminmodel-access_token", "name": "AdminModel[access_token]", "attribute": "access_token", "rules": {"default":"fb9Zf3upBRK1lrRHgQJX9JDnXNYAMRKs","messages":{"default":""}}},{"id": "adminmodel-auth_key", "name": "AdminModel[auth_key]", "attribute": "auth_key", "rules": {"default":"X3_Eq7yJxnI54-ny","messages":{"default":""}}},{"id": "adminmodel-user_type", "name": "AdminModel[user_type]", "attribute": "user_type", "rules": {"default":0,"messages":{"default":""}}},{"id": "adminmodel-status", "name": "AdminModel[status]", "attribute": "status", "rules": {"default":1,"messages":{"default":""}}},{"id": "adminmodel-user_name", "name": "AdminModel[user_name]", "attribute": "user_name", "rules": {"ajax":{"url":"/system/admin/client-validate","model":"YXBwXG1vZHVsZXNcc3lzdGVtXG1vZGVsc1xBZG1pbk1vZGVs","attribute":"user_name","params":["AdminModel[user_id]"]},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},{"id": "adminmodel-password", "name": "AdminModel[password]", "attribute": "password", "rules": {"password":{"pattern":/^[^\u4e00-\u9fa5\·]{6,20}$/,"not":false,"skipOnEmpty":1},"match":{"pattern":/\s+/,"not":true,"skipOnEmpty":1},"messages":{"password":"密码长度为6-20个字符，建议由字母、数字和符号两种以上。","match":"密码不能包含空格。"}}},{"id": "adminmodel-email", "name": "AdminModel[email]", "attribute": "email", "rules": {"email":{"pattern":/^[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/,"fullPattern":/^[^@]*<[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?>$/,"allowName":false,"enableIDN":false,"skipOnEmpty":1},"messages":{"email":"邮箱不是有效的邮箱地址。"}}},{"id": "adminmodel-mobile", "name": "AdminModel[mobile]", "attribute": "mobile", "rules": {"match":{"pattern":/^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$|17[0-9]{1}[0-9]{8}$|14[0-9]{1}[0-9]{8}$|199[0-9]{8}$|198[0-9]{8}$|166[0-9]{8}$/,"not":false,"skipOnEmpty":1},"messages":{"match":"手机是无效的。"}}},{"id": "adminmodel-user_id", "name": "AdminModel[user_id]", "attribute": "user_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"管理员ID必须是整数。"}}},{"id": "adminmodel-user_name", "name": "AdminModel[user_name]", "attribute": "user_name", "rules": {"required":true,"messages":{"required":"登录名不能为空。"}}},{"id": "adminmodel-user_type", "name": "AdminModel[user_type]", "attribute": "user_type", "rules": {"required":true,"messages":{"required":"管理员类型 0-平台管理员 1-站点管理员不能为空。"}}},{"id": "adminmodel-role_id", "name": "AdminModel[role_id]", "attribute": "role_id", "rules": {"required":true,"messages":{"required":"角色不能为空。"}}},{"id": "adminmodel-user_type", "name": "AdminModel[user_type]", "attribute": "user_type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"管理员类型 0-平台管理员 1-站点管理员必须是整数。"}}},{"id": "adminmodel-role_id", "name": "AdminModel[role_id]", "attribute": "role_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"角色必须是整数。"}}},{"id": "adminmodel-status", "name": "AdminModel[status]", "attribute": "status", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"用户状态必须是整数。"}}},{"id": "adminmodel-last_time", "name": "AdminModel[last_time]", "attribute": "last_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"最后登录时间必须是整数。"}}},{"id": "adminmodel-visit_count", "name": "AdminModel[visit_count]", "attribute": "visit_count", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"登录次数必须是整数。"}}},{"id": "adminmodel-create_time", "name": "AdminModel[create_time]", "attribute": "create_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"创建时间必须是整数。"}}},{"id": "adminmodel-update_time", "name": "AdminModel[update_time]", "attribute": "update_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"更新时间必须是整数。"}}},{"id": "adminmodel-auth_codes", "name": "AdminModel[auth_codes]", "attribute": "auth_codes", "rules": {"string":true,"messages":{"string":"授权项 超级为all必须是一条字符串。"}}},{"id": "adminmodel-user_name", "name": "AdminModel[user_name]", "attribute": "user_name", "rules": {"string":true,"messages":{"string":"登录名必须是一条字符串。","maxlength":"登录名只能包含至多60个字符。"},"maxlength":60}},{"id": "adminmodel-password", "name": "AdminModel[password]", "attribute": "password", "rules": {"string":true,"messages":{"string":"密码必须是一条字符串。","maxlength":"密码只能包含至多60个字符。"},"maxlength":60}},{"id": "adminmodel-real_name", "name": "AdminModel[real_name]", "attribute": "real_name", "rules": {"string":true,"messages":{"string":"真实姓名必须是一条字符串。","maxlength":"真实姓名只能包含至多60个字符。"},"maxlength":60}},{"id": "adminmodel-email", "name": "AdminModel[email]", "attribute": "email", "rules": {"string":true,"messages":{"string":"邮箱必须是一条字符串。","maxlength":"邮箱只能包含至多60个字符。"},"maxlength":60}},{"id": "adminmodel-salt", "name": "AdminModel[salt]", "attribute": "salt", "rules": {"string":true,"messages":{"string":"混淆码必须是一条字符串。","maxlength":"混淆码只能包含至多10个字符。"},"maxlength":10}},{"id": "adminmodel-mobile", "name": "AdminModel[mobile]", "attribute": "mobile", "rules": {"string":true,"messages":{"string":"手机必须是一条字符串。","maxlength":"手机只能包含至多20个字符。"},"maxlength":20}},{"id": "adminmodel-tel", "name": "AdminModel[tel]", "attribute": "tel", "rules": {"string":true,"messages":{"string":"固话必须是一条字符串。","maxlength":"固话只能包含至多20个字符。"},"maxlength":20}},{"id": "adminmodel-access_token", "name": "AdminModel[access_token]", "attribute": "access_token", "rules": {"string":true,"messages":{"string":"授权认证必须是一条字符串。","maxlength":"授权认证只能包含至多200个字符。"},"maxlength":200}},{"id": "adminmodel-auth_key", "name": "AdminModel[auth_key]", "attribute": "auth_key", "rules": {"string":true,"messages":{"string":"授权Key必须是一条字符串。","maxlength":"授权Key只能包含至多200个字符。"},"maxlength":200}},{"id": "adminmodel-last_ip", "name": "AdminModel[last_ip]", "attribute": "last_ip", "rules": {"string":true,"messages":{"string":"最后登录IP必须是一条字符串。","maxlength":"最后登录IP只能包含至多15个字符。"},"maxlength":15}},{"id": "adminmodel-valid_time", "name": "AdminModel[valid_time]", "attribute": "valid_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"有效截止时间必须是整数。"}}},{"id": "adminmodel-valid_time_format", "name": "AdminModel[valid_time_format]", "attribute": "valid_time_format", "rules": {"string":true,"messages":{"string":"有效截止时间必须是一条字符串。"}}},]
        @endif
    </script>
    <script type="text/javascript">
        $().ready(function() {

            $("#adminmodel-valid_time_format").datetimepicker({
                language: 'zh-CN',
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,// 开始视图
                minView: 0, // 最小视图
                forceParse: 0,
                showMeridian: 1,
                format: 'yyyy-mm-dd hh:ii',
            });

            var validator = $("#form").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#clientRules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return false;
                }

                if ($.trim($("#adminmodel-mobile").val()) == "" && $.trim($("#adminmodel-email").val()) == "") {
                    $.msg("手机号码和邮箱不能同时为空");
                    return false;
                }

                //清空文件
                var data = $("#form").serializeJson();
                var url = $("#form").attr("action");

                //加载提示
                $.loading.start();

                $.post(url, data, function(result) {
                    $.loading.stop();
                    if (result.code == 0) {
                        $.msg(result.message);
                        $.go('/system/admin/list');
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "json");

                return false;
            });

            // 重新加载角色列表
            $("#btn_reload_role_list").click(function() {
                $.loading.start();
                $.get("/system/admin/role-list", {}, function(result) {
                    if (result.code == 0) {
                        var list = result.data;
                        var html = "";
                        for ( var name in result.data) {
                            html += "<option value='"+name+"'>" + result.data[name] + "</option>";
                        }

                        $("#adminmodel-role_id").html(html);
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