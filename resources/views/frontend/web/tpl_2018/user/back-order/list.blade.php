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
                    <li class="active">@if($type)换货维修@else退款退货@endif</li>
                </ul>
            </div>
            <div class="content-info">
                <div class="content-list refund-return-list">
                    <form id="searchForm" action="/user/back.html" method="GET">
                        <div class="screen-term">
                            <label style="width: 29%;">
                                <span>订单编号：</span>
                                <input type="text" id="order_sn" class="form-control" name="order_sn" placeholder="订单编号">
                            </label>
                            @if($type)
                                <label style="width: 29%;">
                                    <span>售后编号：</span>
                                    <input type="text" id="back_sn" class="form-control" name="back_sn">
                                </label>
                                <label style="width: 30%;">
                                    <span>售后类型：</span>
                                    <span class="select">
                                        <select id="back_type" class="form-control" name="back_type">
                                            <option value="">全部</option>
                                            <option value="3">换货</option>
                                            <option value="4">维修</option>
                                        </select>
                                    </span>
                                </label>
                                <label style="width: 40%;">
                                    <span>售后状态：</span>
                                    <span class="select">
                                        <select id="back_status" class="form-control" name="back_status">
                                            <option value="">全部</option>
                                            <option value="0">买家申请售后，等待卖家确认</option>
                                            <option value="5">卖家不同意，等待买家修改</option>
                                            <option value="1">卖家同意售后申请，等待买家确认完成</option>
                                            <option value="4">售后成功</option>
                                            <option value="6">售后关闭</option>
                                        </select>
                                    </span>
                                </label>
                                <label style="width: 30%;">
                                    <span>申请时间：</span>
                                    <span class="select">
                                        <select id="add_time" class="form-control" name="add_time">
                                            <option value="">全部</option>
                                            <option value="3">近三个月售后单</option>
                                            <option value="6">近半年售后单</option>
                                            <option value="12">今年内售后单</option>
                                        </select>
                                    </span>
                                </label>
                            @else
                            <label style="width: 29%;">
                                <span>退款退货单编号：</span>
                                <input type="text" id="back_sn" class="form-control" name="back_sn" placeholder="退款退货单编号">
                            </label>
                            @endif

                            <label>
                                <input id="btn_submit" type="submit" value="搜索" class="search" />
                            </label>
                        </div>
                    </form>



                    {{--引入列表--}}
                    @include('user.back-order.partials._list')

                </div>

                @if($type)
                    <div class="operat-tips">
                        <h4>换货维修注意事项</h4>
                        <ul class="operat-panel">
                            <li>
                                <span>1、买家“确认收货”前和“确认收货”后发起的“仅退款/退款退货”申请均属于退款退货管理。</span>
                            </li>
                            <li>
                                <span>2、买家“确认收货”后发起的维修申请、换货申请均属于换货维修管理。</span>
                            </li>
                            <li>
                                <span>3、买家“确认收货”后可且仅可发起一次换货、维修申请（换货、维修“确认完成”认为是一次机会），如后期还有其他售后需要可联系客服。</span>
                            </li>
                            <li>
                                <span>4、换货流程：1.申请换货&gt;2.卖家发送退货地址给买家 &gt; 3.买家和卖家线下完成换货 &gt; 4.买家线上确认完成。</span>
                            </li>
                            <li>
                                <span>5、维修流程：1.申请维修&gt;2.卖家发送退货地址给买家 &gt; 3.买家和卖家线下完成维修&gt; 4.买家线上确认完成。</span>
                            </li>
                        </ul>
                    </div>
                @else
                    <div class="operat-tips">
                        <h4>退款退货注意事项</h4>
                        <ul class="operat-panel">
                            <li>
                                <span>买家“确认收货”前和“确认收货”后发起的“仅退款/退款退货”申请均属于退款退货管理。</span>
                            </li>
                            <li>
                                <span>买家“确认收货”后发起的维修申请、换货申请均属于换货维修管理。</span>
                            </li>
                            <li>
                                <span>卖家同意退款后，退款信息将自动推送至平台方，由平台方管理员为买家退款。</span>
                            </li>
                        </ul>
                    </div>
                @endif

            </div>
        </div>

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
            // 加载时加入即时查询搜索条件
            tablelist = $("#table_list").tablelist({
                params: $("#searchForm").serializeJson()
            });
            // 搜索
            $("#searchForm").submit(function() {
                // 序列化表单为JSON对象
                var data = $(this).serializeJson();
                console.info(data);
                // Ajax加载数据
                tablelist.load(data);
                // 阻止表单提交
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
            $('.site_to_yikf').click(function() {
                $(this).parent('form').submit();
            })
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