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
                    <li class="active">
                        设置余额支付密码
                    </li>
                </ul>
            </div>
            <div class="content-info">
                <div id="safe-info" class="safe-con">
                    {{--include file--}}
                    @include('user.security.edit_password_1')
                </div>
            </div>
        </div>
        <!-- 验证码脚本 -->
        <script type="text/javascript">
            // 
        </script>
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
    <script src="/assets/d2eace91/js/jquery.captcha.js"></script>
    <script src="/js/login.js"></script>
    <script src="/assets/d2eace91/min/js/message.min.js"></script>
    <script>
        $().ready(function() {
            function load_form(type) {
                var url = '/user/security/validate.html';
                $.ajax({
                    type: 'GET',
                    url: url,
                    dataType: 'json',
                    data: {
                        type: type
                    },
                    success: function(result) {
                        if (result.code == 0) {
                            $("#safe-info").html(result.data);
                        } else {
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    }
                });
            }
            $("#safe-info").on('change', '#type', function() {
                var type = $(this).val();
                var service_type = '{{ $service_type }}';
                var s_type = service_type.replace(/_/g, '-');
                $.get('/user/security/' + s_type + '.html', {
                    type: type
                }, function(result) {
                    if(result.code == 0){
                        load_form(type);
                    }else{
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "JSON");
            });
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