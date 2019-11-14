$(document).ready(function(){
  $('#form-bukutamu').show();
  $('#form-pendaftaranindustri').hide();

  $("input[name='drop_jenis']").on('change', function() {
    var jenis = $(this).val();
    if(jenis == 0){
      $('#form-bukutamu').show();
      $('#form-pendaftaranindustri').hide();
      $('#form-daftar').hide();
    }else{
        $('#form-bukutamu').hide();
        $('#form-pendaftaranindustri').show();
        $('#form-daftar').hide();
    }
  });

  $('#data_missing').on('change',function(){
    alert(hai);
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
          // swal({
          //   title: "Data Tidak Ditemukan",
          //   text: "Perusahaan anda tidak terdaftar, silahkan daftarkan perusahaan anda dengan memilih tombol daftar dibawah ini",
          //   icon: "error",
          //   button: "Daftar",
          // });
          swal({
            title: "Data Tidak Ditemukan",
            text: "Perusahaan anda tidak terdaftar, silahkan daftarkan perusahaan anda dengan memilih tombol daftar dibawah ini",
            icon: "error",
            buttons: ["Batal","Daftar"],
          })
          .then((daftar) => {
            if (daftar) {
              perusahaanBack();
            } else {
              //noaction
            }
          });
        }
        else{
          $('#val_npwp').html(data.npwp);
          $('#val_nama_perusahaan').html(data.nama_perusahaan)
          $('#data-missing').html('');
        }
      });
    }
  });
});


function showDaftarPerusahaan(){
    $("#bukutamu").hide();
    $("#form-daftar").show();

}
