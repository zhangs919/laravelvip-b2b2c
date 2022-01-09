<div class="nav-category-icon">
    <div class="simple-form-field">
        <div class="form-group">
            <div class="col-sm-12">
                <input class="form-control w200 m-r-10" type="text" value="" id="keyword" />
                <a href="javascript:void(0)" class="btn btn-warning btn-sm search-icon">搜索</a>
            </div>
        </div>
    </div>

    {{--include 图标列表--}}
    @include('design.nav-category.partials._icon_list')

</div>

<script type="text/javascript">
    var tablelist;
    $().ready(function() {
        tablelist = $("#table_list").tablelist({
            url: 'select-icon',
        });
// 搜索
        $(".search-icon").click(function() {
// Ajax加载数据
            tablelist.load({
                url: 'select-icon',
                keyword: $('#keyword').val()
            });
// 阻止表单提交
            return false;
        });
//点击事件
        $('body').on('click','.icon-label',function(){
            var code = $(this).find('input').val();
            if ($.trim(code) != '') {
                code = '&' + code;
                $('#show_icon').html(code);
                $("#show_icon").removeClass('iconfont-bg');
                $('#navcategorymodel-nav_icon').val(code);
                $.modal('hide');
                $('#del_icon').removeClass('hide');
            } else {
                $.msg("请选择图标");
            }
        });
    });
</script>