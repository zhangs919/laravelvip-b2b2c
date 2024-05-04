<select name="link" class="form-control  areaLinkInfo w150">
    <option value="" selected="selected">-- 请选择 --</option>
    @foreach($shop_list as $item)
        <option value="{{ $item['link'] }}">{{ $item['title'] }}</option>
    @endforeach
</select>