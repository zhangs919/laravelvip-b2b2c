{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20180702"/>

@stop

{{--content--}}
@section('content')

    <!-- 隐藏域 -->
    <input type="hidden" id="articlemodel-article_id" class="form-control" name="ArticleModel[article_id]">
    <div class="table-content m-t-30 clearfix">
        <form id="ArticleModel" class="form-horizontal" name="ArticleModel" action="/article/article/add?cat_model=2" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <!-- 文章分类 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="articlemodel-cat_id" class="col-sm-3 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">文章分类：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">


                            <select name="ArticleModel[cat_id]" class="form-control chosen-select" style="display: none;">

                                <option value="0" selected="true">-- 请选择分类 --</option>

                                @if(!empty($cat_list))
                                    @foreach($cat_list as $v)
                                        <option value="{{ $v['cat_id'] }}" @if(!$v['active']) disabled="true" @endif>{{ $v['title_show'] }}</option>
                                    @endforeach
                                @endif

                            </select>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">显示的文章分类是分类类型为“普通分类”的文章分类</div></div>
                    </div>
                </div>
            </div>

            <!-- 文章标题 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="articlemodel-title" class="col-sm-3 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">文章标题：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">


                            <input type="text" id="articlemodel-title" class="form-control" name="ArticleModel[title]">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">最多输入30个字</div></div>
                    </div>
                </div>
            </div>

            <!-- 关键字 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="articlemodel-keywords" class="col-sm-3 control-label">

                        <span class="ng-binding">关键字：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">


                            <input type="text" id="articlemodel-keywords" class="form-control" name="ArticleModel[keywords]">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">最多输入50个字，多关键词之间用空格或者“,”隔开</div></div>
                    </div>
                </div>
            </div>

            <!-- 发布时间 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="articlemodel-add_time" class="col-sm-3 control-label">

                        <span class="ng-binding">发布时间：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">


                            <input type="text" id="articlemodel-add_time" class="form-control form_datetime" name="ArticleModel[add_time]" value="2018-07-15 19:00:13">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">如果设置了发布时间，则会定时发布；如果未设置，则立即发布</div></div>
                    </div>
                </div>
            </div>

            <!-- 文章来源 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="articlemodel-source" class="col-sm-3 control-label">

                        <span class="ng-binding">来源：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">


                            <input type="text" id="articlemodel-source" class="form-control" name="ArticleModel[source]">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 缩略图 -->

            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="articlemodel-article_thumb" class="col-sm-4 control-label">

                        <span class="ng-binding">文章缩略图：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <div id="imagegroup_container" class="szy-imagegroup"  data-size="1"></div>
                            <input type="hidden" id="articlemodel-article_thumb" class="form-control" name="ArticleModel[article_thumb]">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">文章缩略图展示在PC和手机端的咨询频道文章列表页面，建议上传260*150像素的图片</div></div>
                    </div>
                </div>
            </div>

            <!-- 是否显示 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="articlemodel-is_show" class="col-sm-4 control-label">

                        <span class="ng-binding">是否显示：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="ArticleModel[is_show]" value="0"><label><input type="checkbox" id="articlemodel-is_show" class="form-control b-n" name="ArticleModel[is_show]" value="1" checked data-on-text="是" data-off-text="否"> </label>
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">控制文章是否在PC前台资讯频道文章列表显示</div></div>
                    </div>
                </div>
            </div>

            <!-- 是否推荐 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="articlemodel-is_recommend" class="col-sm-4 control-label">

                        <span class="ng-binding">是否推荐：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="ArticleModel[is_recommend]" value="0"><label><input type="checkbox" id="articlemodel-is_recommend" class="form-control b-n" name="ArticleModel[is_recommend]" value="1" data-on-text="是" data-off-text="否"> </label>
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">控制文章是否在前台文章列表推荐位上展示</div></div>
                    </div>
                </div>
            </div>

            <!-- 文章摘要 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="articlemodel-summary" class="col-sm-3 control-label">

                        <span class="ng-binding">文章摘要：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">


                            <textarea id="articlemodel-summary" class="form-control" name="ArticleModel[summary]" rows="5"></textarea>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">最多输入100个字</div></div>
                    </div>
                </div>
            </div>

            <!-- 文章内容 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="articlemodel-content" class="col-sm-3 control-label">

                        <span class="ng-binding">文章内容：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">


                            <!-- 文本编辑器 -->
                            <textarea id="content" class="form-control" name="ArticleModel[content]" rows="5" style="width:700px; height: 350px;"></textarea>



                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>



            <!--             <div class="simple-form-field">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">
                            <span class="ng-binding">缩略图：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="upload-thumb cur-p" data-target="#upload-thumb-Modal" data-toggle="modal"><img  src="/images/ceshi/c2.jpg" ></img></div>
                        </div>
                    </div>
                </div> -->


            <!--<div class="simple-form-field">
                    <div class="form-group">
                        <label for="text4" class="col-sm-3 control-label">
                            <span class="ng-binding">关联商品：</span>
                        </label>
                        <div class="col-sm-8">
                            <label for="text4" class="control-label">
                                <a class="btn-link" onclick=open_add_goods()>添加相关商品</a>
                            </label>
                        </div>

                    </div>
                </div>
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="text4" class="col-sm-3 control-label"> </label>
                        <div class="goods-list col-sm-8" id="article_goods_list"><ul>

    </ul></div>

                    </div>
                </div>-->


            <!-- 转向连接 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="articlemodel-link" class="col-sm-3 control-label">

                        <span class="ng-binding">转向连接：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">


                            <input type="text" id="articlemodel-link" class="form-control" name="ArticleModel[link]" placeholder="http://">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">设置转向链接，文章内容将不在前台文章页面展示，在前台文章列表页面，点击文章标题，转向链接页面打开</div></div>
                    </div>
                </div>
            </div>

            <!-- 是否允许评论 -->
            <!--  <div class="simple-form-field" >
    <div class="form-group">
    <label for="articlemodel-is_comment" class="col-sm-3 control-label">

    <span class="ng-binding">是否允许评论：</span>
    </label>
    <div class="col-sm-9">
    <div class="form-control-box">

                <label class="control-label control-label-spe">
                    <input type="radio" class="icheck" name="ArticleModel[is_comment]" value="0" > 禁止
                </label>
                <label class="control-label control-label-spe">
                    <input type="radio" class="icheck" name="ArticleModel[is_comment]" value="1" checked> 允许
                </label>

    </div>

    <div class="help-block help-block-t"></div>
    </div>
    </div>
    </div>-->

            <input type="hidden" value="" name="ArticleModel[goods_ids]" id="goods_ids">
            <!-- 排序 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="articlemodel-sort" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">排序：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="articlemodel-sort" class="form-control small" name="ArticleModel[sort]" value="255">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">数字范围0~9999，数字越小越靠前</div></div>
                    </div>
                </div>
            </div>

            <!-- 提交按钮 -->
            <div class="bottom-btn p-b-30">
                <input type="button" class="btn btn-primary btn-lg" id="btn_submit" name="btn_submit" value="确认提交">
            </div>

        </form>

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
    <!--添加相关商品-->

    <div class="modal fade" id="goodsModal" tabindex="-1" role="dialog" aria-labelledby="goodsModalLabel" aria-hidden="true"></div>

    <!-- 时间插件引入 start -->
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.css?v=20180702"/> <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.js?v=20180710"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=20180710"></script>
    <!-- 时间插件引入 end -->

    <a class="totop animation" href="javascript:;"><i class="fa fa-angle-up"></i></a>


    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180710"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180710"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180710"></script>

    <!-- 验证规则 -->
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=20180710"></script>
    <script id="client_rules" type="text">
[{"id": "articlemodel-cat_id", "name": "ArticleModel[cat_id]", "attribute": "cat_id", "rules": {"required":true,"messages":{"required":"文章分类不能为空。"}}},{"id": "articlemodel-title", "name": "ArticleModel[title]", "attribute": "title", "rules": {"required":true,"messages":{"required":"文章标题不能为空。"}}},{"id": "articlemodel-sort", "name": "ArticleModel[sort]", "attribute": "sort", "rules": {"required":true,"messages":{"required":"排序不能为空。"}}},{"id": "articlemodel-article_id", "name": "ArticleModel[article_id]", "attribute": "article_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"文章ID必须是整数。"}}},{"id": "articlemodel-cat_id", "name": "ArticleModel[cat_id]", "attribute": "cat_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"文章分类必须是整数。"}}},{"id": "articlemodel-is_comment", "name": "ArticleModel[is_comment]", "attribute": "is_comment", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否允许评论必须是整数。"}}},{"id": "articlemodel-click_number", "name": "ArticleModel[click_number]", "attribute": "click_number", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"点击量必须是整数。"}}},{"id": "articlemodel-is_show", "name": "ArticleModel[is_show]", "attribute": "is_show", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否显示必须是整数。"}}},{"id": "articlemodel-user_id", "name": "ArticleModel[user_id]", "attribute": "user_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"发布人ID必须是整数。"}}},{"id": "articlemodel-status", "name": "ArticleModel[status]", "attribute": "status", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"审核状态必须是整数。"}}},{"id": "articlemodel-shop_id", "name": "ArticleModel[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Shop Id必须是整数。"}}},{"id": "articlemodel-is_recommend", "name": "ArticleModel[is_recommend]", "attribute": "is_recommend", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否推荐必须是整数。"}}},{"id": "articlemodel-content", "name": "ArticleModel[content]", "attribute": "content", "rules": {"string":true,"messages":{"string":"文章内容必须是一条字符串。"}}},{"id": "articlemodel-goods_ids", "name": "ArticleModel[goods_ids]", "attribute": "goods_ids", "rules": {"string":true,"messages":{"string":"Goods Ids必须是一条字符串。"}}},{"id": "articlemodel-source", "name": "ArticleModel[source]", "attribute": "source", "rules": {"string":true,"messages":{"string":"来源必须是一条字符串。"}}},{"id": "articlemodel-extend_cat", "name": "ArticleModel[extend_cat]", "attribute": "extend_cat", "rules": {"string":true,"messages":{"string":"附加分类必须是一条字符串。"}}},{"id": "articlemodel-link", "name": "ArticleModel[link]", "attribute": "link", "rules": {"url":{"pattern":/^(http|https):\/\/(([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+)(?::\d{1,5})?(?:$|[?\/#])/i,"enableIDN":false,"skipOnEmpty":1},"messages":{"url":"转向连接不是一条有效的URL。"}}},{"id": "articlemodel-title", "name": "ArticleModel[title]", "attribute": "title", "rules": {"string":true,"messages":{"string":"文章标题必须是一条字符串。","maxlength":"文章标题只能包含至多30个字符。"},"maxlength":30}},{"id": "articlemodel-keywords", "name": "ArticleModel[keywords]", "attribute": "keywords", "rules": {"string":true,"messages":{"string":"关键字必须是一条字符串。","maxlength":"关键字只能包含至多50个字符。"},"maxlength":50}},{"id": "articlemodel-summary", "name": "ArticleModel[summary]", "attribute": "summary", "rules": {"string":true,"messages":{"string":"文章摘要必须是一条字符串。","maxlength":"文章摘要只能包含至多100个字符。"},"maxlength":100}},{"id": "articlemodel-article_thumb", "name": "ArticleModel[article_thumb]", "attribute": "article_thumb", "rules": {"string":true,"messages":{"string":"文章缩略图必须是一条字符串。","maxlength":"文章缩略图只能包含至多255个字符。"},"maxlength":255}},{"id": "articlemodel-sort", "name": "ArticleModel[sort]", "attribute": "sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于9999。"},"min":0,"max":9999}},]
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
            var validator = $("#ArticleModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                //加载提示
                $.loading.start();
                $("#ArticleModel").submit();

            });

            $("#imagegroup_container").imagegroup({
                host: "http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/",
                size: $(this).data("size"),
                values: $('#articlemodel-article_thumb').val().split("|"),
                // 回调函数
                callback: function(data) {
                    var values = this.values;
                    if (!values) {
                        values = [];
                    }
                    values = values.join("|");
                    $('#articlemodel-article_thumb').val(values);
                    $.validator.clearError($("#articlemodel-article_thumb"));
                },
                // 移除的回调函数
                remove: function(value, values) {
                    var values = this.values;
                    if (!values) {
                        values = [];
                    }
                    values = values.join("|");
                    $('#articlemodel-article_thumb').val(values);
                }
            });

        });

        /*
         * 删除关联商品
         */
        function del_art_goods(id) {
            var goods_ids_str = $("#goods_ids").val();
            var goods_ids = [];
            if ($("#goods_ids").val() != '') {
                goods_ids = $("#goods_ids").val().split(",");
            }
            goods_ids.splice($.inArray(id.toString(), goods_ids), 1)
            var url = "del-art-goods";
            $.confirm("确定取消此商品关联?", function() {
                $.loading.start();
                $.ajax({
                    type: 'get',
                    async: true, //同步请求
                    url: url,
                    data: {
                        goods_ids: goods_ids
                    },
                    success: function(result) {
                        $("#article_goods_list").html(result);
                        $("#goods_ids").val(goods_ids.join(','));
                        return true;
                    }
                });
                $.loading.stop();
            });

        }

        /**
         * 添加关联商品
         */

        function add_art_goods(goods_ids) {
            $.loading.start();
            var url = "add-art-goods";
            $.ajax({
                type: 'get',
                async: false, //同步请求
                url: url,
                data: {
                    goods_ids: goods_ids
                },
                success: function(result) {
                    $("#article_goods_list").html(result);
                    $("#goods_ids").val(goods_ids.join(','));
                    $.loading.stop();
                    return true;
                }
            });
        }

        function open_add_goods() {
            $.loading.start();
            var url = "add-goods";

            if ($("#goods_ids").val() != '') {
                goods_ids = $("#goods_ids").val().split(",");
            }
            $.ajax({
                type: 'get',
                async: false, //同步请求
                url: url,
                data: {
                    goods_ids: $("#goods_ids").val(),
                    id: '',
                },
                success: function(result) {
                    $("#goodsModal").modal('show');
                    $("#goodsModal").html(result);
                    $.loading.stop();
                    return true;
                },
            });
        }
    </script>
    <script type="text/javascript">
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
        });
    </script>
    <!-- AJAX上传+图片预览 -->
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=20180710"></script>
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=20180710"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20180710"></script>
    <script src="/assets/d2eace91/js/editor/kindeditor-all.min.js?v=20180710"></script>
    <script src="/assets/d2eace91/js/editor/lang/zh_CN.js?v=20180710"></script>

    <script type="text/javascript">
        KindEditor.ready(function(K) {

            var extraFileUploadParams = [];
            extraFileUploadParams['B2B2C_YUNMALL_68MALL_COM_USER_PHPSESSID'] = 'gbk6o8g34ns1bvlf9msvn6un2r';

            window.editor = K.create('#content', {
                width: '100%',
                height: '450px',
                items: ['source', '|', 'fullscreen', 'undo', 'redo', 'print', 'cut', 'copy', 'paste', 'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright', 'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript', 'superscript', '|', 'selectall', 'clearhtml', 'quickformat', '|', 'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'flash', 'media', 'table', 'hr', 'emoticons', 'link', 'unlink', '|', 'about'],
                themesPath: "/assets/d2eace91/js/editor/themes/",
                cssPath: "/assets/d2eace91/js/editor/themes/default/default.css",
                uploadJson: "/site/upload-image",
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

{{--outside body script--}}
@section('outside_body_script')

@stop