<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="w80">商品分类</th>
        <th class="text-c w100">销售额（元）<i data-toggle="popover" data-trigger="hover"
                                         data-placement="right" data-html="true"
                                         data-content="销售额：统计的是所有线上、线下订单中的商品总金额，包括各种订单状态的订单（订单包含：普通订单、自由购订单、堂内点餐订单、线下订单）"
                                         class="fa fa-question-circle f16 c-ddd  m-l-5 m-r-0"></i>
        </th>
        <th class="text-c w120">有效销售额（元）<i data-toggle="popover" data-trigger="hover"
                                           data-placement="right" data-html="true"
                                           data-content="有效销售额：统计的是线上、线下交易成功、已付款未发生退款或退款未成功、货到付款交易成功、线下订单未退款的订单中的商品总金额，如果商品退款成功，则统计的金额要去掉退款成功的商品金额"
                                           class="fa fa-question-circle f16 c-ddd  m-l-5 m-r-0"></i>
        </th>
        <th class="text-c w100">总下单量<i data-toggle="popover" data-trigger="hover"
                                       data-placement="right" data-html="true"
                                       data-content="总下单量：选择的时间内线上、线下订单中的总商品数量"
                                       class="fa fa-question-circle f16 c-ddd  m-l-5 m-r-0"></i>
        </th>
        <th class="text-c w100">有效下单量<i data-toggle="popover" data-trigger="hover"
                                        data-placement="right" data-html="true"
                                        data-content="有效下单量：选择的时间内交易成功、已付款未发生退款或退款未完成、货到付款交易成功的订单数、线下订单未退款数的订单中的总商品数量"
                                        class="fa fa-question-circle f16 c-ddd  m-l-5 m-r-0"></i>
        </th>
        <th class="text-c w100">商品总数<i data-toggle="popover" data-trigger="hover"
                                       data-placement="right" data-html="true"
                                       data-content="商品总数：店铺该商品分类下的商品总数量"
                                       class="fa fa-question-circle f16 c-ddd  m-l-5 m-r-0"></i>
        </th>
        <th class="text-c w120">有销量商品数<i data-toggle="popover" data-trigger="hover"
                                         data-placement="right" data-html="true"
                                         data-content="有销量商品数：选择的时间内，该商品分类下有有效销售的商品数量，有效销售指采用在线支付方式支付并且已付款、货到付款支付交易成功的订单"
                                         class="fa fa-question-circle f16 c-ddd  m-l-5 m-r-0"></i>
        </th>
        <th class="text-c w120">无销量商品数<i data-toggle="popover" data-trigger="hover"
                                         data-placement="left" data-html="true"
                                         data-content="无销量商品数：选择的时间内，该商品分类下未有销售的商品总数量"
                                         class="fa fa-question-circle f16 c-ddd  m-l-5 m-r-0"></i>
        </th>
        <th class="text-c w100">下单会员数<i data-toggle="popover" data-trigger="hover"
                                        data-placement="left" data-html="true"
                                        data-content="下单会员数：选择的时间内，下单的会员数量"
                                        class="fa fa-question-circle f16 c-ddd  m-l-5 m-r-0"></i>
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($list as $item)
    <tr>
        <td>{{ $item['cat_name'] }}</td>
        <td class="text-c">{{ $item['goods_amount'] }}</td>
        <td class="text-c">{{ $item['goods_amount_valid'] }}</td>
        <td class="text-c">{{ $item['order_count'] }}</td>
        <td class="text-c">{{ $item['order_count_valid'] }}</td>
        <td class="text-c">{{ $item['goods_number'] }}</td>
        <td class="text-c">{{ $item['goods_number_saled'] }}</td>
        <td class="text-c">{{ $item['goods_number_unsale'] }}</td>
        <td class="text-c">{{ $item['users_count'] }}</td>
    </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td colspan="9">
            <div class="pull-left"></div>
            <div class="pull-right page-box">
                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
