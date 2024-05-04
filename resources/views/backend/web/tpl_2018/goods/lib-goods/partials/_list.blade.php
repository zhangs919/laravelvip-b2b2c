<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck w10">
            <input type="checkbox" class="table-list-checkbox-all" title="全选/全不选">
        </th>
        <th class="text-c w70" data-sortname="goods_id" data-sortorder="asc" style="cursor: pointer;">编号<span class="sort"></span></th>
        <th class="w300" data-sortname="goods_name" data-sortorder="asc" style="cursor: pointer;">商品名称<span class="sort"></span></th>
        <th class="w150" data-sortname="lib_cat_name" data-sortorder="asc" style="cursor: pointer;">商品库商品分类<span class="sort"></span></th>
        <th class="w120" data-sortname="goods_barcode" data-sortorder="asc" style="cursor: pointer;">商品条形码<span class="sort"></span></th>
        <th class="text-c w120" data-sortname="goods_price" data-sortorder="asc" style="cursor: pointer;">本店价（元）<span class="sort"></span></th>
        <!-- <th class="text-c" data-sortname="goods_number">库存</th> -->
        <th class="w80 text-c" data-sortname="goods_status" data-sortorder="asc" style="cursor: pointer;">状态<span class="sort"></span></th>
        <th class="w120" data-sortname="add_time" data-sortorder="asc" style="cursor: pointer;">发布时间<span class="sort"></span></th>
        <th class="handle w180">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
    <tr>
        <td class="tcheck">
            <input type="checkbox" class="checkbox table-list-checkbox" value="{{ $v->goods_id }}">
        </td>
        <td class="text-c">{{ $v->goods_id }}</td>
        <td>
            <div class="goodsPicBox pull-left m-r-10">
                <a>
                    <!-- 图片缩略图 -->
                    <img src="{{ get_image_url($v->goods_image,'goods_image') }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" class="goods-thumb">
                    <!-- 虚拟商品 -->

                </a>
            </div>
            <div class="ng-binding goods-message w200">
                <div class="name">
                    <a class="goods_name editable editable-pre-wrapped editable-click" data-goods_id="{{ $v->goods_id }}" target="_blank">{{ $v->goods_name }}</a>

                    <a href="javascript:void(0);" class="goods_name_controller c-blue m-l-5">修改</a>
                </div>
                <div class="active">

                    <div class="goods-mobile @if(!empty($v->mobile_desc)) open @endif">
                        <a href="javascript:void(0);" data-toggle="tooltip" data-placement="auto bottom" title="" data-original-title="此宝贝@if(empty($v->mobile_desc))尚未@else已@endif发布手机端宝贝详情">
                            <i class="fa fa-tablet"></i>
                        </a>
                    </div>

                    <div class="QR-code popover-box">
                        <a href="javascript:;" class="qrcode">
                            <i class="fa fa-qrcode"></i>
                        </a>
                        <div class="code-info popover-info">
                            <i class="fa fa-caret-left"></i>
                            <a href="/goods/lib-goods/download-qrcode?id={{ $v->goods_id }}">商品二维码</a>
                            <p>
                                <img src="/assets/d2eace91/images/common/loading_90_90.gif" data-src="/goods/lib-goods/qrcode?id={{ $v->goods_id }}">
                            </p>
                        </div>
                    </div>

                </div>
                <!-- <div class="store" style="display: none">
                    <label class="label label-primary">xx旗舰店提供</label>
                </div> -->
            </div>
        </td>
        <td class=""></td>

        <td class="text-c">
            <a href="javascript:void(0);" class="goods_barcode editable editable-click editable-empty" data-goods_id="{{ $v->goods_id }}">{{ $v->goods_barcode ?? '无' }}</a>
        </td>
        <td class="text-c">
            <a href="javascript:void(0);" class="goods_price editable editable-click" data-goods_id="{{ $v->goods_id }}">{{ $v->goods_price }}</a>
        </td>


        <td class="text-c">

            @if($v->goods_status == 0)
                <font class="c-red" data-goods-reason="{{ $v->goods_reason }}">已下架</font>
            @elseif($v->goods_status == 1)
                <font class="c-green">已上架</font>
            @elseif($v->goods_status == 2)
                <font class="c-red" data-goods-reason="{{ $v->goods_reason }}">违规下架</font>
            @endif

        </td>

        <td>
            {{ $v->created_at->format('Y-m-d') }}
            <br>
            {{ $v->created_at->format('H:i:s') }}
        </td>
        <td class="handle">
            <a href="{{ route('pc_show_lib_goods', ['goods_id'=>$v->goods_id]) }}" target="_blank">预览</a>
            <span>|</span>
            <a href="javascript:void(0);" class="sku-list" data-goods-id="{{ $v->goods_id }}">SKU</a>
            <!-- <span>|</span>
            <a href="" target="_blank">查看</a> -->
            <br>
            <a href="/goods/lib-goods/edit?id={{ $v->goods_id }}">编辑</a>
            <!-- <span>|</span>
            <a href="javascript:void(0);">复制</a> -->


            <span>|</span>
            <a href="javascript:void(0);" data-id="{{ $v->goods_id }}" class="offsale-goods del">下架</a>

            <span>|</span>
            <a href="javascript:void(0);" data-id="{{ $v->goods_id }}" class="del border-none delete-goods">删除</a>
        </td>
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td class="text-c w10">
            <input type="checkbox" class="checkBox table-list-checkbox-all" title="全选/全不选">
        </td>
        <td colspan="8">
            <div class="pull-left">
                <div class="btn-group dropup m-r-2">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        批量操作
                        <span class="caret m-l-5"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a class="onsale-goods">商品上架</a>
                        </li>
                        <li>
                            <a class="offsale-goods">商品下架</a>
                        </li>
                        <li>
                            <a class="move-goods">转移商城商品分类</a>
                        </li>
                        <li>
                            <a class="move-lib-goods">转移商品库商品分类</a>
                        </li>
                    </ul>
                </div>
                <a class="btn btn-danger delete-goods m-r-2">批量删除</a>
            </div>
            <div class="pull-right page-box">


                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>