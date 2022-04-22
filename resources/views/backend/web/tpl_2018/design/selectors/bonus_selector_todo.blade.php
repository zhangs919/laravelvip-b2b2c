<!-- 红包选择器 -->
<div id="1519207326KVJar3">
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

        </tbody>
    </table>

    <!-- 红包容器 -->
    <div class="bonus-container"></div>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="ok" data-dismiss="modal">确定</button>
    </div>



</div>

<script type="text/javascript">
    $().ready(function() {

        var lastUuid = 0;

        var uuid = function() {
            return (new Date()).getTime() * 1000 + (lastUuid++) % 1000;
        }

        var type = '11';
        var cat_id = '1';
        var uid = '1519090451Q9J5N4';
        var select_count = '0';
        var max_number = '1';
        var select_count = '0';
        $("#1519207326KVJar3").find("#ok").click(function() {
            chk_value = [];
            $("#1519207326KVJar3").find('#addBonusTable tbody tr').each(function(i, v) {
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

//品牌列表
        var container = $("#1519207326KVJar3").find(".bonus-container");
        var page_id = "#BonusPickerPage_1519207326KVJar3";
        $.ajax({
            url: '/activity/bonus/picker',
            dataType: 'json',
            data: {
                page: {
                    page_id: page_id,
                    page_size: 10,
                },

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

        container.on('click', '.select-bonus', function() {
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
                    var td_name = "<td><input type='hidden' name='bonus_id' value='"+bonus_id+"'>" + bonus_name + "</td>";
                    var td_amount = "<td class='text-c'>" + bonus_amount + "</td>";
                    var td_min_goods_amount = "<td class='text-c'>" + min_goods_amount + "</td>";
                    var td_date = "<td class='text-c'>" + start_time + " ~ " + end_time + "</td>";
                    var td_sort = "<td class='text-c'><input class='form-control small' type='text' value='"+select_count+"' name='sort'></td>";
                    var td_hand = "<td class='handle'><a class='del bonus-del' href='javascript:;'>删除</a></td>";
                    var tr = "<tr>" + td_name + td_amount + td_min_goods_amount + td_date + td_sort + td_hand + "</tr>";
                    $("#1519207326KVJar3").find("#addBonusTable").append(tr);
                } else {
                    $.msg("您已经选择了此红包");
                }
            }
        });

        $("#1519207326KVJar3").on("click", ".bonus-del", function() {
            $(this).parent().parent().remove();
            select_count--;
        });

        $("#1519207326KVJar3").find("input[name='sort']").keyup(function() {
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
        $("#1519207326KVJar3").find('#addBonusTable tbody tr').each(function(i, v) {
            if ($(this).find('td input[name="bonus_id"]').val() == id) {
                judge = true;
            }
        });
        return judge;
    }
</script>