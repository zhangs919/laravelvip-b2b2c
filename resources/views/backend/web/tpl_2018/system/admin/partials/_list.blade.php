<div class="table-responsive">

    <table id="table_list" class="table table-hover">
        <thead>
        <tr>
            <th data-sortname="user_id" class="text-c" data-sortorder="asc" style="cursor: pointer;">编号<span class="sort"></span></th>
            <th data-sortname="user_name" data-sortorder="asc" style="cursor: pointer;">登录名<span class="sort"></span></th>
            <th data-sortname="real_name" data-sortorder="asc" style="cursor: pointer;">姓名<span class="sort"></span></th>
            <th data-sortname="role_name" data-sortorder="asc" style="cursor: pointer;">角色<span class="sort"></span></th>
            <th data-sortname="" style="cursor: default;">最后登录时间</th>
            <th data-sortname="last_ip" class="text-c" data-sortorder="asc" style="cursor: pointer;">最后登录IP<span class="sort"></span></th>
            <th data-sortname="visit_count" data-sortorder="asc" class="" style="cursor: pointer;">登录次数<span class="sort"></span></th>
            <th class="text-c" style="cursor: default;">状态</th>
            <th class="handle" style="cursor: default;">操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($list as $v)
        <tr>
            <td class="text-c">{{ $v->user_id }}</td>
            <td>{{ $v->user_name }}</td>
            <td>{{ $v->real_name }}</td>
            <td>{{ $v->adminRole->role_name ?? '' }}</td>
            <td>{{ $v->last_time }}</td>
            <td class="text-c">{{ $v->last_ip }}</td>
            <td>{{ $v->visit_count }}</td>
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
                <a href="javascript:void(0);" class="del" onclick="delConfirm('{{ $v->user_id }}')">删除</a>

            </td>

        </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td colspan="9">
                <div id="pagination" class="pull-right page-box">


                    {!! $pageHtml !!}

                </div>
            </td>
        </tr>
        </tfoot>
    </table>

</div>
