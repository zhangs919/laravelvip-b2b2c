<!-- 店铺首页轮播广告模板 -->
@if($is_design)
    <div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_id='' data-shop_id='' data-tpl_name='{{ $tpl_name }}' data-is_valid='{{ $is_valid }}'>
@endif

        <!-- banner模块 _start -->
        <div class="banner">

            @if($tpl_name != '' && $is_design)
                <a title="编辑" href="javascript:void(0)" class="selector pic-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="3" data-number="5">
                    <i class="fa fa-edit"></i>
                    编辑
                </a>
            @endif

            @if(isset($data['3-1']))
                <ul id="fullScreenSlides" class="full-screen-slides">
                    @foreach($data['3-1'] as $k=>$v)
                        <li @if($k == 0) style="display: list-item;" @else style="display: none;" @endif>
                            <a href="{{ $v['link'] ?? 'javascript:void(0)' }}" target="_blank" title="" style="background:url({{ get_image_url($v['path']) }}) no-repeat center center;"></a>
                        </li>
                    @endforeach
                </ul>
                <ul class="full-screen-slides-pagination">
                    @foreach($data['3-1'] as $k=>$v)
                        <li class="@if($k == 0) current @endif">
                            <a href="javascript:void(0);">{{ $k }}</a>
                        </li>
                    @endforeach
                </ul>
            @else
                <ul class="full-screen-slides">
                    <li class="example-text">
                        <span>此处添加【1920*400】图片</span>
                    </li>
                </ul>
            @endif
        </div>
        <!-- banner模块 _end -->

@if($is_design)
    </div>
@endif


<script type="text/javascript">
    //首页banner图轮播
    function banner_play(a,b,c,d){
        var blength = $(a).length;
        if(blength > 1){
            $(b).mouseover(function(){
                $(this).addClass(c).siblings().removeClass(c);
                $(a).eq($(this).index()).hide().fadeIn().siblings().fadeOut();

                num=$(this).index();
                clearInterval(bannerTime);
            });
            var num=0;
            function bannerPlay(){
                num++;
                if(num>blength-1){
                    num=0;
                }
                $(b).eq(num).addClass(c).siblings().removeClass(c);
                $(a).eq(num).hide().fadeIn().siblings().fadeOut();
            }
            var bannerTime = setInterval(bannerPlay,6000);
            $(d).hover(function(){
                clearInterval(bannerTime);
            },function(){
                bannerTime = setInterval(bannerPlay,6000);
            })
        }
    }

    banner_play($('#{{ $uid }}').find('.full-screen-slides li'),$('#{{ $uid }}').find('.full-screen-slides-pagination li'),'current',$('#{{ $uid }}').find('#fullScreenSlides'));//首页主广告轮播
</script>