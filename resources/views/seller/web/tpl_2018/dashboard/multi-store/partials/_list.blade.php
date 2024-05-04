<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck">
            <input type="checkbox" class="checkBox allCheckBox" />
        </th>
        <!-- 编号 -->
        <th class="text-c w60" data-sortname="store_id">编号</th>
        <!-- 门店名称 -->
        <th class="w100" data-sortname="store_name">门店名称</th>
        <!-- 门店分组 -->
        <th class="w80" data-sortname="group_id">分组</th>
        <!-- 门店信息 -->
        <th class="w120" data-sortname="">门店信息</th>
        <!-- 门店管理员 -->
        <th class="w120" data-sortname="u.user_id">门店管理员</th>
        <!-- 门店关联商品 -->
        <th class="w80" data-sortname="goods_count">商品数量</th>
        <!-- 门店订单 -->
        <th class="w80">订单数量</th>
        <!-- <th class="w80">门店佣金</th> -->
        <th class="w100" data-sortname="store_status">门店状态</th>
        <!-- 操作-->
        <th class="handle w250">操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($list as $v)
    <tr>
        <td class="tcheck">
            <input type="checkbox" class="checkBox" value="{{ $v->store_id }}" data-name="{{ $v->store_name }}"/>
        </td>
        <td class="text-c">{{ $v->store_id }}</td>
        <td>
            <div class="ng-binding">
                <span>{{ $v->store_name }}</span>
                @if($v->is_pickup)
                <label class="product-label info">门店自提</label>
                @endif
            </div>
        </td>
        <td>
            <div class="ng-binding">
                <span>{{ $v->group_name }}</span>
            </div>
        </td>
        <td>
            <div class="ng-binding">
                <span>{{ $v->address }}</span>
                <span>门店电话：{{ $v->tel }} </span>
            </div>
        </td>
        <td>{{ $v->user_name }}</td>
        <td>
            <a class="c-blue" href="/dashboard/multi-store/goods-list?store_id={{ $v->store_id }}">{{ $v->goods_count }}</a>
        </td>
        <td>{{ $v->order_count }}</td>
        <!-- <td>
            <a href="javascript:void(0);" class="take_rate editable editable-click" data-store_id={{ $v->store_id }}>10.00</a>
            %
        </td> -->
        <td class="store-status-td">
            @if($v->store_status == 1)
                <span value="{{ $v->store_status }}" data-action="/dashboard/multi-store/set-is-enable?id={{ $v->store_id }}" class="ico-switch open" data-value='[0,1]' data-label='["关闭","开启"]' data-class='["fa fa-toggle-off","fa fa-toggle-on"]'><i class="fa fa-toggle-on"></i>开启</span>
            @else
                <span value="{{ $v->store_status }}" data-action="/dashboard/multi-store/set-is-enable?id={{ $v->store_id }}" class="ico-switch" data-value='[0,1]' data-label='["关闭","开启"]' data-class='["fa fa-toggle-off","fa fa-toggle-on"]'><i class="fa fa-toggle-off"></i>关闭</span>
            @endif
        </td>
        <td class="handle">
            <a href="/dashboard/multi-store/edit?id={{ $v->store_id }}">编辑</a>
            <span>|</span>
            <a href="javascript:void(0);" data-id="{{ $v->store_id }}" class="del border-none">删除</a>
            <span>|</span>
            <a href="/dashboard/multi-store/goods-list?store_id={{ $v->store_id }}" data-id="{{ $v->store_id }}" class="border-none">商品管理</a>
            <span>|</span>
            <a href="javascript:void(0)" data-diy="1" data-storeid="{{ $v->store_id }}" class="diy">首页设置</a>
            <span>|</span>
            <a href="javascript:void(0)" class="master" data-storeid="{{ $v->store_id }}" data-master="{{ $v->is_master }}">@if($v->is_master){{ '取消默认门店' }}@else{{ '设为默认门店' }}@endif</a>
            <span>|</span>
            <a href="javascript:void(0)" class="popularize" data-name="{{ $v->store_name }}" data-id="{{ $v->store_id }}" data-url="{{ $v->url }}/index.html?is_scan=1">推广码</a>
            <span>|</span>
            <a href="javascript:void(0);" data-multi-store-id="{{ $v->store_id }}" data-url="{{ $v->url }}/site/oneclick.html" class="oneclick">一键登录门店管理中心</a>
            <!-- <span>|</span>
            <a href='javascript:void(0)' class="synchro" data-storeid="{{ $v->store_id }}">一键同步店铺商品</a> -->
            <span>|</span>
            <a href='javascript:void(0)' class="set_store_act" data-storeid="{{ $v->store_id }}" data-storename="包邮到家门店">活动参与设置</a>
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
                <div class="btn-group dropup m-r-2">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        批量操作
                        <span class="caret m-l-5"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a id="batch_opening_hour">批量调整营业时间</a>
                        </li>
                        <li>
                            <a id="batch_store_status">批量调整门店状态</a>
                        </li>
                        <li>
                            <a id="batch_clearing_cycle">批量调整门店结算周期</a>
                        </li>
                        <li>
                            <a id="batch_set_group">批量设置分组</a>
                        </li>
                        <li>
                            <a id="batch-delete">批量删除</a>
                        </li>
                        <li>
                            <a id="batch_set_activity">批量设置活动</a>
                        </li>
                        <li>
                            <a id="batch_related_goods">批量关联商品</a>
                        </li>
                        <li>
                            <a class="batch_other_shpping_fee">批量调整额外配送费</a>
                        </li>
                        <li>
                            <a class="batch_packing_fee">批量调整包装费</a>
                        </li>
                        <li>
                            <a class="batch_support_shipping_type">批量调整门店配送方式</a>
                        </li>
                        <li>
                            <a class="batch_city_shipping">批量调整门店配送时间</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="pull-right page-box">
                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
