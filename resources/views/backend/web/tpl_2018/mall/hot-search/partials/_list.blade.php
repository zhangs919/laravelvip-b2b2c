<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck">
            <input type="checkbox" class="checkBox allCheckBox" />
        </th>
        <th class="text-c w70" data-sortname="id">编号</th>
        <th class="w150" data-sortname="keyword">搜索词</th>
        <th class="w250" data-sortname="show_words">显示词</th>
        <th class="text-c w150" data-sortname="is_show">是否热门搜索</th>
        <th class="text-c w100" data-sortname="sort">排序</th>
        <th class="handle w200">操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($list as $v)
    <tr>
        <td class="tcheck">
            <input type="checkbox" class="checkBox" name="xzbox" value="{{ $v->id }}" />
        </td>
        <td class="text-c">{{ $v->id }}</td>
        <td>{{ $v->keyword }}</td>
        <td>{{ $v->show_words }}</td>
        <td class="text-c">
            @if($v->is_show == 1)
                <span data-action="set-is-show?id={{ $v->id }}" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>是</span>
            @else
                <span data-action="set-is-show?id={{ $v->id }}" class="ico-switch" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-off"></i>否</span>
            @endif
        </td>
        <td class="text-c ">
            <font class="f14">
                <a href="javascript:void(0);" class="object_sort" data-id={{ $v->id }}>{{ $v->sort }}</a>
            </font>
        </td>
        <td class="handle">
            <a href="edit?id={{ $v->id }}">编辑</a>
            <span>|</span>
            <a href="javascript:void(0);" data-id="{{ $v->id }}" class="del border-none">删除</a>
        </td>
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td class="text-c w10">
            <input type="checkbox" class="allCheckBox checkBox" />
        </td>
        <td colspan="6">
            <div class="pull-left">
                <input type="button" id="btn_delete" class="btn btn-danger m-r-2" value="批量删除" />
                <!--当没有选中任何所操作的项，按钮为禁用状态，将按钮样式btn-danger替换为disabled-->
            </div>
            <div class="pull-right page-box">

                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
