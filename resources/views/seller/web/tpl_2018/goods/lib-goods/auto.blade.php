{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20181020"/>
@stop

{{--content--}}
@section('content')

    <div class="content text-c">
        <h3 class="type-chosen">请选择导入类型</h3>
        <div class="type-box">
            <div class="select-list">
                <ul>
                    <li id="li-0" class="selected" value="0">
                        <dl class="type_info">
                            <dt>文件导入</dt>
                            <dd class="type_pic manual"></dd>
                            <dd class="type_desc_sub">使用上传excel文件方式进入导入系统商品库商品</dd>
                        </dl>
                        <p class="type_toolbar">
                            <em>
                                <a href="javascript:void(0);" id="type_file">已选择</a>
                                <i class="next"></i>
                            </em>
                        </p>
                    </li>
                    <li id="li-1" value="1">
                        <dl class="type_info">
                            <dt>扫码枪导入</dt>
                            <dd class="type_pic machine"></dd>
                            <dd class="type_desc_sub">使用扫码枪扫条形码形式为店铺导入商品库商品，或输入条形码形式为店铺导入商品库商品</dd>
                        </dl>
                        <p class="type_toolbar">
                            <em>
                                <a href="javascript:void(0);" id="type_scan">选择并继续</a>
                                <i class="next"></i>
                            </em>
                        </p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="bottom m-t-30">
            <p>
                <a id="next" class="btn btn-primary btn-lg" href="file.html"> 下一步 </a>
            </p>
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


{{--footer script page元素同级下面--}}
@section('footer_script')
    <script type="text/javascript">
        $(function() {
            $("li").click(function() {
                // $("li[class='selected']").removeAttr("class");
                $("#li-0").removeAttr("class");
                $("#li-1").removeAttr("class");
                $(this).addClass("selected");
                $("#next").removeClass("disabled");

                if ($(this).attr('value') == 0) {
                    $("#type_file").html("已选择");
                    $("#type_scan").html("选择并继续");
                    $("#next").attr("href", "file.html");
                } else {
                    $("#type_file").html("选择并继续");
                    $("#type_scan").html("已选择");
                    $("#next").attr("href", "scan.html");
                }
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop