<div class="search-term  m-b-10" id="{{ $page_id }}">
    <form id="searchForm" action="/activity/bonus/picker" method="GET">
        <input type="hidden" name="page[page_id]" value="{{ $pagination_id }}">
        <input type="hidden" name="page[page_size]" value="10">
        <input type="hidden" name="selected_ids" value="{{ implode(',', $selected_ids) }}">
        <input type="hidden" name="output" value="1"> <input type="hidden" value="0" name="output">
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
                    <span>红包名称：</span>
                </label>
                <div class="form-control-wrap">
                    <input name="keywords" class="form-control" type="text" placeholder="输入红包名称">
                </div>
            </div>
        </div>
        <div class="simple-form-field">
            <input type="submit" id="btn_submit" class="btn btn-primary" value="搜索"/>
        </div>
    </form>
</div>
{{--引入列表--}}
@include('activity.bonus.partials._picker_list')

<script type="text/javascript">
    //
</script>
<script>

    $().ready(function () {
        $(".pagination-goto > .goto-input").keyup(function (e) {
            $(".pagination-goto > .goto-link").attr("data-go-page", $(this).val());
            if (e.keyCode == 13) {
                $(".pagination-goto > .goto-link").click();
            }
        });
        $(".pagination-goto > .goto-button").click(function () {
            var page = $(".pagination-goto > .goto-link").attr("data-go-page");
            if ($.trim(page) == '') {
                return false;
            }
            $(".pagination-goto > .goto-link").attr("data-go-page", page);
            $(".pagination-goto > .goto-link").click();
            return false;
        });
    });

    //


    var tablelist;
    $().ready(function () {
        var params = $('#{{ $page_id }}').find("#searchForm").serializeJson();
        params.selected_ids = get_selected();

        tablelist = $("#table_list").tablelist({
// 支持保存查询条件
            url: '/activity/bonus/picker',
            page_id: "{{ $pagination_id }}",
            params: params
        });
        if (get_selected && typeof (get_selected) == "function") {
            tablelist.params.selected_ids = get_selected();
        }
// 搜索
        $('#{{ $page_id }}').find("#searchForm").submit(function () {
// 序列化表单为JSON对象
            var data = $(this).serializeJson();
            data.selected_ids = get_selected();
// Ajax加载数据
            tablelist.load(data);
// 阻止表单提交
            return false;
        });

    });

    //
</script>