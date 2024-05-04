<div id="{{ $uuid }}">
    <form id="delivery_model" class="form-horizontal" action="/trade/order/edit-order.html?from=list&type=delivery&id={{ $order_id }}" method="post">
        @csrf
        <h5 class="m-b-10">您可以选择本次待发货的商品部分发货</h5>
        <div class="content">
            <div class="table-responsive">
                <table class="table">
                    <colgroup>
                        <!--商品信息-->
                        <col class="w300">
                        </col>
                        <!--数量-->
                        <col class="w70">
                        </col>
                        <!--已发货数量-->
                        <col class="w100">
                        </col>
                        <!--发货数量-->
                        <col class="w100">
                        </col>
                    </colgroup>
                    <thead>
                    <tr>
                        <th>商品信息</th>
                        <th>数量</th>
                        <th>已发货数量</th>
                        <th>发货数量</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($info['goods_list'] as $key=>$goods)
                    <tr class="order-item">
                        <td class="item">
                            <div class="pic-info">
                                <a href="{{ route('pc_show_goods', ['goods_id'=>$goods['goods_id']]) }}" class="goods-thumb" title="查看商品详情" target="_blank">
                                    <img src="{{ get_image_url($goods['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" alt="查看商品详情" />
                                </a>
                            </div>
                            <div class="txt-info w200">
                                <div class="desc">
                                    <a class="goods-name" href="{{ route('pc_show_goods', ['goods_id'=>$goods['goods_id']]) }}" target="_blank" title="查看商品详情">{{ $goods['goods_name'] }}</a>
                                    <!-- <a class="snap">【交易快照】</a> -->
                                </div>


                            </div>
                        </td>

                        <td class="num">{{ $goods['goods_number'] }}</td>{{--商品数量--}}
                        <td class="num">0</td>{{--已发货数--}}
                        <td class="num">
                            <input name='delivery_goods[{{ $goods['record_id'] }}]' class="form-control small" onkeyup="value=value.replace(/[^\d]/g,'')" type="text" value="1" />
                        </td>

                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <input name="id" type="hidden" value="{{ $order_id }}" />
            <input name="type" type="hidden" value="delivery" />
            <button type="button" id='btn_submit' class="btn btn-primary">确定</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        </div>
    </form>
</div>

<!-- 表单验证 -->
<script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180027"></script>
<script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180027"></script>
<script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180027"></script>
<script type="text/javascript">
    $().ready(function() {
        /**
         * 初始化validator默认值
         */
        $.validator.setDefaults({
            errorPlacement: function(error, element) {
                var error_id = $(error).attr("id");
                var error_msg = $(error).text();
                var element_id = $(error).attr("for");

                if ($.trim(error_msg) == 0) {
                    return;
                }

                $.msg(error_msg);
            }
        });

        var validator = $("#{{ $uuid }}").find("#delivery_model").validate();

        $("#{{ $uuid }}").find("#btn_submit").click(function() {
            if (!validator.form()) {
                return;
            } else {

                var data = $("#{{ $uuid }}").find("#delivery_model").serializeJson();

//加载提示
                $.loading.start();

                $.post('/trade/order/edit-order', data, function(result) {
// 关闭对话框
                    $("#{{ $uuid }}").parents(".modal").find(".close").click();
// 显示信息
                    if (result.code == 0) {
                        $.msg(result.message, {
                            time: 1500
                        }, function() {
// 直接去发货页面
                            $.go('/trade/delivery/to-shipping.html?id=' + result.data.delivery_id);
                        });
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "json").always(function() {
                    $.loading.stop();
                });
            }
        });

    });
</script>