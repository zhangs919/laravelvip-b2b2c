<!-- 广告标题模板 -->
@if($is_design)
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_id='' data-shop_id='' data-tpl_name='{{ $tpl_name }}' data-tpl_type='{{ $tpl_type ?? '' }}' data-is_valid='{{ $is_valid }}'>
@endif

    <!--内容区域 start-->

    <h2 class="title" style="background-color: {{ @$data['99-1'][0]['bgcolor'] != null ? $data['99-1'][0]['bgcolor'] : '' }};">

        @if($tpl_name != '' && $is_design)
            <a title="编辑" href="javascript:void(0)" class="title-selector content-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="4" data-width="650" data-title_open_colorpicker="1" data-length="30">
                <i class="fa fa-edit"></i>
                编辑
            </a>
        @endif

        @if(!empty($data['4-1']))
            @foreach($data['4-1'] as $v)
                <font style="background:{{ $v['color'] }};">&nbsp;</font>

                &nbsp;&nbsp;

                <span style="color:{{ $v['color'] }};">{{ $v['name'] }}</span>

                &nbsp;&nbsp;

                <font style="background:{{ $v['color'] }};">&nbsp;</font>
            @endforeach
        @else
            <font>&nbsp;</font>
            &nbsp;&nbsp;
            <span>添加标题</span>
            &nbsp;&nbsp;
            <font>&nbsp;</font>
        @endif

    </h2>

    <!--内容区域 end-->


@if($is_design)
</div>

<script type="text/javascript">
    $('#{{ $uid }}').find('.operateEdit').prepend('<a href="javascript:void(0);" class="decor-btn style-btn SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="99" data-style_colorpicker="1"><div class="selector-box"><div class="arrow"></div><i class="fa fa-arrow-circle-o-up"></i>设置样式</div></a>')
</script>
@endif