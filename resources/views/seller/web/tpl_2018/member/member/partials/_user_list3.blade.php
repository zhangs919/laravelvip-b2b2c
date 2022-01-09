<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <!--复选框列样式tcheck，一般复选框样式checkBox,全选复选框样式在一般复选框样式后再新加allCheckBox样式-->
        <th class="tcheck w10">
            <input type="checkbox" class="checkBox allCheckBox" />
        </th>
        <!--   -->
        <th class="w100 text-c" data-sortname="user_id">编号</th>
        <th class="w300" data-sortname="user_name">会员信息</th>
        <th class="w150" data-sortname="add_time">
            收录时间
            <span class="sort"></span>
        </th>

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
        <td colspan="4">
            <!---->
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
