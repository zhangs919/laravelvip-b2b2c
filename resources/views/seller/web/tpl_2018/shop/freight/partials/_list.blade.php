<div id="table_list" class="table-responsive freight">

    @if(!$list->isEmpty())
        @foreach($list as $v)
            <table class="table table-hover">
                <!--以下为循环内容-->
                <tbody class="freight">
                <!--运费模板-->
                <tr class="freight-hd">
                    <td colspan="6">
                <span class="freight-name">
                <span class="c-blue">
                    @if($v->freight_type == 1){{--同城运费模板--}}
                        <i class="fa fa-map-marker" title="高级版运费模板"></i>
                    @else
                        <i class="fa fa-globe" title="简易版运费模板"></i>
                    @endif
                    {{ $v->title }}
                    @if($v->limit_sale == 1) {{--区域限售--}}
                        <label class="label label-danger m-l-5">区域限售 </label>
                    @endif
                    @if($v->free_set == 1){{--已指定条件包邮--}}
                        <label class="label label-primary m-l-5">已指定条件包邮 </label>
                    @endif

                </span>

                </span>
                        <div class="freight-operate">
                            <span class="freight-time">最后编辑时间：{{ $v->updated_at }}</span>
                            <span class="handle">

                        <a href="/shop/freight/map-add?id={{ $v->freight_id }}" class="click-loading">复制模板</a>

                        <a href="/shop/freight/edit?id={{ $v->freight_id }}" class="click-loading">修改</a>
                        <a href="javascript:void(0);" data-id="{{ $v->freight_id }}" class="del border-none">删除</a>
                    </span>
                        </div>
                    </td>
                </tr>

                <tr>
                    <th class="w300">运送到</th>
                    <th>首件(件)</th>
                    <th>运费(元)</th>
                    <th>续件(件)</th>
                    <th>续费(元)</th>
                    <th class="w150">货到付款</th>
                </tr>
                <!--运费模板内容-->

                @foreach($v->freight_record as $fr)
                    @if($fr->is_default == 1)
                        <tr>
                            <td title="">

                                <b>默认</b>

                            </td>
                            <td>{{ $fr->start_num }}</td>
                            <td>{{ $fr->start_money }}</td>
                            <td>{{ $fr->plus_num }}</td>
                            <td>{{ $fr->plus_money }}</td>
                            <td>
                                {{--是否支持货到付款--}}
                                @if($fr->is_cash == 1)
                                    支持,需加价：{{ $fr->cash_more }}元
                                @else
                                    不支持
                                @endif

                            </td>
                        </tr>
                    @else
                        <tr>
                            <td title="{{ $fr->region_names }}">

                                {{ $fr->region_names }}

                                @if($v->freight_type == 1){{--同城运费模板--}}
                                <i class="c-blue m-l-5 fa fa-exclamation-circle goods-reason" title="{{ $fr->region_desc }}" style="cursor: pointer;"></i>
                                @endif

                            </td>
                            <td>{{ $fr->start_num }}</td>
                            <td>{{ $fr->start_money }}</td>
                            <td>{{ $fr->plus_num }}</td>
                            <td>{{ $fr->plus_money }}</td>
                            <td>
                                {{--是否支持货到付款--}}
                                @if($fr->is_cash == 1)
                                    支持,需加价：{{ $fr->cash_more }}元
                                @else
                                    不支持
                                @endif

                            </td>
                        </tr>
                    @endif
                @endforeach



                </tbody>
            </table>
        @endforeach

        <!-- -->
        <table class="table b-n">
            <tfoot>
            <tr>
                <td class="b-n">
                    <div class="pull-right">


                        {!! $pageHtml !!}
                    </div>
                </td>
            </tr>
            </tfoot>
        </table>
    @else
        <div class="no-data-page">
            <div class="icon">
                <i class="fa fa-file-text-o"></i>
            </div>
            <h5>暂无运费模板</h5>
            <p>暂时没有运费模板，快去添加吧！</p>
        </div>
    @endif



</div>