<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck">
            <input type="checkbox" class="checkBox allCheckBox"></input>
        </th>
        <th class="w300" data-sortname="shop_name">店铺信息</th>
        <th class="text-c w100" data-sortname="user_name">店主帐号</th>
        <th class="w100" data-sortname="credit">申请时间</th>
        <th class="w120" data-sortname="cat_id">店铺所属分类</th>
        <th class="text-c w100" data-sortname="duration">开店时长</th>
        <th class="w150" data-sortname="insure_fee">待支付费用</th>
        <th class="text-c w100" data-sortname="shop_audit">审核状态</th>
        <!--操作列样式handle-->
        <th class="handle w120">操作</th>
    </tr>
    </thead>
    <tbody>

    <tr>
        <td class="tcheck">
            <input type="checkbox" class="checkBox" value="73" />
        </td>
        <td>
            <div class="userPicBox pull-left m-r-10">
                <img src="http://images.68mall.com/system/config/default_image/default_shop_image_0.gif" class="user-avatar"></img>
            </div>
            <div class="ng-binding user-message w200">
                <span class="name" title="阿里巴巴"> 店铺名称：阿里巴巴 </span>

                <span class="id">
								店铺ID：73
								<font class="c-green m-l-10"> 个人店铺 </font>
							</span>
            </div>
        </td>
        <td class="text-c">SZY151SNQR5155</td>
        <td>2018-10-10 14:30:55</td>
        <!-- 店铺所属分类 -->
        <td>家用电器<br></td>
        <!-- 开店时长 -->
        <td class="text-c">1 年</td>
        <td>
            <div class="ng-binding">
							<span>
								平台使用费：
								<font class=" m-r-5">3000.00</font>
								元
							</span>
                <span>
								平台保证金：
								<font class=" m-r-5">10000.00</font>
								元
							</span>
            </div>
        </td>
        <td class="text-c">

            <font class="c-red">待审核</font>

        </td>
        <td class="handle">
            <a href="apply-edit?id=73&shop_type=1&audit=0&is_supply=0">编辑</a>
            <span>|</span>
            <a href="javascript:void(0);" object_id="73" id="del" class="del">删除</a>

            <a href="audit?id=73&audit=1&is_supply=0" data-confirm="您确定通过【阿里巴巴】的申请吗？" class="active">通过</a>
            <span>|</span>
            <a href="apply-edit?id=73&shop_type=1&audit=2&is_supply=0" class="del active">拒绝</a>



        </td>
    </tr>

    </tbody>
    <tfoot>
    <tr>
        <td class="text-c w10">
            <input type="checkbox" class="allCheckBox checkBox" />
        </td>
        <td colspan="8">

            <div class="pull-left">
                <input type="button" id="batch-pass" class="btn btn-primary" value="通过审核" />
            </div>

            <div class="pull-right page-box">


                <div id="pagination">
                    <script data-page-json="true" type="text">
	{"page_key":"page","page_id":"pagination","default_page_size":10,"cur_page":1,"page_size":10,"page_size_list":[10,50,500,1000],"record_count":1,"page_count":1,"offset":0,"url":null,"sql":null}
</script>


                    <div class="pagination-info">
                        共1条记录

                        ，每页显示：
                        <select class="select m-r-5" data-page-size="10">


                            <option value="10" selected="selected">10</option>



                            <option value="50">50</option>



                            <option value="500">500</option>



                            <option value="1000">1000</option>


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

                </div>
            </div>
        </td>
    </tr>
    </tfoot>
</table>
