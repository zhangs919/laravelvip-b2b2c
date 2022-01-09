<!-- 列表 -->
<div class="table-responsive">

    <table id="table_list" class="table table-hover">
        <thead>
        <tr>
            <th class="tcheck">
                <input type="checkbox" class="checkBox allCheckBox table-list-checkbox-all" title="全选/全不选">
            </th>
            <!-- 编号 -->
            <th class="text-c w80" data-sortname="auth_id" data-sortorder="asc" style="cursor: pointer;">编号<span class="sort"></span></th>
            <!-- 资质名称 -->
            <th class="w200" data-sortname="auth_name" data-sortorder="asc" style="cursor: pointer;">资质名称<span class="sort"></span></th>
            <!-- 图标 -->
            <th class="w200 text-c">图标</th>
            <!-- 链接地址 -->
            <th class="w300" data-sortname="" style="cursor: pointer;">链接地址</th>
            <!-- 是否显示 -->
            <th class="text-c w100" data-sortname="is_show" data-sortorder="asc" style="cursor: pointer;">是否显示<span class="sort"></span></th>
            <!-- 排序 -->
            <th class="text-c w80" data-sortname="auth_sort" data-sortorder="asc" style="cursor: pointer;">排序<span class="sort"></span></th>
            <!-- 操作-->
            <th class="handle w150">操作</th>
        </tr>
        </thead>
        <tbody>

        @foreach($list as $v)
        <tr>
            <td class="tcheck">
                <input type="checkbox" class="checkbox table-list-checkbox" value="{{ $v->auth_id }}">
            </td>
            <td class="text-c">{{ $v->auth_id }}</td>
            <td>{{ $v->auth_name }}</td>
            <td class="text-c">
                <img src="{{ get_image_url($v->auth_image) }}" class="icon-images" style="width: 112px; height: 40px;">
            </td>
            <td>
                <a href="{{ $v->links_url }}" target="_blank">{{ $v->links_url }}</a>
            </td>
            <td class="text-c">
                @if($v->is_show == 1)
                    <span data-action="set-is-show?id={{ $v->auth_id }}" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>是</span>
                @else
                    <span data-action="set-is-show?id={{ $v->auth_id }}" class="ico-switch" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-off"></i>否</span>
                @endif
            </td>
            <td class="text-c">
                <font class="f14">
                    <a href="javascript:void(0);" class="auth-sort editable editable-click" data-id="{{ $v->auth_id }}">{{ $v->auth_sort }}</a>
                </font>
            </td>
            <td class="handle">
                <a href="edit?id={{ $v->auth_id }}">编辑</a>
                <span>|</span>
                <a href="javascript:void(0);" data-id="{{ $v->auth_id }}" class="del border-none">删除</a>
            </td>
        </tr>
        @endforeach

        </tbody>
        <tfoot>
        <tr>
            <td class="text-c w10">
                <input type="checkbox" class="checkBox table-list-checkbox-all" title="全选/全不选">
            </td>
            <td colspan="7">
                <div class="pull-left">
                    <input type="button" class="btn btn-danger m-r-2 del" value="批量删除">
                </div>
                <div class="pull-right page-box">


                    {!! $pageHtml !!}
                </div>
            </td>
        </tr>
        </tfoot>
    </table>

</div>