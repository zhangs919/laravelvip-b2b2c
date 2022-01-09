{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30 clearfix">
        <form id="Model" class="form-horizontal" name="Model" action="/system/seo/sitemap" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="simple-form-field">
                <div class="form-group">
                    <label class="col-sm-4 control-label">
                        <span class="ng-binding">首页更新频率：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <select class="form-control" id="index_priority">

                                <option value="1">0.1</option>

                                <option value="2">0.2</option>

                                <option value="3">0.3</option>

                                <option value="4">0.4</option>

                                <option value="5">0.5</option>

                                <option value="6">0.6</option>

                                <option value="7">0.7</option>

                                <option value="8">0.8</option>

                                <option value="9">0.9</option>

                            </select>
                            <select class="form-control m-l-5" id="index_changefreq">

                                <option value="1">always</option>

                                <option value="2">hourly</option>

                                <option value="3">daily</option>

                                <option value="4">weekly</option>

                                <option value="5">monthly</option>

                                <option value="6">yearly</option>

                                <option value="7">never</option>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">
                        <span class="ng-binding">分类更新频率：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <select class="form-control" id="category_priority">

                                <option value="1">0.1</option>

                                <option value="2">0.2</option>

                                <option value="3">0.3</option>

                                <option value="4">0.4</option>

                                <option value="5">0.5</option>

                                <option value="6">0.6</option>

                                <option value="7">0.7</option>

                                <option value="8">0.8</option>

                                <option value="9">0.9</option>

                            </select>
                            <select class="form-control m-l-5" id="category_changefreq">

                                <option value="1">always</option>

                                <option value="2">hourly</option>

                                <option value="3">daily</option>

                                <option value="4">weekly</option>

                                <option value="5">monthly</option>

                                <option value="6">yearly</option>

                                <option value="7">never</option>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">
                        <span class="ng-binding">商品更新频率：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <select class="form-control" id="goods_priority">

                                <option value="1">0.1</option>

                                <option value="2">0.2</option>

                                <option value="3">0.3</option>

                                <option value="4">0.4</option>

                                <option value="5">0.5</option>

                                <option value="6">0.6</option>

                                <option value="7">0.7</option>

                                <option value="8">0.8</option>

                                <option value="9">0.9</option>

                            </select>
                            <select class="form-control m-l-5" id="goods_changefreq">

                                <option value="1">always</option>

                                <option value="2">hourly</option>

                                <option value="3">daily</option>

                                <option value="4">weekly</option>

                                <option value="5">monthly</option>

                                <option value="6">yearly</option>

                                <option value="7">never</option>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">
                        <span class="ng-binding">文章更新频率：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <select class="form-control" id="article_priority">

                                <option value="1">0.1</option>

                                <option value="2">0.2</option>

                                <option value="3">0.3</option>

                                <option value="4">0.4</option>

                                <option value="5">0.5</option>

                                <option value="6">0.6</option>

                                <option value="7">0.7</option>

                                <option value="8">0.8</option>

                                <option value="9">0.9</option>

                            </select>
                            <select class="form-control m-l-5" id="article_changefreq">

                                <option value="1">always</option>

                                <option value="2">hourly</option>

                                <option value="3">daily</option>

                                <option value="4">weekly</option>

                                <option value="5">monthly</option>

                                <option value="6">yearly</option>

                                <option value="7">never</option>

                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <div class="form-group">
                    <label class="col-sm-4 control-label"></label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <input type="button" class="btn btn-primary sitemap" value="确认提交">
                        </div>
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
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=1.2"></script>
    <!-- AJAX上传+图片预览 -->
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=1.2"></script>

    <script type="text/javascript">
        $().ready(function() {

            // 退出
            $(".sitemap").click(function() {
                var index_priority = $("#index_priority ").val();
                var index_changefreq = $("#index_changefreq ").val();
                var category_priority = $("#category_priority ").val();
                var category_changefreq = $("#category_changefreq ").val();
                var goods_priority = $("#goods_priority ").val();
                var goods_changefreq = $("#goods_changefreq ").val();
                var article_priority = $("#article_priority ").val();
                var article_changefreq = $("#article_changefreq ").val();
                $.confirm("您确定生成站点地图吗？", function() {
                    $.post("/system/seo/sitemap", {
                        index_priority: index_priority,
                        index_changefreq: index_changefreq,
                        category_priority: category_priority,
                        category_changefreq: category_changefreq,
                        goods_priority: goods_priority,
                        goods_changefreq: goods_changefreq,
                        article_priority: article_priority,
                        article_changefreq: article_changefreq
                    }, function(result) {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }, "JSON");
                })
            });

            /* var validator = $("#Model").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                //加载提示
                $.loading.start();
                //清空文件
                $("#brandmodel-brand_file").val("");
                $("#Model").submit();
    
            }); */

        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop