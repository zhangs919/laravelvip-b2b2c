<div class="link-mode pull-left" id="{{ $uuid }}">
    <input type="hidden" id="select_width" value="w120">
    <input type="hidden" id="page_code" value="">
    <input type="hidden" id="style" value="{{ $style }}">
    <select class="form-control w100 areaLinkType" id="link_type" name="link_type">
        <option value="0" @if($link_type == 0)selected="selected"@endif>自定义链接</option>
        <option value="1" @if($link_type == 1)selected="selected"@endif>常用链接</option>
        <option value="2" @if($link_type == 2)selected="selected"@endif>选择商品</option>
        <option value="3" @if($link_type == 3)selected="selected"@endif>店铺主页</option>
        <option value="8" @if($link_type == 8)selected="selected"@endif>文章分类</option>
        <option value="4" @if($link_type == 4)selected="selected"@endif>文章详情</option>
        <option value="5" @if($link_type == 5)selected="selected"@endif>分类商品</option>
        <option value="6" @if($link_type == 6)selected="selected"@endif>团购活动</option>
        <option value="7" @if($link_type == 7)selected="selected"@endif>品牌专题</option>
        <option value="9" @if($link_type == 9)selected="selected"@endif>专题活动</option>
        <option value="11" @if($link_type == 11)selected="selected"@endif>会员权益卡</option>
    </select>
    <span id="link_change">
        <select name="link" class="form-control  areaLinkInfo w150">
        </select>
    </span>
</div>
<!-- 处理切换连接类型 -->
<script type="text/javascript">
    //
</script>
<script type="text/javascript">
    var goods_picker_index = 0;
    $().ready(function() {
        $('#{{ $uuid }}').on('change', '#link_type', function() {
            var link_type = $(this).val();
            var select_width = $('#{{ $uuid }}').find('#select_width').val();
            var page = $('#{{ $uuid }}').find('#page_code').val();
            var style = $('#{{ $uuid }}').find('#style').val();
            //var link = $('#{{ $uuid }}').find("[name='link']").val();
            $.ajax({
                type: 'get',
                url: 'change-link-type',
                dataType: 'json',
                data: {
                    link_type: link_type,
                    select_width: select_width,
                    page: page,
                    style: style
                },
                success: function(result) {
                    $('#{{ $uuid }}').find('#link_change').html(result.data);
                    $('#{{ $uuid }}').find('.chosen-select').chosen();
                    $('#{{ $uuid }}').find('.chosen-container').addClass('w120');
                },
            });
        });
        // 商品选择器
        $('#{{ $uuid }}').on('click', '.goods-picker', function(e) {
            var id = $(this).parents('.link-mode').attr('id');
            var goods_id = $(this).attr('data-goods_id');
            $.open({
                title: '选择商品',
                width: 960,
                height: 520,
                btn: false,
                ajax: {
                    url: 'link-goods-picker',
                    data: {
                        id: id,
                        goods_id: goods_id
                    }
                },
                success: function(layero, index) {
                    goods_picker_index = index;
                }
            });
        });
    });
</script><script>

    $().ready(function() {
        $('#{{ $uuid }}').hide();
        $.ajax({
            type: 'get',
            url: 'change-link-type',
            dataType: 'json',
            data: {
                link_type: '{{ $link_type }}',
                link: '{{ $link }}',
                select_width: 'w120',
                page: '',
                style: '{{ $style }}'
            },
            success: function(result) {
                $('#{{ $uuid }}').find('#link_change').html(result.data);
                $('#{{ $uuid }}').find('.chosen-select').chosen();
                $('#{{ $uuid }}').find('.chosen-container').addClass('w120');
                $('#{{ $uuid }}').show();
            },
        });
    });

    //
</script>