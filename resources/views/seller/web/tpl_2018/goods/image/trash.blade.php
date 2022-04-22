{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20180702"/>
@stop

{{--content--}}
@section('content')

    <div class="common-title">
        <div class="ftitle">
            <h3>回收站图片列表</h3>

            <h5>
                (&nbsp;共
                <span data-total-record=true></span>
                条记录&nbsp;)
            </h5>

        </div>
        <div class="operate m-l-20">

            <a class="reload" href="javascript:tablelist.load();" data-toggle="tooltip" data-placement="auto bottom" title="刷新数据">
                <i class="fa fa-refresh"></i>
            </a>



        </div>
    </div>

    {{--引入列表--}}
    @include('goods.image.partials._trash_list')
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
            tablelist = $("#table_list").tablelist();

            // 还原图片
            $('body').on("click", ".recover-image", function() {
                var ids = $(this).data("id");

                if (!ids) {
                    ids = tablelist.checkedValues();
                }

                if (!ids || ids.length == 0) {
                    $.msg("请选择您要还原的图片！");
                    return;
                }

                $.confirm("您确定要还原选择的图片吗？！", function() {
                    //加载提示
                    $.loading.start();
                    $.post('/goods/image/recover', {
                        ids: ids,
                    }, function(result) {
                        if (result.code == 0) {
                            $.msg(result.message);
                            tablelist.load();
                        } else {
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    }, 'json').always(function() {
                        $.loading.stop();
                    });
                });
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

            // 销毁图片
            $('body').on("click", ".destroy-image", function() {
                var ids = $(this).data("id");

                if (!ids) {
                    ids = tablelist.checkedValues();
                }

                if (!ids || ids.length == 0) {
                    $.msg("请选择您要彻底删除的图片！");
                    return;
                }

                $.confirm("您确定要彻底删除选择的图片吗？彻底删除后将无法恢复，并且会影响到前台影响到此图片的地方！", function() {
                    //加载提示
                    $.loading.start();
                    $.post('/goods/image/destroy', {
                        ids: ids,
                    }, function(result) {
                        if (result.code == 0) {
                            $.msg(result.message);
                            tablelist.load();
                        } else {
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    }, 'json').always(function() {
                        $.loading.stop();
                    });
                });
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop