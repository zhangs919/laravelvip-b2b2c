<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck">
            <input type="checkbox" class="checkBox allCheckBox" />
        </th>
        <th class="text-c w150" data-sortname="layout_id">板式ID</th>
        <th class="w300" data-sortname="layout_name">版式名称</th>
        <th class="w300" data-sortname="position">模板位置</th>
        <th class="handle w200">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
    <tr>
        <td class="tcheck">
            <input type="checkbox" class="checkBox" value="{{ $v->layout_id }}" />
        </td>
        <td class="text-c">{{ $v->layout_id }}</td>
        <td>{{ $v->layout_name }}</td>
        <td>
            @if($v->position == 0)
                详情顶部
            @elseif($v->position == 1)
                详情底部
            @elseif($v->position == 2)
                包装清单
            @elseif($v->position == 3)
                售后保障
            @endif
        </td>
        <td class="handle">
            <a href="edit?id={{ $v->layout_id }}">编辑</a>
            <span>|</span>
            <a href="javascript:void(0);" data-id="{{ $v->layout_id }}" class="del border-none">删除</a>
        </td>
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td class="text-c w10">
            <input type="checkbox" class="allCheckBox checkBox" />
        </td>
        <td colspan="4">
            <div class="pull-left">
                <input type="button" id="btn_delete" class="btn btn-danger m-r-2 del" value="批量删除" />
                <!--当没有选中任何所操作的项，按钮为禁用状态，将按钮样式btn-danger替换为disabled-->
            </div>
            <div class="pull-right page-box">


                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>