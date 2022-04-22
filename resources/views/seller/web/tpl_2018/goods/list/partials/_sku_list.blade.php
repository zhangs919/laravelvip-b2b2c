<div class="modal-body" style="padding: 25px;">
    <div class="table-responsive" style="max-height: 380px; overflow-y: auto">
        <table class="table table-hover m-b-0">
            <thead>
            <tr>
                <th class="text-c">SKU编号</th>
                <th class="text-c">SKU图片</th>
                <th>SKU规格</th>
                <th>SKU货号</th>
                <th>SKU价格（元）</th>
                <th>SKU库存</th>
                <th class="text-c">条形码</th>
                <th class="handle">操作</th>
            </tr>
            </thead>
            <tbody>

            @foreach($sku_list as $v)
            <tr>
                <td class="text-c">{{ $v->sku_id }}</td>
                <td class="sku-goods-img text-c">
                    <img src="{{ get_image_url($v->sku_image, 'goods_image') }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" class="goods-thumb" />
                </td>
                <td>
                    @if(!empty($v->spec_ids))
                        {!! implode('<br>', explode(' ', $v->spec_names)) !!}
                    @else
                        无
                    @endif
                </td>
                <td>
                    <a href="javascript:void(0);" class="goods_sn" data-sku_id={{ $v->sku_id }}>{{ $v->goods_sn }}</a>
                </td>
                <td>

                    <a href="javascript:void(0);" class="goods_price" data-sku_id={{ $v->sku_id }}>{{ $v->goods_price }}</a>

                </td>
                <td>
                    <a href="javascript:void(0);" class="goods_number" data-sku_id={{ $v->sku_id }}>{{ $v->goods_number }}</a>
                </td>
                <td class="text-c">
                    <a href="javascript:void(0);" class="goods_barcode" data-sku_id={{ $v->sku_id }}>{{ $v->goods_barcode }}</a>
                </td>
                <td class="handle">
                    <!--
                    <a href="javascript:void(0)">编辑独立描述</a>
                    <span>|</span>
                    -->
                    <a href="{{ route('pc_show_sku_goods', ['sku_id'=>$v->sku_id]) }}" target="_blank">查看</a>
                </td>
            </tr>
            @endforeach

            </tbody>
        </table>
    </div>
</div>
<script type='text/javascript'>
    $(document).ready(function() {
// toggle `popup` / `inline` mode
// $.fn.editable.defaults.mode = "inline";

// SKU货号
        $(".goods_sn").editable({
            type: "text",
            url: "/goods/list/edit-goods-sku-info",
            pk: 1,
            emptytext: '无',
// title: "SKU货号",
            ajaxOptions: {
                type: "post"
            },
            params: function(params) {
                params.sku_id = $(this).data("sku_id");
                params.title = 'goods_sn';
                return params;
            },
            /* validate: function(value) {
            value = $.trim(value);
            if (value.length > 20) {
            return 'SKU货号只能包含至多20个字。';
            }
            }, */
            success: function(response, newValue) {
// 标识SKU发生变化
                $(document).data("sku-change", true);

                var response = eval('(' + response + ')');
// 错误处理
                if (response.code == -1) {
                    return response.message;
                }
            }
        });

// SKU商品价格
        $(".goods_price").editable({
            type: "text",
            url: "/goods/list/edit-goods-sku-info",
            pk: 1,
// title: "	SKU价格",
            ajaxOptions: {
                type: "post"
            },
            params: function(params) {
                params.sku_id = $(this).data("sku_id");
                params.title = 'goods_price';
                return params;
            },
            /* validate: function(value) {
            value = $.trim(value);
            if (!value) {
            return 'SKU价格不能为空。';
            } else if (isNaN(value)) {
            return 'SKU价格必须是一个数字。';
            } else if (value < 0.01) {
            return 'SKU价格必须是0.01~9999999之间的数字。';
            } else if (value > 9999999) {
            return 'SKU价格必须是0.01~9999999之间的数字。';
            }
            }, */
            success: function(response, newValue) {
// 标识SKU发生变化
                $(document).data("sku-change", true);

                var response = eval('(' + response + ')');
// 错误处理
                if (response.code == -1) {
                    return response.message;
                }
            },
            display: function(value, sourceData) {
// 保留两位小数
                $(this).html((Number(value)).toFixed(2));
            }
        });

// SKU库存
        $(".goods_number").editable({
            type: "text",
            url: "/goods/list/edit-goods-sku-info",
            pk: 1,
// title: "SKU库存",
            ajaxOptions: {
                type: "post"
            },
            params: function(params) {
                params.sku_id = $(this).data("sku_id");
                params.title = 'goods_number';
                return params;
            },
            /* validate: function(value) {
            value = $.trim(value);
            var ex = /^\d+$/;
            if (!value) {
            return 'SKU库存不能为空。';
            } else if (!ex.test(value)) {
            return 'SKU库存必须是正整数。';
            } else if (value > 999999999) {
            return 'SKU库存不能大于999999999';
            }
            }, */
            success: function(response, newValue) {
// 标识SKU发生变化
                $(document).data("sku-change", true);

                var response = eval('(' + response + ')');
// 错误处理
                if (response.code == -1) {
                    return response.message;
                }
            },
            display: function(value, sourceData) {
// 显示整数
                $(this).html((Number(value)).toFixed(0));
            }
        });

// SKU条形码
        $(".goods_barcode").editable({
            type: "text",
            url: "/goods/list/edit-goods-sku-info",
            pk: 1,
            emptytext: '无',
// title: "SKU条形码",
            ajaxOptions: {
                type: "post"
            },
            params: function(params) {
                params.sku_id = $(this).data("sku_id");
                params.title = 'goods_barcode';
                return params;
            },
            /* validate: function(value) {
            value = $.trim(value);
            if (value.length > 14) {
            return 'SKU条形码只能包含至多14个字。';
            }
            }, */
            success: function(response, newValue) {
// 标识SKU发生变化
                $(document).data("sku-change", true);

                var response = eval('(' + response + ')');
// 错误处理
                if (response.code == -1) {
                    return response.message;
                }
            }
        });
    });
</script>