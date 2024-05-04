<div class="list-type-text" id="table_list">
    @if(!empty($list))
        <div class="tablelist-append">
            @foreach($list as $item)
            <div class="list-item">
                <p>{!! $item['note'] !!}</p>
                @if($item['changed_points'] > 0)
                    <span class="get">+{{ $item['changed_points'] }}</span>
                @else
                    <span class="lose">{{ $item['changed_points'] }}</span>
                @endif
                <p>{{ $item['created_at'] }}</p>
            </div>
            @endforeach
        </div>
        <!-- 分页 -->
        <!-- 分页 -->
        <div id="pagination" class="page">
            <div class="more-loader-spinner">
                <div class="is-loaded">
                    <div class="loaded-bg">我是有底线的</div>
                </div>
            </div>
            <script data-page-json="true" type="text" id="page_json">
                {!! $page_json !!}
            </script>
        </div>
    @else
        <div class="no-data-div">
            <div class="no-data-img">
                <img src="/images/bg_empty_data.png" />
            </div>
            <dl>
                <dt>暂无数据</dt>
            </dl>
        </div>
    @endif
</div>
