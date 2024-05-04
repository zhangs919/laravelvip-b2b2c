<div id="{{ $uuid }}" class="p-20">
    <div class="table-content m-t-10">
        <!-- 搜索 -->
        <form id="GoodsModel" class="form-horizontal" name="GoodsModel" action="/goods/list/set-user-discount?ids={{ $goods_ids }}" method="POST">
            @csrf

            <!-- 服务保障 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="goodsmodel-user_discount" class="col-sm-3 control-label">

                        <span class="ng-binding">会员打折：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">

                            <input type="hidden" name="GoodsModel[user_discount]" value="0"><div id="goodsmodel-user_discount" class="" name="GoodsModel[user_discount]"><label class="control-label cur-p m-r-10"><input type="radio" name="GoodsModel[user_discount]" value="0" checked> 不参与会员打折</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="GoodsModel[user_discount]" value="1"> 参与会员打折</label></div>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">指的是统一的会员折扣是否参与，参与和不参与会员折扣不影响自定义会员价</br>参与会员折扣，如果设置了自定义会员价，则自定义会员价生效，统一的会员折扣不起作用，如果未设置自定义会员价，则按统一的会员折扣进行计算</br>未设置自定义会员价，选择参与会员打折后，商品详情页的价格将根据登录会员的店铺内会员等级自动计算折扣</br>选择不参与会员打折，也未设置自定义会员价，则此商品在详情页不会根据登录会员自动计算会员在店铺内享受的会员折扣</br>店铺会员等级及折扣设置请到“会员><a href="/member/rank/list.html" target="_blank" class="c-blue">会员等级</a>”模块进行设置</div></div>
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
            $.post('/goods/list/set-discount', data, function(result) {
                if (result.code == 0) {
// 关闭对话框
                    $.closeAll();
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