<!-- 表头固定 -->
<div class="thead-fixed" style="display: none">
    <table class="table table-bordered m-b-0">
        <thead>
        <tr>
            <th class="w300">物流公司名称</th>
            <th class="w400">运单号码</th>
            <th class="w200">操作</th>
        </tr>
        </thead>
    </table>
</div>
<!-- 表格内容 -->
<table class="table table-bordered">
    <colgroup>
        <col class="w300">
        </col>
        <!--商品信息-->
        <col class="w400">
        </col>
        <!--单价（元）-->
        <!--<col class="w500">-->
        <!--</col>-->
        <col class="w200">
        </col>
    </colgroup>
    <thead>
    <tr>
        <th>物流公司名称</th>
        <th>运单号码</th>
        <th class="handle">操作</th>
    </tr>
    </thead>
    <tbody>
    @if(!empty($shipping_list['list']['express']))
        @foreach($shipping_list['list']['express'] as $express)
        <tr>
            <td>{{ $express['shipping_name'] }}</td>
            <td class="waybillNum">
                <dl>
                    <dt>
                        <label class="control-label">
                            <span class="text-danger ng-binding m-r-5">*</span>
                        </label>
                    </dt>
                    <dd>
                        <div class="form-control-wrap">
                            <input id='express_sn_{{ $express['shipping_id'] }}' class="form-control w200" type="text" maxlength="20" />
                            @if($is_sheet)
                                <a class="btn btn-primary btn-sm m-l-5 logistic_code" data-id="{{ $express['id'] }}" data-code='{{ $express['shipping_code'] }}'>获取物流单</a>
                                <a class="btn btn-warning btn-sm m-l-5 print" data-id="{{ $express['id'] }}" data-code='{{ $express['shipping_code'] }}'>打印电子面单</a>
                            @endif
                        </div>
                    </dd>
                </dl>
            </td>
            <td>
                <a class="btn btn-primary btn-xs" onclick="_go('{{ $express['shipping_id'] }}')">确认发货</a>
                @if(!$express['is_default'])
                    <a class="btn-link m-l-10" onclick="_default('{{ $express['shipping_id'] }}')">设为默认</a>
                @endif
            </td>
        </tr>
        @endforeach
    @else
        <tr>
            <td colspan="3">
                <div class="messageBox b-n text-c">暂无物流公司信息</div>
            </td>
        </tr>
    @endif
    </tbody>
</table>