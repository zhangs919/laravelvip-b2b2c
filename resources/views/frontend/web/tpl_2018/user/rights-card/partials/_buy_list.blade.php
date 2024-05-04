<div id="table_list">
    <table class="table">
        <thead>
        <tr>
            <th>名称</th>
            <th>领取时间</th>
            <th>卡号</th>
            <th>权益/领卡礼包</th>
            <th>支付金额（元）</th>
            <th>支付状态</th>
            <th>支付方式</th>
            <th>操作</th>
        </tr>
        </thead>
    </table>
    @if(!empty($list))
        {{--todo 不为空--}}

    @else
        <div class="tip-box">
            <img src="/images/noresult.png" class="tip-icon" />
            <div class="tip-text">没有符合条件的记录</div>
        </div>
    @endif
</div>