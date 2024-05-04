<!-- 默认缓载图片 -->
<!-- 微商城广告模板 -->
@if($is_design)
    <div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_id='' data-shop_id='' data-tpl_name='{{ $tpl_name }}' data-tpl_type='{{ $tpl_type ?? '' }}' data-is_valid='{{ $is_valid }}'>


        <div class="fixed-img-layer">
            <a title="编辑" href="javascript:void(0)" class="pic-selector content-selector SZY-TPL-SELECTOR" data-uid='{{ $uid }}' data-cat_id='1' data-type='3' data-number='1'>
                <i class="fa fa-edit"></i>
                编辑
            </a>
            <div class="fixed-img-lf">

                @if(!empty($data['3-1']))
                    @foreach($data['3-1'] as $v)
                        <a class="fixed-img ad-img" href="javascript:void(0)" style="display: block;">
                            <img class="" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" data-original-webp="{{ get_image_url($v['path']) }}?x-oss-process=image/format,webp/quality,q_75" style="display: inline;">
                        </a>
                    @endforeach
                @else
                    <a class="ad-img fixed-img" href="javascript:void(0);">
                        <img src="/assets/d2eace91/images/design/example/ad_img_110_135_2.png">
                    </a>
                    <!---->
                @endif

            </div>
            <div class="fixed-text">此处为悬浮广告在前台的显示效果，建议上传最大宽度为600px的图片</div>
        </div>
        <!---->


    </div>


    <script type="text/javascript">
        $('#{{ $uid }}').find('.operateEdit').prepend('<a href="javascript:void(0);" class="SZY-TPL-SELECTOR pic-selector style-btn" data-uid="{{ $uid }}" data-cat_id="1" data-type="99" data-timer="1" data-suspend_ad_show_model="1"><div class="selector-box"><div class="arrow"></div><i class="fa fa-arrow-circle-o-up"></i>样式</div></a>')
    </script>

@else
    @if(!empty($data['3-1']))
        @foreach($data['3-1'] as $v)
            <div class="fixed-img-layer hide" style="display: block;">
                <div class="fixed-img-con">

                    <a class="ad-img fixed-img " href="{{ $v['link'] ?? 'javascript:void(0)' }}">
                        <img src="{{ get_image_url($v['path']) }}">
                    </a>

                    <div class="close-fixed-img close-fixed-ad-btn"></div>
                </div>
            </div>
            <!---->
        @endforeach
    @endif

    {{--悬浮广告倒计时--}}
    @if(!empty($data['99-1']))
        @foreach($data['99-1'] as $v)
            @if($v['timer'] > 0)
                <script type="text/javascript">
                    var timer = '{{ $v['timer'] }}';
                    timer = parseInt(timer);
                    setTimeout(function(){
                        sessionStorage.fixed_ad_layer_{{ time() }} = true;
                        $('.fixed-img-layer').hide();
                    },timer*1000);

                </script>
            @endif
        @endforeach
    @endif

@endif




<script type="text/javascript">
    {{--if(!localStorage.fixed_ad_layer_{{ time() }}){--}}
        {{--$('.fixed-img-layer').show();--}}
    {{--}--}}
    {{--//悬浮广告弹出层--}}
    {{--$('body').on('click','.close-fixed-ad-btn',function(){--}}
        {{--localStorage.fixed_ad_layer_{{ time() }} = true;--}}
        {{--$('.fixed-img-layer').hide();--}}
    {{--});--}}
</script>

<script type="text/javascript">
    // $.imgloading.loading();
</script>