<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck">
            <input type="checkbox" class="checkBox allCheckBox"></input>
        </th>
        <th class="text-c w80" data-sortname="attr_id">编号</th>
        <th class="w250" data-sortname="attr_name">规格名称</th>
        <th class="w250">规格值</th>
        <!--
        <th class="text-c" data-sortname="is_show">是否有效</th>
         -->
        <th class="text-c w100" data-sortname="attr_sort">排序</th>
        <th class="handle w150">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
    <tr>
        <td class="tcheck">
            <input type="checkbox" class="checkBox" value="{{ $v->attr_id }}" />
        </td>
        <td class="text-c">{{ $v->attr_id }}</td>
        <td>{{ $v->attr_name }}</td>
        <td>
            <span title="{{ $v->attr_values }}">{{ $v->attr_values }}</span>
        </td>
        <td class="text-c">
            <font class="f14">
                <a href="javascript:void(0);" class="attr_sort" data-id={{ $v->attr_id }}>{{ $v->attr_sort }}</a>
            </font>
        </td>
        <td class="handle">
            <a href="edit?id={{ $v->attr_id }}">编辑</a>
            <span>|</span>
            <a href="javascript:void(0);" object_id="{{ $v->attr_id }}" class="del border-none">删除</a>
        </td>
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td class="text-c w10">
            <input type="checkbox" class="allCheckBox checkBox" />
            </input>
        </td>
        <td colspan="5">
            <div class="pull-left">
                <input type="button" class="btn btn-danger m-r-2 delete-spec" value="批量删除" />
            </div>
            <div class="pull-right page-box">


                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
