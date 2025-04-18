<!-- 商城公告版式2 -->
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_name='{{ $tpl_name }}' data-is_valid='{{ $is_valid }}'>

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
            <li class="">
                <h3>招商入驻</h3>
            </li>
        </ul>
        <div class="tabs-panel ">
            <ul class="mall-news">


                @if(!empty($navNotice))
                    @foreach($navNotice as $v)
                        <li>
                            <a target="_blank" href='{{ route('pc_show_article', ['article_id'=>$v['article_id']]) }}' title="{{ $v['title'] }}">
                                <i></i>
                                {{ $v['title'] }}
                            </a>
                        </li>
                    @endforeach
                @endif


            </ul>
        </div>
        <div class="tabs-panel tabs-hide">
            <a href="/shop/apply.html" title="申请商家入驻；已提交申请，可查看当前审核状态。" class="store-join-btn" target="_blank">&nbsp;</a>
            <a href="//{{ config('lrw.seller_domain') }}" target="_blank" class="store-join-help">
                <i class="icon-cog"></i>
                登录商家管理中心
            </a>
        </div>
    </div>
    <!-- banner右侧公告等tab切换 _end -->

</div>
{{--<script src="http://{{ config('lrw.frontend_domain') }}/js/index.js"></script>--}}
