<div class="search-term m-b-10">
    <form id="searchForm" action="/goods/brand/picker" method="GET">
        <input type="hidden" name="page[page_id]" value="{{ $pagination_id }}">
        <input type="hidden" name="page[page_size]" value="10">
        <input type="hidden" name="selected_ids" value="{{ implode(',', $selected_ids) }}">
        <input type="hidden" name="output" value="1">
        <input type="hidden" value="0" name="output">
        <div class="simple-form-field simple-form-search">
            <div class="form-group">
                <label class="control-label">
                    <i class="fa fa-search"></i>
                </label>
            </div>
        </div>
        <div class="simple-form-field">
            <div class="form-group">
                <label class="control-label">
                    <span>品牌名称：</span>
                </label>
                <div class="form-control-wrap">
                    <input name="brand_name" class="form-control" type="text" placeholder="">
                </div>
            </div>
        </div>
        <div class="simple-form-field">
            <input type="submit" id="btn_submit" class="btn btn-primary" value="搜索" />
        </div>
    </form>
</div>


{{--引入列表--}}
@include('backend::goods.brand.partials._picker_brand_list')


<script type="text/javascript">
    var tablelist;
    $().ready(function() {
        var params = $("#searchForm").serializeJson();
        params.selected_ids = get_selected();
        tablelist = $("#table_list").tablelist({
// 支持保存查询条件
            url: '/goods/brand/picker',
            page_id: "{{ $pagination_id }}",
            params: $("#searchForm").serializeJson()
        });
        if (get_selected && typeof (get_selected) == "function") {
            tablelist.params.selected_ids = get_selected();
        }
// 搜索
        $("#searchForm").submit(function() {
// 序列化表单为JSON对象
            var data = $(this).serializeJson();
            data.selected_ids = get_selected();
// Ajax加载数据
            tablelist.load(data);
// 阻止表单提交
            return false;
        });

    });
</script>