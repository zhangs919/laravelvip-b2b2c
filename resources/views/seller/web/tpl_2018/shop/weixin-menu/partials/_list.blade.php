<table id="list-table" class="table table-hover">
    <thead>
    <tr>
        <th class="w300">
            <a class="expand-toggle category-all" onclick="expandAll(this)">全部收缩</a>
            菜单名称
        </th>
        <th class="text-c w150">菜单类型</th>
        <th class="w200">菜单值</th>
        <th class="text-c w80">排序</th>
        <th class="handle w200">操作</th>
    </tr>
    </thead>
    <tbody>
    @if(empty($list))
        <tr>
            <td colspan="5" class="no-data">
                <i class="fa fa-exclamation-circle"></i>
                没有符合条件的记录
            </td>
        </tr>
    @else
        @foreach($list as $item)
            <tr class="{{ $item['menu_level'] }}" data-id="{{ $item['id'] }}" data-parent-id="{{ $item['parent_id'] }}">
                <td>
                    <img src="/assets/d2eace91/images/common/menu_minus.gif"  style='margin-left:2.5em;' class="icon-image" width="11" height="11" border="0" onclick="change(this)" />
                    <a class="f13" href="javascript:;">{{ $item['menu_name'] }}</a>
                </td>
                <td class="text-c">{{ str_replace([0,1,2,3],['命令','链接','自定义图文','关联小程序'],$item['menu_type']) }}</td>
                <td>
                    {{ str_replace(['','info','wdzh','ddcx','kefu'],['不绑定','个人信息','我的账户','订单查询','微信客服'], $item['menu_command']) }}
                </td>
                <td class="text-c">
                    <a href="javascript:void(0);" class="shop_sort f14" data-act_id={{ $item['id'] }}>{{ $item['menu_sort'] }}</a>
                </td>
                <td class="handle">
                    <a href="edit?id={{ $item['id'] }}">编辑</a>
                    <span>|</span>
                    <a href="add?parent_id={{ $item['id'] }}">新增下级菜单</a>
                    <span>|</span>
                    <a href="javascript:void(0);" data-id="{{ $item['id'] }}" class="del border-none">删除</a>
                </td>
            </tr>
            @if(!empty($item['_child']))
                @foreach($item['_child'] as $child)
                    <tr class="{{ $child['menu_level'] }}" data-id="{{ $child['id'] }}" data-parent-id="{{ $child['parent_id'] }}">
                        <td>
                            <img src="/assets/d2eace91/images/common/menu_minus.gif"  style='margin-left:7.5em;' class="icon-image" width="11" height="11" border="0" onclick="change(this)" />
                            <a class="f13" href="javascript:;">{{ $child['menu_name'] }}</a>
                        </td>
                        <td class="text-c">{{ str_replace([0,1,2,3],['命令','链接','自定义图文','关联小程序'],$child['menu_type']) }}</td>
                        <td>
                            {{ str_replace(['','info','wdzh','ddcx','kefu'],['不绑定','个人信息','我的账户','订单查询','微信客服'], $child['menu_command']) }}
                        </td>
                        <td class="text-c">
                            <a href="javascript:void(0);" class="shop_sort f14" data-act_id={{ $child['id'] }}>{{ $child['menu_sort'] }}</a>
                        </td>
                        <td class="handle">
                            <a href="edit?id={{ $child['id'] }}">编辑</a>
                            <span>|</span>
                            <a href="javascript:void(0);" data-id="{{ $child['id'] }}" class="del border-none">删除</a>
                        </td>
                    </tr>
                @endforeach
            @endif
        @endforeach
    @endif


    </tbody>
    <tfoot>
    <tr>
        <td colspan="5">
            <div class="pull-left">
                <input type="button" id="btn_sync_to_weixin" class="btn btn-default m-r-2" value="同步到微信" />
            </div>
            <div class="pull-right page-box"></div>
        </td>
    </tr>
    </tfoot>
</table>
