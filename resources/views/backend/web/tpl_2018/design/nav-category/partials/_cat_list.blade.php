<script src="/assets/d2eace91/js/common.js?v=1.2"></script>
<label class="control-label">关联到分类：</label>
<select name="link" class="form-control chosen-select" >


    @foreach($cat_list as $v)

        <option value="{{ $v['cat_id'] }}">@if($v['_child'])<span>◢</span>@endif {!! $v['title_show'] !!}</option>

    @endforeach

</select>