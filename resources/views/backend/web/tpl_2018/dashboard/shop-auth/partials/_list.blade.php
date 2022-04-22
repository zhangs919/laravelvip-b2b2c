<!--列表内容-->
<div class="table-responsive">


    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">

    <table id="table_list" class="table table-hover">

        <thead>
        <tr>
            <th class="w300" style="cursor: default;">店铺信息</th>
            <th class="w200 text-c">店铺类型</th>
            <th class="w200 text-c" style="cursor: default;">店铺状态</th>
            <th class="w250 handle" style="cursor: default;">操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($list as $v)
        <tr>
            <td>
                <div class="userPicBox pull-left m-r-10">
                    <img src="{{ get_image_url($v->shop_image, 'shop_image') }}" class="user-avatar">
                </div>
                <div class="ng-binding user-message goods-message w180">
                    <span class="name" title=""> 店铺名称：{{ $v->shop_name }}</span>
                    <span class="id"> 店铺ID：{{ $v->shop_id }} </span>
                </div>
            </td>
            <td class="text-c">入驻零售商</td>
            <td class="text-c">@if($v->shop_status == 1) 开启 @else 关闭 @endif</td>
            <td class="handle">
                <a href="/dashboard/shop-auth/view?shop_id={{ $v->shop_id }}">查看营销权限</a>
                <span>|</span>
                <a href="/dashboard/shop-auth/set-auth?shop_id={{ $v->shop_id }}">营销权限设置</a>
            </td>
        </tr>
        @endforeach

        </tbody>
        <tfoot>
        <tr>
            <td colspan="4">
                <div class="pull-left"></div>
                <div class="pull-right page-box">

                    {!! $pageHtml !!}
                </div>
            </td>
        </tr>
        </tfoot>

    </table>




</div>

{{--
<div class="table-responsive">


    <div id="table_list" class="no-data-page">
        <div class="icon">
            <i class="fa fa-home"></i>
        </div>
        <h5>请输入查询条件，立即查询吧！</h5>
    </div>


</div>--}}
