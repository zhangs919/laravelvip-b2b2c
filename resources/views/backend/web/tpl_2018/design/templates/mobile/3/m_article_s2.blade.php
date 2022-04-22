<!-- 默认缓载图片 -->
<!-- 自定义公告模板 -->
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_id='' data-shop_id='' data-tpl_name='{{ $tpl_name }}' data-tpl_type='{{ $tpl_type }}' data-is_valid='{{ $is_valid }}'>

    <!--商城公告 start-->
    <div class="shop-notice-con">
        <div class="notice-img">

            @if(!empty($data['3-1']))
                @foreach($data['3-1'] as $k=>$v)
                    <a href="{{ $v['link'] ?? 'javascript:void(0)' }}" style="display: block;">
                        <img class="" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" data-original-webp="{{ get_image_url($v['path']) }}?x-oss-process=image/format,webp/quality,q_75">
                    </a>
                @endforeach
            @else
                <img src="/assets/d2eace91/images/design/example/sc-news-tit.png" />
            @endif

            @if($tpl_name != '' && $is_design)
                <a title="编辑" href="javascript:void(0)" class="content-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="3">
                    <i class="fa fa-edit"></i>
                    编辑
                </a>
            @endif
        </div>

        @if($tpl_name != '' && $is_design)
            <a title="编辑" href="javascript:void(0)" class="content-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="12" data-length="500">
                <i class="fa fa-edit"></i>
                编辑
            </a>
        @endif
        <div class="shop-notice-info" style="position: absolute; top: 0px;">

            @if(!empty($data['12-1']))
                <p class="shop-notice">{{ $data['12-1'][0]['text'] }}</p>
            @else
                <p class="shop-notice">此处显示商城公告</p>
            @endif

        </div>
    </div>
    <!--商城公告 end-->

</div>

<script>
    function notice_scroll() {
        var totalHeight = $('.shop-notice-info').height();
        var top = 0;
        var lineHeight = 30;
        var mytime;
        $('.shop-notice-info p').eq(0).clone().appendTo('.shop-notice-info');
        function marquee() {
            if (top >= totalHeight + lineHeight) {
                top = 0;
                $('.shop-notice-info').css('top', 0);
            }
            $('.shop-notice-info').stop().animate({
                'top': -top
            }, 600);
            top = top + lineHeight;
        }
        mytime = setInterval(marquee, 3000)
    }
    var noticeHeight = $('.shop-notice-info p').height();
    if (noticeHeight > 30) {
        notice_scroll();
    }
</script>
<script type="text/javascript">
    $.imgloading.loading();
</script>