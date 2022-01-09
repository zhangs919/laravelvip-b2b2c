<div class="table-responsive">

    <table id="table_list" class="table table-hover">
        <thead>
        <tr>
            <th class="w100" data-sortname="name">名称</th>
            <th class="w100" data-sortname="add_time">备份时间</th>
            <th class="text-c w100" data-sortname="page">页面</th>

            <th class="text-c w100">站点</th>


            <th class="handle w120 text-c">操作</th>
        </tr>
        </thead>
        <tbody>

        @foreach($tplBackup as $v)
        <tr>
            <td>
                <a href="javascript:void(0)" title="{{ $v->name }}">{{ $v->name }}</a>
            </td>
            <td>{{ $v->created_at }}</td>
            <td class="text-c">{{ $v->page }}</td>

            <td class="text-c">{{ $v->site_id }}</td>


            <td class="handle">
                <a href="javascript:void(0)" data-id="{{ $v->back_id }}" class="TPL-USE" title="{{ $v->name }}">使用</a>

                <span>|</span>
                <a href="javascript:void(0);" data-id="{{ $v->back_id }}" class="TPL-DEL border-none">删除</a>



            </td>
        </tr>
        @endforeach


        </tbody>
        <tfoot>
        <tr>
            <td colspan="5">
                <div class="pull-right page-box">


                    {!! $pageHtml !!}

                </div>
            </td>
        </tr>
        </tfoot>
    </table>

</div>