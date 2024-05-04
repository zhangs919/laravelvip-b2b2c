<div id="{{ $uuid }}">
    <form id="assign_form" method="" action="" class="form-horizontal">
        <p class="m-b-10">
<span class="m-r-30">
订单总金额：
<strong class="order-amount m-r-5">￥{{ $info['order_amount'] }}</strong>
</span>
        </p>
        <h5 class="m-b-10">您可以选择指派发货的网点</h5>
        <div class="content">
            <!--搜索-->
            <div class="search-term m-b-10">
                <form id="searchForm" action="/trade/order/edit-order.html" method="GET">
                    <input type="hidden" name="from" value="list">
                    <input type="hidden" name="type" value="assign">
                    <input type="hidden" name="id" value="200">

                    <input type="hidden" id="uid" class="form-control" name="uid">
                    <div class="simple-form-field">
                        <div class="form-group">
                            <label class="control-label">
                                <span>关键字：</span>
                            </label>
                            <div class="form-control-wrap"><input type="text" id="keyword" class="form-control w250" name="keyword" placeholder="网点名称/网点联系电话/网点管理员账号"></div>
                        </div>
                    </div>
                    <div class="simple-form-field">
                        <div class="form-group">
                            <label class="control-label">
                                <span>网点地址：</span>
                            </label>
                            <div class="form-control-wrap"><input type="text" id="address" class="form-control" name="address"></div>
                        </div>
                    </div>
                    <div class="simple-form-field">
                        <a class="btn btn-primary m-r-5 search-store">搜索</a>
                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table id="table_list" class="table">
                    <thead>
                    <tr>
                        <th class="tcheck">
                            <input class="checkBox allCheckBox" type="checkbox">
                        </th>
                        <th class="w80" style="text-align: center;">编号</th>
                        <th class="w200">网点名称</th>
                        <th class="w300">网点信息</th>
                        <th class="w150">网点管理员</th>
                    </tr>
                    </thead>
                    <tbody class="store-list">
                    <tr>
                        <td class="tcheck">
                            <input name="store_ids[7]" class="checkBox" type="checkbox">
                        </td>
                        <td style="text-align: center;">7</td>
                        <td>看看</td>
                        <td>
                            <div class="ng-binding">
                                <span>地址： 丛台区柳林桥街道和平路邯郸第六医院</span>
                                <span>电话：13333333333</span>
                            </div>
                        </td>
                        <td>test2</td>
                    </tr>
                    <tr>
                        <td class="tcheck">
                            <input name="store_ids[6]" class="checkBox" type="checkbox">
                        </td>
                        <td style="text-align: center;">6</td>
                        <td>走西口</td>
                        <td>
                            <div class="ng-binding">
                                <span>地址： 绿园区东风街道十九街区</span>
                                <span>电话：14331546976</span>
                            </div>
                        </td>
                        <td>测试店铺hill</td>
                    </tr>
                    <tr>
                        <td class="tcheck">
                            <input name="store_ids[4]" class="checkBox" type="checkbox">
                        </td>
                        <td style="text-align: center;">4</td>
                        <td>123</td>
                        <td>
                            <div class="ng-binding">
                                <span>地址： 禅城区祖庙街道佛山禅城区祖庙街道气象服务站</span>
                                <span>电话：13035887777</span>
                            </div>
                        </td>
                        <td>decf123</td>
                    </tr>
                    <tr>
                        <td class="tcheck">
                            <input name="store_ids[1]" class="checkBox" type="checkbox">
                        </td>
                        <td style="text-align: center;">1</td>
                        <td>鲜农乐一号门店</td>
                        <td>
                            <div class="ng-binding">
                                <span>地址： 潘庄镇滤马庄村220号</span>
                                <span>电话：13111111111</span>
                            </div>
                        </td>
                        <td>测试网点</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <button id="btn_submit" type="button" class="btn btn-primary">确定</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        </div>

    </form>
</div>

<script type="text/javascript">
    $().ready(function() {

        $.loading.stop();

        var store_tablelist = $("#{{ $uuid }}").find("#table_list").tablelist();

        $("#{{ $uuid }}").find("#btn_submit").click(function() {
            var stores = $("#{{ $uuid }}").find("input[name^='store_ids']").serializeJson();

            if (!stores || !stores.store_ids) {
                $.msg("请选择网点！");
                return;
            }

            $.loading.start();

            $.post('/trade/order/assign.html', {
                id: '{{ $order_id }}',
                stores: stores,
            }, function(result) {
                if (result.code == 0) {
                    // 关闭对话框
                    $("#{{ $uuid }}").parents(".modal").find(".close").click();
                    // 显示信息
                    $.msg(result.message, {
                        time: 1500
                    }, function() {
                        if ('list' == 'list') {
                            if (typeof (tablelist) != "undefined" && tablelist) {
                                tablelist.load();
                            } else {
                                $.go("/trade/order/list.html");
                            }
                        } else {
                            $.go("/trade/order/info?id=" + '{{ $order_id }}');
                        }
                    });
                } else {
                    $.msg(result.message, {
                        time: 5000
                    });
                }
            }, 'json').always(function() {
                $.loading.stop();
            });
        });

        // 查询网点
        $(".search-store").click(function() {
            var keyword = $("#{{ $uuid }}").find("#keyword").val();
            var address = $("#{{ $uuid }}").find("#address").val();
            var id = '{{ $order_id }}';
            $.loading.start();
            $.post("/trade/order/search-store.html", {
                "keyword": keyword,
                "address": address,
                'id': id
            }, function(result) {
                if (result.code == 0) {
                    $(".store-list").html(result.data);
                }
            }, "json");
        });
    });
</script>