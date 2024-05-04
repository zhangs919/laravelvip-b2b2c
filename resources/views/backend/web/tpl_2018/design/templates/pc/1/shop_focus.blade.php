{{--背景高度--}}
@php
    $bg_height = !empty($data['99-1'][0]['height']) ? $data['99-1'][0]['height'] : '400';
@endphp

<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_id='' data-shop_id='{{ $shop_id ?? '' }}' data-tpl_name='{{ $tpl_name }}' data-is_valid='{{ $is_valid }}'>

    <!-- banner模块 _start -->
    <div class="banner" style='height: {{ $bg_height }}px;'>
        @if($tpl_name != '' && $is_design)
            <a title="编辑" href="javascript:void(0)" class="selector pic-selector SZY-TPL-SELECTOR" data-uid='{{ $uid }}' data-cat_id='1' data-type='3' data-number='5'>
                <i class="fa fa-edit"></i>
                编辑
            </a>
        @endif

        @if(isset($data['3-1']))
            <ul id="fullScreenSlides" class="full-screen-slides" style="height: {{ $bg_height }}px;">
                @foreach($data['3-1'] as $k=>$v)
                    <li @if($k == 0) style="display:list-item;" @else style="display:none;" @endif >
                        <a href="{{ $v['link'] ?? 'javascript:void(0)' }}" target="_blank" title="" style="background:url({{ get_image_url($v['path']) }}) no-repeat center center; background-size: auto 100%; height:{{ $bg_height }}px;"></a>
                    </li>
                @endforeach
            </ul>
            <ul class="full-screen-slides-pagination">
                @foreach($data['3-1'] as $k=>$v)
                    <li @if($k == 0) class="current" @endif>
                        <a href="javascript:void(0);">0</a>
                    </li>
                @endforeach
            </ul>
        @else
            <ul class="full-screen-slides" style="height: {{ $bg_height }}px;">
                <li class="example-text">
                    <span>此处添加【1920*400】图片,该尺寸为默认尺寸,可自行修改焦点图高度</span>
                </li>
            </ul>
        @endif


    </div>
    <!-- banner模块 _end -->


@if($is_design)
    <script type="text/javascript">
        $('#{{ $uid }}').find('.operateEdit').prepend('<a class="decor-btn style-btn SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="99" data-style_height="1"><div class="selector-box"><div class="arrow"></div><i class="fa fa-arrow-circle-o-up"></i>样式</div></a>');
    </script>

@endif

</div>


<script type="text/javascript">
    {{--//首页banner图轮播--}}
    {{--function banner_play(a,b,c,d){--}}
        {{--var blength = $(a).length;--}}
        {{--if(blength > 1){--}}
            {{--$(b).mouseover(function(){--}}
                {{--$(this).addClass(c).siblings().removeClass(c);--}}
                {{--$(a).eq($(this).index()).hide().fadeIn().siblings().fadeOut();--}}

                {{--num=$(this).index();--}}
                {{--clearInterval(bannerTime);--}}
            {{--});--}}
            {{--var num=0;--}}
            {{--function bannerPlay(){--}}
                {{--num++;--}}
                {{--if(num>blength-1){--}}
                    {{--num=0;--}}
                {{--}--}}
                {{--$(b).eq(num).addClass(c).siblings().removeClass(c);--}}
                {{--$(a).eq(num).hide().fadeIn().siblings().fadeOut();--}}
            {{--}--}}
            {{--var bannerTime = setInterval(bannerPlay,6000);--}}
            {{--$(d).hover(function(){--}}
                {{--clearInterval(bannerTime);--}}
            {{--},function(){--}}
                {{--bannerTime = setInterval(bannerPlay,6000);--}}
            {{--})--}}
        {{--}--}}
    {{--}--}}

    {{--banner_play($('#{{ $uid }}').find('.full-screen-slides li'),$('#{{ $uid }}').find('.full-screen-slides-pagination li'),'current',$('#{{ $uid }}').find('#fullScreenSlides'));//首页主广告轮播--}}
</script>