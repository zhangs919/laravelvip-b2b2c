<div id="{{ $uuid }}">

    <div class="search-term m-b-10">
        <form id="backSearchForm" action="/site/tpl-backup" method="GET">
            <input type="hidden" name="action" value="list">
            <input type="hidden" name="output" value="{{ $output }}">
            <input type="hidden" name="design_page" value="{{ $design_page }}">
            <input type="hidden" name="search_id" value="0">
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>名称：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input name="name" class="form-control" type="text" placeholder="">
                    </div>
                </div>
            </div>



            <div class="simple-form-field">
                <input type="submit" class="btn btn-primary m-r-5" value="搜索" />
            </div>
            <input type="hidden" name="output" value="0">
        </form>
    </div>

    {{--引入列表--}}
    @include('site.partials._tpl_backup_list')

</div>
<script src="/assets/d2eace91/js/common.js?v=20180418"></script>

<script type="text/javascript">
    var tablelist = null;
    // 防止出错
    if (typeof (topic_id) == 'undefined') {
        var topic_id = 0;
    }

    $().ready(function() {
        tablelist = $("#{{ $uuid }}").find("#table_list").tablelist({
            url: '/site/tpl-backup',
            params: $("#backSearchForm").serializeJson()
// 支持保存查询条件
        });

// 搜索
        $('#{{ $uuid }}').find("#backSearchForm").submit(function() {
// 序列化表单为JSON对象
            var data = $(this).serializeJson();
            data.page = {
                cur_page: 1
            };
            data.output = 0;
// Ajax加载数据
            tablelist.load(data);
// 阻止表单提交
            return false;
        });

        $('#{{ $uuid }}').on('click', '.TPL-DEL', function() {
            var id = $(this).data("id");
            tablelist.remove({
                url: '/site/tpl-backup',
                confirm: '您确定删除这条记录吗？',
                data: {
                    action: 'delete',
                    id: id
                },
            });
        });

        $('#{{ $uuid }}').on('click', '.TPL-USE', function() {
            var id = $(this).data("id");
            $.confirm("确定替换当前模板吗？ 注意：此操作不可恢复！", function() {
                $.loading.start();
                $.ajax({
                    url: '/site/tpl-backup',
                    dataType: 'json',
                    data: {
                        action: 'usetpl',
                        id: id,
                        topic_id: topic_id
                    },
                    success: function(result) {
                        var modal = $.modal($("#{{ $uuid }}"));
                        if (modal) {
                            modal.hide();
//refreshTpl(page);
                            $.loading.stop();
                            $.msg(result.message);
                            window.location.reload();
                        }
                    }
                });
            });

        });
    });
</script>

<style>
    .modal-body .form-horizontal .form-group .form-control-box {
        line-height: 20px;
    }

    .table tbody tr td.no-data {
        padding: 4px 8px;
    }

    .no-data .fa-exclamation-circle {
        width: auto;
        height: auto;
        background: none;
    }
</style>