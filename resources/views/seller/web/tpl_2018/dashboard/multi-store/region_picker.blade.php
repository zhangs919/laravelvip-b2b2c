<div id="{{ $uuid }}" class="SZY-UUID modal-body">
    <div class="table-content clearfix">
        <div class="alert alert-info br-0">双击地区名称可进行地区选择！</div>
        <div class="selector-set region-selected">

        </div>
        <div class="region-picker-list-box region-picker-container"></div>
    </div>
</div>
<script type="text/javascript">
    $().ready(function() {
        var container = $("#{{ $uuid }}");

        $("body").on("click", "#{{ $uuid }} .region-selected a i", function() {
            $(this).parents("a").remove();
        });

        $(container).find(".region-selected").html("");

        for ( var value in region_codes_now) {
            var name = region_codes_now[value];

            var clazz = "region-code-" + value.split(",").join("-");
            if ($(container).find(".region-selected").find("." + clazz).size() == 0) {
                var region_codes = region_codes_not;
                if (region_codes[value]) {
                    $.msg("在其他地区运费设置中已经被选择！");
                    return;
                }
                var element = $("<a href='javascript:void(0);' class='ss-item'>" + name + "<i title='移除'>×</i></a>");
                $(element).data("region-code", value);
                $(element).data("region-name", name);
                $(element).addClass(clazz);
                $(container).find(".region-selected").append(element);
            }
        }

// 初始化地区选择器
        var regionpicker = $("#{{ $uuid }}").find(".region-picker-container").regionpicker({
            sale_scope: true,
            select_class: 'form-control',
            change: function(value, names, is_last) {

            },
// 双击选择
            dblclick: function(option, names) {
                var value = $(option).val();

                if (value == '') {
                    return;
                }

                var is_exist = false;

// 合并子地区
                $(container).find(".region-selected").find("a").each(function() {
                    var region_code = $(this).data("region-code");

                    if (region_code == value) {
                        is_exist = true;
                    } else if (region_code.indexOf(value) == 0) {
                        $(this).remove();
                    } else if(value.indexOf(region_code) == 0){
                        is_exist = true;
                        $.msg(names[names.length - 1] +　"所属上级地区已被选择，无需再选！", {
                            time: 2000
                        });
                    }
                });

                if (is_exist) {
                    return;
                }

                var region_codes = region_codes_not;
                if (region_codes[value]) {
                    $.msg("在其他地区运费设置中已经被选择！", {
                        time: 2000
                    });
                    return;
                }

                var name = $(option).html();
                var element = $("<a href='javascript:void(0);' class='ss-item'>" + name + "<i title='移除'>×</i></a>");
                $(element).data("region-code", value);
                $(element).data("region-name", name);
                $(container).find(".region-selected").append(element);
            },
            option_callback: function(option) {
                var region_codes = region_codes_not;
                var value = $(option).val();
                if (value != '' && region_codes[value]) {
                    $(option).css("color", "#CDCDCD");
                }
            }
        });
    });
</script>

<style type="text/css">
    .modal-footer {
        margin: 0;
    }
</style>