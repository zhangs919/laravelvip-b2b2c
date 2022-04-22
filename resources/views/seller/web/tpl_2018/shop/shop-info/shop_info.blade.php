{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20180702"/>
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=20180702"></script>
@stop

{{--content--}}
@section('content')

    <!--个人店铺认证信息-->


    <div class="m-t-10">
        <table class="table table-bordered">
            <colgroup>
                <col class="w150" />
                <col class="w200" />
                <col class="w150" />
                <col class="w200" />
                <col class="w150" />
                <col class="w200" />
            </colgroup>
            <thead>
            <tr>
                <th class="handle text-l" colspan="6">店铺联系人信息</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-r">联系人姓名：</td>
                <td class="text-l">{{ $shop_field_value->real_name }}</td>
                <td class="text-r">联系人电话：</td>
                <td class="text-l">13333333333</td>
                <td class="text-r">电子邮箱：</td>
                <td class="text-l"></td>
            </tr>
            <tr>
                <td class="text-r">联系地址：</td>
                <td class="text-l" colspan="5">{{ $shop_field_value->address }}</td>
            </tr>
            <tr>
                <td class="text-r">身份证号：</td>
                <td class="text-l" colspan="5">{{ $shop_field_value->card_no }}</td>
            </tr>
            <tr>
                <td class="text-r">身份证正面：</td>
                <td class="text-l" colspan="5">
                    <a href="javascript:void(0);" ref="{{ get_image_url($shop_field_value->card_side_a) }}" class="preview m-l-5">
                        <img src="/images/brand.jpg" />
                    </a>
                </td>
            </tr>
            <tr>
                <td class="text-r">身份证背面：</td>
                <td class="text-l" colspan="5">
                    <a href="javascript:void(0);" ref="{{ get_image_url($shop_field_value->card_side_b) }}" class="preview m-l-5">
                        <img src="/images/brand.jpg" />
                    </a>
                </td>
            </tr>
            <tr>
                <td class="text-r">手持身份证照片：</td>
                <td class="text-l" colspan="5">
                    <a href="javascript:void(0);" ref="{{ get_image_url($shop_field_value->hand_card) }}" class="preview m-l-5">
                        <img src="/images/brand.jpg" />
                    </a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <!-- 企业执照 -->
    <div class="m-t-10">
        <table class="table table-bordered">
            <colgroup>
                <col class="w150" />
                <col class="w200" />
                <col class="w150" />
                <col class="w200" />
                <col class="w150" />
                <col class="w200" />
            </colgroup>
            <thead>
            <tr>
                <th class="handle text-l" colspan="6">企业执照</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-r">特殊行业资质：</td>
                <td class="text-l" colspan="5">
                    <a href="javascript:void(0);" ref="" class="preview m-l-5">
                        <img src="/images/brand.jpg" />
                    </a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <!--店铺经营信息-->
    <div class="m-t-10">
        <table class="table table-bordered">
            <colgroup>
                <col class="w150" />
                <col class="w200" />
                <col class="w150" />
                <col class="w200" />
                <col class="w150" />
                <col class="w200" />
            </colgroup>
            <thead>
            <tr>
                <th class="handle text-l" colspan="6">店铺经营信息</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-r">店主帐号：</td>
                <td class="text-l" colspan="5">测试店铺</td>
            </tr>
            <tr>
                <td class="text-r">店铺名称：</td>
                <td class="text-l" colspan="5">九尘教</td>
            </tr>
            <tr>
                <td class="text-r">店铺分类：</td>
                <td class="text-l" colspan="5">家用电器 > 厨卫大电，食品酒水 > 水果生鲜</td>
            </tr>
            <tr>
                <td class="text-r">店铺佣金比例：</td>

                <td class="text-l" colspan="5">2.00%</td>

            </tr>
            <tr>
                <td class="text-r">开店时长：</td>
                <td class="text-l" colspan="5">

                    2017-06-05~2020-08-22

                </td>
            </tr>
            <tr>
                <td class="text-r">平台保证金：</td>
                <td class="text-l" colspan="5">1000.00元</td>
            </tr>
            <!-- 新加start -->
            <tr>
                <td class="text-r">店铺二维码：</td>
                <td class="text-l" colspan="5">
                    <img class="w70 m-r-10" src="http://images.68mall.com/15164/gqrcode/shop/C4/qrcode_1.png"></img>
                    <a class="btn-link" href="/shop/download-qrcode?shop_id=1"> 【下载店铺二维码】 </a>
                </td>
            </tr>
            <!-- end-->
            </tbody>
        </table>
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

{{--footer script page元素同级下面--}}
@section('footer_script')

@stop

{{--outside body script--}}
@section('outside_body_script')

@stop