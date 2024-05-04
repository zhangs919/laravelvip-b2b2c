<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <!---<th class="tcheck">
            <input type="checkbox" class="checkBox allCheckBox" />
        </th>-->
        <th class="text-c w80" data-sortname="site_id" data-sortorder="asc" style="cursor: pointer;">站点ID<span class="sort"></span></th>
        <th class="w200" data-sortname="" style="cursor: default;">站点名称</th>
        <th class="w200" data-sortname="" style="cursor: default;">站点地区</th>
        <th class="w200" data-sortname="" style="cursor: default;">站点网址</th>
        <th class="w200" data-sortname="" style="cursor: default;">站点管理员</th>
        <th class="w200" data-sortname="" style="cursor: default;">创建时间</th>
        <th class="w200" data-sortname="" style="cursor: default;">到期时间</th>
        <th class="text-c w100" data-sortname="" style="cursor: default;">站点状态</th>
        <th class="text-c w100" data-sortname="" style="cursor: default;">是否默认</th>
        <th class="handle w150" style="cursor: default;">操作</th>
    </tr>
    </thead>
    <tbody>

    <tr>
        <!--<td class="tcheck">
            <input type="checkbox" class="checkBox" />
        </td>-->
        <td class="text-c">1</td>
        <td>北京站</td>
        <td>北京市-北京市</td>
        <td>http://bj.lrw.com/index</td>
        <td>bj_admin</td>
        <td>2019-10-16</td>
        <td>永久</td>

        <td class="text-c">
            <span data-action="set-status?id=23" class="ico-switch open" data-value='[0,1]' data-label='["\u5173\u95ed","\u5f00\u542f"]' data-class='["fa fa-toggle-off","fa fa-toggle-on"]'><i class="fa fa-toggle-on"></i>开启</span>
        </td>
        <td class="text-c">
            <span data-action="set-default?id=23" class="ico-switch open" data-value='[0,1]' data-label='["\u5173\u95ed","\u5f00\u542f"]' data-class='["fa fa-toggle-off","fa fa-toggle-on"]'><i class="fa fa-toggle-on"></i>开启</span>
        </td>

        <td class="handle">
            <a href="edit?id=1">编辑</a>
            <span>|</span>
            <a href="">一键登录站点后台</a>
            <span>|</span>
            <a href="javascript:void(0);" object_id="1" class="del border-none">删除</a>
        </td>
    </tr>



    </tbody>
    <tfoot>
    <tr>
        <td colspan="10">
            <div class="pull-right page-box">


                <div id="pagination">
                    <script data-page-json="true" type="text">
	{"page_key":"page","page_id":"pagination","default_page_size":10,"cur_page":1,"page_size":10,"page_size_list":[10,50,500,1000],"record_count":11,"page_count":2,"offset":0,"url":null,"sql":null}
</script>


                    <div class="pagination-info">
                        共11条记录

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


                        <!--   -->

                        <li>
                            <a href="javascript:void(0);" data-go-page="2">2</a>
                        </li>







                        <li>
                            <a class="fa fa-angle-right" data-go-page="2" title="下一页"></a>
                        </li>

                        <li class="" style="display: none;">
                            <a class="fa fa-angle-double-right" data-go-page="2" title="最后一页"></a>
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
