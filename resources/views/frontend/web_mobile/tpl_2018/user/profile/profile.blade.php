@extends('layouts.user_layout')

{{--header_css--}}
@section('header_css')
    <link rel="stylesheet" href="/css/user.css?v=20180702"/>
@stop

{{--header_js--}}
@section('header_js')

@stop



@section('content')

    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20180813"></script>
    <script src="/js/image_upload/lrz.all.bundle.js?v=20180813"></script>
    <div class="user-info-box">
        <header>
            <div class="header">
                <div class="header-left">
                    <a class="sb-back" href="/user.html" title="返回"></a>
                </div>
                <div class="header-middle">个人设置</div>
                <div class="header-right">
                    <aside class="show-menu-btn">
                        <div class="show-menu" id="show_more">
                            <a href="javascript:void(0);"></a>
                        </div>
                    </aside>
                </div>
            </div>
        </header>
        <dl class="upload-image" style="cursor: pointer;">
            <dt class="user-logo">
                <h3>头像</h3>
                <h5>

                    <img src="{{ get_image_url($user_info->headimg, 'headimg') }}">

                    <i class="iconfont">&#xe607;</i>
                </h5>
            </dt>
        </dl>
        <dl>
            <dt>
                <h3>用户名</h3>
                <h5>{{ $user_info->user_name }}</h5>
            </dt>
        </dl>
        <dl class="nickname_dl">
            <dt>
                <h3>昵称</h3>
                <h5>
                    {{ $user_info->nickname }}
                    <i class="iconfont">&#xe607;</i>
                </h5>
            </dt>
        </dl>
        <dl class="sex_dl">
            <dt>
                <h3>性别</h3>
                <h5>
                    @if($user_info->sex == 0) 保密 @elseif($user_info->sex == 1) 男 @elseif($user_info->sex == 2) 女 @endif				<i class="iconfont">&#xe607;</i>
                </h5>
            </dt>
        </dl>
        <!--        <dl class="birthday_dl">
                <dt>
                    <h3>出生日期</h3>
                    <h5>2010-05-14<i class="iconfont">&#xe607;</i></h5>
                </dt>
            </dl>-->
        <link rel="stylesheet" href="/css/mobiscroll.custom-3.0.0-beta.min.css?v=20180702"/> <script src="/js/mobiscroll.custom-3.0.0-beta.min.js?v=20180813"></script>
        <dl class="birthday_dl" id="showbirth">
            <dt>
                <h3>出生日期</h3>
                <!--1，会员设置了生日，则默认显示生日，格式年/月/日
                        2，会员没有设置过生日，则默认显示：请选择生日
                    -->
                <h5>
                    <input id="birth" value="{{ $user_info->birthday->format('Y-m-d') }}" />
                    <i class="iconfont">&#xe607;</i>
                </h5>
            </dt>
        </dl>
        <dl>
            <a href="/user/address.html">
                <dt>
                    <h3>地址管理</h3>
                    <h5>
                        <i class="iconfont">&#xe607;</i>
                    </h5>
                </dt>
            </a>
        </dl>
        <div class="blank-div"></div>
        <dl>
            <a href="javascript:void(0)" class="edit-real">
                <dt>
                    <h3>实名认证</h3>
                    <h5>
                        <i class="iconfont">&#xe607;</i>
                    </h5>
                </dt>
            </a>
        </dl>
        <dl>
            <a href="/user/security.html">
                <dt>
                    <h3>账号安全</h3>
                    <h5>
                        <i class="iconfont">&#xe607;</i>
                    </h5>
                </dt>
            </a>
        </dl>
        <div class="blank-div"></div>
        <dl>
            <a href="/user/security/edit-password" class="edit-password">
                <dt>
                    <h3>修改密码</h3>
                    <h5>
                        <i class="iconfont">&#xe607;</i>
                    </h5>
                </dt>
            </a>
        </dl>
    </div>
    <form id="UserModel" class="form-horizontal" name="UserModel" action="/user/profile/edit-base" method="post">
        {{ csrf_field() }}
        <div id="user_nickname">
            <header>
                <div class="tab_nav">
                    <div class="header">
                        <div class="header-left">
                            <a class="sb-back" href="/user/profile/index.html" title="返回"></a>
                        </div>
                        <div class="header-middle">修改昵称</div>
                        <div class="header-right">
                            <a href="javascript:void(0)" class="btn-submit text">确定</a>
                        </div>
                    </div>
                </div>
            </header>
            <div class="middle-content">
                <div class="form-group-box"><div class="form-group form-group-spe" >
                        <dl>
                            <dt>
                                <span>昵称：</span>
                            </dt>
                            <dd>
                                <div class="form-control-box">
                                    <input type="text" id="usermodel-nickname" class="form-control" name="UserModel[nickname]" value="{{ $user_info->nickname }}" autocomplete="off" placeholder="输入您的昵称">
                                </div>

                            </dd>
                        </dl>
                    </div>
                    <div class="invalid"><span class="hint">与平台业务或者店铺名称冲突的昵称，平台将有可能收回</span></div></div>
            </div>
        </div>
        <div id="user_sex_box">
            <header>
                <div class="header">
                    <div class="header-left">
                        <a class="sb-back" href="/user/profile/index.html" title="返回"></a>
                    </div>
                    <div class="header-middle">修改性别</div>
                    <div class="header-right">
                        <a href="javascript:void(0)" class="btn-submit text">确定</a>
                    </div>
                </div>
            </header>
            <input type="hidden" id="user_sex" name="UserModel[sex]" value="{{ $user_info->sex }}">
            <ul class="user-sex">
                <li>
                    <span data-sex='0' @if($user_info->sex == 0) class="selected" @endif>保密</span>
                </li>
                <li>
                    <span data-sex='1' @if($user_info->sex == 1) class="selected" @endif>男</span>
                </li>
                <li>
                    <span data-sex='2' @if($user_info->sex == 2) class="selected" @endif>女</span>
                </li>
            </ul>
        </div>
        <!-- 生日 -->
        <input type="hidden" id="birthday" name="UserModel[birthday]" value="{{ strtotime($user_info->birthday) }}">
        <!-- 用户头像 -->
        <input type="hidden" id="headimg" name="UserModel[headimg]" value="{{ $user_info->headimg }}">
    </form>
    <!-- 实名认证 -->
    <div id="user_real_box">

        <form id="UserRealModel" class="form-horizontal" name="UserRealModel" action="/user/profile/edit-real" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <header>
                <div class="header">
                    <div class="header-left">
                        <a class="sb-back" href="/user/profile/index.html" title="返回"></a>
                    </div>
                    <div class="header-middle">实名认证</div>
                    <div class="header-right">
                        <a href="javascript:void(0)" class="text" id="btn_submit_real">确定</a>
                    </div>
                </div>
            </header>

            <div class="operat-tips">您已提交实名认证申请，等待平台方进行审核确认。</div>

            <div class="middle-content">
                <div class="form-group-box">
                    <div class="form-group form-group-spe" >
                        <dl>
                            <dt>
                                <span>真实姓名：</span>
                            </dt>
                            <dd>
                                <div class="form-control-box">


                                    <input type="text" id="userrealmodel-real_name" class="form-control" name="UserRealModel[real_name]" value="{{ $user_real->real_name ?? '' }}" autocomplete="off" placeholder="输入您的真实姓名">


                                </div>

                            </dd>
                        </dl>
                    </div>
                    <div class="invalid"></div>

                    <div class="form-group form-group-spe" >
                        <dl>
                            <dt>
                                <span>身份证号码：</span>
                            </dt>
                            <dd>
                                <div class="form-control-box">


                                    <input type="text" id="userrealmodel-id_code" class="form-control" name="UserRealModel[id_code]" value="{{ $user_real->id_code ?? '' }}" autocomplete="off" placeholder="输入您的身份证号码">


                                </div>

                            </dd>
                        </dl>
                    </div>
                    <div class="invalid"><span class="hint">身份证号码位数为15位或18位</span></div>
                    <!--身份证正面照-->
                    <div class="form-group form-group-spe">
                        <dl>
                            <dt>
                                <span>证件正面：</span>
                            </dt>
                            <dd>
                                <div class="form-control-box">
                                    <div class="img-uploading-list img-uploading">
                                        <span class="img-del "></span>
                                        <div id="facade_img_container" class="image-container">

                                            <img src="@if(isset($user_real->card_pic1)){{ get_image_url($user_real->card_pic1) }}@endif">

                                        </div>
                                        <input type="hidden" id="userrealmodel-card_pic1" class="form-control" name="UserRealModel[card_pic1]" value="{{ $user_real->card_pic1 ?? '' }}">
                                    </div>

                                    <a class="examples-btn" href="javascript:void(0);" data-src="{{ idcard_demo_image(0) }}">示例</a>

                                </div>
                            </dd>
                        </dl>
                    </div>

                    <!--身份证背面照-->
                    <div class="form-group form-group-spe">
                        <dl>
                            <dt>
                                <span>证件背面：</span>
                            </dt>
                            <dd>
                                <div class="form-control-box">
                                    <div class="img-uploading-list img-uploading">
                                        <span class="img-del "></span>
                                        <div id="facade_img_container" class="image-container">

                                            <img src="@if(isset($user_real->card_pic2)){{ get_image_url($user_real->card_pic2) }}@endif">

                                        </div>
                                        <input type="hidden" id="userrealmodel-card_pic2" class="form-control" name="UserRealModel[card_pic2]" value="{{ $user_real->card_pic2 ?? '' }}">
                                    </div>

                                    <a class="examples-btn" href="javascript:void(0);" data-src="{{ idcard_demo_image(1) }}">示例</a>

                                </div>
                            </dd>
                        </dl>

                    </div>
                    <!--本人手持身份证正面照-->
                    <div class="form-group form-group-spe">
                        <dl>
                            <dt>
                                <span>手持证件：</span>
                            </dt>
                            <dd>
                                <div class="form-control-box">
                                    <div class="img-uploading-list img-uploading">
                                        <span class="img-del "></span>
                                        <div id="facade_img_container" class="image-container">

                                            <img src="@if(isset($user_real->card_pic3)){{ get_image_url($user_real->card_pic3) }}@endif">

                                        </div>
                                        <input type="hidden" id="userrealmodel-card_pic3" class="form-control" name="UserRealModel[card_pic3]" value="{{ $user_real->card_pic2 ?? '' }}">
                                    </div>

                                    <a class="examples-btn" href="javascript:void(0);" data-src="{{ idcard_demo_image(2) }}">示例</a>

                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </form>

    </div>

    <div id="datePlugin">
        <div class="mask-div"></div>
    </div>
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180813"></script>
    <script type="text/javascript">
        var step = 0;

        $('.header-left .sb-back').click(function(){
            step = 1;
            $('.user-info-box').show();
            $('#user_nickname').hide();
            $('#user_sex_box').hide();
            $('#user_real_box').hide();

        });

        $('.nickname_dl').click(function(){
            step = 2;
            $('#user_nickname').show();
            $('.user-info-box').hide();
        });
        $('.sex_dl').click(function(){
            step = 3;
            $('#user_sex_box').show();
            $('.user-info-box').hide();
        });
        $('.user-sex li span').click(function(){
            $(this).addClass('selected').parents("li").siblings().find('span').removeClass('selected');
            $("#user_sex").val($(this).data('sex'));
        });


        $('.edit-real').click(function(){
            $('#user_real_box').show();
            $('.user-info-box').hide();
        });

        /*生日选择*/
        $(function () {

            var currYear = new Date().getFullYear();
            //alert(new Date(new Date().setFullYear(currYear - 20)));
            $('#birth').mobiscroll().date({
                theme: 'mobiscroll',
                lang: 'zh',
                display: 'center',
                dateFormat: 'yy-mm-dd', // 日期格式
                //下面这句是默认显示20年前的日期
                //defaultValue: new Date(new Date().setFullYear(currYear - 20)),
                //如果会员设置过生日，则defaultValue设置为他的生日；
                defaultValue: new Date(new Date().setFullYear(currYear)),
                max: new Date(),
                min: new Date('1970-01-02'),
                onSet:function(data){
                    $("#birthday").val(Date.parse(new Date(data.valueText))/1000);
                    $.post("/user/profile/edit-profile-info", {
                        item: 'birthday',
                        value: $("#birthday").val(),
                        title: '出生日期'
                    }, function(result) {
                        if(result.code == 0){
                            $.msg(result.message);
                            window.location.reload();
                        }
                    }, "json");
                }
            });


            $('#showbirth').click(function () {
                $('#birth').mobiscroll('show');
                return false;
            });

            $('#clear').click(function () {
                $('#birth').mobiscroll('clear');
                return false;
            });

        });
    </script>

    <script type="text/javascript">
        $().ready(function() {
            var validator = $("#UserModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules([{"id": "usermodel-nickname", "name": "UserModel[nickname]", "attribute": "nickname", "rules": {"required":true,"messages":{"required":"昵称不能为空。"}}},{"id": "usermodel-user_name", "name": "UserModel[user_name]", "attribute": "user_name", "rules": {"required":true,"messages":{"required":"用户名不能为空。"}}},{"id": "usermodel-user_name", "name": "UserModel[user_name]", "attribute": "user_name", "rules": {"username":{"pattern":/^[a-zA-Z0-9_\u4e00-\u9fa5]{4,20}$/,"not":false,"skipOnEmpty":1},"match":{"pattern":/^\d+$/,"not":true,"skipOnEmpty":1},"messages":{"username":"用户名只能由4-20个字，支持汉字、字母、数字、下划线“_”构成的组合","match":"用户名不能为纯数字"}}},{"id": "usermodel-sex", "name": "UserModel[sex]", "attribute": "sex", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"性别必须是整数。"}}},{"id": "usermodel-birthday", "name": "UserModel[birthday]", "attribute": "birthday", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"出生日期必须是整数。"}}},{"id": "usermodel-rank_point", "name": "UserModel[rank_point]", "attribute": "rank_point", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"成长值必须是整数。"}}},{"id": "usermodel-address_id", "name": "UserModel[address_id]", "attribute": "address_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"默认收货地址必须是整数。"}}},{"id": "usermodel-rank_id", "name": "UserModel[rank_id]", "attribute": "rank_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"用户等级必须是整数。"}}},{"id": "usermodel-mobile_validated", "name": "UserModel[mobile_validated]", "attribute": "mobile_validated", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否已验证手机必须是整数。"}}},{"id": "usermodel-email_validated", "name": "UserModel[email_validated]", "attribute": "email_validated", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否已验证邮箱必须是整数。"}}},{"id": "usermodel-reg_time", "name": "UserModel[reg_time]", "attribute": "reg_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"注册时间必须是整数。"}}},{"id": "usermodel-last_time", "name": "UserModel[last_time]", "attribute": "last_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"最近登录时间必须是整数。"}}},{"id": "usermodel-visit_count", "name": "UserModel[visit_count]", "attribute": "visit_count", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"访问次数必须是整数。"}}},{"id": "usermodel-status", "name": "UserModel[status]", "attribute": "status", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"用户状态必须是整数。"}}},{"id": "usermodel-type", "name": "UserModel[type]", "attribute": "type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"用户类型必须是整数。"}}},{"id": "usermodel-is_seller", "name": "UserModel[is_seller]", "attribute": "is_seller", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否为卖家必须是整数。"}}},{"id": "usermodel-is_real", "name": "UserModel[is_real]", "attribute": "is_real", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否通过实名认证必须是整数。"}}},{"id": "usermodel-shopping_status", "name": "UserModel[shopping_status]", "attribute": "shopping_status", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否允许购物必须是整数。"}}},{"id": "usermodel-comment_status", "name": "UserModel[comment_status]", "attribute": "comment_status", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否允许评论必须是整数。"}}},{"id": "usermodel-user_money", "name": "UserModel[user_money]", "attribute": "user_money", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"可提现余额必须是一个数字。"}}},{"id": "usermodel-user_money_limit", "name": "UserModel[user_money_limit]", "attribute": "user_money_limit", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"不可提现余额必须是一个数字。"}}},{"id": "usermodel-frozen_money", "name": "UserModel[frozen_money]", "attribute": "frozen_money", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"冻结金额必须是一个数字。"}}},{"id": "usermodel-email", "name": "UserModel[email]", "attribute": "email", "rules": {"string":true,"messages":{"string":"邮箱地址必须是一条字符串。","maxlength":"邮箱地址只能包含至多60个字符。"},"maxlength":60}},{"id": "usermodel-address_now", "name": "UserModel[address_now]", "attribute": "address_now", "rules": {"string":true,"messages":{"string":"现居住地址必须是一条字符串。","maxlength":"现居住地址只能包含至多60个字符。"},"maxlength":60}},{"id": "usermodel-user_name", "name": "UserModel[user_name]", "attribute": "user_name", "rules": {"string":true,"messages":{"string":"用户名必须是一条字符串。","minlength":"用户名应该包含至少4个字符。","maxlength":"用户名只能包含至多20个字符。"},"minlength":4,"maxlength":20}},{"id": "usermodel-nickname", "name": "UserModel[nickname]", "attribute": "nickname", "rules": {"string":true,"messages":{"string":"昵称必须是一条字符串。","minlength":"昵称应该包含至少1个字。","maxlength":"昵称只能包含至多20个字符。"},"minlength":1,"maxlength":20}},{"id": "usermodel-nickname", "name": "UserModel[nickname]", "attribute": "nickname", "rules": {"ajax":{"url":"/user/profile/client-validate","model":"YXBwXG1vZHVsZXNcdXNlclxtb2RlbHNcVXNlck1vZGVs","attribute":"nickname","params":[]},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},{"id": "usermodel-password", "name": "UserModel[password]", "attribute": "password", "rules": {"password":{"pattern":/^[^\u4e00-\u9fa5\·]{6,20}$/,"not":false,"skipOnEmpty":1},"match":{"pattern":/\s+/,"not":true,"skipOnEmpty":1},"messages":{"password":"登录密码长度为6-20个字符，建议由字母、数字和符号两种以上。","match":"登录密码不能包含空格。"}}},{"id": "usermodel-password", "name": "UserModel[password]", "attribute": "password", "rules": {"string":true,"messages":{"string":"登录密码必须是一条字符串。","minlength":"登录密码应该包含至少6个字符。","maxlength":"登录密码只能包含至多20个字符。"},"minlength":6,"maxlength":20}},{"id": "usermodel-surplus_password", "name": "UserModel[surplus_password]", "attribute": "surplus_password", "rules": {"string":true,"messages":{"string":"余额支付密码必须是一条字符串。","minlength":"余额支付密码应该包含至少6个字符。","maxlength":"余额支付密码只能包含至多20个字符。"},"minlength":6,"maxlength":20}},{"id": "usermodel-password_reset_token", "name": "UserModel[password_reset_token]", "attribute": "password_reset_token", "rules": {"string":true,"messages":{"string":"重置密码令牌必须是一条字符串。","maxlength":"重置密码令牌只能包含至多255个字符。"},"maxlength":255}},{"id": "usermodel-detail_address", "name": "UserModel[detail_address]", "attribute": "detail_address", "rules": {"string":true,"messages":{"string":"详细地址必须是一条字符串。","maxlength":"详细地址只能包含至多255个字符。"},"maxlength":255}},{"id": "usermodel-headimg", "name": "UserModel[headimg]", "attribute": "headimg", "rules": {"string":true,"messages":{"string":"头像必须是一条字符串。","maxlength":"头像只能包含至多255个字符。"},"maxlength":255}},{"id": "usermodel-auth_key", "name": "UserModel[auth_key]", "attribute": "auth_key", "rules": {"string":true,"messages":{"string":"授权码必须是一条字符串。","maxlength":"授权码只能包含至多255个字符。"},"maxlength":255}},{"id": "usermodel-user_remark", "name": "UserModel[user_remark]", "attribute": "user_remark", "rules": {"string":true,"messages":{"string":"会员备注必须是一条字符串。","maxlength":"会员备注只能包含至多255个字符。"},"maxlength":255}},{"id": "usermodel-salt", "name": "UserModel[salt]", "attribute": "salt", "rules": {"string":true,"messages":{"string":"混淆码必须是一条字符串。","maxlength":"混淆码只能包含至多10个字符。"},"maxlength":10}},{"id": "usermodel-reg_ip", "name": "UserModel[reg_ip]", "attribute": "reg_ip", "rules": {"string":true,"messages":{"string":"注册IP地址必须是一条字符串。","maxlength":"注册IP地址只能包含至多40个字符。"},"maxlength":40}},{"id": "usermodel-last_ip", "name": "UserModel[last_ip]", "attribute": "last_ip", "rules": {"string":true,"messages":{"string":"最近登录IP地址必须是一条字符串。","maxlength":"最近登录IP地址只能包含至多40个字符。"},"maxlength":40}},{"id": "usermodel-pay_point", "name": "UserModel[pay_point]", "attribute": "pay_point", "rules": {"string":true,"messages":{"string":"消费积分必须是一条字符串。"}}},{"id": "usermodel-mobile", "name": "UserModel[mobile]", "attribute": "mobile", "rules": {"match":{"pattern":/^((13|15|18|17|14)\d{9}|(199|198|166)\d{8})$/,"not":false,"skipOnEmpty":1},"messages":{"match":"手机号码是无效的。"}}},{"id": "usermodel-email", "name": "UserModel[email]", "attribute": "email", "rules": {"email":{"pattern":/^[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/,"fullPattern":/^[^@]*<[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?>$/,"allowName":false,"enableIDN":false,"skipOnEmpty":1},"messages":{"email":"邮箱地址不是有效的邮箱地址。"}}},{"id": "usermodel-user_name", "name": "UserModel[user_name]", "attribute": "user_name", "rules": {"ajax":{"url":"/user/profile/client-validate","model":"YXBwXG1vZHVsZXNcdXNlclxtb2RlbHNcVXNlck1vZGVs","attribute":"user_name","params":["UserModel[user_id]"]},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},{"id": "usermodel-mobile", "name": "UserModel[mobile]", "attribute": "mobile", "rules": {"ajax":{"url":"/user/profile/client-validate","model":"YXBwXG1vZHVsZXNcdXNlclxtb2RlbHNcVXNlck1vZGVs","attribute":"mobile","params":["UserModel[user_id]"]},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},{"id": "usermodel-email", "name": "UserModel[email]", "attribute": "email", "rules": {"ajax":{"url":"/user/profile/client-validate","model":"YXBwXG1vZHVsZXNcdXNlclxtb2RlbHNcVXNlck1vZGVs","attribute":"email","params":["UserModel[user_id]"]},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},{"id": "usermodel-sex", "name": "UserModel[sex]", "attribute": "sex", "rules": {"in":{"range":["0","1","2"]},"messages":{"in":"性别是无效的。"}}},{"id": "usermodel-reg_from", "name": "UserModel[reg_from]", "attribute": "reg_from", "rules": {"in":{"range":["0","1","2","3","4","5"]},"messages":{"in":"注册来源是无效的。"}}},{"id": "usermodel-status", "name": "UserModel[status]", "attribute": "status", "rules": {"in":{"range":["0","1","2","3"]},"messages":{"in":"用户状态是无效的。"}}},{"id": "usermodel-shopping_status", "name": "UserModel[shopping_status]", "attribute": "shopping_status", "rules": {"in":{"range":["0","1"]},"messages":{"in":"是否允许购物是无效的。"}}},{"id": "usermodel-comment_status", "name": "UserModel[comment_status]", "attribute": "comment_status", "rules": {"in":{"range":["0","1"]},"messages":{"in":"是否允许评论是无效的。"}}},{"id": "usermodel-type", "name": "UserModel[type]", "attribute": "type", "rules": {"in":{"range":["0","1"]},"messages":{"in":"用户类型是无效的。"}}},{"id": "usermodel-is_seller", "name": "UserModel[is_seller]", "attribute": "is_seller", "rules": {"in":{"range":["0","1"]},"messages":{"in":"是否为卖家是无效的。"}}},{"id": "usermodel-is_real", "name": "UserModel[is_real]", "attribute": "is_real", "rules": {"in":{"range":["0","1","2"]},"messages":{"in":"是否通过实名认证是无效的。"}}},]);

            var validator_real = $("#UserRealModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules([{"id": "userrealmodel-real_name", "name": "UserRealModel[real_name]", "attribute": "real_name", "rules": {"required":true,"messages":{"required":"真实姓名不能为空。"}}},{"id": "userrealmodel-id_code", "name": "UserRealModel[id_code]", "attribute": "id_code", "rules": {"required":true,"messages":{"required":"身份证号码不能为空。"}}},{"id": "userrealmodel-user_id", "name": "UserRealModel[user_id]", "attribute": "user_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"用户基本信息ID必须是整数。"}}},{"id": "userrealmodel-status", "name": "UserRealModel[status]", "attribute": "status", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否通过实名认证必须是整数。"}}},{"id": "userrealmodel-add_time", "name": "UserRealModel[add_time]", "attribute": "add_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Add Time必须是整数。"}}},{"id": "userrealmodel-real_name", "name": "UserRealModel[real_name]", "attribute": "real_name", "rules": {"string":true,"messages":{"string":"真实姓名必须是一条字符串。","maxlength":"真实姓名只能包含至多60个字符。"},"maxlength":60}},{"id": "userrealmodel-address_now", "name": "UserRealModel[address_now]", "attribute": "address_now", "rules": {"string":true,"messages":{"string":"现居住地址必须是一条字符串。","maxlength":"现居住地址只能包含至多60个字符。"},"maxlength":60}},{"id": "userrealmodel-id_code", "name": "UserRealModel[id_code]", "attribute": "id_code", "rules": {"string":true,"messages":{"string":"身份证号码必须是一条字符串。","maxlength":"身份证号码只能包含至多18个字符。"},"maxlength":18}},{"id": "userrealmodel-id_code", "name": "UserRealModel[id_code]", "attribute": "id_code", "rules": {"match":{"pattern":/^[0-9]{14}[X|x]$|[0-9]{17}[X|x]$|[0-9]{18}$/,"not":false,"skipOnEmpty":1},"messages":{"match":"身份证号码是无效的。"}}},{"id": "userrealmodel-status", "name": "UserRealModel[status]", "attribute": "status", "rules": {"in":{"range":["0","1","2"]},"messages":{"in":"是否通过实名认证是无效的。"}}},]);
            $('body').on('click','.btn-submit',function(){
                var item,value,title;
                switch(step)
                {
                    case 2:
                        item = 'nickname';
                        value = $("#usermodel-nickname").val();
                        title = '昵称';
                        if (!$("#usermodel-nickname").valid()) {
                            $("#usermodel-nickname").focus();
                            return;
                        }
                        break;
                    case 3:
                        item = 'sex';
                        value = $("#user_sex").val();
                        title = '性别';
                        if (!$("#user_sex").valid()) {
                            $("#user_sex").focus();
                            return;
                        }
                        break;
                    default:
                        if (!validator.form()) {
                            return;
                        }
                }
                //加载提示
                $.post("/user/profile/edit-profile-info", {
                    item: item,
                    value: value,
                    title: title
                }, function(result) {
                    if(result.code == 0){
                        $.msg(result.message);
                        window.location.reload();
                    }
                }, "json");
                return false;
            });

            $("body").on('click', '.upload-image', function() {
                $.localResizeIMG({
                    callback: function(image) {
                        $.post("/user/profile/edit-profile-info", {
                            item: 'headimg',
                            value: image.data.path,
                            title: '头像'
                        }, function(result) {
                            if(result.code == 0){
                                $.msg(result.message);
                                window.location.reload();
                            }
                        }, "json");

                    }
                });
            });

            //图片上传
            $('.image-container').click(function() {
                var obj = $(this);
                if (obj.find('img').length > 0) {
                    return;
                }
                $.localResizeIMG({
                    callback: function(image) {
                        obj.html('<img src="'+image.data.url+'"/>');
                        obj.parent().find('.img-del').show();
                        obj.parent().find('input').val(image.data.path);
                        obj.parent().find('input').valid();
                    }
                });
            });

            $('body').on('click', '.img-del', function() {
                $(this).parent().find('.image-container').html('<h4><i class="iconfont">&#xe635;</i></h4><p>上传图片</p>');
                $(this).parent().find('input').val('');
                $(this).hide();
            });

            $("#btn_submit_real").click(function() {
                if (!validator_real.form()) {
                    return;
                }
                //加载提示
                $.loading.start();
                $("#UserRealModel").submit();
            });

            $("input:text").watch();
        });
    </script>


    <!--图像弹出层-->
    <div class="examples-pic-con">
        <a class="close-examples-pic"></a>
        <h3>图片示例</h3>
        <img src="">
    </div>
    <script type="text/javascript">
        $('.examples-btn').click(function() {
            var src = $(this).data('src');
            $('.mask-div').show();
            $('.examples-pic-con').find('img').attr('src', src);
            $('.examples-pic-con').show();
        });
        $('.close-examples-pic').click(function() {
            $('.mask-div').hide();
            $('.examples-pic-con').hide();
        });
    </script>
    <script type="text/javascript">
        $().ready(function() {

            /*弹出消息*/
            @if(!empty(session('layerMsg')))
            var status = '{{ session()->get('layerMsg.status') }}';
            var msg = '{{ session()->get('layerMsg.msg') }}';
            switch (status) {
                case 'success':
                    $.msg(msg);
                    break;
                case 'error':
                    $.msg(msg, function () {
                        // 关闭后的操作
                    });
                    break;
                case 'info':
                    $.msg(msg)
                    break;
                case 'warning':
                    $.msg(msg, function () {
                        // 关闭后的操作
                    });
                    break;
            }
            // $.msg('设置成功');
            @endif
        })
    </script>
    <script src="/js/jquery.fly.min.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js?v=20180813"></script>

    <div class="show-menu-info" id="menu">
        <ul>
            <li><a href="/"><span class="index-menu"></span><i>商城首页</i></a></li>
            <li><a href="/category.html"><span class="category-menu"></span><i>分类</i></a></li>
            <li><a href="/cart.html"><span class="cart-menu"></span><i>购物车</i></a></li>
            <li style=" border:0;"><a href="/user.html"><span class="user-menu"></span><i>我的</i></a></li>
        </ul>
    </div>
    <!-- 第三方流量统计 -->
    <div style="display: none;"></div>
    <!-- 底部 _end-->

@stop