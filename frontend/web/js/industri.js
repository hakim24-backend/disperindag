$(document).ready(function(){

  $('.teaser').click(function(){
    data_id = $(this).parents('td').parents('tr').find('#val_id').html();
    data_kode = $(this).parents('td').parents('tr').find('#val_kode').html();
    data_val = $(this).parents('td').parents('tr').find('#val_nama').html();
    $('#modal').modal('hide');
    $('#txt_kbli').val(data_kode + '-' +data_val);
    $('#txt_kbli_val').val(data_kode);
   
    var jenis_industri = data_val.split(" ");
    var komoditi = data_kode.substr(0,2) + '-' + jenis_industri[0] + " " + jenis_industri[1];
    console.log(komoditi);
    $('#industri-komoditi').val(komoditi);
  });

  $('#txt_kbli').click(function(){
    $('#modal').modal('show');
  });
  $('.kbli').DataTable({
      "columnDefs": [{
        "orderable": false,
        "targets": -1
      }],
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
