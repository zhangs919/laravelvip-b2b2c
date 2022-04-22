<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck w10">
            <input type="checkbox" class="checkBox allCheckBox" />
        </th>
        <th class="w70 text-c" data-sortname="group_id">编号</th>
        <th class="w200" data-sortname="group_name">分组名称</th>
        <th class="w100 text-c" data-sortname="store_count">已标记网点个数</th>
        <th class="w80 text-c" data-sortname="group_sort">排序</th>
        <th class="handle w100">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
    <tr>
        <td class="tcheck">
            <input type="checkbox" class="checkBox" value="{{ $v->group_id }}">
        </td>
        <td class="text-c">{{ $v->group_id }}</td>
        <td>{{ $v->group_name }}</td>
        <td class="text-c">
            <a class="c-blue" href="/store/default/list?group_id={{ $v->group_id }}">{{ $v->store_count }}</a>
        </td>
        <td class="text-c">
            <font class="f14">
                <a href="javascript:void(0);" class="group_sort" data-id={{ $v->group_id }}>{{ $v->group_sort }}</a>
            </font>
        </td>
        <td class="handle">
            <a class="edit" href="javascript:void(0);" data-id="{{ $v->group_id }}">编辑</a>
            <a class="btn-danger del" href="javascript:void(0);" data-id="{{ $v->group_id }}">删除</a>
        </td>
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td class="text-c w10">
            <input type="checkbox" class="allCheckBox checkBox" />
        </td>
        <td colspan="5">
            <div class="pull-left">
                <input type="button" class="btn btn-danger m-r-2 del" value="批量删除" />
            </div>
            <div class="pull-right page-box">
                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>