<div id="{{ $page_id }}" class="form-horizontal">
    <!-- 温馨提示 -->
    {{--explain_panel--}}
    @include('layouts.partials.explain_panel')


    <!-- 分类容器 -->
    <table id="addCategoryTable" class="table table-hover m-b-10">
        <thead>
        <tr>
            <th>分类名称</th>
            <th class="text-c">排序</th>
            <th class="handle">操作</th>
        </tr>
        </thead>
        <tbody>

        @if(!empty($selector_data))
            @foreach($selector_data as $v)
                <tr>
                    <td>
                        <input type='hidden' name='cat_id' value='{{ $v['cat_id'] }}'>
                        {{ $v['cat_name'] }}
                    </td>
                    <td class="text-c">
                        <input class="form-control small" type="text" value="{{ $v['sort'] }}" name="sort">
                    </td>
                    <td class="handle">
                        <a class="del category-del" href="javascript:void(0);">删除</a>
                    </td>
                </tr>
            @endforeach
        @endif

        </tbody>
    </table>
    <div class="table-content m-t-10 clearfix">
        <div class="category-container"></div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="ok" data-dismiss="modal">确定</button>
    </div>
</div>

<script type="text/javascript">
    $().ready(function() {
        var type = '{{ $data['type'] }}';
        var cat_id = '{{ $data['cat_id'] }}';
        var uid = '{{ $data['uid'] }}';
        var select_count = '{{ count($selector_data) }}';
        var max_number = '{{ $data['number'] }}';
        $("#{{ $page_id }}").find("#ok").click(function() {
            chk_value = [];
            $("#{{ $page_id }}").find('#addCategoryTable tr').each(function(i, v) {
                chk_value.push({
                    cat_id: $(this).find('td input[name="cat_id"]').val(),
                    sort: $(this).find('td input[name="sort"]').val() == '' ? '255' : $(this).find('td input[name="sort"]').val()
                });
            });
            //上传数据
            $.designadddata({
                data: {
                    uid: uid,
                    chk_value: chk_value,
                    type: type,
                    cat_id: cat_id
                },
            });
        });

        //分类列表
        var container = $("#{{ $page_id }}").find(".category-container");
        $.ajax({
            url: '/goods/category/picker',
            dataType: 'json',
            data: {
                is_show: 1,
                output: 1
            },
            beforeSend: function() {
                $.loading.start();
            },
            success: function(result) {
                container.html(result.data);
                $.loading.stop();
            }
        });

        container.on('click', '.select-category', function() {
            var cat_id = container.find('#choose_cat_id').val();
            var cat_name = $.trim(container.find('#choose_cat_name').val());
            cat_name = $.trim(cat_name.replace("◢", ""));
            if (parseInt(select_count) >= parseInt(max_number)) {
                $.msg("最多可以添加" + max_number + "个分类");
            } else {
                if (!is_exist(cat_id)) {
                    select_count++;
                    var td_name = "<td><input type='hidden' name='cat_id' value='"+cat_id+"'>" + cat_name + "</td>";
                    var td_sort = "<td class='text-c'><input class='form-control small' type='text' value='"+select_count+"' name='sort'></td>";
                    var td_hand = "<td class='handle'><a class='del category-del' href='javascript:;'>删除</a></td>";
                    var tr = "<tr>" + td_name + td_sort + td_hand + "</tr>";
                    $("#{{ $page_id }}").find("#addCategoryTable").append(tr);
                } else {
                    $.msg("您已经选择了此分类");
                }
            }
        });

        $("#{{ $page_id }}").on("click", ".category-del", function() {
            $(this).parent().parent().remove();
            select_count--;
        });

        $("#{{ $page_id }}").find("input[name='sort']").keyup(function() {
            var tmptxt = $(this).val();
            $(this).val(tmptxt.replace(/\D|^0/g, ''));
        }).bind("paste", function() {
            var tmptxt = $(this).val();
            $(this).val(tmptxt.replace(/\D|^0/g, ''));
        }).css("ime-mode", "disabled");
    });
</script>

<!-- 验证是否存在 -->
<script type="text/javascript">
    function is_exist(id) {
        var judge = false;
        $("#{{ $page_id }}").find('#addCategoryTable tbody tr').each(function(i, v) {
            if ($(this).find('td input[name="cat_id"]').val() == id) {
                judge = true;
            }
        });
        return judge;
    }
</script>