@extends('layouts.shop_layout')


@section('style_js')

@stop



@section('content')

    <!-- 内容 -->
    <div class="layout"  style="min-height:400px;">
        <!-- 内容 -->

        <!-- 右侧客服 _start-->
        <!-- 右侧客服_end -->

        <div class="condition-screen w1210">
            <div class="blank15"></div>
            <div class="content-wrap category-wrap clearfix">
                <div class="fl">
                    <div class="store-category">
                        <h3 class="left-title">店内分类</h3>
                        <div class="left-content tree">
                            <ul>

                                <li class="parent_li">
							<span>
								<i class="icon-minus-sign"></i>
							</span>
                                    <a href="/shop-list-{{ $shop_info['shop']['shop_id'] }}.html" target="_self" title="全部商品" class="tree-first">全部商品</a>
                                    <ul>

                                    </ul>
                                </li>
                                @foreach($shop_category_list as $v)
                                    <li>
							<span>
								<i class="icon-minus-sign"></i>
							</span>
                                        <a href="/shop/{{ $shop_info['shop']['shop_id'] }}/list.html?cat_id={{ $v['cat_id'] }}"
                                           target="_self" title="{{ $v['cat_name'] }}" class="tree-first">{{ $v['cat_name'] }}</a>
                                        <ul>



                                            @if(!empty($v['_child']))
                                                @foreach($v['_child'] as $child)
                                                    <li>
                                        <span>
                                            <i class="arrow"></i>
                                        </span>
                                                        <a href="/shop/{{ $shop_info['shop']['shop_id'] }}/list.html?cat_id={{ $v['cat_id'] }}"
                                                           target="_self" title="{{ $v['cat_name'] }}">{{ $v['cat_name'] }}</a>
                                                    </li>
                                                @endforeach
                                            @endif


                                        </ul>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>

                <div class="main fr">
                    <div class="" id="filter">
                        <!--排序-->
                        <form method="GET" name="listform" action="category.php">
                            <div class="fore1">
                                <dl class="order">

                                    <dd class="first curr">
                                        <a href="javascript:void(0);" data-go="/shop-list-1-0-0-0-0-0-0-4-0-0.html">
                                            综合

                                        </a>
                                    </dd>

                                    <dd class="">
                                        <a href="javascript:void(0);" data-go="/shop-list-1-0-0-0-0-0-1-3-0-0.html">
                                            销量

                                            <i class="iconfont icon-DESC"></i>

                                        </a>
                                    </dd>

                                    <dd class="">
                                        <a href="javascript:void(0);" data-go="/shop-list-1-0-0-0-0-0-2-3-0-0.html">
                                            新品

                                            <i class="iconfont icon-DESC"></i>

                                        </a>
                                    </dd>

                                    <dd class="">
                                        <a href="javascript:void(0);" data-go="/shop-list-1-0-0-0-0-0-3-3-0-0.html">
                                            评论

                                            <i class="iconfont icon-DESC"></i>

                                        </a>
                                    </dd>

                                    <dd class="">
                                        <a href="javascript:void(0);" data-go="/shop-list-1-0-0-0-0-0-4-3-0-0.html">
                                            价格

                                            <i class="iconfont icon-DESC"></i>

                                        </a>
                                    </dd>

                                    <dd class="">
                                        <a href="javascript:void(0);" data-go="/shop-list-1-0-0-0-0-0-5-3-0-0.html">
                                            人气

                                            <i class="iconfont icon-DESC"></i>

                                        </a>
                                    </dd>

                                </dl>
                                <div class="pagin">
                                    <!---->
                                    <a class="prev disabled">
                                        <span class="icon prev-disabled"></span>
                                    </a>
                                    <!---->
                                    <span class="text">
								<font class="color">1</font>
								/

								1

							</span>
                                    <!---->
                                    <a class="next next-page" data-go-page="2" href="javascript:;">
                                        <span class="icon next-btn"></span>
                                    </a>

                                </div>
                                <div class="total">
                                    共
                                    <span class="color">0</span>
                                    个商品
                                </div>
                            </div>
                            <div class="fore2">
                                <div class="filter-btn">

                                    <a href="javascript:void(0);" data-go="/shop-list-1-0-0-1-0-0-0-3-0-0.html" class="filter-tag ">
                                        <input class="none" name="fff" onclick="" type="checkbox">
                                        <i class="iconfont">&#xe715;</i>
                                        <span class="text">包邮</span>
                                    </a>

                                    <a href="javascript:void(0);" data-go="/shop-list-1-0-0-0-0-1-0-3-0-0.html" class="filter-tag ">
                                        <input class="none" name="fff" onclick="" type="checkbox">
                                        <i class="iconfont">&#xe715;</i>
                                        <span class="text">仅显示有货</span>
                                    </a>

                                </div>
                            </div>
                        </form>
                    </div>

                    <!--主体商品内容展示-->
                    <form name="compareForm" action="compare.php" method="post" onsubmit="">
                        <ul class="list-grid clearfix">
                            {{--引入列表--}}
                            @include('shop.partials._shop_goods')

                        </ul>
                        <!--当没有数据时，显示如下div-->
                        @if($goods_total == 0)
                        <div class="tip-box">
                            <img src="/frontend/images/noresult.png" class="tip-icon">
                            <div class="tip-text">抱歉！没有搜索到您想要的结果……</div>
                        </div>
                        @endif

                        <!--分页-->
                        <div class="pull-right page-box">



                            {!! $pageHtml !!}

                        </div>
                    </form>

                </div>
            </div>
        </div>

        <script src="/frontend/js/category.js?v=20181123"></script>
        <script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=20181123"></script>
        <script type="text/javascript">
            $().ready(function() {
                var page_url = "/shop-list-1-0-{0}-0-0-0-0-3-0-0.html";
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
                        return false;
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
                            if(attr_list>=200){
                                $('.attr-list').addClass("attr-list-border");
                                $('.attr-list').css({
                                    "overflow-y":"auto"
                                });
                            }
                        }
                    });
                    return false;
                });

                //规格相册
                sildeImg(0);

                // 跳转页面
                $("[data-go]").click(function(){
                    $.go($(this).data("go"));
                });
            });
        </script>

    </div>



@stop