<link href="/assets/d2eace91/js/bootstrap3-editable/css/bootstrap-editable.css?v=2.1" rel="stylesheet">
<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck">
            <input type="checkbox"/>
        </th>
        <th class="text-c w60 p-l-0 p-r-0" data-sortname="goods_id">编号</th>
        <th class="w300  p-l-0 p-r-0" data-sortname="goods_name">商品名称</th>
        <th class="text-c w70  p-l-0 p-r-0">商品标签</th>
        <th class="text-c w120  p-l-0 p-r-0" data-sortname="goods_price">本店价（元）</th>
        <th class="text-c w70  p-l-0 p-r-0" data-sortname="goods_total_sale_num">实时销量</th>
        <th class="text-c w70  p-l-0 p-r-0" data-sortname="goods_number">库存</th>
        <th class="text-c w70  p-l-0 p-r-0" data-sortname="goods_status">状态</th>
        <!-- <th class="text-c w70  p-l-0 p-r-0" data-sortname="is_pickup">是否自提</th>
        <th class="text-c w80  p-l-0 p-r-0" data-sortname="is_common_package">是否普通快递</th> -->
        <th class="text-c w80  p-l-0 p-r-0" data-sortname="add_time">发布时间</th>
        <th class="handle w120 p-0">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
        <tr>
            <td class="tcheck">
                <input type="checkbox" class="checkbox" value="{{ $v['goods_id'] }}"/>
            </td>
            <td class="text-c p-l-0 p-r-0">{{ $v['goods_id'] }}</td>
            <td class="p-l-0 p-r-0">
                <div class="goodsPicBox pull-left m-r-10">
                    <a href="{{ route('pc_show_goods', ['goods_id'=>$v['goods_id']]) }}" target="_blank">
                        <!-- 图片缩略图 -->
                        <img src="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80"
                             class="goods-thumb"/>
                        <!-- 虚拟商品 -->

                    </a>
                </div>
                <div class="ng-binding goods-message w200">
                    <div class="name">
                        <a href="{{ route('pc_show_goods', ['goods_id'=>$v['goods_id']]) }}" class="goods_name"
                           data-goods_id={{ $v['goods_id'] }} target="_blank">{{ $v['goods_name'] }}</a>
                        @if($v['sku_open'])
                            <label class="label label-warning m-l-5" title="此商品为多规格商品">SKU</label>
                        @endif
                        <a href="javascript:void(0);" class="goods_name_controller c-blue m-l-5">修改</a>
                    </div>
                    <div class="active">
                        <div class="goods-mobile">
                            <a href="javascript:void(0);" data-toggle="tooltip" data-placement="auto bottom"
                               title="此宝贝尚未发布手机端宝贝详情">
                                <i class="fa fa-tablet"></i>
                            </a>
                        </div>

                        <div class="QR-code popover-box">
                            <a href="javascript:;" class="qrcode">
                                <i class="fa fa-qrcode"></i>
                            </a>
                            <div class="code-info popover-info">
                                <i class="fa fa-caret-left"></i>
                                <a href="javascript:void(0);" class="download-qrcode"
                                   data-goods_id="{{ $v['goods_id'] }}">商品二维码</a>
                                <div style="padding: 10px; background-color: #fff; margin: 0;">
                                    <div class="goods-qrcode" data-goods_id="{{ $v['goods_id'] }}"
                                         style="width: 120px; height: 120px; margin: 0;"></div>
                                </div>
                            </div>
                        </div>
                        <!--新加批发 start-->
                        <div class="pull-left">

                            <label class="model-label blue">零售</label>

                        </div>
                        <!--新加 end-->
                        <!--以下为区分不同的活动，分别给不同的活动名称不同的背景颜色(对注释下面的div追加以下class名)：
                                                积分： exchange
                                                拍卖： auction
                                                预售： pre-sale
                                                0元购：zero-buy
                                                众筹： crowdfund
                                                促销活动: pro-sale

                            <div class="goods-active pre-sale">
                                <a href="" target="_blank" title="该商品参与XX预售活动，点击进入商品详情页查看">预售</a>
                            </div>
                             -->
                    </div>
                    <div>
                        <!--新加产品库-->


                    </div>
                </div>
            </td>
            <td class="text-c p-l-0 p-r-0">{{ $v['tag_name'] }}</td>
            <td class="text-c p-l-0 p-r-0">
                @if($v['sku_open'])
                    {{ $v['goods_price'] }}
                @else
                    <a href="javascript:void(0);" class="goods_price"
                       data-goods_id={{ $v['goods_id'] }}>{{ $v['goods_price'] }}</a>
                @endif
            </td>
            <td class="text-c p-l-0 p-r-0">
                <font>{{ $v['goods_total_sale_num'] }}</font>
            </td>
            <td class="text-c p-l-0 p-r-0">
                @if($v['sku_open'])
                    <font>{{ $v['goods_number'] }}</font>
                @else
                    <a href="javascript:void(0);" class="goods_number"
                       data-goods_id="{{ $v['goods_id'] }}"> {{ $v['goods_number'] }} </a>
                @endif
            </td>
            <td class="text-c p-l-0 p-r-0">
                <!-- 审核未通过的商品不显示商品状态 -->
                @if($v['goods_audit'] == 0)
                    {{ $v['status_name'] }}
                @else

                    @if($v['goods_status'] == 0)
                        @if(!empty($v['goods_reason']))
                            <font class="c-red"
                                  data-goods-reason="{{ $v['goods_reason'] }}">{{ $v['status_name'] }}</font>
                            <i class="c-yellow m-l-5 fa fa-exclamation-circle goods-reason"
                               data-goods-reason="{{ $v['goods_reason'] }}" style="cursor: pointer;"></i>
                        @else
                            {{ $v['status_name'] }}
                        @endif
                    @elseif($v['goods_status'] == 1)
                        <font class="c-green">{{ $v['status_name'] }}</font>
                    @elseif($v['goods_status'] == 2)
                        <font class="c-red" data-goods-reason="{{ $v['goods_reason'] }}">{{ $v['status_name'] }}</font>
                        <i class="c-yellow m-l-5 fa fa-exclamation-circle goods-reason"
                           data-goods-reason="{{ $v['goods_reason'] }}" style="cursor: pointer;"></i>
                    @endif
                @endif


            </td>
            <td class="text-c p-l-0 p-r-0">
                {{ format_time($v['add_time'],'Y-m-d') }}
                <br/>
                {{ format_time($v['add_time'],'H:i:s') }}
            </td>
            <td class="handle p-l-0 p-r-5">
                <a href="javascript:void(0);" class="sku-list" data-goods-id="{{ $v['goods_id'] }}">SKU</a>
                <span>|</span>
                <a href="{{ route('pc_show_goods', ['goods_id'=>$v['goods_id']]) }}" target="_blank">查看</a>
                <span>|</span>
                <!-- 店铺品可以设置会员价 -->
                <a href="javascript:void(0);" class="sku_member" data-goods-id="{{ $v['goods_id'] }}">会员价</a>
                </br>
                <a href="/goods/publish/edit?id={{ $v['goods_id'] }}&scid=0" target="_blank">编辑</a>
                <!-- <span>|</span>
                    <a href="javascript:void(0);">复制</a> -->
                @if($v['goods_status'] == 0 && $v['goods_audit'] == 1)
                    <span>|</span>
                    <a href="javascript:void(0);" data-id="{{ $v['goods_id'] }}" class="onsale-goods del">上架</a>
                @elseif($v['goods_status'] == 1)
                    <span>|</span>
                    <a href="javascript:void(0);" data-id="{{ $v['goods_id'] }}" class="offsale-goods del">下架</a>
                @endif

                <span>|</span>
                <a href="javascript:void(0);" data-id="{{ $v['goods_id'] }}" class="del border-none delete-goods">删除</a>

                <span>|</span>
                <a href="javascript:void(0);" class="remark" data-id="{{ $v['goods_id'] }}">备注</a>
                <br/>
                <a href="javascript:void(0);" class="miniprogram-live-check" data-id="{{ $v['goods_id'] }}">直播商品审核</a>
            </td>
        </tr>

        @if(!empty($v['remark_array']))
            <tr>
                <td colspan="13">

                    @foreach($v['remark_array'] as $gr)
                        <p class="p-t-2 p-b-2">
                            <span class="m-r-20">备注人：{{ $gr['admin_name'] }}</span>
                            <span class="m-r-20">备注时间：{{ $gr['created_at'] }}</span>
                            <span class="m-r-30">备注内容：{!! $gr['content'] !!}</span>
                        </p>
                    @endforeach

                </td>
            </tr>
        @endif
        <!--
        <tr>
            <td colspan="9" class="table-merge">
                <div class="border-dashed"></div>
                <div class="labelBox">
                    <span class="label-item add-label">+添加标签</span>
                    <span class="label-item">
                        新品
                        <i class="fa">×</i>
                    </span>
                    <span class="label-item">
                        精品
                        <i class="fa">×</i>
                    </span>
                    <span class="label-item">
                        热销
                        <i class="fa">×</i>
                    </span>
                </div>
            </td>
        </tr>
        -->
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td class="text-c w10">
            <input type="checkbox" class="checkBox"/>
        </td>
        <td colspan="12">
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
                            <a class="regular_time_sale">商品定时出售</a>
                        </li>
                        <li>
                            <a class="offsale-goods">商品下架</a>
                        </li>
                        <li>
                            <a class="move-goods">转移商城商品分类</a>
                        </li>
                        <li>
                            <a class="move-shop-goods">设置店铺商品分类</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="goods-tag">打标签</a>
                        </li>
                        <li>
                            <a class="goods-unit">商品单位</a>
                        </li>
                        <li>
                            <a class="goods-pricing-mode">计价方式</a>
                        </li>
                        <li>
                            <a class="stock-mode">库存计数</a>
                        </li>
                        <li>
                            <a class="goods-moq">最小起订量</a>
                        </li>
                        <li>
                            <a class="invoice-type">开具发票</a>
                        </li>
                        <li>
                            <a class="goods-layout">详情版式</a>
                        </li>
                        <li>
                            <a class="contract">服务保障</a>
                        </li>
                        <li>
                            <a class="user-discount">会员打折</a>
                        </li>
                        <li>
                            <a class="sku-member">会员价</a>
                        </li>
                        <li>
                            <a class="goods-freight">运费设置</a>
                        </li>
                        <li>
                            <a class="set-price">调整价格</a>
                        </li>
                        <li>
                            <a class="set-goods-number">调整库存</a>
                        </li>
                        <!-- <li>
                            <a class="set-pickup">自提设置</a>
                        </li>
                        <li>
                            <a class="set-common-package">普通快递配送设置</a>
                        </li> -->
                        <li>
                            <a class="set-keywords">调整关键词</a>
                        </li>
                        <li>
                            <a class="set-pickup-timeout">调整自提超时期限</a>
                        </li>
                    </ul>
                </div>
                <input type="button" class="btn btn-danger m-r-2 delete-goods" value="批量删除"/>
            </div>
            <div class="pull-right page-box">
                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>

<script type="text/javascript"> // </script>
{{--<script src="/assets/d2eace91/min/js/validate.min.js?v=2.1"></script>--}}
{{--<script src="/assets/d2eace91/min/js/upload.min.js?v=2.1"></script>--}}
{{--<script src="/assets/d2eace91/js/bootstrap3-editable/js/bootstrap-editable.js?v=2.1"></script>--}}
<script>
    $().ready(function () {
        var page_id = "pagination";
        $("#" + page_id + " > .pagination-goto > .goto-input").keyup(function (e) {
            $("#" + page_id + " > .pagination-goto > .goto-link").attr("data-go-page", $(this).val());
            if (e.keyCode == 13) {
                $("#" + page_id + " > .pagination-goto > .goto-link").click();
            }
        });
        $("#" + page_id + " > .pagination-goto > .goto-button").click(function () {
            var page = $("#" + page_id + " > .pagination-goto > .goto-link").attr("data-go-page");
            if ($.trim(page) == '') {
                return false;
            }
            $("#" + page_id + " > .pagination-goto > .goto-link").attr("data-go-page", page);
            $("#" + page_id + " > .pagination-goto > .goto-link").click();
            return false;
        });
    });
    //
    $(document).ready(function () {
        // 图片懒加载
        $("img.lazy").lazyload({
            skip_invisible: false,
            effect: 'fadeIn',
            failurelimit: $.imgloading.settings.failurelimit,
            threshold: $.imgloading.settings.threshold,
            data_attribute: $.imgloading.settings.data_attribute,
            load: function () {
                $(this).removeClass('lazy');
                // 删除背景图片
                $(this).parent('a').css("background", "");
                if ($(this).hasClass('square')) {
                    if ($(this).height() != $(this).width()) {
                        $(this).height($(this).width());
                    } else {
                        $(this).removeClass('square');
                    }
                }
            }
        });
        // toggle `popup` / `inline` mode
        // $.fn.editable.defaults.mode = "inline";
		// 商品价格
		$(".goods_price").editable({
			type: "text",
			url: "/goods/list/edit-goods-info",
			pk: 1,
			// title: "本店价（元）",
			ajaxOptions: {
				type: "post"
			},
			params: function (params) {
				params.goods_id = $(this).data("goods_id");
				params.title = 'goods_price';
				return params;
			},
			/* validate: function(value) {
				value = $.trim(value);
				if (!value) {
					return '商品价格不能为空。';
				} else if (isNaN(value)) {
					return '商品价格必须是一个数字。';
				} else if (value < 0.01) {
					return '价格必须是0.01~9999999之间的数字。';
				} else if (value > 9999999) {
					return '价格必须是0.01~9999999之间的数字。';
				}
			}, */
			success: function (response, newValue) {
				var response = eval('(' + response + ')');
				// 错误处理
				if (response.code == -1) {
					return response.message;
				}
			},
			display: function (value, sourceData) {
				// 保留两位小数
				$(this).html((Number(value)).toFixed(2));
			},
			error: function (response, newValue) {
			}
		});
		// 商品库存
		$(".goods_number").editable({
			type: "text",
			url: "/goods/list/edit-goods-info",
			pk: 1,
			// title: "商品库存",
			ajaxOptions: {
				type: "post"
			},
			params: function (params) {
				params.goods_id = $(this).data("goods_id");
				params.title = 'goods_number';
				return params;
			},
			/* validate: function(value) {
				value = $.trim(value);
				var ex = /^\d+$/;
				if (!value) {
					return '商品库存不能为空。';
				} else if (!ex.test(value)) {
					return '商品库存必须是正整数。';
				} else if (value > 999999999) {
					return '商品库存不能大于999999999';
				}
			}, */
			success: function (response, newValue) {
				var response = eval('(' + response + ')');
				// 错误处理
				if (response.code == -1) {
					return response.message;
				}
			},
			display: function (value, sourceData) {
				// 显示整数
				$(this).html((Number(value)).toFixed(0));
			},
			error: function (response, newValue) {
			}
		});
		$('.goods_name_controller').click(function (e) {
			e.stopPropagation();
			$(this).parent().children(":first").editable('toggle');
		});
		// 商品名称
		$(".goods_name").editable({
			type: "text",
			url: "/goods/list/edit-goods-info",
			pk: 1,
			// title: "商品名称",
			ajaxOptions: {
				type: "post"
			},
			params: function (params) {
				params.goods_id = $(this).data("goods_id");
				params.title = 'goods_name';
				return params;
			},
			/* validate: function(value) {
				value = $.trim(value);
				if (!value) {
					return '商品名称不能为空。';
				} else if (value.length < 3) {
					return '商品名称应该包含至少3个字。';
				} else if (value.length > 60) {
					return '商品名称只能包含至多60个字。';
				}
			}, */
			success: function (response, newValue) {
				var response = eval('(' + response + ')');
				// 错误处理
				if (response.code == -1) {
					return response.message;
				}
			},
			display: function (value, sourceData) {
				if (value.length > 25) {
					$(this).html(value.substring(0, 25) + '...');
				} else {
					$(this).html(value);
				}
			},
			error: function (response, newValue) {
			}
		});
        // 复制商品名称
        var clipboard = new Clipboard('.goods_name_controller_copy');
        clipboard.on('success', function (e) {
            console.log(e);
            $.msg("复制商品名称成功！")
        });
        clipboard.on('error', function (e) {
            console.log(e);
            $.msg("复制商品名称失败！请手动复制")
        });
    });
    //
</script>


