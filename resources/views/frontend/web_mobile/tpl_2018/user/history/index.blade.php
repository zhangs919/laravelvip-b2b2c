@extends('layouts.user_layout')

{{--header_css--}}
@section('header_css')
    <link rel="stylesheet" href="/css/user.css?v=20190215"/>
@stop

{{--header_js--}}
@section('header_js')

@stop

@section('content')

    <header>
        <div class="header">
            <div class="header-left">
                <a class="sb-back" href="/user.html" title="返回"></a>
            </div>
            <div class="header-middle">我的足迹</div>

            <div class="header-right">

                <a class="goods_edit_btn text" href="javascript:void(0);">编辑</a>

            </div>

        </div>
    </header>
    <div class="collect-goods-box history-goods-box">

        @if(!empty($list))
            <ul class="collect-goods-list" id="table_list">
                <div class="tablelist-append">

                    @foreach($list as $v)
                    <li class="goods-item" id="goods_item_{{ $v['goods_id'] }}">
                        <lable class="agree-checkbox" data-id="{{ $v['goods_id'] }}"></lable>
                        <a href="{{ route('mobile_show_goods', ['goods_id' => $v['goods_id']]) }}" class="goods-link">
                            <div class="good-pic">
                                <img src="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" alt="{{ $v['goods_name'] }}">
                            </div>
                            <!-- 如果是下架的商品就给下面的div追加class="good-info-nosale" -->
                            <dl class="good-info bdr-bottom ">
                                <dt class="good-name">{{ $v['goods_name'] }}</dt>
                                <!---->
                                <dd class="good-sale">
                                <span class="good-price price-color">
                                    <em>￥{{ $v['goods_price'] }}</em>
                                </span>
                                </dd>

                            </dl>
                        </a>
                    </li>
                    @endforeach

                </div>
                <div class="page">
                    <div class="more-loader-spinner">
                        <div class="is-loaded">
                            <div class="loaded-bg">我是有底线的</div>
                        </div>
                    </div>
                </div>
            </ul>
        @else
            <div class="no-data-div">
                <div class="no-data-img">
                    <img src="/images/bg_empty_data.png">
                </div>
                <dl>
                    <dt>居然空空如也</dt>
                    <dd>您还没有浏览过商品哦~</dd>
                </dl>
                <a href="/" class="no-data-btn">逛一逛</a>
            </div>
        @endif


        <div class="blank-div-footer"></div>
        <div class="colect-goods-footer">
            <!--全选后给goods-check-all增加select样式-->
            <lable class="goods-check-all"></lable>
            <span class="goods-seleted">
			已选择
			<em class="color">0</em>
			个商品
		</span>
            <a class="goods-delete bg-color" href="javascript:void(0)">删除</a>
        </div>
    </div>

    <script type='text/javascript'>
        $(function() {
            $('.goods-delete').click(function() {
                var ids = new Array();
                var int = 0;
                $(".collect-goods-box .agree-checkbox").each(function() {
                    if ($(this).hasClass('checked')) {
                        ids[int] = $(this).data('id');
                        int++;
                    }
                });

                if (int > 0) {
                    $.confirm("是否删除选定内容？", function(s) {
                        if (s) {
                            $.loading.start();

                            $.post('/user/history/del', {
                                id: ids
                            }, function(result) {
                                if (result.code != 2) {
                                    $.each(ids, function(i, v) {
                                        $('#goods_item_' + v).remove();
                                    });
                                    if($('.goods-item').length==0){
                                        window.location.reload();
                                    }
                                    else{
                                        $('.goods_edit_btn').html('完成');
                                        $('.colect-goods-footer').show();
                                        $(".blank-div-footer").show();
                                        $('.agree-checkbox').show();
                                        $('.goods-seleted').find('em').text(0);
                                        $('.goods-check-all').removeClass('select');
                                    }

                                }
                                $.msg(result.message);

                            }, 'JSON');
                        }
                    });
                } else {
                    $.msg("亲,请先选择要删除的记录");
                }
            });

            $('.goods-check-all').click(function() {
                var i = 0;
                if ($(this).hasClass('select')) {
                    $(this).removeClass('select');
                    $(".collect-goods-box .agree-checkbox").each(function() {
                        $(this).removeClass('checked');
                    });
                    $('.goods-seleted').find('em').text(i);
                } else {
                    $(this).addClass('select');
                    $(".collect-goods-box .agree-checkbox").each(function() {
                        $(this).addClass('checked');
                        i++;
                    });
                    $('.goods-seleted').find('em').text(i);
                }
            });

        });
    </script>
    <script type="text/javascript">
        var tablelist = null;
        $().ready(function() {
            tablelist = $("#table_list").tablelist({
                params: $("#searchForm").serializeJson()
            });

            $("#searchForm").submit(function() {
                // 序列化表单为JSON对象
                var data = $(this).serializeJson();
                // Ajax加载数据
                tablelist.load(data);
                // 阻止表单提交
                return false;
            });

        });
    </script>

    <script type="text/javascript">
        $().ready(function() {
        })
    </script>
    <script src="/js/jquery.fly.min.js?v=20190121"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js?v=20190121"></script>

    <div class="show-menu-info" id="menu">
        <ul>
            <li><a href="/"><span class="index-menu"></span><i>商城首页</i></a></li>
            <li><a href="/category.html"><span class="category-menu"></span><i>分类</i></a></li>
            <li><a href="/cart.html"><span class="cart-menu"></span><i>购物车</i></a></li>
            <li style=" border:0;"><a href="/user.html"><span class="user-menu"></span><i>我的</i></a></li>
        </ul>
    </div>	<!-- 第三方流量统计 -->
    <div style="display: none;"></div>
    <!-- 底部 _end-->

@stop