<!-- AJAX上传 -->
<script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=20180528"></script>
<div id="{{ $page_id }}" class="form-horizontal">
    <!-- 温馨提示 -->

    <div class="explanation m-b-10">
        <div class="title">
            <i class="arrow-icon explain-checkZoom cur-p" title=""></i>
            <i class="fa fa-bullhorn"></i>
            <h4>温馨提示</h4>
        </div>
        <ul class="explain-panel">
            <li>
                <span>为达到页面效果，建议上传4个或8个菜单（图片尺寸为135*135），您可以点击下面的“＋”添加菜单</span>
            </li>
            <li>
                <span>导航名称最多不能超过10个字，默认字体颜色为黑色</span>
            </li>

        </ul>
    </div>


    <div class="modal-body p-0">
        <div class="table-content clearfix">
            <div class="navTableBox">
                <table id="addNavTable" class="table table-hover navTable">
                    <thead>
                    <tr>

                        <th class="text-c">图片</th>

                        <th class="text-c">导航名称</th>
                        <th class="text-c">字体颜色</th>
                        <th class="text-c">导航链接</th>
                        <th class="text-c">排序</th>
                        <th class="text-c handle">操作</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                        <td>
                            <div class="szy-imagegroup" data-size="1"></div>
                            <input type="hidden" id="path" name="path" value="">
                        </td>
                        <td class="text-c">
                            <input placeholder="导航名称" type="text" name="name" value="" class="form-control w100">
                        </td>
                        <td class="text-c">
                            <input type="text" name="color" value="" class="form-control w100 colorpicker">
                        </td>
                        <td>
                            <div id="1529337961RrK7c8">
                                <input type="hidden" id="select_width" value="w200">
                                <input type="hidden" id="page_code" value="m_site">
                                <select class="form-control w100 " id="link_type" name="link_type">
                                    <option value="0" selected="selected">自定义链接</option>
                                    <option value="1" >常用链接</option>
                                    <!-- <option value="2" >选择商品</option> -->
                                    <option value="3" >店铺主页</option>
                                    <option value="8" >文章分类</option>
                                    <option value="4" >文章详情</option>

                                    <option value="5" >分类商品</option>


                                    <option value="6" >团购活动</option>

                                    <option value="7" >品牌专题</option>
                                    <option value="9" >专题活动</option>
                                </select>
                                <span id="link_change">


<input class="form-control w180" type="text" name="link" value="" placeholder="输入链接地址">


</span>
                            </div>
                            <!-- 处理切换连接类型 -->
                            <script type="text/javascript">
                                $().ready(function() {
                                    $('#1529337961RrK7c8').find('#link_type').change(function() {
                                        var link_type = $(this).val();
                                        var select_width = $('#1529337961RrK7c8').find('#select_width').val();
                                        var page = $('#1529337961RrK7c8').find('#page_code').val();
//var link = $('#1529337961RrK7c8').find("[name='link']").val();
                                        $.ajax({
                                            type: 'get',
                                            url: 'change-link-type',
                                            dataType: 'json',
                                            data: {
                                                link_type: link_type,
                                                select_width: select_width,
                                                page: page,
                                            },
                                            success: function(result) {
                                                $('#1529337961RrK7c8').find('#link_change').html(result.data);
                                                $('#1529337961RrK7c8').find('.chosen-select').chosen();
                                                $('#1529337961RrK7c8').find('.chosen-container').addClass('w200');
                                            },
                                        });
                                    });
                                });
                            </script></td>
                        <td>
                            <input class="form-control small" type="text" value="1" name="sort">
                        </td>
                        <td class="text-c handle">
                            <a class="del nav-del" href="javascript:void(0);">删除</a>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
            <div class="navAdd">
                <em>+</em>
                添加导航
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="ok">确定</button>
            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">取消</button> -->
        </div>
    </div>


    <table class="chrTable1 hide">
        <tbody>
        <tr>
            <td>
                <div class="szy-imagegroup" data-size="1"></div>
                <input type="hidden" id="path" name="path" value="">
            </td>
            <td class="text-c">
                <input placeholder="导航名称" type="text" name="name" value="" class="form-control w100">
            </td>
            <td class="text-c">
                <input type="text" name="color" value="" class="form-control w100 colorpicker">
            </td>
            <td>
                <div id="15293379615nzH5T">
                    <input type="hidden" id="select_width" value="w200">
                    <input type="hidden" id="page_code" value="m_site">
                    <select class="form-control w100 " id="link_type" name="link_type">
                        <option value="0" selected="selected">自定义链接</option>
                        <option value="1" >常用链接</option>
                        <!-- <option value="2" >选择商品</option> -->
                        <option value="3" >店铺主页</option>
                        <option value="8" >文章分类</option>
                        <option value="4" >文章详情</option>

                        <option value="5" >分类商品</option>


                        <option value="6" >团购活动</option>

                        <option value="7" >品牌专题</option>
                        <option value="9" >专题活动</option>
                    </select>
                    <span id="link_change">


<input class="form-control w180" type="text" name="link" value="" placeholder="输入链接地址">


</span>
                </div>
                <!-- 处理切换连接类型 -->
                <script type="text/javascript">
                    $().ready(function() {
                        $('#15293379615nzH5T').find('#link_type').change(function() {
                            var link_type = $(this).val();
                            var select_width = $('#15293379615nzH5T').find('#select_width').val();
                            var page = $('#15293379615nzH5T').find('#page_code').val();
//var link = $('#15293379615nzH5T').find("[name='link']").val();
                            $.ajax({
                                type: 'get',
                                url: 'change-link-type',
                                dataType: 'json',
                                data: {
                                    link_type: link_type,
                                    select_width: select_width,
                                    page: page,
                                },
                                success: function(result) {
                                    $('#15293379615nzH5T').find('#link_change').html(result.data);
                                    $('#15293379615nzH5T').find('.chosen-select').chosen();
                                    $('#15293379615nzH5T').find('.chosen-container').addClass('w200');
                                },
                            });
                        });
                    });
                </script></td>
            <td>
                <input class="form-control small" type="text" value="" name="sort">
            </td>
            <td class="text-c handle">
                <a class="del nav-del" href="javascript:void(0);">删除</a>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="chrTable2 hide">
        <tbody>
        <tr>
            <td>
                <div class="szy-imagegroup" data-size="1"></div>
                <input type="hidden" id="path" name="path" value="">
            </td>
            <td class="text-c">
                <input placeholder="导航名称" type="text" name="name" value="" class="form-control w100">
            </td>
            <td class="text-c">
                <input type="text" name="color" value="" class="form-control w100 colorpicker">
            </td>
            <td>
                <div id="1529337961C1vdgT">
                    <input type="hidden" id="select_width" value="w200">
                    <input type="hidden" id="page_code" value="m_site">
                    <select class="form-control w100 " id="link_type" name="link_type">
                        <option value="0" selected="selected">自定义链接</option>
                        <option value="1" >常用链接</option>
                        <!-- <option value="2" >选择商品</option> -->
                        <option value="3" >店铺主页</option>
                        <option value="8" >文章分类</option>
                        <option value="4" >文章详情</option>

                        <option value="5" >分类商品</option>


                        <option value="6" >团购活动</option>

                        <option value="7" >品牌专题</option>
                        <option value="9" >专题活动</option>
                    </select>
                    <span id="link_change">


<input class="form-control w180" type="text" name="link" value="" placeholder="输入链接地址">


</span>
                </div>
                <!-- 处理切换连接类型 -->
                <script type="text/javascript">
                    $().ready(function() {
                        $('#1529337961C1vdgT').find('#link_type').change(function() {
                            var link_type = $(this).val();
                            var select_width = $('#1529337961C1vdgT').find('#select_width').val();
                            var page = $('#1529337961C1vdgT').find('#page_code').val();
//var link = $('#1529337961C1vdgT').find("[name='link']").val();
                            $.ajax({
                                type: 'get',
                                url: 'change-link-type',
                                dataType: 'json',
                                data: {
                                    link_type: link_type,
                                    select_width: select_width,
                                    page: page,
                                },
                                success: function(result) {
                                    $('#1529337961C1vdgT').find('#link_change').html(result.data);
                                    $('#1529337961C1vdgT').find('.chosen-select').chosen();
                                    $('#1529337961C1vdgT').find('.chosen-container').addClass('w200');
                                },
                            });
                        });
                    });
                </script></td>
            <td>
                <input class="form-control small" type="text" value="" name="sort">
            </td>
            <td class="text-c handle">
                <a class="del nav-del" href="javascript:void(0);">删除</a>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="chrTable3 hide">
        <tbody>
        <tr>
            <td>
                <div class="szy-imagegroup" data-size="1"></div>
                <input type="hidden" id="path" name="path" value="">
            </td>
            <td class="text-c">
                <input placeholder="导航名称" type="text" name="name" value="" class="form-control w100">
            </td>
            <td class="text-c">
                <input type="text" name="color" value="" class="form-control w100 colorpicker">
            </td>
            <td>
                <div id="1529337961uKLH6P">
                    <input type="hidden" id="select_width" value="w200">
                    <input type="hidden" id="page_code" value="m_site">
                    <select class="form-control w100 " id="link_type" name="link_type">
                        <option value="0" selected="selected">自定义链接</option>
                        <option value="1" >常用链接</option>
                        <!-- <option value="2" >选择商品</option> -->
                        <option value="3" >店铺主页</option>
                        <option value="8" >文章分类</option>
                        <option value="4" >文章详情</option>

                        <option value="5" >分类商品</option>


                        <option value="6" >团购活动</option>

                        <option value="7" >品牌专题</option>
                        <option value="9" >专题活动</option>
                    </select>
                    <span id="link_change">


<input class="form-control w180" type="text" name="link" value="" placeholder="输入链接地址">


</span>
                </div>
                <!-- 处理切换连接类型 -->
                <script type="text/javascript">
                    $().ready(function() {
                        $('#1529337961uKLH6P').find('#link_type').change(function() {
                            var link_type = $(this).val();
                            var select_width = $('#1529337961uKLH6P').find('#select_width').val();
                            var page = $('#1529337961uKLH6P').find('#page_code').val();
//var link = $('#1529337961uKLH6P').find("[name='link']").val();
                            $.ajax({
                                type: 'get',
                                url: 'change-link-type',
                                dataType: 'json',
                                data: {
                                    link_type: link_type,
                                    select_width: select_width,
                                    page: page,
                                },
                                success: function(result) {
                                    $('#1529337961uKLH6P').find('#link_change').html(result.data);
                                    $('#1529337961uKLH6P').find('.chosen-select').chosen();
                                    $('#1529337961uKLH6P').find('.chosen-container').addClass('w200');
                                },
                            });
                        });
                    });
                </script></td>
            <td>
                <input class="form-control small" type="text" value="" name="sort">
            </td>
            <td class="text-c handle">
                <a class="del nav-del" href="javascript:void(0);">删除</a>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="chrTable4 hide">
        <tbody>
        <tr>
            <td>
                <div class="szy-imagegroup" data-size="1"></div>
                <input type="hidden" id="path" name="path" value="">
            </td>
            <td class="text-c">
                <input placeholder="导航名称" type="text" name="name" value="" class="form-control w100">
            </td>
            <td class="text-c">
                <input type="text" name="color" value="" class="form-control w100 colorpicker">
            </td>
            <td>
                <div id="15293379613NqiLe">
                    <input type="hidden" id="select_width" value="w200">
                    <input type="hidden" id="page_code" value="m_site">
                    <select class="form-control w100 " id="link_type" name="link_type">
                        <option value="0" selected="selected">自定义链接</option>
                        <option value="1" >常用链接</option>
                        <!-- <option value="2" >选择商品</option> -->
                        <option value="3" >店铺主页</option>
                        <option value="8" >文章分类</option>
                        <option value="4" >文章详情</option>

                        <option value="5" >分类商品</option>


                        <option value="6" >团购活动</option>

                        <option value="7" >品牌专题</option>
                        <option value="9" >专题活动</option>
                    </select>
                    <span id="link_change">


<input class="form-control w180" type="text" name="link" value="" placeholder="输入链接地址">


