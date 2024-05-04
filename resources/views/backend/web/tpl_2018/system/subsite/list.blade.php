{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')

@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <!-- 搜索条件 -->
    <div class="search-term  m-b-10">
        <form id="searchForm" action="/system/subsite/list" method="GET">

            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>关键字：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input id="key_word" name="key_word" class="form-control w180" type="text" value="" placeholder="站点ID/站点名称">
                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>站点状态：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select name="is_open" class="form-control">
                            <option value="">全部</option>
                            <option value="1">开启</option>
                            <option value="0">关闭</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <input type="submit" id="btn_submit" class="btn btn-primary m-r-5" value="搜索">
                <!-- <input type="button" id="btn_export" class="btn btn-default m-r-5" value="导出" /> -->
            </div>
        </form>
    </div>
    <!--列表上面（列表名称、列表显示项设置）-->

    <div class="common-title">
        <div class="ftitle">
            <h3>{{ $title }}</h3>

            <h5>
                (&nbsp;共
                <span data-total-record="true" class="pagination-total-record"></span>
                条记录&nbsp;)
            </h5>

        </div>
        <div class="operate m-l-20">

            <a class="reload" href="javascript:reload();" data-toggle="tooltip" data-placement="auto bottom" title="" data-original-title="刷新数据">
                <i class="fa fa-refresh"></i>
            </a>
            <script type="text/javascript">
                function reload() {

                }
            </script>


            <span class="rline"></span>


            <div class="editTablebox">
                <a href="javascript:void(0);" class="editBtn">
                    <i class="fa fa-cogs"></i>
                </a>
                <div class="edit-table dropdown-menu animated fadeInDown">
                    <h5>设置表格显示项</h5>
                    <ul>





                        <li>
                            <label>

                                <input type="checkbox" id="editColumn_article_cat" class="checkBox" checked="checked">

                                <span> 文章分类 </span>
                            </label>
                        </li>





                        <li>
                            <label>

                                <input type="checkbox" id="editColumn_article_title" class="checkBox" checked="checked">

                                <span> 文章标题 </span>
                            </label>
                        </li>





                        <li>
                            <label>

                                <input type="checkbox" id="editColumn_add_time" class="checkBox" checked="checked">

                                <span> 发布时间 </span>
                            </label>
                        </li>

                    </ul>
                </div>
            </div>

        </div>
    </div>
    <!-- 列表 -->


    <div class="table-responsive">

        {{--引入列表--}}
        @include('system.subsite.partials._list')

    </div>

@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block page元素同级下面--}}
@section('extra_html')

@stop

{{--helper_tool--}}
@section('helper_tool')

@stop

{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <script type="text/javascript">
        var tablelist;
        $().ready(function() {
            tablelist = $("#table_list").tablelist({
                // 支持保存查询条件
                params: $("#searchForm").serializeJson()
            });

            // 搜索
            $("#searchForm").submit(function() {
                // 序列化表单为JSON对象
                var data = $(this).serializeJson();
                // Ajax加载数据
                tablelist.load(data);
                // 阻止表单提交
                return false;
            });
            // 删除记录
            $("body").on('click', '.del', function() {
                var id = $(this).data("id");
                tablelist.remove({
                    confirm: '您确定删除这条记录吗？',
                    url: 'delete',
                    data: {
                        id: id
                    }
                });
            });

        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop