<!-- 空白模板 -->
{{--背景颜色--}}
@php
    $bg_color = @$data['99-1'][0]['bgcolor'] != null ? $data['99-1'][0]['bgcolor'] : '';
    $height = @$data['99-1'][0]['height'] != null ? $data['99-1'][0]['height'] : '';
@endphp

<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_id='' data-shop_id='' data-tpl_name='{{ $tpl_name }}' data-tpl_type='{{ $tpl_type ?? '' }}' data-is_valid='{{ $is_valid }}'>


    <!-- <!--内容区域 start-->
    <div class="blank-div" style="@if(!empty($bg_color)) height:{{ $height }}px;background:{{ $bg_color }} @endif"></div>
    <!--内容区域 end-->


</div>

@if($is_design)
<script type="text/javascript">
    $('#{{ $uid }}').find('.operateEdit').prepend('<a href="javascript:void(0);" class="decor-btn style-btn SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-type="99" data-style_colorpicker="1" data-style_height="1" data-default_height="8"><div class="selector-box"><div class="arrow"></div><i class="fa fa-arrow-circle-o-up"></i>设置样式</div></a>');
</script>
@endif