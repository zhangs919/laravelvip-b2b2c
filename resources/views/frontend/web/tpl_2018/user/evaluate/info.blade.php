@extends('layouts.user_layout')

{{--header_css--}}
@section('header_css')
    <link href="/assets/d2eace91/css/highslide.css" rel="stylesheet">
@stop

{{--header_js--}}
@section('header_js')

@stop

@section('content')

    <!-- 正文，由view提供 -->
    <div class="con-right fr">
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

                            @include('user.evaluate.partials._eval_goods')


                            <script type='text/javascript'>
                                //
                            </script>
                            <script type="text/javascript">
                                //
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

                @include('user.evaluate.partials._eval_shop')

                <!-- 店铺评分end -->
            </div>
        </div>
        <!---->
        <script type="text/javascript">
            //
        </script>
        <script type="text/javascript">
            //
        </script>
        <!-- -->
    </div>

@stop


{{--底部js--}}
@section('footer_js')
    <!-- 积分提醒 -->
    <!-- 消息提醒 -->
    <script type="text/javascript">
        // 
    </script>
    <script src="/js/common.js"></script>
    <script src="/js/user.js"></script>
    <script src="/assets/d2eace91/js/yii.js"></script>
    <script src="/assets/d2eace91/js/layer/layer.js"></script>
    <script src="/assets/d2eace91/js/jquery.method.js"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js"></script>
    <script src="/assets/d2eace91/js/common.js"></script>
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js"></script>
    <script src="/assets/d2eace91/js/jquery.cookie.js"></script>
    <script src="/js/jquery.fly.min.js"></script>
    <script src="/assets/d2eace91/js/szy.cart.js"></script>
    <script src="/js/jquery.raty.js"></script>
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js"></script>
    <script src="/js/evaluate.js"></script>
    <script src="/assets/d2eace91/js/pic/highslide-with-gallery.js"></script>
    <script src="/assets/d2eace91/min/js/message.min.js"></script>
    <script>
        //商品星级评价 依赖于js/jquery.raty.js
        $().ready(function() {
            $.fn.raty.defaults.path = '/images/star-rank';
            $.fn.raty.defaults.scoreName = "score";
            $.fn.raty.defaults.hints = {!! json_encode($score_desc['desc']) !!};
            $("div[class='star rank_star']").raty();
        });
        // 
        var imgpath = "";
        $().ready(function() {
            $(".comment-images").each(function() {
                var sku_id = $(this).data("sku-id");
                var imagegorup = $(this).imagegroup({
                    host: "{{ get_oss_host() }}",
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
                    },
                    change: function(value, values){
                        $("#images_" + sku_id).val(value);
                    }
                });
            });
        });
        // 
        //商品星级评价 依赖于js/jquery.raty.js
        $().ready(function() {
            $.fn.raty.defaults.path = '/images/star-rank';
            $.fn.raty.defaults.scoreName = "service_desc_score";
            $.fn.raty.defaults.hints = {!! json_encode($score_desc['service_desc']) !!};
            $('#default-demo1').raty();
            $.fn.raty.defaults.scoreName = "send_desc_score";
            $.fn.raty.defaults.hints = {!! json_encode($score_desc['send_desc']) !!};
            $('#default-demo2').raty();
            $.fn.raty.defaults.scoreName = "logistics_speed_score";
            $.fn.raty.defaults.hints = {!! json_encode($score_desc['logistics_speed']) !!};
            $('#default-demo3').raty();
        });
        // 
        $().ready(function() {
            $("#").children(".evaluate-box").css("display", "block")
        })
        // 
        $(function(){
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
        })
        // 
        $(document).ready(function() {
            $(".SZY-SEARCH-BOX-TOP .SZY-SEARCH-BOX-SUBMIT-TOP").click(function() {
                if ($(".search-li-top.curr").attr('num') == 0) {
                    var keyword_obj = $(this).parents(".SZY-SEARCH-BOX-TOP").find(".SZY-SEARCH-BOX-KEYWORD");
                    var keywords = $(keyword_obj).val();
                    if ($.trim(keywords).length == 0 || $.trim(keywords) == "请输入关键词") {
                        keywords = $(keyword_obj).data("searchwords");
                    }
                    $(keyword_obj).val(keywords);
                }
                $(this).parents(".SZY-SEARCH-BOX-TOP").find(".SZY-SEARCH-BOX-FORM").submit();
            });
        });
        // 
        $().ready(function() {
        })
        // 
        $().ready(function() {
            WS_AddPoint({
                user_id: '{{ $user_info['user_id'] ?? 0 }}',
                url: "{{ get_ws_url('4431') }}",
                type: "add_point_set"
            });
        }, 'JSON');
        function addPoint(ob) {
            if (ob != null && ob != 'undefined') {
                if (ob.point && ob.point > 0 && ob.user_id && ob.user_id == '{{ $user_info['user_id'] ?? 0 }}') {
                    $.intergal({
                        point: ob.point,
                        name: '积分'
                    });
                }
            }
        }
        // 
    </script>
@stop