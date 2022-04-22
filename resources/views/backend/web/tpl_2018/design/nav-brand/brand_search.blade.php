<div class="simple-form-field">
    <div class="form-group">
        <label for="text4" class="col-sm-2 control-label">
            <span class="ng-binding">品牌列表：</span>
        </label>
        <div class="col-sm-9">

            {{--引入列表--}}
            @include('design.nav-brand.partials._brand_table_list')

        </div>
    </div>
</div>

<script type="text/javascript">
    var tablelist;
    $().ready(function() {
        tablelist = $("#table_list").tablelist({
// 支持保存查询条件
            url: 'brand-table-list',
        });
// 搜索

    });

    function selectBrand(brand_id, brand_name, brand_logo) {
        $.loading.start();
        $("#select_brand").css('display','block');
        $("#brand_logo").attr("src", brand_logo);
        $("#brand_name").text(brand_name);
        $("#brand_id").val(brand_id);
        $.loading.stop();
    }
</script>