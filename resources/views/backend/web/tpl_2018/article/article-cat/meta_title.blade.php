@if($cat_model == 2)
<!-- meta_title-->
<div class="simple-form-field" >
    <div class="form-group">
        <label for="articlecatmodel-meta_title" class="col-sm-4 control-label">

            <span class="ng-binding">META Title（分类标题）：</span>
        </label>
        <div class="col-sm-8">
            <div class="form-control-box">

                <input type="text" id="articlecatmodel-meta_title" class="form-control" name="ArticleCatModel[meta_title]">

            </div>

            <div class="help-block help-block-t"><div class="help-block help-block-t">针对搜索引擎设置的标题</div></div>
        </div>
    </div>
</div>
<!-- meta_keywords-->
<div class="simple-form-field" >
    <div class="form-group">
        <label for="articlecatmodel-meta_keywords" class="col-sm-4 control-label">

            <span class="ng-binding">META Keywords（分类关键词）：</span>
        </label>
        <div class="col-sm-8">
            <div class="form-control-box">

                <input type="text" id="articlecatmodel-meta_keywords" class="form-control" name="ArticleCatModel[meta_keywords]">

            </div>

            <div class="help-block help-block-t"><div class="help-block help-block-t">关键字中间用英文半角逗号(,)隔开</div></div>
        </div>
    </div>
</div>

<!-- meta_desc -->
<div class="simple-form-field" >
    <div class="form-group">
        <label for="articlecatmodel-meta_desc" class="col-sm-4 control-label">

            <span class="ng-binding">META Description（分类描述）：</span>
        </label>
        <div class="col-sm-8">
            <div class="form-control-box">

                <input type="text" id="articlecatmodel-meta_desc" class="form-control" name="ArticleCatModel[meta_desc]">

            </div>

            <div class="help-block help-block-t"><div class="help-block help-block-t">针对搜索引擎设置的网页描述</div></div>
        </div>
    </div>
</div>
@endif