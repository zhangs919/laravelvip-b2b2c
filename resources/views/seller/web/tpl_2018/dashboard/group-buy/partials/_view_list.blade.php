<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="w300" data-sortname="goods_name">商品名称</th>
        <th class="w150">所属分类</th>
        <th class="w100" data-sortname="act_price">活动价格</th>
        <th class="w100" data-sortname="sale_base">销量基数</th>
        <th class="w100" data-sortname="act_stock">活动库存</th>
        <th class="handle w100">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
    <tr>
        <td>
            <div class="goodsPicBox pull-left m-r-10">
                <a href="{{ route('pc_show_goods',['goods_id'=>$v['goods_id']]) }}" target="_blank">
                    <!-- 图片缩略图 -->
                    <img src="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" class="goods-thumb" />
                </a>
            </div>
            <div class="ng-binding goods-message w200">
                <div class="name">
                    <a href="{{ route('pc_show_goods',['goods_id'=>$v['goods_id']]) }}" target="_blank"  title="{{ $v['goods_name'] }}">{{ $v['goods_name'] }}</a>
                </div>
                <div class="active">
                    <div class="QR-code popover-box">
                        <a href="javascript:;" class="qrcode">
                            <i class="fa fa-qrcode"></i>
                        </a>
                        <div class="code-info popover-info">
                            <i class="fa fa-caret-left"></i>
                            <a href="/goods/default/download-qrcode?id={{ $v['goods_id'] }}">商品二维码</a>
                            <p>
                                <img src="/assets/d2eace91/images/common/loading_90_90.gif" data-src="/goods/default/qrcode?id={{ $v['goods_id'] }}" />
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </td>
        <td>{{ $v['cat_name'] }}</td>
        <td>￥{{ $v['act_price'] }}</td>
        <td>{{ $v['sale_base'] }}</td>
        <td>{{ $v['act_stock'] }}</td>
        <td class="handle">
            --
        </td>
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td colspan="6">
            <div class="pull-right page-box">


                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>