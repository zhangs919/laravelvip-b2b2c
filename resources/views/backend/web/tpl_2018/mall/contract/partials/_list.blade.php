<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck">
            <input type="checkbox" class="checkBox allCheckBox" />
        </th>
        <th class="text-c w80" data-sortname="contract_id">编号</th>
        <th class="w200" data-sortname="contract_name">保障服务名称</th>
        <th class="w150" data-sortname="contract_fee">保证金金额</th>
        <th class="w150 text-c" data-sortname="is_open">是否开启</th>
        <th class="w150" data-sortname="contract_type">保障类型</th>
        <th class="text-c w100" data-sortname="contract_sort">排序</th>
        <th class="handle w100">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
    <tr>
        <td class="tcheck">
            <input type="checkbox" class="checkBox" name="xzbox" value="{{ $v->contract_id }}" />
        </td>
        <td class="text-c">{{ $v->contract_id }}</td>
        <td>
            <span title="{{ $v->contract_name }}">{{ $v->contract_name }}</span>
        </td>
        <td>{{ $v->contract_fee }}</td>
        <td class="text-c">
            @if($v['is_open'] == 1)
                <span data-action="set-is-open?id={{ $v->contract_id }}" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>是</span>
            @else
                <span data-action="set-is-open?id={{ $v->contract_id }}" class="ico-switch" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-off"></i>否</span>
            @endif
        </td>
        <td>@if($v->contract_type == 0) 初级服务 @elseif($v->contract_type == 1) 高级服务 @endif</td>
        <td class="text-c">
            <font class="f14">
                <a href="javascript:void(0);" class="contract_sort" data-id={{ $v->contract_id }}>{{ $v->contract_sort }}</a>
            </font>
        </td>
        <td class="handle">
            <a href="edit?id={{ $v->contract_id }}">编辑</a>
            <span>|</span>
            <a href="javascript:void(0);" onclick="del('{{ $v->contract_id }}');" class="del border-none">删除</a>
        </td>
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td class="text-c w10">
            <input type="checkbox" class="allCheckBox checkBox">
            </input>
        </td>
        <td colspan="7">
            <div class="pull-left">
                <input type="button" id="btn_delete" class="btn btn-danger m-r-2" value="批量删除" />
                <!--当没有选中任何所操作的项，按钮为禁用状态，将按钮样式btn-danger替换为disabled-->
            </div>
            <div class="pull-right page-box">


                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
