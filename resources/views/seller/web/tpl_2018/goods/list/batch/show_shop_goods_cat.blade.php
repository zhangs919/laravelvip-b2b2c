<div id="{{ $uuid }}" class="page">
    <div class="table-content clearfix">
        <form method='post' class='form-horizontal'>
            <input type="hidden" id="goods_ids" name="goods_ids" value="{{ $goods_ids }}" />
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="" class="col-sm-4 control-label">
                        <span class="ng-binding">设置方式：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <!-- -->
                            <div class="" name="type" value="0"><label class="control-label cur-p m-r-10"><input type="radio" name="type" value="0" checked> 追加所选分类</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="type" value="1"> 覆盖原有分类</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="type" value="2"> 移除所选分类</label></div>
                            <!-- -->
                        </div>
                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>                <!-- -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="" class="col-sm-4 control-label">
                        <span class="ng-binding">选择分类：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <!-- 店铺内商品分类 -->
                            <div class="control-label div-scroll m-b-10" style="min-width: 320px; height: 450px;">
                                @foreach($shop_cat_list as $v)
                                    <label>

                                        <input type="checkbox" name="shop_cat_ids[]" value="{{ $v['cat_id'] }}" @if($v['cat_level'] == 2)class="cat-two"@endif>

                                        {{ $v['cat_name'] }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script type="text/javascript">
        // 
    </script>
</div><script>

    $().ready(function() {

        var form = $("#{{ $uuid }}").find("form");

        $("#{{ $uuid }}").parents(".layui-layer").find(".layui-layer-btn0").click(function() {
            var data = $(form).serializeJson();
            $.loading.start();
            $.post('/goods/list/move-shop-goods-cat', {
                data: data
            }, function(result) {
                if (result.code == 0) {
// 关闭对话框
                    $("#{{ $uuid }}").parents(".modal").find(".close").click();
// 显示消息
                    $.msg(result.message, {
                        time: 1500
                    }, function() {
                        $.closeAll();
                        if (typeof (tablelist) != "undefined" && tablelist) {
                            tablelist.load();
                        } else {
                            $.go('/goods/list');
                        }
                    });
                } else {
                    $.msg(result.message, {
                        time: 5000
                    });
                }
            }, "json").always(function() {
                $.loading.stop();
            });
        });
    });

    // 
</script>