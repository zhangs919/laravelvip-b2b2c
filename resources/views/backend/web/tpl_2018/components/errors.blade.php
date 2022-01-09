{{--post 提交 错误提示信息--}}
@if(is_object($errors) && count($errors->all()) > 0)
    @php
        $errors = implode('</br>', $errors->all())
    @endphp
@elseif(is_array($errors) && !empty($errors))
    @php
        $errors = implode('</br>', $errors)
    @endphp
@elseif(is_string($errors))

@endif

@if(!empty($errors) && count($errors) > 0)
$.msg("{{ $errors }}", {
time: 3000,
});
@endif