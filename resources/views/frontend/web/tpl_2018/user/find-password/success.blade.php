
<!DOCTYPE html>
<!--[if IE 8]> <html lang="zh-CN" class="ie8"> <![endif]-->
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <title>找回密码</title>
    <!-- 头部元数据 -->
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="Keywords" content="" />
    <meta name="Description" content="" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
    <meta name="format-detection" content="telephone=no">
    <meta name="is_frontend" content="yes" />
    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <!--整站改色 _start-->
    <!--整站改色 _end-->
    <link href="/css/common.css?v=2.0" rel="stylesheet">
    <link href="/css/forget-password.css?v=2.0" rel="stylesheet">
    <link href="/css/color-style.css?v=2.0" rel="stylesheet">
    <script src="/assets/d2eace91/js/jquery.js?v=202003261806"></script>
    <script src="/assets/d2eace91/js/szy.head.js?v=202003261806"></script>
</head>
<body>
<div class="header w990">
    <div class="logo-info ">
        <a href="/" class="logo">
            <img src="{{ get_image_url(sysconf('mall_logo')) }}" />
        </a>
        <span class="findpw">找回密码</span>
    </div>
</div>
<div class="forget-content w990">
    <div class="forget-form">
        <div class="forget-con">
            <div class="forget-wrap">
                <div class="safe-con">
                    <div class="stepflex">
                        <dl class="first  done ">
                            <dt class="s-num">1</dt>
                            <dd class="s-text">
                                账户名
                                <s></s>
                                <b></b>
                            </dd>
                        </dl>
                        <dl class="normal  done ">
                            <dt class="s-num">2</dt>
                            <dd class="s-text">
                                验证身份
                                <s></s>
                                <b></b>
                            </dd>
                        </dl>
                        <dl class="normal  done ">
                            <dt class="s-num">3</dt>
                            <dd class="s-text">
                                设置新密码
                                <s></s>
                                <b></b>
                            </dd>
                        </dl>
                        <dl class="last  doing ">
                            <dt class="s-num">4</dt>
                            <dd class="s-text">
                                完成
                                <s></s>
                                <b></b>
                            </dd>
                        </dl>
                    </div>
                    <div class="find-box-end">
                        <p class="success">
                            <i></i>
                            新密码设置成功！
                        </p>
                        <p class="tips">
                            <a class="color m-l-10" href="/login.html" title="立即购物">立即登录&gt;&gt;</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 底部 _start-->
{{-- include common footer --}}
@include('layouts.partials.short_footer')
<!-- 底部 _end-->
<script type="text/javascript">
    // 
</script>
<script src="/assets/d2eace91/min/js/core.min.js?v=20201016"></script>
<script src="/assets/d2eace91/js/placeholder.js?v=20201016"></script>
<script src="/js/login.js?v=20201016"></script>
<script src="/assets/d2eace91/js/common.js?v=20201016"></script>
<script>
    $().ready(function() {
        $('.site_to_yikf').click(function() {
            $(this).parent('form').submit();
        })
    });
    // 
</script>
</body>
</html>
