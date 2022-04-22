<div class="simple-form-field goods-spec-item drop-item" data-spec-id="{{ $spec_id }}">
<input type="hidden" name="spec_alias[#key#][attr_id]" value="{{ $attr_id }}" />
<div class="form-group spec-id-{{ $spec_id }}" data-spec-id="{{ $spec_id }}" data-spec-name="{{ $spec_name }}">
    <!-- 规格名称 -->
    <label class="col-sm-2 control-label spec-name cur-p" data-spec-id="{{ $spec_id }}">
        <input type="text" id="spec_name_{{ $spec_id }}" name="spec_alias[#key#][attr_name]" class="form-control form-control-xs text-r w70 spec-name" value="{{ $spec_name }}" data-spec-id="{{ $spec_id }}" data-rule-required="true" data-msg="规格名称不能为空!">
        ：
    </label>
    <!-- 规格值列表 -->
    <div class="col-sm-9 spec-values" data-spec-id="{{ $spec_id }}">


        @foreach($attr_values as $v)
        <label class="control-label text-l cur-p w100" title="{{ $v->attr_vname }}">
            <input type="checkbox" value="{{ $v->attr_vid }}" data-attr-id="{{ $v->attr_id }}" data-vid="{{ $v->attr_vid }}" data-vname="{{ $v->attr_vname }}" class="spec-value">
            {{ $v->attr_vname }}



        </label>
        @endforeach





        <label class="control-label cur-p">
            <input type="checkbox" value="1" class="spec-value spec-other-value" data-attr-id="{{ $attr_id }}">
            <input type="text" name="other_spec[]" value="" placeholder="其他" maxlength="15" class="form-control form-control-xs w80 spec-other-text" data-rule-uniqueOtherSpecName="true">
        </label>

    </div>
</div>
<div class="actions-box">
<span class="actions-btn goods-spec-item-btn-up" title="点击向上移动此规格">
<i class="fa fa-arrow-circle-o-up"></i>
上移
</span>
    <span class="actions-btn goods-spec-item-btn-down" title="点击向下移动此规格">
<i class="fa fa-arrow-circle-o-down"></i>
下移
</span>
</div>
</div>