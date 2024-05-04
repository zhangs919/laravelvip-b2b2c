<!-- 热区模板 m_hots_pot-->
<!-- 默认缓载图片 -->
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_id='' data-shop_id=''
     data-tpl_name='{{ $tpl_name }}' data-tpl_type='{{ $tpl_type ?? '' }}' data-is_valid='{{ $is_valid }}'>

@if(!empty($data['14-1']))
    <!--内容区域 start-->
        <div class="img-groups-box img-groups0-box">
            @if($tpl_name != '' && $is_design)
                <a title="编辑" href="javascript:void(0)" class="pic-selector content-selector SZY-TPL-SELECTOR"
                   data-uid='{{ $uid }}' data-cat_id='1' data-type='14' data-number='1' data-hot_map='1'>
                    <i class="fa fa-edit"></i>
                    编辑
                </a>
            @endif

            <ul>
                @foreach($data['14-1'] as $k=>$v)
                    <li id="pic_{{ $uid }}" style='width:100%'>
                        <a class="item-pic SZY-PIC-BG" href="javascript:void(0)"
                           style="background: url({{ get_image_url(sysconf('default_lazyload_mobile')) }}) no-repeat center center; display: block; background-size: 100px; background-color: #fff;  padding-top:58.12%">
                            <img class="lazy" src="/assets/d2eace91/images/common/blank.png"
                                 data-original="{{ get_image_url($v['path']) }}"
                                 data-original-webp="{{ get_image_url($v['path']) }}?x-oss-process=image/format,webp"
                                 usemap="#planetmap_{{ $uid }}" data-width='{{ $v['image_width'] }}'/>
                            <map name="planetmap_{{ $uid }}" class="map-resize">
                                @if(!empty($v['hot_space']))
                                    @foreach($v['hot_space'] as $area)
                                        <area shape="rect" coords="{{ $area['areaMapInfo'] }}" href="{{ $area['areaLink'] }}"
                                              alt="{{ $area['areaTitle'] }}"/>
                                    @endforeach
                                @endif
                            </map>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <!--内容区域 end-->

@else
    <!--内容区域 start-->
        <div class="img-groups-box">
            @if($tpl_name != '' && $is_design)
                <a title="编辑" href="javascript:void(0)" class="pic-selector content-selector SZY-TPL-SELECTOR"
                   data-uid='{{ $uid }}' data-cat_id='1' data-type='14' data-number='1' data-hot_map='1'>
                    <i class="fa fa-edit"></i>
                    编辑
                </a>
            @endif

            <ul>
                <li>
                    <a class="item-pic example-text" href="javascript:void(0);" style="padding-top: 33.06%">
                        <span>此处建议添加1张宽度为1000像素的广告图片</span>
                    </a>
                </li>
            </ul>
            <!--内容区域 end-->

        </div>
    @endif

</div>


@if($is_design)
    <script type="text/javascript">
        $('#{{ $uid }}').find('.operateEdit').prepend('<a href="javascript:void(0);" class="style-btn SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="99" data-style_colorpicker="1" data-style_border="1"><div class="selector-box"><div class="arrow"></div><i class="fa fa-arrow-circle-o-up"></i>设置样式</div></a>')
    </script>
@endif


<script type="text/javascript">
    // $.imgloading.loading();
</script>
