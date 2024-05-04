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


    <div class="common-title">

        <div class="operate m-l-20">

            <a class="reload" href="javascript:reload();" data-toggle="tooltip" data-placement="auto bottom" title="" data-original-title="刷新数据">
                <i class="fa fa-refresh"></i>
            </a>
            <script type="text/javascript">
                function reload() {

                }
            </script>



        </div>
    </div>

    <!--列表内容-->
    <div class="table-responsive">

        <table id="table_list" class="table table-hover">
            <thead>
            <tr>
                <th class="text-c w200" style="cursor: default;">当前版本</th>
                <th class="text-c w200" style="cursor: default;">更新日期</th>
                <th class="text-c w200" style="cursor: default;">最新版本</th>
            </tr>
            </thead>
            <tbody>

            <tr>
                <td class="text-c">{{ $current_version }}</td>
                <td class="text-c">{{ $lrw_release }}</td>
                <td class="text-c">{{ $last_version }}</td>
            </tr>

            </tbody>
        </table>
        @if(!empty($patch))
        <table id="table_list" class="table table-hover">
            <thead>
            <tr>
                <th class="text-c" style="cursor: default;">待升级版本</th>
            </tr>
            </thead>
            <tbody>
            @foreach($patch as $item)
            <tr>
                <td class="text-c">{{ $item }}</td>
            </tr>
            @endforeach

            </tbody>
        </table>

        <form method="post" id="UpgradeModel" name="UpgradeModel" action="/upgrade?act=init">
            <div style="text-align:center; padding: 24px 0;">
                <input name="UpgradeModel[cover]" id="cover" type="checkbox" value="1">
                <label for="cover"><font color="red">升级版本会覆盖老版本代码，请确认是否升级？</font></label>
            </div>

            <div class="text-c">
                <input type="button" id="btn_submit" value="开始升级" class="btn btn-danger"  />
            </div>
        </form>

        @endif
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
{{--    <script src="/assets/d2eace91/js/jquery.widget.js?v=1.2"></script>--}}
    <script type="text/javascript">
        $().ready(function() {
            // var validator = $("#UpgradeModel").validate();
            // // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            // $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                var checkbox = document.getElementById('cover');
                if(checkbox.checked == false){
                    alert('升级版本会覆盖老版本代码，请确认是否升级？');
                    return false;
                }

                // if (!validator.form()) {
                //     return;
                // }
                //加载提示
                $.loading.start();
                var data = $("#UpgradeModel").serializeJson();

                var url = $("#UpgradeModel").attr("action");
                $.post(url, data, function(result) {
                    if (result.code == 0) {
                        $.msg(result.message, {
                            time: 3000
                        });
                        $.go("/upgrade");
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "JSON").always(function() {
                    $.loading.stop();
                });

                return false;
            });
        })

    </script>

@stop

{{--outside body script--}}
@section('outside_body_script')

@stop