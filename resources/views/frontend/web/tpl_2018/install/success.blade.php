<!DOCTYPE html>
<html lang="ZH-Hans">
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>{{ $seo_title }}</title>
    <link rel="stylesheet" href="/installs/css/base.css">
    <link rel="stylesheet" href="/installs/css/install.css">
</head>
<body>
<header>
    <div class="head">
        <div class="head_left">
            <img src="/installs/images/header.png" class="head_img" alt="">
            <div>安装向导</div>
        </div>
        <div class="head_right">
            <div><a href="https://www.laravelvip.com" target="_blank">官方网站</a></div>
        </div>
    </div>
</header>
<div class="box">
    <div class="header">
        <ul>
            <li>
                <span class="header_left header_left_active">1</span>
                <span class="header_right header_right_active">许可协议</span>
            </li>
            <li>
                <span class="header_left header_left_active">2</span>
                <span class="header_right header_right_active">环境检测</span>
            </li>
            <li>
                <span class="header_left header_left_active">3</span>
                <span class="header_right header_right_active">参数配置</span>
            </li>
            <li>
                <span class="header_left header_left_active">4</span>
                <span class="header_right header_right_active">安装完成</span>
            </li>
        </ul>
    </div>

    <!-- 安装完成 -->
    <div class="complete">
        <div class="d-flex j-content flex-column a-content w-100">
            <div class="d-flex j-content flex-column a-content complete_content">
                <img src="/installs/images/counter.png" alt="" class="counter py-10">
                <div class="font-18 py-10 font-weight">恭喜您，已成功安装部署</div>
                <div class="text-999 font-15 py-10">基于安全考虑，请在安装完成后
{{--					删除 <span class="bg-red">install</span>⽬录。并--}}
					登录后台尽快修改默认账号。
                </div>
                <div class="d-flex py-10">
                    <div class="font-15">默认账号：{{ $admin_username }}</div>
                    <div class="ml-25 font-15"> 默认密码：{{ $admin_password }}</div>
                </div>
                <div class="font-15 py-10">访问站点：<a href="{{ $app_url }}" class="ade">{{ $app_url }}</a></div>
            </div>
            <div class="complete_footer ">
                <div class="font-18 py-10 font-weight">您还可以访问：</div>
                <div class="d-flex py-10 font-15 mt">
                    <div class="flex-1 text-align-center"><a href="{{ $app_url }}">⽹站⾸页</a></div>
                    <div class="flex-1 text-align-center"><a href="//{{ $backend_url }}">后台管理中⼼</a></div>
                    <div class="flex-1 text-align-center"><a href="https://www.laravelvip.com" target="_blank">乐融沃官⽅⽹站</a></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="/vendor/layui/layui.all.js" type="text/javascript"></script>
<script src="/installs/js/Validform_min.js" type="text/javascript"></script>
<script src="/installs/js/install.js" type="text/javascript"></script>
</body>
</html>
