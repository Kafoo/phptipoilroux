// $('#trumbowyg-demo').trumbowyg();

  tinymce.init({
    selector: '#mytextarea',
    content_css : "style/tinymce.css",
    height: 300,
    menubar: false,
    forced_root_block : "",
    statusbar : false,
    toolbar: 'undo redo | bold italic | link image code forecolor backcolor preview',
    plugins: 'code image textcolor preview'
  });


