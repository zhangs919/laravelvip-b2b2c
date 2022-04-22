<div class="table-responsive">

    <table id="table_list" class="table table-hover">
        <thead>
        <tr>
            <th class="tcheck">
                <input type="checkbox" class="checkBox allCheckBox table-list-checkbox-all" title="全选/全不选">
            </th>
            <!-- 编号 -->
            <th class="text-c w100" data-sortname="id" data-sortorder="asc" style="cursor: pointer;">编号<span class="sort"></span></th>
            <!-- 操作人 -->
            <th class="w100" data-sortname="user_id" data-sortorder="asc" style="cursor: pointer;">操作人<span class="sort"></span></th>
            <!-- 操作内容 -->
            <th class="w400" data-sortname="" style="cursor: pointer;">内容</th>
            <!-- 操作时间 -->
            <th class="w200" data-sortname="add_time" data-sortorder="asc" style="cursor: pointer;">时间<span class="sort"></span></th>
            <!-- 操作IP -->
            <th class="w150" data-sortname="" style="cursor: pointer;">IP</th>
            <!-- 操作-->
            <th class="handle w120" style="cursor: default;">操作</th>
        </tr>
        </thead>
        <tbody>

        @foreach($list as $v)
        <tr>
            <td class="tcheck">
                <input type="checkbox" class="checkBox table-list-checkbox" value="{{ $v->id }}">
            </td>
            <td class="text-c">{{ $v->id }}</td>
            <td>{{ $v->admin_name }}</td>
            <td>
                <span>{{ $v->content }}</span>
            </td>
            <td>{{ $v->created_at }}</td>
            <td>{{ $v->ip }}</td>
            <td class="handle">
                <a href="javascript:void(0);" object_id="{{ $v->id }}" class="del border-none">删除</a>
            </td>
        </tr>
        @endforeach

        </tbody>
        <tfoot>
        <tr>
            <td class="text-c w10">
                <input type="checkbox" class="allCheckBox checkBox table-list-checkbox-all" title="全选/全不选">
            </td>
            <td colspan="6">
                <div class="pull-left">
                    <input type="button" id="batch-delete" class="btn btn-danger m-r-2" value="删除">
                    <input type="button" id="delete-old-log" class="btn btn-danger m-r-2" value="删除六个月前日志">
                </div>

                <div class="pull-right page-box">
                    {!! $pageHtml !!}
                </div>

            </td>
        </tr>
        </tfoot>
    </table>

</div>