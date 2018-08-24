$(document).ready(function(){
  $('#form-bukutamu').show();
  $('#form-pendaftaranindustri').hide();

  $('#drop_jenis').change(function(){
    var jenis = $('#drop_jenis').val();
    if(jenis == 0){
      $('#form-bukutamu').show();
      $('#form-pendaftaranindustri').hide();
    }else{
      $('#form-bukutamu').hide();
      $('#form-pendaftaranindustri').show();
    }
  });
});
