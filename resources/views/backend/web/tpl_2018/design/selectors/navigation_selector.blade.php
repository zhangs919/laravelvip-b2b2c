<!-- AJAX上传 -->
<script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=20180528"></script>
<div id="{{ $page_id }}" class="form-horizontal">
    <!-- 温馨提示 -->

    <div class="explanation m-b-10">
        <div class="title">
            <i class="arrow-icon explain-checkZoom cur-p" title=""></i>
            <i class="fa fa-bullhorn"></i>
            <h4>温馨提示</h4>
        </div>
        <ul class="explain-panel">
            @foreach($explain_panel as $v)
            <li>
                <span>{!! $v !!}</span>
            </li>
            @endforeach
                {{--<li>
                    <span>为达到页面效果，建议上传4个或8个菜单（图片尺寸为135*135），您可以点击下面的“＋”添加菜单</span>
                </li>
                <li>
                    <span>导航名称最多不能超过10个字，默认字体颜色为黑色</span>
                </li>--}}

        </ul>
    </div>


    <div class="modal-body p-0">
        <div class="table-content clearfix">
            <div class="navTableBox">
                <table id="addNavTable" class="table table-hover navTable">
                    <thead>
                    <tr>

                        <th class="text-c">图片</th>

                        <th class="text-c">导航名称</th>
                        <th class="text-c">字体颜色</th>
                        <th class="text-c">导航链接</th>
                        <th class="text-c">排序</th>
                        <th class="text-c handle">操作</th>
                    </tr>
                    </thead>
                    <tbody>

                    @if(!empty($selector_data))
                        @foreach($selector_data as $v)
                            <tr>
                                <td>
                                    <div class="szy-imagegroup" data-size="1"></div>
                                    <input type="hidden" id="path" name="path" value="{{ $v['path'] }}">
                                </td>
                                <td class="text-c">
                                    <input placeholder="导航名称" type="text" name="name" value="{{ $v['name'] }}" class="form-control w100">
                                </td>
                                <td class="text-c">
                                    <input type="text" name="color" value="{{ $v['color'] }}" class="form-control w100 colorpicker">
                                </td>
                                <td>
                                    <div id="{{ $v['link_id'] }}">
                                        <input type="hidden" id="select_width" value="w200">
                                        <input type="hidden" id="page_code" value="{{ $page }}">
                                        <select class="form-control w100 " id="link_type" name="link_type">
                                            @foreach(link_type() as $lk=>$lv)
                                                <option value="{{ $lk }}" @if($lk == $v['link_type']) selected="selected" @endif>{{ $lv }}</option>
                                            @endforeach
                                        </select>
                                        <span id="link_change">


        {{--<input class="form-control w180" type="text" name="link" value="" placeholder="输入链接地址">--}}
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
                                                    select_width: 'w200',
                                                    page: '{{ $page }}',
                                                },
                                                success: function(result) {
                                                    $('#{{ $v['link_id'] }}').find('#link_change').html(result.data);
                                                    $('#{{ $v['link_id'] }}').find('.chosen-select').chosen();
                                                    $('#{{ $v['link_id'] }}').find('.chosen-container').addClass('w200');
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
                                                        $('#{{ $v['link_id'] }}').find('.chosen-container').addClass('w200');
                                                    },
                                                });
                                            });
                                        });
                                    </script></td>
                                <td>
                                    <input class="form-control small" type="text" value="{{ $v['sort'] }}" name="sort">
                                </td>
                                <td class="text-c handle">
                                    <a class="del nav-del" href="javascript:void(0);">删除</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif

                    </tbody>
                </table>
            </div>
            <div class="navAdd">
                <em>+</em>
                添加导航
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="ok">确定</button>
            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">取消</button> -->
        </div>
    </div>

    @foreach($selector_empty_data as $k=>$v)
        <table class="chrTable{{ $k+1 }} hide">
            <tbody>
            <tr>
                <td>
                    <div class="szy-imagegroup" data-size="1"></div>
                    <input type="hidden" id="path" name="path" value="">
                </td>
                <td class="text-c">
                    <input placeholder="导航名称" type="text" name="name" value="" class="form-control w100">
                </td>
                <td class="text-c">
                    <input type="text" name="color" value="" class="form-control w100 colorpicker">
                </td>
                <td>
                    <div id="{{ $v['td_link_id'] }}">
                        <input type="hidden" id="select_width" value="w200">
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
                                        $('#{{ $v['td_link_id'] }}').find('.chosen-container').addClass('w200');
                                    },
                                });
                            });
                        });
                    </script></td>
                <td>
                    <input class="form-control small" type="text" value="" name="sort">
                </td>
                <td class="text-c handle">
                    <a class="del nav-del" href="javascript:void(0);">删除</a>
                </td>
            </tr>
            </tbody>
        </table>
    @endforeach

</div>
<script type="text/javascript">
    $().ready(function() {
        getFileImageList();

        $('#{{ $page_id }}').find(".szy-imagegroup").each(function() {
            var size = $(this).data("size");
            var target = $(this);
            var value = $(this).parent().find('input[name="path"]').val();
            $(this).imagegroup({
                host: "/site/upload-image",
                size: size,
                bgclass: 'image-nav-bg',
                gallery: true,
                values: value.split("|"),
// 回调函数
                callback: function(data) {
                    var values = this.values;
                    if (!values) {
                        values = [];
                    }
                    values = values.join("|");
                    target.parent().find('input[name="path"]').val(values);
                },
// 移除的回调函数
                remove: function(value, values) {
                    var values = this.values;
                    if (!values) {
                        values = [];
                    }
                    values = values.join("|");
                    target.parent().find('input[name="path"]').val(values);
                }
            });
        });

    });

    function getFileImageList() {
        $.each($('#{{ $page_id }}').find(".navTable .file_image"), function(i, v) {
            $(this).attr("id", "file_image_{{ $page_id }}" + i);
        });
        $.each($('#{{ $page_id }}').find('#addNavTable').find('.colorpicker'), function() {
            $(this).colorpicker({
                color: $(this).val()
            }).on('change.color', function(evt, color) {
                $(this).val(color);
            });
        });
    }
</script>



<script type="text/javascript">
    $().ready(function() {
        $("#{{ $page_id }}").on('focus', 'input', function() {
            if ($(this).hasClass('error')) {
                $(this).removeClass('error');
            }
        });
        var type = '{{ $data['type'] }}';
        var cat_id = '{{ $data['cat_id'] ?? 1 }}';
        var uid = '{{ $data['uid'] }}';
        var uuid = '{{ $page_id }}';
        var max_number = '{{ $data['number'] }}';
        var select_count = '{{ count($selector_data) }}';
        $("#{{ $page_id }}").find("#ok").click(function() {
            chk_value = [];
            var flag = [];
            $("#{{ $page_id }}").find('#addNavTable tbody tr').each(function(i, v) {
                if ($.trim($(this).find('input[name="name"]').val()) == '' || $.trim($(this).find('input[name="name"]').val()).length > 10) {
                    flag.push(v);
                }
                chk_value.push({
                    path: $(this).find('[name="path"]').val(),
                    link: $(this).find('[name="link"]').val(),
                    link_type: $(this).find('[name="link_type"]').val(),
                    name: $(this).find('[name="name"]').val(),
                    color: $(this).find('[name="color"]').val(),
                    sort: $(this).find('[name="sort"]').val(),
                });
            });

            if (flag.length > 0) {
                for (var i = 0; i < flag.length; i++) {
                    $(flag[i]).find('input[name="name"]').addClass('error');
                }

                $.msg('导航名称不能为空，且不能超过10个字符');
                return false;
            }
//上传数据
            $.designadddata({
                data: {
                    uid: uid,
                    chk_value: chk_value,
                    type: type,
                    cat_id: cat_id,
                    uuid: uuid
                },
            });
        });

        $('#{{ $page_id }}').on("click", ".navLinkModify", function() {
            $(this).parent().parent().find('.navSelscted').slideToggle();
        });

        $('#{{ $page_id }}').find('.navAdd').click(function() {
            if (parseInt(select_count) >= parseInt(max_number)) {
                $.msg("最多可以添加" + max_number + "个导航");
            } else {
                select_count++;
                var $chr_tr = $('#{{ $page_id }}').find('.chrTable' + select_count + ' tbody');
                $('#{{ $page_id }}').find(".navTable tbody").append($chr_tr.html());
                var target = $('#{{ $page_id }}').find(".navTable tbody .szy-imagegroup:last");
                target.imagegroup({
                    host: "/site/upload-image",
                    size: target.data('size'),
                    bgclass: 'image-nav-bg',
                    gallery: true,
                    values: '',
// 回调函数
                    callback: function(data) {
                        var values = this.values;
                        if (!values) {
                            values = [];
                        }
                        values = values.join("|");
                        target.parent().find('input[name="path"]').val(values);
                    },
// 移除的回调函数
                    remove: function(value, values) {
                        var values = this.values;
                        if (!values) {
                            values = [];
                        }
                        values = values.join("|");
                        target.parent().find('input[name="path"]').val(values);
                    }
                });

                $('#{{ $page_id }}').find(".navTable tbody").children().last().find('input[name="sort"]').val(select_count);
                $('.chrTable' + select_count).remove();
                getFileImageList();

            }
        });

        $('#{{ $page_id }}').on("click", ".nav-del", function() {
            $(this).parents('tr').remove();
            select_count--;
            getFileImageList();
        });
    });
</script>