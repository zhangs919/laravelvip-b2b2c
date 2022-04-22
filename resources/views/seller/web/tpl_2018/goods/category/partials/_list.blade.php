<div id="table_list" class="table-responsive">

    <div class="common-title">
        <div class="ftitle">
            <h3>商品分类列表</h3>

            <h5>
                (&nbsp;共
                <span data-total-record=true></span>
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
            <th class="w350">
                <a href="javascript:void(0);" class="expand-toggle category-all" onclick="expandAll(this)">全部展开/收起</a>
                分类名称
            </th>
            <th class="w120 text-c">商品数量</th>
            <th class="w100 text-c">排序</th>
            <th class="w120 text-c">是否显示</th>
            <th class="handle w300">操作</th>
        </tr>
        </thead>
        <tbody>

        @foreach($list as $v)
        <tr id="cat_{{ $v['cat_id'] }}" data-tt-id="{{ $v['cat_id'] }}" data-tt-parent-id="{{ $v['parent_id'] }}" class="1" data-id="{{ $v['cat_id'] }}" data-parent-id="{{ $v['parent_id'] }}">
            <td>
                <a href="http://www.b2b2c.yunmall.laravelvip.com/shop-list-{{ $v['shop_id'] }}-{{ $v['cat_id'] }}.html" target="_blank" title="点击进入前台店铺查看分类【{{ $v['cat_name'] }}】" class="cat_name">{{ $v['cat_name'] }}</a>
            </td>

            <td class="text-c">
                <a class="f14" href="/goods/list/index?scid={{ $v['cat_id'] }}" target="_blank" title="点击查看商品列表">1</a>
            </td>

            <td class="text-c">
                <a href="javascript:void(0);" class="cat_sort f14" data-id={{ $v['cat_id'] }}>{{ $v['cat_sort'] }}</a>
            </td>
            <td class="text-c">
                @if($v['is_show'] == 1)
                    <span data-action="set-is-show?id={{ $v['cat_id'] }}" data-callback="switch_callback" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>是</span>
                @else
                    <span data-action="set-is-show?id={{ $v['cat_id'] }}" data-callback="switch_callback" class="ico-switch" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-off"></i>否</span>
                @endif
            </td>
            <td class="handle">
                <a href="edit?id={{ $v['cat_id'] }}">编辑</a>

                <span>|</span>
                <a href="add?parent_id={{ $v['cat_id'] }}">新增下级分类</a>

                <span>|</span>
                <a href="javascript:void(0);" object_id="{{ $v['cat_id'] }}" class="del border-none">删除</a>
            </td>
        </tr>
        @if(!empty($v['_child']))
            @foreach($v['_child'] as $child)
                <tr id="cat_{{ $child['cat_id'] }}" data-tt-id="{{ $child['cat_id'] }}" data-tt-parent-id="{{ $child['parent_id'] }}" class="2" data-id="{{ $child['cat_id'] }}" data-parent-id="{{ $child['parent_id'] }}">
                    <td>
                        <a href="http://www.b2b2c.yunmall.laravelvip.com/shop-list-1-{{ $child['cat_id'] }}.html" target="_blank" title="点击进入前台店铺查看分类【{{ $child['cat_name'] }}】" class="cat_name">{{ $child['cat_name'] }}</a>
                    </td>

                    <td class="text-c">
                        <a href="javascript:;" class="disabled f14">0</a>
                    </td>

                    <td class="text-c">
                        <a href="javascript:void(0);" class="cat_sort f14" data-id={{ $child['cat_id'] }}>{{ $child['cat_sort'] }}</a>
                    </td>
                    <td class="text-c">
                        @if($child['is_show'] == 1)
                            <span data-action="set-is-show?id={{ $child['cat_id'] }}" data-callback="switch_callback" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>是</span>
                        @else
                            <span data-action="set-is-show?id={{ $child['cat_id'] }}" data-callback="switch_callback" class="ico-switch" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-off"></i>否</span>
                        @endif
                    </td>
                    <td class="handle">
                        <a href="edit?id={{ $child['cat_id'] }}">编辑</a>

                        <span>|</span>
                        <a href="javascript:void(0);" object_id="{{ $child['cat_id'] }}" class="del border-none">删除</a>
                    </td>
                </tr>
            @endforeach
        @endif
        @endforeach

        </tbody>
    </table>

    {{--分页--}}
    {!! $pageHtml !!}

</div>