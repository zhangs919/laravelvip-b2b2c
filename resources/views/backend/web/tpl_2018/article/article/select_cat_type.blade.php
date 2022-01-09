<div class="form-group">
    <label class="control-label">
        <span>文章分类：</span>
    </label>
    <div class="form-control-wrap">
        <select name="cat_id" class="form-control chosen-select" id="select_cat_id">

            <option value="0">所有分类</option>

            @foreach($cat_list as $cat)

            <option value="{{ $cat['cat_id'] }}">@if($cat['_child']){{--<span>◢</span>--}}@endif {{ $cat['title_show'] }}</option>

            @endforeach

        </select>
    </div>
</div>
<script type="text/javascript">
    $("#select_cat_id").chosen();
</script>