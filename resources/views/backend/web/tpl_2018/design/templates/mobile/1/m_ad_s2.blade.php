<!-- 默认缓载图片 -->
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_id='' data-shop_id='' data-tpl_name='{{ $tpl_name }}' data-tpl_type='{{ $tpl_type ?? '' }}' data-is_valid='{{ $is_valid }}'>

<!--内容区域 start-->


    <div class="img-groups-box" @if(!empty($data['99-1'][0]['bgcolor'])) style="background-color: {{ $data['99-1'][0]['bgcolor'] }};" @endif>

        @if(!empty($data['3-1']) && !empty($data['3-2']) && count($data['3-2'] ?? []) >= 2)
            @php
            $image_block_width = $data['3-1'][0]['image_width'] + max(array_column($data['3-2'], 'image_width'));
            $first_image_width_percent = calc_width($data['3-1'][0]['image_width'], $image_block_width);
            $second_image_width_percent = calc_width(max(array_column($data['3-2'], 'image_width')), $image_block_width);
            @endphp
        @endif

        <dl >
            <dt @if(isset($first_image_width_percent))style="width:{{ $first_image_width_percent }}%"@endif>


                @if($tpl_name != '' && $is_design)
                    <a title="编辑" href="javascript:void(0)" class="pic-selector content-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="3">
                        <i class="fa fa-edit"></i>
                        编辑
                    </a>
                @endif

                @if(!empty($data['3-1']))
                    @foreach($data['3-1'] as $k=>$v)
                        <a class="item-pic" href="{{ $v['link'] ?? 'javascript:void(0)' }}" style="display: block; padding-top: {{ calc_padding_top($v['image_height'], $v['image_width']) }}%;">
                            <img class="" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" data-original-webp="{{ get_image_url($v['path']) }}?x-oss-process=image/format,webp/quality,q_75" style="display: block;">
                        </a>
                    @endforeach
                @else
                    <a href="javascript:void(0);" style="padding-top:106.66%" class="example-text special item-pic">
                        <span>此处添加广告图片</span>
                    </a>
                @endif


            </dt>
            <dd @if(isset($second_image_width_percent))style="width:{{ $second_image_width_percent }}%"@endif>

                @if($tpl_name != '' && $is_design)
                    <a title="编辑" href="javascript:void(0)" class="pic-selector content-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="2" data-type="3" data-number="2">
                        <i class="fa fa-edit"></i>
                        编辑
                    </a>
                @endif

                @if(!empty($data['3-2']))
                    @foreach($data['3-2'] as $k=>$v)
                        <span>

                            <a class="item-pic" href="{{ $v['link'] ?? 'javascript:void(0)' }}" style="display: block; padding-top: {{ calc_padding_top($v['image_height'], $v['image_width']) }}%;">
                                <img class="ad" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" data-original-webp="{{ get_image_url($v['path']) }}?x-oss-process=image/format,webp/quality,q_75" style="display: block;">
                            </a>
                        </span>
                    @endforeach
                @else
                    <span class="border-bottom">
                    <a class="example-text item-pic" href="javascript:void(0);" style="padding-top:53.33%">
                    <span>此处添加广告图片</span>
                    </a>
                    </span>
                    <span>
                    <a class="example-text dark item-pic" href="javascript:;" style="padding-top:53.33%">
                    <span>此处添加广告图片</span>
                    </a>
                    </span>
                @endif



            </dd>
        </dl>
        <!--内容区域 end-->
    </div>


</div>

@if($is_design)
<script type="text/javascript">
    $('#{{ $uid }}').find('.operateEdit').prepend('<a href="javascript:void(0);" class="SZY-TPL-SELECTOR decor-btn style-btn" data-uid="{{ $uid }}" data-cat_id="1" data-type="99" data-style_colorpicker="1" data-style_border="1"><div class="selector-box"><div class="arrow"></div><i class="fa fa-arrow-circle-o-up"></i>设置样式</div></a>')
</script>
@endif




<script type="text/javascript">
    // $.imgloading.loading();
</script>