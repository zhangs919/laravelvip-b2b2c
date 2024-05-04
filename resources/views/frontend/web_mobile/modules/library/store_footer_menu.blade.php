<!--底部菜单 start-->
<div style="" class="footer-nav-blank"></div>
<div class="footer-nav">
    <ul>
        <li class="current">
            <!-- -->
            <a href="/" class="" szy_tag_compiled="1">
                <i style="background: url(/images/tab_home_selected.png); background-size: contain; background-repeat: no-repeat;">
                </i>
                <span>首页</span>
            </a>
        </li>
        <li class="">
            <!-- -->
            <a href="/shop/list.html" class="" szy_tag_compiled="1">
                <i style="background: url(/images/tab_category_normal.png); background-size: contain; background-repeat: no-repeat;">
                </i>
                <span>分类</span>
            </a>
        </li>
        <li class="">
            <!-- -->
            <a href="/cart.html" class="cartbox" szy_tag_compiled="1">
                <i style="background: url(/images/tab_cart_normal.png); background-size: contain; background-repeat: no-repeat;">
                    <em class="cart-num SZY-CART-COUNT">0</em>
                </i>
                <span>购物车</span>
            </a>
        </li>
        <li class="">
{{--            <!-- -->@if(request()->getRequestUri() == '' || (str_contains(request()->getRequestUri(), 'index.html') && $v['nav_link'] == '/')){{ get_image_url($v['nav_icon_active']) }}@else{{ get_image_url($v['nav_icon']) }}@endif--}}
            <a href="/user.html" class="" szy_tag_compiled="1">
                <i style="background: url(/images/tab_user_normal.png); background-size: contain; background-repeat: no-repeat;">
                </i>
                <span>我的</span>
            </a>
        </li>
    </ul>
</div>

<!--底部菜单 end-->