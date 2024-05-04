<div id="table_list" class="table-responsive" style="overflow: visible">
    <table id="list-table" class="table table-hover treetable">
        <thead>
        <tr>
            <th class="w300">
                <a class="expand-toggle category-all" onclick="expandAll(this)">全部收缩</a>
                分类名称
            </th>
            <th class="text-c w100">分类图片</th>
            <th class="w100" style="cursor: default;">展示形式</th>
            <th class="w100" style="cursor: default;">分类类型</th>
            <th class="w100" style="cursor: default;">数据量</th>
            <th class="text-c w80" style="cursor: default;">排序</th>
            <th class="text-c w100" style="cursor: default;">是否显示</th>
            <th class="handle w200" style="cursor: default;">操作</th>
        </tr>
        </thead>
        <tbody>

        @foreach($list as $v)
        <tr id="article_cat_{{ $v['cat_id'] }}" data-tt-id="{{ $v['cat_id'] }}" data-tt-parent-id="{{ $v['parent_id'] }}" class="1 @if(!empty($v['_child']))branch@else leaf @endif collapsed" data-id="{{ $v['cat_id'] }}" data-parent-id="{{ $v['parent_id'] }}">
            <td><span class="indenter" style="padding-left: 0px;"></span>
                <a href="/article/article/list?cat_id={{ $v['cat_id'] }}">{{ $v['cat_name'] }}</a>
            </td>
            <td class="text-c">
                <a href="javascript:void(0);" ref="@if(!empty($v['cat_image'])) {{ get_image_url($v['cat_image']) }} @else {{ get_image_url(sysconf('default_article_cat_image')) }} @endif" class="preview">
                    <i class="fa fa-picture-o"></i>
                </a>
            </td>
            <td>@if($v['cat_model'] == 1)单网页展示@elseif($v['cat_model'] == 2)普通展示@endif</td>
            <td>{{ article_cat_type($v['cat_type']) }}</td>
            <td>
                <font class="f14">
                    <a href="/article/article/list?cat_id={{ $v['cat_id'] }}">{{ $v['article_count'] }}</a>
                </font>
            </td>
            <td class="text-c">
                <font class="f14">
                    <a href="javascript:void(0);" class="cat_sort editable editable-click" data-cat_id="{{ $v['cat_id'] }}">{{ $v['cat_sort'] }}</a>
                </font>
            </td>
            <td class="text-c">
                @if($v['is_show'] == 1)
                    <span data-action="set-is-show?id={{ $v['cat_id'] }}" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>是</span>
                @else
                    <span data-action="set-is-show?id={{ $v['cat_id'] }}" class="ico-switch" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-off"></i>否</span>
                @endif
            </td>
            <td class="handle">

                @if($v['parent_id'] == 0 && $v['article_count'] == 0)
                <a href="add-category?cat_model={{ $v['cat_model'] }}&amp;parent_id={{ $v['cat_id'] }}">添加子分类</a>
                <span>|</span>
                @endif

                <a href="edit-category?cat_model={{ $v['cat_model'] }}&amp;cat_id={{ $v['cat_id'] }}">修改</a>
                <span>|</span>

                <a href="javascript:;" data-cat_id="{{ $v['cat_id'] }}" class="del border-none">删除</a>

            </td>
        </tr>

        @if(!empty($v['_child']))
            @foreach($v['_child'] as $child)
            <tr id="article_cat_{{ $child['cat_id'] }}" data-tt-id="{{ $child['cat_id'] }}" data-tt-parent-id="{{ $child['parent_id'] }}" class="2 leaf" data-id="{{ $child['cat_id'] }}" data-parent-id="{{ $child['parent_id'] }}" style="display: none;">
                <td><span class="indenter"></span>
                    <a href="/article/article/list?cat_id={{ $child['cat_id'] }}">{{ $child['cat_name'] }}</a>
                </td>
                <td class="text-c">
                    <a href="javascript:void(0);" ref="@if(!empty($child['cat_image'])) {{ get_image_url($child['cat_image']) }} @else {{ get_image_url(sysconf('default_article_cat_image')) }} @endif" class="preview">
                        <i class="fa fa-picture-o"></i>
                    </a>
                </td>
                <td>@if($child['cat_model'] == 1)单网页展示@elseif($child['cat_model'] == 2)普通展示@endif</td>
                <td>{{ article_cat_type($child['cat_type']) }}</td>
                <td>
                    <font class="f14">
                        <a href="/article/article/list?cat_id={{ $child['cat_id'] }}">{{ $child['article_count'] }}</a>
                    </font>
                </td>
                <td class="text-c">
                    <font class="f14">
                        <a href="javascript:void(0);" class="cat_sort editable editable-click" data-cat_id="{{ $child['cat_id'] }}">{{ $child['cat_sort'] }}</a>
                    </font>
                </td>
                <td class="text-c"><span data-action="set-is-show?cat_id={{ $child['cat_id'] }}" data-callback="switch_callback" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>是</span></td>
                <td class="handle">



                    <a href="edit-category?cat_model={{ $child['cat_model'] }}&amp;cat_id={{ $child['cat_id'] }}">修改</a>

                    <span>|</span>
                    <a href="javascript:;" data-cat_id="{{ $child['cat_id'] }}" class="del border-none">删除</a>

                </td>
            </tr>
            @endforeach
        @endif

        @endforeach

        </tbody>
    </table>

    {!! $pageHtml !!}

</div>