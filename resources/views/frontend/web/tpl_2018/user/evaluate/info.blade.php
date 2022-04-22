@extends('layouts.user_layout')

{{--header_js--}}
@section('header_js')

@stop

@section('content')

    <!-- 正文，由view提供 -->
    <div class="con-right fr">
        <script src="/js/jquery.raty.js?v=20180027"></script>
        <!---->
        <div class="con-right fr">
            <div class="con-right-text">
                <div class="tabmenu">
                    <ul class="tab">
                        <li class="active">评价晒单</li>
                    </ul>
                </div>
                <div class="content-info">
                    <div class="content-list evaluate-list">
                        <div class="evaluate-table">
                            <div class="evaluate-list-head">
                                <ul>
                                    <li style="width: 60%;">宝贝信息</li>
                                    <li style="width: 40%;">评价状态</li>
                                </ul>
                            </div>
                            <!---->
                            <!---->
                            <div class="evaluate-plist evaluate-plist-info comment-goods">
                                <div class="pro-info">
                                    <ul>
                                        <li class="fore1 goods-info">
                                            <div style="overflow: hidden;">
                                                <a class="goods-img" href="http://www.b2b2c.yunmall.68mall.com/goods-205.html" target="_blank">
                                                    <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/shop/1/gallery/2018/09/28/15381362582058.jpg?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" />
                                                </a>
                                                <div class="item-con">
                                                    <div class="item-name">
                                                        <a href="http://www.b2b2c.yunmall.68mall.com/goods-205.html" target="_blank">
                                                            <span>创建红茶</span>
                                                        </a>
                                                    </div>
                                                    <div class="item-props">
							<span class="sku">
								<span>颜色：均色|尺码：S</span>
							</span>
                                                    </div>
                                                    <div class="item-time">
                                                        <span>购买时间：2018-10-15 16:13:46</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="fore3">
                                            <div class="operate">
                                                <!--点击评价-->
                                                <!-- -->
                                                <a href="javascript:;" class="go-to-evaluate">点击评价</a>
                                                <!---->
                                                <!---->
                                            </div>
                                            <!---->
                                        </li>
                                    </ul>
                                </div>
                                <!-- 点击评价 -->
                                <!---->
                                <div class="evaluate-box evaluate-box-spe">
                                    <div class="box-t"></div>
                                    <div class="evaluate-con">
                                        <form class="form-horizontal comment-form" method="post" action="">
                                            <div class="form-group form-group-spe">
                                                <label class="input-left">
                                                    <span>描述相符：</span>
                                                </label>
                                                <div class="rank">
                                                    <div id="rank_star" name="rank_star" class="star rank_star">
                                                        <span style="display: none; color: red; float: right;" class="comment-score-error">必填哦~</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-group-spe">
                                                <label class="input-left">
                                                    <span>评价商品：</span>
                                                </label>
                                                <div class="form-control-box">
                                                    <textarea placeholder="请输入评价内容..." name="content" class="comment-content"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group form-group-spe">
                                                <label class="input-left">
                                                    <span>晒图片：</span>
                                                </label>
                                                <div class="comment-images" data-sku-id="906"></div>
                                                <input type="hidden" id="images_906" name="images" value="" class="comment-images">
                                                <span class="hint">每张图片大小不超过2048KiB，最多上传5张图片，支持gif、png、jpg格式</span>
                                            </div>
                                            <span class="hint comment-content-error" style="display: none; color: red;">亲，请先添加评论或上传图片再提交</span>
                                            <div class="act">
                                                <input type="button" class="btn btn-submit" value="发表评价" data-record-id="284" />
                                                <label>
                                                    <input type="hidden" name="is_anonymous" value="0" />
                                                    <input type="checkbox" name="is_anonymous" checked="checked" value="1" />
                                                    <span>匿名评价</span>
                                                </label>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!---->
                            </div>
                            <!---->
                            <div class="evaluate-plist evaluate-plist-info comment-goods">
                                <div class="pro-info">
                                    <ul>
                                        <li class="fore1 goods-info">
                                            <div style="overflow: hidden;">
                                                <a class="goods-img" href="http://www.b2b2c.yunmall.68mall.com/goods-16.html" target="_blank">
                                                    <img src="http://68dsw.oss-cn-beijing.aliyuncs.com/demo/shop/1/gallery/2017/08/25/15036307529844.jpg?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" />
                                                </a>
                                                <div class="item-con">
                                                    <div class="item-name">
                                                        <a href="http://www.b2b2c.yunmall.68mall.com/goods-16.html" target="_blank">
                                                            <span>陕西白鹿原大樱桃 车厘子大红灯 新鲜水果4斤航空包邮 甜的很</span>
                                                        </a>
                                                    </div>
                                                    <div class="item-props">
							<span class="sku">
								<span></span>
							</span>
                                                    </div>
                                                    <div class="item-time">
                                                        <span>购买时间：2018-10-15 16:13:46</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="fore3">
                                            <div class="operate">
                                                <!--点击评价-->
                                                <!-- -->
                                                <a href="javascript:;" class="go-to-evaluate">点击评价</a>
                                                <!---->
                                                <!---->
                                            </div>
                                            <!---->
                                        </li>
                                    </ul>
                                </div>
                                <!-- 点击评价 -->
                                <!---->
                                <div class="evaluate-box ">
                                    <div class="box-t"></div>
                                    <div class="evaluate-con">
                                        <form class="form-horizontal comment-form" method="post" action="">
                                            <div class="form-group form-group-spe">
                                                <label class="input-left">
                                                    <span>描述相符：</span>
                                                </label>
                                                <div class="rank">
                                                    <div id="rank_star" name="rank_star" class="star rank_star">
                                                        <span style="display: none; color: red; float: right;" class="comment-score-error">必填哦~</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-group-spe">
                                                <label class="input-left">
                                                    <span>评价商品：</span>
                                                </label>
                                                <div class="form-control-box">
                                                    <textarea placeholder="请输入评价内容..." name="content" class="comment-content"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group form-group-spe">
                                                <label class="input-left">
                                                    <span>晒图片：</span>
                                                </label>
                                                <div class="comment-images" data-sku-id="16"></div>
                                                <input type="hidden" id="images_16" name="images" value="" class="comment-images">
                                                <span class="hint">每张图片大小不超过2048KiB，最多上传5张图片，支持gif、png、jpg格式</span>
                                            </div>
                                            <span class="hint comment-content-error" style="display: none; color: red;">亲，请先添加评论或上传图片再提交</span>
                                            <div class="act">
                                                <input type="button" class="btn btn-submit" value="发表评价" data-record-id="285" />
                                                <label>
                                                    <input type="hidden" name="is_anonymous" value="0" />
                                                    <input type="checkbox" name="is_anonymous" checked="checked" value="1" />
                                                    <span>匿名评价</span>
                                                </label>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!---->
                            </div>
                            <!---->
                            <script type='text/javascript'>
                                //商品星级评价 依赖于js/jquery.raty.js
                                $.fn.raty.defaults.path = '/images/star-rank';
                                $.fn.raty.defaults.scoreName = "score";
                                $.fn.raty.defaults.hints = ['1分：差的太离谱，与卖家描述的严重不符，非常不满', '2分：部分有破损，与卖家描述的不符，不满意', '3分：质量一般，没有卖家描述的那么好', '4分：质量不错，与卖家描述的基本一致，还是挺满意的', '5分：质量非常好，与卖家描述的完全一致，非常满意'];
                                $("div[class='star rank_star']").raty();
                            </script>
                            <script type="text/javascript">
                                var imgpath = "";
                                $().ready(function() {
                                    $(".comment-images").each(function() {
                                        var sku_id = $(this).data("sku-id");
                                        var imagegorup = $(this).imagegroup({
                                            host: "http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/",
                                            size: 5,
                                            mode: 0,
                                            callback: function(data) {
                                                var value = this.values.join(",");
                                                var empty_size = 0;

                                                for (var i = 0; i < this.values.length; i++) {
                                                    if ($.trim(this.values[i]) == "") {
                                                        empty_size++;
                                                    }
                                                }

                                                if (this.values.length == empty_size) {
                                                    $("#images_" + sku_id).val("");
                                                } else {
                                                    $("#images_" + sku_id).val(value);
                                                }
                                            },
                                            remove: function(value, values) {
                                                var value = this.values.join(",");
                                                var empty_size = 0;

                                                for (var i = 0; i < this.values.length; i++) {
                                                    if ($.trim(this.values[i]) == "") {
                                                        empty_size++;
                                                    }
                                                }

                                                if (this.values.length == empty_size) {
                                                    $("#images_" + sku_id).val("");
                                                } else {
                                                    $("#images_" + sku_id).val(value);
                                                }
                                            }
                                        });
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
                <!-- 回复框 -->
                <div id="modal_box" style="display: none">
                    <input type="hidden" value="" id="comment_id" name="comment">
                    <input type="hidden" id="reply_text" name="reply_text" value="">
                    <div class="modal-box-con reply-info">
                        <p class="reply-con">
                            <textarea class="comment-cotnent" placeholder="请输入回复内容..."></textarea>
                        </p>
                    </div>
                </div>
                <!-- 回复框end -->
                <!-- 店铺动态评分 -->
                <div id="shop_comment" class="tabmenu">
                    <ul class="tab">
                        <li class="active">店铺动态评分</li>
                    </ul>
                </div>
                <div class="content-info comment-shop">
                    <div id="raty_stars">
                        <div class="shop-evaluate clearfix">
                            <div class="shop-logo">
                                <a href="/shop/1.html" target="_blank" title="进入店铺">
                                    <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/shop/1/images/2018/10/26/15405696251485.jpg" />
                                </a>
                            </div>
                            <div class="shop-info">
                                <p>
                                    <img src="/images/shop-type/shop-icon1.png" />
                                    <a href="/shop/1.html" target="_blank" class="shop-name">楠丹木业</a>

                                    <span class="ww-light">
						<!-- 旺旺不在线 i 标签的 class="ww-offline" -->
                                        <!---->
                                        <!-- s等于1时带文字，等于2时不带文字 -->
<a target="_blank" href="http://amos.alicdn.com/getcid.aw?v=2&uid=zlww26837&site=cntaobao&s=2&groupid=0&charset=utf-8">
	<img border="0" src="http://amos.alicdn.com/online.aw?v=2&uid=zlww26837&site=cntaobao&s=2&charset=utf-8" alt="淘宝旺旺" title="" />
	<span></span>
</a>
                                        <!---->
					</span>

                                </p>
                                <ul>
                                    <li>
                                        描述相符：
                                        <span class="color" id="desc_core">4.67</span>
                                    </li>
                                    <li>
                                        服务态度：
                                        <span class="color">5.00</span>
                                    </li>
                                    <li>
                                        发货速度：
                                        <span class="color">5.00</span>
                                    </li>
                                    <li>
                                        物流服务：
                                        <span class="color">5.00</span>
                                    </li>
                                </ul>
                            </div>
                            <!---->
                            <form class="comment-form" method="POST" action="">
                                <div class="evaluate-shop">
                                    <ul>
                                        <li>
                                            <span class="spark">*</span>
                                            服务态度
                                            <span class="rank-star">
								<div id="default-demo1"></div>
							</span>
                                        </li>
                                        <li>
                                            <span class="spark">*</span>
                                            发货速度
                                            <span class="rank-star">
								<div id="default-demo2"></div>
							</span>
                                        </li>
                                        <li>
                                            <span class="spark">*</span>
                                            物流服务
                                            <span class="rank-star">
								<div id="default-demo3"></div>
							</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="act clearfix">
                                    <input type="button" class="btn btn-eval-shop" value="提交" data-order-id="262" />
                                </div>
                            </form>
                            <!---->
                        </div>
                    </div>
                </div>
                <script type='text/javascript'>
                    //商品星级评价 依赖于js/jquery.raty.js
                    $.fn.raty.defaults.path = '/images/star-rank';
                    $.fn.raty.defaults.scoreName = "service_desc_score";
                    $.fn.raty.defaults.hints = ['1分：卖家态度很差，还骂人、说脏话，简直不把顾客当回事', '2分：卖家有点不耐烦，承诺的服务也兑现不了', '3分：卖家回复问题很慢，态度一般，谈不上沟通顺畅', '4分：卖家服务挺好的，沟通挺顺畅的，总体满意', '5分：卖家的服务太棒了，考虑非常周到，完全超出期望值'];
                    $('#default-demo1').raty();

                    $.fn.raty.defaults.scoreName = "send_desc_score";
                    $.fn.raty.defaults.hints = ['1分：再三提醒下，卖家超过一天才发货，耽误我的时间', '2分：卖家发货有点慢的，催了几次终于发货了', '3分：卖家发货速度一般，提醒后才发货的', '4分：卖家发货挺及时的，运费收取很合理', '5分：卖家发货速度非常快，包装非常仔细、严实'];
                    $('#default-demo2').raty();

                    $.fn.raty.defaults.scoreName = "logistics_speed_score";
                    $.fn.raty.defaults.hints = ['1分：到货速度严重延误，货物破损，派件员态度恶劣', '2分：到货速度慢，外包装严重变形，派件员不耐烦，态度差', '3分：到货速度一般，外包装变形，派件员态度一般', '4分：到货速度及时，派件员态度较好', '5分：到货速度非常快，商品完好无损，派件员态度很好'];
                    $('#default-demo3').raty();
                </script>
                <!-- 店铺评分end -->
            </div>
        </div>
        <!---->
        <script src="/assets/d2eace91/js/jquery.method.js?v=20180027"></script>
        <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=20180027"></script>
        <script src="/assets/d2eace91/js/jquery.widget.js?v=20180027"></script>
        <script src="/js/jquery.modal.js?v=20180027"></script>
        <script src="/js/evaluate.js?v=20180027"></script>
        <link rel="stylesheet" href="/assets/d2eace91/css/highslide.css?v=20181020"/>
        <script src="/assets/d2eace91/js/pic/highslide-with-gallery.js?v=20180027"></script>
        <script type="text/javascript">
            $().ready(function() {
                $("#").children(".evaluate-box").css("display", "block")
            })
        </script>
        <script type="text/javascript">
            //图片弹窗
            hs.graphicsDir = '/assets/d2eace91/js/pic/graphics/';
            hs.align = 'center';
            hs.transitions = ['expand', 'crossfade'];
            hs.outlineType = 'rounded-white';
            hs.fadeInOut = true;
            hs.addSlideshow({
                interval: 5000,
                repeat: false,
                useControls: true,
                fixedControls: 'fit',
                overlayOptions: {
                    opacity: .75,
                    position: 'bottom center',
                    hideOnMouseOut: true
                }
            });
        </script>
        <!-- --></div>

@endsection