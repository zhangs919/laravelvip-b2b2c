@extends('layouts.base')

@section('header_css')

@stop

{{--follow_box 注意此效果只在首页面展示--}}
@section('follow_box')

@stop

@section('content')



@stop


{{--底部js--}}
@section('footer_js')

@stop


<script>

    $().ready(function() {
        WS_AddPoint({
            user_id: '{{ $user_info['user_id'] ?? 0 }}',
            url: "{{ get_ws_url('4431') }}",
            type: "add_point_set"
        });
    }, 'JSON');
    function addPoint(ob) {
        if (ob != null && ob != 'undefined') {
            if (ob.point && ob.point > 0 && ob.user_id && ob.user_id == '{{ $user_info['user_id'] ?? 0 }}') {
                $.intergal({
                    point: ob.point,
                    name: '积分'
                });
            }
        }
    }
</script>