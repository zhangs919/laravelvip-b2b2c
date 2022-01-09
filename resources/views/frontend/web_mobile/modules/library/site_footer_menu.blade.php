<!--底部菜单 start-->
<script src="/mobile/js/custom_js.js?v=20180528"></script>
<link rel="stylesheet" href="/mobile/css/custom_css.css?v=20180428"/>
<div style="height: 48px; line-height: 48px; clear: both;"></div>
<div class="footer-nav">

    @if(@$is_design)
    <a href="javascript:void(0)" class="content-selector SZY-TPL-SETTING" data-url='/design/navigation/list?nav_page=m_site&nav_position=3' data-title='导航设置' data-tpl='@frontend/web_mobile/modules/library/site_footer_menu.tpl' data-container='.SZY-TPL-FOOTER'>
        <i class="fa fa-edit"></i>
        编辑
    </a>
    @endif






    <ul>


        @foreach(get_mobile_navigation() as $v)
        {{-- 当前菜单 给 li 加上class "current"--}}
        <li class="">


            <!---->
            <a href="{{ $v->nav_link }}">

                {{--导航菜单有两种显示方式 todo--}}
                {{--<i style="background: url(/mobile/images/tab_home_normal.png);background-size: contain;"></i>--}}
                <i style="background-image: url({{ get_image_url($v->nav_icon) }});background-size: contain;background-repeat: no-repeat;"></i>

                <span>{{ $v->nav_name }}</span>
            </a>
            <!---->
        </li>
        @endforeach


    </ul>

</div>
<!--底部菜单 end-->