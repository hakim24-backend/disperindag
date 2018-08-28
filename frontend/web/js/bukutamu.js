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


  $('#txt_search_npwp').keypress(function(e){
    if (e.which == 13) {
      $.ajax({
          url : "../interaktif/searchnpwp?query="+$(this).val(),
          dataType : "json",
          type : "post"
      }).done(function(data){
        if (!$.trim(data)){
          $('#val_npwp').html('-');
          $('#val_nama_perusahaan').html('-');
        }
        else{
          $('#val_npwp').html(data.npwp);
          $('#val_nama_perusahaan').html(data.nama_perusahaan)
        }
      });
    }
  });
});


function showDaftarPerusahaan(){
    $("#bukutamu").hide();
    $("#form-daftar").show();

}
