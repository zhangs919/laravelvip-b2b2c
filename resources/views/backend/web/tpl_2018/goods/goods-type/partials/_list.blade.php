<div class="table-responsive">
    <table id="table_list" class="table table-hover">
        <thead>
        <tr>
            <th class="tcheck">
                <input type="checkbox" class="checkBox allCheckBox table-list-checkbox-all" title="全选/全不选">
            </th>
            <th class="text-c w80" data-sortname="type_id" data-sortorder="asc" style="cursor: pointer;">编号<span class="sort"></span></th>
            <th class="w200">类型名称</th>
            <th class="w200" style="cursor: default;">类型描述</th>
            <th class="text-c w100 f14" data-sortname="type_sort" data-sortorder="asc" style="cursor: pointer;">排序<span class="sort"></span></th>
            <th class="handle w200" style="cursor: default;">操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($list as $v)
        <tr>
            <td class="tcheck">
                <input type="checkbox" class="checkBox table-list-checkbox" value="{{ $v->type_id }}">
            </td>
            <td class="text-c">{{ $v->type_id }}</td>
            <td>{{ $v->type_name }}</td>
            <td>{{ $v->type_desc }}</td>
            <td class="text-c">
                <font class="f14">
                    <a href="javascript:void(0);" class="type_sort editable editable-click" data-type_id="{{ $v->type_id }}">{{ $v->type_sort }}</a>
                </font>
            </td>
            <td class="handle">
                <a href="/goods/attribute/add-base?type_id={{ $v->type_id }}" class="click-loading">添加属性</a>
                <span>|</span>
                <a href="/goods/attribute/add-spec?type_id={{ $v->type_id }}" class="click-loading">添加规格</a>
                <br>
                <a href="/goods/attribute/base-list?type_id={{ $v->type_id }}" class="click-loading">属性列表</a>
                <span>|</span>
                <a href="/goods/attribute/spec-list?type_id={{ $v->type_id }}" class="click-loading">规格列表</a>
                <span>|</span>
                <a href="edit?id={{ $v->type_id }}" class="click-loading">编辑</a>
                <span>|</span>
                <a href="javascript:void(0);" object_id="{{ $v->type_id }}" class="del border-none">删除</a>
            </td>
        </tr>
        @endforeach

        </tbody>
        <tfoot>
        <tr>
            <td class="text-c text-10">
                <input type="checkbox" class="allCheckBox checkBox table-list-checkbox-all" title="全选/全不选">

            </td>
            <td colspan="5">
                <div class="pull-left">
                    <!-- <button class="btn btn-danger m-r-2" type="button">批量删除</button> -->
                </div>
                <div class="pull-right page-box">


                    {!! $pageHtml !!}

                </div>
            </td>
        </tr>
        </tfoot>
    </table>

</div>