<div id='{{ $uuid }}'>
    <div class="table-content">
        <!-- 搜索 -->
        <form id="GoodsModel" class="form-horizontal" name="GoodsModel" action="/goods/list/set-goods-invoice-type?ids={{ $goods_ids }}" method="POST">
            @csrf
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="goodsmodel-invoice_type" class="col-sm-3 control-label">

                        <span class="ng-binding">发票：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">

                            <input type="hidden" name="GoodsModel[invoice_type]" value="0">
                            <div id="goodsmodel-invoice_type" class="" name="GoodsModel[invoice_type]">
                                <label class="control-label cur-p m-r-10"><input type="radio" name="GoodsModel[invoice_type]" value="0" checked> 无</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="GoodsModel[invoice_type]" value="1"> 增值税普通发票</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="GoodsModel[invoice_type]" value="2"> 增值税专用发票</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="GoodsModel[invoice_type]" value="3"> 增值税普通发票 和 增值税专用发票</label></div>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">选择“无”则将不提供发票</div></div>
                    </div>
                </div>
            </div>	<input type="hidden" id="goods_ids" name="goods_ids" value="{{ $goods_ids }}" />
        </form>	<div class="modal-footer text-c">
            <button id="btn_next_step" class="btn btn-primary">确认提交</button>
        </div>
    </div>
</div>
<script type='text/javascript'>
    //点击下一步
    $().ready(function() {
        $("#{{ $uuid }}").find("#btn_next_step").click(function() {
            var goods_ids = $("#goods_ids").val();
            var data = $("#GoodsModel").serializeJson();
            $.post('/goods/list/set-invoice-type', data, function(result) {
                if (result.code == 0) {
// 关闭对话框
                    $("#{{ $uuid }}").parents(".modal").find(".close").click();
// 显示信息
                    $.msg(result.message, {
                        time: 1500
                    }, function() {
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