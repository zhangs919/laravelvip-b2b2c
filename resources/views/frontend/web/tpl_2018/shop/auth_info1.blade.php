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
                    <span>以下所需上传电子版资质仅支持jpg、gif、png格式的图片，大小不超过2M。</span>
                </li>
            </ul>
        </div>

        <form id="ShopFieldValueModel" class="form-horizontal" name="ShopFieldValueModel" action="/shop/apply/auth-info.html?is_supply={{ $is_supply }}&amp;shop_type={{ $shop_type }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <!--个人信息认证-->
            <div class="item-box">
                <div class="title">
                    <span>请按照提示填写本人真实的资料</span>
                </div>

                <div class="item-body">



                    <div class="form-group form-group-spe" >
                        <label for="shopfieldvaluemodel-real_name" class="input-left">
                            <span class="spark">*</span>
                            <span>真实姓名：</span>
                        </label>
                        <div class="form-control-box">



                            <input type="text" id="shopfieldvaluemodel-real_name" class="form-control" name="ShopFieldValueModel[real_name]">


                        </div>

                        <div class="invalid"></div>
                    </div>





                    <div class="form-group form-group-spe" >
                        <label for="shopfieldvaluemodel-card_no" class="input-left">
                            <span class="spark">*</span>
                            <span>身份证号码：</span>
                        </label>
                        <div class="form-control-box">



                            <input type="text" id="shopfieldvaluemodel-card_no" class="form-control" name="ShopFieldValueModel[card_no]">


                        </div>

                        <div class="invalid"></div>
                    </div>






                    <div class="item-box item-box-spe">
                        <div class="title">
                            <span>企业执照</span>
                        </div>
                        <div class="form-group form-group-spe pic-box">
                            <label class="input-left">
                                <span>特殊行业资质：</span>
                            </label>
                            <div class="form-control-box">
                                <!--当已经上传了，为image-uploader添加full样式-->
                                <div id="img_special_aptitude" class="image-uploader">
                                    <!--当没有上传的情况下，显示-->
                                    <div class="fild-box" >
                                        <i></i>
                                        <span class="fild-text">点击此处选择上传</span>
                                        <input class="fild-hidden" type="file" value="点击上传" id="shopfieldvaluemodel-special_aptitude" name="ShopFieldValueModel[special_aptitude]" />
                                    </div>
                                    <!--当点击上传时，显示的缓载效果-->
                                    <div class="loading-wrap" style="display: none">
                                        <img src="/frontend/images/apply/apply-loading.gif">
                                    </div>
                                    <!--当已经上传情况下，显示-->
                                    <div class="image-wrap">
                                        <a class="close" href="javascript:void(0);" style="display: none">×</a>
                                        <img >
                                        <input type="hidden" name="check-special_aptitude" id="check-special_aptitude"  />
                                    </div>
                                </div>
                                <div id="img_special_aptitude1" class="image-uploader">
                                    <!--当没有上传的情况下，显示-->
                                    <div class="fild-box" >
                                        <i></i>
                                        <span class="fild-text">点击此处选择上传</span>
                                        <input class="fild-hidden" type="file" value="点击上传" id="shopfieldvaluemodel-special_aptitude1" name="ShopFieldValueModel[special_aptitude1]" />
                                    </div>
                                    <!--当点击上传时，显示的缓载效果-->
                                    <div class="loading-wrap" style="display: none">
                                        <img src="/frontend/images/apply/apply-loading.gif">
                                    </div>
                                    <!--当已经上传情况下，显示-->
                                    <div class="image-wrap">
                                        <a class="close" href="javascript:void(0);" style="display: none">×</a>
                                        <img >
                                        <input type="hidden" name="check-special_aptitude1" id="check-special_aptitude1"  />
                                    </div>
                                </div>
                                <div id="img_special_aptitude2" class="image-uploader">
                                    <!--当没有上传的情况下，显示-->
                                    <div class="fild-box" >
                                        <i></i>
                                        <span class="fild-text">点击此处选择上传</span>
                                        <input class="fild-hidden" type="file" value="点击上传" id="shopfieldvaluemodel-special_aptitude2" name="ShopFieldValueModel[special_aptitude2]" />
                                    </div>
                                    <!--当点击上传时，显示的缓载效果-->
                                    <div class="loading-wrap" style="display: none">
                                        <img src="/frontend/images/apply/apply-loading.gif">
                                    </div>
                                    <!--当已经上传情况下，显示-->
                                    <div class="image-wrap">
                                        <a class="close" href="javascript:void(0);" style="display: none">×</a>
                                        <img >
                                        <input type="hidden" name="check-special_aptitude2" id="check-special_aptitude2"  />
                                    </div>
                                </div>
                            </div>
                            <div class="invalid">
                                <span class="hint">可上传食品流通许可证、食品生产许可证、图书发行资质、药品经营资质等特殊行业资质； 图片请使用595*842像素jpg/gif/png格式的图片，并且图片大小不得超过2M</span>
                            </div>
                        </div>
                    </div>



                    <div class="item-box item-box-none">
                        <div class="title">
                            <span>身份证件</span>
                        </div>
                        <div class="form-group form-group-spe pic-box">
                            <label class="input-left">
                                <span class="spark"></span>
                                <span>手持身份证照片：</span>
                            </label>
                            <div class="form-control-box">
                                <!--当已经上传了，为image-uploader添加full样式-->
                                <div id="img_hand_card" class="image-uploader">
                                    <!--当没有上传的情况下，显示-->
                                    <div class="fild-box" >
                                        <i></i>
                                        <span class="fild-text">点击此处选择上传</span>
                                        <input class="fild-hidden" type="file" value="点击上传" id="shopfieldvaluemodel-hand_card" name="ShopFieldValueModel[hand_card]" />
                                    </div>
                                    <!--当点击上传时，显示的缓载效果-->
                                    <div class="loading-wrap" style="display: none">
                                        <img src="/frontend/images/apply/apply-loading.gif">
                                    </div>
                                    <!--当已经上传情况下，显示-->
                                    <div class="image-wrap">
                                        <a class="close" href="javascript:void(0);" style="display: none">×</a>
                                        <img >
                                        <input type="hidden" name="check-hand_card" id="check-hand_card"  />
                                    </div>
                                </div>

                                <div class="examples">
                                    <label class="input-left">
                                        <span>示例：</span>
                                    </label>
                                    <div class="form-control-box">
                                        <img src="{{ idcard_demo_image(2) }}">
                                        <img class="enlarge-image" src="{{ idcard_demo_image(2) }}" />
                                    </div>
                                </div>

                            </div>
                            <div class="invalid">
                                <span class="hint">图片建议使用4：3比例，尺寸建议为1200*900像素jpg、gif、png格式的图片，并且图片大小不可超过2M。</span>
                            </div>
                        </div>







                        <div class="form-group form-group-spe pic-box">
                            <label class="input-left">
                                <span class="spark"></span>
                                <span>身份证正面：</span>
                            </label>
                            <div class="form-control-box">
                                <!--当已经上传了，为image-uploader添加full样式-->
                                <div id="img_card_side_a" class="image-uploader">
                                    <!--当没有上传的情况下，显示-->
                                    <div class="fild-box" >
                                        <i></i>
                                        <span class="fild-text">点击此处选择上传</span>
                                        <input class="fild-hidden" type="file" value="点击上传" id="shopfieldvaluemodel-card_side_a" name="ShopFieldValueModel[card_side_a]" />
                                    </div>
                                    <!--当点击上传时，显示的缓载效果-->
                                    <div class="loading-wrap" style="display: none">
                                        <img src="/frontend/images/apply/apply-loading.gif">
                                    </div>
                                    <!--当已经上传情况下，显示-->
                                    <div class="image-wrap">
                                        <a class="close" href="javascript:void(0);"  style="display: none">×</a>
                                        <img >
                                        <input type="hidden" name="check-card_side_a" id="check-card_side_a"  />
                                    </div>
                                </div>

                                <div class="examples">
                                    <label class="input-left">
                                        <span>示例：</span>
                                    </label>
                                    <div class="form-control-box">
                                        <img src="{{ idcard_demo_image(0) }}">
                                        <img class="enlarge-image" src="{{ idcard_demo_image(0) }}" />
                                    </div>
                                </div>

                            </div>
                            <div class="invalid">
                                <span class="hint">图片建议使用4：3比例，尺寸建议为1200*900像素jpg、gif、png格式的图片，并且图片大小不可超过2M。</span>
                            </div>
                        </div>








                        <div class="form-group form-group-spe pic-box">
                            <label class="input-left">
                                <span class="spark"></span>
                                <span>身份证背面（国徽页）：</span>
                            </label>
                            <div class="form-control-box">
                                <!--当已经上传了，为image-uploader添加full样式-->
                                <div id="img_card_side_b" class="image-uploader">
                                    <!--当没有上传的情况下，显示-->
                                    <div class="fild-box" >
                                        <i></i>
                                        <span class="fild-text">点击此处选择上传</span>
                                        <input class="fild-hidden" type="file" value="点击上传" id="shopfieldvaluemodel-card_side_b" name="ShopFieldValueModel[card_side_b]" />
                                    </div>
                                    <!--当点击上传时，显示的缓载效果-->
                                    <div class="loading-wrap" style="display: none">
                                        <img src="/frontend/images/apply/apply-loading.gif">
                                    </div>
                                    <!--当已经上传情况下，显示-->
                                    <div class="image-wrap">
                                        <a class="close" href="javascript:void(0);"  style="display: none">×</a>
                                        <img >
                                        <input type="hidden" name="check-card_side_b" id="check-card_side_b"  />
                                    </div>
                                </div>

                                <div class="examples">
                                    <label class="input-left">
                                        <span>示例：</span>
                                    </label>
                                    <div class="form-control-box">
                                        <img src="{{ idcard_demo_image(1) }}">
                                        <img class="enlarge-image" src="{{ idcard_demo_image(1) }}" />
                                    </div>
                                </div>

                            </div>
                            <div class="invalid">
                                <span class="hint">图片建议使用4：3比例，尺寸建议为1200*900像素jpg、gif、png格式的图片，并且图片大小不可超过2M。</span>
                            </div>
                        </div>
                    </div>






                    <div class="form-group form-group-spe" >
                        <label for="shopfieldvaluemodel-address" class="input-left">
                            <span class="spark">*</span>
                            <span>联系地址：</span>
                        </label>
                        <div class="form-control-box">



                            <input type="text" id="shopfieldvaluemodel-address" class="form-control" name="ShopFieldValueModel[address]">


                        </div>

                        <div class="invalid"></div>
                    </div>



                </div>
            </div>



            <div class="item-body">
                <div class="mark">
                    <p>您提供的身份信息，网站将予以保护，不会挪作他用</p>
                </div>
            </div>
            <div class="bottom">
                <div class="form-group form-group-spe" >
                    <label for="" class="input-left">


                    </label>
                    <div class="form-control-box">

                        <a class="btn btn-primary" href="/shop/apply/agreement-type1.html"> 上一步 </a>
                        <input type="button" class="btn btn-primary" id="btn_submit" name="btn_submit" value="下一步">

                    </div>

                    <div class="invalid"></div>
                </div>
            </div>
        </form>

    </div>
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180428"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180428"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180428"></script>
    <!-- AJAX上传+图片预览 -->
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=20180428"></script>
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=20180428"></script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
[{"id": "shopfieldvaluemodel-real_name", "name": "ShopFieldValueModel[real_name]", "attribute": "real_name", "rules": {"required":true,"messages":{"required":"真实姓名不能为空。"}}},{"id": "shopfieldvaluemodel-card_no", "name": "ShopFieldValueModel[card_no]", "attribute": "card_no", "rules": {"required":true,"messages":{"required":"身份证号码不能为空。"}}},{"id": "shopfieldvaluemodel-special_aptitude", "name": "ShopFieldValueModel[special_aptitude]", "attribute": "special_aptitude", "rules": {"string":true,"messages":{"string":"特殊行业资质必须是一条字符串。"}}},{"id": "shopfieldvaluemodel-special_aptitude1", "name": "ShopFieldValueModel[special_aptitude1]", "attribute": "special_aptitude1", "rules": {"string":true,"messages":{"string":"特殊行业资质1必须是一条字符串。"}}},{"id": "shopfieldvaluemodel-special_aptitude2", "name": "ShopFieldValueModel[special_aptitude2]", "attribute": "special_aptitude2", "rules": {"string":true,"messages":{"string":"特殊行业资质2必须是一条字符串。"}}},{"id": "shopfieldvaluemodel-hand_card", "name": "ShopFieldValueModel[hand_card]", "attribute": "hand_card", "rules": {"string":true,"messages":{"string":"手持身份证照片必须是一条字符串。"}}},{"id": "shopfieldvaluemodel-card_side_a", "name": "ShopFieldValueModel[card_side_a]", "attribute": "card_side_a", "rules": {"string":true,"messages":{"string":"身份证正面必须是一条字符串。"}}},{"id": "shopfieldvaluemodel-card_side_b", "name": "ShopFieldValueModel[card_side_b]", "attribute": "card_side_b", "rules": {"string":true,"messages":{"string":"身份证背面（国徽页）必须是一条字符串。"}}},{"id": "shopfieldvaluemodel-address", "name": "ShopFieldValueModel[address]", "attribute": "address", "rules": {"required":true,"messages":{"required":"联系地址不能为空。"}}},]
</script>
    <script id="client_rules1" type="text">
[
		{
			"id": "shopfieldvaluemodel-card_no",
			"name": "ShopFieldValueModel[card_no]",
			"attribute": "card_no",
			"rules": {
				"string":true,
				"messages":{
					"string":"身份证号码必须是一条字符串。",
					"maxlength":"身份证号码只能包含至多18个字符。"
				},
				"maxlength":18
			}
		},
		{
			"id": "shopfieldvaluemodel-card_no",
			"name": "ShopFieldValueModel[card_no]",
			"attribute": "card_no",
			"rules": {
				"match":{

					"pattern":/^[0-9]{14}[X|x]$|[0-9]{17}[X|x]$|[0-9]{18}$/,

					"not":false,
					"skipOnEmpty":1
				},
				"messages":{
					"match": "身份证号码是无效的。"
				}
			}
		},
		{
			"id": "check-hand_card",
			"name": "check-hand_card",
			"attribute": "hand_card",
			"rules": {
				"required": true,
				"messages": {
					"required": "手持身份证照片不能为空。"
				}
			}
		},
		{
			"id": "check-card_side_a",
			"name": "check-card_side_a",
			"attribute": "card_side_a",
			"rules": {
				"required": true,
				"messages": {
					"required": "身份证正面不能为空。"
				}
			}
		},
		{
			"id": "check-card_side_b",
			"name": "check-card_side_b",
			"attribute": "card_side_b",
			"rules": {
				"required": true,
				"messages": {
					"required": "身份证背面（国徽页）不能为空。"
				}
			}
		},
		{
			"id": "shopfieldvaluemodel-hand_card",
			"name": "ShopFieldValueModel[hand_card]",
			"attribute": "hand_card",
			"rules": {
				"required": true,
				"messages": {
					"required": "手持身份证照片不能为空。"
				}
			}
		},
		{
			"id": "shopfieldvaluemodel-card_side_a",
			"name": "ShopFieldValueModel[card_side_a]",
			"attribute": "card_side_a",
			"rules": {
				"required": true,
				"messages": {
					"required": "身份证正面不能为空。"
				}
			}
		},
		{
			"id": "shopfieldvaluemodel-card_side_b",
			"name": "ShopFieldValueModel[card_side_b]",
			"attribute": "card_side_b",
			"rules": {
				"required": true,
				"messages": {
					"required": "身份证背面（国徽页）不能为空。"
				}
			}
		}
]
</script>
    <script type="text/javascript">
        $().ready(function() {
            var validator = $("#ShopFieldValueModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $.validator.addRules($("#client_rules1").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                $("#ShopFieldValueModel").submit();
            });

            $("#shopfieldvaluemodel-hand_card").uploadPreview({
                Img: "img_hand_card",
                Width: 100,
                Height: 100
            });
            $("#shopfieldvaluemodel-card_side_a").uploadPreview({
                Img: "img_card_side_a",
                Width: 100,
                Height: 100
            });
            $("#shopfieldvaluemodel-card_side_b").uploadPreview({
                Img: "img_card_side_b",
                Width: 100,
                Height: 100
            });
            $("#shopfieldvaluemodel-special_aptitude").uploadPreview({
                Img: "img_special_aptitude",
                Width: 200,
                Height: 120
            });
            $("#shopfieldvaluemodel-special_aptitude1").uploadPreview({
                Img: "img_special_aptitude1",
                Width: 200,
                Height: 120
            });
            $("#shopfieldvaluemodel-special_aptitude2").uploadPreview({
                Img: "img_special_aptitude2",
                Width: 200,
                Height: 120
            });
        });
    </script>

@endsection