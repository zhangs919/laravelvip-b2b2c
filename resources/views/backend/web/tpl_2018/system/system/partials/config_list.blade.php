<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck">
            <input type="checkbox" class="checkBox allCheckBox table-list-checkbox-all" title="全选/全不选">
        </th>
        <th class="text-c w60" data-sortname="id" data-sortorder="asc" style="cursor: pointer;">ID<span class="sort"></span></th>
        <th class="w200" style="cursor: default;">配置标题</th>
        <th class="w100" data-sortname="group" data-sortorder="asc" style="cursor: pointer;">配置分组<span class="sort"></span></th>
        <th class="w100" data-sortname="code" data-sortorder="asc" style="cursor: pointer;">配置code<span class="sort"></span></th>
        <th class="text-c w100">是否启用</th>
        <th class="w70 text-c" data-sortname="sort" data-sortorder="asc" style="cursor: pointer;">排序<span class="sort"></span></th>
        {{--<th class="text-c w100" data-sortname="status" data-sortorder="asc" style="cursor: pointer;">状态<span class="sort"></span></th>--}}
        <th class="handle w150" style="cursor: default;">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach( $list as $vo)
    <tr>
        <td class="tcheck">
            <input type="checkbox" class="checkBox table-list-checkbox" value="{{ $vo->id }}">
        </td>
        <td class="text-c">{{ $vo->id }}</td>
        <td>{{ $vo->title }}</td>
        <td>{{ $vo->group }}</td>
        <td>{{ $vo->code }}</td>
        <td class="text-c">
            @if($vo->status == 1)
            <span data-action="set-status?id={{ $vo->id }}" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>是</span>
            @else
            <span data-action="set-status?id={{ $vo->id }}" class="ico-switch" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-off"></i>否</span>
            @endif
        </td>
        <td class="text-c">
            <font class="f14">
                <a href="javascript:void(0);" class="config-sort editable editable-click" data-id="{{ $vo->id }}">{{ $vo->sort }}</a>
            </font>
        </td>
        {{--<td class="text-c">
            @if($vo->status == 1)
            <font class="c-green">启用</font>
            @else
            <font class="c-gray">禁用</font>
            @endif
        </td>--}}
        <td class="handle">
            <a href="edit?id={{ $vo->id }}">编辑</a>
            <span>|</span>
            <a href="javascript:void(0);" data-id="{{ $vo->id }}" class="del border-none">删除</a>
        </td>
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td class="text-c w10">
            <input type="checkbox" class="checkBox table-list-checkbox-all" title="全选/全不选">
        </td>
        <td colspan="11">
            <div class="pull-left">
                <input type="button" id="batch-delete" class="btn btn-danger m-r-2" value="批量删除">
                <!--当没有选中任何所操作的项，按钮为禁用状态，将按钮样式btn-danger替换为disabled-->
            </div>
            <div class="pull-right page-box">

                {{--分页--}}
                {!! $pageHtml !!}

            </div>
        </td>
    </tr>
    </tfoot>
</table>