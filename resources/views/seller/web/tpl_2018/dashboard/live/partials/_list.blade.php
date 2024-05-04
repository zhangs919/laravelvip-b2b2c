<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="text-c w50">ID</th>
        <th class="w200" data-sortname="live_name">直播标题</th>
        <th class="text-c w100">直播封面</th>
        <th class="text-c w200" data-sortname="start_time">直播时间</th>
        <th class="w150">所属分类</th>
        <th class="text-c w120" data-sortname="is_finish">状态</th>
        <!-- <th class="text-c w120">直播统计</th> -->
        <th class="text-c w80" data-sortname="sort">排序</th>
        <th class="handle w200">操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($list as $item)
    <tr>
        <td class="text-c">{{ $item['id'] }}</td>
        <td>
            <div class="ng-binding goods-message">
                <div class="name pull-left">{{ $item['live_name'] }}</div>
                <div class="active pull-left w20 m-l-10">
                    <div class="QR-code popover-box">
                        <a href="javascript:;" class="qrcode">
                            <i class="fa fa-qrcode"></i>
                        </a>
                        <div class="code-info popover-info" style="display: none;">
                            <i class="fa fa-caret-left"></i>
                            <a href="/dashboard/live/download-qrcode?id={{ $item['id'] }}">点击下载</a>
                            <p>
                                <img src="/dashboard/live/qrcode?id={{ $item['id'] }}">
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </td>
        <td class="text-c">
            <a href="javascript:void(0);" ref="{{ get_image_url($item['live_img']) }}" class="preview">
                <i class="fa fa-picture-o"></i>
            </a>
        </td>
        <td class="text-c" id="time_td_{{ $item['id'] }}">
            {{ $item['start_time'] ?: '---' }}
            <br>
            ~
            <br>
            {{ $item['end_time'] ?: '---' }}
        </td>
        <td>{{ $item['cat_name'] }}</td>
        <td class="text-c" id="status_td_{{ $item['id'] }}">
            @if($item['status'] == 0)
                <font class="c-red">未开始</font>
            @elseif($item['status'] == 1)
                <font class="c-green">直播中</font>
            @elseif($item['status'] == 2)
                <font class="c-999">已结束</font>
            @endif
        </td>
        <!-- <td class="text-c">直播统计</td> -->
        <td class="text-c">
            <font class="f14">
                <a href="javascript:void(0);" class="live_sort" data-id={{ $item['id'] }}>{{ $item['sort'] }}</a>
            </font>
        </td>
        <td class="handle">
            @if($item['status'] == 0)
                {{--未开始--}}
                <a href="javascript:void(0);" data-id="{{ $item['id'] }}" data-status="0" class="change-is-finish border-none">开始直播</a>
                <a href="edit?id={{ $item['id'] }}">编辑</a>
                <a href="javascript:void(0);" data-id="{{ $item['id'] }}" class="del border-none">删除</a>
            @elseif($item['status'] == 1)
                {{--直播中--}}
                <a href="javascript:void(0);" data-id="{{ $item['id'] }}" class="address border-none">推流地址</a>
                <a href="javascript:void(0);" data-id="{{ $item['id'] }}" class="change-is-finish">关闭直播</a>
                <a href="edit?id={{ $item['id'] }}">编辑</a>
            @elseif($item['status'] == 2)
                {{--已结束--}}
                <a href="javascript:void(0);" data-id="{{ $item['id'] }}" class="del border-none">删除</a>
            @endif
        </td>
    </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td colspan="8">
            <div class="pull-left"></div>
            <div class="pull-right page-box">
                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
