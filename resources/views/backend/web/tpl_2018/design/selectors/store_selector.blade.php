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
                <span>您最多可以添加24个店铺</span>
            </li>
            <li>
                <span>"虚位以待"默认图片最佳显示尺寸90*45</span>
            </li>

        </ul>
    </div>


    <table class="table table-hover ">
        <thead>
        <tr>
            <th class="text">“虚位以待”默认图片</th>
            <th class="handle">操作</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="text">

                <img class="w50" src="/assets/d2eace91/images/design/example/shop_img_90_45.jpg">

            </td>
            <td class="handle">
                <input type="file" id="file_image_{{ $page_id }}" name="file_image" class="file_image" style="display: none;" />
                <input type="hidden" value="" id="tpl_default_img">
                <a id="upload_image" href="javascript:void(0)">修改</a>

            </td>
        </tr>
        </tbody>
    </table>
    <table id="addShopTable" class="table table-hover">
        <thead>
        <tr>
            <th>店铺名称</th>
            <th>店铺信誉</th>
            <th class="text-c">店铺logo</th>
            <th class="text-c">排序</th>
            <th class="handle">操作</th>
        </tr>
        </thead>
        <tbody>

        @foreach($selector_data as $v)
        <tr>
            <td>
                <input type="hidden" name="shop_id" value="{{ $v['shop_id'] }}">
                {{ $v['shop_name'] }}
            </td>
            <td>
                <img src="{{ $v['credit_img'] }}" alt="">
            </td>
            <td class="text-c">
                <img class="w50" src="{{ $v['shop_logo'] }}">
            </td>
            <td class="text-c">
                <input class="form-control small" type="text" value="{{ $v['sort'] }}" name="sort" onkeyup="validateInteger(this)">
            </td>
            <td class="handle">
                <a class="del shop-del" data-shop_id="{{ $v['shop_id'] }}" href="javascript:void(0);">删除</a>
            </td>
        </tr>
        @endforeach



        </tbody>
    </table>

    <!-- 店铺容器 -->
    <div class="shop-container"></div>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="ok" data-dismiss="modal">确定</button>
    </div>



</div>
<!-- AJAX上传+图片预览 -->
<script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=1.2"></script>
<script src="/assets/d2eace91/js/pic/imgPreview.js?v=1.2"></script>
<script src="/assets/d2eace91/js/jquery.widget.js?v=1.2"></script>

<script type="text/javascript">
    function get_selected() {
        var ids = [];
        $('#{{ $page_id }}').find("input[name='shop_id']").each(function(i, v) {
            ids.push($(this).val());
        });
        return ids.join(',');
    }
</script>

<script type="text/javascript">
    $().ready(function() {

        var lastUuid = 0;

        var uuid = function() {
            return (new Date()).getTime() * 1000 + (lastUuid++) % 1000;
        }

        var type = '{{ $data['type'] }}';
        var cat_id = '{{ $data['cat_id'] }}';
        var uid = '{{ $data['uid'] }}';
        var max_number = '{{ $data['number'] }}';
        var select_count = '{{ count($selector_data) }}';
        $("#{{ $page_id }}").find("#ok").click(function() {
            chk_value = [];
            $("#{{ $page_id }}").find('#addShopTable tbody tr').each(function(i, v) {
                chk_value.push({
                    shop_id: $(this).find('td input[name="shop_id"]').val(),
                    sort: $(this).find('td input[name="sort"]').val() == '' ? '255' : $(this).find('td input[name="sort"]').val()
                });
            });
            //	if(chk_value.length == 0){
            //	$.msg("请选择店铺");
            //	return false;
            //	}
            //上传数据
            $.designadddata({
                data: {
                    uid: uid,
                    chk_value: chk_value,
                    type: type,
                    cat_id: cat_id,
                    extend: {
                        cat_id: cat_id,
                        tpl_default_img: $("#{{ $page_id }}").find('#tpl_default_img').val()
                    }
                },
            });
        });

//店铺列表
        var container = $("#{{ $page_id }}").find(".shop-container");
        var page_id = "#ShopPickerPage_{{ $page_id }}";
        var is_supply = '0';
        $.ajax({
            url: '/shop/shop/picker',
            dataType: 'json',
            data: {
                page: {
                    page_id: page_id,
                    page_size: 10,
                },
                output: 1,
                selected_ids: get_selected(),
                shop_status: 1,
                is_supply: is_supply

            },
            beforeSend: function() {
                $.loading.start();
            },
            success: function(result) {
                container.html(result.data);
                $.loading.stop();
            }
        });

        container.on('click', '.select-shop', function() {
            var shop_id = $(this).data('shop_id');
            var shop_name = $(this).data('shop_name');
            var credit_img = $(this).data('credit_img');
            var credit_name = $(this).data('credit_name');
            var shop_logo = $(this).data('shop_logo');
            if (parseInt(select_count) >= parseInt(max_number)) {
                $.msg("最多可以添加" + max_number + "个店铺");
            } else {
                if (!is_exist(shop_id)) {
                    select_count++;
                    var td_name = "<td><input type='hidden' name='shop_id' value='"+shop_id+"'>" + shop_name + "</td>";
                    var td_credit_img = "<td><img src='"+credit_img+"' alt='"+credit_name+"'></td>";
                    var td_logo = "<td class='text-c'><img class='w50' src='"+shop_logo+"'></td>";
                    var td_sort = "<td class='text-c'><input class='form-control small' type='text' value='"+select_count+"' name='sort'></td>";
                    var td_hand = "<td class='handle'><a class='del shop-del' data-shop_id='"+shop_id+"' href='javascript:;'>删除</a></td>";
                    var tr = "<tr>" + td_name + td_credit_img + td_logo + td_sort + td_hand + "</tr>";
                    $("#{{ $page_id }}").find("#addShopTable").append(tr);
                    tablelist.params.selected_ids = get_selected();
                    $(this).parent().find('a').addClass('active').html('已选');
                } else {
                    $.msg("您已经选择了此店铺");
                }
            }
        });

        $("#{{ $page_id }}").on("click", ".shop-del", function() {
            $(this).parent().parent().remove();
            tablelist.params.selected_ids = get_selected();
            $('#{{ $page_id }}').find('#handle_' + $(this).data('shop_id')).find('a').removeClass('active').html('选择');
            select_count--;
        });

        $("#{{ $page_id }}").find("input[name='sort']").keyup(function() {
            var tmptxt = $(this).val();
            $(this).val(tmptxt.replace(/\D|^0/g, ''));
        }).bind("paste", function() {
            var tmptxt = $(this).val();
            $(this).val(tmptxt.replace(/\D|^0/g, ''));
        }).css("ime-mode", "disabled");

//上传图片
        $('#{{ $page_id }}').on("click", "#upload_image", function() {
            var targer = $(this);
            $(this).parent().find('#file_image_{{ $page_id }}').click().change(function() {
                var file_id = $(this).attr("id");
                var value = $(this).val();
                var $src = $(this).parent().prev().find("img");
                var $path = $(this).parent().find("#tpl_default_img");
                $.ajaxFileUpload({
                    url: '/site/upload-image',
                    fileElementId: file_id,
                    dataType: 'json',
                    success: function(result, status) {
                        if (result.code == 0 && result.data) {
                            var path = result.data.path;
                            var image_url = result.data.url;
                            $src.attr("src", image_url);
                            // 原图路径
                            $path.val(path);
                            $.msg(result.message, {
                                time: 2000
                            });
                            if (targer.parent().find("#upload_cancel").size() == 0) {
                                targer.parent().append('<a id="upload_cancel" href="javascript:void(0)">删除</a>');
                            }
                        } else {
                            $.msg(result.message, {
                                time: 2000
                            });
                        }
                    },
                });
            });
        });
        //删除图片
        $('#{{ $page_id }}').on("click", "#upload_cancel", function() {
            var targer = $(this);
            $.confirm("删除后恢复默认图片,确定要删除吗?", function() {
                targer.parent().prev().find("img").attr("src", "/assets/d2eace91/images/design/example/shop_img_90_45.jpg");
                targer.parent().find("#tpl_default_img").val('');
                $.msg('清空成功', {
                    time: 2000
                });
                targer.remove();
            });
        });
    });
</script>

<!-- 验证是否存在 -->
<script type="text/javascript">
    function is_exist(id) {
        var judge = false;
        $("#{{ $page_id }}").find('#addShopTable tbody tr').each(function(i, v) {
            if ($(this).find('td input[name="shop_id"]').val() == id) {
                judge = true;
            }
        });
        return judge;
    }
</script>