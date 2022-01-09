<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <!--<th class="tcheck"></th>-->
        <th class="text-c w100" data-sortname="shipping_id">编号</th>
        <th class="w200" data-sortname="shipping_name">快递公司名称</th>
        <th class="text-c w150" data-sortname="is_open">是否启用</th>
        <th class="handle w200">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
    <tr>
        <!--<td></td>-->
        <td class="text-c">{{ $v->shipping_id }}</td>
        <td>
            {{ $v->shipping->shipping_name }}
        </td>
        <td class="text-c">
            @if($v->is_open == 1)
                <span data-action="set-is-show?id={{ $v->id }}" class="ico-switch open" data-value="[0,1]" data-label='["\u5426","\u662f"]' data-class='["fa fa-toggle-off","fa fa-toggle-on"]'><i class="fa fa-toggle-on"></i>是</span>
            @else
                <span data-action="set-is-show?id={{ $v->id }}" class="ico-switch" data-value="[0,1]" data-label='["\u5426","\u662f"]' data-class='["fa fa-toggle-off","fa fa-toggle-on"]'><i class="fa fa-toggle-off"></i>否</span>
            @endif
        </td>
        <td class="handle">

            <a href="edit?id={{ $v->id }}">设置运单模板</a>
            <span>|</span>
            <a href="print?id={{ $v->id }}" target="_blank">测试打印</a>

        </td>
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <!--<td class="text-c w10"></td>-->
        <td colspan="4">
            <div class="pull-right page-box">


                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
