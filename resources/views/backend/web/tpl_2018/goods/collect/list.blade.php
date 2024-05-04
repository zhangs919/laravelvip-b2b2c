{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <!-- 工具栏（列表名称、列表显示项设置） -->
    <!--
<div class="common-title">
    <div class="ftitle">
        <h3>数据采集列表</h3>

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



    </div>
</div>-->
    <!--列表内容-->
    <form method="post" action="/goods/collect/add-goods" class="form-horizontal" onsubmit="return checksubmit()">
        <div class="table-responsive" id="table_list">

            <table class="table table-hover">
                <thead>
                <tr>
                    <th class="tcheck">
                        <!--<input type="checkbox" />-->
                    </th>
                    <th class="text-c w80">编号</th>
                    <th class="w150">三方ID号</th>
                    <th class="w300">商品名称</th>
                    <th class="text-c w100">价格（元）</th>
                    <th class="text-c w100">评论数（条）</th>
                    <!--<th class="handle w100">操作</th>-->
                </tr>
                </thead>
                <tbody>

                @foreach($list as $key=>$item)
                <tr>
                    <td class="tcheck">
                        <input type="checkbox" class="checkbox" name="goods_ids[]" value="{{ $item['third_goods_id'] }}" checked="">
                    </td>
                    <td class="text-c">{{ $key+1 }}</td>
                    <td>{{ $item['third_goods_id'] }}</td>
                    <td>
                        <div class="goodsPicBox pull-left m-r-10">
                            <a href="javascript:;" >
                                <!-- 图片缩略图 -->
                                <img src="{{ $item['images'] }}" class="goods-thumb">
                            </a>
                        </div>
                        <div class="ng-binding goods-message w200">
                            <div class="name">
                                <a href="javascript:;" data-toggle="tooltip" data-placement="auto bottom" title="" data-original-title="{{ $item['goods_name'] }}">{{ $item['goods_name'] }}</a>
                            </div>

                        </div>
                    </td>
                    <td class="text-c">{{ $item['goods_price'] }}</td>
                    <td class="text-c">{{ $item['tm_count'] }}</td>
                    <!--<td class="handle">
                        <a href="javascript:;" class="del">删除</a>
                    </td>-->
                </tr>
                @endforeach

                {{--<tr>--}}
                    {{--<td class="tcheck">--}}
                        {{--<input type="checkbox" class="checkbox" name="goods_ids[]" value="577454871963" checked="">--}}
                    {{--</td>--}}
                    {{--<td class="text-c">1</td>--}}
                    {{--<td>577454871963</td>--}}
                    {{--<td>--}}
                        {{--<div class="goodsPicBox pull-left m-r-10">--}}
                            {{--<a href="javascript:;" target="_blank">--}}
                                {{--<!-- 图片缩略图 -->--}}
                                {{--<img src="http://gd1.alicdn.com/imgextra/i4/57709795/O1CN012ME9vE6SGJOIIwt_!!57709795.jpg" class="goods-thumb">--}}
                            {{--</a>--}}
                        {{--</div>--}}
                        {{--<div class="ng-binding goods-message w200">--}}
                            {{--<div class="name">--}}
                                {{--<a href="javascript:;" target="_blank" data-toggle="tooltip" data-placement="auto bottom" title="" data-original-title="GBOY秋冬季港风chic加绒卫衣男连帽衫潮牌情侣加厚ins超火的外套">GBOY秋冬季港风chic加绒卫衣男连帽衫潮牌情侣加厚ins超火的外套</a>--}}
                            {{--</div>--}}

                        {{--</div>--}}
                    {{--</td>--}}
                    {{--<td class="text-c">108.00</td>--}}
                    {{--<td class="text-c">0</td>--}}
                    {{--<!--<td class="handle">--}}
                        {{--<a href="javascript:;" class="del">删除</a>--}}
                    {{--</td>-->--}}
                {{--</tr>--}}

                </tbody>
                <tfoot>
                <tr>
                    <!--<td class="text-c w10">
                        <input type="checkbox" class="checkBox" />
                    </td>-->
                    <td colspan="6">
                        <div class="pull-left"><!--<a class="btn btn-danger m-r-5" href="javascript:;">删除</a>--><a class="btn btn-primary" href="/goods/collect/show">重新抓取</a></div>

                        <!--<div class="pull-right page-box"></div>-->

                    </td>
                </tr>
                </tfoot>
            </table>

        </div>
        <div class="table-content m-t-10 clearfix">

            <div class="simple-form-field">
                <div class="form-group">
                    <div class="col-xs-12 text-c">
                        <button class="btn btn-primary f14" style="padding: 10px 68px;">开始导入</button>
                    </div>
                </div>
            </div>

        </div>

    </form>

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
        function checksubmit(){
            if($("input[type='checkbox']:checked").length <= 0){
                $.msg("请选择要导入的商品！");
                return false;
            }
        }
    </script>

@stop

{{--outside body script--}}
@section('outside_body_script')

@stop