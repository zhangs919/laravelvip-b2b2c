{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20180702"/>
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <div class="table-content">
        <!--打印区 start-->
        <div class="express-box" style="margin-top:{{ $info->offset_top }}px; margin-left:{{ $info->offset_left }}px;background-color: #ffffff;border: none;text-align: left;">

            @if(!empty($info->img_path))
                <img id="img_bg" src="{{ get_image_url($info->img_path) }}" style="width:{{ $info->img_width }}px; height:{{ $info->img_height }}px;" />
            @endif
            <div class="express-center">

                @if(!empty($info->config_lable))
                    @foreach($info->config_lable as $v)
                        <div id="div_{{ $v[0] }}" class="message-box date" style="left: {{ $v[4] }}px; top:{{ $v[5] }}px; width:{{ $v[2] }}px; height:{{ $v[3] }}px;background: none; border: none;cursor: default;text-align: left;">
                            <span>{{ $v[1] }}</span>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
        <!--打印区 end-->
    </div>

@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block page元素同级下面--}}
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
    <script type="text/javascript">
        $().ready(function() {
            $("#btn_print").click(function() {
                $("#img_bg").hide();
                $(".express-box").jqprint({
                    //如果是true则可以显示iframe查看效果（iframe默认高和宽都很小，可以再源码中调大），默认是false
                    debug: false,
                    //true表示引进原来的页面的css，默认是true。（如果是true，先会找$("link[media=print]")，若没有会去找$("link")中的css文件）
                    importCSS: true,
                    //表示如果原来选择的对象必须被纳入打印（注意：设置为false可能会打破你的CSS规则）。
                    printContainer: true,
                    //表示如果插件也必须支持歌opera浏览器，在这种情况下，它提供了建立一个临时的打印选项卡。默认是true
                    operaSupport: true
                });
            });
        })
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop