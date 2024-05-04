{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')

    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
    <link rel="stylesheet" href="/assets/d2eace91/js/ztree/zTreeStyle.css?v=1.2">
    <!-- -->
    <script src="/assets/d2eace91/js/table/treeTable.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/bootstrap3-editable/js/bootstrap-editable.js?v=1.2"></script>
    <link rel="stylesheet" href="/assets/d2eace91/js/bootstrap3-editable/css/bootstrap-editable.css?v=1.2">
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <div class="common-title">
        <div class="ftitle">
            <h3>团购分类列表</h3>

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


    {{--引入分类列表--}}
    @include('dashboard.activity-category.partials._list')

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
    <script type="text/javascript">
        var tablelist;
        $().ready(function() {
            tablelist = $("#table_list").tablelist();
            // 搜索
            $("#searchForm").submit(function() {
                // 序列化表单为JSON对象
                var data = $(this).serializeJson();
                // Ajax加载数据
                tablelist.load(data);
                // 阻止表单提交
                return false;
            });

            // 删除记录
            $("body").on('click', '.del', function() {
                var id = $(this).data("id");
                tablelist.remove({
                    confirm: '您确定删除这条记录吗？',
                    url: 'delete',
                    data: {
                        id: id
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">

        function switch_callback(result, object, value) {
            if (result.code == 0) {
                var cat_ids = result.ids;
                if ($.isArray(cat_ids)) {
                    for (var i = 0; i < cat_ids.length; i++) {
                        var target = $("#cat_" + cat_ids[i]).find(".ico-switch");
                        tablelist.changeSwitch(target, value);
                    }
                }
            }
        }
        /**
         * 折叠分类列表
         */
        var imgPlus = new Image();
        imgPlus.src = "/assets/d2eace91/images/common/menu_plus.gif";

        var plus_image_url = "/assets/d2eace91/images/common/menu_plus.gif";
        var minus_image_url = "/assets/d2eace91/images/common/menu_minus.gif";

        function change(obj, expand, depth) {
            var tr = null;
            if ($(obj).prop("tagName") == 'TR') {
                tr = obj;
            } else {
                tr = $(obj).parents("tr");
            }
            var image = $(tr).find(".icon-image");

            if (expand == undefined) {
                if ($(image).attr("src") != minus_image_url) {
                    $(image).attr("src", minus_image_url);
                    expand = true;
                } else {
                    $(image).attr("src", plus_image_url);
                    expand = false;
                }
            } else {
                if (expand) {
                    $(image).attr("src", minus_image_url);
                } else {
                    $(image).attr("src", plus_image_url);
                }
            }

            if (depth != undefined && depth != 0) {
                var level = $(tr).data("level");
                console.info(level);
                if (depth > level) {
                    return false;
                }
            }

            var table = $(tr).parents("table");
            var cat_id = $(tr).data("id");
            $(table).find("[data-parent-id='" + cat_id + "']").each(function() {
                if (expand == true) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
                change(this, expand, depth);
            });
        }

        var expand = false;
        selecter = "img[src*='/assets/d2eace91/images/common/menu_minus.gif'],img[src*='/assets/d2eace91/images/common/menu_plus.gif']";
        $(".category-all").html("全部展开");
        $(selecter).parents("tr[class!='1']").hide();
        $(selecter).attr("src", "/assets/d2eace91/images/common/menu_plus.gif");
        /**
         * 展开或折叠所有分类
         * 直接调用了rowClicked()函数，由于其函数内每次都会扫描整张表所以效率会比较低，数据量大会出现卡顿现象
         */

        function expandAll(obj) {

            var table = $(obj).parents("table");
            if (expand) {
                // 收缩
                selecter = "img[src*='/assets/d2eace91/images/common/menu_minus.gif'],img[src*='/assets/d2eace91/images/common/menu_plus.gif']";
                $(obj).html("全部展开");
                $(selecter).parents("tr[class!='1']").hide();
                $(selecter).attr("src", "/assets/d2eace91/images/common/menu_plus.gif");
            } else {
                // 展开
                selecter = "img[src*='/assets/d2eace91/images/common/menu_plus.gif'],img[src*='/assets/d2eace91/images/common/menu_minus.gif']";
                $(obj).html("全部收缩");
                $(selecter).parents("tr").show();
                $(selecter).attr("src", "/assets/d2eace91/images/common/menu_minus.gif");
            }

            // 标识展开/收缩状态
            expand = !expand;
        }
    </script>
    <script type="text/javascript">
        $().ready(function() {
            $(".shop_sort").editable({
                type: "text",
                url: "edit-sort",
                pk: 1,
                // title: "排序",
                ajaxOptions: {
                    type: "post"
                },
                params: function(params) {
                    params.id = $(this).data("cat_id");
                    params.title = "cat_sort";
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