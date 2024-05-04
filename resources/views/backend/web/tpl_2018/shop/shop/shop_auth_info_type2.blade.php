{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20180428"/>
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css?v=20180428"/>
    <!-- 日历控件-->
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css?v=20180428"/>

    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js?v=20180528"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=20180528"></script>
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30 clearfix">
        <form id="ShopFieldValueModel" class="form-horizontal" name="ShopFieldValueModel" action="/shop/shop/shop-auth-info?id={{ $info->shop_id }}&amp;shop_type={{ $info->shop_type }}&amp;is_supply={{ $info->is_supply }}" method="post" enctype="multipart/form-data">
            @csrf


            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopfieldvaluemodel-company_name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">公司名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




                            <input type="text" id="shopfieldvaluemodel-company_name" class="form-control" name="ShopFieldValueModel[company_name]" value="{{ $info->shopFieldValue->real_name }}">



                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>




            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopfieldvaluemodel-unified_social_credi" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">统一社会信用代码：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




                            <input type="text" id="shopfieldvaluemodel-unified_social_credi" class="form-control" name="ShopFieldValueModel[unified_social_credi]" value="{{ $info->shopFieldValue->unified_social_credi }}">



                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>




            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopfieldvaluemodel-artificial_person" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">法人代表姓名：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




                            <input type="text" id="shopfieldvaluemodel-artificial_person" class="form-control" name="ShopFieldValueModel[artificial_person]" value="{{ $info->shopFieldValue->artificial_person }}">



                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>




            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopfieldvaluemodel-card_no" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">身份证号码：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




                            <input type="text" id="shopfieldvaluemodel-card_no" class="form-control" name="ShopFieldValueModel[card_no]" value="{{ $info->shopFieldValue->card_no }}">



                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>




            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopfieldvaluemodel-license" class="col-sm-4 control-label">

                        <span class="ng-binding">企业法人营业执照：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">



                            <div class="form-control-box w400">
                                <div id="license_imagegroup_container" class="szy-imagegroup" data-id="shopfieldvaluemodel-license" data-size="1"></div>

                                <div class="example-image">
                                    <span>参考示例：</span>
                                    <ul class="image-group">
                                        <li>
                                            <a href="javascript:void(0);" class="highslide">
                                                <img src="{{ get_image_url(sysconf('company_demo_image')) }}" />
                                            </a>
                                            <img class="enlarge-image" src="{{ get_image_url(sysconf('company_demo_image')) }}" />
                                        </li>
                                    </ul>
                                </div>

                            </div>
                            <input type="hidden" id="shopfieldvaluemodel-license" class="form-control" name="ShopFieldValueModel[license]" value="{{ $info->shopFieldValue->license }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">图片请使用595*842像素jpg/gif/png格式的图片，并且图片大小不得超过2M。</div></div>
                    </div>
                </div>
            </div>




            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopfieldvaluemodel-special_aptitude" class="col-sm-4 control-label">

                        <span class="ng-binding">特殊行业资质：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">



                            <div class="form-control-box w400">
                                <div id="special_aptitude_imagegroup_container" class="szy-imagegroup" data-id="shopfieldvaluemodel-special_aptitude" data-size="3" ></div>

                            </div>
                            <input type="hidden" id="shopfieldvaluemodel-special_aptitude" class="form-control" name="ShopFieldValueModel[special_aptitude]" value="{{ $info->shopFieldValue->special_aptitude }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">图片请使用595*842像素jpg/gif/png格式的图片，并且图片大小不得超过2M。</div></div>
                    </div>
                </div>
            </div>








            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopfieldvaluemodel-card_type" class="col-sm-4 control-label">

                        <span class="ng-binding">身份证类型：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">



                            <select id="shopfieldvaluemodel-card_type" class="form-control" name="ShopFieldValueModel[card_type]">
                                <option value="formal
临时身份证">二代身份证</option>
                            </select>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>




            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopfieldvaluemodel-card_side_a" class="col-sm-4 control-label">

                        <span class="ng-binding">身份证正面：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">



                            <div class="form-control-box w400">
                                <div id="card_side_a_imagegroup_container" class="szy-imagegroup" data-id="shopfieldvaluemodel-card_side_a" data-size="1"></div>

                                <div class="example-image">
                                    <span>参考示例：</span>
                                    <ul class="image-group">
                                        <li>
                                            <a href="javascript:void(0);" class="highslide">
                                                <img src="{{ idcard_demo_image(0) }}" />
                                            </a>
                                            <img class="enlarge-image" src="{{ idcard_demo_image(0) }}" />
                                        </li>
                                    </ul>
                                </div>

                            </div>
                            <input type="hidden" id="shopfieldvaluemodel-card_side_a" class="form-control" name="ShopFieldValueModel[card_side_a]" value="{{ $info->shopFieldValue->card_side_a }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">图片请使用400*200像素jpg/gif/png格式的图片，并且图片大小不得超过2M。</div></div>
                    </div>
                </div>
            </div>




            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopfieldvaluemodel-card_side_b" class="col-sm-4 control-label">

                        <span class="ng-binding">身份证背面（国徽页）：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">



                            <div class="form-control-box w400">
                                <div id="card_side_b_imagegroup_container" class="szy-imagegroup" data-id="shopfieldvaluemodel-card_side_b" data-size="1"></div>

                                <div class="example-image">
                                    <span>参考示例：</span>
                                    <ul class="image-group">
                                        <li>
                                            <a href="javascript:void(0);" class="highslide">
                                                <img src="{{ idcard_demo_image(1) }}" />
                                            </a>
                                            <img class="enlarge-image" src="{{ idcard_demo_image(1) }}" />
                                        </li>
                                    </ul>
                                </div>

                            </div>
                            <input type="hidden" id="shopfieldvaluemodel-card_side_b" class="form-control" name="ShopFieldValueModel[card_side_b]" value="{{ $info->shopFieldValue->card_side_b }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">图片请使用400*200像素jpg/gif/png格式的图片，并且图片大小不得超过2M。</div></div>
                    </div>
                </div>
            </div>



            <!-- 新加start -->
            <div class="simple-form-field" style="display: none">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="ng-binding">其它证件信息：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <ul class="image-group">
                                <li class="image-group-button">
                                    <div class="image-group-bg"></div>
                                    <input type="file" class="inputstyle">
                                </li>
                                <li class="image-group-button">
                                    <div class="image-group-bg"></div>
                                    <input type="file" class="inputstyle">
                                </li>
                                <li class="image-group-button">
                                    <div class="image-group-bg"></div>
                                    <input type="file" class="inputstyle">
                                </li>
                            </ul>

                        </div>
                        <div class="help-block help-block-t">图片请使用595*842像素jpg/gif/png格式的图片，并且图片大小不得超过2M</div>
                    </div>
                </div>
            </div>

            <!-- 新加end -->

            <!-- 参考示例样式star -->
            <!-- <div class="simple-form-field">
              <div class="form-group">
                <label for="text4" class="col-sm-4 control-label"> <span class="ng-binding">手持身份证照片：</span> </label>
                <div class="col-sm-8">
                  <div class="form-control-box w400">
                    <ul class="image-group">
                      <li> <span class="image-group-remove">删除图片</span> <a href="" class="highslide" onclick="return hs.expand(this)"> <img src="/images/common/id-hand-s.jpg" /> </a> </li>
                    </ul>
                    <div class="example-image"><span>参考示例：</span>
                      <ul class="image-group">
                        <li> <a href="" class="highslide" onclick="return hs.expand(this)"> <img src="/images/common/id-hand-s.jpg" /> </a><img class="enlarge-image" src="/images/common/id-hand-s.jpg" /> </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="simple-form-field">
              <div class="form-group">
                <label for="text4" class="col-sm-4 control-label"> <span class="ng-binding">身份证正面：</span> </label>
                <div class="col-sm-8">
                  <div class="form-control-box w400">
                    <ul class="image-group">
                      <li> <span class="image-group-remove">删除图片</span> <a href="/images/common/id-front-s.jpg" class="highslide" onclick="return hs.expand(this)"> <img src="/images/common/id-front-s.jpg" /> </a> </li>
                    </ul>
                    <div class="example-image"> <span>参考示例：</span>
                      <ul class="image-group">
                        <li> <a href="/images/common/id-front-s.jpg" class="highslide" onclick="return hs.expand(this)"> <img src="/images/common/id-front-s.jpg" /> </a><img class="enlarge-image" src="/images/common/id-front-s.jpg" /> </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="simple-form-field">
              <div class="form-group">
                <label for="text4" class="col-sm-4 control-label"> <span class="ng-binding">身份证背面（国徽页）：</span> </label>
                <div class="col-sm-8">
                  <div class="form-control-box w400">
                    <ul class="image-group">
                      <li class="view-example-images"> <span class="image-group-remove">删除图片</span> <a href="" class="highslide" onclick="return hs.expand(this)"> <img src="/images/common/id-back-s.jpg" /> </a> </li>
                    </ul>
                    <div class="example-image"><span>参考示例：</span>
                      <ul class="image-group">
                        <li class="view-example-images"> <a href="" class="highslide" onclick="return hs.expand(this)"> <img src="/images/common/id-back-s.jpg" /> </a><img class="enlarge-image" src="/images/common/id-back-s.jpg" /> </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>-->
            <!-- 参考示例样式end -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="" class="col-sm-4 control-label">


                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <input type="button" class="btn btn-primary btn-lg" id="btn_submit" name="btn_submit" value="确认提交">

                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
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
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180528"></script>
    <!-- AJAX上传+图片预览 -->
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20180528"></script>

    <!-- 验证规则 -->
    <script id="client_rules" type="text">
[{"id": "shopfieldvaluemodel-company_name", "name": "ShopFieldValueModel[company_name]", "attribute": "company_name", "rules": {"required":true,"messages":{"required":"公司名称不能为空。"}}},{"id": "shopfieldvaluemodel-unified_social_credi", "name": "ShopFieldValueModel[unified_social_credi]", "attribute": "unified_social_credi", "rules": {"required":true,"messages":{"required":"统一社会信用代码不能为空。"}}},{"id": "shopfieldvaluemodel-artificial_person", "name": "ShopFieldValueModel[artificial_person]", "attribute": "artificial_person", "rules": {"required":true,"messages":{"required":"法人代表姓名不能为空。"}}},{"id": "shopfieldvaluemodel-card_no", "name": "ShopFieldValueModel[card_no]", "attribute": "card_no", "rules": {"required":true,"messages":{"required":"身份证号码不能为空。"}}},{"id": "shopfieldvaluemodel-license", "name": "ShopFieldValueModel[license]", "attribute": "license", "rules": {"string":true,"messages":{"string":"企业法人营业执照必须是一条字符串。"}}},{"id": "shopfieldvaluemodel-special_aptitude", "name": "ShopFieldValueModel[special_aptitude]", "attribute": "special_aptitude", "rules": {"string":true,"messages":{"string":"特殊行业资质必须是一条字符串。"}}},{"id": "shopfieldvaluemodel-special_aptitude1", "name": "ShopFieldValueModel[special_aptitude1]", "attribute": "special_aptitude1", "rules": {"string":true,"messages":{"string":"特殊行业资质1必须是一条字符串。"}}},{"id": "shopfieldvaluemodel-special_aptitude2", "name": "ShopFieldValueModel[special_aptitude2]", "attribute": "special_aptitude2", "rules": {"string":true,"messages":{"string":"特殊行业资质2必须是一条字符串。"}}},{"id": "shopfieldvaluemodel-card_type", "name": "ShopFieldValueModel[card_type]", "attribute": "card_type", "rules": {"string":true,"messages":{"string":"身份证类型必须是一条字符串。"}}},{"id": "shopfieldvaluemodel-card_side_a", "name": "ShopFieldValueModel[card_side_a]", "attribute": "card_side_a", "rules": {"string":true,"messages":{"string":"身份证正面必须是一条字符串。"}}},{"id": "shopfieldvaluemodel-card_side_b", "name": "ShopFieldValueModel[card_side_b]", "attribute": "card_side_b", "rules": {"string":true,"messages":{"string":"身份证背面（国徽页）必须是一条字符串。"}}},]
</script>
    <script type="text/javascript">
        $().ready(function() {
            var validator = $("#ShopFieldValueModel").validate();
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
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                //加载提示
                $.loading.start();
                $("#ShopFieldValueModel").submit();
            });
        });
    </script>
    <script type="text/javascript">
        $(".szy-imagegroup").each(function() {
            var id = $(this).data("id");
            var size = $(this).data("size");

            var target = $("#" + id);
            var value = $(target).val();

            $(this).imagegroup({
                host: "{{ get_oss_host() }}",
                size: size,
                values: value.split("|"),
                // 回调函数
                callback: function(data) {
                    var values = this.values;
                    if (!values) {
                        values = [];
                    }
                    values = values.join("|");
                    target.val(values);
                },
                // 移除的回调函数
                remove: function(value, values) {
                    var values = this.values;
                    if (!values) {
                        values = [];
                    }
                    values = values.join("|");
                    target.val(values);
                }
            });
        });
    </script>
    <a class="scroll-to-top"><i class="fa fa-chevron-up"></i></a>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop
