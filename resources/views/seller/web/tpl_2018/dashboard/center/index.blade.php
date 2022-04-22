{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/revision-styles.css?v=20180702"/>
@stop

{{--content--}}
@section('content')

    @foreach(get_shop_application_list() as $app)
        <div class="application-list" @if(!empty($app['is_hide'])) style="display: none" @endif>
            <h3>{{ $app['name'] }}</h3>
            <ul class="clear row">
                @if(!empty($app['child']))
                    @foreach($app['child'] as $child)
                        @if($shop_auth == 'all_auth' || in_array($child['field'], $shop_auth))
                        <li class="application-item col-md-3 col-sm-4 col-xs-12" @if(!empty($child['is_hide'])) style="display: none" @endif>

                            <a href="{{ $child['url'] }}">

                                <div class="application-logo">
                                    <i class="{{ $child['logo'] }}"></i>
                                </div>
                                <div class="application-name">{{ $child['name'] }}</div>
                                <div class="application-desc">{{ $child['desc'] }}</div>
                                @if(!empty($child['label']))
                                    <span class="application-label @if($child['is_disp_block']) disp-block @endif">{{ $child['label'] }}</span>
                                @endif
                            </a>
                        </li>
                        @endif
                    @endforeach
                @endif
            </ul>
        </div>
    @endforeach

@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block--}}
@section('extra_html')

@stop


{{--helper_tool--}}
@section('helper_tool')

@stop


{{--footer script page元素同级下面--}}
@section('footer_script')

@stop

{{--outside body script--}}
@section('outside_body_script')

@stop