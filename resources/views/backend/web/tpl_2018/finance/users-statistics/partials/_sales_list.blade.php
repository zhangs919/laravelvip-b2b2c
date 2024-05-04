<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="text-c w70" data-sortname="user_id">编号</th>
        <th class="w200" data-sortname="user_name">会员信息</th>
        <th class="text-c w120" data-sortname="order_count">订单总数量</th>
        <th class="text-c w120" data-sortname="order_amount">订单总金额（元）</th>
        <th class="text-c w120" data-sortname="order_count_valid">有效订单总数量</th>
        <th class="text-c w150" data-sortname="order_amount_valid">有效订单金额（元）</th>
        <th class="text-c w120" data-sortname="back_count">退款数量</th>
        <th class="text-c w120" data-sortname="back_amount">退款金额（元）</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $item)
        <tr>
            <td class="text-c">5</td>
            <td>
                会员账号：LRQ157FTPJ8849
                <br>
                会员昵称：666
                <br>
                真实姓名：
                <br>
                手机号码：13333333333
            </td>
            <td class="text-c">61</td>
            <td class="text-c">2462.90</td>
            <td class="text-c">29</td>
            <td class="text-c">173.28</td>
            <td class="text-c">1</td>
            <td class="text-c">1.00</td>
        </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td colspan="8">
            <div class="pull-left"></div>
            <div class="pull-right page-box">
                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
