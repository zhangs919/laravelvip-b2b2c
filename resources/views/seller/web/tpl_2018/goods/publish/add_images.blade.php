{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.6"/>
@stop

{{--content--}}
@section('content')

    <div class="table-content">
        <!--步骤-->
        @if($is_publish)
        <ul class="add-goods-step">
            <li id="step_1">
                <i class="fa fa-list-alt step"></i>
                <h6>STEP.1</h6>
                <h2>选择商品分类</h2>
                <i class="fa fa-angle-right"></i>
            </li>
            <li id="step_2">
                <i class="fa fa-edit step"></i>
                <h6>STEP.2</h6>
                <h2>填写商品详情</h2>
                <i class="fa fa-angle-right"></i>
            </li>
            <li id="step_3">
                <i class="fa fa-image step"></i>
                <h6>STEP.3</h6>
                <h2>上传商品图片</h2>
                <i class="fa fa-angle-right"></i>
            </li>
            <li id="step_4">
                <i class="fa fa-check-square-o step"></i>
                <h6>STEP.4</h6>
                <h2>商品发布成功</h2>
            </li>
        </ul>
        <script type="text/javascript">
            $().ready(function(){
                $("#step_3").addClass("current");
            });
        </script>
        @endif

        <!-- 温馨提示 -->
        <div class="content">

            <div class="goods-info-three">
                <div class="col-sm-9">

                    @foreach($spec_list as $v)
                        <div class="goodspic-list image-list">
                            <div class="title">
                                <h3>{{ $spec_name }}：{{ $v['attr_value'] }}</h3>
                            </div>
                            <!-- 容器 -->
                            <div id="goods_images_container_{{ $v['spec_id'] }}" class="goods-images-container" data-spec_id="{{ $v['spec_id'] }}">
                                <ul class="image-group">
                                    <li class="image-group-button" data-label-index="0" title="点击并选择上传的图片">
                                        <div class="image-group-bg"></div>
                                    </li>
                                    <li class="image-group-button" data-label-index="1" title="点击并选择上传的图片">
                                        <div class="image-group-bg"></div>
                                    </li>
                                    <li class="image-group-button" data-label-index="2" title="点击并选择上传的图片">
                                        <div class="image-group-bg"></div>
                                    </li>
                                    <li class="image-group-button" data-label-index="3" title="点击并选择上传的图片">
                                        <div class="image-group-bg"></div>
                                    </li>
                                    <li class="image-group-button" data-label-index="4" title="点击并选择上传的图片">
                                        <div class="image-group-bg"></div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endforeach

                    <div class="goods-next p-b-30 text-c p-l-0">

                        @if(!$is_publish)
                        <input type="button" id="btn_submit" value="确认提交" class="btn btn-primary btn-lg" />
                        @else
                        <input type="button" id="btn_submit" value="下一步，确认商品发布" class="btn btn-primary" />
                        @endif

                        <!--不可点击状态的下一步-->
                        <!--<button class="btn btn-default">下一步，确认商品发布</button>-->
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="pic-upload-request p-15">
                        <h4>上传要求：</h4>
                        <ul>
                            <li>1. 请使用jpg、jpeg、png等格式、单张大小不超过4M的正方形图片。</li>
                            <li>2. 上传图片最大尺寸将被保留为1280像素，建议使用尺寸800*800像素。</li>
                            <li>3. 每种颜色最多5张图片，可上传图片或从图片空间中选择已有的图片，上传后的图片也将被保存在店铺图片空间中以便其它使用。</li>
                            <li>4. 通过更改排序数字修改商品图片的显示顺序。</li>
                            <li>5. 图片质量要清晰，不能虚化，要保证亮度充足。</li>
                            <li>6. 操作完成后请点下一步，否则无法在网站生效。</li>
                        </ul>
                        <h4>建议：</h4>
                        <ul>
                            <li>1. 主图为白色背景正面图。</li>
                            <li>2. 排序依次为正面图-&gt;背面图-&gt;侧面图-&gt;细节图。</li>
                        </ul>
                    </div>
                </div>
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
    <!-- AJAX上传 -->
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=20180418"></script>
    <!-- 图片上传、图片空间 -->
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20180418"></script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">

    </script>
    <script type="text/javascript">
        $().ready(function() {
            window.onscroll = function() {
                $(window).scroll(function() {
                    var scrollTop = $(document).scrollTop();
                    var height = $(".table-content").height();
                    var wHeight = $(window).height();
                    if (scrollTop > (height - wHeight)) {
                        $(".goods-next").removeClass("goods-btn-fixed");
                    } else {
                        $(".goods-next").addClass("goods-btn-fixed");
                    }
                });

            };

            $("#btn_view").click(function() {
                $.go("{{ route('pc_show_goods', ['goods_id'=>$model['goods_id']]) }}", "_blank");
            });
        });
    </script>
    <script id="goods_images_list" type="text">
    {!! json_encode($goods_images) !!}
    </script>
    <script type="text/javascript">
        $().ready(function() {

            var imagegroups = [];

            var images = $.parseJSON($("#goods_images_list").text());

            @foreach($spec_list as $v)
            imagegroups["spec_{{ $v['spec_id'] }}"] = $("#goods_images_container_{{ $v['spec_id'] }}").imagegroup({
                size: 5,
                mode: 1,
                host: "{{ get_oss_host() }}",
                values: images["{{ $v['spec_id'] }}"],
                gallery: true,
            });
            @endforeach

            // 提交
            $("#btn_submit").click(function() {
                var goods_images = {};

                $(".goods-images-container").each(function() {
                    var spec_id = $(this).data("spec_id");
                    var imagegroup = imagegroups["spec_" + spec_id];

                    if (!goods_images[spec_id]) {
                        goods_images[spec_id] = [];
                    }

                    var index = 0;

                    for (var i = 0; i < imagegroup.values.length; i++) {

                        var path = imagegroup.values[i];

                        if (path && path != "") {
                            goods_images[spec_id].push({
                                path: path,
                                is_default: index == 0 ? 1 : 0,
                                sort: i + 1
                            });
                            index++;
                        }
                    }
                });

                var data = {
                    goods_images: goods_images
                };

                // 加载
                $.loading.start();

                $.post('/goods/publish/edit-images?id={{ $model['goods_id'] }}', data, function(result) {
                    // 加载
                    $.loading.stop();

                    if (result.code == 0) {
                        $.msg(result.message, {
                            time: 2000
                        }, function() {
                            // 加载
                            $.loading.start();
                            @if(!$is_publish)
                            $.go('');
                            @else
                            $.go('/goods/publish/success?id={{ $model['goods_id'] }}');
                            @endif
                        });
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, 'json');
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop