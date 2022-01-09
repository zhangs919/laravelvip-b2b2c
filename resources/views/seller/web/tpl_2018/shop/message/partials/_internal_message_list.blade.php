<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <!-- 编号 -->
        <th class="text-c w100" data-sortname="rec_id">编号</th>
        <!-- 消息内容 -->
        <th class="w600" data-sortname="content">消息内容</th>
        <!-- 发送时间 -->
        <th class="w200" data-sortname="send_time">发送时间</th>
        <!-- 操作-->
        <th class="handle w150">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
    <tr>
        <td class="text-c">{{ $v->rec_id }}</td>
        <td class="text-l">{{ $v->content }}</td>
        <td>{{ $v->send_time }}</td>
        <td class="handle">
            <a class="btn-link m-l-10" href="javascript:void(0);" data-msg-id="{{ $v->msg_id }}" data-rec-id="{{ $v->rec_id }}">查看</a>

            <span>|</span>
            <a href="javascript:void(0);" data-rec-id="{{ $v->rec_id }}" class="del border-none">删除</a>

        </td>
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td colspan="4">
            <div class="pull-right page-box">


                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
