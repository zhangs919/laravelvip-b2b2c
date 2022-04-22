<table class="table table-hover" id="table_list">
    <thead>
    <tr>
        <th class="tcheck">
            <input type="checkbox" class="checkBox allCheckBox table-list-checkbox-all" title="全选/全不选">
        </th>
        <th class="w100 text-c">编号</th>
        <th class="w150">所属类型</th>
        <th class="w500">搜索词</th>
        <th class="w100 text-c">是否显示</th>
        <!--<th class="text-c">
            排序
            <span class="sort"></span>
        </th>  -->
        <th class="w150 handle" style="cursor: default;">操作</th>
    </tr>
    </thead>

    <tbody>

    @foreach($list as $v)
    <tr>
        <td class="tcheck">
            <input type="checkbox" class="checkBox table-list-checkbox">

        </td>
        <td class="text-c">{{ $v->id }}</td>
        <td>{{ $v->search_name }}</td>
        <td>{{ $v->search_keywords }}</td>
        <td class="text-c">
            @if($v->is_show == 1)
                <span data-action="set-is-show?id={{ $v->id }}" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>是</span>
            @else
                <span data-action="set-is-show?id={{ $v->id }}" class="ico-switch" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-off"></i>否</span>
            @endif
        </td>
        <!--<td class="text-c">{{ $v->sort }}</td>  -->
        <td class="handle">
            <a href="/mall/search/edit?id={{ $v->id }}">编辑</a>
            <span>|</span>
            <a class="del border-none" href="javascript:void(0);" data-id="{{ $v->id }}">删除</a>
        </td>
    </tr>
    @endforeach


    </tbody>
    <tfoot>
    <tr>
        <td class="text-c w10">
            <!-- <input type="checkbox" class="allCheckBox checkBox" />-->
        </td>
        <td colspan="5">
            <!-- <div class="pull-left">
                <button class="btn btn-danger m-r-2" type="button">删除</button>
            </div> -->
            <div class="pull-right page-box">


                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
