@extends('layouts.user_layout')

{{--header_css--}}
@section('header_css')
    <link rel="stylesheet" href="/css/user.css?v=20180702"/>
@stop

{{--header_js--}}
@section('header_js')

@stop



@section('content')

    <div>
        <header>
            <div class="header">
                <div class="header-left">
                    <a class="sb-back" href="/user.html" title="返回"></a>
                </div>
                <div class="header-middle">收货地址管理</div>
                <div class="header-right">
                    <aside class="show-menu-btn">
                        <div id="show_more" class="show-menu">
                            <a href="javascript:;"></a>
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
        var tablelist = null;
        $().ready(function() {
            tablelist = $("#table_list").tablelist();
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