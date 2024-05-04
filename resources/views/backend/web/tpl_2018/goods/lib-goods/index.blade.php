{{--模板继承--}}
@extends('layouts.app')

@section('header_style')
    <style type="text/css">.highslide img {cursor: url(/assets/d2eace91/js/pic/graphics/zoomin.cur), pointer !important;}.highslide-viewport-size {position: fixed; width: 100%; height: 100%; left: 0; top: 0}</style><link href="/assets/d2eace91/js/editor/themes/default/default.css" rel="stylesheet">
@stop

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
    <!-- 图片弹窗  star-->
    <link rel="stylesheet" href="/assets/d2eace91/css/highslide.css?v=1.2">
    <script src="/assets/d2eace91/js/pic/highslide-with-gallery.js?v=1.2"></script>

    <script>
        //图片弹窗
        hs.graphicsDir = '/assets/d2eace91/js/pic/graphics/';
        hs.align = 'center';
        hs.transitions = ['expand', 'crossfade'];
        hs.outlineType = 'rounded-white';
        hs.fadeInOut = true;

        hs.addSlideshow({
            interval: 5000,
            repeat: false,
            useControls: true,
            fixedControls: 'fit',
            overlayOptions: {
                opacity: .75,
                position: 'bottom center',
                hideOnMouseOut: true
            }
        });
    </script>
    <!-- 图片弹窗  end-->
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <div class="table-content">

        <!--步骤-->
        <ul class="add-goods-step">
            <li id="step_1">
                <i class="fa fa-list-alt step"></i>
                <h6>STEP.1</h6>
                <h2>选择商品分类</h2>
                <i class="fa fa-angle-right"></i>
            </li>
            <li id="step_2" class="current">
                <i class="fa fa-edit step"></i>
                <h6>STEP.2</h6>
                <h2>填写商品详情</h2>
                <i class="fa fa-angle-right"></i>
            </li>
            <li id="step_3">
                <i class="fa fa-image step"></i>
                <h6>STEP.3</h6>
                <h2>上传商品图片</h2>
                <i class="fa fa-angle-right"></i>
            </li>
            <li id="step_4">
                <i class="fa fa-check-square-o step"></i>
                <h6>STEP.4</h6>
                <h2>商品发布成功</h2>
            </li>
        </ul>
        <script type="text/javascript">
            $().ready(function(){
                $("#step_2").addClass("current");
            });
        </script>

        <div class="content m-t-30">
            <div class="goods-info-two">
                <form id="LibGoodsModel" class="form-horizontal" name="LibGoodsModel" action="/goods/lib-goods/index?cat_id={{ $cat_id }}" method="POST" novalidate="novalidate">
                    @csrf
                    <!-- 分类编号 -->
                    <input type="hidden" id="libgoodsmodel-cat_id" class="form-control" name="LibGoodsModel[cat_id]" value="{{ $cat_id }}">
                    <h5 class="m-b-30">商品基本信息</h5>
                    <div class="simple-form-field">
                        <div class="form-group">
                            <label for="text4" class="col-sm-3 control-label">
                                <span class="text-danger ng-binding">*</span>
                                <span class="ng-binding">商品分类：</span>
                            </label>
                            <div class="col-sm-9">
                                <label class="control-label" data-anchor="商品分类">{!! $cat_names !!}</label>
                                <input type="hidden" id="libgoodsmodel-cat_id" class="form-control" name="LibGoodsModel[cat_id]" value="{{ $cat_id }}">

                                <a id="change_category" href="javascript:void(0);" class="btn btn-warning btn-sm m-l-5">切换商品分类</a>

                            </div>
                        </div>
                    </div>
                    <!-- 商品名称 -->
                    <div class="simple-form-field">
                        <div class="form-group">
                            <label for="libgoodsmodel-goods_name" class="col-sm-3 control-label">
                                <span class="text-danger ng-binding">*</span>
                                <span class="ng-binding">商品名称：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">


                                    <input type="text" id="libgoodsmodel-goods_name" class="form-control" name="LibGoodsModel[goods_name]" data-anchor="商品名称">


                                </div>

                                <div class="help-block help-block-t"><div class="help-block help-block-t">商品标题名称长度至少3个字，最长60个字</div></div>
                            </div>
                        </div>
                    </div>

                    <!-- 商品原地址 -->


                    <!-- 商品原id -->


                    <!-- 商品关键词 -->
                    <div class="simple-form-field">
                        <div class="form-group">
                            <label for="libgoodsmodel-keywords" class="col-sm-3 control-label">

                                <span class="ng-binding">关键词：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">


                                    <input type="text" id="libgoodsmodel-keywords" class="form-control" name="LibGoodsModel[keywords]">


                                </div>

                                <div class="help-block help-block-t"><div class="help-block help-block-t">关键词之间用空格分割，设置后有利于搜索引擎优化</div></div>
                            </div>
                        </div>
                    </div>
                    <!-- 商品卖点 -->
                    <div class="simple-form-field">
                        <div class="form-group">
                            <label for="libgoodsmodel-goods_subname" class="col-sm-3 control-label">

                                <span class="ng-binding">商品卖点：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">


                                    <textarea id="libgoodsmodel-goods_subname" class="form-control" name="LibGoodsModel[goods_subname]" rows="5"></textarea>


                                </div>

                                <div class="help-block help-block-t"><div class="help-block help-block-t">商品卖点最长不能超过140个字，设置后有利于搜索引擎优化</div></div>
                            </div>
                        </div>
                    </div>

                    <!---商品品牌-->
                    <div class="simple-form-field">
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">

                                <span class="ng-binding">商品品牌：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">

                                    <select name="LibGoodsModel[brand_id]" class="form-control chosen-select" style="display: none;">
                                        @foreach($brand_list as $v)
                                            <option value="{{ $v['brand_id'] }}">{{ $v['brand_name'] }}</option>
                                        @endforeach
                                    </select>

                                </div>

                                <div class="help-block help-block-t"></div>
                            </div>
                        </div>
                    </div>

                    <!-- 商品属性 -->
                    <div class="simple-form-field">
                        <div class="form-group">
                            <label for="libgoodsmodel-goods_attr" class="col-sm-3 control-label">

                                <span class="ng-binding">商品属性：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">

                                    <div class="goods-attr w800" data-anchor="商品属性">

                                        {{--平台系统属性--}}
                                        @if(!empty($attr_list))
                                            <div class="goods-attr-tit">
                                                <span>平台系统属性</span>
                                            </div>

                                            @foreach($attr_list as $v)
                                                <div class="simple-form-field" >
                                                    <div class="form-group">
                                                        <label for="" class="col-sm-2 control-label">

                                                            @if($v['is_required'] == 1)
                                                                <span class="text-danger ng-binding">*</span>
                                                            @endif
                                                            <span class="ng-binding">{{ $v['attr_name'] }}：</span>
                                                        </label>
                                                        <div class="col-sm-9">
                                                            <div class="form-control-box">





                                                                <div class="attr-values" data-attr-id="{{ $v['attr_id'] }}" data-required="{{ $v['is_required'] }}">
                                                                @if($v['attr_style'] == 2)
                                                                    {{--文本--}}
                                                                    <!-- 多选属性 -->

                                                                        <input type="text" id="goods_attrs_{{ $v['attr_id'] }}" class="form-control"
                                                                               name="goods_attrs[{{ $v['attr_id'] }}]"
                                                                               data-rule-required="@if($v['is_required'] == 1){{ $v['is_required'] }}@endif" data-msg="@if($v['is_required'] == 1){{ $v['attr_name'] }}不能为空！ @endif">
                                                                        <!-- 品牌属性 -->
                                                                    @elseif($v['attr_style'] == 1)
                                                                        {{--单选--}}
                                                                        <select id="goods_attrs_{{ $v['attr_id'] }}" class="form-control chosen-select"
                                                                                name="goods_attrs[{{ $v['attr_id'] }}]"
                                                                                data-rule-required="@if($v['is_required'] == 1){{ $v['is_required'] }}@endif" data-msg="@if($v['is_required'] == 1){{ $v['attr_name'] }}不能为空！ @endif">
                                                                            <option value=""></option>
                                                                            @foreach($attr_values[$v['attr_id']] as $av)
                                                                                <option value="{{ $av['id'] }}">{{ $av['value'] }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    @elseif($v['attr_style'] == 0)
                                                                        {{--多选--}}
                                                                        @foreach($attr_values[$v['attr_id']] as $av)
                                                                            <label class="control-label cur-p m-r-10">

                                                                                <input type="checkbox" id="goods_attrs_{{ $v['attr_id'] }}_{{ $av['id'] }}"
                                                                                       name="goods_attrs[{{ $v['attr_id'] }}][]" value="{{ $av['id'] }}"
                                                                                       data-rule-required="@if($v['is_required'] == 1){{ $v['is_required'] }}@endif" data-msg="@if($v['is_required'] == 1){{ $v['attr_name'] }}不能为空！ @endif">

                                                                                {{ $av['value'] }}
                                                                            </label>
                                                                        @endforeach
                                                                    @endif

                                                                </div>

                                                            </div>

                                                            <div class="help-block help-block-t"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif


                                        {{--自定义属性--}}
                                        <div class="goods-attr-tit">
                                            <span>自定义属性</span>
                                        </div>
                                        <div class="other-attrs-list">

                                        </div>
                                        <a id="btn_add_other_attr" href="javascript:void(0);" class="btn btn-warning btn-sm m-t-10">
                                            <i class="fa fa-plus"></i>
                                            添加自定义属性
                                        </a>
                                    </div>

                                </div>

                                <div class="help-block help-block-t"></div>
                            </div>
                        </div>
                    </div>
                    <!-- 商品规格 -->

                    @if(!empty($spec_list))
                    <div class="simple-form-field" >
                        <div class="form-group">
                            <label for="libgoodsmodel-goods_spec" class="col-sm-3 control-label">

                                <span class="ng-binding">商品规格：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">

                                    <div class="goods-spec w800" data-anchor="商品规格">
                                        <div class="simple-form-field spec-title-box">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label w100">商品规格：</label>
                                                <div class="col-sm-9 p-0 goods-spec-names" style="width: 580px;">


                                                {{--商品规格--}}
                                                @foreach($spec_list as $v)
                                                    <!--已选中的默认规格，为span添加 selected样式-->
                                                        <span class="spec-values-item selected">
                                                    <label class="control-label">
                                                        <!-- 修改0124 input 添加class="cur-not",后增加 disabled="disabled" 需增判断，做完程序后，此注释请删除-->

                                                        <input type="checkbox" value="{{ $v['attr_id'] }}"  />

                                                        {{ $v['attr_name'] }}
                                                    </label>
                                                            <!-- <a class="default-spec" href="javascript:void(0);" title="点击设置为默认规格">默认</a> -->
                                                </span>
                                                    @endforeach

                                                </div>
                                            </div>

                                            <a id="btn_add_shop_spec" href="javascript:void(0);" class="btn btn-warning btn-sm pos-a" style="right: 15px; top: 14px;">
                                                <i class="fa fa-plus"></i>
                                                添加规格
                                            </a>

                                        </div>

                                        <div id="dropzone" class="ui-sortable goods-spec-items">

                                            {{--规格列表--}}
                                            @foreach($spec_list as $k=>$v)
                                                <div class="simple-form-field goods-spec-item drop-item" data-spec-id="{{ $v['attr_id'] }}" style="display: none;">
                                                    <input type="hidden" name="spec_alias[{{ $k }}][attr_id]" value="{{ $v['attr_id'] }}" />
                                                    <div class="form-group spec-id-{{ $v['attr_id'] }}" data-spec-id="{{ $v['attr_id'] }}" data-spec-name="{{ $v['attr_name'] }}">
                                                        <!-- 规格名称 -->
                                                        <label class="col-sm-2 control-label spec-name cur-p l-h-22" data-spec-id="{{ $v['attr_id'] }}">

                                                        @if($v['is_alias'] == 1)
                                                            <!-- 设置规格别名 start-->

                                                                <input type="text" id="spec_name_{{ $v['attr_id'] }}"
                                                                       name="spec_alias[{{ $k }}][attr_name]" class="form-control form-control-xs text-r w70 spec-name"
                                                                       value="{{ $v['attr_name'] }}" data-spec-id="{{ $v['attr_id'] }}" data-rule-required="true" data-msg="规格名称不能为空!" maxlength="10">

                                                                <!-- 设置规格别名 end-->
                                                            @else
                                                                <span class="ng-binding">{{ $v['attr_name'] }}</span>
                                                            @endif
                                                            ：

                                                        </label>
                                                        <!-- 规格值列表 -->
                                                        <div class="col-sm-9 spec-values" data-spec-id="{{ $v['attr_id'] }}">


                                                            @foreach($v['attrs'] as $av)
                                                                <label class="control-label text-l cur-p w100" title="{{ $av['attr_vname'] }}">
                                                                    <!-- 选中规格 -->

                                                                    <input type="checkbox" value="{{ $av['attr_vid'] }}" data-attr-id="{{ $v['attr_id'] }}" data-vid="{{ $av['attr_vid'] }}"
                                                                           data-vname="{{ $av['attr_vname'] }}" class="spec-value">

                                                                    {{ $av['attr_vname'] }}

                                                                    &nbsp; &nbsp;
                                                                    @if($v['is_desc'] == 1)
                                                                        <span class="color-note-text">备注</span>
                                                                        <input type="text" value="" class="color-note form-control form-control-xs w60 br-0 spec-desc" maxlength="16">
                                                                    @endif

                                                                </label>
                                                            @endforeach




                                                        <!-- 遍历自定义规格 start -->


                                                            <!-- 遍历自定义规格 end -->

                                                            @if($v['is_input'] == 1)
                                                                <label class="control-label cur-p">
                                                                    <input type="checkbox" value="1" class="spec-value spec-other-value" data-attr-id="{{ $v['attr_id'] }}">
                                                                    <input type="text" name="other_spec[]" value="" placeholder="其他" maxlength="15" class="form-control form-control-xs w80 spec-other-text" data-rule-uniqueOtherSpecName="true">
                                                                </label>
                                                            @endif

                                                        </div>
                                                    </div>
                                                    <div class="actions-box">
                                                <span class="actions-btn goods-spec-item-btn-up" title="点击向上移动此规格">
                                                    <i class="fa fa-arrow-circle-o-up"></i>
                                                    上移
                                                </span>
                                                        <span class="actions-btn goods-spec-item-btn-down" title="点击向下移动此规格">
                                                    <i class="fa fa-arrow-circle-o-down"></i>
                                                    下移
                                                </span>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>

                                        <div id="sku_table_container" class="table-responsive" style="display: none; overflow: visible;">
                                            <table id="sku_table" class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th class="sku-th-index text-c">序号</th>
                                                    <th class="sku-market-price-td ">
                                                        市场价
                                                        <div class="batch">
                                                            <a href="javascript:void(0);" class="batch-edit" title="批量设置">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                            <div class="batch-input" style="display: none;">
                                                                <h6>批量设置市场价：</h6>
                                                                <a href="javascript:void(0);" class="batch-close">X</a>
                                                                <input type="text" class="form-control text small pull-none" value="">
                                                                <input type="button" class="btn btn-primary btn-sm pull-none m-l-5 btn_batch_set" data-field="market_price" value="设置" />
                                                                <span class="arrow"></span>
                                                            </div>
                                                        </div>
                                                    </th>
                                                    <th class="sku-goods-price-td ">
                                                        <span class="text-danger ng-binding">*</span>
                                                        店铺价
                                                        <div class="batch">
                                                            <a href="javascript:void(0);" class="batch-edit" title="批量设置">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                            <div class="batch-input" style="display: none;">
                                                                <h6>批量设置店铺价：</h6>
                                                                <a href="javascript:void(0);" class="batch-close">X</a>
                                                                <input class="form-control text small pull-none" type="text" value="">
                                                                <input type="button" class="btn btn-primary btn-sm pull-none m-l-5 btn_batch_set" data-field="goods_price" value="设置" />
                                                                <span class="arrow"></span>
                                                            </div>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <span class="text-danger ng-binding">*</span>
                                                        库存
                                                        <div class="batch">
                                                            <a href="javascript:void(0);" class="batch-edit" title="批量设置">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                            <div class="batch-input" style="display: none;">
                                                                <h6>批量设置库存：</h6>
                                                                <a href="javascript:void(0);" class="batch-close">X</a>
                                                                <input class="form-control text small pull-none" type="text" value="">
                                                                <input type="button" class="btn btn-primary btn-sm pull-none m-l-5 btn_batch_set" data-field="goods_number" value="设置" />
                                                                <span class="arrow"></span>
                                                            </div>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        预警值
                                                        <div class="batch">
                                                            <a href="javascript:void(0);" class="batch-edit" title="批量设置">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                            <div class="batch-input" style="display: none;">
                                                                <h6>批量设置预警值：</h6>
                                                                <a href="javascript:void(0);" class="batch-close">X</a>
                                                                <input class="form-control text small pull-none" type="text" value="">
                                                                <input type="button" class="btn btn-primary btn-sm pull-none m-l-5 btn_batch_set" data-field="warn_number" value="设置" />
                                                                <span class="arrow"></span>
                                                            </div>
                                                        </div>
                                                    </th>
                                                    <th>商品货号</th>
                                                    <th>商品条形码</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>

                                            <a id="btn_sku_more_set" href="javascript:void(0);" class="btn btn-warning btn-sm m-t-10">
                                                <i class="fa fa-plus"></i>
                                                更多设置
                                            </a>

                                        </div>

                                        <!-- 规格数量大于1则发出警告提示 -->
                                        <p id="sku_table_warning" class="form-control-warning m-t-10">
                                            <i class="fa fa-exclamation-circle"></i>
                                            <span>1.设置默认规格后，才可以编辑商品的相册图片。</span>
                                            <span>2.您需要选择至少一个商品规格，才能组合成完整的规格信息。</span>
                                        </p>

                                    </div>

                                </div>

                                <div class="help-block help-block-t"></div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- 商品价格 -->
                    <div class="simple-form-field">
                        <div class="form-group">
                            <label for="libgoodsmodel-goods_price" class="col-sm-3 control-label">
                                <span class="text-danger ng-binding">*</span>
                                <span class="ng-binding">店铺价：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">


                                    <input type="text" id="libgoodsmodel-goods_price" class="form-control ipt pull-none m-r-10" name="LibGoodsModel[goods_price]" data-anchor="店铺价">元


                                </div>

                                <div class="help-block help-block-t"><div class="help-block help-block-t">价格必须是0.01~9999999之间的数字，且不能高于市场价<br>此价格为商品实际销售价格，如果商品存在规格，该价格显示最低价格</div></div>
                            </div>
                        </div>
                    </div>
                    <!-- 市场价 -->
                    <div class="simple-form-field">
                        <div class="form-group">
                            <label for="libgoodsmodel-market_price" class="col-sm-3 control-label">

                                <span class="ng-binding">市场价：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">


                                    <input type="text" id="libgoodsmodel-market_price" class="form-control ipt pull-none m-r-10" name="LibGoodsModel[market_price]" value="0">元


                                </div>

                                <div class="help-block help-block-t"><div class="help-block help-block-t">为0则商品详情页不显示，价格必须是0.00~9999999之间的数字，此价格仅为市场参考售价，请根据该实际情况认真填写</div></div>
                            </div>
                        </div>
                    </div>
                    <!-- 成本价 -->
                    <div class="simple-form-field">
                        <div class="form-group">
                            <label for="libgoodsmodel-cost_price" class="col-sm-3 control-label">

                                <span class="ng-binding">成本价：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">


                                    <input type="text" id="libgoodsmodel-cost_price" class="form-control ipt pull-none m-r-10" name="LibGoodsModel[cost_price]" value="0">元


                                </div>

                                <div class="help-block help-block-t"><div class="help-block help-block-t">价格必须是0.00~9999999之间的数字，此价格为商户对所销售的商品实际成本价格进行备注记录</div></div>
                            </div>
                        </div>
                    </div>
                    <!-- 商品货号 -->
                    <div class="simple-form-field">
                        <div class="form-group">
                            <label for="libgoodsmodel-goods_sn" class="col-sm-3 control-label">

                                <span class="ng-binding">商品货号：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">


                                    <input type="text" id="libgoodsmodel-goods_sn" class="form-control" name="LibGoodsModel[goods_sn]">


                                </div>

                                <div class="help-block help-block-t"><div class="help-block help-block-t">商品货号是指商家管理商品的编号，买家不可见<br>最多可输入20个字，支持输入中文、字母、数字、_、/、-和小数点</div></div>
                            </div>
                        </div>
                    </div>
                    <!-- 商品条形码 -->
                    <div class="simple-form-field">
                        <div class="form-group">
                            <label for="libgoodsmodel-goods_barcode" class="col-sm-3 control-label">

                                <span class="ng-binding">商品条形码：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">


                                    <input type="text" id="libgoodsmodel-goods_barcode" class="form-control" name="LibGoodsModel[goods_barcode]">


                                </div>

                                <div class="help-block help-block-t"></div>
                            </div>
                        </div>
                    </div>
                    <!-- 商品主图 -->
                    <div class="simple-form-field">
                        <div class="form-group">
                            <label for="libgoodsmodel-goods_image" class="col-sm-3 control-label">

                                <span class="ng-binding">商品主图：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">

                                    <!-- 图片相对路径 -->
                                    <input type="hidden" id="libgoodsmodel-goods_image" class="form-control" name="LibGoodsModel[goods_image]">

                                    <div id="goods_image_container"><ul class="image-group"><li class="image-group-button" data-label-index="0" title="点击并选择上传的图片"><div class="image-group-bg"></div></li></ul></div>

                                </div>

                                <div class="help-block help-block-t"><div class="help-block help-block-t">上传商品默认主图，无规格主图时展示该图<br>支持jpg、gif、png格式上传或从图片空间中选择，建议使用尺寸800*800像素以上、大小不超过1M的正方形图片<br>上传后的图片将会自动保存在图片空间的默认分类中</div></div>
                            </div>
                        </div>
                    </div>

                    <!-- 商品主图视频 -->
                    <div class="simple-form-field">
                        <div class="form-group">
                            <label for="libgoodsmodel-goods_video" class="col-sm-3 control-label">

                                <span class="ng-binding">主图视频：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">

                                    <!-- 视频相对路径 -->
                                    <input type="hidden" id="libgoodsmodel-goods_video" class="form-control" name="LibGoodsModel[goods_video]">

                                    <div id="goods_video_container"><ul class="image-group"><li class="image-group-button" data-label-index="0" title="点击并选择上传的视频文件"><div class="image-group-bg-video"></div></li></ul></div>

                                </div>

                                <div class="help-block help-block-t"></div>
                            </div>
                        </div>
                    </div>
                    <!-- 商品详情 -->
                    <div class="simple-form-field">
                        <div class="form-group">
                            <label for="text4" class="col-sm-3 control-label">
                                <span class="ng-binding">商品描述：</span>
                            </label>
                            <div class="col-sm-9">
                                <div id="product-details" class="w800 p-0">
                                    <div class="tabmenu">
                                        <ul class="tab">
                                            <li class="active">
                                                <a href="#texpress1" data-toggle="tab">
                                                    <!--
                                                    <span class="text-danger ng-binding">*</span>
                                                     -->
                                                    电脑端
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#texpress2" data-toggle="tab">手机端</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-content" data-anchor="商品详情">
                                        <div id="texpress1" class="tab-pane fade in active">
                                            <div class="form-control-box">
                                                <!-- 文本编辑器 -->
                                                <textarea id="pc_desc" class="form-control" name="LibGoodsModel[pc_desc]" rows="5" style="width: 100%; height: 350px; visibility: hidden; display: none;"></textarea>
                                            </div>
                                            <div style="clear: both;"></div>
                                            <div class="upload-thumb-buttom p-t-10">
                                                <a id="btn_pc_desc_imagegallery" href="javascript:void(0);" class="btn btn-primary m-l-5">
                                                    <i class="fa fa-picture-o"></i>
                                                    批量插入相册图片
                                                </a>
                                                <a id="btn_upload_pc_desc" href="javascript:void(0);" class="btn btn-primary" data-toggle="collapse">
                                                    <i class="fa fa-upload"></i>
                                                    上传图片
                                                </a>
                                                <div id="pc_desc_imagegallery_container" style="width: 750px;"></div>
                                                <!-- 图片空间选择图片 -->
                                            </div>
                                        </div>
                                        <div id="texpress2" class="tab-pane fade">
                                            <div class="mobile-editor">
                                                <div class="pannel">
                                                    <div class="size-tip">
                                                        <span class="graphic-details">图文详情</span>
                                                        <!--
                                                        <a href="" class="leading-in">导入电脑端宝贝详情</a>
                                                        <div class="build-mdetail">
                                                            <p class="tips-content">将清除之前的手机版宝贝描述，并生成新的</p>
                                                            <div class="button m-b-10">
                                                                <button class="btn btn-primary btn-sm m-r-10">确认生成</button>
                                                                <button class="btn btn-default btn-sm">取消</button>
                                                                <a href="javascript:void(0)" class="btn-close">
                                                                    <i class="fa fa-times-circle"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                         -->
                                                    </div>
                                                    <div class="content-edit">
                                                        <div class="control-panel">

                                                        </div>
                                                        <div id="mobile_text_editor" class="edit-area" style="display: none;">
                                                            <div class="edit-text text-content">
                                                                <p class="text-tip">
                                                                    单个文本框字数不得超过
                                                                    <b>500</b>
                                                                </p>
                                                                <div class="text-textarea">
                                                                    <textarea class="form-control"></textarea>
                                                                </div>
                                                                <div class="button">
                                                                    <input type="button" class="btn btn-primary ok" value="确认">
                                                                    <input type="button" class="btn btn-default cancel" value="取消">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="add-btn">
                                                        <div class="jia hide">
                                                            <ul>
                                                                <li>
                                                                    <a href="javascript:void(0);">
                                                                        <i class="fa fa-plus"></i>
                                                                        <p>添加</p>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <ul class="btn-wrap">
                                                            <li style="width: 50%">
                                                                <a id="btn_mobile_add_image" href="javascript:void(0);" title="上传图片">
                                                                    <i class="fa fa-picture-o"></i>
                                                                    <p>图片</p>
                                                                </a>
                                                            </li>
                                                            <li style="width: 50%">
                                                                <a id="btn_mobile_add_text" href="javascript:void(0);" title="添加文字">
                                                                    <i class="fa fa-font"></i>
                                                                    <p>文字</p>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="mobile-editor-explain">
                                                    <dl>
                                                        <dt>1、图片大小要求：</dt>
                                                        <dd>
                                                            （1）移动端尺寸为
                                                            <span class="c-red">宽度480-1242之间，高度小于等于1546</span>
                                                            ；建议上传详情图片宽度为
                                                            <span class="c-red">750px</span>
                                                            ，效果更佳。
                                                        </dd>
                                                        <dd>
                                                            （2）格式为：
                                                            <span class="c-red">JPG\JEPG\GIF\PNG；</span>
                                                        </dd>
                                                    </dl>
                                                    <dl>
                                                        <dt>2、文字要求：</dt>
                                                        <dd>
                                                            （1）每次插入文字不能超过
                                                            <span class="c-red">500</span>
                                                            个字，标点、特殊字符按照一个字计算；
                                                        </dd>
                                                        <dd>（2）请手动输入文字，不要复制粘贴网页上的文字，防止出现乱码；</dd>
                                                        <dd>（3）以下特殊字符“&lt;”、“&gt;”、“"”、“'”、“\”会被替换为空。</dd>
                                                        <dd>建议：不要添加太多的文字，这样看起来更清晰。</dd>
                                                    </dl>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script id="mobile_image_template" type="text">
<div class="module m-image current first">
	<ul class="tools">
		<li>
			<a href="javascript:void(0);" class="up">上移</a>
		</li>
		<li>
			<a href="javascript:void(0);" class="down">下移</a>
		</li>
		<li>
			<a href="javascript:void(0);" class="replace">替换</a>
		</li>
		<li>
			<a href="javascript:void(0);" class="delete">删除</a>
		</li>
	</ul>
	<div class="content">
		<div class="image-div">
			<img src="">
		</div>
	</div>
	<div class="cover"></div>
</div>
</script>
                    <script id="mobile_text_template" type="text">
<div class="module m-text">
	<ul class="tools">
		<li>
			<a href="javascript:void(0);" class="up">上移</a>
		</li>
		<li>
			<a href="javascript:void(0);" class="down">下移</a>
		</li>
		<li>
			<a href="javascript:void(0);" class="edit">编辑</a>
		</li>
		<li>
			<a href="javascript:void(0);" class="delete">删除</a>
		</li>
	</ul>
	<div class="content">
		<div class="text-div">
			<div class="text-html"></div>
		</div>
	</div>
	<div class="cover"></div>
</div>
</script>
                    <h5 class="m-b-30" data-anchor="其他信息">其他信息</h5>
                    <!-- 系统商品库商品分类 -->
                    <div class="simple-form-field">
                        <div class="form-group">
                            <label for="libgoodsmodel-lib_cat_id" class="col-sm-4 control-label">
                                <span class="ng-binding">系统商品库商品分类：</span>
                            </label>
                            <div class="col-sm-8">
                                <div class="form-control-box">
                                    {{--<div class="chosen-container chosen-container-single" title="" id="libgoodsmodel_lib_cat_id_chosen">
                                        <div class="chosen-drop">
                                            <div class="chosen-search">
                                                <input type="text" autocomplete="off">
                                            </div>
                                            <ul class="chosen-results"></ul>
                                        </div>
                                    </div>--}}
                                    <select id="libgoodsmodel-lib_cat_id" class="form-control chosen-select" name="LibGoodsModel[lib_cat_id]" style="display: none;">

                                        @foreach($lib_category_list as $k=>$v)
                                            <option value="{{ $k }}" @if(0 == $k)selected="selected"@endif @if($v['has_child'])disabled="true"@endif>{!! $v['cat_name'] !!}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="help-block help-block-t"></div>
                            </div>
                        </div>
                    </div>
                    <!-- 商品发布 -->
                    <div class="simple-form-field">
                        <div class="form-group">
                            <label for="libgoodsmodel-goods_status" class="col-sm-3 control-label">

                                <span class="ng-binding">商品状态：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">


                                    <label class="control-label cur-p">
                                        <input type="radio" id="libgoodsmodel-goods_status_1" name="LibGoodsModel[goods_status]" value="1" checked="checked">
                                        立刻发布
                                    </label>
                                    <br>
                                    <label class="control-label cur-p">
                                        <input type="radio" id="libgoodsmodel-goods_status_0" name="LibGoodsModel[goods_status]" value="0">
                                        放入仓库
                                    </label>


                                </div>

                                <div class="help-block help-block-t"></div>
                            </div>
                        </div>
                    </div>

                    <div class="goods-next p-b-30">

                        <input type="button" id="btn_publish" value="下一步，上传商品图片" class="btn btn-primary">

                        <!--不可点击状态的下一步-->
                        <!--<button class="btn btn-default">下一步，上传商品图片</button>-->
                    </div>
                </form>
                <input type="file" id="file_goods_image" name="file_goods_image" style="display: none;" multiple="multiple" accept="image/*">
                <input type="file" id="file_pc_desc" name="file_pc_desc" style="display: none;" multiple="multiple" accept="image/jpeg,image/png">
            </div>
        </div>
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
    @include('layouts.partials.helper_tool')
@stop

{{--自定义css样式--}}
@section('style_css')
    <style type="text/css">
        .goods-next {
            padding-left: 25.5%
        }
    </style>
@stop

{{--footer script page元素同级下面--}}
@section('footer_script')

    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=1.2"></script>
    <!-- AJAX上传 -->
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=1.2"></script>
    <!-- 图片上传、图片空间 -->
    <script src="/assets/d2eace91/js/jquery.widget.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/jquery-ui.js?v=1.2"></script>
    <script id="other_attrs_template" type="text">
<div class="simple-form-field other-attrs-item">
	<div class="form-group">
		<label class="col-sm-2 control-label">
			<input type="text" class="form-control w80 other-attr-name" name="other_attr_name" value="" placeholder="属性名" />
			：
		</label>
		<div class="col-sm-9">
			<div class="form-control-box  control-label">
				<input type="text" class="form-control w450 other-attr-value" name="other_attr_value" value="" placeholder="属性值，多个值间用英文逗号分割" />
				<a class="btn btn-danger btn-sm m-l-5 other-attr-remove">移除</a>
				</div>
		</div>
	</div>
</div>
</script>
    <script id="other_cat_template" type="text">
<div class="choosen-select-item other-cat">
	<select class="form-control chosen-select" name="other_cat_ids[]">

</select>
	<a class="choosen-select-delete other-cat-delete">×</a>
</div>
</script>
    <script id="spec_other_value_template" type="text">
<label class="control-label">
	<input type="checkbox" value="" class="spec-value spec-other-value">
	<input type="text" name="other_spec[]" value="" placeholder="其他" maxlength="15" class="form-control form-control-xs w80 spec-other-text" data-rule-uniqueOtherSpecName="true">
</label>
</script>

    <!-- SKU表格头模板 -->
    <!-- SKU模板 -->

    <!-- SKU表格头模板 -->
    <!-- SKU模板 -->
    <script id="sku_table_template" type="text">
<td class="sku-td-index text-c"></td>
<td>
	<input type="text" name="market_price" value="" class="form-control w60 sku-field sku-market-price" data-rule-min="0.01" data-rule-max="9999999">
</td>
<td>
	<input type="text" name="goods_price" value="" class="form-control w60 sku-field sku-goods-price" data-rule-required="true" data-msg-required="SKU商品店铺价不能为空" data-rule-min="0.01" data-rule-max="9999999">
</td>
<!--
<td>
	<input type="text" name="goods_number" value="" class="form-control small sku-field sku-goods-number" data-rule-required="true" data-msg-required="SKU商品库存不能为空" data-rule-min="0" data-rule-max="9999999">
</td>
<td>
	<input type="text" name="warn_number" value="" class="form-control small sku-field sku-warn-number" data-rule-number="true">
</td>
-->
<td>
	<input type="text" name="goods_sn" value="" class="form-control w90 sku-field">
</td>
<td>
	<input type="text" name="goods_barcode" value="" class="form-control w90 sku-field">
</td>
</script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
[{"id": "libgoodsmodel-goods_name", "name": "LibGoodsModel[goods_name]", "attribute": "goods_name", "rules": {"required":true,"messages":{"required":"商品名称不能为空。"}}},{"id": "libgoodsmodel-cat_id", "name": "LibGoodsModel[cat_id]", "attribute": "cat_id", "rules": {"required":true,"messages":{"required":"商品分类ID不能为空。"}}},{"id": "libgoodsmodel-goods_price", "name": "LibGoodsModel[goods_price]", "attribute": "goods_price", "rules": {"required":true,"messages":{"required":"店铺价不能为空。"}}},{"id": "libgoodsmodel-add_time", "name": "LibGoodsModel[add_time]", "attribute": "add_time", "rules": {"required":true,"messages":{"required":"商品发布时间不能为空。"}}},{"id": "libgoodsmodel-last_time", "name": "LibGoodsModel[last_time]", "attribute": "last_time", "rules": {"required":true,"messages":{"required":"最后一次更新时间不能为空。"}}},{"id": "libgoodsmodel-sku_open", "name": "LibGoodsModel[sku_open]", "attribute": "sku_open", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Sku Open必须是整数。"}}},{"id": "libgoodsmodel-sku_id", "name": "LibGoodsModel[sku_id]", "attribute": "sku_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Sku Id必须是整数。"}}},{"id": "libgoodsmodel-cat_id", "name": "LibGoodsModel[cat_id]", "attribute": "cat_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品分类ID必须是整数。"}}},{"id": "libgoodsmodel-invoice_type", "name": "LibGoodsModel[invoice_type]", "attribute": "invoice_type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"发票必须是整数。"}}},{"id": "libgoodsmodel-is_repair", "name": "LibGoodsModel[is_repair]", "attribute": "is_repair", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"保修必须是整数。"}}},{"id": "libgoodsmodel-user_discount", "name": "LibGoodsModel[user_discount]", "attribute": "user_discount", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"会员打折必须是整数。"}}},{"id": "libgoodsmodel-stock_mode", "name": "LibGoodsModel[stock_mode]", "attribute": "stock_mode", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"库存计数必须是整数。"}}},{"id": "libgoodsmodel-warn_number", "name": "LibGoodsModel[warn_number]", "attribute": "warn_number", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"库存警告数量必须是整数。"}}},{"id": "libgoodsmodel-brand_id", "name": "LibGoodsModel[brand_id]", "attribute": "brand_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"品牌ID必须是整数。"}}},{"id": "libgoodsmodel-top_layout_id", "name": "LibGoodsModel[top_layout_id]", "attribute": "top_layout_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品顶部模板编号必须是整数。"}}},{"id": "libgoodsmodel-bottom_layout_id", "name": "LibGoodsModel[bottom_layout_id]", "attribute": "bottom_layout_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品底部模板编号必须是整数。"}}},{"id": "libgoodsmodel-packing_layout_id", "name": "LibGoodsModel[packing_layout_id]", "attribute": "packing_layout_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Packing Layout Id必须是整数。"}}},{"id": "libgoodsmodel-service_layout_id", "name": "LibGoodsModel[service_layout_id]", "attribute": "service_layout_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Service Layout Id必须是整数。"}}},{"id": "libgoodsmodel-click_count", "name": "LibGoodsModel[click_count]", "attribute": "click_count", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品浏览次数必须是整数。"}}},{"id": "libgoodsmodel-goods_audit", "name": "LibGoodsModel[goods_audit]", "attribute": "goods_audit", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"审核是否通过必须是整数。"}}},{"id": "libgoodsmodel-goods_status", "name": "LibGoodsModel[goods_status]", "attribute": "goods_status", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品状态必须是整数。"}}},{"id": "libgoodsmodel-is_delete", "name": "LibGoodsModel[is_delete]", "attribute": "is_delete", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否已删除必须是整数。"}}},{"id": "libgoodsmodel-is_virtual", "name": "LibGoodsModel[is_virtual]", "attribute": "is_virtual", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Is Virtual必须是整数。"}}},{"id": "libgoodsmodel-is_best", "name": "LibGoodsModel[is_best]", "attribute": "is_best", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否精品必须是整数。"}}},{"id": "libgoodsmodel-is_new", "name": "LibGoodsModel[is_new]", "attribute": "is_new", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否新品必须是整数。"}}},{"id": "libgoodsmodel-is_hot", "name": "LibGoodsModel[is_hot]", "attribute": "is_hot", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否热卖必须是整数。"}}},{"id": "libgoodsmodel-is_promote", "name": "LibGoodsModel[is_promote]", "attribute": "is_promote", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否促销必须是整数。"}}},{"id": "libgoodsmodel-supplier_id", "name": "LibGoodsModel[supplier_id]", "attribute": "supplier_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"供货商ID必须是整数。"}}},{"id": "libgoodsmodel-goods_sort", "name": "LibGoodsModel[goods_sort]", "attribute": "goods_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Goods Sort必须是整数。"}}},{"id": "libgoodsmodel-add_time", "name": "LibGoodsModel[add_time]", "attribute": "add_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品发布时间必须是整数。"}}},{"id": "libgoodsmodel-last_time", "name": "LibGoodsModel[last_time]", "attribute": "last_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"最后一次更新时间必须是整数。"}}},{"id": "libgoodsmodel-comment_num", "name": "LibGoodsModel[comment_num]", "attribute": "comment_num", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品评论次数必须是整数。"}}},{"id": "libgoodsmodel-sale_num", "name": "LibGoodsModel[sale_num]", "attribute": "sale_num", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品销售数量必须是整数。"}}},{"id": "libgoodsmodel-collect_num", "name": "LibGoodsModel[collect_num]", "attribute": "collect_num", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品收藏数量必须是整数。"}}},{"id": "libgoodsmodel-lib_cat_id", "name": "LibGoodsModel[lib_cat_id]", "attribute": "lib_cat_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"系统商品库商品分类必须是整数。"}}},{"id": "libgoodsmodel-goods_image", "name": "LibGoodsModel[goods_image]", "attribute": "goods_image", "rules": {"string":true,"messages":{"string":"商品主图必须是一条字符串。","maxlength":"商品主图只能包含至多255个字符。"},"maxlength":255}},{"id": "libgoodsmodel-goods_video", "name": "LibGoodsModel[goods_video]", "attribute": "goods_video", "rules": {"string":true,"messages":{"string":"主图视频必须是一条字符串。","maxlength":"主图视频只能包含至多255个字符。"},"maxlength":255}},{"id": "libgoodsmodel-goods_price", "name": "LibGoodsModel[goods_price]", "attribute": "goods_price", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"店铺价必须是一个数字。","min":"店铺价必须不小于0。","max":"店铺价必须不大于9999999。"},"min":0,"max":9999999}},{"id": "libgoodsmodel-market_price", "name": "LibGoodsModel[market_price]", "attribute": "market_price", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"市场价必须是一个数字。","min":"市场价必须不小于0。","max":"市场价必须不大于9999999。"},"min":0,"max":9999999}},{"id": "libgoodsmodel-warn_number", "name": "LibGoodsModel[warn_number]", "attribute": "warn_number", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"库存警告数量必须是整数。","min":"库存警告数量必须不小于0。","max":"库存警告数量必须不大于255。"},"min":0,"max":255}},{"id": "libgoodsmodel-cost_price", "name": "LibGoodsModel[cost_price]", "attribute": "cost_price", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"成本价必须是一个数字。","min":"成本价必须不小于0。","max":"成本价必须不大于9999999。"},"min":0,"max":9999999}},{"id": "libgoodsmodel-mobile_price", "name": "LibGoodsModel[mobile_price]", "attribute": "mobile_price", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"移动端专项价必须是一个数字。","min":"移动端专项价必须不小于0。","max":"移动端专项价必须不大于9999999。"},"min":0,"max":9999999}},{"id": "libgoodsmodel-pc_desc", "name": "LibGoodsModel[pc_desc]", "attribute": "pc_desc", "rules": {"string":true,"messages":{"string":"商品电脑端描述必须是一条字符串。"}}},{"id": "libgoodsmodel-mobile_desc", "name": "LibGoodsModel[mobile_desc]", "attribute": "mobile_desc", "rules": {"string":true,"messages":{"string":"商品手机端描述必须是一条字符串。"}}},{"id": "libgoodsmodel-contract_ids", "name": "LibGoodsModel[contract_ids]", "attribute": "contract_ids", "rules": {"string":true,"messages":{"string":"保障服务必须是一条字符串。"}}},{"id": "libgoodsmodel-goods_name", "name": "LibGoodsModel[goods_name]", "attribute": "goods_name", "rules": {"string":true,"messages":{"string":"商品名称必须是一条字符串。","maxlength":"商品名称只能包含至多100个字符。"},"maxlength":100}},{"id": "libgoodsmodel-goods_subname", "name": "LibGoodsModel[goods_subname]", "attribute": "goods_subname", "rules": {"string":true,"messages":{"string":"商品卖点必须是一条字符串。","maxlength":"商品卖点只能包含至多140个字符。"},"maxlength":140}},{"id": "libgoodsmodel-goods_image", "name": "LibGoodsModel[goods_image]", "attribute": "goods_image", "rules": {"string":true,"messages":{"string":"商品主图必须是一条字符串。","maxlength":"商品主图只能包含至多255个字符。"},"maxlength":255}},{"id": "libgoodsmodel-keywords", "name": "LibGoodsModel[keywords]", "attribute": "keywords", "rules": {"string":true,"messages":{"string":"关键词必须是一条字符串。","maxlength":"关键词只能包含至多255个字符。"},"maxlength":255}},{"id": "libgoodsmodel-goods_info", "name": "LibGoodsModel[goods_info]", "attribute": "goods_info", "rules": {"string":true,"messages":{"string":"商品简介必须是一条字符串。","maxlength":"商品简介只能包含至多255个字符。"},"maxlength":255}},{"id": "libgoodsmodel-goods_reason", "name": "LibGoodsModel[goods_reason]", "attribute": "goods_reason", "rules": {"string":true,"messages":{"string":"Goods Reason必须是一条字符串。","maxlength":"Goods Reason只能包含至多255个字符。"},"maxlength":255}},{"id": "libgoodsmodel-goods_volume", "name": "LibGoodsModel[goods_volume]", "attribute": "goods_volume", "rules": {"string":true,"messages":{"string":"物流体积(m3)必须是一条字符串。","maxlength":"物流体积(m3)只能包含至多255个字符。"},"maxlength":255}},{"id": "libgoodsmodel-goods_weight", "name": "LibGoodsModel[goods_weight]", "attribute": "goods_weight", "rules": {"string":true,"messages":{"string":"物流重量(Kg)必须是一条字符串。","maxlength":"物流重量(Kg)只能包含至多255个字符。"},"maxlength":255}},{"id": "libgoodsmodel-goods_remark", "name": "LibGoodsModel[goods_remark]", "attribute": "goods_remark", "rules": {"string":true,"messages":{"string":"商品备注必须是一条字符串。","maxlength":"商品备注只能包含至多255个字符。"},"maxlength":255}},{"id": "libgoodsmodel-goods_sn", "name": "LibGoodsModel[goods_sn]", "attribute": "goods_sn", "rules": {"string":true,"messages":{"string":"商品货号必须是一条字符串。","maxlength":"商品货号只能包含至多60个字符。"},"maxlength":60}},{"id": "libgoodsmodel-goods_barcode", "name": "LibGoodsModel[goods_barcode]", "attribute": "goods_barcode", "rules": {"string":true,"messages":{"string":"商品条形码必须是一条字符串。","maxlength":"商品条形码只能包含至多60个字符。"},"maxlength":60}},{"id": "libgoodsmodel-invoice_type", "name": "LibGoodsModel[invoice_type]", "attribute": "invoice_type", "rules": {"in":{"range":["0","1","2"]},"messages":{"in":"发票是无效的。"}}},{"id": "libgoodsmodel-is_repair", "name": "LibGoodsModel[is_repair]", "attribute": "is_repair", "rules": {"in":{"range":["0","1"]},"messages":{"in":"保修是无效的。"}}},{"id": "libgoodsmodel-user_discount", "name": "LibGoodsModel[user_discount]", "attribute": "user_discount", "rules": {"in":{"range":["0","1"]},"messages":{"in":"会员打折是无效的。"}}},{"id": "libgoodsmodel-stock_mode", "name": "LibGoodsModel[stock_mode]", "attribute": "stock_mode", "rules": {"in":{"range":["0","1","2"]},"messages":{"in":"库存计数是无效的。"}}},{"id": "libgoodsmodel-goods_status", "name": "LibGoodsModel[goods_status]", "attribute": "goods_status", "rules": {"in":{"range":["0","1","2"]},"messages":{"in":"商品状态是无效的。"}}},{"id": "libgoodsmodel-goods_sn", "name": "LibGoodsModel[goods_sn]", "attribute": "goods_sn", "rules": {"string":true,"messages":{"string":"商品货号必须是一条字符串。","maxlength":"商品货号只能包含至多20个字符。"},"maxlength":20}},{"id": "libgoodsmodel-goods_barcode", "name": "LibGoodsModel[goods_barcode]", "attribute": "goods_barcode", "rules": {"string":true,"messages":{"string":"商品条形码必须是一条字符串。","maxlength":"商品条形码只能包含至多1,500个字符。"},"maxlength":1500}},{"id": "libgoodsmodel-market_price", "name": "LibGoodsModel[market_price]", "attribute": "market_price", "rules": {"default":0,"messages":{"default":""}}},]
</script>
    <script type="text/javascript">
        $().ready(function() {
            //悬浮显示上下步骤按钮
            window.onscroll = function() {
                $(window).scroll(function() {
                    var scrollTop = $(document).scrollTop();
                    var height = $(".table-content").height();
                    var wHeight = $(window).height();
                    if (scrollTop > (height - wHeight)) {
                        $(".goods-next").removeClass("goods-btn-fixed");
                    } else {
                        $(".goods-next").addClass("goods-btn-fixed");
                    }
                });

            };
            /*商品添加页面右侧发布助手js*/
            $('.helper-icon').click(function() {
                $('.helper-icon').animate({
                    'right': '-40px'
                }, 200, function() {
                    $('.helper-wrap').animate({
                        'right': '0'
                    }, 200);
                });
            });
            $('.help-header .fa-times-circle').click(function() {
                $('.helper-wrap').animate({
                    'right': '-140px'
                }, 200, function() {
                    $('.helper-icon').animate({
                        'right': '0'
                    }, 200);
                });
            });

            //生成页面导航助手
            $("#helper_tool_nav").find("ul").html("");
            var count = 0;
            $("[data-anchor]").each(function() {
                var title = $(this).data("anchor");
                var element = $($.parseHTML("<li><a href='javascript:void(0);'>" + title + "</a></li>"));
                $("#helper_tool_nav").find("ul").append(element);
                var target = this;
                $(element).click(function() {
                    $('html, body').animate({
                        scrollTop: $(target).offset().top - 100
                    }, 500);
                    if ($(target).is(":input")) {
                        $(target).focus();
                    } else {
                        $(target).find(":input").first().focus();
                    }
                });
                count++;
            });

            $("#helper_tool_nav").find(".count").html(count);
        });
    </script>
    <!-- 规格、属性 -->
    <script type="text/javascript">
        function getOtherValue(attr_id, vname) {
            return "other_" + attr_id + "_" + vname;
        }

        $().ready(function() {

            $("#libgoodsmodel-goods_status_1").attr("checked", true);

            // 验证
            var validator = $("#LibGoodsModel").validate();
            $("select").on('change', function() {
                $(this).valid();
            });

            //-------------------------------------商品规格处理-----------------------------------------

            // 修改规格名称时级联修改表格的表头
            $(".spec-name:text").keyup(function() {
                var attr_id = $(this).data("spec-id");
                $("#th_spec_id_" + attr_id).html($(this).val());
            });

            // 如果不存在则为0
            var vid_index = 0;
            var other_name = "其他";

            function getNewVid(attr_id) {
                return "other_" + attr_id + "_" + (vid_index++);
            }

            function setOtherSpecData(cb_object, vname) {

                var vid = $(cb_object).data("vid");
                var attr_id = $(cb_object).data("attr-id");

                if (vid == undefined || vid == null) {
                    vid = getNewVid(attr_id);
                }

                if (vname == undefined || $.trim(vname) == "") {
                    vname = other_name + vid_index;
                }

                $(cb_object).val(getOtherValue(attr_id, vname));
                $(cb_object).data("vid", vid);
                $(cb_object).data("vname", vname);
                $(cb_object).siblings(":text").val(vname);

                $(".spec-vname-label-" + vid).html(vname);
                $(".spec-vname-text-" + vid).val(vname);
                $(".spec-vid-text-" + vid).val(getOtherValue(attr_id, vname));

            }

            // 读取复选框获取规格信息
            function getSpecInfo(cb_object) {
                var object = {};
                object.attr_id = $(cb_object).data("attr-id");
                object.attr_vid = $(cb_object).data("vid");
                object.attr_vname = $(cb_object).data("vname");
                object.attr_desc = $(cb_object).siblings(".spec-desc").val();

                if (new String(object.attr_vid).indexOf("other_") == 0) {
                    attr_vname = $(this).siblings(".spec-other-text").val();
                    if ($.trim(object.attr_vname) == '') {
                        object.attr_vname = other_name;
                    }
                }

                return object;
            }

            // 单击“其他规格”复选框事件
            $("body").on("click", ".spec-other-value", function() {
                var checked = $(this).is(":checked");
                if (checked) {
                    var value = $(this).siblings(":text").val();
                    if ($.trim(value) == '') {
                        //设置复选框参数
                        setOtherSpecData(this, other_name);
                    }
                    // 变色
                    $(this).siblings(":text").css({
                        "color": "#000"
                    });
                    var template = $("#spec_other_value_template").html();
                    template = $($.parseHTML(template));
                    $(template).find(":checkbox").attr("data-attr-id", $(this).data("attr-id"));
                    $(this).parents(".spec-values").append(template);
                    $(this).siblings(":text").focus();
                } else {
                    if ($(this).parents(".spec-values").find(".spec-other-value").size() > 1) {
                        $(this).parents("label").remove();
                    }
                }
            });

            // “其他”文本框获取焦点事件
            $("body").on("keyup", ".spec-other-text", function() {
                var value = $(this).val();
                //设置复选框参数
                var cb_object = $(this).siblings(":checkbox");
                setOtherSpecData(cb_object, value);
                // 不进行实时计算
                //evalSkuTable();
            });

            // “其他”文本框获取焦点事件
            $("body").on("focus", ".spec-other-text", function() {
                var value = $(this).val();
                if ($.trim(value) == other_name) {
                    var cb_object = $(this).siblings(":checkbox");
                    setOtherSpecData(cb_object, "");
                }
            });

            // “其他”文本框失去焦点事件
            $("body").on("blur", ".spec-other-text", function() {
                if ($(this).siblings(":checkbox").is(":checked") == false) {
                    return;
                }
                var value = $(this).val();
                if ($.trim(value) == '') {
                    value = other_name;
                }

                var cb_object = $(this).siblings(":checkbox");
                setOtherSpecData(cb_object, value);

                $(this).valid();
            });

            // 规格对象
            var spec_object = [];
            // sku对象
            var sku_object = [];

            if ($("#goods_sku_list").size() > 0) {
                try {
                    sku_object = $.parseJSON($("#goods_sku_list").html());

                    for ( var spec_vids in sku_object) {
                        var item = sku_object[spec_vids];
                        var ids = spec_vids.split("-");
                        var list = $.toPermute(ids);

                        for (var i = 0; i < list.length; i++) {
                            var vids = list[i].join("-");
                            sku_object[vids] = item;
                        }
                    }
                } catch (e) {
                    console.info(e);
                }
            }

            // 计算SKU表格
            function evalSkuTable(init) {

                if (init == undefined) {
                    init = false;
                }

                var is_all = true;

                $(".goods-spec-item").each(function() {
                    if ($(this).find(":checked").size() == 0) {
                        //is_all = false;
                    }
                });

                if (!is_all) {
                    $("#sku_table_container").hide().find("tbody").empty();
                    $("#sku_table_warning").show();
                    //$("#libgoodsmodel-goods_number").prop("readonly", false);
                    //$("#libgoodsmodel-warn_number").prop("readonly", false);

                    $("#libgoodsmodel-market_price").prop("readonly", false);
                    $("#libgoodsmodel-goods_price").prop("readonly", false);
                    return;
                } else {
                    $("#sku_table_container").show();
                    $("#sku_table_warning").hide();
                    $("#libgoodsmodel-warn_number").prop("readonly", true);
                    $("#libgoodsmodel-warn_number").prop("readonly", true);

                    $("#libgoodsmodel-market_price").prop("readonly", true);
                    $("#libgoodsmodel-goods_price").prop("readonly", true);
                }

                var is_repeat = false;

                $(".spec-other-text").reverse().each(function() {
                    if ($(this).siblings(":checkbox").is(":checked") == false) {
                        return;
                    }

                    if ($(this).valid()) {
                        return true;
                    }

                    $(this).focus();

                    is_repeat = true;

                    return false;
                });

                if (is_repeat) {
                    return;
                }

                spec_ids = [];
                spec_values = [];

                var sku_td_html = "";
                var sku_th_html = "";

                var temp_attr_ids = [];

                // 查找选中的复选框
                $(".spec-values").find(":checkbox:checked").each(function() {
                    var attr_id = $(this).parents(".spec-values").data("spec-id");
                    var value = $(this).val();
                    var attr_desc = $(this).siblings(".spec-desc").val();

                    var key = "spec-" + attr_id;

                    if (spec_values[key] == undefined) {
                        spec_values[key] = [];
                        spec_ids.push(attr_id);
                    }

                    spec_values[key].push(this);

                    if (temp_attr_ids[attr_id] == undefined) {
                        sku_th_html += $("#sku_th_template_" + attr_id).html();
                        sku_td_html += $("#sku_td_template_" + attr_id).html();
                        temp_attr_ids[attr_id] = true;
                    }
                });

                $(".spec-th").remove();
                $(".sku-th-index").after($.parseHTML(sku_th_html));

                var list = [];

                if (parseInt("0") > 1) {
                    for (var i = 0; i < spec_ids.length; i++) {
                        var key = "spec-" + spec_ids[i];
                        list.push(spec_values[key]);
                    }
                    list = $.toDkezj(list);
                } else {
                    for ( var key in spec_values) {
                        for ( var k in spec_values[key]) {
                            list.push([spec_values[key][k]]);
                        }
                    }
                }

                // 如果为选中任何规格则提示
                if (list.length == 0) {
                    $("#sku_table_container").hide().find("tbody").empty();
                    $("#sku_table_warning").show();
                    //$("#libgoodsmodel-goods_number").prop("readonly", false);
                    //$("#libgoodsmodel-warn_number").prop("readonly", false);

                    $("#libgoodsmodel-market_price").prop("readonly", false);
                    $("#libgoodsmodel-goods_price").prop("readonly", false);

                    $("#libgoodsmodel-goods_sn").prop("readonly", false);
                    $("#libgoodsmodel-goods_barcode").prop("readonly", false);
                    return;
                } else {
                    $("#sku_table_container").show();
                    $("#sku_table_warning").hide();
                    //$("#libgoodsmodel-goods_number").prop("readonly", true);
                    //$("#libgoodsmodel-warn_number").prop("readonly", true);

                    $("#libgoodsmodel-market_price").prop("readonly", true);
                    $("#libgoodsmodel-goods_price").prop("readonly", true);

                    $("#libgoodsmodel-goods_sn").prop("readonly", true);
                    $("#libgoodsmodel-goods_barcode").prop("readonly", true);
                }

                var template = $("#sku_table_template").html();

                // 遍历行
                $("#sku_table").find("tbody").find("tr").each(function() {
                    var object = $(this).serializeJson();
                    var sku_id = $(this).data("sku_id");
                    var is_enable = $(this).data("is_enable");

                    if (is_enable == undefined) {
                        is_enable = true;
                    }

                    sku_object[sku_id] = object;
                    // 标识出此SKU对象未被选中
                    sku_object[sku_id].checked = false;
                    sku_object[sku_id].is_enable = is_enable;
                });

                $("#sku_table").find("tbody").find("tr").remove();

                var total_goods_number = 0;
                var goods_price = 0;
                var market_price = 0;

                for (var i = 0; i < list.length; i++) {

                    var objects = list[i];

                    var sku_id = [];

                    var html = "<tr>" + template + "</tr>";

                    var element = $(html);

                    $(element).find(".sku-td-index").after(sku_td_html);

                    for (var j = 0; j < objects.length; j++) {

                        // 读取复选框获取规格信息
                        var object = getSpecInfo(objects[j]);

                        var attr_id = object.attr_id;
                        var vname = object.attr_vname;
                        var desc = object.attr_desc;
                        var vid = object.attr_vid;

                        if (new String(vid).indexOf('other_') == 0) {
                            sku_id.push(getOtherValue(attr_id, vname));
                            $(element).find("[name='specs[" + attr_id + "][attr_vid]']").val(getOtherValue(attr_id, vname)).addClass("spec-vid-text-" + vid);
                        } else {
                            sku_id.push(vid);
                            $(element).find("[name='specs[" + attr_id + "][attr_vid]']").val(vid).addClass("spec-vid-text-" + vid);
                        }

                        $(element).find(".spec-vname-label[data-attr-id='" + attr_id + "']").html(vname).addClass("spec-vname-label-" + vid);
                        $(element).find("[name='specs[" + attr_id + "][attr_vname]']").val(vname).addClass("spec-vname-text-" + vid);
                        $(element).find("[name='specs[" + attr_id + "][attr_desc]']").val(desc).addClass("spec-desc-text-" + vid);
                    }

                    sku_id = sku_id.join("-");

                    // 行标识出SKU_ID
                    $(element).data("sku_id", sku_id);
                    $("#sku_table").find("tbody").append(element);

                    if (sku_object[sku_id] == undefined) {
                        sku_object[sku_id] = $(element).serializeJson();
                        if (init) {
                            // 初始化时不存在则为false
                            sku_object[sku_id].is_enable = false;
                        } else {
                            sku_object[sku_id].is_enable = true;
                        }

                    } else {
                        //还原赋值
                        $(element).find(".sku-field").each(function() {
                            var name = $(this).attr("name");
                            $(this).val(sku_object[sku_id][name]);
                        });
                    }

                    // 标识出此SKU对象被选中
                    sku_object[sku_id].checked = true;

                    // 标识是否可用
                    if (sku_object[sku_id].is_enable == undefined) {
                        sku_object[sku_id].is_enable = true;
                    }

                    $(element).data("is_enable", sku_object[sku_id].is_enable);

                    if (sku_object[sku_id].is_enable) {
                        $(element).find(".sku-td-index").html((i + 1) + '<a class="del-btn sku-item-handle" data-sku-enable=false data-sku-index="' + (i + 1) + '" title="点击禁用此规格">×</a>');
                        $(element).removeClass("disabled");
                        $(element).find(":input").prop("disabled", false);
                    } else {
                        $(element).find(".sku-td-index").html((i + 1) + '<a class="allow-btn sku-item-handle" data-sku-enable=true data-sku-index="' + (i + 1) + '" title="点击启用此规格">√</a>');
                        $(element).addClass("disabled");
                        $(element).find(":input").prop("disabled", true);
                    }

                    if (sku_object[sku_id].is_enable) {
                        // 合计库存
                        if (sku_object[sku_id]['goods_number'] != '') {
                            total_goods_number = total_goods_number + parseInt(sku_object[sku_id]['goods_number']);
                        }

                        // 计算最低价格
                        if (!isNaN(parseFloat(sku_object[sku_id]['goods_price'])) && (goods_price == 0 || parseFloat(sku_object[sku_id]['goods_price']) < goods_price)) {
                            goods_price = parseFloat(sku_object[sku_id]['goods_price']);
                        }

                        // 计算最低价格
                        if (!isNaN(parseFloat(sku_object[sku_id]['market_price'])) && (market_price == 0 || parseFloat(sku_object[sku_id]['market_price']) < market_price)) {
                            market_price = parseFloat(sku_object[sku_id]['market_price']);
                        }
                    }
                }

                // 选择了SKU规格组合和禁用商品库存、条形码、货号等
                if (list.length > 0) {
                    //$("#libgoodsmodel-goods_number").prop("readonly", true).val(total_goods_number);
                    //$("#libgoodsmodel-warn_number").prop("readonly", true).val(0);

                    $("#libgoodsmodel-market_price").prop("readonly", true).val(market_price);
                    $("#libgoodsmodel-goods_price").prop("readonly", true).val(goods_price);
                } else {
                    //$("#libgoodsmodel-goods_number").prop("readonly", false);
                    //$("#libgoodsmodel-warn_number").prop("readonly", false);

                    $("#libgoodsmodel-market_price").prop("readonly", false);
                    $("#libgoodsmodel-goods_price").prop("readonly", false);

                    $("#libgoodsmodel-goods_sn").prop("readonly", false);
                    $("#libgoodsmodel-goods_barcode").prop("readonly", false);
                }
            }

            // 启用、禁用SKU
            $("body").on("click", ".sku-item-handle", function() {
                var is_enable = $(this).data("sku-enable");
                var sku_index = $(this).data("sku-index");

                var tr_obj = $(this).parents("tr");

                var sku_id = $(tr_obj).data("sku_id");

                sku_object[sku_id].is_enable = is_enable;

                $(tr_obj).data("is_enable", is_enable);

                if (is_enable) {
                    $(this).parents(".sku-td-index").html(sku_index + '<a class="del-btn sku-item-handle" data-sku-enable=false data-sku-index="' + sku_index + '" title="点击禁用此规格">×</a>');
                    $(tr_obj).removeClass("disabled");
                    $(tr_obj).find(":input").prop("disabled", false).removeClass("error");
                } else {
                    // 至少要有一项规格，否则提示
                    if ($(tr_obj).parents("tbody").find("tr").not(".disabled").size() == 1) {
                        $.msg("如果您不想发布的商品包含任何规格，请不要勾选任何商品规格！", {
                            time: 3000
                        });
                        return;
                    }

                    $(this).parents(".sku-td-index").html(sku_index + '<a class="allow-btn sku-item-handle" data-sku-enable=true data-sku-index="' + sku_index + '" title="点击启用此规格">√</a>');
                    $(tr_obj).addClass("disabled");
                    $(tr_obj).find(":input").prop("disabled", true);
                }

                // 计算SKU信息
                $(".sku-goods-number").keyup();
                $(".sku-warn-number").keyup();
                $(".sku-goods-price").keyup();
                $(".sku-market-price").keyup();

                $(tr_obj).parents("tbody").find("tr.disabled").find(":input").removeClass("error");
            });

            $("body").on("mouseenter", "#sku_table tr", function() {
                var target = $(this).find(".sku-item-handle");
                $.tips($(target).attr("title"), target, {
                    tips: 4,
                    time: 2000
                });
            });

            // SKU商品库存合计后赋值给商品库存
            $("body").on("keyup", ".sku-goods-number", function() {
                var total_goods_number = 0;

                $(".sku-goods-number").each(function() {

                    if ($(this).parents("tr").data("is_enable") == false) {
                        return;
                    }

                    if ($(this).val().length > 0) {
                        total_goods_number += parseInt($(this).val());
                    }
                });

                //$("#libgoodsmodel-goods_number").val(total_goods_number);
            });

            // SKU库存警告数量合计后赋值给商品库存警告数量
            $("body").on("keyup", ".sku-warn-number", function() {
                var total_warn_number = 0;

                $(".sku-warn-number").each(function() {

                    if ($(this).parents("tr").data("is_enable") == false) {
                        return;
                    }

                    if ($(this).val().length > 0) {
                        total_warn_number += parseInt($(this).val());
                    }
                });

                if (total_warn_number > 255) {
                    total_warn_number = 255;
                }

                $("#libgoodsmodel-warn_number").val(total_warn_number);
            });

            // SKU商品价格最小值计算
            $("body").on("keyup", ".sku-goods-price", function() {
                var goods_price = null;

                $(".sku-goods-price").each(function() {

                    if ($(this).parents("tr").data("is_enable") == false) {
                        return;
                    }

                    if (goods_price == null || ($(this).val().length > 0 && goods_price > parseFloat($(this).val()))) {
                        goods_price = parseFloat($(this).val());
                    }
                });

                $("#libgoodsmodel-goods_price").val(goods_price);
            });

            // SKU商品市场价格最小值计算
            $("body").on("keyup", ".sku-market-price", function() {
                var market_price = 0;

                $(".sku-market-price").each(function() {

                    if ($(this).parents("tr").data("is_enable") == false) {
                        return;
                    }

                    if (market_price == 0 || ($(this).val().length > 0 && market_price > parseFloat($(this).val()))) {
                        market_price = isNaN(parseFloat($(this).val())) ? 0 : parseFloat($(this).val());
                    }

                });

                $("#libgoodsmodel-market_price").val(market_price);
            });

            // 初始化
            evalSkuTable(true);

            // 点击规格值拼接表格
            $("body").on("click", ".spec-value", function() {
                evalSkuTable();
            });

            // 默认规格
            $("body").on("click", ".default-spec", function() {
                $(".default-spec").parents("span").removeClass("selected");
                $(this).parents("span").addClass("selected");
                $(this).parents("span").find(":checkbox").prop("checked", true).change();
            });

            // 点击规格分类
            $(".spec-values-item :checkbox").change(function() {

                var attr_id = $(this).val();
                var element = $(".goods-spec-item[data-spec-id='" + attr_id + "']");

                if ($(this).is(":checked")) {
                    if ($(".spec-values-item :checkbox").size() == 1 || $(".spec-values-item").filter(".selected").find(":checkbox:checked").size() == 0) {
                        $(".spec-values-item").removeClass("selected");
                        $(this).parents(".spec-values-item").addClass("selected");
                    }

                    $(element).show();
                } else {
                    var is_default = $(this).parents(".spec-values-item").hasClass("selected");
                    $(this).parents(".spec-values-item").removeClass("selected");

                    $(element).hide();

                    if ($(element).find(":checkbox:checked").size() > 0) {
                        $(element).find(":checkbox").prop("checked", false);
                        // 重新计算
                        evalSkuTable();
                    }

                    // 如果此元素被选择则让下一个被选择的被选择
                    if (is_default) {
                        $(".spec-values-item").find(":checkbox:checked").first().parents(".spec-values-item").addClass("selected");
                    }
                }

            });

        });
        //商品相册
        $().ready(function() {

            $("#btn_imagegallery").click(function() {

                var container = $("#imagegallery_container");

                if (!$.imagegallery(container)) {
                    $(this).html("<i class=\"fa fa-picture-o\"></i>关闭图片空间");
                    if ($(this).data("toggle") == false) {
                        $(container).show();
                        $(this).data("toggle", true);
                        return;
                    }
                    var imagegallery = $(container).imagegallery({
                        data: {
                            page: {
                                page_id: "ImageGallery_GoodsImage"
                            }
                        },
                        click: function(target, path) {
                            var image_url = $(target).attr("src");
                            $("#goods_image_tag").attr("src", image_url);
                            // 原图路径
                            $("#libgoodsmodel-goods_image").val(path);
                            $("#goods_image_tag").parent("a").attr("href", "{{ get_oss_host() }}" + path);
                        }
                    });
                } else {
                    if ($(container).is(":hidden")) {
                        $(this).html("<i class=\"fa fa-picture-o\"></i>关闭图片空间");
                        $(container).show();
                    } else {
                        $(this).html("<i class=\"fa fa-picture-o\"></i>从图片空间选择");
                        $(container).hide();
                    }
                }

            });

            // 图片空间
            $("#btn_pc_desc_imagegallery").click(function() {

                var container = $("#pc_desc_imagegallery_container");

                if (!$.imagegallery(container)) {
                    $(this).html("<i class=\"fa fa-picture-o\"></i>关闭相册图片");
                    if ($(this).data("toggle") == false) {
                        $(container).show();
                        $(this).data("toggle", true);
                        return;
                    }
                    var imagegallery = $(container).imagegallery({
                        data: {
                            page: {
                                page_id: "ImageGallery_PcDesc"
                            }
                        },
                        click: function(target, path, url) {
                            var image_url = $(target).data("url");

                            var tab_obj = $("#product-details").find(".desc-tab[aria-expanded=true]");

                            if ($(tab_obj).hasClass("mobile-desc")) {
                                var template = $("#mobile_image_template").html();
                                var element = $($.parseHTML(template));
                                $(element).find("img").attr("src", url);
                                $(element).find("img").data("path", path);
                                $(".mobile-editor").find(".control-panel").append(element);
                            } else {
                                // 获取商品详情
                                KindEditor.ready(function(K) {
                                    K.insertHtml("#pc_desc", "<img src='"+image_url+"' />");
                                });
                            }
                        }
                    });
                } else {

                    if ($(container).is(":hidden")) {
                        $(this).html("<i class=\"fa fa-picture-o\"></i>关闭相册图片");
                        $(container).show();
                    } else {
                        $(this).html("<i class=\"fa fa-picture-o\"></i>批量插入相册图片");
                        $(container).hide();
                    }
                }
            });

            // 商品主图
            $("#goods_image_container").imagegroup({
                host: "{{ get_oss_host() }}",
                values: [""],
                gallery: true,
                callback: function(result) {
                    var values = this.getValues();
                    var value = values.length > 0 ? values[0] : "";
                    $("#libgoodsmodel-goods_image").val(value);
                },
                remove: function() {
                    $("#libgoodsmodel-goods_image").val("");
                }
            });

            // 商品主图视频
            $("#goods_video_container").videogroup({
                host: "{{ get_oss_host() }}",
                values: [""],
                gallery: true,
                options: {
                    minDuration: "0",
                    maxDuration: "90",
                },
                callback: function(data) {
                    var values = this.getValues();
                    var value = values.length > 0 ? values[0] : "";
                    $("#libgoodsmodel-goods_video").val(value);
                },
                remove: function() {
                    $("#libgoodsmodel-goods_video").val("");
                }
            });

            $("#btn_upload_pc_desc").click(function() {
                $.imageupload({
                    url: '/site/upload-goods-desc-image',
                    multiple: true,
                    callback: function(result) {
                        if (result.code == 0 && result.data) {
                            if (!$.isArray(result.data)) {
                                result.data = [result.data];
                            }

                            $.each(result.data, function(i, data) {
                                var path = data.path;
                                var image_url = data.url;

                                var tab_obj = $("#product-details").find(".desc-tab[aria-expanded=true]");

                                if ($(tab_obj).hasClass("mobile-desc")) {
                                    var template = $("#mobile_image_template").html();
                                    var element = $($.parseHTML(template));
                                    $(element).find("img").attr("src", image_url);
                                    $(element).find("img").data("path", path);
                                    $(".mobile-editor").find(".control-panel").append(element);
                                } else {
                                    // 获取商品详情
                                    KindEditor.ready(function(K) {
                                        K.insertHtml("#pc_desc", "<img src='"+image_url+"' />");
                                    });
                                }
                            });
                        } else if (result.message) {
                            $.msg(result.message, {
                                time: 5000
                            })
                        }
                    }
                });
            });

            $("body").on("change", "#file_pc_desc", function() {
                var file_id = $(this).attr("id");
                var value = $(this).val();
                if (value.length > 0) {
                    $.ajaxFileUpload({
                        url: '/site/upload-goods-desc-image',
                        fileElementId: file_id,
                        dataType: 'json',
                        success: function(result, status) {
                            if (result.code == 0 && result.data) {
                                var path = result.data.path;
                                var image_url = result.data.url;

                                var tab_obj = $("#product-details").find(".desc-tab[aria-expanded=true]");

                                if ($(tab_obj).hasClass("mobile-desc")) {
                                    var template = $("#mobile_image_template").html();
                                    var element = $($.parseHTML(template));
                                    $(element).find("img").attr("src", image_url);
                                    $(element).find("img").data("path", path);
                                    $(".mobile-editor").find(".control-panel").append(element);
                                } else {
                                    // 获取商品详情
                                    KindEditor.ready(function(K) {
                                        K.insertHtml("#pc_desc", "<img src='"+image_url+"' />");
                                    });
                                }

                            } else if (result.message) {
                                $.msg(result.message, {
                                    time: 5000
                                })
                            }
                        }
                    });
                }
            });
            // 刷新运费模板
            $(".refresh-freight-list").click(function() {
                $.get('/goods/lib-goods/freights', {}, function(result) {
                    if (result.code == 0) {
                        var html = "<option value=''>--请选择--</option>";

                        for (var i = 0; i < result.data.length; i++) {
                            var item = result.data[i];
                            html += "<option value='"+item.freight_id+"'>" + item.title + "</option>";
                        }

                        $("#libgoodsmodel-freight_id").html(html);
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "json");

                $("#goods_freight_info").hide();
            });

            // 查看运费模板
            $(".freight-info").click(function() {
                var id = $(".freight-list").val();
                if (id == '') {
                    return;
                }
                $.go("/shop/freight/edit?id=" + id, "_blank");
            });

            // 刷新运费模板
            $(".freight-list").change(function() {
                var id = $(this).val();

                if (id == '') {
                    $("#goods_freight_info").hide();
                    return;
                }

                $.get("/shop/freight/desc", {
                    id: id
                }, function(result) {
                    if (result.code == 0) {
                        $("#goods_freight_info").find(".default-desc").html("默认运费：" + result.data.default_desc);
                        if (result.data.desc) {
                            $("#goods_freight_info").find(".other-desc-title").show();
                            $("#goods_freight_info").find(".other-desc").show();
                            $("#goods_freight_info").find(".other-desc").html(result.data.region_names + " " + result.data.desc);
                        } else {
                            $("#goods_freight_info").find(".other-desc-title").hide();
                            $("#goods_freight_info").find(".other-desc").hide();
                        }
                        if (result.data.freight.limit_sale == 1) {
                            $("#goods_freight_info").find(".limit-sale").show();
                        } else {
                            $("#goods_freight_info").find(".limit-sale").hide();
                        }
                        if (result.data.freight.is_free == 1) {
                            $("#goods_freight_info").find(".is-free").show();
                        } else {
                            $("#goods_freight_info").find(".is-free").hide();
                        }

                        if (result.data.freight.free_set == 1) {
                            $("#goods_freight_info").find(".free-set").show();
                        } else {
                            $("#goods_freight_info").find(".free-set").hide();
                        }

                        $("#goods_freight_info").find(".goods-from").html(result.data.freight.region_names);

                        $("#goods_freight_info").show();
                    }
                }, "json");
            });
            $(".freight-list").change();
        });
    </script>
    <!-- JSON2 -->
    <script src="/assets/d2eace91/js/jquery.json-2.4.js?v=1.2"></script>
    <!-- 在线文本编辑器 -->
    <script src="/assets/d2eace91/js/editor/kindeditor-all.min.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/editor/lang/zh_CN.js?v=1.2"></script>
    <!-- 创建KindEditor的脚本 必须设置editor_id属性-->
    <script type="text/javascript">
        KindEditor.ready(function(K) {
            window.editor = K.create('#pc_desc', {
                items: ['source', '|', 'fullscreen', 'undo', 'redo', 'print', 'cut', 'copy', 'paste', 'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright', 'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript', 'superscript', '|', 'selectall', 'clearhtml', 'quickformat', '|', 'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'flash', 'media', 'table', 'hr', 'emoticons', 'link', 'unlink', '|', 'about'],
                cssPath: "/assets/d2eace91/js/editor/themes/default/default.css",
                allowImageUpload: false,
                allowFlashUpload: false,
                allowMediaUpload: false,
                allowFileManager: false,
                syncType: "form",
                afterCreate: function() {
                    var self = this;
                    self.sync();
                },
                afterChange: function() {
                    var self = this;
                    self.sync();
                },
                afterBlur: function() {
                    var self = this;
                    self.sync();
                }
            });
        });
    </script>
    <!-- 手机端详情 -->
    <script type="text/javascript">
        $().ready(function() {

            // 添加文本
            $("#btn_mobile_add_text").click(function() {
                $("#mobile_text_editor").show();
                $("#mobile_text_editor").css("z-index", 99);
                $("#mobile_text_editor").offset({
                    top: $(".content-edit").offset().top,
                    left: $(".content-edit").offset().left
                });
            });

            // 添加手机端图片
            $("#btn_mobile_add_image").click(function() {
                $.imageupload({
                    url: '/site/upload-mobile-image',
                    callback: function(result) {
                        if (result.code == 0) {
                            var template = $("#mobile_image_template").html();
                            var element = $($.parseHTML(template));
                            $(element).find("img").attr("src", result.data.url);
                            $(element).find("img").data("path", result.data.path);
                            $(".mobile-editor").find(".control-panel").append(element);
                        } else {
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    }
                });
            });

            $("#mobile_text_editor").find(".ok").click(function() {
                var content = $("#mobile_text_editor").find("textarea").val();

                var target = $("#mobile_text_editor").find("textarea").data("target");

                if (target == null) {
                    var template = $("#mobile_text_template").html();
                    var element = $($.parseHTML(template));
                    $(element).find(".text-html").html("");
                    // 防止执行js
                    $(element).find(".text-html").append($.parseHTML(content));
                    var html = $(element).find(".text-html").html();
                    if (html.length == 0) {
                        $("#mobile_text_editor").find("textarea").val("");
                        $("#mobile_text_editor").hide();
                        return;
                    }
                    $(".mobile-editor").find(".control-panel").append(element);
                } else {
                    $(target).html("");
                    // 防止执行js
                    $(target).html($.parseHTML(content));
                    var html = $(target).html();
                    if (html.length == 0) {
                        $("#mobile_text_editor").find("textarea").val("");
                        $("#mobile_text_editor").hide();
                        return;
                    }
                }

                // 置空
                $("#mobile_text_editor").find("textarea").data("target", null);

                $("#mobile_text_editor").find("textarea").val("");
                $("#mobile_text_editor").hide();
            });

            $("#mobile_text_editor").find(".cancel").click(function() {
                $("#mobile_text_editor").find("textarea").val("");
                $("#mobile_text_editor").hide();
            });

            $("body").click(function() {
                $(".control-panel").find(".current").removeClass("current");
            });

            // 点击展示出遮罩层和工具栏
            $("body").on("click", "div .module", function() {
                $(this).parents(".control-panel").find(".current").removeClass("current");
                $(this).addClass("current");
                return false;
            });
            //上移
            $(".control-panel").on("click", ".up", function() {
                if ($(this).parents(".module").prev().size() == 0) {
                    $.msg("已经到最顶端了");
                    return;
                }
                var target = $(this).parents(".module");
                $(target).insertBefore($(this).parents(".module").prev());
            });
            //下移
            $(".control-panel").on("click", ".down", function() {
                if ($(this).parents(".module").next().size() == 0) {
                    $.msg("已经到最低端了");
                    return;
                }
                var target = $(this).parents(".module");
                $(target).insertAfter($(this).parents(".module").next());
            });
            //移除
            $(".control-panel").on("click", ".delete", function() {
                $(this).parents(".module").remove();
            });
            //编辑
            $(".control-panel").on("click", ".edit", function() {
                var content = $(this).parents(".module").find(".text-html").html();
                $("#mobile_text_editor").find("textarea").val(content);
                //保存编辑目标信息
                $("#mobile_text_editor").find("textarea").data("target", $(this).parents(".module").find(".text-html"));
                $("#btn_mobile_add_text").click();
            });
            //替换
            $(".control-panel").on("click", ".replace", function() {
                var target = $(this).parents(".module");
                $.imageupload({
                    url: '/site/upload-mobile-image',
                    callback: function(result) {
                        if (result.code == 0) {
                            $(target).find("img").attr("src", result.data.url);
                            $(target).find("img").data("path", result.data.path);
                        } else {
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    }
                });
            });
        });
    </script>
    <!-- 发布商品 -->
    <script type="text/javascript">
        $().ready(function() {
            $(".panel-collapse .panel-body").mCustomScrollbar();
            var validator = $("#LibGoodsModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules("[{\"id\": \"libgoodsmodel-goods_name\", \"name\": \"LibGoodsModel[goods_name]\", \"attribute\": \"goods_name\", \"rules\": {\"required\":true,\"messages\":{\"required\":\"商品名称不能为空。\"}}},{\"id\": \"libgoodsmodel-cat_id\", \"name\": \"LibGoodsModel[cat_id]\", \"attribute\": \"cat_id\", \"rules\": {\"required\":true,\"messages\":{\"required\":\"商品分类ID不能为空。\"}}},{\"id\": \"libgoodsmodel-goods_price\", \"name\": \"LibGoodsModel[goods_price]\", \"attribute\": \"goods_price\", \"rules\": {\"required\":true,\"messages\":{\"required\":\"店铺价不能为空。\"}}},{\"id\": \"libgoodsmodel-add_time\", \"name\": \"LibGoodsModel[add_time]\", \"attribute\": \"add_time\", \"rules\": {\"required\":true,\"messages\":{\"required\":\"商品发布时间不能为空。\"}}},{\"id\": \"libgoodsmodel-last_time\", \"name\": \"LibGoodsModel[last_time]\", \"attribute\": \"last_time\", \"rules\": {\"required\":true,\"messages\":{\"required\":\"最后一次更新时间不能为空。\"}}},{\"id\": \"libgoodsmodel-sku_open\", \"name\": \"LibGoodsModel[sku_open]\", \"attribute\": \"sku_open\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"Sku Open必须是整数。\"}}},{\"id\": \"libgoodsmodel-sku_id\", \"name\": \"LibGoodsModel[sku_id]\", \"attribute\": \"sku_id\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"Sku Id必须是整数。\"}}},{\"id\": \"libgoodsmodel-cat_id\", \"name\": \"LibGoodsModel[cat_id]\", \"attribute\": \"cat_id\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"商品分类ID必须是整数。\"}}},{\"id\": \"libgoodsmodel-invoice_type\", \"name\": \"LibGoodsModel[invoice_type]\", \"attribute\": \"invoice_type\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"发票必须是整数。\"}}},{\"id\": \"libgoodsmodel-is_repair\", \"name\": \"LibGoodsModel[is_repair]\", \"attribute\": \"is_repair\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"保修必须是整数。\"}}},{\"id\": \"libgoodsmodel-user_discount\", \"name\": \"LibGoodsModel[user_discount]\", \"attribute\": \"user_discount\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"会员打折必须是整数。\"}}},{\"id\": \"libgoodsmodel-stock_mode\", \"name\": \"LibGoodsModel[stock_mode]\", \"attribute\": \"stock_mode\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"库存计数必须是整数。\"}}},{\"id\": \"libgoodsmodel-warn_number\", \"name\": \"LibGoodsModel[warn_number]\", \"attribute\": \"warn_number\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"库存警告数量必须是整数。\"}}},{\"id\": \"libgoodsmodel-brand_id\", \"name\": \"LibGoodsModel[brand_id]\", \"attribute\": \"brand_id\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"品牌ID必须是整数。\"}}},{\"id\": \"libgoodsmodel-top_layout_id\", \"name\": \"LibGoodsModel[top_layout_id]\", \"attribute\": \"top_layout_id\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"商品顶部模板编号必须是整数。\"}}},{\"id\": \"libgoodsmodel-bottom_layout_id\", \"name\": \"LibGoodsModel[bottom_layout_id]\", \"attribute\": \"bottom_layout_id\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"商品底部模板编号必须是整数。\"}}},{\"id\": \"libgoodsmodel-packing_layout_id\", \"name\": \"LibGoodsModel[packing_layout_id]\", \"attribute\": \"packing_layout_id\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"Packing Layout Id必须是整数。\"}}},{\"id\": \"libgoodsmodel-service_layout_id\", \"name\": \"LibGoodsModel[service_layout_id]\", \"attribute\": \"service_layout_id\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"Service Layout Id必须是整数。\"}}},{\"id\": \"libgoodsmodel-click_count\", \"name\": \"LibGoodsModel[click_count]\", \"attribute\": \"click_count\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"商品浏览次数必须是整数。\"}}},{\"id\": \"libgoodsmodel-goods_audit\", \"name\": \"LibGoodsModel[goods_audit]\", \"attribute\": \"goods_audit\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"审核是否通过必须是整数。\"}}},{\"id\": \"libgoodsmodel-goods_status\", \"name\": \"LibGoodsModel[goods_status]\", \"attribute\": \"goods_status\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"商品状态必须是整数。\"}}},{\"id\": \"libgoodsmodel-is_delete\", \"name\": \"LibGoodsModel[is_delete]\", \"attribute\": \"is_delete\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"是否已删除必须是整数。\"}}},{\"id\": \"libgoodsmodel-is_virtual\", \"name\": \"LibGoodsModel[is_virtual]\", \"attribute\": \"is_virtual\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"Is Virtual必须是整数。\"}}},{\"id\": \"libgoodsmodel-is_best\", \"name\": \"LibGoodsModel[is_best]\", \"attribute\": \"is_best\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"是否精品必须是整数。\"}}},{\"id\": \"libgoodsmodel-is_new\", \"name\": \"LibGoodsModel[is_new]\", \"attribute\": \"is_new\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"是否新品必须是整数。\"}}},{\"id\": \"libgoodsmodel-is_hot\", \"name\": \"LibGoodsModel[is_hot]\", \"attribute\": \"is_hot\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"是否热卖必须是整数。\"}}},{\"id\": \"libgoodsmodel-is_promote\", \"name\": \"LibGoodsModel[is_promote]\", \"attribute\": \"is_promote\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"是否促销必须是整数。\"}}},{\"id\": \"libgoodsmodel-supplier_id\", \"name\": \"LibGoodsModel[supplier_id]\", \"attribute\": \"supplier_id\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"供货商ID必须是整数。\"}}},{\"id\": \"libgoodsmodel-goods_sort\", \"name\": \"LibGoodsModel[goods_sort]\", \"attribute\": \"goods_sort\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"Goods Sort必须是整数。\"}}},{\"id\": \"libgoodsmodel-add_time\", \"name\": \"LibGoodsModel[add_time]\", \"attribute\": \"add_time\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"商品发布时间必须是整数。\"}}},{\"id\": \"libgoodsmodel-last_time\", \"name\": \"LibGoodsModel[last_time]\", \"attribute\": \"last_time\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"最后一次更新时间必须是整数。\"}}},{\"id\": \"libgoodsmodel-comment_num\", \"name\": \"LibGoodsModel[comment_num]\", \"attribute\": \"comment_num\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"商品评论次数必须是整数。\"}}},{\"id\": \"libgoodsmodel-sale_num\", \"name\": \"LibGoodsModel[sale_num]\", \"attribute\": \"sale_num\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"商品销售数量必须是整数。\"}}},{\"id\": \"libgoodsmodel-collect_num\", \"name\": \"LibGoodsModel[collect_num]\", \"attribute\": \"collect_num\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"商品收藏数量必须是整数。\"}}},{\"id\": \"libgoodsmodel-lib_cat_id\", \"name\": \"LibGoodsModel[lib_cat_id]\", \"attribute\": \"lib_cat_id\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"系统商品库商品分类必须是整数。\"}}},{\"id\": \"libgoodsmodel-goods_image\", \"name\": \"LibGoodsModel[goods_image]\", \"attribute\": \"goods_image\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"商品主图必须是一条字符串。\",\"maxlength\":\"商品主图只能包含至多255个字符。\"},\"maxlength\":255}},{\"id\": \"libgoodsmodel-goods_video\", \"name\": \"LibGoodsModel[goods_video]\", \"attribute\": \"goods_video\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"主图视频必须是一条字符串。\",\"maxlength\":\"主图视频只能包含至多255个字符。\"},\"maxlength\":255}},{\"id\": \"libgoodsmodel-goods_price\", \"name\": \"LibGoodsModel[goods_price]\", \"attribute\": \"goods_price\", \"rules\": {\"number\":{\"pattern\":\"\/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$\/\"},\"messages\":{\"number\":\"店铺价必须是一个数字。\",\"min\":\"店铺价必须不小于0。\",\"max\":\"店铺价必须不大于9999999。\"},\"min\":0,\"max\":9999999}},{\"id\": \"libgoodsmodel-market_price\", \"name\": \"LibGoodsModel[market_price]\", \"attribute\": \"market_price\", \"rules\": {\"number\":{\"pattern\":\"\/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$\/\"},\"messages\":{\"number\":\"市场价必须是一个数字。\",\"min\":\"市场价必须不小于0。\",\"max\":\"市场价必须不大于9999999。\"},\"min\":0,\"max\":9999999}},{\"id\": \"libgoodsmodel-warn_number\", \"name\": \"LibGoodsModel[warn_number]\", \"attribute\": \"warn_number\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"库存警告数量必须是整数。\",\"min\":\"库存警告数量必须不小于0。\",\"max\":\"库存警告数量必须不大于255。\"},\"min\":0,\"max\":255}},{\"id\": \"libgoodsmodel-cost_price\", \"name\": \"LibGoodsModel[cost_price]\", \"attribute\": \"cost_price\", \"rules\": {\"number\":{\"pattern\":\"\/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$\/\"},\"messages\":{\"number\":\"成本价必须是一个数字。\",\"min\":\"成本价必须不小于0。\",\"max\":\"成本价必须不大于9999999。\"},\"min\":0,\"max\":9999999}},{\"id\": \"libgoodsmodel-mobile_price\", \"name\": \"LibGoodsModel[mobile_price]\", \"attribute\": \"mobile_price\", \"rules\": {\"number\":{\"pattern\":\"\/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$\/\"},\"messages\":{\"number\":\"移动端专项价必须是一个数字。\",\"min\":\"移动端专项价必须不小于0。\",\"max\":\"移动端专项价必须不大于9999999。\"},\"min\":0,\"max\":9999999}},{\"id\": \"libgoodsmodel-pc_desc\", \"name\": \"LibGoodsModel[pc_desc]\", \"attribute\": \"pc_desc\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"商品电脑端描述必须是一条字符串。\"}}},{\"id\": \"libgoodsmodel-mobile_desc\", \"name\": \"LibGoodsModel[mobile_desc]\", \"attribute\": \"mobile_desc\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"商品手机端描述必须是一条字符串。\"}}},{\"id\": \"libgoodsmodel-contract_ids\", \"name\": \"LibGoodsModel[contract_ids]\", \"attribute\": \"contract_ids\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"保障服务必须是一条字符串。\"}}},{\"id\": \"libgoodsmodel-goods_name\", \"name\": \"LibGoodsModel[goods_name]\", \"attribute\": \"goods_name\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"商品名称必须是一条字符串。\",\"maxlength\":\"商品名称只能包含至多100个字符。\"},\"maxlength\":100}},{\"id\": \"libgoodsmodel-goods_subname\", \"name\": \"LibGoodsModel[goods_subname]\", \"attribute\": \"goods_subname\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"商品卖点必须是一条字符串。\",\"maxlength\":\"商品卖点只能包含至多140个字符。\"},\"maxlength\":140}},{\"id\": \"libgoodsmodel-goods_image\", \"name\": \"LibGoodsModel[goods_image]\", \"attribute\": \"goods_image\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"商品主图必须是一条字符串。\",\"maxlength\":\"商品主图只能包含至多255个字符。\"},\"maxlength\":255}},{\"id\": \"libgoodsmodel-keywords\", \"name\": \"LibGoodsModel[keywords]\", \"attribute\": \"keywords\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"关键词必须是一条字符串。\",\"maxlength\":\"关键词只能包含至多255个字符。\"},\"maxlength\":255}},{\"id\": \"libgoodsmodel-goods_info\", \"name\": \"LibGoodsModel[goods_info]\", \"attribute\": \"goods_info\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"商品简介必须是一条字符串。\",\"maxlength\":\"商品简介只能包含至多255个字符。\"},\"maxlength\":255}},{\"id\": \"libgoodsmodel-goods_reason\", \"name\": \"LibGoodsModel[goods_reason]\", \"attribute\": \"goods_reason\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"Goods Reason必须是一条字符串。\",\"maxlength\":\"Goods Reason只能包含至多255个字符。\"},\"maxlength\":255}},{\"id\": \"libgoodsmodel-goods_volume\", \"name\": \"LibGoodsModel[goods_volume]\", \"attribute\": \"goods_volume\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"物流体积(m3)必须是一条字符串。\",\"maxlength\":\"物流体积(m3)只能包含至多255个字符。\"},\"maxlength\":255}},{\"id\": \"libgoodsmodel-goods_weight\", \"name\": \"LibGoodsModel[goods_weight]\", \"attribute\": \"goods_weight\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"物流重量(Kg)必须是一条字符串。\",\"maxlength\":\"物流重量(Kg)只能包含至多255个字符。\"},\"maxlength\":255}},{\"id\": \"libgoodsmodel-goods_remark\", \"name\": \"LibGoodsModel[goods_remark]\", \"attribute\": \"goods_remark\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"商品备注必须是一条字符串。\",\"maxlength\":\"商品备注只能包含至多255个字符。\"},\"maxlength\":255}},{\"id\": \"libgoodsmodel-goods_sn\", \"name\": \"LibGoodsModel[goods_sn]\", \"attribute\": \"goods_sn\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"商品货号必须是一条字符串。\",\"maxlength\":\"商品货号只能包含至多60个字符。\"},\"maxlength\":60}},{\"id\": \"libgoodsmodel-goods_barcode\", \"name\": \"LibGoodsModel[goods_barcode]\", \"attribute\": \"goods_barcode\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"商品条形码必须是一条字符串。\",\"maxlength\":\"商品条形码只能包含至多60个字符。\"},\"maxlength\":60}},{\"id\": \"libgoodsmodel-invoice_type\", \"name\": \"LibGoodsModel[invoice_type]\", \"attribute\": \"invoice_type\", \"rules\": {\"in\":{\"range\":[\"0\",\"1\",\"2\"]},\"messages\":{\"in\":\"发票是无效的。\"}}},{\"id\": \"libgoodsmodel-is_repair\", \"name\": \"LibGoodsModel[is_repair]\", \"attribute\": \"is_repair\", \"rules\": {\"in\":{\"range\":[\"0\",\"1\"]},\"messages\":{\"in\":\"保修是无效的。\"}}},{\"id\": \"libgoodsmodel-user_discount\", \"name\": \"LibGoodsModel[user_discount]\", \"attribute\": \"user_discount\", \"rules\": {\"in\":{\"range\":[\"0\",\"1\"]},\"messages\":{\"in\":\"会员打折是无效的。\"}}},{\"id\": \"libgoodsmodel-stock_mode\", \"name\": \"LibGoodsModel[stock_mode]\", \"attribute\": \"stock_mode\", \"rules\": {\"in\":{\"range\":[\"0\",\"1\",\"2\"]},\"messages\":{\"in\":\"库存计数是无效的。\"}}},{\"id\": \"libgoodsmodel-goods_status\", \"name\": \"LibGoodsModel[goods_status]\", \"attribute\": \"goods_status\", \"rules\": {\"in\":{\"range\":[\"0\",\"1\",\"2\"]},\"messages\":{\"in\":\"商品状态是无效的。\"}}},{\"id\": \"libgoodsmodel-goods_sn\", \"name\": \"LibGoodsModel[goods_sn]\", \"attribute\": \"goods_sn\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"商品货号必须是一条字符串。\",\"maxlength\":\"商品货号只能包含至多20个字符。\"},\"maxlength\":20}},{\"id\": \"libgoodsmodel-goods_barcode\", \"name\": \"LibGoodsModel[goods_barcode]\", \"attribute\": \"goods_barcode\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"商品条形码必须是一条字符串。\",\"maxlength\":\"商品条形码只能包含至多1,500个字符。\"},\"maxlength\":1500}},{\"id\": \"libgoodsmodel-market_price\", \"name\": \"LibGoodsModel[market_price]\", \"attribute\": \"market_price\", \"rules\": {\"default\":0,\"messages\":{\"default\":\"\"}}},]");

            $.validator.addMethod("uniqueOtherSpecName", function(value, element, param) {
                if ($(element).siblings(":checkbox").is(":checked") == false) {
                    return true;
                }

                var is_repeat = false;

                $(element).parents("[data-spec-id]").find(".spec-other-text,[value='" + value + "']").not(element).each(function() {
                    if ($(this).siblings(":checkbox").is(":checked") == true) {
                        if ($(this).val() == value) {
                            $(element).focus();
                            is_repeat = true;
                            return false;
                        }
                    }
                });

                return !is_repeat;
            }, "自定义的规格名称不能重复");

            var error_list = [];

            $("#btn_publish").click(function() {

                var cat_id = $("#libgoodsmodel-cat_id").val();

                if (cat_id == "" || cat_id == 0) {
                    $.msg("商品分类不能为空！");
                    return false;
                }

                if (!validator.form()) {
                    var html = "";

                    error_list = validator.errorList;

                    for (var i = 0; i < validator.errorList.length; i++) {
                        var element = validator.errorList[i].element;
                        var message = validator.errorList[i].message;

                        html += "<div><a href='javascript:void(0);' data-id='" + i + "'>" + message + "</a></div>";
                    }

                    $.alert("<div id='error_list'>" + html + "</div>");

                    $("#error_list").find("a").click(function() {
                        var id = $(this).data("id");

                        var element = $(error_list[id].element);

                        $(element).focus();
                        $(window).scrollTop($(element).offset().top - $(window).height() + 120);
                    })

                    return false;
                }

                // AJAX发布商品
                var goods = $("#LibGoodsModel").serializeJson();

                goods.LibGoodsModel.mobile_desc = [];

                // 获取移动端详情
                $(".mobile-editor").find(".module").each(function() {
                    if ($(this).find(".text-html").size() > 0) {
                        var content = $(this).find(".text-html").html();
                        if (content.length > 0) {
                            goods.LibGoodsModel.mobile_desc.push({
                                'content': content,
                                'type': 0
                            });
                        }
                    } else if ($(this).find("img").size() > 0) {
                        var path = $(this).find("img").data("path");
                        if (path) {
                            goods.LibGoodsModel.mobile_desc.push({
                                'content': path,
                                'type': 1
                            });
                        }
                    }
                });

                // 获取商品属性设置
                goods.goods_attrs = [];
                $(".attr-values").each(function() {
                    var attr_id = $(this).data("attr-id");
                    var required = $(this).data("required");
                    var object = $(this).serializeJson();

                    if (object['goods_attrs']) {
                        object = object['goods_attrs'][attr_id];
                        goods.goods_attrs.push({
                            attr_id: attr_id,
                            attr_vid: object
                        });
                    }
                });

                // 获取商品规格设置
                goods.goods_specs = [];
                $(".spec-values").find(":checkbox:checked").each(function() {
                    var attr_id = $(this).data("attr-id");
                    var attr_vid = $(this).data("vid");
                    var attr_vname = $(this).data("vname");
                    var attr_desc = $(this).siblings(".spec-desc").val();

                    if (new String(attr_vid).indexOf("other_") == 0) {
                        attr_vname = $(this).siblings(".spec-other-text").val();
                        if ($.trim(attr_vname) == '') {
                            attr_vname = '其他';
                        }
                        attr_vid = getOtherValue(attr_id, attr_vname);
                    }

                    goods.goods_specs.push({
                        attr_id: attr_id,
                        attr_vid: attr_vid,
                        attr_vname: attr_vname,
                        attr_desc: attr_desc
                    });
                });

                // 获取商品SKU设置
                goods.sku_list = [];
                $("#sku_table").find("tbody").find("tr").each(function() {
                    var object = $(this).serializeJson();
                    goods.sku_list.push(object);
                });

                // 获取商品详情
                KindEditor.ready(function(K) {
                    var html = K.create("#pc_desc").html();
                    $("#pc_desc").val(html);
                    goods['LibGoodsModel']['pc_desc'] = html;
                });

                //设置其他无关属性为空
                goods.specs = null;
                goods.other_spec = null;

                // 扩展分类
                goods.other_cat_ids = [];
                $(".other-cat").find("select").each(function() {
                    if ($(this).val() != 0) {
                        goods.other_cat_ids.push($(this).val());
                    }
                });

                goods.other_attrs = [];

                // 店铺自定义属性处理
                $(".other-attrs-item").each(function() {

                    var item = $(this).serializeJson();

                    if ($.trim(item.other_attr_name) != "" || $.trim(item.other_attr_value) != "") {
                        if ($.trim(item.other_attr_name) == "") {
                            $.msg("属性名称不能为空");
                            $(this).find(".other-attr-name").focus();
                            $('html, body').animate({
                                scrollTop: $(this).offset().top - 100
                            }, 500);
                            return false;
                        } else if ($.trim(item.other_attr_value) == "") {
                            $.msg("属性值不能为空");
                            $(this).find(".other-attr-value").focus();
                            $('html, body').animate({
                                scrollTop: $(this).offset().top - 100
                            }, 500);
                            return false;
                        }
                        goods.other_attrs.push({
                            attr_name: item.other_attr_name,
                            attr_value: item.other_attr_value
                        });
                    }
                });

                // 默认规格处理
                if (goods.sku_list.length > 0) {
                    if ($(".spec-values-item").filter(".selected").find(":checkbox:checked").size() == 0) {
                        $.msg("请选择默认规格！");
                        $('html, body').animate({
                            scrollTop: $(".spec-values-item").offset().top - 100
                        }, 500);
                        return;
                    } else {
                        // 默认规格
                        goods.default_spec_id = $(".spec-values-item").filter(".selected").find(":checkbox:checked").val();
                    }
                } else {
                    goods.default_spec_id = 0;
                }

                console.info(goods);

                var data = JSON.stringify(goods);

                // 加载
                $.loading.start();

                if ("" == "") {
                    $.post('/goods/lib-goods/add?cat_id={{ $cat_id }}', {
                        data: data
                    }, function(result) {
                        // 停止加载
                        $.loading.stop();

                        if (result.code == 0) {
                            $.msg(result.message);
                            // 发布成功跳转页面
                            var goods_id = result.data;

                            // 加载
                            $.loading.start();
                            $.go('/goods/lib-goods/add-images?id=' + goods_id);
                        } else {
                            $.alert(result.message);
                        }
                    }, 'json');
                } else {
                    $.post('/goods/lib-goods/edit?id=', {
                        data: data
                    }, function(result) {
                        // 停止加载
                        $.loading.stop();

                        if (result.code == 0) {
                            $.msg(result.message, {
                                time: 2000
                            }, function() {
                                // 加载
                                $.loading.start();
                                $.go('/goods/lib-goods/edit?id=');
                            });
                        } else {
                            $.alert(result.message);
                        }
                    }, 'json');
                }

            });

            // 批量设置
            $(".btn_batch_set").click(function() {
                var field = $(this).data("field");
                var value = $(this).parents(".batch-input").find(":text").val();
                $(this).parents("table").find("[name='" + field + "']").val(value);
                $(this).parents(".batch-input").find(".batch-close").click();
                // 合计
                //if (field == 'goods_number') {
                //	$(".sku-goods-number").keyup();
                //}
                //if (field == 'warn_number') {
                //$(".sku-warn-number").keyup();
                //}
                if (field == 'goods_price') {
                    $(".sku-goods-price").keyup();
                }
                if (field == 'market_price') {
                    $(".sku-market-price").keyup();
                }
            });

            // 批量设置获取焦点
            $(".batch-edit").click(function() {
                $(this).parents(".batch").find(".batch-input").find(":text").focus();
            })

            // 刷新运费模板
            $(".refresh-layout-list").click(function() {

                $.loading.start();

                $.get('/goods/lib-goods/layouts', {}, function(result) {
                    if (result.code == 0) {

                        for (var i = 0; i < result.data.length; i++) {

                            var html = "";

                            var list = result.data[i];

                            for (var j = 0; j < list.length; j++) {
                                var item = list[j];
                                html += "<option value='"+item.layout_id+"'>" + item.layout_name + "</option>";
                            }

                            $("[data-layout-position='" + i + "']").html(html);

                        }

                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "json").always(function() {
                    $.loading.stop()
                });
            });

            $("#btn_view").click(function() {
                $.go("/goods-.html", "_blank");
            });

            //添加分类按钮
            $("#btn_addCategory").click(function() {
                $(".choosen-select-box").append("");
            });
            $(".batch-edit").mouseenter(function() {
                $.tips('点击批量设置', $(this), {
                    tips: 1,
                    time: 2000
                });
            });

            var goods_id = "";

            $("#change_category").click(function() {
                if (!confirm("此页面要求您确认想要离开 - 您输入的数据可能不会被保存。")) {
                    return false;
                }

                if (goods_id == "") {
                    $.go("/goods/lib-goods/index");
                } else {
                    $.go("/goods/lib-goods/index?id=");
                }
            });

            // 添加扩展分类
            $("#btn_add_other_cat").click(function() {
                var template = $("#other_cat_template").html();
                var element = $($.parseHTML(template));
                $(this).after(element);
                $(element).find('.chosen-select').chosen();
            });

            // 删除扩展分类
            $("body").on("click", ".other-cat-delete", function() {
                $(this).parents(".other-cat").remove();
            });

            $("#btn_add_other_attr").click(function() {
                var template = $("#other_attrs_template").html();
                $(".other-attrs-list").append(template);
            });

            $("body").on("click", ".other-attr-remove", function() {
                var target = $(this);
                $.confirm("您确定要移除此属性吗？", function(index) {
                    $(target).parents(".other-attrs-item").remove();
                });
            })

        });
    </script>
    <script type="text/javascript">
        $(function() {
            // 批量设置价格、库存、预警值
            $('.batch > .batch-edit').click(function() {
                $('.batch > .batch-input').hide();
                $(this).next().show();
            });
            $('.batch-input > .batch-close').click(function() {
                $(this).parent().hide();
            });

            // 商品描述手机端详情导入弹框
            $('.size-tip > .leading-in').click(function() {
                $('.size-tip > .build-mdetail').show();
                return false;
            });
            $('.size-tip').find('.btn-close').click(function() {
                $('.size-tip > .build-mdetail').hide();
                return false;
            });
            $('.size-tip').find('.btn-default').click(function() {
                $('.size-tip > .build-mdetail').hide();
                return false;
            });
        })
    </script>

@stop

{{--outside body script--}}
@section('outside_body_script')

@stop