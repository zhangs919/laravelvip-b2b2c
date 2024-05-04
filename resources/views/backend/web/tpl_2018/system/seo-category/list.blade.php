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

    <div id="table_list" class="table-responsive m-t-10">

        <div class="common-title">
            <div class="ftitle">
                <h3>商品分类列表</h3>

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
        <table id="list-table" class="table table-hover">
            <thead>
            <tr>
                <th class="w300">
                    <a class="expand-toggle category-all" onclick="expandAll(this)">全部收缩</a>
                    分类名称
                </th>
                <th class="w200">title</th>
                <!-- <th>展示方式</th> -->
                <th class="w200" style="cursor: default;">keywords</th>
                <th class="w300" style="cursor: default;">discription</th>
                <th class="handle w100" style="cursor: default;">操作</th>
            </tr>
            </thead>
            <tbody>

            @foreach($list as $v)
            <tr class="{{ $v['cat_level'] }}" data-id="{{ $v['cat_id'] }}" data-parent-id="{{ $v['parent_id'] }}">
                <td>
                    <?php $margin_left = 2.5+5*($v['cat_level']-1); ?>
                    <img src="/assets/d2eace91/images/common/menu_minus.gif" style="margin-left:{{ $margin_left }}em ;" class="icon-image" width="11" height="11" border="0" onclick="change(this)">
                    <a href="javascript:void(0);">{{ $v['cat_name'] }}</a>
                </td>
                <td>{{ $v['title'] }}</td>

                <td>{{ $v['keywords'] }}</td>
                <td>{{ $v['discription'] }}</td>
                <td class="handle">
                    <a href="javascript:void(0);" class="seo-edit" data-cat_id="{{ $v['cat_id'] }}">编辑</a>
                </td>

            </tr>
            @endforeach

            </tbody>
        </table>

        {{--分页--}}
        {!! $pageHtml !!}

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
    <script type="text/javascript">
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

        /**
         * 展开或折叠所有分类
         * 直接调用了rowClicked()函数，由于其函数内每次都会扫描整张表所以效率会比较低，数据量大会出现卡顿现象
         */
        var expand = true;
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

        $().ready(function() {
            var tablelist = $("#table_list").tablelist();
            $("#btn_submit").click(function() {
                tablelist.load({
                    'cat_name': $("#cat_name").val()
                });
                return false;
            });

            //弹出模态框
            $("body").on("click", ".seo-edit", function() {
                var cat_id = $(this).data("cat_id");

                if ($.modal($(this))) {
                    $.modal($(this)).show();
                } else {
                    $.modal({
                        // 标题
                        title: '编辑',
                        width: 550,
                        trigger: $(this),
                        // ajax加载的设置
                        ajax: {
                            url: '/system/seo-category/seo-edit',
                            data: {
                                cat_id: cat_id
                            }
                        },
                    });
                }

            });

        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop