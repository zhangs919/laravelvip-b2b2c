<div id="{{ $page_id }}">
    <div class="search-term m-b-10">
        <form id="searchForm" action="/article/article/picker" method="GET">
            <input type="hidden" name="cat_type" value="1,2,11,12">
            <input type="hidden" name="page[page_id]" value="{{ $pagination_id }}">
            <input type="hidden" name="page[page_size]" value="10">
            <input type="hidden" name="selected_ids" value="{{ implode(',', $selected_ids) }}">
            <input type="hidden" name="output" value="1">
            <input type="hidden" value="0" name="output">
            <div class="simple-form-field simple-form-search">
                <div class="form-group">
                    <label class="control-label">
                        <i class="fa fa-search"></i>
                    </label>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <div class="form-control-wrap">
                        <select name="cat_id" class="form-control chosen-select" id="select_cat_id">

                            <option value="0">所有分类</option>

                            <option value="1">新手上路</option>

                            <option value="2">支付方式</option>

                            <option value="3">配送服务</option>

                            <option value="4">售后服务</option>

                            <option value="5">商家合作</option>

                            <option value="7">卖家入驻</option>

                            <option value="20">        招商方向</option>

                            <option value="21">        招商标准</option>

                            <option value="22">        招商资质</option>

                            <option value="8">店铺续签/终止合作</option>

                            <option value="18">        店铺续签</option>

                            <option value="19">        终止合作</option>

                            <option value="9">店铺管理</option>

                            <option value="12">        我的店铺</option>

                            <option value="13">        商品管理</option>

                            <option value="14">        订单管理</option>

                            <option value="15">        会员管理</option>

                            <option value="16">        账号管理</option>

                            <option value="17">        客服管理</option>

                            <option value="24">商城公告</option>

                            <option value="29">信息公告</option>

                            <option value="30">行业聚焦</option>

                            <option value="31">        电商资讯</option>

                            <option value="32">        玩转电商</option>

                            <option value="55">啊啊</option>

                            <option value="57">图书资讯</option>

                            <option value="58">自由编辑</option>

                        </select>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>标题：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input name="keywords" class="form-control" type="text" placeholder="">
                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <input type="submit" id="btn_submit" class="btn btn-primary" value="搜索" />
            </div>
        </form>
    </div>


    {{--引入列表--}}
    @include('article.article.partials._picker_article_list')

</div>


<script type="text/javascript">
    var tablelist;
    $().ready(function() {
        var params = $('#{{ $page_id }}').find("#searchForm").serializeJson()
        params.selected_ids = get_selected();
        tablelist = $("#table_list").tablelist({
// 支持保存查询条件
            url: '/article/article/picker',
            page_id: "{{ $pagination_id }}",
            params: params
        });
        if (get_selected && typeof (get_selected) == "function") {
            tablelist.params.selected_ids = get_selected();
        }
// 搜索
        $('#{{ $page_id }}').find("#searchForm").submit(function() {
// 序列化表单为JSON对象
            var data = $(this).serializeJson();
            data.selected_ids = get_selected();
// Ajax加载数据
            tablelist.load(data);
// 阻止表单提交
            return false;
        });


        try {
// chosen带搜索的select框
            $('.chosen-select').chosen();
        } catch (e) {
// console.warn("初始化“chosen”发生错误：" + e);
        }

        $('#{{ $page_id }}').find('#select_cat_id_chosen').css("cssText", "width:200px !important;");
    });
</script>