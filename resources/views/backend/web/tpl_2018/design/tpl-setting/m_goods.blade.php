@extends('layouts.design_layout_v3')

@section('header_js')

    <!-- 图片缓载js -->
    <script src="/assets/d2eace91/js/jquery.lazyload.js?v=20180418"></script>
    <!-- 装修js -->
    <script src="/assets/d2eace91/js/jquery.design.js?v=20180418"></script>
    <!--选色插件-->
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/evol-colorpicker/css/evol.colorpicker.css?v=1.6"/>
    <script src="/assets/d2eace91/js/jquery-ui.js?v=20180418"></script>
    <script src="/assets/d2eace91/bootstrap/evol-colorpicker/js/evol.colorpicker.js?v=20180418"></script>
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=20180418"></script>
    <link rel="stylesheet" href="/assets/d2eace91/css/design/moduleEditTool.css?v=1.6"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.6"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/design/mobile/swiper.min.css?v=1.6"/>
    <script src="/assets/d2eace91/js/design/swiper.jquery.min.js?v=20180418"></script>

@stop

@section('content')

    <script src="/assets/d2eace91/js/design/TouchSlide.1.1.js?v=20180418"></script>
    <script src="/assets/d2eace91/js/design/bubbleup.js?v=20180418"></script>
    <script src="/assets/d2eace91/js/design/index_tab.js?v=20180418"></script>
    <script src="/assets/d2eace91/js/design/jquery-hdscroll.js?v=20180418"></script>
    <link rel="stylesheet" href="/assets/d2eace91/css/design/mobile/public.css?v=1.6"/>
    <link rel="stylesheet" href="/mobile/css/goods.css?v=1.6"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/design/mobile/tplsetting.css?v=1.6"/>

    <div class="page">
        <div class="goods-preview">
            <div class="goods-entry">
                <h1>商品详情页装修</h1>
                <!--前台详情页start-->
                <div class="goods-content user-goods-ka">
                    <!------------------------------商品详情 相册------------------------------->
                    <div class="swiper-container swiper-container-horizontal">
                        <a href="javascript:void(0)" class="content-selector SZY-DESIGN-GOODS" data-url='/design/navigation/list?nav_page=m_goods&nav_position=3' data-title='导航设置'>
                            <i class="fa fa-edit"></i>
                            编辑
                        </a>
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <a href="javascript:void(0)" class="example-text">
                                    <span class="big-font-size"> 原图尺寸 </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!------------------------------商品详情 start------------------------------->

                    <div class="goods-info">
                        <div class="goods-info-top">
                            <h3 class="SZY-GOODS-NAME">商品名称</h3>
                        </div>
                        <span class="goods-depict color"></span>
                        <div class="goods-price">
                            <div class="now-prices">
                                <em class="price-color">￥99.00</em>
                                <del>￥66.00</del>
                            </div>
                            <span class="sold">销量：1件</span>
                        </div>
                    </div>
                    <div class="blank-div"></div>
                    <!-- 店铺信息 _star-->
                    <div class="store-info show">
                        <a href="javascript:void(0)" class="set-shop-info-btn show-btn  SZY-DESIGN-SHOP" data-code='design_m_goods_shop_is_show'><div class="selector-box"><div class="arrow"></div>设置店铺信息显示和隐藏</div>
                        </a>
                        <div class="design-m-goods-shop">
                            <div class="store-top">
                                <a href="/shop/5.html">
                                    <div class="store-logo">
                                        <img src="http://images.68mall.com/system/config/default_image/default_shop_logo_0.gif">
                                    </div>
                                    <div class="store-item">
                                        <div class="store-name">店铺名称</div>
                                        <p class="score-sum">综合评分：5.00</p>
                                    </div>
                                </a>
                            </div>
                            <ul class="score-detail clearfix">
                                <a href="javascript:void(0)">
                                    <li>
                                        <span class="num">106</span>
                                        <span class="text">全部宝贝</span>
                                    </li>
                                </a>
                                <li>
                                    <span class="num SZY-COLLECT-COUNT">17</span>
                                    <span class="text">关注人数</span>
                                </li>
                                <li>
                                    <p>
                                        <em>描述相符</em>
                                        <i class="color">5.00</i>
                                    </p>
                                    <p>
                                        <em>服务态度</em>
                                        <i class="color">5.00</i>
                                    </p>
                                    <p>
                                        <em>发货速度</em>
                                        <i class="color">5.00</i>
                                    </p>
                                </li>
                            </ul>
                            <div class="store-btn">
                                <!-- 收藏店铺 -->
                                <div class="store-btn-item">
                                    <a href="javascript:void(0);" class="collect-shop">
                                        <i class="store-btn-icon collect-shop-icon">&nbsp;</i>
                                        <span class="store-btn-text">收藏本店</span>
                                    </a>
                                </div>
                                <!-- 进入店铺 -->
                                <div class="store-btn-item">
                                    <a href="/shop/5.html">
                                        <i class="store-btn-icon goto-shop-icon">&nbsp;</i>
                                        <span class="store-btn-text">进入店铺</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--底部样式-->
                    <div class="goods-footer-nav">
                        <a href="javascript:void(0)" class="content-selector SZY-TPL-SETTING" data-url='/design/navigation/list?nav_page=m_goods&nav_position=3' data-title='导航设置'>
                            <i class="fa fa-edit"></i>
                            编辑
                        </a>









                        <a href="javascript:void(0);" class="nav-button">
                            <em class="goods-index-nav" style="background: url(http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/backend/gallery/2018/04/06/15229944431542.png) no-repeat center center;
    background-size: 24px;"></em>
                            <span>美女</span>
                        </a>




                        <dl class="ub-f1">
                            <dd class="flow">
                                <a href="javascript:void(0)" class="button">加入购物车</a>
                            </dd>
                            <dd>
                                <a href="javascript:void(0)" class="button">立即购买</a>
                            </dd>
                        </dl>
                    </div>
                    <!--前台详情页end-->
                </div>
            </div>
        </div>
    </div>

    <div id="design_goods_content" class="hide">
        <div class="page" style="min-height: 50px; padding: 10px 15px 10px 15px;">
            <!-- 温馨提示 -->

            <div class="explanation m-b-10">
                <div class="title">
                    <i class="arrow-icon explain-checkZoom cur-p" title=""></i>
                    <i class="fa fa-bullhorn"></i>
                    <h4>温馨提示</h4>
                </div>
                <ul class="explain-panel">
                    <li>
                        <span>注：如果选择原图会影响详情页的加载速度；大图尺寸：450,450</span>
                    </li>

                </ul>
            </div>

            <form class="form-horizontal">
                <div class="table-content m-t-10 clearfix">
                    <div class="simple-form-field">
                        <div class="form-group">
                            <label for="text4" class="col-sm-3 control-label">
                                <span class="ng-binding">显示模式：</span>
                            </label>
                            <div class="col-sm-9">
                                <label class="control-label cur-p m-r-10">
                                    <input type="radio" id="radio2" name="mian_image_size" value="2" checked>
                                    原图
                                </label>
                                <label class="control-label cur-p m-r-10">
                                    <input type="radio" id="radio1" name="mian_image_size" value="1" >
                                    大图
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <script type="text/javascript">
        $().ready(function() {
            $('.SZY-DESIGN-SHOP').click(function() {
                $.get('/design/tpl-setting/design-setting', {
                    code: $(this).data('code'),
                }, function(result) {
                    if (result.code == 0) {
                        if (result.data == 0) {
                            $('.SZY-DESIGN-SHOP').addClass('hide-btn').removeClass('show-btn');
                            $('.SZY-DESIGN-SHOP').parent().removeClass('show');
                        } else {
                            $('.SZY-DESIGN-SHOP').addClass('show-btn').removeClass('hide-btn');
                            $('.SZY-DESIGN-SHOP').parent().addClass('show');
                        }
                    }
                    $.msg(result.message);
                }, 'json');
            });

            $('.SZY-DESIGN-GOODS').click(function() {
                $.open({
                    type: 1,
                    title: '商品主图设置', //样式类名
                    area: ['620px', ''], //宽高
                    content: $('#design_goods_content').html(),
                    btn: ['确定', '取消'],
                    success: function(layero) {
                        var btn = layero.find('.layui-layer-btn');
                        btn.css('text-align', 'center');
                    },
                    yes: function(index, container) {
                        var value = container.find('input:radio:checked').val();
                        $('#design_goods_content').find('input:radio').removeAttr("checked");
                        $('#design_goods_content').find('input:radio[id="radio' + value + '"]').attr("checked", "checked");
                        $.get('/design/tpl-setting/design-setting', {
                            code: 'design_m_goods_main_image_size',
                            value: value
                        }, function(result) {
                            $.msg(result.message);
                            if (result.code == 0) {
                                if (result.data == 1) {
                                    $('.big-font-size').html('大图尺寸： 450,450');
                                } else {
                                    $('.big-font-size').html('原图尺寸');
                                }
                                setTimeout("$.closeAll()", 1000);
                            }
                        }, 'json');
                    }
                });

            });
        });
    </script>

