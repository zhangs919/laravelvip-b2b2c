@extends('layouts.user_layout')


{{--header_css--}}
@section('header_css')
    <link href="/css/membercard.css" rel="stylesheet">
@stop

@section('content')
    <header class="header-top-nav">
        <div class="header">
            <div class="header-left">
                <a class="sb-back" href="javascript:history.back(-1);" title="返回">
                    <i class="iconfont">&#xe606;</i>
                </a>
            </div>
            <div class="header-middle">我的会员卡</div>
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
    <div class="card-list clearfix" id="table_list">
        <!-- -->
        <div class="card-content">
            <a href="/user/rights-card/info?id=192" class="member-card "style="background-color:#00b0f0">
                <div class="member-card-hd">
                    <img src="https://xxxx?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" class="shop-logo">
                    <h3 class="shop-name">三只松鼠旗舰店</h3>
                </div>
                <div class="card-name">高级会员(VIP2)<em class="color">默认</em></div>
                <div class="member-card-ft">
                    <p>
                        类型：
                        按规则发放
                    </p>
                    <p>
                        永久有效
                    </p>
                </div>
                <div class="card-status">
                    使用中
                </div>
            </a>
        </div>
        <!-- -->
        <div class="card-content">
            <a href="/user/rights-card/info?id=200" class="member-card "style="background-color:#00b0f0">
                <div class="member-card-hd">
                    <img src="xxxx/images/shop/5/images/2019/01/28/15486572353455.jpg?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" class="shop-logo">
                    <h3 class="shop-name">夏色萌动自营旗舰店</h3>
                </div>
                <div class="card-name">高级会员(VIP2)<em class="color">默认</em></div>
                <div class="member-card-ft">
                    <p>
                        类型：
                        按规则发放
                    </p>
                    <p>
                        永久有效
                    </p>
                </div>
                <div class="card-status">
                    使用中
                </div>
            </a>
        </div>
        <!-- -->
        <div class="card-content">
            <a href="/user/rights-card/info?id=211" class="member-card "style="background-color:#00b0f0">
                <div class="member-card-hd">
                    <img src="xxxx/images/shop/6/images/2019/01/28/15486555936392.jpg?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" class="shop-logo">
                    <h3 class="shop-name">吃子之心零食店</h3>
                </div>
                <div class="card-name">VIP会员(VIP3)<em class="color">默认</em></div>
                <div class="member-card-ft">
                    <p>
                        类型：
                        按规则发放
                    </p>
                    <p>
                        永久有效
                    </p>
                </div>
                <div class="card-status">
                    使用中
                </div>
            </a>
        </div>
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

    <div style="height: 54px; line-height: 54px" class="handle-spacing"></div>
    <script src="/assets/d2eace91/min/js/core.min.js"></script>
    <script src="/js/app.frontend.mobile.min.js"></script>
    <script src="/js/user.js"></script>
    <script src="/js/address.js"></script>
    <script src="/js/center.js"></script>
    <script src="/js/jquery.fly.min.js"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js"></script>
    <script src="/assets/d2eace91/min/js/message.min.js"></script>
    <script>
        //点击显示更多会员等级
        //if ('.card-info .card-box-bottom span').hasClass('small-drop-down') {
        $('.card-info').not('a').click(function() {
            if ($(this).find('span').hasClass('small-drop-down')) {
                if ($(this).parent().find('.trade-dropdown-table').hasClass('show')) {
                    $(this).parent().find('.trade-dropdown-table').removeClass('show');
                } else {
                    $(this).parent().find('.trade-dropdown-table').addClass('show');
                    $(this).parent().siblings().find('.trade-dropdown-table').removeClass('show');
                }
            }
        })
        //}
        var tablelist = null;
        $().ready(function() {
            tablelist = $("#table_list").tablelist({
                params: $("#searchForm").serializeJson()
            });
            $("#searchForm").submit(function() {
                // 序列化表单为JSON对象
                var data = $(this).serializeJson();
                console.info(data);
                // Ajax加载数据
                tablelist.load(data);
                // 阻止表单提交
                return false;
            });
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
    </script>

@stop
