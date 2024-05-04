<div class="table-responsive ">


    <table class="table">
        <colgroup>
            <col class="item-list-col0">
            </col>

            <!--商品信息-->
            <col class="item-list-col1">
            </col>



            <!--数量-->
            <col class="item-list-col3">
            </col>



            <!--买家信息-->
            <col class="item-list-col5">
            </col>

            <!--交易状态-->
            <col class="item-list-col6">
            </col>




            <!--评价-->
            <col class="item-list-col8 w60">
            </col>


            <!--操作-->
            <col class="item-list-col9">
            </col>

        </colgroup>
        <thead>
        <tr>
            <!--复选框列样式tcheck，一般复选框样式checkBox,全选复选框样式在一般复选框样式后再新加allCheckBox样式-->
            <th class="tcheck">
                <input type="checkbox" class="checkBox allCheckBox">
                </input>
            </th>
            <!--排序样式sort默认，asc升序，desc降序-->
            <th>商品信息</th>

            <th class="text-c">数量</th>

            <th class="text-c w130">买家</th>
            <th class="text-c">交易状态</th>


            <th class="text-c">评价</th>

            <!--操作列样式handle-->
            <th class="handle text-c">操作</th>
        </tr>
        </thead>
        <tbody style="display: none">
        <!--新加操作按钮，可批量操作，默认或没有选择的时候，是为禁用的状态（将按钮btn-default样式替换为disabled），当点击复选时，为可操作状态-->
        <tr>
            <!--此年colspan="10",10代表着表格table的列数-->
            <th colspan="10">
                <div class="pull-left">

                    <button class="btn btn-default m-r-2" type="button">批量打印订单</button>
                    <button class="btn btn-default m-r-2" type="button">批量打印快递单</button>
                    <span class="text-explode m-r-5 m-l-5">|</span>
                    <label class="input-label">
                        <input class="checkBox m-r-5" type="checkbox" />
                        不显示已关闭的订单
                    </label>
                </div>
                <div class="pull-right">
                    <button onclick="prePage()" class="btn disabled m-r-2" type="button">上一页</button>
                    <button onclick="nextPage()" class="btn btn-default" type="button">下一页</button>
                </div>
            </th>
        </tr>
        </tbody>
        <tbody class="tbody-nodata">
        <tr>
            <td class="no-data" colspan="7">
                <i class="fa fa-exclamation-circle"></i>
                没有符合条件的记录
            </td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
            <td class="text-c w10">
                <input type="checkbox" class="allCheckBox checkBox hide">
            </td>
            <td colspan="6">
                <div class="pull-left hide">
                    <a class="btn btn-danger" href="javascript:;">批量删除</a>
                </div>

                <div id="pagination" class="pull-right page-box">


                    {!! $pageHtml !!}
                </div>
            </td>
        </tr>
        </tfoot>
    </table>


</div>