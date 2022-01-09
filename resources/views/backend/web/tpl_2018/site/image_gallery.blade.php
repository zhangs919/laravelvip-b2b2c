<div id="imagegallery_{{ $page_id }}" class="collapse goods-gallery m-t-10 m-b-10 p-0">
    <div class="nav">

        <span class="pull-left">
            <select class="form-control form-control-xs dir-id" name="dir_id">
                @foreach($image_dir_list as $key=>$v)
                    <option value="{{ $v->dir_id }}">{{ $v->dir_name }}</option>
                @endforeach
            </select>

            <select class="form-control form-control-xs m-l-5 sort-name" name="sort_name">
            <option value="created_at-desc">按上传时间从晚到早</option>
            <option value="created_at-asc">按上传时间从早到晚</option>
            <option value="size-asc">按图片从小到大</option>
            <option value="size-desc">按图片从大到小</option>
            <option value="name-asc">按图片名升序</option>
            <option value="name-desc">按图片名降序</option>
            </select>
        </span>
        <span class="pull-right">
			<input type="text" id="image_name" class="form-control form-control-sm w150" placeholder="请输入图片名称">
			<a class="btn btn-primary btn-sm image-search"><i class="fa fa-search m-l-0"></i>搜索</a>
			<a href="javascript:void(0);" class="btn btn-primary btn-sm btn-upload"><i class="fa fa-upload m-l-0"></i>上传图片</a>
		</span>
    </div>

    {{-- 图片列表 --}}
    @include('site.partials._image_gallery_list')

</div>

<script type="text/javascript">
    $().ready(function() {
        var container = $("#imagegallery_{{ $page_id }}");

        // 动态调节尺寸
        if ($(container).width() > 1000) {
            $(container).find(".table_list").find("li").width(131);
        } else if ($(container).width() < 600) {
            $(container).find(".table_list").find("li").width(101);
        }

        var tablelist = $(container).find(".table_list").tablelist({
            url: "/site/image-gallery",
            method: "GET",
            page_id: "#{{ $page_id }}",
        });

        $(container).find(".dir-id").change(function() {
            tablelist.load({
                dir_id: $(this).val(),
                sort_name: $(container).find(".sort-name").val(),
                image_name: $.trim($(container).find("#image_name").val()),
            });
        });

        $(container).find(".sort-name").change(function() {
            tablelist.load({
                dir_id: $(container).find(".dir-id").val(),
                sort_name: $(this).val()
            });
        });

        var imagegallery = $.imagegallery(container);

        $(container).find(".btn-upload").click(function() {

            var options = $(container).data("options");

            if ($.isPlainObject(options)) {
                options = $.extend({
                    maxSize: "2097152"
                }, options);
            } else {
                options = {
                    maxSize: "2097152"
                };
            }

            var params = {
                sort_name: 'created_at-desc',
                page: {
                    cur_page: 1,
                    page_size: 12
                }
            };

            // 重置排序
            $(container).find(".sort-name").val('created_at-desc');

            $.imageupload({
                url: '/site/image-gallery',
                data: {
                    dir_id: $(container).find(".dir-id").val()
                },
                options: options,
                multiple: true,
                callback: function(result) {
                    if (result.code == 0) {
                        var data = result.data;

                        if (!$.isArray(data)) {
                            data = [data];
                        }

                        tablelist.load(params, function(result) {
                            if (imagegallery) {
                                // 自动点击图片
                                if ($.isFunction(imagegallery.click)) {
                                    // 遍历点击图片
                                    $.each(data, function(i, item) {
                                        $(container).find(".image-item[data-url='" + item.url + "']").click();
                                    });
                                }
                                if ($.isFunction(imagegallery.callback)) {
                                    $.each(data, function(i, item) {
                                        imagegallery.callback.call(imagegallery, item);
                                    });
                                }
                            }
                        });
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }
            });
        });

        // 取消选择
        $(container).on("click", ".image-search", function() {
            var name = $(this).prev(":input").val();
            /* if ($.trim(name) == "") {
                $.msg("请输入图片名称！");
                $(this).prev(":input").focus();
                return;
            }
            */

            tablelist.load({
                dir_id: $(this).val(),
                sort_name: $(container).find(".sort-name").val(),
                image_name: name
            });
        });
    });
</script>
