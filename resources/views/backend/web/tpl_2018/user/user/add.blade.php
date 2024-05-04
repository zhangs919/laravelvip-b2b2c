{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
    <script src="/assets/d2eace91/js/datetime/dateselector.js?v=1.2"></script>
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css?v=1.2">
    <!-- 日历控件-->
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css?v=1.2">
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js?v=1.2"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=1.2"></script>
    <!-- 双向选择器 -->
    <link rel="stylesheet" href="/assets/d2eace91/css/selector/jquery.multiselect2side.css?v=1.2">
    <script src="/assets/d2eace91/js/selector/jquery.multiselect2side.js?v=1.2"></script>
    
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <form id="UserModel" class="form-horizontal" name="UserModel" action="/user/user/add?type=0" method="post" novalidate="novalidate">
        @csrf
        <div class="table-content m-t-30 clearfix">

            <div class="simple-form-field">
                <div class="form-group">
                    <label for="usermodel-user_name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">用户名：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">



                            <input type="text" id="usermodel-user_name" class="form-control" name="UserModel[user_name]">



                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">4~20个字，支持汉字、字母、数字、下划线“_”构成的组合</div></div>
                    </div>
                </div>
            </div>


            <div class="simple-form-field">
                <div class="form-group">
                    <label for="usermodel-password" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">登录密码：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="password" id="pwd-input" class="form-control" name="UserModel[password]" maxlength="30" autocomplete="off">
                            <i class="fa fa-eye-slash pwd-toggle" data-id="pwd-input"></i>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>


            <div class="simple-form-field">
                <div class="form-group">
                    <label for="usermodel-nickname" class="col-sm-4 control-label">

                        <span class="ng-binding">昵称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="usermodel-nickname" class="form-control" name="UserModel[nickname]">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">支持中、英文、数字及符号</div></div>
                    </div>
                </div>
            </div>
            <!-- 会员等级 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="usermodel-rank_id" class="col-sm-4 control-label">

                        <span class="ng-binding">用户等级：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <select id="usermodel-rank_id" name="UserModel[rank_id]" class="chosen-select" style="display: none;">

                                @foreach($user_rank as $v)
                                    <option value="{{ $v->rank_id }}" @if($v->min_points > 0) disabled="true" @endif>{{ $v->rank_name }}</option>

                                @endforeach

                            </select>

                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 享受时长 -->
            <div class="simple-form-field between" style="display: none">
                <div class="form-group">
                    <label for="" class="col-sm-4 control-label">
                        <span class="ng-binding">享受时长：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <div id="" class="" name="">
                                <label class="control-label cur-p m-r-10">

                                    <input type="radio" name="UserModel[use_between]" value="0" checked="">

                                    无期限
                                </label>
                                <br>
                                <label class="control-label cur-p m-r-10">

                                    <input type="radio" name="UserModel[use_between]" value="1">

                                    <input type="text" id="usermodel-rank_start_time" class="form-control form_datetime ipt pull-none" name="UserModel[rank_start_time]" placeholder="开始时间">

                                    &nbsp;~&nbsp;

                                    <input type="text" id="usermodel-rank_end_time" class="form-control form_datetime ipt pull-none" name="UserModel[rank_end_time]" placeholder="结束时间">
                                </label>
                            </div>
                        </div>
                        <div class="help-block help-block-t">
                            <div class="help-block help-block-t">只有特殊会员等级，才需要设置享受时长</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <div class="form-group">
                    <label for="usermodel-sex" class="col-sm-4 control-label">

                        <span class="ng-binding">性别：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <select id="usermodel-sex" class="form-control" name="UserModel[sex]">
                                <option value="0">保密</option>
                                <option value="1">男</option>
                                <option value="2">女</option>
                            </select>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div> <div class="simple-form-field">
                <div class="form-group">
                    <label for="usermodel-birthday" class="col-sm-4 control-label">

                        <span class="ng-binding">出生日期：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <select id="sel_year" class="form-control m-r-5"></select>
                            年
                            <select id="sel_month" class="form-control m-r-5 m-l-5"></select>
                            月
                            <select id="sel_day" class="form-control m-r-5 m-l-5"></select>
                            日

                            <input type="hidden" id="birthday" class="form-control" name="UserModel[birthday]" value="0">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <script>
                $(function() {
                    $.dateselector({
                        defaulttime: "1970-01-01",
                        sel_unix: "#birthday"
                    });
                });
            </script>

            <div class="form-group">
                <label class="col-sm-4 control-label">
                    <span class="text-danger ng-binding"></span>
                    <span class="ng-binding">现居住地址：</span>
                </label>
                <div id="address" class="col-sm-8">

                    <!--	<select class="form-control m-r-5" id="pro" onchange="AjaxRegion('ajax-region','city',this.value)">
                        <option value="0">省份</option>

                    </select>
                    <select class="form-control m-r-5" id="city" onchange="AjaxRegion('ajax-region','area',this.value)">
                        <option value="0">市</option>
                    </select>
                    <select class="form-control" id="area" name="address_now">
                        <option value="0">区/县</option>
                    </select>-->


                </div>
            </div>

            <input type="hidden" id="receive_address" name="receive_address">


            <div class="simple-form-field">
                <div class="form-group">
                    <label for="usermodel-detail_address" class="col-sm-4 control-label">

                        <span class="ng-binding">详细地址：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <textarea id="usermodel-detail_address" class="form-control" name="UserModel[detail_address]" rows="5" style="height:60px"></textarea>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>


            <div class="simple-form-field">
                <div class="form-group">
                    <label for="usermodel-mobile" class="col-sm-4 control-label">

                        <span class="ng-binding">手机号码：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="usermodel-mobile" class="form-control" name="UserModel[mobile]">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">请填写正确的11位手机号</div></div>
                    </div>
                </div>
            </div>


            <div class="simple-form-field">
                <div class="form-group">
                    <label for="usermodel-email" class="col-sm-4 control-label">

                        <span class="ng-binding">邮箱地址：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="usermodel-email" class="form-control" name="UserModel[email]">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">邮箱地址格式为xxx@xx.com</div></div>
                    </div>
                </div>
            </div>


            <div class="simple-form-field">
                <div class="form-group">
                    <label for="usermodel-status" class="col-sm-4 control-label">

                        <span class="ng-binding">是否允许登录：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="UserModel[status]" value="0">
                                    <label>
                                        <input type="checkbox" id="usermodel-status" class="form-control b-n" name="UserModel[status]" value="1" checked="" data-on-text="是" data-off-text="否">
                                    </label>
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">如果为否，则会员不能登录</div></div>
                    </div>
                </div>
            </div>


            <div class="simple-form-field">
                <div class="form-group">
                    <label for="usermodel-shopping_status" class="col-sm-4 control-label">

                        <span class="ng-binding">是否允许购物：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="UserModel[shopping_status]" value="0">
                                    <label>
                                        <input type="checkbox" id="usermodel-shopping_status" class="form-control b-n" name="UserModel[shopping_status]" value="1" checked="" data-on-text="是" data-off-text="否">
                                    </label>
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">如果为否，则会员不能进行购物</div></div>
                    </div>
                </div>
            </div>


            <div class="simple-form-field">
                <div class="form-group">
                    <label for="usermodel-comment_status" class="col-sm-4 control-label">

                        <span class="ng-binding">是否允许评论：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="UserModel[comment_status]" value="0">
                                    <label>
                                        <input type="checkbox" id="usermodel-comment_status" class="form-control b-n" name="UserModel[comment_status]" value="1" checked="" data-on-text="是" data-off-text="否">
                                    </label>
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">如果为否，则会员不能进行评价</div></div>
                    </div>
                </div>
            </div>
            <!-- 提交按钮 -->
            <div class="bottom-btn p-b-30">
                <input type="submit" id="btn_submit" name="btn_submit" class="btn btn-primary btn-lg" value="确认提交">
                <!-- 隐藏域，标识作用 -->
                <input type="hidden" id="usermodel-user_id" class="form-control" name="UserModel[user_id]">
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


{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer script page元素同级下面--}}
@section('footer_script')

    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/jquery.region.js?v=1.2"></script>
    <script type="text/javascript">
        $("#address").regionselector({
            value: '',
            select_class: "form-control",
            change: function(value, names, is_last) {
                $("#receive_address").val(value);
            }
        });
    </script>

    <!-- 验证规则 -->
    <script id="client_rules" type="text">
[{"id": "usermodel-user_name", "name": "UserModel[user_name]", "attribute": "user_name", "rules": {"required":true,"messages":{"required":"用户名不能为空。"}}},{"id": "usermodel-password", "name": "UserModel[password]", "attribute": "password", "rules": {"required":true,"messages":{"required":"登录密码不能为空。"}}},{"id": "usermodel-password", "name": "UserModel[password]", "attribute": "password", "rules": {"password":{"pattern":/^[^\u4e00-\u9fa5\·]{6,20}$/,"not":false,"skipOnEmpty":1},"match":{"pattern":/\s+/,"not":true,"skipOnEmpty":1},"messages":{"password":"登录密码长度为6-20个字符，建议由字母、数字和符号两种以上。","match":"登录密码不能包含空格。"}}},{"id": "usermodel-sex", "name": "UserModel[sex]", "attribute": "sex", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"性别必须是整数。"}}},{"id": "usermodel-birthday", "name": "UserModel[birthday]", "attribute": "birthday", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"出生日期必须是整数。"}}},{"id": "usermodel-rank_point", "name": "UserModel[rank_point]", "attribute": "rank_point", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"成长值必须是整数。"}}},{"id": "usermodel-address_id", "name": "UserModel[address_id]", "attribute": "address_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"默认收货地址必须是整数。"}}},{"id": "usermodel-rank_id", "name": "UserModel[rank_id]", "attribute": "rank_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"用户等级必须是整数。"}}},{"id": "usermodel-mobile_validated", "name": "UserModel[mobile_validated]", "attribute": "mobile_validated", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否已验证手机必须是整数。"}}},{"id": "usermodel-email_validated", "name": "UserModel[email_validated]", "attribute": "email_validated", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否已验证邮箱必须是整数。"}}},{"id": "usermodel-reg_time", "name": "UserModel[reg_time]", "attribute": "reg_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"注册时间必须是整数。"}}},{"id": "usermodel-last_time", "name": "UserModel[last_time]", "attribute": "last_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"最近登录时间必须是整数。"}}},{"id": "usermodel-visit_count", "name": "UserModel[visit_count]", "attribute": "visit_count", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"访问次数必须是整数。"}}},{"id": "usermodel-status", "name": "UserModel[status]", "attribute": "status", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否允许登录必须是整数。"}}},{"id": "usermodel-type", "name": "UserModel[type]", "attribute": "type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"用户类型必须是整数。"}}},{"id": "usermodel-is_seller", "name": "UserModel[is_seller]", "attribute": "is_seller", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否为卖家必须是整数。"}}},{"id": "usermodel-is_real", "name": "UserModel[is_real]", "attribute": "is_real", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否通过实名认证必须是整数。"}}},{"id": "usermodel-shopping_status", "name": "UserModel[shopping_status]", "attribute": "shopping_status", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否允许购物必须是整数。"}}},{"id": "usermodel-comment_status", "name": "UserModel[comment_status]", "attribute": "comment_status", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否允许评论必须是整数。"}}},{"id": "usermodel-user_money", "name": "UserModel[user_money]", "attribute": "user_money", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"可提现余额必须是一个数字。"}}},{"id": "usermodel-user_money_limit", "name": "UserModel[user_money_limit]", "attribute": "user_money_limit", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"不可提现余额必须是一个数字。"}}},{"id": "usermodel-frozen_money", "name": "UserModel[frozen_money]", "attribute": "frozen_money", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"冻结金额必须是一个数字。"}}},{"id": "usermodel-email", "name": "UserModel[email]", "attribute": "email", "rules": {"string":true,"messages":{"string":"邮箱地址必须是一条字符串。","maxlength":"邮箱地址只能包含至多60个字符。"},"maxlength":60}},{"id": "usermodel-address_now", "name": "UserModel[address_now]", "attribute": "address_now", "rules": {"string":true,"messages":{"string":"现居住地址必须是一条字符串。","maxlength":"现居住地址只能包含至多60个字符。"},"maxlength":60}},{"id": "usermodel-user_name", "name": "UserModel[user_name]", "attribute": "user_name", "rules": {"username":{"pattern":/^[a-zA-Z0-9_\u4e00-\u9fa5]{4,20}$/,"not":false,"skipOnEmpty":1},"match":{"pattern":/^\d+$/,"not":true,"skipOnEmpty":1},"messages":{"username":"用户名只能由4-20个字，支持汉字、字母、数字、下划线“_”构成的组合","match":"用户名不能为纯数字"}}},{"id": "usermodel-user_name", "name": "UserModel[user_name]", "attribute": "user_name", "rules": {"string":true,"messages":{"string":"用户名必须是一条字符串。","minlength":"用户名应该包含至少4个字符。","maxlength":"用户名只能包含至多20个字符。"},"minlength":4,"maxlength":20}},{"id": "usermodel-nickname", "name": "UserModel[nickname]", "attribute": "nickname", "rules": {"string":true,"messages":{"string":"昵称必须是一条字符串。","minlength":"昵称应该包含至少1个字符。"},"minlength":1}},{"id": "usermodel-password", "name": "UserModel[password]", "attribute": "password", "rules": {"string":true,"messages":{"string":"登录密码必须是一条字符串。"}}},{"id": "usermodel-surplus_password", "name": "UserModel[surplus_password]", "attribute": "surplus_password", "rules": {"string":true,"messages":{"string":"余额支付密码必须是一条字符串。"}}},{"id": "usermodel-nickname", "name": "UserModel[nickname]", "attribute": "nickname", "rules": {"string":true,"messages":{"string":"昵称必须是一条字符串。","maxlength":"昵称只能包含至多20个字符。"},"maxlength":20}},{"id": "usermodel-mobile", "name": "UserModel[mobile]", "attribute": "mobile", "rules": {"string":true,"messages":{"string":"手机号码必须是一条字符串。","maxlength":"手机号码只能包含至多20个字符。"},"maxlength":20}},{"id": "usermodel-pay_point", "name": "UserModel[pay_point]", "attribute": "pay_point", "rules": {"string":true,"messages":{"string":"消费积分必须是一条字符串。","maxlength":"消费积分只能包含至多255个字符。"},"maxlength":255}},{"id": "usermodel-password_reset_token", "name": "UserModel[password_reset_token]", "attribute": "password_reset_token", "rules": {"string":true,"messages":{"string":"重置密码令牌必须是一条字符串。","maxlength":"重置密码令牌只能包含至多255个字符。"},"maxlength":255}},{"id": "usermodel-detail_address", "name": "UserModel[detail_address]", "attribute": "detail_address", "rules": {"string":true,"messages":{"string":"详细地址必须是一条字符串。","maxlength":"详细地址只能包含至多255个字符。"},"maxlength":255}},{"id": "usermodel-headimg", "name": "UserModel[headimg]", "attribute": "headimg", "rules": {"string":true,"messages":{"string":"头像必须是一条字符串。","maxlength":"头像只能包含至多255个字符。"},"maxlength":255}},{"id": "usermodel-auth_key", "name": "UserModel[auth_key]", "attribute": "auth_key", "rules": {"string":true,"messages":{"string":"授权码必须是一条字符串。","maxlength":"授权码只能包含至多255个字符。"},"maxlength":255}},{"id": "usermodel-user_remark", "name": "UserModel[user_remark]", "attribute": "user_remark", "rules": {"string":true,"messages":{"string":"会员备注必须是一条字符串。","maxlength":"会员备注只能包含至多255个字符。"},"maxlength":255}},{"id": "usermodel-salt", "name": "UserModel[salt]", "attribute": "salt", "rules": {"string":true,"messages":{"string":"混淆码必须是一条字符串。","maxlength":"混淆码只能包含至多10个字符。"},"maxlength":10}},{"id": "usermodel-reg_ip", "name": "UserModel[reg_ip]", "attribute": "reg_ip", "rules": {"string":true,"messages":{"string":"注册IP地址必须是一条字符串。","maxlength":"注册IP地址只能包含至多40个字符。"},"maxlength":40}},{"id": "usermodel-last_ip", "name": "UserModel[last_ip]", "attribute": "last_ip", "rules": {"string":true,"messages":{"string":"最近登录IP地址必须是一条字符串。","maxlength":"最近登录IP地址只能包含至多40个字符。"},"maxlength":40}},{"id": "usermodel-mobile", "name": "UserModel[mobile]", "attribute": "mobile", "rules": {"match":{"pattern":/^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$|17[0-9]{1}[0-9]{8}$|14[0-9]{1}[0-9]{8}$|199[0-9]{8}$|198[0-9]{8}$|166[0-9]{8}$/,"not":false,"skipOnEmpty":1},"messages":{"match":"手机号码是无效的。"}}},{"id": "usermodel-email", "name": "UserModel[email]", "attribute": "email", "rules": {"email":{"pattern":/^[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/,"fullPattern":/^[^@]*<[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?>$/,"allowName":false,"enableIDN":false,"skipOnEmpty":1},"messages":{"email":"邮箱地址不是有效的邮箱地址。"}}},{"id": "usermodel-user_name", "name": "UserModel[user_name]", "attribute": "user_name", "rules": {"ajax":{"url":"/user/user/client-validate","model":"YXBwXG1vZHVsZXNcdXNlclxtb2RlbHNcVXNlck1vZGVs","attribute":"user_name","params":["UserModel[user_id]"],"scenario":"create"},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},{"id": "usermodel-mobile", "name": "UserModel[mobile]", "attribute": "mobile", "rules": {"ajax":{"url":"/user/user/client-validate","model":"YXBwXG1vZHVsZXNcdXNlclxtb2RlbHNcVXNlck1vZGVs","attribute":"mobile","params":["UserModel[user_id]"],"scenario":"create"},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},{"id": "usermodel-email", "name": "UserModel[email]", "attribute": "email", "rules": {"ajax":{"url":"/user/user/client-validate","model":"YXBwXG1vZHVsZXNcdXNlclxtb2RlbHNcVXNlck1vZGVs","attribute":"email","params":["UserModel[user_id]"],"scenario":"create"},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},{"id": "usermodel-sex", "name": "UserModel[sex]", "attribute": "sex", "rules": {"in":{"range":["0","1","2"]},"messages":{"in":"性别是无效的。"}}},{"id": "usermodel-reg_from", "name": "UserModel[reg_from]", "attribute": "reg_from", "rules": {"in":{"range":["0","1","2","3","4","5"]},"messages":{"in":"注册来源是无效的。"}}},{"id": "usermodel-status", "name": "UserModel[status]", "attribute": "status", "rules": {"in":{"range":["0","1","2","3"]},"messages":{"in":"是否允许登录是无效的。"}}},{"id": "usermodel-shopping_status", "name": "UserModel[shopping_status]", "attribute": "shopping_status", "rules": {"in":{"range":["0","1"]},"messages":{"in":"是否允许购物是无效的。"}}},{"id": "usermodel-comment_status", "name": "UserModel[comment_status]", "attribute": "comment_status", "rules": {"in":{"range":["0","1"]},"messages":{"in":"是否允许评论是无效的。"}}},{"id": "usermodel-type", "name": "UserModel[type]", "attribute": "type", "rules": {"in":{"range":["0","1"]},"messages":{"in":"用户类型是无效的。"}}},{"id": "usermodel-is_seller", "name": "UserModel[is_seller]", "attribute": "is_seller", "rules": {"in":{"range":["0","1"]},"messages":{"in":"是否为卖家是无效的。"}}},{"id": "usermodel-nickname", "name": "UserModel[nickname]", "attribute": "nickname", "rules": {"ajax":{"url":"/user/user/client-validate","model":"YXBwXG1vZHVsZXNcdXNlclxtb2RlbHNcVXNlck1vZGVs","attribute":"nickname","params":[],"scenario":"create"},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},]
</script>
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

            // 初始化时间选择控件
            $('.form_datetime').datetimepicker({
                language: 'zh-CN',
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                minView: 2, // 只选年月日
                forceParse: 0,
                showMeridian: 1,
                format: 'yyyy-mm-dd'
            });
            $('#usermodel-rank_start_time').datetimepicker().on('changeDate', function(ev) {
                $('#usermodel-rank_end_time').datetimepicker('setStartDate', ev.date);
            });
            $('#usermodel-rank_end_time').datetimepicker().on('changeDate', function(ev) {
                $('#usermodel-rank_start_time').datetimepicker('setEndDate', ev.date);
            });

            // 改变用户等级
            $("#usermodel-rank_id").change(function() {
                var text = $("#usermodel-rank_id option:selected").html();
                if (text.endWith("【特殊等级】")) {
                    $(".between").show();
                } else {
                    $(".between").hide();
                }
            });
            String.prototype.endWith = function(endStr) {
                var d = this.length - endStr.length;
                return(d >= 0 && this.lastIndexOf(endStr) == d)
            }
        });
    </script>
    
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop