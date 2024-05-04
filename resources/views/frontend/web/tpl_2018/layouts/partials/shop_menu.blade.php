{{--店铺菜单--}}
<div class="shop-menu" @if(!empty(shopconf('nav_bgcolor', false, $shop_info['shop']['shop_id']))) style='background-color:{{ shopconf('nav_bgcolor', false, $shop_info['shop']['shop_id']) }};' @endif>
    <div class="shop-menu-box">
        <ul class="shop-menu-left">
            <li>
                <a href="{{ route('pc_shop_home', ['shop_id' => $shop_info['shop']['shop_id']]) }}" target="">首页</a>
            </li>
            <li class="all-category">
                <a href="{{ route('pc_shop_goods_list', ['filter_str' => $shop_info['shop']['shop_id']]) }}" target="">
                    全部分类
                    <span class="arrow"></span>
                </a>
                <div class="all-category-coupon">

                    <!-- 获取店铺内商品分类 -->





                    <dl>
                        <dt>
                            <a href="{{ route('pc_shop_goods_list', ['filter_str' => $shop_info['shop']['shop_id'].'-0']) }}" target="_blank">全部商品 ></a>
                        </dt>
                        <dd>
                            <ul>


                            </ul>
                        </dd>
                    </dl>

                    @foreach($shop_category_list as $v)
                        <dl>
                            <dt>
                                <a href="{{ route('pc_shop_goods_list', ['filter_str' => $shop_info['shop']['shop_id'].'-'.$v['cat_id']]) }}" target="_blank">{{ $v['cat_name'] }} ></a>
                            </dt>
                            <dd>
                                <ul>

                                    @if(!empty($v['_child']))
                                        @foreach($v['_child'] as $child)
                                            <li>
                                                <a href="{{ route('pc_shop_goods_list', ['filter_str' => $shop_info['shop']['shop_id'].'-'.$child['cat_id']]) }}" target="_blank">{{ $child['cat_name'] }}</a>
                                            </li>
                                        @endforeach
                                    @endif

                                </ul>
                            </dd>
                        </dl>
                    @endforeach

                </div>
            </li>
            <!-- 获取店铺导航 -->
        </ul>
        <ul class="shop-menu-right">

            @if(!empty($is_design) && (isset($page) && $page != 'topic'))
            <li class="shop-menu-edit">
                <a href="javascript:void(0)" class="selector SZY-TPL-SETTING" data-url='/shop/navigation/list?is_design=1' data-title='店铺导航设置' data-container='.SZY-TPL-HEADER'>
                    <i class="fa fa-edit"></i>
                    编辑店铺导航
                </a>
            </li>
            @endif


            @if(!empty($shop_navigation))
                @foreach($shop_navigation as $v)
                    <li class="shop-nav">

                        <a href="{{ !empty($v['nav_link'] && empty($is_design)) ? $v['nav_link'] : 'javascript:void(0)' }}">{{ $v['nav_name'] }}</a>

                    </li>
                @endforeach
            @else
                @if(!empty($is_design) && (isset($page) && $page != 'topic'))
                    <li class="shop-nav">
                        <a href="javascript:void(0)">请在这里添加导航</a>
                    </li>
                @endif
            @endif

        </ul>
    </div>
</div>
