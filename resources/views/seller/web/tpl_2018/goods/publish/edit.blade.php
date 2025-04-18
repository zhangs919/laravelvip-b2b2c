{{--模板继承--}}
@extends('layouts.seller_layout')

{{--header 内 css文件--}}
@section('header_css')
    <link href="/assets/d2eace91/css/jquery-ui.css" rel="stylesheet">
    <link href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css?v=2.1" rel="stylesheet">
    <link href="/assets/d2eace91/js/ztree/zTreeStyle.css" rel="stylesheet">
@stop

{{--header 内 css文件--}}
@section('header_css_2')
    <link href="/assets/d2eace91/css/highslide.css" rel="stylesheet">
@stop

{{--css style page元素同级上面--}}
@section('style')
@stop

{{--content--}}
@section('content')

    <div class="table-content">

        <div class="content m-t-30">
            <div class="goods-info-two">
                <form id="GoodsModel" class="form-horizontal" name="GoodsModel" action="/goods/publish/edit?id={{ $model['goods_id'] }}" method="POST">
                    @csrf
                    <!-- 分类编号 -->
                    <input type="hidden" id="goodsmodel-cat_id" class="form-control" name="GoodsModel[cat_id]" value="{{ $model['cat_id'] }}">
                    <!-- 是否跨境商品 -->
                    <input type="hidden" id="goodsmodel-is_cross_border" class="form-control" name="GoodsModel[is_cross_border]" value="{{ $model['is_cross_border'] }}">
                    <h5 class="m-b-30">商品基本信息</h5>
                    <div class="simple-form-field">
                        <div class="form-group">
                            <label for="text4" class="col-sm-3 control-label">
                                <span class="text-danger ng-binding">*</span>
                                <span class="ng-binding">商品分类：</span>
                            </label>
                            <div class="col-sm-9">
                                <label class="control-label" data-anchor="商品分类">{!! $cat_names !!}</label>
                                <input type="hidden" id="goodsmodel-cat_id" class="form-control"
                                       name="GoodsModel[cat_id]" value="{{ $cat_id }}">

                                @if($cat_edit)
                                    <a id="change_category" href="javascript:void(0);" class="btn btn-warning btn-sm m-l-5" data-goods-id="{{ $model['goods_id'] }}">编辑商品分类</a>
                                @else
                                    <a title="参与限时折扣的商品不能编辑分类" href="javascript:void(0);" class="btn btn-warning btn-sm m-l-5 disabled" data-goods-id="202">编辑商品分类</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- 商品类别 -->

                    <div class="simple-form-field" >
                        <div class="form-group">
                            <label for="goodsmodel-goods_mode" class="col-sm-3 control-label">

                                <span class="ng-binding">商品类别：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">



                                    <label class="control-label cur-p m-r-10">



                                        <input type="radio" value="0"  checked='checked' disabled="disabled">
                                        实物商品（物流发货）
                                    </label>

                                    <label class="control-label cur-p m-r-10">

                                        <input type="radio" value="1" 0 disabled="disabled">
                                        电子卡券（无需物流）
                                    </label>

                                    <label class="control-label cur-p m-r-10">

                                        <input type="radio" value="2" 0 disabled="disabled">
                                        服务商品（无需物流）
                                    </label>

                                    <input type="hidden" id="goodsmodel-goods_mode" class="form-control" name="GoodsModel[goods_mode]" value="0">



                                </div>

                                <div class="help-block help-block-t"></div>
                            </div>
                        </div>
                    </div>

                    <!---扩展分类-->
                    <div class="simple-form-field" >
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">

                                <span class="ng-binding">扩展分类：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">

                                    <div class="form-control-box choosen-select-box">
                                        <div id="other_cat_container"></div>
                                        <input type="text" id="other_cat_ids" class="form-control" value="{{ implode(',', array_column($other_cat_ids, 'cat_id')) }}" style="display: none;">
                                    </div>

                                </div>

                                <div class="help-block help-block-t"></div>
                            </div>
                        </div>
                    </div>
                    <!--新加批发 start-->
                    <div class="simple-form-field" style="display: none">
                        <div class="form-group">
                            <label for="text4" class="col-sm-3 control-label">
                                <span class="ng-binding">预售设置：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">
                                    <label class="control-label cur-p">
                                        <input class="cur-p" type="checkbox" />
                                        预售商品
                                    </label>
                                </div>
                                <div class="help-block help-block-t">预售商品不支持加入购物车</div>
                            </div>
                        </div>
                    </div>
                    <div class="simple-form-field" style="display: none">
                        <div class="form-group">
                            <label for="text4" class="col-sm-3 control-label">
                                <span class="text-danger ng-binding">*</span>
                                <span class="ng-binding">发货时间：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">
                                    <label class="control-label cur-p m-r-10">
                                        <input class="cur-p" type="radio" name="radio-date" checked="checked" />
                                        <input class="form-control form_datetime w150 m-r-10" type="text">
                                        开始发货
                                    </label>
                                    </br>
                                    <label class="control-label cur-p m-r-10">
                                        <input class="cur-p" type="radio" type="text" name="radio-date" />
                                        付款成功
                                        <input class="form-control w90 m-l-10 m-r-10">
                                        天后发货
                                    </label>
                                </div>
                                <div class="help-block help-block-t">约定几号开始发货，开始发货当前，预售活动自动结束，只允许设置90天内的发货时间，请务必按照约定时间发货以免引起客户投诉设置付款成功x天后发货，预售活动无结束时间。</div>
                            </div>
                        </div>
                    </div>
                    <!--新加 end-->
                    <!-- 商品名称 -->
                    <div class="simple-form-field" >
                        <div class="form-group">
                            <label for="goodsmodel-goods_name" class="col-sm-3 control-label">
                                <span class="text-danger ng-binding">*</span>
                                <span class="ng-binding">商品名称：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">


                                    <input type="text" id="goodsmodel-goods_name" class="form-control" name="GoodsModel[goods_name]" value="{{ $model['goods_name'] }}" data-anchor="商品名称">


                                </div>

                                <div class="help-block help-block-t"><div class="help-block help-block-t">商品标题名称长度至少3个字，最长60个字</div></div>
                            </div>
                        </div>
                    </div>

                    <!-- 商品原地址 -->
                    @if(!empty($third_url))
                        <div class="simple-form-field">
                            <div class="form-group">
                                <label for="text4" class="col-sm-3 control-label">
                                    <span class="text-danger ng-binding"></span>
                                    <span class="ng-binding">商品原地址：</span>
                                </label>
                                <div class="col-sm-9">
                                    <div class="form-control-box">
                                        <label class="control-label">
                                            <a href="{{ $third_url }}" target="_blank">{{ $third_url }}</a>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- 商品原id -->
                    @if(!empty($third_id))
                        <div class="simple-form-field">
                            <div class="form-group">
                                <label for="text4" class="col-sm-3 control-label">
                                    <span class="text-danger ng-binding"></span>
                                    <span class="ng-binding">商品原id：</span>
                                </label>
                                <div class="col-sm-9">
                                    <div class="form-control-box">
                                        <label class="control-label">{{ $third_id }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- 商品关键词 -->
                    <div class="simple-form-field" >
                        <div class="form-group">
                            <label for="goodsmodel-keywords" class="col-sm-3 control-label">

                                <span class="ng-binding">关键词：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">


                                    <input type="text" id="goodsmodel-keywords" class="form-control" name="GoodsModel[keywords]" value="{{ $model['keywords'] }}">


                                </div>

                                <div class="help-block help-block-t"><div class="help-block help-block-t">关键词之间用空格分割，设置后有利于搜索引擎优化</div></div>
                            </div>
                        </div>
                    </div>
                    <!-- 商品卖点 -->
                    <div class="simple-form-field" >
                        <div class="form-group">
                            <label for="goodsmodel-goods_subname" class="col-sm-3 control-label">

                                <span class="ng-binding">商品卖点：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">


                                    <textarea id="goodsmodel-goods_subname" class="form-control" name="GoodsModel[goods_subname]" rows="5">{!! $model['goods_subname'] !!}</textarea>


                                </div>

                                <div class="help-block help-block-t"><div class="help-block help-block-t">商品卖点最长不能超过140个字，设置后有利于搜索引擎优化</div></div>
                            </div>
                        </div>
                    </div>
                    <!-- 计价方式 -->
                    <div class="simple-form-field" >
                        <div class="form-group">
                            <label for="goodsmodel-pricing_mode" class="col-sm-3 control-label">

                                <span class="ng-binding">计价方式：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">


                                    <input type="hidden" name="GoodsModel[pricing_mode]" value="0">
                                    <div id="goodsmodel-pricing_mode" class="" name="GoodsModel[pricing_mode]">
                                        <label class="control-label cur-p m-r-10">
                                            <input type="radio" name="GoodsModel[pricing_mode]" value="0" @if($model['pricing_mode'] == 0){{ 'checked' }}@endif> 计件</label>
                                        <label class="control-label cur-p m-r-10"><input type="radio" name="GoodsModel[pricing_mode]" value="1" @if($model['pricing_mode'] == 1){{ 'checked' }}@endif> 计重</label>
                                    </div>


                                </div>

                                <div class="help-block help-block-t"></div>
                            </div>
                        </div>
                    </div>
                    <!-- 商品单位 -->
                    <div class="simple-form-field" >
                        <div class="form-group">
                            <label for="goodsmodel-goods_unit" class="col-sm-3 control-label">

                                <span class="ng-binding">商品单位：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">

                                    <div class="w150 disp-inlblock">
                                        <select id="goodsmodel-goods_unit" class="form-control chosen-select" name="GoodsModel[goods_unit]">
                                            @foreach($goods_unit_list as $k=>$v)
                                                <option value="{{ $k }}" @if($model['goods_unit'] == $k) selected="selected" @endif>{{ $v }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <a class="btn btn-warning btn-sm m-l-5" href="/goods/goods-unit/list" target="blank">新建商品单位</a>
                                    <a class="btn btn-primary btn-sm m-l-5 reload_btn">重新加载</a>


                                </div>

                                <div class="help-block help-block-t"></div>
                            </div>
                        </div>
                    </div>
                    <!--新加批发 start-->
                    <!-- 销售模式 -->
                    <div class="simple-form-field" >
                        <div class="form-group">
                            <label for="goodsmodel-sales_model" class="col-sm-3 control-label">
                                <span class="ng-binding">销售模式：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">
                                    <label class="control-label cur-p m-r-10">
                                        <input type="radio" value="0"  checked='checked' disabled="disabled">
                                        零售
                                    </label>
                                    <i class="fa fa-question-circle f16 c-ddd m-r-20 cur-p" data-toggle="popover" data-trigger="hover" data-placement="right" data-html="true" data-content="<img width='200' height='180' src='/images/goods/pattern0.png'>"></i>
                                    <label class="control-label cur-p m-r-10">
                                        <input type="radio" value="1" 0 disabled="disabled">
                                        批发
                                    </label>
                                    <i class="fa fa-question-circle f16 c-ddd m-r-20 cur-p" data-toggle="popover" data-trigger="hover" data-placement="right" data-html="true" data-content="<img width='200' height='180' src='/images/goods/pattern1.png'>"></i>
                                    <input type="hidden" id="goodsmodel-sales_model" class="form-control" name="GoodsModel[sales_model]" value="0">
                                </div>
                                <div class="help-block help-block-t"><div class="help-block help-block-t">“零售型”适用于多规格、且有可能规格价格不一的商品，但零售商品不可设置购买数量阶梯价格段；“批发型”适用于多规格但价格统一的商品，此类型可设定整体购买数量阶梯价格段规则。根据选择的销售模式不同，销售规则将对应改变；销售模式一旦设置，即不可修改。</div></div>
                            </div>
                        </div>
                    </div>
                    <div class="simple-form-field goods-stepped-price hide">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                <span class="ng-binding">阶梯价格：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box m-r-0" style="width: 785px;">
                                    <table class="table table-blue w400 pull-left m-r-15 goods-stepped-price-table m-b-0">
                                        <thead>
                                        <tr>
                                            <th>
                                                <span class="text-danger ng-binding m-r-5">*</span>
                                                购买数量
                                            </th>
                                            <th>
                                                <span class="text-danger ng-binding m-r-5">*</span>
                                                商品单价
                                            </th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody class="append">
                                        </tbody>
                                        <tr class="">
                                            <td colspan="3">
                                                <a class="btn btn-warning btn-sm add-step-price" href="javascript:void(0)">
                                                    <i class="fa fa-plus"></i>
                                                    添加价格区间
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                    <table class="table table-warning pull-right goods-stepped-price-preview m-b-0" style="width: 370px;">
                                        <thead>
                                        <tr>
                                            <th>
                                                设置预览
                                                <i class="fa fa-question-circle m-l-5" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="阶梯价格同时满足购买数量时，以较低的价格为准"></i>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--新加批发 end-->
                    <!---商品品牌-->
                    <div class="simple-form-field" >
                        <div class="form-group">
                            <label for="goodsmodel-brand_id" class="col-sm-3 control-label">

                                <span class="ng-binding">商品品牌：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">

                                    <select name="GoodsModel[brand_id]" class="form-control chosen-select">
                                        @foreach($brand_list as $v)
                                            <option value="{{ $v['brand_id'] }}" @if($model['brand_id'] == $v['brand_id']) selected="selected" @endif>{{ $v['brand_name'] }}</option>
                                        @endforeach
                                    </select>

                                </div>

                                <div class="help-block help-block-t"><div class="help-block help-block-t">选择您的商品品牌，有利于商品通过品牌索引方式被找到；如没有您想要的品牌，可联系平台方添加后再选择</div></div>
                            </div>
                        </div>
                    </div>

                    <!-- 商品属性 -->
                    <div class="simple-form-field" >
                        <div class="form-group">
                            <label for="goodsmodel-goods_attr" class="col-sm-3 control-label">

                                <span class="ng-binding">商品属性：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">

                                    <div class="goods-attr w800" data-anchor="商品属性">

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
                                                                               name="goods_attrs[{{ $v['attr_id'] }}]" data-rule-required="@if($v['is_required'] == 1){{ $v['is_required'] }}@endif" data-msg="@if($v['is_required'] == 1){{ $v['attr_name'] }}不能为空！ @endif">
                                                                        <!-- 品牌属性 -->
                                                                    @elseif($v['attr_style'] == 1)
                                                                        {{--单选--}}
                                                                        <select id="goods_attrs_{{ $v['attr_id'] }}" class="form-control chosen-select" name="goods_attrs[{{ $v['attr_id'] }}]" data-rule-required="@if($v['is_required'] == 1){{ $v['is_required'] }}@endif" data-msg="@if($v['is_required'] == 1){{ $v['attr_name'] }}不能为空！ @endif">
                                                                            <option value=""></option>
                                                                            @foreach($attr_values[$v['attr_id']] as $av)
                                                                                <option value="{{ $av['id'] }}" @if(isset($goods_attrs[$v['attr_id']]) && in_array($av['id'], $goods_attrs[$v['attr_id']])) selected @endif>{{ $av['value'] }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    @elseif($v['attr_style'] == 0)
                                                                        {{--多选--}}
                                                                        @foreach($attr_values[$v['attr_id']] as $av)
                                                                            <label class="control-label cur-p m-r-10">

                                                                                <input type="checkbox" id="goods_attrs_{{ $v['attr_id'] }}_{{ $av['id'] }}" @if(isset($goods_attrs[$v['attr_id']]) && in_array($av['id'], $goods_attrs[$v['attr_id']])) checked="checked" @endif name="goods_attrs[{{ $v['attr_id'] }}][]" value="{{ $av['id'] }}" data-rule-required="@if($v['is_required'] == 1){{ $v['is_required'] }}@endif" data-msg="@if($v['is_required'] == 1){{ $v['attr_name'] }}不能为空！ @endif">

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


                                        <div class="goods-attr-tit">
                                            <span>店铺自定义属性</span>
                                            <font class="pull-right c-999">温馨提示：鼠标滑过右侧小图标查看在页面如何显示
                                                <i class="fa fa-question-circle f16 c-ccc cur-p m-l-5" data-toggle="popover" data-trigger="hover" data-placement="left" data-html="true" data-content="<img width='260' height='173' src='/images/goods/custom-attributes.png'>"></i>
                                            </font>
                                        </div>
                                        <div class="other-attrs-list">

                                            @if(!empty($model['other_attrs']))
                                            @foreach($model['other_attrs'] as $v)
                                            <div class="simple-form-field other-attrs-item">
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">
                                                        <input type="text" class="form-control w80 other-attr-name" name="other_attr_name" value="{{ $v['attr_name'] }}" placeholder="属性名" />
                                                        ：
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <div class="form-control-box  control-label">
                                                            <input type="text" class="form-control w450 other-attr-value" name="other_attr_value" value="{{ $v['attr_value'] }}" placeholder="属性值，多个值间用英文逗号分割" />
                                                            <a class="btn btn-danger btn-sm m-l-5 other-attr-remove">移除</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @endif

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
                    <style type="text/css">
                        .goods-spec .form-control-box {
                            width: 90% !important;
                            max-width: 90%;
                        }
                        .goods-spec .tree-chosen-box {
                            width: 100% !important;
                            max-width: 100%;
                        }
                        .goods-spec .tree-chosen-input-box {
                            width: 100% !important;
                            max-width: 100%;
                        }
                        .goods-spec .tree-chosen-panel-box {
                            width: 350px;
                        }
                        .goods-spec .ztree li>span.switch {
                            display: none;
                        }
                        .goods-spec .tree-chosen-input-box, .goods-spec .spec-name {
                            min-height: 30px;
                        }
                        /**
                        .goods-specs .ztree * {
                            font-size: 14px !important;
                        }
                        .goods-specs .ztree li>span {
                            height: 24px !important;
                        }
                        **/
                    </style>
                    <!-- 商品规格 -->
                    <div class="simple-form-field" >
                        <div class="form-group">
                            <label for="goodsmodel-goods_spec" class="col-sm-3 control-label">
                                <span class="ng-binding">商品规格：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">
                                    <div id="goods_specs" class="goods-spec w800" data-anchor="商品规格">
                                        <div class="simple-form-field spec-title-box">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label w100">选择规格：&nbsp;</label>
                                                <div class="col-sm-9 goods-spec-names">
                                                    <!-- 规格选择器 -->
                                                    <div id="spec_selector_container"></div>
                                                </div>
                                            </div>
                                            <i class="fa fa-question-circle f16 c-fff cur-p pos-a" style="right: 18px; top: 24px;" data-toggle="popover" data-trigger="hover" data-placement="left" data-html="true" data-content="1、如果规格变为不可选择状态，代表此商品正在参与预售活动；</br>2、如果商品店铺价变为不可修改状态，代表此商品正在参加搭配套餐。"></i>
                                            <a id="btn_add_shop_spec" href="javascript:void(0);" class="btn btn-warning btn-sm pos-a" style="right: 45px; top: 21px;" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="如果没有找到合适的规格，您可以点击此处添加自定义规格！">
                                                <i class="fa fa-plus"></i> 添加自定义规格
                                            </a>
                                        </div>
                                        <div id="dropzone" class="ui-sortable goods-spec-items">
                                        </div>
                                        <div id="sku_table_container" class="table-responsive" style="display: none; overflow: visible;">
                                            <table id="sku_table" class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th class="sku-th-index text-c" style="min-width: 40px;">序号</th>
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
                                                    <th class="sku-cost-price-td ">
                                                        成本价
                                                        <div class="batch">
                                                            <a href="javascript:void(0);" class="batch-edit" title="批量设置">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                            <div class="batch-input" style="display: none;">
                                                                <h6>批量设置成本价：</h6>
                                                                <a href="javascript:void(0);" class="batch-close">X</a>
                                                                <input class="form-control text small pull-none" type="text" value="">
                                                                <input type="button" class="btn btn-primary btn-sm pull-none m-l-5 btn_batch_set" data-field="cost_price" value="设置" />
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
                                                    <th>商品货号</th>
                                                    <th>商品条形码</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                            <a id="btn_sku_more_set" href="javascript:void(0);" class="btn btn-warning btn-sm m-t-10">
                                                <i class="fa fa-plus"></i> 更多设置
                                            </a>
                                        </div>
                                        <!-- 规格数量大于1则发出警告提示 -->
                                        <p id="sku_table_warning" class="form-control-warning m-t-10">
                                            <i class="fa fa-exclamation-circle"></i>
                                            <span>1.您需要选择至少一个商品规格，才能组合成完整的规格信息。</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="help-block help-block-t"></div>
                            </div>
                        </div>
                    </div>
                    <!-- SKU规格值模板 -->
                    <script id="spec_values_template" type='text'>
<div class="simple-form-field goods-spec-item" data-spec-id="#attr_id#">
<input type="hidden" name="spec_alias[#key#][attr_id]" value="#attr_id#" />
<div class="form-group spec-id-#attr_id#" data-spec-id="#attr_id#" data-spec-name="#attr_name#">
    <!-- 规格名称 -->
    <label class="col-sm-2 control-label spec-name cur-p l-h-22 w100" style="padding-top: 2px; padding-right: 0; text-align: right;" data-spec-id="#attr_id#">
        <span class="ng-binding">#attr_name#</span>：
    </label>
    <!-- 规格值列表 -->
    <div class="col-sm-9 spec-values p-0" data-spec-id="#attr_id#" style="width: 650px;">
        <div id="spec_value_selector_container_#attr_id#" class="spec-values-selector-container" data-attr_id="#attr_id#" data-attr_vids="#attr_vids#" data-loaded="false"></div>
    </div>
</div>
</div>
</script>
                    <!-- SKU规格值模板-支持别名 -->
                    <script id="spec_alias_values_template" type='text'>
<div class="simple-form-field goods-spec-item" data-spec-id="#attr_id#">
<input type="hidden" name="spec_alias[#key#][attr_id]" value="#attr_id#" />
<div class="form-group spec-id-#attr_id#" data-spec-id="#attr_id#" data-spec-name="#attr_name#">
    <!-- 规格名称 -->
    <label class="col-sm-2 control-label spec-name cur-p l-h-22 w100" style="padding-top: 2px; padding-right: 0;" data-spec-id="#attr_id#">
        <input type="text" id="spec_name_#attr_id#" name="spec_alias[#key#][attr_name]" class="form-control form-control-xs text-r w70 spec-name" value="#attr_name#" data-spec-id="#attr_id#" data-rule-required="true" data-msg="规格名称不能为空!" maxlength="10">：
    </label>
    <!-- 规格值列表 -->
    <div class="col-sm-9 spec-values p-0" data-spec-id="#attr_id#" style="width: 650px;">
        <div id="spec_value_selector_container_#attr_id#" class="spec-values-selector-container" data-attr_id="#attr_id#" data-attr_vids="#attr_vids#" data-loaded="false"></div>
    </div>
</div>
</div>
</script>
                    <!-- SKU表格头模板 -->
                    <script id="sku_th_template" type='text'>
<th class="spec-th w150 th_spec_id_#attr_id#">#attr_name#</th>
</script>
                    <!-- SKU模板 -->
                    <!-- SKU表格头模板 -->
                    <script id="sku_td_template" type='text'>
<td class="spec-vname-td">
<span class="spec-vname-label w150" data-attr-id="#attr_id#"></span>
<input type="hidden" name="specs[#attr_id#][attr_id]" value="#attr_id#">
<input type="hidden" name="specs[#attr_id#][attr_vid]" value="" class="" data-attr-id="#attr_id#">
<input type="hidden" name="specs[#attr_id#][attr_vname]" value="" class="" data-attr-id="#attr_id#">
<input type="hidden" name="specs[#attr_id#][attr_desc]" value="" class="" data-attr-id="#attr_id#">
</td>
</script>
                    <!-- SKU模板 -->
                    <script id="sku_table_template" type='text'>
<td class="sku-td-index text-c"></td>
<td class="sku-market-price-td ">
<input type="text" name="market_price" value="" class="form-control w60 sku-field sku-market-price" data-rule-min="0" data-rule-max="9999999" data-rule-decimal="2" data-msg-decimal="SKU市场价格必须是一个不大于2位小数的数字">
</td>
<td class="sku-cost-price-td ">
<input type="text" name="cost_price" value="" class="form-control w60 sku-field sku-cost-price" data-rule-min="0" data-rule-max="9999999" data-rule-decimal="2" data-msg-decimal="SKU成本价格必须是一个不大于2位小数的数字">
</td>
<td class="sku-goods-price-td ">
    <input type="text" name="goods_price" value="" class="form-control w60 sku-field sku-goods-price" data-rule-required="true" data-msg-required="SKU商品店铺价不能为空" data-rule-min="0.01" data-rule-max="9999999" data-rule-decimal="2" data-msg-decimal="SKU店铺价格必须是一个不大于2位小数的数字">
</td>
<td>
<input type="text" name="goods_number" value="" class="form-control small sku-field sku-goods-number" data-rule-required="true" data-msg-required="SKU商品库存不能为空" data-rule-min="0" data-rule-max="999999999">
</td>
<td>
<input type="text" name="goods_sn" value="" class="form-control w90 sku-field">
</td>
<td>
<input type="text" name="goods_barcode" value="" class="form-control w90 sku-field">
<input type="hidden" name="goods_stockcode" value="" class="sku-field">
</td>
</script>
                    <!-- SKU模板 -->
                    <script id="sku_more_table_template" type='text'>
<td class="sku-td-index more text-c"></td>
<td>
<input type="text" name="goods_stockcode" value="" class="form-control w90 sku-field">
</td>
</script>
                    <script>
                        //
                    </script>
                    <script type="text/javascript">
                        //
                    </script>
                    <script type="text/javascript">
                        //
                    </script>
                    <!-- 特殊属性 -->
                    <style type="text/css">
                        #goods_props .simple-form-field.goods-prop-item {
                            padding-top: 10px;
                            border-top: 1px solid #ececec;
                        }
                    </style>
                    <!-- 商品规格 -->
                    <div class="simple-form-field" >
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">
                                <span class="ng-binding">特殊属性：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">
                                    <div id="goods_props" class="goods-spec w800" data-anchor="特殊属性">
                                        <div class="simple-form-field spec-title-box">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label w100">选择属性：&nbsp;</label>
                                                <div class="col-sm-9 goods-prop-names">
                                                    <!-- 规格选择器 -->
                                                    <div id="prop_selector_container"></div>
                                                </div>
                                            </div>
                                            <a id="btn_add_goods_prop" href="javascript:void(0);" class="btn btn-warning btn-sm pos-a" style="right: 45px; top: 21px;" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="如果没有找到合适的属性，您可以点击此处添加特殊属性！">
                                                <i class="fa fa-plus"></i> 添加特殊属性
                                            </a>
                                        </div>
                                        <div class="ui-sortable goods-prop-items"></div>
                                    </div>
                                </div>
                                <div class="help-block help-block-t"></div>
                            </div>
                        </div>
                    </div>
                    <!-- SKU规格值模板 -->
                    <script id="prop_values_template" type='text'>
<div class="simple-form-field goods-prop-item" data-prop-id="#prop_id#">
<input type="hidden" name="prop_alias[#key#][prop_id]" value="#prop_id#" />
<div class="form-group prop-id-#prop_id#" data-prop-id="#prop_id#" data-prop-name="#prop_name#">
    <!-- 规格名称 -->
    <label class="col-sm-2 control-label spec-name cur-p l-h-22 w100" style="padding-top: 2px; padding-right: 0; text-align: right;" data-prop-id="#prop_id#">
        <span class="ng-binding">#prop_name#</span>：
    </label>
    <!-- 规格值列表 -->
    <div class="col-sm-9 spec-values p-0" data-prop-id="#prop_id#" style="width: 650px;">
        <div id="prop_value_selector_container_#prop_id#" class="prop-values-selector-container" data-prop_id="#prop_id#" data-prop_vids="#prop_vids#" data-loaded="false"></div>
    </div>
</div>
</div>
</script>
                    <!-- SKU规格值模板-支持别名 -->
                    <script id="prop_alias_values_template" type='text'>
<div class="simple-form-field goods-prop-item" data-prop-id="#prop_id#">
<input type="hidden" name="prop_alias[#key#][prop_id]" value="#prop_id#" />
<div class="form-group prop-id-#prop_id#" data-prop-id="#prop_id#" data-prop-name="#prop_name#">
    <!-- 规格名称 -->
    <label class="col-sm-2 control-label spec-name cur-p l-h-22 w100" style="padding-top: 2px; padding-right: 0;" data-prop-id="#prop_id#">
        <input type="text" id="prop_name_#prop_id#" name="prop_alias[#key#][prop_name]" class="form-control form-control-xs text-r w70 spec-name" value="#prop_name#" data-prop-id="#prop_id#" data-rule-required="true" data-msg="属性名称不能为空!" maxlength="10">：
    </label>
    <!-- 规格值列表 -->
    <div class="col-sm-9 spec-values p-0" data-prop-id="#prop_id#" style="width: 650px;">
        <div id="prop_value_selector_container_#prop_id#" class="prop-values-selector-container" data-prop_id="#prop_id#" data-prop_vids="#prop_vids#" data-loaded="false"></div>
    </div>
</div>
</div>
</script>
                    <script type="text/javascript">
                        //
                    </script>
                    <!---高级规格--->
                    <!-- 最小起订量 -->
                    <div class="simple-form-field" >
                        <div class="form-group">
                            <label for="goodsmodel-goods_moq" class="col-sm-3 control-label">
                                <span class="ng-binding">最小起订量：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">
                                    <input type="text" id="goodsmodel-goods_moq" class="form-control ipt pull-none m-r-10" name="GoodsModel[goods_moq]" value="{{ $model['goods_moq'] ?? '' }}" data-anchor="最小起订量">
                                </div>
                                <div class="help-block help-block-t"><div class="help-block help-block-t">买家购买商品的最小购买量，购买的商品件数不能低于此数量</div></div>
                            </div>
                        </div>
                    </div>
                    <!-- 商品价格 -->
                    <div class="simple-form-field" >
                        <div class="form-group">
                            <label for="goodsmodel-goods_price" class="col-sm-3 control-label">
                                <span class="text-danger ng-binding">*</span>
                                <span class="ng-binding">店铺价：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">
                                    <input type="text" id="goodsmodel-goods_price" class="form-control ipt pull-none m-r-10" name="GoodsModel[goods_price]" value="{{ $model['goods_price'] }}" data-anchor="店铺价">元
                                </div>

                                <div class="help-block help-block-t"><div class="help-block help-block-t">价格必须是0.01~9999999之间的数字，且不能高于市场价</br>此价格为商品实际销售价格，如果商品存在规格，该价格显示最低价格</div></div>
                            </div>
                        </div>
                    </div>
                    <!-- 市场价 -->
                    <div class="simple-form-field" >
                        <div class="form-group">
                            <label for="goodsmodel-market_price" class="col-sm-3 control-label">

                                <span class="ng-binding">市场价：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">


                                    <input type="text" id="goodsmodel-market_price" class="form-control ipt pull-none m-r-10" name="GoodsModel[market_price]" value="{{ $model['market_price'] ?? '0.00' }}">元


                                </div>

                                <div class="help-block help-block-t"><div class="help-block help-block-t">为0则商品详情页不显示，价格必须是0.00~9999999之间的数字，此价格仅为市场参考售价，请根据该实际情况认真填写</div></div>
                            </div>
                        </div>
                    </div>
                    <!-- 成本价 -->
                    <div class="simple-form-field" >
                        <div class="form-group">
                            <label for="goodsmodel-cost_price" class="col-sm-3 control-label">

                                <span class="ng-binding">成本价：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">


                                    <input type="text" id="goodsmodel-cost_price" class="form-control ipt pull-none m-r-10" name="GoodsModel[cost_price]" value="{{ $model['cost_price'] ?? '0.00' }}">元


                                </div>

                                <div class="help-block help-block-t"><div class="help-block help-block-t">价格必须是0.00~9999999之间的数字，此价格为商户对所销售的商品实际成本价格进行备注记录</div></div>
                            </div>
                        </div>
                    </div>
                    <!-- 商品数量 -->
                    <div class="simple-form-field" >
                        <div class="form-group">
                            <label for="goodsmodel-goods_number" class="col-sm-3 control-label">
                                <span class="text-danger ng-binding">*</span>
                                <span class="ng-binding">商品库存：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">


                                    <input type="text" id="goodsmodel-goods_number" class="form-control ipt pull-none m-r-10" name="GoodsModel[goods_number]" value="{{ $model['goods_number'] }}" data-anchor="商品库存">件


                                </div>

                                <div class="help-block help-block-t"><div class="help-block help-block-t">店铺库存数量必须为0~999999999之间的整数，若启用了库存配置，则系统自动计算商品的总数，此处无需卖家填写</div></div>
                            </div>
                        </div>
                    </div>
                    <!-- 库存预警值 -->
                    <div class="simple-form-field" >
                        <div class="form-group">
                            <label for="goodsmodel-warn_number" class="col-sm-3 control-label">

                                <span class="ng-binding">库存警告数量：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">


                                    <input type="text" id="goodsmodel-warn_number" class="form-control ipt" name="GoodsModel[warn_number]" value="{{ $model['warn_number'] }}">


                                </div>

                                <div class="help-block help-block-t"><div class="help-block help-block-t">设置最低库存预警值。当库存低于预警值时商家中心商品列表页库存列红字提醒</br>请填写0~255的数字，0为不预警</div></div>
                            </div>
                        </div>
                    </div>
                    <!-- 商品货号 -->
                    <div class="simple-form-field" >
                        <div class="form-group">
                            <label for="goodsmodel-goods_sn" class="col-sm-3 control-label">

                                <span class="ng-binding">商品货号：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">


                                    <input type="text" id="goodsmodel-goods_sn" class="form-control" name="GoodsModel[goods_sn]" value="{{ $model['goods_sn'] }}">


                                </div>

                                <div class="help-block help-block-t"><div class="help-block help-block-t">商品货号是指商家管理商品的编号，买家不可见</br>最多可输入20个字，支持输入中文、字母、数字、_、/、-和小数点</div></div>
                            </div>
                        </div>
                    </div>
                    <!-- 商品条形码 -->
                    <div class="simple-form-field" >
                        <div class="form-group">
                            <label for="goodsmodel-goods_barcode" class="col-sm-3 control-label">

                                <span class="ng-binding">商品条形码：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">


                                    <input type="text" id="goodsmodel-goods_barcode" class="form-control" name="GoodsModel[goods_barcode]" value="{{ $model['goods_barcode'] }}">


                                </div>

                                <div class="help-block help-block-t"><div class="help-block help-block-t">支持一品多码，多个条形码之间用逗号分隔</div></div>
                            </div>
                        </div>
                    </div>



                    <!-- 库位码 -->
                    <div class="simple-form-field" >
                        <div class="form-group">
                            <label for="goodsmodel-goods_stockcode" class="col-sm-3 control-label">

                                <span class="ng-binding">商品库位码：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">


                                    <input type="text" id="goodsmodel-goods_stockcode" class="form-control" name="GoodsModel[goods_stockcode]" value="{{ $model['goods_stockcode'] }}">


                                </div>

                                <div class="help-block help-block-t"><div class="help-block help-block-t">实体仓库存储商品位置编码</div></div>
                            </div>
                        </div>
                    </div>



                    <!-- 商品主图 -->
                    <div class="simple-form-field" >
                        <div class="form-group">
                            <label for="goodsmodel-goods_image" class="col-sm-3 control-label">

                                <span class="ng-binding">商品主图：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">

                                    <!-- 图片相对路径 -->
                                    <input type="hidden" id="goodsmodel-goods_image" class="form-control" name="GoodsModel[goods_image]" value="{{ $model['goods_image'] }}">

                                    <div id="goods_image_container"></div>

                                </div>

                                <div class="help-block help-block-t"><div class="help-block help-block-t">上传商品默认主图，无规格主图时展示该图</br>支持jpg、gif、png格式上传或从图片空间中选择，建议使用尺寸800*800像素以上</br>上传后的图片将会自动保存在图片空间的默认分类中</div></div>
                            </div>
                        </div>
                    </div>

                    <!-- 商品封面图片-->
                    <div class="simple-form-field">
                        <div class="form-group">
                            <label for="goodsmodel-cover_image" class="col-sm-3 control-label">
                                <span class="ng-binding">封面图片：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">
                                    <!-- 图片相对路径 -->
                                    <input type="hidden" id="goodsmodel-cover_image" class="form-control" name="GoodsModel[cover_image]" value="{{ $model['cover_image'] }}">
                                    <div id="cover_image_container"><ul class="image-group"><li class="image-group-button" data-label-index="0" title="点击并选择上传的图片"><div class="image-group-bg"></div></li></ul></div>
                                </div>
                                <div class="help-block help-block-t"><div class="help-block help-block-t">上传商品封面图片，用于部分装修模板展示使用<br>支持jpg、gif、png格式上传或从图片空间中选择，建议使用尺寸 1000*640 像素<br>上传后的图片将会自动保存在图片空间的默认分类中</div></div>
                            </div>
                        </div>
                    </div>
                    <!-- 商品主图视频 -->
                    <div class="simple-form-field" >
                        <div class="form-group">
                            <label for="goodsmodel-goods_video" class="col-sm-3 control-label">

                                <span class="ng-binding">主图视频：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">

                                    <!-- 视频相对路径 -->
                                    <input type="hidden" id="goodsmodel-goods_video" class="form-control" name="GoodsModel[goods_video]" value="{{ $model['goods_video'] }}">

                                    <div id="goods_video_container"></div>

                                </div>

                                <div class="help-block help-block-t"><div class="help-block help-block-t">商品主图视频要求请参考文章“<a class="c-blue" href="http://help.laravelvip.com/info/186.html" target="_blank">商城主图视频规则要求</a>”</div></div>
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
                                                <a href="#texpress1" data-toggle="tab" class="desc-tab pc-desc">
                                                    <!--
                <span class="text-danger ng-binding">*</span>
                 -->
                                                    电脑端
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#texpress2" data-toggle="tab" class="desc-tab mobile-desc">手机端</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-content" data-anchor="商品详情">
                                        <div id="texpress1" class="tab-pane fade in active">
                                            <div class="form-control-box">
                                                <!-- 文本编辑器 -->
                                                <textarea id="pc_desc" class="form-control" name="GoodsModel[pc_desc]" rows="5" style="width:100%; height: 350px; visibility: hidden;">{!! $model['pc_desc'] !!}</textarea>
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


                                                            @foreach($model['mobile_desc'] as $v)
                                                            <div class="module m-image current first">
                                                                <ul class="tools">
                                                                    <li>
                                                                        <a href="javascript:void(0);" class="up">上移</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="javascript:void(0);" class="down">下移</a>
                                                                    </li>

                                                                    @if($v['type'] == 0)
                                                                        {{--文本--}}
                                                                        <li>
                                                                            <a href="javascript:void(0);" class="edit">编辑</a>
                                                                        </li>
                                                                    @elseif($v['type'] == 1)
                                                                        {{--图片--}}
                                                                        <li>
                                                                            <a href="javascript:void(0);" class="replace">替换</a>
                                                                        </li>
                                                                    @endif

                                                                    <li>
                                                                        <a href="javascript:void(0);" class="delete">删除</a>
                                                                    </li>
                                                                </ul>
                                                                <div class="content">

                                                                    @if($v['type'] == 0)
                                                                        {{--文本--}}
                                                                        <div class="text-div">
                                                                            <div class="text-html">{!! $v['content'] !!}</div>
                                                                        </div>
                                                                    @elseif($v['type'] == 1)
                                                                        {{--图片--}}
                                                                        <div class="image-div">
                                                                            <img src="{{ get_image_url($v['content']) }}" data-path="{{ $v['content'] }}">
                                                                        </div>
                                                                    @endif

                                                                </div>
                                                                <div class="cover"></div>
                                                            </div>
                                                            @endforeach

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
                                                            <!--
                        <li>
                            <a id="btn_mobile_add_html" href="javascript:void(0);" title="添加html">
                                <i class="fa fa-file-code-o"></i>
                                <p>html</p>
                            </a>
                        </li>
                         -->
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
                                        <div style="clear: both;"></div>
                                        <div class="upload-thumb-buttom p-t-10">
                                            <a id="btn_pc_desc_imagegallery" href="javascript:void(0);" class="btn btn-primary m-r-5">
                                                <i class="fa fa-picture-o"></i>
                                                批量插入相册图片
                                            </a>
                                            <a id="btn_upload_pc_desc" href="javascript:void(0);" class="btn btn-primary">
                                                <i class="fa fa-upload"></i>
                                                上传图片
                                            </a>
                                            <div id="pc_desc_imagegallery_container" style="width: 750px;"></div>
                                            <!-- 图片空间选择图片 -->
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
                    <!-- 商品详情模板 -->
                    <div class="simple-form-field" >
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">

                                <span class="ng-binding">详情版式：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">


                                    <label class="control-label">顶部模板</label>

                                    <select id="goodsmodel-top_layout_id" class="form-control m-l-5 m-r-20" name="GoodsModel[top_layout_id]" data-layout-position="0">
                                        @foreach($top_layouts as $k=>$v)
                                            <option value="{{ $k }}" @if($k == $model['top_layout_id']) selected @endif>{{ $v }}</option>
                                        @endforeach
                                    </select>

                                    <label class="control-label">底部模板</label>

                                    <select id="goodsmodel-bottom_layout_id" class="form-control m-l-5" name="GoodsModel[bottom_layout_id]" data-layout-position="1">
                                        @foreach($bottom_layouts as $k=>$v)
                                            <option value="{{ $k }}" @if($k == $model['bottom_layout_id']) selected @endif>{{ $v }}</option>
                                        @endforeach
                                    </select>


                                </div>

                                <div class="help-block help-block-t"></div>
                            </div>
                        </div>
                    </div>
                    <!-- 商品详情模板 -->
                    <div class="simple-form-field" >
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">


                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">


                                    <label class="control-label">包装清单版式</label>

                                    <select id="goodsmodel-packing_layout_id" class="form-control m-l-5 m-r-20" name="GoodsModel[packing_layout_id]" data-layout-position="2">
                                        @foreach($packing_layouts as $k=>$v)
                                            <option value="{{ $k }}" @if($k == $model['packing_layout_id']) selected @endif>{{ $v }}</option>
                                        @endforeach
                                    </select>

                                    <label class="control-label">售后保证版式</label>

                                    <select id="goodsmodel-service_layout_id" class="form-control m-l-5" name="GoodsModel[service_layout_id]" data-layout-position="3">
                                        @foreach($service_layouts as $k=>$v)
                                            <option value="{{ $k }}" @if($k == $model['service_layout_id']) selected @endif>{{ $v }}</option>
                                        @endforeach
                                    </select>

                                    <div class="help-block help-block-t">
                                        您可以到
                                        <a href="/goods/layout/list" target="_blank" class="c-blue">详情版式</a>
                                        进行设置“包装清单模板”和“售后保障模板”
                                    </div>
                                    <br />
                                    <a href="/goods/layout/add" target="_blank" class="btn btn-warning btn-sm pull-none m-r-5">新建详情版式</a>
                                    <a href="javascript:void(0);" class="btn btn-primary btn-sm pull-none refresh-layout-list">刷新</a>

                                </div>

                                <div class="help-block help-block-t"></div>
                            </div>
                        </div>
                    </div>
                    <!-- 虚拟商品-电子卡券 -->
                    <h5 class="m-b-30" data-anchor="物流信息">商品物流信息</h5>
                    <!-- 商品重量 -->
                    <div class="simple-form-field" >
                        <div class="form-group">
                            <label for="goodsmodel-goods_weight" class="col-sm-3 control-label">

                                <span class="ng-binding">物流重量(Kg)：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">


                                    <input type="text" id="goodsmodel-goods_weight" class="form-control ipt pull-none m-r-10" name="GoodsModel[goods_weight]" value="{{ $model['goods_weight'] }}">Kg


                                </div>

                                <div class="help-block help-block-t"><div class="help-block help-block-t">商品的重量单位为千克，如果商品的运费模板按照重量计算请填写此项，为空则默认商品重量为0Kg；</br>如果SKU的重量未设置，则以此重量作为默认值；</div></div>
                            </div>
                        </div>
                    </div>
                    <!-- 商品体积 -->
                    <div class="simple-form-field" >
                        <div class="form-group">
                            <label for="goodsmodel-goods_volume" class="col-sm-3 control-label">

<span class="ng-binding">物流体积(m
				<sup>3</sup>
				)：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">


                                    <input type="text" id="goodsmodel-goods_volume" class="form-control ipt pull-none m-r-10" name="GoodsModel[goods_volume]" value="{{ $model['goods_volume'] }}">m
                                    <sup>3</sup>


                                </div>

                                <div class="help-block help-block-t"><div class="help-block help-block-t">商品的体积单位为立方米，如果商品的运费模板按照体积计算请填写此项，为空则默认商品体积为0立方米；</br>如果SKU的体积未设置，则以此体积作为默认值；</div></div>
                            </div>
                        </div>
                    </div>

                    <!-- 运费设置 -->
                    <div class="simple-form-field" >
                        <div class="form-group">
                            <label for="goodsmodel-goods_freight_type" class="col-sm-3 control-label">
                                <span class="text-danger ng-binding">*</span>
                                <span class="ng-binding">运费设置：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">

                                    <label class="control-label cur-p">
                                        <input type="radio" id="goodsmodel-goods_freight_type_0" name="GoodsModel[goods_freight_type]" class="goods-freight-type" value="0" @if($model['goods_freight_type'] == 0) checked="checked" @endif />
                                        店铺统一运费
                                        <span>（￥{{ $shop_freight_fee }}）</span>
                                    </label>
                                    <br />
                                    <!--
<label class="control-label cur-p">
    <input type="radio" id="goodsmodel-goods_freight_type_1" name="GoodsModel[goods_freight_type]" class="goods-freight-type" value="1"  />
    固定运费 <input type="text" id="goodsmodel-goods_freight_fee" class="form-control ipt m-l-5" name="GoodsModel[goods_freight_fee]" value="0.00">
</label>
 -->
                                    <br />
                                    <label class="control-label cur-p">
                                        <input type="radio" id="goodsmodel-goods_freight_type_2" name="GoodsModel[goods_freight_type]" class="goods-freight-type" value="2" @if($model['goods_freight_type'] == 2) checked="checked" @endif />
                                        运费模板

                                        <select id="goodsmodel-freight_id" class="form-control m-l-5 m-r-5 freight-list" name="GoodsModel[freight_id]">
                                            <option value="0" selected="">--请选择--</option>
                                            @foreach($freight_list as $v)
                                                <option value="{{ $v['freight_id'] }}" @if($model['freight_id'] == $v['freight_id']) selected @endif>{{ $v['title'] }}</option>
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
                                    </label>



                                    <div id="goods_freight_info" class="goods-freight col-sm-10 m-t-10"style='display: none;'>
                                        <div class="freight-pop">
                                            <div class="freight-box">
                                                <div class="logis-switch m-b-5">
                                                    <div class="switch-bar">
                                                        <!--
                                <span class="tpl-name active">
                                    平邮
                                    <b></b>
                                </span>
                                 -->
                                                    </div>
                                                    <a href="javascript:void(0);" class="help-link freight-info">查看详情</a>
                                                </div>
                                                <div class="logis-content">
                                                    <div class="col-split p-5 default-desc"></div>
                                                    <div class="col-title p-5 other-desc-title">指定区域运费</div>
                                                    <div class="p-l-5 other-desc"></div>
                                                </div>
                                            </div>
                                            <div class="deliver-warn p-5">
                                                <strong class="warn-type limit-sale">区域限售</strong>
                                                <strong class="warn-type is-free">包邮</strong>
                                                <strong class="warn-type free-set">已指定条件包邮</strong>
                                                发货地：
                                                <span class="goods-from"></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="help-block help-block-t"></div>
                            </div>
                        </div>
                    </div>

                    <h5 class="m-b-30" data-anchor="售后保障">售后服务保障</h5>
                    <!-- 发票 -->
                    <div class="simple-form-field" >
                        <div class="form-group">
                            <label for="goodsmodel-invoice_type" class="col-sm-3 control-label">

                                <span class="ng-binding">发票：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">


                                    <input type="hidden" name="GoodsModel[invoice_type]" value="0">
                                    <div id="goodsmodel-invoice_type" class="" name="GoodsModel[invoice_type]">
                                        <label class="control-label cur-p m-r-10"><input type="radio" name="GoodsModel[invoice_type]" value="0" @if($model['invoice_type'] == 0){{ 'checked' }}@endif> 无</label>
                                        <label class="control-label cur-p m-r-10"><input type="radio" name="GoodsModel[invoice_type]" value="1" @if($model['invoice_type'] == 1){{ 'checked' }}@endif> 增值税普通发票</label>
                                        <label class="control-label cur-p m-r-10"><input type="radio" name="GoodsModel[invoice_type]" value="2" @if($model['invoice_type'] == 2){{ 'checked' }}@endif> 增值税专用发票</label>
                                        <label class="control-label cur-p m-r-10"><input type="radio" name="GoodsModel[invoice_type]" value="3" @if($model['invoice_type'] == 3){{ 'checked' }}@endif> 增值税普通发票 和 增值税专用发票</label></div>


                                </div>

                                <div class="help-block help-block-t"><div class="help-block help-block-t">选择“无”则将不提供发票</div></div>
                            </div>
                        </div>
                    </div>
                    <!-- 服务保障 -->
                    @foreach($contract_list as $v)
                        <div class="simple-form-field" >
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">

                                    <span class="ng-binding">{{ $v['contract_name'] }}：</span>
                                </label>
                                <div class="col-sm-9">
                                    <div class="form-control-box">



                                        <input type="hidden" name="GoodsModel[contract_ids][{{ $v['contract_id'] }}]" value="0">
                                        <div class="" name="GoodsModel[contract_ids][{{ $v['contract_id'] }}]">
                                            <label class="control-label cur-p m-r-10">
                                                <input type="radio" name="GoodsModel[contract_ids][{{ $v['contract_id'] }}]"
                                                       value="1" @if(isset($model['contract_ids'][$v['contract_id']]) && $model['contract_ids'][$v['contract_id']] == 1){{ 'checked' }}@endif> 开启</label>
                                            <label class="control-label cur-p m-r-10">
                                                <input type="radio" name="GoodsModel[contract_ids][{{ $v['contract_id'] }}]"
                                                       value="0" @if(!isset($model['contract_ids'][$v['contract_id']]) || @$model['contract_ids'][$v['contract_id']] == 0){{ 'checked' }}@endif> 关闭</label></div>



                                    </div>

                                    <div class="help-block help-block-t"><div class="help-block help-block-t">卖家就该商品品质向买家作出承诺，承诺商品为正品。</div></div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{--自定义按钮 需判断 商品设置-更多商品编辑项 ShopConfigModel[goods_edit_items] 自定义商品详情按钮--}}
                    <div class="goods-custom-btn">
                        <h5 class="m-b-30" data-anchor="自定义按钮" title="点击展开/收起自定义按钮设置面板" style="margin-top: 10px !important">
                            自定义按钮
                            <i class="fa fa-angle-double-down"></i>
                            <span class="c-blue f12 m-l-10">提示：自定义按钮用于显示在商品详情页的按钮链接，仅当“按钮名称”和“按钮内容”均不为空时才会显示，支持上传附件供用户下载</span>
                        </h5>
                        <div class="goods-custom-box">
                            <!-- 按钮名称 -->
                            <div class="simple-form-field">
                                <div class="form-group">
                                    <label for="goodsmodel-button_name" class="col-sm-3 control-label">
                                        <span class="ng-binding">按钮名称：</span>
                                    </label>
                                    <div class="col-sm-9">
                                        <div class="form-control-box">
                                            <input type="text" id="goodsmodel-button_name" class="form-control valid" name="GoodsModel[button_name]" value="下载案例" aria-invalid="false">
                                        </div>
                                        <div class="help-block help-block-t"></div>
                                    </div>
                                </div>
                            </div>                        <!-- 按钮内容 -->
                            <div class="simple-form-field">
                                <div class="form-group">
                                    <label for="" class="col-sm-3 control-label">
                                        <span class="ng-binding">按钮内容：</span>
                                    </label>
                                    <div class="col-sm-9">
                                        <div class="form-control-box">
                                            <input type="text" id="goodsmodel-button_url" class="form-control valid" name="GoodsModel[button_url]" value="/shop/511/files/2019/10/22/15717523205770.jpg" aria-invalid="false">
                                            <a id="goods_button_upload" href="javascript:void(0);" class="btn btn-warning btn-sm pull-none m-r-5">上传附件</a>
                                            <script type="text/javascript">
                                                //
                                            </script>
                                        </div>
                                        <div class="help-block help-block-t"><div class="help-block help-block-t">如果按钮内容为链接，则点击商品详情页自定义按钮会打开此链接对应的页面；如果按钮内容为通过上传附件上传的文件，则点击商品详情页自定义按钮会下载附件，附件请上传小于4MB的文件。</div></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h5 class="m-b-30" data-anchor="其他信息">其他信息</h5>
                    <!-- 店铺内商品分类 -->
                    <div class="simple-form-field" >
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">
                                <span class="ng-binding">店铺内商品分类：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">
                                    <div class="disp-inlblock shop-cat-choosen-select-box">
                                        <div id="shop_cat_container"></div>
                                        <input type="text" id="shop_cat_ids" class="form-control" name="shop_cat_ids" value="{{ $model['shop_cat_ids'] }}" style="display: none;">
                                    </div>
                                    <a class="btn btn-warning btn-sm m-l-5" href="/goods/category/add" target="blank">新建店铺商品分类</a>
                                    <a class="btn btn-primary btn-sm m-l-5 reload_shop_cat_btn">重新加载</a>
                                </div>
                                <div class="help-block help-block-t"></div>
                            </div>
                        </div>
                    </div>
                    <!-- 会员打折 -->
                    <div class="simple-form-field" >
                        <div class="form-group">
                            <label for="goodsmodel-user_discount" class="col-sm-3 control-label">

                                <span class="ng-binding">会员打折：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">


                                    <input type="hidden" name="GoodsModel[user_discount]" value="0">
                                    <div id="goodsmodel-user_discount" class="" name="GoodsModel[user_discount]">
                                        <label class="control-label cur-p m-r-10"><input type="radio" name="GoodsModel[user_discount]" value="0" @if($model['user_discount'] == 0){{ 'checked' }}@endif> 不参与会员打折</label>
                                        <label class="control-label cur-p m-r-10"><input type="radio" name="GoodsModel[user_discount]" value="1" @if($model['user_discount'] == 0){{ 'checked' }}@endif> 参与会员打折</label></div>


                                </div>

                                <div class="help-block help-block-t"><div class="help-block help-block-t">指的是统一的会员折扣是否参与，参与和不参与会员折扣不影响自定义会员价</br>参与会员折扣，如果设置了自定义会员价，则自定义会员价生效，统一的会员折扣不起作用，如果未设置自定义会员价，则按统一的会员折扣进行计算</br>未设置自定义会员价，选择参与会员打折后，商品详情页的价格将根据登录会员的店铺内会员等级自动计算折扣</br>选择不参与会员打折，也未设置自定义会员价，则此商品在详情页不会根据登录会员自动计算会员在店铺内享受的会员折扣</br>店铺会员等级及折扣设置请到“会员><a href="/member/rank/list" target="_blank" class="c-blue">会员等级</a>”模块进行设置</div></div>
                            </div>
                        </div>
                    </div>
                    <!-- 库存计数 -->
                    <div class="simple-form-field" >
                        <div class="form-group">
                            <label for="goodsmodel-stock_mode" class="col-sm-3 control-label">

                                <span class="ng-binding">库存计数：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">


                                    <input type="hidden" name="GoodsModel[stock_mode]" value="0"><div id="goodsmodel-stock_mode" class="" name="GoodsModel[stock_mode]">
                                        <label class="control-label cur-p m-r-10"><input type="radio" name="GoodsModel[stock_mode]" value="0" @if($model['stock_mode'] == 0){{ 'checked' }}@endif> 拍下减库存</label>
                                        <label class="control-label cur-p m-r-10"><input type="radio" name="GoodsModel[stock_mode]" value="1" @if($model['stock_mode'] == 1){{ 'checked' }}@endif> 付款减库存</label>
                                        <label class="control-label cur-p m-r-10"><input type="radio" name="GoodsModel[stock_mode]" value="2" @if($model['stock_mode'] == 2){{ 'checked' }}@endif> 出库减库存</label></div>


                                </div>

                                <div class="help-block help-block-t"><div class="help-block help-block-t">拍下减库存：买家拍下商品即减少库存，存在恶拍风险。热销商品如需避免超卖可选此方式</br>付款减库存：买家拍下并完成付款方可减少库存，存在超卖风险。如需减少恶拍、提高回款效率，可选此方式；货到付款时将在卖家确认订单时减库存</br>出库减库存：卖家发货时减库存，如果库存充实，需要确保线上库存与线下库存保持一致，可选此方式</div></div>
                            </div>
                        </div>
                    </div>
                        <!--todo 待新增字段-->
<!--                    <div class="simple-form-field">
                        <div class="form-group">
                            <label for="goodsmodel-goods_price" class="col-sm-3 control-label">
                                <span class="ng-binding">商品自提超时期限：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">
                                    <input type="text" id="goodsmodel-pickup_timeout" class="form-control ipt pull-none m-r-5" name="GoodsModel[pickup_timeout]" value="0">
                                    <select id="goodsmodel-pickup_timeout_type" class="form-control ipt pull-none m-r-5" name="GoodsModel[pickup_timeout_type]">
                                        <option value="0" selected>分钟</option>
                                        <option value="1">小时</option>
                                        <option value="2">天</option>
                                    </select>
                                </div>
                                <div class="help-block help-block-t">
                                    <div class="help-block help-block-t">
                                        0代表不受限制，没有超时期限。
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>-->
                    <div class="simple-form-field">
                        <div class="form-group">
                            <label for="goodsmodel-goods_price" class="col-sm-3 control-label">
                                <span class="ng-binding">商品自提超时期限：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">
                                    <input type="text" id="goodsmodel-pickup_timeout" class="form-control ipt pull-none m-r-5" name="GoodsModel[pickup_timeout]" value="{{ $model['pickup_timeout'] }}">
                                    <select id="goodsmodel-pickup_timeout_type" class="form-control ipt pull-none m-r-5" name="GoodsModel[pickup_timeout_type]">
                                        <option value="0" @if($model['pickup_timeout_type'] == 0)selected=""@endif>分钟</option>
                                        <option value="1" @if($model['pickup_timeout_type'] == 1)selected=""@endif>小时</option>
                                        <option value="2" @if($model['pickup_timeout_type'] == 2)selected=""@endif>天</option>
                                    </select>
                                </div>
                                <div class="help-block help-block-t">
                                    <div class="help-block help-block-t">
                                        0代表不受限制，没有超时期限。
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 商品发布 -->
                    <div class="simple-form-field" >
                        <div class="form-group">
                            <label for="goodsmodel-goods_status" class="col-sm-3 control-label">

                                <span class="ng-binding">商品状态：</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="form-control-box">


                                    <label class="control-label @if($model['goods_status'] == 1){{ 'cur-p' }}@endif">
                                        <input type="radio" id="goodsmodel-goods_status_1" name="GoodsModel[goods_status]" value="1" @if($model['goods_status'] == 1)checked="checked"@endif />
                                        立刻发布
                                    </label>


                                    {{--<br/>
                                    <label class="control-label cur-p m-r-10">
                                        <input type="radio" name="GoodsModel[goods_status]" value="0" @if($model['goods_status'] == 0)checked="checked"@endif />
                                        定时发布
                                    </label>
                                    <select class="form-control sm-height pull-none m-r-5">
                                        @foreach($date_list as $k=>$v)
                                            <option value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select> 时
                                    <select class="form-control sm-height pull-none m-r-5 m-l-5">
                                        @foreach($hour_list as $k=>$v)
                                            <option value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select> 分
                                    <select class="form-control sm-height pull-none m-l-5">
                                        @foreach($minute_list as $k=>$v)
                                            <option value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>--}}


                                    <br/>
                                    <label class="control-label @if($model['goods_status'] == 0){{ 'cur-p' }}@endif">
                                        <input type="radio" id="goodsmodel-goods_status_0" name="GoodsModel[goods_status]" value="0" @if($model['goods_status'] == 0)checked="checked"@endif />
                                        放入仓库
                                    </label>

                                    <br/>
                                    <label class="control-label cur-p m-r-10">
                                        <input type="radio" id="goodsmodel-goods_status_-1" name="GoodsModel[goods_status]" value="-1" />
                                        定时出售
                                    </label>
                                    <input type="text" id="start_time" class="form-control form_datetime large hide" name="start_time" value="{{ format_time(time()) }}" autocomplete="off">
                                    <div class="help-block help-block-t">商品设置定时出售后，卖家手动上架或下架商品该设置项将不起作用</div>
                                    <div class="simple-form-field w800 m-t-10 hide" id="sale_time_quantum">
                                        <div class="form-group">
                                            <label for="goodsmodel-goods_price" class="col-sm-3 control-label w80">
                                                <span class="ng-binding">周期重复：</span>
                                            </label>
                                            <div class="col-sm-9">
                                                <div class="form-control-box m-r-0" style="width:670px;">
                                                    <div id="cycle_picker_container"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <div class="help-block help-block-t"></div>
                            </div>
                        </div>
                    </div>

                    <div class="goods-next p-b-30">

                        <input type="button" id="btn_publish" value="确认提交" class="btn btn-primary btn-lg" />

                        <!--不可点击状态的下一步-->
                        <!--<button class="btn btn-default">下一步，上传商品图片</button>-->
                    </div>
                </form>
                <input type="file" id="file_goods_image" name="file_goods_image" style="display: none;" multiple="multiple" accept="image/*" />
                <input type="file" id="file_pc_desc" name="file_pc_desc" style="display: none;" multiple="multiple" accept="image/jpeg,image/png" />
            </div>
        </div>
    </div>

@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block--}}
@section('extra_html')
    <div style="display: none; overflow: visible;">
        <div id="sku_more_table_container" class="content">
            <div class="goods-info-two">
                <div class="goods-spec" style="min-width: 100%;">
                    <div class="table-responsive">
                        <table id="sku_more_table" class="table table-hover">
                            <thead>
                            <tr>
                                <th class="sku-th-index">序号</th>

                                <th class="sku-goods-stockcode-td">
                                    库位码
                                    <div class="batch">
                                        <a href="javascript:void(0);" class="batch-edit" title="批量设置">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <div class="batch-input" style="display: none;">
                                            <h6>批量设置库位码：</h6>
                                            <a href="javascript:void(0);" class="batch-close">X</a>
                                            <input type="text" class="form-control text small pull-none" value="">
                                            <input type="button" class="btn btn-primary btn-sm pull-none m-l-5 btn_batch_set" data-field="goods_stockcode" value="设置" />
                                            <span class="arrow"></span>
                                        </div>
                                    </div>
                                </th>



                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop


