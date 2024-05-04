<!-- 默认缓载图片 -->
<!-- 手机端精品推荐模板 -->
<div class="drop-item SZY-PAGINATION-TPL {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_id='' data-shop_id='' data-tpl_name='{{ $tpl_name }}' data-tpl_type='{{ $tpl_type ?? '' }}' data-is_valid='{{ $is_valid }}'>

    @if($tpl_name != '' && $is_design)
        <a title="编辑" class="content-selector category-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="2" data-number="99" data-width="980">
            <i class="fa fa-edit"></i>
            编辑
        </a>
    @endif
        <div id="{{ $uid }}">
            <div class="goods-loading-box"></div>
        </div>
        <script type="text/javascript">
            //
        </script>
</div>
<script>

    {{--$().ready(function() {--}}
        {{--$.ajax({--}}
{{--//url: '/index/information/goods-list',--}}
            {{--url: $.baseurl('/site/tpl-data'),--}}
            {{--dataType: 'json',--}}
            {{--<!--  -->--}}
            {{--data: {--}}
                {{--tpl_code: 'm_goods_list',--}}
                {{--goods_ids: '@if(!empty($data['2-1'])){{ implode(',',array_column($data['2-1'], 'goods_id')) }}@else{{ 0 }}@endif',--}}
                {{--output: 0,--}}
                {{--shop_id: '{{ $shop_id ?? 0 }}',--}}
                {{--is_last: ''--}}
            {{--},--}}
            {{--success: function(result) {--}}
                {{--$('#{{ $uid }}').find('.goods-loading-box').html(result.data);--}}
                {{--$.imgloading.loading();--}}
            {{--}--}}
        {{--});--}}
    {{--});--}}

    //
</script>