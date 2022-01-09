@extends('layouts.base')

@section('header_css')
    <link rel="stylesheet" href="/frontend/css/compare.css?v=20180702"/>
@stop

@section('header_js')

@stop

{{--follow_box 注意此效果只在首页面展示--}}
@section('follow_box')

@stop

@section('style_js')
    <!--页面css/js-->

@stop

{{--不显示分类box--}}
@section('category_box')

@show

@section('content')

    <div class="w990">
        <div class="compare compare-nav">
            <div class="compare-content clearfix">
                <div class="compare-side">
                    <span class="compare-side-title">宝贝对比</span>
                </div>
                <ul class="compare-goods-list clearfix">
                    @foreach($list as $k=>$v)
                    <!---->
                    <!---->
                    <!-- 选择进行对比的商品 给Li标签追加 class 值为"active" _start-->
                    <li class="nav-item @if($k<=3){{ 'active' }}@endif">
                        <img src="{{ get_image_url($v['goods_image'],'goods_image') }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" alt="" title="" />
                        <span class="nav-sel"></span>
                        <input type="hidden" value="{{ $v['goods_id'] }}">
                    </li>
                    <!-- 选择进行对比的商品 给Li标签追加 class 值为"active" _end-->
                    <!---->
                    @endforeach
                    <!---->
                </ul>
            </div>
        </div>
        <!---->
        {{--引入列表--}}
        @include('compare.partials._compare_list')
        <!---->
    </div>
    <script type="text/javascript">
        var local_region_code = "53,01";
        var local_region_name = "云南省 昆明市";
    </script>
    <script src="/frontend/js/compare.js?v=20180027"></script>
    <script src="/frontend/js/tabs.js?v=20180027"></script>
    <script type="text/javascript">
        $("body").on("click", "a[class='cart-btn add-to-cart'],a[class='list-item-btn add-to-cart']", function() {
            var buy_enable = $(this).data("buy-enable");
            if(buy_enable){
                $.msg(buy_enable);
                return;
            }
            $.cart.add($(this).data("tip"), "1", {
                is_sku: false
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajax({
                type: 'GET',
                url: '/compare/freight?cid=' + local_region_code + '&ids={{ $ids }}',
                dataType: 'json',
                success: function(result) {
                    $("span[class='rmb-num freught']").each(function(index, eve) {
                        $(this).html(result.data[index]);
                    });
                    $(".distance").each(function(index, eve) {
                        $(this).children().html(local_region_name);
                    });
                }
            })

        });
    </script>
    <script type="text/javascript">
        function buy(goods_id) {

            $.get('/compare/in-cart?id=' + goods_id, function(results) {
                if (results.code == 0) {
                    $.cart.quickBuy(results.data, 1);
                    //$.go("/cart/quick-buy.html?sku_id=" + results.data + "&number=1","_blank");
                } else {
                    $.go("/goods-" + goods_id + ".html");
                }
            }, "json");

        }
    </script>
    <script type="text/javascript">
        $(".nav-item").click(function() {
            if ($("li[class='nav-item active']").length >= 3) {
                if ($(this).hasClass("active")) {
                    $(this).removeClass("active");
                } else {
                    $.msg("最多只能同时对比3个商品");
                    return;
                }
            } else {
                $(this).toggleClass("active");
            }
            var int = 0;
            var arr = new Array();
            $("li[class='nav-item active']").each(function() {
                arr[int] = $("li[class='nav-item active']").eq(int).children("input").val();
                int++;
            });
            var spread = $("li[class='list-row-item more-shop-info']").attr("style");

            $.ajax({
                type: 'GET',
                url: '/user/compare.html?type=1&ids=' + arr,
                dataType: 'json',
                success: function(result) {
                    $("#compare").html(result.data);
                    $.ajax({
                        type: 'GET',
                        url: '/compare/freight?cid=' + local_region_code + '&ids=' + arr,
                        dataType: 'json',
                        success: function(result) {
                            $("span[class='rmb-num freught']").each(function(index, eve) {

                                $(this).html(result.data[index]);
                                if (spread == "display: list-item;") {
                                    $('.more-shop-info').attr("style", "display: list-item;");
                                }

                            });
                            $(".distance").each(function(index, eve) {
                                $(this).children().html(returnCitySN.cname);
                            });
                        }
                    })
                }
            })
        });
    </script>
    <script type="text/javascript">
        $("body").on("click", "a[class='del btn-del-sku'],a[class='list-item-btn list-item-del']", function() {
            var c_id = $(this).next().val()
            var int = 0;
            var arr = new Array();
            $.confirm("确定要移出该宝贝吗？", function(s) {
                if (s) {
                    $("li[class='nav-item active']").each(function() {
                        var id = $("li[class='nav-item active']").eq(int).children("input").val();

                        if (id == c_id) {
                            $(this).remove();
                        } else {
                            arr[int] = $("li[class='nav-item active']").eq(int).children("input").val();
                            int++;
                        }
                    });
                    $.ajax({
                        type: 'GET',
                        url: '/compare?type=1&ids=' + arr,
                        dataType: 'json',
                        success: function(result) {
                            $("#compare").html(result.data);
                            $.ajax({
                                type: 'GET',
                                url: '/compare/freight?cid=' + local_region_code + '&ids=' + arr,
                                dataType: 'json',
                                success: function(result) {
                                    $("span[class='rmb-num freught']").each(function(index, eve) {
                                        $(this).html(result.data[index]);
                                    });
                                    $(".distance").each(function(index, eve) {
                                        $(this).children().html(returnCitySN.cname);
                                    });
                                }
                            })
                        }
                    })
                }
            })
        });
    </script>

@stop

@section('footer_js')
    <script src="/frontend/js/jquery.fly.min.js?v=20180027"></script>
    <script src="/assets/d2eace91/js/szy.cart.js?v=20180027"></script>
    <!--[if lte IE 9]>
    <script src="/frontend/js/requestAnimationFrame.js?v=20180027"></script>
    <![endif]-->
    <script type="text/javascript">
        $().ready(function(){
            // 缓载图片
            $.imgloading.loading();
        });
    </script>
@stop