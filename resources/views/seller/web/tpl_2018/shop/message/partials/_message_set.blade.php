<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <!-- 编号 -->
        <th class="text-c w100" data-sortname="">编号</th>
        <!-- 模块名称 -->
        <th class="w300" data-sortname="">模板名称</th>
        <!-- 接收方式 -->
        <th class="w300" data-sortname="">接收方式</th>
        <!-- 是否启用 -->
        <th class="text-c w150" data-sortname="">是否启用</th>
        <!-- 操作-->
        <!--
        <th class="handle">操作</th>
         -->
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
    <tr>
        <td class="text-c">{{ $v['id'] }}</td>
        <td>{{ $v['name'] }}</td>
        <td>{{ $v['receive_type'] }}</td>
        <td class="text-c">
            @if($v['is_open'] == 1)
                <span data-action="set-is-open?id={{ $v['shop_tpl_id']  }}&tpl_id={{ $v['id'] }}" class="ico-switch open" data-value='[0,1]' data-label='["\u5426","\u662f"]' data-class='["fa fa-toggle-off","fa fa-toggle-on"]'><i class="fa fa-toggle-on"></i>是</span>
            @else
                <span data-action="set-is-open?id={{ $v['id'] }}&tpl_id={{ $v['id'] }}" class="ico-switch" data-value='[0,1]' data-label='["\u5426","\u662f"]' data-class='["fa fa-toggle-off","fa fa-toggle-on"]'><i class="fa fa-toggle-off"></i>否</span>
            @endif
        </td>
        <!--
        <td class="handle">
            <a href="javascript:void(0);">设置</a>
        </td>
         -->
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td colspan="4">
            <div class="pull-right page-box">

                {!! $pageHtml !!}

            </div>
        </td>
    </tr>
    </tfoot>
</table>
