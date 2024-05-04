@extends('layouts.user_layout')

{{--header_css--}}
@section('header_css')

@stop

{{--header_js--}}
@section('header_js')

@stop

@section('content')



@stop


<script>
    $().ready(function () {
        WS_AddPoint({
            user_id: '{{ $user_info['user_id'] ?? 0 }}',
            url: "{{ get_ws_url('7272') }}",
            type: "add_point_set"
        });
    });

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