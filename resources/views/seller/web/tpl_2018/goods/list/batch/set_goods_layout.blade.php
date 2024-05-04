<div id='{{ $uuid }}'>
    <div class="table-content">
        <!-- 搜索 -->
        <form id="GoodsModel" class="form-horizontal" name="GoodsModel" action="/goods/list/set-goods-layout?ids={{ $goods_ids }}"
              method="POST">
        @csrf
        <!-- 商品详情模板 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="" class="col-sm-5 control-label">

                        <span class="ng-binding">顶部模板：</span>
                    </label>
                    <div class="col-sm-7">
                        <div class="form-control-box">

                            <select id="goods-top_layout_id" class="form-control m-l-5 m-r-20"
                                    name="GoodsModel[top_layout_id]" data-layout-position="0">
                                @foreach($top_layouts as $k=>$v)
                                    <option value="{{ $k }}">{{ $v }}</option>
                                @endforeach
                            </select>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="" class="col-sm-5 control-label">

                        <span class="ng-binding">底部模板：</span>
                    </label>
                    <div class="col-sm-7">
                        <div class="form-control-box">

                            <select id="goods-bottom_layout_id" class="form-control m-l-5"
                                    name="GoodsModel[bottom_layout_id]" data-layout-position="1">
                                @foreach($bottom_layouts as $k=>$v)
                                    <option value="{{ $k }}">{{ $v }}</option>
                                @endforeach
                            </select>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>    <!-- 商品详情模板 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="" class="col-sm-5 control-label">

                        <span class="ng-binding">包装清单版式：</span>
                    </label>
                    <div class="col-sm-7">
                        <div class="form-control-box">

                            <select id="goods-packing_layout_id" class="form-control m-l-5 m-r-20"
                                    name="GoodsModel[packing_layout_id]" data-layout-position="2">
                                @foreach($packing_layouts as $k=>$v)
                                    <option value="{{ $k }}">{{ $v }}</option>
                                @endforeach
                            </select>
                            <!-- -->

                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="" class="col-sm-5 control-label">

                        <span class="ng-binding">售后保障版式：</span>
                    </label>
                    <div class="col-sm-7">
                        <div class="form-control-box">

                            <select id="goods-service_layout_id" class="form-control m-l-5"
                                    name="GoodsModel[service_layout_id]" data-layout-position="3">
                                @foreach($service_layouts as $k=>$v)
                                    <option value="{{ $k }}">{{ $v }}</option>
                                @endforeach
                            </select>
                            <!-- -->

                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <input type="hidden" id="goods_ids" name="goods_ids" value="{{ $goods_ids }}"/>
        </form>
        <div class="modal-footer text-c">
            <button id="btn_next_step" class="btn btn-primary">添加详情版式</button>
        </div>
    </div>
</div>
<script type='text/javascript'>
    $().ready(function () {
//点击下一步
        $("#{{ $uuid }}").find("#btn_next_step").click(function () {
            var goods_ids = $("#{{ $uuid }}").find("#goods_ids").val();
            var data = $("#{{ $uuid }}").find("#GoodsModel").serializeJson();
            $.post('/goods/list/set-layout', data, function (result) {
                if (result.code == 0) {
// 关闭对话框
                    $("#{{ $uuid }}").parents(".modal").find(".close").click();
// 展示信息
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
        });
    });
</script>