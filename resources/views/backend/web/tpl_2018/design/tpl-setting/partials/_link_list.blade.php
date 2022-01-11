@if($link_type == 0)
    <input class="form-control w180" type="text" name="link" value="{{ $link ?? '' }}" placeholder="输入链接地址">
@else
    <select name="link" class="form-control chosen-select">

        @if(!empty($link_data))
            <option value="" >-- 请选择 --</option>
            @foreach($link_data as $v)
                <option value="{{ $v['link'] }}" @if($link == $v['link']) selected="selected" @endif>{!! $v['title'] !!}</option>
            @endforeach
        @endif

    </select>
@endif