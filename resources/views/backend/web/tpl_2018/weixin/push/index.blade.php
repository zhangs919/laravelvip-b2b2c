{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')

    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
    <link href="../../../assets/d2eace91/js/editor/themes/default/default.css" rel="stylesheet">

    <link rel="stylesheet" href="../../../assets/d2eace91/css/mobile-styles.css?v=1.2">
    <script src="../../../assets/d2eace91/js/editor/kindeditor-all.min.js?v=1.2"></script>
    <script src="../../../assets/d2eace91/js/editor/lang/zh_CN.js?v=1.2"></script>

    <script type="text/javascript">
        KindEditor.ready(function(K) {

            var extraFileUploadParams = [];
            extraFileUploadParams['CP6ZNQ_YUNMALL_LARAVELVIP_COM_BACKEND_PHPSESSID'] = '239ake8n3e2sb93j1c0c0ijgt1';

            window.editor = K.create('#content', {
                width: '100%',
                height: '450px',
                items: ['source', '|', 'fullscreen', 'undo', 'redo', 'print', 'cut', 'copy', 'paste', 'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright', 'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript', 'superscript', '|', 'selectall', 'clearhtml', 'quickformat', '|', 'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'flash', 'media', 'table', 'hr', 'emoticons', 'link', 'unlink', '|', 'about'],
                themesPath: "../../../assets/d2eace91/js/editor/themes/",
                cssPath: "../../../assets/d2eace91/js/editor/themes/default/default.css",
                uploadJson: "/site/upload-image.html",
                extraFileUploadParams: extraFileUploadParams,
                allowImageUpload: true,
                allowFlashUpload: false,
                allowMediaUpload: false,
                allowFileManager: true,
                syncType: "form",
                // 设置粘贴类型，0:禁止粘贴, 1:纯文本粘贴, 2:HTML粘贴
                pasteType: 2,
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
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30 clearfix">
        <form method="post" id="form" action="" class="form-horizontal">
            @csrf
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="ng-binding">信息发送给：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <label class="control-label">
                                <span class="msg-receive">所有人</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="ng-binding">发送内容：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <!--推送框-->
                            <div class="msg-sender-box">
                                <div class="msg-sender-nav">
                                    <ul>
                                        <li class="selected" data-id="1">
                                            <a>
                                                <i class="fa fa-newspaper-o"></i>
                                                <span>图文消息</span>
                                            </a>
                                        </li>
                                        <li data-id="2">
                                            <a>
                                                <i class="fa fa-pencil"></i>
                                                <span>文字</span>
                                            </a>
                                        </li>
                                        <!---
                                      <li data-id="3">
                                          <a>
                                              <i class="fa fa-microphone"></i>
                                              <span>语音</span>
                                          </a>
                                      </li>
                                      <li data-id="4">
                                          <a>
                                              <i class="fa fa-video-camera"></i>
                                              <span>视频</span>
                                          </a>
                                      </li>
                                     -->
                                    </ul>
                                    <input type="hidden" name="msg_type" id="msg_type" value="1">
                                </div>
                                <div class="msg-sender-panel">
                                    <!--图文面板-->
                                    <input type="hidden" name="material_id" id="material_id">
                                    <div class="content-panel image-text" style="display: block">
                                        <div class="row">
                                            <div class="media-cover col-sm-4 single-graphic">
	<span class="create-access">
		<a href="javascript:;" class="select_material" data-id="0">
			<i>+</i>
			<strong>选择单图文素材</strong>
		</a>
	</span>
                                            </div>
                                            <div class="media-cover col-sm-4 single-graphic">
		<span class="create-access">
			<a href="javascript:;" class="select_material" data-id="1">
					<i>+</i>
					<strong>选择多图文素材</strong>
			</a>
		</span>
                                            </div>
                                            <div class="media-cover col-sm-4 single-graphic">
		<span class="create-access">
			<a href="javascript:;" class="add_material">
			<i>+</i>
			<strong>新建图文素材</strong>
			</a>
		</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!--输入文字面板-->
                                    <div class="content-panel text">
                                        <div class="emotion-editor">
                                            <textarea placeholder="" name="content" id="content" style="display: none;"></textarea>
                                        </div>
                                    </div>
                                    <!--语音素材
                                    <div class="content-panel voice"></div>-->
                                    <!--视频素材
                                    <div class="content-panel video"></div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label"></label>
                    <div class="col-xs-8">
                        <a class="btn btn-primary">群发</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script id="material" type="text">
	<div class="row">
	<div class="media-cover col-sm-4 single-graphic">
	<span class="create-access">
		<a href="javascript:;" class="select_material" data-id="0">
			<i>+</i>
			<strong>选择单图文素材</strong>
		</a>
	</span>
	</div>
	<div class="media-cover col-sm-4 single-graphic">
		<span class="create-access">
			<a href="javascript:;" class="select_material" data-id="1">
					<i>+</i>
					<strong>选择多图文素材</strong>
			</a>
		</span>
	</div>
	<div class="media-cover col-sm-4 single-graphic">
		<span class="create-access">
			<a href="javascript:;" class="add_material">
			<i>+</i>
			<strong>新建图文素材</strong>
			</a>
		</span>
	</div>
	</div>
	</script>
    <script type="text/javascript">
        $().ready(function() {
            var html = $("#material").html();
            $(".image-text").html(html);

            $(".btn-primary").click(function() {
                var msg_type = $("#msg_type").val();
                var material_id = $("#material_id").val();
                var content = $("#content").val();
                if (msg_type == 1) {
                    if (material_id == '') {
                        $.msg('请选择图文素材！');
                        return false;
                    }
                } else if (msg_type == 2) {
                    if (content == '') {
                        $.msg('请输入发送内容！');
                        return false;
                    }
                }
                //加载提示
                $.loading.start();
                $("#form").submit();
            });

            /*鼠标点击切换tab*/
            function change_tabs(a, b, c) {
                $(a).click(function() {
                    var msg_type = $(this).data('id');
                    $("#msg_type").val(msg_type);
                    $(this).addClass(c).siblings().removeClass(c);
                    $(b).eq($(this).index()).show().siblings().hide();
                })
            }
            change_tabs(".msg-sender-nav li", ".content-panel", 'selected');

            $("body").on("click", ".link-dele", function() {
                var type = $(this).data('id');
                if (type == 'image-text') {
                    $.confirm('确定要删除此图文素材吗？',function(){
                        $(".image-text").html(html);
                        $("#material_id").val('');
                    });
                }
            });

            // 新建图文
            $("body").on("click", ".add_material", function() {
                $.open({
                    title: '新建图文',
                    width: '960px',
                    ajax: {
                        url: '/weixin/push/add-material'
                    }
                });
            });

            // 选择图文
            $("body").on("click", ".select_material", function() {
                var type = $(this).data("id");

                $.open({
                    title: '图文选择',
                    width: '960px',
                    ajax: {
                        url: '/weixin/push/select-material',
                        data: {
                            type: type
                        }
                    },
                    btn: ['提交'],
                    yes: function() {
                        var material_id = $("#material_id").val();
                        if (material_id == '') {
                            alert('请选择素材');
                            return false;
                        }
                        $.ajax({
                            type: "POST",
                            url: "/weixin/push/select-material",
                            dataType: "json",
                            data: {
                                id: material_id
                            },
                            success: function(result) {
                                if (result.code == 0) {
                                    $.closeAll();
                                    $(".image-text").html(result.data);
                                    $("#material_id").val(result.material_id);
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>


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

@stop

{{--outside body script--}}
@section('outside_body_script')

@stop
