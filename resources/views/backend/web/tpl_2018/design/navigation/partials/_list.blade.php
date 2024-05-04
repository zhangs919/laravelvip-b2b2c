<div class="table-responsive">

    <table id="table_list" class="table table-hover">
        <thead>
        <tr>
            <th class="tcheck">
                <input type="checkbox" class="checkBox allCheckBox table-list-checkbox-all" title="全选/全不选">
            </th>
            <!-- 编号 -->
            <th class="text-c w80" data-sortname="nav_id" data-sortorder="asc" style="cursor: pointer;">编号<span class="sort"></span></th>
            <!-- 导航名称 -->
            <th class="w100" data-sortname="nav_name" data-sortorder="asc" style="cursor: pointer;">导航名称<span class="sort"></span></th>



            <!-- 显示位置 -->
            <th class="w100" data-sortname="nav_position" data-sortorder="asc" style="cursor: pointer;">显示位置<span class="sort"></span></th>

            <!-- 连接类型 -->
            <th class="w100" data-sortname="nav_type" data-sortorder="asc" style="cursor: pointer;">导航类型<span class="sort"></span></th>
            <th class="w150" style="cursor: default;">导航链接</th>
            <!-- 是否显示 -->
            <th class="text-c w100" data-sortname="is_show" data-sortorder="asc" style="cursor: pointer;">是否显示<span class="sort"></span></th>

            <!-- 新窗口打开 -->
            <th class="text-c w110" data-sortname="new_open" data-sortorder="asc" style="cursor: pointer;">新窗口打开<span class="sort"></span></th>

            <!-- 排序 -->
            <th class="text-c w80" data-sortname="nav_sort" data-sortorder="asc" style="cursor: pointer;">排序<span class="sort"></span></th>
            <!-- 操作-->
            <th class="handle w110" style="cursor: default;">操作</th>
        </tr>
        </thead>
        <tbody>

        @foreach($list as $v)
        <tr>
            <td class="tcheck">
                <input type="checkbox" class="checkBox table-list-checkbox" value="{{ $v->id }}">
            </td>
            <td class="text-c">{{ $v->id }}</td>
            <td>
                {{ $v->nav_name }}
                @if(!empty($v->nav_icon))
                <a href="javascript:void(0);" ref="{{ get_image_url($v->nav_icon) }}" class="preview">
                    <i class="fa fa-picture-o"></i>
                </a>
                @endif
            </td>
            <td>{{ nav_position($v->nav_position) }}-{{ nav_layout($v->nav_layout) }}</td>
            <td>{{ link_type($v->nav_type) }}</td>
            <td>{{ $v->nav_link }}</td>
            <td class="text-c">
                @if($v->is_show == 1)
                    <span data-action="set-is-show?id={{ $v->id }}" class="ico-switch open" data-value="[0,1]" data-label='["\u5426","\u662f"]' data-class='["fa fa-toggle-off","fa fa-toggle-on"]'><i class="fa fa-toggle-on"></i>是</span>
                @else
                    <span data-action="set-is-show?id={{ $v->id }}" class="ico-switch" data-value="[0,1]" data-label='["\u5426","\u662f"]' data-class='["fa fa-toggle-off","fa fa-toggle-on"]'><i class="fa fa-toggle-off"></i>否</span>
                @endif
            </td>
            <td class="text-c">
                @if($v->new_open == 1)
                    <span data-action="set-new-open?id={{ $v->id }}" class="ico-switch open" data-value="[0,1]" data-label='["\u5426","\u662f"]' data-class='["fa fa-toggle-off","fa fa-toggle-on"]'><i class="fa fa-toggle-on"></i>是</span>
                @else
                    <span data-action="set-new-open?id={{ $v->id }}" class="ico-switch" data-value="[0,1]" data-label='["\u5426","\u662f"]' data-class='["fa fa-toggle-off","fa fa-toggle-on"]'><i class="fa fa-toggle-off"></i>否</span>
                @endif
            </td>
            <td class="text-c">
                <font class="f14">
                    <a href="javascript:void(0);" class="nav_sort editable editable-click" data-nav_id="{{ $v->id }}">{{ $v->nav_sort }}</a>
                </font>
            </td>
            <td class="handle">
                <a href="edit?nav_page={{ $v->nav_page }}&amp;id={{ $v->id }}&amp;nav_position={{ $v->nav_position }}&amp;show_all=1">编辑</a>
                <span>|</span>
                <a href="javascript:void(0);" object_id="{{ $v->id }}" class="del border-none">删除</a>
            </td>
        </tr>
        @endforeach

        </tbody>
        <tfoot>
        <tr>
            <td class="text-c w10">
                <input type="checkbox" class="checkBox table-list-checkbox-all" title="全选/全不选">
            </td>
            <td colspan="9">
                <div class="pull-left">
                    <input type="button" id="batch-delete" class="btn btn-danger m-r-2" value="批量删除">
                    <!--当没有选中任何所操作的项，按钮为禁用状态，将按钮样式btn-danger替换为disabled-->
                </div>
                <div class="pull-right page-box">


                    {!! $pageHtml !!}
                </div>
            </td>
        </tr>
        </tfoot>
    </table>

</div>