{{--helper_tool--}}
@section('helper_tool')
    @include('layouts.partials.helper_tool')
@stop

{{--自定义css样式--}}
@section('style_css')
    <style type="text/css">
        .col-sm-3 {
            width: 20%;
        }
        .col-sm-9 {
            width: 80%;
        }
        .style-seller {
            overflow-x: hidden;
        }
        #goodsmodel-valid_period_type, #goodsmodel-effective_type {
            margin-top: -5px;
        }
    </style>
    <!-- 阶梯价格模板 -->
    <script id="step_price_tr_template" type='text'>
<tr class="item">
<td>
    购买
    <input class="form-control form-control-sm w70 m-l-10 m-r-10 step-number" type="text" onkeyup="this.value=this.value.replace(/[^0-9]+/,'')"  onafterpaste="this.value=this.value.replace(/[^0-9]+/,'')">
    <i class="pricing-mode">件</i>及以上，
</td>
<td>
<input class="form-control form-control-sm w70 m-l-10 m-r-10 step-price" type="text" onkeyup="this.value=this.value.replace(/[^\d.]/g,'')"  onafterpaste="this.value=this.value.replace(/[^\d.]/g,'')">
    元
</td>
<td>
    <a class="btn btn-danger btn-sm c-fff del-step-price" href="javascript:void(0)">删除</a>
</td>
</tr>
</script>
    <!-- 阶梯价格预览模板 -->
    <script id="step_price_preview_template" type='text'>
<tr>
    <td>
        销售规则<span class="sale-rule">一：</span>当商品购买数量为
        <strong class="m-l-5 m-r-5 preview-number"></strong>
        <i class="pricing-mode">件</i>
        时，售价为
        <strong class="c-yellow m-l-5 m-r-5 preview-price"></strong>
        元/
        <i class="pricing-mode">件</i>
    </td>
</tr>
</script>
    <script id="other_attrs_template" type='text'>
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
    <!-- 扩展分类模板 -->
    <script id="other_cat_template" type='text'>
<div class="choosen-select-item other-cat">
    <select class="form-control chosen-select" name="other_cat_ids[]">
</select>
    <a class="choosen-select-delete other-cat-delete">×</a>
</div>
</script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
[{"id": "goodsmodel-cat_id1", "name": "GoodsModel[cat_id1]", "attribute": "cat_id1", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Cat Id1必须是整数。"}}},{"id": "goodsmodel-cat_id2", "name": "GoodsModel[cat_id2]", "attribute": "cat_id2", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Cat Id2必须是整数。"}}},{"id": "goodsmodel-cat_id3", "name": "GoodsModel[cat_id3]", "attribute": "cat_id3", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Cat Id3必须是整数。"}}},{"id": "goodsmodel-pricing_mode", "name": "GoodsModel[pricing_mode]", "attribute": "pricing_mode", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"计价方式必须是整数。"}}},{"id": "goodsmodel-goods_unit", "name": "GoodsModel[goods_unit]", "attribute": "goods_unit", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品单位必须是整数。"}}},{"id": "goodsmodel-is_cross_border", "name": "GoodsModel[is_cross_border]", "attribute": "is_cross_border", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否跨境商品必须是整数。"}}},{"id": "goodsmodel-shipper_id", "name": "GoodsModel[shipper_id]", "attribute": "shipper_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Shipper Id必须是整数。"}}},{"id": "goodsmodel-sku_mode", "name": "GoodsModel[sku_mode]", "attribute": "sku_mode", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Sku Mode必须是整数。"}}},{"id": "goodsmodel-is_pickup", "name": "GoodsModel[is_pickup]", "attribute": "is_pickup", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"支持自提必须是整数。"}}},{"id": "goodsmodel-is_common_package", "name": "GoodsModel[is_common_package]", "attribute": "is_common_package", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"支持普通快递配送必须是整数。"}}},{"id": "goodsmodel-pickup_timeout", "name": "GoodsModel[pickup_timeout]", "attribute": "pickup_timeout", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品自提超时期限必须是整数。"}}},{"id": "goodsmodel-pickup_timeout_type", "name": "GoodsModel[pickup_timeout_type]", "attribute": "pickup_timeout_type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Pickup Timeout Type必须是整数。"}}},{"id": "goodsmodel-filter_attr_ids", "name": "GoodsModel[filter_attr_ids]", "attribute": "filter_attr_ids", "rules": {"string":true,"messages":{"string":"Filter Attr Ids必须是一条字符串。"}}},{"id": "goodsmodel-filter_attr_vids", "name": "GoodsModel[filter_attr_vids]", "attribute": "filter_attr_vids", "rules": {"string":true,"messages":{"string":"Filter Attr Vids必须是一条字符串。"}}},{"id": "goodsmodel-goods_stockcode", "name": "GoodsModel[goods_stockcode]", "attribute": "goods_stockcode", "rules": {"string":true,"messages":{"string":"商品库位码必须是一条字符串。"}}},{"id": "goodsmodel-goods_name", "name": "GoodsModel[goods_name]", "attribute": "goods_name", "rules": {"required":true,"messages":{"required":"商品名称不能为空。"}}},{"id": "goodsmodel-cat_id", "name": "GoodsModel[cat_id]", "attribute": "cat_id", "rules": {"required":true,"messages":{"required":"商品分类不能为空。"}}},{"id": "goodsmodel-shop_id", "name": "GoodsModel[shop_id]", "attribute": "shop_id", "rules": {"required":true,"messages":{"required":"店铺ID不能为空。"}}},{"id": "goodsmodel-goods_price", "name": "GoodsModel[goods_price]", "attribute": "goods_price", "rules": {"required":true,"messages":{"required":"店铺价不能为空。"}}},{"id": "goodsmodel-goods_number", "name": "GoodsModel[goods_number]", "attribute": "goods_number", "rules": {"required":true,"messages":{"required":"商品库存不能为空。"}}},{"id": "goodsmodel-add_time", "name": "GoodsModel[add_time]", "attribute": "add_time", "rules": {"required":true,"messages":{"required":"商品发布时间不能为空。"}}},{"id": "goodsmodel-last_time", "name": "GoodsModel[last_time]", "attribute": "last_time", "rules": {"required":true,"messages":{"required":"最后一次更新时间不能为空。"}}},{"id": "goodsmodel-freight_id", "name": "GoodsModel[freight_id]", "attribute": "freight_id", "rules": {"required":true,"messages":{"required":"运费模板不能为空。"}}},{"id": "goodsmodel-sku_open", "name": "GoodsModel[sku_open]", "attribute": "sku_open", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Sku Open必须是整数。"}}},{"id": "goodsmodel-prop_open", "name": "GoodsModel[prop_open]", "attribute": "prop_open", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Prop Open必须是整数。"}}},{"id": "goodsmodel-sku_id", "name": "GoodsModel[sku_id]", "attribute": "sku_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Sku Id必须是整数。"}}},{"id": "goodsmodel-cat_id", "name": "GoodsModel[cat_id]", "attribute": "cat_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品分类必须是整数。"}}},{"id": "goodsmodel-shop_id", "name": "GoodsModel[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"店铺ID必须是整数。"}}},{"id": "goodsmodel-invoice_type", "name": "GoodsModel[invoice_type]", "attribute": "invoice_type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"发票必须是整数。"}}},{"id": "goodsmodel-is_repair", "name": "GoodsModel[is_repair]", "attribute": "is_repair", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"保修必须是整数。"}}},{"id": "goodsmodel-user_discount", "name": "GoodsModel[user_discount]", "attribute": "user_discount", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"会员打折必须是整数。"}}},{"id": "goodsmodel-stock_mode", "name": "GoodsModel[stock_mode]", "attribute": "stock_mode", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"库存计数必须是整数。"}}},{"id": "goodsmodel-goods_number", "name": "GoodsModel[goods_number]", "attribute": "goods_number", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品库存必须是整数。"}}},{"id": "goodsmodel-warn_number", "name": "GoodsModel[warn_number]", "attribute": "warn_number", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"库存警告数量必须是整数。"}}},{"id": "goodsmodel-brand_id", "name": "GoodsModel[brand_id]", "attribute": "brand_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"品牌必须是整数。"}}},{"id": "goodsmodel-top_layout_id", "name": "GoodsModel[top_layout_id]", "attribute": "top_layout_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品顶部模板编号必须是整数。"}}},{"id": "goodsmodel-bottom_layout_id", "name": "GoodsModel[bottom_layout_id]", "attribute": "bottom_layout_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品底部模板编号必须是整数。"}}},{"id": "goodsmodel-packing_layout_id", "name": "GoodsModel[packing_layout_id]", "attribute": "packing_layout_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Packing Layout Id必须是整数。"}}},{"id": "goodsmodel-service_layout_id", "name": "GoodsModel[service_layout_id]", "attribute": "service_layout_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Service Layout Id必须是整数。"}}},{"id": "goodsmodel-click_count", "name": "GoodsModel[click_count]", "attribute": "click_count", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品浏览次数必须是整数。"}}},{"id": "goodsmodel-goods_audit", "name": "GoodsModel[goods_audit]", "attribute": "goods_audit", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"审核是否通过必须是整数。"}}},{"id": "goodsmodel-goods_status", "name": "GoodsModel[goods_status]", "attribute": "goods_status", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品状态必须是整数。"}}},{"id": "goodsmodel-is_delete", "name": "GoodsModel[is_delete]", "attribute": "is_delete", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否已删除必须是整数。"}}},{"id": "goodsmodel-is_virtual", "name": "GoodsModel[is_virtual]", "attribute": "is_virtual", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Is Virtual必须是整数。"}}},{"id": "goodsmodel-is_best", "name": "GoodsModel[is_best]", "attribute": "is_best", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否精品必须是整数。"}}},{"id": "goodsmodel-is_new", "name": "GoodsModel[is_new]", "attribute": "is_new", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否新品必须是整数。"}}},{"id": "goodsmodel-is_hot", "name": "GoodsModel[is_hot]", "attribute": "is_hot", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否热卖必须是整数。"}}},{"id": "goodsmodel-is_promote", "name": "GoodsModel[is_promote]", "attribute": "is_promote", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否促销必须是整数。"}}},{"id": "goodsmodel-supplier_id", "name": "GoodsModel[supplier_id]", "attribute": "supplier_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"供货商ID必须是整数。"}}},{"id": "goodsmodel-freight_id", "name": "GoodsModel[freight_id]", "attribute": "freight_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"运费模板必须是整数。"}}},{"id": "goodsmodel-goods_sort", "name": "GoodsModel[goods_sort]", "attribute": "goods_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Goods Sort必须是整数。"}}},{"id": "goodsmodel-audit_time", "name": "GoodsModel[audit_time]", "attribute": "audit_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Audit Time必须是整数。"}}},{"id": "goodsmodel-add_time", "name": "GoodsModel[add_time]", "attribute": "add_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品发布时间必须是整数。"}}},{"id": "goodsmodel-last_time", "name": "GoodsModel[last_time]", "attribute": "last_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"最后一次更新时间必须是整数。"}}},{"id": "goodsmodel-comment_num", "name": "GoodsModel[comment_num]", "attribute": "comment_num", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品评论次数必须是整数。"}}},{"id": "goodsmodel-sale_num", "name": "GoodsModel[sale_num]", "attribute": "sale_num", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品销售数量必须是整数。"}}},{"id": "goodsmodel-collect_num", "name": "GoodsModel[collect_num]", "attribute": "collect_num", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品收藏数量必须是整数。"}}},{"id": "goodsmodel-sales_model", "name": "GoodsModel[sales_model]", "attribute": "sales_model", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"销售模式必须是整数。"}}},{"id": "goodsmodel-erp_goods_id", "name": "GoodsModel[erp_goods_id]", "attribute": "erp_goods_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Erp Goods Id必须是整数。"}}},{"id": "goodsmodel-is_sync_price", "name": "GoodsModel[is_sync_price]", "attribute": "is_sync_price", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Is Sync Price必须是整数。"}}},{"id": "goodsmodel-is_sync_stock", "name": "GoodsModel[is_sync_stock]", "attribute": "is_sync_stock", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Is Sync Stock必须是整数。"}}},{"id": "goodsmodel-goods_mode", "name": "GoodsModel[goods_mode]", "attribute": "goods_mode", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品类别必须是整数。"}}},{"id": "goodsmodel-cs_dg_id", "name": "GoodsModel[cs_dg_id]", "attribute": "cs_dg_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Cs Dg Id必须是整数。"}}},{"id": "goodsmodel-cover_image", "name": "GoodsModel[cover_image]", "attribute": "cover_image", "rules": {"string":true,"messages":{"string":"封面图片必须是一条字符串。"}}},{"id": "goodsmodel-goods_images", "name": "GoodsModel[goods_images]", "attribute": "goods_images", "rules": {"string":true,"messages":{"string":"Goods Images必须是一条字符串。"}}},{"id": "goodsmodel-button_name", "name": "GoodsModel[button_name]", "attribute": "button_name", "rules": {"string":true,"messages":{"string":"按钮名称必须是一条字符串。"}}},{"id": "goodsmodel-button_url", "name": "GoodsModel[button_url]", "attribute": "button_url", "rules": {"string":true,"messages":{"string":"按钮链接必须是一条字符串。"}}},{"id": "goodsmodel-goods_price", "name": "GoodsModel[goods_price]", "attribute": "goods_price", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"店铺价必须是一个数字。","decimal":"店铺价必须是一个不大于2位小数的数字。","min":"店铺价必须不小于0。","max":"店铺价必须不大于9999999。"},"decimal":2,"min":0,"max":9999999}},{"id": "goodsmodel-market_price", "name": "GoodsModel[market_price]", "attribute": "market_price", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"市场价必须是一个数字。","decimal":"市场价必须是一个不大于2位小数的数字。","min":"市场价必须不小于0。","max":"市场价必须不大于9999999。"},"decimal":2,"min":0,"max":9999999}},{"id": "goodsmodel-goods_sort", "name": "GoodsModel[goods_sort]", "attribute": "goods_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Goods Sort必须是整数。","min":"Goods Sort必须不小于0。","max":"Goods Sort必须不大于9999。"},"min":0,"max":9999}},{"id": "goodsmodel-warn_number", "name": "GoodsModel[warn_number]", "attribute": "warn_number", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"库存警告数量必须是整数。","min":"库存警告数量必须不小于0。"},"min":0}},{"id": "goodsmodel-pickup_timeout", "name": "GoodsModel[pickup_timeout]", "attribute": "pickup_timeout", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品自提超时期限必须是整数。","min":"商品自提超时期限必须不小于0。"},"min":0}},{"id": "goodsmodel-goods_number", "name": "GoodsModel[goods_number]", "attribute": "goods_number", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品库存必须是整数。","min":"商品库存必须不小于0。","max":"商品库存必须不大于999999999。"},"min":0,"max":999999999}},{"id": "goodsmodel-cost_price", "name": "GoodsModel[cost_price]", "attribute": "cost_price", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"成本价必须是一个数字。","decimal":"成本价必须是一个不大于2位小数的数字。","min":"成本价必须不小于0。","max":"成本价必须不大于9999999。"},"decimal":2,"min":0,"max":9999999}},{"id": "goodsmodel-mobile_price", "name": "GoodsModel[mobile_price]", "attribute": "mobile_price", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"移动端专项价必须是一个数字。","decimal":"移动端专项价必须是一个不大于2位小数的数字。","min":"移动端专项价必须不小于0。","max":"移动端专项价必须不大于9999999。"},"decimal":2,"min":0,"max":9999999}},{"id": "goodsmodel-pc_desc", "name": "GoodsModel[pc_desc]", "attribute": "pc_desc", "rules": {"string":true,"messages":{"string":"商品电脑端描述必须是一条字符串。"}}},{"id": "goodsmodel-mobile_desc", "name": "GoodsModel[mobile_desc]", "attribute": "mobile_desc", "rules": {"string":true,"messages":{"string":"商品手机端描述必须是一条字符串。"}}},{"id": "goodsmodel-contract_ids", "name": "GoodsModel[contract_ids]", "attribute": "contract_ids", "rules": {"string":true,"messages":{"string":"保障服务必须是一条字符串。"}}},{"id": "goodsmodel-goods_name", "name": "GoodsModel[goods_name]", "attribute": "goods_name", "rules": {"string":true,"messages":{"string":"商品名称必须是一条字符串。","minlength":"商品名称应该包含至少1个字符。","maxlength":"商品名称只能包含至多60个字符。"},"minlength":1,"maxlength":60}},{"id": "goodsmodel-goods_subname", "name": "GoodsModel[goods_subname]", "attribute": "goods_subname", "rules": {"string":true,"messages":{"string":"商品卖点必须是一条字符串。","maxlength":"商品卖点只能包含至多255个字符。"},"maxlength":255}},{"id": "goodsmodel-goods_image", "name": "GoodsModel[goods_image]", "attribute": "goods_image", "rules": {"string":true,"messages":{"string":"商品主图必须是一条字符串。","maxlength":"商品主图只能包含至多255个字符。"},"maxlength":255}},{"id": "goodsmodel-goods_video", "name": "GoodsModel[goods_video]", "attribute": "goods_video", "rules": {"string":true,"messages":{"string":"主图视频必须是一条字符串。","maxlength":"主图视频只能包含至多255个字符。"},"maxlength":255}},{"id": "goodsmodel-keywords", "name": "GoodsModel[keywords]", "attribute": "keywords", "rules": {"string":true,"messages":{"string":"关键词必须是一条字符串。","maxlength":"关键词只能包含至多255个字符。"},"maxlength":255}},{"id": "goodsmodel-goods_info", "name": "GoodsModel[goods_info]", "attribute": "goods_info", "rules": {"string":true,"messages":{"string":"商品简介必须是一条字符串。","maxlength":"商品简介只能包含至多255个字符。"},"maxlength":255}},{"id": "goodsmodel-goods_reason", "name": "GoodsModel[goods_reason]", "attribute": "goods_reason", "rules": {"string":true,"messages":{"string":"Goods Reason必须是一条字符串。","maxlength":"Goods Reason只能包含至多255个字符。"},"maxlength":255}},{"id": "goodsmodel-goods_volume", "name": "GoodsModel[goods_volume]", "attribute": "goods_volume", "rules": {"string":true,"messages":{"string":"物流体积(m3)必须是一条字符串。","maxlength":"物流体积(m3)只能包含至多255个字符。"},"maxlength":255}},{"id": "goodsmodel-goods_weight", "name": "GoodsModel[goods_weight]", "attribute": "goods_weight", "rules": {"string":true,"messages":{"string":"物流重量(Kg)必须是一条字符串。","maxlength":"物流重量(Kg)只能包含至多255个字符。"},"maxlength":255}},{"id": "goodsmodel-goods_remark", "name": "GoodsModel[goods_remark]", "attribute": "goods_remark", "rules": {"string":true,"messages":{"string":"商品备注必须是一条字符串。","maxlength":"商品备注只能包含至多255个字符。"},"maxlength":255}},{"id": "goodsmodel-goods_sn", "name": "GoodsModel[goods_sn]", "attribute": "goods_sn", "rules": {"string":true,"messages":{"string":"商品货号必须是一条字符串。","maxlength":"商品货号只能包含至多60个字符。"},"maxlength":60}},{"id": "goodsmodel-goods_barcode", "name": "GoodsModel[goods_barcode]", "attribute": "goods_barcode", "rules": {"string":true,"messages":{"string":"商品条形码必须是一条字符串。","maxlength":"商品条形码只能包含至多1,500个字符。"},"maxlength":1500}},{"id": "goodsmodel-invoice_type", "name": "GoodsModel[invoice_type]", "attribute": "invoice_type", "rules": {"in":{"range":["0","1","2","3"]},"messages":{"in":"发票是无效的。"}}},{"id": "goodsmodel-is_repair", "name": "GoodsModel[is_repair]", "attribute": "is_repair", "rules": {"in":{"range":["0","1"]},"messages":{"in":"保修是无效的。"}}},{"id": "goodsmodel-user_discount", "name": "GoodsModel[user_discount]", "attribute": "user_discount", "rules": {"in":{"range":["0","1"]},"messages":{"in":"会员打折是无效的。"}}},{"id": "goodsmodel-stock_mode", "name": "GoodsModel[stock_mode]", "attribute": "stock_mode", "rules": {"in":{"range":["0","1","2"]},"messages":{"in":"库存计数是无效的。"}}},{"id": "goodsmodel-goods_status", "name": "GoodsModel[goods_status]", "attribute": "goods_status", "rules": {"in":{"range":["-1","0","1","2"]},"messages":{"in":"商品状态是无效的。"}}},{"id": "goodsmodel-goods_freight_type", "name": "GoodsModel[goods_freight_type]", "attribute": "goods_freight_type", "rules": {"in":{"range":["0","1","2"]},"messages":{"in":"运费设置是无效的。"}}},{"id": "goodsmodel-goods_freight_fee", "name": "GoodsModel[goods_freight_fee]", "attribute": "goods_freight_fee", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"商品固定运费必须是一个数字。","decimal":"商品固定运费必须是一个不大于2位小数的数字。","min":"商品固定运费必须不小于0。","max":"商品固定运费必须不大于9999999。"},"decimal":2,"min":0,"max":9999999}},{"id": "goodsmodel-goods_name", "name": "GoodsModel[goods_name]", "attribute": "goods_name", "rules": {"string":true,"messages":{"string":"商品名称必须是一条字符串。","match":"商品名称中含有非法字符"},"match":{"pattern":/<|>|<script|<img|<svg|alert|prompt|cookie|@eval|@ini_set|@set_time_limit|\$_SERVER|@set_magic_quotes_runtime/,"not":true}}},{"id": "goodsmodel-goods_subname", "name": "GoodsModel[goods_subname]", "attribute": "goods_subname", "rules": {"string":true,"messages":{"string":"商品卖点必须是一条字符串。","match":"商品卖点中含有非法字符"},"match":{"pattern":/<|>|<script|<img|<svg|alert|prompt|cookie|@eval|@ini_set|@set_time_limit|\$_SERVER|@set_magic_quotes_runtime/,"not":true}}},{"id": "goodsmodel-goods_info", "name": "GoodsModel[goods_info]", "attribute": "goods_info", "rules": {"string":true,"messages":{"string":"商品简介必须是一条字符串。","match":"商品简介中含有非法字符"},"match":{"pattern":/<|>|<script|<img|<svg|alert|prompt|cookie|@eval|@ini_set|@set_time_limit|\$_SERVER|@set_magic_quotes_runtime/,"not":true}}},{"id": "goodsmodel-remark", "name": "GoodsModel[remark]", "attribute": "remark", "rules": {"string":true,"messages":{"string":"Remark必须是一条字符串。","match":"Remark中含有非法字符"},"match":{"pattern":/<|>|<script|<img|<svg|alert|prompt|cookie|@eval|@ini_set|@set_time_limit|\$_SERVER|@set_magic_quotes_runtime/,"not":true}}},{"id": "goodsmodel-pc_desc", "name": "GoodsModel[pc_desc]", "attribute": "pc_desc", "rules": {"string":true,"messages":{"string":"商品电脑端描述必须是一条字符串。"}}},{"id": "goodsmodel-mobile_desc", "name": "GoodsModel[mobile_desc]", "attribute": "mobile_desc", "rules": {"string":true,"messages":{"string":"商品手机端描述必须是一条字符串。"}}},{"id": "goodsmodel-goods_sn", "name": "GoodsModel[goods_sn]", "attribute": "goods_sn", "rules": {"string":true,"messages":{"string":"商品货号必须是一条字符串。","maxlength":"商品货号只能包含至多20个字符。"},"maxlength":20}},{"id": "goodsmodel-goods_barcode", "name": "GoodsModel[goods_barcode]", "attribute": "goods_barcode", "rules": {"string":true,"messages":{"string":"商品条形码必须是一条字符串。","maxlength":"商品条形码只能包含至多1,500个字符。"},"maxlength":1500}},{"id": "goodsmodel-goods_moq", "name": "GoodsModel[goods_moq]", "attribute": "goods_moq", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"最小起订量必须是整数。","min":"最小起订量必须不小于1。"},"min":1}},{"id": "goodsmodel-button_name", "name": "GoodsModel[button_name]", "attribute": "button_name", "rules": {"string":true,"messages":{"string":"按钮名称必须是一条字符串。"}}},{"id": "goodsmodel-button_url", "name": "GoodsModel[button_url]", "attribute": "button_url", "rules": {"string":true,"messages":{"string":"按钮链接必须是一条字符串。"}}},{"id": "goodsmodel-goods_freight_fee", "name": "GoodsModel[goods_freight_fee]", "attribute": "goods_freight_fee", "rules": {"required":true,"messages":{"required":"商品固定运费不能为空。"}}},{"id": "goodsmodel-freight_id", "name": "GoodsModel[freight_id]", "attribute": "freight_id", "rules": {"compare":{"operator":">","type":"number","compareValue":0,"skipOnEmpty":1},"messages":{"compare":"运费模板不能为空"},"when":"function(){console.info($('.goods-freight-type:checked').val());return $('.goods-freight-type:checked').val() == 2;}"}}]
</script>
    <script type="text/javascript">
        //
    </script>
    <script id="goods_sku_list" type='text'>
    {!! json_encode($goods_sku_list) !!}
{{--{"13675|13722":{"checked":"true","goods_barcode":"","goods_number":500,"goods_price":"100.00","goods_sn":"","market_price":null,"cost_price":"0.00","mobile_price":"0.00","warn_number":0,"goods_stockcode":"","goods_weight":null,"goods_volume":null,"cart_step":1},"13681|13722":{"checked":"true","goods_barcode":"","goods_number":600,"goods_price":"200.00","goods_sn":"","market_price":null,"cost_price":"0.00","mobile_price":"0.00","warn_number":0,"goods_stockcode":"","goods_weight":null,"goods_volume":null,"cart_step":1}}--}}
</script>
    <!-- 规格、属性 -->
    <script type="text/javascript">
        //
    </script>
    <!-- JSON2 -->
    <!-- 在线文本编辑器 -->
    <!-- 创建KindEditor的脚本 必须设置editor_id属性-->
    <script type="text/javascript">
        //
    </script><!-- 手机端详情 -->
    <script type="text/javascript">
        //
    </script>
    <!-- 发布商品 -->
    <script type="text/javascript">
        //
    </script>
    <script type="text/javascript">
        //
    </script>
    <!-- 处理阶梯价格js -->
    <script type="text/javascript">
        //
    </script>
    <script type="text/javascript">
        //
    </script>
