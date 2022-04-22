<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck w10">
            <input type="checkbox" class="checkBox allCheckBox"/>
        </th>
        <th class="text-c w70" data-sortname="topic_id">编号</th>
        <th class="w250" data-sortname="topic_name">活动名称</th>
        <th class="w150">专题地址</th>
        <th class="text-c w150" data-sortname="add_time">创建时间</th>
        <th class="text-c w150" data-sortname="update_time">更新时间</th>
        <th class="handle w250">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
    <tr>
        <td class="tcheck">
            <input type="checkbox" class="checkBox" value="{{ $v->topic_id }}" />
        </td>
        <td class="text-c">{{ $v->topic_id }}</td>
        <td>{{ $v->topic_name }}</td>
        <td>{{ route('pc_show_topic', ['topic_id'=>$v->topic_id], false) }}</td>
        <td class="text-c">{{ $v->created_at }}</td>
        <td class="text-c">{{ $v->updated_at }}</td>
        <td class="handle">
            <a href="edit?id={{ $v->topic_id }}">编辑</a>
            <span>|</span>
            <a href="design?id={{ $v->topic_id }}"  target="_blank">装修</a>
            <span>|</span>
            <a href="{{ route('pc_show_topic', ['topic_id'=>$v->topic_id]) }}"  target="_blank">查看</a>
            <span>|</span>
            <a href="javascript:void(0);" data-id="{{ $v->topic_id }}" class="del border-none">删除</a>
        </td>
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td class="text-c w10">
            <input type="checkbox" class="allCheckBox checkBox">
        </td>
        <td colspan="6">
            <div class="pull-left">
                <input type="button" id="batch-delete" class="btn btn-danger m-r-2" value="批量删除" />
                <!--当没有选中任何所操作的项，按钮为禁用状态，将按钮样式btn-danger替换为disabled-->
            </div>
            <div class="pull-right page-box">


                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
