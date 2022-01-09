 <div class="search-term m-b-10">
    <form id="searchForm" action="/shop/shop/picker" method="GET">
        <input type="hidden" name="page[page_id]" value="#ShopPickerPage_{{ $page_id }}">
        <input type="hidden" name="page[page_size]" value="10">
        <input type="hidden" name="output" value="1">
        <input type="hidden" name="selected_ids" value="1">
        <input type="hidden" name="shop_status" value="1">
        <input type="hidden" name="is_supply" value="0">
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
                    <span>店铺名称：</span>
                </label>
                <div class="form-control-wrap">
                    <input name="keywords" class="form-control" type="text" placeholder="请输入店铺名称">
                </div>
            </div>
        </div>
        <div class="simple-form-field">
            <input type="submit" id="btn_submit" class="btn btn-primary" value="搜索" />
        </div>
    </form>
</div>


{{--引入列表--}}
@include('shop.shop.partials._picker_shop_list')



<script type="text/javascript">
    var tablelist;
    $().ready(function() {
        var params = $("#searchForm").serializeJson();
        params.selected_ids = get_selected();
        tablelist = $("#table_ShopPickerPage_{{ $page_id }}").tablelist({
// 支持保存查询条件
            url: '/shop/shop/picker',
            page_id: "#ShopPickerPage_{{ $page_id }}",
            params: params
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