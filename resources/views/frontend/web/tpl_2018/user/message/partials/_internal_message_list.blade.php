@foreach($list as $v)
    <li>
        <p class="mg-time">
            <span>{{ $v['send_time'] }}</span>
        </p>
        <div class="mg-info">
            <h3>{{ $v['title'] }}</h3>
            <div class="mg-detail">{!! $v['content'] !!}</div>
        </div>
    </li>
@endforeach