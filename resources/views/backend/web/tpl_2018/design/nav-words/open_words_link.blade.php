@if($type == 0)
    <div class="simple-form-field ">
        <div class="form-group">
            <label for="text4" class="col-sm-4 control-label"> <span class="ng-binding">自定义连接：</span> </label>
            <div class="col-sm-8">
                <div class="form-control-box">
                    <input type="text" value="{{ $link ?? '' }}" name="NavWordsModel[words_link]" class="form-control" placeholder=''>
                </div>
                <div class="help-block help-block-t">示例：http://www.xxx.com</div>
            </div>
        </div>
    </div>
@elseif($type == 1)
    <script src="/assets/d2eace91/js/common.js?v=20181123"></script>
    <div class="simple-form-field ">
        <div class="form-group">
            <label for="text4" class="col-sm-4 control-label"> <span class="ng-binding">选择关联商品分类：</span> </label>
            <div class="col-sm-8">
                <select name="NavWordsModel[words_link]" class="form-control chosen-select">


                    @foreach($cat_list as $v)

                        <option value="{{ $v['cat_id'] }}" @if($link == $v['cat_id']){{ 'selected="true"' }}@endif>@if($v['_child'])<span>◢</span>@endif {!! $v['title_show'] !!}</option>

                    @endforeach

                </select>
            </div>
        </div>
    </div>
@elseif($type == 2)

@endif