<!-- AJAX上传+图片预览 -->
<script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=1.2"></script>
<script src="/assets/d2eace91/js/pic/imgPreview.js?v=1.2"></script>
<script src="/assets/d2eace91/js/jquery.widget.js?v=1.2"></script>
<script src="/assets/d2eace91/js/editor/kindeditor-all.min.js?v=1.2"></script>
<script src="/assets/d2eace91/js/editor/lang/zh_CN.js?v=1.2"></script>
<div id="{{ $page_id }}" class="modal-body" style="padding-bottom:70px;">
    <!-- 温馨提示 -->
    <form class="form-horizontal">
        <div class="form-control-box">
            <!-- 文本编辑器 -->

            <textarea id="content_{{ $page_id }}">
                {!! $selector_data[0]['content'] ?? '' !!}
            </textarea>


        </div>
        <div class="modal-footer" style="padding:12px;">
            <button type="button" class="btn btn-primary" id="ok" data-dismiss="modal">确定</button>
        </div>
    </form>
</div>
<script type="text/javascript">
    var editor = KindEditor.create('#content_{{ $page_id }}', {
        items: ['source', '|', 'fullscreen', 'undo', 'redo', 'print', 'cut', 'copy', 'paste', 'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright', 'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript', 'superscript', '|', 'selectall', 'clearhtml', 'quickformat', '|', 'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'flash', 'media', 'table', 'hr', 'emoticons', 'link', 'unlink', '|', 'about'],
        cssPath: "/assets/d2eace91/js/editor/themes/default/default.css",
        uploadJson: "/site/upload-image",
        resizeType: 1,
        width: '760px',
        height: '350px',
        filterMode: true,
        allowImageUpload: true,
        allowFlashUpload: false,
        allowMediaUpload: false,
        allowFileManager: true,
        syncType: "form",
        afterCreate: function() {
            var self = this;
            self.sync();
        },
        afterChange: function() {
            var self = this;
            self.sync();
        },
        afterBlur: function() {
            var self = this;
            self.sync();
        }
    });
</script>

<script type="text/javascript">
    $().ready(function() {
        var type = '{{ $data['type'] }}';
        var cat_id = '{{ $data['cat_id'] }}';
        var uid = '{{ $data['uid'] }}';

        $("#{{ $page_id }}").find("#ok").click(function() {
            if ($('.ke-outline[title="HTML代码"]').hasClass('ke-selected')) {
                $('.ke-outline[title="HTML代码"]').click();
            }
            var content = $('#content_{{ $page_id }}').val();
            chk_value = [];
            chk_value.push({
                content: content
            });
//上传数据
            $.designadddata({
                data: {
                    uid: uid,
                    chk_value: chk_value,
                    type: type,
                    cat_id: cat_id,
                },
                callback: function(result) {
                    var index = $('#' + result.uid).parents().find('.layui-layer-page').attr('times');
                    layer.close(index);
                }
            });
        });

    });
</script>