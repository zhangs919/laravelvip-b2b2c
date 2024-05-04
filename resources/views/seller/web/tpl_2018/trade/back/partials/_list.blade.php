<link href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet"><!-- ================== BEGIN BASE  ================== -->
<!-- ================== END BASE  ================== -->
<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <!--排序样式sort默认，asc升序，desc降序-->
        <th class="w300" data-sortname="order_id">商品信息</th>
        <th class="w120" data-sortname="user_name">买家</th>
        <th class="w80" data-sortname="order_amount">交易金额</th>
        <th class="w80" data-sortname="refund_money">退款金额</th>
        <th class="w100" data-sortname="add_time">申请时间</th>
        <th class="w100" data-sortname="disabled_time">超时时间</th>
        <th class="w100" data-sortname="back_status">@if($is_after_sale)售后状态@else退款状态@endif</th>
        <!--操作列样式handle-->
        <th class="handle w100">操作</th>
    </tr>
    </thead>
    <tbody>

    @if(!empty($list))
        @foreach($list as $item)
            <tr>
                <td>
                    <div class="goodsPicBox pull-left m-r-10">
                        <img src="{{ $item['sku_image'] }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" class="goods-thumb"/>
                    </div>
                    <div class="ng-binding refund-message" style="width: 210px;">
                        <div class="name">
                            <a href="{{ route('pc_show_goods',['goods_id'=>$item['goods_id']]) }}" target="_blank" data-toggle="tooltip" data-placement="auto bottom" title="{{ $item['sku_name'] }}" class="c-blue">{{ $item['sku_name'] }}</a>
                        </div>
                        <div class="order-num">订单编号：{{ $item['order_sn'] }}</div>
                        <div class="refund-num">退款编号：{{ $item['back_sn'] }}</div>
                    </div>
                </td>
                <td>
                    <div class="ng-binding">
                        <span>{{ $item['user_name'] }}</span>
                    </div>
                </td>
                <td>￥{{ $item['order_amount'] }}</td>
                <td>￥{{ $item['refund_money'] }}</td>
                <td>{{ format_time($item['add_time']) }}</td>
                <td>{{ format_time($item['disabled_time']) }}</td>
                <td>
                    <font class="c-red">{{ $item['back_status_format'] }}</font>
                </td>
                <td class="handle">
                    <a href="/trade/back/info?id={{ $item['back_id'] }}">查看</a>
                </td>
            </tr>

        @endforeach
    @endif

    </tbody>
    <tfoot>
    <tr>
        <td colspan="8">
            <div class="pull-right page-box">
                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
<script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js"></script>
<script>

    $().ready(function() {
        $(".pagination-goto > .goto-input").keyup(function(e) {
            $(".pagination-goto > .goto-link").attr("data-go-page", $(this).val());
            if (e.keyCode == 13) {
                $(".pagination-goto > .goto-link").click();
            }
        });
        $(".pagination-goto > .goto-button").click(function() {
            var page = $(".pagination-goto > .goto-link").attr("data-go-page");
            if ($.trim(page) == '') {
                return false;
            }
            $(".pagination-goto > .goto-link").attr("data-go-page", page);
            $(".pagination-goto > .goto-link").click();
            return false;
        });
    });

    // 
</script>