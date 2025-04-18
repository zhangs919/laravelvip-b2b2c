<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck p-l-5 p-r-0">
            <input type="checkbox" class="checkBox allCheckBox" />
        </th>
        <th class="text-c w60 p-l-0">活动ID</th>
        <th class="w100 p-l-0">活动名称</th>
        <th class="text-c w60 p-l-0">商品ID</th>
        <th class="w250 p-l-0 p-r-0">商品名称</th>
        <!-- <th class="text-c w70">活动图片</th> -->
        <th class="text-c w90 p-l-0">活动类型</th>
        <th class="text-c w80 p-l-0">拼团价</th>
        <th class="text-c w80 p-l-0">店铺价</th>
        <th class="text-c w70 p-l-0">参团人数</th>
        <th class="text-c w70 p-l-0">活动库存</th>
        <th class="text-c w150 p-l-0">活动有效时间</th>
        <th class="text-c w70 p-l-0">活动状态</th>
        <th class="text-c w70 p-l-0">审核状态</th>
        <th class="handle w80 p-l-0 p-r-0">操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($list as $item)
    <tr>
        <td class="tcheck p-l-5 p-r-0">
            <input type="checkbox" class="checkBox" value="{{ $item->act_id }}" disabled=true />
        </td>
        <td class="text-c p-l-0">{{ $item->act_id }}</td>
        <td class="p-l-0 f13">{{ $item->act_name }}</td>
        <td class="text-c p-l-0">{{ $item->goods_id }}</td>
        <td class=" p-l-0  p-r-0">
            <div class="goodsPicBox pull-left m-r-10">
                <a href="{{ route('mobile_show_goods', ['goods_id'=> $item->goods_id]) }}" target="_blank">
                    <!-- 图片缩略图 -->
                    <img src="{{ $item->goods_image }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" class="goods-thumb"></img>
                </a>
            </div>
            <div class="ng-binding goods-message w150">
                <div class="name">
                    <a href="{{ route('mobile_show_goods', ['goods_id'=> $item->goods_id]) }}" target="_blank" data-toggle="tooltip" data-placement="auto bottom" title="{{ $item->goods_name }}">{{ $item->goods_name }}</a>
                </div>
                <div class="active">
                    <div class="QR-code popover-box" style="margin-top: 2px;">
                        <a href="javascript:void(0);" class="qrcode">
                            <i class="fa fa-qrcode"></i>
                        </a>
                        <div class="code-info popover-info">
                            <i class="fa fa-caret-left"></i>
                            <a href="/goods/default/download-qrcode?id={{ $item->goods_id }}" class="download-qrcode" data-goods_id="{{ $item->goods_id }}" data-sku_id="{{ $item->sku_id }}">商品二维码</a>
                            <div style="padding: 10px; background-color: #fff; margin: 0;">
                                <div class="goods-qrcode" data-url="{{ route('mobile_show_goods', ['goods_id' =>$item->goods_id]) }}" style="width: 120px; height: 120px; margin: 0;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </td>
        <!-- <td class="text-c">
            <a href="javascript:void(0);" ref="/system/config/default_image/default_goods_image_0.gif?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" class="preview">
                <i class="fa fa-picture-o"></i>
            </a>
            <span class="btn btn-success btn-xs pos-r upload-img" data-url="upload-act_img" data-id="18"> 更换 </span>
        </td> -->
        <td class="text-c p-l-0">{{ $item->groupon_mode == 1 ? '老带新拼团' : '普通拼团' }}</td>
        <td class="text-c p-l-0">￥{{ $item->act_price }}</td>
        <td class="text-c p-l-0">￥{{ $item->goods_price }}</td>
        <td class="text-c p-l-0">{{ $item->act_ext_info['fight_num'] }}</td>
        <td class="text-c p-l-0">{{ $item->act_stock }}</td>
        <td class="text-c p-l-0">
            {{ $item->start_time }}
            <br>
            ~
            <br>
            {{ $item->end_time }}
        </td>
        <td class="text-c p-l-0" data-is_finish="{{ $item->is_finish }}">
            <font class="@if($item->is_finish) c-green @else c-red @endif"> {{ $item->status_format }} </font>
        </td>
        <td class="text-c p-l-0">
            <span class="{{ str_replace([0,1,2], ['', 'c-green', 'c-red'], $item->status) }}">{{ str_replace([0,1,2], ['待审核', '审核通过', '审核不通过'], $item->status) }}</span>
        </td>
        <td class="handle p-l-0 p-r-0">
            <a href="view?id={{ $item->act_id }}">查看</a>
            <span>|</span>
            <a href="javascript:void(0);" class="del end-activity" data-id="{{ $item->act_id }}" data-name="{{ $item->act_name }}">结束活动</a>
        </td>
    </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td class="text-c w10  p-l-5 p-r-0">
            <input type="checkbox" class="checkBox" />
        </td>
        <td colspan="13">
            <div class="pull-left">
                <input type="button" class="btn btn-danger m-r-2 delete-activity" value="批量删除" />
            </div>
            <div class="pull-right page-box">
                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
