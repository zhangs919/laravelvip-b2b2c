<span class="top-dropdown-bg"></span>
<div class="message-title">
    <h5>
        <i class="news-icon"></i>
        消息通知（{{ $messageCount }}）
        <input id="counts_time" type="hidden" value="{{ time() }}" />
    </h5>
    <!--<a class="close" href="javascript:;"></a>-->
</div>
<div class="message-info p-t-5">
    {{--<ul>
        <li>
            <a onclick="message_click('order_payed')">
                <div class="message-icon pull-left m-r-10">
                    <i class="fa fa-user"></i>
                </div>
                <div class="pull-left">
                    <span class="tit">订单付款成功</span>
                    <span>2个订单付款成功</span>
                </div>
            </a>
        </li>
        <li>
            <a onclick="message_click('back_goods')">
                <div class="message-icon pull-left m-r-10">
                    <i class="fa fa-institution"></i>
                </div>
                <div class="pull-left">
                    <span class="tit">退货退款申请</span>
                    <span>2个退货退款需要处理</span>
                </div>
            </a>
        </li>
        <li>
            <a onclick="message_click('group_buy_audit')">
                <div class="message-icon pull-left m-r-10">
                    <i class="fa fa-thumbs-o-up"></i>
                </div>
                <div class="pull-left">
                    <span class="tit">团购审核结果</span>
                    <span>1个团购审核结果</span>
                </div>
            </a>
        </li>
        <li>
            <a onclick="message_click('contract_audit')">
                <div class="message-icon pull-left m-r-10">
                    <i class="fa fa-users"></i>
                </div>
                <div class="pull-left">
                    <span class="tit">消费保障审核结果</span>
                    <span>1个消费保障审核结果</span>
                </div>
            </a>
        </li>

    </ul>--}}
    @if($messageCount > 0)
        <ul>




            @foreach($messageList as $key=>$item)
            <li>
                <a onclick="message_click('{{ $key }}')">
                    <div class="message-icon pull-left m-r-10">
                        <i class="fa {{ $item['icon'] }}"></i>
                    </div>
                    <div class="pull-left">
                        <span class="tit">{{ $item['title'] }}</span>
                        <span>{{ $item['content'] }}</span>
                    </div>
                </a>
            </li>
            @endforeach



        </ul>
    @else
        <div class="no-data-page">
            <div class="icon">
                <i class="fa fa-bell-o"></i>
            </div>
            <h5>暂无消息内容</h5>
            <p>暂时没有消息提醒，稍后再来看看吧！</p>
        </div>
    @endif
</div>