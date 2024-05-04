{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link href="/assets/d2eace91/js/editor/themes/default/default.css" rel="stylesheet">

    <link rel="stylesheet" href="/assets/d2eace91/css/mobile-styles.css?v=1.2">
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')



    <!--左侧内容start-->
    <div class="col-sm-3">
        <div class="graphic-material m-t-30 m-l-30">
            <div class="graphic-material-title">
                <h1>高级图文</h1>
            </div>
            <!--中间内容-->
            <div class="graphic-material-con">
                <div class="graphic-material-info" id="graphic-material-info">
                    @if(isset($info->id))
                        @foreach($info->items as $key=>$item)
                            @if($key == 0)
                                <!--头部封面设置-->
                                    <div class="graphic-con more-graphic add-article-html selected" data-id="{{ $key+1 }}">
                                        <h4 class="graphic-title title-{{ $key+1 }}">{{ $item->title }}</h4>
                                        <div class="graphic-wrap material-img-1">
                                            <img src="{{ get_image_url($item->cover) }}">
                                        </div>
                                    </div>
                            @else
                                <!--底部文章-->
                                    <div class="article-list add-article-html" data-id="{{ $key+1 }}">
                                        <h3 class="title-{{ $key+1 }}">{{ $item->title }}</h3>
                                        <div class="article-list-pic material-img-2">
                                            <img src="{{ get_image_url($item->cover) }}">
                                        </div>
                                        <div class="handle-btn-con">
                                            <a href="javascript:void(0)" class="del">
                                                <i class="fa fa-trash-o"></i>
                                                删除
                                            </a>
                                        </div>
                                    </div>
                            @endif
                        @endforeach
                    @else
                        <!--头部封面设置-->
                        <div class="graphic-con more-graphic add-article-html selected" data-id="1">
                            <h4 class="graphic-title title-1">标题</h4>
                            <div class="graphic-wrap material-img-1">
                                <p>封面图片</p>
                            </div>
                        </div>
                        <!--底部文章-->
                        <div class="article-list add-article-html" data-id="2">
                            <h3 class="title-2">标题</h3>
                            <div class="article-list-pic material-img-2">
                                <p>图片</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <!--底部新增-->
            <div class="add-article-btn">
                <h4>
                    <a href="javascript:;" class="add_template">+ 新增</a>
                </h4>
            </div>
        </div>
    </div>
    <!--左侧内容end-->
    <div class="m-t-30 col-sm-9">
        <div class="table-content">
            <div id="form_list">


            </div>
            <!-- 确认提交 -->
            <div class="bottom-btn p-b-30" style="margin-top:-30px;">
                <input type="hidden" name="id" value="{{ $info->id ?? '' }}">
                <input type="button" id="btn_submit" name="btn_submit" class="btn btn-primary btn-lg" value="确认提交">
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

    <script id="add_template" type="text">
<div class="article-list add-article-html" data-id="#0#">
	<h3 class="graphic-title title-#0#">标题</h3>
	<div class="article-list-pic material-img-#0#">
		<p>图片</p>
	</div>
	<div class="handle-btn-con">
		<a href="javascript:void(0)" class="del">
			<i class="fa fa-trash-o"></i>
			删除
		</a>
	</div>
</div>

</script>

    <script id="form_template" type="text">

	<form id="form_#0#" class="form-horizontal" name="MaterialModel" action="/weixin/material/more-add" method="post" enctype="multipart/form-data">
    @csrf
	<!-- 标题 -->
	<div class="simple-form-field" >
<div class="form-group">
<label for="materialmodel-title" class="col-sm-4 control-label">
<span class="text-danger ng-binding">*</span>
<span class="ng-binding">标题：</span>
</label>
<div class="col-sm-8">
<div class="form-control-box">


	<input type="text" id="title_#0#" class="form-control" name="MaterialModel[title]">


</div>

<div class="help-block help-block-t"></div>
</div>
</div>
</div>
	<!-- 作者 -->
	<div class="simple-form-field" >
<div class="form-group">
<label for="materialmodel-author" class="col-sm-4 control-label">

<span class="ng-binding">作者：</span>
</label>
<div class="col-sm-8">
<div class="form-control-box">


	<input type="text" id="author_#0#" class="form-control" name="MaterialModel[author]">


</div>

<div class="help-block help-block-t"></div>
</div>
</div>
</div>
	<!-- 封面 -->
	<div class="simple-form-field" >
<div class="form-group">
<label for="materialmodel-cover" class="col-sm-4 control-label">
<span class="text-danger ng-binding">*</span>
<span class="ng-binding">封面：</span>
</label>
<div class="col-sm-8">
<div class="form-control-box">


	<div id="cover_container_#0#" class="img-container"></div>
	<input type="hidden" id="cover_#0#" class="form-control" name="MaterialModel[cover]">


</div>

<div class="help-block help-block-t"><div class="help-block help-block-t"> 封面大图-图片建议尺寸：900px*500px，封面小图-图片建议尺寸：200px*200px</div></div>
</div>
</div>
</div>
	<!-- 摘要 -->
	<div class="simple-form-field" >
<div class="form-group">
<label for="materialmodel-abstract" class="col-sm-4 control-label">
<span class="text-danger ng-binding">*</span>
<span class="ng-binding">摘要：</span>
</label>
<div class="col-sm-8">
<div class="form-control-box">


	<textarea id="abstract_#0#" class="form-control" name="MaterialModel[abstract]" rows="5"></textarea>


</div>

<div class="help-block help-block-t"></div>
</div>
</div>
</div>
	<!-- 转向链接 -->
	<div class="simple-form-field" >
<div class="form-group">
<label for="materialmodel-link" class="col-sm-4 control-label">

<span class="ng-binding">转向链接：</span>
</label>
<div class="col-sm-8">
<div class="form-control-box">


	<input type="text" id="link_#0#" class="form-control" name="MaterialModel[link]" placeholder="http://">


</div>

<div class="help-block help-block-t"></div>
</div>
</div>
</div>
	<!-- 内容  -->
	<div class="simple-form-field" >
<div class="form-group">
<label for="materialmodel-content" class="col-sm-3 control-label">

<span class="ng-binding">内容：</span>
</label>
<div class="col-sm-9">
<div class="form-control-box">

	<div class="form-control-box">
		<!-- 文本编辑器 -->
		<textarea id="content_#0#" class="form-control" name="MaterialModel[content]" rows="5" style="width: 350px; height: 250px;"></textarea>
	</div>

</div>

<div class="help-block help-block-t"></div>
</div>
</div>
</div>
</form>

<script type="text/javascript">
	KindEditor.ready(function(K) {
		window.editor = K.create('#content_#0#', {
			items: ['source', '|', 'fullscreen', 'undo', 'redo', 'print', 'cut', 'copy', 'paste', 'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright', 'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript', 'superscript', '|', 'selectall', 'clearhtml', 'quickformat', '|', 'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'flash', 'media', 'table', 'hr', 'emoticons', 'link', 'unlink', '|', 'about'],
			cssPath: "/assets/d2eace91/js/editor/themes/default/default.css",
			uploadJson: "/site/upload-image",
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
		});
	});
	$().ready(function() {
		$("#cover_container_#0#").imagegroup({
			host: '{{ get_oss_host() }}',
			size: 1,
			values: [$("#cover_#0#").val()],
			callback: function(data) {
				console.info(data);
				var img = "{{ get_oss_host() }}" + data.path;
				var src = "<img src='" + img + "'>";
				if (src.indexOf("//backend") > 0) {
					src = src.replace("//backend", "/backend");
				}
				$("#cover_#0#").val(data.path);
				$(".material-img-#0#").html(src);
			},
			remove: function(value, values) {
				var src = '<p>图片</p>';
				$(".material-img-#0#").html(src);
				$("#cover_#0#").val('');
			}
		});

		$('#title_#0#').bind('input propertychange', function() {
			var val = $("#title_#0#").val();
			if (val == '') {
				$(".title-#0#").html('标题');
			} else {
				$(".title-#0#").html(val);
			}
		});
	});
</script>

    
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/min/js/validate.min.js"></script>
    <!-- AJAX上传 -->
    <script src="/assets/d2eace91/min/js/upload.min.js"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=1.2"></script>
    <!-- 编辑器 -->
    <script src="/assets/d2eace91/js/editor/kindeditor-all.min.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/editor/lang/zh_CN.js?v=1.2"></script>

    <script id="client_rules" type="text">
[{"id": "materialmodel-title", "name": "MaterialModel[title]", "attribute": "title", "rules": {"required":true,"messages":{"required":"标题不能为空。"}}},{"id": "materialmodel-cover", "name": "MaterialModel[cover]", "attribute": "cover", "rules": {"required":true,"messages":{"required":"封面不能为空。"}}},{"id": "materialmodel-abstract", "name": "MaterialModel[abstract]", "attribute": "abstract", "rules": {"required":true,"messages":{"required":"摘要不能为空。"}}},{"id": "materialmodel-author", "name": "MaterialModel[author]", "attribute": "author", "rules": {"string":true,"messages":{"string":"作者必须是一条字符串。"}}},{"id": "materialmodel-content", "name": "MaterialModel[content]", "attribute": "content", "rules": {"string":true,"messages":{"string":"内容必须是一条字符串。"}}},{"id": "materialmodel-link", "name": "MaterialModel[link]", "attribute": "link", "rules": {"string":true,"messages":{"string":"转向链接必须是一条字符串。"}}},{"id": "materialmodel-title", "name": "MaterialModel[title]", "attribute": "title", "rules": {"string":true,"messages":{"string":"标题必须是一条字符串。","maxlength":"标题只能包含至多30个字符。"},"maxlength":30}},{"id": "materialmodel-link", "name": "MaterialModel[link]", "attribute": "link", "rules": {"url":{"pattern":/^(http|https):\/\/(([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+)(?::\d{1,5})?(?:$|[?\/#])/i,"enableIDN":false,"skipOnEmpty":1},"messages":{"url":"转向链接不是一条有效的URL。"}}},]
</script>
    <script type="text/javascript">
        var data_json = {!! $dataJson ?? '[]' !!};
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

            if (data_json.length > 0) {
                var at_size = $(".add-article-html").size();
                for (var i = 1; i <= at_size; i++) {
                    var items = ['title','author','cover','abstract','type','content','link'];
                    var tl = $("#form_template").html();
                    tl = tl.replace(/#0#/g, i);
                    var tl_element = $($.parseHTML(tl, true));
                    $("#form_list").append(tl_element);
                    for(var j=0;j<items.length;j++){
                        $(tl_element).find("#" + items[j] + "_" + i).val(data_json[i-1][items[j]]);
                    }
                    if (i == 1) {
                        $("#form_" + i).show();
                    } else {
                        $("#form_" + i).hide();
                    }
                }
            } else {
                var at_size = $(".add-article-html").size();
                for (var i = 1; i <= at_size; i++) {
                    var tl = $("#form_template").html();
                    tl = tl.replace(/#0#/g, i);
                    var tl_element = $($.parseHTML(tl, true));
                    $("#form_list").append(tl_element);
                    if (i == 1) {
                        $("#form_" + i).show();
                    } else {
                        $("#form_" + i).hide();
                    }
                }
            }

            // 模版点击事件
            $("body").on('click', '.add-article-html', function() {
                var index = $(this).data('id');
                $(this).addClass("selected").siblings().removeClass("selected");
                $('#form_list').find("[id^='form_']").hide();
                $("#form_" + index).show();
            });

            // 删除记录
            $("body").on('click', '.del', function() {
                var id = $(this).parent().parent('.add-article-html').data('id');
                var obj = $(this).parent().parent('.add-article-html');
                $.confirm("确定要删除此图文信息吗？",function(){
                    obj.remove();
                    $('.add-article-html').eq(0).click();
                    $("#form_"+id).remove();
                });
            });

            // 增加左侧图文模版
            $(".add_template").click(function() {
                var add_template_size = $(".add-article-html").size();
                if (add_template_size == 10) {
                    $.msg('最多只能10条！');
                    return false;
                }

                var last_id = $(".add-article-html").last().data('id');

                add_template_id = last_id + 1;

                var add_template = $("#add_template").html();
                add_template = add_template.replace(/#0#/g, add_template_id);

                var add_template_element = $($.parseHTML(add_template, true));

                add_template_element.addClass('selected');

                $('#graphic-material-info').find('.add-article-html').removeClass('selected');
                $('#graphic-material-info').append(add_template_element);

                // 增加右侧form表单

                var template = $("#form_template").html();

                template = template.replace(/#0#/g, add_template_id);

                var element = $($.parseHTML(template, true));

                $("#form_list").append(element);

                $('#form_list').find("[id^='form_']").hide();

                $("#form_" + add_template_id).show();

            });

            $("#btn_submit").click(function() {

                // 点击提交默认所有表单全部隐藏
                var form_size = $(".form-horizontal").size();
                for (var i = 1; i <= form_size; i++) {
                    $("#form_" + i).hide();
                }

                var is_valid = true;

                var data = [];

                $("#form_list").find("form").each(function(index, element) {
                    var validator = $(this).validate();
                    $.validator.addRules($("#client_rules").html(), {
                        form: element
                    });

                    if (!validator.form()) {
                        // 把表单div显示出来
                        $(this).show();
                        var template_id = $(this).attr('id').replace(/form_/g, '');
                        $('.add-article-html[data-id='+template_id+']').addClass("selected").siblings().removeClass("selected");
                        is_valid = false;
                        return false;
                    }
                    data.push($(this).serializeJson());
                });
                if (is_valid) {
                    //加载提示
                    if ("{{ $info->id ?? '' }}" == "") {
                        $.ajax({
                            type: "POST",
                            url: "/weixin/material/more-add",
                            dataType: "json",
                            data: {
                                data: data
                            },
                            success: function(result) {
                                if (result.code == 0) {
                                    $.go('/weixin/material/more-list');
                                    $.msg(result.message, {
                                        time: 3000
                                    });
                                }else {
                                    $.msg(result.message, {
                                        time: 5000
                                    });
                                }
                            }
                        });
                    } else {
                        $.ajax({
                            type: "POST",
                            url: "/weixin/material/more-edit?id={{ $info->id ?? '' }}",
                            dataType: "json",
                            data: {
                                data: data
                            },
                            success: function(result) {
                                if (result.code == 0) {
                                    $.go('/weixin/material/more-list');
                                    $.msg(result.message, {
                                        time: 3000
                                    });
                                }else {
                                    $.msg(result.message, {
                                        time: 5000
                                    });
                                }
                            }
                        });
                    }
                }

            });
        });

    </script>

@stop

{{--outside body script--}}
@section('outside_body_script')

@stop