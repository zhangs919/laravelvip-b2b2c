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
                <span class="header_left">4</span>
                <span class="header_right">安装完成</span>
            </li>
        </ul>
    </div>

    <!-- 参数配置 -->
    <div class="parameter" data-index="3">
        <form action="/install/setting.html" method="post" id="js-setting" name="installForm">
			@csrf
            <div class="database_content">
                <div class="database_content_title d-flex a-content">
                    <div class="font-18 font-weight ml-25">数据库账号</div>
                </div>
                <div class="database_content_footer">
                    <div class="d-flex a-content">
                        <label for="host" class="font-16 w-250 align-right">数据库主机</label>
                        <div class="ml-35 line-height-40">
                            <input type="text" name="db_host" id="host" value="127.0.0.1"
                                   class="float-left radius-5 border-ccc h-40 w-350 required">
                        </div>
                    </div>
                    <div class="font-15 text-999 ml-285 py-10">⼀般为127.0.0.1</div>

                    <div class="d-flex a-content">
                        <label for="port" class="font-16 w-250 align-right">数据库端⼝号</label>
                        <div class="ml-35 line-height-40">
                            <input type="text" name="db_port" value="3306" id="port" datatype="s"
                                   class="float-left required radius-5 border-ccc h-40 w-350 ">
                        </div>
                    </div>
                    <div class="font-15 text-999 ml-285 py-10">⼀般为3306</div>

                    <div class="d-flex a-content">
                        <label for="userinfo" class="font-16 w-250 align-right">数据库⽤户名</label>
                        <div class="ml-35 line-height-40">
                            <input type="text" name="db_user" id="userinfo" value="root" datatype="s"
                                   class="required radius-5 border-ccc h-40 w-350 float-left">
                        </div>
                    </div>
                    <div class="font-15 text-999 ml-285 py-10">请设置连接数据库⽤户名，建议⽤root账号，创建完成后可⼿动更改</div>

                    <div class="d-flex a-content">
                        <label for="passinfo" class="font-16 w-250 align-right">数据库密码</label>
                        <div class="ml-35 line-height-40">
                            <input type="text" name="db_pass" id="passinfo" value="" datatype="s"
                                   class="required radius-5 border-ccc h-40 w-350 float-left">
                        </div>
                    </div>
                    <div class="font-15 text-999 ml-285 py-10">请设置连接数据库的密码，建议字母⼤⼩写+数字</div>

                    <div class="d-flex a-content">
                        <label for="names" class="font-16 w-250 align-right">数据库名</label>
                        <div class="ml-35 d-flex a-content">
                            <input type="text" name="db_name" id="names" datatype="s"
                                   class="radius-5 border-ccc h-40 w-160">
                            <div class="font-15 align-center w-30">或</div>
                            <select class="radius-5 border-ccc h-40 w-160 font-15 text-999 select_160" id="j-databases">
                                <option value="">已有数据库</option>
                            </select>
                        </div>
                    </div>
                    <div class="font-15 text-999 ml-285 py-10">⽤于安装程序的数据库，若不存在则创建</div>

                    <div class="d-flex a-content">
                        <label for="prefix" class="font-16 w-250 align-right">数据库表前缀</label>
                        <div class="ml-35 line-height-40">
                            <input type="text" name="db_prefix" id="prefix" value="_" datatype="s"
                                   class="float-left radius-5 border-ccc h-40 w-350 required">
                        </div>
                    </div>
                    <div class="font-15 text-999 ml-285 py-10">⼀个数据库安装多个程序时，建议您修改数据表前缀，默认为"_"表示没有前缀</div>
                </div>
            </div>
            <div class="database_content">
                <div class="database_content_title d-flex a-content">
                    <div class="font-18 font-weight ml-25">管理员账号</div>
                </div>
                <div class="database_content_footer ">
                    <div class="d-flex a-content">
                        <label for="adminname" class="font-16 w-250 align-right">管理员姓名</label>
                        <div class="ml-35 line-height-40">
                            <input type="text" name="admin_name" id="adminname" datatype="s"
                                   class="radius-5 border-ccc h-40 w-350 required float-left">
                        </div>
                    </div>
                    <div class="font-15 text-999 ml-285 py-10">设置管理员登录后台的账号</div>

                    <div class="d-flex a-content">
                        <label for="adminpass" class="font-16 w-250 align-right">登录密码</label>
                        <div class="ml-35 line-height-40">
                            <input type="password" name="admin_password" id="adminpass" datatype="*6-16"
                                   class="required radius-5 border-ccc h-40 w-350 float-left">
                        </div>
                    </div>
                    <div class="font-15 text-999 ml-285 py-10">请设置管理员登录后台的密码</div>

                    <div class="d-flex a-content">
                        <label for="confirm_pass" class="font-16 w-250 align-right">确认密码</label>
                        <div class="ml-35 line-height-40">
                            <input type="password" name="admin_password2" id="confirm_pass" datatype="*"
                                   recheck="admin_password"
                                   class="required radius-5 border-ccc h-40 w-350 float-left" msg="请输入密码">
                        </div>
                    </div>
                    <div class="font-15 text-999 ml-285 py-10">请重复输⼊确认上⾯管理员的登录密码</div>

                    <div class="d-flex a-content">
                        <label for="email" class="font-16 w-250 align-right">电⼦邮箱</label>
                        <div class="ml-35 line-height-40">
                            <input type="text" id="email" name="admin_email" datatype="e"
                                   class="radius-5 border-ccc h-40 w-350 float-left">
                        </div>
                    </div>
                    <div class="font-15 text-999 ml-285 py-10">请输⼊电⼦邮箱地址</div>
                </div>
            </div>

            <div class="protocol_footer">
                <button id="parameter_last" onclick="location.href='/install/check.html'">上一步</button>
                <input class="submit" type="submit" value="立即安装" id="parameter_install"/>
            </div>
        </form>
    </div>
</div>

<!-- 弹框 -->
<div class="tanchuang" id="x-error">
    <div class="pop">
        <div class="up">
            <div class="w-100 text-align-right"></div>
            <div class="d-flex flex-column j-content a-content">
                <img src="/installs/images/1.png" class="img_1" alt="">
                <div class="bar mt-10">
                    <span id="progressBar" class="percentage"></span>
                </div>
                <div class="font-18 py-10 font-weight">正在安装中···</div>
                <div class="text-999 font-15">正在为您安装部署，请稍后···</div>
            </div>
        </div>
    </div>
</div>

<script src="/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="/installs/js/layui/layui.js" type="text/javascript"></script>
<script src="/installs/js/Validform_min.js" type="text/javascript"></script>
<script src="/installs/js/install.js" type="text/javascript"></script>
</body>
</html>