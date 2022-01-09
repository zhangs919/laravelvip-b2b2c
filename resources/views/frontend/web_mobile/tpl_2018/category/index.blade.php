@extends('layouts.base')

{{--header_css--}}
@section('header_css')

@stop

{{--header_js--}}
@section('header_js')
    <script src="/assets/d2eace91/js/jquery.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/jquery.cookie.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20180813"></script>
    <script src="/mobile/js/common.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=20180813"></script>
    <!-- 图片缓载js -->
    <script src="/assets/d2eace91/js/jquery.lazyload.js?v=20180813"></script>
    <!-- 飞入购物车 -->
    <script src="/mobile/js/jquery.fly.min.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js?v=20180813"></script>
    <script type="text/javascript">
        $().ready(function() {


        })
    </script>
@stop



@section('content')

    <!-- 内容 -->
    <div id="index_content"><!-- 默认缓载图片 -->
        <link rel="stylesheet" href="/mobile/css/catalog.css?v=20180702"/>
        <script src="/mobile/js/category.js?v=20180813"></script>
        <script src="/mobile/js/szy_rotate.js?v=20180813"></script>
        <section id="catalog_content">
            <header class="header" style="position: fixed; top: 0">
                <div class="header-left">
                    <a class="sb-back" href="javascript:history.back(-1)" title="返回"></a>
                </div>
                <div class="header-middle">
                    <div class="search-box">
                        <input id="search_text" class="text" placeholder="请输入商品名称" />
                        <i class="submit"></i>
                    </div>
                </div>
                <div class="header-right">
                    <aside class="show-menu-btn">
                        <div class="show-menu" id="show_more">
                            <a href="javascript:void(0)"></a>
                        </div>
                    </aside>
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
            <div class="container">
                <div class="category-box">
                    <div class="category-left" style="outline: none;" tabindex="5000">
                        <ul class="clearfix">

                            @foreach($list as $k=>$v)
                            <li class="@if($cat_id == $v['cat_id']) cur @endif" data-cat_id="{{ $v['cat_id'] }}" data-cat_link="{{ $v['cat_link'] }}">
                                <span>{{ $v['cat_name'] }}</span>
                            </li>
                            @endforeach

                        </ul>
                    </div>

                    <div class="category-right" style="outline: none; overflow-y: scroll" tabindex="5001">

                        @foreach($list as $v)
                        <dl id="cat_chr_{{ $v['cat_id'] }}" style="display: none;">

                            <span>
                                <a href="{{ route('mobile_goods_list', ['cat_id'=>$v['cat_id']]) }}">
                                    <img alt="{{ $v['cat_name'] }}" src="{{ get_image_url($v['cat_image']) }}">
                                </a>
                            </span>

                            <a href="{{ route('mobile_goods_list', ['cat_id'=>$v['cat_id']]) }}" class="all bg-color">进入{{ $v['cat_name'] }}频道&nbsp;&gt;&nbsp;&gt;</a>

                            @if(!empty($v['items']))
                            @foreach($v['items'] as $vv)
                                <dt>
                                    <a href="{{ route('mobile_goods_list', ['cat_id'=>$vv['cat_id']]) }}">  {{ $vv['cat_name'] }}  </a>
                                </dt>
                                @if(!empty($vv['items']))
                                    <dd>
                                    <div class="catalog-box">

                                        @foreach($vv['items'] as $vvv)
                                        <div class="catalog-info">
                                            <a class="catalog-info-link" href="{{ route('mobile_goods_list', ['cat_id'=>$vvv['cat_id']]) }}" style="background: url('/mobile/images/no_image.png') no-repeat center center; background-size: 55px;">
                                                <img class="lazy" src="/assets/d2eace91/images/common/blank.png" data-original="{{ get_image_url($vvv['cat_image']) }}" data-original-webp="{{ get_image_url($vvv['cat_image']) }}?x-oss-process=image/format,webp/quality,q_75" alt=" {{ $vvv['cat_name'] }} " />
                                            </a>
                                            <a href="{{ route('mobile_goods_list', ['cat_id'=>$vvv['cat_id']]) }}"><em> {{ $vvv['cat_name'] }} </em></a>
                                        </div>
                                        @endforeach

                                    </div>
                                </dd>
                                @endif
                            @endforeach
                            @endif

                            <div class="blank-div"></div>
                        </dl>
                        @endforeach

                    </div>

                </div>
            </div>

            {{--引入底部菜单--}}
            @include('frontend.web_mobile.modules.library.site_footer_menu')
            
        </section>
        <section id="search_content">
            <div class="search-header">
                <div class="search-left">
                    <a href="javascript:void(0)" class="sb-back" title="返回"></a>
                </div>
                <div class="search-middle">
                    <div class="search-info">
                        <div class="search-type">
                            <div class="search-type-txt">商品</div>
                            <div class="search-type-info">
                                <ul class="search-type-ul">
                                    <li id="select_goods">
                                        <i class="iconfont">&#xe63f;</i>
                                        商品
                                    </li>
                                    <li id="select_shop">
                                        <i class="iconfont">&#xe601;</i>
                                        店铺
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="text-box">
                            <form id="headerSearchForm" method="get" name="" action="/search.html" onSubmit="">
                                <input type='hidden' name='type' id="searchtype" value="">
                                <input type="text" class="text" id="keyword" name="keyword" tabindex="9" autocomplete="off" data-searchwords="榨汁机" data-placeholder="榨出营养,喝出健康" placeholder="榨出营养,喝出健康" value="">
                                <a href="javascript:void(0)" class="submit"></a>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="search-right">
                    <a href="javascript:void(0)" class="clear_input submit" style="display: block;">搜索</a>
                </div>
            </div>
            <div class="search-con">
                <div id="search_goods">
                    <section class="hot-search">
                        <h3>
                            历史记录
                            <i class="delete-btn iconfont" id="clear">&#xe61b;</i>
                        </h3>
                        <ul class="history-results SZY-SEARCH-RECORD">
                        </ul>
                    </section>
                </div>

                <!---热门搜索热搜词显示--->
                <section class="recently-search">
                    <h3>热门搜索</h3>

                    <ul>

                        <li>
                            <a href="search.html?keyword=电视" title="电视">电视</a>
                        </li>

                        <li>
                            <a href="search.html?keyword=酒水" title="酒水">酒水</a>
                        </li>

                        <li>
                            <a href="search.html?keyword=茶叶" title="茶叶">茶叶</a>
                        </li>

                        <li>
                            <a href="search.html?keyword=榨汁机" title="榨汁机">榨汁机</a>
                        </li>

                        <li>
                            <a href="search.html?keyword=手机" title="手机">手机</a>
                        </li>

                        <li>
                            <a href="search.html?keyword=抽油烟机" title="抽油烟机">抽油烟机</a>
                        </li>

                        <li>
                            <a href="search.html?keyword=面条" title="面条">面条</a>
                        </li>

                        <li>
                            <a href="search.html?keyword=冰箱" title="冰箱">冰箱</a>
                        </li>

                        <li>
                            <a href="search.html?keyword=零食" title="零食">零食</a>
                        </li>

                        <li>
                            <a href="search.html?keyword=礼盒" title="礼盒">礼盒</a>
                        </li>

                    </ul>

                </section>

            </div>
            <a class="colse-search-btn" href="javascript:void(0)"></a>
        </section>
        <script type="text/javascript">
            $(document).ready(function() {
                $(".submit").click(function() {
                    if ($("#searchtype").val() == '') {
                        var keywords = $("#headerSearchForm").find("#keyword").val();
                        if ($.trim(keywords).length == 0 || $.trim(keywords) == "请输入关键词") {
                            keywords = $("#headerSearchForm").find("#keyword").data("searchwords");
                        }
                        $("#headerSearchForm").find("#keyword").val(keywords);
                    } else {
                        var keywords = $("#headerSearchForm").find("#keyword").val();
                        if ($.trim(keywords).length == 0 || $.trim(keywords) == "请输入关键词") {
                            $("#headerSearchForm").find("#keyword").val('');
                        }
                    }
                    $("#headerSearchForm").submit();
                });

                //搜索记录
                $.get('/index/information/search-record', function(result) {
                    var sr = '';
                    $.each($(result.data), function(index, val) {
                        if (val != '') {
                            sr += '<li><a href="/search?keyword=' + val + '">' + val + '</a></li>';
                        }
                    });
                    if (sr != '') {
                        $('#search_goods').show();
                        $('.SZY-SEARCH-RECORD').html(sr);
                    } else {
                        $('#search_goods').hide();
                    }
                }, 'json');

                //清空
                $('#clear').click(function() {
                    var url = '/search/clear-record.html';
                    $.confirm("您确认删除所有的历史记录？", function() {
                        $.post(url, {}, function(result) {
                            if (result.code == 0) {
                                $(".history-results").empty();
                                $('#search_goods').hide();
                            }
                        }, 'json');
                    });
                });

                $('.search-type-txt').click(function() {
                    $('.search-type-info').toggle();
                });
                $('#select_goods').on('click', function() {
                    if ($('#searchtype').val() != '') {
                        $("input[name='keyword']").val('');
                        $("input[name='keyword']").attr('placeholder', $("input[name='keyword']").data('placeholder'));
                    }
                    $('#searchtype').val('');
                    $('.search-type-txt').html("商品");
                    $('.search-type-info').hide();
                    $("input[name='keyword']").focus();
                });
                $('#select_shop').on('click', function() {
                    if ($('#searchtype').val() != '1') {
                        $("input[name='keyword']").val('');
                        $("input[name='keyword']").attr('placeholder', '');
                    }
                    $('#searchtype').val('1');
                    $('.search-type-txt').html("店铺");
                    $('.search-type-info').hide();
                    $("input[name='keyword']").focus();
                });
            });
        </script>
        <script>
            $('.search-box').click(function() {
                $('#search_content').addClass("show");
                $('#catalog_content').hide();
                $("input[name='keyword']").focus();
            });
            $('.sb-back').click(function() {
                $('#search_content').removeClass('show');
                $('#catalog_content').show();
                $("input[name='keyword']").blur();
            });
            $('.colse-search-btn').click(function() {
                $('#search_content').removeClass('show');
                $('#catalog_content').show();
                $("input[name='keyword']").blur();
            });
            $().ready(function() {
                // 缓载图片
                $.imgloading.loading();
            });
        </script>
    </div>
    <div class="show-menu-info" id="menu">
        <ul>
            <li><a href="/"><span class="index-menu"></span><i>商城首页</i></a></li>
            <li><a href="/category.html"><span class="category-menu"></span><i>分类</i></a></li>
            <li><a href="/cart.html"><span class="cart-menu"></span><i>购物车</i></a></li>
            <li style=" border:0;"><a href="/user.html"><span class="user-menu"></span><i>我的</i></a></li>
        </ul>
    </div>

    <!-- 第三方流量统计 -->
    <div style="display: none;">
        {{--第三方统计代码--}}
        {!! sysconf('stats_code_wap') !!}
    </div>
    <!-- 底部 _end-->
    <script type="text/javascript">
        $().ready(function(){
            // 缓载图片
            $.imgloading.loading();
        });
    </script>
@stop