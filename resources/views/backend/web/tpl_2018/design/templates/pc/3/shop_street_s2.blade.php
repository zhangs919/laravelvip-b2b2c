<!-- 默认缓载图片 -->
@if($is_design)
<!-- 前台首页店铺街模板2 -->
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_name='{{ $tpl_name }}' data-is_valid='{{ $is_valid }}'>
@endif

    <!-- 店铺街2 _start -->
    <div class="w1210 store-wall2">
        <h2>

            @if($tpl_name != '' && $is_design)
                <a title="编辑" href="javascript:void(0)" class="selector title-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="4" data-width="650" data-title_open_colorpicker="1" data-title_open_link="1">
                    <i class="fa fa-edit"></i>
                    编辑
                </a>
            @endif

                @if(!empty($data['4-1']))
                    @foreach($data['4-1'] as $v)
                        <a class="store-wall-title" href="javascript:void(0)" title="{{ $v['name'] }}" style="color: {{ $v['color'] }}">{{ $v['name'] }}</a>
                    @endforeach
                @else
                    <a class="store-wall-title" href="javascript:void(0);">添加标题</a>
                @endif

        </h2>
        <div class="store-con2">
            <div class="store-wall2-ad">

                @if($tpl_name != '' && $is_design)
                    <a title="编辑" href="javascript:void(0)" class="selector pic-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="3">
                        <i class="fa fa-edit"></i>
                        编辑
                    </a>
                @endif

                @if(!empty($data['3-1']))
                    @foreach($data['3-1'] as $v)
                        <a href="{{ $v['link'] ?? 'javascript:void(0)' }}" style="">
                            <img class="" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" data-original-webp="{{ get_image_url($v['path']) }}" style="display: block;">
                        </a>
                    @endforeach
                @else
                    <a href="javascript:void(0);" class="example-text full-size">
                        <span>此处添加【400*278】图片</span>
                    </a>
                @endif


            </div>
            <ul class="store-wall2-list">

                @if($tpl_name != '' && $is_design)
                    <a title="编辑" href="javascript:void(0)" class="selector shop-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="9" data-number="18" data-show_extend="1">
                        <i class="fa fa-edit"></i>
                        编辑
                    </a>
                @endif

                @for($i=0; $i <= 24; $i++)
                    @if(@$data['9-1'][$i] != null)
                        <li>
                            <img alt="{{ $data['9-1'][$i]['shop_name'] }}" src="{{ $data['9-1'][$i]['shop_logo'] }}">
                            <div class="black-cover" style="display: none;"></div>
                            <div class="cover-content" style="display: none;">
                                <em>{{ $data['9-1'][$i]['shop_name'] }}</em>
                                <a href="{{ route('pc_shop_home', ['shop_id'=>$data['9-1'][$i]['shop_id']]) }}" class="enter" target="">点击进入</a>
                            </div>
                        </li>
                    @else
                        <li>
                            <img src="/assets/d2eace91/images/design/example/shop_img_120_60.jpg" height="120" width="60" />
                            <div class="black-cover"></div>
                            <div class="cover-content">
                                <a href="javascript:void(0)" class="enter enter-center">点击进入</a>
                            </div>
                        </li>
                    @endif
                @endfor


            </ul>
        </div>
    </div>
    <!-- 店铺街2 _end -->

@if($is_design)
</div>
@endif



<script type="text/javascript">
    //店铺街logo鼠标经过效果
    $("#{{ $uid }}").find(".store-wall2-list li").hover(function() {
        $(this).find('.black-cover').css('display', 'block');
        $(this).find('.cover-content').css('display', 'block');
    }, function() {
        $(this).find('.black-cover').css('display', 'none');
        $(this).find('.cover-content').css('display', 'none');
    });
</script>

<script type="text/javascript">
    $(function() {
        //图片缓载
        $('#{{ $uid }}').find("img").lazyload({
            skip_invisible: false,
            effect: 'fadeIn',
            failure_limit: 20,
            threshold: 200
        });
    });
</script>