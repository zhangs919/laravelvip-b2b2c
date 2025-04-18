@if(!empty($fixedBarHtml) || !empty($fixed_title))
<div class="fixed-bar">
    <div class="item-title">
        <div class="subject">

            @if(!empty($action_span))
                <h5>
                @foreach($action_span as $vo)

                    <span class="action-span">
                        <a @if(!empty($vo['id']))id="{{ $vo['id'] }}" href="{{ $vo['url'] ?? 'javascript:void(0);' }}" class="btn btn-warning"@else href="{{ $vo['url'] }}" class="btn btn-warning click-loading"@endif>
                            <i class="fa {{ $vo['icon'] }}"></i>
                            {{ $vo['text'] }}
                        </a>
                    </span>
                @endforeach
                </h5>
            @endif

            @if(!empty($fixedBarHtml))
                {!! $fixedBarHtml ?? '' !!}
            @else
                <h3>
                    <span class="action">{{ $fixed_title ?? '' }}</span>
                    <!--帮助教程-->
                    <!--<a class="help-href" href="javascript:;" data-toggle="tooltip" data-placement="auto bottom" title="点击跳转到该模块教程页面"><i class="help-icon"></i></a>-->
                    <!----->
                </h3>
            @endif


        </div>
    </div>
</div>
@endif