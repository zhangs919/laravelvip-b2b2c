<style>
    .pic-view{ position: relative; width: 54px; height: 54px; padding:2px; display:block;box-sizing:border-box; }
    .pic-edit{ position:absolute;top:0;left:0;right:0;bottom:0;opacity:0;-webkit-transition:opacity 0.3s ease;-moz-transition:opacity 0.3s ease;
        transition:opacity 0.3s ease;background-size:10px 10px;background-image:-webkit-linear-gradient(45deg,#248DC1 25%, transparent 25%, transparent 50%, #248DC1 50%, #248DC1 75%, transparent 75%, transparent);
        background-image:-moz-linear-gradient(45deg, #248DC1 25%, transparent 25%, transparent 50%, #248DC1 50%, #248DC1 75%, transparent 75%, transparent);
        background-image:linear-gradient(45deg, #248DC1 25%, transparent 25%, transparent 50%,#248DC1) 50%, #248DC1 75%, transparent 75%, transparent);
        -webkit-animation:barberpole 0.5s linear infinite;-moz-animation:barberpole 0.5s linear infinite;animation:barberpole 0.5s linear infinite; }
    @-webkit-keyframes barberpole{
        from{
            background-position:0 0;
        }
        to{
            background-position:20px 10px;
        }
    }

    @-moz-keyframes barberpole{
        from{
            background-position:0 0;
        }
        to{
            background-position:20px 10px;
        }
    }

    @keyframes barberpole{
        from{
            background-position:0 0;
        }
        to{
            background-position:20px 10px;
        }
    }
    .pic-view.edit .pic-edit{ opacity: 1;}
    .pic-view img{ position: relative; z-index: 2; display:block;}
    .pic-view span.image-group-edit{ display: none; width: 100%; left: 0px; bottom: 0px; position: absolute; height:50px; line-height: 50px; filter: alpha(opacity=0.7); -moz-opacity: 0.7; opacity: 0.7; filter: progid:DXImageTransform.Microsoft.Alpha(opacity=70); color: #fff; background: none repeat scroll 0 0 #000000; text-align: center; cursor: pointer; overflow: hidden; z-index: 3;}
    .pic-view:hover span.image-group-edit{ display: block}
    .pic-view.edit:hover span.image-group-edit{ display:none;}
</style>

<div id="{{ $page_id }}">
    <!-- 温馨提示 -->

    <div class="explanation m-b-10">
        <div class="title">
            <i class="arrow-icon explain-checkZoom cur-p" title=""></i>
            <i class="fa fa-bullhorn"></i>
            <h4>温馨提示</h4>
        </div>
        <ul class="explain-panel">
            <li>
                <span>为达到页面效果，建议上传{{ $templateCat['number'] ?? 0 }}张 {{ $templateCat['width'] ?? 0 }}*{{ $templateCat['height'] ?? 0 }}</span>
            </li>

        </ul>
    </div>


    <table id="addPicTable" class="table table-hover">
        <thead>
        <tr>
            <th>图片</th>
            <th>图片链接</th>
            <th>排序</th>
            <th class="handle">操作</th>
        </tr>
        </thead>
        <tbody>

        @if(!empty($selector_data))
            @foreach($selector_data as $v)
                <tr>
                    <td>
                        <a href="javascript:void(0);" ref="{{ get_image_url($v['path']) }}" class="pic-view m-l-5" data-toggle="tooltip" data-placement="auto bottom">
                            <div class="pic-edit"></div>
                            <img class="w50 h50" src="{{ get_image_url($v['path']) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320">
                            <span class="image-group-edit">编辑</span>
                        </a>

                        <input type="hidden" name="path" value="{{ $v['path'] }}">
                        <input type="hidden" name="image_width" value="{{ $v['image_width'] }}">
                        <input type="hidden" name="image_height" value="{{ $v['image_height'] }}">
                    </td>
                    <td>
                        <div id="{{ $v['link_id'] }}">
                            <input type="hidden" id="select_width" value="w300">
                            <input type="hidden" id="page_code" value="{{ $page }}">
                            <select class="form-control w100 " id="link_type" name="link_type">

                                @foreach(link_type() as $lk=>$lv)
                                    <option value="{{ $lk }}" @if($lk == $v['link_type']) selected="selected" @endif>{{ $lv }}</option>
                                @endforeach

                            </select>
                            <span id="link_change">
                                <select name="link" class="form-control chosen-select">

                                </select>
                            </span>
                        </div>
                        <!-- 处理切换连接类型 -->
                        <script type="text/javascript">
                            $().ready(function() {
                                $('#{{ $v['link_id'] }}').hide();
                                $.ajax({
                                    type: 'get',
                                    url: 'change-link-type',
                                    dataType: 'json',
                                    data: {
                                        link_type: '{{ $v['link_type'] }}',
                                        link: '{{ $v['link'] }}',
                                        select_width: 'w300',
                                        page: '{{ $page }}',
                                    },
                                    success: function(result) {
                                        $('#{{ $v['link_id'] }}').find('#link_change').html(result.data);
                                        $('#{{ $v['link_id'] }}').find('.chosen-select').chosen();
                                        $('#{{ $v['link_id'] }}').find('.chosen-container').addClass('w300');
                                        $('#{{ $v['link_id'] }}').show();
                                    },
                                });
                            });
                        </script>
                        <script type="text/javascript">
                            $().ready(function() {
                                $('#{{ $v['link_id'] }}').find('#link_type').change(function() {
                                    var link_type = $(this).val();
                                    var select_width = $('#{{ $v['link_id'] }}').find('#select_width').val();
                                    var page = $('#{{ $v['link_id'] }}').find('#page_code').val();
                                    //var link = $('#{{ $v['link_id'] }}').find("[name='link']").val();
                                    $.ajax({
                                        type: 'get',
                                        url: 'change-link-type',
                                        dataType: 'json',
                                        data: {
                                            link_type: link_type,
                                            select_width: select_width,
                                            page: page,
                                        },
                                        success: function(result) {
                                            $('#{{ $v['link_id'] }}').find('#link_change').html(result.data);
                                            $('#{{ $v['link_id'] }}').find('.chosen-select').chosen();
                                            $('#{{ $v['link_id'] }}').find('.chosen-container').addClass('w300');
                                        },
                                    });
                                });
                            });
                        </script>
                    </td>
                    <td>
                        <input class="form-control small" type="text" value="{{ $v['sort'] }}" name="sort">
                    </td>
                    <td class="handle">
                        <a class="pic-del del" href="javascript:void(0);">删除</a>
                    </td>
                </tr>
            @endforeach
        @endif

        </tbody>
    </table>
    <div id="imagegallery_container" style="overflow: hidden;"></div>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="ok" data-dismiss="modal">确定</button>
    </div>

    @foreach($selector_empty_data as $k=>$v)
        <div id="td_link_{{ $k+1 }}" class="hide">
            <div id="{{ $v['td_link_id'] }}">
                <input type="hidden" id="select_width" value="w300">
                <input type="hidden" id="page_code" value="{{ $page }}">
                <select class="form-control w100 " id="link_type" name="link_type">

                    @foreach(link_type() as $lk=>$lv)
                        <option value="{{ $lk }}" @if($lk == 0) selected="selected" @endif>{{ $lv }}</option>
                    @endforeach

                </select>
                <span id="link_change">
                    <input class="form-control w180" type="text" name="link" value="" placeholder="输入链接地址">
                </span>
            </div>
            <!-- 处理切换连接类型 -->
            <script type="text/javascript">
                $().ready(function() {
                    $('#{{ $v['td_link_id'] }}').find('#link_type').change(function() {
                        var link_type = $(this).val();
                        var select_width = $('#{{ $v['td_link_id'] }}').find('#select_width').val();
                        var page = $('#{{ $v['td_link_id'] }}').find('#page_code').val();
                        //var link = $('#{{ $v['td_link_id'] }}').find("[name='link']").val();
                        $.ajax({
                            type: 'get',
                            url: 'change-link-type',
                            dataType: 'json',
                            data: {
                                link_type: link_type,
                                select_width: select_width,
                                page: page,
                            },
                            success: function(result) {
                                $('#{{ $v['td_link_id'] }}').find('#link_change').html(result.data);
                                $('#{{ $v['td_link_id'] }}').find('.chosen-select').chosen();
                                $('#{{ $v['td_link_id'] }}').find('.chosen-container').addClass('w300');
                            },
                        });
                    });
                });
            </script>
        </div>
    @endforeach

</div>
<!--上传图片-->

<!-- 图片空间选择图片 -->
<!-- AJAX上传+图片预览 -->
<script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=20180528"></script>
<script src="/assets/d2eace91/js/pic/imgPreview.js?v=20180528"></script>
<script type="text/javascript">
    //商品相册
    $().ready(function() {
        var type = '{{ $data['type'] }}';
        var cat_id = '{{ $data['cat_id'] }}';
        var uid = '{{ $data['uid'] }}';
        var select_count = '{{ count($selector_data) }}';
        var max_number = '{{ $data['number'] }}';
        $("#{{ $page_id }}").find("#ok").click(function() {
            chk_value = [];
            $("#{{ $page_id }}").find('#addPicTable tbody tr').each(function(i, v) {
                chk_value.push({
                    path: $(this).find('td input[name="path"]').val(),
                    image_width: $(this).find('td input[name="image_width"]').val(),
                    image_height: $(this).find('td input[name="image_height"]').val(),
                    link: $(this).find('td [name="link"]').val(),
                    link_type: $(this).find('td [name="link_type"]').val(),
                    sort: $(this).find('td input[name="sort"]').val() == '' ? '255' : $(this).find('td input[name="sort"]').val()
                });
            });
            //	if (chk_value.length == 0) {
            //	$.msg("请选择图片");
            //	return false;
            //	}
            //上传数据
            $.designadddata({
                data: {
                    uid: uid,
                    type: type,
                    cat_id: cat_id,
                    chk_value: chk_value,
                },
            });
        });

        $("#{{ $page_id }}").on("click", ".pic-del", function() {
            $(this).parent().parent().remove();
            select_count--;
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
                    var image_url = $(target).attr("src");
                    var image_width = $(target).data('width');
                    var image_height = $(target).data("height");

                    if ($("#{{ $page_id }}").find(".pic-view").hasClass('edit')) {
                        $("#{{ $page_id }}").find(".pic-view.edit").find('img').attr("src", image_url);
                        $("#{{ $page_id }}").find(".pic-view.edit").parent().find('input[name="path"]').val(path);
                        $("#{{ $page_id }}").find(".pic-view.edit").parent().find('input[name="image_width"]').val(image_width);
                        $("#{{ $page_id }}").find(".pic-view.edit").parent().find('input[name="image_height"]').val(image_height);
                        $("#{{ $page_id }}").find(".pic-view").removeClass('edit');
                    } else {
                        if (parseInt(select_count) >= parseInt(max_number)) {
                            $.msg("最多可以选择" + max_number + "张图片");
                        } else {
                            select_count++;
                            var td_url = "<td><a href='javascript:void(0);' ref='" + image_url + "' class='pic-view m-l-5' data-toggle='tooltip' data-placement='auto bottom'><div class='pic-edit'></div><img class='w50 h50' src='"+image_url+"'><span class='image-group-edit'>编辑</span></a><input type='hidden' name='path' value='"+path+"'><input type='hidden' name='image_width' value='"+image_width+"'><input type='hidden' name='image_height' value='"+image_height+"'></td>";
                            var td_link = "<td>" + $('#{{ $page_id }}').find('#td_link_' + select_count).html() + "</td>";
                            var td_sort = "<td><input class='form-control small' type='text' value='"+select_count+"' name='sort'></td>";
                            var td_hand = "<td class='handle'><a class='pic-del del' href='javascript:;'>删除</a></td>";
                            var tr = "<tr>" + td_url + td_link + td_sort + td_hand + "</tr>";
                            $("#{{ $page_id }}").find("#addPicTable").append(tr);
                        }
                    }

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
                            var image_url = "{{ get_oss_host() }}" + path;

                            $("#goods_image_tag").attr("src", image_url);
                            // 原图路径
                            $("#goodsmodel-goods_image").val(path);
                            $("#goods_image_tag").parent("a").attr("href", image_url);
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

        $("#{{ $page_id }}").find("input[name='sort']").keyup(function() {
            var tmptxt = $(this).val();
            $(this).val(tmptxt.replace(/\D|^0/g, ''));
        }).bind("paste", function() {
            var tmptxt = $(this).val();
            $(this).val(tmptxt.replace(/\D|^0/g, ''));
        }).css("ime-mode", "disabled");

        // 修改图片
        $("#{{ $page_id }}").on('click', '.pic-view', function() {
            if ($(this).hasClass("edit")) {
                $(this).removeClass('edit');
            } else {
                $("#{{ $page_id }}").find(".pic-view").removeClass('edit');
                $(this).addClass('edit');
            }
        });
    });
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
