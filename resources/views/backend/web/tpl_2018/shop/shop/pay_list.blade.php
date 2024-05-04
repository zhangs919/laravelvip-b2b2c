{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')

@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <div class="common-title">
        <div class="ftitle">
            <h3>付款信息列表</h3>

            <h5>
                (&nbsp;共
                <span data-total-record="true" class="pagination-total-record"></span>
                条记录&nbsp;)
            </h5>

        </div>
        <div class="operate m-l-20">

            <a class="reload" href="javascript:reload();" data-toggle="tooltip" data-placement="auto bottom" title="刷新数据">
                <i class="fa fa-refresh"></i>
            </a>
            <script type="text/javascript">
                function reload() {

                }
            </script>


            <span class="rline"></span>


            <div class="editTablebox">
                <a href="javascript:void(0);" class="editBtn">
                    <i class="fa fa-cogs"></i>
                </a>
                <div class="edit-table dropdown-menu animated fadeInDown">
                    <h5>设置表格显示项</h5>
                    <ul>





                        <li>
                            <label>

                                <input type="checkbox" id="editColumn_pay_time" class="checkBox" checked="checked">

                                <span> 付款时间 </span>
                            </label>
                        </li>





                        <li>
                            <label>

                                <input type="checkbox" id="editColumn_pay_code" class="checkBox" checked="checked">

                                <span> 付款方式 </span>
                            </label>
                        </li>





                        <li>
                            <label>

                                <input type="checkbox" id="editColumn_payment" class="checkBox" checked="checked">

                                <span> 付款金额 </span>
                            </label>
                        </li>





                        <li>
                            <label>

                                <input type="checkbox" id="editColumn_pay_status" class="checkBox" checked="checked">

                                <span> 付款状态 </span>
                            </label>
                        </li>





                        <li>
                            <label>

                                <input type="checkbox" id="editColumn_end_time" class="checkBox" checked="checked">

                                <span> 店铺到期时间 </span>
                            </label>
                        </li>





                        <li>
                            <label>

                                <input type="checkbox" id="editColumn_remark" class="checkBox" checked="checked">

                                <span> 备注 </span>
                            </label>
                        </li>

                    </ul>
                </div>
            </div>

        </div>
    </div>
    <!--列表内容-->
    <div class="table-responsive">

        {{--引入列表--}}
        @include('shop.shop.partials._pay_list')

    </div>


@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block page元素同级下面--}}
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
    <script type="text/javascript">
        $().ready(function() {
            var tablelist = $("#table_list").tablelist();
            // 删除记录
            $("body").on('click', '.del', function() {
                var id = $(this).attr("object_id");
                tablelist.remove({
                    confirm: '您确定删除这条记录吗？',
                    url: 'pay-delete',
                    data: {
                        id: id
                    }
                });
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop