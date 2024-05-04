@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="/css/welcome.css">
@stop

@section('alert_msg')
    <!--顶部4个-->
    <!--系统更新消息提示信息-->
    <!--
        <div class="col-lg-12 col-sm-12">
            <div class="alert alert-warning animated fadeIn">
                <a href="#" class="close" data-dismiss="alert"> &times; </a>
                <strong>警告！</strong>
                店铺处于免费试用期（还剩 6 天）；逾期未续费的店铺将自动被打烊。为保证店铺正常运营请尽快进行
                <a class="alert-href" href="javascript:;">升级v1.5</a>
                版本…
            </div>
    </div>
    -->
@stop

@section('content')

    <div class="row card-box">
        <div class="col-lg-12 col-sm-12">
            <div class="alert alert-warning animated fadeIn">
                <p class="m-b-5">
                    <strong>系统检测到您有影响商城运营的基本配置信息尚未配置：</strong>
                </p>

                @if(empty(sysconf('sms_sign_name')))
                <span class="m-r-30">
					短信配置尚未配置，
					<a class="alert-href" target="_blank" href="/system/sms/sms-config">前往配置</a>
				</span>
                @endif


                @if(empty(sysconf('smtp_host')))
                <span class="m-r-30">
					邮件配置尚未配置，
					<a class="alert-href" target="_blank" href="/system/config/index?group=smtp">前往配置</a>
				</span>
                @endif


                <span class="m-r-30">
					支付方式尚未配置，
					<a class="alert-href" target="_blank" href="/mall/payment/list">前往配置</a>
				</span>


                @if(empty(sysconf('alioss_enable')))
                <span>
					阿里OSS尚未配置，
					<a class="alert-href" target="_blank" href="/system/config/index?group=alioss">前往配置</a>
				</span>
                @endif

            </div>
        </div>
        <div class="col-lg-3 col-sm-3">
            <div class="panel purple">
                <div class="symbol">
                    <i class="fa fa-jpy"></i>
                </div>
                <div class="value">
                    <p class="num h40" id="today_gains">0.00</p>
                    <p class="text">
                        今日销售总额
                        <i class="fa fa-question-circle" data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content="今日销售总额统计所有已经付款的订单，用户前台下单且付款后，今日销售额增加；用户付款前，销售额不变，当用户退款或退货后，减少相应的销售额。" data-original-title="" title=""></i>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-3">
            <a href="/trade/order/list?add_time_begin=2018-02-15">
                <div class="panel yellow">
                    <div class="symbol">
                        <i class="fa fa-bar-chart"></i>
                    </div>
                    <div class="value">
                        <p class="num" id="today_orders">0</p>
                        <p class="text">
                            今日订单量
                            <i class="fa fa-question-circle" data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content="今日订单量统计当前日期一天内的所有订单，包含交易成功、交易关闭、未付款、已付款未发货、已发货的订单。" data-original-title="" title=""></i>
                        </p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-sm-3">
            <a href="/shop/shop/index?is_supply=0&amp;start_from=2018-02-15">
                <div class="panel green">
                    <div class="symbol">
                        <i class="fa fa-bank"></i>
                    </div>
                    <div class="value">
                        <p class="num" id="today_shops">0</p>
                        <p class="text">今日入驻商家</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-sm-3">
            <a href="/user/user/list?reg_time_begin=2018-02-15">
                <div class="panel red">
                    <div class="symbol">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="value">
                        <p class="num" id="today_users">0</p>
                        <p class="text">今日注册会员</p>
                    </div>
                </div>
            </a>
        </div>
        <!-- <div class="col-lg-3 col-sm-3">
            <div class="panel orange">
                <div class="symbol">
                    <i class="fa fa-bar-chart"></i>
                </div>
                <div class="value">
                    <p class="num" id="today_visits">&nbsp;</p>
                    <p class="text">今日网站访问</p>
                </div>
            </div>
        </div> -->
    </div>
    <!--订单小统计-->
    <div class="row mini-stat">
        <div class="col-lg-2 col-sm-2">
            <div class="panel">
                <a href="/trade/order/list?order_status=unpayed">
					<span class="mini-stat-icon orange">
						<i class="fa fa-money"></i>
					</span>
                    <div class="mini-stat-info">
                        <span class="num" id="unpayed">0</span>
                        <span class="text">待付款订单数</span>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-2 col-sm-2">
            <div class="panel">
                <a href="/trade/order/list?order_status=unshipped">
					<span class="mini-stat-icon tar">
						<i class="fa fa-cubes"></i>
					</span>
                    <div class="mini-stat-info">
                        <span class="num" id="unshipped">0</span>
                        <span class="text">待发货订单数</span>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-2 col-sm-2">
            <div class="panel">
                <a href="/trade/order/list?order_status=shipped">
					<span class="mini-stat-icon brown">
						<i class="fa fa-truck"></i>
					</span>
                    <div class="mini-stat-info">
                        <span class="num" id="shipped">0</span>
                        <span class="text">已发货订单数</span>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-2 col-sm-2">
            <div class="panel">
                <a href="/trade/order/list?order_status=backing">
					<span class="mini-stat-icon pink">
						<i class="fa fa-mail-reply-all"></i>
					</span>
                    <div class="mini-stat-info">
                        <span class="num" id="backing">0</span>
                        <span class="text">退款中订单数</span>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-2 col-sm-2">
            <div class="panel">
                <a href="/trade/order/list?evaluate_status=unevaluate">
					<span class="mini-stat-icon green">
						<i class="fa fa-pencil"></i>
					</span>
                    <div class="mini-stat-info">
                        <span class="num" id="unevaluate">0</span>
                        <span class="text">待评价订单数</span>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-2 col-sm-2">
            <div class="panel">
                <a href="/trade/order/list?order_status=finished">
					<span class="mini-stat-icon blue">
						<i class="fa fa-check-square-o"></i>
					</span>
                    <div class="mini-stat-info">
                        <span class="num" id="finished">0</span>
                        <span class="text">已完成订单数</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!--中间内容-->
    <div class="row">
        <!--左侧内容-->
        <div class="col-md-8">
            <!---->
            <div class="panel">
                <div class="panel-header">
                    <h3>会员增长统计图</h3>
                </div>
                <div class="panel-body">
                    <div id="users_div" _echarts_instance_="1518658315863" style="-webkit-tap-highlight-color: transparent; user-select: none; background-color: rgba(0, 0, 0, 0); cursor: default;"><div style="position: relative; overflow: hidden; width: 829px; height: 252px;"><div data-zr-dom-id="bg" class="zr-element" style="position: absolute; left: 0px; top: 0px; width: 829px; height: 252px; user-select: none;"></div><canvas width="829" height="252" data-zr-dom-id="0" class="zr-element" style="position: absolute; left: 0px; top: 0px; width: 829px; height: 252px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></canvas><canvas width="829" height="252" data-zr-dom-id="1" class="zr-element" style="position: absolute; left: 0px; top: 0px; width: 829px; height: 252px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></canvas><canvas width="829" height="252" data-zr-dom-id="_zrender_hover_" class="zr-element" style="position: absolute; left: 0px; top: 0px; width: 829px; height: 252px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></canvas></div></div>
                </div>
            </div>
        </div>
        <!--中间内容-->
        <div class="col-md-4">
            <!---->
            <div class="panel">
                <div class="panel-header">
                    <h3>运营快捷入口</h3>
                </div>
                <div class="panel-body">
                    <div class="entrance-box">
                        <dl>
                            <sub></sub>
                            <dt class="p-name">
                                <a href="/trade/order/list">订单列表</a>
                            </dt>
                            <dd class="p-ico">
                                <a>
                                    <i class="order"></i>
                                </a>
                            </dd>
                        </dl>
                        <dl>
                            <sub></sub>
                            <dt class="p-name">
                                <a href="/trade/refund/list">退款管理</a>
                            </dt>
                            <dd class="p-ico">
                                <a>
                                    <i class="return"></i>
                                </a>
                            </dd>
                        </dl>
                        <dl>
                            <sub></sub>
                            <dt class="p-name">
                                <a href="/shop/shop/list">入驻商管理</a>
                            </dt>
                            <dd class="p-ico">
                                <a>
                                    <i class="apply"></i>
                                </a>
                            </dd>
                        </dl>
                        <dl>
                            <sub></sub>
                            <dt class="p-name">
                                <a href="/user/user/list">会员管理</a>
                            </dt>
                            <dd class="p-ico">
                                <a>
                                    <i class="user"></i>
                                </a>
                            </dd>
                        </dl>
                        <dl>
                            <sub></sub>
                            <dt class="p-name">
                                <a href="/design/tpl-setting/setup" target="_blank">商城装修</a>
                            </dt>
                            <dd class="p-ico">
                                <a>
                                    <i class="store"></i>
                                </a>
                            </dd>
                        </dl>
                        <dl>
                            <sub></sub>
                            <dt class="p-name">

                                <a href="/finance/bill/system-shop-bill">账单管理</a>

                            </dt>
                            <dd class="p-ico">
                                <a>
                                    <i class="money"></i>
                                </a>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--系统信息-->
    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <div class="panel">
                <div class="panel-header">
                    <h3>系统信息</h3>
                </div>
                <div class="panel-body">
                    <div class="system-infor">
                        <ul>
                            <li>
                                <span class="dt">服务器操作系统：</span>
                                <span class="dd">{{ PHP_OS }}</span>
                            </li>
                            <li>
                                <span class="dt">Web服务器：</span>
                                <span class="dd">{{ $system_info['service_software'] }}</span>
                            </li>
                            <li>
                                <span class="dt">PHP版本：</span>
                                <span class="dd">{{ $system_info['php_version'] }}</span>
                            </li>
                            <li>
                                <span class="dt">MySQL版本：</span>
                                <span class="dd">{{ $system_info['mysql_version'] }}</span>
                            </li>
{{--                            <li>--}}
{{--                                <span class="dt">GD版本：</span>--}}
{{--                                <span class="dd">{{ $system_info['gd_version'] }}--}}{{--bundled (2.1.0 compatible)--}}{{--</span>--}}
{{--                            </li>--}}
                            <li>
                                <span class="dt">Laravel版本：</span>
                                <span class="dd">{{ app()->version() }}</span>
                            </li>
                            <li>
                                <span class="dt">时区设置：</span>
                                <span class="dd">({{ $system_info['timezone'] }}) Beijing, Hong Kong, Perth, Singapore, Taipei</span>
                            </li>
                            <li>
                                <span class="dt">文件上传的最大大小：</span>
                                <span class="dd">{{ $system_info['fileupload'] }}</span>
                            </li>
                            <li>
                                <span class="dt">字符编码：</span>
                                <span class="dd">{{ $system_info['default_charset'] }}</span>
                            </li>
                            <li>
                                <span class="dt">当前版本：</span>
                                <span class="dd">
									{{ $system_info['version'] }}&nbsp;&nbsp;
									<span id="update"></span>
                                    <a id="update-log" class="btn btn-sm btn-primary" href="javascript:;">更新日志</a>
								</span>
                            </li>
                            <li>
                                <span class="dt">更新日期：</span>
                                <span class="dd">{{ $system_info['update_time'] }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('extra_html')
    <div class="reveal-modal hide" id ='qweqwe'>
        <div class="inner">
            <div class="title">商城相关后台入口</div>
            <div class="pull-left text-box">
                <div class="text-l">
                    <p>为了将系统更安全，系统分不同角色不同后台。</p>
                    <p>运营方/总部的管理后台<span>（即平台方后台）</span>，<!--招商加盟的区域分站后台<span>（站点后台）</span>，-->自营或入驻商家的后台<span>（即店铺后台）</span>，每个商家可开通线下多网点，进行网点就近接单<span>（网点后台）</span>。</p>
                    <p>点击“<span> 首页 -> 新手向导 </span>”菜单，更进一步的了解商城后台系统</p>
                </div>
            </div>
            <div class="pull-right">
                <div class="sub-title">相关后台切换地址</div>
                <ul class="backend-block">
                    <li class="current"><a class="blue-bg"  target="_blank" href="http://{{ config('lrw.backend_domain') }}">平台方后台</a></li>
                    <!---->
                    <li><a class="green-bg"  target="_blank" href="http://{{ config('lrw.seller_domain') }}">店铺后台</a></li>
                    <li><a class="yellow-bg"  target="_blank" href="http://{{ config('lrw.store_domain') }}">网点后台</a></li>
                </ul>
            </div>
        </div>
        <a class="close-reveal-modal"></a>
    </div>
    <a class="reveal-modal-show-btn c-fff"><i class="fa fa-desktop"></i><br/>后台入口</a>
    <script type="text/javascript">
        $().ready(function() {
            /* 判断是否启用弹框 */
            $.ajax({
                url: '/index/index/show-message',
                dataType: 'json',
                success: function(data) {
                    if (data.data == 0) {
                        $("#qweqwe").removeClass('hide');
                    }
                }
            });
            /*关闭按钮*/
            $('.close-reveal-modal').click(function() {
                var data = 1;
                $.get("/index/index/guide-show.html", {
                    data: data
                }, function(result) {
                });

            });
            $('.close-reveal-modal').click(function(e) {
                $(".reveal-modal").animate({
                    bottom:'-255px',right:'-100%'}
                );
            });
            $('.reveal-modal-show-btn').click(function(e) {
                $(".reveal-modal").removeClass('hide');
                $(".reveal-modal").animate({
                    bottom:'0px',right:'0'}
                );
            });
            $("#update-log").click(function () {
                $.open({
                    title: "更新日志",
                    shadeClose: true,
                    type:1,
                    content: "<div style='padding:15px; font-size:14px;line-height:28px;'>{!! $system_info['latest_version_str'] !!}</div>",
                });

            })
        });
    </script>


    <script type="text/javascript">
        (function($) {
            $(window).load(function() {
                $(".slimScrollDiv").mCustomScrollbar();
                $("[data-toggle='popover']").popover();
            });
        })(jQuery);
    </script>
    <script type="text/javascript">
        $().ready(function() {
            $.ajax({
                url:'/index/index/get-data',
                dataType:'json',
                success:function(data) {
                    // 今日销售总额
                    $("#today_gains").html(data.today_gains);
                    // 今日订单量
                    $("#today_orders").html(data.today_orders);
                    // 今日入驻商家
                    $("#today_shops").html(data.today_shops);
                    // 今日注册会员
                    $("#today_users").html(data.today_users);
                    // 今日网站访问
                    /* $("#today_visits").html(data.today_visits); */
                    // 待付款订单数
                    $("#unpayed").html(data.order_count.unpayed);
                    // 待发货订单数
                    $("#unshipped").html(data.order_count.unshipped);
                    // 已发货订单数
                    $("#shipped").html(data.order_count.shipped);
                    // 退款中订单数
                    $("#backing").html(data.order_count.backing);
                    // 待评价订单数
                    $("#unevaluate").html(data.order_count.unevaluate);
                    // 已完成订单数
                    $("#finished").html(data.order_count.finished);
                }
            });


            $.ajax({
                url:'/index/index/update',
                dataType:'json',
                success:function(data) {
                    // 新版本信息
                    if (data.update !== '') {
                        $("#update").html(data.update);
                    }
                }
            });


            $("body").on('click', '#one_key_upgrade', function() {
                // 新加 一键升级功能
                $.ajax({
                    url:'/index/index/one-key-upgrade',
                    dataType:'json',
                    success:function(data) {
                        $.msg(data.message);
                        // $("#update").html(data.message);
                    }
                });
            });

        });
    </script>
    <script src=/js/welcome.js"></script>
    <!-- ECharts单文件引入 -->
    <script src="/assets/d2eace91/js/echarts/echarts-all.js"></script>
    <script type="text/javascript">
        $().ready(function() {
            // 基于准备好的dom，初始化echarts图表
            var myChart = echarts.init(document.getElementById('users_div'));

            var option = {
                //统计图主题色调
                color: [
                    '#2ec7c9','#b6a2de','#5ab1ef','#ffb980','#d87a80',
                ],
                //统计图标题
                title: {
                    text: ''
                },
                //鼠标经过tooltip背景颜色
                tooltip: {
                    backgroundColor: 'rgba(50,50,50,0.6)',
                    trigger: 'axis'
                },
                //统计角色
                legend: {
                    data: ['']
                },
                //表格
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '3%',
                    containLabel: true
                },
                //其它统计图切换
                toolbox: {
                    feature: {
                        saveAsImage: {}
                    }
                },
                //X轴数据
                xAxis: {
                    type: 'category',
                    boundaryGap: false,
                    data: {!! json_encode($recent_ten_days['x']) !!}
                },
                //Y轴数据
                yAxis: {
                    type: 'value'
                },
                //数据
                series: [{
                    name: '会员增长',
                    type: 'line',
                    stack: '',
                    data: {!! json_encode($recent_ten_days['y']) !!}
                }]
            };

            // 为echarts对象加载数据
            myChart.setOption(option);
        });




    </script>
@stop