<div id="table_list">

    <ul class="message-list tablelist-append">

        @foreach($list as $v)
        <li onclick="messageInfo('{{ $v['msg_id'] }}')">
            <div class="message-pic">
                <img src="/images/user/bg_message_notice.png">
            </div>
            <!--如果是未读状态的信息，显示红色小点，点击进入阅读后红点消失-->
            <dl>
                <dt>
                    <span class="messgae-name">{{ $v['title'] }}</span>
                    <span class="messgae-time">{{ format_time(strtotime($v['send_time']), 'Y-m-d') }}</span>
                </dt>
                <dd>{!! $v['content'] !!}</dd>
            </dl>
            <span class="message-title hide">{{ $v['title'] }}</span>
            <span class="message-content hide">{!! $v['content'] !!}</span>
        </li>
        @endforeach

    </ul>
    <!-- 分页 -->
    <div id="pagination" class="page">
        <div class="more-loader-spinner">

        </div>
        <script data-page-json="true" type="text" id="page_json">
            {!! $page_json !!}
        </script>
    </div>


</div>