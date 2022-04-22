<div id="{{ $page_id }}">
    <!-- 温馨提示 -->
    {{--explain_panel--}}
    @include('layouts.partials.explain_panel')

    <table id="addArticleTable" class="table table-hover">
        <thead>
        <tr>
            <th>文章标题</th>
            <th class="text-c">排序</th>
            <th class="handle">操作</th>
        </tr>
        </thead>
        <tbody>
            @if(!empty($selector_data))
                @foreach($selector_data as $v)
                    <tr>
                        <td>
                            <input type="hidden" name="article_id" value="{{ $v['article_id'] }}">
                            {{ $v['title'] }}
                        </td>
                        <td class="text-c">
                            <input class="form-control small" type="text" value="{{ $v['sort'] }}" name="sort">
                        </td>
                        <td class="handle">
                            <a class="del article-del" data-article_id="{{ $v['article_id'] }}" href="javascript:void(0);">删除</a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    <!-- 文章容器 -->
    <div class="article-container"></div>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="ok" data-dismiss="modal">确定</button>
    </div>



</div>

<script type="text/javascript">
    function get_selected(){
        var ids = [];
        $('#{{ $page_id }}').find("input[name='article_id']").each(function(i,v){
            ids.push($(this).val());
        });
        return ids.join(',');
    }
</script>

<script type="text/javascript">
    $().ready(function() {

        var lastUuid = 0;

        var uuid = function() {
            return (new Date()).getTime() * 1000 + (lastUuid++) % 1000;
        }

        var type = '{{ $data['type'] }}';
        var cat_id = '{{ $data['cat_id'] }}';
        var uid = '{{ $data['uid'] }}';
        var max_number = '{{ $data['number'] }}';
        var select_count = '{{ count($selector_data) }}';
        $("#{{ $page_id }}").find("#ok").click(function() {
            chk_value = [];
            $("#{{ $page_id }}").find('#addArticleTable tbody tr').each(function(i, v) {
                chk_value.push({
                    article_id: $(this).find('td input[name="article_id"]').val(),
                    sort: $(this).find('td input[name="sort"]').val() == '' ? '255' : $(this).find('td input[name="sort"]').val()
                });
            });
            if (chk_value.length == 0) {
                $.msg("请选择文章");
                return false;
            }
            //上传数据
            $.designadddata({
                data: {
                    uid: uid,
                    chk_value: chk_value,
                    type: type,
                    cat_id: cat_id
                },
            });
        });

        //文章列表
        var container = $("#{{ $page_id }}").find(".article-container");
        var page_id = "#ArticlePickerPage_{{ $page_id }}";
        $.ajax({
            url: '/article/article/picker',
            dataType: 'json',
            data: {
                cat_type : '',
                page: {
                    page_id: page_id,
                    page_size: 10,
                },
                selected_ids : get_selected(),
                output: 1
            },
            beforeSend: function() {
                $.loading.start();
            },
            success: function(result) {
                container.html(result.data);
                $.loading.stop();
            }
        });

        container.on('click', '.select-article', function() {
            var article_id = $(this).data('article_id');
            var title = $(this).data('title');
            if (parseInt(max_number) > 0 && parseInt(select_count) >= parseInt(max_number)) {
                $.msg("最多可以添加" + max_number + "个文章");
            } else {
                if (!is_exist(article_id)) {
                    select_count++;
                    var td_name = "<td><input type='hidden' name='article_id' value='"+article_id+"'>" + title + "</td>";
                    var td_sort = "<td class='text-c'><input class='form-control small' type='text' value='"+select_count+"' name='sort'></td>";
                    var td_hand = "<td class='handle'><a class='del article-del' data-article_id='"+article_id+"' href='javascript:;'>删除</a></td>";
                    var tr = "<tr>" + td_name + td_sort + td_hand + "</tr>";
                    $("#{{ $page_id }}").find("#addArticleTable").append(tr);
                    tablelist.params.selected_ids = get_selected();
                    $(this).parent().find('a').addClass('active').html('已选');
                } else {
                    $.msg("您已经选择了此文章");
                }
            }
        });

        $("#{{ $page_id }}").on("click", ".article-del", function() {
            $(this).parent().parent().remove();
            tablelist.params.selected_ids = get_selected();
            $('#{{ $page_id }}').find('#handle_'+$(this).data('article_id')).find('a').removeClass('active').html('选择');
            select_count--;
        });

        $("#{{ $page_id }}").find("input[name='sort']").keyup(function() {
            var tmptxt = $(this).val();
            $(this).val(tmptxt.replace(/\D|^0/g, ''));
        }).bind("paste", function() {
            var tmptxt = $(this).val();
            $(this).val(tmptxt.replace(/\D|^0/g, ''));
        }).css("ime-mode", "disabled");
    });
</script>

<!-- 验证是否存在 -->
<script type="text/javascript">
    function is_exist(id) {
        var judge = false;
        $("#{{ $page_id }}").find('#addArticleTable tbody tr').each(function(i, v) {
            if ($(this).find('td input[name="article_id"]').val() == id) {
                judge = true;
            }
        });
        return judge;
    }
</script>