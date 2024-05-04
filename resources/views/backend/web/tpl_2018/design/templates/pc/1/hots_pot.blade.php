<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_id='' data-shop_id=''
     data-tpl_name='{{ $tpl_name }}' data-is_valid='{{ $is_valid }}'>
    <!-- banner下广告组 _star -->
    <div class="w1210 img-groups img-groups1">

        @if($tpl_name != '' && $is_design)
            <a title="编辑" href="javascript:void(0)" class="selector pic-selector SZY-TPL-SELECTOR"
               data-uid='{{ $uid }}'
               data-cat_id='1' data-type='14' data-hot_map='1'>
                <i class="fa fa-edit"></i>
                编辑
            </a>
        @endif

        @if(!empty($data['14-1']))
            @foreach($data['14-1'] as $v)
                <div class="images-one SZY-PIC-BG" href="javascript:void(0)"
                     style="background: url({{ get_image_url(sysconf('default_lazyload')) }}) no-repeat center center">
                    <img class="lazy" src="/assets/d2eace91/images/common/blank.png"
                         data-original="{{ get_image_url($v['path']) }}"
                         data-original-webp="{{ get_image_url($v['path']) }}?x-oss-process=image/format,webp"
                         width="1210px" usemap="#planetmap_{{ $uid }}"/>
                    <map name="planetmap_{{ $uid }}" class="map-resize">
                        @if(!empty($v['hot_space']))
                            @foreach($v['hot_space'] as $area)
                                <area shape="rect" coords="{{ $area['areaMapInfo'] }}" href="{{ $area['areaLink'] }}"
                                      alt="{{ $area['areaTitle'] }}"/>
                            @endforeach
                        @endif
                    </map>
                </div>
            @endforeach
        @else
            <a class="images-one example-text" href="javascript:void(0);">
                <span>此处添加宽度为1210像素的图片</span>
            </a>
        @endif

    </div>
    <!-- banner下广告组 _end -->
</div>