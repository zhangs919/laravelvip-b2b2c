<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck">
            <input type="checkbox" class="checkBox allCheckBox" />
        </th>
        <th class="text-c w80" data-sortname="unit_id">编号</th>
        <th class="w400" data-sortname="unit_name">单位名称</th>
        <th class="handle w120">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
    <tr>
        <td class="tcheck">
            <input type="checkbox" class="checkBox activitycheckbox" value="{{ $v->unit_id }}" />
        </td>
        <td class="text-c">{{ $v->unit_id }}</td>
        <td>{{ $v->unit_name }}</td>
        <td class="handle">
            <a href="javascript:void(0);" data-id="{{ $v->unit_id }}" class="btn-edit">编辑</a>
            <span>|</span>
            <a href="javascript:void(0);" data-id="{{ $v->unit_id }}" class="del border-none">删除</a>
        </td>
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td class="tcheck text-c">
            <input type="checkbox" class="allCheckBox checkBox" />
        </td>
        <td colspan="3">
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