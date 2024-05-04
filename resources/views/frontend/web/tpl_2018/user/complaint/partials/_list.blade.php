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
                <a href="/shop/{{ $v['shop_id'] }}.html" title="{{ $v['shop_name'] }}" target="_blank" class="btn-link">{{ $v['shop_name'] }}</a>
            </p>
            <p>
                卖家：{{ $v['user_name'] }}


                @if(!empty($customer_main))
                {{--客服工具 默认0 0无客服 1QQ 2旺旺--}}
                @if($customer_main['customer_tool'] == 2)
                    <span class="ww-light">
                                <!-- 旺旺不在线 i 标签的 class="ww-offline" -->

                        <!-- s等于1时带文字，等于2时不带文字 -->
                                <a target="_blank" href="http://amos.alicdn.com/getcid.aw?v=2&uid={{ $customer_main['customer_account'] }}&site=cntaobao&s=2&groupid=0&charset=utf-8">
                                    <img border="0" src="http://amos.alicdn.com/online.aw?v=2&uid={{ $customer_main['customer_account'] }}&site=cntaobao&s=2&charset=utf-8" alt="淘宝旺旺" title="" />
                                    <span></span>
                                </a>

                            </span>
                @elseif($customer_main['customer_tool'] == 1)
                <!-- s等于1时带文字，等于2时不带文字 -->
                    <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin={{ $customer_main['customer_account'] }}&site=qq&menu=yes" class="service-btn">
                        <img border="0" onload="load_qq_customer_image(this, 'http://')" src="http://wpa.qq.com/pa?p=2:{{ $customer_main['customer_account'] }}:52" alt="QQ" title="" style="height: 20px;" />
                        <span></span>
                    </a>
                @else{{--默认 平台客服--}}
                    <a href='{{ $customer_main['yikf_url'] ?? 'javascript:;' }}' class="ww-light  color" target="_blank" title="点击联系在线客服">
                        <i class="iconfont">&#xe6ad;</i>
                    </a>
                @endif
            @endif


            </p>
        </td>
        <td align="center">
            {{ format_complaint_type($v['complaint_type']) }}
        </td>
        <td align="center">{{ format_time($v['add_time']) }}</td>
        <td align="center">
            <p>{{ format_complaint_status($v['complaint_status'],1) }}</p>
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