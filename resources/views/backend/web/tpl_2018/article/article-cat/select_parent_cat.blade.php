<script src="/assets/d2eace91/js/common.js?v=20180428"></script>
<!-- 上级id -->
<div class="simple-form-field" >
    <div class="form-group">
        <label for="articlecatmodel-parent_id" class="col-sm-4 control-label">
            <span class="text-danger ng-binding">*</span>
            <span class="ng-binding">上级分类：</span>
        </label>
        <div class="col-sm-8">
            <div class="form-control-box">


                <select class="form-control chosen-select" name="ArticleCatModel[parent_id]" id="select_cat_id">

                    <option value="0" selected='selected'>顶级分类</option>

                    @if(!empty($parent_cat))
                    @foreach($parent_cat as $v)
                    <option value="{{ $v['cat_id'] }}">{{ $v['cat_name'] }}</option>
                    @endforeach
                    @endif

                </select>


            </div>

            <div class="help-block help-block-t"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $().ready(function() {
        $("#select_cat_id").change(function() {
            var cat_id = $(this).children('option:selected').val();
            $.ajax({
                url : 'select-cat-type',
                dataType : 'json',
                async : false,
                data : {
                    cat_id : cat_id,
                },
                success : function(result) {
                    $('#cat_type').html(result.data);
                }
            });
        });
    });
</script>