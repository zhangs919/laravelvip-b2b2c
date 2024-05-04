<div id="{{ $uuid }}" class="p-20">
    <div class="table-content m-t-10">
        <!-- 搜索 -->
        <form id="GoodsModel" class="form-horizontal" name="GoodsModel"
              action="/goods/list/set-goods-pricing-mode?ids={{ $goods_ids }}" method="POST">
            @csrf
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="goodsmodel-pricing_mode" class="col-sm-3 control-label">

                        <span class="ng-binding">计价方式：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">

                            <input type="hidden" name="GoodsModel[pricing_mode]" value="0">
                            <div id="goodsmodel-pricing_mode" class="" name="GoodsModel[pricing_mode]"><label
                                        class="control-label cur-p m-r-10"><input type="radio"
                                                                                  name="GoodsModel[pricing_mode]"
                                                                                  value="0" checked> 计件</label>
                                <label class="control-label cur-p m-r-10"><input type="radio"
                                                                                 name="GoodsModel[pricing_mode]"
                                                                                 value="1"> 计重</label></div>


                        </div>

                        <div class="help-block help-block-t"></div>
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
            $.post('/goods/list/set-pricing-mode', data, function (result) {
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