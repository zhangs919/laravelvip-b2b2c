<!-- 默认缓载图片 -->
<!-- 手机端导航模板 -->
@if($is_design)
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_id='' data-shop_id='' data-tpl_name='{{ $tpl_name }}' data-tpl_type='{{ $tpl_type }}' data-is_valid='{{ $is_valid }}'>
@endif


    <!--内容区域 start-->



    <div class="swiper-container nav-list-container" style="">
        <nav class="nav-list swiper-wrapper nav-col05-list">


            <ul>

                @if(!empty($data['8-1']))
                    @foreach($data['8-1'] as $v)
                        <li>
                            <a href="{{ $v['link'] }}">

                                <img src="/assets/d2eace91/images/common/blank.png" data-src="{{ get_image_url($v['path'], 'mobile_nav') }}" class="swiper-lazy">


                                <span style="color:{{ $v['color'] }}">{{ $v['name'] }}</span>
                            </a>
                        </li>
                    @endforeach
                @else
                    @for($i=1; $i <= 4; $i++)
                        <li>
                            <a href="javascript:void(0);">
                                <img alt="快捷菜单" src="/assets/d2eace91/images/design/example/indexnav_120_120_1.png">
                                <span>快捷菜单</span>
                            </a>
                        </li>
                    @endfor
                @endif

            </ul>

        </nav>
        <div class="swiper-pagination"></div>
    </div>
    <!--内容区域 end-->


@if($is_design)
</div>
<script type="text/javascript">
    $('#{{ $uid }}').find('.handle').prepend('<a href="javascript:void(0);" class="SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-type="99" data-style_colorpicker="1" data-style_image="1"><i class="fa fa-arrow-circle-o-up"></i>设置</a>')
</script>
@endif

<script type="text/javascript">
    var swiper = $('#{{ $uid }} .nav-list-container').swiper({
        pagination: '#{{ $uid }} .swiper-pagination',
        paginationClickable: true,
        autoplay: false,
        autoplayDisableOnInteraction: false
    });
    if ($('#{{ $uid }} ul').length <= 1) {
        $('#{{ $uid }}').find('.swiper-pagination').addClass('hide');
    }
</script>
