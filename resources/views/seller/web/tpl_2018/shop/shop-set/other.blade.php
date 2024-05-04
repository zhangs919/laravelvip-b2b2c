{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
@stop

{{--content--}}
@section('content')

    <form id="ShopConfigModel" class="form-horizontal" name="ShopConfigModel" action="/shop/config/index" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="group" value="shop_other">
        <input type="hidden" name="tabs" value="">
        <div class="table-content m-t-30">



            <input type="hidden" id="shopconfigmodel-shop_index_topic" class="form-control" name="ShopConfigModel[shop_index_topic]" value="0">





            <h5 class="m-b-30 m-t-30" data-anchor="店铺首页设置">店铺首页设置</h5>



            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopconfigmodel-shop_index" class="col-sm-4 control-label">

                        <span class="ng-binding">店铺首页：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




                            <input type="hidden" name="ShopConfigModel[shop_index]" value="0">
                            <div id="shopconfigmodel-shop_index" class="" name="ShopConfigModel[shop_index]">
                                <label class="control-label cur-p m-r-10"><input type="radio" name="ShopConfigModel[shop_index]" value="0" @if($model['shop_index'] == 0){{ 'checked' }}@endif> 店铺首页</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="ShopConfigModel[shop_index]" value="1" @if($model['shop_index'] == 1){{ 'checked' }}@endif> 商品列表</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="ShopConfigModel[shop_index]" value="2" @if($model['shop_index'] == 2){{ 'checked' }}@endif> 专题页
                                    <select id="shopconfigmodel-shop_index_topic" name="ShopConfigModel[shop_index_topic]" class="form-control form-control-xs w150 m-l-10 valid" style="margin-top: -5px;" onClick="$(this).parents('label').find('input').click()">
                                        <option value="0">--请选择--</option>
                                        @if(!empty($topic_list))
                                            @foreach($topic_list as $v)
                                                <option value="{{ $v['topic_id'] }}" @if($model['shop_index_topic'] == $v['topic_id'])selected="selected"@endif>{{ $v['topic_name'] }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </label>
                            </div>




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">此设置用于定制你的店铺首页显示的内容，暂时支持店铺的装修首页、商品列表页、专题页</div></div>
                    </div>
                </div>
            </div>


            <div class="simple-form-field">
                <div class="form-group">
                    <label for="shopconfigmodel-shop_index_show_goods_number" class="col-sm-4 control-label">
                        <span class="ng-binding">店铺首页全部商品是否展示数量：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <input type="hidden" name="ShopConfigModel[shop_index_show_goods_number]" value="0">
                            <div id="shopconfigmodel-shop_index_show_goods_number" class="" name="ShopConfigModel[shop_index_show_goods_number]">
                                <label class="control-label cur-p m-r-10"><input type="radio" name="ShopConfigModel[shop_index_show_goods_number]" value="0" @if($model['shop_index_show_goods_number'] == 0){{ 'checked' }}@endif> 不显示</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="ShopConfigModel[shop_index_show_goods_number]" value="1" @if($model['shop_index_show_goods_number'] == 1){{ 'checked' }}@endif> 显示</label>
                            </div>
                        </div>
                        <div class="help-block help-block-t"><div class="help-block help-block-t">此设置用于控制手机端店铺首页全部商品处展示的具体数量</div></div>
                    </div>
                </div>
            </div>

            <h5 class="m-b-30 m-t-30" data-anchor="店铺商品列表设置">店铺商品列表设置</h5>


            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopconfigmodel-goods_list_show_mode" class="col-sm-4 control-label">

                        <span class="ng-binding">pc商品列表展示方式：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




                            <input type="hidden" name="ShopConfigModel[goods_list_show_mode]" value="0">
                            <div id="shopconfigmodel-goods_list_show_mode" class="" name="ShopConfigModel[goods_list_show_mode]">
                                <label class="control-label cur-p m-r-10"><input type="radio" name="ShopConfigModel[goods_list_show_mode]" value="0" @if($model['goods_list_show_mode'] == 0){{ 'checked' }}@endif> 默认主图</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="ShopConfigModel[goods_list_show_mode]" value="1" @if($model['goods_list_show_mode'] == 1){{ 'checked' }}@endif> 规格相册</label></div>




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">设置店铺pc商品列表页面商品的展示形式，默认仅展示商品主图，设置为规格相册后，会将每个商品的规格主图以小图展示出来，让用户能在列表页面即切换看到每个商品的规格主图</div></div>
                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <div class="form-group">
                    <label for="shopconfigmodel-m_shop_list_style" class="col-sm-4 control-label">
                        <span class="ng-binding">店铺商品列表页样式：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <input type="hidden" name="ShopConfigModel[m_shop_list_style]" value="0">
                            <div id="shopconfigmodel-m_shop_list_style" class="" name="ShopConfigModel[m_shop_list_style]">
                                <label class="control-label cur-p m-r-10"><input type="radio" name="ShopConfigModel[m_shop_list_style]" value="0" @if($model['m_shop_list_style'] == 0){{ 'checked' }}@endif> 默认样式</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="ShopConfigModel[m_shop_list_style]" value="1" @if($model['m_shop_list_style'] == 1){{ 'checked' }}@endif> 经典样式</label>
                            </div>
                        </div>
                        <div class="help-block help-block-t"><div class="help-block help-block-t">控制手机端店铺全部商品列表页面商品展示的样式<span class="m-l-10 c-blue">默认样式示例：<i data-toggle="popover" data-trigger="hover" data-placement="right" data-html="true" data-content="<img width='200' height='180' src='/images/shop/shoplist-1.png'>" class="fa fa-question-circle f16 c-orange cur-p" data-original-title="" title=""></i>；</span><span class="c-blue">经典样式示例：<i data-toggle="popover" data-trigger="hover" data-placement="right" data-html="true" data-content="<img width='200' height='180' src='/images/shop/shoplist-2.png'>" class="fa fa-question-circle f16 c-orange cur-p" data-original-title="" title=""></i></span></div></div>
                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <div class="form-group">
                    <label for="shopconfigmodel-m_search_mode" class="col-sm-4 control-label">
                        <span class="ng-binding">经典样式店铺商品分类页搜索机制：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <input type="hidden" name="ShopConfigModel[m_search_mode]" value="0">
                            <div id="shopconfigmodel-m_search_mode" class="" name="ShopConfigModel[m_search_mode]">
                                <label class="control-label cur-p m-r-10"><input type="radio" name="ShopConfigModel[m_search_mode]" value="0" @if($model['m_search_mode'] == 0){{ 'checked' }}@endif> 当前分类下搜索</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="ShopConfigModel[m_search_mode]" value="1" @if($model['m_search_mode'] == 1){{ 'checked' }}@endif> 搜索全部</label>
                            </div>
                        </div>
                        <div class="help-block help-block-t"><div class="help-block help-block-t">控制的是手机端店铺商品分类页面搜索机制<br>
                                当前分类下搜索：查看某个分类下商品时，在搜索框输入关键词，搜索的是选择的分类下与关键字匹配的商品<br>
                                搜索全部：无论当前切换到哪个分类下，在搜索框输入搜索词，搜索的就是全部分类下与关键词匹配的商品</div></div>
                    </div>
                </div>
            </div>

            <div class="bottom-btn p-b-30">
                <input type="hidden" name="back_url" value="{{ request()->fullUrl() }}" />
                <input type="button" id="btn_submit" value="确认提交" class="btn btn-primary btn-lg" />
            </div>

        </div>
    </form>

@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block--}}
@section('extra_html')

@stop


{{--helper_tool--}}
@section('helper_tool')
    @include('layouts.partials.helper_tool')
@stop

{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer_js page元素同级下面--}}
@section('footer_js')
    <script src="/assets/d2eace91/js/jquery-ui.js"></script>
    <script src="/assets/d2eace91/min/js/validate.min.js"></script>
    <script src="/assets/d2eace91/min/js/upload.min.js"></script>
@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    @include('shop.config.partials.shop_other')
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop