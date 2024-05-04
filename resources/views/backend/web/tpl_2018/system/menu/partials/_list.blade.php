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
                菜单名称
            </th>
            <th class="w100 text-c">菜单链接</th>
            <th class="w100 text-c">菜单路由</th>
            <th class="w100 text-c">排序</th>
            <th class="w120 text-c">是否显示</th>
            <th class="handle w300">操作</th>
        </tr>
        </thead>
        <tbody>

        @foreach($list as $v)
            <tr id="cat_{{ $v['id'] }}" data-tt-id="{{ $v['id'] }}" data-tt-parent-id="{{ $v['pid'] }}" class="1" data-id="{{ $v['id'] }}" data-parent-id="{{ $v['pid'] }}">
                <td>
                    <a href="javascript:;" title="{{ $v['title'] }}【{{ $v['name'] }}】" class="name">{{ $v['title'] }}【{{ $v['name'] }}】</a>
                </td>
                <td class="text-c">
                    {{ $v['url'] }}
                </td>
                <td class="text-c">
                    {{ $v['route'] }}
                </td>
                <td class="text-c">
                    <a href="javascript:void(0);" class="menu-sort editable editable-click" data-id={{ $v['id'] }}>{{ $v['sort'] }}</a>
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
                    <a href="add?pid={{ $v['id'] }}">新增下级菜单</a>

                    <span>|</span>
                    <a href="javascript:void(0);" object_id="{{ $v['id'] }}" class="del border-none">删除</a>
                </td>
            </tr>
            @if(!empty($v['_child']))
                @foreach($v['_child'] as $child)
                    <tr id="cat_{{ $child['id'] }}" data-tt-id="{{ $child['id'] }}" data-tt-parent-id="{{ $child['pid'] }}" class="2" data-id="{{ $child['id'] }}" data-parent-id="{{ $child['pid'] }}">
                        <td>
                            <a href="javascript:;" title="{{ $child['title'] }}【{{ $child['name'] }}】" class="name">{{ $child['title'] }}【{{ $child['name'] }}】</a>
                        </td>
                        <td class="text-c">
                            {{ $child['url'] }}
                        </td>
                        <td class="text-c">
                            {{ $child['route'] }}
                        </td>
                        <td class="text-c">
                            <a href="javascript:void(0);" class="menu-sort editable editable-click" data-id={{ $child['id'] }}>{{ $child['sort'] }}</a>
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
                            <a href="add?pid={{ $v['id'] }}">新增下级菜单</a>

                            <span>|</span>
                            <a href="javascript:void(0);" object_id="{{ $child['id'] }}" class="del border-none">删除</a>
                        </td>
                    </tr>

                    @if(!empty($child['_child']))
                        @foreach($child['_child'] as $child2)
                            <tr id="cat_{{ $child2['id'] }}" data-tt-id="{{ $child2['id'] }}" data-tt-parent-id="{{ $child2['pid'] }}" class="2 @if(!empty($child2['_child']))branch @else leaf @endif" data-id="{{ $child2['id'] }}" data-parent-id="{{ $child2['pid'] }}">
                                <td>
                                    <a href="javascript:;" title="{{ $child2['title'] }}【{{ $child2['name'] }}】" class="name">{{ $child2['title'] }}【{{ $child2['name'] }}】</a>
                                </td>
                                <td class="text-c">
                                    {{ $child2['url'] }}
                                </td>
                                <td class="text-c">
                                    {{ $child2['route'] }}
                                </td>
                                <td class="text-c">
                                    <a href="javascript:void(0);" class="menu-sort editable editable-click" data-id={{ $child2['id'] }}>{{ $child2['sort'] }}</a>
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