{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
    <script src="/assets/d2eace91/js/bootstrap3-editable/js/bootstrap-editable.js?v=1.2"></script>
    <link rel="stylesheet" href="/assets/d2eace91/js/bootstrap3-editable/css/bootstrap-editable.css?v=1.2">
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <!-- 搜索条件 -->
    <div class="search-term m-b-10">
        <div class="simple-form-field simple-form-search">
            <div class="form-group">
                <label class="control-label">
                    <i class="fa fa-search"></i>
                </label>
            </div>
        </div>
        <div class="simple-form-field">
            <div class="form-group">
                <label class="control-label">
                    <span>分类名称：</span>
                </label>
                <div class="form-control-wrap">
                    <input type="text" id="cls_name" class="form-control">
                </div>
            </div>
        </div>
        <div class="simple-form-field">
            <input type="button" id="btn_submit" class="btn btn-primary" value="搜索">
        </div>
    </div>


    <!-- 分类列表 -->
    <div id="table_list" class="table-responsive">

        <div class="common-title">
            <div class="ftitle">
                <h3>店铺分类列表</h3>

                <h5>
                    (&nbsp;共
                    <span data-total-record="true"></span>
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

        {{--引入列表--}}
        @include('shop.shop-class.partials._list')




    </div>



    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=1.2"></script>
    <link rel="stylesheet" href="/assets/d2eace91/js/table/css/jquery.treetable.css?v=1.2">
    <link rel="stylesheet" href="/assets/d2eace91/js/table/css/jquery.treetable.theme.default.css?v=1.2">
    <script src="/assets/d2eace91/js/table/jquery.treetable.js?v=1.2"></script>
    <script type="text/javascript">
        /**
         * 折叠分类列表
         */
        var imgPlus = new Image();
        imgPlus.src = "/assets/d2eace91/images/common/menu_plus.gif";

        function rowClicked(obj) {

            // 当前图像
            img = obj;
            // 取得上二级tr>td>img对象
            obj = obj.parentNode.parentNode;
            // 整个分类列表表格
            var tbl = document.getElementById("list-table");
            // 当前分类级别
            var lvl = parseInt(obj.className);
            // 是否找到元素
            var fnd = false;
            var sub_display = img.src.indexOf('/assets/d2eace91/images/common/menu_minus.gif') > 0 ? 'none' : 'table-row';
            // 遍历所有的分类
            for (i = 0; i < tbl.rows.length; i++) {
                var row = tbl.rows[i];
                if (row == obj) {
                    // 找到当前行
                    fnd = true;
                } else {
                    if (fnd == true) {
                        var cur = parseInt(row.className);
                        var icon = 'icon_' + row.id;
                        if (cur > lvl) {
                            row.style.display = sub_display;
                            if (sub_display != 'none') {
                                var iconimg = document.getElementById(icon);
                                iconimg.src = iconimg.src.replace('plus.gif', 'minus.gif');
                            }
                        } else {
                            fnd = false;
                            break;
                        }
                    }
                }
            }

            for (i = 0; i < obj.cells[0].childNodes.length; i++) {
                var imgObj = obj.cells[0].childNodes[i];
                if (imgObj.tagName == "IMG" && imgObj.src != '/assets/d2eace91/images/common/menu_plus.gif') {
                    imgObj.src = (imgObj.src == imgPlus.src) ? '/assets/d2eace91/images/common/menu_minus.gif' : imgPlus.src;
                }
            }
        }
        /**
         * 展开或折叠所有分类
         * 直接调用了rowClicked()函数，由于其函数内每次都会扫描整张表所以效率会比较低，数据量大会出现卡顿现象
         */
        var expand = true;
        function expandAll(obj) {

            var selecter;

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

        $().ready(function() {
            var tablelist = $("#table_list").tablelist();
            $("#btn_submit").click(function() {
                tablelist.load({
                    'cls_name': $("#cls_name").val()
                });
                return false;
            });

            //删除记录
            $("body").on('click', '.del', function() {
                var id = $(this).data("cls-id");
                var name = $(this).data("cls-name");
                $.confirm('您确定删除店铺分类【' + name + '】吗？', function() {
                    $.post('/shop/shop-class/delete', {
                        id: id
                    }, function(result) {
                        if (result.code == 0) {
                            $.msg(result.message);
                            if (result.parent_id == 0) {
                                $.loading.start();
                                $.go('/shop/shop-class/list');
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

            $("body").on("click", ".upload-img", function() {
                var image = $(this).siblings("a");
                var span = $(this);
                $.imageupload({
                    url: $(this).data("url"),
                    data: {
                        id: $(this).data("id")
                    },
                    callback: function(result) {
                        if (result.code == 0) {
                            $(image).attr("ref", result.data.url);
                            $(span).html("更换");
                            $(span).attr("class", "btn btn-success btn-xs pos-r upload-img");
                            $.msg(result.message, {
                                time: 2000
                            });
                        } else {
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    }
                });
            });

            expandAll();
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {

            $(".cls_sort").editable({
                type: "text",
                url: "/shop/shop-class/edit-shop-class-info",
                pk: 1,
                // title: "排序",
                ajaxOptions: {
                    type: "post"
                },
                params: function(params) {
                    params.cls_id = $(this).data("cls_id");
                    params.title = 'cls_sort';
                    return params;
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

@stop

{{--outside body script--}}
@section('outside_body_script')

@stop