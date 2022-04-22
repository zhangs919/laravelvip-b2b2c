@extends('layouts.user_layout')

{{--header_js--}}
@section('header_js')

@stop

@section('content')

    <!-- 正文，由view提供 -->
    <div class="con-right fr"><script src="/assets/d2eace91/js/datetime/dateselector.js?v=20180528"></script>
        <div class="con-right-text">
            <div class="tabmenu">
                <div class="user-status">
			<span class="active" id="profile1" onclick="setTab('profile',1,3)">
				<a href="javascript:void(0);" target="_self">
					<span>基本信息</span>
					<span class="vertical-line">|</span>
				</a>
			</span>
                    <span class="" id="profile2" onclick="setTab('profile',2,3)">
				<a href="javascript:void(0);" target="_self">
					<span>实名认证</span>
					<span class="vertical-line">|</span>
				</a>
			</span>
                    <span class="" id="profile3" onclick="setTab('profile',3,3)">
				<a href="javascript:void(0);" target="_self">
					<span>头像信息</span>
				</a>
			</span>
                </div>
            </div>
            <div class="content-info">
                <div id="con_profile_1">
                    <form id="UserModel" class="form-horizontal" name="UserModel" action="/user/profile/edit-base" method="post">
                        {{ csrf_field() }}
                        <div class="form-group form-group-spe">
                            <label class="input-left">
                                <span>当前头像：</span>
                            </label>
                            <div class="profile-avatar">
                                <img id="headimg" src="{{ get_image_url($user_info->headimg, 'headimg') }}" width="120" height="120" />
                            </div>
                        </div>
                        <div class="form-group form-group-spe">
                            <label class="input-left">
                                <span>会员名称：</span>
                            </label>
                            <span class="input-none">{{ $user_info->user_name }}</span>
                        </div>

                        <!-- 会员昵称 -->
                        <div class="form-group form-group-spe" >
                            <label for="usermodel-nickname" class="input-left">
                                <span class="spark">*</span>
                                <span>昵称：</span>
                            </label>
                            <div class="form-control-box">


                                <input type="text" id="usermodel-nickname" class="form-control" name="UserModel[nickname]" value="{{ $user_info->nickname ?? '' }}">


                            </div>

                            <div class="invalid"><span class="hint">与平台业务或者店铺名称冲突的昵称，平台将有可能收回</span></div>
                        </div>
                        <div class="form-group form-group-spe">
                            <label class="input-left">
                                <span>会员等级：</span>
                            </label>
                            <span class="input-none">
                                {{ $user_rank_info['rank_name'] }}
                                <span>
                                    我的成长值：

                                    <font class="second-color">
                                        <a href="/user/growth-value.html">{{ $user_info->rank_point ?? 0 }}</a>
                                    </font>
                                </span>

                                <span>
                                    再积累
                                    <font class="second-color">{{ $user_rank_info['less_exppoints'] }}</font>
                                    成长值即可升级至{{ $user_rank_info['downrank_name'] }}
                                </span>

                            </span>
                        </div>

                        <!-- 性别 -->
                        <div class="form-group form-group-spe" >
                            <label for="usermodel-sex" class="input-left">

                                <span>性别：</span>
                            </label>
                            <div class="form-control-box">


                                <input type="hidden" name="UserModel[sex]" value="0">
                                <div id="usermodel-sex" class="" name="UserModel[sex]">
                                    <label class="control-label cur-p m-r-10">
                                        <input type="radio" name="UserModel[sex]" value="0" @if($user_info->sex == 0) checked @endif> 保密</label>
                                    <label class="control-label cur-p m-r-10">
                                        <input type="radio" name="UserModel[sex]" value="1" @if($user_info->sex == 1) checked @endif> 男</label>
                                    <label class="control-label cur-p m-r-10">
                                        <input type="radio" name="UserModel[sex]" value="2" @if($user_info->sex == 2) checked @endif> 女</label>
                                </div>


                            </div>

                            <div class="invalid"></div>
                        </div>

                        <div class="form-group form-group-spe">
                            <label class="input-left">
                                <span>生日：</span>
                            </label>
                            <div class="form-control-box">
                                <span class="select">
                                    <select id="sel_year" class="form-control"></select>
                                    年
                                    <select id="sel_month" class="form-control"></select>
                                    月
                                    <select id="sel_day" class="form-control"></select>
                                    日
                                </span>
                            </div>
                            <input type="hidden" id="birthday" class="form-control" name="UserModel[birthday]" value="{{ strtotime($user_info->birthday) }}">
                        </div>

                        <div class="form-group form-group-spe">
                            <label class="input-left">
                                <span>现居住地：</span>
                            </label>
                            <input type="hidden" id="address_code" name="address_code" value="{{ $user_info->address_code ?? '' }}">
                            <div class="form-control-box">
                                <span id="address_now" class="select">
                                    <!--<span class="select">
                                    <select id="pro" onchange="AjaxRegion('/user/profile/ajax-region','city',this.value)">
                                        <option value="0">省/直辖市</option>

                                    </select>
                                    <select id="city" onchange="AjaxRegion('/user/profile/ajax-region','area',this.value)">
                                        <option>市</option>
                                    </select>
                                    <select id="area" name="address_now">
                                        <option>区/县</option>
                                    </select>
                                </span>-->
                                </span>
                            </div>
                        </div>

                        <!-- 详细地址 -->
                        <div class="form-group form-group-spe" >
                            <label for="usermodel-detail_address" class="input-left">

                                <span>详细地址：</span>
                            </label>
                            <div class="form-control-box">


                                <textarea id="usermodel-detail_address" class="form-control" name="UserModel[detail_address]" rows="5" placeholder="建议您如实填写详细收货地址，例如街道名称，门牌号码，楼层和房间号等信息">{!! $user_info->detail_address !!}</textarea>


                            </div>

                            <div class="invalid"></div>
                        </div>

                        <div class="act">
                            <input type="submit" value="保存" id="btn_submit">
                        </div>
                    </form>
                    <div class="operat-tips">
                        <h4>个人资料注意事项</h4>
                        <ul class="operat-panel">
                            <!-- <li>
                                <span>完善个人基本信息可获得点积分奖励，赶快完善信息赢积分吧！</span>
                            </li> -->
                            <li>
                                <span>成长值：是会员通过购物所获得的经验值，由累计购物金额计算获得，成长值获得根据确认收货时间计算，成长值小数点后部分不计入积分：例如会员的订单是88.2元，消费金额与赠送成长值比例是10%，则确认收货后并无退款退货，即可得到8点成长值</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="con_profile_2" style="display: none">



                    <form id="UserRealModel" class="form-horizontal" name="UserRealModel" action="/user/profile/edit-real" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <!-- 真实姓名 -->
                        <div class="form-group form-group-spe" >
                            <label for="userrealmodel-real_name" class="input-left">
                                <span class="spark">*</span>
                                <span>真实姓名：</span>
                            </label>
                            <div class="form-control-box">


                                <input type="text" id="userrealmodel-real_name" class="form-control" name="UserRealModel[real_name]" value="{{ $user_real->real_name ?? '' }}">


                            </div>

                            <div class="invalid"></div>
                        </div>


                        <div class="form-group form-group-spe" >
                            <label for="userrealmodel-id_code" class="input-left">
                                <span class="spark">*</span>
                                <span>身份证号码：</span>
                            </label>
                            <div class="form-control-box">


                                <input type="text" id="userrealmodel-id_code" class="form-control" name="UserRealModel[id_code]" value="{{ $user_real->id_code ?? '' }}">


                            </div>

                            <div class="invalid"><span class="hint">身份证号码位数为15位或18位</span></div>
                        </div>


                        <div class="form-group form-group-spe" >
                            <label for="userrealmodel-card_pic1" class="input-left">
                                <span class="spark">*</span>
                                <span>身份证正面照：</span>
                            </label>
                            <div class="form-control-box">

                                <!-- 图片组 start -->
                                <div id="card_pic1_imagegroup_container" class="szy-imagegroup" data-id="userrealmodel-card_pic1" data-size="1"></div>

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

                                <input type="hidden" id="userrealmodel-card_pic1" class="form-control" name="UserRealModel[card_pic1]" value="{{ $user_real->card_pic1 ?? '' }}">
                                <!-- 图片组 end -->

                            </div>

                            <div class="invalid"><span class="hint">图片请使用400*200像素jpg/gif/png格式的图片，并且图片大小不可超过2M。</span></div>
                        </div>

                        <div class="form-group form-group-spe" >
                            <label for="userrealmodel-card_pic2" class="input-left">
                                <span class="spark">*</span>
                                <span>身份证背面照：</span>
                            </label>
                            <div class="form-control-box">

                                <!-- 图片组 start -->
                                <div id="card_pic2_imagegroup_container" class="szy-imagegroup" data-id="userrealmodel-card_pic2" data-size="1"></div>

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

                                <input type="hidden" id="userrealmodel-card_pic2" class="form-control" name="UserRealModel[card_pic2]" value="{{ $user_real->card_pic2 ?? '' }}">
                                <!-- 图片组 end -->

                            </div>

                            <div class="invalid"><span class="hint">图片请使用400*200像素jpg/gif/png格式的图片，并且图片大小不可超过2M。</span></div>
                        </div>

                        <div class="form-group form-group-spe" >
                            <label for="userrealmodel-card_pic3" class="input-left">
                                <span class="spark">*</span>
                                <span>本人手持身份证正面照：</span>
                            </label>
                            <div class="form-control-box">

                                <!-- 图片组 start -->
                                <div id="card_pic3_imagegroup_container" class="szy-imagegroup" data-id="userrealmodel-card_pic3" data-size="1"></div>

                                <div class="example-image">
                                    <span>参考示例：</span>
                                    <ul class="image-group">
                                        <li>
                                            <a href="javascript:void(0);" class="highslide">
                                                <img src="{{ idcard_demo_image(2) }}" />
                                            </a>
                                            <img class="enlarge-image" src="{{ idcard_demo_image(2) }}" />
                                        </li>
                                    </ul>
                                </div>

                                <input type="hidden" id="userrealmodel-card_pic3" class="form-control" name="UserRealModel[card_pic3]" value="{{ $user_real->card_pic3 ?? '' }}">
                                <!-- 图片组 end -->

                            </div>

                            <div class="invalid"><span class="hint">图片请使用400*200像素jpg/gif/png格式的图片，并且图片大小不可超过2M。</span></div>
                        </div>


                        <div class="act">
                            <input type="submit" value="保存" id="btn_submit_real">
                        </div>
                    </form>

                    <div class="operat-tips">
                        <h4>为什么要进行实名认证?</h4>
                        <ul class="operat-panel">
                            <!-- <li>
                                <span>实名认证后您可获得平台方送出的点积分奖励，赶快实名认证赢积分吧！</span>
                            </li> -->
                            <li>
                                <span>实名认证需要网站方管理员人工审核，审核通过后即认证成功。</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="con_profile_3" style="display: none">
                    <!--<form id="Img_Load" action="/user/profile/up-load" enctype="multipart/form-data" method="post">  -->
                    <div class="update-face-cont">
                        <div class="update-left">
                            <div class="update-btn">
                                <link rel="stylesheet" href="/css/style.css?v=20180428"/>
                                <div class="btn">
                                    <a href="javascript:void(0);" class="upload-img">
                                        <label for="upload-file">选择您要上传的头像</label>
                                    </a>
                                    <input accept=".JPG,.GIF,.PNG,.JPEG,.BMP" type="file" value="本地上传" class="file-botton" name="upload-file" id="upload-file" />
                                </div>
                                <p class="explain">仅支持JPG、GIF、PNG、JPEG、BMP格式，文件小于2MB</p>
                            </div>
                            <div class="img-cont">
                                <div id="context_img" class="img-b">
                                    <div class="thumbBox">

                                        <img id="default_img" style="width: 100%; height: 100%;" src="{{ get_image_url($user_info->headimg,'headimg') }}" />

                                    </div>
                                </div>
                                <p class="submit" style="display: none">
                                    <input type="button" id="btnCrop" class="btn submit" value="裁切">
                                    <input type="button" id="btnZoomIn" class="btn submit" value="+">
                                    <input type="button" id="btnZoomOut" class="btn submit" value="-">
                                    <input type="hidden" value="" id="load_img" name="load_img">
                                    <input id="upload" class="btn submit" value="保存" type="button" />
                                </p>
                            </div>
                        </div>
                        <div class="update-right">
                            <div class="smt">
                                <h3>效果预览</h3>
                            </div>
                            <div class="smc">
                                你上传的图片会自动生成2种尺寸，请注意小尺寸的头像是否清晰
                                <div class="img-cont img-m-cont">
                                    <img id="img1" src="{{ get_image_url($user_info->headimg,'headimg') }}" />
                                </div>
                                120*120像素
                                <div class="/img-cont img-s-cont">
                                    <img id="img5" src="{{ get_image_url($user_info->headimg,'headimg') }}" />
                                </div>
                                50*50像素
                            </div>
                        </div>
                    </div>
                    <!--</form>  -->
                </div>
            </div>
        </div>
        <script src="/js/cropbox.js?v=20180528"></script>
        <script src="/assets/d2eace91/js/jquery.region.js?v=20180528"></script>
        <script type="text/javascript">
            $(window).load(function() {
                var options = {
                    thumbBox: '.thumbBox',
                    imgSrc: ""
                }
                var cropper = $('.img-b').cropbox(options);
                $('#upload-file').on('change', function() {
                    $(".thumbBox").css("background-image","url('')");
                    var f = document.getElementById("upload-file").files;
                    if (f[0].size < "2097152") {
                        $("#default_img").remove();
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            options.imgSrc = e.target.result;
                            cropper = $('.img-b').cropbox(options);
                            $(".img-b .thumbBox").css("border", "1px solid rgb(102, 102, 102)");
                            $(".img-b .thumbBox").css("box-shadow", "0 0 0 1000px rgba(0, 0, 0, 0.5)");
                        }
                        reader.readAsDataURL(this.files[0]);
                        $(".submit").show();
                    } else {
                        $.msg("上传图片过大");
                    }
                })
                $('#btnZoomIn').on('click', function() {
                    $(".thumbBox").css("background-image","url('')");
                    cropper.zoomIn();
                })
                $("#upload").on("click", function() {
                    if ($("#load_img").val() == "") {
                        $.msg("请先对头像进行裁剪");
                    } else {
                        var img = $("#load_img").val()
                        $.post('/user/profile/up-load', {
                            "load_img": img
                        }, function(result) {
                            $("#headimg").attr("src", result.url);
                            $("#load_img").val("");
                            $.msg(result.message);
                        },"json");
                    }
                })
                $('#btnCrop').on('click', function() {
                    var img = cropper.getDataURL();
                    $('.cropped').html('');
                    $("#load_img").val(img);
                    $(".thumbBox").css("background-image","url("+img+")");
                    $("#context_img").css("background-image","url('')");
                    $('#img1').attr("src", img);
                    $('#img5').attr("src", img);
                    $("#upload").show();
                })
                $('#btnZoomOut').on('click', function() {
                    $(".thumbBox").css("background-image","url('')");
                    cropper.zoomOut();
                })
            });
        </script>
        <script type='text/javascript'>
            $("#address_now").regionselector({
                value: '{{ $user_info->address_code ?? "" }}',
                select_class: "select",
                change: function(value, names, is_last) {
                    $("#address_code").val(value);
                }
            });
        </script>
        <script>
            $(function() {
                $.dateselector({
                    defaulttime: "{{ $user_info->birthday->format('Y-m-d') }}",
                    sel_unix: "#birthday"
                });
            });
        </script>

        <!-- 图片预览 -->
        <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=20180528"></script>
        <script src="/assets/d2eace91/js/pic/imgPreview.js?v=20180528"></script>
        <script src="/assets/d2eace91/js/jquery.widget.js?v=20180528"></script>
        <!-- 表单验证 -->
        <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180528"></script>
        <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180528"></script>
        <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180528"></script>
        <script type="text/javascript">
            $(".szy-imagegroup").each(function() {
                var id = $(this).data("id");
                var size = $(this).data("size");

                var target = $("#" + id);
                var value = $(target).val() ? $(target).val() : "";

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
        <script type="text/javascript">
            $().ready(function() {
                var validator = $("#UserModel").validate();
                // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
                $.validator.addRules([{"id": "usermodel-nickname", "name": "UserModel[nickname]", "attribute": "nickname", "rules": {"required":true,"messages":{"required":"昵称不能为空。"}}},{"id": "usermodel-user_name", "name": "UserModel[user_name]", "attribute": "user_name", "rules": {"required":true,"messages":{"required":"用户名不能为空。"}}},{"id": "usermodel-user_name", "name": "UserModel[user_name]", "attribute": "user_name", "rules": {"username":{"pattern":/^[a-zA-Z0-9_\u4e00-\u9fa5]{4,20}$/,"not":false,"skipOnEmpty":1},"match":{"pattern":/^\d+$/,"not":true,"skipOnEmpty":1},"messages":{"username":"用户名只能由4-20个字，支持汉字、字母、数字、下划线“_”构成的组合","match":"用户名不能为纯数字"}}},{"id": "usermodel-sex", "name": "UserModel[sex]", "attribute": "sex", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"性别必须是整数。"}}},{"id": "usermodel-birthday", "name": "UserModel[birthday]", "attribute": "birthday", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"出生日期必须是整数。"}}},{"id": "usermodel-rank_point", "name": "UserModel[rank_point]", "attribute": "rank_point", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"成长值必须是整数。"}}},{"id": "usermodel-address_id", "name": "UserModel[address_id]", "attribute": "address_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"默认收货地址必须是整数。"}}},{"id": "usermodel-rank_id", "name": "UserModel[rank_id]", "attribute": "rank_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"用户等级必须是整数。"}}},{"id": "usermodel-mobile_validated", "name": "UserModel[mobile_validated]", "attribute": "mobile_validated", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否已验证手机必须是整数。"}}},{"id": "usermodel-email_validated", "name": "UserModel[email_validated]", "attribute": "email_validated", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否已验证邮箱必须是整数。"}}},{"id": "usermodel-reg_time", "name": "UserModel[reg_time]", "attribute": "reg_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"注册时间必须是整数。"}}},{"id": "usermodel-last_time", "name": "UserModel[last_time]", "attribute": "last_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"最近登录时间必须是整数。"}}},{"id": "usermodel-visit_count", "name": "UserModel[visit_count]", "attribute": "visit_count", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"访问次数必须是整数。"}}},{"id": "usermodel-status", "name": "UserModel[status]", "attribute": "status", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"用户状态必须是整数。"}}},{"id": "usermodel-type", "name": "UserModel[type]", "attribute": "type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"用户类型必须是整数。"}}},{"id": "usermodel-is_seller", "name": "UserModel[is_seller]", "attribute": "is_seller", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否为卖家必须是整数。"}}},{"id": "usermodel-is_real", "name": "UserModel[is_real]", "attribute": "is_real", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否通过实名认证必须是整数。"}}},{"id": "usermodel-shopping_status", "name": "UserModel[shopping_status]", "attribute": "shopping_status", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否允许购物必须是整数。"}}},{"id": "usermodel-comment_status", "name": "UserModel[comment_status]", "attribute": "comment_status", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否允许评论必须是整数。"}}},{"id": "usermodel-user_money", "name": "UserModel[user_money]", "attribute": "user_money", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"可提现余额必须是一个数字。"}}},{"id": "usermodel-user_money_limit", "name": "UserModel[user_money_limit]", "attribute": "user_money_limit", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"不可提现余额必须是一个数字。"}}},{"id": "usermodel-frozen_money", "name": "UserModel[frozen_money]", "attribute": "frozen_money", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"冻结金额必须是一个数字。"}}},{"id": "usermodel-email", "name": "UserModel[email]", "attribute": "email", "rules": {"string":true,"messages":{"string":"邮箱地址必须是一条字符串。","maxlength":"邮箱地址只能包含至多60个字符。"},"maxlength":60}},{"id": "usermodel-address_now", "name": "UserModel[address_now]", "attribute": "address_now", "rules": {"string":true,"messages":{"string":"现居住地址必须是一条字符串。","maxlength":"现居住地址只能包含至多60个字符。"},"maxlength":60}},{"id": "usermodel-user_name", "name": "UserModel[user_name]", "attribute": "user_name", "rules": {"string":true,"messages":{"string":"用户名必须是一条字符串。","minlength":"用户名应该包含至少4个字符。","maxlength":"用户名只能包含至多20个字符。"},"minlength":4,"maxlength":20}},{"id": "usermodel-nickname", "name": "UserModel[nickname]", "attribute": "nickname", "rules": {"string":true,"messages":{"string":"昵称必须是一条字符串。","minlength":"昵称应该包含至少1个字。","maxlength":"昵称只能包含至多20个字符。"},"minlength":1,"maxlength":20}},{"id": "usermodel-nickname", "name": "UserModel[nickname]", "attribute": "nickname", "rules": {"ajax":{"url":"/user/profile/client-validate","model":"YXBwXG1vZHVsZXNcdXNlclxtb2RlbHNcVXNlck1vZGVs","attribute":"nickname","params":[]},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},{"id": "usermodel-password", "name": "UserModel[password]", "attribute": "password", "rules": {"password":{"pattern":/^[^\u4e00-\u9fa5\·]{6,20}$/,"not":false,"skipOnEmpty":1},"match":{"pattern":/\s+/,"not":true,"skipOnEmpty":1},"messages":{"password":"登录密码长度为6-20个字符，建议由字母、数字和符号两种以上。","match":"登录密码不能包含空格。"}}},{"id": "usermodel-password", "name": "UserModel[password]", "attribute": "password", "rules": {"string":true,"messages":{"string":"登录密码必须是一条字符串。","minlength":"登录密码应该包含至少6个字符。","maxlength":"登录密码只能包含至多20个字符。"},"minlength":6,"maxlength":20}},{"id": "usermodel-surplus_password", "name": "UserModel[surplus_password]", "attribute": "surplus_password", "rules": {"string":true,"messages":{"string":"余额支付密码必须是一条字符串。","minlength":"余额支付密码应该包含至少6个字符。","maxlength":"余额支付密码只能包含至多20个字符。"},"minlength":6,"maxlength":20}},{"id": "usermodel-password_reset_token", "name": "UserModel[password_reset_token]", "attribute": "password_reset_token", "rules": {"string":true,"messages":{"string":"重置密码令牌必须是一条字符串。","maxlength":"重置密码令牌只能包含至多255个字符。"},"maxlength":255}},{"id": "usermodel-detail_address", "name": "UserModel[detail_address]", "attribute": "detail_address", "rules": {"string":true,"messages":{"string":"详细地址必须是一条字符串。","maxlength":"详细地址只能包含至多255个字符。"},"maxlength":255}},{"id": "usermodel-headimg", "name": "UserModel[headimg]", "attribute": "headimg", "rules": {"string":true,"messages":{"string":"头像必须是一条字符串。","maxlength":"头像只能包含至多255个字符。"},"maxlength":255}},{"id": "usermodel-auth_key", "name": "UserModel[auth_key]", "attribute": "auth_key", "rules": {"string":true,"messages":{"string":"授权码必须是一条字符串。","maxlength":"授权码只能包含至多255个字符。"},"maxlength":255}},{"id": "usermodel-user_remark", "name": "UserModel[user_remark]", "attribute": "user_remark", "rules": {"string":true,"messages":{"string":"会员备注必须是一条字符串。","maxlength":"会员备注只能包含至多255个字符。"},"maxlength":255}},{"id": "usermodel-salt", "name": "UserModel[salt]", "attribute": "salt", "rules": {"string":true,"messages":{"string":"混淆码必须是一条字符串。","maxlength":"混淆码只能包含至多10个字符。"},"maxlength":10}},{"id": "usermodel-reg_ip", "name": "UserModel[reg_ip]", "attribute": "reg_ip", "rules": {"string":true,"messages":{"string":"注册IP地址必须是一条字符串。","maxlength":"注册IP地址只能包含至多40个字符。"},"maxlength":40}},{"id": "usermodel-last_ip", "name": "UserModel[last_ip]", "attribute": "last_ip", "rules": {"string":true,"messages":{"string":"最近登录IP地址必须是一条字符串。","maxlength":"最近登录IP地址只能包含至多40个字符。"},"maxlength":40}},{"id": "usermodel-pay_point", "name": "UserModel[pay_point]", "attribute": "pay_point", "rules": {"string":true,"messages":{"string":"消费积分必须是一条字符串。"}}},{"id": "usermodel-mobile", "name": "UserModel[mobile]", "attribute": "mobile", "rules": {"match":{"pattern":/^(13[0-9]{1}[0-9]{8}|15[0-9]{1}[0-9]{8}|18[0-9]{1}[0-9]{8}|17[0-9]{1}[0-9]{8}|14[0-9]{1}[0-9]{8}|199[0-9]{8}|198[0-9]{8}|166[0-9]{8})$/,"not":false,"skipOnEmpty":1},"messages":{"match":"手机号码是无效的。"}}},{"id": "usermodel-email", "name": "UserModel[email]", "attribute": "email", "rules": {"email":{"pattern":/^[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/,"fullPattern":/^[^@]*<[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?>$/,"allowName":false,"enableIDN":false,"skipOnEmpty":1},"messages":{"email":"邮箱地址不是有效的邮箱地址。"}}},{"id": "usermodel-user_name", "name": "UserModel[user_name]", "attribute": "user_name", "rules": {"ajax":{"url":"/user/profile/client-validate","model":"YXBwXG1vZHVsZXNcdXNlclxtb2RlbHNcVXNlck1vZGVs","attribute":"user_name","params":["UserModel[user_id]"]},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},{"id": "usermodel-mobile", "name": "UserModel[mobile]", "attribute": "mobile", "rules": {"ajax":{"url":"/user/profile/client-validate","model":"YXBwXG1vZHVsZXNcdXNlclxtb2RlbHNcVXNlck1vZGVs","attribute":"mobile","params":["UserModel[user_id]"]},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},{"id": "usermodel-email", "name": "UserModel[email]", "attribute": "email", "rules": {"ajax":{"url":"/user/profile/client-validate","model":"YXBwXG1vZHVsZXNcdXNlclxtb2RlbHNcVXNlck1vZGVs","attribute":"email","params":["UserModel[user_id]"]},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},{"id": "usermodel-sex", "name": "UserModel[sex]", "attribute": "sex", "rules": {"in":{"range":["0","1","2"]},"messages":{"in":"性别是无效的。"}}},{"id": "usermodel-reg_from", "name": "UserModel[reg_from]", "attribute": "reg_from", "rules": {"in":{"range":["0","1","2","3","4","5"]},"messages":{"in":"注册来源是无效的。"}}},{"id": "usermodel-status", "name": "UserModel[status]", "attribute": "status", "rules": {"in":{"range":["0","1","2","3"]},"messages":{"in":"用户状态是无效的。"}}},{"id": "usermodel-shopping_status", "name": "UserModel[shopping_status]", "attribute": "shopping_status", "rules": {"in":{"range":["0","1"]},"messages":{"in":"是否允许购物是无效的。"}}},{"id": "usermodel-comment_status", "name": "UserModel[comment_status]", "attribute": "comment_status", "rules": {"in":{"range":["0","1"]},"messages":{"in":"是否允许评论是无效的。"}}},{"id": "usermodel-type", "name": "UserModel[type]", "attribute": "type", "rules": {"in":{"range":["0","1"]},"messages":{"in":"用户类型是无效的。"}}},{"id": "usermodel-is_seller", "name": "UserModel[is_seller]", "attribute": "is_seller", "rules": {"in":{"range":["0","1"]},"messages":{"in":"是否为卖家是无效的。"}}},{"id": "usermodel-is_real", "name": "UserModel[is_real]", "attribute": "is_real", "rules": {"in":{"range":["0","1","2"]},"messages":{"in":"是否通过实名认证是无效的。"}}},]);
                $("#btn_submit").click(function() {
                    if (!validator.form()) {
                        return;
                    }
                    //加载提示
                    $.loading.start();
                    $("#UserModel").submit();
                });
                var validator_real = $("#UserRealModel").validate();
                // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
                $.validator.addRules([{"id": "userrealmodel-real_name", "name": "UserRealModel[real_name]", "attribute": "real_name", "rules": {"required":true,"messages":{"required":"真实姓名不能为空。"}}},{"id": "userrealmodel-id_code", "name": "UserRealModel[id_code]", "attribute": "id_code", "rules": {"required":true,"messages":{"required":"身份证号码不能为空。"}}},{"id": "userrealmodel-card_pic1", "name": "UserRealModel[card_pic1]", "attribute": "card_pic1", "rules": {"required":true,"messages":{"required":"身份证正面照不能为空。"}}},{"id": "userrealmodel-card_pic2", "name": "UserRealModel[card_pic2]", "attribute": "card_pic2", "rules": {"required":true,"messages":{"required":"身份证背面照不能为空。"}}},{"id": "userrealmodel-card_pic3", "name": "UserRealModel[card_pic3]", "attribute": "card_pic3", "rules": {"required":true,"messages":{"required":"本人手持身份证正面照不能为空。"}}},{"id": "userrealmodel-user_id", "name": "UserRealModel[user_id]", "attribute": "user_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"用户基本信息ID必须是整数。"}}},{"id": "userrealmodel-status", "name": "UserRealModel[status]", "attribute": "status", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否通过实名认证必须是整数。"}}},{"id": "userrealmodel-add_time", "name": "UserRealModel[add_time]", "attribute": "add_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Add Time必须是整数。"}}},{"id": "userrealmodel-real_name", "name": "UserRealModel[real_name]", "attribute": "real_name", "rules": {"string":true,"messages":{"string":"真实姓名必须是一条字符串。","maxlength":"真实姓名只能包含至多60个字符。"},"maxlength":60}},{"id": "userrealmodel-address_now", "name": "UserRealModel[address_now]", "attribute": "address_now", "rules": {"string":true,"messages":{"string":"现居住地址必须是一条字符串。","maxlength":"现居住地址只能包含至多60个字符。"},"maxlength":60}},{"id": "userrealmodel-id_code", "name": "UserRealModel[id_code]", "attribute": "id_code", "rules": {"string":true,"messages":{"string":"身份证号码必须是一条字符串。","maxlength":"身份证号码只能包含至多18个字符。"},"maxlength":18}},{"id": "userrealmodel-id_code", "name": "UserRealModel[id_code]", "attribute": "id_code", "rules": {"match":{"pattern":/^[0-9]{14}[X|x]$|[0-9]{17}[X|x]$|[0-9]{18}$/,"not":false,"skipOnEmpty":1},"messages":{"match":"身份证号码是无效的。"}}},{"id": "userrealmodel-status", "name": "UserRealModel[status]", "attribute": "status", "rules": {"in":{"range":["0","1","2"]},"messages":{"in":"是否通过实名认证是无效的。"}}},]);
                $("#btn_submit_real").click(function() {
                    if (!validator_real.form()) {
                        return;
                    }
                    //加载提示
                    $.loading.start();
                    $("#UserModel").submit();
                });
            });
        </script>
    </div>

@endsection