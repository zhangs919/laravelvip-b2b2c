<div class="table-responsive">

    <table class="table table-hover" id="table_list">
        <thead>
        <tr>
            <th class="tcheck">
                <input type="checkbox" class="checkBox allCheckBox table-list-checkbox-all" title="全选/全不选">
            </th>
            <th>角色名称</th>
            <th class="" style="cursor: default;">描述</th>
            <th class="w200">最后更新时间</th>
            <th class="handle w200" style="cursor: default;">操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($list as $v)
        <tr>
            <td class="text-c w10">
                <input type="checkbox" class="checkBox table-list-checkbox" value="{{ $v->role_id }}">
            </td>
            <td>{{ $v->role_name }}</td>
            <td>{{ $v->role_desc }}</td>
            <td>{{ $v->updated_at }}</td>
            <td class="handle">
                <a href="edit?role_id={{ $v->role_id }}" title="编辑">编辑</a>
                <span>|</span>
                <a href="javascript:void(0);" data-id="{{ $v->role_id }}" title="删除" class="del border-none">删除</a>
            </td>
        </tr>
        @endforeach

        </tbody>
        <tfoot>
        <tr>
            <td class="text-c w10"></td>
            <td colspan="4">
                <div class="pull-left">
                    <!--
                    <input type="button" id="btn_delete" class="btn btn-danger m-r-2" value="删除" />
                     -->
                </div>
                <div id="pagination" class="pull-right page-box">


                    {!! $pageHtml !!}
                </div>
            </td>
        </tr>
        </tfoot>
    </table>

</div>