<div id="table_list" class="table-responsive" style="overflow: visible;">
    <table id="list-table" class="table table-hover treetable">
        <thead>
        <tr>
            <th class="w350" style="cursor: default;">
                <a class="expand-toggle category-all" onclick="expandAll(this)">全部展开/收起</a>
                分类名称
                <i class="fa fa-question-circle m-l-5" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="商城中分类下的商品数量会因为扩展分类的原因与当前列表中的商品数量不一致" data-original-title="" title="" style="vertical-align: initial; color: #FF9F24;"></i>
            </th>
            <th class="w100" style="cursor: default;">
                商品数量
                <i class="fa fa-question-circle m-l-5" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="商品数量统计时不包含扩展分类下绑定的商品" data-original-title="" title="" style="vertical-align: initial; color: #FF9F24;"></i>
            </th>
            <th class="w80" style="cursor: default;">展示方式</th>
            <th class="w100" style="cursor: default;">分类图标</th>
            <th class="text-c w60">排序</th>
            <th class="text-c w100" style="cursor: default;">是否显示</th>
            <th class="text-c w100">佣金比例</th>
            <th class="handle w300">操作</th>
        </tr>
        </thead>
        <tbody>

        @foreach($list as $v)
        <tr id="cat_{{ $v['cat_id'] }}" data-tt-id="{{ $v['cat_id'] }}" data-tt-parent-id="{{ $v['parent_id'] }}" class="1 @if(!empty($v['_child']))branch @else leaf @endif" data-id="{{ $v['cat_id'] }}" data-parent-id="{{ $v['parent_id'] }}">
            <td>
                <a href="{{ route('pc_goods_list', ['cat_id' => $v['cat_id']]) }}" target="_blank" title="点击进入商城前台查看分类【{{ $v['cat_name'] }}】"> {{ $v['cat_name'] }} </a>
            </td>
            <td class="handle text-l">
                <font class="f14">
                    @if($v['goods_count'] > 0)
                    <a href="/goods/default/list?cat_id={{ $v['cat_id'] }}" title="点击查看商品列表">{{ $v['goods_count'] }}</a>
                    @else
                        <a class="disabled">0</a>
                    @endif
                </font>
            </td>
            <td>

                @if($v['show_mode'] == 0)
                默认主图
                @else
                规格相册
                @endif

            </td>
            <td class="text-c">
                <a href="javascript:void(0);" ref="@if(!empty($v['cat_image'])) {{ get_image_url($v['cat_image']) }} @else /images/default/goods.gif @endif" class="preview">
                    <i class="fa fa-picture-o"></i>
                </a>

                <span class="btn btn-success btn-xs pos-r upload-img" data-url="upload-cat_image" data-id="{{ $v['cat_id'] }}"> 更换 </span>

            </td>
            <td class="text-c">
                <font class="f14">
                    <a href="javascript:void(0);" class="cat_sort editable editable-click" data-cat_id="{{ $v['cat_id'] }}">{{ $v['cat_sort'] }}</a>
                </font>
            </td>
            <td class="text-c">
                @if($v['is_show'] == 1)
                    <span data-action="set-is-show?id={{ $v['cat_id'] }}" data-callback="switch_callback" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>是</span>
                @else
                    <span data-action="set-is-show?id={{ $v['cat_id'] }}" data-callback="switch_callback" class="ico-switch" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-off"></i>否</span>
                @endif
            </td>
            <td class="text-c">
                <font class="f14">
                    <a href="javascript:void(0);" class="take_rate editable editable-click" data-cat_id="{{ $v['cat_id'] }}">{{ $v['take_rate'] }}%</a>
                </font>
            </td>
            <td class="handle">
                <a href="edit?id={{ $v['cat_id'] }}" target="_blank" title="编辑分类【{{ $v['cat_name'] }}】的基本信息">编辑</a>
                <span>|</span>
                <a href="edit-brand?id={{ $v['cat_id'] }}" target="_blank" title="为分类【{{ $v['cat_name'] }}】的关联品牌">关联品牌</a>

                @if($v['is_parent'] == 1)
                <span>|</span>
                <a href="add?parent_id={{ $v['cat_id'] }}">新增下级分类</a>
                @endif

                <span>|</span>
                <a href="javascript:void(0);" data-object-id="{{ $v['cat_id'] }}" class="del border-none" data-cat-name="{{ $v['cat_name'] }}" data-goods-count="{{ $v['goods_count'] }}">删除</a>
            </td>
        </tr>

        @if(!empty($v['_child']))
            @foreach($v['_child'] as $child)
                <tr id="cat_{{ $child['cat_id'] }}" data-tt-id="{{ $child['cat_id'] }}" data-tt-parent-id="{{ $child['parent_id'] }}" class="2 @if(!empty($child['_child']))branch @else leaf @endif" data-id="{{ $child['cat_id'] }}" data-parent-id="{{ $child['parent_id'] }}" style="display: none;">
                    <td>
                        <a href="{{ route('pc_goods_list', ['cat_id' => $child['cat_id']]) }}" target="_blank" title="点击进入商城前台查看分类【{{ $child['cat_name'] }}】"> {{ $child['cat_name'] }} </a>
                    </td>
                    <td class="handle text-l">
                        <font class="f14">
                            @if($v['goods_count'] > 0)
                                <a href="/goods/default/list?cat_id={{ $child['cat_id'] }}" title="点击查看商品列表">{{ $child['goods_count'] }}</a>
                            @else
                                <a class="disabled">0</a>
                            @endif
                        </font>
                    </td>
                    <td>

                        --

                    </td>
                    <td class="text-c">
                        <a href="javascript:void(0);" ref="@if(!empty($child['cat_image'])) {{ get_image_url($child['cat_image']) }} @else /images/default/goods.gif @endif" class="preview">
                            <i class="fa fa-picture-o"></i>
                        </a>

                        <span class="btn btn-primary btn-xs pos-r upload-img" data-url="upload-cat_image" data-id="{{ $child['cat_id'] }}"> 添加 </span>

                    </td>
                    <td class="text-c">
                        <font class="f14">
                            <a href="javascript:void(0);" class="cat_sort editable editable-click" data-cat_id="{{ $child['cat_id'] }}">{{ $child['cat_sort'] }}</a>
                        </font>
                    </td>

                    <td class="text-c">
                        @if($child['is_show'] == 1)
                            <span data-action="set-is-show?id={{ $child['cat_id'] }}" data-callback="switch_callback" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>是</span>
                        @else
                            <span data-action="set-is-show?id={{ $child['cat_id'] }}" data-callback="switch_callback" class="ico-switch" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-off"></i>否</span>
                        @endif
                    </td>
                    <td class="text-c">
                        <font class="f14">
                            <a href="javascript:void(0);" class="take_rate editable editable-click" data-cat_id="{{ $child['cat_id'] }}">{{ $child['take_rate'] }}%</a>
                        </font>
                    </td>
                    <td class="handle">
                        <a href="edit?id={{ $child['cat_id'] }}" target="_blank" title="编辑分类【{{ $child['cat_name'] }}】的基本信息">编辑</a>
                        <span>|</span>
                        <a href="edit-brand?id={{ $child['cat_id'] }}" target="_blank" title="为分类【{{ $child['cat_name'] }}】的关联品牌">关联品牌</a>

                        <span>|</span>
                        <a href="javascript:void(0);" cat_level="2" cat_id="{{ $child['cat_id'] }}" class="move-cat">转移分类</a>

                        @if($child['is_parent'] == 1)
                        <span>|</span>
                        <a href="add?parent_id={{ $child['cat_id'] }}">新增下级分类</a>
                        @endif

                        <span>|</span>
                        <a href="javascript:void(0);" data-object-id="{{ $child['cat_id'] }}" class="del border-none" data-cat-name="{{ $child['cat_name'] }}" data-goods-count="{{ $child['goods_count'] }}">删除</a>
                    </td>
                </tr>
                @if(!empty($child['_child']))
                    @foreach($child['_child'] as $child2)
                        <tr id="cat_{{ $child2['cat_id'] }}" data-tt-id="{{ $child2['cat_id'] }}" data-tt-parent-id="{{ $child2['parent_id'] }}" class="2 @if(!empty($child2['_child']))branch @else leaf @endif" data-id="{{ $child2['cat_id'] }}" data-parent-id="{{ $child2['parent_id'] }}" style="display: none;">
                            <td>
                                {{--<span class="indenter" style="padding-left: 38px;">
                                    @if($child2['is_parent'] == 1 && !empty($child2['_child']))
                                        <a href="#" title="展开">&nbsp;</a>
                                    @endif
                                </span>--}}
                                <a href="http://www.laravelvip.com/list-{{ $child2['cat_id'] }}.html" target="_blank" title="点击进入商城前台查看分类【{{ $child2['cat_name'] }}】"> {{ $child2['cat_name'] }} </a>
                            </td>
                            <td class="handle text-l">
                                <font class="f14">

                                    @if($v['goods_count'] > 0)
                                        <a href="/goods/default/list?cat_id={{ $child2['cat_id'] }}" title="点击查看商品列表">{{ $child2['goods_count'] }}</a>
                                    @else
                                        <a class="disabled">0</a>
                                    @endif

                                </font>
                            </td>
                            <td>

                                --

                            </td>
                            <td class="text-c">
                                <a href="javascript:void(0);" ref="@if(!empty($child2['cat_image'])) {{ get_image_url($child2['cat_image']) }} @else /images/default/goods.gif @endif" class="preview">
                                    <i class="fa fa-picture-o"></i>
                                </a>

                                <span class="btn btn-primary btn-xs pos-r upload-img" data-url="upload-cat_image" data-id="{{ $child2['cat_id'] }}"> 添加 </span>

                            </td>
                            <td class="text-c">
                                <font class="f14">
                                    <a href="javascript:void(0);" class="cat_sort editable editable-click" data-cat_id="{{ $child2['cat_id'] }}">{{ $child2['cat_sort'] }}</a>
                                </font>
                            </td>

                            <td class="text-c">
                                @if($child2['is_show'] == 1)
                                    <span data-action="set-is-show?id={{ $child2['cat_id'] }}" data-callback="switch_callback" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>是</span>
                                @else
                                    <span data-action="set-is-show?id={{ $child2['cat_id'] }}" data-callback="switch_callback" class="ico-switch" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-off"></i>否</span>
                                @endif
                            </td>
                            <td class="text-c">
                                <font class="f14">
                                    <a href="javascript:void(0);" class="take_rate editable editable-click" data-cat_id="{{ $child2['cat_id'] }}">{{ $child2['take_rate'] }}%</a>
                                </font>
                            </td>
                            <td class="handle">
                                <a href="edit?id={{ $child2['cat_id'] }}" target="_blank" title="编辑分类【{{ $child2['cat_name'] }}】的基本信息">编辑</a>
                                <span>|</span>
                                <a href="edit-brand?id={{ $child2['cat_id'] }}" target="_blank" title="为分类【{{ $child2['cat_name'] }}】的关联品牌">关联品牌</a>

                                <span>|</span>
                                <a href="javascript:void(0);" cat_level="3" cat_id="{{ $child2['cat_id'] }}" class="move-cat">转移分类</a>

                                @if($child2['is_parent'] == 1)
                                    <span>|</span>
                                    <a href="add?parent_id={{ $child2['cat_id'] }}">新增下级分类</a>
                                @endif

                                <span>|</span>
                                <a href="javascript:void(0);" data-object-id="{{ $child2['cat_id'] }}" class="del border-none" data-cat-name="{{ $child2['cat_name'] }}" data-goods-count="{{ $child2['goods_count'] }}">删除</a>
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