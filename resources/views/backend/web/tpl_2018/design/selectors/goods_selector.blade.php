<div id="{{ $page_id }}" class="form-horizontal">
    <!-- 温馨提示 -->

    {{--explain_panel--}}
    @include('layouts.partials.explain_panel')


    <div class="table-content m-t-10 clearfix">

        @if(!empty($data['goods_open_title']))
        <div class="simple-form-field">
            <div class="form-group">
                <label for="text4" class="col-sm-3 control-label">
                    <span class="ng-binding">
                    <span class="text-danger ng-binding">*</span>
                    分类名称：
                    </span>
                </label>
                <div class="col-sm-7">
                    <div class="form-control-box">
                        <input class="form-control" type="text" value="{{ $ext_info['cat'][$data['cat_id']] ?? '' }}" id="cat_name">
                    </div>
                    <div class="help-block help-block-t">
                        <div class="help-block help-block-t">标题不能为空，最多输入{{ $data['length'] }}个字</div>
                    </div>
                </div>
            </div>
        </div>
        @endif


        <table id="addGoodsTable" class="table table-hover">
            <thead>
            <tr>
                <th class="text-c">商品图片</th>
                <th class="text-c">商品名称</th>
                <th class="text-c">商品价格</th>
                <th class="text-c">排序</th>
                <th class="handle">操作</th>
            </tr>
            </thead>
            <tbody>
                @if(!empty($selector_data))
                    @foreach($selector_data as $v)
                        <tr id="tr_{{ $v['goods_id'] }}">
                            <td class="text-c">
                                <img class="w50" src="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80">
                            </td>
                            <td>
                                <input type='hidden' name='goods_id' value='{{ $v['goods_id'] }}'>
                                <input type='hidden' name='sku_id' value='{{ $v['sku_id'] }}'>
                                {{ $v['goods_name'] }}
                            </td>
                            <td class="text-c">￥{{ $v['goods_price'] }}</td>
                            <td class="text-c">
                                <input class="form-control small" type="text" value="{{ $v['sort'] }}" name="sort">
                            </td>
                            <td class="handle">
                                <a class="del goods-del" data-goods_id="{{ $v['goods_id'] }}" data-sku_id="{{ $v['sku_id'] }}" href="javascript:void(0);">删除</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

        <div class="simple-form-field">

            <div class="goods-picker-container p-l-15 p-r-15"></div>

        </div>

    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="ok" data-dismiss="modal">确定</button>
    </div>
    <script id="select_list" type="text">{!! json_encode($selector_data) !!}</script>
    <script type="text/javascript">
        var is_supply = "";
    </script>

    <script type="text/javascript">
        $().ready(function() {
            //组件初始化，点击某个按钮展开商品选择控件
            var is_select = true;
            var select_num = 0;
            var container = $("#{{ $page_id }}").find(".goods-picker-container");
            //var sku_id = $(this).data("sku-id");
            // 一个页面中如果有多个组件，则需要为每个组件定义一个唯一的ID，此ID
            // 建议就是分页控件的ID，也主要是为了区分开每个组件的分页已经表单
            // 如果页面中只有一个，默认为GoodsPickerPage
            var page_id = "GoodsPickerPage_{{ $page_id }}";
            //判断容器是否已经初始化了组件
            // $.goodspickers()可获取页面中所有的选择器组件对象，
            // 也可以根据ID获取指定的组件对象

            var max_number = '{{ $data['number'] }}';
            var select_count = '{{ count($selector_data) }}';

            var goods_table = $('#addGoodsTable');
            if (!$.goodspickers(page_id)) {

                // 如果已经有选择了的商品则可以想下面这样初始化已选择的数据，有两种形式
                var values = [];
                var select_list = $.parseJSON($("#{{ $page_id }}").find("#select_list").html());
                $.each(select_list, function(index, val) {
                    values[val.goods_id] = {
                        goods_id: val.goods_id,
                        sku_id: val.sku_id
                    }
                });

                // 设置已选择：第一种方法，加载控件前传递已选择的商品信息
                $(container).parents(".goods-sku").find(".goods-gift-list").find("li").each(function() {
                    var goods_id = $(this).find(".gift-goods-id").val();
                    var sku_id = $(this).find(".gift-sku-id").val();
                    values[goods_id] = {
                        goods_id: goods_id,
                        sku_id: sku_id,
                    };
                });

                // 初始化组件，为容器绑定组件
                var goodspicker = $(container).goodspicker({
                    // 组件ajax提交的数据，主要设置分页的相关设置
                    data: {
                        page: {
                            // 分页唯一标识
                            page_id: page_id
                        },
                        is_sku: 0,
                        is_supply: is_supply,
                        is_enable: 1,
                        goods_status: 1,
                        goods_audit: 1,
                        show_store: 0
                        // 不能将自己作为赠品
                        //except_sku_ids: sku_id
                    },
                    // 已加载的数据
                    values: values,
                    // 选择商品和未选择商品的按钮单击事件
                    // @param selected 点击是否选中
                    // @param sku 选中的SKU对象
                    // @return 返回false代表
                    click: function(selected, sku) {
                        if (selected) {
                            if (max_number > 0 && this.goods_ids.length > max_number) {
                                $.msg("最多可以选择" + max_number + "件商品");
                                return false;
                            }
                        }
                        refreshGoodsTable(sku, selected);
                    },
                });

            } else {
                if ($(container).is(":hidden")) {
                    $(container).show();
                } else {
                    $(container).hide();
                }
            }

            $(container).on('click', '.unselectall', function() {
                chk_value = [];
                $("#{{ $page_id }}").find("#addGoodsTable tbody").find('tr').remove();
                select_count = 0;
            });

            //移除赠品
            $("body").on("click", ".gift-del", function() {
                var target = $(this).parents("li");
                var goods_id = $(target).data("goods-id");
                var sku_id = $(target).data("sku-id");

                var page_id = "GoodsPickerPage_" + $(this).parents(".goods-sku").data("sku-id");

                if ($.goodspickers(page_id)) {
                    // 获取控件
                    var goodspicker = $.goodspickers(page_id);
                    // 通过组件的remove函数取消选择指定的商品信息
                    goodspicker.remove(goods_id, sku_id);
                }

                $(target).remove();
            });

            $("#{{ $page_id }}").on("click", ".goods-del", function() {
                var goods_id = $(this).data('goods_id');
                var sku_id = $(this).data('sku_id');
                goodspicker.remove(goods_id, sku_id);
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

            //刷新已选商品列表
            function refreshGoodsTable(sku, selected) {
                if (selected == true) {
                    select_count++;
                    var td_image = "<td class='text-c'><img class='w50' src='"+sku.goods_image+"'></td>";
                    var td_name = "<td><input type='hidden' name='goods_id' value='"+sku.goods_id+"'><input type='hidden' name='sku_id' value='"+sku.sku_id+"'>" + sku.goods_name + "</td>";
                    var td_price = "<td class='text-c'>￥" + sku.goods_price + "</td>";
                    var td_sort = "<td class='text-c'><input class='form-control small' type='text' value='"+select_count+"' name='sort'></td>";
                    var td_hand = "<td class='handle'><a class='del goods-del' data-goods_id='"+sku.goods_id+"' data-sku_id='"+sku.sku_id+"' href='javascript:;'>删除</a></td>";
                    var tr = "<tr id='tr_"+sku.goods_id+"'>" + td_image + td_name + td_price + td_sort + td_hand + "</tr>";
                    if ($("#{{ $page_id }}").find("#addGoodsTable tbody").find($('#tr_' + sku.goods_id).length == 0)) {
                        $("#{{ $page_id }}").find("#addGoodsTable tbody").append(tr);
                    }

                } else {
                    $("#{{ $page_id }}").find("#addGoodsTable").find($('#tr_' + sku.goods_id)).remove();
                    select_count--;
                }
            }
        });
    </script>

    <script type="text/javascript">
        $().ready(function() {
            var type = '{{ $data['type'] }}';
            var cat_id = '{{ $data['cat_id'] }}';
            var uid = '{{ $data['uid'] }}';
            var container = $("#{{ $page_id }}");
            var modal = $(container).data("modal");
            var options = $(modal).data("options");
            //$(modal).modal("hide");
            $("#{{ $page_id }}").find("#ok").click(function() {
                var chk_value = [];

                $("#{{ $page_id }}").find('#addGoodsTable tbody tr').each(function(i, v) {
                    chk_value.push({
                        goods_id: $(this).find('td input[name="goods_id"]').val(),
                        sku_id: $(this).find('td input[name="sku_id"]').val(),
                        sort: $(this).find('td input[name="sort"]').val() == '' ? '255' : $(this).find('td input[name="sort"]').val()
                    });
                });

                if ($("#{{ $page_id }}").find("#cat_name").length > 0) {
                    var cat_name = $("#{{ $page_id }}").find("#cat_name").val();
                    if ($.trim(cat_name).length == 0 && chk_value.length > 0) {
                        $("#{{ $page_id }}").find("#cat_name").addClass('error');
                        $.msg("标题名称不能为空");
                        return false;
                    }

                    if ($.trim(cat_name).length > '10') {
                        $("#{{ $page_id }}").find("#cat_name").addClass('error');
                        $.msg("标题名称不能超过10个字");
                        return false;
                    }
                }

                //上传数据
                $.designadddata({
                    data: {
                        uid: uid,
                        chk_value: chk_value,
                        type: type,
                        cat_id: cat_id,
                        extend: {
                            cat_id: cat_id,
                            cat_name: cat_name,
                        },
                        page: 1,
                    },
                });
            });

        });
    </script>
</div>