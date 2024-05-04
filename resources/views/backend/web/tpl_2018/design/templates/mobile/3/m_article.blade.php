<!-- 默认缓载图片 -->
<!-- 微商城文章模板 -->
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_id='' data-shop_id='' data-tpl_name='{{ $tpl_name }}' data-tpl_type='{{ $tpl_type }}' data-is_valid='{{ $is_valid }}'>

    <!--商城热点 start-->
    <div class="hot" style="position: relative; overflow: hidden;">
        <div class="notice-img">

            @if(!empty($data['3-1']))
                @foreach($data['3-1'] as $k=>$v)
                    <a href="{{ $v['link'] ?? 'javascript:void(0)' }}" style="display: block;">
                        <img class="" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" data-original-webp="{{ get_image_url($v['path']) }}?x-oss-process=image/format,webp/quality,q_75">
                    </a>
                @endforeach
            @else
                <img src="/assets/d2eace91/images/design/example/notice_bg_73_73.jpg" />
            @endif


            @if($tpl_name != '' && $is_design)
                <a title="编辑" href="javascript:void(0)" class="pic-selector content-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="3">
                    <i class="fa fa-edit"></i>
                    编辑
                </a>
            @endif
        </div>

        @if($tpl_name != '' && $is_design)
            <a title="编辑" href="javascript:void(0)" class="article-selector content-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="1" data-number="20" data-articlr_cat_type="1,2,11,12">
                <i class="fa fa-edit"></i>
                编辑
            </a>
        @endif
        <ul>

            @if(!empty($data['1-1']))
                @foreach(array_chunk($data['1-1'], 2) as $v)
                    <li>
                        <div class="hot-message">

                            @foreach($v as $vv)
{{--                            <a href="/article/list?aid=57,56,55,58" title="{{ $vv['title'] }}">{{ $vv['title'] }}</a>--}}
                            <a href="/news/{{ $vv['article_id'] }}.html" title="{{ $vv['title'] }}">{{ $vv['title'] }}</a>
                            @endforeach

                        </div>
                    </li>
                @endforeach
            @else
                <li>
                    <div class="hot-message">
                        <a href="javascript:void(0)" title="商城公告1">商城公告1</a>
                        <a href="javascript:void(0)" title="商城公告2">商城公告2</a>
                    </div>
                </li>
                <li>
                    <div class="hot-message">
                        <a href="javascript:void(0)" title="商城公告3">商城公告3</a>
                        <a href="javascript:void(0)" title="商城公告4">商城公告4</a>
                    </div>
                </li>
            @endif


        </ul>
    </div>
    <!--商城热点 end-->

</div>

<script type="text/javascript">
    // function comments_scroll() {
    //     var liLen = $('.hot ul li').length;
    //     var num3 = 0;
    //     $('.hot ul').append($('.hot ul').html());
    //     function autoplay() {
    //         if (num3 > liLen) {
    //             num3 = 1;
    //             $('.hot ul').css('top', 0);
    //         }
    //         $('.hot ul').stop().animate({
    //             'top': -60 * num3
    //         }, 500);
    //         num3++;
    //     }
    //     var mytime = setInterval(autoplay, 5000)
    // }
    // comments_scroll();
</script>
<script type="text/javascript">
    // $.imgloading.loading();
</script>