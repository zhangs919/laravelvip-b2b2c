<div id="ActivityPickerPage_{{ $uuid }}" class="simple-form-field">
    <div class="form-group">
        <label for="text4" class="col-sm-0 control-label"></label>
        <div class="col-sm-12">
            <div class="choose-goods-list">
                <div class="search-condition">
                    <div class="pull-left">

                        <select id="shop_id" class="form-control chosen-select m-l-2" name="shop_id">
                            <option value="">--请选择店铺--</option>
                            <option value="1">鲜农乐食品专营店</option>
                        </select>

                        <span id="artivity_list"></span>
                        <input type="text" name="goods_name" id="goods_name" class="form-control large m-l-2" placeholder="商品名称">
                        <input type="button" class="btn btn-primary m-l-2 m-r-2 btn-submit" value="搜索商品">
                        <span class="text-explode m-r-2">|</span>
                        <input type="button" class="btn btn-default m-r-2 selectall-page" value="本页全选">
                        <input type="button" class="btn btn-default m-r-2 unselectall" value="全部取消">
                        <!--
                        <input type="button" class="btn btn-default m-r-2 selectall" value="一键全选">
                        <span class="text-explode m-r-2">|</span>
                        <label class="input-label">
                        <input class="checkBox" type="checkbox" id="select_show" />
                        不看已选择商品
                        </label>
                        -->
                    </div>
                    <div class="clear"></div>
                </div>

                {{--引入列表--}}
                @include('activity.activity.partials._list')

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var tablelist;
    $().ready(function() {
        var act_type = '3';
        try {
// chosen带搜索的select框
            $('.chosen-select').chosen();
        } catch (e) {
// console.warn("初始化“chosen”发生错误：" + e);
        }

        var container = $("#ActivityPickerPage_{{ $uuid }}");

        tablelist = $(container).find("#table_list").tablelist({
            url: "/activity/activity/picker",
            method: "POST",
            page_id: "#ActivityPickerPage_{{ $uuid }}",
            params: {
                shop_id: $(container).find('#shop_id').val(),
                act_id: $(container).find('#act_id').val(),
                act_type: act_type,
                selected_ids: get_selected()
            }

        });

        $(container).find("#shop_id").change(function() {
            var shop_id = $(this).val();
            var act_type = '3';
            $.get('/activity/activity/picker', {
                'handle': 'get_activity_list',
                'shop_id': shop_id,
                'act_type': act_type
            }, function(result) {
                if (result.code == 0) {
                    $(container).find('#artivity_list').html(result.data);
                    $(container).find('#artivity_list .chosen-select').chosen();
                }
            }, 'JSON');
        });

// 点击搜索按钮
        $(container).find(".btn-submit").click(function() {
            tablelist.page.cur_page = 1;
            var params = {
                shop_id: $(container).find('#shop_id').val(),
                act_id: $(container).find('#act_id').val(),
                goods_name: $(container).find('#goods_name').val(),
                act_type: act_type,
                selected_ids: get_selected()
            };
            tablelist.load(params);
        });

// 全部取消 
        $(container).find(".unselectall").click(function() {
            $(container).find(".btn-goodspicker").each(function() {
                if ($(this).data("selected") == true) {
                    $(this).click();
                }
            });
        });

// 本页全选
        $(container).find(".selectall-page").click(function() {
            $(container).find(".btn-goodspicker").each(function() {
                if ($(this).data("selected") == false) {
                    $(this).click();
                }
            });
        });

    });
</script>