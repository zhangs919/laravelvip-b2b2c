@if(!empty($list))
<div id="table_list">
    <!-- -->
    <table class="table">
        <thead>
        <tr>
            <th style="width: 40%;">来源/用途</th>
            <th style="width: 20%;">收入/支出</th>
            <th style="width: 20%;">时间</th>
            <th style="width: 20%;">备注</th>
        </tr>
        </thead>
        <tbody>

        @foreach($list as $v)
        <tr>
            <td>
                <div class="item-con item-con-spe">
                    <div class="item-name">{!! $v['note'] !!}</div>
                </div>
            </td>
            <td align="center">
                <span class="get">{{ $v['amount'] }}</span>
            </td>
            <td align="center">{{ $v['add_time'] }}</td>
            <td align="center">{{ $v['trade_type'] }}</td>
        </tr>
        @endforeach

        </tbody>
    </table>

    <form name="selectPageForm" action="" method="get">
        <!--分页-->
        <div class="page">
            <div class="page-wrap fr">
                <div id="pagination" class="pull-right page-box">


                    {!! $pageHtml !!}
                </div>
            </div>
        </div>
    </form>

</div>
@else
    <div id="table_list">
        <!---->
        <table class="table">
            <thead>
            <tr>
                <th style="width: 40%; cursor: default;" class="">来源/用途</th>
                <th style="width: 20%;">收入/支出</th>
                <th style="width: 20%;">时间</th>
                <th style="width: 20%;">备注</th>
            </tr>
            </thead>
        </table>
        <div class="tip-box">
            <img src="{{ get_image_url(sysconf('default_noresult')) }}" class="tip-icon">
            <div class="tip-text">没有符合条件的记录</div>
        </div>

    </div>
@endif