{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
    <link rel="stylesheet" href="/assets/d2eace91/css/revision-styles.css?v=1.2">
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <form method="" action="" class="form-horizontal">
        <div class="table-content m-t-30 clearfix">
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="ng-binding">店铺ID：</span>
                    </label>
                    <div class="col-sm-4">
                        <label class="control-label text-l">1</label>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="ng-binding">店铺名称：</span>
                    </label>
                    <div class="col-sm-4">
                        <label class="control-label text-l">鲜农乐食品专营店</label>
                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-3 control-label">
                        <span class="ng-binding">营销权限：</span>
                    </label>
                    <div class="col-sm-9">
                        <!-- - -->
                        <div class="authset-all" style="width: 780px;">
                            <!--一级循环-->
                            <dl class="simple-form-field">
                                <dt class="tit">
					<span>
						<label> 促销工具 </label>
					</span>
                                </dt>
                                <dd class="form-group-t">
                                    <div class="authset-list">
                                        <div class="col-sm-12 control-label control-label-t">
                                            <ul class="authset-section b-n">
                                                <!--二级循环-->


                                                <li class="w180 p-l-0 m-b-10">
                                                    <label class="control-label">红包：启用</label>
                                                </li>



                                                <li class="w180 p-l-0 m-b-10">
                                                    <label class="control-label">团购：启用</label>
                                                </li>



                                                <li class="w180 p-l-0 m-b-10">
                                                    <label class="control-label">促销专场：启用</label>
                                                </li>



                                                <li class="w180 p-l-0 m-b-10">
                                                    <label class="control-label">积分商城：启用</label>
                                                </li>



                                                <li class="w180 p-l-0 m-b-10">
                                                    <label class="control-label">提货券：启用</label>
                                                </li>



                                                <li class="w180 p-l-0 m-b-10">
                                                    <label class="control-label">店铺购物卡：启用</label>
                                                </li>



                                                <li class="w180 p-l-0 m-b-10">
                                                    <label class="control-label">搭配套餐：启用</label>
                                                </li>



                                                <li class="w180 p-l-0 m-b-10">
                                                    <label class="control-label">限时折扣：启用</label>
                                                </li>



                                                <li class="w180 p-l-0 m-b-10">
                                                    <label class="control-label">赠品：启用</label>
                                                </li>



                                                <li class="w180 p-l-0 m-b-10">
                                                    <label class="control-label">满减/送：启用</label>
                                                </li>



                                                <li class="w180 p-l-0 m-b-10">
                                                    <label class="control-label">满件优惠：启用</label>
                                                </li>



                                                <li class="w180 p-l-0 m-b-10">
                                                    <label class="control-label">购物返现：启用</label>
                                                </li>



                                                <li class="w180 p-l-0 m-b-10">
                                                    <label class="control-label">签到：启用</label>
                                                </li>


























                                            </ul>
                                        </div>
                                    </div>
                                </dd>
                            </dl>
                            <dl class="simple-form-field">
                                <dt class="tit">
					<span>
						<label> 营销工具 </label>
					</span>
                                </dt>
                                <dd class="form-group-t">
                                    <div class="authset-list">
                                        <div class="col-sm-12 control-label control-label-t">
                                            <ul class="authset-section b-n">




























                                                <li class="w180 p-l-0 m-b-10">
                                                    <label class="control-label">拼团：启用</label>
                                                </li>



                                                <li class="w180 p-l-0 m-b-10">
                                                    <label class="control-label">砍价：启用</label>
                                                </li>



                                                <li class="w180 p-l-0 m-b-10">
                                                    <label class="control-label">短信推送：启用</label>
                                                </li>



                                                <li class="w180 p-l-0 m-b-10">
                                                    <label class="control-label">邮件推送：启用</label>
                                                </li>



                                                <li class="w180 p-l-0 m-b-10">
                                                    <label class="control-label">分销：启用</label>
                                                </li>
















                                            </ul>
                                        </div>
                                    </div>
                                </dd>
                            </dl>
                            <dl class="simple-form-field">
                                <dt class="tit">
					<span>
						<label> 应用插件 </label>
					</span>
                                </dt>
                                <dd class="form-group-t">
                                    <div class="authset-list">
                                        <div class="col-sm-12 control-label control-label-t">
                                            <ul class="authset-section b-n">






































                                                <li class="w180 p-l-0 m-b-10">
                                                    <label class="control-label">批量更新价格、库存：启用</label>
                                                </li>



                                                <li class="w180 p-l-0 m-b-10">
                                                    <label class="control-label">数据导出：启用</label>
                                                </li>



                                                <li class="w180 p-l-0 m-b-10">
                                                    <label class="control-label">神码收银：启用</label>
                                                </li>



                                                <li class="w180 p-l-0 m-b-10">
                                                    <label class="control-label">商超便利超市-自由购：启用</label>
                                                </li>



                                                <li class="w180 p-l-0 m-b-10">
                                                    <label class="control-label">堂内点餐：启用</label>
                                                </li>



                                                <li class="w180 p-l-0 m-b-10">
                                                    <label class="control-label">客户分析：启用</label>
                                                </li>




                                            </ul>
                                        </div>
                                    </div>
                                </dd>
                            </dl>
                            <dl class="simple-form-field">
                                <dt class="tit">
					<span>
						<label> 经营插件 </label>
					</span>
                                </dt>
                                <dd class="form-group-t">
                                    <div class="authset-list">
                                        <div class="col-sm-12 control-label control-label-t">
                                            <ul class="authset-section b-n">


















































                                                <li class="w180 p-l-0 m-b-10">
                                                    <label class="control-label">收银台：启用</label>
                                                </li>


                                            </ul>
                                        </div>
                                    </div>
                                </dd>
                            </dl>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </form>


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

@stop

{{--outside body script--}}
@section('outside_body_script')

@stop