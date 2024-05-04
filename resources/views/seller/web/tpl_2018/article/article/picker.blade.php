<div id="{{ $page_id }}">
    <div class="search-term m-b-10">
        <form id="searchForm" action="/article/article/picker" method="GET">
            <input type="hidden" name="cat_type" value="1,2,11,12">
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
                    <div class="form-control-wrap">
                        <select name="cat_id" class="form-control chosen-select" id="select_cat_id">

                            <option value="0">所有分类</option>

							@if(!empty($cat_list))
								@foreach($cat_list as $v)
									<option value="{{ $v['cat_id'] }}" @if(!$v['active']) disabled="true" @endif>{!! $v['title_show'] !!}</option>
								@endforeach
							@endif

                        </select>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>标题：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input name="keywords" class="form-control" type="text" placeholder="">
                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <input type="submit" id="btn_submit" class="btn btn-primary" value="搜索" />
            </div>
        </form>
    </div>


    {{--引入列表--}}
    @include('article.article.partials._picker_article_list')

</div>


<script type="text/javascript">
    var tablelist;
    $().ready(function() {
        var params = $('#{{ $page_id }}').find("#searchForm").serializeJson()
        params.selected_ids = get_selected();
        tablelist = $("#table_list").tablelist({
// 支持保存查询条件
            url: '/article/article/picker',
            page_id: "{{ $pagination_id }}",
            params: params
        });
        if (get_selected && typeof (get_selected) == "function") {
            tablelist.params.selected_ids = get_selected();
        }
// 搜索
        $('#{{ $page_id }}').find("#searchForm").submit(function() {
// 序列化表单为JSON对象
            var data = $(this).serializeJson();
            data.selected_ids = get_selected();
// Ajax加载数据
            tablelist.load(data);
// 阻止表单提交
            return false;
        });


        try {
// chosen带搜索的select框
            $('.chosen-select').chosen();
        } catch (e) {
// console.warn("初始化“chosen”发生错误：" + e);
        }

        $('#{{ $page_id }}').find('#select_cat_id_chosen').css("cssText", "width:200px !important;");
    });
</script>
