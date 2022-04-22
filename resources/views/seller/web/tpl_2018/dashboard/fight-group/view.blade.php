{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20180702"/>
@stop

{{--content--}}
@section('content')

    <form id="FightGroupModel" class="form-horizontal" name="FightGroupModel" action="/dashboard/fight-group/view?id=95" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="table-content m-t-30 clearfix fight-group-goods">
            <div class="form-horizontal">
                <!-- 隐藏域 -->
                <input type="hidden" id="fightgroupmodel-act_id" class="form-control" name="FightGroupModel[act_id]" value="95">
                <div class="simple-form-field">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">
                            <span class="ng-binding">活动商品：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">
							<span class="fight-group-pic m-r-10" id="goods_image">
																<img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/backend/gallery/2019/01/05/15466928132839.jpg">
															</span>
                                <a id="goods_name" class="control-label" href="http://www.b2b2c.yunmall.68mall.com/goods-250.html" target="_blank">金色喀秋莎1000克/包玉米面条</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 活动图片 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="fightgroupmodel-act_img" class="col-sm-4 control-label">

                            <span class="ng-binding">活动图片：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">

                                <img class="imgpreview-box" src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/shop/1/images/2019/01/11/15471852565412.jpg" width="250px" height="102px">


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">用拼团活动页面的图片，请使用640*260像素<br>大小1M内的图片，支持jpg、jpeg、gif、png格式上传</div></div>
                        </div>
                    </div>
                </div>

                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="fightgroupmodel-cat_id" class="col-sm-4 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">活动分类：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">

                                <label class="control-label">大金智能锁</label>


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">活动分类可在平台方后台->商城->促销->拼团->拼团分类添加</div></div>
                        </div>
                    </div>
                </div>
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="fightgroupmodel-start_time" class="col-sm-3 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">活动有效期：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">

                                <label class="control-label">
                                    2019-01-11 13:40:36
                                    <span class="ctime">至</span>
                                    2019-01-18 13:40:36
                                </label>


                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>			<!-- 拼团价格 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="fightgroupmodel-act_price" class="col-sm-4 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">拼团价格：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">

                                <label class="control-label">6.00&nbsp;&nbsp;元
                                    <span id="goods_price" class="m-l-20">店铺价：<strong class="order-amount c-orange m-r-5">90.00</strong>元</span></label>


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">拼团价不能大于店铺价</div></div>
                        </div>
                    </div>
                </div>
                <!-- 团长优惠金额百分比 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="fightgroupmodel-first_discount" class="col-sm-4 control-label">

                            <span class="ng-binding">团长享受折扣：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">

                                <label class="control-label">10&nbsp;%</label>


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">团长享受折扣价是以拼团价格为计算基数的；例如：商品拼团价为10元，团长享受折扣为90%，那么团长购买此商品最终的价格即为9元</div></div>
                        </div>
                    </div>
                </div>
                <!-- 限购 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="fightgroupmodel-purchase_num" class="col-sm-4 control-label">

                            <span class="ng-binding">限购：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">

                                <label class="control-label">1&nbsp;&nbsp;件

                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">限制会员购买活动中的每件商品的限购数量，为0或空时，则不限购</div></div>
                        </div>
                    </div>
                </div>			<!-- 活动库存 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="fightgroupmodel-act_stock" class="col-sm-4 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">活动库存：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">

                                <label class="control-label">10&nbsp;&nbsp;件
                                    <span id="number" class="m-l-20">总库存：<strong class="order-amount c-orange m-r-5">100</strong>件</span></label>


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">活动库存不能大于总库存</div></div>
                        </div>
                    </div>
                </div>			<!-- 参团人数 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="fightgroupmodel-fight_num" class="col-sm-4 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">参团人数：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">

                                <label class="control-label">2&nbsp;&nbsp;人</label>


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">建议3人以上</div></div>
                        </div>
                    </div>
                </div>			<!-- 成团时限 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="fightgroupmodel-fight_time" class="col-sm-4 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">成团时限：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">

                                <label class="control-label">5&nbsp;&nbsp;小时</label>


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">组团限制时间，单位为小时</div></div>
                        </div>
                    </div>
                </div>		</div>
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

@stop

{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <!-- AJAX上传 -->
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=20190121"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20190121"></script>
    <script type='text/javascript'>
        $().ready(function() {
            $("#act_img_container").imagegroup({
                host: 'http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/',
                size: 1,
                values: ['/shop/1/images/2019/01/11/15471852565412.jpg'],
                callback: function(data) {
                    $("#fightgroupmodel-act_img").val(data.path);
                },
                remove: function(value, values) {
                    $("#fightgroupmodel-act_img").val('');
                }
            });

        })
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop