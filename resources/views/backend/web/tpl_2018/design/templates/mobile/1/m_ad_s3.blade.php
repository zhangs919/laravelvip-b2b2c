<!-- 默认缓载图片 -->
<!-- 手机端广告模板 -->
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_id='' data-shop_id='' data-tpl_name='{{ $tpl_name }}' data-tpl_type='{{ $tpl_type ?? '' }}' data-is_valid='{{ $is_valid }}'>

    <!--内容区域 start-->



    <div class="img-groups-box img-groups8-box">

        @if($tpl_name != '' && $is_design)
            <a title="编辑" href="javascript:void(0)" class="pic-selector content-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="3" data-number="8">
                <i class="fa fa-edit"></i>
                编辑
            </a>
        @endif

        <ul>

            @if(!empty($data['3-1']))
                @foreach($data['3-1'] as $v)
                    <li>
                        <a class="item-pic" href="{{ $v['link'] ?? 'javascript:void(0)' }}" style="display: block; padding-top: {{ calc_padding_top($v['image_height'], $v['image_width']) }}%;">
                            <img class="" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" data-original-webp="{{ get_image_url($v['path']) }}?x-oss-process=image/format,webp/quality,q_75" style="display: block;">
                        </a>
                    </li>
                @endforeach
            @else
                @for($i=1; $i <= 8; $i++)
                    <li>
                        <a class="example-text special item-pic" href="javascript:void(0);" style="padding-top:120%">
                            <span>此处添加广告图片</span>
                        </a>
                    </li>
                @endfor
            @endif

        </ul>

    </div>
    <!--内容区域 end-->

</div>

@if($is_design)
<script type="text/javascript">
    $('#{{ $uid }}').find('.operateEdit').prepend('<a href="javascript:void(0);" class="SZY-TPL-SELECTOR decor-btn style-btn" data-uid="{{ $uid }}" data-cat_id="1" data-type="99" data-style_colorpicker="1" data-style_border="1"><div class="selector-box"><div class="arrow"></div><i class="fa fa-arrow-circle-o-up"></i>设置样式</div></a>')
</script>
@endif

<script type="text/javascript">
    $.imgloading.loading();
</script>