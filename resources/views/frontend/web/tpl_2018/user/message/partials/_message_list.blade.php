<div class="mg-content" id="table_list">
    <!---->

    @if(!empty($list))
        <ul>
            @foreach($list as $v)
            <li>
                <p class="mg-time">
                    <span>{{ $v['add_time'] }}</span>
                </p>
                <div class="mg-info">
                    <h3 class="sys-title">
                        {{ $v['title'] }}
                        <a href="/article/info?id={{ $v['article_id'] }}" target="_blank" title="点击查看" class="btn-link">点击查看&gt;</a>
                    </h3>
                </div>
            </li>
            @endforeach
        </ul>
        {!! $pageHtml !!}
    @else
        <div class="tip-box">
            <img src="{{ get_image_url(sysconf('default_noresult')) }}" class="tip-icon">
            <div class="tip-text">没有符合条件的记录</div>
        </div>
    @endif

</div>