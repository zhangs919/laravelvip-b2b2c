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
        <th class="text-c w100" data-sortname="status">状态</th>
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
            @if($v->is_enable == 0)
                <font class="c-red">禁用</font>
            @elseif($v->is_enable == 1)
                <font class="c-green">启用</font>
            @endif
            <!---->
            <!-- -->
        </td>
        <td class="handle">
            @if($v->is_enable == 0)
                <a onclick="enabled('{{ $v->id }}','{{ $v->shop->shop_name }}','{{ $v->contract->contract_name }}')">开启使用</a>
            @elseif($v->is_enable == 1)
                <a class="del" onclick="forbidden('{{ $v->id }}','{{ $v->shop->shop_name }}','{{ $v->contract->contract_name }}')">禁止使用</a>
            @endif
        </td>
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td class="w10 text-c">
            <input type="checkbox" class="allCheckBox checkBox" />
        </td>
        <td colspan="7">
            <div class="pull-left">
                <input type="button" id="batch_open" class="btn btn-primary m-r-2" value="批量开启使用" />
                <input type="button" id="batch_forbidden" class="btn btn-danger m-r-2" value="批量禁止使用" />
            </div>
            <div class="pull-right page-box">

                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