@stop

@section('outside_body_script')


    <script type="text/javascript">
        /*********外边js start**********/
        $().ready(function() {
            $(".colorPicker").colorpicker();
            // 顶部导航展示形式切换
            $('#foldSidebar').click(function() {
                if ($('.module-main').hasClass('unfold')) {
                    $('.module-main').addClass('fold').removeClass('unfold');
                    $('.quickDress').removeClass('hide');
                    $('#foldSidebar').addClass('styleDesignArrowUp').removeClass('styleDesignArrowDown');
                } else {
                    $('.module-main').addClass('unfold').removeClass('fold');
                    $('.quickDress').addClass('hide');
                    $('#foldSidebar').addClass('styleDesignArrowDown').removeClass('styleDesignArrowUp');
                }
            });
            $('.topBar-navbar a').click(function() {
                $('.module-main').addClass('fold').removeClass('unfold');
                $('.quickDress').removeClass('hide');
                $('#foldSidebar').addClass('styleDesignArrowUp').removeClass('styleDesignArrowDown');

            });
            //隐藏下拉导航
            function hiddenNavbar(){
                $('.module-main').addClass('unfold').removeClass('fold');
                $('.quickDress').addClass('hide');
                $('#foldSidebar').addClass('styleDesignArrowUp').removeClass('styleDesignArrowDown');
            }
            /*鼠标滑过切换tab*/
            function change_tabs(a, b, c) {
                $(a).click(function() {
                    $(this).addClass(c).siblings().removeClass(c);
                    $(b).eq($(this).data('key')-1).show().siblings().hide();
                })
            }
            change_tabs(".topBar-navbar a", ".quickDress .panel", 'active');
            //切换不同页面装修
            $('.top-set-btn').click(function(){
                if($(this).find('.set-btn-box').hasClass('hide')){
                    $(this).find('.set-btn-box').removeClass('hide');
                }else{
                    $(this).find('.set-btn-box').addClass('hide')
                }
            });
            $(".top-set-btn").mouseleave (function(){
                $(this).find('.set-btn-box').addClass('hide')
            });
        });

    </script>

    <script type="text/javascript">
        $(function(){
            $('body').on('click','.SZY-TPL-SELECTOR',function(){
                try{
                    if(hiddenNavbar&&typeof(hiddenNavbar)=="function"){
                        hiddenNavbar();
                    }
                }catch(e){

                }
                var this_obj = $(this);
                delay_till_last(this_obj.uid, function() {
                    //构造数据
                    $.designselector(this_obj);
                }, 300);
            });

            $('body').on('click','.SZY-TPL-SETTING',function(){
                var uid = $(this).data('uid');
                var url = $(this).data('url');
                var title = $(this).data('title');
                var tpl = $(this).data('tpl');
                var container = $(this).data('container');
                if($(this).data('modal') && $(this).data('modal') == '1'){
                    $.loading.start();
                    modal = $.modal($(this));
                    if (modal) {
                        modal.show();
                        $.loading.stop();
                    } else {
                        modal = $.modal({
                            title: title,
                            trigger: $(this),
                            ajax: {
                                url: url,
                            },

                        });
                    }
                }else{
                    $.open({
                        type: 2,
                        area: ['1100px', '610px'],
                        //btn: true,
                        fix: true,
                        maxmin: true,
                        title: title,
                        content: url,
                        end: function(result) {
                            if(uid != undefined){
                                refreshTpl(page, uid);
                            }else{
                                //window.location.reload();
                                //刷新
                                if(tpl){
                                    ajaxRender(page, tpl, container);
                                }else{
                                    window.location.reload();
                                }
                            }
                        }
                    });
                }
            });

            $('body').on('click','.SZY-THEME-TPL',function(){
                var id = $(this).data("id");
                $.confirm("确定使用此主题模板吗？ 注意：此操作不可恢复！", function() {
                    $.loading.start();
                    $.ajax({
                        url: '/site/tpl-backup',
                        dataType: 'json',
                        data: {
                            action: 'usetpl',
                            id: id,
                            topic_id: topic_id
                        },
                        success: function(result) {
                            $.msg(result.message,{
                                time:2000
                            },function(){
                                window.location.reload();
                            });
                            //refreshTpl(page);
                        }
                    });
                });
            });

            //选择页面显示隐藏js
            $('.page-title').click(function() {
                $('.page-title-nav').show();
            });
            $('.bv-header-close').click(function() {
                $('.page-title-nav').hide();
            });
            $('.bv-container li').click(function(){
                $.go($(this).data('url'));
            });

        });
    </script>


@stop