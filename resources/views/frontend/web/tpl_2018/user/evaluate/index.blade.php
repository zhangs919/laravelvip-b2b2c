@extends('layouts.user_layout')

{{--header_js--}}
@section('header_js')

@stop

@section('content')

    <!-- 正文，由view提供 -->
    <div class="con-right fr"><!---->
        <div class="con-right fr">
            <div class="con-right-text">
                <div class="tabmenu">
                    <ul class="tab">
                        <li class="active">我的评价</li>
                    </ul>
                </div>
                <div class="content-info">
                    <div class="content-list evaluate-list">
                        <form id="searchForm" class="screen-term" method="GET">
                            <label style="width: 30%;">
                                <span>评价等级：</span>
                                <select name="comment_level">
                                    <option value="0">全部评价</option>
                                    <option value="1">好评</option>
                                    <option value="2">中评</option>
                                    <option value="3">差评</option>
                                </select>
                            </label>
                            <label style="width: 30%;">
                                <span>评论内容：</span>
                                <select name="comment_content">
                                    <option value="0">全部评论</option>
                                    <option value="1">有评论内容</option>
                                    <option value="2">无评论内容</option>
                                    <option value="3">有追加评论内容</option>
                                </select>
                            </label>
                            <label style="width: 40%;">
                                <input type="button" id="btn_search" value="搜索" class="search" />
                            </label>
                        </form>
                        <div class="evaluate-table ">
                            <div class="evaluate-list-head">
                                <ul>
                                    <li style="width: 50%;">宝贝信息</li>
                                    <li style="width: 20%;">评分</li>
                                    <li style="width: 30%;">评价状态</li>
                                </ul>
                            </div>
                            <!---->
                            {{--引入列表--}}
                            @include('user.evaluate.partials._list')
                            <!---->
                        </div>
                    </div>
                    <div class="operat-tips">
                        <h4>评价注意事项</h4>
                        <ul class="operat-panel">
                            <li>
                                <span>如买家恶意评价，平台方一经核实，将有权隐藏您的评价信息，如有疑问，请联系平台方客服处理</span>
                            </li>
                            <li>
                                <span>平台方开启评论审核后，买家提交的评论，平台方审核通过后才可在商品评论中展示</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            //
        </script>
        <script type='text/javascript'>
            //
        </script>
        <script type="text/javascript">
            //
        </script>
        <!---->
    </div>

@stop

{{--底部js--}}
@section('footer_js')
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
    <script src="/assets/d2eace91/js/pic/highslide-with-gallery.js"></script>
    <script src="/assets/d2eace91/min/js/message.min.js"></script>
    <script>
        $().ready(function() {
            $(".pagination-goto > .goto-input").keyup(function(e) {
                $(".pagination-goto > .goto-link").attr("data-go-page", $(this).val());
                if (e.keyCode == 13) {
                    $(".pagination-goto > .goto-link").click();
                }
            });
            $(".pagination-goto > .goto-button").click(function() {
                var page = $(".pagination-goto > .goto-link").attr("data-go-page");
                if ($.trim(page) == '') {
                    return false;
                }
                $(".pagination-goto > .goto-link").attr("data-go-page", page);
                $(".pagination-goto > .goto-link").click();
                return false;
            });
        });
        // 
        var tablelist = null;
        $().ready(function() {
            tablelist = $("#table_list").tablelist({
                params: $("#searchForm").serializeJson()
            });
            $("#btn_search").click(function() {
                // 序列化表单为JSON对象
                var data = $("#searchForm").serializeJson();
                // Ajax加载数据
                tablelist.load(data);
                // 阻止表单提交
                return false;
            });
            // 回复卖家
            $("body").on("click", ".reply", function() {
                var comment_id = $(this).data("comment-id");
                $.loading.start();
                $.open({
                    type: 1,
                    title: '回复卖家',
                    ajax: {
                        url: '/user/evaluate/reply.html',
                        data: {
                            comment_id: comment_id
                        }
                    },
                    width: 500,
                    btn: ['确定', '取消'],
                    yes: function(index, obj) {
                        var data = $(obj).serializeJson();

                        if ($.trim(data.content) == 0) {
                            $(obj).find(".comment-content").focus();
                            $.msg("请输入回复内容！");
                            return;
                        } else if ($.trim(data.content).length > 400) {
                            $(obj).find(".comment-content").focus();
                            $.msg("恢复内容不能超过400个字！");
                            return;
                        }
                        $.post("/user/evaluate/reply.html", data, function(result) {
                            if (result.code == 0) {
                                $.closeDialog(index);
                                $.msg(result.message);
                                $.go(window.location.href);
                            } else {
                                $.msg(result.message, {
                                    time: 5000
                                });
                            }
                        }, "JSON");
                    }
                }).always(function() {
                    $.loading.stop();
                });
            });
        });
        // 
        $("body").on('click', '.photos-close', function(event) {
            var img_id = $(this).parent("a").attr("id");
            var tip = $(this).parent("a").data("tip");
            var type = $(this).parent("a").parent("div").data("type");
            var id = $(this).parent("a").parent("div").parent("div").data("id");
            $.ajax({
                type: 'GET',
                url: '/user/evaluate/removo-img?id=' + id + "&tip=" + tip + "&type=" + type,
                dataType: 'json',
                success: function(result) {
                    $("#" + img_id).remove();
                }
            })
        });
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
