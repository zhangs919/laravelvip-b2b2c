{{--单选按钮 start--}}
<input type="hidden" name="SystemConfigModel[image_dir_type]" value="3">
<div id="systemconfigmodel-image_dir_type" class="" name="SystemConfigModel[image_dir_type]">

    <label class="control-label cur-p m-r-10"><input type="radio" name="SystemConfigModel[site_index]" value="0" checked=""> 商城首页</label>
    <label class="control-label cur-p m-r-10"><input type="radio" name="SystemConfigModel[site_index]" value="1"> 资讯频道</label>
    <label class="control-label cur-p m-r-10"><input type="radio" name="SystemConfigModel[site_index]" value="2">
        专题页<select id="systemconfigmodel-site_index_topic" name="SystemConfigModel[site_index_topic]"
                   class="form-control form-control-xs w150 m-l-10 valid" style="margin-top: -6px;"
                   onclick="$(this).parents('label').find('input').click()">
            <option value="0">--请选择--</option>
        </select></label>

</div>

{{--单选按钮 end--}}