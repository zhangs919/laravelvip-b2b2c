<div class="table-responsive">

    <table id="table_list" class="table table-hover">
        <thead>
        <tr>
            <th class="tcheck">
                <input type="checkbox" class="checkBox allCheckBox table-list-checkbox-all" title="全选/全不选">
            </th>
            <th class="text-c" data-sortname="attr_id" data-sortorder="asc" style="cursor: pointer;">编号<span class="sort"></span></th>
            <th data-sortname="attr_name" data-sortorder="asc" style="cursor: pointer;">属性名称<span class="sort"></span></th>
            <th data-sortname="type_id" data-sortorder="asc" style="cursor: pointer;">商品类型<span class="sort"></span></th>
            <th>样式</th>
            <th>属性值</th>
            <!--
            <th class="text-c">是否显示</th>
             -->
            <th class="text-c" data-sortname="attr_sort" data-sortorder="asc" style="cursor: pointer;">排序<span class="sort"></span></th>
            <th class="handle" style="cursor: default;">操作</th>
        </tr>
        </thead>
        <tbody>

        @foreach($list as $v)
        <tr>
            <td class="tcheck">
                <input type="checkbox" class="checkBox table-list-checkbox" value="{{ $v->attr_id }}">
            </td>
            <td class="text-c">{{ $v->attr_id }}</td>
            <td>{{ $v->attr_name }}</td>
            <td>{{ $v->type_name }}</td>
            <td>{{ $v->attr_style }}</td>
            <td>
                <span title="{{ $v->attr_values }}">{{ $v->attr_values }}</span>
            </td>
            <!--
            <td class="text-c"><span class="ico-switch open" data-value='[0,1]' data-label='["\u5426","\u662f"]' data-class='["fa fa-toggle-off","fa fa-toggle-on"]'><i class="fa fa-toggle-on"></i>是</span></td>
             -->
            <td class="text-c f14">
                <font class="f14">
                    <a href="javascript:void(0);" class="attr_sort editable editable-click" data-id="{{ $v->attr_id }}">{{ $v->attr_sort }}</a>
                </font>
            </td>
            <td class="handle">
                <a href="edit-base?id={{ $v->attr_id }}&amp;type_id={{ $type_id }}">编辑</a>
                <span>|</span>
                <a href="javascript:void(0);" data-id="{{ $v->attr_id }}" class="del border-none">删除</a>
            </td>
        </tr>
        @endforeach

        </tbody>
        <tfoot>
        <tr>
            <td class="text-c w10">
                <input type="checkbox" class="allCheckBox checkBox" title="全选/全不选">
            </td>
            <td colspan="7">
                <div class="pull-left">
                    <input type="button" class="btn btn-danger m-r-2 del" value="批量删除" />
                </div>
                <div class="pull-right page-box">


                    {!! $pageHtml !!}
                </div>
            </td>
        </tr>
        </tfoot>
    </table>

</div>