<!-- 默认缓载图片 -->
<!-- 手机端广告模板板式四 -->
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_id='' data-shop_id='' data-tpl_name='{{ $tpl_name }}' data-tpl_type='{{ $tpl_type ?? '' }}' data-is_valid='{{ $is_valid }}'>

    <div class="activity-img-groups clearfix @if(count($data['3-1'] ?? []) > 0) activity-img-groups{{ count($data['3-1'] ?? []) }} @endif" @if(!empty($data['99-1'][0]['bgcolor'])) style="background-color: {{ $data['99-1'][0]['bgcolor'] }};" @endif>

        @if($tpl_name != '' && $is_design)
            <a title="编辑" href="javascript:void(0)" class="pic-selector content-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="3" data-number="4">
                <i class="fa fa-edit"></i>
                编辑
            </a>
        @endif
        @if(!empty($data['3-1']))
            @foreach($data['3-1'] as $k=>$v)
                <div class="item">
                    <a class="item-img" href="{{ $v['link'] ?? 'javascript:void(0)' }}" style="display: block; padding-top: {{ calc_padding_top($v['image_height'], $v['image_width']) }}%;">
                        <img class="" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" data-original-webp="{{ get_image_url($v['path']) }}?x-oss-process=image/format,webp/quality,q_75" style="display: block;">
                    </a>
                </div>
            @endforeach
        @else
            <div class="item">
                <a href="javascript:void(0);" class="example-text item-img" style="padding-top:20%"><span>此处可添加1-4张广告图片</span></a>
            </div>
        @endif


    </div>

</div>

@if($is_design)
<script type="text/javascript">
    $('#{{ $uid }}').find('.operateEdit').prepend('<a href="javascript:void(0);" class="decor-btn style-btn SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="99" data-style_colorpicker="1"><div class="selector-box"><div class="arrow"></div><i class="fa fa-arrow-circle-o-up"></i>设置样式</div></a>')
</script>
@endif

