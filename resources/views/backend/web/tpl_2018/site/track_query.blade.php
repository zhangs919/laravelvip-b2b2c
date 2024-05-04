{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')

@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')


    <div class="table-content m-t-30">
        <form id="form1">
            <div class="simple-form-field">
                <div class="form-group">
                    <div class="form-control-wrap text-c">
                        <select id="shipping_code" name="shipping_code" class="form-control-wrap text-l chosen-select">
                            <option value="">请选择</option>
                            @foreach($shipping_list as $item)
                                <option value="{{ $item->shipping_code }}">{{ $item->shipping_name }}</option>
                            @endforeach
                        </select>
                        <input id='logistic_code' name='logistic_code' class="form-control m-r-5" type="text" placeholder="请输入要查询的快递单号">
                        <input type="button" id="btn_submit" class="btn btn-primary" value="快速查找" />
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </form>
        <!-- 搜索展示区域 -->
        <div class="search-show-region" style="display: none">
            <div class="search-show-notice">
                共搜索到
                <span class="track-number">0</span>
                条信息
            </div>
            <div class="delivery-container">
                <ul></ul>
                <!--无搜索内容-->
                <div class="no-data-page" style="display: none">
                    <h5>暂无物流信息</h5>
                    <p>：( 该单号暂无物流进展，请稍后再试，或检查公司和单号是否有误。</p>
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
    <script id="template" type="text">
<li>
    <div class="delivery-timeline">
        <div class="delivery-timeline-sign">
            <i class="delivery-timeline-circle"></i>
            <i class="delivery-timeline-text-mult">最新</i>
        </div>
        <div class="delivery-timeline-info">
            <p>#time#</p>
            <p>#msg#</p>
        </div>
    </div>
</li>
</script>
    <script type="text/javascript">
        //
    </script>
@stop

{{--helper_tool--}}
@section('helper_tool')

@stop

{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer script page元素同级下面--}}
@section('footer_script')

    <script>
        $().ready(function() {
            $("#btn_submit").click(function() {
                var data = $("#form1").serializeJson();
                data.logistic_code = $.trim(data.logistic_code);
                if (data.logistic_code == "") {
                    $.msg("快递单号不能为空！");
                    $("#logistic_code").focus();
                    return;
                }
                $.loading.start();
                $.post('/site/trackquery', data, function(result) {
                    $(".search-show-region").show();
                    if (result.code == 0) {
                        $(".delivery-container").find("ul").html("");
                        if (result.data.list.length > 0) {
                            var template = $("#template").html();
                            var html = "";
                            for (var i = 0; i < result.data.list.length; i++) {
                                var time = result.data.list[i].time;
                                var msg = result.data.list[i].msg;
                                html += template.replace(/#time#/, time).replace(/#msg#/, msg);
                            }
                            $(".delivery-container").find("ul").html(html);
                            $(".track-number").html(result.data.list.length);
                            $(".delivery-container").find("ul").show();
                            $(".no-data-page").hide();
                        } else {
                            $(".track-number").html(0);
                            $(".delivery-container").find("ul").hide();
                            $(".no-data-page").show();
                        }
                    } else {
                        $(".track-number").html(0);
                        $(".delivery-container").find("ul").hide();
                        $(".no-data-page").find("p").html(result.message);
                        $(".no-data-page").show();
                    }
                }, "JSON").always(function() {
                    $.loading.stop();
                });
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop