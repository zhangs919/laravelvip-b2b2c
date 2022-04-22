@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
@stop

@section('content')

    <form id="SystemConfigModel" class="form-horizontal" name="SystemConfigModel" action="/system/config/index?group=goods" method="post" enctype="multipart/form-data" novalidate="novalidate">
        {{ csrf_field() }}
        <input type="hidden" name="group" value="goods">
        <input type="hidden" name="tabs" value="">
        <div class="table-content m-t-30">


            <h5 class="m-b-30 m-t-0" data-anchor="商品审核">
                商品审核 		</h5>




            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-audit_self_shop_goods" class="col-sm-4 control-label">

                        <span class="ng-binding">自营店铺商品是否需要审核：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">





                            <input type="hidden" name="SystemConfigModel[audit_self_shop_goods]" value="0">
                            <div id="systemconfigmodel-audit_self_shop_goods" class="" name="SystemConfigModel[audit_self_shop_goods]">
                                <label class="control-label cur-p m-r-10"><input type="radio" name="SystemConfigModel[audit_self_shop_goods]" value="0" @if($group_info['audit_self_shop_goods']->value == 0) checked="" @endif> 无需审核</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="SystemConfigModel[audit_self_shop_goods]" value="1" @if($group_info['audit_self_shop_goods']->value == 1) checked="" @endif> 必须审核</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="SystemConfigModel[audit_self_shop_goods]" value="2" @if($group_info['audit_self_shop_goods']->value == 2) checked="" @endif> 仅第一次上架时需要审核</label></div>




                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>








            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-audit_other_shop_goods" class="col-sm-4 control-label">

                        <span class="ng-binding">入驻店铺商品是否需要审核：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">





                            <input type="hidden" name="SystemConfigModel[audit_other_shop_goods]" value="0">
                            <div id="systemconfigmodel-audit_other_shop_goods" class="" name="SystemConfigModel[audit_other_shop_goods]">
                                <label class="control-label cur-p m-r-10"><input type="radio" name="SystemConfigModel[audit_other_shop_goods]" value="0" @if($group_info['audit_other_shop_goods']->value == 0) checked="" @endif> 无需审核</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="SystemConfigModel[audit_other_shop_goods]" value="1" @if($group_info['audit_other_shop_goods']->value == 1) checked="" @endif> 必须审核</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="SystemConfigModel[audit_other_shop_goods]" value="2" @if($group_info['audit_other_shop_goods']->value == 2) checked="" @endif> 仅第一次上架时需要审核</label></div>




                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>






            <h5 class="m-b-30 m-t-30" data-anchor="商品价格">
                商品价格 		</h5>




            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-goods_price_format" class="col-sm-4 control-label">

                        <span class="ng-binding">商品价格显示格式：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




                            <input type="text" id="systemconfigmodel-goods_price_format" class="form-control ipt m-r-10" name="SystemConfigModel[goods_price_format]" value="{{ $group_info['goods_price_format']->value }}" unselect="0">




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">用于PC端列表页面、商品详情页面等其他页面的商品价格的显示的格式，“{0}”代表价格的占位符</div></div>
                    </div>
                </div>
            </div>








            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-price_show_rule" class="col-sm-4 control-label">

                        <span class="ng-binding">商品价格显示规则：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">





                            <input type="hidden" name="SystemConfigModel[price_show_rule]" value="0">
                            <div id="systemconfigmodel-price_show_rule" class="" name="SystemConfigModel[price_show_rule]">
                                <label class="control-label cur-p m-r-10"><input type="radio" name="SystemConfigModel[price_show_rule]" value="0" @if($group_info['price_show_rule']->value == 0) checked="" @endif> 不处理</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="SystemConfigModel[price_show_rule]" value="1" @if($group_info['price_show_rule']->value == 1) checked="" @endif> 保留两位小数</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="SystemConfigModel[price_show_rule]" value="2" @if($group_info['price_show_rule']->value == 2) checked="" @endif> 不保留小数部分为0的尾数</label></div>




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">用于列表页面、商品详情页面商品价格的显示计算规则</div></div>
                    </div>
                </div>
            </div>






            <h5 class="m-b-30 m-t-30" data-anchor="商品列表">
                商品列表 		</h5>




            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-goods_list_count" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">列表页面显示商品数量：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




                            <input type="text" id="systemconfigmodel-goods_list_count" class="form-control ipt m-r-10" name="SystemConfigModel[goods_list_count]" value="{{ $group_info['goods_list_count']->value }}">




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">用于控制前台商品列表页、搜索结果页面每页显示商品的数量，为了页面的美观建议为12或20</div></div>
                    </div>
                </div>
            </div>








            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-goods_list_cache" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">列表页面查询缓存：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




                            <input type="text" id="systemconfigmodel-goods_list_cache" class="form-control ipt m-r-10" name="SystemConfigModel[goods_list_cache]" value="{{ $group_info['goods_list_cache']->value }}">



                            秒


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">用于控制前台商品列表页、搜索结果页面缓存时间，单位：秒，默认为600秒</div></div>
                    </div>
                </div>
            </div>








            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-goods_list_filter_count" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">列表页面筛选条件默认展示数量：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




                            <input type="text" id="systemconfigmodel-goods_list_filter_count" class="form-control ipt m-r-10" name="SystemConfigModel[goods_list_filter_count]" value="{{ $group_info['goods_list_filter_count']->value }}">



                            个


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">用于控制前台商品列表页筛选条件中除品牌、价格其他的属性条件展示数量，默认为2，设置为0则展示所有</div></div>
                    </div>
                </div>
            </div>








            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-sort_order_type" class="col-sm-4 control-label">

                        <span class="ng-binding">商品列表页面默认排序类型：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">





                            <input type="hidden" name="SystemConfigModel[sort_order_type]" value="0">
                            <div id="systemconfigmodel-sort_order_type" class="" name="SystemConfigModel[sort_order_type]">
                                <label class="control-label cur-p m-r-10"><input type="radio" name="SystemConfigModel[sort_order_type]" value="0" @if($group_info['sort_order_type']->value == 0) checked="" @endif> 按综合排序</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="SystemConfigModel[sort_order_type]" value="1" @if($group_info['sort_order_type']->value == 1) checked="" @endif> 按销量</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="SystemConfigModel[sort_order_type]" value="2" @if($group_info['sort_order_type']->value == 2) checked="" @endif> 按上架时间</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="SystemConfigModel[sort_order_type]" value="3" @if($group_info['sort_order_type']->value == 3) checked="" @endif> 按评论数</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="SystemConfigModel[sort_order_type]" value="4" @if($group_info['sort_order_type']->value == 4) checked="" @endif> 按商品价格</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="SystemConfigModel[sort_order_type]" value="5" @if($group_info['sort_order_type']->value == 5) checked="" @endif> 按人气 </label></div>




                        </div>

                        <div class="help-block help-block-t">根据关键词搜索商品时，如果搜索的关键词与上次搜索的关键词不同则系统自动使用综合排序对搜索结果进行排序；<br>系统支持elasticsearch后，综合排序的规则是按关键词搜索商品将会根据关键词匹配的相关度进行优先排序；</div>
                    </div>
                </div>
            </div>








            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-sort_order_method" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">商品列表页面默认排序方式：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">





                            <input type="hidden" name="SystemConfigModel[sort_order_method]" value="1">
                            <div id="systemconfigmodel-sort_order_method" class="" name="SystemConfigModel[sort_order_method]">
                                <label class="control-label cur-p m-r-10"><input type="radio" name="SystemConfigModel[sort_order_method]" value="0" @if($group_info['sort_order_method']->value == 0) checked="" @endif> 升序</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="SystemConfigModel[sort_order_method]" value="1" @if($group_info['sort_order_method']->value == 1) checked="" @endif> 降序</label></div>




                        </div>

                        <div class="help-block help-block-t">综合排序按仅照商品的排序进行升序排序，不受此排序设置控制；</div>
                    </div>
                </div>
            </div>








            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-goods_show_sale_number" class="col-sm-4 control-label">

                        <span class="ng-binding">是否显示商品销量：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">





                            <input type="hidden" name="SystemConfigModel[goods_show_sale_number]" value="0">
                            <div id="systemconfigmodel-goods_show_sale_number" class="" name="SystemConfigModel[goods_show_sale_number]">
                                <label class="control-label cur-p m-r-10"><input type="radio" name="SystemConfigModel[goods_show_sale_number]" value="0" @if($group_info['goods_show_sale_number']->value == 0) checked="" @endif> 隐藏</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="SystemConfigModel[goods_show_sale_number]" value="1" @if($group_info['goods_show_sale_number']->value == 1) checked="" @endif> 显示</label></div>




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">控制商品列表页、详情页是否显示商品销量</div></div>
                    </div>
                </div>
            </div>








            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-goods_list_show_style" class="col-sm-4 control-label">

                        <span class="ng-binding">商品列表页显示样式：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">





                            <input type="hidden" name="SystemConfigModel[goods_list_show_style]" value="grid">
                            <div id="systemconfigmodel-goods_list_show_style" class="" name="SystemConfigModel[goods_list_show_style]">
                                <label class="control-label cur-p m-r-10"><input type="radio" name="SystemConfigModel[goods_list_show_style]" value="grid" @if($group_info['goods_list_show_style']->value == 'grid') checked="" @endif> 网格</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="SystemConfigModel[goods_list_show_style]" value="list" @if($group_info['goods_list_show_style']->value == 'list') checked="" @endif> 列表</label></div>




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">控制商品列表页是否显示样式。注：目前只能控制WAP端</div></div>
                    </div>
                </div>
            </div>






            <h5 class="m-b-30 m-t-30" data-anchor="商品详情">
                商品详情 		</h5>




            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-goods_info_freight" class="col-sm-4 control-label">

                        <span class="ng-binding">商品详情页运费模式：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">





                            <input type="hidden" name="SystemConfigModel[goods_info_freight]" value="0">
                            <div id="systemconfigmodel-goods_info_freight" class="" name="SystemConfigModel[goods_info_freight]">
                                <label class="control-label cur-p m-r-10"><input type="radio" name="SystemConfigModel[goods_info_freight]" value="2" @if($group_info['goods_info_freight']->value == 2) checked="" @endif> 隐藏配送地区</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="SystemConfigModel[goods_info_freight]" value="0" @if($group_info['goods_info_freight']->value == 0) checked="" @endif> 显示具体运费</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="SystemConfigModel[goods_info_freight]" value="1" @if($group_info['goods_info_freight']->value == 1) checked="" @endif> 仅显示“有货”、“无货”等信息，不显示具体运费</label></div>




                        </div>

                        <div class="help-block help-block-t">注：设置为“显示具体运费”时，仅在选择配送区域最后一级时才会显示具体运费</div>
                    </div>
                </div>
            </div>








            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-goods_info_show_stock" class="col-sm-4 control-label">

                        <span class="ng-binding">是否显示商品详情页库存：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">





                            <input type="hidden" name="SystemConfigModel[goods_info_show_stock]" value="1">
                            <div id="systemconfigmodel-goods_info_show_stock" class="" name="SystemConfigModel[goods_info_show_stock]">
                                <label class="control-label cur-p m-r-10"><input type="radio" name="SystemConfigModel[goods_info_show_stock]" value="0" @if($group_info['goods_info_show_stock']->value == 0) checked="" @endif> 隐藏，无货时显示“库存不足”</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="SystemConfigModel[goods_info_show_stock]" value="1" @if($group_info['goods_info_show_stock']->value == 1) checked="" @endif> 显示</label></div>




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">用于控制商品详情页面是否展示具体的商品库存</div></div>
                    </div>
                </div>
            </div>








            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-goods_info_pickup" class="col-sm-4 control-label">

                        <span class="ng-binding">是否显示商品详情页自提点：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">





                            <input type="hidden" name="SystemConfigModel[goods_info_pickup]" value="0">
                            <div id="systemconfigmodel-goods_info_pickup" class="" name="SystemConfigModel[goods_info_pickup]">
                                <label class="control-label cur-p m-r-10"><input type="radio" name="SystemConfigModel[goods_info_pickup]" value="0" @if($group_info['goods_info_pickup']->value == 0) checked="" @endif> 隐藏</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="SystemConfigModel[goods_info_pickup]" value="1" @if($group_info['goods_info_pickup']->value == 1) checked="" @endif> 显示</label></div>




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">用于控制商品详情页是否展示自提点列表</div></div>
                    </div>
                </div>
            </div>








            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-goods_info_show_collect" class="col-sm-4 control-label">

                        <span class="ng-binding">是否显示商品收藏人气：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">





                            <input type="hidden" name="SystemConfigModel[goods_info_show_collect]" value="1">
                            <div id="systemconfigmodel-goods_info_show_collect" class="" name="SystemConfigModel[goods_info_show_collect]">
                                <label class="control-label cur-p m-r-10"><input type="radio" name="SystemConfigModel[goods_info_show_collect]" value="0" @if($group_info['goods_info_show_collect']->value == 0) checked="" @endif> 隐藏</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="SystemConfigModel[goods_info_show_collect]" value="1" @if($group_info['goods_info_show_collect']->value == 1) checked="" @endif> 显示</label></div>




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">用于控制商品详情页是否展示具体的收藏人气</div></div>
                    </div>
                </div>
            </div>








            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-shop_show_collect" class="col-sm-4 control-label">

                        <span class="ng-binding">是否显示店铺收藏人气：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">





                            <input type="hidden" name="SystemConfigModel[shop_show_collect]" value="1">
                            <div id="systemconfigmodel-shop_show_collect" class="" name="SystemConfigModel[shop_show_collect]">
                                <label class="control-label cur-p m-r-10"><input type="radio" name="SystemConfigModel[shop_show_collect]" value="0" @if($group_info['shop_show_collect']->value == 0) checked="" @endif> 隐藏</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="SystemConfigModel[shop_show_collect]" value="1" @if($group_info['shop_show_collect']->value == 1) checked="" @endif> 显示</label></div>




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">用于控制店铺相关页面是否展示具体的店铺收藏人气</div></div>
                    </div>
                </div>
            </div>






            <h5 class="m-b-30 m-t-30" data-anchor="商品视频">
                商品视频 		</h5>




            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-goods_video_enable" class="col-sm-4 control-label">

                        <span class="ng-binding">是否开启商品主图视频：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">





                            <input type="hidden" name="SystemConfigModel[goods_video_enable]" value="0">
                            <div id="systemconfigmodel-goods_video_enable" class="" name="SystemConfigModel[goods_video_enable]">
                                <label class="control-label cur-p m-r-10"><input type="radio" name="SystemConfigModel[goods_video_enable]" value="0" @if($group_info['goods_video_enable']->value == 0) checked="" @endif> 关闭</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="SystemConfigModel[goods_video_enable]" value="1" @if($group_info['goods_video_enable']->value == 1) checked="" @endif> 开启</label></div>




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">开启后，卖家中心发布、编辑商品时可以为商品添加主图视频用于在商品详情页展示；关闭后将禁用此功能，上传的主图视频无法在商品详情展示。</div></div>
                    </div>
                </div>
            </div>















            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-goods_video_max_duration" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">主图视频时长：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">



                            <input type="text" id="systemconfigmodel-goods_video_min_duration" name="SystemConfigModel[goods_video_min_duration]" value="{{ $group_info['goods_video_min_duration']->value }}" class="form-control m-r-5 valid ipt" placeholder="最小时长"><span>-</span>


                            <input type="text" id="systemconfigmodel-goods_video_max_duration" class="form-control m-l-5 valid ipt" name="SystemConfigModel[goods_video_max_duration]" value="{{ $group_info['goods_video_max_duration']->value }}" placeholder="最大时长">



                            &nbsp;秒


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">设置商品主图视频的时长大小，单位：秒，默认为0~90秒</div></div>
                    </div>
                </div>
            </div>








            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-goods_video_article" class="col-sm-4 control-label">

                        <span class="ng-binding">主图视频规则文章：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




                            <input type="text" id="systemconfigmodel-goods_video_article" class="form-control" name="SystemConfigModel[goods_video_article]" placeholder="请输入一个有效的文章链接地址" value="{{ $group_info['goods_video_article']->value }}">




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">设置描述商品主图视频上传要求规则的文章链接地址，设置后会展示在商品发布、编辑页面中主图视频提示中，便于用户了解视频要求;<br><span style="color: red;">为了兼容各端浏览器，目前暂支持视频格式：mpeg4（H.264）、ogg、webm</span>；<br>Ogg = 带有 Theora 视频编码和 Vorbis 音频编码的 Ogg 文件;<br>MPEG4 = 带有 H.264 视频编码和 AAC 音频编码的 MPEG 4文件;<br>WebM = 带有 VP8 视频编码和 Vorbis 音频编码的 WebM 文件;</div></div>
                    </div>
                </div>
            </div>






            <div class="bottom-btn p-b-30">
                <input type="hidden" name="back_url" value="{{ request()->fullUrl() }}">
                {{--<input type="hidden" name="back_url" value="{{ $_SERVER['HTTP_REFERER'] ?? '' }}">--}}
                <input type="button" id="btn_submit" value="确认提交" class="btn btn-primary btn-lg">
            </div>

        </div></form>

@stop

@section('helper_tool')
    @include('layouts.partials.helper_tool')
@stop

@section('footer_script')

    {!! $script_render !!}

@stop