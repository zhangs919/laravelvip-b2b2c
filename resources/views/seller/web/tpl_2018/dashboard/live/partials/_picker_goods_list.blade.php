<div id="table_list" class="table-list">
    <input type="hidden" name="goods_skus" id="goods_skus" value="">
    <ul class="goods-list m-t-10">

        @if(!$list->isEmpty())
        @foreach($list as $v)
        <li class="sku-item">
            <input type="hidden" name="goods_id" value="{{ $v->goods_id }}" />
            <input type="hidden" name="sku_id" value="{{ $v->sku_id }}" />
            <input type="hidden" name="goods_name" value="{{ $v->goods_name }}" />
            <input type="hidden" name="sku_name" value="商品名称 + 规格名称" />
            <input type="hidden" name="goods_number" value="{{ $v->goods_number }}" />
            <input type="hidden" name="goods_price" value="{{ $v->goods_price }}" />
            <input type="hidden" name="sku_open" value="{{ $v->sku_open }}" />


            <input type="hidden" name="sku_image" value="http://68products.oss-cn-beijing.aliyuncs.com/taobao-yun-images/531610068386/TB1O0Z.MVXXXXXPXVXXXXXXXXXX_!!0-item_pic.jpg?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" />



            <input type="hidden" name="goods_image" value="{{ get_image_url($v->goods_image) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" />


            <dl>
                <dt>
                    <div class="picture m-b-5">
                        <a href="{{ route('pc_show_sku_goods',['sku_id'=>$v->sku_id]) }}" target="_blank">

                            <img src="{{ get_image_url($v->goods_image) }}?x-oss-process=image/resize,m_pad,limit_0,h_220,w_220">

                        </a>
                    </div>
                </dt>
                <dd class="date">
                    <p class="name">

                        <a href="{{ route('pc_show_goods', ['goods_id'=>$v->goods_id]) }}" target="_blank">{{ $v->goods_name }}</a>

                    </p>
                    <p class="choose">
                        <span class="pull-left">￥{{ $v->goods_price }}</span>
                        <span class="pull-right allattr">

                            @if(in_array($v->goods_id, $goods_ids))
                                <a data-sku-id="{{ $v->sku_id }}" data-goods-id="{{ $v->goods_id }}" data-selected="true" href="javascript:void(0);" class="btn btn-xs btn-default btn-goodspicker">
                                    <i class="fa fa-check"></i>
                                    <span>已选</span>
                                </a>
                            @else
                                <a data-sku-id="{{ $v->sku_id }}" data-goods-id="{{ $v->goods_id }}" data-selected="false" href="javascript:void(0);" class="btn btn-xs btn-primary btn-goodspicker">
                                    <i class="fa fa-plus"></i>
                                    <span>选择</span>
                                </a>
                            @endif

                        </span>
                    </p>
                </dd>
            </dl>
        </li>
        @endforeach
        @else
        <!--当没有数据时显示如下div-->
        <div class="warning-option">
            <i class="fa fa-exclamation-triangle c-blue"></i>
            <span>暂无符合条件的数据记录</span>
        </div>
        @endif
    </ul>
    <table class="table b-n m-t-10">
        <tfoot>
        <tr>
            <td class="b-n">
                <div class="pull-right page-box">


                    {{--分页--}}
                    {!! $pageHtml !!}

                </div>
            </td>
        </tr>
        </tfoot>
    </table>
</div>
