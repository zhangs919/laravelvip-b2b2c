<link href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css?v=2.1" rel="stylesheet"><!-- ================== BEGIN BASE  ================== -->
<!-- ================== END BASE  ================== -->
<div id="{{ $uuid }}" class="p-20">
    <div class="table-content m-t-10">
        <!-- 搜索 -->
        <form id="GoodsModel" class="form-horizontal" name="GoodsModel" action="/goods/list/set-regular-time-sale?ids={{ $goods_ids }}" method="POST">
            @csrf
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="goodsmodel-goods_price" class="col-sm-3 control-label w100">
                        <span class="ng-binding">定时出售：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">
                            <input type="text" id="start_time" class="form-control form_datetime large" name="start_time" value="{{ format_time(time()) }}" autocomplete="off">
                        </div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field " id="sale_time_quantum">
                <div class="form-group">
                    <label for="goodsmodel-goods_price" class="col-sm-3 control-label w100">
                        <span class="ng-binding">重复周期：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box m-r-0" style="width: 660px">
                            <div id="cycle_picker_container"></div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" id="ids" name="ids" value="72176,72174" />
        </form>        <div class="modal-footer text-c">
            <button id="btn_next_step" class="btn btn-primary">确认提交</button>
        </div>
    </div>
</div>
<script type="text/javascript">
    // 
</script><script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js?v=2.1"></script>
<script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=2.1"></script>
<script>

    //点击下一步
    $().ready(function() {

// 日期
        $('.form_datetime').datetimepicker({
            language: 'zh-CN',
            weekStart: 1,
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            forceParse: 0,
            showMeridian: 1,
            format: 'yyyy-mm-dd hh:ii:ss',
        }).on('changeDate', function(ev) {
            $(this).trigger("blur");
        });

        var time_points = "10:00,15:00,20:00,22:00".split(",");

        time_points = time_points.map(function (item) {
            item = item.split(":");
            return {
                hour: parseInt(item[0]),
                minute: parseInt(item[1]),
            };
        }, time_points);

        var cycle_data = JSON.parse('null');

        var cs_time_point = "";
// 周期循环组件
        var cyclePicker = $("#cycle_picker_container").cyclePicker({
            value: cycle_data,
            minuteStep: 1,
            daySize: 0,
            weekSize: 5,
            monthSize: 0,
            show_text: '时间不限',
// 支持的类型回调函数
            typeCallback: function(value) {
                return true;
            },
// 开始时间以时间点为准
            hourCallback: function (value, type, is_begin) {
                return true;
            },
// 开始时间以时间点为准
            minuteCallback: function (value, type, is_begin) {
                return true;
            },
            change: function() {
// 值发生改变后进行校验
                this.validate();
            }
        });

        $("#{{ $uuid }}").find("#btn_next_step").click(function() {
            var data = $("#GoodsModel").serializeJson();
            data.cycle_data = cyclePicker.getValue();
            $.post('/goods/list/set-regular-time-sale', data, function(result) {
                if (result.code == 0) {
// 关闭对话框
                    $.closeAll();
//$("#{{ $uuid }}").parents(".modal").find(".close").click();
// 显示信息
                    $.msg(result.message, {
                        time: 1500
                    }, function() {
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
            }, "json");
        })
    });

    // 
</script>