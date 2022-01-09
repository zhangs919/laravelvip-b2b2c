<!-- 商品标题模板 -->
@if($is_design)
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_id='' data-shop_id='' data-tpl_name='{{ $tpl_name }}' data-tpl_type='{{ $tpl_type ?? '' }}' data-is_valid='{{ $is_valid }}'>
@endif

    <!--内容区域 start-->



    <h4 class="goods-floor-title">

        @if(!empty($data['4-1']))
            @foreach($data['4-1'] as $v)
                <span class="title-name" style="color:{{ $v['color'] }};">{{ $v['name'] }}</span>
                <a href="{{ $v['link'] ?? 'javascript:void(0)' }}" class="more-link">
                    <span>更多</span>
                    <i class="iconfont" style="color:{{ $v['color'] }};"></i>
                </a>
            @endforeach
        @else
            <span class="title-name">添加标题</span>
            <a href="javascript:void(0)" class="more-link">
                <span>更多</span>
                <i class="iconfont"></i>
            </a>
        @endif


        @if($tpl_name != '' && $is_design)
            <a title="编辑" class="title-selector content-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="4" data-width="650" data-title_open_colorpicker="1" data-title_open_link="1" data-length="30">
                <i class="fa fa-edit"></i>
                编辑
            </a>
        @endif

    </h4>
    <!--内容区域 end-->


@if($is_design)
</div>
@endif