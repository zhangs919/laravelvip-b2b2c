<!-- 列表 -->
<div class="table-responsive">

    <table id="table_list" class="table table-hover">
        <thead>
        <tr>
            <!--<th class="tcheck"></th>-->
            <th class="text-c w80" data-sortname="shipping_id" data-sortorder="asc" style="cursor: pointer;">编号<span class="sort"></span></th>
            <th class="w200" data-sortname="shipping_name" data-sortorder="asc" style="cursor: pointer;">快递公司名称<span class="sort"></span></th>
            <!--<th data-sortname="site_url">快递公司网址</th>  -->
            <th class="text-c w120" data-sortname="is_open" data-sortorder="asc" style="cursor: pointer;">是否启用<span class="sort"></span></th>
            <th class="text-c w150" data-sortname="shipping_code" data-sortorder="asc" style="cursor: pointer;">系统物流代码<span class="sort"></span></th>
            <!-- <th class="text-c w100" data-sortname="shipping_sort">排序</th> -->
            <th class="handle w300" style="cursor: default;">操作</th>
        </tr>
        </thead>
        <tbody>

        @foreach($list as $v)
        <tr>
            <!--<td></td>-->
            <td class="text-c">{{ $v->shipping_id }}</td>
            <td>{{ $v->shipping_name }}</td>
            <!--<td>{{ $v->site_url }}</td>-->
            <td class="text-c">
                @if($v->is_open == 1)
                    <span data-action="set-is-show?id={{ $v->shipping_id }}" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>是</span>
                @else
                    <span data-action="set-is-show?id={{ $v->shipping_id }}" class="ico-switch" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-off"></i>否</span>
                @endif
            </td>
            <td class="text-c">{{ $v->shipping_code }}</td>
            <!-- <td class="text-c">
                <font class="f14">
                    <a href="javascript:void(0);" class="shipping_sort" data-id={{ $v->shipping_id }}>{{ $v->shipping_sort }}</a>
                </font>
            </td> -->
            <td class="handle">

                <a href="edit-shipping?id={{ $v->shipping_id }}">编辑</a>
                <span>|</span>
                <a href="javascript:void(0);" data-id="{{ $v->shipping_id }}" class="del border-none">删除</a>
                <span>|</span>
                <a href="javascript:void(0);" data-id="{{ $v->shipping_code }}" class="config">电子面单参数配置</a>
                <span>|</span>

                <a href="edit?id={{ $v->shipping_id }}">设置运单模板</a>
                <span>|</span>
                <a href="print?id={{ $v->shipping_id }}" target="_blank">测试打印</a>

            </td>
        </tr>
        @endforeach

        </tbody>
        <tfoot>
        <tr>
            <td colspan="5">
                <div class="pull-right page-box">


                    {!! $pageHtml !!}
                </div>
            </td>
        </tr>
        </tfoot>
    </table>

</div>