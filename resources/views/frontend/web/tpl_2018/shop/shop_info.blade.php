@extends('layouts.shop_apply_layout')

@section('content')

    <!--头部信息-->
    <div class="header-layout">
        <div class="header-conter">
            <h2 class="header_logo">
                <a href="/" class="logo">
                    <img src="{{ get_image_url(sysconf('mall_logo')) }}" />
                </a>
            </h2>
            <div class="header-extra">
                <div class="progress">
                    <div class="progress-wrap">
                        <div class="progress-item ongoing">
                            <div class="number">1</div>
                            <div class="progress-desc">开店申请</div>
                        </div>
                    </div>
                    <div class="progress-wrap">
                        <div class="progress-item  tobe ">
                            <div class="number">2</div>
                            <div class="progress-desc">网站审核</div>
                        </div>
                    </div>
                    <div class="progress-wrap">
                        <div class="progress-item  tobe ">
                            <div class="number">3</div>
                            <div class="progress-desc">支付开店款项</div>
                        </div>
                    </div>

                    <div class="progress-wrap">
                        <div class="progress-item  tobe ">
                            <div class="number">√</div>
                            <div class="progress-desc">创建店铺</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 内容 -->
    <link rel="stylesheet" href="/assets/d2eace91/js/chosen/chosen.css?v=20180428">
    <div class="content">
        <div class="operat-tips">
            <h4>
                <i></i>
                注意事项
            </h4>
            <ul class="operat-panel">
                <li>
                    <span>信息提交前，请务必先了解招商资质标准细则；</span>
                </li>
                <li>
                    <span>店铺分类选定后将不可更改，请慎重选择，如没有您需要的分类请联系网站客服。</span>
                </li>
            </ul>
        </div>

        <form id="ShopApplyModel" class="form-horizontal" name="ShopApplyModel" action="/shop/apply/shop-info.html" method="post" novalidate="novalidate">
            {{ csrf_field() }}
            <!--店铺信息认证-->
            <div class="item-box">
                <div class="title">
                    <span>请完善店铺信息</span>
                </div>
                <div class="item-body">
                    <!-- 店铺ID -->
                    <input type="hidden" id="shopapplymodel-shop_id" class="form-control" name="ShopApplyModel[shop_id]" value="{{ $shop_info->shop_id }}">

                    <!-- 站点 -->{{--todo 如果网站开启了多站点 才显示站点选择--}}
                    <div class="form-group form-group-spe" >
                        <label for="shopapplymodel-site_id" class="input-left">
                            <span class="spark">*</span>
                            <span>所属站点：</span>
                        </label>
                        <div class="form-control-box">


                            <span class="select">
                                <select id="shopapplymodel-site_id" class="form-control chosen-select" name="ShopApplyModel[site_id]">
                                <option value="">-- 请选择 --</option>
                                <option value="1">北京站</option>
                                <option value="2">开州区</option>
                                </select>
                            </span>


                        </div>

                        <div class="invalid"></div>
                    </div>


                    <!-- 店铺所属分类 -->
                    <div class="form-group form-group-spe">
                        <label for="" class="input-left">
                            <span class="spark">*</span>
                            <span>店铺所属分类：</span>
                        </label>
                        <div class="form-control-box">

                            <div class="choosen-select-box" style="width: 560px;">
                                <a id="btn_add_other_cat" class="btn btn-primary fl" style="margin: 2px;">添加</a>
                                <div class="choosen-select-item other-cat">
                                    <span class="select">

                                        <select id="cat_ids" class="form-control chosen-select" name="cat_ids[]" style="display: none;">
                                            <option value="">-- 请选择 --</option>
                                            @if($cat_list)
                                            @foreach($cat_list as $cat)

                                                <option value="{{ $cat['cls_id'] }}">{{ $cat['level_show'] }}{{ $cat['cls_name'] }}</option>

                                            @endforeach
                                            @endif
                                        </select>
                                    </span>
                                    <a class="choosen-select-delete other-cat-delete">×</a>
                                </div>



                            </div>
                            <input type="hidden" id="shopapplymodel-cat_id" class="form-control" name="ShopApplyModel[cat_id]" value="">


                        </div>

                        <div class="invalid"></div>
                    </div>
                    <!-- 开店时长 -->
                    <div class="form-group form-group-spe">
                        <label for="shopapplymodel-duration" class="input-left">
                            <span class="spark">*</span>
                            <span>开店时长：</span>
                        </label>
                        <div class="form-control-box">


                            <span class="select">
                                <select id="shopapplymodel-duration" class="form-control chosen-select" name="ShopApplyModel[duration]" style="display: none;">
                                <option value="">-- 请选择 --</option>
                                    @foreach($use_fee_value['number'] as $k=>$item)
                                        <option value="{{ $use_fee_value['number'][$k] }}-{{ $use_fee_value['unit'][$k] }}-{{ $use_fee_value['fee'][$k] }}">{{ $use_fee_value['number'][$k] }}{{ format_unit($use_fee_value['unit'][$k]) }}（平台使用费：{{ $use_fee_value['fee'][$k] }}）</option>
                                    @endforeach
                                </select>
                            </span>


                        </div>

                        <div class="invalid"></div>
                    </div>
                    <div class="form-group form-group-spe">
                        <label class="input-left">
                            <span class="spark"></span>
                            <span>平台保证金：</span>
                        </label>
                        <div class="form-control-box">
                            <span class="select">{{ sysconf('base_fee') }} 元</span>
                        </div>
                    </div>
                    <!-- 店铺名称  -->
                    <div class="form-group form-group-spe">
                        <label for="shopapplymodel-shop_name" class="input-left">
                            <span class="spark">*</span>
                            <span>店铺名称：</span>
                        </label>
                        <div class="form-control-box">


                            <input type="text" id="shopapplymodel-shop_name" class="form-control" name="ShopApplyModel[shop_name]" value="">


                        </div>

                        <div class="invalid"><span class="hint">开店成功后，可在店铺基本设置页面修改店铺名称</span></div>
                    </div>

                    <div class="mark">
                        <p>
                            待支付总费用：
                            <font class="amount" id="payment">0.00</font>
                            元
                        </p>
                        <p>请先提交至网站管理员进行人工审核，审核通过后，缴纳“待支付费用”，支付成功后即可成功开店</p>
                    </div>
                </div>
            </div>
            <div class="bottom">
                <a class="btn btn-primary" href="/shop/apply/auth-info?shop_type=2"> 上一步 </a>
                <input type="button" class="btn btn-primary" id="btn_submit" name="btn_submit" value="提交审核">
            </div>
        </form>
    </div>

    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/chosen/jquery.chosen.js?v=20180528"></script>
    <script id="other_cat_template" type='text'>
<div class="choosen-select-item other-cat">
	<span class="select">
<select id="cat_ids" class="form-control chosen-select" name="cat_ids[]">
    <option value="">-- 请选择 --</option>
    @if($cat_list)
    @foreach($cat_list as $cat)

        <option value="{{ $cat['cls_id'] }}">{{ $cat['level_show'] }}{{ $cat['cls_name'] }}</option>

    @endforeach
    @endif
</select>
</span>
	<a class="choosen-select-delete other-cat-delete">×</a>
</div>
</script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
[{"id": "shopapplymodel-cat_id", "name": "ShopApplyModel[cat_id]", "attribute": "cat_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"店铺所属分类必须是整数。"}}},{"id": "shopapplymodel-shop_name", "name": "ShopApplyModel[shop_name]", "attribute": "shop_name", "rules": {"required":true,"messages":{"required":"店铺名称不能为空。"}}},{"id": "shopapplymodel-duration", "name": "ShopApplyModel[duration]", "attribute": "duration", "rules": {"required":true,"messages":{"required":"开店时长不能为空。"}}},{"id": "shopapplymodel-cat_id", "name": "ShopApplyModel[cat_id]", "attribute": "cat_id", "rules": {"required":true,"messages":{"required":"店铺所属分类不能为空。"}}},{"id": "shopapplymodel-shop_name", "name": "ShopApplyModel[shop_name]", "attribute": "shop_name", "rules": {"string":true,"messages":{"string":"店铺名称必须是一条字符串。","maxlength":"店铺名称只能包含至多40个字符。"},"maxlength":40}},{"id": "shopapplymodel-shop_name", "name": "ShopApplyModel[shop_name]", "attribute": "shop_name", "rules": {"ajax":{"url":"/shop/apply/client-validate","model":"YXBwXG1vZHVsZXNcc2hvcFxtb2RlbHNcU2hvcEFwcGx5TW9kZWw=","attribute":"shop_name","params":["ShopApplyModel[shop_id]"],"scenario":"update"},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},]
</script>
    <script type="text/javascript">
        $().ready(function() {
            $('.chosen-select').chosen();
            var validator = $("#ShopApplyModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                $("#shopapplymodel-cat_id").val($("#cat_ids").val());
                if (!validator.form()) {
                    return;
                }
                $("#ShopApplyModel").submit();
            });

            // 开店时长改变事件
            $("#shopapplymodel-duration").change(function() {
                var payment = 0;
                if($(this).val() != "") {
                    var array = $(this).val().split("-");
                    payment = parseFloat(array[2]) + parseFloat(0.00);
                }
                $("#payment").text(payment.toFixed(2));
            });
            // 初始化开店时长
            $("#shopapplymodel-duration").change();

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
        });
    </script>

@endsection