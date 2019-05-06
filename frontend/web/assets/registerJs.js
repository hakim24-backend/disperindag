function showBukuTamu(){
    var form0 = document.getElementById("form-0");
    var form1 = document.getElementById("form-1");
    var form2 = document.getElementById("form-2");
    var form3 = document.getElementById("form-3");
    var list = document.getElementById("btn-list");
    var formdaftar = document.getElementById("form-daftar");

    if (form1.style.display === "none" && form2.style.display === "none" && form3.style.display=== "none") {
        form0.style.display = "none";
        form1.style.display = "none";
        form2.style.display = "none";
        form3.style.display = "none";
        list.style.display = "none";
        formdaftar.style.display = "block";

    } else {
        form0.style.display = "none";
        form1.style.display = "block";
        form2.style.display = "none";
        form3.style.display = "none";
        list.style.display = "none";
    }
}

function bukuTamuBack(){
    var form0 = document.getElementById("form-0");
    var form1 = document.getElementById("form-1");
    var form2 = document.getElementById("form-2");
    var form3 = document.getElementById("form-3");
    var list = document.getElementById("btn-list");
    var formdaftar = document.getElementById("form-daftar");

    if (form1.style.display === "none" && form2.style.display === "none" && form3.style.display=== "none") {
        form0.style.display = "block";
        form1.style.display = "none";
        form2.style.display = "none";
        form3.style.display = "none";
        list.style.display = "block";
        formdaftar.style.display = "none";

    } else {
        form0.style.display = "none";
        form1.style.display = "none";
        form2.style.display = "none";
        form3.style.display = "none";
        list.style.display = "none";
        formdaftar.style.display = "block";    }
}

function myFunctionNext0() {
    var form0 = document.getElementById("form-0");
    var form1 = document.getElementById("form-1");
    var form2 = document.getElementById("form-2");
    var form3 = document.getElementById("form-3");
    var list = document.getElementById("btn-list");

    if (form1.style.display === "none" && form2.style.display === "none" && form3.style.display=== "none") {
        form0.style.display = "none";
        form1.style.display = "block";
        form2.style.display = "none";
        form3.style.display = "none";
        list.style.display = "none";

    } else {
        form0.style.display = "block";        
        form1.style.display = "none";
        form2.style.display = "none";
        form3.style.display = "none";
    }
}


function myFunctionNext1() {
    var badanUsaha=$('#industri-badan_usaha').val();
    var perusahaan=$('#industri-nama_perusahaan').val();
    var pemilik=$('#industri-nama_pemilik').val();
    var jalan=$('#industri-jalan').val();
    var kecamatan=$('#id-cat').val();
    var kelurahan=$('#id-subcat').val();
    var telepon=$('#industri-telepon').val();

    var form1 = document.getElementById("form-1");
    var form2 = document.getElementById("form-2");
    var form3 = document.getElementById("form-3");

    if (badanUsaha=='' || perusahaan=='' || pemilik=='' || jalan=='' || kecamatan=='' || kelurahan=='' || telepon=='') {
        // alert('hai');
        swal(
            'Oopss!',
            'Data yang anda masukkan tidak lengkap, silahkan lengkapi data anda terlebih dahulu',
            'error'
        )
    }else{        
        if (form2.style.display === "none" && form3.style.display=== "none") {
            form1.style.display = "none";
            form2.style.display = "block";
            form3.style.display = "none";
        } else {
            form1.style.display = "block";
            form2.style.display = "none";
            form3.style.display = "none";
        }
    }
}


function myFunctionNext2() {
    var npwp=$('#industri-npwp').val();
    var izinUsaha=$('#industri-izin_usaha_industri').val();
    var tahunIzin=$('#industri-tahun_izin').val();
    var kbli=$('#industri-txt_kbli').val();
    var komoditi=$('#industri-komoditi').val();
    var jenisProduk=$('#industri-jenis_produk').val();
    var tahunData=$('#industri-tahun_data').val();
    var tklk=$('#industri-tk_lk').val();
    var tkpr=$('#industri-tk_pr').val();

    var form1 = document.getElementById("form-1");
    var form2 = document.getElementById("form-2");
    var form3 = document.getElementById("form-3");

    if(npwp=='' || izinUsaha=='' || tahunIzin=='' || kbli=='' || komoditi=='' || jenisProduk=='' || tahunData=='' || tklk=='' || tkpr==''){
        swal(
            'Oopss!',
            'Data yang anda masukkan tidak lengkap, silahkan lengkapi data anda terlebih dahulu',
            'error'
        )
    }else{
        if (form1.style.display === "none" && form3.style.display=== "none") {
            form1.style.display = "none";
            form2.style.display = "none";
            form3.style.display = "block";

        } else {
            form1.style.display = "none";
            form2.style.display = "block";
            form3.style.display = "none";
        }
    }
}


function myFunctionBack1() {
    var form1 = document.getElementById("form-1");
    var form2 = document.getElementById("form-2");
    var form3 = document.getElementById("form-3");

    if (form1.style.display === "none" && form3.style.display=== "none") {
        form1.style.display = "block";
        form2.style.display = "none";
        form3.style.display = "none";

    } else {
        form1.style.display = "none";
        form2.style.display = "block";
        form3.style.display = "none";
    }
}

function myFunctionBack2() {
    var form1 = document.getElementById("form-1");
    var form2 = document.getElementById("form-2");
    var form3 = document.getElementById("form-3");

    if (form1.style.display === "none" && form2.style.display=== "none") {
        form1.style.display = "none";
        form2.style.display = "block";
        form3.style.display = "none";

    } else {
        form1.style.display = "none";
        form2.style.display = "block";
        form3.style.display = "none";
    }
}

function perusahaanBack() {

    $("#bukutamu").show();
    $("#form-daftar").hide();

}
