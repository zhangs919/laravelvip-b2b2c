{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/iconfont/iconfont.css?v=4.0"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=4.0"/>
@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30 clearfix pos-r">

        <form id="form1" class="form-horizontal" name="GoodsTag" action="/goods/goods-tag/add" method="POST">
            {{ csrf_field() }}
            <input type="hidden" id="goodstag-tag_id" class="form-control" name="GoodsTag[tag_id]" value="{{ $info->tag_id ?? '' }}">
            <!-- 标签名称-->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="goodstag-tag_name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">标签名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <input type="text" id="tag_name" class="form-control" name="GoodsTag[tag_name]" value="{{ $info->tag_name ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="goodstag-tag_name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">标签形状：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <ul class="goodstag-item-box">

                                <li class="disp-block">
                                    <div class="goodstag-type">角标（1）</div>
                                </li>


                                <li class='tag-item selected' data-key=1 data-k=0>

                                    <div class="goodstag-seat">
                                        <div class="goodstag-item tag1">
                                            <i class="fa fa-check-circle"></i>
                                            <img src="/assets/d2eace91/images/superscript/jb1-0.png">
                                        </div>
                                    </div>
                                </li>


                                <li class='tag-item ' data-key=1 data-k=1>

                                    <div class="goodstag-seat">
                                        <div class="goodstag-item tag1">
                                            <i class="fa fa-check-circle"></i>
                                            <img src="/assets/d2eace91/images/superscript/jb1-1.png">
                                        </div>
                                    </div>
                                </li>


                                <li class='tag-item ' data-key=1 data-k=2>

                                    <div class="goodstag-seat">
                                        <div class="goodstag-item tag1">
                                            <i class="fa fa-check-circle"></i>
                                            <img src="/assets/d2eace91/images/superscript/jb1-2.png">
                                        </div>
                                    </div>
                                </li>


                                <li class='tag-item ' data-key=1 data-k=3>

                                    <div class="goodstag-seat">
                                        <div class="goodstag-item tag1">
                                            <i class="fa fa-check-circle"></i>
                                            <img src="/assets/d2eace91/images/superscript/jb1-3.png">
                                        </div>
                                    </div>
                                </li>

                                <div class="m-b-10 disp-block"></div>

                                <li class="disp-block">
                                    <div class="goodstag-type">角标（2）</div>
                                </li>


                                <li class='tag-item ' data-key=2 data-k=0>

                                    <div class="goodstag-seat">
                                        <div class="goodstag-item tag2">
                                            <i class="fa fa-check-circle"></i>
                                            <img src="/assets/d2eace91/images/superscript/jb2-0.png">
                                        </div>
                                    </div>
                                </li>


                                <li class='tag-item ' data-key=2 data-k=1>

                                    <div class="goodstag-seat">
                                        <div class="goodstag-item tag2">
                                            <i class="fa fa-check-circle"></i>
                                            <img src="/assets/d2eace91/images/superscript/jb2-1.png">
                                        </div>
                                    </div>
                                </li>

                                <div class="m-b-10 disp-block"></div>

                                <li class="disp-block">
                                    <div class="goodstag-type">角标（3）</div>
                                </li>


                                <li class='tag-item ' data-key=3 data-k=0>

                                    <div class="goodstag-seat">
                                        <div class="goodstag-item tag3">
                                            <i class="fa fa-check-circle"></i>
                                            <img src="/assets/d2eace91/images/superscript/jb3-0.png">
                                        </div>
                                    </div>
                                </li>


                                <li class='tag-item ' data-key=3 data-k=1>

                                    <div class="goodstag-seat">
                                        <div class="goodstag-item tag3">
                                            <i class="fa fa-check-circle"></i>
                                            <img src="/assets/d2eace91/images/superscript/jb3-1.png">
                                        </div>
                                    </div>
                                </li>


                                <li class='tag-item ' data-key=3 data-k=2>

                                    <div class="goodstag-seat">
                                        <div class="goodstag-item tag3">
                                            <i class="fa fa-check-circle"></i>
                                            <img src="/assets/d2eace91/images/superscript/jb3-2.png">
                                        </div>
                                    </div>
                                </li>


                                <li class='tag-item ' data-key=3 data-k=3>

                                    <div class="goodstag-seat">
                                        <div class="goodstag-item tag3">
                                            <i class="fa fa-check-circle"></i>
                                            <img src="/assets/d2eace91/images/superscript/jb3-3.png">
                                        </div>
                                    </div>
                                </li>


                                <li class='tag-item ' data-key=3 data-k=4>

                                    <div class="goodstag-seat">
                                        <div class="goodstag-item tag3">
                                            <i class="fa fa-check-circle"></i>
                                            <img src="/assets/d2eace91/images/superscript/jb3-4.png">
                                        </div>
                                    </div>
                                </li>


                                <li class='tag-item ' data-key=3 data-k=5>

                                    <div class="goodstag-seat">
                                        <div class="goodstag-item tag3">
                                            <i class="fa fa-check-circle"></i>
                                            <img src="/assets/d2eace91/images/superscript/jb3-5.png">
                                        </div>
                                    </div>
                                </li>


                                <li class='tag-item ' data-key=3 data-k=6>

                                    <div class="goodstag-seat">
                                        <div class="goodstag-item tag3">
                                            <i class="fa fa-check-circle"></i>
                                            <img src="/assets/d2eace91/images/superscript/jb3-6.png">
                                        </div>
                                    </div>
                                </li>


                                <li class='tag-item ' data-key=3 data-k=7>

                                    <div class="goodstag-seat">
                                        <div class="goodstag-item tag3">
                                            <i class="fa fa-check-circle"></i>
                                            <img src="/assets/d2eace91/images/superscript/jb3-7.png">
                                        </div>
                                    </div>
                                </li>


                                <li class='tag-item ' data-key=3 data-k=8>

                                    <div class="goodstag-seat">
                                        <div class="goodstag-item tag3">
                                            <i class="fa fa-check-circle"></i>
                                            <img src="/assets/d2eace91/images/superscript/jb3-8.png">
                                        </div>
                                    </div>
                                </li>

                                <div class="m-b-10 disp-block"></div>

                                <li class="disp-block">
                                    <div class="goodstag-type">角标（4）</div>
                                </li>


                                <li class='tag-item ' data-key=4 data-k=0>

                                    <div class="goodstag-seat">
                                        <div class="goodstag-item tag4">
                                            <i class="fa fa-check-circle"></i>
                                            <img src="/assets/d2eace91/images/superscript/jb4-0.png">
                                        </div>
                                    </div>
                                </li>


                                <li class='tag-item ' data-key=4 data-k=1>

                                    <div class="goodstag-seat">
                                        <div class="goodstag-item tag4">
                                            <i class="fa fa-check-circle"></i>
                                            <img src="/assets/d2eace91/images/superscript/jb4-1.png">
                                        </div>
                                    </div>
                                </li>


                                <li class='tag-item ' data-key=4 data-k=2>

                                    <div class="goodstag-seat">
                                        <div class="goodstag-item tag4">
                                            <i class="fa fa-check-circle"></i>
                                            <img src="/assets/d2eace91/images/superscript/jb4-2.png">
                                        </div>
                                    </div>
                                </li>


                                <li class='tag-item ' data-key=4 data-k=3>

                                    <div class="goodstag-seat">
                                        <div class="goodstag-item tag4">
                                            <i class="fa fa-check-circle"></i>
                                            <img src="/assets/d2eace91/images/superscript/jb4-3.png">
                                        </div>
                                    </div>
                                </li>


                                <li class='tag-item ' data-key=4 data-k=4>

                                    <div class="goodstag-seat">
                                        <div class="goodstag-item tag4">
                                            <i class="fa fa-check-circle"></i>
                                            <img src="/assets/d2eace91/images/superscript/jb4-4.png">
                                        </div>
                                    </div>
                                </li>


                                <li class='tag-item ' data-key=4 data-k=5>

                                    <div class="goodstag-seat">
                                        <div class="goodstag-item tag4">
                                            <i class="fa fa-check-circle"></i>
                                            <img src="/assets/d2eace91/images/superscript/jb4-5.png">
                                        </div>
                                    </div>
                                </li>


                                <li class='tag-item ' data-key=4 data-k=6>

                                    <div class="goodstag-seat">
                                        <div class="goodstag-item tag4">
                                            <i class="fa fa-check-circle"></i>
                                            <img src="/assets/d2eace91/images/superscript/jb4-6.png">
                                        </div>
                                    </div>
                                </li>

                                <div class="m-b-10 disp-block"></div>

                                <li class="disp-block">
                                    <div class="goodstag-type">角标（5）</div>
                                </li>


                                <li class='tag-item ' data-key=5 data-k=0>

                                    <div class="goodstag-seat">
                                        <div class="goodstag-item tag5">
                                            <i class="fa fa-check-circle"></i>
                                            <img src="/assets/d2eace91/images/superscript/jb5-0.png">
                                        </div>
                                    </div>
                                </li>


                                <li class='tag-item ' data-key=5 data-k=1>

                                    <div class="goodstag-seat">
                                        <div class="goodstag-item tag5">
                                            <i class="fa fa-check-circle"></i>
                                            <img src="/assets/d2eace91/images/superscript/jb5-1.png">
                                        </div>
                                    </div>
                                </li>


                                <li class='tag-item ' data-key=5 data-k=2>

                                    <div class="goodstag-seat">
                                        <div class="goodstag-item tag5">
                                            <i class="fa fa-check-circle"></i>
                                            <img src="/assets/d2eace91/images/superscript/jb5-2.png">
                                        </div>
                                    </div>
                                </li>


                                <li class='tag-item ' data-key=5 data-k=3>

                                    <div class="goodstag-seat">
                                        <div class="goodstag-item tag5">
                                            <i class="fa fa-check-circle"></i>
                                            <img src="/assets/d2eace91/images/superscript/jb5-3.png">
                                        </div>
                                    </div>
                                </li>

                                <div class="m-b-10 disp-block"></div>

                                <li class="disp-block">
                                    <div class="goodstag-type">角标（6）</div>
                                </li>


                                <li class='tag-item ' data-key=6 data-k=0>

                                    <div class="goodstag-seat">
                                        <div class="goodstag-item tag6">
                                            <i class="fa fa-check-circle"></i>
                                            <img src="/assets/d2eace91/images/superscript/jb6-0.png">
                                        </div>
                                    </div>
                                </li>


                                <li class='tag-item ' data-key=6 data-k=1>

                                    <div class="goodstag-seat">
                                        <div class="goodstag-item tag6">
                                            <i class="fa fa-check-circle"></i>
                                            <img src="/assets/d2eace91/images/superscript/jb6-1.png">
                                        </div>
                                    </div>
                                </li>


                                <li class='tag-item ' data-key=6 data-k=2>

                                    <div class="goodstag-seat">
                                        <div class="goodstag-item tag6">
                                            <i class="fa fa-check-circle"></i>
                                            <img src="/assets/d2eace91/images/superscript/jb6-2.png">
                                        </div>
                                    </div>
                                </li>

                                <div class="m-b-10 disp-block"></div>

                                <li class="disp-block">
                                    <div class="goodstag-type">角标（7）</div>
                                </li>


                                <li class='tag-item ' data-key=7 data-k=0>

                                    <div class="goodstag-seat">
                                        <div class="goodstag-item tag7">
                                            <i class="fa fa-check-circle"></i>
                                            <img src="/assets/d2eace91/images/superscript/jb7-0.png">
                                        </div>
                                    </div>
                                </li>


                                <li class='tag-item ' data-key=7 data-k=1>

                                    <div class="goodstag-seat">
                                        <div class="goodstag-item tag7">
                                            <i class="fa fa-check-circle"></i>
                                            <img src="/assets/d2eace91/images/superscript/jb7-1.png">
                                        </div>
                                    </div>
                                </li>

                                <div class="m-b-10 disp-block"></div>

                                <li class="disp-block">
                                    <div class="goodstag-type">角标（8）</div>
                                </li>


                                <li class='tag-item ' data-key=8 data-k=0>

                                    <div class="goodstag-seat">
                                        <div class="goodstag-item tag8">
                                            <i class="fa fa-check-circle"></i>
                                            <img src="/assets/d2eace91/images/superscript/jb8-0.png">
                                        </div>
                                    </div>
                                </li>


                                <li class='tag-item ' data-key=8 data-k=1>

                                    <div class="goodstag-seat">
                                        <div class="goodstag-item tag8">
                                            <i class="fa fa-check-circle"></i>
                                            <img src="/assets/d2eace91/images/superscript/jb8-1.png">
                                        </div>
                                    </div>
                                </li>

                                <div class="m-b-10 disp-block"></div>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="goodstag-tag_name" class="col-sm-4 control-label">
                        <span class="ng-binding">自定义标签：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <div class="imagegroup_container pull-left"></div>
                            <input type="hidden" id="imgpath" class="form-control" name="GoodsTag[tag_image]" value="/images/superscript/jb1-1.png" placeholder="">

                            <input type="hidden" id="self_img" class="form-control" value="0">

                            <input type="hidden" id="tag_shape" class="form-control" name="GoodsTag[tag_shape]" value="{{ $info->tag_shape ?? '1-0' }}">
                            <span class="help-block help-block-t">请上传已设计好的标签图片，最佳上传图片尺寸为60*60像素</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="goodstag-tag_position" class="col-sm-4 control-label">

                        <span class="ng-binding">标签显示位置：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <select id="tag_position" class="form-control" name="GoodsTag[tag_position]" onChange="preview()">
                                @foreach($tagPosition as $k=>$v)
                                    <option value="{{ $k }}" @if(@$info->tag_position == $k){{ 'selected' }}@endif>{{ $v }}</option>
                                @endforeach
                            </select>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>		<!-- 确认提交 -->
            <div class="bottom-btn p-b-30">
                <input type="button" id="btn_submit" name="btn_submit" class="btn btn-primary btn-lg" value="确认提交" />
            </div>

        </form>
        <!--新加标签预览-->
        <div class="goodstag-preview">
            <p class="title">标签预览</p>
            <div class="goodstag-content">
                <!--为goodstag-seat后添加location0~4样式-->
                <div class="goodstag-seat location{{ $info->tag_position ?? 0 }}" id='show_seat'>
                    <div class="goodstag-item" id='iconfont_show'>
                        <img id='image_show' src="{{ $info->tag_image ?? '/assets/d2eace91/images/superscript/jb1-0.png' }}">
                    </div>
                </div>
            </div>
        </div>
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

{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20190110"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20190110"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20190110"></script>
    <!-- 在线文本编辑器 -->
    <!-- AJAX上传+图片预览 -->
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=20190110"></script>
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=20190110"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20190110"></script>
    <script src="/assets/d2eace91/js/jquery-ui.js?v=20190110"></script>
    <script src="/assets/d2eace91/js/html2canvas.min.js?v=20190110"></script>
    <script src="/assets/d2eace91/bootstrap/evol-colorpicker/js/evol.colorpicker.js?v=20190110"></script>


    <script type="text/javascript">
        $().ready(function() {
            $(".colorpicker").colorpicker();
        });
    </script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
[{"id": "goodstag-tag_name", "name": "GoodsTag[tag_name]", "attribute": "tag_name", "rules": {"required":true,"messages":{"required":"标签名称不能为空。"}}},{"id": "goodstag-tag_image", "name": "GoodsTag[tag_image]", "attribute": "tag_image", "rules": {"required":true,"messages":{"required":"Tag Image不能为空。"}}},{"id": "goodstag-sort", "name": "GoodsTag[sort]", "attribute": "sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。"}}},{"id": "goodstag-add_time", "name": "GoodsTag[add_time]", "attribute": "add_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"添加时间必须是整数。"}}},{"id": "goodstag-tag_name", "name": "GoodsTag[tag_name]", "attribute": "tag_name", "rules": {"string":true,"messages":{"string":"标签名称必须是一条字符串。","maxlength":"标签名称只能包含至多50个字符。"},"maxlength":50}},{"id": "goodstag-tag_position", "name": "GoodsTag[tag_position]", "attribute": "tag_position", "rules": {"string":true,"messages":{"string":"标签显示位置必须是一条字符串。","maxlength":"标签显示位置只能包含至多1个字符。"},"maxlength":1}},]
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

            //选择形状
            $('.tag-item').click(function() {
                $('.tag-item').each(function(index, domEle) {
                    $(this).removeClass("selected");
                });
                $(this).addClass("selected");
                preview();
            });

            var validator = $("#form1").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                //加载提示
                $.loading.start();

                var url = $("#form1").attr("action");
                var data = $("#form1").serializeJson();
                $.post(url, data, function(result) {
                    $.loading.stop();
                    if (result.code == 0) {
                        $.msg(result.message, function() {
                            $.loading.start();
                            $.go('list');
                        });
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "json");

            });
        });
        //预览
        function preview() {
            var shape = '';
            var key = '';
            var k = '';
            var position = $("#tag_position").val();
            if ($("#self_img").val() == 0) {
                $('.tag-item').each(function(index, domEle) {
                    if ($(this).hasClass("selected")) {
                        key = $(this).data('key');
                        k = $(this).data('k');
                        //预览效果
                        $("#image_show").attr('src', $(this).find('img')[0].src);
                        $("#imgpath").val('/images/superscript/jb' + key + '-' + k + '.png');
                        $("#tag_shape").val(key + '-' + k);

                    }
                });
            }
            //改变位置
            if (position.length > 0) {
                document.getElementById("show_seat").className = "goodstag-seat";
                $("#show_seat").addClass("location" + position);
            }
        }
    </script>
    <script type="text/javascript">
        $().ready(function() {
            var img = '';
            if ("{{ $info->self_img ?? 0 }}" == 1) {
                img = "{{ $info->self_img ? $info->tag_image : '/assets/d2eace91' }}";
            }

            $(".imagegroup_container").each(function() {
                var imagegorup = $(this).imagegroup({
                    host: "{{ get_oss_host() }}",
                    size: 1,
                    values: [img],
                    callback: function(data) {
                        console.info(data);
                        $("#imgpath").val(this.values);
                        $("#image_show").attr('src', data.url);
                        $("#self_img").val(1);
                    },
                    remove: function(value, values) {
                        $("#imgpath").val(this.values);
                        $("#self_img").val(0);
                        $("#image_show").attr('src', "/assets/d2eace91/images/superscript/jb1-0.png");
                    }
                });
            });

        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop