@if(!empty($fixedBarHtml) || !empty($fixed_title))
<div class="fixed-bar">
    <div class="item-title">
        <div class="subject">
            <h3>
                <span class="action">{{ $fixed_title ?? '' }}</span>
                <!--帮助教程-->
                <!--<a class="help-href" href="javascript:;" data-toggle="tooltip" data-placement="auto bottom" title="点击跳转到该模块教程页面"><i class="help-icon"></i></a>-->
                <!----->
            </h3>

            @if(!empty($action_span))
                @foreach($action_span as $vo)
                <h5>
                    <span class="action-span">
                        <a @if(!empty($vo['id']))id="{{ $vo['id'] }}" href="javascript:void(0);" @else href="{{ $vo['url'] }}" @endif class="btn btn-warning click-loading">
                            <i class="fa {{ $vo['icon'] }}"></i>
                            {{ $vo['text'] }}
                        </a>
                    </span>
                </h5>
                @endforeach
            @endif


            {!! $fixedBarHtml ?? '' !!}


        </div>
    </div>
</div>
@endif