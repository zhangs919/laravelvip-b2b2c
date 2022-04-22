<div id="{{ $page_id }}">
    <!-- 温馨提示 -->
    {{--explain_panel--}}
    @include('layouts.partials.explain_panel')



    <table id="addBrandTable" class="table table-hover">
        <thead>
        <tr>
            <th>品牌名称</th>
            <th class="text-c">品牌logo</th>
            <th class="text-c">排序</th>
            <th class="handle">操作</th>
        </tr>
        </thead>
        <tbody>

            @if(!empty($selector_data))
                @foreach($selector_data as $v)
                    <tr>
                        <td>
                            <input type='hidden' name='brand_id' value='{{ $v['brand_id'] }}' class="list-selected-ids">
                            {{ $v['brand_name'] }}
                        </td>
                        <td class="text-c">
                            <img class="w50" src="{{ get_image_url($v['brand_logo']) }}">
                        </td>
                        <td class="text-c">
                            <input class="form-control small" type="text" value="{{ $v['sort'] }}" name="sort">
                        </td>
                        <td class="handle">
                            <a class="del brand-del" data-brand_id="{{ $v['brand_id'] }}" href="javascript:void(0);">删除</a>
                        </td>
                    </tr>
                @endforeach
            @endif

        </tbody>
    </table>

    <!-- 品牌容器 -->
    <div class="brand-container"></div>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="ok" data-dismiss="modal">确定</button>
    </div>



</div>

<script type="text/javascript">
    function get_selected(){
        var ids = [];
        $('#{{ $page_id }}').find("input[name='brand_id']").each(function(i,v){
            ids.push($(this).val());
        });
        return ids.join(',');
    }
</script>

<script type="text/javascript">
    $().ready(function() {

        var lastUuid = 0;

        var uuid = function() {
            return (new Date()).getTime() * 1000 + (lastUuid++) % 1000;
        }

        var type = '{{ $data['type'] }}';
        var cat_id = '{{ $data['cat_id'] }}';
        var uid = '{{ $data['uid'] }}';
        var max_number = '{{ $data['number'] }}';
        var select_count = '{{ count($selector_data) }}'; // 已选择数量
        $("#{{ $page_id }}").find("#ok").click(function() {
            chk_value = [];
            $("#{{ $page_id }}").find('#addBrandTable tbody tr').each(function(i, v) {
                chk_value.push({
                    brand_id: $(this).find('td input[name="brand_id"]').val(),
                    sort: $(this).find('td input[name="sort"]').val() == '' ? '255' : $(this).find('td input[name="sort"]').val()
                });
            });
            if (chk_value.length == 0) {
                $.msg("请选择品牌");
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
        var container = $("#{{ $page_id }}").find(".brand-container");
        var page_id = "#BrandPickerPage_{{ $page_id }}";

        $.ajax({
            url: '/goods/brand/picker',
            dataType: 'json',
            data: {
                page: {
                    page_id: page_id,
                    page_size: 10,
                },
                selected_ids : get_selected(),
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

        container.on('click', '.select-brand', function() {
            var brand_id = $(this).attr('brand_id');
            var brand_name = $(this).attr('brand_name');
            var brand_logo = $(this).attr('brand_logo');
            if (parseInt(select_count) >= parseInt(max_number)) {
                $.msg("最多可以添加" + max_number + "个品牌");
            } else {
                if (!is_exist(brand_id)) {
                    select_count++;
                    var td_name = "<td><input type='hidden' name='brand_id' value='"+brand_id+"'>" + brand_name + "</td>";
                    var td_logo = "<td class='text-c'><img class='w50' src='"+brand_logo+"'></td>";
                    var td_sort = "<td class='text-c'><input class='form-control small' type='text' value='"+select_count+"' name='sort'></td>";
                    var td_hand = "<td class='handle'><a class='del brand-del' data-brand_id='"+brand_id+"' href='javascript:;'>删除</a></td>";
                    var tr = "<tr>" + td_name + td_logo + td_sort + td_hand + "</tr>";
                    $("#{{ $page_id }}").find("#addBrandTable").append(tr);
//从新传值
//$("#{{ $page_id }}").find("input[name='selected_ids']").val(get_selected());
                    tablelist.params.selected_ids = get_selected();
                    $(this).parent().find('a').addClass('active').html('已选');
                } else {
                    $.msg("您已经选择了此品牌");
                }
            }
        });

        $("#{{ $page_id }}").on("click", ".brand-del", function() {
            $(this).parent().parent().remove();
            tablelist.params.selected_ids = get_selected();
            $('#{{ $page_id }}').find('#handle_'+$(this).data('brand_id')).find('a').removeClass('active').html('选择');
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
        $("#{{ $page_id }}").find('#addBrandTable tbody tr').each(function(i, v) {
            if ($(this).find('td input[name="brand_id"]').val() == id) {
                judge = true;
            }
        });
        return judge;
    }
</script>