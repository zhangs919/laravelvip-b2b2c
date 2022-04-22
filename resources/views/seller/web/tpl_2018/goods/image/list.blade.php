{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20180702"/>
@stop

{{--content--}}
@section('content')

    <div class="picture-title">
        <div class="pull-left">
            <span class="m-r-5">批量处理</span>
            <a class="btn btn-primary btn-xs m-r-2 check-all">
                <i class="fa fa-check-square-o"></i>
                全选
            </a>
            <a class="btn btn-primary btn-xs m-r-2 cancel-checked">
                <i class="fa fa-square-o"></i>
                取消
            </a>
            <a class="btn btn-primary btn-xs m-r-2 delete-image">
                <i class="fa fa-trash-o"></i>
                删除
            </a>
            <a class="btn btn-primary btn-xs m-r-2 move-image">
                <i class="fa fa-arrows"></i>
                移动
            </a>
            <!--
            <a class="btn btn-primary btn-xs m-r-2 watermark-image">
                <i class="fa fa-paste"></i>
                水印
            </a>
            <a class="btn btn-primary btn-xs m-r-2 make-image">
                <i class="fa fa-floppy-o"></i>
                生成
            </a>
             -->
        </div>
        <div class="pull-right text-r">
            <!--
            <select class="form-control form-control-xs w90">
                <option value="0">不区分引用</option>
                <option value="1">引用</option>
                <option value="2">未引用</option>
            </select>
             -->
            <select id="sortname" class="form-control form-control-sm w150 m-l-5 m-r-5">
                <option value="0">按上传时间从晚到早</option>
                <option value="1">按上传时间从早到晚</option>
                <option value="2">按图片从大到小</option>
                <option value="3">按图片从小到大</option>
                <option value="4">按图片名升序</option>
                <option value="5">按图片名降序</option>
            </select>
            <span>
			<input type="text" id="image_name" class="form-control form-control-sm w150"  placeholder="请输入图片名称" />
			<a class="btn btn-primary btn-sm m-r-2 image-search">
				<i class="fa fa-search"></i>
				搜索
			</a>
		</span>
            <div class="btn-group m-l-10 va-top" style="padding-top: 2px;">
                <a href="javascript:void(0);" class="btn btn-default btn-sm br-1 toggle-type active" data-type="0" title="大图模式">
                    <i class="fa fa-th-large m-r-0"></i>
                </a>
                <a href="javascript:void(0);" class="btn btn-default btn-sm br-1 toggle-type " data-type="1" title="列表模式">
                    <i class="fa fa-th-list m-r-0"></i>
                </a>
            </div>
        </div>
    </div>


    {{--引入列表--}}
    @include('goods.image.partials._list_0')

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
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=20180710"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20180710"></script>
    <!-- AJAX上传+图片预览 -->
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=20180710"></script>
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=20180710"></script>
    <script type="text/javascript">
        var tablelist = null;
        $().ready(function() {

            // 缓载
            function lazyload() {
                $(".lazy").each(function() {
                    var url = $(this).data("original");

                    if (url.indexOf("?") == -1) {
                        url = url + "?k=" + new Date().getTime();
                    } else {
                        url = url + "&k=" + new Date().getTime();
                    }

                    $(this).attr("src", url);
                })
            }

            lazyload();

            tablelist = $("#table_list").tablelist({
                dataCallback: function(data) {
                    data.dir_id = "{{ $dir_id }}";
                    data.sort_name = $("#sortname").val();
                    data.image_name = $.trim($("#image_name").val());
                    return data;
                },
                callback: function() {
                    lazyload();
                }
            });

            // 按图片名称搜索
            $("body").on("click", ".image-search", function() {
                tablelist.load();
            });

            $(".toggle-type").click(function() {
                $(this).parents("div").find("a").removeClass("active");
                $(this).addClass("active");
                var type = $(this).data("type");

                tablelist.load({
                    dir_id: "{{ $dir_id }}",
                    type: type
                });
            });

            $(".check-all").click(function() {
                $("#table_list").find(".checkbox").prop("checked", true);
            });

            $(".cancel-checked").click(function() {
                $("#table_list").find(".checkbox").prop("checked", false);
            });

            function checkedValues() {
                var ids = [];
                $(".checkbox:checked").each(function() {
                    ids.push($(this).val());
                });
                return ids;
            }

            // 上传图片
            $("#btn_upload_image").click(function() {
                $.imageupload({
                    url: '/site/image-gallery',
                    // 是否允许上传多个图片
                    multiple: true,
                    // 验证规则
                    options: null,
                    // 提交的数据
                    data: {
                        dir_id: "{{ $dir_id }}"
                    },
                    // 上传后的回调函数
                    // @params result 返回的数据
                    callback: function(result) {
                        tablelist.load();
                        $.msg(result.message, {
                            time: 3000
                        });
                    }
                });
            });

            // 删除选择的图片
            $('body').on("click", ".delete-image", function() {
                var id = $(this).data("id");
                var img_ids = [];
                if (id) {
                    img_ids = [id];
                } else {
                    img_ids = checkedValues();
                }
                if (img_ids.length == 0) {
                    $.msg('请选择要删除的图片！');
                    return;
                }

                $.confirm('被删除的图片将被放入图片空间回收站，您可以在回收站彻底销毁图片或者还原。您确定要删除选择的图片吗？', function() {
                    //加载提示
                    $.loading.start();
                    $.post('delete', {
                        ids: img_ids,
                    }, function(result) {
                        $.loading.stop();
                        if (result.code == 0) {
                            $.msg(result.message);
                            tablelist.load();
                        } else {
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    }, 'json');
                })
            });

            // 设为封面
            $('body').on("click", ".cover-image", function() {
                var id = $(this).data("id");
                if (!id) {
                    var img_ids = checkedValues();
                    id = img_ids[0];
                }
                if (!id) {
                    $.msg('请选择要设为封面的图片！');
                    return;
                }

                //加载提示
                $.loading.start();
                $.post('cover', {
                    id: id,
                }, function(result) {
                    $.loading.stop();
                    if (result.code == 0) {
                        $.msg(result.message);
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, 'json');

            });

            // 移动图片
            $('body').on("click", ".move-image", function() {

                var id = $(this).data("id");

                var img_ids = [];

                if (id) {
                    img_ids = [id];
                } else {
                    $(".checkbox:checked").each(function() {
                        img_ids.push($(this).val());
                    });
                }

                if (img_ids.length == 0) {
                    $.msg('请选择要移动的图片！');
                    return;
                }

                if ($.modal($(this))) {
                    $.modal($(this)).show();
                } else {
                    $.modal({
                        title: "选择图片移动至的目标相册",
                        trigger: $(this),
                        width: 500,
                        params: {
                            img_ids: img_ids,
                            tablelist: tablelist
                        },
                        ajax: {
                            url: 'move',
                        }
                    });
                }
            });

            // 移动图片
            $('body').on("click", ".edit-name", function() {

                var id = $(this).data("id");

                if ($.modal($(this))) {
                    $.modal($(this)).show();
                } else {
                    $.modal({
                        title: "修改图片名称",
                        trigger: $(this),
                        width: 600,
                        params: {
                            tablelist: tablelist
                        },
                        ajax: {
                            url: 'edit-name',
                            data: {
                                id: id
                            },
                        }
                    });
                }
            });

            // 移动图片
            $('body').on("click", ".make-image", function() {
                var checkedValues = checkedValues();

            });

            // 替换图片
            $('body').on("click", ".replace-image", function() {
                var id = $(this).data("id");
                $.imageupload({
                    url: '/goods/image/replace',
                    // 提交的数据
                    data: {
                        id: id
                    },
                    // 上传后的回调函数
                    // @params result 返回的数据
                    callback: function(result) {
                        if (result.code == 0) {
                            $.msg(result.message);
                            tablelist.load();
                        } else {
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    }
                });
            });

            // 排序
            $("#sortname").change(function() {
                var sort = $(this).val();

                var data = {};

                switch (sort) {
                    case "1":
                        // 按上传时间从早到晚
                        data = {
                            sortname: 'i.add_time',
                            sortorder: 'asc',
                        };
                        break;
                    case "2":
                        // 按图片从大到小
                        data = {
                            sortname: 'i.size',
                            sortorder: 'desc',
                        };
                        break;
                    case "3":
                        // 按图片从小到大
                        data = {
                            sortname: 'i.size',
                            sortorder: 'asc',
                        };
                        break;
                    case "4":
                        // 按图片名升序
                        data = {
                            sortname: 'i.name',
                            sortorder: 'asc',
                        };
                        break;
                    case "5":
                        // 按图片名降序
                        data = {
                            sortname: 'i.name',
                            sortorder: 'desc',
                        };
                        break;
                    default:
                        // 按上传时间从晚到早
                        data = {
                            sortname: 'i.add_time',
                            sortorder: 'desc',
                        };
                        break;
                }

                tablelist.load(data);
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop