<link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/jquery.dataTables.min.css">

<?php 
include 'views/pages/burger.php';
?>
<style>


table {
  border-collapse: collapse;
  width: 100%;
}

td {
  text-align: start;
}
</style>
<div id="main">

<div class ="col-md-12 col-12">
  <div class="card">
    <div class="card-header">
    <h5>Kunjungan  Produksi</h5>
    </div>
    <div class="card-content">
      <div class="card-body">
      <?php 
        $id = $idkun->getid();
      ?>
      <form  id ="formtambah" class ="form form-horizontal">
        <div class="row col-md-12-col-12">
          <div class= "col-md-6">
                   <div class =" row col-md-12 mb-3">
                      <label for="tanggal" class="col-sm-3 col-form-label" >Tanggal</label>
                        <div class = "col-md-3">
                            <input type="text" class="form-control" name ="tanggal" id="tanggal" value="" required>
                        </div>
                    </div>
                      <div class="row col-md-12 mb-3">
                                <label for="id_kunjungan" class="col-sm-3 col-form-label">Id Kunjungan</label>
                                <div class="col-sm-3">
                                <input disabled type="text"  class="form-control" name ="id_kunjungan" id="id_kunjungan" value="<?=$id?>" required>
                                </div>
                        </div>
                        <div class="row col-md-12 mb-3">
                                <label for="jenis_kunjungan" class="col-sm-3 col-form-label">Jenis kunjungan</label>
                               <div class="col-sm-5">
                               <select class="form-control" id="jenis"></select>
                               </div> 

                      </div>
                  <div class ="row col-md-12 mb-2">
                        <label for="direksi" class="col-sm-3 col-form-label" >Divisi</label>
                                <div id="divisi" class ="col-md-6"></div>
                  </div>
                    <div class="row col-md-12 mb-3">
                                <label for="peserta" class="col-sm-3 col-form-label">Peserta</label>
                                <div class="col-sm-8">
                                <textarea style="height:100px;" class="form-control" name ="peserta" id="peserta" value="" required></textarea>
                                </div>
                    </div>
                      <div class="row col-md-12 mb-3">
                                <label for="tujuan" class="col-sm-3 col-form-label">Tujuan</label>
                                <div class="col-sm-8">
                                <textarea style="height:100px;"  class="form-control" name ="tujuan" id="tujuan" value="" required></textarea>
                                </div>
                        </div>
              </div>
          
          <div class= "col-md-6">
     
                        <div class="row col-md-12 mb-3">
                                <label for="temuan" class="col-sm-2 col-form-label">Temuan</label>
                                <div class="col-sm-8">
                                <textarea style="height:100px;" class="form-control" name ="temuan" id="temuan" value="" required></textarea>
                                </div>
                        </div>
                        <div class="row col-md-12">
                            <div class="col-md-10">
                              <div class ="row col-md-10">
                                  <label for="direksi" class="col-sm-3 col-form-label" >Divisi Terkait</label>
                                  <div class ="col-md-8" id ="divisi_tkt"></div>
                              </div>
                            </div>
                            <div class="col-md-2">
                            <button type="button"id="sendEmail" class="btn btn-primary" style="color:#FFFF;" data-bs-toggle="modal" data-bs-target="#SendemailModal">
                              Pilih
                            </button>
                               
                            </div>
                        </div>
                       
                      <div class="row col-md-12">
                                <label for="image_toko" class="col-sm-2 col-form-label">Foto</label>
                            <div class=" col-md-12 row mb-3">
                              <div class="col-md-3">
                                  <div class="col-md-8 row">
                                    <div class="col-md-1">  
                                    <input alt="" id="toko_upload1" type="file"  class="form-control border-0">
                                    </div>
                                    <div class="col-md-7">  
                                    <label style="cursor:pointer" id="upload-label1" for="toko_upload1" class="font-weight-light text-muted">Upload</label>
                                    <img id="tokoImage1" src="#" class="box md-3"> 
                                    <p style="cursor:pointer" id="delete_image1"class="mt-3"><i class="fa-regular fa-trash-can xl text-danger"></i></p>   
                                    </div> 
                                    
                                  </div>
                              </div>
                              <div class="col-md-3">
                              <div class="col-md-8 row">
                                <div class="col-md-1">  
                                <input alt="" id="toko_upload2" type="file"  class="form-control border-0">
                                </div>
                                <div class="col-md-7">  
                                <label style="cursor:pointer" id="upload-label1" for="toko_upload2" class="font-weight-light text-muted">Upload</label>
                                <img id="tokoImage2" src="#" class="box2" >    
                                <p style="cursor:pointer" id="delete_image2"class="mt-3"><i class="fa-regular fa-trash-can xl text-danger"></i></p>   
                              </div>                            
                              </div>
                              </div>
                              <div class="col-md-3">
                              <div class="col-md-8 row">
                                <div class="col-md-1">  
                                <input alt="" id="toko_upload3" type="file"  class="form-control border-0">
                                </div>
                                <div class="col-md-7">  
                                <label style="cursor:pointer" id="upload-label1" for="toko_upload3" class="font-weight-light text-muted">Upload</label>
                                <img id="tokoImage3" src="#" class="box3" > 
                                  <p style="cursor:pointer" id="delete_image3"class="mt-3">
                                  <i class="fa-regular fa-trash-can xl text-danger"></i></p>   
                                </div>                            
                              </div>
                              </div>
                              <div class="col-md-3">
                              <div class="col-md-8 row">
                                <div class="col-md-1">  
                                <input alt="" id="toko_upload4" type="file"  class="form-control border-0">
                                </div>
                                <div class="col-md-7">  
                                <label style="cursor:pointer" id="upload-label1" for="toko_upload4" class="font-weight-light text-muted">Upload</label>
                                <img id="tokoImage4" src="#" class="box4" >
                                  <p style="cursor:pointer" id="delete_image4"class="mt-3">
                                  <i class="fa-regular fa-trash-can xl text-danger"></i></p>                                 </div>                            
                              </div>
                              </div>
                              
                            </div>
                            
                      </div>
    
                        <div class="row col-md-12 mb-3">  
                                <label for="ket" class="col-sm-2 col-form-label">Catatan</label>
                                <div class="col-sm-8">
                                  <textarea  style="height:100px;" maxlength="500" type="text" class="form-control"  name="ket" id="ket" value="" required> </textarea>
                                </div>
                        </div>
          </div>

        </div>
    
                            </div>
                            <div class="col-sm-11 d-flex justify-content-end">
                                    <button  type="sumbit" name="sumbit" class="btn btn-primary me-1 mb-3" id="Createdata">Save</button>
                                    <button type="button" class="btn btn-secondary me-1 mb-3" id="clear">Clear</button>
                                  </div>
          </form>
      </div>
    </div>
  </div>
  </div>
