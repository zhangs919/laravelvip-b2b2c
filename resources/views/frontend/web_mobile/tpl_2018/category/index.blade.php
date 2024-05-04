@extends('layouts.base')

{{--header_css--}}
@section('header_css')
    <link href="/css/catalog.css" rel="stylesheet">
@stop

{{--header_js--}}
@section('header_js')

@stop



@section('content')
    <!-- 内容 -->
    <div id="index_content"><!-- 默认缓载图片 -->
        <section id="catalog_content">
            <header class="header-search-con header-search-fixed">
                <div class="header-search-left">
                    <a class="sb-back  iconfont icon-fanhui1" href="javascript:history.back(-1)" title="返回"></a>
                </div>
                <div class="header-search-middle">
                    <div class="search-box">
                        <input id="search_text" class="text" placeholder="请输入商品名称" />
                        <i class="submit"></i>
                    </div>
                </div>
                <div class="header-search-right">
                    <!-- 控制展示更多按钮 -->
                    <aside class="show-menu-btn">
                        <div class="show-menu iconfont icon-gengduo3" id="show_more"></div>
                    </aside>
                </div>
            </header>
            {{--引入右上角菜单--}}
            @include('layouts.partials.right_top_menu')

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
                                <a href="/list-{{ $v['cat_id'] }}.html">
                                    <img alt="{{ $v['cat_name'] }}" src="{{ get_image_url($v['cat_image']) }}">
                                </a>
                            </span>

                                <a href="/list-{{ $v['cat_id'] }}.html" class="all bg-color">进入{{ $v['cat_name'] }}频道&nbsp;&gt;&nbsp;&gt;</a>

                                @if(!empty($v['items']))
                                    @foreach($v['items'] as $vv)
                                        <dt>
                                            <a href="/list-{{ $vv['cat_id'] }}.html">  {{ $vv['cat_name'] }}  </a>
                                        </dt>
                                        @if(!empty($vv['items']))
                                            <dd>
                                                <div class="catalog-box">

                                                    @foreach($vv['items'] as $vvv)
                                                        <div class="catalog-info">
                                                            <a class="catalog-info-link" href="/list-{{ $vvv['cat_id'] }}.html" style="background: url('/images/no_image.png') no-repeat center center; background-size: 55px;">
                                                                <img class="lazy" src="/assets/d2eace91/images/common/blank.png" data-original="{{ get_image_url($vvv['cat_image']) }}" data-original-webp="{{ get_image_url($vvv['cat_image']) }}?x-oss-process=image/format,webp/quality,q_75" alt=" {{ $vvv['cat_name'] }} " />
                                                            </a>
                                                            <a href="/list-{{ $vvv['cat_id'] }}.html"><em> {{ $vvv['cat_name'] }} </em></a>
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
            <!--底部菜单 start-->
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
                                <input type="text" class="text" id="keyword" name="keyword" tabindex="9" autocomplete="off" data-searchwords="雀巢" data-placeholder="雀巢超级品牌日" placeholder="雀巢超级品牌日" value="">
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
                            <a href="search.html?keyword=全身镜" title="全身镜">全身镜</a>
                        </li>
                        <li>
                            <a href="search.html?keyword=躺椅折叠午休" title="躺椅折叠午休">躺椅折叠午休</a>
                        </li>
                        <li>
                            <a href="search.html?keyword=榨汁机" title="榨汁机">榨汁机</a>
                        </li>
                        <li>
                            <a href="search.html?keyword=科11" title="科11">科11</a>
                        </li>
                        <li>
                            <a href="search.html?keyword=凉鞋" title="凉鞋">凉鞋</a>
                        </li>
                        <li>
                            <a href="search.html?keyword=雀巢" title="雀巢">雀巢</a>
                        </li>
                        <li>
                            <a href="search.html?keyword=连衣裙" title="连衣裙">连衣裙</a>
                        </li>
                        <li>
                            <a href="search.html?keyword=洁面乳" title="洁面乳">洁面乳</a>
                        </li>
                        <li>
                            <a href="search.html?keyword=彩妆" title="彩妆">彩妆</a>
                        </li>
                    </ul>
                </section>
            </div>
            <a class="colse-search-btn" href="javascript:void(0)"></a>
        </section>
        <script type="text/javascript">
            // 
        </script><script type="text/javascript">
            // 
        </script>
    </div>

    {{--引入右上角菜单--}}
    @include('layouts.partials.right_top_menu')

    <!-- 底部 _end-->
    <script type="text/javascript">
        // 
    </script>
    <!-- 积分提醒 -->
    <!-- 消息提醒 -->
    <script type="text/javascript">
        // 
    </script>    
    <!-- 第三方流量统计 -->
    <div style="display: none;">
        {{--第三方统计代码--}}
        {!! sysconf('stats_code_wap') !!}
    </div>
    <script src="/assets/d2eace91/min/js/core.min.js"></script>
    <script src="/assets/d2eace91/js/swiper/swiper.jquery.min.js"></script>
    <script src="/js/app.frontend.mobile.min.js"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js"></script>
    <script src="/js/category.js"></script>
    <script src="/js/szy_rotate.js"></script>
    <script src="/assets/d2eace91/min/js/message.min.js"></script>
    <script>
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
        // 
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
        // 弹出菜单
        var menu1 = $('#menu');
        $('body').on('click', '.header-right', function(e) {
            if (e.stopPropagation) {
                e.stopPropagation();
            } else {
                e.cancelBubble = true;
            }
            var bd_top = $(document).scrollTop();
            if (menu1.css('opacity') == '0') {
                menu1.addClass('show');
            } else {
                menu1.removeClass('show');
            }
        });
        $.imgloading.setting({
            skip_invisible: true
        });
        // 
        $().ready(function() {
            // 缓载图片
            $.imgloading.loading();
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