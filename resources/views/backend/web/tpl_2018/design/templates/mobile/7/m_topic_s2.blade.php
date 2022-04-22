<!-- 默认缓载图片 -->
<!-- 手机端专题广告模板 -->
{{--背景颜色--}}
@php
    $bg_color = @$data['99-1'][0]['bgcolor'] != null ? $data['99-1'][0]['bgcolor'] : '';
    $height = @$data['99-1'][0]['height'] != null ? $data['99-1'][0]['height'] : '';
@endphp

<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_id='' data-shop_id='' data-tpl_name='{{ $tpl_name }}' data-tpl_type='{{ $tpl_type }}' data-is_valid='{{ $is_valid }}'>







    <div class="activity-img-groups clearfix activity-img-groups4" @if(!empty($bg_color)) style="background-color:{{ $bg_color }}; " @endif>

        @if($tpl_name != '' && $is_design)
            <a title="编辑" href="javascript:void(0)" class="pic-selector content-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="3" data-number="4">
                <i class="fa fa-edit"></i>
                编辑
            </a>
        @endif

        @if(!empty($data['3-1']))
            @foreach($data['3-1'] as $v)
                <div class="item">

                    <a class="item-img" href="javascript:void(0)" style="display: block; padding-top: 100%;">
                        <img class="" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" data-original-webp="{{ get_image_url($v['path']) }}?x-oss-process=image/format,webp/quality,q_75">
                    </a>
                </div>
            @endforeach
        @else
            @for($i=1; $i <= 4; $i++)
                <div class="item">
                    <a class="item-img" href="javascript:void(0);">
                        <img src="/assets/d2eace91/images/design/example/ad_img_110_135_2.png">
                    </a>
                </div>
            @endfor
        @endif
        

    </div>

</div>

@if($is_design)
<script type="text/javascript">
    $('#{{ $uid }}').find('.operateEdit').prepend('<a href="javascript:void(0);" class="decor-btn style-btn SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="99" data-style_colorpicker="1"><div class="selector-box"><div class="arrow"></div><i class="fa fa-arrow-circle-o-up"></i>设置样式</div></a>')
</script>
@endif