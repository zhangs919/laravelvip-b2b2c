<table id="list-table" class="table table-hover">
    <thead>
    <tr>
        <th>
            <a class="expand-toggle category-all" onclick="expandAll(this)">全部展开</a>
            分类名称
        </th>
        <th class="text-c">店铺数量</th>
        <th class="text-c">分类图标</th>
        <th class="text-c">排序</th>
        <th class="text-c" style="cursor: default;">是否热门</th>
        <th class="text-c" style="cursor: default;">是否显示</th>
        <th class="handle" style="cursor: default;">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
    <tr class="1" id="1_{{ $v['cls_id'] }}">
        <td>
            <img src="/assets/d2eace91/images/common/menu_plus.gif" id="icon_1_{{ $v['cls_id'] }}" width="11" height="11" border="0" style="margin-left:2.5em" onclick="rowClicked(this)">

            <a href="javascript:void(0);">{{ $v['cls_name'] }}</a>
        </td>
        <td class="text-c">
            <font class="f14">{{ $v['shop_count'] }}</font>
        </td>
        <td class="text-c">
            @if($v['cls_image'] != '')
                <a href="javascript:void(0);" ref="{{ get_image_url($v['cls_image']) }}" class="preview">
                    <i class="fa fa-picture-o"></i>
                </a>
                <span class="btn btn-success btn-xs pos-r upload-img" data-url="upload-cls_image" data-id="{{ $v['cls_id'] }}"> 更换 </span>
            @else
                <a href="javascript:void(0);" ref="/backend/images/default/goods.gif" class="preview">
                    <i class="fa fa-picture-o"></i>
                </a>
                <span class="btn btn-primary btn-xs pos-r upload-img" data-url="upload-cls_image" data-id="{{ $v['cls_id'] }}"> 添加 </span>
            @endif
        </td>
        <td class="text-c">
            <font class="f14">
                <a href="javascript:void(0);" class="cls_sort editable editable-click" data-cls_id="{{ $v['cls_id'] }}">{{ $v['cls_sort'] }}</a>
            </font>
        </td>
        <td class="text-c">
            @if($v['is_hot'] == 1)
                <span data-action="set-is-hot?id={{ $v['cls_id'] }}" refresh="1" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>是</span>
            @else
                <span data-action="set-is-hot?id={{ $v['cls_id'] }}" refresh="1" class="ico-switch" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-off"></i>否</span>
            @endif
        </td>

        <td class="text-c">
            @if($v['is_show'] == 1)
                <span data-action="set-is-show?id={{ $v['cls_id'] }}" refresh="1" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>是</span>
            @else
                <span data-action="set-is-show?id={{ $v['cls_id'] }}" refresh="1" class="ico-switch" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-off"></i>否</span>
            @endif
        </td>

        <td class="handle">
            <a href="edit?id={{ $v['cls_id'] }}">编辑</a>

            @if(!$v['parent_id'])
            <span>|</span>
            <a href="add?parent_id={{ $v['cls_id'] }}">添加下级分类</a>
            @endif

            <span>|</span>
            <a href="javascript:void(0);" data-cls-id="{{ $v['cls_id'] }}" data-cls-name="{{ $v['cls_name'] }}" class="del border-none">删除</a>
        </td>
    </tr>

        @if(!empty($v['_child']))
            @foreach($v['_child'] as $child)
                <tr class="2" id="2_{{ $child['cls_id'] }}" style="display: none;">
                    <td>
                        <img src="/assets/d2eace91/images/common/menu_plus.gif" id="icon_2_{{ $child['cls_id'] }}" width="11" height="11" border="0" style="margin-left:7.5em" onclick="rowClicked(this)">

                        <a href="javascript:void(0);">{{ $child['cls_name'] }}</a>
                    </td>
                    <td class="text-c">
                        <font class="f14">{{ $child['shop_count'] }}</font>
                    </td>
                    <td class="text-c">
                        @if($child['cls_image'] != '')
                            <a href="javascript:void(0);" ref="{{ get_image_url($child['cls_image']) }}" class="preview">
                                <i class="fa fa-picture-o"></i>
                            </a>
                            <span class="btn btn-success btn-xs pos-r upload-img" data-url="upload-cls_image" data-id="{{ $child['cls_id'] }}"> 更换 </span>
                        @else
                            <a href="javascript:void(0);" ref="/backend/images/default/goods.gif" class="preview">
                                <i class="fa fa-picture-o"></i>
                            </a>
                            <span class="btn btn-primary btn-xs pos-r upload-img" data-url="upload-cls_image" data-id="{{ $child['cls_id'] }}"> 添加 </span>
                        @endif
                    </td>
                    <td class="text-c">
                        <font class="f14">
                            <a href="javascript:void(0);" class="cls_sort editable editable-click" data-cls_id="{{ $child['cls_id'] }}">{{ $child['cls_sort'] }}</a>
                        </font>
                    </td>
                    <td class="text-c">
                        @if($child['is_hot'] == 1)
                            <span data-action="set-is-hot?id={{ $child['cls_id'] }}" refresh="1" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>是</span>
                        @else
                            <span data-action="set-is-hot?id={{ $child['cls_id'] }}" refresh="1" class="ico-switch" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-off"></i>否</span>
                        @endif
                    </td>

                    <td class="text-c">
                        @if($child['is_show'] == 1)
                            <span data-action="set-is-show?id={{ $child['cls_id'] }}" refresh="1" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>是</span>
                        @else
                            <span data-action="set-is-show?id={{ $child['cls_id'] }}" refresh="1" class="ico-switch" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-off"></i>否</span>
                        @endif
                    </td>

                    <td class="handle">
                        <a href="edit?id={{ $child['cls_id'] }}">编辑</a>

                        <span>|</span>
                        <a href="javascript:void(0);" data-cls-id="{{ $child['cls_id'] }}" data-cls-name="{{ $child['cls_name'] }}" class="del border-none">删除</a>
                    </td>
                </tr>
            @endforeach
        @endif
    @endforeach

    </tbody>
</table>

<div id="pagination">

    {!! $pageHtml !!}

</div>