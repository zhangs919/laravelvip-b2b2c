<div class="table-responsive">

    <table id="table_list" class="table table-hover">
        <thead>
        <tr>
            <th class="w100 text-c">编号</th>
            <th class="w130">提交人</th>
            <th class="w130 text-c">提交时间</th>
            <th>提交地点</th>
            <th class="w100">姓名</th>
            <!-- <th class="w50">年龄</th> -->
            <th class="w150">电话</th>
            <th>所在城市</th>
            <th class="handle">操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($list as $v)
        <tr>
            <td class="text-c">{{ $v->id }}</td>
            <td>{{ $v->user_name }}</td>
            <td class="text-c">{{ $v->created_at }}</td>
            <td>{{ $v->address ?? '' }}</td>
            <td>{{ $v->username ?? '' }}</td>
            <!-- <td></td> -->
            <td>{{ $v->phone ?? '' }}</td>
            <td>{{ $v->location }}</td>
            <td class="handle">
                <a href="/dashboard/custom-form-data/detail?id={{ $v->id }}">查看明细</a>
            </td>
        </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td colspan="8">
                <div class="pull-right page-box">


                    {!! $pageHtml !!}
                </div>
            </td>
        </tr>
        </tfoot>
    </table>

</div>