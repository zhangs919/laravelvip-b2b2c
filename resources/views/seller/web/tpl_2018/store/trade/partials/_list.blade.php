<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck">
            <input type="checkbox" class="checkBox allCheckBox">
            </input>
        </th>
        <th class="w150" data-sortname="add_time">起止时间</th>
        <th class="w150" data-sortname="store_id">网点</th>
        <th class="w150">分组</th>
        <th class="w120 text-c" data-sortname="alipay">支付宝</th>
        <th class="w100 text-c" data-sortname="weixin">微信</th>
        <th class="w100 text-c" data-sortname="union">银联</th>
        <th class="w100 text-c" data-sortname="balance">余额</th>
        <th class="w120 text-c" data-sortname="store_card_amount">购物卡</th>
        <th class="w150 text-c" data-sortname="cod">货到付款</th>
        <th class="w120 text-c">红包金额</th>
        <th class="w120 text-c">红包数量</th>
        <th class="w120 text-c">赠品数量</th>
        <th class="w120 text-c" data-sortname="order_count">订单数</th>
        <th class="w150 text-c" data-sortname="order_amount">订单总额</th>
        <th class="handle w100">操作</th>
    </tr>
    </thead>
    <tbody>
    <!--以下为循环内容-->
    @foreach($list as $item)
    <tr>
        <td class="tcheck">
            <input type="checkbox" class="checkBox" value="">
        </td>
        <td>
            {{ $item['start_time'] }}
        </td>
        <td>{{ $item['store_name'] }}</td>
        <td>{{ $item['group_name'] }}</td>
        <td class="merge text-c" data-name="alipay" data-value="{{ $item['alipay'] }}">
            <a href="javascript:void(0);" class="c-blue" onClick="go('{{ $item['store_id'] }}', '{{ $item['start_time'] }}', '{{ $item['end_time'] }}', 'alipay')">{{ $item['alipay'] }}</a>
        </td>
        <td class="merge text-c" data-name="weixin" data-value="{{ $item['weixin'] }}">
            <a href="javascript:void(0);" class="c-blue" onClick="go('{{ $item['store_id'] }}', '{{ $item['start_time'] }}', '{{ $item['end_time'] }}', 'weixin')">{{ $item['weixin'] }}</a>
        </td>
        <td class="merge text-c" data-name="union" data-value="{{ $item['union'] }}">
            <a href="javascript:void(0);" class="c-blue" onClick="go('{{ $item['store_id'] }}', '{{ $item['start_time'] }}', '{{ $item['end_time'] }}', 'union')">{{ $item['union'] }}</a>
        </td>
        <td class="merge text-c" data-name="balance" data-value="{{ $item['balance'] }}">
            <a href="javascript:void(0);" class="c-blue" onClick="go('{{ $item['store_id'] }}', '{{ $item['start_time'] }}', '{{ $item['end_time'] }}', 'balance')">{{ $item['balance'] }}</a>
        </td>
        <td class="merge text-c" data-name="store_card_amount" data-value="{{ $item['store_card_amount'] }}">
            <a href="javascript:void(0);" class="c-blue" onClick="go('{{ $item['store_id'] }}', '{{ $item['start_time'] }}', '{{ $item['end_time'] }}', 'store_card_amount')">{{ $item['store_card_amount'] }}</a>
        </td>
        <td class="merge text-c" data-name="cod" data-value="{{ $item['cod'] }}">
            <a href="javascript:void(0);" class="c-blue" onClick="go('{{ $item['store_id'] }}', '{{ $item['start_time'] }}', '{{ $item['end_time'] }}', 'cod')">{{ $item['cod'] }}</a>
        </td>
        <td class="merge text-c" data-name="bonus" data-value="{{ $item['bonus'] }}">{{ $item['bonus'] }}</td>
        <td class="merge text-c" data-name="bonus_count" data-value="{{ $item['bonus_count'] }}">
            <a href="javascript:void(0);" class="c-blue" onClick="go('{{ $item['store_id'] }}', '{{ $item['start_time'] }}', '{{ $item['end_time'] }}', false, true)">{{ $item['bonus_count'] }}</a>
        </td>
        <td class="merge text-c" data-name="gift_count" data-value="{{ $item['gift_count'] }}">
            <a href="javascript:void(0);" class="c-blue" onClick="go('{{ $item['store_id'] }}', '{{ $item['start_time'] }}', '{{ $item['end_time'] }}', false, false, true)">{{ $item['gift_count'] }}</a>
        </td>
        <td class="merge text-c" data-name="order_count" data-value="{{ $item['order_count'] }}">{{ $item['order_count'] }}</td>
        <td class="merge text-c" data-name="order_amount" data-value="{{ $item['order_amount'] }}">{{ $item['order_amount'] }}</td>
        <td class="handle">
            <a href="javascript:void(0);" onClick="go('{{ $item['store_id'] }}', '{{ $item['start_time'] }}', '{{ $item['end_time'] }}')">查看</a>
        </td>
    </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td class="text-c w10">
            <input type="checkbox" class="allCheckBox checkBox" />
        </td>
        <td colspan="15">
            <div class="pull-left">
                <input type="button" id="btn_merge" class="btn btn-warning m-r-2 del" value="合计" />
            </div>
            <div class="pull-right page-box">
                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
