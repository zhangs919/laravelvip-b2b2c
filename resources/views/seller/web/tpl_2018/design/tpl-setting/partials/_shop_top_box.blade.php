@if(shopconf('shop_header_style', false, $shop_info->shop_id) == 0)
    {{--店铺头部样式 shop_header_style=0--}}
    <div class="shop-top-box shop-top-con1">
        <div class="shop-top-bg">

            <img src="{{ get_image_url($shop_info->shop_sign_m) }}">

        </div>
        <header class="header">
            <div class="header-bcak-bar">
                <a class="sb-back" href="javascript:history.back(-1)" title="返回"></a>
            </div>
            <!-- 如果有自由购功能，给下面标签添加class,'header-middle-freebuy' -->
            <div class="header-middle-box  SZY-SHOP-HEADER">
                <div class="header-middle-con">
                    <form name="searchForm" method="get" action="/shop/{{ $shop_info->shop_id }}/list">
                        <div class="header-search">
                            <i class="search-icon"></i>
                            <input type="text" name="keyword" value="{{ $keyword ?? '' }}" class="search-input" placeholder="搜索店铺内商品">
                        </div>
                    </form>
                </div>
            </div>
            <!-- 如果有自由购功能，给下面标签添加class,'header-right-freebuy'，然后扫码的a标签显示 -->
            <div class="header-right-bar">
                <aside class="top_bar">
                    <div class="show-menu" id="show_more">
                        <a href="javascript:void(0);"></a>
                    </div>
                </aside>
            </div>
        </header>
        <div class="shop-info">
            <div class="shop-logo">
                <img src="{{ get_image_url($shop_info->shop_image, 'shop_image') }}" alt="{{ $shop_info->shop_name }}">
            </div>

            <div class="shop-collect-btn SZY-SHOP-IS-COLLENT" data-shop_id="{{ $shop_info->shop_id }}">
                <i class="iconfont">&#xe615;</i>
                <span>收藏</span>
            </div>
            <div class="shop-info-right">
                <div class="shop-name">{{ $shop_info->shop_name }}</div>

                <div class="shop-notice">
                    <em>公告</em>
                    <ul class="SZY-SHOP-ARTICLE">
                        <li>
                            <a href="javascript:void(0)">{!! $shop_info->detail_introduce !!}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@else
    {{--店铺头部样式 shop_header_style=1--}}
    <div class="shop-top-box shop-top-con2">
        <div class="shop-top-bg">

            <img src="http://{{ env('MOBILE_DOMAIN') }}/images/shop_top_bg.jpg">

        </div>
        <header class="header">
            <div class="header-bcak-bar">
                <a class="sb-back  iconfont icon-fanhui1" href="javascript:history.back(-1)" title="返回"></a>
            </div>
            <!-- 如果有自由购功能，给下面标签添加class,'header-middle-freebuy' -->
            <div class="header-middle-box SZY-SHOP-HEADER">
                <div class="header-middle-con">
                    <form name="searchForm" method="get" action="/shop/{{ $shop_info->shop_id }}/list">
                        <div class="header-search">
                            <i class="search-icon"></i>
                            <input type="search" name="keyword" value="{{ $keyword ?? '' }}" class="search-input" placeholder="搜索店铺内商品">
                        </div>
                    </form>
                    <a href="/freebuy/scan/{{ $shop_info->shop_id }}.html" class="freebuy-scan hide" title="扫码">
                    </a>
                </div>
            </div>
            <!-- 如果有自由购功能，给下面标签添加class,'header-right-freebuy'，然后扫码的a标签显示 -->
            <div class="header-right-bar">
                <aside class="top_bar">
                    <div class="show-menu iconfont icon-gengduo3" id="show_more"></div>
                </aside>
            </div>
        </header>
        <div class="shop-info">
            <div class="shop-logo">
                <img src="{{ get_image_url($shop_info->shop_image, 'shop_image') }}" alt="{{ $shop_info->shop_name }}">
            </div>
            <h3 class="shop-name">{{ $shop_info->shop_name }}</h3>
            <div class="operate-box">
                <a class="btn invitation-open-shop SZY-SHOP-IS-COLLENT" href="javascript:void(0)" data-shop_id="{{ $shop_info->shop_id }}">
                    <em></em>
                    <span>关注</span>
                </a>
                <a class="btn share-shop-btn SZY-SHOP-SHARE" href="javascript:void(0)">
                    <em></em>
                    <span>分享</span>
                </a>
            </div>
            <!--公告-->
            <div class="shop-notice">
                <div class="shop-notice-info">
                    <em>公告</em>
                    <ul class="SZY-SHOP-ARTICLE">
                        <li>
                            <a href="javascript:void(0)">{!! $shop_info->detail_introduce !!}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endif