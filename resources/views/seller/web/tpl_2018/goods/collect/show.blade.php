{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20181020"/>
    <link href="/assets/d2eace91/js/ztree/zTreeStyle.css" rel="stylesheet">

@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30 clearfix">
        <form id="CollectModel" class="form-horizontal" name="CollectModel" action="/goods/collect/show" method="post"
              enctype="multipart/form-data">
        @csrf
        <!-- 采集商品id -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="collectmodel-goods_ids" class="col-sm-3 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">批量商品详情链接：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">


                            <textarea id="collectmodel-goods_ids" class="form-control w500"
                                      name="CollectModel[goods_ids]" rows="5"></textarea>


                        </div>

                        <div class="help-block help-block-t">
                            <div class="help-block help-block-t">多个商品详情链接，用回车隔开,<br>最多一次填写20条商品详情链接<br>eg:https://item.taobao.com/item.htm?<b>id=521436856623</b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 是否采集评论 -->
            <!-- <div class="simple-form-field" >
    <div class="form-group">
    <label for="collectmodel-is_comment" class="col-sm-4 control-label">

    <span class="ng-binding">采集评论：</span>
    </label>
    <div class="col-sm-8">
    <div class="form-control-box">
     -->

            <input type="hidden" id="collectmodel-is_comment" class="form-control" name="CollectModel[is_comment]">

            <!--
    </div>

    <div class="help-block help-block-t"><div class="help-block help-block-t">是否采集评论，如果是，仅采集前5条记录</div></div>
    </div>
    </div>
    </div> -->
            <!-- 是否采集销量 -->
            <!-- <div class="simple-form-field" >
    <div class="form-group">
    <label for="collectmodel-is_sale" class="col-sm-4 control-label">

    <span class="ng-binding">采集销量：</span>
    </label>
    <div class="col-sm-8">
    <div class="form-control-box">
     -->

            <input type="hidden" id="collectmodel-is_sale" class="form-control" name="CollectModel[is_sale]">

            <!--
    </div>

    <div class="help-block help-block-t"><div class="help-block help-block-t">是否采集第三方的销量</div></div>
    </div>
    </div>
    </div> -->
            <!-- 价格变动 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="ng-binding">价格变动：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <select class="form-control m-r-10" name="CollectModel[price][sige]">
                                <option value="1">+</option>
                                <option value="2">-</option>
                                <option value="3">*</option>
                                <option value="4">/</option>

                            </select>
                            <input class="form-control ipt" placeholder="" name="CollectModel[price][num]" min="0"
                                   number="true" type="text" value="0">
                        </div>
                        <div class="help-block help-block-t">在数字前台填写[+ - * /]表示算法，如原价调高2倍，则写成*2</div>
                    </div>
                </div>
            </div>
            <!-- 库存变动 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="ng-binding">商品库存：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <select class="form-control m-r-10" name="CollectModel[stock][sige]">
                                <option value="1">+</option>
                                <option value="2">-</option>
                                <option value="3">*</option>
                                <option value="4">/</option>

                            </select>
                            <input class="form-control ipt" placeholder="" name="CollectModel[stock][num]" type="text"
                                   value="0" data-rule-min="0" data-rule-digits="true">
                        </div>
                        <div class="help-block help-block-t">在数字前台填写[+ - * /]表示算法，如库存调高2倍，则写成*2</div>
                    </div>
                </div>
            </div>

            <!-- 所属分类 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="collectmodel-goods_category" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">放入商品分类：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <div id="cat_selector"></div>
                            <input type="hidden" id="collectmodel-goods_category" class="form-control" name="CollectModel[goods_category]">
                        </div>
                        <div class="help-block help-block-t"><div class="help-block help-block-t">选择采集的商品存入到商城的哪个商品分类下</div></div>
                    </div>
                </div>
            </div>
            <!-- 所属类型 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="collectmodel-goods_type" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">放入商品类型：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <select id="uploadmodel-type" name="CollectModel[goods_type]" class="chosen-select"
                                    style="display: none;">

                                <option value="">-- 请选择 --</option>
                                @foreach($goods_type_list as $item)
                                    <option value="{{ $item->type_id }}">{{ $item->type_name }}</option>
                                @endforeach

                            </select>

                        </div>

                        <div class="help-block help-block-t">
                            <div class="help-block help-block-t">选择采集的商品存入到商城的哪个商品类型下</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 运费模板 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="collectmodel-freight_id" class="col-sm-3 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">运费模板：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">


                            <select id="collectmodel-freight_id" class="form-control m-r-5 freight-list"
                                    name="CollectModel[freight_id]">
                                <option value="">--请选择--</option>
                                <option value="0">店铺统一运费（￥{{ $shop_freight_fee }}）</option>
                                @foreach($freight_list as $v)
                                    <option value="{{ $v['freight_id'] }}">{{ $v['title'] }}</option>
                                @endforeach
                            </select>
                            <div class="btn-group m-r-2">
                                <button type="button" data-toggle="dropdown" aria-expanded="true"
                                        class="btn btn-warning btn-sm dropdown-toggle">
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
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="collectmodel-shop_cat_ids" class="col-sm-3 control-label">

                        <span class="ng-binding">店铺内商品分类：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">

                            <div class="control-label div-scroll" style="min-width: 150px;">

                                @foreach($shop_category_list as $k=>$v)
                                    <label>

                                        <input type="checkbox" name="CollectModel[shop_cat_ids][]"
                                               value="{{ $v['cat_id'] }}"
                                               @if($v['cat_level'] == 2)class="cat-two"@endif>

                                        {{ $v['cat_name'] }}
                                    </label>
                                @endforeach

                            </div>

                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 是否上架 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="collectmodel-goods_status" class="col-sm-4 control-label">

                        <span class="ng-binding">是否上架：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="CollectModel[goods_status]" value="0"><label><input
                                                type="checkbox" id="collectmodel-goods_status" class="form-control b-n"
                                                name="CollectModel[goods_status]" value="1" data-on-text="是"
                                                data-off-text="否"> </label>
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t">
                            <div class="help-block help-block-t">默认采集导入到产品中的商品是下架的</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 计价方式 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="collectmodel-pricing_mode" class="col-sm-3 control-label">

                        <span class="ng-binding">计价方式：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">


                            <input type="hidden" name="CollectModel[pricing_mode]" value="">
                            <div id="collectmodel-pricing_mode" class="" name="CollectModel[pricing_mode]"><label
                                        class="control-label cur-p m-r-10"><input type="radio"
                                                                                  name="CollectModel[pricing_mode]"
                                                                                  value="0" checked> 计件</label>
                                <label class="control-label cur-p m-r-10"><input type="radio"
                                                                                 name="CollectModel[pricing_mode]"
                                                                                 value="1"> 计重</label></div>


                        </div>

                        <div class="help-block help-block-t">
                            <div class="help-block help-block-t">称重商品，请选择计重</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 销售模式 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="collectmodel-sales_model" class="col-sm-3 control-label">
                        <span class="ng-binding">销售模式：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">
                            <input type="hidden" name="CollectModel[sales_model]" value="">
                            <div id="collectmodel-sales_model" class="" name="CollectModel[sales_model]"><label
                                        class="control-label cur-p m-r-10"><input type="radio"
                                                                                  name="CollectModel[sales_model]"
                                                                                  value="0" checked=""> 零售</label>
                                <label class="control-label cur-p m-r-10"><input type="radio"
                                                                                 name="CollectModel[sales_model]"
                                                                                 value="1"> 批发</label></div>
                        </div>
                        <div class="help-block help-block-t">
                            <div class="help-block help-block-t">
                                “零售型”适用于多规格、且有可能规格价格不一的商品，但零售商品不可设置购买数量阶梯价格段；“批发型”适用于多规格但价格统一的商品，此类型可设定整体购买数量阶梯价格段规则。根据选择的销售模式不同，销售规则将对应改变；销售模式一旦设置，即不可修改。
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 提交按钮 -->
            <div class="bottom-btn p-b-30">
                <input id="btn_submit" type="button" value="立即采集" class="btn btn-primary btn-lg">
            </div>
        </form>
    </div>

@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block--}}
@section('extra_html')

@stop


{{--helper_tool--}}
@section('helper_tool')

@stop


{{--footer script page元素同级下面--}}
@section('footer_script')
    <script src="/assets/d2eace91/min/js/validate.min.js?v=1.0"></script>
    <script src="/assets/d2eace91/min/js/upload.min.js?v=1.0"></script>
    <script src="/assets/d2eace91/js/ztree/jquery.ztree.all-3.5.min.js?v=1.0"></script>
    <script src="/js/common.js?v=1.0"></script>
    <script src="/assets/d2eace91/bootstrap/switch/js/bootstrap-switch.min.js?v=1.0"></script>
    <script src="/assets/d2eace91/js/chosen/jquery.chosen.js?v=1.0"></script>
    <script src="/assets/d2eace91/min/js/message.min.js?v=1.0"></script>

    <!-- 验证规则 -->
    <script id="client_rules" type="text">
[{"id": "collectmodel-goods_ids", "name": "CollectModel[goods_ids]", "attribute": "goods_ids", "rules": {"required":true,"messages":{"required":"批量商品详情链接不能为空。"}}},{"id": "collectmodel-goods_category", "name": "CollectModel[goods_category]", "attribute": "goods_category", "rules": {"required":true,"messages":{"required":"放入商品分类不能为空。"}}},{"id": "collectmodel-goods_type", "name": "CollectModel[goods_type]", "attribute": "goods_type", "rules": {"required":true,"messages":{"required":"放入商品类型不能为空。"}}},{"id": "collectmodel-freight_id", "name": "CollectModel[freight_id]", "attribute": "freight_id", "rules": {"required":true,"messages":{"required":"运费模板不能为空。"}}},{"id": "collectmodel-is_comment", "name": "CollectModel[is_comment]", "attribute": "is_comment", "rules": {"default":0,"messages":{"default":""}}},{"id": "collectmodel-is_sale", "name": "CollectModel[is_sale]", "attribute": "is_sale", "rules": {"default":0,"messages":{"default":""}}}]
</script>
    <script type="text/javascript">

        $().ready(function () {
            //悬浮显示上下步骤按钮
            window.onscroll = function () {
                $(window).scroll(function () {
                    var scrollTop = $(document).scrollTop();
                    var height = $(".page").height();
                    var wHeight = $(window).height();
                    if (scrollTop > (height - wHeight)) {
                        $(".bottom-btn").removeClass("bottom-btn-fixed");
                    } else {
                        $(".bottom-btn").addClass("bottom-btn-fixed");
                    }
                });

            };
            var validator = $("#CollectModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function () {
                if (!validator.form()) {
                    return;
                }
                if (1) {
                    //加载提示
                    $.loading.start();
                    $("#CollectModel").submit();
                } else {
                    $.msg("店铺可采集条数已经不足，请联系平台方！", {
                        time: 5000
                    });
                }
            });

            // 刷新运费模板
            $(".refresh-freight-list").click(function () {
                $.loading.start();
                $.get('/goods/publish/freights', {}, function (result) {
                    $.loading.stop();
                    if (result.code == 0) {
                        var html = "<option value=''>--请选择--</option>";

                        for (var i = 0; i < result.data.length; i++) {
                            var item = result.data[i];
                            html += "<option value='" + item.freight_id + "'>" + item.title + "</option>";
                        }

                        $("#collectmodel-freight_id").html(html);
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "json");
            });

            var catselector = $("#cat_selector").catselector({
                size: 1,
                data: {
                    deep: 3
                },
                addCallback: function(id, name, treeNode) {
                    if(treeNode.isParent){
                        $.msg("请选择末级分类！");
                        this.remove(id);
                        this.ztree.cancelSelectedNode(treeNode);
                        $("#collectmodel-goods_category").val("").valid();
                        return;
                    }
                    $("#collectmodel-goods_category").val(id).valid();
                }
            });
            catselector.load();

        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop