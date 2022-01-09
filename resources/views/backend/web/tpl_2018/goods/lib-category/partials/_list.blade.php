<div id="table_list" class="table-responsive">


    <table class="table table-hover treeTable">
        <thead>
        <tr>
            <th class="w400">
                <a href="javascript:void(0);" class="expand-toggle category-all" onclick="expandAll(this)">全部展开/收起</a>
                分类名称
            </th>
            <th class="text-c w150">是否显示</th>
            <th class="text-c w150">排序</th>
            <th class="handle w200" style="cursor: default;">操作</th>
        </tr>
        </thead>
        <tbody>

        @foreach($list as $v)
            <tr class="1" data-id="{{ $v['cat_id'] }}" data-parent-id="{{ $v['parent_id'] }}">
            <td>

                <img src="/assets/d2eace91/images/common/menu_plus.gif" style="margin-left:2.5em;" class="icon-image" width="11" height="11" border="0" onclick="change(this)">
                <a href="javascript:void(0);">{{ $v['cat_name'] }}</a>
            </td>

            <td class="text-c">
                @if($v['is_show'] == 1)
                    <span data-action="set-is-show?id={{ $v['cat_id'] }}" refresh="1" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>是</span>
                @else
                    <span data-action="set-is-show?id={{ $v['cat_id'] }}" refresh="1" class="ico-switch" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-off"></i>否</span>
                @endif
            </td>

            <td class="text-c">
                <font class="f14">
                    <a href="javascript:void(0);" class="cat_sort editable editable-click" data-cat_id="{{ $v['cat_id'] }}">{{ $v['cat_sort'] }}</a>
                </font>
            </td>
            <td class="handle">
                <a href="edit?id={{ $v['cat_id'] }}">编辑</a>

                <span>|</span>
                <a href="add?parent_id={{ $v['cat_id'] }}">新增下级分类</a>

                <span>|</span>
                <a href="javascript:void(0);" object_id="{{ $v['cat_id'] }}" class="del border-none">删除</a>
            </td>
        </tr>
        @endforeach
        @if(!empty($v['_child']))
            @foreach($v['_child'] as $child)
                <tr class="2" data-id="{{ $child['cat_id'] }}" data-parent-id="{{ $child['parent_id'] }}" style="display: none;">
            <td>

                <img src="/assets/d2eace91/images/common/menu_plus.gif" style="margin-left:7.5em;" class="icon-image" width="11" height="11" border="0" onclick="change(this)">
                <a href="javascript:void(0);">{{ $child['cat_name'] }}</a>
            </td>


            <td class="text-c">
                @if($child['is_show'] == 1)
                    <span data-action="set-is-show?id={{ $child['cat_id'] }}" refresh="1" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>是</span>
                @else
                    <span data-action="set-is-show?id={{ $child['cat_id'] }}" refresh="1" class="ico-switch" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-off"></i>否</span>
                @endif
            </td>

            <td class="text-c">
                <font class="f14">
                    <a href="javascript:void(0);" class="cat_sort editable editable-click" data-cat_id="{{ $child['cat_id'] }}">{{ $child['cat_sort'] }}</a>
                </font>
            </td>
            <td class="handle">
                <a href="edit?id={{ $child['cat_id'] }}">编辑</a>

                <span>|</span>
                <a href="javascript:void(0);" object_id="{{ $child['cat_id'] }}" class="del border-none">删除</a>
            </td>
        </tr>
            @endforeach
        @endif

        </tbody>
    </table>

    {{--分页--}}
    {!! $pageHtml !!}

</div>