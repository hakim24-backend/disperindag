var baseUrl = "http://disperindag.jatimprov.go.id/";
var path = "backend/web/plugins/";

function elFinderBrowser (field_name, url, type, win) {
  tinymce.activeEditor.windowManager.open({
    file: baseUrl+path+"wysiwyg/elfinder/elfinder.html",
    title: "File Image Manager (PNG/JPEG)",
    width: 960,  
    height: 450,
    resizable: "yes"
  }, {
    setUrl: function (url) {
      win.document.getElementById(field_name).value = url;
    }
  });
  return false;
}

tinymce.init({
    selector: ".tinymce",
    width: 815,
    plugin_preview_width : 843, 
    theme: "modern",
    menubar : true,
    menubar : "file edit insert view table",
    content_css : baseUrl+path+"wysiwyg/tinymce/custom2.css",
    plugins: [
         "advlist autolink link image lists charmap print preview hr media",
         "searchreplace wordcount visualblocks visualchars fullscreen",
         "save table contextmenu paste textcolor colorpicker",
   ],
   contextmenu: "link image inserttable | cell row column deletetable",
   toolbar: "undo redo | fontsizeselect | bold italic underline superscript subscript removeformat | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview fullpage | forecolor  backcolor", 
   file_browser_callback : elFinderBrowser,
 });

$(".wysiwyg").wysihtml5();