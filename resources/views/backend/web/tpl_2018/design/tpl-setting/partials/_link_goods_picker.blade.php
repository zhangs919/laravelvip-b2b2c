<div id="{{ $page_id }}" class="p-15">
    <!-- 商品选择器 -->
    <div class="goods-picker-container"></div>
</div>
<script type="text/javascript">
    //
</script><script>

    $().ready(function() {
        var values = [];
        <!--  -->
        @if(!empty($goods_id))
        values['{{ $goods_id }}'] = {
            goods_id: '{{ $goods_id }}'
        };
        <!--  -->
        @endif

        $("#{{ $page_id }} .goods-picker-container").goodspicker({
            data: {
                page: {
// 分页唯一标识
                    page_id: "GoodsPickerPage_{{ $page_id }}"
                },
                is_sku: 0,
                is_supply: 0,
                is_enable: 1,
                goods_status: 1,
                goods_audit: 1,
                show_store: 0
            },
// 已加载的数据
            values: values,

// 选择商品和未选择商品的按钮单击事件
// @param selected 点击是否选中
// @param sku 选中的SKU对象
// @return 返回false代表
            click: function(selected, sku) {
                $('#{{ $id }}').find("#link_change .goods-name").html(sku.goods_name);
                $('#{{ $id }}').find("#link_change [name='link']").val('/goods/' + sku.goods_id+'.html');
                $('#{{ $id }}').find("#link_change .goods-picker").attr('data-goods_id',sku.goods_id);
                if(goods_picker_index){
                    layer.close(goods_picker_index);
                }else{
                    $.closeAll();
                }
            }

        });
    });

    //
</script>