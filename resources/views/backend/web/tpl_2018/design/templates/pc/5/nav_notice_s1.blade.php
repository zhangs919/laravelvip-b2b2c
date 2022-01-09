<!-- 商城公告版式1 -->
@if($is_design)
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_name='{{ $tpl_name }}' data-is_valid='{{ $is_valid }}'>
@endif

    <!-- banner右侧公告 _start -->
    <div class="proclamation1">

        @if($tpl_name != '' && $is_design)
            <a href="javascript:void(0)" class="selector SZY-TPL-SETTING" title="编辑" data-uid="{{ $uid }}" data-url="/article/article/list?show_cat_type=2" data-title="商城公告">
                <i class="fa fa-edit"></i>
                编辑
            </a>
        @endif

        <h3>
        <span>
        <i></i>
        公告
        </span>
            <a href="http://www.laravelvip.com/help/notice.html" target="_blank">
                更多
                <i>></i>
            </a>
        </h3>
        <ul class="mall-news">


            <li>
                <a target="_blank" href='/help/notice/36.html' title="翼商城持续更新中...">
                    <i></i>
                    翼商城持续更新中...
                </a>
            </li>



            <li>
                <a target="_blank" href='/help/notice/20.html' title="翼商城火热招商中">
                    <i></i>
                    翼商城火热招商中
                </a>
            </li>



            <li>
                <a target="_blank" href='/help/notice/35.html' title="翼商城介绍">
                    <i></i>
                    翼商城介绍
                </a>
            </li>



            <li>
                <a target="_blank" href='/help/notice/34.html' title="站点—供货—入驻商家—区域配送">
                    <i></i>
                    站点—供货—入驻商家—区域配送
                </a>
            </li>



            <li>
                <a target="_blank" href='/help/notice/33.html' title="B2B2B2C电商生态系统">
                    <i></i>
                    B2B2B2C电商生态系统
                </a>
            </li>



            <li>
                <a target="_blank" href='/help/notice/32.html' title="翼商城更新啦....">
                    <i></i>
                    翼商城更新啦....
                </a>
            </li>


        </ul>
    </div>
    <!-- banner右侧公告 _end -->

@if($is_design)
</div>
@endif
