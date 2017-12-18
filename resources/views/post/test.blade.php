<form action="/posts" method="POST">
    <div id="div1" >
    <p>欢迎使用 <b>wangEditor</b> 富文本编辑器</p>
</div>

    {{csrf_field()}}
<textarea id="title" name="title" style="width:100%; height:200px;" style="display:none;"></textarea>
    <input type="submit">
</form>
<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="/js/wangEditor.min.js"></script>
<script type="text/javascript">
    var E = window.wangEditor
    var editor = new E('#div1')
    var $text1 = $('#title')
    editor.customConfig.onchange = function (html) {
        // 监控变化，同步更新到 textarea
        $text1.val(html)
    }
    editor.create()
    // 初始化 textarea 的值
    $text1.val(editor.txt.html())
</script>