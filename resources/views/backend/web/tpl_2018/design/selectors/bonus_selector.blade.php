<!-- 红包选择器 -->
<div id="{{ $page_id }}">
    <!-- 温馨提示 -->
    <table id="addBonusTable" class="table table-hover">
        <thead>
        <tr>
            <th>红包名称</th>
            <th class="text-c">红包金额</th>
            <th class="text-c">最小订单金额</th>
            <th class="text-c">有效期</th>
            <th class="text-c">排序</th>
            <th class="handle">操作</th>
        </tr>
        </thead>
        <tbody>
        @if(!empty($selector_data))
            @foreach($selector_data as $v)
                <tr>
                    <td><input type="hidden" name="bonus_id" value="{{ $v['bonus_id'] }}">{{ $v['bonus_name'] }}</td>
                    <td class="text-c">{{ $v['bonus_amount'] }}</td>
                    <td class="text-c">{{ $v['min_goods_amount'] }}</td>
                    <td class="text-c">{{ $v['start_time'] }} ~ {{ $v['end_time'] }}</td>
                    <td class="text-c"><input class="form-control small" type="text" value="{{ $v['sort'] }}" name="sort"
                                              onkeyup="validateInteger(this)"></td>
                    <td class="handle"><a class="del bonus-del" data-bonus_id="{{ $v['bonus_id'] }}" href="javascript:;">删除</a></td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
    <!-- 红包容器 -->
    <div class="bonus-container"></div>
    <div class="modal-footer pos-r">
        <button type="button" class="btn btn-primary" id="ok" data-dismiss="modal">确定</button>
    </div>
</div>
<script type="text/javascript">
    // 
</script>
<script type="text/javascript">
    // 
</script>
<!-- 验证是否存在 -->
<script type="text/javascript">
    // 
</script>
<script>

    function get_selected() {
        var ids = [];
        $('#{{ $page_id }}').find("input[name='bonus_id']").each(function (i, v) {
            ids.push($(this).val());
        });
        return ids.join(',');
    }

    // 


    $().ready(function () {

        var lastUuid = 0;

        var uuid = function () {
            return (new Date()).getTime() * 1000 + (lastUuid++) % 1000;
        }

        var type = '{{ $data['type'] }}';
        var cat_id = '{{ $data['cat_id'] }}';
        var uid = '{{ $data['uid'] }}';
        var max_number = '{{ $data['number'] }}';
        var select_count = '{{ count($selector_data) }}';
        $("#{{ $page_id }}").find("#ok").click(function () {
            chk_value = [];
            $("#{{ $page_id }}").find('#addBonusTable tbody tr').each(function (i, v) {
                chk_value.push({
                    bonus_id: $(this).find('td input[name="bonus_id"]').val(),
                    sort: $(this).find('td input[name="sort"]').val() == '' ? '255' : $(this).find('td input[name="sort"]').val()
                });
            });
            if (chk_value.length == 0) {
                $.msg("请选择红包");
                return false;
            }
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

//红包列表
        var container = $("#{{ $page_id }}").find(".bonus-container");
        var page_id = "#BonusPickerPage_{{ $page_id }}";
        $.ajax({
            url: '/activity/bonus/picker',
            dataType: 'json',
            data: {
                page: {
                    page_id: page_id,
                    page_size: 10,
                },
                selected_ids: get_selected(),
                output: 1
            },
            beforeSend: function () {
                $.loading.start();
            },
            success: function (result) {
                container.html(result.data);
                $.loading.stop();
            }
        });

        container.on('click', '.select-bonus', function () {
            var bonus_id = $(this).data('bonus_id');
            var bonus_name = $(this).data('bonus_name');
            var bonus_amount = $(this).data('bonus_amount');
            var min_goods_amount = $(this).data('min_goods_amount');
            var start_time = $(this).data('start_time');
            var end_time = $(this).data('end_time');
            if (parseInt(select_count) >= parseInt(max_number)) {
                $.msg("最多可以添加" + max_number + "个红包");
            } else {
                if (!is_exist(bonus_id)) {
                    select_count++;
                    var td_name = "<td><input type='hidden' name='bonus_id' value='" + bonus_id + "'>" + bonus_name + "</td>";
                    var td_amount = "<td class='text-c'>" + bonus_amount + "</td>";
                    var td_min_goods_amount = "<td class='text-c'>" + min_goods_amount + "</td>";
                    var td_date = "<td class='text-c'>" + start_time + " ~ " + end_time + "</td>";
                    var td_sort = "<td class='text-c'><input class='form-control small' type='text' value='" + select_count + "' name='sort' onkeyup='validateInteger(this)'></td>";
                    var td_hand = "<td class='handle'><a class='del bonus-del' data-bonus_id='" + bonus_id + "' href='javascript:;'>删除</a></td>";
                    var tr = "<tr>" + td_name + td_amount + td_min_goods_amount + td_date + td_sort + td_hand + "</tr>";
                    $("#{{ $page_id }}").find("#addBonusTable").append(tr);
                    tablelist.params.selected_ids = get_selected();
                    $(this).parent().find('a').addClass('active').html('已选');
                } else {
                    $.msg("您已经选择了此红包");
                }
            }
        });

        $("#{{ $page_id }}").on("click", ".bonus-del", function () {
            $(this).parent().parent().remove();
            tablelist.params.selected_ids = get_selected();
            $('#{{ $page_id }}').find('#handle_' + $(this).data('bonus_id')).find('a').removeClass('active').html('选择');
            select_count--;
        });

        /*$("#{{ $page_id }}").find("input[name='sort']").keyup(function() {
        var tmptxt = $(this).val();
        $(this).val(tmptxt.replace(/\D|^0/g, ''));
        }).bind("paste", function() {
        var tmptxt = $(this).val();
        $(this).val(tmptxt.replace(/\D|^0/g, ''));
        }).css("ime-mode", "disabled");*/
    });

    // 


    function is_exist(id) {
        var judge = false;
        $("#{{ $page_id }}").find('#addBonusTable tbody tr').each(function (i, v) {
            if ($(this).find('td input[name="bonus_id"]').val() == id) {
                judge = true;
            }
        });
        return judge;
    }

    // 
</script>