@stop

{{--footer_js page元素同级下面--}}
@section('footer_js')
    <script src="/assets/d2eace91/min/js/validate.min.js?v=2.1"></script>
    <script src="/assets/d2eace91/min/js/upload.min.js?v=2.1"></script>
    <script src="/assets/d2eace91/js/jquery-ui.min.js?v=2.1"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js?v=2.1"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=2.1"></script>
    <script src="/assets/d2eace91/js/pic/highslide-with-gallery.js?v=2.1"></script>
    <script src="/assets/d2eace91/js/jquery.json-2.4.js?v=2.1"></script>
    <script src="/assets/d2eace91/js/editor/kindeditor-all.min.js?v=2.1"></script>
    <script src="/assets/d2eace91/js/editor/lang/zh_CN.js?v=2.1"></script>
    <script src="/assets/d2eace91/js/ztree/jquery.ztree.all-3.5.min.js?v=2.1"></script>
@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <script>
        $(function(){
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
        })
        //
        // 获取当前选中的规格列表
        var getCheckedSpecList = null;
        var getCheckedSpecValueList = null;
        var isCheckedSpec = null;
        var eachCheckedSpecValue = null;
        $(function(){
            var checked_spec_list = [];
            var checked_spec_value_list = [];
            // 获取选中的规格列表
            getCheckedSpecList = function(){
                return checked_spec_list;
            };
            isCheckedSpec = function(attr_id){
                return checked_spec_list.some(function(item){
                    return item.attr_id == attr_id;
                });
            }
            // 获取选中的规格值列表
            getCheckedSpecValueList = function(attr_id){
                return checked_spec_value_list[attr_id] ? checked_spec_value_list[attr_id] : [];
            };
            // 遍历所有被选中的规格值
            eachCheckedSpecValue = function(cb){
                getCheckedSpecList().forEach(function(spec_item){
                    getCheckedSpecValueList(spec_item.attr_id).forEach(function(sv_item){
                        cb(sv_item, spec_item);
                    });
                });
            };
            // 初始选中的规格
            var init_checked_attr_ids = "{{ $checked_attr_ids ?? '' }}".split(",");
            var init_checked_attr_vids = "{{ $checked_attr_vids ?? '' }}".split(",");
            var spec_selector_init = false;
            var spec_values_template = $("#spec_values_template").html();
            var spec_alias_values_template = $("#spec_alias_values_template").html();
            var spec_alias_key = 0;
            // 规格别名，会在初始化后置空
            var spec_alias = {};
            try{
                //
            }catch(e){
                console.error('解析规格别名失败', '[]');
            }
            // 加载规格值
            // @params array spec_list - [{ attr_id, attr_vids }, { attr_id, attr_vids }...]
            function loadSpecValues(spec_list){
                // 开始加载
                spec_selector_init && $.loading.start();
                var promise_list = [];
                spec_list.forEach(function(spec_item){
                    var attr_id = spec_item.attr_id;
                    var attr_name = spec_item.attr_name;
                    var attr_vids = spec_item.attr_vids;
                    var target = $("#spec_value_selector_container_" + attr_id);
                    // 创建规格值
                    if(target.size() == 0){
                        // 初始值
                        attr_vids = init_checked_attr_vids;
                        // 根据是否支持别名选择合适的模板
                        var temp = spec_item.is_alias == '1' ? spec_alias_values_template : spec_values_template;
                        // 模板赋值
                        temp = temp.replace(/#key#/g, spec_alias_key++);
                        temp = temp.replace(/#attr_id#/g, attr_id);
                        temp = temp.replace(/#attr_name#/g, spec_alias[attr_id] ? spec_alias[attr_id] : attr_name);
                        temp = temp.replace(/#attr_vids#/g, init_checked_attr_vids);
                        $("#goods_specs .goods-spec-items").append(temp);
                        // 重新查询
                        target = $("#spec_value_selector_container_" + attr_id);
                    }else{
                        var spec_item_element = $(".goods-spec-item[data-spec-id='" + attr_id + "']");
                        $("#goods_specs .goods-spec-items").after(spec_item_element);
                        $(spec_item_element).show();
                    }
                    // 检查是否已加载过
                    if(target.data("loaded") == true){
                        promise_list.push(new Promise(function(resolve, reject){
                            resolve();
                        }));
                        return;
                    }
                    // 表示为已加载
                    target.data("loaded", true);
                    var btn_add_element = $('<a class="btn btn-warning btn-sm btn-add-spec-value m-l-4">添加此规格值</a>');
                    var spec_value_selector = $(target).specValueSelector({
                        size: 0,
                        sortable: true,
                        data: {
                            attr_id: attr_id,
                            goods_id: "{{ $model['goods_id'] }}"
                        },
                        values: attr_vids ? attr_vids : [],
                        // 是否允许添加
                        addable: spec_item.is_input == '1' ? true : false,
                        // 添加规格
                        addCallback: function(attr_vid, name, node) {
                            if(!checked_spec_value_list[attr_id]){
                                checked_spec_value_list[attr_id] = [];
                            }
                            // 规格是否发生变动，从无到有
                            var spec_changed = checked_spec_value_list[attr_id].length == 0;
                            checked_spec_value_list[attr_id].push(node);
                            if(spec_selector_init){
                                // 重新计算
                                evalSkuTable(false, spec_changed).always(function() {
                                    // 批发模式下，计算阶梯价格中的最大值值复制给SKU的店铺价格
                                    countStepPrice();
                                    // 停止缓载
                                    $.loading.stop();
                                });
                            }
                        },
                        // 改变规格
                        change: function(event_name) {
                            if(!checked_spec_value_list[attr_id]){
                                checked_spec_value_list[attr_id] = [];
                            }
                            if(event_name == "add"){
                                return;
                            }
                            this.hide();
                            if(event_name == "clear"){
                                checked_spec_value_list[attr_id] = [];
                                return;
                            }
                            if(event_name == "remove"){
                                var attr_vids = this.getValues();
                                checked_spec_value_list[attr_id] = checked_spec_value_list[attr_id].filter(function(item){
                                    return attr_vids.some(function(vid){
                                        return item.attr_vid == vid;
                                    });
                                });
                                // 重新计算
                                evalSkuTable(false, attr_vids.length == 0).always(function() {
                                    // 批发模式下，计算阶梯价格中的最大值值复制给SKU的店铺价格
                                    countStepPrice();
                                    // 停止缓载
                                    $.loading.stop();
                                });
                            }
                        },
                        // 排序回调
                        sortCallback: function(){
                            var that = this;
                            checked_spec_value_list[attr_id] = [];
                            this.getValues().forEach(function(attr_vid){
                                checked_spec_value_list[attr_id].push(that.getNode(attr_vid));
                            });
                            // 重新计算
                            evalSkuTable().always(function() {
                                // 批发模式下，计算阶梯价格中的最大值值复制给SKU的店铺价格
                                countStepPrice();
                                // 停止缓载
                                $.loading.stop();
                            });
                        },
                        // 渲染工具栏按钮
                        renderButtons: function(show){
                            var html = null;
                            if(show === true){
                                html = btn_add_element;
                            }
                            $(this.getButtonContainer()).empty().html(html);
                        },
                        // 搜索回调
                        searchCallback: function(keyword, nodes){
                            if($.trim(keyword) == "" || this.addable == false){
                                this.renderButtons(false);
                                return;
                            }
                            if(nodes.length > 0){
                                var exists = nodes.some(function(item){
                                    return item.attr_vname == keyword;
                                });
                                if(exists){
                                    this.renderButtons(false);
                                    return;
                                }
                            }
                            this.renderButtons(true);
                            $(btn_add_element).click(function(){
                                addHandle(keyword);
                            });
                        }
                    });
                    // 添加规格值处理器
                    var addHandle = function(keywords){
                        if(keywords == ""){
                            return;
                        }
                        var attr_vid = 'other_' + attr_id + '_' + keywords;
                        var nodeData = {
                            attr_id: attr_id,
                            attr_vname: keywords,
                            attr_vid: attr_vid,
                            keywords: keywords
                        };
                        // 新规格添加到数据列表中
                        spec_value_selector.items.push(nodeData);
                        // 搜索关键词置空
                        $(spec_value_selector.container).find(".tree-chosen-input").val("");
                        // 重新搜索
                        spec_value_selector.search('');
                        // 刷新节点
                        spec_value_selector.refresh();
                        // 查找节点
                        var treeNode = spec_value_selector.getNode(attr_vid);
                        // 直接选中
                        spec_value_selector.add(attr_vid, keywords, treeNode);
                    }
                    promise_list.push(spec_value_selector.load());
                });
                return Promise.all(promise_list).then(function(){
                    // 停止加载
                    spec_selector_init && $.loading.stop();
                });
            }
            // 初始化队列
            var init_list = [];
            var spec_selector = $("#spec_selector_container").specSelector({
                size: 0,
                sortable: true,
                data: {
                    cat_id: "0"
                },
                values: init_checked_attr_ids,
                // 添加规格
                addCallback: function(attr_id, name, node) {
                    checked_spec_list.push(node);
                    if(spec_selector_init){
                        loadSpecValues([node]);
                        // 如果别名存在，那么在新添加规格时要覆盖别名，还原原来的规格名称
                        $("#spec_name_" + attr_id).val(name);
                    }else{
                        init_list.push(loadSpecValues([node]));
                    }
                },
                // 移除规格
                removeCallback: function(attr_id, name, node) {
                    this.hide();
                    // 删除规格
                    checked_spec_list = checked_spec_list.filter(function(item){
                        return item.attr_id != attr_id;
                    });
                    $(".goods-spec-item[data-spec-id='" + attr_id + "']").hide();
                    var specValueSelector = $("#spec_value_selector_container_" + attr_id).specValueSelector();
                    specValueSelector && specValueSelector.clear();
                    // 重新计算
                    evalSkuTable(false, true).always(function() {
                        // 批发模式下，计算阶梯价格中的最大值值复制给SKU的店铺价格
                        countStepPrice();
                        // 停止缓载
                        $.loading.stop();
                    });
                },
                // 排序回调
                sortCallback: function(){
                    var that = this;
                    checked_spec_list = [];
                    var children = [];
                    this.getValues().forEach(function(attr_id){
                        checked_spec_list.push(that.getNode(attr_id));
                        children.push($(".goods-spec-item[data-spec-id='" + attr_id + "']"));
                    });
                    // 规格值 Dom 排序
                    $("#goods_specs .goods-spec-items").before(children);
                    // 重新计算
                    evalSkuTable().always(function() {
                        // 批发模式下，计算阶梯价格中的最大值值复制给SKU的店铺价格
                        countStepPrice();
                        // 停止缓载
                        $.loading.stop();
                    });
                }
            });
            // 开始加载
            $.loading.start();
            spec_selector.load().then(function(){
                Promise.all(init_list).then(function(){
                    evalSkuTable(true).then(function(){
                        // 批发模式下，计算阶梯价格中的最大值值复制给SKU的店铺价格
                        countStepPrice();
                        // 停止加载
                        $.loading.stop();
                        // 标记初始化完成
                        spec_selector_init = true;
                    });
                });
            });
            // 添加店铺自定义规格
            $("#btn_add_shop_spec").click(function() {
                $.loading.start();
                $.open({
                    title: "添加规格",
                    width: "630px",
                    height:"520px",
                    ajax: {
                        url: "/goods/publish/add-spec.html",
                    },
                    btn: ['提交', '取消'],
                    success: function(object, index) {
                        $.loading.stop();
                        var validator = $(object).find("form").validate();
                        // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
                        $.validator.addRules($(object).find(".client-rules").html());
                        $(object).data("validator", validator);
                    },
                    yes: function(index, object) {
                        validator = $(object).data("validator");
                        if (!validator.form()) {
                            return;
                        }
                        var form = $(object).find("form");
                        var url = $(form).attr("action");
                        var data = $(form).remove(".attr-values-area").serializeJson();
                        data = {
                            _csrf: data._csrf,
                            Attribute: data.Attribute,
                            attr_values: data.attr_values
                        };
                        var attr_values = [];
                        $(object).find(".attr-values-area:visible").each(function() {
                            if ($(this).attr("id") == "values_select") {
                                $(this).find(".attr-value,.new-attr-value").each(function() {
                                    var object = $(this).serializeJson();
                                    if ($.trim(object.attr_vname) != '') {
                                        attr_values.push(object);
                                    }
                                });
                            }
                        });
                        data.attr_values = attr_values;
                        data = JSON.stringify(data);
                        //加载提示
                        $.loading.start();
                        $.post("/goods/publish/add-spec.html", {
                            data: data
                        }, function(result) {
                            if (result.code == 0) {
                                $.msg(result.message);
                                if (result.model) {
                                    var attr_id = result.model.attr_id;
                                    var attr_name = result.model.attr_name;
                                    // 将数据追加到当前结构中
                                    var spec_selector = $("#spec_selector_container").specSelector();
                                    // 补充数据
                                    spec_selector.items.push(result.model);
                                    // 刷新
                                    spec_selector.refresh();
                                    // 查找节点
                                    var treeNode = spec_selector.getNode(attr_id);
                                    // 直接选中
                                    spec_selector.add(attr_id, attr_name, treeNode);
                                }
                                // 关闭
                                $.closeDialog(index);
                            } else {
                                $.msg(result.message, {
                                    time: 5000
                                });
                            }
                        }, "json").always(function() {
                            $.loading.stop();
                        });
                    }
                });
            });
        });
        //
        function getOtherValue(attr_id, vname) {
            return "other_" + attr_id + "_" + vname;
        }
        var evalSkuTable = null;
        var eval_loading = false;
        $().ready(function() {
            $("#goodsmodel-goods_status_{{ $model['goods_status'] }}").attr("checked", true);
            // 验证
            var validator = $("#GoodsModel").validate();
            $("select").on('change', function() {
                $(this).valid();
            });
            //-------------------------------------商品规格处理-----------------------------------------
            // 修改规格名称时级联修改表格的表头
            $("body").on("keyup", ".spec-name:text", function() {
                var attr_id = $(this).data("spec-id");
                $(".th_spec_id_" + attr_id).html($(this).val());
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
                if(cb_object instanceof HTMLElement){
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
                }else{
                    object.attr_id = cb_object.attr_id;
                    object.attr_vid = cb_object.attr_vid;
                    object.attr_vname = cb_object.attr_vname;
                    object.attr_desc = '';
                }
                return object;
            }
            // 规格对象
            var spec_object = [];
            // sku对象
            var sku_object = [];
            if ($("#goods_sku_list").size() > 0) {
                try {
                    sku_object = $.parseJSON($("#goods_sku_list").html());
                    for (var spec_vids in sku_object) {
                        var item = sku_object[spec_vids];
                        var ids = spec_vids.split("|");
                        var list = $.toPermute(ids);
                        for (var i = 0; i < list.length; i++) {
                            var vids = list[i].sort();
                            vids = vids.join("|");
                            sku_object[vids] = item;
                        }
                    }
                } catch (e) {
                    console.info(e);
                }
            }
            // 计算SKU表格
            // @param boolean init 是否为初始化
            // @param boolean is_change_spec 规格是否发生变动，避免 sku 列表中出现全部禁用状态
            evalSkuTable = function(init, is_change_spec) {
                var deferred = $.Deferred();
                // 缓载
                $.loading.start();
                if (init == undefined) {
                    init = false;
                }
                // 选中的规格
                var checked_spec_list = getCheckedSpecList();
                var is_all = true;
                if (!is_all) {
                    $("#sku_table_container").hide().find("tbody").empty();
                    $("#sku_table_warning").show();
                    $("#goodsmodel-goods_number").prop("readonly", false);
                    $("#goodsmodel-warn_number").prop("readonly", false);
                    $("#goodsmodel-market_price").prop("readonly", false);
                    $("#goodsmodel-goods_price").prop("readonly", false);
                    $("#goodsmodel-cost_price").prop("readonly", false);
                    $("#warn_number").prop("readonly", false);
                    $("#cart_step").prop("readonly", false);
                    $("#goodsmodel-goods_sn").prop("readonly", false);
                    $("#goodsmodel-goods_barcode").prop("readonly", false);
                    // 改变Deferred对象的执行状态
                    deferred.resolve();
                    return deferred;
                } else {
                    $("#sku_table_container").show();
                    $("#sku_table_warning").hide();
                    $("#goodsmodel-goods_number").prop("readonly", true);
                    $("#goodsmodel-warn_number").prop("readonly", true);
                    $("#goodsmodel-market_price").prop("readonly", true);
                    $("#goodsmodel-goods_price").prop("readonly", true);
                    $("#goodsmodel-cost_price").prop("readonly", true);
                    $("#warn_number").prop("readonly", true);
                    $("#cart_step").prop("readonly", true);
                    $("#goodsmodel-goods_sn").prop("readonly", true);
                    $("#goodsmodel-goods_barcode").prop("readonly", true);
                }
                spec_ids = [];
                spec_values = [];
                var sku_td_html = "";
                var sku_th_html = "";
                var temp_attr_ids = [];
                var sku_th_template = $("#sku_th_template").html();
                var sku_td_template = $("#sku_td_template").html();
                // 处理选中的规格值
                checked_spec_list.forEach(function(spec_item){
                    var attr_id = spec_item.attr_id;
                    var attr_name = spec_item.attr_name;
                    var key = "spec-" + attr_id;
                    getCheckedSpecValueList(spec_item.attr_id).forEach(function(sv_item){
                        if (spec_values[key] == undefined) {
                            spec_values[key] = [];
                            spec_ids.push(attr_id);
                        }
                        spec_values[key].push(sv_item);
                        if (temp_attr_ids[attr_id] == undefined) {
                            //sku_th_html += $("#sku_th_template_" + attr_id).html();
                            //sku_td_html += $("#sku_td_template_" + attr_id).html();
                            var temp = sku_th_template;
                            temp = temp.replace(/#attr_id#/g, attr_id);
                            temp = temp.replace(/#attr_name#/g, attr_name);
                            sku_th_html += temp;
                            temp = sku_td_template;
                            temp = temp.replace(/#attr_id#/g, attr_id);
                            temp = temp.replace(/#attr_name#/g, attr_name);
                            sku_td_html += temp;
                            temp_attr_ids[attr_id] = true;
                        }
                    });
                });
                // 遍历行保存当前数据
                $("#sku_table").find("tbody").find("tr").each(function() {
                    var object = $(this).serializeJson();
                    var sku_id = $(this).data("sku_id");
                    var is_enable = $(this).data("is_enable");
                    if (is_enable == undefined || is_change_spec == true) {
                        is_enable = true;
                    }
                    sku_object[sku_id] = object;
                    sku_object[sku_id].checked = is_enable;
                    sku_object[sku_id].is_enable = is_enable;
                });
                $(".spec-th").remove();
                $(".sku-th-index").after($.parseHTML(sku_th_html));
                var list = [];
                if (parseInt(checked_spec_list.length) > 1) {
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
                    $("#goodsmodel-goods_number").prop("readonly", false);
                    $("#goodsmodel-warn_number").prop("readonly", false);
                    $("#goodsmodel-market_price").prop("readonly", false);
                    $("#goodsmodel-goods_price").prop("readonly", false);
                    $("#goodsmodel-cost_price").prop("readonly", false);
                    $("#warn_number").prop("readonly", false);
                    $("#cart_step").prop("readonly", false);
                    $("#goodsmodel-goods_sn").prop("readonly", false);
                    $("#goodsmodel-goods_barcode").prop("readonly", false);
                    // 改变Deferred对象的执行状态
                    deferred.resolve();
                    return deferred;
                } else {
                    $("#sku_table_container").show();
                    $("#sku_table_warning").hide();
                    $("#goodsmodel-goods_number").prop("readonly", true);
                    $("#goodsmodel-warn_number").prop("readonly", true);
                    $("#goodsmodel-market_price").prop("readonly", true);
                    $("#goodsmodel-goods_price").prop("readonly", true);
                    $("#goodsmodel-cost_price").prop("readonly", true);
                    $("#warn_number").prop("readonly", true);
                    $("#cart_step").prop("readonly", true);
                    $("#goodsmodel-goods_sn").prop("readonly", true);
                    $("#goodsmodel-goods_barcode").prop("readonly", true);
                }
                $("#sku_table").find("tbody").find("tr").remove();
                $("#sku_more_table").find("tbody").find("tr").remove();
                var total_goods_number = 0;
                var goods_price = 0;
                var market_price = 0;
                var cost_price = 0;
                // 模板
                var template = $("#sku_table_template").html();
                var more_template = $("#sku_more_table_template").html();
                for (var i = 0; i < list.length; i++) {
                    var objects = list[i];
                    var sku_id = [];
                    var html = "<tr>" + template + "</tr>";
                    var more_html = "<tr>" + more_template + "</tr>";
                    var element = $(html);
                    var more_element = $(more_html);
                    $(element).find(".sku-td-index").after(sku_td_html);
                    $(more_element).find(".sku-td-index").after(sku_td_html);
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
                            $(more_element).find("[name='specs[" + attr_id + "][attr_vid]']").val(getOtherValue(attr_id, vname)).addClass("spec-vid-text-" + vid);
                        } else {
                            sku_id.push(vid);
                            $(element).find("[name='specs[" + attr_id + "][attr_vid]']").val(vid).addClass("spec-vid-text-" + vid);
                            $(more_element).find("[name='specs[" + attr_id + "][attr_vid]']").val(vid).addClass("spec-vid-text-" + vid);
                        }
                        $(element).find(".spec-vname-label[data-attr-id='" + attr_id + "']").html(vname).addClass("spec-vname-label-" + vid);
                        $(element).find("[name='specs[" + attr_id + "][attr_vname]']").val(vname).addClass("spec-vname-text-" + vid);
                        $(element).find("[name='specs[" + attr_id + "][attr_desc]']").val(desc).addClass("spec-desc-text-" + vid);
                        if ($('input[name="GoodsModel[sales_model]"]:checked').val() == 1) {
                            $(element).find(".sku-market-price-td").addClass('hide');
                            $(element).find(".sku-goods-price-td").addClass('hide');
                        }
                        $(more_element).find(".spec-vname-label[data-attr-id='" + attr_id + "']").html(vname).addClass("spec-vname-label-" + vid);
                        $(more_element).find("[name='specs[" + attr_id + "][attr_vname]']").val(vname).addClass("spec-vname-text-" + vid);
                        $(more_element).find("[name='specs[" + attr_id + "][attr_desc]']").val(desc).addClass("spec-desc-text-" + vid);
                    }
                    // 排序，保证sku_id的拼接不受排序影响
                    sku_id.sort();
                    sku_id = sku_id.join("|");
                    // 行标识出SKU_ID
                    $(element).data("sku_id", sku_id);
                    $(more_element).data("sku_id", sku_id);
                    $("#sku_table").find("tbody").append(element);
                    $("#sku_more_table").find("tbody").append(more_element);
                    if (sku_object[sku_id] == undefined) {
                        sku_object[sku_id] = $(element).serializeJson();
                        if (init) {
                            // 初始化时不存在则为false
                            sku_object[sku_id].checked = false;
                        } else {
                            sku_object[sku_id].checked = true;
                        }
                    } else {
                        if (sku_object[sku_id].checked == "false" || sku_object[sku_id].checked == false) {
                            sku_object[sku_id].checked = false;
                        } else {
                            sku_object[sku_id].checked = true;
                        }
                        //还原赋值
                        $(element).find(".sku-field").each(function() {
                            var name = $(this).attr("name");
                            $(this).val(sku_object[sku_id][name]);
                        });
                    }
                    sku_object[sku_id].is_enable = sku_object[sku_id].checked;
                    // 标识是否可用
                    if (sku_object[sku_id].is_enable == undefined || is_change_spec == true) {
                        sku_object[sku_id].is_enable = true;
                    }
                    $(element).data("is_enable", sku_object[sku_id].is_enable);
                    var edit_enable = "1";
                    if (edit_enable > 0) {
                        var a_enable_false = '<a class="del-btn sku-item-handle" data-sku-enable=false data-sku-index="' + (i + 1) + '" title="点击禁用此规格">×</a>';
                        var a_enable_true = '<a class="allow-btn sku-item-handle" data-sku-enable=true data-sku-index="' + (i + 1) + '" title="点击启用此规格">√</a>';
                    } else {
                        var a_enable_false = '';
                        var a_enable_true = '';
                    }
                    if (sku_object[sku_id].is_enable) {
                        $(element).find(".sku-td-index").html((i + 1) + a_enable_false);
                        $(element).removeClass("disabled");
                        $(element).find(":input").prop("disabled", false);
                        $(more_element).find(".sku-td-index").html((i + 1) + a_enable_false);
                        $(more_element).removeClass("disabled");
                        $(more_element).find(":input").prop("disabled", false);
                    } else {
                        $(element).find(".sku-td-index").html((i + 1) + a_enable_true);
                        $(element).addClass("disabled");
                        $(element).find(":input").prop("disabled", true);
                        $(more_element).find(".sku-td-index").html((i + 1) + a_enable_true);
                        $(more_element).addClass("disabled");
                        $(more_element).find(":input").prop("disabled", true);
                    }
                    var erp_goods_id = "0";
                    if (erp_goods_id > 0) {
                        $(".sku-goods-number").prop("disabled", true);
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
                        // 计算最低价格
                        if (!isNaN(parseFloat(sku_object[sku_id]['cost_price'])) && (cost_price == 0 || parseFloat(sku_object[sku_id]['cost_price']) < cost_price)) {
                            cost_price = parseFloat(sku_object[sku_id]['cost_price']);
                        }
                    }
                }
                // 选择了SKU规格组合和禁用商品库存、条形码、货号等
                if (list.length > 0) {
                    $("#goodsmodel-goods_number").prop("readonly", true).val(total_goods_number);
                    // @hezhiqiang 库存预警实时调取sku list的总和
                    // $("#goodsmodel-warn_number").prop("readonly", true).val(0);
                    $("#goodsmodel-warn_number").prop("readonly", true)
                    $("#goodsmodel-market_price").prop("readonly", true).val(market_price);
                    $("#goodsmodel-goods_price").prop("readonly", true).val(goods_price);
                    $("#goodsmodel-cost_price").prop("readonly", true).val(cost_price);
                    $("#goodsmodel-goods_sn").prop("readonly", true);
                    $("#goodsmodel-goods_barcode").prop("readonly", true);
                    $("#warn_number").prop("readonly", true);
                    $("#cart_step").prop("readonly", true);
                } else {
                    $("#goodsmodel-goods_number").prop("readonly", false);
                    $("#goodsmodel-warn_number").prop("readonly", false);
                    $("#goodsmodel-market_price").prop("readonly", false);
                    $("#goodsmodel-goods_price").prop("readonly", false);
                    $("#goodsmodel-cost_price").prop("readonly", false);
                    $("#goodsmodel-goods_sn").prop("readonly", false);
                    $("#goodsmodel-goods_barcode").prop("readonly", false);
                    $("#warn_number").prop("readonly", false);
                    $("#cart_step").prop("readonly", false);
                }
                // 改变Deferred对象的执行状态
                deferred.resolve();
                return deferred;
            }
            function sku_info_sum(sum_goods_number, sum_warn_number, min_goods_price, min_market_price, min_cost_price) {
                // 商品数量求和
                if (sum_goods_number) {
                    var total_goods_number = 0;
                    $(".sku-goods-number").each(function() {
                        if ($(this).parents("tr").data("is_enable") == false) {
                            return;
                        }
                        if ($(this).val().length > 0) {
                            total_goods_number += parseInt($(this).val());
                        }
                    });
                    $("#goodsmodel-goods_number").val(total_goods_number);
                }
                // 商品数量求和
                if (sum_warn_number) {
                    var total_warn_number = 0;
                    $("#sku_table tr[class!='disabled'] input[name='warn_number']").each(function() {
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
                    $("#goodsmodel-warn_number").val(total_warn_number);
                }
                // 商品价格求最低价
                if (min_goods_price) {
                    var goods_price = null;
                    $(".sku-goods-price").each(function() {
                        if ($(this).parents("tr").data("is_enable") == false) {
                            return;
                        }
                        if (goods_price == null || ($(this).val().length > 0 && goods_price > parseFloat($(this).val()))) {
                            goods_price = parseFloat($(this).val());
                        }
                    });
                    $("#goodsmodel-goods_price").val(goods_price);
                }
                // 市场价求最低价
                if (min_market_price) {
                    var market_price = 0;
                    $(".sku-market-price").each(function() {
                        if ($(this).parents("tr").data("is_enable") == false) {
                            return;
                        }
                        if (market_price == 0 || ($(this).val().length > 0 && market_price > parseFloat($(this).val()))) {
                            market_price = isNaN(parseFloat($(this).val())) ? 0 : parseFloat($(this).val());
                        }
                    });
                    $("#goodsmodel-market_price").val(market_price);
                }
                // 成本价求最低价
                if (min_cost_price) {
                    var cost_price = 0;
                    $(".sku-cost-price").each(function() {
                        if ($(this).parents("tr").data("is_enable") == false) {
                            return;
                        }
                        if (cost_price == 0 || ($(this).val().length > 0 && cost_price > parseFloat($(this).val()))) {
                            cost_price = isNaN(parseFloat($(this).val())) ? 0 : parseFloat($(this).val());
                        }
                    });
                    $("#goodsmodel-cost_price").val(cost_price);
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
                sku_info_sum(true, true, true, true, true);
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
                sku_info_sum(true, false, false, false, false);
            });
            // SKU库存警告数量合计后赋值给商品库存警告数量
            $("body").on("keyup", ".sku-warn-number", function() {
                sku_info_sum(false, true, false, false, false);
            });
            // SKU商品价格最小值计算
            $("body").on("keyup", ".sku-goods-price", function() {
                sku_info_sum(false, false, true, false, false);
            });
            // SKU商品市场价格最小值计算
            $("body").on("keyup", ".sku-market-price", function() {
                sku_info_sum(false, false, false, true, false);
            });
            // SKU商品成本价格最小值计算
            $("body").on("keyup", ".sku-cost-price", function() {
                sku_info_sum(false, false, false, false, true);
            });
        });
        //
        $().ready(function() {
            //
            // SKU更多设置
            $("#btn_sku_more_set").click(function() {
                var more_table = $("#sku_more_table");
                $.open({
                    title: "更多SKU设置",
                    width: "850px",
                    content: $("#sku_more_table_container").prop("outerHTML"),
                    btn: ['确定', '取消'],
                    success: function(object, index) {
                        var target = $(object).find("#sku_more_table");
                        $("#sku_table").find("tbody").find("tr").each(function() {
                            var is_enable = $(this).hasClass('disabled');
                            var index = $(this).find("[data-sku-index]").data("sku-index");
                            var tr = $(target).find("[data-sku-index='" + index + "']").parents("tr");
                            if(is_enable)
                            {
                                tr.addClass('disabled');
                                tr.find(":input").prop("disabled", true);
                            }else{
                                tr.removeClass('disabled');
                                tr.find(":input").prop("disabled", false);
                            }
                            $(this).find(".sku-field").each(function() {
                                var name = $(this).attr("name");
                                $(tr).find("[name='" + name + "']").val($(this).val());
                            });
                        });
                    },
                    yes: function(index, object) {
                        var target = $(object).find("#sku_more_table");
                        var all_warn_number = 0;
                        $(target).find("tbody").find("tr").each(function() {
                            var index = $(this).find("[data-sku-index]").data("sku-index");
                            var tr = $("#sku_table").find("[data-sku-index='" + index + "']").parents("tr");
                            var more_tr = $(more_table).find("[data-sku-index='" + index + "']").parents("tr");
                            $(this).find(".sku-field[name='warn_number']").each(function() {
                                var name = $(this).attr("name");
                                if(!$(this).prop('disabled')){
                                    if(parseInt($(this).val())>0){
                                        all_warn_number = all_warn_number + parseInt($(this).val());
                                    }
                                }
                                $(tr).find("[name='" + name + "']").val($(this).val());
                                $(more_tr).find("[name='" + name + "']").val($(this).val());
                            });
                        });
                        $('#goodsmodel-warn_number').val(all_warn_number);
                        $.closeDialog(index);
                    }
                });
            });
            //
        });
        //
        var eachCheckedPropValue = null;
        $(function(){
            var checked_prop_list = [];
            var checked_prop_value_list = [];
            // 初始选中的规格
            var init_checked_prop_ids = "".split(",");
            var init_checked_prop_vids = "".split(",");
            var prop_selector_init = false;
            var prop_values_template = $("#prop_values_template").html();
            var prop_alias_values_template = $("#prop_alias_values_template").html();
            var prop_alias_key = 0;
            // 规格别名，会在初始化后置空
            var prop_alias = {};
            try{
                //
            }catch(e){
                console.error('解析规格别名失败', 'null');
            }
            // 初始化队列
            var init_list = [];
            // 遍历所有被选中的特殊属性
            eachCheckedPropValue = function(cb){
                checked_prop_list.forEach(function(prop_item){
                    if(checked_prop_value_list[prop_item.prop_id]){
                        checked_prop_value_list[prop_item.prop_id].forEach(function(pv_item){
                            cb(pv_item, prop_item);
                        });
                    }
                });
            }
            // 加载规格值
            // @params array prop_list - [{ prop_id, prop_vids }, { prop_id, prop_vids }...]
            function loadPropValues(prop_list){
                // 开始加载
                prop_selector_init && $.loading.start();
                var promise_list = [];
                prop_list.forEach(function(prop_item){
                    var prop_id = prop_item.prop_id;
                    var prop_name = prop_item.prop_name;
                    var prop_vids = prop_item.prop_vids;
                    var target = $("#prop_value_selector_container_" + prop_id);
                    // 创建规格值
                    if(target.size() == 0){
                        // 初始值
                        prop_vids = init_checked_prop_vids;
                        // 根据是否支持别名选择合适的模板
                        var temp = prop_item.is_alias == '1' ? prop_alias_values_template : prop_values_template;
                        // 模板赋值
                        temp = temp.replace(/#key#/g, prop_alias_key++);
                        temp = temp.replace(/#prop_id#/g, prop_id);
                        temp = temp.replace(/#prop_name#/g, prop_alias[prop_id] ? prop_alias[prop_id] : prop_name);
                        temp = temp.replace(/#prop_vids#/g, init_checked_prop_vids);
                        $(".goods-prop-items").append(temp);
                        // 重新查询
                        target = $("#prop_value_selector_container_" + prop_id);
                    }else{
                        var prop_item_element = $(".goods-prop-item[data-prop-id='" + prop_id + "']");
                        $(".goods-prop-items").after(prop_item_element);
                        $(prop_item_element).show();
                    }
                    // 检查是否已加载过
                    if(target.data("loaded") == true){
                        promise_list.push(new Promise(function(resolve, reject){
                            resolve();
                        }));
                        return;
                    }
                    // 表示为已加载
                    target.data("loaded", true);
                    var btn_add_element = $('<a class="btn btn-warning btn-sm btn-add-prop-value m-l-4">添加此规格值</a>');
                    var prop_value_selector = $(target).specValueSelector({
                        size: 0,
                        sortable: true,
                        url: '/site/prop-value-list',
                        data: {
                            prop_id: prop_id,
                            goods_id: "{{ $model['goods_id'] }}"
                        },
                        values: init_checked_prop_vids,
                        // ztree配置
                        ztree_config: {
                            data: {
                                key: {
                                    name: "prop_vname"
                                },
                                simpleData: {
                                    enable: true,
                                    idKey: "prop_vid",
                                    pIdKey: "parent_id",
                                    rootPId: "0",
                                }
                            }
                        },
                        // 是否允许添加
                        addable: prop_item.is_input == '1' ? true : false,
                        // 添加规格
                        addCallback: function(prop_vid, name, node) {
                            if(!checked_prop_value_list[prop_id]){
                                checked_prop_value_list[prop_id] = [];
                            }
                            // 规格是否发生变动，从无到有
                            var spec_changed = checked_prop_value_list[prop_id].length == 0;
                            checked_prop_value_list[prop_id].push(node);
                        },
                        // 改变规格
                        change: function(event_name) {
                            if(!checked_prop_value_list[prop_id]){
                                checked_prop_value_list[prop_id] = [];
                            }
                            if(event_name == "add"){
                                return;
                            }
                            this.hide();
                            if(event_name == "clear"){
                                checked_prop_value_list[prop_id] = [];
                                return;
                            }
                            if(event_name == "remove"){
                                var prop_vids = this.getValues();
                                checked_prop_value_list[prop_id] = checked_prop_value_list[prop_id].filter(function(item){
                                    return prop_vids.some(function(vid){
                                        return item.prop_vid == vid;
                                    });
                                });
                            }
                        },
                        // 排序回调
                        sortCallback: function(){
                            var that = this;
                            checked_prop_value_list[prop_id] = [];
                            this.getValues().forEach(function(prop_vid){
                                checked_prop_value_list[prop_id].push(that.getNode(prop_vid));
                            });
                        },
                        // 渲染工具栏按钮
                        renderButtons: function(show){
                            var html = null;
                            if(show === true){
                                html = btn_add_element;
                            }
                            $(this.getButtonContainer()).empty().html(html);
                        },
                        // 搜索回调
                        searchCallback: function(keyword, nodes){
                            if($.trim(keyword) == "" || this.addable == false){
                                this.renderButtons(false);
                                return;
                            }
                            if(nodes.length > 0){
                                var exists = nodes.some(function(item){
                                    return item.prop_vname == keyword;
                                });
                                if(exists){
                                    this.renderButtons(false);
                                    return;
                                }
                            }
                            this.renderButtons(true);
                            $(btn_add_element).click(function(){
                                addHandle(keyword);
                            });
                        }
                    });
                    // 添加规格值处理器
                    var addHandle = function(keywords){
                        if(keywords == ""){
                            return;
                        }
                        var prop_vid = 'other_' + prop_id + '_' + keywords;
                        var nodeData = {
                            prop_id: prop_id,
                            prop_vname: keywords,
                            prop_vid: prop_vid,
                            keywords: keywords
                        };
                        // 新规格添加到数据列表中
                        prop_value_selector.items.push(nodeData);
                        // 搜索关键词置空
                        $(prop_value_selector.container).find(".tree-chosen-input").val("");
                        // 重新搜索
                        prop_value_selector.search('');
                        // 刷新节点
                        prop_value_selector.refresh();
                        // 查找节点
                        var treeNode = prop_value_selector.getNode(prop_vid);
                        // 直接选中
                        prop_value_selector.add(prop_vid, keywords, treeNode);
                    }
                    promise_list.push(prop_value_selector.load());
                });
                return Promise.all(promise_list).then(function(){
                    // 停止加载
                    prop_selector_init && $.loading.stop();
                });
            }
            var prop_selector = $("#prop_selector_container").specSelector({
                size: 0,
                sortable: true,
                url: '/site/prop-list',
                data: {
                    goods_id: "{{ $model['goods_id'] }}"
                },
                values: init_checked_prop_ids,
                // ztree配置
                ztree_config: {
                    data: {
                        key: {
                            name: "prop_name"
                        },
                        simpleData: {
                            enable: true,
                            idKey: "prop_id",
                            pIdKey: "parent_id",
                            rootPId: "0",
                        }
                    }
                },
                // 添加规格
                addCallback: function(prop_id, name, node) {
                    checked_prop_list.push(node);
                    if(prop_selector_init){
                        loadPropValues([node]);
                        // 如果别名存在，那么在新添加规格时要覆盖别名，还原原来的规格名称
                        $("#prop_name_" + prop_id).val(name);
                    }else{
                        init_list.push(loadPropValues([node]));
                    }
                },
                // 移除规格
                removeCallback: function(prop_id, name, node) {
                    this.hide();
                    // 删除规格
                    checked_prop_list = checked_prop_list.filter(function(item){
                        return item.prop_id != prop_id;
                    });
                    $(".goods-prop-item[data-prop-id='" + prop_id + "']").hide();
                    var specValueSelector = $("#spec_value_selector_container_" + prop_id).specValueSelector();
                    propValueSelector && propValueSelector.clear();
                },
                // 排序回调
                sortCallback: function(){
                    var that = this;
                    checked_prop_list = [];
                    var children = [];
                    this.getValues().forEach(function(prop_id){
                        checked_prop_list.push(that.getNode(prop_id));
                        children.push($(".goods-prop-item[data-prop-id='" + prop_id + "']"));
                    });
                    // 规格值 Dom 排序
                    $(".goods-prop-items").before(children);
                }
            });
            prop_selector.load();
            // 添加特殊属性
            $("#btn_add_goods_prop").click(function() {
                $.loading.start();
                $.open({
                    title: "添加特殊属性",
                    width: "750px",
                    height:"520px",
                    ajax: {
                        url: "/goods/publish/add-prop.html",
                    },
                    btn: ['提交', '取消'],
                    success: function(object, index) {
                        $.loading.stop();
                        var validator = $(object).find("form").validate();
                        // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
                        $.validator.addRules($(object).find(".client-rules").html());
                        $(object).data("validator", validator);
                    },
                    yes: function(index, object) {
                        validator = $(object).data("validator");
                        if (!validator.form()) {
                            return;
                        }
                        var form = $(object).find("form");
                        var url = $(form).attr("action");
                        var data = getPropData();
                        if(data == false){
                            return;
                        }
                        //加载提示
                        $.loading.start();
                        $.post("/goods/publish/add-prop.html", {
                            data: data
                        }, function(result) {
                            if (result.code == 0) {
                                $.msg(result.message);
                                if (result.model) {
                                    var prop_id = result.model.prop_id;
                                    var prop_name = result.model.prop_name;
                                    // 将数据追加到当前结构中
                                    var prop_selector = $("#prop_selector_container").specSelector();
                                    // 补充数据
                                    prop_selector.items.push(result.model);
                                    // 刷新
                                    prop_selector.refresh();
                                    // 查找节点
                                    var treeNode = prop_selector.getNode(prop_id);
                                    // 直接选中
                                    prop_selector.add(prop_id, prop_name, treeNode);
                                }
                                // 关闭
                                $.closeDialog(index);
                            } else {
                                $.msg(result.message, {
                                    time: 5000
                                });
                            }
                        }, "json").always(function() {
                            $.loading.stop();
                        });
                    }
                });
            });
            // 商品特殊属性仅支持零售商品
            $("#goodsmodel-sales_model").find(":radio").change(function(){
                if($(this).val() == "0") {
                    $("#goods_props").show();
                }else{
                    $("#goods_props").hide();
                }
            });
        });
        //
        $().ready(function() {
            $("[data-toggle='popover']").popover();
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
        //
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
                            $("#goodsmodel-goods_image").val(path);
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
                values: ["{{ $model['goods_image'] }}"],
                gallery: true,
                callback: function(result) {
                    var values = this.getValues();
                    var value = values.length > 0 ? values[0] : "";
                    $("#goodsmodel-goods_image").val(value);
                },
                remove: function() {
                    $("#goodsmodel-goods_image").val("");
                }
            });
            // 商品封面图片
            $("#cover_image_container").imagegroup({
                host: "{{ get_oss_host() }}",
                values: ["{{ $model['cover_image'] }}"],
                gallery: true,
                callback: function(result) {
                    var values = this.getValues();
                    var value = values.length > 0 ? values[0] : "";
                    $("#goodsmodel-cover_image").val(value);
                },
                remove: function() {
                    $("#goodsmodel-cover_image").val("");
                }
            });
            //
            // 商品主图视频
            $("#goods_video_container").videogroup({
                host: "{{ get_oss_host() }}",
                values: ["{{ $model['goods_video'] }}"],
                gallery: true,
                options: {
                    minDuration: "0",
                    maxDuration: "90",
                },
                callback: function(data) {
                    var values = this.getValues();
                    var value = values.length > 0 ? values[0] : "";
                    $("#goodsmodel-goods_video").val(value);
                },
                remove: function() {
                    $("#goodsmodel-goods_video").val("");
                }
            });
            //
            $("#btn_upload_pc_desc").click(function() {
                $.imageupload({
                    url: '/site/upload-goods-desc-image',
                    multiple: true,
                    is_watermark:true,
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
            // 刷新运费模板
            $(".refresh-freight-list").click(function() {
                $.get('/goods/publish/freights', {}, function(result) {
                    if (result.code == 0) {
                        var html = "<option value='0'>--请选择--</option>";
                        for (var i = 0; i < result.data.length; i++) {
                            var item = result.data[i];
                            html += "<option value='"+item.freight_id+"'>" + item.title + "</option>";
                        }
                        $("#goodsmodel-freight_id").html(html);
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
                    } else {
                        $("#goods_freight_info").hide();
                    }
                }, "json");
            });
            $(".freight-list").change();
        });
        //
        KindEditor.ready(function(K) {
            var extraFileUploadParams = [];
            extraFileUploadParams['LARAVELVIP_COM_USER_PHPSESSID'] = 'lmh5rrmfk9coae4vpi42lj9j0q';
            window.editor = K.create('#pc_desc', {
                width: '830px',
                minWidth: '650',
                height: '450px',
                items: ['source', '|', 'fullscreen', 'undo', 'redo', 'print', 'cut', 'copy', 'paste', 'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright', 'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', '|', 'quickformat', '|', 'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'flash', 'media', 'table', 'hr', 'emoticons', 'link', 'unlink', '|', 'about'],
                themesPath: "/assets/d2eace91/js/editor/themes/",
                cssPath: "/assets/d2eace91/js/editor/themes/default/default.css",
                uploadJson: "/site/upload-image.html",
                extraFileUploadParams: extraFileUploadParams,
                allowImageUpload: true,
                allowFlashUpload: false,
                allowMediaUpload: false,
                allowFileManager: true,
                syncType: "form",
                // 设置粘贴类型，0:禁止粘贴, 1:纯文本粘贴, 2:HTML粘贴
                pasteType: 2,
                filterMode: '1737' == 15688 ? false : true,
                afterCreate: function() {
                    var self = this;
                    self.sync();
                    //得到编辑器的文档对象
                    var doc = this.edit.doc;
                    var cmd = this.edit.cmd;
                    //监听粘贴事件, 包括右键粘贴和ctrl+v
                    $(doc).bind('paste', null, function(e) {
                        // 上传图片
                        $.imageupload({
                            // 显示加载
                            loading: true,
                            // 获得操作系统剪切板里的项目，e即kindeditor,
                            // kindeditor 创建了 originalEvent(源事件)对象，
                            // 并指向了浏览器的事件对象，而chrome浏览器
                            // 需要通过 clipboardData(剪贴板数据)对象的 items 获得复制的图片数据。
                            pasteEvent: e.originalEvent,
                            // 回调事件
                            callback: function (result) {
                                if (result.code == 0) {
                                    //上传完之后，生成图片标签回显图片，假定服务器返回url。
                                    var src = result.data.url;
                                    var imgTag = '<img src="' + src + '" border="0"/>';
                                    //kindeditor提供了一个在焦点位置插入HTML的函数，调用此函数即可。
                                    cmd.inserthtml(imgTag);
                                } else if (result.message) {
                                    $.msg(result.message, {
                                        time: 3000
                                    })
                                }
                            }
                        });
                        // 组织事件冒泡
                        if (e && e.preventDefault){
                            e.preventDefault();
                        }
                    });
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
        //
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
                    url: '/site/upload-mobile-image.html',
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
                $("#mobile_text_editor").find("textarea").focus();
                $("#btn_mobile_add_text").click();
            });
            //替换
            $(".control-panel").on("click", ".replace", function() {
                var target = $(this).parents(".module");
                $.imageupload({
                    url: '/site/upload-mobile-image.html',
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
        //
        $().ready(function() {
            $(".panel-collapse .panel-body").mCustomScrollbar();
            var validator = $("#GoodsModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules("[{\"id\": \"goodsmodel-cat_id1\", \"name\": \"GoodsModel[cat_id1]\", \"attribute\": \"cat_id1\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"Cat Id1必须是整数。\"}}},{\"id\": \"goodsmodel-cat_id2\", \"name\": \"GoodsModel[cat_id2]\", \"attribute\": \"cat_id2\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"Cat Id2必须是整数。\"}}},{\"id\": \"goodsmodel-cat_id3\", \"name\": \"GoodsModel[cat_id3]\", \"attribute\": \"cat_id3\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"Cat Id3必须是整数。\"}}},{\"id\": \"goodsmodel-pricing_mode\", \"name\": \"GoodsModel[pricing_mode]\", \"attribute\": \"pricing_mode\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"计价方式必须是整数。\"}}},{\"id\": \"goodsmodel-goods_unit\", \"name\": \"GoodsModel[goods_unit]\", \"attribute\": \"goods_unit\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"商品单位必须是整数。\"}}},{\"id\": \"goodsmodel-is_cross_border\", \"name\": \"GoodsModel[is_cross_border]\", \"attribute\": \"is_cross_border\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"是否跨境商品必须是整数。\"}}},{\"id\": \"goodsmodel-shipper_id\", \"name\": \"GoodsModel[shipper_id]\", \"attribute\": \"shipper_id\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"Shipper Id必须是整数。\"}}},{\"id\": \"goodsmodel-sku_mode\", \"name\": \"GoodsModel[sku_mode]\", \"attribute\": \"sku_mode\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"Sku Mode必须是整数。\"}}},{\"id\": \"goodsmodel-is_pickup\", \"name\": \"GoodsModel[is_pickup]\", \"attribute\": \"is_pickup\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"支持自提必须是整数。\"}}},{\"id\": \"goodsmodel-is_common_package\", \"name\": \"GoodsModel[is_common_package]\", \"attribute\": \"is_common_package\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"支持普通快递配送必须是整数。\"}}},{\"id\": \"goodsmodel-pickup_timeout\", \"name\": \"GoodsModel[pickup_timeout]\", \"attribute\": \"pickup_timeout\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"商品自提超时期限必须是整数。\"}}},{\"id\": \"goodsmodel-pickup_timeout_type\", \"name\": \"GoodsModel[pickup_timeout_type]\", \"attribute\": \"pickup_timeout_type\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"Pickup Timeout Type必须是整数。\"}}},{\"id\": \"goodsmodel-filter_attr_ids\", \"name\": \"GoodsModel[filter_attr_ids]\", \"attribute\": \"filter_attr_ids\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"Filter Attr Ids必须是一条字符串。\"}}},{\"id\": \"goodsmodel-filter_attr_vids\", \"name\": \"GoodsModel[filter_attr_vids]\", \"attribute\": \"filter_attr_vids\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"Filter Attr Vids必须是一条字符串。\"}}},{\"id\": \"goodsmodel-goods_stockcode\", \"name\": \"GoodsModel[goods_stockcode]\", \"attribute\": \"goods_stockcode\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"商品库位码必须是一条字符串。\"}}},{\"id\": \"goodsmodel-goods_name\", \"name\": \"GoodsModel[goods_name]\", \"attribute\": \"goods_name\", \"rules\": {\"required\":true,\"messages\":{\"required\":\"商品名称不能为空。\"}}},{\"id\": \"goodsmodel-cat_id\", \"name\": \"GoodsModel[cat_id]\", \"attribute\": \"cat_id\", \"rules\": {\"required\":true,\"messages\":{\"required\":\"商品分类不能为空。\"}}},{\"id\": \"goodsmodel-shop_id\", \"name\": \"GoodsModel[shop_id]\", \"attribute\": \"shop_id\", \"rules\": {\"required\":true,\"messages\":{\"required\":\"店铺ID不能为空。\"}}},{\"id\": \"goodsmodel-goods_price\", \"name\": \"GoodsModel[goods_price]\", \"attribute\": \"goods_price\", \"rules\": {\"required\":true,\"messages\":{\"required\":\"店铺价不能为空。\"}}},{\"id\": \"goodsmodel-goods_number\", \"name\": \"GoodsModel[goods_number]\", \"attribute\": \"goods_number\", \"rules\": {\"required\":true,\"messages\":{\"required\":\"商品库存不能为空。\"}}},{\"id\": \"goodsmodel-add_time\", \"name\": \"GoodsModel[add_time]\", \"attribute\": \"add_time\", \"rules\": {\"required\":true,\"messages\":{\"required\":\"商品发布时间不能为空。\"}}},{\"id\": \"goodsmodel-last_time\", \"name\": \"GoodsModel[last_time]\", \"attribute\": \"last_time\", \"rules\": {\"required\":true,\"messages\":{\"required\":\"最后一次更新时间不能为空。\"}}},{\"id\": \"goodsmodel-freight_id\", \"name\": \"GoodsModel[freight_id]\", \"attribute\": \"freight_id\", \"rules\": {\"required\":true,\"messages\":{\"required\":\"运费模板不能为空。\"}}},{\"id\": \"goodsmodel-sku_open\", \"name\": \"GoodsModel[sku_open]\", \"attribute\": \"sku_open\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"Sku Open必须是整数。\"}}},{\"id\": \"goodsmodel-prop_open\", \"name\": \"GoodsModel[prop_open]\", \"attribute\": \"prop_open\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"Prop Open必须是整数。\"}}},{\"id\": \"goodsmodel-sku_id\", \"name\": \"GoodsModel[sku_id]\", \"attribute\": \"sku_id\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"Sku Id必须是整数。\"}}},{\"id\": \"goodsmodel-cat_id\", \"name\": \"GoodsModel[cat_id]\", \"attribute\": \"cat_id\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"商品分类必须是整数。\"}}},{\"id\": \"goodsmodel-shop_id\", \"name\": \"GoodsModel[shop_id]\", \"attribute\": \"shop_id\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"店铺ID必须是整数。\"}}},{\"id\": \"goodsmodel-invoice_type\", \"name\": \"GoodsModel[invoice_type]\", \"attribute\": \"invoice_type\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"发票必须是整数。\"}}},{\"id\": \"goodsmodel-is_repair\", \"name\": \"GoodsModel[is_repair]\", \"attribute\": \"is_repair\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"保修必须是整数。\"}}},{\"id\": \"goodsmodel-user_discount\", \"name\": \"GoodsModel[user_discount]\", \"attribute\": \"user_discount\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"会员打折必须是整数。\"}}},{\"id\": \"goodsmodel-stock_mode\", \"name\": \"GoodsModel[stock_mode]\", \"attribute\": \"stock_mode\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"库存计数必须是整数。\"}}},{\"id\": \"goodsmodel-goods_number\", \"name\": \"GoodsModel[goods_number]\", \"attribute\": \"goods_number\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"商品库存必须是整数。\"}}},{\"id\": \"goodsmodel-warn_number\", \"name\": \"GoodsModel[warn_number]\", \"attribute\": \"warn_number\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"库存警告数量必须是整数。\"}}},{\"id\": \"goodsmodel-brand_id\", \"name\": \"GoodsModel[brand_id]\", \"attribute\": \"brand_id\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"品牌必须是整数。\"}}},{\"id\": \"goodsmodel-top_layout_id\", \"name\": \"GoodsModel[top_layout_id]\", \"attribute\": \"top_layout_id\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"商品顶部模板编号必须是整数。\"}}},{\"id\": \"goodsmodel-bottom_layout_id\", \"name\": \"GoodsModel[bottom_layout_id]\", \"attribute\": \"bottom_layout_id\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"商品底部模板编号必须是整数。\"}}},{\"id\": \"goodsmodel-packing_layout_id\", \"name\": \"GoodsModel[packing_layout_id]\", \"attribute\": \"packing_layout_id\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"Packing Layout Id必须是整数。\"}}},{\"id\": \"goodsmodel-service_layout_id\", \"name\": \"GoodsModel[service_layout_id]\", \"attribute\": \"service_layout_id\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"Service Layout Id必须是整数。\"}}},{\"id\": \"goodsmodel-click_count\", \"name\": \"GoodsModel[click_count]\", \"attribute\": \"click_count\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"商品浏览次数必须是整数。\"}}},{\"id\": \"goodsmodel-goods_audit\", \"name\": \"GoodsModel[goods_audit]\", \"attribute\": \"goods_audit\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"审核是否通过必须是整数。\"}}},{\"id\": \"goodsmodel-goods_status\", \"name\": \"GoodsModel[goods_status]\", \"attribute\": \"goods_status\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"商品状态必须是整数。\"}}},{\"id\": \"goodsmodel-is_delete\", \"name\": \"GoodsModel[is_delete]\", \"attribute\": \"is_delete\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"是否已删除必须是整数。\"}}},{\"id\": \"goodsmodel-is_virtual\", \"name\": \"GoodsModel[is_virtual]\", \"attribute\": \"is_virtual\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"Is Virtual必须是整数。\"}}},{\"id\": \"goodsmodel-is_best\", \"name\": \"GoodsModel[is_best]\", \"attribute\": \"is_best\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"是否精品必须是整数。\"}}},{\"id\": \"goodsmodel-is_new\", \"name\": \"GoodsModel[is_new]\", \"attribute\": \"is_new\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"是否新品必须是整数。\"}}},{\"id\": \"goodsmodel-is_hot\", \"name\": \"GoodsModel[is_hot]\", \"attribute\": \"is_hot\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"是否热卖必须是整数。\"}}},{\"id\": \"goodsmodel-is_promote\", \"name\": \"GoodsModel[is_promote]\", \"attribute\": \"is_promote\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"是否促销必须是整数。\"}}},{\"id\": \"goodsmodel-supplier_id\", \"name\": \"GoodsModel[supplier_id]\", \"attribute\": \"supplier_id\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"供货商ID必须是整数。\"}}},{\"id\": \"goodsmodel-freight_id\", \"name\": \"GoodsModel[freight_id]\", \"attribute\": \"freight_id\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"运费模板必须是整数。\"}}},{\"id\": \"goodsmodel-goods_sort\", \"name\": \"GoodsModel[goods_sort]\", \"attribute\": \"goods_sort\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"Goods Sort必须是整数。\"}}},{\"id\": \"goodsmodel-audit_time\", \"name\": \"GoodsModel[audit_time]\", \"attribute\": \"audit_time\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"Audit Time必须是整数。\"}}},{\"id\": \"goodsmodel-add_time\", \"name\": \"GoodsModel[add_time]\", \"attribute\": \"add_time\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"商品发布时间必须是整数。\"}}},{\"id\": \"goodsmodel-last_time\", \"name\": \"GoodsModel[last_time]\", \"attribute\": \"last_time\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"最后一次更新时间必须是整数。\"}}},{\"id\": \"goodsmodel-comment_num\", \"name\": \"GoodsModel[comment_num]\", \"attribute\": \"comment_num\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"商品评论次数必须是整数。\"}}},{\"id\": \"goodsmodel-sale_num\", \"name\": \"GoodsModel[sale_num]\", \"attribute\": \"sale_num\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"商品销售数量必须是整数。\"}}},{\"id\": \"goodsmodel-collect_num\", \"name\": \"GoodsModel[collect_num]\", \"attribute\": \"collect_num\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"商品收藏数量必须是整数。\"}}},{\"id\": \"goodsmodel-sales_model\", \"name\": \"GoodsModel[sales_model]\", \"attribute\": \"sales_model\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"销售模式必须是整数。\"}}},{\"id\": \"goodsmodel-erp_goods_id\", \"name\": \"GoodsModel[erp_goods_id]\", \"attribute\": \"erp_goods_id\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"Erp Goods Id必须是整数。\"}}},{\"id\": \"goodsmodel-is_sync_price\", \"name\": \"GoodsModel[is_sync_price]\", \"attribute\": \"is_sync_price\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"Is Sync Price必须是整数。\"}}},{\"id\": \"goodsmodel-is_sync_stock\", \"name\": \"GoodsModel[is_sync_stock]\", \"attribute\": \"is_sync_stock\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"Is Sync Stock必须是整数。\"}}},{\"id\": \"goodsmodel-goods_mode\", \"name\": \"GoodsModel[goods_mode]\", \"attribute\": \"goods_mode\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"商品类别必须是整数。\"}}},{\"id\": \"goodsmodel-cs_dg_id\", \"name\": \"GoodsModel[cs_dg_id]\", \"attribute\": \"cs_dg_id\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"Cs Dg Id必须是整数。\"}}},{\"id\": \"goodsmodel-cover_image\", \"name\": \"GoodsModel[cover_image]\", \"attribute\": \"cover_image\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"封面图片必须是一条字符串。\"}}},{\"id\": \"goodsmodel-goods_images\", \"name\": \"GoodsModel[goods_images]\", \"attribute\": \"goods_images\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"Goods Images必须是一条字符串。\"}}},{\"id\": \"goodsmodel-button_name\", \"name\": \"GoodsModel[button_name]\", \"attribute\": \"button_name\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"按钮名称必须是一条字符串。\"}}},{\"id\": \"goodsmodel-button_url\", \"name\": \"GoodsModel[button_url]\", \"attribute\": \"button_url\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"按钮链接必须是一条字符串。\"}}},{\"id\": \"goodsmodel-goods_price\", \"name\": \"GoodsModel[goods_price]\", \"attribute\": \"goods_price\", \"rules\": {\"number\":{\"pattern\":\"\/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$\/\"},\"messages\":{\"number\":\"店铺价必须是一个数字。\",\"decimal\":\"店铺价必须是一个不大于2位小数的数字。\",\"min\":\"店铺价必须不小于0。\",\"max\":\"店铺价必须不大于9999999。\"},\"decimal\":2,\"min\":0,\"max\":9999999}},{\"id\": \"goodsmodel-market_price\", \"name\": \"GoodsModel[market_price]\", \"attribute\": \"market_price\", \"rules\": {\"number\":{\"pattern\":\"\/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$\/\"},\"messages\":{\"number\":\"市场价必须是一个数字。\",\"decimal\":\"市场价必须是一个不大于2位小数的数字。\",\"min\":\"市场价必须不小于0。\",\"max\":\"市场价必须不大于9999999。\"},\"decimal\":2,\"min\":0,\"max\":9999999}},{\"id\": \"goodsmodel-goods_sort\", \"name\": \"GoodsModel[goods_sort]\", \"attribute\": \"goods_sort\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"Goods Sort必须是整数。\",\"min\":\"Goods Sort必须不小于0。\",\"max\":\"Goods Sort必须不大于9999。\"},\"min\":0,\"max\":9999}},{\"id\": \"goodsmodel-warn_number\", \"name\": \"GoodsModel[warn_number]\", \"attribute\": \"warn_number\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"库存警告数量必须是整数。\",\"min\":\"库存警告数量必须不小于0。\"},\"min\":0}},{\"id\": \"goodsmodel-pickup_timeout\", \"name\": \"GoodsModel[pickup_timeout]\", \"attribute\": \"pickup_timeout\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"商品自提超时期限必须是整数。\",\"min\":\"商品自提超时期限必须不小于0。\"},\"min\":0}},{\"id\": \"goodsmodel-goods_number\", \"name\": \"GoodsModel[goods_number]\", \"attribute\": \"goods_number\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"商品库存必须是整数。\",\"min\":\"商品库存必须不小于0。\",\"max\":\"商品库存必须不大于999999999。\"},\"min\":0,\"max\":999999999}},{\"id\": \"goodsmodel-cost_price\", \"name\": \"GoodsModel[cost_price]\", \"attribute\": \"cost_price\", \"rules\": {\"number\":{\"pattern\":\"\/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$\/\"},\"messages\":{\"number\":\"成本价必须是一个数字。\",\"decimal\":\"成本价必须是一个不大于2位小数的数字。\",\"min\":\"成本价必须不小于0。\",\"max\":\"成本价必须不大于9999999。\"},\"decimal\":2,\"min\":0,\"max\":9999999}},{\"id\": \"goodsmodel-mobile_price\", \"name\": \"GoodsModel[mobile_price]\", \"attribute\": \"mobile_price\", \"rules\": {\"number\":{\"pattern\":\"\/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$\/\"},\"messages\":{\"number\":\"移动端专项价必须是一个数字。\",\"decimal\":\"移动端专项价必须是一个不大于2位小数的数字。\",\"min\":\"移动端专项价必须不小于0。\",\"max\":\"移动端专项价必须不大于9999999。\"},\"decimal\":2,\"min\":0,\"max\":9999999}},{\"id\": \"goodsmodel-pc_desc\", \"name\": \"GoodsModel[pc_desc]\", \"attribute\": \"pc_desc\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"商品电脑端描述必须是一条字符串。\"}}},{\"id\": \"goodsmodel-mobile_desc\", \"name\": \"GoodsModel[mobile_desc]\", \"attribute\": \"mobile_desc\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"商品手机端描述必须是一条字符串。\"}}},{\"id\": \"goodsmodel-contract_ids\", \"name\": \"GoodsModel[contract_ids]\", \"attribute\": \"contract_ids\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"保障服务必须是一条字符串。\"}}},{\"id\": \"goodsmodel-goods_name\", \"name\": \"GoodsModel[goods_name]\", \"attribute\": \"goods_name\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"商品名称必须是一条字符串。\",\"minlength\":\"商品名称应该包含至少1个字符。\",\"maxlength\":\"商品名称只能包含至多60个字符。\"},\"minlength\":1,\"maxlength\":60}},{\"id\": \"goodsmodel-goods_subname\", \"name\": \"GoodsModel[goods_subname]\", \"attribute\": \"goods_subname\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"商品卖点必须是一条字符串。\",\"maxlength\":\"商品卖点只能包含至多255个字符。\"},\"maxlength\":255}},{\"id\": \"goodsmodel-goods_image\", \"name\": \"GoodsModel[goods_image]\", \"attribute\": \"goods_image\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"商品主图必须是一条字符串。\",\"maxlength\":\"商品主图只能包含至多255个字符。\"},\"maxlength\":255}},{\"id\": \"goodsmodel-goods_video\", \"name\": \"GoodsModel[goods_video]\", \"attribute\": \"goods_video\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"主图视频必须是一条字符串。\",\"maxlength\":\"主图视频只能包含至多255个字符。\"},\"maxlength\":255}},{\"id\": \"goodsmodel-keywords\", \"name\": \"GoodsModel[keywords]\", \"attribute\": \"keywords\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"关键词必须是一条字符串。\",\"maxlength\":\"关键词只能包含至多255个字符。\"},\"maxlength\":255}},{\"id\": \"goodsmodel-goods_info\", \"name\": \"GoodsModel[goods_info]\", \"attribute\": \"goods_info\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"商品简介必须是一条字符串。\",\"maxlength\":\"商品简介只能包含至多255个字符。\"},\"maxlength\":255}},{\"id\": \"goodsmodel-goods_reason\", \"name\": \"GoodsModel[goods_reason]\", \"attribute\": \"goods_reason\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"Goods Reason必须是一条字符串。\",\"maxlength\":\"Goods Reason只能包含至多255个字符。\"},\"maxlength\":255}},{\"id\": \"goodsmodel-goods_volume\", \"name\": \"GoodsModel[goods_volume]\", \"attribute\": \"goods_volume\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"物流体积(m3)必须是一条字符串。\",\"maxlength\":\"物流体积(m3)只能包含至多255个字符。\"},\"maxlength\":255}},{\"id\": \"goodsmodel-goods_weight\", \"name\": \"GoodsModel[goods_weight]\", \"attribute\": \"goods_weight\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"物流重量(Kg)必须是一条字符串。\",\"maxlength\":\"物流重量(Kg)只能包含至多255个字符。\"},\"maxlength\":255}},{\"id\": \"goodsmodel-goods_remark\", \"name\": \"GoodsModel[goods_remark]\", \"attribute\": \"goods_remark\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"商品备注必须是一条字符串。\",\"maxlength\":\"商品备注只能包含至多255个字符。\"},\"maxlength\":255}},{\"id\": \"goodsmodel-goods_sn\", \"name\": \"GoodsModel[goods_sn]\", \"attribute\": \"goods_sn\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"商品货号必须是一条字符串。\",\"maxlength\":\"商品货号只能包含至多60个字符。\"},\"maxlength\":60}},{\"id\": \"goodsmodel-goods_barcode\", \"name\": \"GoodsModel[goods_barcode]\", \"attribute\": \"goods_barcode\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"商品条形码必须是一条字符串。\",\"maxlength\":\"商品条形码只能包含至多1,500个字符。\"},\"maxlength\":1500}},{\"id\": \"goodsmodel-invoice_type\", \"name\": \"GoodsModel[invoice_type]\", \"attribute\": \"invoice_type\", \"rules\": {\"in\":{\"range\":[\"0\",\"1\",\"2\",\"3\"]},\"messages\":{\"in\":\"发票是无效的。\"}}},{\"id\": \"goodsmodel-is_repair\", \"name\": \"GoodsModel[is_repair]\", \"attribute\": \"is_repair\", \"rules\": {\"in\":{\"range\":[\"0\",\"1\"]},\"messages\":{\"in\":\"保修是无效的。\"}}},{\"id\": \"goodsmodel-user_discount\", \"name\": \"GoodsModel[user_discount]\", \"attribute\": \"user_discount\", \"rules\": {\"in\":{\"range\":[\"0\",\"1\"]},\"messages\":{\"in\":\"会员打折是无效的。\"}}},{\"id\": \"goodsmodel-stock_mode\", \"name\": \"GoodsModel[stock_mode]\", \"attribute\": \"stock_mode\", \"rules\": {\"in\":{\"range\":[\"0\",\"1\",\"2\"]},\"messages\":{\"in\":\"库存计数是无效的。\"}}},{\"id\": \"goodsmodel-goods_status\", \"name\": \"GoodsModel[goods_status]\", \"attribute\": \"goods_status\", \"rules\": {\"in\":{\"range\":[\"-1\",\"0\",\"1\",\"2\"]},\"messages\":{\"in\":\"商品状态是无效的。\"}}},{\"id\": \"goodsmodel-goods_freight_type\", \"name\": \"GoodsModel[goods_freight_type]\", \"attribute\": \"goods_freight_type\", \"rules\": {\"in\":{\"range\":[\"0\",\"1\",\"2\"]},\"messages\":{\"in\":\"运费设置是无效的。\"}}},{\"id\": \"goodsmodel-goods_freight_fee\", \"name\": \"GoodsModel[goods_freight_fee]\", \"attribute\": \"goods_freight_fee\", \"rules\": {\"number\":{\"pattern\":\"\/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$\/\"},\"messages\":{\"number\":\"商品固定运费必须是一个数字。\",\"decimal\":\"商品固定运费必须是一个不大于2位小数的数字。\",\"min\":\"商品固定运费必须不小于0。\",\"max\":\"商品固定运费必须不大于9999999。\"},\"decimal\":2,\"min\":0,\"max\":9999999}},{\"id\": \"goodsmodel-goods_name\", \"name\": \"GoodsModel[goods_name]\", \"attribute\": \"goods_name\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"商品名称必须是一条字符串。\",\"match\":\"商品名称中含有非法字符\"},\"match\":{\"pattern\":/<|>|<script|<img|<svg|alert|prompt|cookie|@eval|@ini_set|@set_time_limit|\$_SERVER|@set_magic_quotes_runtime/,\"not\":true}}},{\"id\": \"goodsmodel-goods_subname\", \"name\": \"GoodsModel[goods_subname]\", \"attribute\": \"goods_subname\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"商品卖点必须是一条字符串。\",\"match\":\"商品卖点中含有非法字符\"},\"match\":{\"pattern\":/<|>|<script|<img|<svg|alert|prompt|cookie|@eval|@ini_set|@set_time_limit|\$_SERVER|@set_magic_quotes_runtime/,\"not\":true}}},{\"id\": \"goodsmodel-goods_info\", \"name\": \"GoodsModel[goods_info]\", \"attribute\": \"goods_info\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"商品简介必须是一条字符串。\",\"match\":\"商品简介中含有非法字符\"},\"match\":{\"pattern\":/<|>|<script|<img|<svg|alert|prompt|cookie|@eval|@ini_set|@set_time_limit|\$_SERVER|@set_magic_quotes_runtime/,\"not\":true}}},{\"id\": \"goodsmodel-remark\", \"name\": \"GoodsModel[remark]\", \"attribute\": \"remark\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"Remark必须是一条字符串。\",\"match\":\"Remark中含有非法字符\"},\"match\":{\"pattern\":/<|>|<script|<img|<svg|alert|prompt|cookie|@eval|@ini_set|@set_time_limit|\$_SERVER|@set_magic_quotes_runtime/,\"not\":true}}},{\"id\": \"goodsmodel-pc_desc\", \"name\": \"GoodsModel[pc_desc]\", \"attribute\": \"pc_desc\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"商品电脑端描述必须是一条字符串。\"}}},{\"id\": \"goodsmodel-mobile_desc\", \"name\": \"GoodsModel[mobile_desc]\", \"attribute\": \"mobile_desc\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"商品手机端描述必须是一条字符串。\"}}},{\"id\": \"goodsmodel-goods_sn\", \"name\": \"GoodsModel[goods_sn]\", \"attribute\": \"goods_sn\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"商品货号必须是一条字符串。\",\"maxlength\":\"商品货号只能包含至多20个字符。\"},\"maxlength\":20}},{\"id\": \"goodsmodel-goods_barcode\", \"name\": \"GoodsModel[goods_barcode]\", \"attribute\": \"goods_barcode\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"商品条形码必须是一条字符串。\",\"maxlength\":\"商品条形码只能包含至多1,500个字符。\"},\"maxlength\":1500}},{\"id\": \"goodsmodel-goods_moq\", \"name\": \"GoodsModel[goods_moq]\", \"attribute\": \"goods_moq\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"最小起订量必须是整数。\",\"min\":\"最小起订量必须不小于1。\"},\"min\":1}},{\"id\": \"goodsmodel-button_name\", \"name\": \"GoodsModel[button_name]\", \"attribute\": \"button_name\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"按钮名称必须是一条字符串。\"}}},{\"id\": \"goodsmodel-button_url\", \"name\": \"GoodsModel[button_url]\", \"attribute\": \"button_url\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"按钮链接必须是一条字符串。\"}}},{\"id\": \"goodsmodel-goods_freight_fee\", \"name\": \"GoodsModel[goods_freight_fee]\", \"attribute\": \"goods_freight_fee\", \"rules\": {\"required\":true,\"messages\":{\"required\":\"商品固定运费不能为空。\"}}},{\"id\": \"goodsmodel-freight_id\", \"name\": \"GoodsModel[freight_id]\", \"attribute\": \"freight_id\", \"rules\": {\"compare\":{\"operator\":\"\u003E\",\"type\":\"number\",\"compareValue\":0,\"skipOnEmpty\":1},\"messages\":{\"compare\":\"运费模板不能为空\"},\"when\":\"function(){console.info($(\u0027.goods-freight-type:checked\u0027).val());return $(\u0027.goods-freight-type:checked\u0027).val() == 2;}\"}},]");
            $.validator.addMethod("uniqueOtherSpecName", function(value, element, param) {
                if ($(element).siblings(":checkbox").is(":checked") == false) {
                    return true;
                }
                if (value == "") {
                    $(element).focus();
                    return false;
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
            // 日期
            $('.form_datetime').datetimepicker({
                language: 'zh-CN',
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                forceParse: 0,
                showMeridian: 1,
                format: 'yyyy-mm-dd hh:ii:ss',
            }).on('changeDate', function(ev) {
                $(this).trigger("blur");
            });
            var time_points = "10:00,15:00,20:00,22:00".split(",");
            time_points = time_points.map(function (item) {
                item = item.split(":");
                return {
                    hour: parseInt(item[0]),
                    minute: parseInt(item[1]),
                };
            }, time_points);
            var cycle_data = JSON.parse('null');
            var cs_time_point = "";
            // 周期循环组件
            var cyclePicker = $("#cycle_picker_container").cyclePicker({
                value: cycle_data,
                minuteStep: 1,
                daySize: 0,
                weekSize: 5,
                monthSize: 0,
                show_text: '时间不限',
                // 支持的类型回调函数
                typeCallback: function(value) {
                    return true;
                },
                // 开始时间以时间点为准
                hourCallback: function (value, type, is_begin) {
                    return true;
                },
                // 开始时间以时间点为准
                minuteCallback: function (value, type, is_begin) {
                    return true;
                },
                change: function() {
                    // 值发生改变后进行校验
                    this.validate();
                }
            });
            var error_list = [];
            $("#btn_publish").click(function() {
                var cat_id = $("#goodsmodel-cat_id").val();
                if (cat_id == "" || cat_id == 0) {
                    $.msg("商品分类不能为空！");
                    return false;
                }
                var spec_error = false;
                var vname_error = "";
                $(".spec-vname-label").each(function() {
                    var vname = $(this).html();
                    if(vname.length > 30) {
                        spec_error = true;
                        vname_error = vname;
                        return;
                    }
                });
                if(spec_error) {
                    $.msg("商品规格【 " + vname_error + " 】字数超限！");
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
                var goods = $("#GoodsModel").serializeJson();
                goods.GoodsModel.mobile_desc = [];
                // 获取移动端详情
                $(".mobile-editor").find(".module").each(function() {
                    if ($(this).find(".text-html").size() > 0) {
                        var content = $(this).find(".text-html").html();
                        if (content.length > 0) {
                            goods.GoodsModel.mobile_desc.push({
                                'content': content,
                                'type': 0
                            });
                        }
                    } else if ($(this).find("img").size() > 0) {
                        var path = $(this).find("img").data("path");
                        if (path) {
                            goods.GoodsModel.mobile_desc.push({
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
                // 遍历所有被选中的规格值
                eachCheckedSpecValue(function(sv_item, spec_item) {
                    var attr_id = sv_item.attr_id;
                    var attr_vid = sv_item.attr_vid;
                    var attr_vname = sv_item.attr_vname;
                    var attr_desc = '';
                    if (new String(attr_vid).indexOf("other_") == 0) {
                        attr_vid = getOtherValue(attr_id, attr_vname);
                    }
                    goods.goods_specs.push({
                        attr_id: attr_id,
                        attr_vid: attr_vid,
                        attr_vname: attr_vname,
                        attr_desc: attr_desc
                    });
                });
                // 获取商品属性设置
                goods.goods_prop_items = [];
                // 遍历所有被选中的特殊属性值
                if($.isFunction(window.eachCheckedPropValue)){
                    eachCheckedPropValue(function(pv_item, prop_item) {
                        var prop_id = pv_item.prop_id;
                        var prop_vid = pv_item.prop_vid;
                        var prop_vname = pv_item.prop_vname;
                        goods.goods_prop_items.push({
                            prop_id: prop_id,
                            prop_vid: prop_vid
                        });
                    });
                }
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
                    goods['GoodsModel']['pc_desc'] = html;
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
                //处理阶梯价格
                if ($('.goods-stepped-price').length > 0 && !$('.goods-stepped-price').hasClass('hide')) {
                    goods.step_price = validStepPrice();
                    if (goods.step_price == false) {
                        return;
                    }
                }
                // 扩展分类
                var other_cat_ids = $("#other_cat_ids").val();
                if(other_cat_ids == ""||other_cat_ids==undefined){
                    goods.other_cat_ids = [];
                }else{
                    goods.other_cat_ids = other_cat_ids.split(",");
                }
                var data = JSON.stringify(goods);
                if($("#cart_step").size() > 0){
                    data.cart_step = $("#cart_step").val();
                }
                // 加载
                $.loading.start();
                if ("{{ $model['goods_id'] }}" == "") {
                    $.post('/goods/publish/add?cat_id={{ $model['cat_id'] }}', {
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
                            $.go('/goods/publish/add-images.html?id=' + goods_id);
                        } else {
                            $.alert(result.message);
                        }
                    }, 'json');
                } else {
                    $.post('/goods/publish/edit?id={{ $model['goods_id'] }}&scid={{ $scid }}', {
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
                                $.go('/goods/publish/edit?id={{ $model['goods_id'] }}&scid={{ $scid }}');
                            });
                        } else {
                            $.alert(result.message);
                        }
                    }, 'json');
                }
            });
            function validFreightId() {
                if ($("#goodsmodel-goods_freight_type_2").is(":checked") && $("#goodsmodel-freight_id").val() == 0) {
                    $.validator.showError($("#goodsmodel-freight_id"), "运费模板不能为空");
                } else {
                    $.validator.clearError($("#goodsmodel-freight_id"));
                }
            }
            $(".goods-freight-type").click(function() {
                validFreightId();
                var freight_fee_valid = $("#goodsmodel-goods_freight_fee").valid();
                if ($(this).val() != 1 && freight_fee_valid == false) {
                    $("#goodsmodel-goods_freight_fee").val("0.00");
                    $("#goodsmodel-goods_freight_fee").valid();
                }
                if ($(this).val() != 2) {
                    $("#goodsmodel-freight_id").val("0");
                    $("#goods_freight_info").hide();
                }
            });
            $("body").on("change", "#goodsmodel-freight_id", function() {
                var freight_fee_valid = $("#goodsmodel-goods_freight_fee").valid();
                if ($(".goods-freight-type:checked").val() != 1 && freight_fee_valid == false) {
                    $("#goodsmodel-goods_freight_fee").val("0.00");
                    $("#goodsmodel-goods_freight_fee").valid();
                }
            });
            // 批量设置
            $("body").on("click", ".btn_batch_set", function() {
                var field = $(this).data("field");
                var value = $(this).parents(".batch-input").find(":text").val();
                $(this).parents("table").find("[name='" + field + "']:not(:disabled)").val(value);
                $(this).parents(".batch-input").find(".batch-close").click();
                // 合计
                if (field == 'goods_number') {
                    $(".sku-goods-number").keyup();
                }
                if (field == 'warn_number') {
                    $(".sku-warn-number").keyup();
                }
                if (field == 'goods_price') {
                    $(".sku-goods-price").keyup();
                }
                if (field == 'market_price') {
                    $(".sku-market-price").keyup();
                }
                if (field == 'cost_price') {
                    $(".sku-cost-price").keyup();
                }
            });
            // 刷新运费模板
            $(".refresh-layout-list").click(function() {
                $.loading.start();
                $.get('/goods/publish/layouts', {}, function(result) {
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
                $.go("{{ route('pc_show_goods',['goods_id'=>$model['goods_id']]) }}", "_blank");
            });
            //添加分类按钮
            $("#btn_addCategory").click(function() {
                $(".choosen-select-box").append("");
            });
            // 鼠标悬浮
            $("body").on("mouseenter", ".batch-edit", function() {
                $.tips('点击批量设置', $(this), {
                    tips: 1,
                    time: 2000
                });
            });
            var goods_id = "{{ $model['goods_id'] }}";
            $("#change_category").click(function() {
                if (!confirm("此页面要求您确认想要离开 - 您输入的数据可能不会被保存。")) {
                    return false;
                }
                if (goods_id == "") {
                    $.go("/goods/publish/index.html");
                } else {
                    $.go("/goods/publish/index.html?id={{ $model['goods_id'] }}");
                }
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
            // 给定时出售绑定change事件
            $("body").on("change", "input[name='GoodsModel[goods_status]']", function() {
                if($(this).val() == -1)
                {
                    $('#start_time').removeClass('hide');
                    $('#sale_time_quantum').removeClass('hide');
                }
                else
                {
                    $('#start_time').addClass('hide');
                    $('#sale_time_quantum').addClass('hide');
                }
            });
        });
        //
        $(function() {
            //select-input操作
            $(".select-input").focus(function(){
                $(this).parent(".select-popover-wrapper").find(".select-item-box").show();
            });
            $('.select-item').click( function(){
                $(this).addClass('selected').siblings(".select-item").removeClass("selected");
                var selectInput = $(this).parents(".select-popover-wrapper").find(".select-input");
                selectInput.attr('value',$(this).html());
                selectInput.attr('title',$(this).html());
                $(this).parents(".select-popover-wrapper").find(".select-item-box").hide();
            });
            $('.select-remove').click( function(){
                $(this).parents(".select-popover-wrapper").remove();
            });
            $('.goods-spec-move').click( function(){
                $(this).parent(".goods-spec-item").remove();
            });
            //$('.select-input').blur( function(){
            //    $(this).parent(".select-popover-wrapper").find(".select-item-box").hide();
            //    });
            // 批量设置价格、库存、预警值
            $("body").on('click', ".batch > .batch-edit", function() {
                $('.batch > .batch-input').hide();
                $(this).next().show();
                // 批量设置获取焦点
                $(this).parents(".batch").find(".batch-input").find(":text").focus();
            });
            $("body").on('click', ".batch-input > .batch-close", function() {
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
        //
        $(function() {
            $('input[name="GoodsModel[sales_model]"]').change(function() {
                if ($(this).val() == 1) {
                    $('.goods-stepped-price').removeClass('hide');
                    $(".sku-market-price-td").addClass('hide');
                    $(".sku-goods-price-td").addClass('hide');
                    $("#goodsmodel-goods_moq").attr('readonly', true);
                    $("#goodsmodel-goods_price").attr('readonly', true);
                } else {
                    $('.goods-stepped-price').addClass('hide');
                    $(".sku-market-price-td").removeClass('hide');
                    $(".sku-goods-price-td").removeClass('hide');
                    $("#goodsmodel-goods_moq").attr('readonly',false);
                    $("#goodsmodel-goods_price").attr('readonly',false);
                }
            });
            $('.add-step-price').click(function() {
                var template = $('#step_price_tr_template').html();
                $('.goods-stepped-price tbody.append').append(template);
                if ($('input[name="GoodsModel[pricing_mode]"]:checked').val() == 1) {
                    if ($('#goodsmodel-goods_unit').val() > 0) {
                        $('body').find('.pricing-mode').html($("#goodsmodel-goods_unit").find("option:selected").text());
                    } else {
                        $('body').find('.pricing-mode').html('件');
                    }
                } else {
                    $('body').find('.pricing-mode').html('件');
                }
                if ($('.goods-stepped-price tbody tr[class="item"]').length > 2) {
                    $(this).parents('tr').addClass('hide');
                }
                previewView();
            });
            $('body').on('click', '.del-step-price', function() {
                $(this).parent().parent().remove();
                $('.add-step-price').parents('tr').removeClass('hide');
                countStepPrice();
                previewView();
            });
            $("body").on("keyup", ".step-number", function(i, v) {
                countStepPrice();
                previewView();
            });
            $("body").on("keyup", ".step-price", function() {
                countStepPrice();
                previewView();
            });
            $('input[name="GoodsModel[pricing_mode]"]').change(function() {
                if ($(this).val() == 1) {
                    if ($('#goodsmodel-goods_unit option:selected').val() > 0) {
                        $('body').find('.pricing-mode').html($('#goodsmodel-goods_unit option:selected').text());
                    }
                } else {
                    $('body').find('.pricing-mode').html('件');
                }
            });
            $('#goodsmodel-goods_unit').change(function() {
                if ($('input[name="GoodsModel[pricing_mode]"]:checked').val() == 1) {
                    if ($(this).val() > 0) {
                        $('body').find('.pricing-mode').html($('#goodsmodel-goods_unit option:selected').text());
                    }
                }
            });
            if ($('.goods-stepped-price').length > 0 && !$('.goods-stepped-price').hasClass('hide')) {
                countStepPrice();
            }
        });
        // 批发模式下，计算阶梯价格中的最大值值复制给SKU的店铺价格
        function countStepPrice() {
            if ($("input[name='GoodsModel[sales_model]']:checked").size() == 0) {
                return;
            }
            var sale_model = $("input[name='GoodsModel[sales_model]']:checked").val();
            if (sale_model == 0) {
                return;
            }
            $.validator.clearError($('.goods-stepped-price-table'));
            var min_price = 0;
            var max_price = 0;
            $.each($('.step-price'), function() {
                if (min_price == 0) {
                    min_price = parseFloat($(this).val());
                }
                if (min_price >= parseFloat($(this).val())) {
                    min_price = parseFloat($(this).val());
                }
            });
            $.each($('.step-price'), function() {
                if (max_price == 0) {
                    max_price = parseFloat($(this).val());
                }
                if (max_price <= parseFloat($(this).val())) {
                    max_price = parseFloat($(this).val());
                }
            });
            if (max_price > 0) {
                $('#sku_table_container').find('#sku_table tbody tr .sku-market-price').val(max_price);
                $('#sku_table_container').find('#sku_table tbody tr .sku-goods-price').val(max_price);
            } else {
                $('#sku_table_container').find('#sku_table tbody tr .sku-market-price').val('100.00');
                $('#sku_table_container').find('#sku_table tbody tr .sku-goods-price').val('100.00');
            }
            if (max_price > 0) {
                $("#goodsmodel-goods_price").val(min_price);
                $('#goodsmodel-market_price').val(min_price);
                $('#goodsmodel-cost_price').val(min_price);
                $("#goodsmodel-goods_price").prop("readonly", true);
                $('#goodsmodel-market_price').prop("readonly", false);
                $('#goodsmodel-cost_price').prop("readonly", false);
            } else {
                $("#goodsmodel-goods_price").val('100.00');
                $("#goodsmodel-goods_price").prop("readonly", false);
            }
            $('.step-number').eq(0).val();
            if ($('.step-number').eq(0).val() > 0) {
                $('#goodsmodel-goods_moq').val($('.step-number').eq(0).val());
                $("#goodsmodel-goods_moq").prop("readonly", true);
            }
            $('#goodsmodel-market_price').val('0.00');
            $('#goodsmodel-cost_price').val('0.00');
            return min_price;
        }
        //生成预览
        function previewView() {
            var sale_rule = ['一', '二', '三'];
            $('.goods-stepped-price-preview tbody').html('');
            var preview_template = $('#step_price_preview_template').html();
            var step_number = [];
            $.each($('.goods-stepped-price tbody.append tr'), function(i, v) {
                step_number.push($(v).find('.step-number').val());
            });
            $.each($('.goods-stepped-price tbody.append tr'), function(i, v) {
                var number = $(v).find('.step-number').val();
                var price = $(v).find('.step-price').val();
                if (number != '' && number > 0) {
                    if (step_number.length == i + 1) {
                        if (!isNaN(number)) {
                            number = '≥' + number;
                        } else {
                            number = '';
                            price = '';
                        }
                    } else if (number == (step_number[i + 1] - 1)) {
                        if (!isNaN(number)) {
                            number = number;
                        } else {
                            number = '';
                            price = '';
                        }
                    } else {
                        if (!isNaN(step_number[i]) && !isNaN(step_number[i + 1]) && step_number[i] != '') {
                            if (step_number[i + 1] - 1 >= 0 && ((step_number[i + 1] - 1) > step_number[i])) {
                                number = step_number[i] + '-' + (step_number[i + 1] - 1);
                            } else {
                                number = '';
                                price = '';
                            }
                        } else {
                            number = '';
                            price = '';
                        }
                    }
                } else {
                    number = '';
                    price = '';
                }
                $('.goods-stepped-price-preview tbody').append(preview_template);
                $('.goods-stepped-price-preview tbody tr').eq(i).find('.sale-rule').html(sale_rule[i] + '：');
                $('.goods-stepped-price-preview tbody tr').eq(i).find('.preview-number').html(number);
                $('.goods-stepped-price-preview tbody tr').eq(i).find('.preview-price').html(price);
            });
        }
        // 验证阶梯价格
        function validStepPrice() {
            var step_price = [];
            var step_price_valid = true;
            var w_number, w_price;
            var message = [];
            $.each($('.goods-stepped-price tbody tr[class="item"]'), function() {
                var number = $(this).find('input').eq(0).val();
                var price = $(this).find('input').eq(1).val();
                var flag = false;
                if (w_number > 0 && w_number >= parseFloat(number)) {
                    $(this).find('input').eq(0).addClass('error');
                    step_price_valid = false;
                    message[0] = '购买数量后者需大于前者';
                }
                if (!isNaN(number) && parseFloat(number) > 0) {
                    w_number = parseFloat(number);
                } else {
                    w_number = 0;
                    $(this).find('input').eq(0).addClass('error');
                    step_price_valid = false;
                    message[1] = '购买数量必须为大于0的数字';
                }
                if (w_price > 0 && w_price <= parseFloat(price)) {
                    $(this).find('input').eq(1).addClass('error');
                    step_price_valid = false;
                    message[2] = '商品价格后者需小于前者';
                }
                if (!isNaN(price) && parseFloat(price) > 0) {
                    w_price = price;
                } else {
                    w_price = 0;
                    $(this).find('input').eq(1).addClass('error');
                    step_price_valid = false;
                    message[3] = '商品价格必须为不小于0的数字';
                }
                if (parseFloat(w_number) > 0 && parseFloat(w_price) > 0) {
                    step_price.push(w_number + ',' + w_price);
                } else {
                    step_price_valid = false;
                }
            });
            if (step_price.length == 0) {
                message[4] = '请设置阶梯价格';
                step_price_valid = false;
            }
            for (var i = 0; i < message.length; i++) {
                if (message[i] == "" || typeof (message[i]) == "undefined") {
                    message.splice(i, 1);
                    i = i - 1;
                }
            }
            if (step_price_valid == false) {
                $.msg(message.join('<br/>'));
                $.validator.showError($('.goods-stepped-price-table'), message.join('；'));
                return false;
            } else {
                return step_price;
            }
        }
        //
        $().ready(function(){
            //
            var other_cat_ids = "{{ implode(',', array_column($other_cat_ids, 'cat_id')) }}".split(",");
            //
            var catselector = $("#other_cat_container").catselector({
                size: 0,
                data: {
                    deep: 3
                },
                values: other_cat_ids,
                addCallback: function(id, name, node) {
                },
                removeCallback: function(id) {
                    this.hide();
                },
                change: function(){
                    $("#other_cat_ids").val(this.getValues().join(","));
                }
            });
            catselector.load();
            // 加载初始化
            //
            var shop_cat_ids = "{{ $model['shop_cat_ids'] }}".split(",");
            //
            // 店铺内商品分类
            var shopcatselector = $("#shop_cat_container").catselector({
                url: '/site/shop-cat-list.html',
                size: 0,
                data: {
                    deep: 2
                },
                values: shop_cat_ids,
                addCallback: function(id, name, node) {
                },
                removeCallback: function(id) {
                    this.hide();
                },
                change: function(){
                    $("#shop_cat_ids").val(this.getValues().join(","));
                }
            });
            // 加载初始化
            shopcatselector.load();
            // 重新加载红包
            $("body").on("click", ".reload_btn", function() {
                $.loading.start();
                $.get("/goods/publish/reload-goods-unit.html", {
                }, function(result) {
                    if (result.code == 0) {
                        var list = result.data;
                        var html = "";
                        for ( var name in result.data) {
                            html += "<option value='"+name+"'>" + result.data[name] + "</option>";
                        }
                        $("#goodsmodel-goods_unit").html(html);
                        $('.chosen-select').chosen("destroy");
                        $('.chosen-select').chosen();
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "JSON").always(function() {
                    $.loading.stop();
                });
            });
            var goods_mode_change_before = '0';
            $('#goodsmodel-goods_mode').find('[name="GoodsModel[goods_mode]"]').change(function(){
                var goods_mode = $(this).val();
                $.confirm("切换商品类别会丢失表单数据，您确定切换吗?", function() {
                    $.go('/goods/publish/index.html?cat_id={{ $model['cat_id'] }}&goods_mode='+goods_mode);
                },function(){
                    $('#goodsmodel-goods_mode').find('[name="GoodsModel[goods_mode]"][value='+goods_mode_change_before+']').prop('checked', true);
                });
            });
            $(".v-name").each(function() {
                var vname = $(this).html();
                if(vname.length > 30) {
                    $(this).html("<font class='text-intercept'>"+vname+"</font>" + "<font class='m-l-5 c-red'><i class='fa fa-warning'></i>字数超限</font>");
                }
            });
        });
        //
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop
