{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20190116"/> 
    <link rel="stylesheet" href="/assets/d2eace91/css/common.css?v=20190116"/>
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <!-- 隐藏域 -->
    <div class="table-content m-t-30 clearfix">
        <form id="IntegralGoodsModel" class="form-horizontal" name="IntegralGoodsModel" action="/dashboard/integral-mall/add-integral-goods" method="post" onSubmit="return mobileDesc()">
            @csrf

            <input type="hidden" id="integralgoodsmodel-goods_id" class="form-control" name="IntegralGoodsModel[goods_id]" value="{{ $info->goods_id ?? '' }}">
            <!-- 商品名称-->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="integralgoodsmodel-goods_name" class="col-sm-3 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">商品名称：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">


                            <input type="text" id="integralgoodsmodel-goods_name" class="form-control" name="IntegralGoodsModel[goods_name]" value="{{ $info->goods_name ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">商品标题名称长度至少3个字，最多60个字</div></div>
                    </div>
                </div>
            </div>
            <!-- 商品价格 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="integralgoodsmodel-goods_price" class="col-sm-3 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">商品价格：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">


                            <input type="text" id="integralgoodsmodel-goods_price" class="form-control ipt m-r-10" name="IntegralGoodsModel[goods_price]" value="{{ $info->goods_price ?? '' }}">元


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">价格必须是0.01~9999999之间的数字</div></div>
                    </div>
                </div>
            </div>

            <!-- 所需积分 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="integralgoodsmodel-goods_integral" class="col-sm-3 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">所需积分：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">


                            <input type="text" id="integralgoodsmodel-goods_integral" class="form-control ipt m-r-10" name="IntegralGoodsModel[goods_integral]" value="{{ $info->goods_integral ?? '' }}">积分


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            <!-- 可兑换库存 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="integralgoodsmodel-goods_number" class="col-sm-3 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">可兑换商品库存：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">


                            <input type="text" id="integralgoodsmodel-goods_number" class="form-control ipt m-r-10" name="IntegralGoodsModel[goods_number]" value="{{ $info->goods_number ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">仅用于兑换的商品库存</div></div>
                    </div>
                </div>
            </div>

            <!-- 限制兑换时间 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="integralgoodsmodel-is_limit" class="col-sm-4 control-label">

                        <span class="ng-binding">限制兑换时间：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="hidden" name="IntegralGoodsModel[is_limit]" value="">
                            <div id="integralgoodsmodel-is_limit" class="" name="IntegralGoodsModel[is_limit]">
                                @if(!isset($info->is_limit))
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="IntegralGoodsModel[is_limit]" value="0" checked> 无限制</label>
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="IntegralGoodsModel[is_limit]" value="1"> 限制</label>
                                @else
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="IntegralGoodsModel[is_limit]" value="0" @if($info->is_limit == 0) checked @endif> 无限制</label>
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="IntegralGoodsModel[is_limit]" value="1" @if($info->is_limit == 1) checked @endif> 限制</label>
                                @endif
                            </div>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <div id="exchange-div" style="display: none;">
                <!-- 开始时间 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="integralgoodsmodel-start_time" class="col-sm-3 control-label">

                            <span class="ng-binding">开始时间：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">


                                <input type="text" id="start_date" class="form-control form_datetime large" name="IntegralGoodsModel[start_time]" value="{{ $info->start_time ?? '1970-01-01' }}" placeholder="请选择开始时间">


                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>

                <!-- 结束时间 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="integralgoodsmodel-end_time" class="col-sm-3 control-label">

                            <span class="ng-binding">结束时间：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">


                                <input type="text" id="end_date" class="form-control form_datetime large" name="IntegralGoodsModel[end_time]" value="{{ $info->end_time ?? '1970-01-01' }}" placeholder="请选择结束时间">


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">在兑换时间内，商品才能正常兑换，否则商品不可兑换</div></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 商品图片 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="integralgoodsmodel-goods_images" class="col-sm-4 control-label">

                        <span class="ng-binding">商品图片：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <div id="imagegroup_container" class="szy-imagegroup" data-size="5"></div>
                            <input type="hidden" id="integralgoodsmodel-goods_images" class="form-control" name="IntegralGoodsModel[goods_images]" value="{{ $info->goods_images ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">支持jpg、gif、png格式上传或从图片空间中选择，建议使用尺寸800*800像素以上、大小不超过1M的正方形图片，最多上传5张图片</div></div>
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
                                        <textarea id="pc_desc" class="form-control" name="IntegralGoodsModel[pc_desc]" rows="5" style="width:100%; height: 350px; visibility: hidden;">{!! $info->pc_desc ?? '' !!}</textarea>
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
                                                    @if(!empty($info->mobile_desc))
                                                        @foreach($info->mobile_desc as $v)
                                                            <div class="module m-image first">
                                                                <ul class="tools">
                                                                    <li>
                                                                        <a href="javascript:void(0);" class="up">上移</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="javascript:void(0);" class="down">下移</a>
                                                                    </li>

                                                                    @if($v->type == 0)
                                                                        {{--文本--}}
                                                                        <li>
                                                                            <a href="javascript:void(0);" class="edit">编辑</a>
                                                                        </li>
                                                                    @elseif($v->type == 1)
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

                                                                    @if($v->type == 1)
                                                                        <div class="image-div">
                                                                            <img src="{{ get_image_url($v->content) }}" data-path="{{ $v->content }}">
                                                                        </div>
                                                                    @elseif($v->type == 0)
                                                                        <div class="text-div">
                                                                            <div class="text-html">{!! $v->content !!}</div>
                                                                        </div>
                                                                    @endif

                                                                </div>
                                                                <div class="cover"></div>
                                                            </div>
                                                        @endforeach
                                                    @endif
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
                                                    <span class="c-red">宽度480-1242像素之间，高度小于等于1546像素</span>
                                                    ；建议上传详情图片宽度为
                                                    <span class="c-red">750像素</span>
                                                    ，效果更佳。
                                                </dd>
                                                <dd>
                                                    （2）格式为：
                                                    <span class="c-red">jpg、jepg、gif、png；</span>
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
                                    <textarea id="mobile_desc" class="form-control" name="IntegralGoodsModel[mobile_desc]" rows="5" style="display:none"></textarea>
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
            <!-- 排序 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="integralgoodsmodel-goods_sort" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">商品排序：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="integralgoodsmodel-goods_sort" class="form-control small" name="IntegralGoodsModel[goods_sort]" value="{{ $info->goods_sort ?? 255 }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">数字范围为0~255，数字越小越靠前</div></div>
                    </div>
                </div>
            </div>
            <!-- 提交按钮 -->
            <div class="bottom-btn p-b-30">
                <button id="btn_submit" class="btn btn-primary btn-lg">确认提交</button>
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
    <!-- 时间插件引入 start -->
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.css?v=20190116"/> <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.js?v=20190121"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=20190121"></script>
    <!-- 时间插件引入 end -->
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20190121"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20190121"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20190121"></script>
    <!-- AJAX上传+图片预览 -->
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=20190121"></script>
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=20190121"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20190121"></script>
    <script id="client_rules" type="text">
[{"id": "integralgoodsmodel-goods_name", "name": "IntegralGoodsModel[goods_name]", "attribute": "goods_name", "rules": {"required":true,"messages":{"required":"商品名称不能为空。"}}},{"id": "integralgoodsmodel-goods_price", "name": "IntegralGoodsModel[goods_price]", "attribute": "goods_price", "rules": {"required":true,"messages":{"required":"商品价格不能为空。"}}},{"id": "integralgoodsmodel-goods_number", "name": "IntegralGoodsModel[goods_number]", "attribute": "goods_number", "rules": {"required":true,"messages":{"required":"可兑换商品库存不能为空。"}}},{"id": "integralgoodsmodel-goods_integral", "name": "IntegralGoodsModel[goods_integral]", "attribute": "goods_integral", "rules": {"required":true,"messages":{"required":"所需积分不能为空。"}}},{"id": "integralgoodsmodel-goods_sort", "name": "IntegralGoodsModel[goods_sort]", "attribute": "goods_sort", "rules": {"required":true,"messages":{"required":"商品排序不能为空。"}}},{"id": "integralgoodsmodel-goods_number", "name": "IntegralGoodsModel[goods_number]", "attribute": "goods_number", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"可兑换商品库存必须是整数。"}}},{"id": "integralgoodsmodel-goods_integral", "name": "IntegralGoodsModel[goods_integral]", "attribute": "goods_integral", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"所需积分必须是整数。"}}},{"id": "integralgoodsmodel-shop_id", "name": "IntegralGoodsModel[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"店铺ID必须是整数。"}}},{"id": "integralgoodsmodel-goods_name", "name": "IntegralGoodsModel[goods_name]", "attribute": "goods_name", "rules": {"string":true,"messages":{"string":"商品名称必须是一条字符串。"}}},{"id": "integralgoodsmodel-goods_images", "name": "IntegralGoodsModel[goods_images]", "attribute": "goods_images", "rules": {"string":true,"messages":{"string":"商品图片必须是一条字符串。"}}},{"id": "integralgoodsmodel-goods_video", "name": "IntegralGoodsModel[goods_video]", "attribute": "goods_video", "rules": {"string":true,"messages":{"string":"商品视频必须是一条字符串。"}}},{"id": "integralgoodsmodel-pc_desc", "name": "IntegralGoodsModel[pc_desc]", "attribute": "pc_desc", "rules": {"string":true,"messages":{"string":"商品电脑端描述必须是一条字符串。"}}},{"id": "integralgoodsmodel-mobile_desc", "name": "IntegralGoodsModel[mobile_desc]", "attribute": "mobile_desc", "rules": {"string":true,"messages":{"string":"商品手机端描述必须是一条字符串。"}}},{"id": "integralgoodsmodel-goods_name", "name": "IntegralGoodsModel[goods_name]", "attribute": "goods_name", "rules": {"string":true,"messages":{"string":"商品名称必须是一条字符串。","minlength":"商品名称应该包含至少3个字符。","maxlength":"商品名称只能包含至多60个字符。"},"minlength":3,"maxlength":60}},{"id": "integralgoodsmodel-goods_integral", "name": "IntegralGoodsModel[goods_integral]", "attribute": "goods_integral", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"所需积分必须是整数。","min":"所需积分必须不小于1。"},"min":1}},{"id": "integralgoodsmodel-goods_number", "name": "IntegralGoodsModel[goods_number]", "attribute": "goods_number", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"可兑换商品库存必须是整数。","min":"可兑换商品库存必须不小于0。"},"min":0}},{"id": "integralgoodsmodel-goods_sort", "name": "IntegralGoodsModel[goods_sort]", "attribute": "goods_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品排序必须是整数。","min":"商品排序必须不小于0。","max":"商品排序必须不大于255。"},"min":0,"max":255}},{"id": "integralgoodsmodel-goods_price", "name": "IntegralGoodsModel[goods_price]", "attribute": "goods_price", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"商品价格必须是一个数字。","min":"商品价格必须不小于0.01。","max":"商品价格必须不大于9999999。"},"min":0.01,"max":9999999}},{"id": "integralgoodsmodel-goods_price", "name": "IntegralGoodsModel[goods_price]", "attribute": "goods_price", "rules": {"match":{"pattern":/^[0-9]+(.[0-9]{1,2})?$/,"not":false,"skipOnEmpty":1},"messages":{"match":"套餐价格最多两位小数。"}}},{"id": "integralgoodsmodel-market_price", "name": "IntegralGoodsModel[market_price]", "attribute": "market_price", "rules": {"match":{"pattern":/^[0-9]+(.[0-9]{1,2})?$/,"not":false,"skipOnEmpty":1},"messages":{"match":"套餐价格最多两位小数。"}}},]
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
            var goods_id = "";
            var validator = $("#IntegralGoodsModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {

                if (!validator.form()) {
                    return;
                }
                //加载提示
                $.loading.start();

                var goods = $("#IntegralGoodsModel").serializeJson();
                //$("#IntegralGoodsModel").submit();
            });

            $("#imagegroup_container").imagegroup({
                host: "{{ get_oss_host() }}",
                gallery: true,
                size: $("#imagegroup_container").data("size"),
                values: $('#integralgoodsmodel-goods_images').val().split("|"),
                mode: 0,
                // 回调函数
                callback: function(data) {
                    var values = this.values;
                    if (!values) {
                        values = [];
                    }
                    values = values.join("|");
                    $('#integralgoodsmodel-goods_images').val(values);
                    $.validator.clearError($("#integralgoodsmodel-goods_images"));
                },
                // 移除的回调函数
                remove: function(value, values) {
                    var values = this.values;
                    if (!values) {
                        values = [];
                    }
                    values = values.join("|");
                    $('#integralgoodsmodel-goods_images').val(values);
                }
            });

            if ($('input[name="IntegralGoodsModel[is_limit]"]:checked').val() == 0) {
                $("#exchange-div").hide();
                $("#start_date").val(0);
                $("#end_date").val(0);
            } else {
                $("#exchange-div").show();
            }

            $('input[name="IntegralGoodsModel[is_limit]"]').click(function() {
                if ($(this).val() == 0) {
                    $("#exchange-div").hide();
                    $("#start_date").val(0);
                    $("#end_date").val(0);

                } else {
                    $("#exchange-div").show();
                    $("#start_date").val("2019-01-26");
                    $("#end_date").val("2019-02-02");
                    $('#start_date').datetimepicker('update');
                    $('#end_date').datetimepicker('update');
                    $('#start_date').datetimepicker('setEndDate', $('#end_date').val());
                    $('#end_date').datetimepicker('setStartDate', $('#start_date').val());
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
        });

        function mobileDesc() {
            // 获取移动端详情
            var mobile_desc = [];
            $(".mobile-editor").find(".module").each(function() {
                if ($(this).find(".text-html").size() > 0) {
                    var content = $(this).find(".text-html").html();
                    if (content.length > 0) {
                        mobile_desc.push({
                            'content': content,
                            'type': 0
                        });
                    }
                } else if ($(this).find("img").size() > 0) {
                    var path = $(this).find("img").data("path");
                    if (path) {
                        mobile_desc.push({
                            'content': path,
                            'type': 1
                        });
                    }
                }
            });
            if (mobile_desc.length > 0) {
                mobile_desc = JSON.stringify(mobile_desc);
                $("#mobile_desc").val(mobile_desc);
            }
            return true;
        }
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
    </script>

    <script type="text/javascript">
        $('.form_datetime').datetimepicker({
            language: 'zh-CN',
            weekStart: 1,
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            minView: 2, // 只选年月日
            forceParse: 0,
            showMeridian: 1,
            format: 'yyyy-mm-dd',
        });
        $('#start_date').datetimepicker().on('changeDate', function(ev) {
            $('#end_date').datetimepicker('setStartDate', ev.date);
        });
        $('#end_date').datetimepicker().on('changeDate', function(ev) {
            $('#start_date').datetimepicker('setEndDate', ev.date);
        });
    </script>

    <script src="/assets/d2eace91/js/editor/kindeditor-all.min.js?v=20190121"></script>
    <script src="/assets/d2eace91/js/editor/lang/zh_CN.js?v=20190121"></script>
    <script type="text/javascript">
        // 获取商品详情
        KindEditor.ready(function(K) {
            var html = K.create("#pc_desc", {
                items: ['source', '|', 'fullscreen', 'undo', 'redo', 'print', 'cut', 'copy', 'paste', 'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright', 'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript', 'superscript', '|', 'selectall', 'clearhtml', 'quickformat', '|', 'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'flash', 'media', 'table', 'hr', 'emoticons', 'link', 'unlink', '|', 'about'],
                cssPath: "/assets/d2eace91/js/editor/themes/default/default.css",
                uploadJson: "/site/upload-image",
                resizeType: 1,
                width: '800px',
                height: '350px',
                filterMode: true,
                allowImageUpload: true,
                allowFlashUpload: false,
                allowMediaUpload: false,
                allowFileManager: true,
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
            }).html();
            $("#pc_desc").val(html);
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop