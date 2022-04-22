<div id="{{ $page_id }}">
    <!-- 温馨提示 -->
    {{--explain_panel--}}
    @include('layouts.partials.explain_panel')


    <form class="form-horizontal">
        <div class="table-content m-t-10 clearfix">
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">标题名称：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">
                            <input class="form-control w250" type="text" name="name" value="{{ $selector_data[0]['name'] ?? '' }}">
                        </div>
                        <div class="help-block help-block-t">
                            <div class="help-block help-block-t">标题不能为空，最多输入10个字</div>
                        </div>
                    </div>
                </div>
            </div>

            @if(!empty($data['title_open_link']))
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="ng-binding">标题链接：</span>
                    </label>
                    <div class="col-sm-9">
                        <div id="{{ $link_id }}">
                            <input type="hidden" id="select_width" value="w120">
                            <input type="hidden" id="page_code" value="{{ $page }}">
                            <select class="form-control w100 " id="link_type" name="link_type">

                                @foreach(link_type() as $lk=>$lv)
                                    @if(isset($selector_data[0]['link']))
                                        <option value="{{ $lk }}" @if($lk == $selector_data[0]['link_type']) selected="selected" @endif>{{ $lv }}</option>
                                    @else
                                        <option value="{{ $lk }}" @if($lk == 0) selected="selected" @endif>{{ $lv }}</option>
                                    @endif
                                @endforeach

                            </select>
                            <span id="link_change">
                                <input class="form-control w180" type="text" name="link" value="{{ $selector_data[0]['link'] ?? '' }}" placeholder="输入链接地址">
                            </span>
                        </div>
                        <!-- 处理切换连接类型 -->
                        <script type="text/javascript">
                            $().ready(function() {
                                $('#{{ $link_id }}').find('#link_type').change(function() {
                                    var link_type = $(this).val();
                                    var select_width = $('#{{ $link_id }}').find('#select_width').val();
                                    var page = $('#{{ $link_id }}').find('#page_code').val();
                                    //var link = $('#{{ $link_id }}').find("[name='link']").val();
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
                                            $('#{{ $link_id }}').find('#link_change').html(result.data);
                                            $('#{{ $link_id }}').find('.chosen-select').chosen();
                                            $('#{{ $link_id }}').find('.chosen-container').addClass('w120');
                                        },
                                    });
                                });
                            });
                        </script>
                        <script type="text/javascript">
                            $().ready(function() {
                                $('#{{ $link_id }}').hide();
                                $.ajax({
                                    type: 'get',
                                    url: 'change-link-type',
                                    dataType: 'json',
                                    data: {
                                        link_type: '{{ $selector_data[0]['link_type'] ?? '' }}',
                                        link: '{{ $selector_data[0]['link'] ?? '' }}',
                                        select_width: 'w120',
                                        page: 'site',
                                    },
                                    success: function(result) {
                                        $('#{{ $link_id }}').find('#link_change').html(result.data);
                                        $('#{{ $link_id }}').find('.chosen-select').chosen();
                                        $('#{{ $link_id }}').find('.chosen-container').addClass('w120');
                                        $('#{{ $link_id }}').show();
                                    },
                                });
                            });
                        </script>
                        <script type="text/javascript">
                            $().ready(function() {
                                $('#{{ $link_id }}').find('#link_type').change(function() {
                                    var link_type = $(this).val();
                                    var select_width = $('#{{ $link_id }}').find('#select_width').val();
                                    var page = $('#{{ $link_id }}').find('#page_code').val();
                                    //var link = $('#{{ $link_id }}').find("[name='link']").val();
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
                                            $('#{{ $link_id }}').find('#link_change').html(result.data);
                                            $('#{{ $link_id }}').find('.chosen-select').chosen();
                                            $('#{{ $link_id }}').find('.chosen-container').addClass('w120');
                                        },
                                    });
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
            @endif

            @if(!empty($data['title_open_second']))
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="ng-binding">副标题名称：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">
                            <input class="form-control w250" type="text" name="second_name" value="{{ $selector_data[0]['second_name'] ?? '' }}">
                        </div>
                    </div>
                </div>
            </div>
            @endif


            @if(!empty($data['title_open_colorpicker']))
            <!-- 颜色选择器 -->

            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="ng-binding">设置文字颜色：</span>
                    </label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control colorpicker ipt w250" name="color" value="{{ $selector_data[0]['color'] ?? '' }}">
                    </div>
                </div>
            </div>
            @endif

            @if(!empty($data['title_open_bgcolor']))
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="ng-binding">设置背景颜色：</span>
                    </label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control colorpicker ipt w250" name="bgcolor" value="{{ $selector_data[0]['bgcolor'] ?? '' }}">
                    </div>
                </div>
            </div>
            @endif


            @if(!empty($data['title_short_name']))
            <!-- 楼层名称 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="ng-binding">楼层名称：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">
                            <input class="form-control w250" type="text" name="floor_name" value="{{ $selector_data[0]['floor_name'] ?? '' }}" maxlength="2" placeholder="示例: 1F/1楼">
                        </div>
                        <div class="help-block help-block-t">左侧快捷导航处楼层显示的名称，建议输入1F或1楼，最大输入两个汉字，否则前台快捷导航处展示的名称会错位。</div>

                    </div>
                </div>

            </div>
            @endif

            @if(!empty($data['title_is_floor']))
                <!-- 是否使用标题缩写 -->
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="text4" class="col-sm-4 control-label">
                            <span class="ng-binding">标题缩写：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">
                                <input class="form-control w250" type="text" name="short_name" value="{{ $selector_data[0]['short_name'] ?? '' }}" maxlength="2" placeholder="建议输入2个汉字">
                            </div>
                            <div class="help-block help-block-t">鼠标经过及页面滚动到楼层处，快捷导航处展示的名称，最多允许输入两个汉字。</div>

                        </div>
                    </div>
                </div>

            @endif


        </div>

        <div class="modal-footer">

            <button type="button" class="btn btn-primary" id="ok" data-dismiss="modal">确定</button>
        </div>
    </form>
</div>
<script type="text/javascript">
    $().ready(function() {
        $("#{{ $page_id }}").on('focus', 'input', function() {
            if ($(this).hasClass('error')) {
                $(this).removeClass('error');
            }
        });
        var type = '{{ $data['type'] }}';
        var cat_id = '{{ $data['cat_id'] }}';
        var uid = '{{ $data['uid'] }}';
        var select_count = '0';
        var max_number = '{{ $data['number'] }}';
        $("#{{ $page_id }}").find("#ok").click(function() {
            var name = $("#{{ $page_id }}").find("input[name='name']").val();
            var link = $("#{{ $page_id }}").find("[name='link']").val();
            var link_type = $("#{{ $page_id }}").find("[name='link_type']").val();
            var color = $("#{{ $page_id }}").find("input[name='color']").val();
            var bgcolor = $("#{{ $page_id }}").find("input[name='bgcolor']").val();
            var short_name = $("#{{ $page_id }}").find("input[name='short_name']").val();
            var floor_name = $("#{{ $page_id }}").find("input[name='floor_name']").val();
            var second_name = $("#{{ $page_id }}").find("input[name='second_name']").val();
            if ($.trim(name) == '') {
                $("#{{ $page_id }}").find("input[name='name']").addClass('error');
                $.msg("标题名称不能为空");
                return false;
            } else if ($.trim(name).length > '10') {
                $("#{{ $page_id }}").find("input[name='name']").addClass('error');
                $.msg("标题名称不能超过10个字");
                return false;
            }
            chk_value = [];
            chk_value.push({
                name: name,
                color: color,
                bgcolor: bgcolor,
                link: link,
                link_type: link_type,
                short_name: short_name,
                floor_name: floor_name,
                second_name: second_name
            });
//上传数据	
            $.designadddata({
                data: {
                    uid: uid,
                    chk_value: chk_value,
                    type: type,
                    cat_id: cat_id,
                },
            });
        });
    });

    $.each($('#{{ $page_id }}').find('.colorpicker'), function(i, v) {
        $(this).colorpicker({
            color: $(this).val()
        });
    });
</script>