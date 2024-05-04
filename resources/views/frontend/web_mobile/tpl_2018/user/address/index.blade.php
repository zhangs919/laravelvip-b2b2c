@extends('layouts.user_layout')


{{--header_css--}}
@section('header_css')
@stop


@section('content')

    <div>
        <header>
            <div class="header">
                <div class="header-left">
                    <a class="sb-back" href="/user.html" title="返回">
                        <i class="iconfont">&#xe606;</i>
                    </a>
                </div>
                <div class="header-middle">收货地址管理</div>
                <div class="header-right">
                    <!-- 控制展示更多按钮 -->
                    <aside class="show-menu-btn">
                        <div id="show_more" class="show-menu">
                            <a href="javascript:;">
                                <i class="iconfont">&#xe6cd;</i>
                            </a>
                        </div>
                    </aside>
                </div>
            </div>
        </header>
        <div class="address-box">

            <div class="address-items" id="table_list">
                <!--有收货地址时-->

                    @if($address_list->isEmpty())
                        <!--没有收货地址时 start-->
                        <div class="no-data-div">
                            <div class="no-data-img">
                                <img src="/images/bg_empty_data.png">
                            </div>
                            <dl>
                                <dt>没有收货地址</dt>
                                <dd>添加收货地址购物更方便哦~</dd>
                            </dl>
                        </div>
                        <!--没有收货地址时 end-->
                    @else
                        <div class="tablelist-append">
                            @foreach($address_list as $address)
                                <div class="address-add-box">
                                    <dl>
                                        <dt>
                                            <strong>{{ $address->consignee }}&nbsp;&nbsp;</strong>
                                            <span>{{ $address->mobile }}</span>
                                        </dt>
                                        <dd>
                                            @if(!empty($address->address_label))
                                                <em class="company-address-icon">{{ $address->address_label }}</em>
                                            @endif
                                            {{ get_region_names_by_region_code($address->region_code, ' ') }} {{ $address->address_detail }}
                                        </dd>
                                    </dl>
                                    <div class="address-bottom">
                                        <div class="add-left">
                                            <!--a标签选中状态class为addl-red，不选中状态为addl-hui-->
                                            <span>
                                                <a href="javascript:void(0)" data-address_id="{{ $address->address_id }}" class="add_selected @if($address->is_default) addl-red @else addl-hui @endif"></a>
                                            </span>
                                            <em>设为默认地址</em>
                                        </div>
                                        <div class="add-right">
                                            <a href="javascript:edit({{ $address->address_id }})">
                                                <i class="iconfont">&#xe623;</i>
                                                <span>编辑</span>
                                            </a>
                                            <a href="javascript:void(0)" data-address_id="{{ $address->address_id }}" class="address-delete">
                                                <i class="iconfont">&#xe61b;</i>
                                                <span>删除</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

            </div>

            <div style="width: 100%; height: 50px;"></div>
            <div class="list-footer">
                <a href="javascript:add()">添加新地址</a>
            </div>
        </div>
    </div>
    <div id='edit-address-div'></div>
    <!-- more.js -->
    <script type="text/javascript">
        //
    </script>
    <!-- GPS获取坐标 -->
	<script type="text/javascript">
		window._AMapSecurityConfig = {
			securityJsCode: "{{ sysconf('amap_js_security_code') }}",
		};
	</script>
    <script src="http://webapi.amap.com/maps?v=1.4.15&key={{ sysconf('amap_js_key') }}"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.6.0.js"></script>
    <script type="text/javascript">
        //
    </script>
    {{--引入右上角菜单--}}
    @include('layouts.partials.right_top_menu')

    <!-- 积分消息 -->
    <!-- 消息提醒 -->
    <script type="text/javascript">
        //
    </script>
    <!-- 第三方流量统计 -->
    <div style="display: none;"></div>
    <!-- 底部 _end-->
    <div style="height: 54px; line-height: 54px" class="handle-spacing"></div>
    <script src="/assets/d2eace91/min/js/core.min.js"></script>
    <script src="/js/app.frontend.mobile.min.js"></script>
    <script src="/js/user.js"></script>
    <script src="/js/address.js"></script>
    <script src="/js/center.js"></script>
    <script src="/js/jquery.fly.min.js"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js"></script>
    <script src="/assets/d2eace91/js/geolocation/amap.js"></script>
    <script src="/assets/d2eace91/min/js/message.min.js"></script>
    <script>
        var tablelist = null;
        $().ready(function() {
            tablelist = $("#table_list").tablelist();
        });
        //
        function geolocation() {
            if (!sessionStorage.geolocation) {
                setTimeout(function() {
                    $.geolocation();
                }, 500);
            }
        }
        $().ready(function(){
            geolocation();
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
