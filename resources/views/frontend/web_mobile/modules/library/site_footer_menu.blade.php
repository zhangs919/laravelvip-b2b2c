<!--底部菜单 start-->
<div style="" class="footer-nav-blank"></div>
<div class="footer-nav">

    @if(!empty($is_design))
    <a href="javascript:void(0)" class="content-selector SZY-TPL-SETTING" data-url='/design/navigation/list?nav_page=m_site&nav_position=3' data-title='导航设置' data-tpl='@frontend/web_mobile/modules/library/site_footer_menu.tpl' data-container='.SZY-TPL-FOOTER'>
        <i class="fa fa-edit"></i>
        编辑
    </a>
    @endif

    <ul>
        @foreach(get_mobile_navigation() as $k=>$v)
        {{-- 当前菜单 给 li 加上class "current"--}}
        <li class="@if(request()->getRequestUri() == $v['nav_link']){{ 'current' }}@endif">

            <a href="{{ $v['nav_link'] }}" @if($v['nav_link'] == '/cart.html')class="cartbox"@endif>
                {{--导航菜单有两种显示方式--}}
                @if($v['nav_class'] == 'index-icon'){{--仿淘宝首页--}}
                    <i style="background-image: url('@if(request()->getRequestUri() == $v['nav_link']){{ get_image_url($v['nav_icon_active']) }}@else{{ get_image_url($v['nav_icon']) }}@endif');background-size: contain;background-repeat: no-repeat;">
                        @if($v['nav_link'] == '/cart.html')<em class="cart-num SZY-CART-COUNT">0</em>@endif
                    </i>
                @else
                    <i style="background: url('{{ get_image_url($v['nav_icon']) }}');background-size: contain;">
                        @if($v['nav_link'] == '/cart.html')<em class="cart-num SZY-CART-COUNT">0</em>@endif
                    </i>
                @endif
                <span>{{ $v['nav_name'] }}</span>
            </a>
        </li>
        @endforeach
    </ul>

</div>
<!--底部菜单 end-->
