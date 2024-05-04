<select class="form-control" id="cat_id2" name="cat_id2">
    <option value="0">所有分类</option>
    @foreach($cat_list as $item)
        <option value="{{ $item['cat_id'] }}">{{ $item['cat_name'] }}</option>
    @endforeach
</select>