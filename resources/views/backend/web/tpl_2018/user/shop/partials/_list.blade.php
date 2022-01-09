<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="text-c w100" data-sortname="rank_id" data-sortorder="asc" style="cursor: pointer;">编号<span class="sort"></span></th>
        <th class="w500" data-sortname="rank_name" data-sortorder="asc" style="cursor: pointer;">等级名称<span class="sort"></span></th>
        <th class="w200" data-sortname="rank_level" data-sortorder="asc" style="cursor: pointer;">等级级别<span class="sort"></span></th>
        <th class="handle" style="cursor: default;">操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($list as $v)
    <!---->
    <tr>
        <td class="text-c">{{ $v->rank_id }}</td>
        <td>{{ $v->rank_name }}</td>
        <td>{{ $v->rank_level }}</td>
        <td class="handle">
            <a href="edit?id={{ $v->rank_id }}">编辑</a>
            <span>|</span>
            <a href="javascript:void(0);" object_id="{{ $v->rank_id }}" class="del border-none">删除</a>
        </td>
    </tr>
    @endforeach
    <!---->
    </tbody>
    <tfoot>
    <tr>
        <td colspan="4">
            <div class="pull-left"></div>
            <div id="pagination" class="pull-right page-box">


                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
