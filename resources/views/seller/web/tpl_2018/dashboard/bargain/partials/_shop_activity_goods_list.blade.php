<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck">
            <input type="checkbox" class="checkBox allCheckBox"/>
        </th>
        <th class="w300" data-sortname="goods_id">商品信息</th>
        <th class="w150">规格</th>
        <th class="text-c w100" data-sortname="">原价（元）</th>
        <th class="text-c w150" data-sortname="">初始砍价（元）</th>
        <th class="text-c w120" data-sortname="act_price">砍价底价（元）</th>
        <th class="text-c w150" data-sortname="">自砍比例（%）</th>
        <th class="text-c w100" data-sortname="">商品库存</th>
        <th class="text-c w100" data-sortname="">活动库存</th>
        <th class="text-c w100" data-sortname="">运费模板</th>
        <th class="text-c w100" data-sortname="">排序</th>
        <th class="w80 text-c" data-sortname="is_enable">状态</th>
        <th class="handle w120 p-l-0">操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($list as $item)
    <tr>
        <td class="tcheck">
            <input type="checkbox" class="checkBox" value="{{ $item->id }}"/>
        </td>
        <td class="f13">
            <div class="goodsPicBox pull-left m-r-10">
                <a href="{{ $item->goods_url }}" target="_blank">
                    <img src="{{ $item->goods_image }}" data-original="{{ $item->goods_image }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" class="goods-thumb lazy"/>
                </a>
            </div>
            <div class="ng-binding goods-message w180">
                <div class="name">
                    <a href="{{ $item->goods_url }}" class="goods_name" title="{{ $item->goods_name }}" target="_blank">{{ $item->goods_name }}</a>
                </div>
                <div class="pull-left">
                    <div>商品ID：{{ $item->goods_id }}</div>
                    <div>规格ID：{{ $item->sku_id }}</div>
                    <div>货　号：{{ $item->goods_sn }}</div>
                    <div>条　码：{{ $item->goods_barcode }}</div>
                </div>
                <div class="active">
                    <div class="QR-code popover-box" style="margin-top: 2px;">
                        <a href="javascript:void(0);" class="qrcode">
                            <i class="fa fa-qrcode"></i>
                        </a>
                        <div class="code-info popover-info">
                            <i class="fa fa-caret-left"></i>
                            <a href="/goods/default/download-qrcode?id={{ $item->goods_id }}">商品二维码</a>
                            <div style="padding: 10px; background-color: #fff; margin: 0;">
                                <div class="goods-qrcode" data-url="{{ $item->goods_url }}" style="width: 120px; height: 120px; margin: 0;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </td>
        <td>{{ $item->spec_names }}</td>
        <td class="text-c">{{ $item->goods_price }}</td>
        <td class="text-c">{{ $item->original_price }}</td>
        <td class="text-c">{{ $item->act_price }}</td>
        <td class="text-c">{{ $item->self_bargain_ratio }}</td>
        <td class="text-c">{{ $item->goods_number }}</td>
        <td class="text-c">{{ $item->act_stock }}</td>
        <td class="text-c">{{ $item->freight_name }}</td>
        <td class="text-c">{{ $item->sort }}</td>
        <td class="text-c">
            <span class="@if($item->is_enable) c-green @else c-red @endif">{{ $item->status_format }}</span>
        </td>
        <td class="handle p-l-0">
            @if($item->is_enable)
            <a class="set-disabled border-none" href="javascript:void(0);" data-id="{{ $item->id }}" data-store_id="0">取消商品</a>
            @endif
            <a href="/dashboard/plat-bargain/bargain-list?act_id={{ $item->act_id }}&amp;goods_id={{ $item->goods_id }}&amp;sku_id={{ $item->sku_id }}" target="_blank">砍价列表</a>
            <a href="/dashboard/bargain-order/list?act_id={{ $item->act_id }}&amp;goods_id={{ $item->goods_id }}&amp;sku_id={{ $item->sku_id }}&amp;order_type=8" target="_blank">砍价订单列表</a>
        </td>
    </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td class="text-c w10">
            <input type="checkbox" class="allCheckBox checkBox"/>
        </td>
        <td colspan="16">
            <div class="pull-left">
                <input type="button" class="btn btn-danger m-r-2 set-disabled" value="批量取消商品"/>
                <!--当没有选中任何所操作的项，按钮为禁用状态，将按钮样式btn-danger替换为disabled-->
                <input type="button" class="btn btn-primary m-r-2 batch-set-bargain" value="批量设置自砍比例">
            </div>
            <div class="pull-right page-box">
                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
