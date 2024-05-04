<link href="/assets/d2eace91/css/image-map.css?v=2.0" rel="stylesheet">
<div id="{{ $page_id }}">
    <!-- 温馨提示 -->
    {{--explain_panel--}}
    @include('layouts.partials.explain_panel')
    <div id="imgMap_{{ $page_id }}" class="hot_area p-10" style="display: none;">
        <!-- 1.图片url显示部分：-->
        <input id="" type="text" class="" readonly="readonly" value="" style="display: none;">
        <!-- 2.图片展示部分：-->
        <div class="drag-img-bg m-r-10" name="imageMap" id="image_map">
            <img src="{{ get_image_url(@$selector_data[0]['path'],'no_default') }}" ref="imageMap" id="photo" style="width: 403px; height: auto; border: 1px solid #ddd;">
        </div>
        <!-- 4.添加热区按钮部分：-->
        <a id="add_hot_area" href="JavaScript:;" class="btn btn-primary btn-sm m-b-10">
            <i class="fa fa-plus"></i>
            添加热区
        </a>
        <!--3.添加热区对应编辑链接列表渲染部分，目前需两者选一：
         1)tablebody样式：-->
        <div style="max-height: 370px; overflow-y: auto;">
            <table>
                <tbody id="areaItems">
                </tbody>
            </table>
        </div>
        <!-- 2)ul样式：
         <ul id="areaItems"></ul>-->
        <!-- 5.热区数据存储（隐藏）：-->
        <input type="hidden" class="" id="hotAreas" name="hotAreas" value='{{ @$selector_data[0]['hot_space'] }}'>
        <div class="clear"></div>
        <!-- 隐藏域 -->
        <input type="hidden" name="path" value="{{ @$selector_data[0]['path'] }}">
        <input type="hidden" name="image_width" value="{{ @$selector_data[0]['image_width'] }}">
        <input type="hidden" name="image_height" value="{{ @$selector_data[0]['image_height'] }}">
    </div>
    <div id="imagegallery_container" class="w800 p-10 m-auto" style="overflow: hidden;"></div>
    <div class="modal-footer pos-r">
        <button type="button" class="btn btn-primary" id="ok" data-dismiss="modal">确定</button>
    </div>
</div>
<!--上传图片-->
<!-- 图片空间选择图片 -->
<script type="text/javascript">
    //
</script>
<script type="text/javascript">
    //
</script>
<style>
    .goods-gallery .list li {
        width: 126.8px;
        height: 127px;
    }
    .goods-gallery .list li a {
        border: none;
        width: 123px;
        height: 123px;
    }
