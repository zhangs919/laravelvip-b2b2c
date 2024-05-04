<div class="list-type-text" id="table_list">
    @if(!empty($list))
        <!---->
        <table class="table">
            <thead>
            <tr>
                <th style="width: 30%;">来源/用途</th>
                <th style="width: 20%;">收入/支出</th>
                <th style="width: 25%;">时间</th>

            </tr>
            </thead>
            <tbody>

            @foreach($list as $item)
            <tr>
                <td>{!! $item['note'] !!}</td>
                <td align="center">

                    <span class="get">{{ $item['changed_points'] > 0 ? '+' : '' }}{{ $item['changed_points'] }}</span>

                </td>
                <td align="center">{{ format_time($item['add_time']) }}</td>
            </tr>
            @endforeach

            </tbody>
        </table>

        {!! $pageHtml !!}
        <!---->
    @else
        <div class="tip-box">
            <img src="{{ get_image_url(sysconf('default_noresult'), 'default_noresult') }}" class="tip-icon" />
            <div class="tip-text">没有符合条件的记录</div>
        </div>
    @endif
</div>

