<div class="floatbar">
    <div class="bar-float">
        <div class="select">
            <ul>
                <!-- 选择的当前的状态 给a标签追加class值为"sel-select" _start -->
                <li id="all_shop" class="sel-item">
                    <a class="sel-link">
                        全部店铺
                        <em> {{ $shop_collect_count }} </em>
                    </a>
                </li>
                <!-- 选择的当前的状态 给a标签追加class值为"sel-select" _end -->
                <li id="buy_shop_list" class="sel-item">
                    <a class="sel-link sel-select">
                        已购
                        <em>  </em>
                    </a>
                </li>
            </ul>
        </div>
        <div class="fav-search fav-shop-search cleatfix">
            <form class="search-panel-focused" id="searchForm" action="">
                <div class="search-panel-fields">
                    <input name="search_shop" type="text" placeholder="请输入搜索关键字" value="" class="search-combobox-input">
                </div>
                <div class="search-button-shop">
                    <input name="buy_shop_list" type="submit" class="btn-search" value="搜店铺" />
                </div>
                <input name="tab" type="hidden" value="buy_shop_list" />
                <input name="type" type="hidden" value="1" />
            </form>
        </div>
        <div class="tools">
            <div class="tool-showbtn">批量管理</div>
            <ul class="tool-list">
                <!-- 如果是全选状态，给li标签追加class值"tool-item-selall"  _start-->
                <li class="tool-item">
                    <i class="iconfont"></i>
                    全选
                </li>
                <!-- 如果是全选状态，给li标签追加class值"tool-item-selall"  _end-->
                <li id="tools" class="tool-item">
                    <i class="iconfont"></i>
                    删除
                </li>
                <li class="tool-item tool-hidebtn">取消管理</li>
            </ul>
        </div>
    </div>
</div>

@include('user.collect.partials._ajax_shop_list')

<script type="text/javascript">
    //
</script>
<script type="text/javascript">
    //
</script>
<script type="text/javascript">
    //
</script>
<script>

    $(function() {
        $(".select li").on('click', function() {
            $.loading.start();
            var page = $(this).attr('id');
            $.ajax({
                type: 'GET',
                url: '/user/collect/shop?tab=' + page + '',
                dataType: 'json',
                success: function(result) {
                    $('.collect-list').removeClass('collect-list-items');
                    $(".collect-list").html(result.data);
                }
            })
        })
    })

    //



    $(function() {
        $("#tools").click(function() {
            var arr = new Array();
            var int = 0;
            $(".edit-pop-select input").each(function() {
                arr[int] = $(this).val();
                int++;
            });
            if (int > 0) {
                $.confirm("是否删除选中内容？", function(s) {
                    if (s) {
                        $.ajax({
                            type: 'GET',
                            url: '/user/collect/delete-collect?id=' + arr,
                            dataType: 'json',
                            success: function(result) {
                                $("#all_shop em").html(result.shop_count);
                                $("#buy_shop_list em").html(result.buy_count);
                                tablelist.load();
                                $.msg("删除成功");
                            }
                        })
                    }
                });
            } else {
                $.msg("亲,请先选择要删除的的店铺");
            }
        })
    })

    //



    var tablelist = null;
    $().ready(function() {
        tablelist = $("#table_list").tablelist({
            params: $("#searchForm").serializeJson()
        });
        $("#searchForm").submit(function() {

// 序列化表单为JSON对象
            var data = $(this).serializeJson();
            console.info(data);
// Ajax加载数据
            tablelist.load(data);
// 阻止表单提交
            return false;
        });
    });

    //
</script>