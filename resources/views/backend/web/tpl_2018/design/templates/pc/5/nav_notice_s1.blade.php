<!-- 商城公告版式1 -->
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_name='{{ $tpl_name }}' data-is_valid='{{ $is_valid }}'>

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
            <a href="http://{{ config('lrw.frontend_domain') }}/help/notice.html" target="_blank">
                更多
                <i>></i>
            </a>
        </h3>
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
    <!-- banner右侧公告 _end -->

</div>
