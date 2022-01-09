<!-- 商城公告版式2 -->
@if($is_design)
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_name='{{ $tpl_name }}' data-is_valid='{{ $is_valid }}'>
@endif

    <!-- banner右侧公告等tab切换 _start -->
    <div class="proclamation2">

        @if($tpl_name != '' && $is_design)
            <a href="javascript:void(0)" class="selector SZY-TPL-SETTING" title="编辑" data-uid="{{ $uid }}" data-url="/article/article/list?show_cat_type=2">
                <i class="fa fa-edit"></i>
                编辑
            </a>
        @endif

        <ul class="tabs-nav">
            <li class="tabs-selected">
                <h3>商城公告</h3>
            </li>
            <li>
                <h3>招商入驻</h3>
            </li>
        </ul>
        <div class="tabs-panel">
            <ul class="mall-news">


                <li>
                    <a target="_blank" href="http://www.laravelvip.com/article/info?id=36" title="">
                        <i></i>
                        翼商城持续更新中...
                    </a>
                </li>



                <li>
                    <a target="_blank" href="http://www.laravelvip.com/article/info?id=20" title="">
                        <i></i>
                        翼商城火热招商中
                    </a>
                </li>



                <li>
                    <a target="_blank" href="http://www.laravelvip.com/article/info?id=35" title="">
                        <i></i>
                        翼商城介绍
                    </a>
                </li>



                <li>
                    <a target="_blank" href="http://www.laravelvip.com/article/info?id=34" title="">
                        <i></i>
                        站点—供货—入驻商家—区域配送
                    </a>
                </li>



                <li>
                    <a target="_blank" href="http://www.laravelvip.com/article/info?id=33" title="">
                        <i></i>
                        B2B2B2C电商生态系统
                    </a>
                </li>



                <li>
                    <a target="_blank" href="http://www.laravelvip.com/article/info?id=32" title="">
                        <i></i>
                        翼商城更新啦....
                    </a>
                </li>


            </ul>
        </div>
        <div class="tabs-panel tabs-hide">
            <a href="http://www.laravelvip.com/shop/apply.html" title="申请商家入驻；已提交申请，可查看当前审核状态。" class="store-join-btn" target="_blank"> </a>
            <a href="http://seller.laravelvip.com" target="_blank" class="store-join-help">
                <i class="icon-cog"></i>
                登录商家管理中心
            </a>
        </div>
    </div>
    <!-- banner右侧公告等tab切换 _end -->

@if($is_design)
</div>
@endif
