{{--v3.0--}}
<div id="{{ $page_id }}" class="form-horizontal">
    <!-- 温馨提示 -->

    <div class="table-content m-t-10 clearfix">
        <table id="addActivityTable" class="table table-hover">
            <thead>
            <tr>
                <th class="text-c">商品图片</th>
                <th class="text-c">商品名称</th>
                <th class="text-c">活动时间</th>
                <th class="text-l">活动价格</th>
                <th class="text-c">排序</th>
                <th class="handle">操作</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
        <div class="simple-form-field">

            <div class="activity-container p-l-0 p-r-0"></div>

        </div>
    </div>
    <div class="modal-footer">

        <button type="button" class="btn btn-primary" id="ok" data-dismiss="modal">确定</button>
    </div>
</div>

<script type="text/javascript">
    function get_selected() {
        var ids = [];
        $('#{{ $page_id }}').find("input[name='id']").each(function(i, v) {
            ids.push($(this).val());
        });
        return ids.join(',');
    }
</script>

<script type="text/javascript">
    var type = '{{ $data['type'] }}';
    var act_type = '{{ $data['act_type'] }}';
    var cat_id = '{{ $data['cat_id'] }}';
    var uid = '{{ $data['uid'] }}';
    var select_count = '{{ isset($tpl_item_data['3-1']) ? count($tpl_item_data['3-1']) : 0 }}'; //'0';
    var max_number = '{{ $data['number'] }}';
    var container = $("#{{ $page_id }}").find(".activity-container");
    var page_id = "ActivityPickerPage_{{ $page_id }}";
    $.ajax({
        url: '/activity/activity/picker',
        dataType: 'json',
        data: {
            page: {
                page_id: page_id,
                page_size: 5,
            },
            output: true,
            act_type: act_type,
            selected_ids: get_selected()
        },
        beforeSend: function() {
            $.loading.start();
        },
        success: function(result) {
            container.html(result.data);
            $.loading.stop();
        }
    });
</script>

<script type="text/javascript">
    $().ready(function() {

        $(container).on('click', '.btn-goodspicker', function() {
            var id = $(this).parents('.sku-item').find('input[name="act_goods_id"]').val();
            var goods_name = $(this).parents('.sku-item').find('input[name="goods_name"]').val();
            var act_price = $(this).parents('.sku-item').find('input[name="act_price"]').val();
            var start_time = $(this).parents('.sku-item').find('input[name="start_time"]').val();
            var end_time = $(this).parents('.sku-item').find('input[name="end_time"]').val();
            var goods_image = $(this).parents('.sku-item').find('input[name="goods_image"]').val();
            if ($(this).data('selected') == false) {
                if (parseInt(select_count) >= parseInt(max_number)) {
                    $.msg("最多可以添加" + max_number + "个商品");
                } else {
                    if (!is_exist(id)) {
                        select_count++;
                        var td_image = "<td class='text-c'><img class='w50' src='"+goods_image+"'></td>";
                        var td_name = "<td class='text-1'><input type='hidden' name='id' value='"+id+"'>" + goods_name + "</td>";
                        var td_time = "<td class='text-c'>" + start_time + " ~ " + end_time + "</td>";
                        var td_price = "<td class='text-l'>" + act_price + "</td>";
                        var td_sort = "<td class='text-c'><input class='form-control small' type='text' value='"+select_count+"' name='sort'></td>";
                        var td_hand = "<td class='handle'><a class='del goods-del' data-id='"+id+"' href='javascript:;'>删除</a></td>";
                        var tr = "<tr>" + td_image + td_name + td_time + td_price + td_sort + td_hand + "</tr>";
                        $("#{{ $page_id }}").find("#addActivityTable").append(tr);

                        $(this).removeClass('btn-primary').addClass('btn-default');
                        $(this).data('selected', true);
                        $(this).find('i').removeClass('fa-plus').addClass('fa-check');
                        $(this).find('span').text('已选');

                    } else {
                        $.msg("您已经选择了此商品");
                    }
                }
            } else {
                $("#{{ $page_id }}").find(".goods-del[data-id='" + id + "']").click();
            }
        });

        $("#{{ $page_id }}").on("click", ".goods-del", function() {
            tablelist.params.selected_ids = get_selected();
            var button = $('#ActivityPickerPage_{{ $page_id }}').find('#handle_' + $(this).data('id')).find('.btn-goodspicker');
            $(button).removeClass('btn-default').addClass('btn-primary');
            $(button).data('selected', false);
            $(button).find('i').removeClass('fa-check').addClass('fa-plus');
            $(button).find('span').text('选择');
            $(this).parent().parent().remove();
            select_count--;
        });
    });
</script>

<script type="text/javascript">
    $().ready(function() {
        $("#{{ $page_id }}").find("#ok").click(function() {
            chk_value = [];
            $("#{{ $page_id }}").find('#addActivityTable tr').each(function(i, v) {
                chk_value.push({
                    id: $(this).find('td input[name="id"]').val(),
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

    });
</script>

<!-- 验证是否存在 -->
<script type="text/javascript">
    function is_exist(id) {
        var judge = false;
        $("#{{ $page_id }}").find('#addActivityTable tbody tr').each(function(i, v) {
            if ($(this).find('td input[name="id"]').val() == id) {
                judge = true;
            }
        });
        return judge;
    }
</script>