<div id="table_list" class="table-responsive">

    <div class="common-title">
        <div class="ftitle">
            <h3>{{ $title }}</h3>

            <h5>
                (&nbsp;共
                <span data-total-record="true" class="pagination-total-record"></span>
                条记录&nbsp;)
            </h5>

        </div>
        <div class="operate m-l-20">

            <a class="reload" href="javascript:tablelist.load();" data-toggle="tooltip" data-placement="auto bottom" title="刷新数据">
                <i class="fa fa-refresh"></i>
            </a>



        </div>
    </div>
    <table class="table table-hover treeTable treetable">
        <thead>
        <tr>
            <th class="w250">
                <a href="javascript:void(0);" class="expand-toggle category-all" onclick="expandAll(this)">全部展开/收起</a>
                节点名称
            </th>
            <th class="w100 text-c">排序</th>
            <th class="w120 text-c">是否显示</th>
            <th class="handle w300">操作</th>
        </tr>
        </thead>
        <tbody>

        @foreach($list as $v)
            <tr id="cat_{{ $v['id'] }}" data-tt-id="{{ $v['id'] }}" data-tt-parent-id="{{ $v['parent_node_id'] }}" class="1 @if(!empty($v['_child']))branch @else leaf @endif" data-id="{{ $v['id'] }}" data-parent-id="{{ $v['parent_node_id'] }}">
                <td>
                    <a href="javascript:;" title="{{ $v['node_title'] }}【{{ $v['node_name'] }}】" class="name">{{ $v['node_title'] }}【{{ $v['node_name'] }}】</a>
                </td>
                <td class="text-c">
                    <a href="javascript:void(0);" class="node-sort editable editable-click" data-id={{ $v['id'] }}>{{ $v['sort'] }}</a>
                </td>
                <td class="text-c">
                    @if($v['is_show'] == 1)
                        <span data-action="set-is-show?id={{ $v['id'] }}" data-callback="switch_callback" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>是</span>
                    @else
                        <span data-action="set-is-show?id={{ $v['id'] }}" data-callback="switch_callback" class="ico-switch" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-off"></i>否</span>
                    @endif
                </td>
                <td class="handle">
                    <a href="edit?id={{ $v['id'] }}">编辑</a>

                    <span>|</span>
                    <a href="add?parent_node_id={{ $v['id'] }}">新增下级节点</a>

                    <span>|</span>
                    <a href="javascript:void(0);" object_id="{{ $v['id'] }}" class="del border-none">删除</a>
                </td>
            </tr>
            @if(!empty($v['_child']))
                @foreach($v['_child'] as $child)
                    <tr id="cat_{{ $child['id'] }}" data-tt-id="{{ $child['id'] }}" data-tt-parent-id="{{ $child['parent_node_id'] }}" class="2 @if(!empty($child['_child']))branch @else leaf @endif"
                        data-id="{{ $child['id'] }}" data-parent-id="{{ $child['parent_node_id'] }}">
                        <td>
                            <a href="javascript:;" title="{{ $child['node_title'] }}【{{ $child['node_name'] }}】" class="name">{{ $child['node_title'] }}【{{ $child['node_name'] }}】</a>
                        </td>
                        <td class="text-c">
                            <a href="javascript:void(0);" class="node-sort editable editable-click" data-id={{ $child['id'] }}>{{ $child['sort'] }}</a>
                        </td>
                        <td class="text-c">
                            @if($child['is_show'] == 1)
                                <span data-action="set-is-show?id={{ $child['id'] }}" data-callback="switch_callback" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>是</span>
                            @else
                                <span data-action="set-is-show?id={{ $child['id'] }}" data-callback="switch_callback" class="ico-switch" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-off"></i>否</span>
                            @endif
                        </td>
                        <td class="handle">
                            <a href="edit?id={{ $child['id'] }}">编辑</a>

                            <span>|</span>
                            <a href="add?parent_node_id={{ $child['id'] }}">新增下级节点</a>

                            <span>|</span>
                            <a href="javascript:void(0);" object_id="{{ $child['id'] }}" class="del border-none">删除</a>
                        </td>
                    </tr>

                    @if(!empty($child['_child']))
                        @foreach($child['_child'] as $child2)
                            <tr id="cat_{{ $child2['id'] }}" data-tt-id="{{ $child2['id'] }}" data-tt-parent-id="{{ $child2['parent_node_id'] }}" class="2 @if(!empty($child2['_child']))branch @else leaf @endif" data-id="{{ $child2['id'] }}" data-parent-id="{{ $child2['parent_node_id'] }}">
                                <td>
                                    <a href="javascript:;" title="{{ $child2['node_title'] }}【{{ $child2['node_name'] }}】" class="name">{{ $child2['node_title'] }}【{{ $child2['node_name'] }}】</a>
                                </td>
                                <td class="text-c">
                                    <a href="javascript:void(0);" class="node-sort editable editable-click" data-id={{ $child2['id'] }}>{{ $child2['sort'] }}</a>
                                </td>
                                <td class="text-c">
                                    @if($child2['is_show'] == 1)
                                        <span data-action="set-is-show?id={{ $child2['id'] }}" data-callback="switch_callback" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>是</span>
                                    @else
                                        <span data-action="set-is-show?id={{ $child2['id'] }}" data-callback="switch_callback" class="ico-switch" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-off"></i>否</span>
                                    @endif
                                </td>
                                <td class="handle">
                                    <a href="edit?id={{ $child2['id'] }}">编辑</a>

                                    <span>|</span>
                                    <a href="javascript:void(0);" object_id="{{ $child2['id'] }}" class="del border-none">删除</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                @endforeach
            @endif
        @endforeach

        </tbody>
    </table>

    {{--分页--}}
    {!! $pageHtml !!}

</div>