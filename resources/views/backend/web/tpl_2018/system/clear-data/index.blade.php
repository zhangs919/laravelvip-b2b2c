@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
@stop

@section('content')

    <div class="fixed-bar">
        <div class="item-title">
            <div class="subject">
                <h3>
                    <span class="action">清测试数据 - 列表</span>
                    <!--帮助教程-->
                    <!--<a class="help-href" href="javascript:;" data-toggle="tooltip" data-placement="auto bottom" title="点击跳转到该模块教程页面"><i class="help-icon"></i></a>-->
                    <!----->
                </h3>

            </div>
        </div>
    </div>


    <div class="explanation m-b-10">
        <div class="title">
            <i class="arrow-icon explain-checkZoom cur-p" title=""></i>
            <i class="fa fa-bullhorn"></i>
            <h4>温馨提示</h4>
        </div>
        <ul class="explain-panel">
            <li>
                <span>商城运营打理前，请先清理初始数据，如果已经维护部分数据，建议不要随便清理数据，否则会造成数据丢失</span>
            </li>
            <li>
                <span>如果误删数据，需要交纳费用恢复数据，费用价格由数据量决定，请谨慎操作</span>
            </li>
            <li>
                <span>每个商城只能清理一次数据</span>
            </li>

        </ul>
    </div>
    <form id="form" class="form-horizontal" action="/system/clear-data/index" method="post">
        @csrf
        <div class="common-title">
            <h5>
                <label class="control-label cur-p m-l-10">
                    <input id="all" class="checkBox allCheckBox m-r-5 va-bottom" type="checkbox" onclick="selectAuthsAll(this)">
                    全部选择
                </label>
            </h5>
        </div>
        <div class="table-responsive m-t-10">
            <div class="authset-all">
                <dl class="simple-form-field">
                    <dt class="tit">
					<span>
						<label>
							<input type="checkbox" value="suggestion" id="suggestion" data-parent-id="root" onclick="selectAuth(this.id)">
							商城拓展数据
						</label>

						<span class="c-blue f12 m-l-10">说明：建议清理</span>

					</span>
                    </dt>
                    <dd class="form-group-t">
                        <div class="authset-list">
                            <div class="col-sm-14 control-label control-label-t">
                                <ul class="authset-section" style="border-left: none;">
                                    <li>
                                        <label>
                                            <input type="checkbox" id="" name="codes[]" data-parent-id="suggestion" value="goods" class="auth-item" onclick="selectAuth(this.id)">
                                            商品管理
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox" id="" name="codes[]" data-parent-id="suggestion" value="shop" class="auth-item" onclick="selectAuth(this.id)">
                                            店铺
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox" id="" name="codes[]" data-parent-id="suggestion" value="shop_category" class="auth-item" onclick="selectAuth(this.id)">
                                            店铺分类
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox" id="" name="codes[]" data-parent-id="suggestion" value="user" class="auth-item" onclick="selectAuth(this.id)">
                                            会员列表
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox" id="" name="codes[]" data-parent-id="suggestion" value="mall_nav" class="auth-item" onclick="selectAuth(this.id)">
                                            商城导航
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox" id="" name="codes[]" data-parent-id="suggestion" value="nav_banner" class="auth-item" onclick="selectAuth(this.id)">
                                            首页轮播图
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox" id="" name="codes[]" data-parent-id="suggestion" value="quick_service" class="auth-item" onclick="selectAuth(this.id)">
                                            快捷服务
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox" id="" name="codes[]" data-parent-id="suggestion" value="links" class="auth-item" onclick="selectAuth(this.id)">
                                            友情链接
                                        </label>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </dd>
                </dl>
                <dl class="simple-form-field">
                    <dt class="tit">
					<span>
						<label>
							<input type="checkbox" value="no_suggestion" id="no_suggestion" data-parent-id="root" onclick="selectAuth(this.id)">
							商城基础数据
						</label>

						<span class="c-blue f12 m-l-10">说明：不建议清理</span>

					</span>
                    </dt>
                    <dd class="form-group-t">
                        <div class="authset-list">
                            <div class="col-sm-14 control-label control-label-t">
                                <ul class="authset-section" style="border-left: none;">
                                    <li>
                                        <label>
                                            <input type="checkbox" id="" name="codes[]" data-parent-id="no_suggestion" value="category" class="auth-item" onclick="selectAuth(this.id)">
                                            分类管理
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox" id="" name="codes[]" data-parent-id="no_suggestion" value="brand" class="auth-item" onclick="selectAuth(this.id)">
                                            品牌管理
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox" id="" name="codes[]" data-parent-id="no_suggestion" value="goods_type" class="auth-item" onclick="selectAuth(this.id)">
                                            商品类型
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox" id="" name="codes[]" data-parent-id="no_suggestion" value="image_space" class="auth-item" onclick="selectAuth(this.id)">
                                            图片空间
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox" id="" name="codes[]" data-parent-id="no_suggestion" value="cat_nav" class="auth-item" onclick="selectAuth(this.id)">
                                            分类导航
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox" id="" name="codes[]" data-parent-id="no_suggestion" value="mall_account" class="auth-item" onclick="selectAuth(this.id)">
                                            商城账户
                                        </label>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </dd>
                </dl>

            </div>

            <div class="col-md-12 text-c p-b-30 p-t-20">
                <input type="button" id="btn_submit" value="一键清理" class="btn btn-primary btn-lg">
            </div>

        </div>
    </form>

@stop

@section('script')
    <script type="text/javascript">
        $().ready(function() {

            $("#btn_submit").click(function() {

                var data = $("#form").serializeJson();
                var url = $("#form").attr("action");

                if (data.codes == undefined || data.codes.length == 0) {
                    $.msg("请选择您要清理的数据！");
                    return;
                }

                if (confirm("您确定要进行此操作吗？继续进行将会彻底删除您选择的数据，请谨慎操作！")) {
                    if (confirm("如果数据不是演示数据则建议您不要进行清理，以免数据丢失！")) {
                        alert("您还是选择继续清理数据，如果此时你想撤销操作请关闭浏览器！否则系统将对您选择的数据进行清理！！");
                    } else {
                        return;
                    }
                } else {
                    return;
                }

                //加载提示
                $.loading.start();
                $.post(url, data, function(result) {
                    if (result.code == 0) {
                        $.msg(result.message, {
                            time: 2000
                        });
                        $.go("/system/clear-data/index");
                        //$.go("/index/index");
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "json").always(function() {
                    $.loading.stop();
                });

                return false;
            });

            //级联选中
            $("[data-parent-id]:checkbox").on("change", function() {
                var checked = $(this).is(":checked");
                var parent_id = $(this).data("parent-id");
                var id = $(this).attr("id");

                // 排除禁用的选项
                var elements = $("[data-parent-id='" + id + "']:checkbox").not("[disabled]");
                $(elements).prop("checked", checked);
                $(elements).change();

            });

            // 页面加载后的初始化状态
            $(".auth-item").each(function() {
                selectAuth($(this).attr("id"));
            });

        });

        // 选择权限项
        function selectAuth(id) {
            var parent_id = $("#" + id).data("parent-id");

            if (!parent_id) {
                return;
            }

            var elements = $("[data-parent-id='" + parent_id + "']:checkbox");

            if ($(elements).size() == $(elements).filter(":checked").size()) {
                $("#" + parent_id).prop("checked", true);
                selectAuth(parent_id);
            } else {
                $("#" + parent_id).prop("checked", false);
                selectAuth(parent_id);
            }

        }

        //全选权限
        function selectAuthsAll(target) {
            $("[data-parent-id='root']").prop("checked", $(target).prop("checked"));
            $("[data-parent-id='root']").change();
        }
    </script>
@stop