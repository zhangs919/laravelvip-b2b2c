{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
    <link rel="stylesheet" href="/assets/d2eace91/js/ztree/zTreeStyle.css?v=1.2">
    <script src="/assets/d2eace91/js/bootstrap3-editable/js/bootstrap-editable.js?v=1.2"></script>
    <link rel="stylesheet" href="/assets/d2eace91/js/bootstrap3-editable/css/bootstrap-editable.css?v=1.2">
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <!-- 搜索条件 -->
    <div class="search-term  m-b-10">
        <form id="searchForm" action="/article/article-cat/list" method="GET">
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>分类类型：</span>
                    </label>
                    <div class="form-control-wrap">
                        {{--<div class="chosen-container chosen-container-single" title="" id="select_cat_type_chosen">
                            <a class="chosen-single" tabindex="-1"><span>全部分类</span><div><b></b></div></a>
                            <div class="chosen-drop"><div class="chosen-search"><input type="text" autocomplete="off"></div><ul class="chosen-results"></ul></div>
                        </div>--}}

                        <select name="cat_type" class="form-control chosen-select" id="select_cat_type" style="display: none;">
                            <option value="0">全部分类</option>

                            @foreach($cat_types as $k=>$v)
                            <option value="{{ $k }}">{{ $v }}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>分类名称：</span>
                    </label>
                    <div class="form-control-wrap">
                        <!-- <div id="cat_selector"></div> -->
                        <input type="hidden" id="cat_id" name="cat_id" class="form-control">
                        <input type="text" id="cat_name" name="cat_name" class="form-control">
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <input type="submit" id="btn_submit" class="btn btn-primary m-r-5" value="搜索">
            </div>
        </form>
    </div>


    <div class="common-title">
        <div class="ftitle">
            <h3>文章分类列表</h3>

            <h5>
                (&nbsp;共
                <span data-total-record="true" class="pagination-total-record"></span>
                条记录&nbsp;)
            </h5>

        </div>
        <div class="operate m-l-20">

            <a class="reload" href="javascript:reload();" data-toggle="tooltip" data-placement="auto bottom" title="" data-original-title="刷新数据">
                <i class="fa fa-refresh"></i>
            </a>
            <script type="text/javascript">
                function reload() {

                }
            </script>



        </div>
    </div>
    <!-- 分类列表 -->


    {{--引入分类列表--}}
    @include('article.article-cat.partials._list')

@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block page元素同级下面--}}
@section('extra_html')

@stop


{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <script src="/assets/d2eace91/js/ztree/jquery.ztree.all-3.5.min.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/table/jquery.treetable.js?v=1.2"></script>
    <link rel="stylesheet" href="/assets/d2eace91/js/table/css/jquery.treetable.css?v=1.2">
    <link rel="stylesheet" href="/assets/d2eace91/js/table/css/jquery.treetable.theme.default.css?v=1.2">
    <script type="text/javascript">
        /* var catselector = $("#cat_selector").catselector({
         size: 1,
         data: {
         deep: 3
         },
         addCallback: function(id, name, node) {
         this.hide();
         $("#cat_id").val(id);
         $("#btn_submit").click();
         },
         removeCallback: function(id) {
         this.hide();
         $("#cat_id").val("");
         if ($("#cat_id").val() == "") {
         $("#btn_submit").click();
         }
         }
         }); */

        function expandAll() {
            if ($(this).data("expandAll")) {
                $(".treetable").treetable("collapseAll");
                $(this).data("expandAll", false);
            } else {
                $(".treetable").treetable("expandAll");
                $(this).data("expandAll", true);
            }

        }
        var tablelist = null;
        function switch_callback(result, object, value) {
            if (result.code == 0) {
                var cat_ids = result.cat_ids;
                if ($.isArray(cat_ids)) {
                    for (var i = 1; i < cat_ids.length; i++) {
                        var target = $("#article_cat_" + cat_ids[i]).find(".ico-switch");
                        tablelist.changeSwitch(target, value);

                    }
                }
            }
        }
        $().ready(function() {

            $(".treetable").treetable({
                expandable: true,
            });
            tablelist = $("#table_list").tablelist({
                callback: function() {
                    $(".treetable").treetable({
                        expandable: true,
                    });
                }
            });
            //catselector.load();
            // 搜索
            $("#searchForm").submit(function() {
                // 序列化表单为JSON对象
                var data = $(this).serializeJson();
                // Ajax加载数据s
                tablelist.load(data);
                // 阻止表单提交
                return false;
            });
            // 删除记录
            $("body").on('click', '.del', function() {
                var id = $(this).data("cat_id");
                $.confirm('您确定删除这条记录吗？', function() {
                    $.post('/article/article-cat/del-category', {
                        cat_id: id
                    }, function(result) {
                        if (result.code == 0) {
                            $.msg(result.message);
                            if (result.parent_id == 0) {
                                $.loading.start();
                                $.go('/article/article-cat/list');
                            } else {
                                tablelist.load();
                            }
                        } else {
                            $.msg(result.message, {
                                time: 5000
                            })
                        }
                    }, "json");
                })

            });

        });
    </script>

    <script type="text/javascript">
        $().ready(function() {
            $(".cat_sort").editable({
                type: "text",
                url: 'edit-cat-info',
                pk: 1,
                // title: "排序",
                ajaxOptions: {
                    type: "post"
                },
                params: function(params) {
                    params.cat_id = $(this).data("cat_id");
                    params.title = 'cat_sort';
                    return params;
                },
                validate: function(value) {
                    value = $.trim(value);
                    var ex = /^\d+$/;
                    if (!value) {
                        return '排序不能为空。';
                    } else if (!ex.test(value)) {
                        return '排序必须是0~255的正整数。';
                    } else if (value > 255) {
                        return '排序必须是0~255的正整数。';
                    }
                },
                success: function(response, newValue) {
                    var response = eval('(' + response + ')');
                    if (response.code == -1) {
                        return response.message;
                    }
                }
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop