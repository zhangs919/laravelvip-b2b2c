@extends('layouts.buy_layout')

{{--header_css--}}
@section('header_css')
    <link href="/css/flow.css" rel="stylesheet">

@stop

{{--header_js--}}
@section('header_js')

@stop

@section('content')
    <div class="content-main">
        <header>
            <div class="header">
                <div class="header-left">
                    <a class="sb-back" href="javascript:history.back(-1);" title="返回">
                        <i class="iconfont">&#xe606;</i>
                    </a>
                </div>
                <div class="header-middle">收货地址管理</div>
                <div class="header-right">
                    <!-- 控制展示更多按钮 -->
                    <aside class="show-menu-btn">
                        <div id="show_more" class="show-menu iconfont icon-gengduo3"></div>
                    </aside>
                </div>
            </div>
        </header>
        @if(!empty($address_list))
        <!--有收货地址时-->
        <div class="address-items">
            @foreach($address_list as $v)
                <div class="address-add-box">
                    <a href="javascript:void(0)" data-address-id="{{ $v['address_id'] }}" class="address-box @if($v['selected']){{ 'active' }}@endif">
                        <dl>
                            <dt>
                                <strong>{{ $v['consignee'] }}&nbsp;&nbsp;</strong>
                                <span>{{ $v['mobile_format'] }}</span>
                            </dt>
                            <dd>
                                @if(!empty($v['address_label']))
                                    <em class="custom-address-icon">{{ $v['address_label'] }}</em>

                                @endif
                                {{ $v['region_name'] }} {{ $v['address_detail'] }} {{ $v['address_house'] }}
                            </dd>
                        </dl>
                    </a>
                    <div class="address-bottom">
                        <div class="add-left">
                            <!--a标签选中状态class为addl-red，不选中状态为addl-hui-->
                            <span>
                                <a href="javascript:void(0)" data-address-id="{{ $v['address_id'] }}" class="@if($v['is_default']){{ 'addl-red' }}@else{{ 'addl-hui' }}@endif set-deftip"></a>
                            </span>
                            <em>设为默认地址</em>
                        </div>
                        <div class="add-right">
                            <a href="javascript:void(0)" class="add addr-modify color" data="{{ $v['address_id'] }}">
                                <i class="iconfont">&#xe623;</i>
                                <span>编辑</span>
                            </a>
                            <a href="javascript:void(0)" class="address-delete color" data-address_id={{ $v['address_id'] }} title="删除地址">
                                <i class="iconfont">&#xe61b;</i>
                                <span>删除</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @else
            <!--没有收货地址时 start-->
            <div class="no-data-div">
                <div class="no-data-img">
                    <img src="/images/bg_empty_data.png">
                </div>
                <dl>
                    <dt>暂无收货地址</dt>
                </dl>
            </div>
        @endif

        <div style="width: 100%; height: 45px"></div>
        <div class="list-footer">
            <a href="javascript:void(0)" class="add addr-add">添加新地址</a>
        </div>
        <!-- 地址容器 -->
        <div class="addressmone" id="edit-address-div"></div></div>
    <!-- 发票信息弹框 -->
    <!--发票弹出层-->
    <div id="invoice_coupon_box">
        <header>
            <div class="header">
                <div class="header-left">
                    <a class="sb-back" onclick="close_coupon_box();">
                        <i class="iconfont">&#xe606;</i>
                    </a>
                </div>
                <div class="header-middle">设置发票信息</div>
                <div class="header-right"></div>
            </div>
        </header>
        <!--发票弹出层-->
        <div class="invoice-coupon">
            <div class="invoice-type m-b-0 p-b-0">
                <div class="invoice-type-mt">发票类型</div>
                <div class="invoice-type-mc">
                    <div class="tab-nav">
                        <ul>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- 普通税发票 _star -->
        </div>
    </div>	<!-- 微信里支付宝弹出层 -->
    <div class="alipay-mark hide">
        <div class="alipay-share-con">
            <div class="box-tip">
                <div class="alipay-tip">
                    <p>点击右上角，</p>
                    <p>选择在浏览器打开</p>
                    <p>完成支付宝支付！</p>
                </div>
            </div>
            <div class="icon-logo"></div>
            <i class="alipay-star1"></i>
            <i class="alipay-star2"></i>
            <i class="alipay-star3"></i>
        </div>
        <div class="arrow-pointing"></div>
    </div>

    {{--引入右上角菜单--}}
    @include('layouts.partials.right_top_menu')

    <!-- 积分消息 -->
    <!-- 消息提醒 -->
    <script type="text/javascript">
        //
    </script>    
    <!-- 第三方流量统计 -->
    <div style="display: none;">
        
    </div>
    <script src="/assets/d2eace91/min/js/core.min.js"></script>
    <script src="/js/app.frontend.mobile.min.js"></script>
    <script src="/js/checkout.js"></script>
    <script src="/assets/d2eace91/min/js/validate.min.js"></script>
    <script src="/assets/d2eace91/min/js/message.min.js"></script>
    <script>
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