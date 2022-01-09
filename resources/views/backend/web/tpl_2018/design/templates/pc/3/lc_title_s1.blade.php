<!-- 广告标题模板 -->
@if($is_design)
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_name='{{ $tpl_name }}' data-is_valid='{{ $is_valid }}'>
@endif

    <div class="grid-ftit">

        @if($tpl_name != '' && $is_design)
            <a title="编辑" href="javascript:void(0)" class="selector title-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-title_open_colorpicker="1" data-number="5" data-type="4">
                <i class="fa fa-edit"></i>
                编辑
            </a>
        @endif


        @if(!empty($data['4-1']))
            @foreach($data['4-1'] as $v)
                <h3 style="color:{{ $v['color'] }};">{{ $v['name'] }}</h3>
            @endforeach
        @else
            <h3>添加标题</h3>
        @endif
    </div>


@if($is_design)
</div>
@endif
