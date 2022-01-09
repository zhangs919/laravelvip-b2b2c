<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck">
            <input type="checkbox" class="checkBox allCheckBox" />
        </th>
        <!-- 编号 -->
        <th class="text-c w60" data-sortname="user_id">编号</th>
        <!-- 登录名 -->
        <th class="w150" data-sortname="user_name">登录名</th>
        <!-- 角色 -->
        <th class="w100" data-sortname="">角色</th>
        <!-- 创建时间 -->
        <th class="w120" data-sortname="reg_time">创建时间</th>
        <!-- 最后登录时间 -->
        <th class="w120" data-sortname="last_time">最后登录时间</th>
        <!-- 最后登录IP -->
        <th class="w100" data-sortname="last_ip">最后登录IP</th>
        <!-- 登录次数 -->
        <th class="text-c w100" data-sortname="visit_count">登录次数</th>
        <!-- 状态 -->
        <th class="text-c w80" data-sortname="status">状态</th>
        <!-- 操作-->
        <th class="handle w180">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
    <tr>
        <td class="tcheck">
            <input type="checkbox" class="checkBox" />
        </td>
        <!-- 编号 -->
        <td class="text-c">{{ $v->user_id }}</td>
        <!-- 登录名 -->
        <td>
            {{ $v->user_name }}

            <div class="m-t-2"></div>
            @if($v->is_seller == 1)
                <label class="product-label warning">店铺管理员</label>
            @elseif($v->is_seller == 2)
                <label class="product-label success" title="【{{ $v->store_name }}】管理员">网点管理员</label>
            @endif

        </td>
        <!-- 角色 -->
        <td>{{ $v->shopRole->role_name ?? '' }}</td>
        <!-- 创建时间 -->
        <td>{{ $v->reg_time }}</td>
        <!-- 最后登录时间 -->
        <td>{{ $v->last_login }}</td>
        <!-- 最后登录IP -->
        <td>{{ $v->last_ip }}</td>
        <!-- 登录次数 -->
        <td class="text-c">{{ $v->visit_count }}</td>
        <!-- 状态 -->

        <td class="text-c">
            @if($v->status == 1)
                <span data-action="set-status?id={{ $v->user_id }}" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u7981\u7528&quot;,&quot;\u542f\u7528&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>启用</span>
            @else
                <span data-action="set-status?id={{ $v->user_id }}" class="ico-switch" data-value="[0,1]" data-label="[&quot;\u7981\u7528&quot;,&quot;\u542f\u7528&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-off"></i>禁用</span>
            @endif
        </td>

        <td class="handle">

            <a href="edit?id={{ $v->user_id }}">编辑</a>

            <span>|</span>

            <a href="auth-set?id={{ $v->user_id }}">权限</a>

            <span>|</span>

            <a href="javascript:void(0);" object_id="{{ $v->user_id }}" data-store_id="{{ $v->store_id }}" class="del border-none">删除</a>

        </td>
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td colspan="10">
            <div class="pull-right page-box">
                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
