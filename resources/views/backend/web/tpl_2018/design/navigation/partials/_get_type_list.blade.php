<select name="NavigationModel[nav_link]" class="form-control chosen-select">
    @if(!empty($link_data))
        <option value="" >-- 请选择 --</option>
        @foreach($link_data as $link)
            <option value="{{ $link['link'] }}" @if($nav_link == $link['link']) selected="selected" @endif>{!! $link['title'] !!}</option>
        @endforeach
    @endif
</select>

<script type="text/javascript">
    $("[name='NavigationModel[nav_link]']").chosen();
</script>
