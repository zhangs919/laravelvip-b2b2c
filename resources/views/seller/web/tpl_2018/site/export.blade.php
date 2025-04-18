{{--模板继承--}}
@extends('layouts.seller_layout')

{{--header 内 css文件--}}
@section('header_css')
    
@stop

{{--header 内 css文件--}}
@section('header_css_2')
    <link href="/assets/d2eace91/css/styles.css" rel="stylesheet">
@stop

{{--css style page元素同级上面--}}
@section('style')
    <style type="text/css">
        .table thead tr th:first-child, .table tbody tr td:first-child {
            padding-left: 0px;
        }
        .table-report table {
            background: none;
            border-spacing: inherit;
        }
    </style>
@stop

{{--content--}}
@section('content')

    <!-- 下载进度 -->
    <div id="ajax_process" class="panel panel-default">
        <div class="panel-heading">正在加载...</div>
        <div class="panel-body">
            <div class="progress m-t-15" style="background-color: #ddd;">
                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
            </div>
        </div>
    </div>
    <!-- 工具栏（列表名称、列表显示项设置） -->
    <div class="common-title">
        <div class="ftitle">
            <h3>文件列表</h3>
        </div>
    </div>    <!--列表内容-->
    <div class="table-responsive" style="overflow: visible;">
        <table id="table_files" class="table table-hover">
            <thead>
            <tr>
                <th class="w80 text-c">序号</th>
                <th>文件</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-c report-waiting" colspan="2">正在加载...</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div id="container" class="table-responsive table-report" style="overflow: visible; display: none;"></div>
    <iframe id="report" style="overflow: visible; display: none;"></iframe>

@stop

{{--script page元素内--}}
@section('script')
    <script id="worker" type="app/worker">
var window = this;
this.onmessage = function(event){
    var worker = this;
    // 导入JS
    if(event.data.scripts && event.data.scripts.length > 0){
        for(var i = 0; i < event.data.scripts.length; i++){
            this.importScripts(event.data.scripts[i]);
        }
    }
    // 导出数据
    if(event.data.table){
        var i = 0;
        // 导出表格
        var table2Excel = new Table2Excel([event.data.table], {
            plugins: [{
                worksheetCreated: function (data) {
                    // 冻结表头
                    data.worksheet.views = [
                        {
                            state: 'frozen',
                            xSplit: 0,
                            ySplit: data.table.col_head_row_count
                        }
                    ];
                },
                workcellCreated: function (data) {
                    // 累计
                    i++;
                    // 赋值
                    data.workcell.value = data.cell.innerText;
                    // 文本垂直居中、水平居右
                    data.workcell.alignment = data.workcell.alignment ? data.workcell.alignment : {};
                    data.workcell.alignment.vertical = 'middle';
                    data.workcell.alignment.horizontal = 'left';
                    // 发送进度
                    worker.postMessage({
                        index: i,
                        end: false
                    });
                }
            }]
        });
        table2Excel.export(function(data){
            worker.postMessage({
                index: i,
                end: true,
                data: data
            });
            worker.close();
        }, "xlsx");
    }
}
</script>
    <script type="text/javascript">
        //
    </script>
@stop

{{--extra html block--}}
@section('extra_html')

@stop


{{--helper_tool--}}
@section('helper_tool')

@stop

{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer_js page元素同级下面--}}
@section('footer_js')
    <script src="/assets/d2eace91/js/FileSaver.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/exceljs.min.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/table2excel.core.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/json2csv.js?v=1.1"></script>
