<!-- 默认缓载图片 -->
<!-- 手机端导航模板 -->
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_id='' data-shop_id='' data-tpl_name='{{ $tpl_name }}' data-tpl_type='{{ $tpl_type ?? '' }}' data-is_valid='{{ $is_valid }}'>


    <!--内容区域 start-->



    <div class="swiper-container nav-list-container" style="">
        <nav class="nav-list swiper-wrapper nav-col04-list">

            @if($tpl_name != '' && $is_design)
                <a title="编辑" href="javascript:void(0)" class="mnav-selector content-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="8" data-number="40" data-width="950" data-nav_open_pic="1">
                    <i class="fa fa-edit"></i>
                    编辑
                </a>
            @endif

            <ul>


                @if(!empty($data['8-1']))
                    @foreach($data['8-1'] as $v)
                        <li>
                            <a href="{{ $v['link'] }}">

                                <img src="{{ get_image_url($v['path'], 'mobile_nav') }}" data-src="{{ get_image_url($v['path'], 'mobile_nav') }}" class="swiper-lazy">
                                {{-- <img src="{{ $v['path'] }}" data-src="{{ $v['path'] }}" class="swiper-lazy"> --}}


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
        <div class="swiper-pagination nav-se"></div>
    </div>
    <!--内容区域 end-->



</div>

<script type="text/javascript">
    {{--var swiper = $('#{{ $uid }} .nav-list-container').swiper({--}}
        {{--pagination: '.swiper-pagination',--}}
        {{--paginationClickable: true,--}}
        {{--autoplay: false,--}}
        {{--autoplayDisableOnInteraction: false,--}}
        {{--lazyLoading: true,--}}
    {{--});--}}
    {{--if ($('#{{ $uid }} ul').length <= 1) {--}}
        {{--$('#{{ $uid }}').find('.swiper-pagination').addClass('hide');--}}
    {{--}--}}
</script>
@if($is_design)
<script type="text/javascript">
    $('#{{ $uid }}').find('.operateEdit').prepend('<a href="javascript:void(0);" class="decor-btn style-btn SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-type="99" data-style_colorpicker="1" data-style_image="1" data-width="650"><div class="selector-box"><div class="arrow"></div><i class="fa fa-arrow-circle-o-up"></i>设置样式</div></a>')
</script>
@endif