</span>
                </div>
                <!-- 处理切换连接类型 -->
                <script type="text/javascript">
                    $().ready(function() {
                        $('#15293379613NqiLe').find('#link_type').change(function() {
                            var link_type = $(this).val();
                            var select_width = $('#15293379613NqiLe').find('#select_width').val();
                            var page = $('#15293379613NqiLe').find('#page_code').val();
//var link = $('#15293379613NqiLe').find("[name='link']").val();
                            $.ajax({
                                type: 'get',
                                url: 'change-link-type',
                                dataType: 'json',
                                data: {
                                    link_type: link_type,
                                    select_width: select_width,
                                    page: page,
                                },
                                success: function(result) {
                                    $('#15293379613NqiLe').find('#link_change').html(result.data);
                                    $('#15293379613NqiLe').find('.chosen-select').chosen();
                                    $('#15293379613NqiLe').find('.chosen-container').addClass('w200');
                                },
                            });
                        });
                    });
                </script></td>
            <td>
                <input class="form-control small" type="text" value="" name="sort">
            </td>
            <td class="text-c handle">
                <a class="del nav-del" href="javascript:void(0);">删除</a>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="chrTable5 hide">
        <tbody>
        <tr>
            <td>
                <div class="szy-imagegroup" data-size="1"></div>
                <input type="hidden" id="path" name="path" value="">
            </td>
            <td class="text-c">
                <input placeholder="导航名称" type="text" name="name" value="" class="form-control w100">
            </td>
            <td class="text-c">
                <input type="text" name="color" value="" class="form-control w100 colorpicker">
            </td>
            <td>
                <div id="1529337961hsmmS2">
                    <input type="hidden" id="select_width" value="w200">
                    <input type="hidden" id="page_code" value="m_site">
                    <select class="form-control w100 " id="link_type" name="link_type">
                        <option value="0" selected="selected">自定义链接</option>
                        <option value="1" >常用链接</option>
                        <!-- <option value="2" >选择商品</option> -->
                        <option value="3" >店铺主页</option>
                        <option value="8" >文章分类</option>
                        <option value="4" >文章详情</option>

                        <option value="5" >分类商品</option>


                        <option value="6" >团购活动</option>

                        <option value="7" >品牌专题</option>
                        <option value="9" >专题活动</option>
                    </select>
                    <span id="link_change">


<input class="form-control w180" type="text" name="link" value="" placeholder="输入链接地址">


</span>
                </div>
                <!-- 处理切换连接类型 -->
                <script type="text/javascript">
                    $().ready(function() {
                        $('#1529337961hsmmS2').find('#link_type').change(function() {
                            var link_type = $(this).val();
                            var select_width = $('#1529337961hsmmS2').find('#select_width').val();
                            var page = $('#1529337961hsmmS2').find('#page_code').val();
//var link = $('#1529337961hsmmS2').find("[name='link']").val();
                            $.ajax({
                                type: 'get',
                                url: 'change-link-type',
                                dataType: 'json',
                                data: {
                                    link_type: link_type,
                                    select_width: select_width,
                                    page: page,
                                },
                                success: function(result) {
                                    $('#1529337961hsmmS2').find('#link_change').html(result.data);
                                    $('#1529337961hsmmS2').find('.chosen-select').chosen();
                                    $('#1529337961hsmmS2').find('.chosen-container').addClass('w200');
                                },
                            });
                        });
                    });
                </script></td>
            <td>
                <input class="form-control small" type="text" value="" name="sort">
            </td>
            <td class="text-c handle">
                <a class="del nav-del" href="javascript:void(0);">删除</a>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="chrTable6 hide">
        <tbody>
        <tr>
            <td>
                <div class="szy-imagegroup" data-size="1"></div>
                <input type="hidden" id="path" name="path" value="">
            </td>
            <td class="text-c">
                <input placeholder="导航名称" type="text" name="name" value="" class="form-control w100">
            </td>
            <td class="text-c">
                <input type="text" name="color" value="" class="form-control w100 colorpicker">
            </td>
            <td>
                <div id="1529337961tn8u06">
                    <input type="hidden" id="select_width" value="w200">
                    <input type="hidden" id="page_code" value="m_site">
                    <select class="form-control w100 " id="link_type" name="link_type">
                        <option value="0" selected="selected">自定义链接</option>
                        <option value="1" >常用链接</option>
                        <!-- <option value="2" >选择商品</option> -->
                        <option value="3" >店铺主页</option>
                        <option value="8" >文章分类</option>
                        <option value="4" >文章详情</option>

                        <option value="5" >分类商品</option>


                        <option value="6" >团购活动</option>

                        <option value="7" >品牌专题</option>
                        <option value="9" >专题活动</option>
                    </select>
                    <span id="link_change">


<input class="form-control w180" type="text" name="link" value="" placeholder="输入链接地址">


</span>
                </div>
                <!-- 处理切换连接类型 -->
                <script type="text/javascript">
                    $().ready(function() {
                        $('#1529337961tn8u06').find('#link_type').change(function() {
                            var link_type = $(this).val();
                            var select_width = $('#1529337961tn8u06').find('#select_width').val();
                            var page = $('#1529337961tn8u06').find('#page_code').val();
//var link = $('#1529337961tn8u06').find("[name='link']").val();
                            $.ajax({
                                type: 'get',
                                url: 'change-link-type',
                                dataType: 'json',
                                data: {
                                    link_type: link_type,
                                    select_width: select_width,
                                    page: page,
                                },
                                success: function(result) {
                                    $('#1529337961tn8u06').find('#link_change').html(result.data);
                                    $('#1529337961tn8u06').find('.chosen-select').chosen();
                                    $('#1529337961tn8u06').find('.chosen-container').addClass('w200');
                                },
                            });
                        });
                    });
                </script></td>
            <td>
                <input class="form-control small" type="text" value="" name="sort">
            </td>
            <td class="text-c handle">
                <a class="del nav-del" href="javascript:void(0);">删除</a>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="chrTable7 hide">
        <tbody>
        <tr>
            <td>
                <div class="szy-imagegroup" data-size="1"></div>
                <input type="hidden" id="path" name="path" value="">
            </td>
            <td class="text-c">
                <input placeholder="导航名称" type="text" name="name" value="" class="form-control w100">
            </td>
            <td class="text-c">
                <input type="text" name="color" value="" class="form-control w100 colorpicker">
            </td>
            <td>
                <div id="1529337961mpE8A6">
                    <input type="hidden" id="select_width" value="w200">
                    <input type="hidden" id="page_code" value="m_site">
                    <select class="form-control w100 " id="link_type" name="link_type">
                        <option value="0" selected="selected">自定义链接</option>
                        <option value="1" >常用链接</option>
                        <!-- <option value="2" >选择商品</option> -->
                        <option value="3" >店铺主页</option>
                        <option value="8" >文章分类</option>
                        <option value="4" >文章详情</option>

                        <option value="5" >分类商品</option>


                        <option value="6" >团购活动</option>

                        <option value="7" >品牌专题</option>
                        <option value="9" >专题活动</option>
                    </select>
                    <span id="link_change">


<input class="form-control w180" type="text" name="link" value="" placeholder="输入链接地址">


</span>
                </div>
                <!-- 处理切换连接类型 -->
                <script type="text/javascript">
                    $().ready(function() {
                        $('#1529337961mpE8A6').find('#link_type').change(function() {
                            var link_type = $(this).val();
                            var select_width = $('#1529337961mpE8A6').find('#select_width').val();
                            var page = $('#1529337961mpE8A6').find('#page_code').val();
//var link = $('#1529337961mpE8A6').find("[name='link']").val();
                            $.ajax({
                                type: 'get',
                                url: 'change-link-type',
                                dataType: 'json',
                                data: {
                                    link_type: link_type,
                                    select_width: select_width,
                                    page: page,
                                },
                                success: function(result) {
                                    $('#1529337961mpE8A6').find('#link_change').html(result.data);
                                    $('#1529337961mpE8A6').find('.chosen-select').chosen();
                                    $('#1529337961mpE8A6').find('.chosen-container').addClass('w200');
                                },
                            });
                        });
                    });
                </script></td>
            <td>
                <input class="form-control small" type="text" value="" name="sort">
            </td>
            <td class="text-c handle">
                <a class="del nav-del" href="javascript:void(0);">删除</a>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="chrTable8 hide">
        <tbody>
        <tr>
            <td>
                <div class="szy-imagegroup" data-size="1"></div>
                <input type="hidden" id="path" name="path" value="">
            </td>
            <td class="text-c">
                <input placeholder="导航名称" type="text" name="name" value="" class="form-control w100">
            </td>
            <td class="text-c">
                <input type="text" name="color" value="" class="form-control w100 colorpicker">
            </td>
            <td>
                <div id="15293379619cOkAe">
                    <input type="hidden" id="select_width" value="w200">
                    <input type="hidden" id="page_code" value="m_site">
                    <select class="form-control w100 " id="link_type" name="link_type">
                        <option value="0" selected="selected">自定义链接</option>
                        <option value="1" >常用链接</option>
                        <!-- <option value="2" >选择商品</option> -->
                        <option value="3" >店铺主页</option>
                        <option value="8" >文章分类</option>
                        <option value="4" >文章详情</option>

                        <option value="5" >分类商品</option>


                        <option value="6" >团购活动</option>

                        <option value="7" >品牌专题</option>
                        <option value="9" >专题活动</option>
                    </select>
                    <span id="link_change">


<input class="form-control w180" type="text" name="link" value="" placeholder="输入链接地址">


</span>
                </div>
                <!-- 处理切换连接类型 -->
                <script type="text/javascript">
                    $().ready(function() {
                        $('#15293379619cOkAe').find('#link_type').change(function() {
                            var link_type = $(this).val();
                            var select_width = $('#15293379619cOkAe').find('#select_width').val();
                            var page = $('#15293379619cOkAe').find('#page_code').val();
//var link = $('#15293379619cOkAe').find("[name='link']").val();
                            $.ajax({
                                type: 'get',
                                url: 'change-link-type',
                                dataType: 'json',
                                data: {
                                    link_type: link_type,
                                    select_width: select_width,
                                    page: page,
                                },
                                success: function(result) {
                                    $('#15293379619cOkAe').find('#link_change').html(result.data);
                                    $('#15293379619cOkAe').find('.chosen-select').chosen();
                                    $('#15293379619cOkAe').find('.chosen-container').addClass('w200');
                                },
                            });
                        });
                    });
                </script></td>
            <td>
                <input class="form-control small" type="text" value="" name="sort">
            </td>
            <td class="text-c handle">
                <a class="del nav-del" href="javascript:void(0);">删除</a>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="chrTable9 hide">
        <tbody>
        <tr>
            <td>
                <div class="szy-imagegroup" data-size="1"></div>
                <input type="hidden" id="path" name="path" value="">
            </td>
            <td class="text-c">
                <input placeholder="导航名称" type="text" name="name" value="" class="form-control w100">
            </td>
            <td class="text-c">
                <input type="text" name="color" value="" class="form-control w100 colorpicker">
            </td>
            <td>
                <div id="15293379616fX2aQ">
                    <input type="hidden" id="select_width" value="w200">
                    <input type="hidden" id="page_code" value="m_site">
                    <select class="form-control w100 " id="link_type" name="link_type">
                        <option value="0" selected="selected">自定义链接</option>
                        <option value="1" >常用链接</option>
                        <!-- <option value="2" >选择商品</option> -->
                        <option value="3" >店铺主页</option>
                        <option value="8" >文章分类</option>
                        <option value="4" >文章详情</option>

                        <option value="5" >分类商品</option>


                        <option value="6" >团购活动</option>

                        <option value="7" >品牌专题</option>
                        <option value="9" >专题活动</option>
                    </select>
                    <span id="link_change">


<input class="form-control w180" type="text" name="link" value="" placeholder="输入链接地址">


</span>
                </div>
                <!-- 处理切换连接类型 -->
                <script type="text/javascript">
                    $().ready(function() {
                        $('#15293379616fX2aQ').find('#link_type').change(function() {
                            var link_type = $(this).val();
                            var select_width = $('#15293379616fX2aQ').find('#select_width').val();
                            var page = $('#15293379616fX2aQ').find('#page_code').val();
//var link = $('#15293379616fX2aQ').find("[name='link']").val();
                            $.ajax({
                                type: 'get',
                                url: 'change-link-type',
                                dataType: 'json',
                                data: {
                                    link_type: link_type,
                                    select_width: select_width,
                                    page: page,
                                },
                                success: function(result) {
                                    $('#15293379616fX2aQ').find('#link_change').html(result.data);
                                    $('#15293379616fX2aQ').find('.chosen-select').chosen();
                                    $('#15293379616fX2aQ').find('.chosen-container').addClass('w200');
                                },
                            });
                        });
                    });
                </script></td>
            <td>
                <input class="form-control small" type="text" value="" name="sort">
            </td>
            <td class="text-c handle">
                <a class="del nav-del" href="javascript:void(0);">删除</a>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="chrTable10 hide">
        <tbody>
        <tr>
            <td>
                <div class="szy-imagegroup" data-size="1"></div>
                <input type="hidden" id="path" name="path" value="">
            </td>
            <td class="text-c">
                <input placeholder="导航名称" type="text" name="name" value="" class="form-control w100">
            </td>
            <td class="text-c">
                <input type="text" name="color" value="" class="form-control w100 colorpicker">
            </td>
            <td>
                <div id="1529337961m8qz75">
                    <input type="hidden" id="select_width" value="w200">
                    <input type="hidden" id="page_code" value="m_site">
                    <select class="form-control w100 " id="link_type" name="link_type">
                        <option value="0" selected="selected">自定义链接</option>
                        <option value="1" >常用链接</option>
                        <!-- <option value="2" >选择商品</option> -->
                        <option value="3" >店铺主页</option>
                        <option value="8" >文章分类</option>
                        <option value="4" >文章详情</option>

                        <option value="5" >分类商品</option>


                        <option value="6" >团购活动</option>

                        <option value="7" >品牌专题</option>
                        <option value="9" >专题活动</option>
                    </select>
                    <span id="link_change">


<input class="form-control w180" type="text" name="link" value="" placeholder="输入链接地址">


</span>
                </div>
                <!-- 处理切换连接类型 -->
                <script type="text/javascript">
                    $().ready(function() {
                        $('#1529337961m8qz75').find('#link_type').change(function() {
                            var link_type = $(this).val();
                            var select_width = $('#1529337961m8qz75').find('#select_width').val();
                            var page = $('#1529337961m8qz75').find('#page_code').val();
//var link = $('#1529337961m8qz75').find("[name='link']").val();
                            $.ajax({
                                type: 'get',
                                url: 'change-link-type',
                                dataType: 'json',
                                data: {
                                    link_type: link_type,
                                    select_width: select_width,
                                    page: page,
                                },
                                success: function(result) {
                                    $('#1529337961m8qz75').find('#link_change').html(result.data);
                                    $('#1529337961m8qz75').find('.chosen-select').chosen();
                                    $('#1529337961m8qz75').find('.chosen-container').addClass('w200');
                                },
                            });
                        });
                    });
                </script></td>
            <td>
                <input class="form-control small" type="text" value="" name="sort">
            </td>
            <td class="text-c handle">
                <a class="del nav-del" href="javascript:void(0);">删除</a>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="chrTable11 hide">
        <tbody>
        <tr>
            <td>
                <div class="szy-imagegroup" data-size="1"></div>
                <input type="hidden" id="path" name="path" value="">
            </td>
            <td class="text-c">
                <input placeholder="导航名称" type="text" name="name" value="" class="form-control w100">
            </td>
            <td class="text-c">
                <input type="text" name="color" value="" class="form-control w100 colorpicker">
            </td>
            <td>
                <div id="1529337961i6Odjl">
                    <input type="hidden" id="select_width" value="w200">
                    <input type="hidden" id="page_code" value="m_site">
                    <select class="form-control w100 " id="link_type" name="link_type">
                        <option value="0" selected="selected">自定义链接</option>
                        <option value="1" >常用链接</option>
                        <!-- <option value="2" >选择商品</option> -->
                        <option value="3" >店铺主页</option>
                        <option value="8" >文章分类</option>
                        <option value="4" >文章详情</option>

                        <option value="5" >分类商品</option>


                        <option value="6" >团购活动</option>

                        <option value="7" >品牌专题</option>
                        <option value="9" >专题活动</option>
                    </select>
                    <span id="link_change">


<input class="form-control w180" type="text" name="link" value="" placeholder="输入链接地址">


</span>
                </div>
                <!-- 处理切换连接类型 -->
                <script type="text/javascript">
                    $().ready(function() {
                        $('#1529337961i6Odjl').find('#link_type').change(function() {
                            var link_type = $(this).val();
                            var select_width = $('#1529337961i6Odjl').find('#select_width').val();
                            var page = $('#1529337961i6Odjl').find('#page_code').val();
//var link = $('#1529337961i6Odjl').find("[name='link']").val();
                            $.ajax({
                                type: 'get',
                                url: 'change-link-type',
                                dataType: 'json',
                                data: {
                                    link_type: link_type,
                                    select_width: select_width,
                                    page: page,
                                },
                                success: function(result) {
                                    $('#1529337961i6Odjl').find('#link_change').html(result.data);
                                    $('#1529337961i6Odjl').find('.chosen-select').chosen();
                                    $('#1529337961i6Odjl').find('.chosen-container').addClass('w200');
                                },
                            });
                        });
                    });
                </script></td>
            <td>
                <input class="form-control small" type="text" value="" name="sort">
            </td>
            <td class="text-c handle">
                <a class="del nav-del" href="javascript:void(0);">删除</a>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="chrTable12 hide">
        <tbody>
        <tr>
            <td>
                <div class="szy-imagegroup" data-size="1"></div>
                <input type="hidden" id="path" name="path" value="">
            </td>
            <td class="text-c">
                <input placeholder="导航名称" type="text" name="name" value="" class="form-control w100">
            </td>
            <td class="text-c">
                <input type="text" name="color" value="" class="form-control w100 colorpicker">
            </td>
            <td>
                <div id="1529337961EGES8U">
                    <input type="hidden" id="select_width" value="w200">
                    <input type="hidden" id="page_code" value="m_site">
                    <select class="form-control w100 " id="link_type" name="link_type">
                        <option value="0" selected="selected">自定义链接</option>
                        <option value="1" >常用链接</option>
                        <!-- <option value="2" >选择商品</option> -->
                        <option value="3" >店铺主页</option>
                        <option value="8" >文章分类</option>
                        <option value="4" >文章详情</option>

                        <option value="5" >分类商品</option>


                        <option value="6" >团购活动</option>

                        <option value="7" >品牌专题</option>
                        <option value="9" >专题活动</option>
                    </select>
                    <span id="link_change">


<input class="form-control w180" type="text" name="link" value="" placeholder="输入链接地址">


</span>
                </div>
                <!-- 处理切换连接类型 -->
                <script type="text/javascript">
                    $().ready(function() {
                        $('#1529337961EGES8U').find('#link_type').change(function() {
                            var link_type = $(this).val();
                            var select_width = $('#1529337961EGES8U').find('#select_width').val();
                            var page = $('#1529337961EGES8U').find('#page_code').val();
//var link = $('#1529337961EGES8U').find("[name='link']").val();
                            $.ajax({
                                type: 'get',
                                url: 'change-link-type',
                                dataType: 'json',
                                data: {
                                    link_type: link_type,
                                    select_width: select_width,
                                    page: page,
                                },
                                success: function(result) {
                                    $('#1529337961EGES8U').find('#link_change').html(result.data);
                                    $('#1529337961EGES8U').find('.chosen-select').chosen();
                                    $('#1529337961EGES8U').find('.chosen-container').addClass('w200');
                                },
                            });
                        });
                    });
                </script></td>
            <td>
                <input class="form-control small" type="text" value="" name="sort">
            </td>
            <td class="text-c handle">
                <a class="del nav-del" href="javascript:void(0);">删除</a>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="chrTable13 hide">
        <tbody>
        <tr>
            <td>
                <div class="szy-imagegroup" data-size="1"></div>
                <input type="hidden" id="path" name="path" value="">
            </td>
            <td class="text-c">
                <input placeholder="导航名称" type="text" name="name" value="" class="form-control w100">
            </td>
            <td class="text-c">
                <input type="text" name="color" value="" class="form-control w100 colorpicker">
            </td>
            <td>
                <div id="1529337961HT4qzA">
                    <input type="hidden" id="select_width" value="w200">
                    <input type="hidden" id="page_code" value="m_site">
                    <select class="form-control w100 " id="link_type" name="link_type">
                        <option value="0" selected="selected">自定义链接</option>
                        <option value="1" >常用链接</option>
                        <!-- <option value="2" >选择商品</option> -->
                        <option value="3" >店铺主页</option>
                        <option value="8" >文章分类</option>
                        <option value="4" >文章详情</option>

                        <option value="5" >分类商品</option>


                        <option value="6" >团购活动</option>

                        <option value="7" >品牌专题</option>
                        <option value="9" >专题活动</option>
                    </select>
                    <span id="link_change">


<input class="form-control w180" type="text" name="link" value="" placeholder="输入链接地址">


</span>
                </div>
                <!-- 处理切换连接类型 -->
                <script type="text/javascript">
                    $().ready(function() {
                        $('#1529337961HT4qzA').find('#link_type').change(function() {
                            var link_type = $(this).val();
                            var select_width = $('#1529337961HT4qzA').find('#select_width').val();
                            var page = $('#1529337961HT4qzA').find('#page_code').val();
//var link = $('#1529337961HT4qzA').find("[name='link']").val();
                            $.ajax({
                                type: 'get',
                                url: 'change-link-type',
                                dataType: 'json',
                                data: {
                                    link_type: link_type,
                                    select_width: select_width,
                                    page: page,
                                },
                                success: function(result) {
                                    $('#1529337961HT4qzA').find('#link_change').html(result.data);
                                    $('#1529337961HT4qzA').find('.chosen-select').chosen();
                                    $('#1529337961HT4qzA').find('.chosen-container').addClass('w200');
                                },
                            });
                        });
                    });
                </script></td>
            <td>
                <input class="form-control small" type="text" value="" name="sort">
            </td>
            <td class="text-c handle">
                <a class="del nav-del" href="javascript:void(0);">删除</a>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="chrTable14 hide">
        <tbody>
        <tr>
            <td>
                <div class="szy-imagegroup" data-size="1"></div>
                <input type="hidden" id="path" name="path" value="">
            </td>
            <td class="text-c">
                <input placeholder="导航名称" type="text" name="name" value="" class="form-control w100">
            </td>
            <td class="text-c">
                <input type="text" name="color" value="" class="form-control w100 colorpicker">
            </td>
            <td>
                <div id="15293379610W70z4">
                    <input type="hidden" id="select_width" value="w200">
                    <input type="hidden" id="page_code" value="m_site">
                    <select class="form-control w100 " id="link_type" name="link_type">
                        <option value="0" selected="selected">自定义链接</option>
                        <option value="1" >常用链接</option>
                        <!-- <option value="2" >选择商品</option> -->
                        <option value="3" >店铺主页</option>
                        <option value="8" >文章分类</option>
                        <option value="4" >文章详情</option>

                        <option value="5" >分类商品</option>


                        <option value="6" >团购活动</option>

                        <option value="7" >品牌专题</option>
                        <option value="9" >专题活动</option>
                    </select>
                    <span id="link_change">


<input class="form-control w180" type="text" name="link" value="" placeholder="输入链接地址">


</span>
                </div>
                <!-- 处理切换连接类型 -->
                <script type="text/javascript">
                    $().ready(function() {
                        $('#15293379610W70z4').find('#link_type').change(function() {
                            var link_type = $(this).val();
                            var select_width = $('#15293379610W70z4').find('#select_width').val();
                            var page = $('#15293379610W70z4').find('#page_code').val();
//var link = $('#15293379610W70z4').find("[name='link']").val();
                            $.ajax({
                                type: 'get',
                                url: 'change-link-type',
                                dataType: 'json',
                                data: {
                                    link_type: link_type,
                                    select_width: select_width,
                                    page: page,
                                },
                                success: function(result) {
                                    $('#15293379610W70z4').find('#link_change').html(result.data);
                                    $('#15293379610W70z4').find('.chosen-select').chosen();
                                    $('#15293379610W70z4').find('.chosen-container').addClass('w200');
                                },
                            });
                        });
                    });
                </script></td>
            <td>
                <input class="form-control small" type="text" value="" name="sort">
            </td>
            <td class="text-c handle">
                <a class="del nav-del" href="javascript:void(0);">删除</a>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="chrTable15 hide">
        <tbody>
        <tr>
            <td>
                <div class="szy-imagegroup" data-size="1"></div>
                <input type="hidden" id="path" name="path" value="">
            </td>
            <td class="text-c">
                <input placeholder="导航名称" type="text" name="name" value="" class="form-control w100">
            </td>
            <td class="text-c">
                <input type="text" name="color" value="" class="form-control w100 colorpicker">
            </td>
            <td>
                <div id="15293379612cyBQB">
                    <input type="hidden" id="select_width" value="w200">
                    <input type="hidden" id="page_code" value="m_site">
                    <select class="form-control w100 " id="link_type" name="link_type">
                        <option value="0" selected="selected">自定义链接</option>
                        <option value="1" >常用链接</option>
                        <!-- <option value="2" >选择商品</option> -->
                        <option value="3" >店铺主页</option>
                        <option value="8" >文章分类</option>
                        <option value="4" >文章详情</option>

                        <option value="5" >分类商品</option>


                        <option value="6" >团购活动</option>

                        <option value="7" >品牌专题</option>
                        <option value="9" >专题活动</option>
                    </select>
                    <span id="link_change">


<input class="form-control w180" type="text" name="link" value="" placeholder="输入链接地址">


</span>
                </div>
                <!-- 处理切换连接类型 -->
                <script type="text/javascript">
                    $().ready(function() {
                        $('#15293379612cyBQB').find('#link_type').change(function() {
                            var link_type = $(this).val();
                            var select_width = $('#15293379612cyBQB').find('#select_width').val();
                            var page = $('#15293379612cyBQB').find('#page_code').val();
//var link = $('#15293379612cyBQB').find("[name='link']").val();
                            $.ajax({
                                type: 'get',
                                url: 'change-link-type',
                                dataType: 'json',
                                data: {
                                    link_type: link_type,
                                    select_width: select_width,
                                    page: page,
                                },
                                success: function(result) {
                                    $('#15293379612cyBQB').find('#link_change').html(result.data);
                                    $('#15293379612cyBQB').find('.chosen-select').chosen();
                                    $('#15293379612cyBQB').find('.chosen-container').addClass('w200');
                                },
                            });
                        });
                    });
                </script></td>
            <td>
                <input class="form-control small" type="text" value="" name="sort">
            </td>
            <td class="text-c handle">
                <a class="del nav-del" href="javascript:void(0);">删除</a>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="chrTable16 hide">
        <tbody>
        <tr>
            <td>
                <div class="szy-imagegroup" data-size="1"></div>
                <input type="hidden" id="path" name="path" value="">
            </td>
            <td class="text-c">
                <input placeholder="导航名称" type="text" name="name" value="" class="form-control w100">
            </td>
            <td class="text-c">
                <input type="text" name="color" value="" class="form-control w100 colorpicker">
            </td>
            <td>
                <div id="1529337961qcJec7">
                    <input type="hidden" id="select_width" value="w200">
                    <input type="hidden" id="page_code" value="m_site">
                    <select class="form-control w100 " id="link_type" name="link_type">
                        <option value="0" selected="selected">自定义链接</option>
                        <option value="1" >常用链接</option>
                        <!-- <option value="2" >选择商品</option> -->
                        <option value="3" >店铺主页</option>
                        <option value="8" >文章分类</option>
                        <option value="4" >文章详情</option>

                        <option value="5" >分类商品</option>


                        <option value="6" >团购活动</option>

                        <option value="7" >品牌专题</option>
                        <option value="9" >专题活动</option>
                    </select>
                    <span id="link_change">


<input class="form-control w180" type="text" name="link" value="" placeholder="输入链接地址">


</span>
                </div>
                <!-- 处理切换连接类型 -->
                <script type="text/javascript">
                    $().ready(function() {
                        $('#1529337961qcJec7').find('#link_type').change(function() {
                            var link_type = $(this).val();
                            var select_width = $('#1529337961qcJec7').find('#select_width').val();
                            var page = $('#1529337961qcJec7').find('#page_code').val();
//var link = $('#1529337961qcJec7').find("[name='link']").val();
                            $.ajax({
                                type: 'get',
                                url: 'change-link-type',
                                dataType: 'json',
                                data: {
                                    link_type: link_type,
                                    select_width: select_width,
                                    page: page,
                                },
                                success: function(result) {
                                    $('#1529337961qcJec7').find('#link_change').html(result.data);
                                    $('#1529337961qcJec7').find('.chosen-select').chosen();
                                    $('#1529337961qcJec7').find('.chosen-container').addClass('w200');
                                },
                            });
                        });
                    });
                </script></td>
            <td>
                <input class="form-control small" type="text" value="" name="sort">
            </td>
            <td class="text-c handle">
                <a class="del nav-del" href="javascript:void(0);">删除</a>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="chrTable17 hide">
        <tbody>
        <tr>
            <td>
                <div class="szy-imagegroup" data-size="1"></div>
                <input type="hidden" id="path" name="path" value="">
            </td>
            <td class="text-c">
                <input placeholder="导航名称" type="text" name="name" value="" class="form-control w100">
            </td>
            <td class="text-c">
                <input type="text" name="color" value="" class="form-control w100 colorpicker">
            </td>
            <td>
                <div id="15293379616dswsi">
                    <input type="hidden" id="select_width" value="w200">
                    <input type="hidden" id="page_code" value="m_site">
                    <select class="form-control w100 " id="link_type" name="link_type">
                        <option value="0" selected="selected">自定义链接</option>
                        <option value="1" >常用链接</option>
                        <!-- <option value="2" >选择商品</option> -->
                        <option value="3" >店铺主页</option>
                        <option value="8" >文章分类</option>
                        <option value="4" >文章详情</option>

                        <option value="5" >分类商品</option>


                        <option value="6" >团购活动</option>

                        <option value="7" >品牌专题</option>
                        <option value="9" >专题活动</option>
                    </select>
                    <span id="link_change">


<input class="form-control w180" type="text" name="link" value="" placeholder="输入链接地址">


</span>
                </div>
                <!-- 处理切换连接类型 -->
                <script type="text/javascript">
                    $().ready(function() {
                        $('#15293379616dswsi').find('#link_type').change(function() {
                            var link_type = $(this).val();
                            var select_width = $('#15293379616dswsi').find('#select_width').val();
                            var page = $('#15293379616dswsi').find('#page_code').val();
//var link = $('#15293379616dswsi').find("[name='link']").val();
                            $.ajax({
                                type: 'get',
                                url: 'change-link-type',
                                dataType: 'json',
                                data: {
                                    link_type: link_type,
                                    select_width: select_width,
                                    page: page,
                                },
                                success: function(result) {
                                    $('#15293379616dswsi').find('#link_change').html(result.data);
                                    $('#15293379616dswsi').find('.chosen-select').chosen();
                                    $('#15293379616dswsi').find('.chosen-container').addClass('w200');
                                },
                            });
                        });
                    });
                </script></td>
            <td>
                <input class="form-control small" type="text" value="" name="sort">
            </td>
            <td class="text-c handle">
                <a class="del nav-del" href="javascript:void(0);">删除</a>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="chrTable18 hide">
        <tbody>
        <tr>
            <td>
                <div class="szy-imagegroup" data-size="1"></div>
                <input type="hidden" id="path" name="path" value="">
            </td>
            <td class="text-c">
                <input placeholder="导航名称" type="text" name="name" value="" class="form-control w100">
            </td>
            <td class="text-c">
                <input type="text" name="color" value="" class="form-control w100 colorpicker">
            </td>
            <td>
                <div id="1529337961RC3SJq">
                    <input type="hidden" id="select_width" value="w200">
                    <input type="hidden" id="page_code" value="m_site">
                    <select class="form-control w100 " id="link_type" name="link_type">
                        <option value="0" selected="selected">自定义链接</option>
                        <option value="1" >常用链接</option>
                        <!-- <option value="2" >选择商品</option> -->
                        <option value="3" >店铺主页</option>
                        <option value="8" >文章分类</option>
                        <option value="4" >文章详情</option>

                        <option value="5" >分类商品</option>


                        <option value="6" >团购活动</option>

                        <option value="7" >品牌专题</option>
                        <option value="9" >专题活动</option>
                    </select>
                    <span id="link_change">


<input class="form-control w180" type="text" name="link" value="" placeholder="输入链接地址">


</span>
                </div>
                <!-- 处理切换连接类型 -->
                <script type="text/javascript">
                    $().ready(function() {
                        $('#1529337961RC3SJq').find('#link_type').change(function() {
                            var link_type = $(this).val();
                            var select_width = $('#1529337961RC3SJq').find('#select_width').val();
                            var page = $('#1529337961RC3SJq').find('#page_code').val();
//var link = $('#1529337961RC3SJq').find("[name='link']").val();
                            $.ajax({
                                type: 'get',
                                url: 'change-link-type',
                                dataType: 'json',
                                data: {
                                    link_type: link_type,
                                    select_width: select_width,
                                    page: page,
                                },
                                success: function(result) {
                                    $('#1529337961RC3SJq').find('#link_change').html(result.data);
                                    $('#1529337961RC3SJq').find('.chosen-select').chosen();
                                    $('#1529337961RC3SJq').find('.chosen-container').addClass('w200');
                                },
                            });
                        });
                    });
                </script></td>
            <td>
                <input class="form-control small" type="text" value="" name="sort">
            </td>
            <td class="text-c handle">
                <a class="del nav-del" href="javascript:void(0);">删除</a>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="chrTable19 hide">
        <tbody>
        <tr>
            <td>
                <div class="szy-imagegroup" data-size="1"></div>
                <input type="hidden" id="path" name="path" value="">
            </td>
            <td class="text-c">
                <input placeholder="导航名称" type="text" name="name" value="" class="form-control w100">
            </td>
            <td class="text-c">
                <input type="text" name="color" value="" class="form-control w100 colorpicker">
            </td>
            <td>
                <div id="1529337961QW59Os">
                    <input type="hidden" id="select_width" value="w200">
                    <input type="hidden" id="page_code" value="m_site">
                    <select class="form-control w100 " id="link_type" name="link_type">
                        <option value="0" selected="selected">自定义链接</option>
                        <option value="1" >常用链接</option>
                        <!-- <option value="2" >选择商品</option> -->
                        <option value="3" >店铺主页</option>
                        <option value="8" >文章分类</option>
                        <option value="4" >文章详情</option>

                        <option value="5" >分类商品</option>


                        <option value="6" >团购活动</option>

                        <option value="7" >品牌专题</option>
                        <option value="9" >专题活动</option>
                    </select>
                    <span id="link_change">


<input class="form-control w180" type="text" name="link" value="" placeholder="输入链接地址">


</span>
                </div>
                <!-- 处理切换连接类型 -->
                <script type="text/javascript">
                    $().ready(function() {
                        $('#1529337961QW59Os').find('#link_type').change(function() {
                            var link_type = $(this).val();
                            var select_width = $('#1529337961QW59Os').find('#select_width').val();
                            var page = $('#1529337961QW59Os').find('#page_code').val();
//var link = $('#1529337961QW59Os').find("[name='link']").val();
                            $.ajax({
                                type: 'get',
                                url: 'change-link-type',
                                dataType: 'json',
                                data: {
                                    link_type: link_type,
                                    select_width: select_width,
                                    page: page,
                                },
                                success: function(result) {
                                    $('#1529337961QW59Os').find('#link_change').html(result.data);
                                    $('#1529337961QW59Os').find('.chosen-select').chosen();
                                    $('#1529337961QW59Os').find('.chosen-container').addClass('w200');
                                },
                            });
                        });
                    });
                </script></td>
            <td>
                <input class="form-control small" type="text" value="" name="sort">
            </td>
            <td class="text-c handle">
                <a class="del nav-del" href="javascript:void(0);">删除</a>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="chrTable20 hide">
        <tbody>
        <tr>
            <td>
                <div class="szy-imagegroup" data-size="1"></div>
                <input type="hidden" id="path" name="path" value="">
            </td>
            <td class="text-c">
                <input placeholder="导航名称" type="text" name="name" value="" class="form-control w100">
            </td>
            <td class="text-c">
                <input type="text" name="color" value="" class="form-control w100 colorpicker">
            </td>
            <td>
                <div id="1529337961OwQlz9">
                    <input type="hidden" id="select_width" value="w200">
                    <input type="hidden" id="page_code" value="m_site">
                    <select class="form-control w100 " id="link_type" name="link_type">
                        <option value="0" selected="selected">自定义链接</option>
                        <option value="1" >常用链接</option>
                        <!-- <option value="2" >选择商品</option> -->
                        <option value="3" >店铺主页</option>
                        <option value="8" >文章分类</option>
                        <option value="4" >文章详情</option>

                        <option value="5" >分类商品</option>


                        <option value="6" >团购活动</option>

                        <option value="7" >品牌专题</option>
                        <option value="9" >专题活动</option>
                    </select>
                    <span id="link_change">


<input class="form-control w180" type="text" name="link" value="" placeholder="输入链接地址">


</span>
                </div>
                <!-- 处理切换连接类型 -->
                <script type="text/javascript">
                    $().ready(function() {
                        $('#1529337961OwQlz9').find('#link_type').change(function() {
                            var link_type = $(this).val();
                            var select_width = $('#1529337961OwQlz9').find('#select_width').val();
                            var page = $('#1529337961OwQlz9').find('#page_code').val();
//var link = $('#1529337961OwQlz9').find("[name='link']").val();
                            $.ajax({
                                type: 'get',
                                url: 'change-link-type',
                                dataType: 'json',
                                data: {
                                    link_type: link_type,
                                    select_width: select_width,
                                    page: page,
                                },
                                success: function(result) {
                                    $('#1529337961OwQlz9').find('#link_change').html(result.data);
                                    $('#1529337961OwQlz9').find('.chosen-select').chosen();
                                    $('#1529337961OwQlz9').find('.chosen-container').addClass('w200');
                                },
                            });
                        });
                    });
                </script></td>
            <td>
                <input class="form-control small" type="text" value="" name="sort">
            </td>
            <td class="text-c handle">
                <a class="del nav-del" href="javascript:void(0);">删除</a>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="chrTable21 hide">
        <tbody>
        <tr>
            <td>
                <div class="szy-imagegroup" data-size="1"></div>
                <input type="hidden" id="path" name="path" value="">
            </td>
            <td class="text-c">
                <input placeholder="导航名称" type="text" name="name" value="" class="form-control w100">
            </td>
            <td class="text-c">
                <input type="text" name="color" value="" class="form-control w100 colorpicker">
            </td>
            <td>
                <div id="1529337961mCI7uY">
                    <input type="hidden" id="select_width" value="w200">
                    <input type="hidden" id="page_code" value="m_site">
                    <select class="form-control w100 " id="link_type" name="link_type">
                        <option value="0" selected="selected">自定义链接</option>
                        <option value="1" >常用链接</option>
                        <!-- <option value="2" >选择商品</option> -->
                        <option value="3" >店铺主页</option>
                        <option value="8" >文章分类</option>
                        <option value="4" >文章详情</option>

                        <option value="5" >分类商品</option>


                        <option value="6" >团购活动</option>

                        <option value="7" >品牌专题</option>
                        <option value="9" >专题活动</option>
                    </select>
                    <span id="link_change">


<input class="form-control w180" type="text" name="link" value="" placeholder="输入链接地址">


</span>
                </div>
                <!-- 处理切换连接类型 -->
                <script type="text/javascript">
                    $().ready(function() {
                        $('#1529337961mCI7uY').find('#link_type').change(function() {
                            var link_type = $(this).val();
                            var select_width = $('#1529337961mCI7uY').find('#select_width').val();
                            var page = $('#1529337961mCI7uY').find('#page_code').val();
//var link = $('#1529337961mCI7uY').find("[name='link']").val();
                            $.ajax({
                                type: 'get',
                                url: 'change-link-type',
                                dataType: 'json',
                                data: {
                                    link_type: link_type,
                                    select_width: select_width,
                                    page: page,
                                },
                                success: function(result) {
                                    $('#1529337961mCI7uY').find('#link_change').html(result.data);
                                    $('#1529337961mCI7uY').find('.chosen-select').chosen();
                                    $('#1529337961mCI7uY').find('.chosen-container').addClass('w200');
                                },
                            });
                        });
                    });
                </script></td>
            <td>
                <input class="form-control small" type="text" value="" name="sort">
            </td>
            <td class="text-c handle">
                <a class="del nav-del" href="javascript:void(0);">删除</a>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="chrTable22 hide">
        <tbody>
        <tr>
            <td>
                <div class="szy-imagegroup" data-size="1"></div>
                <input type="hidden" id="path" name="path" value="">
            </td>
            <td class="text-c">
                <input placeholder="导航名称" type="text" name="name" value="" class="form-control w100">
            </td>
            <td class="text-c">
                <input type="text" name="color" value="" class="form-control w100 colorpicker">
            </td>
            <td>
                <div id="1529337961CX7xzD">
                    <input type="hidden" id="select_width" value="w200">
                    <input type="hidden" id="page_code" value="m_site">
                    <select class="form-control w100 " id="link_type" name="link_type">
                        <option value="0" selected="selected">自定义链接</option>
                        <option value="1" >常用链接</option>
                        <!-- <option value="2" >选择商品</option> -->
                        <option value="3" >店铺主页</option>
                        <option value="8" >文章分类</option>
                        <option value="4" >文章详情</option>

                        <option value="5" >分类商品</option>


                        <option value="6" >团购活动</option>

                        <option value="7" >品牌专题</option>
                        <option value="9" >专题活动</option>
                    </select>
                    <span id="link_change">


<input class="form-control w180" type="text" name="link" value="" placeholder="输入链接地址">


</span>
                </div>
                <!-- 处理切换连接类型 -->
                <script type="text/javascript">
                    $().ready(function() {
                        $('#1529337961CX7xzD').find('#link_type').change(function() {
                            var link_type = $(this).val();
                            var select_width = $('#1529337961CX7xzD').find('#select_width').val();
                            var page = $('#1529337961CX7xzD').find('#page_code').val();
//var link = $('#1529337961CX7xzD').find("[name='link']").val();
                            $.ajax({
                                type: 'get',
                                url: 'change-link-type',
                                dataType: 'json',
                                data: {
                                    link_type: link_type,
                                    select_width: select_width,
                                    page: page,
                                },
                                success: function(result) {
                                    $('#1529337961CX7xzD').find('#link_change').html(result.data);
                                    $('#1529337961CX7xzD').find('.chosen-select').chosen();
                                    $('#1529337961CX7xzD').find('.chosen-container').addClass('w200');
                                },
                            });
                        });
                    });
                </script></td>
            <td>
                <input class="form-control small" type="text" value="" name="sort">
            </td>
            <td class="text-c handle">
                <a class="del nav-del" href="javascript:void(0);">删除</a>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="chrTable23 hide">
        <tbody>
        <tr>
            <td>
                <div class="szy-imagegroup" data-size="1"></div>
                <input type="hidden" id="path" name="path" value="">
            </td>
            <td class="text-c">
                <input placeholder="导航名称" type="text" name="name" value="" class="form-control w100">
            </td>
            <td class="text-c">
                <input type="text" name="color" value="" class="form-control w100 colorpicker">
            </td>
            <td>
                <div id="1529337961B86U0V">
                    <input type="hidden" id="select_width" value="w200">
                    <input type="hidden" id="page_code" value="m_site">
                    <select class="form-control w100 " id="link_type" name="link_type">
                        <option value="0" selected="selected">自定义链接</option>
                        <option value="1" >常用链接</option>
                        <!-- <option value="2" >选择商品</option> -->
                        <option value="3" >店铺主页</option>
                        <option value="8" >文章分类</option>
                        <option value="4" >文章详情</option>

                        <option value="5" >分类商品</option>


                        <option value="6" >团购活动</option>

                        <option value="7" >品牌专题</option>
                        <option value="9" >专题活动</option>
                    </select>
                    <span id="link_change">


<input class="form-control w180" type="text" name="link" value="" placeholder="输入链接地址">


</span>
                </div>
                <!-- 处理切换连接类型 -->
                <script type="text/javascript">
                    $().ready(function() {
                        $('#1529337961B86U0V').find('#link_type').change(function() {
                            var link_type = $(this).val();
                            var select_width = $('#1529337961B86U0V').find('#select_width').val();
                            var page = $('#1529337961B86U0V').find('#page_code').val();
//var link = $('#1529337961B86U0V').find("[name='link']").val();
                            $.ajax({
                                type: 'get',
                                url: 'change-link-type',
                                dataType: 'json',
                                data: {
                                    link_type: link_type,
                                    select_width: select_width,
                                    page: page,
                                },
                                success: function(result) {
                                    $('#1529337961B86U0V').find('#link_change').html(result.data);
                                    $('#1529337961B86U0V').find('.chosen-select').chosen();
                                    $('#1529337961B86U0V').find('.chosen-container').addClass('w200');
                                },
                            });
                        });
                    });
                </script></td>
            <td>
                <input class="form-control small" type="text" value="" name="sort">
            </td>
            <td class="text-c handle">
                <a class="del nav-del" href="javascript:void(0);">删除</a>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="chrTable24 hide">
        <tbody>
        <tr>
            <td>
                <div class="szy-imagegroup" data-size="1"></div>
                <input type="hidden" id="path" name="path" value="">
            </td>
            <td class="text-c">
                <input placeholder="导航名称" type="text" name="name" value="" class="form-control w100">
            </td>
            <td class="text-c">
                <input type="text" name="color" value="" class="form-control w100 colorpicker">
            </td>
            <td>
                <div id="1529337961l5Wtli">
                    <input type="hidden" id="select_width" value="w200">
                    <input type="hidden" id="page_code" value="m_site">
                    <select class="form-control w100 " id="link_type" name="link_type">
                        <option value="0" selected="selected">自定义链接</option>
                        <option value="1" >常用链接</option>
                        <!-- <option value="2" >选择商品</option> -->
                        <option value="3" >店铺主页</option>
                        <option value="8" >文章分类</option>
                        <option value="4" >文章详情</option>

                        <option value="5" >分类商品</option>


                        <option value="6" >团购活动</option>

                        <option value="7" >品牌专题</option>
                        <option value="9" >专题活动</option>
                    </select>
                    <span id="link_change">


<input class="form-control w180" type="text" name="link" value="" placeholder="输入链接地址">


</span>
                </div>
                <!-- 处理切换连接类型 -->
                <script type="text/javascript">
                    $().ready(function() {
                        $('#1529337961l5Wtli').find('#link_type').change(function() {
                            var link_type = $(this).val();
                            var select_width = $('#1529337961l5Wtli').find('#select_width').val();
                            var page = $('#1529337961l5Wtli').find('#page_code').val();
//var link = $('#1529337961l5Wtli').find("[name='link']").val();
                            $.ajax({
                                type: 'get',
                                url: 'change-link-type',
                                dataType: 'json',
                                data: {
                                    link_type: link_type,
                                    select_width: select_width,
                                    page: page,
                                },
                                success: function(result) {
                                    $('#1529337961l5Wtli').find('#link_change').html(result.data);
                                    $('#1529337961l5Wtli').find('.chosen-select').chosen();
                                    $('#1529337961l5Wtli').find('.chosen-container').addClass('w200');
                                },
                            });
                        });
                    });
                </script></td>
            <td>
                <input class="form-control small" type="text" value="" name="sort">
            </td>
            <td class="text-c handle">
                <a class="del nav-del" href="javascript:void(0);">删除</a>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="chrTable25 hide">
        <tbody>
        <tr>
            <td>
                <div class="szy-imagegroup" data-size="1"></div>
                <input type="hidden" id="path" name="path" value="">
            </td>
            <td class="text-c">
                <input placeholder="导航名称" type="text" name="name" value="" class="form-control w100">
            </td>
            <td class="text-c">
                <input type="text" name="color" value="" class="form-control w100 colorpicker">
            </td>
            <td>
                <div id="15293379611yygN6">
                    <input type="hidden" id="select_width" value="w200">
                    <input type="hidden" id="page_code" value="m_site">
                    <select class="form-control w100 " id="link_type" name="link_type">
                        <option value="0" selected="selected">自定义链接</option>
                        <option value="1" >常用链接</option>
                        <!-- <option value="2" >选择商品</option> -->
                        <option value="3" >店铺主页</option>
                        <option value="8" >文章分类</option>
                        <option value="4" >文章详情</option>

                        <option value="5" >分类商品</option>


                        <option value="6" >团购活动</option>

                        <option value="7" >品牌专题</option>
                        <option value="9" >专题活动</option>
                    </select>
                    <span id="link_change">


<input class="form-control w180" type="text" name="link" value="" placeholder="输入链接地址">


</span>
                </div>
                <!-- 处理切换连接类型 -->
                <script type="text/javascript">
                    $().ready(function() {
                        $('#15293379611yygN6').find('#link_type').change(function() {
                            var link_type = $(this).val();
                            var select_width = $('#15293379611yygN6').find('#select_width').val();
                            var page = $('#15293379611yygN6').find('#page_code').val();
//var link = $('#15293379611yygN6').find("[name='link']").val();
                            $.ajax({
                                type: 'get',
                                url: 'change-link-type',
                                dataType: 'json',
                                data: {
                                    link_type: link_type,
                                    select_width: select_width,
                                    page: page,
                                },
                                success: function(result) {
                                    $('#15293379611yygN6').find('#link_change').html(result.data);
                                    $('#15293379611yygN6').find('.chosen-select').chosen();
                                    $('#15293379611yygN6').find('.chosen-container').addClass('w200');
                                },
                            });
                        });
                    });
                </script></td>
            <td>
                <input class="form-control small" type="text" value="" name="sort">
            </td>
            <td class="text-c handle">
                <a class="del nav-del" href="javascript:void(0);">删除</a>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="chrTable26 hide">
        <tbody>
        <tr>
            <td>
                <div class="szy-imagegroup" data-size="1"></div>
                <input type="hidden" id="path" name="path" value="">
            </td>
            <td class="text-c">
                <input placeholder="导航名称" type="text" name="name" value="" class="form-control w100">
            </td>
            <td class="text-c">
                <input type="text" name="color" value="" class="form-control w100 colorpicker">
            </td>
            <td>
                <div id="1529337961zaAAK8">
                    <input type="hidden" id="select_width" value="w200">
                    <input type="hidden" id="page_code" value="m_site">
                    <select class="form-control w100 " id="link_type" name="link_type">
                        <option value="0" selected="selected">自定义链接</option>
                        <option value="1" >常用链接</option>
                        <!-- <option value="2" >选择商品</option> -->
                        <option value="3" >店铺主页</option>
                        <option value="8" >文章分类</option>
                        <option value="4" >文章详情</option>

                        <option value="5" >分类商品</option>


                        <option value="6" >团购活动</option>

                        <option value="7" >品牌专题</option>
                        <option value="9" >专题活动</option>
                    </select>
                    <span id="link_change">


<input class="form-control w180" type="text" name="link" value="" placeholder="输入链接地址">


