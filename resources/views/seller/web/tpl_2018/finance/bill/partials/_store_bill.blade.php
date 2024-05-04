<link href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet"><!-- ================== BEGIN BASE  ================== -->
<!-- ================== END BASE  ================== -->
<input type="hidden" name="type" id="type" value="0">
<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck">
            <input type="checkbox" class="checkBox allCheckBox">
            </input>
        </th>
        <th class="w100">起止时间</th>
        <th class="w100">所属网点</th>
        <th class="w80 text-c">订单</br>总数量</th>
        <th class="colspan-th" >
            <div class="colspan-div" style="width: 550px;">
                <p class="text-c">网点应收金额</p>
                <p>
                    <span class="w90 text-c">付款金额</br>（不含运费）</span>
                    <span class="w70 text-c">平台承担</br>活动款</span>
                    <span class="w40 text-c">运费</span>
                    <span class="w40 text-c">额外</br>配送费</span>
                    <span class="w40 text-c">包装费</span>
                    <span class="w40 text-c">积分</br>抵扣</span>
                    <span class="w40 text-c">平台</br>佣金</span>
                    <span class="w40 text-c">店铺</br>佣金</span>
                    <span class="w40 text-c">佣金</br>比例</span>
                </p>
            </div>
        </th>
        <th class="w80 text-c">网点</br>金额</th>
        <th class="w80 text-c">结算</br>状态</th>
        <th class="handle w100">操作</th>
    </tr>
    </thead>
    <tbody>
    <!--以下为循环内容-->
    </tbody>
    <tfoot>
    <tr>
        <td class="text-c w10">
            <input type="checkbox" class="allCheckBox checkBox">
            </input>
        </td>
        <td colspan="7">
            <div class="pull-left">
                <!--当没有选中任何所操作的项，按钮为禁用状态，将按钮样式btn-danger替换为disabled-->
                <!-- <button class="btn btn-default m-r-5" type="button">批量结算</button> -->
                <!-- <button class="btn btn-default m-r-5 apply_count" type="button">批量统计</button> -->
                <!-- <button class="btn btn-default m-r-5" type="button">批量导出</button> -->
            </div>
            <div class="pull-right page-box">
                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
<script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js"></script>
<script>

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

    //
</script>