{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20181020"/>
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <form id="UserRealModel" class="form-horizontal" name="UserRealModel" action="/user/user/real-info?id={{ $info->user_id }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="table-content m-t-30 clearfix">

            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="userrealmodel-real_name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">真实姓名：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="userrealmodel-real_name" class="form-control" name="UserRealModel[real_name]" value="{{ $info->real_name }}">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>


            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="userrealmodel-id_code" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">身份证号码：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="userrealmodel-id_code" class="form-control" name="UserRealModel[id_code]" value="{{ $info->id_code }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">身份证号码位数为15位或18位</div></div>
                    </div>
                </div>
            </div>

            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="userrealmodel-card_pic1" class="col-sm-4 control-label">

                        <span class="ng-binding">身份证正面照：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <!-- 图片组 start -->
                            <div id="card_pic1_imagegroup_container" class="szy-imagegroup w600" data-id="userrealmodel-card_pic1" data-size="1"></div>

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

                            <input type="hidden" id="userrealmodel-card_pic1" class="form-control" name="UserRealModel[card_pic1]" value="{{ $info->card_pic1 }}">
                            <!-- 图片组 end -->

                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">请上传jpg、gif、png格式的图片，并且图片清晰，图片大小不得超过2M</div></div>
                    </div>
                </div>
            </div>


            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="userrealmodel-card_pic2" class="col-sm-4 control-label">

                        <span class="ng-binding">身份证背面照：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <!-- 图片组 start -->
                            <div id="card_pic2_imagegroup_container" class="szy-imagegroup w600" data-id="userrealmodel-card_pic2" data-size="1"></div>

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

                            <input type="hidden" id="userrealmodel-card_pic2" class="form-control" name="UserRealModel[card_pic2]" value="{{ $info->card_pic2 }}">
                            <!-- 图片组 end -->

                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">请上传jpg、gif、png格式的图片，并且图片清晰，图片大小不得超过2M</div></div>
                    </div>
                </div>
            </div>


            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="userrealmodel-card_pic3" class="col-sm-4 control-label">

                        <span class="ng-binding">本人手持身份证正面照：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <!-- 图片组 start -->
                            <div id="card_pic3_imagegroup_container" class="szy-imagegroup w600" data-id="userrealmodel-card_pic3" data-size="1"></div>

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

                            <input type="hidden" id="userrealmodel-card_pic3" class="form-control" name="UserRealModel[card_pic3]" value="{{ $info->card_pic3 }}">
                            <!-- 图片组 end -->

                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">请上传jpg、gif、png格式的图片，并且图片清晰，图片大小不得超过2M</div></div>
                    </div>
                </div>
            </div>


            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="userrealmodel-status" class="col-sm-4 control-label">

                        <span class="ng-binding">是否通过实名认证：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="UserRealModel[status]" value="0">
                                    <label><input type="checkbox" id="userrealmodel-status" class="form-control b-n" name="UserRealModel[status]"
                                                  value="1" @if($info->status == 1)checked="" @endif data-on-text="是" data-off-text="否"> </label>
                                </div>
                            </label>
                            <span>
                                <a class="btn-link m-t-10 m-l-20" href="javascript:card_search()">在线查询</a>
                            </span>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">如果为是，则通过实名认证；如果为否，则没有通过实名认证</div></div>
                    </div>
                </div>
            </div>

            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="userrealmodel-reason" class="col-sm-4 control-label">

                        <span class="ng-binding">审核原因：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <textarea id="userrealmodel-reason" class="form-control" name="UserRealModel[reason]" rows="5">{{ $info->reason }}</textarea>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">最多50个字</div></div>
                    </div>
                </div>
            </div>
            <!-- 提交按钮 -->
            <div class="simple-form-field p-b-30">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label"></label>
                    <div class="col-xs-8">
                        <input type="button" id="btn_submit" value="确认提交" class="btn btn-primary" />

                        <!-- 隐藏域，标识作用 -->
                        <input type="hidden" id="userrealmodel-real_id" class="form-control" name="UserRealModel[real_id]" value="{{ $info->real_id }}">
                        <input type="hidden" id="userrealmodel-user_id" class="form-control" name="UserRealModel[user_id]" value="{{ $info->user_id }}">
                    </div>
                </div>
            </div>
        </div>
    </form>

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
    <!-- 图片预览 -->
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=20180027"></script>
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=20180027"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20180027"></script>
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180027"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180027"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180027"></script>
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
    <script type="text/javascript">
        $().ready(function() {
            var validator = $("#UserRealModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules([{"id": "userrealmodel-real_name", "name": "UserRealModel[real_name]", "attribute": "real_name", "rules": {"required":true,"messages":{"required":"真实姓名不能为空。"}}},{"id": "userrealmodel-id_code", "name": "UserRealModel[id_code]", "attribute": "id_code", "rules": {"required":true,"messages":{"required":"身份证号码不能为空。"}}},{"id": "userrealmodel-user_id", "name": "UserRealModel[user_id]", "attribute": "user_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"用户基本信息ID必须是整数。"}}},{"id": "userrealmodel-status", "name": "UserRealModel[status]", "attribute": "status", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否通过实名认证必须是整数。"}}},{"id": "userrealmodel-real_name", "name": "UserRealModel[real_name]", "attribute": "real_name", "rules": {"string":true,"messages":{"string":"真实姓名必须是一条字符串。","maxlength":"真实姓名只能包含至多60个字符。"},"maxlength":60}},{"id": "userrealmodel-address_now", "name": "UserRealModel[address_now]", "attribute": "address_now", "rules": {"string":true,"messages":{"string":"现居住地址必须是一条字符串。","maxlength":"现居住地址只能包含至多60个字符。"},"maxlength":60}},{"id": "userrealmodel-reason", "name": "UserRealModel[reason]", "attribute": "reason", "rules": {"string":true,"messages":{"string":"审核原因必须是一条字符串。","maxlength":"审核原因只能包含至多50个字符。"},"maxlength":50}},{"id": "userrealmodel-id_code", "name": "UserRealModel[id_code]", "attribute": "id_code", "rules": {"string":true,"messages":{"string":"身份证号码必须是一条字符串。","maxlength":"身份证号码只能包含至多18个字符。"},"maxlength":18}},{"id": "userrealmodel-id_code", "name": "UserRealModel[id_code]", "attribute": "id_code", "rules": {"match":{"pattern":/^[0-9]{14}[X|x]$|[0-9]{17}[X|x]$|[0-9]{18}$/,"not":false,"skipOnEmpty":1},"messages":{"match":"身份证号码是无效的。"}}},{"id": "userrealmodel-status", "name": "UserRealModel[status]", "attribute": "status", "rules": {"in":{"range":["0","1","2"]},"messages":{"in":"是否通过实名认证是无效的。"}}},]);
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                //加载提示
                $.loading.start();
                $("#UserRealModel").submit();
            });
        });

        function card_search()
        {
            $.modal({
                // 标题
                title: '查询身份信息',
                width: 520,
                trigger: $(this),
                // ajax加载的设置
                ajax: {
                    url: '/user/user/card-search',
                    data: {
                        id: $("#userrealmodel-id_code").val()
                    }
                },
            });
        }
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop