<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="w80 text-c" data-sortname="id">编号</th>
        <th class="w150" data-sortname="print_spec">打印规格</th>
        <th class="w150 text-c" data-sortname="is_default">是否默认</th>
        <th class="handle w200">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
    <tr>
        <td class="text-c">{{ $v->id }}</td>
        <td>{{ $v->print_spec }}</td>
        <td class="text-c">
            @if($v->is_default == 1) {{--默认打印机--}}
                <span title="禁止修改，至少存在一个默认规格" data-id="0" class="ico-switch open" data-value='[0,1]' data-label='["\u5426","\u662f"]' data-class='["fa fa-toggle-off","fa fa-toggle-on"]'><i class="fa fa-toggle-on"></i>是</span>
            @else
                <span data-id="{{ $v->id }}" class="ico-switch" data-value='[0,1]' data-label='["\u5426","\u662f"]' data-class='["fa fa-toggle-off","fa fa-toggle-on"]'><i class="fa fa-toggle-off"></i>否</span>
            @endif
        </td>
        <td class="handle">
            <a href="javascript:void(0);" data-id="{{ $v->id }}" class="border-none config-printer">配置打印机</a>
            <span>|</span>
            <a href="set?id={{ $v->id }}" target="_blank">模版设置</a>
            <span>|</span>
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
        <td colspan="3">
            <div class="pull-right page-box">
                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
