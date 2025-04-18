<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="w250">活动名称</th>
        <th class="text-c w100">活动推广图</th>
        <th class="text-c w200">活动有效期</th>
        <th class="w150">活动标签</th>
        <th class="text-c w120">活动状态</th>
        <th class="text-c w120">排序</th>
        <th class="handle w150">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
    <tr>
        <td>{{ $v['act_name'] }}</td>
        <td class="text-c">
            <a href="javascript:void(0);" ref="{{ get_image_url($v['act_img']) }}" class="preview">
                <i class="fa fa-picture-o"></i>
            </a>
            <span class="btn btn-success btn-xs pos-r upload-img" data-url="upload-act_img" data-id="{{ $v['act_id'] }}"> 更换 </span>
        </td>
        <td class="text-c">
            {{ $v['start_time'] }}
            <br>
            ~
            <br>
            {{ $v['end_time'] }}
        </td>
        <td>{{ $v['act_label'] }}</td>
        <td class="text-c">
            <font class="{{ str_replace(['未开始','进行中','已结束'],['c-red','c-green','c-999'],$v['status_message']) }}">{{ $v['status_message'] }}</font>
        </td>
        <td class="text-c">
            <a href="javascript:void(0);" class="sort-edit" data-act_id="{{ $v['act_id'] }}">{{ $v['sort'] }}</a>
        </td>
        <td class="handle">
            <a href="edit?id={{ $v['act_id'] }}">编辑</a>
            <span>|</span>
            <span>|</span>
            <a href="shop-activity-goods-list?act_id={{ $v['act_id'] }}" data-id="{{ $v['act_id'] }}" class="goods-list border-none">活动商品</a>
            @if($v['is_finish'] == 1)
            <span>|</span>
            <a href="javascript:void(0);" data-id="{{ $v['act_id'] }}" data-name="{{ $v['act_name'] }}" class="del end-activity">结束活动</a>
            @endif
            @if($v['is_finish'] == 2)
            <span>|</span>
            <a href="javascript:void(0);" data-id="{{ $v['act_id'] }}" class="del border-none">删除</a>
            @endif
        </td>
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td colspan="7">
            <div class="pull-left"></div>
            <div class="pull-right page-box">


                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
