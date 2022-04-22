<!-- 自定义模板 -->
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_id='' data-shop_id='' data-tpl_name='{{ $tpl_name }}' data-tpl_type='{{ $tpl_type ?? '' }}' data-is_valid='{{ $is_valid }}'>

    <!-- 内容开始 -->
    <div class="custom-box">
        <div class="custom">
            @if($tpl_name != '' && $is_design)
                <a title="编辑" href="javascript:void(0)" class="content-selector custom-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="10">
                    <i class="fa fa-edit"></i>
                    编辑
                </a>
            @endif


            @if(!empty($data['10-1']))
                @foreach($data['10-1'] as $v)
                    {!! $v['content'] !!}
                @endforeach
            @else
                <img src="/assets/d2eace91/images/design/example/custom_420_200.jpg" width="100%" />
            @endif

        </div>
    </div>
    <!-- 内容结束 -->

</div>

<!-- 调用需要的JS -->
<script type="text/javascript">

</script>