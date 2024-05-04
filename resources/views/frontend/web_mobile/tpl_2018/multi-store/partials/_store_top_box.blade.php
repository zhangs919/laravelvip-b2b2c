<header class="header-con store-header header-con2">
    <div class="header bg-color">
        <div class="header-content header-con">
            <div class="city-handle">
                <a class="city" href="{{ route('mobile_store_location') }}"><span>{{ $store_info['store_name'] }}</span></a>
            </div>
            <form name="searchForm" method="get" action="{{ shop_prefix_url($shop_id, 'mobile_shop_goods_list') }}">
                <div class="box-search">
                    <div class="header-search">
                        <i class="search-icon iconfont icon-sousuo"></i>
                        <input type="search" name="keyword" value="" class="search-input" placeholder="搜索门店内商品">
                    </div>
                </div>
            </form>
            <div class="header-left-back">
                <a class="sb-back  iconfont icon-shouye2" href="{{ route('mobile_home') }}" title="返回"></a>
            </div>
        </div>
    </div>
    <div style="height: 44px; line-height: 44px;" id="bottom_div"></div>
</header>
<script type="text/javascript">
    $(window).scroll(function() {
        if ($(window).scrollTop() > 100 || $('body').hasClass('visibly')) {
            $(".header-con2").addClass("fixed");
        } else {
            $(".header-con2").removeClass("fixed");
        }
    });
</script>