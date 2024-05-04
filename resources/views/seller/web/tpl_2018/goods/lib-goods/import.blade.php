<div class="modal-body">
    <form id="form" class="form-horizontal" name="BatchEditModel" action="/goods/lib-goods/import.html?ids={{ $ids }}&single=1" method="post">
        @csrf
        <div class="table-content clearfix">
            <input type="hidden" name="ids" value="{{ $ids }}">
            <!-- 商品价格 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="batcheditmodel-goods_price" class="col-sm-3 control-label">

                        <span class="ng-binding">商品价格：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">


                            <input type="text" id="batcheditmodel-goods_price" class="form-control ipt m-r-10" name="BatchEditModel[goods_price]" value="">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">未填写任何值，则采集的商品价格默认为采集的商品价格，一旦设置价格，则所有的规格商品价格全部按此处设置的价格进行设置。</div></div>
                    </div>
                </div>
            </div>
            <!-- 商品库存 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="batcheditmodel-goods_number" class="col-sm-3 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">商品库存：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">


                            <input type="text" id="batcheditmodel-goods_number" class="form-control ipt m-r-10" name="BatchEditModel[goods_number]" value="0">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 运费模板 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="batcheditmodel-freight_id" class="col-sm-3 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">运费设置：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">


                            <select id="batcheditmodel-freight_id" class="form-control m-r-5 freight-list w150" name="BatchEditModel[freight_id]">
                                <option value="0">店铺统一运费（￥{{ $shop_freight_fee }}）</option>
                                @foreach($freight_list as $v)
                                    <option value="{{ $v['freight_id'] }}">{{ $v['title'] }}</option>
                                @endforeach
                            </select>
                            <div class="btn-group m-r-2">
                                <button type="button" data-toggle="dropdown" aria-expanded="true" class="btn btn-warning btn-sm dropdown-toggle">
                                    新建运费模板
                                    <span class="caret m-l-5"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="/shop/freight/add" target="_blank">新建全国模板</a>
                                    </li>
                                    <li>
                                        <a href="/shop/freight/map-add" target="_blank">新建同城模板</a>
                                    </li>
                                </ul>
                            </div>
                            <a href="javascript:void(0);" class="btn btn-primary btn-sm refresh-freight-list">重新加载</a>

                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 店铺内商品分类 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">

                        <span class="ng-binding">店铺商品分类：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">

                            <div class="control-label div-scroll" style="min-width: 250px; height: 180px;">

                                @foreach($shop_category_list as $k=>$v)
                                    <label>

                                        <input type="checkbox" name="CollectModel[shop_cat_ids][]"
                                               value="{{ $v['cat_id'] }}"
                                               @if($v['cat_level'] == 2)class="cat-two"@endif>

                                        {{ $v['cat_name'] }}
                                    </label>
                                @endforeach

                            </div>
                            <div class="help-block help-block-t">如果选择店铺商品分类，则按照选择的进行设置，如果没有选择店铺商品分类，则系统商品库所属的系统商品库商品分类名称自动与店铺商品 分类匹配，只要名称相同，店铺商品分类就被选中</div>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>
<!-- 表单验证 -->
<script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180027"></script>
<script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180027"></script>
<script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180027"></script>
<!-- 验证规则 -->
<script id="client_rules" type="text">
[{"id": "batcheditmodel-goods_number", "name": "BatchEditModel[goods_number]", "attribute": "goods_number", "rules": {"required":true,"messages":{"required":"商品库存不能为空。"}}},{"id": "batcheditmodel-freight_id", "name": "BatchEditModel[freight_id]", "attribute": "freight_id", "rules": {"required":true,"messages":{"required":"运费设置不能为空。"}}},{"id": "batcheditmodel-goods_number", "name": "BatchEditModel[goods_number]", "attribute": "goods_number", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品库存必须为大于0的整数","min":"商品库存必须不小于0。"},"min":0}},{"id": "batcheditmodel-goods_price", "name": "BatchEditModel[goods_price]", "attribute": "goods_price", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"商品价格必须为大于0的整数或小数","min":"商品价格必须不小于0。"},"min":0}},]
</script>
<script type="text/javascript">
    var validator = null;
    $().ready(function() {
        validator = $("#form").validate();
// 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules($("#client_rules").html());

// 刷新运费模板
        $(".refresh-freight-list").click(function() {
            $.loading.start();
            $.get('/goods/publish/freights', {}, function(result) {
                $.loading.stop();
                if (result.code == 0) {
                    var html = "<option value='0'>店铺统一运费（" + result.shop_freight_fee_format + "）</option>";

                    for (var i = 0; i < result.data.length; i++) {
                        var item = result.data[i];
                        html += "<option value='"+item.freight_id+"'>" + item.title + "</option>";
                    }

                    $("#batcheditmodel-freight_id").html(html);
                } else {
                    $.msg(result.message, {
                        time: 5000
                    });
                }
            }, "json");
        });
    });
</script>