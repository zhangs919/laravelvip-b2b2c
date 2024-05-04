<div id="{{ $uuid }}" class="p-20">
    <div class="table-content m-t-10">
        <!-- 搜索 -->
        <form id="GoodsModel" class="form-horizontal" name="GoodsModel"
              action="/goods/list/set-goods-stock-mode?ids={{ $goods_ids }}" method="POST">
            @csrf
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="goodsmodel-stock_mode" class="col-sm-3 control-label">

                        <span class="ng-binding">库存计数：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">

                            <input type="hidden" name="GoodsModel[stock_mode]" value="0">
                            <div id="goodsmodel-stock_mode" class="" name="GoodsModel[stock_mode]">
                                <label class="control-label cur-p m-r-10"><input type="radio"
                                                                                 name="GoodsModel[stock_mode]" value="0"
                                                                                 checked> 拍下减库存</label>
                                <label class="control-label cur-p m-r-10"><input type="radio"
                                                                                 name="GoodsModel[stock_mode]"
                                                                                 value="1"> 付款减库存</label>
                                <label class="control-label cur-p m-r-10"><input type="radio"
                                                                                 name="GoodsModel[stock_mode]"
                                                                                 value="2"> 出库减库存</label></div>


                        </div>

                        <div class="help-block help-block-t">
                            <div class="help-block help-block-t">拍下减库存：买家拍下商品即减少库存，存在恶拍风险。热销商品如需避免超卖可选此方式</br>
                                付款减库存：买家拍下并完成付款方可减少库存，存在超卖风险。如需减少恶拍、提高回款效率，可选此方式；货到付款时将在卖家确认订单时减库存</br>
                                出库减库存：卖家发货时减库存，如果库存充实，需要确保线上库存与线下库存保持一致，可选此方式
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" id="goods_ids" name="goods_ids" value="{{ $goods_ids }}"/>
        </form>
        <div class="modal-footer text-c">
            <button id="btn_next_step" class="btn btn-primary">确认提交</button>
        </div>
    </div>
</div>
<script type='text/javascript'>
    //点击下一步
    $().ready(function () {
        $("#{{ $uuid }}").find("#btn_next_step").click(function () {
            var goods_ids = $("#goods_ids").val();
            var data = $("#GoodsModel").serializeJson();
            $.post('/goods/list/set-stock-mode', data, function (result) {
                if (result.code == 0) {
// 关闭对话框
                    $.closeAll();
// 显示信息
                    $.msg(result.message, {
                        time: 1500
                    }, function () {
                        if (typeof (tablelist) != "undefined" && tablelist) {
                            tablelist.load();
                        } else {
                            $.go('/goods/list');
                        }
                    });
                } else {
                    $.msg(result.message, {
                        time: 5000
                    });
                }
            }, "json");
        })
    });
</script>