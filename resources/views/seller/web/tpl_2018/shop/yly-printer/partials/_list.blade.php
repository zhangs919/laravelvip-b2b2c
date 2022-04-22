<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="w80 text-c" data-sortname="id">编号</th>
        <th class="w150">打印机终端号</th>
        <th class="w150">打印机密钥</th>
        <th class="w150">打印机名称</th>
        <th class="w150">手机号</th>
        <th class="w150 text-c" data-sortname="is_default">是否默认</th>
        <th class="handle w200">操作</th>
    </tr>
    </thead>
    <tbody>

    {{--todo 由于没有找到模板html 借用打印规格列表模板--}}
    @foreach($list as $v)
        <tr>
            <td class="text-c">{{ $v->id }}</td>
            <td>{{ $v->machine_code }}</td>
            <td>{{ $v->msign }}</td>
            <td>{{ $v->print_name }}</td>
            <td>{{ $v->phone }}</td>
            <td class="text-c">
                @if($v->is_default == 1) {{--todo 是否必须有一个默认打印机？--}}
                <span title="禁止修改，至少存在一个默认打印机" data-id="0" class="ico-switch open" data-value='[0,1]' data-label='["\u5426","\u662f"]' data-class='["fa fa-toggle-off","fa fa-toggle-on"]'><i class="fa fa-toggle-on"></i>是</span>
                @else
                    <span data-id="{{ $v->id }}" class="ico-switch" data-value='[0,1]' data-label='["\u5426","\u662f"]' data-class='["fa fa-toggle-off","fa fa-toggle-on"]'><i class="fa fa-toggle-off"></i>否</span>
                @endif
            </td>
            <td class="handle">
                <a href="edit?id={{ $v->id }}">编辑</a>
                <span>|</span>
                <a href="javascript:void(0);" object_id="{{ $v->id }}" class="del border-none">删除</a>
            </td>
        </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td class="text-c w10"></td>
        <td colspan="6">
            <div class="pull-right page-box">
                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
