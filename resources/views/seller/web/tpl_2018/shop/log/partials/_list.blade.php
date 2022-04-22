<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck">
            <input type="checkbox" class="checkBox allCheckBox" />
        </th>
        <!-- 编号 -->
        <th class="text-c w80" data-sortname="id">编号</th>
        <!-- 操作人 -->
        <th class="w150" data-sortname="user_id">操作人</th>
        <!-- 操作内容 -->
        <th class="w300" data-sortname="">内容</th>
        <!-- 操作时间 -->
        <th class="text-c w150" data-sortname="add_time">时间</th>
        <!-- 操作IP -->
        <th class="text-c w150" data-sortname="">IP</th>
        <!-- 操作-->
        <th class="handle w150">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
    <tr>
        <td class="tcheck">
            <input type="checkbox" class="checkBox" value="{{ $v->id }}" />
        </td>
        <td class="text-c">{{ $v->id }}</td>
        <td>{{ $v->user_name }}</td>
        <td>
            <span>{{ $v->content }}</span>
        </td>
        <td  class="text-c">{{ $v->created_at }}</td>
        <td  class="text-c">{{ $v->ip }}</td>
        <td class="handle">
            <a href="javascript:void(0);" object_id="{{ $v->id }}" class="del border-none">删除</a>
        </td>
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td class="text-c w10">
            <input type="checkbox" class="allCheckBox checkBox" />
        </td>
        <td colspan="6">
            <div class="pull-left">
                <input type="button" id="batch-delete" class="btn btn-danger m-r-2" value="批量删除" />
                <input type="button" id="delete-old-log" class="btn btn-danger m-r-2" value="删除六个月前日志" />
            </div>
            <div class="pull-right page-box">
                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
