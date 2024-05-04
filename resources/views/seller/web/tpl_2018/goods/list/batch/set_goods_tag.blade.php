<div id="{{ $uuid }}" class="p-20">
    <div class="table-content m-t-10">
        <!-- 搜索 -->
        <form id="GoodsModel" class="form-horizontal" name="GoodsModel"
              action="/goods/list/set-goods-tag?ids={{ $goods_ids }}" method="POST">
            @csrf
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="goodsmodel-tag_id" class="col-sm-3 control-label">

                        <span class="ng-binding">商品标签：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">

                            <select id="goodsmodel-tag_id" class="form-control chosen-select" name="GoodsModel[tag_id]">
                                <option value="0">-- 请选择 --</option>
                                @foreach($goods_tag as $v)
                                    <option value="{{ $v['tag_id'] }}">{{ $v['tag_name'] }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <input type="hidden" id="{{ $uuid }}_goods_ids" name="goods_ids" value="{{ $goods_ids }}"/>
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
            var goods_ids = $("#{{ $uuid }}_goods_ids").val();
            var data = $("#GoodsModel").serializeJson();
            console.info(goods_ids);
            $.post('/goods/list/set-tag', data, function (result) {
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