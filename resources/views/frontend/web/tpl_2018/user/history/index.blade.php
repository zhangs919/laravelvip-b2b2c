@extends('layouts.user_layout')

{{--header_js--}}
@section('header_js')

@stop

@section('content')

    <!-- 正文，由view提供 -->
    <div class="con-right fr"><!---->
        <div class="con-right fr">
            <div class="con-right-text">
                <div class="tabmenu">
                    <ul class="tab">
                        <li class="active">我的足迹</li>
                    </ul>
                </div>
                <div class="content-info">
                    <div class="history-list ">
                        <div class="classify-choose ">
                            {{--引入商品分类tab列表--}}
                            @include('user.history.partials._cat_tab')
                        </div>
                        <!-- 全部商品列表 _start -->
                        <div id="fav-list">
                            <!---->
                            {{--引入列表--}}
                            @include('user.history.partials._list')
                            <!---->
                        </div>
                        <!-- 全部商品列表 _end -->
                    </div>
                </div>
            </div>
        </div>
        <script src="/assets/d2eace91/js/szy.cart.js?v=20180027"></script>
        <script type="text/javascript">
            $("body").on("click", ".add-cat-btn", function() {
                var this_target = $(this);
                $.cart.add(this_target.data("tip"), "1", {
                    is_sku: false
                });
            })
        </script>
        <script type="text/javascript">
            $("body").on("click", ".classify-choose a", function() {
                layer.load();
                var this_target = $(this);
                var arr = $(this).next().attr("value");
                $.ajax({
                    type: 'GET',
                    url: '/user/history.html?id=' + arr,
                    dataType: 'json',
                    success: function(result) {
                        if (result.code == 0) {
                            $("#fav-list").html(result.data);
                            $(".classify-choose li").each(function() {
                                $(this).removeClass("current fav-item-hover");
                                this_target.parents().addClass("current");
                            })
                        }
                        layer.closeAll("loading");
                    }
                })
            })
        </script>
        <script type="text/javascript">
            $("body").on("click", ".del-btn", function() {
                layer.load();
                var this_target = $(this);
                var selected;
                var arr;
                $(".classify-choose li").each(function() {
                    if ($(this).hasClass("current")) {
                        selected = $(this).data("tip");
                        arr = $(this).children().next().attr("value");
                    }
                })
                $.get('/user/history/del?id=' + this_target.data("tip") + '&ids=' + arr, function(result) {
                    $.msg(result.message);
                    if (result.code == 0) {
                        $("#tab_list").html(result.data);
                        $(".classify-choose").html(result.tab);
                        $(".classify-choose li").each(function() {
                            $(this).removeClass("current fav-item-hover");
                            $("#tab_0").addClass("current");
                        })
                    } else if (result.code == 1) {
                        $("#tab_list").html(result.data);
                        $(".classify-choose").html(result.tab);
                        $(".classify-choose li").each(function() {
                            $(this).removeClass("current fav-item-hover");
                            $("#tab_" + selected).addClass("current");
                        })
                    }
                    layer.closeAll("loading");
                }, "json");
            })
        </script>
    </div>

@endsection