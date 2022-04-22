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

    <div class="table-content">
        <!--步骤-->

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
            <li id="step_3" class="current">
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

        <!-- 温馨提示 -->
        <div class="content">

            <div class="goods-info-three">
                <div class="col-sm-9">

                    <div class="goodspic-list image-list">
                        <div class="title">
                            <h3>规格：无</h3>
                        </div>
                        <ul class="goods-pic-list">
                            <!-- 遍历图片列表 -->

                            <li class="goodspic-upload image-item">
                                <div class="upload-thumb">

                                    <img src="http://images.68mall.com/system/config/default_image/default_goods_image_0.gif">

                                    <!-- 第一个为默认图片 -->
                                    <div class="show-default selected">
                                        <p class="set-default">
                                            <i class="fa fa-check-circle-o"></i>
                                            默认主图
                                        </p>
                                        <a href="javascript:void(0)" class="del del-image" title="移除">X</a>
                                    </div>
                                </div>
                                <div class="upload-info">
                                    <div class="show-sort">
                                        排序：
                                        <input type="text" name="goods_images[default][0][sort]" class="text image-sort" size="1" value="0" maxlength="1">
                                    </div>
                                    <div class="upload-btn">
                                        <a href="javascript:void(0);">
											<span class="image-upload">
												<input type="hidden" name="goods_images[default][0][is_default]" value="1" class="image-default">
												<input type="hidden" name="goods_images[default][0][path]" value="" class="image-path">
											</span>
                                            <p>
                                                <i class="fa fa-upload"></i>
                                                上传
                                            </p>
                                        </a>
                                    </div>
                                </div>
                            </li>

                            <li class="goodspic-upload image-item">
                                <div class="upload-thumb">

                                    <img src="http://images.68mall.com/system/config/default_image/default_goods_image_0.gif">

                                    <!-- 第一个为默认图片 -->
                                    <div class="show-default ">
                                        <p class="set-default">
                                            <i class="fa fa-check-circle-o"></i>
                                            默认主图
                                        </p>
                                        <a href="javascript:void(0)" class="del del-image" title="移除">X</a>
                                    </div>
                                </div>
                                <div class="upload-info">
                                    <div class="show-sort">
                                        排序：
                                        <input type="text" name="goods_images[default][1][sort]" class="text image-sort" size="1" value="0" maxlength="1">
                                    </div>
                                    <div class="upload-btn">
                                        <a href="javascript:void(0);">
											<span class="image-upload">
												<input type="hidden" name="goods_images[default][1][is_default]" value="0" class="image-default">
												<input type="hidden" name="goods_images[default][1][path]" value="" class="image-path">
											</span>
                                            <p>
                                                <i class="fa fa-upload"></i>
                                                上传
                                            </p>
                                        </a>
                                    </div>
                                </div>
                            </li>

                            <li class="goodspic-upload image-item">
                                <div class="upload-thumb">

                                    <img src="http://images.68mall.com/system/config/default_image/default_goods_image_0.gif">

                                    <!-- 第一个为默认图片 -->
                                    <div class="show-default ">
                                        <p class="set-default">
                                            <i class="fa fa-check-circle-o"></i>
                                            默认主图
                                        </p>
                                        <a href="javascript:void(0)" class="del del-image" title="移除">X</a>
                                    </div>
                                </div>
                                <div class="upload-info">
                                    <div class="show-sort">
                                        排序：
                                        <input type="text" name="goods_images[default][2][sort]" class="text image-sort" size="1" value="0" maxlength="1">
                                    </div>
                                    <div class="upload-btn">
                                        <a href="javascript:void(0);">
											<span class="image-upload">
												<input type="hidden" name="goods_images[default][2][is_default]" value="0" class="image-default">
												<input type="hidden" name="goods_images[default][2][path]" value="" class="image-path">
											</span>
                                            <p>
                                                <i class="fa fa-upload"></i>
                                                上传
                                            </p>
                                        </a>
                                    </div>
                                </div>
                            </li>

                            <li class="goodspic-upload image-item">
                                <div class="upload-thumb">

                                    <img src="http://images.68mall.com/system/config/default_image/default_goods_image_0.gif">

                                    <!-- 第一个为默认图片 -->
                                    <div class="show-default ">
                                        <p class="set-default">
                                            <i class="fa fa-check-circle-o"></i>
                                            默认主图
                                        </p>
                                        <a href="javascript:void(0)" class="del del-image" title="移除">X</a>
                                    </div>
                                </div>
                                <div class="upload-info">
                                    <div class="show-sort">
                                        排序：
                                        <input type="text" name="goods_images[default][3][sort]" class="text image-sort" size="1" value="0" maxlength="1">
                                    </div>
                                    <div class="upload-btn">
                                        <a href="javascript:void(0);">
											<span class="image-upload">
												<input type="hidden" name="goods_images[default][3][is_default]" value="0" class="image-default">
												<input type="hidden" name="goods_images[default][3][path]" value="" class="image-path">
											</span>
                                            <p>
                                                <i class="fa fa-upload"></i>
                                                上传
                                            </p>
                                        </a>
                                    </div>
                                </div>
                            </li>

                            <li class="goodspic-upload image-item">
                                <div class="upload-thumb">

                                    <img src="http://images.68mall.com/system/config/default_image/default_goods_image_0.gif">

                                    <!-- 第一个为默认图片 -->
                                    <div class="show-default ">
                                        <p class="set-default">
                                            <i class="fa fa-check-circle-o"></i>
                                            默认主图
                                        </p>
                                        <a href="javascript:void(0)" class="del del-image" title="移除">X</a>
                                    </div>
                                </div>
                                <div class="upload-info">
                                    <div class="show-sort">
                                        排序：
                                        <input type="text" name="goods_images[default][4][sort]" class="text image-sort" size="1" value="0" maxlength="1">
                                    </div>
                                    <div class="upload-btn">
                                        <a href="javascript:void(0);">
											<span class="image-upload">
												<input type="hidden" name="goods_images[default][4][is_default]" value="0" class="image-default">
												<input type="hidden" name="goods_images[default][4][path]" value="" class="image-path">
											</span>
                                            <p>
                                                <i class="fa fa-upload"></i>
                                                上传
                                            </p>
                                        </a>
                                    </div>
                                </div>
                            </li>

                        </ul>
                        <!--新要更换上传图片
                      <ul class="goods-pic-list-update">
                              <li>
                                  <div class="images-thumb">
                                  <span title="删除">删除图片</span>
                                  <a href="/images/ceshi/1.jpg" class="highslide" onclick="return hs.expand(this)">
                                      <img src="/images/ceshi/1.jpg" />
                                  </a>
                                  </div>
                              </li>
                              <li>
                                  <div class="images-thumb">
                                  <span title="删除">删除图片</span>
                                  <a href="/images/ceshi/1.jpg" class="highslide" onclick="return hs.expand(this)">
                                      <img src="/images/ceshi/1.jpg" />
                                  </a>
                                  </div>
                              </li>
                              <li>
                                  <div class="images-thumb">
                                  <span title="删除">删除图片</span>
                                  <a href="/images/ceshi/1.jpg" class="highslide" onclick="return hs.expand(this)">
                                      <img src="/images/ceshi/1.jpg" />
                                  </a>
                                  </div>
                              </li>
                              <li>
                                  <div class="images-thumb">
                                  <span title="删除">删除图片</span>
                                  <a href="/images/ceshi/1.jpg" class="highslide" onclick="return hs.expand(this)">
                                      <img src="/images/ceshi/1.jpg" />
                                  </a>
                                  </div>
                              </li>
                              <li class="image-group-button">
                                  <div class="images-thumb">
                                  <div class="image-group-bg"><i class="fa fa-plus"></i></div>
                                  <input type="file" class="inputstyle">
                                  </div>
                              </li>
                      </ul>
                      -->
                        <div class="select-album">
                            <a href="javascript:void(0);" class="btn btn-primary btn-imagegallery">
                                <i class="fa fa-picture-o"></i>
                                从图片空间选择
                            </a>
                            <div class="imagegallery-container" data-spec-id="default" style="width: 100%;"></div>
                        </div>

                    </div>

                    <div class="goods-next text-c p-l-0">

                        <input type="button" id="btn_submit" value="下一步，确认商品发布" class="btn btn-primary">

                        <!--不可点击状态的下一步-->
                        <!--<button class="btn btn-default">下一步，确认商品发布</button>-->
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="pic-upload-request p-15">
                        <h4>上传要求：</h4>
                        <ul>
                            <li>1. 请使用jpg、jpeg、png等格式，单张大小不超过4M的正方形图片。</li>
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

{{--extra html block page元素同级下面--}}
@section('extra_html')

@stop


{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer script page元素同级下面--}}
@section('footer_script')

    <!-- AJAX上传 -->
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=1.2"></script>
    <!-- 图片上传、图片空间 -->
    <script src="/assets/d2eace91/js/jquery.widget.js?v=1.2"></script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">

    </script>
    <script type="text/javascript">
        $().ready(function() {
            var default_image = "http://images.68mall.com/system/config/default_image/default_goods_image_0.gif";

            // AJAX上传文件
            $("body").on("click", ".image-upload", function() {

                var image = $(this).parents(".image-item").find("img");
                var image_path = $(this).parents(".image-item").find(".image-path");

                $.imageupload({
                    url: '/site/upload-goods-image',
                    callback: function(result) {
                        if (result.code == 0) {
                            $(image).attr("src", result.data.url);
                            $(image_path).val(result.data.path);
                            // 显示提示信息
                            $.msg(result.message);
                        } else if (result.message) {
                            // 显示错误信息
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    }
                });

                return true;
            });

            // 相册空间
            $(".btn-imagegallery").click(function() {

                var container = $(this).parents(".image-list").find(".imagegallery-container");

                var image_list = $(this).parents(".image-list");

                var page_id = "ImageGallery_" + $(container).data("spec-id");

                if (!$.imagegallery(container)) {
                    $(this).html("<i class=\"fa fa-picture-o\"></i>关闭图片空间");
                    if ($(this).data("toggle") == false) {
                        $(container).show();
                        $(this).data("toggle", true);
                        return;
                    }
                    var imagegallery = $(container).imagegallery({
                        data: {
                            page: {
                                page_id: page_id
                            }
                        },
                        click: function(target, path) {
                            var url = $(target).attr("src");

                            $(image_list).find("img").each(function() {
                                if ($(this).attr("src") == default_image) {
                                    $(this).attr("src", url);
                                    $(this).parents(".image-item").find(".image-path").val(path);
                                    return false;
                                }
                            });
                        }
                    });
                } else {
                    if ($(container).is(":hidden")) {
                        $(this).html("<i class=\"fa fa-picture-o\"></i>关闭图片空间");
                        $(container).show();
                    } else {
                        $(this).html("<i class=\"fa fa-picture-o\"></i>从图片空间选择");
                        $(container).hide();
                    }
                }

            });

            // 将图片设置为默认主图
            $(".show-default").click(function() {
                $(this).parents(".image-list").find(".show-default").removeClass("selected");
                $(this).parents(".image-list").find(".image-default").each(function() {
                    $(this).val(0);
                });
                $(this).addClass("selected");
                $(this).parents(".image-item").find(".image-default").val(1);
            });

            // 将图片设置为默认图片
            $(".del-image").click(function() {
                $(this).parents(".image-item").find("img").attr("src", default_image);
                $(this).parents(".image-item").find(".image-path").val("");
            });
        });
    </script>
    <script type="text/javascript">
        $().ready(function() {
            // 提交
            $("#btn_submit").click(function() {
                var goods_images = [];
                var data = $(".image-list").serializeJson();

                // 加载
                $.loading.start();

                $.post('/goods/lib-goods/edit-images?id=6', data, function(result) {
                    // 加载
                    $.loading.stop();

                    if (result.code == 0) {
                        $.msg(result.message, {
                            time: 2000
                        }, function() {
                            // 加载
                            $.loading.start();
                            $.go('/goods/lib-goods/success?id=6');
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