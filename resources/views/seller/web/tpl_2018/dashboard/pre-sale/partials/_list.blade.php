<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck">
            <input type="checkbox" class="checkBox allCheckBox" />
        </th>
        <th class="text-c w60">编号</th>
        <th class="w250">商品信息</th>
        <th class="text-c w100">店铺价（元）</th>
        <th class="text-c w100">预售价（元）</th>
        <th class="text-c w80">预售类型</th>
        <th class="w250">预售详情</th>
        <th class="w100">审核状态</th>
        <th class="text-c w80">活动状态</th>
        <th class="handle w120">操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($list as $v)
    <tr>
        <td class="tcheck">
            <input type="checkbox" class="checkBox" value="1074" />
        </td>
        <td class="text-c">1</td>
        <td>
            <div class="goodsPicBox pull-left m-r-10">
                <a href="http://www.xxx.com/goods-292.html" target="_blank">
                    <!-- 图片缩略图 -->
                    <img src="http://xxxx?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" class="goods-thumb"></img>
                </a>
            </div>
            <div class="ng-binding goods-message w150">
                <div class="name">
                    <a href="http://www.xxxx.com/goods-292.html" target="_blank" data-toggle="tooltip" data-placement="auto bottom" title="12345699999999999999">12345699999999999999</a>
                </div>
                <div class="active">
                    <div class="QR-code popover-box">
                        <a href="javascript:;" class="qrcode">
                            <i class="fa fa-qrcode"></i>
                        </a>
                        <div class="code-info popover-info">
                            <i class="fa fa-caret-left"></i>
                            <a href="/goods/default/download-qrcode?id=292">商品二维码</a>
                            <p>
                                <img src="/assets/e8b2e423/images/common/loading_90_90.gif" data-src="/goods/default/qrcode?id=292" />
                            </p>
                        </div>
                    </div>
                </div>
                <div class="active">商品ID：292</div>
            </div>
        </td>
        <td class="text-c">1.00</td>
        <td class="text-c">2.00</td>
        <td class="text-c">定金预售</td>
        <td class="">
            开始时间：2019-06-09
            <br />
            结束时间：2019-06-16
            <br />
            发货时间：付款后5天后发货						<br />
            限购数量：3件					</td>
        <td class="">
            <font class="c-yellow"> 待审核 </font>

        </td>
        <td class="text-c">
            <font class="c-red"> 未开始 </font>
        </td>
        <td class="handle">
            <a href="javascript:void(0)" class="border-none sku-list" data-goods_id="292" data-act_id="1074" data-pre_sale_mode="1">SKU</a>
            <span>|</span>
            <a href="edit?id=1074" class="border-none">编辑</a>
            <span>|</span>
            <a href="javascript:;" class="border-none del" data-id="1074">删除</a>
        </td>
    </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td class="text-c w10">
            <input type="checkbox" class="checkBox" />
        </td>
        <td colspan="9">
            <div class="pull-left">
                <input type="button" class="btn btn-danger m-r-2 batch-del" value="批量删除" />
            </div>
            <div class="pull-right page-box">


                {!! $pageHtml !!}

            </div>
        </td>
    </tr>
    </tfoot>
</table>
