$(document).ready(function(){

  $('.teaser').click(function(){
    data_kode = $(this).parents('td').parents('tr').find('#val_id').html();
    data_val = $(this).parents('td').parents('tr').find('#val_nama').html();
    $('#modal').modal('hide');
    $('#txt_kbli').val(data_val);
    $('#txt_kbli_val').val(data_kode);
  });

  $('#txt_kbli').click(function(){
    $('#modal').modal('show');
  });

  $('#txt_search_npwp').keypress(function(e){
    if (e.which == 13) {
      // alert($(this).val());
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