</div>

<!-- modal data email  -->
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="SendemailModal" tabindex="-1" aria-labelledby="SendemailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="SendemailModalLabel">data email</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type ="hidden"  id="kode_email" class ="form-control">
        <div id="dataemail"></div>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="save_email">Save</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- end modal  -->
<script>
$(document).ready(function(){
  var d = new Date();
  var month = d.getMonth()+1;
  var day = d.getDate();
  let  output = (day<10 ? '0' : '') + day + '/' +
              (month<10 ? '0' : '') + month + '/' +
              d.getFullYear() ;

   
  
    $("#tanggal").val(output);
    get_data_divisi();
    get_data_jenis();
	  //get_data_idkun();
    $("#delete_image1").hide();
    $("#delete_image2").hide();
    $("#delete_image3").hide();
    $("#delete_image4").hide();

  $("#Createdata").on('click',function(e){
    e.preventDefault();
    let peserta = $("#peserta").val();
    let tgl = $("#tanggal").val();
    let tanggal = myformat(tgl);

    let id = $("#id_kunjungan").val();
    let tujuan = $("#tujuan").val();
    let temuan = $("#temuan").val();
    let ket = $("#ket").val();
    //check box mulitifel divisi
          let divisi =``;
          $(".checkdivisi:checked").each(function(){
            divisi +=$(this).val()+',';
          });
     let str_divisi = divisi.slice(0,-1);
    //end
        //check box mulitifel divisi
        let divisi_trk =``;

          $(".checkterkait:checked").each(function(){
            divisi_trk +=$(this).val()+ ',';
          });
        
     let str_div_trk = divisi_trk.slice(0,-1);
     
    //end
    //combobox jenis 
    let  jenis = $("#jenis").find(":selected").val();
    //end

   // image toko
   const t_image1 = $('#toko_upload1').prop('files')[0];  
    const t_image2 = $('#toko_upload2').prop('files')[0];  
    const t_image3 = $('#toko_upload3').prop('files')[0]; 
    const t_image4 = $('#toko_upload3').prop('files')[0]; 
   
    //end image toko,
    let formData = new FormData();
    formData.append('peserta', peserta);
    formData.append('tanggal', tanggal);
    formData.append('id', id);
    formData.append('tujuan', tujuan);
    formData.append('temuan', temuan);      
    formData.append('ket', ket);
    formData.append('divisi', str_divisi);
    formData.append('divisi_trk', str_div_trk);
    formData.append('jenis_ktg', jenis);


    formData.append('image1', t_image1);
    formData.append('image2', t_image2);
	  formData.append('image3', t_image3);
	  formData.append('image4', t_image4);
    

    $.ajax({
      url:'models/new/tambahdata.php',
      method:'POST',
      data: formData,
      cache: false,
      processData: false,
      contentType: false,
      dataType:'json',
       success:function(result){ 
        let status = result.error;
           
              Swal.fire({
                position: 'top-center',
              icon: 'success',
              title: status,
              showConfirmButton: false,
              timer: 500000
              }); 
            location.reload();

       }
    })
  })

  $("#clear").on('click',function(){
    window.location.href='index.php?page=new';
  })

  //delete image 
$("#delete_image1").on("click",function(){
    let img =$("#tokoImage1").attr('src');
    let newUrl ='';
    let gambar1 = $("#tokoImage1");
    gambar1.attr('src',newUrl);
    $("#delete_image1").hide();
});
$("#delete_image2").on("click",function(){
    let img =$("#tokoImage2").attr('src');
    let newUrl ='';
    let gambar2 = $("#tokoImage2");
    gambar2.attr('src',newUrl);
    $("#delete_image2").hide();

});
$("#delete_image3").on("click",function(){
    let img =$("#tokoImage3").attr('src');
    let newUrl ='';
    let gambar3 = $("#tokoImage3");
    gambar3.attr('src',newUrl);
    $("#delete_image3").hide();

});
$("#delete_image4").on("click",function(){
    let img =$("#tokoImage4").attr('src');
    let newUrl ='';
    let gambar4 = $("#tokoImage4");
    gambar4.attr('src',newUrl);
    $("#delete_image4").hide();
});
  //end delete image
    // upload gambar
  $('#toko_upload1').on('change', function () {
    $("#delete_image1").show();
        let id = '#tokoImage1';
        readURL(this,id);
  });
  $('#toko_upload2').on('change', function () {
    $("#delete_image2").show();
        let id = '#tokoImage2';
        readURL(this,id);
  });
  $('#toko_upload3').on('change', function () {
    $("#delete_image3").show();
        let id = '#tokoImage3';
        readURL(this,id);
  });
  $('#toko_upload4').on('change', function () {
    $("#delete_image4").show();
        let id = '#tokoImage4';
        readURL(this,id);
  });


  // unutuk data email 



  $("#sendEmail").on("click",function(e){

    let id_kjn = $("#id_kunjungan").val();
    if(id_kjn !== ''){
      $("#kode_email").val(id_kjn);
     $(".save_email").show();   
    e.preventDefault();
    if (!$(this).is('.checkterkait:checked')) { 
      let div =``;
          $(".checkterkait:checked").each(function(){
            div += "'"+$(this).val()+ "'"+',';
          });
          
      let str_div = div.slice(0,-1);
    // let formData = new FormData();
    // formData.append('kode', str_div);
      $.ajax({
      url:'models/member_divisi/member_data_email.php',
      method:'POST',
      data: {kode:str_div},
      dataType:'json',
       success:function(result){ 
        tabelemail();
          $('#tabelemail').DataTable( {
            response:true,
			  pageLength :20,
			lengthMenu: [[20, -1], [20, 'all']],
            columnDefs: [ {
            orderable: false,
            className: 'select-checkbox',
            targets:2
            } ],
            select: {
                style:    'multi',
                selector: 'td:first-child'
            },
            'order': [[0, 'asc']],
              data: result,
                        columns: [
                          { 'data': 'nama_divisi'},
                            { 'data': 'nama' },
                            { 'data': 'email' },
                            {
                                targets: 2,
                                data: null,
                                className: 'text-center',
                                searchable: false,
                                orderable: false,
                                render: function (data, type, full, meta) {
                                  return `<input type="checkbox"  id="check_to_${data.id}" class="check check_to" name="check_to" value="${data.id}">`;
                                },
                                width: "5%"
                            },
                            {
                                data: null,
                                className: 'text-center',
                                searchable: false,
                                orderable: false,
                                render: function (data, type, full, meta) {
                                    return `<input type="checkbox" id="check_cc_${data.id}" class="check check_cc" name="check_cc" value="${data.id}">`;
                                },
                                width: "5%"
                            },
                            {
                                targets: 4,
                                data: null,
                                className: 'text-center',
                                searchable: false,
                                orderable: false,
                                render: function (data, type, full, meta) {
                                    return `<input type="checkbox" id="check_bcc_${data.id}" class="check check_bcc" name="check_bcc"value="${data.id}">`;
                                },
                                width: "5%"
                            },
                        
                        ],
                  
          });
          editemail(id_kjn);
       }
      });
      
      } 
    }else{
      Swal.fire({
        position: 'top-center',
          icon: 'success',
            title: "ID Kunjungan harus di isi",
                          // showConfirmButton: false,
                          // timer: 500000
      }); 
    }
  });

  // simpan data kirim email
  $("#save_email").on("click",function(e){
      e.preventDefault();
    
      let kode_email = $("#kode_email").val();
      delete_data(kode_email);
   
      $("table >tbody >tr").each(function(){
        let dataobject = []; 
        if($(this).find(".check").is(":checked")){
           let  data= {
              'kode_email' : kode_email,
              'id':$(this).closest('tr').find('input:checkbox').val(),
              'to':$(this).closest('tr').find(".check_to").is(":checked"),
              'cc':$(this).closest('tr').find(".check_cc").is(":checked"),
              'bcc':$(this).closest('tr').find(".check_bcc").is(":checked"),
              'nama_divisi': $(this).find('td').eq(0).text(),
              'nama'  : $(this).find('td').eq(1).text(),
              'email'  : $(this).find('td').eq(2).text(),
        };
         dataobject = data;
        }else{

            dataobject ='';
        }
    
        if(dataobject !== ''){
            var jsonString = JSON.stringify(dataobject);
            $.ajax({
              url:'models/member_divisi/history_email.php',
              method:'POST',
              data: {data:jsonString},
              cache: false,
              dataType:'json',
              success:function(result){ 
                let status = result.error;
                              Swal.fire({
                                position: 'top-center',
                              icon: 'success',
                              title: status,
                              showConfirmButton: false,
                              timer: 1000
                              });
              }
            });
        }
      });  
   
  
          
       
    });
  // 

  });
  
  function delete_data(kode_email){
        $.ajax({
        url:'models/member_divisi/delete_history_email.php',
              method:'POST',
              data: {data:kode_email},
              cache: false,
              dataType:'json',
            });
}
  //fungsi untuk edit data email
  function editemail(id_kjn){
   
   //untuk ceheck box send email
     $.ajax({
       url:'models/member_divisi/editdata_history_email.php',
               method:'POST',
               data:{id:id_kjn},
               dataType:'json',  
               success:function(respons){
               
                 if(respons !== null){
                   for(let item of respons){
                    let id = item.id;
                    let to  = parseInt(item.status_to);
                    let cc  =parseInt(item.status_cc);
                    let bcc  =parseInt(item.status_bcc);
                    if(to == 1){
                    let id_check = "#check_to_"+id
                     $(id_check).prop("checked",true);
                    }else{
                      let id_check = "#check_to_"+id;
                      $(id_check).prop("checked",false);
                    }

                        if(cc == 1){
                          let id_check2 = "#check_cc_"+id;
                          $(id_check2).prop("checked",true);
                        }else{
                          let id_check2 = "#check_cc_"+id;
                          $(id_check2).prop("checked",false);
                        }
                    
                        if(bcc == 1){
                          let id_check3 = "#check_bcc_"+id;
                          $(id_check3).prop("checked",true);
                        }else{
                          let id_check3 = "#check_bcc_"+id;
                          $(id_check3).prop("checked",false);
                        }
                 }
               }
             
               }
     })
   //end check send email
 }
//end data email

  //untuk data tabel email
      function tabelemail(){
        let tabel =`     <table id="tabelemail" class="display table-info" style="width:100%">                    
                                      <thead  id='thead'class ='thead'>
                                      <tr>      
                                                <th style="width:30%">Divisi</th>
                                                 <th>Nama</th>
                                                 <th>Email</th>
                                                 <th>To</th>
                                                 <th>CC</th>
                                                 <th>BCC</th>

                                                     
                                      </tr>
                                      </thead>
                                      <tbody>
                                      </tbody>
                                  </table><br>`;
          $("#dataemail").empty().html(tabel);
      }
  //data
  $( function() {
        $( "#tanggal" ).datepicker(
            {dateFormat : 'dd/mm/yy'}
        );
   
  });

  function myformat(date){
    let d = date.split('/')[0];
    let m = date.split('/')[1];
    let y = date.split('/')[2];
    let format = y + "-" + m + "-" + d;
   
    return format;
  }


  function readURL(input,id){
    let file = input.files[0];
    if(file){
            var reader = new FileReader();
 
            reader.onload = function(){
                $(id).attr("src",reader.result);
            }
            reader.readAsDataURL(file);
        }
}

// UNTUK MENAMILKAN DATA DIVISI
function get_data_divisi(){
    $.ajax({
            url:'models/master_divisi/tampildata.php',
            method:'POST',
            dataType:'json',      
            success:function(response){
                  let data =``;
                  let datas =``;
                  // chexbox divisi
                $.each(response,function(key,value){
                  let divisi = value.nama_divisi;
                  data +=`
                  <div class="form-check form-check-inline col-md-5">
                                  <input class="form-check-input checkdivisi" for ="${divisi}" type="checkbox" id="divisi"name="divisi[]" value="${divisi}" required>
                                  <label class="form-check-label" for ="${divisi}" >${divisi}</label>
                      </div>
                  `;

                });
                $("#divisi").empty().html(data); 
                //end chex box divisi
                //chexbox divisi terkait
                $.each(response,function(k,nilai){
               
                  let div = nilai.nama_divisi;
                  let kode = nilai.kode_divisi;

                  datas +=`
                          <div class="form-check form-check-inline col-md-5">
                                          <input class="form-check-input checkterkait" for ="${div}" type="checkbox" id="divisi"name="divisi[]" value="${kode}" required>
                                          <label class="form-check-label" for ="${div}" >${div}</label>
                              </div>
                            
                     
                  `;

                });
                $("#divisi_tkt").empty().html(datas);  
            }

          });

   
}
//END DATA DIVISI                                   

// UNTUK MENAMILKAN DATA jenis
function get_data_jenis(){
  $.ajax({
        url:'models/master_kunjungan/tampildata.php',
        method:'POST',
        dataType:'json',      
        success:function(response){
              let data =``;
            $.each(response,function(key,value){
              
              let jenis = value.nama_kunjungan;
               $("#jenis").append($('<option/>').val(jenis).html(jenis));  
            });
        
        
      }

      });
}
//END DATA jenis
</script>