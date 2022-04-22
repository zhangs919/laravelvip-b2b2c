<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck">
            <input type="checkbox" class="checkBox allCheckBox" />
        </th>
        <th class="text-c w80" data-sortname="customer_id">编号</th>
        <th class="w100" data-sortname="type_name">客服类型</th>
        <th class="w120" data-sortname="customer_name">客服名称</th>
        <th class="w100" data-sortname="customer_tool">客服工具</th>
        <th class="w100" data-sortname="customer_account">客服账号</th>
        <th class="text-c w100" data-sortname="is_main">是否主客服</th>
        <th class="text-c w100" data-sortname="is_show">是否显示</th>
        <th class="text-c w80" data-sortname="customer_sort">排序</th>
        <th class="handle w100">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
    <tr>
        <td class="tcheck">
            <input type="checkbox" class="checkBox" value="{{ $v->customer_id }}" />
        </td>
        <td class="text-c">{{ $v->customer_id }}</td>
        <td>@if($v->customer_tool == 1)QQ @elseif($v->customer_tool == 2)旺旺 @endif</td>
        <td>{{ $v->customer_name }}</td>
        <td>{{ $v->customer_tool }}</td>
        <td>{{ $v->customer_account }}</td>
        <td class="text-c">
            @if($v->is_main == 1)
                <span data-action="set-is-main?id={{ $v->customer_id }}" refresh="1" class="ico-switch open" data-value='[0,1]' data-label='["\u5426","\u662f"]' data-class='["fa fa-toggle-off","fa fa-toggle-on"]'><i class="fa fa-toggle-on"></i>是</span>
            @else
                <span data-action="set-is-main?id={{ $v->customer_id }}" refresh="1" class="ico-switch" data-value='[0,1]' data-label='["\u5426","\u662f"]' data-class='["fa fa-toggle-off","fa fa-toggle-on"]'><i class="fa fa-toggle-off"></i>否</span>
            @endif
        </td>
        <td class="text-c">
            @if($v->is_show == 1)
                <span data-action="set-is-show?id={{ $v->customer_id }}" class="ico-switch open" data-value='[0,1]' data-label='["\u5426","\u662f"]' data-class='["fa fa-toggle-off","fa fa-toggle-on"]'><i class="fa fa-toggle-on"></i>是</span>
            @else
                <span data-action="set-is-show?id={{ $v->customer_id }}" class="ico-switch" data-value='[0,1]' data-label='["\u5426","\u662f"]' data-class='["fa fa-toggle-off","fa fa-toggle-on"]'><i class="fa fa-toggle-off"></i>否</span>
            @endif
        </td>
        <td class="text-c">
            <font class="f14">
                <a href="javascript:void(0);" class="customer_sort" data-customer_id={{ $v->customer_id }}>{{ $v->customer_sort }}</a>
            </font>
        </td>
        <td class="handle">
            <a href="edit?id={{ $v->customer_id }}">编辑</a>
            <span>|</span>
            <a href="javascript:void(0);" data-id="{{ $v->customer_id }}" class="del border-none">删除</a>
        </td>
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td class="text-c w10">
            <input type="checkbox" class="allCheckBox checkBox" />
        </td>
        <td colspan="9">
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
