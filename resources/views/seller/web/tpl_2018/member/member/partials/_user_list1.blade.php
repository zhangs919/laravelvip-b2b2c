<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <!--复选框列样式tcheck，一般复选框样式checkBox,全选复选框样式在一般复选框样式后再新加allCheckBox样式-->
        <th class="tcheck w10">
            <input type="checkbox" class="checkBox allCheckBox" />
        </th>

        <!--排序样式sort默认，asc升序，desc降序-->
        <th class="w70 text-c" data-sortname="user_id">编号</th>
        <th class="w300" data-sortname="user_name">会员信息</th>
        <!--<th class="text-c" data-sortname="e.type">
            个人/企业
            <span class="sort"></span>
        </th>-->
        <th class="w100" data-sortname="rank_name">
            会员等级
            <span class="sort"></span>
        </th>
        <th class="w90" data-sortname="tradin">
            交易总额
            <span class="sort"></span>
        </th>
        <th class="w90" data-sortname="tradin_count">
            交易笔数
            <span class="sort"></span>
        </th>
        <th class="w100" data-sortname="tradin_avg">
            平均交易额
            <span class="sort"></span>
        </th>
        <th class="w120" data-sortname="last_tradin">
            上次交易时间
            <span class="sort"></span>
        </th>
        <th class="handle w150">操作</th>
        <!-- -->
    </tr>
    </thead>
    <tbody>
    <!--以下为循环内容-->
    <!---->
    <!---->
    <!---->
    </tbody>
    <tfoot>
    <tr>
        <!--<td class="text-c w10">
            <input type="checkbox" class="allCheckBox checkBox" />
        </td>  -->
        <!---->
        <td colspan="9">
            <!---->
            <!---->
            <div class="pull-left">
                <!--暂无-->
                <select class="form-control w100 m-r-5" style="display: none">
                    <option value="0">请选择批量设置项</option>
                    <option value="1">会员等级</option>
                    <option value="2">会员折扣</option>
                    <option value="3">禁止购买</option>
                </select>
                <!-- <button id="delete-all" class="btn btn-danger mr5" type="button" data-action="delete-all">批量设置</button>		<button class="btn btn-default disabled mr5" type="button">禁用</button>
                <button class="btn btn-default" type="button">按钮1</button> -->
            </div>
            <!---->
            <div id="pagination" class="pull-right page-box">


                <div id="pagination">
                    <script data-page-json="true" type="text">
	{"page_key":"page","page_id":"pagination","default_page_size":10,"cur_page":1,"page_size":10,"page_size_list":[10,50,500,1000],"record_count":0,"page_count":0,"offset":0,"url":null,"sql":null}
</script>


                    <div class="pagination-info">
                        共0条记录，每页显示：
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













                        <li class="disabled">
                            <a class="fa fa-angle-right" title="下一页"></a>
                        </li>

                        <li class="disabled" style="display: none;">
                            <a class="fa fa-angle-double-right" data-go-page="0" title="最后一页"></a>
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