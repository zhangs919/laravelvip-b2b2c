<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="text-c w80" data-sortname="id" data-sortorder="asc" style="cursor: pointer;">编号<span class="sort"></span></th>
        <th class="text-c w100">二维码类型</th>
        <th class="w300">二维码内容</th>
        <th class="text-c w100">二维码</th>
        <th class="handle w120">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $item)
    <tr>
        <td class="text-c">{{ $item->id }}</td>
        <td class="text-c">{{ $item->qcode_type_text }}</td>
        <td>{{ $item->qcode_content_text }}</td>
        <td class="text-c">
            <a href="javascript:void(0);" ref="{{ $item->qcode_url }}" class="preview">
                <i class="fa fa-qrcode f16"></i>
            </a>
        </td>
        <td class="handle">
            <a href="edit?id={{ $item->id }}">编辑</a>
            <span>|</span>
            <a href="javascript:void(0);" data-id="{{ $item->id }}" class="del border-none">删除</a>
        </td>
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>

        <td colspan="5">
            <div class="pull-left"></div>
            <div class="pull-right page-box">
                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>