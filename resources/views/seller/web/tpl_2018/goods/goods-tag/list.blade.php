{{--模板继承--}}
@extends('layouts.seller_layout')

{{--header 内 css文件--}}
@section('header_css')
@stop

{{--header 内 css文件--}}
@section('header_css_2')
@stop

{{--content--}}
@section('content')

    <!--搜索-->
    <div class="search-term m-b-10">
        <form id="searchForm" action="/goods/goods-tag/list.html" method="GET">		<div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>关键词：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input name="keyword" id='keyword' class="form-control" type="text" placeholder="商品标签名称">
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>标签显示位置：</span>
                    </label>
                    <div class="form-control-wrap"><select id="tag_position" class="form-control" name="tag_position">
                            <option value="">请选择</option>
                            @foreach($tagPosition as $k=>$v)
                            <option value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select></div>
                </div>
            </div>
            <div class="simple-form-field">
                <button class="btn btn-primary m-r-5">搜索</button>
                <!-- <button class="btn btn-default m-r-5">导出</button> -->
            </div>
        </form>	</div>

    <div class="common-title">
        <div class="ftitle">
            <h3>商品标签列表</h3>

            <h5>
                (&nbsp;共
                <span data-total-record="true" class="pagination-total-record"></span>
                条记录&nbsp;)
            </h5>

        </div>
        <div class="operate m-l-20">

            <a class="reload" href="javascript:tablelist.load();" data-toggle="tooltip" data-placement="auto bottom" title="刷新数据">
                <i class="fa fa-refresh"></i>
            </a>



        </div>
    </div>	<!--列表内容-->
    <div class="table-responsive">

        {{--引入列表--}}
        @include('goods.goods-tag.partials._list')

    </div>

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

{{--footer_js page元素同级下面--}}
@section('footer_js')
    <script src="/assets/d2eace91/min/js/upload.min.js"></script>
@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
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
        $().ready(function() {
            var tablelist = $("#table_list").tablelist({
                params: $("#searchForm").serializeJson()
            });
            $("#searchForm").submit(function() {
                tablelist.load({
                    //问题名称
                    'keyword': $("#keyword").val(),
                    'tag_position': $("#tag_position").val(),
                });
                return false;
            });
            // 删除记录  
            $("body").on('click', '.del', function() {
                var id = $(this).attr("object_id");
                $.confirm('您确定删除这条记录吗？', function() {
                    $.post('/goods/goods-tag/delete', {
                        id: id
                    }, function(result) {
                        if (result.code == 0) {
                            $.msg(result.message);
                            $.go('list');
                        } else {
                            $.msg(result.message, {
                                time: 5000
                            })
                        }
                    }, "json");
                })
            });
            // 批量删除
            $("body").on("click", ".batch-del", function() {
                var ids = tablelist.checkedValues();
                if (ids.length == 0) {
                    $.msg("您没有选择任何待处理的数据！");
                    return;
                }
                console.info(ids);
                tablelist.remove({
                    confirm: '您确定批量删除吗？',
                    url: 'batch-delete',
                    data: {
                        ids: ids
                    }
                });
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop