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
            <li id="step_3">
                <i class="fa fa-image step"></i>
                <h6>STEP.3</h6>
                <h2>上传商品图片</h2>
                <i class="fa fa-angle-right"></i>
            </li>
            <li id="step_4" class="current">
                <i class="fa fa-check-square-o step"></i>
                <h6>STEP.4</h6>
                <h2>商品发布成功</h2>
            </li>
        </ul>
        <script type="text/javascript">
            $().ready(function(){
                $("#step_4").addClass("current");
            });
        </script>
        <div class="content">
            <div class="goods-info-four">
                <div class="issued-success">
                    <h2 class="c-blue">
                        <i class="fa fa-check-circle-o m-r-10"></i>
                        恭喜您，商品发布成功！
                    </h2>
                    <div class="issued-success-content m-t-20">
                        <p>
                            <a class="btn btn-primary f14" href="/goods/lib-goods/add">
                                <i class="fa fa-plus"></i>
                                继续添加商品
                            </a>
                        </p>
                        <p class="page-jump">
                            <a class="c-blue m-r-20" href="/goods/lib-goods/edit?id={{ $goods_id }}">重新编辑刚发布的商品&gt;&gt;</a>
                            <a class="c-blue" href="/goods/lib-goods/list">进入商品库&gt;&gt;</a>
                        </p>
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

@stop

{{--outside body script--}}
@section('outside_body_script')

@stop