</span>
                </div>
                <!-- 处理切换连接类型 -->
                <script type="text/javascript">
                    $().ready(function() {
                        $('#1529337961zaAAK8').find('#link_type').change(function() {
                            var link_type = $(this).val();
                            var select_width = $('#1529337961zaAAK8').find('#select_width').val();
                            var page = $('#1529337961zaAAK8').find('#page_code').val();
//var link = $('#1529337961zaAAK8').find("[name='link']").val();
                            $.ajax({
                                type: 'get',
                                url: 'change-link-type',
                                dataType: 'json',
                                data: {
                                    link_type: link_type,
                                    select_width: select_width,
                                    page: page,
                                },
                                success: function(result) {
                                    $('#1529337961zaAAK8').find('#link_change').html(result.data);
                                    $('#1529337961zaAAK8').find('.chosen-select').chosen();
                                    $('#1529337961zaAAK8').find('.chosen-container').addClass('w200');
                                },
                            });
                        });
                    });
                </script></td>
            <td>
                <input class="form-control small" type="text" value="" name="sort">
            </td>
            <td class="text-c handle">
                <a class="del nav-del" href="javascript:void(0);">删除</a>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="chrTable27 hide">
        <tbody>
        <tr>
            <td>
                <div class="szy-imagegroup" data-size="1"></div>
                <input type="hidden" id="path" name="path" value="">
            </td>
            <td class="text-c">
                <input placeholder="导航名称" type="text" name="name" value="" class="form-control w100">
            </td>
            <td class="text-c">
                <input type="text" name="color" value="" class="form-control w100 colorpicker">
            </td>
            <td>
                <div id="1529337961Zeu9qo">
                    <input type="hidden" id="select_width" value="w200">
                    <input type="hidden" id="page_code" value="m_site">
                    <select class="form-control w100 " id="link_type" name="link_type">
                        <option value="0" selected="selected">自定义链接</option>
                        <option value="1" >常用链接</option>
                        <!-- <option value="2" >选择商品</option> -->
                        <option value="3" >店铺主页</option>
                        <option value="8" >文章分类</option>
                        <option value="4" >文章详情</option>

                        <option value="5" >分类商品</option>


                        <option value="6" >团购活动</option>

                        <option value="7" >品牌专题</option>
                        <option value="9" >专题活动</option>
                    </select>
                    <span id="link_change">


<input class="form-control w180" type="text" name="link" value="" placeholder="输入链接地址">


</span>
                </div>
                <!-- 处理切换连接类型 -->
                <script type="text/javascript">
                    $().ready(function() {
                        $('#1529337961Zeu9qo').find('#link_type').change(function() {
                            var link_type = $(this).val();
                            var select_width = $('#1529337961Zeu9qo').find('#select_width').val();
                            var page = $('#1529337961Zeu9qo').find('#page_code').val();
//var link = $('#1529337961Zeu9qo').find("[name='link']").val();
                            $.ajax({
                                type: 'get',
                                url: 'change-link-type',
                                dataType: 'json',
                                data: {
                                    link_type: link_type,
                                    select_width: select_width,
                                    page: page,
                                },
                                success: function(result) {
                                    $('#1529337961Zeu9qo').find('#link_change').html(result.data);
                                    $('#1529337961Zeu9qo').find('.chosen-select').chosen();
                                    $('#1529337961Zeu9qo').find('.chosen-container').addClass('w200');
                                },
                            });
                        });
                    });
                </script></td>
            <td>
                <input class="form-control small" type="text" value="" name="sort">
            </td>
            <td class="text-c handle">
                <a class="del nav-del" href="javascript:void(0);">删除</a>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="chrTable28 hide">
        <tbody>
        <tr>
            <td>
                <div class="szy-imagegroup" data-size="1"></div>
                <input type="hidden" id="path" name="path" value="">
            </td>
            <td class="text-c">
                <input placeholder="导航名称" type="text" name="name" value="" class="form-control w100">
            </td>
            <td class="text-c">
                <input type="text" name="color" value="" class="form-control w100 colorpicker">
            </td>
            <td>
                <div id="1529337961y4tAtK">
                    <input type="hidden" id="select_width" value="w200">
                    <input type="hidden" id="page_code" value="m_site">
                    <select class="form-control w100 " id="link_type" name="link_type">
                        <option value="0" selected="selected">自定义链接</option>
                        <option value="1" >常用链接</option>
                        <!-- <option value="2" >选择商品</option> -->
                        <option value="3" >店铺主页</option>
                        <option value="8" >文章分类</option>
                        <option value="4" >文章详情</option>

                        <option value="5" >分类商品</option>


                        <option value="6" >团购活动</option>

                        <option value="7" >品牌专题</option>
                        <option value="9" >专题活动</option>
                    </select>
                    <span id="link_change">


<input class="form-control w180" type="text" name="link" value="" placeholder="输入链接地址">


</span>
                </div>
                <!-- 处理切换连接类型 -->
                <script type="text/javascript">
                    $().ready(function() {
                        $('#1529337961y4tAtK').find('#link_type').change(function() {
                            var link_type = $(this).val();
                            var select_width = $('#1529337961y4tAtK').find('#select_width').val();
                            var page = $('#1529337961y4tAtK').find('#page_code').val();
//var link = $('#1529337961y4tAtK').find("[name='link']").val();
                            $.ajax({
                                type: 'get',
                                url: 'change-link-type',
                                dataType: 'json',
                                data: {
                                    link_type: link_type,
                                    select_width: select_width,
                                    page: page,
                                },
                                success: function(result) {
                                    $('#1529337961y4tAtK').find('#link_change').html(result.data);
                                    $('#1529337961y4tAtK').find('.chosen-select').chosen();
                                    $('#1529337961y4tAtK').find('.chosen-container').addClass('w200');
                                },
                            });
                        });
                    });
                </script></td>
            <td>
                <input class="form-control small" type="text" value="" name="sort">
            </td>
            <td class="text-c handle">
                <a class="del nav-del" href="javascript:void(0);">删除</a>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="chrTable29 hide">
        <tbody>
        <tr>
            <td>
                <div class="szy-imagegroup" data-size="1"></div>
                <input type="hidden" id="path" name="path" value="">
            </td>
            <td class="text-c">
                <input placeholder="导航名称" type="text" name="name" value="" class="form-control w100">
            </td>
            <td class="text-c">
                <input type="text" name="color" value="" class="form-control w100 colorpicker">
            </td>
            <td>
                <div id="15293379618Yp7tr">
                    <input type="hidden" id="select_width" value="w200">
                    <input type="hidden" id="page_code" value="m_site">
                    <select class="form-control w100 " id="link_type" name="link_type">
                        <option value="0" selected="selected">自定义链接</option>
                        <option value="1" >常用链接</option>
                        <!-- <option value="2" >选择商品</option> -->
                        <option value="3" >店铺主页</option>
                        <option value="8" >文章分类</option>
                        <option value="4" >文章详情</option>

                        <option value="5" >分类商品</option>


                        <option value="6" >团购活动</option>

                        <option value="7" >品牌专题</option>
                        <option value="9" >专题活动</option>
                    </select>
                    <span id="link_change">


<input class="form-control w180" type="text" name="link" value="" placeholder="输入链接地址">


</span>
                </div>
                <!-- 处理切换连接类型 -->
                <script type="text/javascript">
                    $().ready(function() {
                        $('#15293379618Yp7tr').find('#link_type').change(function() {
                            var link_type = $(this).val();
                            var select_width = $('#15293379618Yp7tr').find('#select_width').val();
                            var page = $('#15293379618Yp7tr').find('#page_code').val();
//var link = $('#15293379618Yp7tr').find("[name='link']").val();
                            $.ajax({
                                type: 'get',
                                url: 'change-link-type',
                                dataType: 'json',
                                data: {
                                    link_type: link_type,
                                    select_width: select_width,
                                    page: page,
                                },
                                success: function(result) {
                                    $('#15293379618Yp7tr').find('#link_change').html(result.data);
                                    $('#15293379618Yp7tr').find('.chosen-select').chosen();
                                    $('#15293379618Yp7tr').find('.chosen-container').addClass('w200');
                                },
                            });
                        });
                    });
                </script></td>
            <td>
                <input class="form-control small" type="text" value="" name="sort">
            </td>
            <td class="text-c handle">
                <a class="del nav-del" href="javascript:void(0);">删除</a>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="chrTable30 hide">
        <tbody>
        <tr>
            <td>
                <div class="szy-imagegroup" data-size="1"></div>
                <input type="hidden" id="path" name="path" value="">
            </td>
            <td class="text-c">
                <input placeholder="导航名称" type="text" name="name" value="" class="form-control w100">
            </td>
            <td class="text-c">
                <input type="text" name="color" value="" class="form-control w100 colorpicker">
            </td>
            <td>
                <div id="1529337961GZhtT6">
                    <input type="hidden" id="select_width" value="w200">
                    <input type="hidden" id="page_code" value="m_site">
                    <select class="form-control w100 " id="link_type" name="link_type">
                        <option value="0" selected="selected">自定义链接</option>
                        <option value="1" >常用链接</option>
                        <!-- <option value="2" >选择商品</option> -->
                        <option value="3" >店铺主页</option>
                        <option value="8" >文章分类</option>
                        <option value="4" >文章详情</option>

                        <option value="5" >分类商品</option>


                        <option value="6" >团购活动</option>

                        <option value="7" >品牌专题</option>
                        <option value="9" >专题活动</option>
                    </select>
                    <span id="link_change">


<input class="form-control w180" type="text" name="link" value="" placeholder="输入链接地址">


</span>
                </div>
                <!-- 处理切换连接类型 -->
                <script type="text/javascript">
                    $().ready(function() {
                        $('#1529337961GZhtT6').find('#link_type').change(function() {
                            var link_type = $(this).val();
                            var select_width = $('#1529337961GZhtT6').find('#select_width').val();
                            var page = $('#1529337961GZhtT6').find('#page_code').val();
//var link = $('#1529337961GZhtT6').find("[name='link']").val();
                            $.ajax({
                                type: 'get',
                                url: 'change-link-type',
                                dataType: 'json',
                                data: {
                                    link_type: link_type,
                                    select_width: select_width,
                                    page: page,
                                },
                                success: function(result) {
                                    $('#1529337961GZhtT6').find('#link_change').html(result.data);
                                    $('#1529337961GZhtT6').find('.chosen-select').chosen();
                                    $('#1529337961GZhtT6').find('.chosen-container').addClass('w200');
                                },
                            });
                        });
                    });
                </script></td>
            <td>
                <input class="form-control small" type="text" value="" name="sort">
            </td>
            <td class="text-c handle">
                <a class="del nav-del" href="javascript:void(0);">删除</a>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="chrTable31 hide">
        <tbody>
        <tr>
            <td>
                <div class="szy-imagegroup" data-size="1"></div>
                <input type="hidden" id="path" name="path" value="">
            </td>
            <td class="text-c">
                <input placeholder="导航名称" type="text" name="name" value="" class="form-control w100">
            </td>
            <td class="text-c">
                <input type="text" name="color" value="" class="form-control w100 colorpicker">
            </td>
            <td>
                <div id="1529337961NWxwa2">
                    <input type="hidden" id="select_width" value="w200">
                    <input type="hidden" id="page_code" value="m_site">
                    <select class="form-control w100 " id="link_type" name="link_type">
                        <option value="0" selected="selected">自定义链接</option>
                        <option value="1" >常用链接</option>
                        <!-- <option value="2" >选择商品</option> -->
                        <option value="3" >店铺主页</option>
                        <option value="8" >文章分类</option>
                        <option value="4" >文章详情</option>

                        <option value="5" >分类商品</option>


                        <option value="6" >团购活动</option>

                        <option value="7" >品牌专题</option>
                        <option value="9" >专题活动</option>
                    </select>
                    <span id="link_change">


<input class="form-control w180" type="text" name="link" value="" placeholder="输入链接地址">


</span>
                </div>
                <!-- 处理切换连接类型 -->
                <script type="text/javascript">
                    $().ready(function() {
                        $('#1529337961NWxwa2').find('#link_type').change(function() {
                            var link_type = $(this).val();
                            var select_width = $('#1529337961NWxwa2').find('#select_width').val();
                            var page = $('#1529337961NWxwa2').find('#page_code').val();
//var link = $('#1529337961NWxwa2').find("[name='link']").val();
                            $.ajax({
                                type: 'get',
                                url: 'change-link-type',
                                dataType: 'json',
                                data: {
                                    link_type: link_type,
                                    select_width: select_width,
                                    page: page,
                                },
                                success: function(result) {
                                    $('#1529337961NWxwa2').find('#link_change').html(result.data);
                                    $('#1529337961NWxwa2').find('.chosen-select').chosen();
                                    $('#1529337961NWxwa2').find('.chosen-container').addClass('w200');
                                },
                            });
                        });
                    });
                </script></td>
            <td>
                <input class="form-control small" type="text" value="" name="sort">
            </td>
            <td class="text-c handle">
                <a class="del nav-del" href="javascript:void(0);">删除</a>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="chrTable32 hide">
        <tbody>
        <tr>
            <td>
                <div class="szy-imagegroup" data-size="1"></div>
                <input type="hidden" id="path" name="path" value="">
            </td>
            <td class="text-c">
                <input placeholder="导航名称" type="text" name="name" value="" class="form-control w100">
            </td>
            <td class="text-c">
                <input type="text" name="color" value="" class="form-control w100 colorpicker">
            </td>
            <td>
                <div id="1529337961zy47Vn">
                    <input type="hidden" id="select_width" value="w200">
                    <input type="hidden" id="page_code" value="m_site">
                    <select class="form-control w100 " id="link_type" name="link_type">
                        <option value="0" selected="selected">自定义链接</option>
                        <option value="1" >常用链接</option>
                        <!-- <option value="2" >选择商品</option> -->
                        <option value="3" >店铺主页</option>
                        <option value="8" >文章分类</option>
                        <option value="4" >文章详情</option>

                        <option value="5" >分类商品</option>


                        <option value="6" >团购活动</option>

                        <option value="7" >品牌专题</option>
                        <option value="9" >专题活动</option>
                    </select>
                    <span id="link_change">


