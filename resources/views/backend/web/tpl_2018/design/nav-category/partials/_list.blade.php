<div class="table-responsive">

    <table id="table_list" class="table table-hover">
        <thead>
        <tr>
            <!--<th class="tcheck w10">
                <input type="checkbox" class="checkBox allCheckBox" />
            </th>-->
            <!-- 编号 -->
            <th class="text-c w100" data-sortname="id">编号</th>
            <!-- 导航名称 -->
            <th class="w300" data-sortname="name">导航分类名称</th>
            <th class="text-c w150">导航分类图标</th>
            <!-- 显示位置 -->
            <th class="text-c w200" data-sortname="is_show">是否显示</th>
            <!-- 连接类型 -->
            <th class="text-c w100" data-sortname="sort">排序</th>
            <!-- 操作-->
            <th class="handle w200">操作</th>
        </tr>
        </thead>
        <tbody>

        @foreach($list as $v)
        <tr>
            <!--<td class="tcheck">
                <input type="checkbox" class="checkBox" />
            </td>-->
            <td class="text-c">{{ $v->id }}</td>
            <td>{{ $v->name }}</td>
            <td class="text-c">
                <i class="iconfont">{!! $v->nav_icon !!}</i>
            </td>
            <td class="text-c">
                @if($v->is_show == 1)
                    <span data-action="set-is-show?id={{ $v->id }}" class="ico-switch open" data-value="[0,1]" data-label='["\u5426","\u662f"]' data-class='["fa fa-toggle-off","fa fa-toggle-on"]'><i class="fa fa-toggle-on"></i>是</span>
                @else
                    <span data-action="set-is-show?id={{ $v->id }}" class="ico-switch" data-value="[0,1]" data-label='["\u5426","\u662f"]' data-class='["fa fa-toggle-off","fa fa-toggle-on"]'><i class="fa fa-toggle-off"></i>否</span>
                @endif
            </td>
            <td class="text-c">
                <font class="f14">
                    <a href="javascript:void(0);" class="category-sort" data-id={{ $v->id }}>{{ $v->sort }}</a>
                </font>
            </td>
            <td class="handle">
                <a href="edit?pid={{ $v->id }}">编辑</a>
                <span>|</span>
                <a href="javascript:void(0);" object_id="{{ $v->id }}" class="del border-none">删除</a>
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

</div>