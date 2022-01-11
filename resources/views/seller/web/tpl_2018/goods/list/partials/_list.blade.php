<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck">
            <input type="checkbox" />
        </th>
        <th class="text-c" data-sortname="goods_id">编号</th>
        <th data-sortname="goods_name">商品名称</th>
        <th data-sortname="goods_price">本店价（元）</th>
        <th data-sortname="goods_number">库存</th>
        <th class="text-c" data-sortname="goods_status">状态</th>
        <th data-sortname="add_time">发布时间</th>
        <th class="handle">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
    <tr>
        <td class="tcheck">
            <input type="checkbox" class="checkbox" value="{{ $v->goods_id }}">
            </input>
        </td>
        <td class="text-c">{{ $v->goods_id }}</td>
        <td>
            <div class="goodsPicBox pull-left m-r-10">
                <a href="{{ route('pc_show_goods', ['goods_id'=>$v->goods_id]) }}" target="_blank">
                    <!-- 图片缩略图 -->
                    <img src="{{ get_image_url($v->goods_image) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" class="goods-thumb" />
                    <!-- 虚拟商品 -->

                </a>
            </div>
            <div class="ng-binding goods-message">
                <div class="name">
                    <a href="{{ route('pc_show_goods', ['goods_id'=>$v->goods_id]) }}" class="goods_name" data-goods_id={{ $v->goods_id }} target="_blank">{{ $v->goods_name }}</a>
                    @if($v->is_sku)
                        <label class="label label-warning m-l-5" title="此商品为多规格商品">SKU</label>
                    @endif
                    <a href="javascript:void(0);" class="goods_name_controller c-blue m-l-5">修改</a>
                </div>
                <div class="active">
                    <!--判断是否发布手机端宝贝详情：
                                        默认、未发布（为灰色小图标）：默认的给class值goods-mobile
                                        已发布（为蓝色小图标）:在默认的基础上追加class值open
                                        注意：在已发布及未发布的小图标鼠标经过的title值有所不同
                        -->

                    <div class="goods-mobile">
                        <a href="javascript:void(0);" data-toggle="tooltip" data-placement="auto bottom" title="此宝贝尚未发布手机端宝贝详情">
                            <i class="fa fa-tablet"></i>
                        </a>
                    </div>

                    <div class="QR-code popover-box">
                        <a href="javascript:;" class="qrcode">
                            <i class="fa fa-qrcode"></i>
                        </a>
                        <div class="code-info popover-info">
                            <i class="fa fa-caret-left"></i>
                            <a href="/goods/default/download-qrcode?id={{ $v->goods_id }}">商品二维码</a>
                            <p>
                                <img src="/assets/d2eace91/images/common/loading_90_90.gif" data-src="/goods/default/qrcode?id={{ $v->goods_id }}" />
                            </p>
                        </div>
                    </div>
                    <!--新加批发 start-->
                    <div class="pull-left">

                        <label class="model-label blue">零售</label>

                    </div>
                    <!--新加 end-->
                    <!--以下为区分不同的活动，分别给不同的活动名称不同的背景颜色(对注释下面的div追加以下class名)：
                                            积分： exchange
                                            拍卖： auction
                                            预售： pre-sale
                                            0元购：zero-buy
                                            众筹： crowdfund
                                            促销活动: pro-sale

                        <div class="goods-active pre-sale">
                            <a href="" target="_blank" title="该商品参与XX预售活动，点击进入商品详情页查看">预售</a>
                        </div>
                         -->
                </div>
                <div>
                    <!--新加产品库-->


                </div>
            </div>
        </td>



        <td>
            @if($v->is_sku)
                {{ $v->goods_price }}
            @else
                <a href="javascript:void(0);" class="goods_price" data-goods_id={{ $v->goods_id }}>{{ $v->goods_price }}</a>
            @endif
        </td>

        <td>
            @if($v->is_sku)
                <font>{{ $v->goods_number }}</font>
            @else
                <a href="javascript:void(0);" class="goods_number" data-goods_id="{{ $v->goods_id }}" > {{ $v->goods_number }} </a>
            @endif
        </td>



        <td class="text-c">
            <!-- 审核未通过的商品不显示商品状态 -->


            <font class="c-green">出售中</font>



        </td>
        <td>
            {{ $v->created_at->format('Y-m-d') }}
            <br />
            {{ $v->created_at->format('H:i:s') }}
        </td>
        <td class="handle">
            <a href="javascript:void(0);" class="sku-list" data-goods-id="{{ $v->goods_id }}">SKU</a>
            <span>|</span>
            <a href="{{ route('pc_show_goods', ['goods_id'=>$v->goods_id]) }}" target="_blank">查看</a>
            <span>|</span>
            <!-- 零售商品可以设置会员价 -->

            <a href="javascript:void(0);" class="sku_member" data-goods-id="{{ $v->goods_id }}">会员价</a>


            </br>
            <a href="/goods/publish/edit?id={{ $v->goods_id }}&scid=0" target="_blank">编辑</a>
            <!-- <span>|</span>
                <a href="javascript:void(0);">复制</a> -->


            <span>|</span>
            <a href="javascript:void(0);" data-id="{{ $v->goods_id }}" class="offsale-goods del">下架</a>

            <span>|</span>
            <a href="javascript:void(0);" data-id="{{ $v->goods_id }}" class="del border-none delete-goods">删除</a>

            <span>|</span>
            <a href="javascript:void(0);" class="remark" data-id="{{ $v->goods_id }}">备注</a>
        </td>
    </tr>

    @if(!empty($v->goods_remark))
        <tr>
            <td colspan="8" class="">

                @foreach($v->goods_remark as $gr)
                <p class="m-b-10">
                    <span class="m-r-20">备注人：{{ $gr['admin_name'] }}</span>
                    <span class="m-r-20">备注时间：{{ $gr['created_at'] }}</span>
                    <span class="m-r-30">备注内容：{!! $gr['content'] !!}</span>
                </p>
                @endforeach

            </td>
        </tr>
    @endif
    <!--
        <tr>
            <td colspan="9" class="table-merge">
                <div class="border-dashed"></div>
                <div class="labelBox">
                    <span class="label-item add-label">+添加标签</span>
                    <span class="label-item">
                        新品
                        <i class="fa">×</i>
                    </span>
                    <span class="label-item">
                        精品
                        <i class="fa">×</i>
                    </span>
                    <span class="label-item">
                        热销
                        <i class="fa">×</i>
                    </span>
                </div>
            </td>
        </tr>
        -->
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td class="text-c w10">
            <input type="checkbox" class="checkBox" />
        </td>
        <td colspan="7">
            <div class="pull-left">
                <div class="btn-group dropup m-r-2">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        批量操作
                        <span class="caret m-l-5"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a class="onsale-goods">商品上架</a>
                        </li>
                        <li>
                            <a class="offsale-goods">商品下架</a>
                        </li>
                        <li>
                            <a class="move-goods">转移商城商品分类</a>
                        </li>
                        <li>
                            <a class="move-shop-goods">转移店铺商品分类</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="goods-tag">打标签</a>
                        </li>
                        <li>
                            <a class="goods-unit">商品单位</a>
                        </li>
                        <li>
                            <a class="goods-pricing-mode">计价方式</a>
                        </li>
                        <li>
                            <a class="goods-moq">最小起订量</a>
                        </li>
                        <li>
                            <a class="invoice-type">开具发票</a>
                        </li>
                        <li>
                            <a class="goods-layout">详情版式</a>
                        </li>
                        <li>
                            <a class="contract">服务保障</a>
                        </li>
                        <li>
                            <a class="sku-member">会员价</a>
                        </li>
                        <li>
                            <a class="goods-freight">运费设置</a>
                        </li>
                        <li>
                            <a class="set-price">调整价格</a>
                        </li>
                    </ul>
                </div>
                <input type="button" class="btn btn-danger m-r-2 delete-goods" value="批量删除" />
                <!--当没有选中任何所操作的项，按钮为禁用状态，将按钮样式btn-danger替换为disabled-->
            </div>
            <div class="pull-right page-box">


                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>



