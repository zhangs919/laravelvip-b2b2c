<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="text-c w80" data-sortname="id">编号</th>
        <th class="w300">小程序内容</th>
        <th class="text-c w100">小程序码</th>
        <th class="handle w120">操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($list as $item)
    <tr>
        <td class="text-c">{{ $item['id'] }}</td>
        <td>/shop/{{ $item['shop_id'] }}.html</td>
        <td class="text-c">
            <a href="javascript:void(0);" ref="{{ get_image_url($item['qrcode'],'no_default') }}" class="preview">
                <i class="fa fa-qrcode f16"></i>
            </a>
            <a class="download-btn" href="/site/download-file?file={{ get_image_url($item['qrcode'],'no_default') }}&file_name={{ $item['id'] }}"> 下载 </a>
        </td>
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
        <td colspan="4">
            <div class="pull-left"></div>
            <div class="pull-right page-box">
                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
