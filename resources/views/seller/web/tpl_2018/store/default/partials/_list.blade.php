<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck">
            <input type="checkbox" class="checkBox allCheckBox" />
        </th>
        <!-- 编号 -->
        <th class="text-c w80" data-sortname="store_id">编号</th>
        <!-- 网点名称 -->
        <th class="w200" data-sortname="store_name">网点名称</th>
        <!-- 网点分组 -->
        <th class="w200" data-sortname="group_id">分组</th>
        <!-- 网点信息 -->
        <th class="w300" data-sortname="">网点信息</th>
        <!-- 网点管理员 -->
        <th class="w150" data-sortname="u.user_id">网点管理员</th>
        <!-- 网点关联商品 -->
        <th class="w150" data-sortname="goods_count">商品数量</th>
        <!-- 网点订单 -->
        <th class="w150" data-sortname="order_count">订单数量</th>
        <th class="w150" data-sortname="order_count">网点状态</th>
        <!-- 操作-->
        <th class="handle w200">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
    <tr>
        <td class="tcheck">
            <input type="checkbox" class="checkBox" value="{{ $v->store_id }}" />
        </td>
        <td class="text-c">{{ $v->store_id }}</td>
        <td>
            <div class="ng-binding">
                <span>{{ $v->store_name }}</span>
            </div>
        </td>
        <td>
            <div class="ng-binding">
                <span>{{ $v->storeGroup->group_name ?? '' }}</span>
            </div>
        </td>
        <td>
            <div class="ng-binding">
                <span>{{ $v->address }}</span>
                <span>网点电话：{{ $v->tel }} </span>
            </div>
        </td>
        <td>测试网店</td>
        <td>
            <a class="c-blue" href="/goods/list/index?store_id={{ $v->store_id }}">3</a>
        </td>
        <td>
            <a class="c-blue" href="/trade/order/list?stid={{ $v->store_id }}">0</a>
        </td>
        <td>
            @if($v->store_status == 1)
                <span data-action="set-is-enable?id={{ $v->store_id }}" class="ico-switch open" data-value="[0,1]" data-label='["\u5426","\u662f"]' data-class='["fa fa-toggle-off","fa fa-toggle-on"]'><i class="fa fa-toggle-on"></i>是</span>
            @else
                <span data-action="set-is-enable?id={{ $v->store_id }}" class="ico-switch" data-value="[0,1]" data-label='["\u5426","\u662f"]' data-class='["fa fa-toggle-off","fa fa-toggle-on"]'><i class="fa fa-toggle-off"></i>否</span>
            @endif
        </td>
        <td class="handle">
            <a href="edit?id={{ $v->store_id }}">编辑</a>
            <span>|</span>
            <a href="javascript:void(0);" data-id="{{ $v->store_id }}" class="del border-none">删除</a>
        </td>
    </tr>
    @endforeach

    </tbody>
    </tbody>
    <tfoot>
    <tr>
        <td class="text-c w10">
            <input type="checkbox" class="allCheckBox checkBox" />
        </td>
        <td colspan="9">
            <div class="pull-left">
                <input type="button" id="btn_set_group" class="btn btn-default m-r-2" value="批量设置分组" />
                <input type="button" id="batch-delete" class="btn btn-danger m-r-2" value="批量删除" />
            </div>
            <div class="pull-right page-box">
                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
