<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck">
            <input type="checkbox" class="checkBox allCheckBox" />
        </th>
        <th class="text-c w60">商品ID</th>
        <th class="w300">商品名称</th>
        <th class="text-c w70">活动图片</th>
        <th class="text-c w80">拼团价</th>
        <th class="text-c w80">店铺价</th>
        <th class="text-c w70">参团人数</th>
        <th class="text-c w70">活动库存</th>
        <th class="text-c w150">活动有效时间</th>
        <th class="text-c w70">活动状态</th>
        <th class="handle w120">操作</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td class="tcheck">
            <input type="checkbox" class="checkBox" value="95" />
        </td>
        <td class="text-c">250</td>
        <td>
            <div class="goodsPicBox pull-left m-r-10">
                <a href="http://www.mall.laravelvip.com/goods-250.html" target="_blank">
                    <!-- 图片缩略图 -->
                    <img src="http://xxx.oss-cn-beijing.aliyuncs.com/images/15164/backend/gallery/2019/01/05/15466928132839.jpg?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" class="goods-thumb"></img>
                </a>
            </div>
            <div class="ng-binding goods-message w200">
                <div class="name">
                    <a href="http://www.mall.laravelvip.com/goods-250.html" target="_blank" data-toggle="tooltip" data-placement="auto bottom" title="金色喀秋莎1000克/包玉米面条">金色喀秋莎1000克/包玉米面条</a>
                </div>
                <div class="active">
                    <div class="QR-code popover-box">
                        <a href="javascript:;" class="qrcode">
                            <i class="fa fa-qrcode"></i>
                        </a>
                        <div class="code-info popover-info">
                            <i class="fa fa-caret-left"></i>
                            <a href="/goods/default/download-qrcode?id=250">商品二维码</a>
                            <p>
                                <img src="/assets/d2eace91/images/common/loading_90_90.gif" data-src="/goods/default/qrcode?id=250" />
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </td>
        <td class="text-c">
            <a href="javascript:void(0);" ref="http://xxx.oss-cn-beijing.aliyuncs.com/images/15164/shop/1/images/2019/01/11/15471852565412.jpg" class="preview">
                <i class="fa fa-picture-o"></i>
            </a>
            <span class="btn btn-success btn-xs pos-r upload-img" data-url="upload-act_img" data-id="95"> 更换 </span>
        </td>
        <td class="text-c">￥6.00</td>
        <td class="text-c">￥90.00</td>
        <td class="text-c">2</td>
        <td class="text-c">10</td>
        <td class="text-c">
            2019-01-11 13:40:36
            <br>
            ~
            <br>
            2019-01-18 13:40:36
        </td>
        <td class="text-c">
            <font class="c-999"> 已结束 </font>
        </td>
        <td class="handle">
            <a href="view?id=95" class="border-none">查看</a>
            <span>|</span>

            <a href="javascript:;" class="border-none del" data-id="95">删除</a>
        </td>
    </tr>

    </tbody>
    <tfoot>
    <tr>
        <td class="text-c w10">
            <input type="checkbox" class="checkBox" />
        </td>
        <td colspan="10">
            <div class="pull-left">
                <input type="button" class="btn btn-danger m-r-2 batch-del" value="批量删除" />
            </div>
            <div class="pull-right page-box">


                <div id="pagination">
                    <script data-page-json="true" type="text">
	{"page_key":"page","page_id":"pagination","default_page_size":10,"cur_page":1,"page_size":10,"page_size_list":[10,50,500],"record_count":10,"page_count":1,"offset":0,"url":null,"sql":null}
</script>


                    <div class="pagination-info">
                        共10条记录，每页显示：
                        <select class="select m-r-5" data-page-size="10">


                            <option value="10" selected="selected">10</option>



                            <option value="50">50</option>



                            <option value="500">500</option>


                        </select>
                        条
                    </div>

                    <ul class="pagination">
                        <li class="disabled" style="display: none;">
                            <a class="fa fa-angle-double-left" data-go-page="1" title="第一页"></a>
                        </li>

                        <li class="disabled">
                            <a class="fa fa-angle-left" title="上一页"></a>
                        </li>








                        <!--   -->

                        <li class="active">
                            <a data-cur-page="1">1</a>
                        </li>







                        <li class="disabled">
                            <a class="fa fa-angle-right" title="下一页"></a>
                        </li>

                        <li class="disabled" style="display: none;">
                            <a class="fa fa-angle-double-right" data-go-page="1" title="最后一页"></a>
                        </li>
                    </ul>

                    <div class="pagination-goto">
                        <input class="ipt form-control goto-input" type="text">
                        <button class="btn btn-default goto-button" title="点击跳转到指定页面">GO</button>
                        <a class="goto-link" data-go-page="" style="display: none;"></a>
                    </div>
                    <script type="text/javascript">
                        $().ready(function() {
                            $(".pagination-goto > .goto-input").keyup(function(e) {
                                $(".pagination-goto > .goto-link").attr("data-go-page", $(this).val());
                                if (e.keyCode == 13) {
                                    $(".pagination-goto > .goto-link").click();
                                }
                            });
                            $(".pagination-goto > .goto-button").click(function() {
                                var page = $(".pagination-goto > .goto-link").attr("data-go-page");
                                if ($.trim(page) == '') {
                                    return false;
                                }
                                $(".pagination-goto > .goto-link").attr("data-go-page", page);
                                $(".pagination-goto > .goto-link").click();
                                return false;
                            });
                        });
                    </script>

                </div>						</div>
        </td>
    </tr>
    </tfoot>
</table>
