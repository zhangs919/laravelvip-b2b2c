<!--底部菜单 start-->
<script src="/mobile/js/custom_js.js?v=20180528"></script>
<link rel="stylesheet" href="/mobile/css/custom_css.css?v=20180428"/>
<div style="height: 48px; line-height: 48px; clear: both; display:none;"></div>
<div class="footer-nav">

    @if(@$is_design)
    <a href="javascript:void(0)" class="content-selector SZY-TPL-SETTING" data-url='/design/navigation/list?nav_page=m_site&nav_position=3' data-title='导航设置' data-tpl='@frontend/web_mobile/modules/library/site_footer_menu.tpl' data-container='.SZY-TPL-FOOTER'>
        <i class="fa fa-edit"></i>
        编辑
    </a>
    @endif






    <ul>


        @foreach($list as $v)
        <li class="">


            <!---->
            <a href="javascript:void(0)">

                <i style="background: url(/mobile/images/tab_home_normal.png);background-size: contain;"></i>

                <span>{{ $v->nav_name }}</span>
            </a>
            <!---->
        </li>
        @endforeach


    </ul>

</div>