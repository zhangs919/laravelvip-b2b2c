<div class="table-responsive">

    <table id="table_list" class="table table-hover">
        <thead>
        <tr>
            <th class="tcheck">
                <input type="checkbox" class="checkBox allCheckBox" />
            </th>
            <th class="w70 text-c">编号</th>
            <th class="w250">表单标题</th>
            <th class="w250">地址</th>
            <th class="w150 text-c">创建时间</th>
            <th class="w150 text-c">更新时间</th>
            <th class="w80  text-c">反馈数</th>
            <th class="handle w250">操作</th>
        </tr>
        </thead>
        <tbody>

        @foreach($list as $v)
        <tr>
            <td class="tcheck">
                <input type="checkbox" class="checkBox" value="{{ $v->form_id }}" />
            </td>
            <td class="text-c">{{ $v->form_id }}</td>
            <td>{{ $v->form_title }}</td>
            <td>/form/{{ $v->form_id }}.html</td>
            <td class="text-c">{{ $v->created_at }}</td>
            <td class="text-c">{{ $v->updated_at }}</td>
            <td class="text-c">
                <a href="/dashboard/custom-form-data/list?form_id={{ $v->form_id }}">{{ $v->fb_num }}</a>
            </td>
            <td class="handle">
                <a target="_blank" href="{{ route('show_form', ['form_id'=>$v->form_id]) }}" data-id="{{ $v->form_id }}" class="view border-none">查看</a>
                <a href="javascript:void(0);" data-id="{{ $v->form_id }}" class="copy border-none">复制</a>
                <a href="/dashboard/custom-form-data/list?form_id={{ $v->form_id }}" class="border-none">反馈统计</a>
                <a href="edit-form?form_id={{ $v->form_id }}" class="border-none">编辑</a>
                <a href="edit?form_id={{ $v->form_id }}" target="_blank" class="border-none">设计表单</a>
                <a href="javascript:void(0);" data-id="{{ $v->form_id }}" class="del border-none">删除</a>
            </td>
        </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td class="text-c w10">
                <input type="checkbox" class="allCheckBox checkBox">
            </td>
            <td colspan="7">
                <div class="pull-left">
                    <input type="button" id="batch-delete" class="btn btn-danger m-r-2" value="批量删除" />
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