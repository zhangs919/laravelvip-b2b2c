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
                    <li class="active">我的投诉</li>
                </ul>
            </div>
            <div class="content-info refund-return-list">
                <div class="complaint-list">
                    <form id='searchForm' method='GET' action="" name="">
                        <div class="screen-term">
                            <label style="width: 30%;">
                                <span>订单编号：</span>
                                <input id="order_id" type="text" name="order_id" />
                            </label>
                            <label style="width: 30%;">
                                <span>投诉编号：</span>
                                <input type="text" name="complaint_id" id="complaint_id" />
                            </label>
                            <label style="width: 30%;">
                                <span>投诉状态：</span>
                                <select id="complaint_status">
                                    <option value="-1">全部</option>
                                    @foreach($complaint_status_list as $key=>$item)
                                        <option value="{{ $key }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </label>
                            <label style="width: 30%;">
                                <span>申请时间：</span>
                                <select id="complaint_time">
                                    <option value="0">全部</option>
                                    <option value="1">近3个月的订单</option>
                                    <option value="2">近半年的订单</option>
                                    <option value="3">今年内的订单</option>

                                </select>
                            </label>
                            <label style="width: 10%;">
                                <input type="submit" value="搜索" class="search" />
                            </label>
                        </div>
                    </form>

                    <!---->
                    {{--引入列表--}}
                    @include('user.complaint.partials._list')

                    <!---->

                </div>
                <div class="operat-tips">
                    <h4>我的投诉注意事项</h4>
                    <ul class="operat-panel">
                        <li>
                            <span>交易状态为“交易成功”后，{{ $involve_time }}天内可以投诉商家</span>
                        </li>
                        <li>
                            <span>可申请由平台方介入处理投诉，如投诉成功后，被投诉店铺将会受到惩罚</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>


        <a class="scroll-to-top"><i class="fa fa-chevron-up"></i></a>


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
    <script src="/assets/d2eace91/min/js/message.min.js"></script>
    <script>
        $().ready(function() {
            var tablelist = $("#table_list").tablelist({
                params: $("#searchForm").serializeJson()
            });
            $("#searchForm").submit(function() {
                tablelist.load({
                    // 订单编号
                    'order_id': $("#order_id").val(),
                    // 投诉编号
                    'complaint_id': $("#complaint_id").val(),
                    //投诉状态
                    'complaint_status': $("#complaint_status").val(),
                    //投诉时间
                    'complaint_time': $("#complaint_time").val(),
                });
                return false;
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