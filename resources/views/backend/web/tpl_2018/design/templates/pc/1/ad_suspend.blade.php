<!-- 默认缓载图片 -->
<!-- 商城悬浮广告模板 -->
@if($is_design)
    <div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_id='' data-shop_id='' data-tpl_name='{{ $tpl_name }}' data-tpl_type='{{ $tpl_type }}' data-is_valid='{{ $is_valid }}'>


        <div class="fixed-suspend-layer-uid">
            <a href="javascript:void(0)" class="selector pic-selector SZY-TPL-SELECTOR" data-uid='{{ $uid }}' data-cat_id='1' data-type='3' data-number='1'>
                <i class="fa fa-edit"></i>
                编辑
            </a>
            <div class="fixed-suspend-lf">

                @if(!empty($data['3-1']))
                    @foreach($data['3-1'] as $v)
                        <a class="fixed-suspend-img" href="{{ $v['link'] ?? 'javascript:void(0)' }}" style="">
                            <img class="" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" data-original-webp="{{ get_image_url($v['path']) }}?x-oss-process=image/format,webp/quality,q_75" style="display: inline;">
                        </a>
                    @endforeach
                @else
                    <a class="fixed-suspend example-text" href="javascript:;">
                        <span>此处添加悬浮广告图片</span>
                    </a>
                    <!---->
                @endif
            </div>
            <div class="fixed-suspend-text">
                <p>此处为悬浮广告，在后台的位置不影响前台的显示效果。</p>
                <p>在前台的显示效果：进入商城首页首先居中显示此广告,建议上传尺寸为800px*500px的图片。</p>
            </div>
        </div>
        <!---->

        <div class="operateEdit" style="right:157px">
            <a class="decor-btn style-btn SZY-TPL-SELECTOR" data-uid='{{ $uid }}' data-cat_id='1' data-type='99' data-timer='1' data-suspend_ad_show_model='1'><div class="selector-box"><div class="arrow"></div><i class="fa fa-arrow-circle-o-up"></i>样式</div></a>
        </div>
    </div>
@else

    @if(!empty($data['3-1']))
        @foreach($data['3-1'] as $v)
            <div class="fixed-suspend-layer hide" style="display: block;">
                <div class="fixed-suspend-con">

                    <a class="fixed-suspend-img" href="{{ $v['link'] ?? 'javascript:void(0)' }}">
                        <img class="lazy" src="{{ get_image_url($v['path']) }}">
                    </a>

                    <div class="close-fixed-suspend"></div>
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
                        $('.fixed-suspend-layer').hide();
                    },timer*1000);

                </script>
            @endif
        @endforeach
    @endif
@endif




<script type="text/javascript">
    if(!localStorage.fixed_ad_layer_{{ time() }}){
        $('.fixed-suspend-layer').show();
    }
    //悬浮广告弹出层
    $('body').on('click','.close-fixed-suspend',function(){
        localStorage.fixed_ad_layer_{{ time() }} = true;
        $('.fixed-suspend-layer').hide();
    });
</script>