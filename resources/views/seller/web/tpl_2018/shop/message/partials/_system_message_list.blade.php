<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <!-- 标题 -->
        <th class="w500" data-sortname="title">标题</th>
        <!-- 发布时间 -->
        <th class="w300" data-sortname="add_time">发布时间</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
        <tr>
            <td class="text-l">
                <a href="@if(!empty($v->link)){{ $v->link }}@else{{ route('pc_show_article', ['article_id'=>$v->article_id]) }}@endif" target="_blank" title="{{ $v->title }}">{{ $v->title }}</a>
            </td>
            <td>{{ $v->add_time }}</td>
        </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td colspan="2">
            <div class="pull-right page-box">


                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
