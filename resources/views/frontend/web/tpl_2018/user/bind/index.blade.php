@extends('layouts.user_layout')

{{--header_js--}}
@section('header_js')

@stop

@section('content')

    <!-- 正文，由view提供 -->
    <div class="con-right fr">
        <div class="con-right-text">
            <div class="tabmenu">
                <ul class="tab">
                    <li class="active">账号绑定</li>
                    <li class="li-spe">（绑定第三方账户，绑定成功后即可使用第三方账户快速登录）</li>
                </ul>
            </div>
            <div class="content-info">
                <div id="safe" class="binding">
                    @if(empty($user_info->qq_key))
                        <div class="safe-list">
                            <div class="fore1">
                                <s class="fore1-bg1"></s>
                                <strong>QQ账户</strong>
                            </div>
                            <div class="fore2">
                                <span>您还没有绑定qq账户，绑定后您可以使用qq快速登录。</span>
                            </div>
                            <div class="fore3">
                                <a href="javascript:;" data-id="qq" class="btn bind">快速绑定</a>
                            </div>
                        </div>
                    @else
                        <div class="safe-list">
                            <div class="fore1">
                                <s class="fore1-bg1"></s>
                                <strong>QQ账户</strong>
                            </div>
                            <div class="fore2">
                                <span>已绑定QQ</span>
                            </div>
                            <div class="fore3">
                                <a href="javascript:void(0);" data-id="qq" class="btn remove-bind">解除绑定</a>
                            </div>
                        </div>
                    @endif

                    @if(empty($user_info->weibo_key))
                        <div class="safe-list">
                            <div class="fore1">
                                <s class="fore1-bg3"></s>
                                <strong>新浪微博账户</strong>
                            </div>
                            <div class="fore2">
                                <span>您还没有绑定新浪微博账户，绑定后您可以使用新浪微博账户快速登录。</span>
                            </div>
                            <div class="fore3">
                                <a href="javascript:;" data-id="weibo" class="btn bind">快速绑定</a>
                            </div>
                        </div>
                    @else
                        <div class="safe-list">
                            <div class="fore1">
                                <s class="fore1-bg3"></s>
                                <strong>新浪微博账户</strong>
                            </div>
                            <div class="fore2">
                                <span>已绑定新浪微博</span>
                            </div>
                            <div class="fore3">
                                <a href="javascript:;" data-id="weibo" class="btn remove-bind">解除绑定</a>
                            </div>
                        </div>
                    @endif


                    @if(empty($user_info->weixin_key))
                        <div class="safe-list">
                            <div class="fore1">
                                <s class="fore1-bg4"></s>
                                <strong>微信账户</strong>
                            </div>
                            <div class="fore2">
                                <span>您还没有绑定微信账户，绑定后您可以使用微信账户快速登录。</span>
                            </div>
                            <div class="fore3">
                                <a href="javascript:;" data-id="pc_weixin" class="btn bind">快速绑定</a>
                            </div>
                        </div>
                    @else
                        <div class="safe-list">
                            <div class="fore1">
                                <s class="fore1-bg4"></s>
                                <strong>微信账户</strong>
                            </div>
                            <div class="fore2">
                                <span>已绑定微信</span>
                            </div>
                            <div class="fore3">
                                <a href="javascript:;" data-id="pc_weixin" class="btn remove-bind">解除绑定</a>
                            </div>
                        </div>
                    @endif

                        @if(empty($user_info->github_key))
                            <div class="safe-list">
                                <div class="fore1">
{{--                                    <s class="fore1-bg4"></s>--}}
                                    <strong>github账户</strong>
                                </div>
                                <div class="fore2">
                                    <span>您还没有绑定github账户，绑定后您可以使用github账户快速登录。</span>
                                </div>
                                <div class="fore3">
                                    <a href="javascript:;" data-id="github" class="btn bind">快速绑定</a>
                                </div>
                            </div>
                        @else
                            <div class="safe-list">
                                <div class="fore1">
{{--                                    <s class="fore1-bg4"></s>--}}
                                    <strong>github账户</strong>
                                </div>
                                <div class="fore2">
                                    <span>已绑定github</span>
                                </div>
                                <div class="fore3">
                                    <a href="javascript:;" data-id="github" class="btn remove-bind">解除绑定</a>
                                </div>
                            </div>
                        @endif
                </div>
            </div>
        </div>
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
    <script src="/assets/d2eace91/min/js/message.min.js"></script>
    <script>
        $().ready(function() {
            // 解除绑定
            $("body").on('click', '.remove-bind', function() {
                var key = $(this).data("id");
                $.confirm("您确定要解除绑定吗？", function() {
                    $.ajax({
                        type: "GET",
                        url: "/user/bind/remove",
                        dataType: "json",
                        data: {
                            key: key
                        },
                        success: function(result) {
                            $.msg(result.message);
                            $.go('/user/bind.html');
                        }
                    })
                });
            })
            $("body").on('click', '.bind', function() {
                var type = $(this).data("id");
                $.go("http://{{ config('lrw.frontend_domain') }}" + "/website/login?type=" + type);
            })
        });
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