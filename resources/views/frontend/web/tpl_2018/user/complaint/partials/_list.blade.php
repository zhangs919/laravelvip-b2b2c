<table id="table_list" class="table">
    <thead>
    <tr>
        <th style="width: 14%;">投诉编号</th>
        <th style="width: 16%;">订单编号</th>
        <th style="width: 16%;">投诉卖家</th>
        <th style="width: 17%;">投诉原因</th>
        <th style="width: 12%;">申请时间</th>
        <th style="width: 15%;">投诉状态</th>
        <th style="width: 8%;">操作</th>
    </tr>
    </thead>
    <tbody>

    @if(!empty($list))
    @foreach($list as $v)
    <tr>
        <td>{{ $v['complaint_sn'] }}</td>
        <td>
            <a href="/user/order/info.html?id={{ $v['order_id'] }}" title="查看订单详情" class="btn-link">{{ $v['order_sn'] }}</a>
        </td>
        <td>
            <p class="shop-name">
                店铺：
                <a href="/shop/{{ $v['shop_id'] }}.html" title="楠丹木业" target="_blank" class="btn-link">楠丹木业</a>
            </p>
            <p>
                卖家：测试店铺



                <!-- s等于1时带文字，等于2时不带文字 -->
                <a target="_blank" href="http://amos.alicdn.com/getcid.aw?v=2&uid=&site=cntaobao&s=2&groupid=0&charset=utf-8">
                    <img border="0" src="http://amos.alicdn.com/online.aw?v=2&uid=&site=cntaobao&s=2&charset=utf-8" alt="淘宝旺旺" title="" />
                    <span></span>
                </a>


            </p>
        </td>
        <td align="center">未按成交价格进行交易
        </td>
        <td align="center">2018-11-10 10:58:05</td>
        <td align="center">
            <p>买家提起投诉，等待卖家处理</p>
        </td>
        <td align="center">
            <div class="operate">
                <a href="/user/complaint/view.html?complaint_id={{ $v['complaint_id'] }}" class="btn-link">查看</a>
            </div>
        </td>
    </tr>
    @endforeach

    <tr style="border-right-style: none; border-left-style: none; border-bottom-style: none">
        <td colspan="7">
            {!! $pageHtml !!}
        </td>
    </tr>

    @else
        <tr style="border-right-style: none; border-left-style: none; border-bottom-style: none">
            <td colspan="7">
                <div class="tip-box">
                    <img src="{{ get_image_url(sysconf('default_noresult')) }}" class="tip-icon">
                    <div class="tip-text">您还没有任何投诉记录</div>
                </div>
            </td>
        </tr>
    @endif

    </tbody>
</table>