@extends('layouts.base')

@section('header_css')
    <link href="/css/category.css" rel="stylesheet">
@stop

{{--follow_box 注意此效果只在首页面展示--}}
@section('follow_box')

@stop


@section('content')

    <!-- 内容 -->

    <!---------------------以上为公共内容顶部及头部导航---------------------------->
    <div class="w1210">
        <!--当前位置，面包屑-->
        <div class="breadcrumb clearfix">
            <a href="javascript:;" class="index">全部结果</a>
            <span class="crumbs-arrow">&gt;</span>
            <span class="last">{{ $keyword }}</span>
        </div>

        <div class="content-wrap category-wrap clearfix">
            <!--左侧内容-->
            <div class="aside" >
                <span class="slide-aside" ></span>
                <div class="aside-inner">
                    <!--新品推荐-->

                    @include('frontend.web.tpl_2018.goods.partials.new_goods')

                    <!--销量排行榜-->

                    @include('frontend.web.tpl_2018.goods.partials.sale_rank_goods')

                </div>
            </div>
            <!--右侧内容-->
            <div class="main "  >
                <div class="" id="filter">
                    <!--排序-->
                    <form method="GET" name="listform" action="category.php">
                        <div class="fore1">
                            <dl class="order">

                                <dd class="first curr">
                                    <a href="search.html?keyword={{ $keyword }}">
                                        综合

                                    </a>
                                </dd>

                                <dd class="">
                                    <a href="search.html?sort=1&amp;order=DESC&amp;keyword={{ $keyword }}">
                                        销量

                                        <i class="iconfont icon-DESC"></i>

                                    </a>
                                </dd>

                                <dd class="">
                                    <a href="search.html?sort=2&amp;order=DESC&amp;keyword={{ $keyword }}">
                                        新品

                                        <i class="iconfont icon-DESC"></i>

                                    </a>
                                </dd>

                                <dd class="">
                                    <a href="search.html?sort=3&amp;order=DESC&amp;keyword={{ $keyword }}">
                                        评论

                                        <i class="iconfont icon-DESC"></i>

                                    </a>
                                </dd>

                                <dd class="">
                                    <a href="search.html?sort=4&amp;order=DESC&amp;keyword={{ $keyword }}">
                                        价格

                                        <i class="iconfont icon-DESC"></i>

                                    </a>
                                </dd>

                                <dd class="">
                                    <a href="search.html?sort=5&amp;order=DESC&amp;keyword={{ $keyword }}">
                                        人气

                                        <i class="iconfont icon-DESC"></i>

                                    </a>
                                </dd>

                            </dl>
							@if($page_array['page_count'] > 0)
								<div class="pagin">
									<a class="prev @if($page_array['cur_page'] == 1) disabled @else prev-page @endif">
										<span class="icon @if($page_array['cur_page'] == 1) prev-disabled @else prev-btn @endif"></span>
									</a>
									<span class="text">
										<font class="color">{{ $page_array['cur_page'] }}</font>
										/
										{{ $page_array['page_count'] }}
									</span>
									<a class="next @if($page_array['cur_page'] == $page_array['page_count']) disabled @else next-page @endif" data-go-page="2" href="javascript:;">
										<span class="icon @if($page_array['cur_page'] == $page_array['page_count']) next-disabled @else next-btn @endif"></span>
									</a>
								</div>
								<div class="total">
									共
									<span class="color">{{ $total }}</span>
									个商品
								</div>
							@endif
                        </div>
                        <div class="fore2">
                            <div class="filter-btn">
                                <span class="distribution">配送至</span>
                                <div class="region-chooser-container" style="z-index: 3"></div>
                                <!-- 选中的筛选条件给 a 标签追加类名 即  class="filter-tag curr" _star-->

                                <!-- <a href="search.html?is_self=1&amp;keyword=1" class="filter-tag "> -->
                                <a href="search.html?is_self=1&amp;keyword={{ $keyword }}" class="filter-tag ">
                                    <input class="none" name="fff" onclick="" type="checkbox">
                                    <i class="iconfont">&#xe715;</i>
                                    <span class="text">平台自营</span>
                                </a>

                                <!-- <a href="search.html?is_free=1&amp;keyword=1" class="filter-tag "> -->
                                <a href="search.html?is_free=1&amp;keyword={{ $keyword }}" class="filter-tag ">
                                    <input class="none" name="fff" onclick="" type="checkbox">
                                    <i class="iconfont">&#xe715;</i>
                                    <span class="text">包邮</span>
                                </a>

                                <!-- <a href="search.html?is_cash=1&amp;keyword=1" class="filter-tag "> -->
                                <a href="search.html?is_cash=1&amp;keyword={{ $keyword }}" class="filter-tag ">
                                    <input class="none" name="fff" onclick="" type="checkbox">
                                    <i class="iconfont">&#xe715;</i>
                                    <span class="text">支持货到付款</span>
                                </a>

                                <!-- <a href="search.html?is_stock=1&amp;keyword=1" class="filter-tag "> -->
                                <a href="search.html?is_stock=1&amp;keyword={{ $keyword }}" class="filter-tag ">
                                    <input class="none" name="fff" onclick="" type="checkbox">
                                    <i class="iconfont">&#xe715;</i>
                                    <span class="text">仅显示有货</span>
                                </a>

                            </div>
                            <div class="filter-mod">
                                <!--选中样式为a标签添加curr样式-->

                                <a href="search.html?keyword={{ $keyword }}" title="大图模式" class="filter-type filter-type-grid @if($params['style'] == 'grid') curr @endif">
                                    <i class="iconfont icon-grid"></i>
                                </a>

                                <a href="search.html?style=list&amp;keyword={{ $keyword }}" title="列表模式" class="filter-type filter-type-list @if($params['style'] == 'list') curr @endif">
                                    <i class="iconfont icon-list"></i>
                                </a>

                            </div>
                        </div>
                    </form>
                </div>
                <!--主体商品内容展示-->

                <form name="compareForm" action="compare.php" method="post" onsubmit="" id="table_list">
                    @include('frontend.web.tpl_2018.goods.partials.goods_list')
                </form>

                <!--对比栏-->
            </div>
        </div>
        <!--历史记录和猜你喜欢-->

        <div class="browse-history">
            <div class="browse-history-tab clearfix">
                <!--当前选中color-->
                <span class="tab-span color">猜您喜欢</span>
                <span class="tab-span">浏览历史</span>
                <div class="browse-history-line bg-color"></div>
                <div class="browse-history-other">
                    <a href="javascript:change_like()" class="history-recommend-change">
                        <i class="iconfont">&#xe6c0;</i>
                        <em class="text">换一批</em>
                    </a>
                    <a href="javascript:;" class="clear_history none">
                        <i class="iconfont">&#xe78d;</i>
                        <em id="del-history" class="text">清空</em>
                    </a>
                </div>
            </div>


            <div class="browse-history-con">
                <div class="browse-history-inner">
                    <!--猜您喜欢-->
                    <ul id="user_like" class="recommend-panel">
                        <input type="hidden" id="user_like_page" value="" />
                    </ul>
                    <!--浏览历史-->
                    @include('frontend.web.tpl_2018.goods.partials.history_goods')


                </div>
            </div>
        </div>
        <script type="text/javascript">
            //
        </script>

    </div>
    <!-- 选中当前分类弹出同级分类JS -->
    <script type="text/javascript">
        //
    </script>
    <script type="text/javascript">
       //
    </script>
    <!-- 暂时去掉 滚动条定位功能
<script type="text/javascript">
//
</script> -->
    <!--[if lte IE 9]>
    <![endif]-->
    <!-- 飞入购物车js _end -->

@stop

{{--底部js--}}
@section('footer_js')
    <script src="/js/index.js"></script>
    <script src="/js/tabs.js"></script>
    <script src="/js/bubbleup.js"></script>
    <script src="/js/jquery.hiSlider.js"></script>
    <script src="/js/index_tab.js"></script>
    <script src="/js/jump.js"></script>
    <script src="/js/nav.js"></script>
    <script src="/assets/d2eace91/js/jquery.cookie.js"></script>
    <script src="/assets/d2eace91/js/layer/layer.js"></script>
    <script src="/assets/d2eace91/js/jquery.method.js"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js"></script>
    <script src="/assets/d2eace91/js/jquery.lazyload.js"></script>
    <script src="/js/jquery.fly.min.js"></script>
    <script src="/assets/d2eace91/js/szy.cart.js"></script>
    <script src="/js/requestAnimationFrame.js"></script>
    <script src="/assets/d2eace91/js/jquery.region.js"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js"></script>
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js"></script>
    <script src="/js/category.js"></script>
    <script src="/js/common.js"></script>
    <script src="/assets/d2eace91/min/js/message.min.js"></script>
    <script>
        $().ready(function() {
            $(".pagination-goto > .goto-input").keyup(function(e) {
                $(".pagination-goto > .goto-link").attr("data-go-page", $(this).val());
                if (e.keyCode == 13) {
                    $(".pagination-goto > .goto-link").click();
                }
            });
            $(".pagination-goto > .goto-button").click(function() {
                var page = $(".pagination-goto > .goto-link").attr("data-go-page");
                if ($.trim(page) == '') {
                    return false;
                }
                $(".pagination-goto > .goto-link").attr("data-go-page", page);
                $(".pagination-goto > .goto-link").click();
                return false;
            });
        });
        //
        $("body").on("click", ".clear_history", function() {
            $.confirm("是否清空历史足迹？", function(s) {
                if (s) {
                    $.ajax({
                        type: 'GET',
                        url: '/user/history/del-all',
                        dataType: 'json',
                        success: function(data) {
                            if (data.code == 0) {
                                $("#history_list").html("<div class='tip-box'><img src='/images/noresult.png' class='tip-icon' /><div class='tip-text'>暂无历史足迹</div></div>");
                            }
                        }
                    })
                }
            })
        })
        function change_like() {
            var page = $("#user_like_page").val();
            $.ajax({
                type: 'GET',
                url: '/guess/like',
                data: {
                    page: page,
                    num: 6,
                    tpl: 'guess_like_list'
                },
                dataType: 'json',
                success: function(data) {
                    if (data.code == 0) {
                        $('#user_like').html(data.data);
                    }
                }
            });
        }
        // 初始化加载
        change_like();
        //
        $(function() {
            $('.breadcrumb .crumbs-nav').hover(function() {
                $(this).toggleClass('curr');
            })
        });
        //
        $().ready(function() {
            var page_url = "search.html?go={0}&amp;keyword=a";
            page_url = page_url.replace(/&amp;/g, '&');
            var tablelist = $("#table_list").tablelist({
                page_mode: 1,
                go: function(page){
                    page_url = page_url.replace("{0}", page);
                    $.go(page_url);
                }
            });
            $(".prev-page").click(function(){
                tablelist.prePage();
            });
            $(".next-page").click(function(){
                tablelist.nextPage();
            });
            $(".add-cart").click(function(event) {
                var goods_id = $(this).data("goods-id");
                var image_url = $(this).data("image-url");
                var buy_enable = $(this).data("buy-enable");
                if(buy_enable){
                    $.msg(buy_enable);
                    return;
                }
                $.cart.add(goods_id, 1, {
                    is_sku: false,
                    event: event,
                    image_url: image_url,
                    callback: function(){
                        var attr_list = $('.attr-list').height();
                        $('.attr-list').css({
                            "overflow":"hidden"
                        });
                        if(attr_list >= 200){
                            $('.attr-list').addClass("attr-list-border");
                            $('.attr-list').css({
                                "overflow-y":"auto"
                            });
                        }
                    }
                });
            });
            $(".compare-btn").click(function(event) {
                var goods_id = $(this).data("compare-goods-id");
                var image_url = $(this).data("image-url");
                var that = $(this);
                if ($(this).hasClass("curr")) {
                    $.compare.remove(goods_id, function(result) {
                        if (result.code == 0) {
                            that.removeClass('curr');
                            that.find('i').html('&#xe715;');
                        }
                    });
                } else {
                    $.compare.add(goods_id, image_url, event, function(result) {
                        if (result.code == 0) {
                            that.addClass('curr');
                            that.find('i').html('&#xe6ae;');
                        }
                    });
                }
            });
            // 移除对对比商品
            $.compare.removeCallback = function(goods_id, result) {
                $("[data-compare-goods-id='" + goods_id + "']").removeClass('curr');
            }
            // 清空对比商品
            $.compare.clearCallback = function(goods_id, result) {
                $("[data-compare-goods-id]").removeClass('curr');
            }
            //规格相册
            sildeImg(0);
            //地区组件
            var region_chooser = $(".region-chooser-container").regionchooser({
                value: "53,01",
                change: function(value, names, is_last) {
                    if (value == '') {
                        var values = this.values();
                        if (values.length > 0) {
                            value = values[values.length - 1].region_code;
                        }
                    }
                    var region_code = "53,01";
                    if (is_last && value != region_code ) {
                        value = value.replace(/,/g, "_");
                        var url = "search.html?region={0}&amp;keyword=a";
                        url = url.replace(/&amp;/g, '&');
                        url = url.replace("{0}", value);
                        $.go(url);
                    }
                }
            });
            var goods_ids = '41008-41009-40958-41085-41084-48359-48401-48353-48362-48357-41066-48126-48396-41086-41067-47999-48398-40811-48262-48260';
            $.collect.getGoodsList(goods_ids, null, function(result){
                var goods_list = result.data;
                $(".goods-collect").each(function(){
                    var goods_id = $(this).data("goods-id");
                    if(result.code == 0){
                        if(goods_list[goods_id]){
                            $(this).addClass("curr");
                            $(this).find("span").html("已收藏");
                            $(this).find("i").html('&#xe6b3;');
                        }else{
                            $(this).removeClass("curr");
                            $(this).find("span").html("收藏");
                            $(this).find("i").html('&#xe6b3;');
                        }
                    }
                });
            });
            $.compare.getGoodsList(goods_ids, function(result){
                var goods_list = result.data;
                $(".goods-comapre").each(function(){
                    var goods_id = $(this).data("compare-goods-id");
                    if(result.code == 0){
                        if(goods_list[goods_id]){
                            $(this).addClass("curr");
                            $(this).find("i").html('&#xe6ae;');
                        }else{
                            $(this).removeClass("curr");
                            $(this).find("i").html('&#xe715;');
                        }
                    }
                });
            });
        });
        //
        window.onbeforeunload = function() {
            var scrollPos;
            if (typeof window.pageYOffset != 'undefined') {
                scrollPos = window.pageYOffset;
            } else if (typeof document.compatMode != 'undefined' && document.compatMode != 'BackCompat') {
                scrollPos = document.documentElement.scrollTop;
            } else if (typeof document.body != 'undefined') {
                scrollPos = document.body.scrollTop;
            }
            document.cookie = "SZY_GOODS_LIST_SCROLLTOP=" + scrollPos; //存储滚动条位置到cookies中
        }
        if (document.cookie.match(/SZY_GOODS_LIST_SCROLLTOP=([^;]+)(;|$)/) != null) {
            //cookies中不为空，则读取滚动条位置
            var arr = document.cookie.match(/SZY_GOODS_LIST_SCROLLTOP=([^;]+)(;|$)/);
            document.documentElement.scrollTop = parseInt(arr[1]);
            document.body.scrollTop = parseInt(arr[1]);
        }
        //
        //解决因为缓存导致获取分类ID不正确问题，需在ready之前执行
        $(".SZY-DEFAULT-SEARCH").data("cat_id", "");
        $().ready(function() {
            $(".SZY-SEARCH-BOX-KEYWORD").val("{{ request('keyword', '') }}");
            $(".SZY-SEARCH-BOX-KEYWORD").data("search_type", "{{ request('search_type', 0) }}");
            //
            $(".SZY-SEARCH-BOX-KEYWORD").attr("placeholder", "请输入要搜索的关键词");
            //
            $(".SZY-SEARCH-BOX .SZY-SEARCH-BOX-SUBMIT").click(function() {
                if ($(".search-li.curr").attr('num') == 0) {
                    var keyword_obj = $(this).parents(".SZY-SEARCH-BOX").find(".SZY-SEARCH-BOX-KEYWORD");
                    var keywords = $(keyword_obj).val();
                    if ($.trim(keywords).length == 0 || $.trim(keywords) == "请输入要搜索的关键词") {
                        keywords = $(keyword_obj).data("searchwords");
                        $(keyword_obj).val(keywords);
                    }
                    $(keyword_obj).val(keywords);
                }
                $(this).parents(".SZY-SEARCH-BOX").find(".SZY-SEARCH-BOX-FORM").submit();
            });
        });
        //
        $().ready(function(){
            // 缓载图片
            $.imgloading.loading();
        });
        //
        $().ready(function() {
            WS_AddPoint({
                user_id: '{{ $user_info['user_id'] ?? 0 }}',
                url: "{{ get_ws_url('4431') }}",
                type: "add_point_set"
            });
        }, 'JSON');
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
        $().ready(function() {
        })
        //
    </script>
@stop
