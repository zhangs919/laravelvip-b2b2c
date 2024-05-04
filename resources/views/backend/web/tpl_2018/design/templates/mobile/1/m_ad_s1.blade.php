<!-- 默认缓载图片 -->
<!-- 微商城广告模板 -->
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_id='' data-shop_id='' data-tpl_name='{{ $tpl_name }}' data-tpl_type='{{ $tpl_type ?? '' }}' data-is_valid='{{ $is_valid }}'>

    <!--内容区域 start-->






    <div class="img-groups-box @if(count($data['3-1'] ?? []) > 0) img-groups{{ count($data['3-1'] ?? []) }}-box @endif" @if(!empty($data['99-1'][0]['bgcolor'])) style="background-color: {{ $data['99-1'][0]['bgcolor'] }};" @endif>

        <ul @if(empty($data['99-1'][0]['border'])) class="border-0" @endif>
            @if($tpl_name != '' && $is_design)
                <a title="编辑" href="javascript:void(0)" class="pic-selector content-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="3" data-number="5">
                    <i class="fa fa-edit"></i>
                    编辑
                </a>
            @endif

            @if(!empty($data['3-1']))
                @foreach($data['3-1'] as $k=>$v)
                    <li id="pic_1_{{ $k }}" style='width: {{ calc_width($v['image_width'],array_sum(array_column($data['3-1'], 'image_width'))) }}%'>
                        <a class="item-pic" href="{{ $v['link'] ?? 'javascript:void(0)' }}" style="background: url({{ get_image_url(sysconf('default_lazyload_mobile')) }}) no-repeat center center; display: block; background-size: 100px; background-color: #fff; padding-top: {{ calc_padding_top($v['image_height'], $v['image_width']) }}%">
                            <img class="lazy" src="/assets/d2eace91/images/common/blank.png" data-original="{{ get_image_url($v['path']) }}" data-original-webp="{{ get_image_url($v['path']) }}?x-oss-process=image/format,webp/quality,q_75" />
                        </a>
                    </li>
                @endforeach
            @else
                <li>
                    <a class="item-pic example-text" href="javascript:void(0);" style="padding-top:33.06%"><span>此处可添加1-5张广告图片</span></a>
                </li>
            @endif

        </ul>

        <!--内容区域 end-->
    </div>


</div>

@if($is_design)
<script type="text/javascript">
    $('#{{ $uid }}').find('.operateEdit').prepend('<a href="javascript:void(0);" class="style-btn SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="99" data-style_colorpicker="1" data-style_border="1"><div class="selector-box"><div class="arrow"></div><i class="fa fa-arrow-circle-o-up"></i>设置样式</div></a>')
</script>
@endif


<script type="text/javascript">
    // $.imgloading.loading();
</script>