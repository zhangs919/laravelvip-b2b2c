@if(!empty($fixedBarHtml) || !empty($fixed_title))
    <!--tab分页及跳转按钮-->
    <div class="tabmenu">
        {!! $fixedBarHtml ?? '' !!}

        @if(!empty($action_span))
            @foreach($action_span as $vo)
                <a @if(!empty($vo['id']))id="{{ $vo['id'] }}" href="javascript:void(0);" @else href="{{ $vo['url'] }}" @endif class="top-btn btn btn-primary">
                    <i class="fa {{ $vo['icon'] }}"></i>
                    {{ $vo['text'] }}
                </a>
            @endforeach
        @endif



    </div>
@endif

