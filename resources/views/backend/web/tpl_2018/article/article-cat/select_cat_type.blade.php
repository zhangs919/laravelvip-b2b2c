<script src="/assets/d2eace91/js/common.js?v=20180428"></script>

<div class="simple-form-field" >
    <div class="form-group">
        <label for="articlecatmodel-cat_type" class="col-sm-4 control-label">

            <span class="ng-binding">分类类型：</span>
        </label>
        <div class="col-sm-8">
            <div class="form-control-box">

                @if(empty($cat_type_info))
                <select class="form-control chosen-select" name="ArticleCatModel[cat_type]" id="select_cat_type">

                    @foreach($cat_types as $k=>$v)
                        <option value="{{ $k }}">{{ $v }}</option>
                    @endforeach

                </select>
                @else
                <label class="control-label">{{ $cat_type_info['cat_type_name'] }}</label>
                <input type="hidden" name="ArticleCatModel[cat_type]" value="{{ $cat_type_info['cat_type_id'] }}">
                @endif

            </div>


            <div class="help-block help-block-t"><div class="help-block help-block-t">不同分类类型的文章分类，添加的文章控制前台不同页面展示 </div></div>
        </div>
    </div>
</div>