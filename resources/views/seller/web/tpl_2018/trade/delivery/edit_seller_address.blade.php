<div id="{{ $uuid }}" class="modal-body">
    <p class="m-b-10">
        <a class="btn-link" href="/shop/shop-address/list" target="_blank">管理发/退货地址</a>
        <span class="m-l-10 m-r-10 c-bbb">|</span>
        <a class="btn-link" href="javascript:_update()">刷新</a>
    </p>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th class="w100">发货人</th>
                <th>发货地址</th>
                <th class="w150">电话</th>
                <th class="handle w100">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($shop_address as $item)
            <tr>
                <td>{{ $item['consignee'] }}</td>
                <td>{{ get_region_names_by_region_code($item['region_code']) }} {!! $item['address_detail'] !!}</td>
                <td>{{ $item['mobile'] ?? $item['tel'] }}</td>
                <td class="handle">
                    @if($region_code_now == $item['region_code'] && $address_now == $item['address_detail'])
                        已选择
                    @else
                        <a class="btn_submit" data-id="{{ $item['address_id'] }}">选择</a>
                    @endif
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
    // 
</script><script>

    function _update() {
        $.closeAll();
        $.open({
// 标题  
            title: '发货人信息',
            width: '800px',
// ajax加载的设置  
            ajax: {
                url: '/trade/delivery/edit-order',
                data: {
                    type: 'seller_address',
                    id: '{{ $delivery_id }}',
                }
            },
        });
    }

    $().ready(function() {
        $("#{{ $uuid }}").find(".btn_submit").click(function() {
            var id = $(this).data('id');
            var from = "{{ $from }}";
            var url;

            $.loading.start();

            $.post("/trade/delivery/edit-order", {
                id: id,
                delivery_id: '{{ $delivery_id }}',
                type: 'seller_address',
                from: from
            }, function(result) {
                if (from == "batch-delivery") {
                    var address_id = result.address_id;
                    url = '/trade/order/batch-delivery.html?id=&address_id=' + address_id;
                } else {
                    url = '/trade/delivery/to-shipping?id={{ $delivery_id }}';
                }
                $.msg(result.message, function(){
                    $.go(url);
                });
            }, "json").always(function(){
                $.loading.stop();
            });
        });

        $("#{{ $uuid }}").find(".btn-default").click(function() {
            $(".layui-layer-shade").hide();
            $(".layui-layer-dialog").hide();
        });
    });

    // 
</script>