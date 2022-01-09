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
            <h3>店铺会员等级列表</h3>

            <h5>
                (&nbsp;共
                <span data-total-record="true"></span>
                条记录&nbsp;)
            </h5>

        </div>
        <div class="operate m-l-20">

            <a class="reload" href="javascript:reload();" data-toggle="tooltip" data-placement="auto bottom" title="" data-original-title="刷新数据">
                <i class="fa fa-refresh"></i>
            </a>
            <script type="text/javascript">
                function reload() {

                }
            </script>



        </div>
    </div>
    <div id="open_edit"></div>
    <div class="table-responsive">
        <!---->
        {{--引入列表--}}
        @include('user.shop.partials._list')

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
                    confirm: '您确定删除这个等级吗？',
                    url: 'delete',
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