<div id="table_list">

    <div class="common-title">
        <div class="ftitle">
            <h3>积分兑换红包列表</h3>

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
    </div>
    <!--列表内容-->
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th class="tcheck w10">
                    <input type="checkbox" class="checkBox allCheckBox" />
                </th>
                <th class="w60 text-c" data-sortname="bonus_id">编号</th>
                <th class="w150" data-sortname="bonus_name">名称</th>
                <th class="w70 text-c" data-sortname="bonus_amount">面值</th>
                <th class="w100 text-c" data-sortname="start_time">有效期</th>
                <th class="w100" data-sortname="bonus_type">红包类型</th>
                <th class="w100 text-c" data-sortname="bonus_number">发放数量</th>
                <th class="w100 text-c">已领取数量</th>
                <th class="w100 text-c">已使用数量</th>
                <th class="w100 text-c">状态</th>
                <th class="handle w150">操作</th>
            </tr>
            </thead>
            <tbody>
            @if(!empty($list))
                @foreach($list as $v)
                    <tr id="tr_{{ $v['bonus_id'] }}">
                        <td class="text-c">
                            <input type="checkbox" class="checkBox activitycheckbox" value="{{ $v['bonus_id'] }}" />
                        </td>
                        <td class="text-c">{{ $v['bonus_id'] }}</td>
                        <td>
                            <a href="/dashboard/integral-mall/integral-bonus-view?bonus_id={{ $v['bonus_id'] }}" class="c-blue" title="点击查看红包详细信息" onClick="$.loading.start()">{{ $v['bonus_name'] }}</a>
                        </td>
                        <td class="text-c">￥{{ $v['bonus_amount'] }}</td>
                        <td class="text-c">
                            {{ $v['start_time_format'] }}
                            <br />
                            ~
                            <br />
                            {{ $v['end_time_format'] }}
                        </td>
                        <td>{{ $v['bonus_type_name'] }}</td>
                        <td class="text-c">
                            <a href="/dashboard/integral-mall/use-integral-bonus-list?bonus_id={{ $v['bonus_id'] }}" class="c-blue" data-toggle="tooltip" data-placement="auto bottom">{{ $v['bonus_number'] }}</a>
                        </td>
                        <td class="text-c">
                            <a href="/dashboard/integral-mall/use-integral-bonus-list?bonus_id={{ $v['bonus_id'] }}&receive_status=1" class="c-blue" data-toggle="tooltip" data-placement="auto bottom" title="进入红包详情">{{ $v['receive_number'] }}</a>
                        </td>
                        <td class="text-c">
                            <a href="/dashboard/integral-mall/use-integral-bonus-list?bonus_id={{ $v['bonus_id'] }}&bonus_status=1" class="c-blue" data-toggle="tooltip" data-placement="auto bottom" title="进入红包详情">{{ $v['used_number'] }}</a>
                        </td>
                        <td class="text-c">
                            @if($v['is_enable'] == 0)
                                <font class="c-red">已失效</font>
                            @else
                                <font class="{{ str_replace([0,1,2], ['c-green','c-999','c-red'], $v['bonus_status']) }}">{{ $v['bonus_status_format'] }}</font>
                            @endif
                        </td>
                        <td class="handle">
                            <a href="/dashboard/integral-mall/integral-bonus-view.html?bonus_id={{ $v['bonus_id'] }}">查看</a>
                            <span>|</span>
                            <a href="/dashboard/integral-mall/use-integral-bonus-list.html?bonus_id={{ $v['bonus_id'] }}">已发放</a>

                            @if($v['is_enable'] == 1)
                                <a href="javascript:void(0)" data-id="{{ $v['bonus_id'] }}" class="del enable">作废</a>
                                <span>|</span>
                            @endif

                            <a href="javascript:void(0)" data-id="{{ $v['bonus_id'] }}" class="del delete">删除</a>
                        </td>
                    </tr>

                @endforeach

            @else

            @endif

            </tbody>
            <tfoot>
            <tr>
                <!-- <td class="text-c w10">
                <input type="checkbox" class="allCheckBox checkBox" id="action_status"></input>
            </td> -->
                <td colspan="11">
                    <div class="pull-left">
                        <!--当没有选中任何行时，btn-default为 disabled,无法响应点击模态框事件-->
                        <!-- <button class="btn btn-default" type="button" data-toggle="modal" data-target="#confirmModal">设置为无效</button> -->
                        <input type="button" id="batch_status" class="btn btn-danger" value="批量作废">
                    </div>
                    <div class="pull-right page-box">
                        {!! $pageHtml !!}
                    </div>
                </td>
            </tr>
            </tfoot>
        </table>

    </div>
</div>