<div class="table-responsive">

    <table id="table_list" class="table table-hover">
        <thead>
        <tr>
            <th class="text-c" style="cursor: pointer;">编号</th>
            <th style="cursor: pointer;">文件名</th>
            <th style="cursor: pointer;">文件大小</th>
            <th style="cursor: default;">最后修改时间</th>
            <th class="handle" style="cursor: default;">操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($list as $k=>$v)
        <tr>
            <td class="text-c">{{ $k+1 }}</td>
            <td>{{ $v['filename'] }}</td>
            <td>{{ $v['filesize'] }}</td>

            <td>{{ $v['time'] }}</td>
            <td class="handle">


                @if(backend_auth('system-backup-download'))
                    <span>|</span>
                    <a href="download?filename={{ $v['filename'] }}">下载文件</a>
                @endif

                @if(backend_auth('system-backup-delete'))
                    <span>|</span>
                    <a href="javascript:void(0);" class="del" onclick="delConfirm('{{ $v['filename'] }}')">删除</a>
                @endif

            </td>

        </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td colspan="5">
                <div id="pagination" class="pull-right page-box">


                    {!! $pageHtml !!}

                </div>
            </td>
        </tr>
        </tfoot>
    </table>

</div>
