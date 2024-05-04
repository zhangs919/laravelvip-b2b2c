<div class="simple-form-field" id="table_list">
    <div class="form-group">
        <label for="text4" class="col-sm-4 control-label">
            <span class="ng-binding"></span>
        </label>
        <div class="col-sm-8">
            <div class="form-control-box w700">
                <table class="table table-hover m-b-0">
                    <thead>
                    <tr>
                        <th class="w250">商品名称</th>
                        <th class="w100">所属分类</th>
                        <th class="w70">活动价格</th>
                        <th class="w100">虚拟销售数量</th>
                        <th class="w70">活动库存</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($goods_activity as $v)
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
                        </tr>
                    @endforeach

                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="5">
                            <div class="pull-right page-box">
                                {!! $pageHtml !!}

                            </div>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

