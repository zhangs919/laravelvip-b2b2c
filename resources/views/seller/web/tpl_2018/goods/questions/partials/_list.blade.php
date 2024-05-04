<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="text-c w80" data-sortname="questions_id">编号</th>
        <th class="w600" data-sortname="question">常见问题信息</th>
        <th class="text-c w80" data-sortname="sort">排序</th>
        <th class="handle w120">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
    <tr>
        <td class="text-c">{{ $v->questions_id }}</td>
        <td class="question-box">
            <dl>
                <dt>
                    <em class="q">Q</em>
                    {{ $v->question }}
                </dt>
                <dd>
                    <em class="a">A</em>
                    {{ $v->answer }}
                </dd>
            </dl>
        </td>
        <td class="text-c">
            <font class="f14">
                <a href="javascript:void(0);" class="question_sort" data-id={{ $v->questions_id }}>{{ $v->sort }}</a>
            </font>
        </td>
        <td class="handle">
            <a href="/goods/questions/edit?id={{ $v->questions_id }}">编辑</a>
            <span>|</span>
            <a href="javascript:void(0);" object_id="{{ $v->questions_id }}" class="del border-none">删除</a>
        </td>
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td colspan="4">
            <div class="pull-right page-box">


                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>

