@extends('layouts.base')

{{--header_css--}}
@section('header_css')

@stop

{{--header_js--}}
@section('header_js')
    <script src="/assets/d2eace91/js/jquery.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/jquery.cookie.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20180919"></script>
    <script src="/js/common.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=20180919"></script>
    <!-- 图片缓载js -->
    <script src="/assets/d2eace91/js/jquery.lazyload.js?v=20180919"></script>
    <!-- 飞入购物车 -->
    <script src="/js/jquery.fly.min.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js?v=20180919"></script>
    <script type="text/javascript">
        $().ready(function() {


        })
    </script>
@stop



@section('content')

    <!-- 内容 -->
    <div id="index_content">
        <link rel="stylesheet" href="/css/exchange.css?v=20180927"/>
        <header>
            <div class="header">
                <div class="header-left">
                    <a class="sb-back" href="javascript:history.back(-1)" title="返回"></a>
                </div>
                <div class="header-middle">积分商城-红包兑换</div>
                <div class="header-right">
                    <aside class="show-menu-btn">
                        <div class="show-menu" id="show_more">
                            <a href="javascript:void(0)"></a>
                        </div>
                    </aside>
                </div>
            </div>
        </header>
        <div class="show-menu-info" id="menu">
            <ul>
                <li><a href="/"><span class="index-menu"></span><i>商城首页</i></a></li>
                <li><a href="/category.html"><span class="category-menu"></span><i>分类</i></a></li>
                <li><a href="/cart.html"><span class="cart-menu"></span><i>购物车</i></a></li>
                <li style=" border:0;"><a href="/user.html"><span class="user-menu"></span><i>我的</i></a></li>
            </ul>
        </div>
        <div class="hot-bonus hot-bonus-box">

            <div class="hot-bonus-list" id="table_list">

                <div class="hot-bonus-con tablelist-append">

                    <div class="item clearfix">
                        <div class="item-left">
                            <p class="price">
                                <strong class="num">￥50.00</strong>

                                <span class="txt">满399.00元可用</span>

                            </p>
                            <p class="row issuer">发行方：阿迪达斯旗舰店</p>
                            <p class="row">
                                限品类：



                                全店通用


                            </p>
                            <p class="row">发行数量：1000</p>
                            <p class="row">
                                <em>使用</em>
                                2018-04-17 ~ 2018-12-31 					</p>
                            <p class="row">
                                <em>兑换</em>
                                不限日期					</p>
                        </div>
                        <div class="item-right">
                            <b class="semi-circle"></b>
                            <div class="item-right-con">
                                <p class="exchange">
                                    <strong>500</strong>
                                    <em>积分</em>
                                </p>

                                <a href="javascript:void(0);" class="receive">
                                    <span class="txt bonus-exchange" data-id="8" data-points="500" data-shop_name="阿迪达斯旗舰店 ">立即兑换</span>
                                </a>

                                <p>已兑换1次</p>
                            </div>
                        </div>
                    </div>

                    <div class="item clearfix">
                        <div class="item-left">
                            <p class="price">
                                <strong class="num">￥10.00</strong>

                            </p>
                            <p class="row issuer">发行方：东和MRO平台</p>
                            <p class="row">
                                限品类：



                                全店通用


                            </p>
                            <p class="row">发行数量：10</p>
                            <p class="row">
                                <em>使用</em>
                                2017-06-29 ~ 2018-11-28 					</p>
                            <p class="row">
                                <em>兑换</em>
                                不限日期					</p>
                        </div>
                        <div class="item-right">
                            <b class="semi-circle"></b>
                            <div class="item-right-con">
                                <p class="exchange">
                                    <strong>100</strong>
                                    <em>积分</em>
                                </p>

                                <a href="javascript:void(0);" class="receive">
                                    <span class="txt bonus-exchange" data-id="2" data-points="100" data-shop_name="东和MRO平台 ">立即兑换</span>
                                </a>

                                <p>已兑换0次</p>
                            </div>
                        </div>
                    </div>

                    <div class="item clearfix">
                        <div class="item-left">
                            <p class="price">
                                <strong class="num">￥5.00</strong>

                            </p>
                            <p class="row issuer">发行方：东和MRO平台</p>
                            <p class="row">
                                限品类：



                                全店通用


                            </p>
                            <p class="row">发行数量：10</p>
                            <p class="row">
                                <em>使用</em>
                                2017-06-29 ~ 2018-11-28 					</p>
                            <p class="row">
                                <em>兑换</em>
                                不限日期					</p>
                        </div>
                        <div class="item-right">
                            <b class="semi-circle"></b>
                            <div class="item-right-con">
                                <p class="exchange">
                                    <strong>50</strong>
                                    <em>积分</em>
                                </p>

                                <a href="javascript:void(0);" class="receive">
                                    <span class="txt bonus-exchange" data-id="1" data-points="50" data-shop_name="东和MRO平台 ">立即兑换</span>
                                </a>

                                <p>已兑换0次</p>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- 分页 -->
                <!-- 分页 -->
                <div id="pagination" class="page">
                    <div class="more-loader-spinner">

                        <div class="is-loaded">
                            <div class="loaded-bg">我是有底线的</div>
                        </div>

                    </div>
                    <script data-page-json="true" type="text" id="page_json">
	{"page_key":"page","page_id":"pagination","default_page_size":10,"cur_page":1,"page_size":10,"page_size_list":[10,50,500,1000],"record_count":3,"page_count":1,"offset":0,"url":null,"sql":null}
	</script>
                </div>

            </div>

        </div>

        {{--引入底部菜单--}}
        @include('frontend.web_mobile.modules.library.site_footer_menu')

        <script src="/assets/d2eace91/js/szy.page.more.js?v=20180919"></script>
        <script type="text/javascript">
            $().ready(function() {
                tablelist = $("#table_list").tablelist();

                $("body").on("click", ".bonus-exchange", function() {
                    var id = $(this).data("id");
                    var points = $(this).data("points");
                    var current = $(this);
                    var shop_name = $(this).data("shop_name");
                    $.confirm("兑换此红包，将需要扣除您 " + shop_name + points + " 积分，您确定是否兑换？", function() {
                        $.ajax({
                            type: "POST",
                            url: "/integralmall/index/bonus-exchange",
                            dataType: "json",
                            data: {
                                id: id,
                            },
                            beforeSend: function() {
                                $.loading.start();
                            },
                            success: function(result) {
                                if (result.code == 0) {
                                    current.parent().next().html("已兑换" + result.send_number + "次");
                                }
                                $.msg(result.message);
                                $.loading.stop();
                            }
                        })
                    });
                });
            });
        </script>
        <script type="text/javascript">
            // 滚动加载数据
            $(window).on('scroll', function() {
                if (($(document).scrollTop() + $(window).height() + 10) > $(document).height()) {
                    $.pagemore();
                }
            });
        </script></div>
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
    <script type="text/javascript">
        $().ready(function(){
            // 缓载图片
            $.imgloading.loading();
        });
    </script>

@stop