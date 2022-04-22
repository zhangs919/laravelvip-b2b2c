<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck">
            <input type="checkbox" class="checkBox allCheckBox" />
        </th>
        <th class="w200" data-sortname="act_name">活动名称</th>
        <th class="text-c w100">活动图片</th>
        <th class="w200" data-sortname="start_time">活动有效时间</th>
        <th class="w150">商品个数</th>
        <th class="text-c w120">活动状态</th>
        <th class="text-c w120" data-sortname="status">审核状态</th>
        <th class="handle w200">操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($list as $v)
    <tr>
        <td class="tcheck">
            <input type="checkbox" class="checkBox" value="{{ $v['act_id'] }}" />
        </td>
        <td>{{ $v['act_name'] }}</td>
        <td class="text-c">
            <a href="javascript:void(0);" ref="{{ get_image_url($v['act_img']) }}" class="preview">
                <i class="fa fa-picture-o"></i>
            </a>
            <span class="btn btn-success btn-xs pos-r upload-img" data-url="upload-act_img" data-id="{{ $v['act_id'] }}"> 更换 </span>
        </td>
        <td>
            {{ $v['start_time'] }}
            <br>
            ~
            <br>
            {{ $v['end_time'] }}
            <br>
        </td>
        <td>{{ $v['goods_count'] }}</td>
        <td class="text-c">
            <font class="{{ str_replace([0,1,2],['c-red','c-warning','c-999'],$v['is_finish']) }}">{{ str_replace([0,1,2],['未开始','进行中','已结束'],$v['is_finish']) }}</font>
        </td>
        <td class="text-c">
            <font class="{{ str_replace([0,1,2],['c-red','c-green','c-999'],$v['status']) }}">{{ str_replace([0,1,2],['待审核','已审核','审核不通过'],$v['status']) }}</font>
        </td>
        <td class="handle">
            <a href="view?id={{ $v['act_id'] }}" class="border-none">查看</a>
            <span>|</span>
            @if($v['status'] == 0){{--待审核 可以编辑--}}
            <a href="edit?id={{ $v['act_id'] }}">编辑</a>
            <span>|</span>
            @endif
            <a href="javascript:void(0);" data-id="{{ $v['act_id'] }}" class="del border-none">删除</a>
        </td>
    </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td class="text-c w10">
            <input type="checkbox" class="checkBox" />
        </td>
        <td colspan="7">
            <div class="pull-left">
                <div class="pull-left">
                    <input type="button" class="btn btn-danger m-r-2 batch-del" value="批量删除" />
                </div>
            </div>
            <div class="pull-right page-box">


                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