<input class="form-control w180" type="text" name="link" value="" placeholder="输入链接地址">


</span>
                </div>
                <!-- 处理切换连接类型 -->
                <script type="text/javascript">
                    $().ready(function() {
                        $('#1529337961zy47Vn').find('#link_type').change(function() {
                            var link_type = $(this).val();
                            var select_width = $('#1529337961zy47Vn').find('#select_width').val();
                            var page = $('#1529337961zy47Vn').find('#page_code').val();
//var link = $('#1529337961zy47Vn').find("[name='link']").val();
                            $.ajax({
                                type: 'get',
                                url: 'change-link-type',
                                dataType: 'json',
                                data: {
                                    link_type: link_type,
                                    select_width: select_width,
                                    page: page,
                                },
                                success: function(result) {
                                    $('#1529337961zy47Vn').find('#link_change').html(result.data);
                                    $('#1529337961zy47Vn').find('.chosen-select').chosen();
                                    $('#1529337961zy47Vn').find('.chosen-container').addClass('w200');
                                },
                            });
                        });
                    });
                </script></td>
            <td>
                <input class="form-control small" type="text" value="" name="sort">
            </td>
            <td class="text-c handle">
                <a class="del nav-del" href="javascript:void(0);">删除</a>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="chrTable33 hide">
        <tbody>
        <tr>
            <td>
                <div class="szy-imagegroup" data-size="1"></div>
                <input type="hidden" id="path" name="path" value="">
            </td>
            <td class="text-c">
                <input placeholder="导航名称" type="text" name="name" value="" class="form-control w100">
            </td>
            <td class="text-c">
                <input type="text" name="color" value="" class="form-control w100 colorpicker">
            </td>
            <td>
                <div id="1529337961QmfD78">
                    <input type="hidden" id="select_width" value="w200">
                    <input type="hidden" id="page_code" value="m_site">
                    <select class="form-control w100 " id="link_type" name="link_type">
                        <option value="0" selected="selected">自定义链接</option>
                        <option value="1" >常用链接</option>
                        <!-- <option value="2" >选择商品</option> -->
                        <option value="3" >店铺主页</option>
                        <option value="8" >文章分类</option>
                        <option value="4" >文章详情</option>

                        <option value="5" >分类商品</option>


                        <option value="6" >团购活动</option>

                        <option value="7" >品牌专题</option>
                        <option value="9" >专题活动</option>
                    </select>
                    <span id="link_change">


<input class="form-control w180" type="text" name="link" value="" placeholder="输入链接地址">


</span>
                </div>
                <!-- 处理切换连接类型 -->
                <script type="text/javascript">
                    $().ready(function() {
                        $('#1529337961QmfD78').find('#link_type').change(function() {
                            var link_type = $(this).val();
                            var select_width = $('#1529337961QmfD78').find('#select_width').val();
                            var page = $('#1529337961QmfD78').find('#page_code').val();
//var link = $('#1529337961QmfD78').find("[name='link']").val();
                            $.ajax({
                                type: 'get',
                                url: 'change-link-type',
                                dataType: 'json',
                                data: {
                                    link_type: link_type,
                                    select_width: select_width,
                                    page: page,
                                },
                                success: function(result) {
                                    $('#1529337961QmfD78').find('#link_change').html(result.data);
                                    $('#1529337961QmfD78').find('.chosen-select').chosen();
                                    $('#1529337961QmfD78').find('.chosen-container').addClass('w200');
                                },
                            });
                        });
                    });
                </script></td>
            <td>
                <input class="form-control small" type="text" value="" name="sort">
            </td>
            <td class="text-c handle">
                <a class="del nav-del" href="javascript:void(0);">删除</a>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="chrTable34 hide">
        <tbody>
        <tr>
            <td>
                <div class="szy-imagegroup" data-size="1"></div>
                <input type="hidden" id="path" name="path" value="">
            </td>
            <td class="text-c">
                <input placeholder="导航名称" type="text" name="name" value="" class="form-control w100">
            </td>
            <td class="text-c">
                <input type="text" name="color" value="" class="form-control w100 colorpicker">
            </td>
            <td>
                <div id="15293379610lCX1k">
                    <input type="hidden" id="select_width" value="w200">
                    <input type="hidden" id="page_code" value="m_site">
                    <select class="form-control w100 " id="link_type" name="link_type">
                        <option value="0" selected="selected">自定义链接</option>
                        <option value="1" >常用链接</option>
                        <!-- <option value="2" >选择商品</option> -->
                        <option value="3" >店铺主页</option>
                        <option value="8" >文章分类</option>
                        <option value="4" >文章详情</option>

                        <option value="5" >分类商品</option>


                        <option value="6" >团购活动</option>

                        <option value="7" >品牌专题</option>
                        <option value="9" >专题活动</option>
                    </select>
                    <span id="link_change">


<input class="form-control w180" type="text" name="link" value="" placeholder="输入链接地址">


</span>
                </div>
                <!-- 处理切换连接类型 -->
                <script type="text/javascript">
                    $().ready(function() {
                        $('#15293379610lCX1k').find('#link_type').change(function() {
                            var link_type = $(this).val();
                            var select_width = $('#15293379610lCX1k').find('#select_width').val();
                            var page = $('#15293379610lCX1k').find('#page_code').val();
//var link = $('#15293379610lCX1k').find("[name='link']").val();
                            $.ajax({
                                type: 'get',
                                url: 'change-link-type',
                                dataType: 'json',
                                data: {
                                    link_type: link_type,
                                    select_width: select_width,
                                    page: page,
                                },
                                success: function(result) {
                                    $('#15293379610lCX1k').find('#link_change').html(result.data);
                                    $('#15293379610lCX1k').find('.chosen-select').chosen();
                                    $('#15293379610lCX1k').find('.chosen-container').addClass('w200');
                                },
                            });
                        });
                    });
                </script></td>
            <td>
                <input class="form-control small" type="text" value="" name="sort">
            </td>
            <td class="text-c handle">
                <a class="del nav-del" href="javascript:void(0);">删除</a>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="chrTable35 hide">
        <tbody>
        <tr>
            <td>
                <div class="szy-imagegroup" data-size="1"></div>
                <input type="hidden" id="path" name="path" value="">
            </td>
            <td class="text-c">
                <input placeholder="导航名称" type="text" name="name" value="" class="form-control w100">
            </td>
            <td class="text-c">
                <input type="text" name="color" value="" class="form-control w100 colorpicker">
            </td>
            <td>
                <div id="15293379614gDuuT">
                    <input type="hidden" id="select_width" value="w200">
                    <input type="hidden" id="page_code" value="m_site">
                    <select class="form-control w100 " id="link_type" name="link_type">
                        <option value="0" selected="selected">自定义链接</option>
                        <option value="1" >常用链接</option>
                        <!-- <option value="2" >选择商品</option> -->
                        <option value="3" >店铺主页</option>
                        <option value="8" >文章分类</option>
                        <option value="4" >文章详情</option>

                        <option value="5" >分类商品</option>


                        <option value="6" >团购活动</option>

                        <option value="7" >品牌专题</option>
                        <option value="9" >专题活动</option>
                    </select>
                    <span id="link_change">


<input class="form-control w180" type="text" name="link" value="" placeholder="输入链接地址">


</span>
                </div>
                <!-- 处理切换连接类型 -->
                <script type="text/javascript">
                    $().ready(function() {
                        $('#15293379614gDuuT').find('#link_type').change(function() {
                            var link_type = $(this).val();
                            var select_width = $('#15293379614gDuuT').find('#select_width').val();
                            var page = $('#15293379614gDuuT').find('#page_code').val();
//var link = $('#15293379614gDuuT').find("[name='link']").val();
                            $.ajax({
                                type: 'get',
                                url: 'change-link-type',
                                dataType: 'json',
                                data: {
                                    link_type: link_type,
                                    select_width: select_width,
                                    page: page,
                                },
                                success: function(result) {
                                    $('#15293379614gDuuT').find('#link_change').html(result.data);
                                    $('#15293379614gDuuT').find('.chosen-select').chosen();
                                    $('#15293379614gDuuT').find('.chosen-container').addClass('w200');
                                },
                            });
                        });
                    });
                </script></td>
            <td>
                <input class="form-control small" type="text" value="" name="sort">
            </td>
            <td class="text-c handle">
                <a class="del nav-del" href="javascript:void(0);">删除</a>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="chrTable36 hide">
        <tbody>
        <tr>
            <td>
                <div class="szy-imagegroup" data-size="1"></div>
                <input type="hidden" id="path" name="path" value="">
            </td>
            <td class="text-c">
                <input placeholder="导航名称" type="text" name="name" value="" class="form-control w100">
            </td>
            <td class="text-c">
                <input type="text" name="color" value="" class="form-control w100 colorpicker">
            </td>
            <td>
                <div id="1529337961IUE5fO">
                    <input type="hidden" id="select_width" value="w200">
                    <input type="hidden" id="page_code" value="m_site">
                    <select class="form-control w100 " id="link_type" name="link_type">
                        <option value="0" selected="selected">自定义链接</option>
                        <option value="1" >常用链接</option>
                        <!-- <option value="2" >选择商品</option> -->
                        <option value="3" >店铺主页</option>
                        <option value="8" >文章分类</option>
                        <option value="4" >文章详情</option>

                        <option value="5" >分类商品</option>


                        <option value="6" >团购活动</option>

                        <option value="7" >品牌专题</option>
                        <option value="9" >专题活动</option>
                    </select>
                    <span id="link_change">


<input class="form-control w180" type="text" name="link" value="" placeholder="输入链接地址">


</span>
                </div>
                <!-- 处理切换连接类型 -->
                <script type="text/javascript">
                    $().ready(function() {
                        $('#1529337961IUE5fO').find('#link_type').change(function() {
                            var link_type = $(this).val();
                            var select_width = $('#1529337961IUE5fO').find('#select_width').val();
                            var page = $('#1529337961IUE5fO').find('#page_code').val();
//var link = $('#1529337961IUE5fO').find("[name='link']").val();
                            $.ajax({
                                type: 'get',
                                url: 'change-link-type',
                                dataType: 'json',
                                data: {
                                    link_type: link_type,
                                    select_width: select_width,
                                    page: page,
                                },
                                success: function(result) {
                                    $('#1529337961IUE5fO').find('#link_change').html(result.data);
                                    $('#1529337961IUE5fO').find('.chosen-select').chosen();
                                    $('#1529337961IUE5fO').find('.chosen-container').addClass('w200');
                                },
                            });
                        });
                    });
                </script></td>
            <td>
                <input class="form-control small" type="text" value="" name="sort">
            </td>
            <td class="text-c handle">
                <a class="del nav-del" href="javascript:void(0);">删除</a>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="chrTable37 hide">
        <tbody>
        <tr>
            <td>
                <div class="szy-imagegroup" data-size="1"></div>
                <input type="hidden" id="path" name="path" value="">
            </td>
            <td class="text-c">
                <input placeholder="导航名称" type="text" name="name" value="" class="form-control w100">
            </td>
            <td class="text-c">
                <input type="text" name="color" value="" class="form-control w100 colorpicker">
            </td>
            <td>
                <div id="1529337961lst5gl">
                    <input type="hidden" id="select_width" value="w200">
                    <input type="hidden" id="page_code" value="m_site">
                    <select class="form-control w100 " id="link_type" name="link_type">
                        <option value="0" selected="selected">自定义链接</option>
                        <option value="1" >常用链接</option>
                        <!-- <option value="2" >选择商品</option> -->
                        <option value="3" >店铺主页</option>
                        <option value="8" >文章分类</option>
                        <option value="4" >文章详情</option>

                        <option value="5" >分类商品</option>


                        <option value="6" >团购活动</option>

                        <option value="7" >品牌专题</option>
                        <option value="9" >专题活动</option>
                    </select>
                    <span id="link_change">


<input class="form-control w180" type="text" name="link" value="" placeholder="输入链接地址">