</style>
<script src="/assets/d2eace91/js/jquery.image-maps.js?v=202003261806"></script>
<script>
    $(document).ready(function() {

// 初始化熱區
        <!--  -->
        @if(!empty(@$selector_data[0]['hot_space']))
        $("#imgMap_{{ $page_id }}").show();

        imageMaps.proportionNoSameManual("{{ get_image_url(@$selector_data[0]['path'],'no_default') }}",{
            tag:'tr',
            params:{
//'areaLink':'添加热区时的默认值',
//'areaType':'添加热区时的默认值'
            },
            domCallBack: function(type,link){
                console.info(222);
                return getAreaLink(type,link);
            }
        },1,1,true);

        <!--  -->
        @endif
    });


    function getAreaLink(type,link){
        var html = '';
        $.ajax({
            url: '/site/image-hot-link',
            dataType: 'json',
            async: false,
            data: {
                link_type: type,
                link: link,
                style: 1
            },
            success: function(result){
                html = '<td class="w350"><div class="h40 p-t-5"><span class="pull-left p-t-5">链接：</span>'+ result.data + '</div>';
            }
        });
        return html;
    }
    //



    //商品相册
    $().ready(function() {
        var type = '{{ $data['type'] }}';
        var cat_id = '{{ $data['cat_id'] }}';
        var uid = '{{ $data['uid'] }}';
        $("#{{ $page_id }}").find("#ok").click(function() {
            chk_value = [];
            var hot_space = '';

            var data = [];
            var error = [];

            var path = $("#imgMap_{{ $page_id }}").find('input[name="path"]').val();
            var image_width = $("#imgMap_{{ $page_id }}").find('input[name="image_width"]').val();
            var image_height = $("#imgMap_{{ $page_id }}").find('input[name="image_height"]').val();

            if(path == ''){
                error.push('请选择图片');
            }

            $.each($("#imgMap_{{ $page_id }}").find('.area_item'), function(i, v) {
                var areaTitle = '热区'+ $(v).attr('ref');
                var areaLink = $(v).find('.areaLinkInfo').val();
                var areaLinkType = $(v).find('.areaLinkType').val();
                var areaMapInfo = $(v).find('.areaMapInfo').val();
                if(areaLink == ''){
                    error.push(areaTitle+ '链接不能为空');
                }
                if(areaMapInfo == ''){
                    error.push(areaTitle+ '位置不能为空');
                }
                data.push({
                    areaTitle: areaTitle,
                    areaLinkType: areaLinkType,
                    areaLink: areaLink,
                    areaMapInfo: areaMapInfo
                });
            });

            if(data.length == 0){
                error.push('至少添加一个热区');
            }

            hot_space = JSON.stringify(data);

            if(error.length > 0){
                $.msg(error.join('<br/>'));
                return false;
            }else{
                chk_value.push({
                    path: path,
                    image_width: image_width,
                    image_height: image_height,
                    hot_space: hot_space
                });
//上传数据
                $.designadddata({
                    data: {
                        uid: uid,
                        type: type,
                        cat_id: cat_id,
                        chk_value: chk_value,
                    },
                });
            }
        });

        var container = $("#{{ $page_id }}").find("#imagegallery_container");

        if (!$.imagegallery(container)) {

            var imagegallery = $(container).imagegallery({
                open_upload: true,
                data: {
                    page: {
                        page_id: "ImageGallery__{{ $page_id }}"
                    }
                },
                click: function(target, path) {
// 如果是修改
                    var image_url = $(target).data("url");
                    var image_width = $(target).data('width');
                    var image_height = $(target).data("height");

                    $("#imgMap_{{ $page_id }}").find('input[name="path"]').val(path);
                    $("#imgMap_{{ $page_id }}").find('input[name="image_width"]').val(image_width);
                    $("#imgMap_{{ $page_id }}").find('input[name="image_height"]').val(image_height);
                    $('#imgMap_{{ $page_id }}').find('img').attr('src',image_url);
                    $("#imgMap_{{ $page_id }}").show();
                    imageMaps.proportionNoSameManual(image_url,{
                        tag:'tr',
                        params:{
//'areaLink':'添加热区时的默认值',
//'areaType':'添加热区时的默认值'
                        },
                        domCallBack: function(type,link){
                            return getAreaLink(type,link);
                        }
                    },1,1,true);

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

        $("#{{ $page_id }}").find("#btn_upload_goods_image").click(function() {
            $("#{{ $page_id }}").find("#upload_image").modal();
        });

// 上传
        $("#{{ $page_id }}").on("change", "#upload_file", function() {
            var file_id = $(this).attr("id");
            if ($(this).val().length > 0) {
                var data = $("#{{ $page_id }}").find("#uploadForm").serializeJson();
                $.ajaxFileUpload({
                    url: '/site/upload-image',
                    fileElementId: file_id,
                    dataType: 'json',
                    data: data,
                    success: function(result, status) {
                        if (result.code == 0 && result.data) {
                            var path = result.data.path;
                            var image_url = "{{ get_oss_host() }}/" + path;

                            $("#goods_image_tag").attr("src", image_url);
// 原图路径
                            $("#goodsmodel-goods_image").val(path);
                            $("#goods_image_tag").parent("a").attr("href", "{{ get_oss_host() }}/" + path);
                            $.msg(result.message);

                        } else if (result.message) {
                            $.msg(result.message, {
                                time: 5000
                            })
                        }
                    },
                });
            }
            return true;
        });
    });

    function isJSON(str) {
        if (typeof str == 'string') {
            try {
                var obj = JSON.parse(str);
                if (typeof obj == 'object' && obj) {
                    return true;
                } else {
                    return false;
                }

            } catch (e) {
                console.log('error：' + str + '!!!' + e);
                return false;
            }
        }
        console.log('It is not a string!')
    }

    //
</script>