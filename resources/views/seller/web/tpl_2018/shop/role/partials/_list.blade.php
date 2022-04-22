<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck">
            <input type="checkbox" class="checkBox allCheckBox" />
        </th>
        <!-- 编号 -->
        <th class="text-c w100" data-sortname="role_id">编号</th>
        <!-- 角色名称 -->
        <th class="w200" data-sortname="role_name">角色名称</th>
        <!-- 角色说明 -->
        <th class="w300" data-sortname="role_desc">角色说明</th>
        <!-- 操作-->
        <th class="handle w200">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
    <tr>
        <td class="tcheck">
            <input type="checkbox" class="checkBox" />
        </td>
        <td class="text-c">{{ $v->role_id }}</td>
        <td>{{ $v->role_name }}</td>
        <td>{{ $v->role_desc }}</td>
        <td class="handle">
            <a href="edit?role_id={{ $v->role_id }}">编辑</a>
            <span>|</span>
            <a href="javascript:void(0);" object_id="{{ $v->role_id }}" class="del border-none">删除</a>
        </td>
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td colspan="5">
            <div class="pull-right page-box">
                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>