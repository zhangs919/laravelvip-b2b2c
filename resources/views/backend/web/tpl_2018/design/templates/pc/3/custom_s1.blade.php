<!-- 默认缓载图片 -->
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_name='{{ $tpl_name }}' data-is_valid='{{ $is_valid }}'>

    <!-- 内容开始 -->
    <div class="w1210 custom-box">
        <div class="custom">

            @if($tpl_name != '' && $is_design)
                <a href="javascript:void(0)" class="selector custom-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="1" data-type="10">
                    <i class="fa fa-edit"></i>
                    编辑
                </a>
            @endif

            @if(!empty($data['10-1']))
                @foreach($data['10-1'] as $v)
                    {!! $v['content'] !!}
                @endforeach
            @else
                <div class="example-text example-custom">
                    <span>自定义区域</span>
                </div>
            @endif


        </div>
    </div>
    <!-- 内容结束 -->

</div>