</span>
                </div>
                <!-- 处理切换连接类型 -->
                <script type="text/javascript">
                    $().ready(function() {
                        $('#1529337961lst5gl').find('#link_type').change(function() {
                            var link_type = $(this).val();
                            var select_width = $('#1529337961lst5gl').find('#select_width').val();
                            var page = $('#1529337961lst5gl').find('#page_code').val();
//var link = $('#1529337961lst5gl').find("[name='link']").val();
                            $.ajax({
                                type: 'get',
                                url: 'change-link-type',
                                dataType: 'json',
                                data: {
                                    link_type: link_type,
                                    select_width: select_width,
                                    page: page,
                                },
                                success: function(result) {
                                    $('#1529337961lst5gl').find('#link_change').html(result.data);
                                    $('#1529337961lst5gl').find('.chosen-select').chosen();
                                    $('#1529337961lst5gl').find('.chosen-container').addClass('w200');
                                },
                            });
                        });
                    });
                </script></td>
            <td>
                <input class="form-control small" type="text" value="" name="sort">
            </td>
            <td class="text-c handle">
                <a class="del nav-del" href="javascript:void(0);">删除</a>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="chrTable38 hide">
        <tbody>
        <tr>
            <td>
                <div class="szy-imagegroup" data-size="1"></div>
                <input type="hidden" id="path" name="path" value="">
            </td>
            <td class="text-c">
                <input placeholder="导航名称" type="text" name="name" value="" class="form-control w100">
            </td>
            <td class="text-c">
                <input type="text" name="color" value="" class="form-control w100 colorpicker">
            </td>
            <td>
                <div id="15293379614yAugC">
                    <input type="hidden" id="select_width" value="w200">
                    <input type="hidden" id="page_code" value="m_site">
                    <select class="form-control w100 " id="link_type" name="link_type">
                        <option value="0" selected="selected">自定义链接</option>
                        <option value="1" >常用链接</option>
                        <!-- <option value="2" >选择商品</option> -->
                        <option value="3" >店铺主页</option>
                        <option value="8" >文章分类</option>
                        <option value="4" >文章详情</option>

                        <option value="5" >分类商品</option>


                        <option value="6" >团购活动</option>

                        <option value="7" >品牌专题</option>
                        <option value="9" >专题活动</option>
                    </select>
                    <span id="link_change">


<input class="form-control w180" type="text" name="link" value="" placeholder="输入链接地址">


</span>
                </div>
                <!-- 处理切换连接类型 -->
                <script type="text/javascript">
                    $().ready(function() {
                        $('#15293379614yAugC').find('#link_type').change(function() {
                            var link_type = $(this).val();
                            var select_width = $('#15293379614yAugC').find('#select_width').val();
                            var page = $('#15293379614yAugC').find('#page_code').val();
//var link = $('#15293379614yAugC').find("[name='link']").val();
                            $.ajax({
                                type: 'get',
                                url: 'change-link-type',
                                dataType: 'json',
                                data: {
                                    link_type: link_type,
                                    select_width: select_width,
                                    page: page,
                                },
                                success: function(result) {
                                    $('#15293379614yAugC').find('#link_change').html(result.data);
                                    $('#15293379614yAugC').find('.chosen-select').chosen();
                                    $('#15293379614yAugC').find('.chosen-container').addClass('w200');
                                },
                            });
                        });
                    });
                </script></td>
            <td>
                <input class="form-control small" type="text" value="" name="sort">
            </td>
            <td class="text-c handle">
                <a class="del nav-del" href="javascript:void(0);">删除</a>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="chrTable39 hide">
        <tbody>
        <tr>
            <td>
                <div class="szy-imagegroup" data-size="1"></div>
                <input type="hidden" id="path" name="path" value="">
            </td>
            <td class="text-c">
                <input placeholder="导航名称" type="text" name="name" value="" class="form-control w100">
            </td>
            <td class="text-c">
                <input type="text" name="color" value="" class="form-control w100 colorpicker">
            </td>
            <td>
                <div id="1529337961aua6xc">
                    <input type="hidden" id="select_width" value="w200">
                    <input type="hidden" id="page_code" value="m_site">
                    <select class="form-control w100 " id="link_type" name="link_type">
                        <option value="0" selected="selected">自定义链接</option>
                        <option value="1" >常用链接</option>
                        <!-- <option value="2" >选择商品</option> -->
                        <option value="3" >店铺主页</option>
                        <option value="8" >文章分类</option>
                        <option value="4" >文章详情</option>

                        <option value="5" >分类商品</option>


                        <option value="6" >团购活动</option>

                        <option value="7" >品牌专题</option>
                        <option value="9" >专题活动</option>
                    </select>
                    <span id="link_change">


<input class="form-control w180" type="text" name="link" value="" placeholder="输入链接地址">


</span>
                </div>
                <!-- 处理切换连接类型 -->
                <script type="text/javascript">
                    $().ready(function() {
                        $('#1529337961aua6xc').find('#link_type').change(function() {
                            var link_type = $(this).val();
                            var select_width = $('#1529337961aua6xc').find('#select_width').val();
                            var page = $('#1529337961aua6xc').find('#page_code').val();
//var link = $('#1529337961aua6xc').find("[name='link']").val();
                            $.ajax({
                                type: 'get',
                                url: 'change-link-type',
                                dataType: 'json',
                                data: {
                                    link_type: link_type,
                                    select_width: select_width,
                                    page: page,
                                },
                                success: function(result) {
                                    $('#1529337961aua6xc').find('#link_change').html(result.data);
                                    $('#1529337961aua6xc').find('.chosen-select').chosen();
                                    $('#1529337961aua6xc').find('.chosen-container').addClass('w200');
                                },
                            });
                        });
                    });
                </script></td>
            <td>
                <input class="form-control small" type="text" value="" name="sort">
            </td>
            <td class="text-c handle">
                <a class="del nav-del" href="javascript:void(0);">删除</a>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="chrTable40 hide">
        <tbody>
        <tr>
            <td>
                <div class="szy-imagegroup" data-size="1"></div>
                <input type="hidden" id="path" name="path" value="">
            </td>
            <td class="text-c">
                <input placeholder="导航名称" type="text" name="name" value="" class="form-control w100">
            </td>
            <td class="text-c">
                <input type="text" name="color" value="" class="form-control w100 colorpicker">
            </td>
            <td>
                <div id="1529337961lQy5KB">
                    <input type="hidden" id="select_width" value="w200">
                    <input type="hidden" id="page_code" value="m_site">
                    <select class="form-control w100 " id="link_type" name="link_type">
                        <option value="0" selected="selected">自定义链接</option>
                        <option value="1" >常用链接</option>
                        <!-- <option value="2" >选择商品</option> -->
                        <option value="3" >店铺主页</option>
                        <option value="8" >文章分类</option>
                        <option value="4" >文章详情</option>

                        <option value="5" >分类商品</option>


                        <option value="6" >团购活动</option>

                        <option value="7" >品牌专题</option>
                        <option value="9" >专题活动</option>
                    </select>
                    <span id="link_change">


<input class="form-control w180" type="text" name="link" value="" placeholder="输入链接地址">


</span>
                </div>
                <!-- 处理切换连接类型 -->
                <script type="text/javascript">
                    $().ready(function() {
                        $('#1529337961lQy5KB').find('#link_type').change(function() {
                            var link_type = $(this).val();
                            var select_width = $('#1529337961lQy5KB').find('#select_width').val();
                            var page = $('#1529337961lQy5KB').find('#page_code').val();
//var link = $('#1529337961lQy5KB').find("[name='link']").val();
                            $.ajax({
                                type: 'get',
                                url: 'change-link-type',
                                dataType: 'json',
                                data: {
                                    link_type: link_type,
                                    select_width: select_width,
                                    page: page,
                                },
                                success: function(result) {
                                    $('#1529337961lQy5KB').find('#link_change').html(result.data);
                                    $('#1529337961lQy5KB').find('.chosen-select').chosen();
                                    $('#1529337961lQy5KB').find('.chosen-container').addClass('w200');
                                },
                            });
                        });
                    });
                </script></td>
            <td>
                <input class="form-control small" type="text" value="" name="sort">
            </td>
            <td class="text-c handle">
                <a class="del nav-del" href="javascript:void(0);">删除</a>
            </td>
        </tr>
        </tbody>
    </table>

</div>
<script type="text/javascript">
    $().ready(function() {
        getFileImageList();

        $('#{{ $page_id }}').find(".szy-imagegroup").each(function() {
            var size = $(this).data("size");
            var target = $(this);
            var value = $(this).parent().find('input[name="path"]').val();
            $(this).imagegroup({
                host: "/site/upload-image",
                size: size,
                bgclass: 'image-nav-bg',
                gallery: true,
                values: value.split("|"),
// 回调函数
                callback: function(data) {
                    var values = this.values;
                    if (!values) {
                        values = [];
                    }
                    values = values.join("|");
                    target.parent().find('input[name="path"]').val(values);
                },
// 移除的回调函数
                remove: function(value, values) {
                    var values = this.values;
                    if (!values) {
                        values = [];
                    }
                    values = values.join("|");
                    target.parent().find('input[name="path"]').val(values);
                }
            });
        });

    });

    function getFileImageList() {
        $.each($('#{{ $page_id }}').find(".navTable .file_image"), function(i, v) {
            $(this).attr("id", "file_image_{{ $page_id }}" + i);
        });
        $.each($('#{{ $page_id }}').find('#addNavTable').find('.colorpicker'), function() {
            $(this).colorpicker({
                color: $(this).val()
            }).on('change.color', function(evt, color) {
                $(this).val(color);
            });
        });
    }
</script>



<script type="text/javascript">
    $().ready(function() {
        $("#{{ $page_id }}").on('focus', 'input', function() {
            if ($(this).hasClass('error')) {
                $(this).removeClass('error');
            }
        });
        var type = '{{ $data['type'] }}';
        var cat_id = '{{ $data['cat_id'] ?? 1 }}';
        var uid = '{{ $data['uid'] }}';
        var uuid = '{{ $page_id }}';
        var max_number = '{{ $data['number'] }}';
        var select_count = '{{ count($selector_data) }}';
        $("#{{ $page_id }}").find("#ok").click(function() {
            chk_value = [];
            var flag = [];
            $("#{{ $page_id }}").find('#addNavTable tbody tr').each(function(i, v) {
                if ($.trim($(this).find('input[name="name"]').val()) == '' || $.trim($(this).find('input[name="name"]').val()).length > 10) {
                    flag.push(v);
                }
                chk_value.push({
                    path: $(this).find('[name="path"]').val(),
                    link: $(this).find('[name="link"]').val(),
                    link_type: $(this).find('[name="link_type"]').val(),
                    name: $(this).find('[name="name"]').val(),
                    color: $(this).find('[name="color"]').val(),
                    sort: $(this).find('[name="sort"]').val(),
                });
            });

            if (flag.length > 0) {
                for (var i = 0; i < flag.length; i++) {
                    $(flag[i]).find('input[name="name"]').addClass('error');
                }

                $.msg('导航名称不能为空，且不能超过10个字符');
                return false;
            }
//上传数据
            $.designadddata({
                data: {
                    uid: uid,
                    chk_value: chk_value,
                    type: type,
                    cat_id: cat_id,
                    uuid: uuid
                },
            });
        });

        $('#{{ $page_id }}').on("click", ".navLinkModify", function() {
            $(this).parent().parent().find('.navSelscted').slideToggle();
        });

        $('#{{ $page_id }}').find('.navAdd').click(function() {
            if (parseInt(select_count) >= parseInt(max_number)) {
                $.msg("最多可以添加" + max_number + "个导航");
            } else {
                select_count++;
                var $chr_tr = $('#{{ $page_id }}').find('.chrTable' + select_count + ' tbody');
                $('#{{ $page_id }}').find(".navTable tbody").append($chr_tr.html());
                var target = $('#{{ $page_id }}').find(".navTable tbody .szy-imagegroup:last");
                target.imagegroup({
                    host: "/site/upload-image",
                    size: target.data('size'),
                    bgclass: 'image-nav-bg',
                    gallery: true,
                    values: '',
// 回调函数
                    callback: function(data) {
                        var values = this.values;
                        if (!values) {
                            values = [];
                        }
                        values = values.join("|");
                        target.parent().find('input[name="path"]').val(values);
                    },
// 移除的回调函数
                    remove: function(value, values) {
                        var values = this.values;
                        if (!values) {
                            values = [];
                        }
                        values = values.join("|");
                        target.parent().find('input[name="path"]').val(values);
                    }
                });

                $('#{{ $page_id }}').find(".navTable tbody").children().last().find('input[name="sort"]').val(select_count);
                $('.chrTable' + select_count).remove();
                getFileImageList();

            }
        });

        $('#{{ $page_id }}').on("click", ".nav-del", function() {
            $(this).parents('tr').remove();
            select_count--;
            getFileImageList();
        });
    });
</script>