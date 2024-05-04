{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
    <link href="/assets/d2eace91/js/ztree/zTreeStyle.css" rel="stylesheet">
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30 clearfix">
        <form id="CollectModel" class="form-horizontal" name="CollectModel" action="/goods/collect/show" method="post" enctype="multipart/form-data" novalidate="novalidate">
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


                            <textarea id="collectmodel-goods_ids" class="form-control w500" name="CollectModel[goods_ids]" rows="5"></textarea>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">多个商品详情链接，用回车隔开,<br>最多一次填写20条商品详情链接<br>eg:https://item.taobao.com/item.htm?<b>id=521436856623</b></div></div>
                    </div>
                </div>
            </div>
            <!-- 是否采集评论 -->
            <!--<div class="simple-form-field" >
<div class="form-group">
<label for="collectmodel-is_comment" class="col-sm-4 control-label">
<span class="text-danger ng-binding">*</span>
<span class="ng-binding">采集评论：</span>
</label>
<div class="col-sm-8">
<div class="form-control-box">
-->

            <!--<label class="control-label control-label-switch">
<div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
<input type="hidden" name="CollectModel[is_comment]" value="0"><label><input type="checkbox" id="collectmodel-is_comment" class="form-control b-n" name="CollectModel[is_comment]" value="1" data-on-text="是" data-off-text="否"> </label>
</div>
</label>-->
            <input type="hidden" id="collectmodel-is_comment" class="form-control" name="CollectModel[is_comment]" value="0">

            <!--
</div>

<div class="help-block help-block-t"><div class="help-block help-block-t">是否采集评论，如果是，仅采集前5条记录</div></div>
</div>
</div>
</div>-->
            <!-- 是否采集销量 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="collectmodel-is_sale" class="col-sm-4 control-label">

                        <span class="ng-binding">采集销量：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="CollectModel[is_sale]" value="0">
                                    <label>
                                        <input type="checkbox" id="collectmodel-is_sale" class="form-control b-n"
                                               name="CollectModel[is_sale]" value="1" data-on-text="是" data-off-text="否">
                                    </label>
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">是否采集第三方的销量</div></div>
                    </div>
                </div>
            </div>
            <!-- 价格变动 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label"><span class="ng-binding">价格变动：</span> </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <select class="form-control m-r-10" name="CollectModel[price][sige]">
                                <option value="1">+</option>
                                <option value="2">-</option>
                                <option value="3">*</option>
                                <option value="4">/</option>

                            </select>
                            <input class="form-control ipt" placeholder="" name="CollectModel[price][num]" min="0" number="true" type="text" value="0">
                        </div>
                        <div class="help-block help-block-t">在数字前台填写[+ - * /]表示算法，如原价调高2倍，则写成*2</div>
                    </div>
                </div>
            </div>
            <!-- 库存变动 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label"><span class="ng-binding">商品库存：</span> </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <select class="form-control m-r-10" name="CollectModel[stock][sige]">
                                <option value="1">+</option>
                                <option value="2">-</option>
                                <option value="3">*</option>
                                <option value="4">/</option>

                            </select>
                            <input class="form-control ipt" placeholder="" name="CollectModel[stock][num]" type="text" value="0" data-rule-min="0" data-rule-digits="true">
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

                        <div class="help-block help-block-t"><div class="help-block help-block-t">选择采集的商品存入到商城的哪个商品类型下</div></div>
                    </div>
                </div>
            </div>
            <!-- 系统产品库分类 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="collectmodel-lib_cat_ids" class="col-sm-4 control-label">

                        <span class="ng-binding">商品库商品分类：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <select id="libgoodsmodel-lib_cat_id" class="form-control chosen-select"
                                    name="CollectModel[lib_cat_ids]" style="display: none;">

                                @foreach($lib_category_list as $k=>$v)
                                    <option value="{{ $k }}" @if(0 == $k)selected="selected"@endif @if($v['has_child'])disabled="true"@endif>{!! $v['cat_name'] !!}</option>
                                @endforeach

                            </select>

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
                                    <input type="hidden" name="CollectModel[goods_status]" value="0">
                                    <label>
                                        <input type="checkbox"
                                               id="collectmodel-goods_status"
                                               class="form-control b-n"
                                               name="CollectModel[goods_status]"
                                               value="1" data-on-text="是"
                                               data-off-text="否">
                                    </label>
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">默认采集导入到产品中的商品是下架的</div></div>
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

{{--extra html block page元素同级下面--}}
@section('extra_html')

@stop

{{--helper_tool--}}
@section('helper_tool')

@stop

{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer script page元素同级下面--}}
@section('footer_script')

    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/ztree/jquery.ztree.all-3.5.min.js?v=1.0"></script>

    <!-- 验证规则 -->
    <script id="client_rules" type="text">
        [{"id": "collectmodel-goods_ids", "name": "CollectModel[goods_ids]", "attribute": "goods_ids", "rules": {"required":true,"messages":{"required":"批量商品详情链接不能为空。"}}},{"id": "collectmodel-goods_category", "name": "CollectModel[goods_category]", "attribute": "goods_category", "rules": {"required":true,"messages":{"required":"放入商品分类不能为空。"}}},{"id": "collectmodel-goods_type", "name": "CollectModel[goods_type]", "attribute": "goods_type", "rules": {"required":true,"messages":{"required":"放入商品类型不能为空。"}}},{"id": "collectmodel-is_comment", "name": "CollectModel[is_comment]", "attribute": "is_comment", "rules": {"required":true,"messages":{"required":"采集评论不能为空。"}}},]
    </script>
    <script type="text/javascript">
        $().ready(function() {
            //悬浮显示上下步骤按钮
            window.onscroll = function() {
                $(window).scroll(function() {
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
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                if({{ $can_collect }}){
                    //加载提示
                    $.loading.start();
                    $("#CollectModel").submit();
                }else{
                    $.msg("{!! $collect_msg !!}", {
                        time: 5000
                    });
                }
            });

            // 刷新运费模板
            $(".refresh-freight-list").click(function() {
                $.loading.start();
                $.get('/goods/publish/freights', {}, function(result) {
                    $.loading.stop();
                    if (result.code == 0) {
                        var html = "<option value=''>--请选择--</option>";

                        for (var i = 0; i < result.data.length; i++) {
                            var item = result.data[i];
                            html += "<option value='"+item.freight_id+"'>" + item.title + "</option>";
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