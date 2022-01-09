<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck">
            <input type="checkbox" class="checkBox allCheckBox" />
        </th>
        <th class="text-c w80" data-sortname="id">编号</th>
        <th class="w200" data-sortname="shop_name">店铺名称</th>
        <th class="w150" data-sortname="contract_name">保障服务</th>
        <th class="w150" data-sortname="contract_fee">保障金金额（元）</th>
        <th class="w150" data-sortname="contract_type">保障类型</th>
        <th class="text-c w100" data-sortname="status">审核状态</th>
        <th class="handle w100">操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($list as $v)
    <tr>
        <td class="tcheck">
            <input type="checkbox" class="checkBox" value="{{ $v->id }}" />
        </td>
        <td class="text-c">{{ $v->id }}</td>
        <td><span title="{{ $v->shop->shop_name }}">{{ $v->shop->shop_name }}</span></td>
        <td>{{ $v->contract->contract_name }}</td>
        <td>{{ $v->contract->contract_fee }}</td>
        <td>@if($v->contract->contract_type == 0) 初级服务 @elseif($v->contract->contract_type == 1) 高级服务 @endif</td>
        <td class="text-c">

            @if($v->status == 1)
                <font class="c-red">待审核</font>
            @elseif($v->status == 3)
                <font class="c-yellow">审核未通过</font>

            @endif

        </td>
        <td class="handle">
            <a href="to-audit?id={{ $v->id }}">审核</a>
        </td>
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td class="w10 text-c">
            <input type="checkbox" class="allCheckBox checkBox">
            </input>
        </td>
        <td colspan="7">
            <div class="pull-left">
                <input type="button" id="audit_access" class="btn btn-primary m-r-2" value="审核通过" />
                <input type="button" id="audit_refuse" class="btn btn-danger m-r-2" value="审核拒绝" />
                <!--当没有选中任何所操作的项，按钮为禁用状态，将按钮样式btn-danger替换为disabled-->
            </div>
            <div class="pull-right page-box">


                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
