<div class="table-responsive">

    <table id="table_list" class="table table-hover">
        <thead>
        <tr>
            <th class="text-c w100" data-sortname="pay_id" data-sortorder="asc" style="cursor: pointer;">编号<span class="sort"></span></th>
            <th class="w200" data-sortname="pay_code" data-sortorder="asc" style="cursor: pointer;">支付方式代码<span class="sort"></span></th>
            <th class="w200" data-sortname="pay_name" data-sortorder="asc" style="cursor: pointer;">支付方式名称<span class="sort"></span></th>
            <th class="w100 text-c" data-sortname="is_enable" data-sortorder="asc" style="cursor: pointer;">是否启用<span class="sort"></span></th>
            <th class="w100 text-c" data-sortname="pay_sort" data-sortorder="asc" style="cursor: pointer;">排序<span class="sort"></span></th>
            <th class="handle w100">操作</th>
        </tr>
        </thead>
        <tbody>

        @foreach($list as $v)
        <tr>
            <td class="text-c">{{ $v->pay_id }}</td>
            <td>{{ $v->pay_code }}</td>
            <td>{{ $v->pay_name }}</td>
            <td class="text-c">
                @if($v->is_enable == 1)
                    <span data-action="set-is-enable?id={{ $v->pay_id }}" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>是</span>
                @else
                    <span data-action="set-is-enable?id={{ $v->pay_id }}" class="ico-switch" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-off"></i>否</span>
                @endif
            </td>
            <td class="text-c">
                <font class="f14">
                    <a href="javascript:void(0);" class="shop_sort editable editable-click" data-pay_id="{{ $v->pay_id }}">{{ $v->pay_sort }}</a>
                </font>
            </td>
            <td class="handle">
                <a href="config-payment?pay_id={{ $v->pay_id }}">配置参数</a>
            </td>
        </tr>
        @endforeach

        </tbody>
        <tfoot>
        <tr>
            <td colspan="6">
                <div class="pull-left"></div>
                <div class="pull-right page-box">


                    {!! $pageHtml !!}
                </div>
            </td>
        </tr>
        </tfoot>
    </table>

</div>