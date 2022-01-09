{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20180702"/>
@stop

{{--content--}}
@section('content')


    @include('shop.freight.partials._list')

@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block--}}
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
                var id = $(this).data("id");
                tablelist.remove({
                    confirm: '删除运费模板后系统将会自动下架所有绑定此运费模板的商品，这些下架的商品必须重新编辑选择运费模板后才能上架，您确定要继续删除此运费模板吗？',
                    url: '/shop/freight/delete',
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