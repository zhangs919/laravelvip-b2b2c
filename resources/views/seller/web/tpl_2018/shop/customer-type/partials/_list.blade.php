<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck">
            <input type="checkbox" class="checkBox allCheckBox" />
        </th>
        <th class="text-c 100" data-sortname="type_id">编号</th>
        <th class="w200" data-sortname="type_name">客服类型名称</th>
        <th class="w300" data-sortname="type_desc">客服描述</th>
        <th class="text-c w100" data-sortname="is_show">是否启用</th>
        <th class="text-c w100" data-sortname="type_sort">排序</th>
        <th class="handle w150">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
    <tr>
        <td class="tcheck">
            <input type="checkbox" class="checkBox" value="{{ $v->type_id }}" />
        </td>
        <td class="text-c">{{ $v->type_id }}</td>
        <td>{{ $v->type_name }}</td>
        <td>{{ $v->type_desc }}</td>
        <td class="text-c">
            @if($v->is_show == 1)
                <span data-action="set-is-show?id={{ $v->type_id }}" class="ico-switch open" data-value='[0,1]' data-label='["\u5426","\u662f"]' data-class='["fa fa-toggle-off","fa fa-toggle-on"]'><i class="fa fa-toggle-on"></i>是</span>
            @else
                <span data-action="set-is-show?id={{ $v->type_id }}" class="ico-switch" data-value='[0,1]' data-label='["\u5426","\u662f"]' data-class='["fa fa-toggle-off","fa fa-toggle-on"]'><i class="fa fa-toggle-off"></i>否</span>
            @endif
        </td>
        <td class="text-c">
            <font class="f14">
                <a href="javascript:void(0);" class="customer_sort" data-type_id={{ $v->type_id }}>{{ $v->type_sort }}</a>
            </font>
        </td>
        <td class="handle">
            <a href="edit?id={{ $v->type_id }}">编辑</a>
            <span>|</span>
            <a href="javascript:void(0);" data-id="{{ $v->type_id }}" class="del border-none">删除</a>
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
                <!--当没有选中任何所操作的项，按钮为禁用状态，将按钮样式btn-danger替换为disabled-->
            </div>
            <div class="pull-right page-box">


                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
