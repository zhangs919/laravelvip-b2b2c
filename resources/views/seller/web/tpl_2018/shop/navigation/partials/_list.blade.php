<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck">
            <input type="checkbox" class="checkBox allCheckBox" />
        </th>
        <!-- 编号 -->
        <th class="text-c w80" data-sortname="nav_id">编号</th>
        <!-- 导航名称 -->
        <th class="w150" data-sortname="nav_name">导航名称</th>
        <!-- 链接地址 -->
        <th class="w200" data-sortname="nav_link">链接地址</th>
        <!-- 是否显示 -->
        <th class="text-c w100" data-sortname="is_show">是否显示</th>
        <!-- 新窗口打开 -->
        <th class="text-c w120" data-sortname="new_open">新窗口打开</th>
        <!-- 排序 -->
        <th class="text-c w80" data-sortname="nav_sort">排序</th>
        <!-- 操作-->
        <th class="handle w150">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
    <tr>
        <td class="tcheck">
            <input type="checkbox" class="checkBox" value="{{ $v->nav_id }}" />
        </td>
        <td class="text-c">{{ $v->nav_id }}</td>
        <td>{{ $v->nav_name }}</td>
        <td>

            <a href="{{ $v->nav_link }}" target="_blank">{{ $v->nav_link }}</a>

        </td>
        <td class="text-c">
            @if($v->is_show == 1)
                <span data-action="set-is-show?id={{ $v->nav_id }}" class="ico-switch open" data-value="[0,1]" data-label='["\u5426","\u662f"]' data-class='["fa fa-toggle-off","fa fa-toggle-on"]'><i class="fa fa-toggle-on"></i>是</span>
            @else
                <span data-action="set-is-show?id={{ $v->nav_id }}" class="ico-switch" data-value="[0,1]" data-label='["\u5426","\u662f"]' data-class='["fa fa-toggle-off","fa fa-toggle-on"]'><i class="fa fa-toggle-off"></i>否</span>
            @endif
        </td>
        <td class="text-c">
            @if($v->new_open == 1)
                <span data-action="set-new-open?id={{ $v->nav_id }}" class="ico-switch open" data-value="[0,1]" data-label='["\u5426","\u662f"]' data-class='["fa fa-toggle-off","fa fa-toggle-on"]'><i class="fa fa-toggle-on"></i>是</span>
            @else
                <span data-action="set-new-open?id={{ $v->nav_id }}" class="ico-switch" data-value="[0,1]" data-label='["\u5426","\u662f"]' data-class='["fa fa-toggle-off","fa fa-toggle-on"]'><i class="fa fa-toggle-off"></i>否</span>
            @endif
        </td>
        <td class="text-c">
            <font class="f14">
                <a href="javascript:void(0);" class="nav_sort" data-nav_id={{ $v->nav_id }}>{{ $v->nav_sort }}</a>
            </font>
        </td>
        <td class="handle">
            <a href="edit?id={{ $v->nav_id }}&is_design={{ $is_design ?? 0 }}">编辑</a>
            <span>|</span>
            <a href="javascript:void(0);" object_id="{{ $v->nav_id }}" class="del border-none">删除</a>
        </td>
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td class="text-c w10">
            <input type="checkbox" class="allCheckBox checkBox" />
        </td>
        <td colspan="7">
            <div class="pull-left">
                <input type="button" id="batch-delete" class="btn btn-danger m-r-2" value="批量删除" />
            </div>
            <div class="pull-right page-box">
                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>