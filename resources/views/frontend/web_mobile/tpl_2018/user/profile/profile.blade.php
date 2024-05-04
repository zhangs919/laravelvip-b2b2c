@extends('layouts.user_layout')


{{--header_css--}}
@section('header_css')
    <link href="/css/mobiscroll/mobiscroll.core-2.5.2.css" rel="stylesheet">
    <link href="/css/mobiscroll/mobiscroll.animation-2.5.2.css" rel="stylesheet">
    <link href="/css/mobiscroll/mobiscroll.android-ics-2.5.2.css" rel="stylesheet">
@stop


@section('content')

    <div class="user-info-box">
        <header class="header-top-nav">
            <div class="header">
                <div class="header-left">
                    <a class="sb-back" href="javascript:history.back(-1);" title="返回">
                        <i class="iconfont">&#xe606;</i>
                    </a>
                </div>
                <div class="header-middle">个人设置</div>
                <div class="header-right">
                    <!-- 控制展示更多按钮 -->
                    <aside class="show-menu-btn">
                        <div class="show-menu" id="show_more">
                            <a href="javascript:void(0);">
                                <i class="iconfont">&#xe6cd;</i>
                            </a>
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
                    <span>
                        @if($user_info->sex == 0) 保密 @elseif($user_info->sex == 1) 男 @elseif($user_info->sex == 2) 女 @endif
                    </span>
                    <i class="iconfont">&#xe607;</i>
                </h5>
            </dt>
        </dl>
        <dl class="birthday_dl" id="showbirth">
            <dt>
                <h3>出生日期</h3>
                <!--1，会员设置了生日，则默认显示生日，格式年/月/日
                        2，会员没有设置过生日，则默认显示：请选择生日
                    -->
                <h5>
                    <input id="birth" value="{{ $user_info->birthday ?? '' }}" disabled="" />
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
            <a href="/user/security/edit-password.html" class="edit-password">
                <dt>
                    <h3>修改密码</h3>
                    <h5>
                        <i class="iconfont">&#xe607;</i>
                    </h5>
                </dt>
            </a>
        </dl>
        <dl>
            <a href="javascript:void(0)" class="cancel-user">
                <dt>
                    <h3>注销账户</h3>
                    <h5>
                        <i class="iconfont"></i>
                    </h5>
                </dt>
            </a>
        </dl>
    </div>
    <!-- 上传头像组件 -->
    <div id="headimg_upload_container" style="display: none">
        <div class="header cropper-header">
            <div class="header-left">
                <a class="sb-back" href="javascript:void(0)" title="返回">
                    <i class="iconfont">&#xe606;</i>
                </a>
            </div>
            <div class="header-middle">头像</div>
            <div class="header-right">
                <a id="headimg_file_btn" class="clip-btn bg-color" href="javascript:void(0)">使用</a>
            </div>
        </div>
        <div class="cropper-modal"></div>
        <div class="cropper-crop-box">
            <div id="headimg_file_area"></div>
            <input id="headimg_file" type="file" accept="image/*" multiple style="display: none" />
            <div id="headimg_view"></div>
        </div>
    </div>
    <form id="UserModel" class="form-horizontal" name="UserModel" action="/user/profile/edit-base" method="post">
        @csrf
        <div id="user_nickname">
            <header>
                <div class="tab_nav">
                    <div class="header">
                        <div class="header-left">
                            <a class="sb-back" href="javascript:void(0)" title="返回">
                                <i class="iconfont">&#xe606;</i>
                            </a>
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
            <div class="header">
                <div class="header-left">
                    <a class="sb-back" href="javascript:void(0)" title="返回">
                        <i class="iconfont">&#xe606;</i>
                    </a>
                </div>
                <div class="header-middle">修改性别</div>
                <div class="header-right">
                    <a href="javascript:void(0)" class="btn-submit text">确定</a>
                </div>
            </div>
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
            @csrf
            <header>
                <div class="header">
                    <div class="header-left">
                        <a class="sb-back" href="/user/profile.html" title="返回">
                            <i class="iconfont">&#xe606;</i>
                        </a>
                    </div>
                    <div class="header-middle">实名认证</div>
                    <div class="header-right">
                        <a href="javascript:void(0)" class="text" id="btn_submit_real">确定</a>
                    </div>
                </div>
            </header>

            <div class="operat-tips">您已提交实名认证申请，等待平台方进行审核确认。</div>

            <div class="middle-content">
                <div class="form-group-box certification-uploading">
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
                                    <div class="img-uploading-list @if(!empty($user_real->card_pic1)){{ 'img-uploading' }}@endif">
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
                                    <div class="img-uploading-list @if(isset($user_real->card_pic2)){{ get_image_url($user_real->card_pic2) }}@endif">
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
                                    <div class="img-uploading-list @if(isset($user_real->card_pic3)){{ get_image_url($user_real->card_pic3) }}@endif">
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
    <!-- 引入mobiscroll插件 -->
    <!-- S 可根据自己喜好引入样式风格文件 -->
    <!-- E 可根据自己喜好引入样式风格文件 -->
    <script type="text/javascript">
        //
    </script>
    <script type="text/javascript">
        //
    </script>
    <script type="text/javascript">
        //
    </script>
    <!--图像弹出层-->
    <div class="examples-pic-con">
        <a class="close-examples-pic"></a>
        <h3>图片示例</h3>
        <img src="">
    </div>
    <script type="text/javascript">
        //
    </script>
    {{--引入右上角菜单--}}
    @include('layouts.partials.right_top_menu')

    <!-- 积分消息 -->
    <!-- 消息提醒 -->
    <script type="text/javascript">
        //
    </script>    <!-- 第三方流量统计 -->
    <div style="display: none;"></div>
    <!-- 底部 _end-->
    {{--引入版权信息--}}
{{--    @include('frontend.web_mobile.modules.library.copy_right')--}}

    <script type="text/javascript">
        //
    </script>
    <div style="height: 54px; line-height: 54px" class="handle-spacing"></div>
    <script src="/assets/d2eace91/min/js/core.min.js"></script>
    <script src="/js/app.frontend.mobile.min.js"></script>
    <script src="/js/user.js"></script>
    <script src="/js/address.js"></script>
    <script src="/js/center.js"></script>
    <script src="/js/jquery.fly.min.js"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js"></script>
    <script src="/js/image_upload/lrz.all.bundle.js"></script>
    <script src="/js/mobiscroll/mobiscroll.core-2.5.2.js"></script>
    <script src="/js/mobiscroll/mobiscroll.core-2.5.2-zh.js"></script>
    <script src="/js/mobiscroll/mobiscroll.datetime-2.5.1.js"></script>
    <script src="/js/mobiscroll/mobiscroll.datetime-2.5.1-zh.js"></script>
    <script src="/js/photoclip/hammer.min.js"></script>
    <script src="/js/photoclip/iscroll-zoom-min.js"></script>
    <script src="/js/photoclip/lrz.all.bundle.js"></script>
    <script src="/js/photoclip/PhotoClip.js"></script>
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js"></script>
    <script src="/assets/d2eace91/min/js/validate.min.js"></script>
    <script src="/assets/d2eace91/min/js/message.min.js"></script>
    <script>
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
            $('#birth').mobiscroll().date({
                theme: 'android-ics light',
                lang: 'zh',
                mode: 'scroller', //日期选择模式
                display: 'bottom',
                dateFormat: 'yy-mm-dd', // 日期格式
                preset: 'data', //日期类型--datatime --time,
                showNow: true,
                nowText: "今天",  //
                startYear: (new Date()).getFullYear()-50, //开始年份
                endYear: (new Date()).getFullYear(), //结束年份
                onSelect(valueText, inst){
                    $("#birthday").val(Date.parse(new Date(valueText))/1000);
                    $.post("/user/profile/edit-profile-info", {
                        item: 'birthday',
                        value: $("#birthday").val(),
                        title: '出生日期'
                    }, function(result) {
                        if(result.code == 0){
                            $.msg(result.message,{
                                icon_type: 1
                            });
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
        //
        $().ready(function() {
            var validator = $("#UserModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules([{"id": "usermodel-nickname", "name": "UserModel[nickname]", "attribute": "nickname", "rules": {"required":true,"messages":{"required":"昵称不能为空。"}}},{"id": "usermodel-user_name", "name": "UserModel[user_name]", "attribute": "user_name", "rules": {"required":true,"messages":{"required":"用户名不能为空。"}}},{"id": "usermodel-user_name", "name": "UserModel[user_name]", "attribute": "user_name", "rules": {"username":{"pattern":/^[a-zA-Z0-9_\u4e00-\u9fa5]{1,20}$/,"not":false,"skipOnEmpty":1},"match":{"pattern":/^\d+$/,"not":true,"skipOnEmpty":1},"messages":{"username":"用户名只能由1-20个字，支持汉字、字母、数字、下划线“_”构成的组合","match":"用户名不能为纯数字"}}},{"id": "usermodel-sex", "name": "UserModel[sex]", "attribute": "sex", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"性别必须是整数。"}}},{"id": "usermodel-birthday", "name": "UserModel[birthday]", "attribute": "birthday", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"出生日期必须是整数。"}}},{"id": "usermodel-rank_point", "name": "UserModel[rank_point]", "attribute": "rank_point", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"成长值必须是整数。"}}},{"id": "usermodel-address_id", "name": "UserModel[address_id]", "attribute": "address_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"默认收货地址必须是整数。"}}},{"id": "usermodel-rank_id", "name": "UserModel[rank_id]", "attribute": "rank_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"用户等级必须是整数。"}}},{"id": "usermodel-mobile_validated", "name": "UserModel[mobile_validated]", "attribute": "mobile_validated", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否已验证手机必须是整数。"}}},{"id": "usermodel-email_validated", "name": "UserModel[email_validated]", "attribute": "email_validated", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否已验证邮箱必须是整数。"}}},{"id": "usermodel-reg_time", "name": "UserModel[reg_time]", "attribute": "reg_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"注册时间必须是整数。"}}},{"id": "usermodel-last_time", "name": "UserModel[last_time]", "attribute": "last_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"最近登录时间必须是整数。"}}},{"id": "usermodel-visit_count", "name": "UserModel[visit_count]", "attribute": "visit_count", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"访问次数必须是整数。"}}},{"id": "usermodel-status", "name": "UserModel[status]", "attribute": "status", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"用户状态必须是整数。"}}},{"id": "usermodel-type", "name": "UserModel[type]", "attribute": "type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"用户类型必须是整数。"}}},{"id": "usermodel-is_seller", "name": "UserModel[is_seller]", "attribute": "is_seller", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否为卖家必须是整数。"}}},{"id": "usermodel-is_real", "name": "UserModel[is_real]", "attribute": "is_real", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否通过实名认证必须是整数。"}}},{"id": "usermodel-shopping_status", "name": "UserModel[shopping_status]", "attribute": "shopping_status", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否允许购物必须是整数。"}}},{"id": "usermodel-comment_status", "name": "UserModel[comment_status]", "attribute": "comment_status", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否允许评论必须是整数。"}}},{"id": "usermodel-user_money", "name": "UserModel[user_money]", "attribute": "user_money", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"可提现余额必须是一个数字。"}}},{"id": "usermodel-user_money_limit", "name": "UserModel[user_money_limit]", "attribute": "user_money_limit", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"不可提现余额必须是一个数字。"}}},{"id": "usermodel-frozen_money", "name": "UserModel[frozen_money]", "attribute": "frozen_money", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"冻结金额必须是一个数字。"}}},{"id": "usermodel-email", "name": "UserModel[email]", "attribute": "email", "rules": {"string":true,"messages":{"string":"邮箱地址必须是一条字符串。","maxlength":"邮箱地址只能包含至多60个字符。"},"maxlength":60}},{"id": "usermodel-address_now", "name": "UserModel[address_now]", "attribute": "address_now", "rules": {"string":true,"messages":{"string":"现居住地址必须是一条字符串。","maxlength":"现居住地址只能包含至多60个字符。"},"maxlength":60}},{"id": "usermodel-user_name", "name": "UserModel[user_name]", "attribute": "user_name", "rules": {"string":true,"messages":{"string":"用户名必须是一条字符串。","minlength":"用户名应该包含至少1个字符。","maxlength":"用户名只能包含至多20个字符。"},"minlength":1,"maxlength":20}},{"id": "usermodel-nickname", "name": "UserModel[nickname]", "attribute": "nickname", "rules": {"string":true,"messages":{"string":"昵称必须是一条字符串。","minlength":"昵称应该包含至少1个字。","maxlength":"昵称只能包含至多20个字符。"},"minlength":1,"maxlength":20}},{"id": "usermodel-password", "name": "UserModel[password]", "attribute": "password", "rules": {"password":{"pattern":/^[^\u4e00-\u9fa5\·]{6,20}$/,"not":false,"skipOnEmpty":1},"match":{"pattern":/\s+/,"not":true,"skipOnEmpty":1},"messages":{"password":"登录密码长度为6-20个字符，建议由字母、数字和符号两种以上。","match":"登录密码不能包含空格。"}}},{"id": "usermodel-password", "name": "UserModel[password]", "attribute": "password", "rules": {"string":true,"messages":{"string":"登录密码必须是一条字符串。","minlength":"登录密码应该包含至少6个字符。","maxlength":"登录密码只能包含至多20个字符。"},"minlength":6,"maxlength":20}},{"id": "usermodel-surplus_password", "name": "UserModel[surplus_password]", "attribute": "surplus_password", "rules": {"string":true,"messages":{"string":"余额支付密码必须是一条字符串。","minlength":"余额支付密码应该包含至少6个字符。","maxlength":"余额支付密码只能包含至多20个字符。"},"minlength":6,"maxlength":20}},{"id": "usermodel-password_reset_token", "name": "UserModel[password_reset_token]", "attribute": "password_reset_token", "rules": {"string":true,"messages":{"string":"重置密码令牌必须是一条字符串。","maxlength":"重置密码令牌只能包含至多255个字符。"},"maxlength":255}},{"id": "usermodel-detail_address", "name": "UserModel[detail_address]", "attribute": "detail_address", "rules": {"string":true,"messages":{"string":"详细地址必须是一条字符串。","maxlength":"详细地址只能包含至多255个字符。"},"maxlength":255}},{"id": "usermodel-headimg", "name": "UserModel[headimg]", "attribute": "headimg", "rules": {"string":true,"messages":{"string":"头像必须是一条字符串。","maxlength":"头像只能包含至多255个字符。"},"maxlength":255}},{"id": "usermodel-auth_key", "name": "UserModel[auth_key]", "attribute": "auth_key", "rules": {"string":true,"messages":{"string":"授权码必须是一条字符串。","maxlength":"授权码只能包含至多255个字符。"},"maxlength":255}},{"id": "usermodel-user_remark", "name": "UserModel[user_remark]", "attribute": "user_remark", "rules": {"string":true,"messages":{"string":"会员备注必须是一条字符串。","maxlength":"会员备注只能包含至多255个字符。"},"maxlength":255}},{"id": "usermodel-salt", "name": "UserModel[salt]", "attribute": "salt", "rules": {"string":true,"messages":{"string":"混淆码必须是一条字符串。","maxlength":"混淆码只能包含至多10个字符。"},"maxlength":10}},{"id": "usermodel-reg_ip", "name": "UserModel[reg_ip]", "attribute": "reg_ip", "rules": {"string":true,"messages":{"string":"注册IP地址必须是一条字符串。","maxlength":"注册IP地址只能包含至多40个字符。"},"maxlength":40}},{"id": "usermodel-last_ip", "name": "UserModel[last_ip]", "attribute": "last_ip", "rules": {"string":true,"messages":{"string":"最近登录IP地址必须是一条字符串。","maxlength":"最近登录IP地址只能包含至多40个字符。"},"maxlength":40}},{"id": "usermodel-pay_point", "name": "UserModel[pay_point]", "attribute": "pay_point", "rules": {"string":true,"messages":{"string":"消费积分必须是一条字符串。"}}},{"id": "usermodel-mobile", "name": "UserModel[mobile]", "attribute": "mobile", "rules": {"match":{"pattern":/^((13|15|18|17|14)\d{9}|(199|198|166|191|167)\d{8})$/,"not":false,"skipOnEmpty":1},"messages":{"match":"手机号码是无效的。"}}},{"id": "usermodel-email", "name": "UserModel[email]", "attribute": "email", "rules": {"email":{"pattern":/^[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/,"fullPattern":/^[^@]*<[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?>$/,"allowName":false,"enableIDN":false,"skipOnEmpty":1},"messages":{"email":"邮箱地址不是有效的邮箱地址。"}}},{"id": "usermodel-user_name", "name": "UserModel[user_name]", "attribute": "user_name", "rules": {"ajax":{"url":"/user/profile/client-validate","model":"YXBwXG1vZHVsZXNcdXNlclxtb2RlbHNcVXNlck1vZGVs","attribute":"user_name","params":["UserModel[user_id]"]},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},{"id": "usermodel-mobile", "name": "UserModel[mobile]", "attribute": "mobile", "rules": {"ajax":{"url":"/user/profile/client-validate","model":"YXBwXG1vZHVsZXNcdXNlclxtb2RlbHNcVXNlck1vZGVs","attribute":"mobile","params":["UserModel[user_id]"]},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},{"id": "usermodel-email", "name": "UserModel[email]", "attribute": "email", "rules": {"ajax":{"url":"/user/profile/client-validate","model":"YXBwXG1vZHVsZXNcdXNlclxtb2RlbHNcVXNlck1vZGVs","attribute":"email","params":["UserModel[user_id]"]},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},{"id": "usermodel-sex", "name": "UserModel[sex]", "attribute": "sex", "rules": {"in":{"range":["0","1","2"]},"messages":{"in":"性别是无效的。"}}},{"id": "usermodel-reg_from", "name": "UserModel[reg_from]", "attribute": "reg_from", "rules": {"in":{"range":["0","1","2","3","4","5","6","7","8"]},"messages":{"in":"注册来源是无效的。"}}},{"id": "usermodel-status", "name": "UserModel[status]", "attribute": "status", "rules": {"in":{"range":["0","1","2","3"]},"messages":{"in":"用户状态是无效的。"}}},{"id": "usermodel-shopping_status", "name": "UserModel[shopping_status]", "attribute": "shopping_status", "rules": {"in":{"range":["0","1"]},"messages":{"in":"是否允许购物是无效的。"}}},{"id": "usermodel-comment_status", "name": "UserModel[comment_status]", "attribute": "comment_status", "rules": {"in":{"range":["0","1"]},"messages":{"in":"是否允许评论是无效的。"}}},{"id": "usermodel-type", "name": "UserModel[type]", "attribute": "type", "rules": {"in":{"range":["0","1"]},"messages":{"in":"用户类型是无效的。"}}},{"id": "usermodel-is_seller", "name": "UserModel[is_seller]", "attribute": "is_seller", "rules": {"in":{"range":["0","1"]},"messages":{"in":"是否为卖家是无效的。"}}},{"id": "usermodel-is_real", "name": "UserModel[is_real]", "attribute": "is_real", "rules": {"in":{"range":["0","1","2"]},"messages":{"in":"是否通过实名认证是无效的。"}}},{"id": "usermodel-user_name", "name": "UserModel[user_name]", "attribute": "user_name", "rules": {"string":true,"messages":{"string":"用户名必须是一条字符串。","match":"用户名中含有非法字符"},"match":{"pattern":/<|>|<script|<img|<svg|alert|prompt|cookie|@eval|@ini_set|@set_time_limit|\$_SERVER|@set_magic_quotes_runtime/,"not":true}}},{"id": "usermodel-nickname", "name": "UserModel[nickname]", "attribute": "nickname", "rules": {"string":true,"messages":{"string":"昵称必须是一条字符串。","match":"昵称中含有非法字符"},"match":{"pattern":/<|>|<script|<img|<svg|alert|prompt|cookie|@eval|@ini_set|@set_time_limit|\$_SERVER|@set_magic_quotes_runtime/,"not":true}}},{"id": "usermodel-detail_address", "name": "UserModel[detail_address]", "attribute": "detail_address", "rules": {"string":true,"messages":{"string":"详细地址必须是一条字符串。","match":"详细地址中含有非法字符"},"match":{"pattern":/<|>|<script|<img|<svg|alert|prompt|cookie|@eval|@ini_set|@set_time_limit|\$_SERVER|@set_magic_quotes_runtime/,"not":true}}},{"id": "usermodel-company_name", "name": "UserModel[company_name]", "attribute": "company_name", "rules": {"string":true,"messages":{"string":"Company Name必须是一条字符串。","match":"Company Name中含有非法字符"},"match":{"pattern":/<|>|<script|<img|<svg|alert|prompt|cookie|@eval|@ini_set|@set_time_limit|\$_SERVER|@set_magic_quotes_runtime/,"not":true}}},{"id": "usermodel-company_address", "name": "UserModel[company_address]", "attribute": "company_address", "rules": {"string":true,"messages":{"string":"Company Address必须是一条字符串。","match":"Company Address中含有非法字符"},"match":{"pattern":/<|>|<script|<img|<svg|alert|prompt|cookie|@eval|@ini_set|@set_time_limit|\$_SERVER|@set_magic_quotes_runtime/,"not":true}}},{"id": "usermodel-purpose_type", "name": "UserModel[purpose_type]", "attribute": "purpose_type", "rules": {"string":true,"messages":{"string":"Purpose Type必须是一条字符串。","match":"Purpose Type中含有非法字符"},"match":{"pattern":/<|>|<script|<img|<svg|alert|prompt|cookie|@eval|@ini_set|@set_time_limit|\$_SERVER|@set_magic_quotes_runtime/,"not":true}}},{"id": "usermodel-user_remark", "name": "UserModel[user_remark]", "attribute": "user_remark", "rules": {"string":true,"messages":{"string":"会员备注必须是一条字符串。","match":"会员备注中含有非法字符"},"match":{"pattern":/<|>|<script|<img|<svg|alert|prompt|cookie|@eval|@ini_set|@set_time_limit|\$_SERVER|@set_magic_quotes_runtime/,"not":true}}},]);
            var validator_real = $("#UserRealModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules([{"id": "userrealmodel-real_name", "name": "UserRealModel[real_name]", "attribute": "real_name", "rules": {"required":true,"messages":{"required":"真实姓名不能为空。"}}},{"id": "userrealmodel-id_code", "name": "UserRealModel[id_code]", "attribute": "id_code", "rules": {"required":true,"messages":{"required":"身份证号码不能为空。"}}},{"id": "userrealmodel-card_pic1", "name": "UserRealModel[card_pic1]", "attribute": "card_pic1", "rules": {"required":true,"messages":{"required":"身份证人像面照片不能为空。"}}},{"id": "userrealmodel-card_pic2", "name": "UserRealModel[card_pic2]", "attribute": "card_pic2", "rules": {"required":true,"messages":{"required":"身份证国徽面照片不能为空。"}}},{"id": "userrealmodel-card_pic3", "name": "UserRealModel[card_pic3]", "attribute": "card_pic3", "rules": {"required":true,"messages":{"required":"本人手持身份证人像面照片不能为空。"}}},{"id": "userrealmodel-user_id", "name": "UserRealModel[user_id]", "attribute": "user_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"用户基本信息ID必须是整数。"}}},{"id": "userrealmodel-status", "name": "UserRealModel[status]", "attribute": "status", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否通过实名认证必须是整数。"}}},{"id": "userrealmodel-add_time", "name": "UserRealModel[add_time]", "attribute": "add_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Add Time必须是整数。"}}},{"id": "userrealmodel-real_name", "name": "UserRealModel[real_name]", "attribute": "real_name", "rules": {"string":true,"messages":{"string":"真实姓名必须是一条字符串。","maxlength":"真实姓名只能包含至多60个字符。","match":"真实姓名中含有非法字符"},"maxlength":60,"match":{"pattern":/<|>|<script|<img|<svg|alert|prompt|cookie|@eval|@ini_set|@set_time_limit|\$_SERVER|@set_magic_quotes_runtime/,"not":true}}},{"id": "userrealmodel-address_now", "name": "UserRealModel[address_now]", "attribute": "address_now", "rules": {"string":true,"messages":{"string":"现居住地址必须是一条字符串。","maxlength":"现居住地址只能包含至多60个字符。","match":"现居住地址中含有非法字符"},"maxlength":60,"match":{"pattern":/<|>|<script|<img|<svg|alert|prompt|cookie|@eval|@ini_set|@set_time_limit|\$_SERVER|@set_magic_quotes_runtime/,"not":true}}},{"id": "userrealmodel-id_code", "name": "UserRealModel[id_code]", "attribute": "id_code", "rules": {"string":true,"messages":{"string":"身份证号码必须是一条字符串。","maxlength":"身份证号码只能包含至多18个字符。","match":"身份证号码中含有非法字符"},"maxlength":18,"match":{"pattern":/<|>|<script|<img|<svg|alert|prompt|cookie|@eval|@ini_set|@set_time_limit|\$_SERVER|@set_magic_quotes_runtime/,"not":true}}},{"id": "userrealmodel-id_code", "name": "UserRealModel[id_code]", "attribute": "id_code", "rules": {"match":{"pattern":/^[0-9]{14}[X|x]$|[0-9]{17}[X|x]$|[0-9]{18}$/,"not":false,"skipOnEmpty":1},"messages":{"match":"身份证号码是无效的。"}}},{"id": "userrealmodel-status", "name": "UserRealModel[status]", "attribute": "status", "rules": {"in":{"range":["0","1","2"]},"messages":{"in":"是否通过实名认证是无效的。"}}},{"id": "userrealmodel-real_name", "name": "UserRealModel[real_name]", "attribute": "real_name", "rules": {"string":true,"messages":{"string":"真实姓名必须是一条字符串。","match":"真实姓名中含有非法字符"},"match":{"pattern":/<|>|<script|<img|<svg|alert|prompt|cookie|@eval|@ini_set|@set_time_limit|\$_SERVER|@set_magic_quotes_runtime/,"not":true}}},{"id": "userrealmodel-id_code", "name": "UserRealModel[id_code]", "attribute": "id_code", "rules": {"string":true,"messages":{"string":"身份证号码必须是一条字符串。","match":"身份证号码中含有非法字符"},"match":{"pattern":/<|>|<script|<img|<svg|alert|prompt|cookie|@eval|@ini_set|@set_time_limit|\$_SERVER|@set_magic_quotes_runtime/,"not":true}}},]);
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
                        $.msg(result.message,{
                            icon_type: 1
                        });
                        $('.nickname_dl span').html(result.data.nickname);
                        $('.sex_dl span').html(result.data.sex);
                        $('#user_nickname').hide();
                        $('#user_sex_box').hide();
                        $('.user-info-box').show();
                    }else{
                        $.msg(result.message,{
                            time: 3000
                        });
                    }
                }, "json");
                return false;
            });
            //图片上传
            $(".image-container").each(function() {
                var target = $(this);
                var value = $(target).next('input').val() ? $(target).next('input').val() : "";
                var imagegorup = $(this).imagegroup({
                    host: "{{ get_oss_host() }}",
                    size: 1,
                    is_mobile: true,
                    values: value.split("|"),
                    callback: function(data) {
                        target.next('input').val(this.values);
                    },
                    remove: function(value, values) {
                        target.next('input').val(this.values);
                    },
                });
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
            // 注销用户
            $('.cancel-user').click(function(){
                $.confirm("你确定要注销此账户吗？", function() {
                    $.post('/user/security/cancel.html',{},function(result){
                        if(result.code == 0){
                            $.go('/');
                        }else{
                            $.msg(result.message);
                        }
                    },'json');
                });
            });
        });
        //
        $().ready(function() {
            $("body").on('click', '.upload-image', function() {
                $('#headimg_file').click();
            });
            var photoclip = new PhotoClip('#headimg_file_area', {
                size: [300, 300],
                outputSize: 640,
                //adaptive: ['60%', '80%'],
                file: '#headimg_file',
                view: '#headimg_view',
                ok: '#headimg_file_btn',
                //img: 'img/mm.jpg',
                loadStart: function() {
                    $.loading.start('图片上传中...');
                    console.log('开始读取照片');
                },
                loadComplete: function() {
                    console.log('照片读取完成');
                    $.loading.stop();
                    $('#headimg_upload_container').show();
                },
                done: function(dataURL) {
                    //console.log(dataURL);
                    $.loading.start();
                    $.post('/user/profile/up-load', {
                        "load_img": dataURL
                    }, function(result) {
                        $(".upload-image img").attr("src", result.url);
                        $.msg(result.message,{
                            icon_type: 1
                        });
                        $('#headimg_upload_container').hide();
                    },"json");
                },
                fail: function(msg) {
                    $.msg(msg,{
                        time: 3000
                    });
                }
            });
        });
        //
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
        //
        $().ready(function () {
            WS_AddPoint({
                user_id: '{{ $user_info['user_id'] ?? 0 }}',
                url: "{{ get_ws_url('7272') }}",
                type: "add_point_set"
            });
        });

        function addPoint(ob) {
            if (ob != null && ob != 'undefined') {
                if (ob.point && ob.point > 0 && ob.user_id && ob.user_id == '{{ $user_info['user_id'] ?? 0 }}') {
                    $.intergal({
                        point: ob.point,
                        name: '积分'
                    });
                }
            }
        }
        //
        function go_laravelvip() {
            if (window.__wxjs_environment !== 'miniprogram') {
                window.location.href = 'http://m.laravelvip.com/statistics.html?product_type=shop&domain=http://{{ config('lrw.mobile_domain') }}';
            } else {
                window.location.href = 'http://{{ config('lrw.mobile_domain') }}';
            }
        }
        function GetUrlRelativePath(){
            var url = document.location.toString();
            var arrUrl = url.split("//");
            var start = arrUrl[1].indexOf("/");
            var relUrl = arrUrl[1].substring(start);
            if(relUrl.indexOf("?") != -1){
                relUrl = relUrl.split("?")[0];
            }
            if(relUrl.indexOf(".htm") != -1){
                relUrl = relUrl.split(".htm")[0];
            }
            return relUrl;
        }
        var hide_list = ['/bill','/bill.html','/user/order/bill-list','/user/scan-code/index','/user/sign-in/info'];
        if($.inArray(GetUrlRelativePath(), hide_list) == -1){
            $('.copyright').removeClass('hide');
        }
        //
    </script>

    {{--<script type="text/javascript">
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
    </script>--}}
@stop
