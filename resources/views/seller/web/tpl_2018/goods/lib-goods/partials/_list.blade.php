<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck">
            <input type="checkbox" class="checkbox" />
        </th>
        <th class="text-c w100" data-sortname="goods_id">编号</th>
        <th class="w300" data-sortname="goods_name">商品名称</th>
        <th class="w200" data-sortname="">商品库商品分类</th>
        <th class="text-c w150" data-sortname="goods_price">本店价（元）</th>
        <th class="w150" data-sortname="add_time">发布时间</th>
        <th class="handle w200">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
    <tr>
        <td class="tcheck">

            <input type="checkbox" class="checkbox" value="{{ $v->goods_id }}" />

        </td>
        <td class="text-c">{{ $v->goods_id }}</td>
        <td>
            <div class="goodsPicBox pull-left m-r-10">
                <a href="javascript:void(0);">
                    <!-- 图片缩略图 -->
                    <img src="{{ get_image_url($v->goods_image,'goods_image') }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" class="goods-thumb" />
                    <!-- 虚拟商品 -->

                </a>
            </div>
            <div class="ng-binding goods-message w200">
                <div class="name">
                    <a href="javascript:void(0);" title="{{ $v->goods_name }}">{{ $v->goods_name }}</a>

                    @if($v->is_sku)
                        <label class="label label-warning m-l-5" title="此商品为多规格商品">SKU</label>
                    @endif
                </div>
                <div class="active">

                    @if($v->has_imported)
                    <label class="product-label">已导入</label>
                    @endif

                    <div class="goods-mobile @if(!empty($v->mobile_desc)) open @endif">
                        <a href="javascript:void(0);" data-toggle="tooltip" data-placement="auto bottom" title="此宝贝@if(empty($v->mobile_desc))尚未@else已@endif发布手机端宝贝详情">
                            <i class="fa fa-tablet"></i>
                        </a>
                    </div>

                    <div class="QR-code popover-box">
                        <a href="javascript:;" class="qrcode">
                            <i class="fa fa-qrcode"></i>
                        </a>
                        <div class="code-info popover-info">
                            <i class="fa fa-caret-left"></i>
                            <a href="/goods/lib-goods/download-qrcode?id={{ $v->goods_id }}">商品二维码</a>
                            <p>
                                <img src="/assets/d2eace91/images/common/loading_90_90.gif" data-src="/goods/lib-goods/qrcode?id={{ $v->goods_id }}" />
                            </p>
                        </div>
                    </div>
                    <div class="pull-left">

                        <label class="model-label blue">零售</label>

                    </div>
                </div>
            </div>
        </td>
        <td class=""></td>
        <td class="text-c">{{ $v->goods_price }}</td>
        <td>{{ $v->created_at }}</td>
        <td class="handle">
            <a href="javascript:void(0);" class="sku-list" data-goods-id="{{ $v->goods_id }}">SKU</a>
            <span>|</span>

            <a href="javascript:void(0);" data-id="{{ $v->goods_id }}" data-single="1" class="import">@if(!$v->has_imported)导入@else重新导入@endif</a>


            <a href="{{ route('pc_show_lib_goods', ['goods_id'=>$v->goods_id]) }}" target="_blank">预览</a>
        </td>
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td class="text-c w10">
            <input type="checkbox" class="checkBox" />
        </td>
        <td colspan="6">
            <div class="pull-left">
                <input type="button" class="btn btn-default m-r-2 import" value="批量导入" />
            </div>
            <div class="pull-right page-box">
                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
