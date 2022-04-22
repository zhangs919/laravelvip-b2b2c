<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <!---<th class="tcheck">
            <input type="checkbox" class="checkBox allCheckBox" />
        </th>-->
        <!-- 编号 -->
        <th class="text-c w80" data-sortname="links_id" data-sortorder="asc" style="cursor: pointer;">编号<span class="sort"></span></th>
        <!-- 链接名称 -->
        <th class="w200" data-sortname="links_name" data-sortorder="asc" style="cursor: pointer;">友情链接名称<span class="sort"></span></th>
        <!-- 链接地址 -->
        <th class="w400" data-sortname="" style="cursor: default;">友情链接地址</th>
        <!-- 是否显示 -->
        <th class="text-c w100" data-sortname="" style="cursor: default;">是否显示</th>
        <!-- 排序 -->
        <th class="text-c w80" data-sortname="links_sort" data-sortorder="asc" style="cursor: pointer;">排序<span class="sort"></span></th>
        <!-- 操作-->
        <th class="handle w150" style="cursor: default;">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
    <tr>
        <!--<td class="tcheck">
            <input type="checkbox" class="checkBox" />
        </td>-->
        <td class="text-c">{{ $v->links_id }}</td>
        <td>{{ $v->links_name }}</td>
        <td>
            <a class="w400 intercept" href="{{ $v->links_url }}" target="_blank" title="{{ $v->links_url }}">{{ $v->links_url }}</a>
        </td>
        <td class="text-c">
            @if($v->is_show == 1)
                <span data-action="set-is-show?id={{ $v->links_id }}" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>是</span>
            @else
                <span data-action="set-is-show?id={{ $v->links_id }}" class="ico-switch" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-off"></i>否</span>
            @endif
        </td>
        <td class="text-c">
            <font class="f14">
                <a href="javascript:void(0);" class="links-sort editable editable-click" data-id="{{ $v->links_id }}">{{ $v->links_sort }}</a>
            </font>
        </td>


        <td class="handle">
            <a href="edit?id={{ $v->links_id }}">编辑</a>
            <span>|</span>
            <a href="javascript:void(0);" object_id="{{ $v->links_id }}" class="del border-none">删除</a>
        </td>
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td colspan="6">
            <div class="pull-right page-box">


                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>

<script type="text/javascript">
    $().ready(function() {
        $(".links-sort").editable({
            type: "text",
            url: 'edit-links-info',
            pk: 1,
            //title: "排序",
            ajaxOptions: {
                type: "post"
            },
            params: function(params) {
                params.id = $(this).data("id");
                params.title = 'links_sort';
                return params;
            },
            validate: function(value) {
                value = $.trim(value);
                var ex = /^\d+$/;
                if (!value) {
                    return '排序不能为空。';
                } else if (!ex.test(value)) {
                    return '排序必须是0~255的正整数。';
                } else if (value > 255) {
                    return '排序必须是0~255的正整数。';
                }
            },
            success: function(response, newValue) {
                var response = eval('(' + response + ')');
                if (response.code == -1) {
                    return response.message;
                }
                $("#table_list").tablelist().load(); // 重新加载页面
            }
        });
    });
</script>
