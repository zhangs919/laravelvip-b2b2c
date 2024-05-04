<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck w10 p-l-5 p-r-0"><input type="checkbox"/></th>
        @if($is_manage)
            <th class="w120" style="cursor: default;">门店信息</th>
        @else
            <th class="text-c w60" data-sortname="goods_id">编号</th>
        @endif
        <th class='w300 p-l-0' data-sortname="goods_name">商品名称</th>
        <th class='w100 text-c p-l-0 p-r-0'>店铺价格</th>
        <th class='w100 text-c p-l-0 p-r-0'>门店价格 <i
                    class="fa fa-question-circle c-ccc m-r-0" data-toggle="popover"
                    data-trigger="hover" data-placement="bottom"
                    data-content="门店支持店铺统一价格和门店独立价格，当前门店的价格为店铺统一价格"
                    data-original-title="" title=""></i></th>
        <th class='w100 text-c p-l-0 p-r-0'>门店库存 <i
                    class="fa fa-question-circle c-ccc m-r-0" data-toggle="popover"
                    data-trigger="hover" data-placement="bottom"
                    data-content="门店支持店铺统一库存和门店独立库存，当前门店的库存为店铺统一库存"
                    data-original-title="" title=""></i></th>
        <th class='w100 text-c p-l-0'>库存预警值</th>
        <th class='w100 text-c p-l-0'>实时销量</th>
        <th class='w100 text-c p-l-0'>商品状态</th>
        <th class='w100 text-c p-l-0'>是否自提</th>
        <!-- <th>是否普通快递</th> -->
        <th class="handle w80 p-l-0 p-r-5">操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($list as $v)
        <tr>
            <td class="tcheck p-l-5 p-r-0"><input type="checkbox" class="checkbox"
                                                  value="{{ $v['goods_id'] }}"/></td>
            @if($is_manage)
                <td>
                    <div>门店ID：{{ $v['store_id'] }}</div>
                    <div>门店名称：{{ $v['store_name'] }}</div>
                </td>
            @else
                <td class="text-c">{{ $v['goods_id'] }}</td>
            @endif
            <td class=" p-l-0">
                <div class="goodsPicBox pull-left m-r-10">
                    <a href="{{ $v['goods_url'] }}" target="_blank">
                        <!-- 图片缩略图 -->
                        <img
                                src="{{ get_image_url($v['goods_image']) }}"
                                data-original="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80"
                                class="goods-thumb lazy"/>
                        <!-- 虚拟商品 -->
                        @if($v['is_virtual'])
                            <span
                                    class="goods-type fictitious">虚拟</span>
                        @endif
                    </a>
                </div>
                <div class="ng-binding goods-message w180">
                    <div class="name">
                        <a href="{{ $v['goods_url'] }}" target="_blank"
                           class="goods_name"
                           data-goods_id={{ $v['goods_id'] }} title="{{ $v['goods_name'] }}">
                            {{ $v['goods_name'] }}
                        </a>
                        @if($v['sku_open'])
                            <label class="label label-warning m-l-5" title="此商品为多规格商品">SKU</label>
                        @endif
                    </div>
                    <div class="active">
                        <div class="QR-code popover-box">
                            <a href="javascript:;" class="qrcode">
                                <i class="fa fa-qrcode"></i>
                            </a>
                            <div class="code-info popover-info">
                                <i class="fa fa-caret-left"></i>
                                <a href="javascript:void(0);" class="download-qrcode"
                                   data-goods_id="{{ $v['goods_id'] }}">商品二维码</a>
                                <div style="padding: 10px; background-color: #fff; margin: 0;">
                                    <div class="goods-qrcode" data-goods_id="{{ $v['goods_id'] }}"
                                         data-url="{{ $v['goods_url'] }}?is_scan=1"
                                         style="width: 120px; height: 120px; margin: 0;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="pull-left">
                            <label class="model-label blue">@if($v['sales_model'] == 1){{ '批发' }}@else{{ '零售' }}@endif</label>
                        </div>
                    </div>
                    <div>
                        <!-- 活动色块 -->
                    </div>
                </div>
            </td>
            <td class="text-c p-l-0 p-r-0">￥{{ $v['shop_goods_price'] }}</td>
            <td class="text-c p-l-0 p-r-0">￥{{ $v['store_goods_price'] }}</td>
            <td class="text-c p-l-0 p-r-0">
                @if($v['store_goods_number'] > 0)
                    {{ $v['store_goods_number'] }}
                @else
                    <span style="color:red">0</span>
                @endif
            </td>
            <td class="text-c p-l-0">{{ $v['warn_number'] }}</td>
            <td class="text-c p-l-0">{{ $v['sale_num'] }}</td>
            <td class=" text-c p-l-0">
                <span value="{{ $v['is_sell'] }}"
                      data-action="set-is-sell?store_id={{ $v['store_id'] }}&spu_id={{ $v['goods_id'] }}"
                      title="点击可编辑门店商品上下架状态"
                      class="ico-switch {{ $v['is_sell'] ? 'open' : '' }}" data-value='[0,1]' data-label='["已下架","出售中"]'
                      data-class='["fa fa-toggle-off","fa fa-toggle-on"]'>
                    {!! $v['is_sell'] ? '<i class="fa fa-toggle-on"></i>出售中' : '<i class="fa fa-toggle-off"></i>已下架' !!}
                </span>
            </td>
            <td class=" text-c p-l-0">
                <span value="{{ $v['is_self_mention'] }}"
                      data-action="set-is-self-mention?store_id={{ $v['store_id'] }}&spu_id={{ $v['goods_id'] }}"
                      class="ico-switch {{ $v['is_self_mention'] ? 'open' : '' }}" data-value='[0,1]'
                      data-label='["关闭","开启"]'
                      data-class='["fa fa-toggle-off","fa fa-toggle-on"]'>
                    {!! $v['is_self_mention'] ? '<i class="fa fa-toggle-on"></i>开启' : '<i class="fa fa-toggle-off"></i>关闭' !!}
                </span>
            </td>
{{--            <td>--}}
{{--                <span value="{{ $v['is_common_package'] }}" --}}
{{--                      data-action="set-is-common-package?store_id={{ $v['store_id'] }}&spu_id={{ $v['goods_id'] }}" --}}
{{--                      class="ico-switch {{ $v['is_common_package'] ? 'open' : '' }}" data-value='[0,1]' --}}
{{--                      data-label='["否","是"]' --}}
{{--                      data-class='["fa fa-toggle-off","fa fa-toggle-on"]'>--}}
{{--                    {!! $v['is_self_mention'] ? '<i class="fa fa-toggle-on"></i>是' : '<i class="fa fa-toggle-off"></i>否' }}--!!}
{{--                </span>--}}
{{--            </td>--}}
            <td class="handle p-l-0 p-r-5">
                <a href="javascript:void(0)" data-goods_id="{{ $v['goods_id'] }}" data-store_id="{{ $v['store_id'] }}"
                   class="edit_goods">编辑</a>
                <span>|</span>
                <a href="javascript:void(0);" data-id="{{ $v['goods_id'] }}" data-store_id="{{ $v['store_id'] }}"
                   class="batch-sale-goods" data-status="{{ $v['is_sell'] ? 'off' : 'on' }}">{{ $v['is_sell'] ? '下架' : '上架' }}</a>
                <!-- -->
                <span>|</span>
                <a href="javascript:void(0);" class="popularize" data-id="{{ $v['goods_id'] }}"
                   data-name="{{ $v['goods_name'] }}"
                   data-url="{{ $v['goods_url'] }}">推广码</a>
                <!-- -->
                <span>|</span>
                <a href="javascript:void(0);" data-id="{{ $v['goods_id'] }}" class="del delete-goods">删除</a>
                <!-- -->
            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td class="text-c w10"><input type="checkbox" class="checkBox"/>
        </td>
        <td colspan="10">
            <div class="pull-left">
                <div class="btn-group dropup m-r-2">
                    <button type="button" class="btn btn-default dropdown-toggle"
                            data-toggle="dropdown">
                        批量操作 <span class="caret m-l-5"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a class="batch-sale-goods" data-status="on">商品上架</a></li>
                        <li><a class="batch-sale-goods" data-status="off">商品下架</a>
                        </li>
                        <li><a class="sku-member">自提点设置</a></li>
                        <li>
                            <a class="goods-multi-edit">库存和价格设置</a>
                        </li>
                        <!-- -->
                        <li><a class="delete-goods">批量删除</a></li>
                        <!-- -->
                    </ul>
                </div>
            </div>
            <div class="pull-right page-box">
                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
