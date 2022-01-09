<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <!-- 付款时间 -->
        <th class="w200" data-sortname="pay_time" data-sortorder="asc" style="cursor: pointer;">付款时间<span class="sort"></span></th>
        <!-- 付款方式 -->
        <th class="w120" data-sortname="" style="cursor: default;">付款方式</th>
        <!-- 付款金额 -->
        <th class="w150" data-sortname="" style="cursor: pointer;">付款金额</th>
        <!-- 付款状态 -->
        <th class="w120 text-c" data-sortname="" style="cursor: default;">付款状态</th>
        <!-- 店铺到期时间 -->
        <th class="w200" data-sortname="" style="cursor: default;">店铺到期时间</th>
        <!-- 备注 -->
        <th class="w200" data-sortname="" style="cursor: default;">备注</th>
        <!-- 操作 -->
        <th class="handle">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
    <tr>

        <td>{{ $v->pay_time }}</td>

        <td>{{ $v->pay_code }}</td>
        <td>{{ $v->insure_fee + $v->system_fee }} 元</td>
        <td class="text-c">
            @if($v->pay_status == 1)
                <font class="c-green">已付款</font>
                <!---->
            @else
                <!-- -->

                <font class="c-red">未付款</font>
                <!---->
            @endif
        </td>
        <td>{{ $v->end_time }}</td>
        <td>{{ $v->remark }}</td>
        <td class="handle">

            @if($v->pay_status == 0)
                <a href="pay-edit?pay_id={{ $v->pay_id }}&{{ $extra }}">编辑</a>
                <span>|</span>
                <a href="javascript:void(0);" object_id="{{ $v->pay_id }}" class="del border-none">删除</a>
            @endif

        </td>
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td colspan="7">
            <div class="pull-right page-box">


                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>