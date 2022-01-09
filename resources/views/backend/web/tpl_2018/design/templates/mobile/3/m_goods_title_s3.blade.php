<!-- 广告标题模板 -->
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_id='' data-shop_id='' data-tpl_name='{{ $tpl_name }}' data-tpl_type='{{ $tpl_type }}' data-is_valid='{{ $is_valid }}'>
@endif
{{--todo --}}
    <!--内容区域 start-->

    <h2 class="bg title">

        @if(!empty($data['4-1']))
            @foreach($data['4-1'] as $v)
                <font> </font>

                <span>{{ $v['name'] }}</span>

                <font> </font>
            @endforeach
        @else
            <font> </font>

            <span>添加标题</span>

            <font> </font>
        @endif
    </h2>

    <!--内容区域 end-->

@if($is_design)
</div>
@endif

<script type="text/javascript">

</script>