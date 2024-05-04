<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="text-c w100" data-sortname="id">编号</th>
        <th class="w150" data-sortname="key_name">关键词名称</th>
        <th class="w150" data-sortname="key_type">关键词类型</th>
        <th class="w300" data-sortname="key_content">关键词回复内容</th>
        <th class="handle w150">操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($list as $item)
    <tr>
        <td class="text-c">{{ $item['id'] }}</td>
        <td class="f13">{{ $item['key_name'] }}</td>
        <td>{{ str_replace([0,1],['自定义文字','自定义图文'],$item['key_type']) }}</td>
        <td>{!! $item['key_content'] ?? $item['key_title'] !!}</td>
        <td class="handle">
            <a href="edit?id={{ $item['id'] }}">编辑</a>
            <span>|</span>
            <a href="javascript:void(0);" data-id="{{ $item['id'] }}" class="del border-none">删除</a>
        </td>
    </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td colspan="5">
            <div class="pull-left">
            </div>
            <div class="pull-right page-box">
                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
