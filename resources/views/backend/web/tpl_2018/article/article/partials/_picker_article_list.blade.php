<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th data-sortname="shop_id">编号</th>
        <th data-sortname="title">文章标题</th>
        <th data-sortname="add_time">发布时间</th>
        <th class="handle">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
    <tr>
        <td>{{ $v->article_id }}</td>
        <td>{{ $v->title }}</td>
        <td>{{ $v->created_at }}</td>
        <td class="handle" id="handle_{{ $v->article_id }}">

            <a href="javascript:void(0);" data-article_id='{{ $v->article_id }}' data-title='{{ $v->title }}'
               class="select-article @if(in_array($v->article_id, $selected_ids)){{ 'active' }}@endif">
                @if(in_array($v->article_id, $selected_ids)){{ '已选' }}@else{{ '选择' }}@endif
            </a>

        </td>
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td colspan="4">
            <div class="pull-right page-box">


                {{--分页--}}
                {!! $pageHtml !!}

            </div>
        </td>
    </tr>
    </tfoot>
</table>