<script src="tinymce/js/tinymce.min.js"></script>

<script type="text/javascript">
  function elFinderBrowser (field_name, url, type, win) {
  tinymce.activeEditor.windowManager.open({
    file: 'elfinder/elfinder.html',// use an absolute path!
    title: 'File Manager',
    width: 960,  
    height: 450,
    resizable: 'yes'
  }, {
    setUrl: function (url) {
      win.document.getElementById(field_name).value = url;
    }
  });
  return false;
}
</script>
