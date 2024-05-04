<div id="table_list">
    <ul class="message-list tablelist-append">
        @foreach($list as $v)
        <li>
            <label class="agree-checkbox" data-id="{{ $v['msg_id'] }}">
                <i></i>
            </label>
            <div class="message-swiper message-swiper-read">
                <div class="message-item" onclick="messageInfo('{{ $v['msg_id'] }}')">
                    <div class="message-pic">
                        <img src="/images/user/bg_message_notice.png">
                    </div>
                    <!--如果是未读状态的信息，显示红色小点，点击进入阅读后红点消失-->
                    @if(!$v['status'])
                    <em class="message-tip" id="message_tip_{{ $v['msg_id'] }}"></em>
                    @endif
                    <dl>
                        <dt>
                            <span class="messgae-name">{{ $v['title'] }}</span>
                            <span class="messgae-time">{{ format_time(strtotime($v['send_time']), 'Y-m-d') }}</span>
                        </dt>
                        <dd>{!! $v['content'] !!}</dd>
                    </dl>
                </div>
                <div class="message-handle">
                    <a class="message-read-btn" onclick="read('{{ $v['msg_id'] }}',this)">标记已读</a>
                    <a class="message-del-btn bg-color" onclick="del('{{ $v['msg_id'] }}',this)">删除</a>
                </div>
            </div>
            <span class="message-title hide">{{ $v['title'] }}</span>
            <span class="message-content hide">{!! $v['content'] !!}</span>
        </li>
        @endforeach
    </ul>
    <div class="message-footer bdr-top hide">
        <!--全选后给message-footer增加select样式-->
        <label class="check-all">
            <i></i>
        </label>
        <span class="agree-checkbox">全选</span>
        <div class="handle-btn">
            <a href="javascript:;" class="btn batch-read">标为已读</a>
            <a href="javascript:;" class="btn delete batch-del">批量删除</a>
        </div>
    </div>
    <!-- 分页 -->
    <div id="pagination" class="page">
        <div class="more-loader-spinner">
        </div>
        <script data-page-json="true" type="text" id="page_json">
        {!! $page_json !!}
        </script>
    </div>
    <!--底部菜单 start-->
    {{--引入底部菜单--}}
    @include('frontend.web_mobile.modules.library.site_footer_menu')

</div>