@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <script>
        // 日期格式化
        Date.prototype.format = function(fmt) {
            var o = {
                "M+" : this.getMonth()+1,                 //月份
                "d+" : this.getDate(),                    //日
                "h+" : this.getHours(),                   //小时
                "m+" : this.getMinutes(),                 //分
                "s+" : this.getSeconds(),                 //秒
                "q+" : Math.floor((this.getMonth()+3)/3), //季度
                "S"  : this.getMilliseconds()             //毫秒
            };
            if(/(y+)/.test(fmt)) {
                fmt=fmt.replace(RegExp.$1, (this.getFullYear()+"").substr(4 - RegExp.$1.length));
            }
            for(var k in o) {
                if(new RegExp("("+ k +")").test(fmt)){
                    fmt = fmt.replace(RegExp.$1, (RegExp.$1.length==1) ? (o[k]) : (("00"+ o[k]).substr((""+ o[k]).length)));
                }
            }
            return fmt;
        }
        // 每个文件的数据量
        var record_count = '2000';
        // 每页数据量
        var page_size = 200;
        $(function() {
            var worker_enable = typeof(Worker) !== undefined ? true : false;
            var tables = null;
            var url = $.base64.decode("{{ $url }}");
            // 每N页一个报表文件
            var page_group = record_count / 100;
            // 报表索引
            var report_id = 1;
            // 报表标题
            var report_title = null;
            // 列头
            var col_head = null;
            function createDownloadInfo(id){
                // 创建下载按钮
                if ($("#report_" + id).size() > 0) {
                    $(".report-waiting").remove();
                    // $("#table_files").find("tbody").append('<tr><td class="text-c">' + id + '</td><td><span class="pull-left m-r-30">' + report_title + '_' + id + '<button type="button" class="btn btn-primary btn-xs m-l-10 download" data-report_id="'+id+'" title="点击下载"><span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span>下载</button></span></td></tr>');
                    var link = '<tr><td class="text-c">' + id + '</td><td><span class="pull-left m-r-30">' + report_title + '_' + id;
                    // excel 下载按钮
                    link += '<button type="button" class="btn btn-primary btn-xs m-l-10 download" data-report_id="'+id+'" title="点击下载"><span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span>下载(Excel)</button>';
                    link += '<button type="button" class="btn btn-primary btn-xs m-l-10 csv-download" data-report_id="'+id+'" title="点击下载"><span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span>下载(CSV)</button>';
                    link += '</span></td></tr>';
                    $("#table_files").find("tbody").append(link);
                    // 如果支持多线程则自动点击下载
                    if(worker_enable){
                        // $('button[data-report_id="' + id + '"]').click();
                    }
                }
            }
            // 获取行头
            function col_head_init(result){
                if(col_head == null){
                    col_head = {
                        cell_count: 0,
                        rows: []
                    };
                    for (var i = 0; i < result.rows.length; i++) {
                        var cells = [];
                        var end = false;
                        for (var j = 0; j < result.rows[i].length; j++) {
                            cell = result.rows[i][j];
                            if (cell.type != "data") {
                                cells.push({
                                    id: cell.id,
                                    type: cell.type,
                                    innerText: cell.value === null ? '' : cell.value,
                                    colSpan: cell.col_span,
                                    rowSpan: cell.row_span
                                });
                                col_head.cell_count++;
                            }else{
                                end = true;
                                break;
                            }
                        }
                        if(cells.length > 0){
                            col_head.rows.push(cells);
                        }
                        if(end){
                            break;
                        }
                    }
                }
            }
            function report_init(report_id){
                var table_id = "#report_" + report_id;
                // 初始化表数据
                if(tables == null || !tables[table_id]){
                    tables = tables == null ? [] : tables;
                    tables[table_id] = {
                        // 单元格数量
                        cell_count: 0,
                        // 列头所占的行数
                        col_head_row_count: 0,
                        // 行数据
                        rows: []
                    };
                    if(col_head != null){
                        tables[table_id].cell_count = col_head.cell_count;
                        for(var i = 0; i < col_head.rows.length; i++){
                            tables[table_id].rows.push({
                                cells: col_head.rows[i]
                            });
                        }
                        tables[table_id].col_head_row_count = col_head.rows.length;
                    }
                }
                // 创建表
                if ($(table_id).size() == 0) {
                    $("#container").append('<h2>#' + report_id + '</h2><table id="report_' + report_id + '" border="1"><tbody></tbody></table>');
                }
                return table_id;
            }
            // 加载报表
            function load(cur_page) {
                $.get(url, {
                    page : {
                        cur_page : cur_page,
                        page_size : page_size
                    }
                }, function(result) {
                    if(result.code != 0){
                        $.msg(result.message, {
                            time: 5000
                        });
                        return;
                    }
                    if(result.page.record_count == 0){
                        result.page.page_count = 1;
                        $.msg("没有搜到任何符合条件的记录！");
                    }
                    // 标题
                    report_title = result.title;
                    // 进度显示
                    $(".panel-heading").html("正在下载 - " + report_title + " - [" + result.page.cur_page + "/" + result.page.page_count + "]");
                    // 进度条
                    var progress = (result.page.cur_page / result.page.page_count * 100).toFixed(2);
                    $("#ajax_process").find(".progress-bar").attr("aria-valuenow", progress).width(progress + "%").html(progress + "%");
                    // 报表是否变更
                    var report_change = false;
                    var table_id;
                    // 初始化
                    if(tables == null){
                        // 获取行头
                        col_head_init(result);
                        table_id = report_init(report_id);
                    }else{
                        table_id = "#report_" + report_id;
                    }
                    // 达到一定行数则自动分文件
                    if(cur_page % page_group == 0){
                        createDownloadInfo(report_id);
                        report_id ++;
                        // 初始化
                        table_id = report_init(report_id);
                    }
                    for (var i = 0; i < result.rows.length; i++) {
                        var cells = [];
                        var html = "";
                        for (var j = 0; j < result.rows[i].length; j++) {
                            var cell = result.rows[i][j];
                            // 跳过行头
                            if (cell.type != "data") {
                                continue;
                            }
                            if(worker_enable){
                                cells.push({
                                    id: cell.id,
                                    type: cell.type,
                                    innerText: cell.value === null ? '' : cell.value,
                                    colSpan: cell.col_span,
                                    rowSpan: cell.row_span
                                });
                                // 累计单元格数量
                                tables[table_id].cell_count ++;
                            }else{
                                html += '<td data-row="' + (i+1) + '"';
                                if(cell.col_span > 1){
                                    html += ' colspan="' + cell.col_span + '"';
                                }
                                if(cell.row_span > 1){
                                    html += ' rowspan="' + cell.row_span + '"';
                                }
                                html += '>';
                                html += cell.value === null ? '' : cell.value;
                                html += '</td>';
                            }
                        }
                        if(worker_enable){
                            if(cells.length > 0){
                                tables[table_id].rows.push({
                                    cells: cells
                                });
                            }
                        }else{
                            if (html != "") {
                                html = "<tr>" + html + "</tr>";
                                $(table_id).find("tbody").append(html);
                            }
                        }
                    }
                    if (result.page.cur_page < result.page.page_count) {
                        // 间隔1秒后发送请求，避免给服务器造成过大压力
                        setTimeout(function(){
                            // 加载下一页
                            load(result.page.cur_page + 1);
                        }, 1000);
                    }else {
                        // 创建下载信息
                        createDownloadInfo(report_id);
                        // 移除进度条的动画效果
                        $("#ajax_process").find(".progress-bar").removeClass("progress-bar-striped").removeClass("active").addClass("progress-bar-success");
                    }
                }, "JSON").fail(function(error){
                    console.log(error);
                    console.log("重新加载...");
                    load(cur_page);
                });
            }
            $.loading.start();
            // 加载第一页
            load(1);
            $("body").on("click", ".download", function() {
                var target = this;
                var td = $(this).parents("td");
                var id = $(this).data("report_id");
                var filename = report_title + "_" + new Date().format("yyyyMMdd") + "_" + id + ".xlsx";
                var ext = "xlsx";
                if($(td).find(".progress-bar").length > 0){
                    var progress = $(td).find(".progress-bar").attr("aria-valuenow");
                    if(progress < 100){
                        $.msg("正在下载中，请稍等...");
                        return;
                    }
                }
                // 移除
                $(td).find(".progress-bar").parents("span").remove();
                // 生成进度条
                var progressBar = $('<span style="margin-top: 1px;"><div class="progress m-b-0 w200" style="background-color: #ddd;"><div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div></div></span>');
                // 显示下载进度
                $(this).parents("span").after(progressBar);
                progressBar = $(progressBar).find(".progress-bar");
                // 放入iframe中 - css样式会影响导出的表格
                var ibody = $($("#report").get(0).contentDocument).find("body");
                // 如果iframe中不存在次表格则获取放入其中
                if($(ibody).find("#report_" + id).size() == 0){
                    $(ibody).append($("#report_" + id).prop('outerHTML'));
                }
                // 如果支持线程则启用线程
                if(worker_enable){
                    var table = tables["#report_" + id];
                    if(table.blob){
                        // 直接下载
                        saveAs(table.blob, filename);
                        // 进度条
                        $(progressBar).attr("aria-valuenow", 100).width("100%").html("100%");
                        // 进度条颜色
                        $(progressBar).removeClass("progress-bar-striped").removeClass("active").addClass("progress-bar-success");
                        // 移除按钮颜色
                        $(target).removeClass("btn-primary").addClass("btn-success");
                        return;
                    }
                    var blob = new Blob([$('#worker').html()]);
                    var url = window.URL.createObjectURL(blob);
                    var worker = new Worker(url);
                    worker.postMessage({
                        scripts: [
                            "/js/exceljs.min.js",
                            "/js/table2excel.core.js",
                        ],
                        table: table
                    });
                    worker.onmessage = function(object){
                        var progress = (object.data.index / table.cell_count * 100).toFixed(2);
                        $(progressBar).attr("aria-valuenow", progress).width(progress + "%").html(progress + "%");
                        if(object.data.end){
                            // 记录数据方便二次下载
                            table.blob = object.data.data;
                            // 保存
                            saveAs(object.data.data, filename);
                            // 进度条颜色
                            $(progressBar).removeClass("progress-bar-striped").removeClass("active").addClass("progress-bar-success");
                            // 移除按钮颜色
                            $(target).removeClass("btn-primary").addClass("btn-success");
                            // 关闭线程
                            worker.terminate();
                        }
                    }
                    worker.onerror = function(e){
                        console.log([
                            'ERROR: Line ' + e.lineno + ' in ' + e.filename, ': ' + e.message
                        ].join(''));
                        // 关闭线程
                        worker.terminate();
                    }
                    return;
                }
                // 不支持线程则使用原始方式
                $.loading.start();
                var count = $("#report_" + id).find("td").length;
                // 延时下载
                setTimeout(function(){
                    var i = 0;
                    // 进度
                    setInterval(function(){
                        var progress = (i / count * 100).toFixed(2);
                        $(progressBar).attr("aria-valuenow", progress).width(progress + "%").html(progress + "%");
                    }, 100);
                    // 导出表格
                    var table2Excel = new Table2Excel($(ibody).find("#report_" + id), {
                        plugins: [{
                            workcellCreated: function (data) {
                                // 累计
                                i++;
                                // 赋值
                                data.workcell.value = $.trim($(data.cell).html());
                            }
                        }]
                    });
                    // 导出
                    table2Excel.export(function(data){
                        // 保存
                        saveAs(data, filename);
                        // 移除按钮颜色
                        $(target).removeClass("btn-primary").addClass("btn-success");
                        // 移除表格，减少内存
                        $(ibody).find("#report_" + id).remove();
                        // 停止加载
                        $.loading.stop();
                    }, ext);
                }, 200);
            });
            $("body").on("click", ".csv-download", function() {
                var target = this;
                var td = $(this).parents("td");
                var id = $(this).data("report_id");
                var filename = report_title + "_" + new Date().format("yyyyMMdd") + "_" + id;
                var ext = "csv";
                // 放入iframe中 - css样式会影响导出的表格
                var ibody = $($("#report").get(0).contentDocument).find("body");
                // 如果iframe中不存在次表格则获取放入其中
                if($(ibody).find("#report_" + id).size() == 0){
                    $(ibody).append($("#report_" + id).prop('outerHTML'));
                }
                $.loading.start();
                var table = tables["#report_" + id];
                var rows = table.rows;
                var title = [];
                var key = [];
                var data = [];
                for (var i = 0; i < rows.length; i++) {
                    var cells = rows[i].cells;
                    var record = [];
                    for (var j = 0; j < cells.length; j++) {
                        var id = cells[j].id;
                        var innerText = cells[j].innerText;
                        if (i == 0) {
                            key[j] = id;
                            title[j] = innerText;
                        } else {
                            id = id.split(":")[1];
                            record[id] = innerText;
                        }
                    }
                    if (i > 0) {
                        data.push(record);
                    }
                }
                // console.log(data);
                // 字符型关键词
                var textKeys = ['sn', 'barcode', 'code', 'mobile', 'tel', 'card_number','serial_number'];
                JSonToCSV.setDataConver({
                    data: data,
                    fileName: filename,
                    columns: {
                        title: title,
                        key: key,
                        formatter: function(n, v) {
                            return v;
                        },
                        append: function (row, k, v) {
                            var showText = false;
                            if (typeof v === 'string') {
                                // 包含逗号则忽略
                                if (v.indexOf(",") !== -1) {
                                    showText = false;
                                } else {
                                    for (var i = 0; i < textKeys.length; i++) {
                                        if (k.indexOf(textKeys[i]) !== -1) {
                                            showText = true;
                                            break;
                                        }
                                    }
                                }
                            }
                            if(showText) {
                                row += '="' + v + '",';
                            }else{
                                row += '"' + v + '",';
                            }
                            return row;
                        }
                    }
                });
                $.loading.stop();
                return;
            });
        });
        // 
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop