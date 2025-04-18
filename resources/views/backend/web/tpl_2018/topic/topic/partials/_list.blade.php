<div class="table-responsive">

    <table id="table_list" class="table table-hover">
        <thead>
        <tr>
            <th class="tcheck">
                <input type="checkbox" class="checkBox allCheckBox table-list-checkbox-all" title="全选/全不选">
            </th>
            <th class="text-c w80" data-sortname="topic_id" data-sortorder="asc" style="cursor: pointer;">编号<span class="sort"></span></th>
            <th class="w200" data-sortname="topic_name" data-sortorder="asc" style="cursor: pointer;">活动名称<span class="sort"></span></th>
            <th class="w300" style="cursor: default;">专题地址</th>
            <th class="w150" data-sortname="add_time" data-sortorder="asc" style="cursor: pointer;">创建时间<span class="sort"></span></th>
            <th class="w150" data-sortname="update_time" data-sortorder="asc" style="cursor: pointer;">更新时间<span class="sort"></span></th>
            <th class="handle w250" style="cursor: default;">操作</th>
        </tr>
        </thead>
        <tbody>

        @foreach($list as $v)
        <tr>
            <td class="tcheck">
                <input type="checkbox" class="checkBox table-list-checkbox" value="{{ $v->topic_id }}">
            </td>
            <td class="text-c">{{ $v->topic_id }}</td>
            <td>{{ $v->topic_name }}</td>
            <td>{{ route('pc_show_topic', ['topic_id' => $v->topic_id], false) }}</td>
            <td>{{ $v->created_at }}</td>
            <td>{{ $v->updated_at }}</td>
            <td class="handle">
                <a href="{{ route('pc_show_topic', ['topic_id' => $v->topic_id]) }}" target="_blank">查看</a>

                @if($v->shop_id == 0){{--店铺专题不允许平台装修、编辑--}}
                <span>|</span>
                <a href="design?id={{ $v->topic_id }}" target="_blank">装修</a>
                <span>|</span>
                <a href="edit?id={{ $v->topic_id }}">编辑</a>
                <span>|</span>
                @endif
                <a href="javascript:void(0);" data-id="{{ $v->topic_id }}" class="del border-none">删除</a>
            </td>
        </tr>
        @endforeach

        </tbody>
        <tfoot>
        <tr>
            <td class="text-c w10">
                <input type="checkbox" class="allCheckBox checkBox table-list-checkbox-all" title="全选/全不选">
            </td>
            <td colspan="6">
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