<div id="tampildata">
  <div id="main">
  <?php include 'views/pages/burger.php' ?>
  <div id="header_data"></div>
  <!-- <div id="filter"> -->
      <!-- Basic Tables start -->
      
  <div id="tabelhead"></div> &nbsp;
      <!-- Basic Tables end -->
  </div>
</div>
</div>

<script>
$(document).ready(function(){
  var d = new Date();
  var month = d.getMonth()+1;
  var day = d.getDate();
  var output = (month<10 ? '0' : '') + month + '/' +
    (day<10 ? '0' : '') + day + '/' +
    d.getFullYear() 
  $("#tgl_solusi").val(output);

    const dateya = new Date();
    let bulan = dateya.getMonth()+1;
    let tahun = dateya.getFullYear();
    //$("#editdata").show();
    get_solusi(tahun,bulan);
    //filter();

  // klik editdata
  $(document).on("click",".solusi",function(){

    $("#tampildata").hide();
    $("#editdata").show();
  //   $("#formedit").trigger("reset");

    let kjn_edit = "";
  //   let dataimage = $(this).data('image');
  

    let row = jQuery(this).closest('tr');
    let columns = row.find('td'); 
    columns.addClass('row-highlight'); 
    jQuery.each(columns, function(key, item) { 
        switch(key){
          case 0:
            tgl_edit = item.innerHTML;
             $("#tgl_edit").val(tgl_edit);
            break;
          case 1:
             id_kj_edit = item.innerHTML;
            $("#id_kj_edit").val(id_kj_edit);
          break;
          case 2:
            let kjn_edit = item.innerHTML;
            $("#kjn_edit").val(kjn_edit);
          break;
          case 7:
            let ket = item.innerHTML;
            $("#ket").val(ket);
          break;
       
        }

    });
   $.ajax({
            url:'models/new/edit_data.php',
            method:'POST',
            data:{id:id_kj_edit},
            dataType:'json',  
            success:function(result){
            
              $.each(result,function(key,value){
               
                let image1_e = value.image1;
                $("#kjk_Image1").attr("src",image1_e);
                let image2_e = value.image2;
                $("#kjk_Image2").attr("src",image2_e);
                let image3_e = value.image3;
                $("#kjk_Image3").attr("src",image3_e);
                let image4_e = value.image4;
                $("#kjk_Image4").attr("src",image4_e);
            
              });
        
            }
   });
  });
  //end klik editdata
  
    $('#upload_edit1').on('change', function () {
        let id ="#kjk_Image1";
        readURL(this,id);

    });

   $('#upload_edit2').on('change', function () {
    let id ="#kjk_Image2";
        readURL(this,id);
    });
    $('#upload_edit3').on('change', function () {
      let id ="#kjk_Image3";
        readURL(this,id);
    });
    $('#upload_edit4').on('change', function () {
      let id ="#kjk_Image4";
        readURL(this,id);
    });



//simpan edit data
$("#Simpan_edit").on('click',function(e){
 
     e.preventDefault();
     let tgl_edit = $("#tgl_edit").val();
     let tgl_solusi = $("#tgl_solusi").val();
     let id_kj = $("#id_kj_edit").val();
     let kjn_edit = $("#kjn_edit").val();
     let ket = $("#ket").val();
     let jwb_solusi = $("#jwb_solusi").val();

     let gambar1 ='';
     let gambar2 ='';
     let gambar3 ='';
     let gambar4 ='';
     const image1 = $('#upload_edit1').prop('files')[0];
     //const auth = undefined;
     if(image1 == undefined){
      let image1_e = $("#kjk_Image1").attr('src');
      gambar1 =image1_e;
     }else{
      gambar1 =image1;
     }

     const image2 = $('#upload_edit2').prop('files')[0];
     if(image2 == undefined){
      let image2_e = $("#kjk_Image2").attr('src');
      gambar2 =image2_e;
     }else{
      gambar2 = image2;
     }
     const image3 = $('#upload_edit4').prop('files')[0]; 
     if(image3 == undefined){
      let image3_e = $("#kjk_Image4").attr('src');
      gambar3 = image3_e;
     }else{
      gambar3 = image3;
     } 
     const image4 = $('#upload_edit4').prop('files')[0];  
     if(image4 == undefined){
      let image4_e = $("#kjk_Image4").attr('src');
      gambar4 = image4_e;
     }else{
      gambar4 = image4;
     }
 
     let formData = new FormData();
     formData.append('tgl_edit', tgl_edit);
     formData.append('tgl_solusi', tgl_solusi);
     formData.append('id_kj', id_kj);
     formData.append('kjn_edit', kjn_edit);
     formData.append('ket', ket);
     formData.append('jwb_solusi', jwb_solusi);
     formData.append('image1', gambar1);
     formData.append('image2', gambar2);
     formData.append('image3', gambar3);
     formData.append('image4', gambar4);
 

     $.ajax({
       url:'models/new/update_data.php',
       method:'POST',
     
       data: formData,
       cache: false,
       processData: false,
       contentType: false,
        success:function(result){
         console.log(result)
         let nilai = result.nilai;
           if(nilai === 1){
            //goBack()
          //$("#tabelhead").load('index.php?page=edit');
           }else{
            //goBack()
           // $("#tabelhead").load('index.php?page=edit');

 
           }
        }
     });

   });
//end_simpan edit data
  });



  function get_solusi(tahun,bulan){
    $("#editdata").hide();
    get_header(tahun);
    get_tables();
    let dataTable =``;
    let image1 ='';
    let image2 ='';
    let image3 ='';
    let image4 ='';
    let id_kunjungan = '';
    let myData ={};
    let data ={};
    $.ajax({
            url:'models/new/tampildata.php',
            method:'POST',
            data:{tahun:tahun,bulan:bulan},
            dataType:'json',      
            success:function(result){
              //console.log(result);
       
          
              $("#tabel1").DataTable({
                    "ordering": false,
                    "destroy":true,
                    // dom: 'Plfrtip',
                    //     scrollCollapse: true,
                    //     paging:false,
                    //     "bPaginate":true,
                    //     "bLengthChange": false,
                    //     "bFilter": true,
                    //     "bInfo": false,
                    //     "bAutoWidth": false,
                    //     dom: 'lrt',
                        fixedColumns:   {
                        // left: 1,
                            right: 1
                        },
                    "order":[[0,'desc']],
                    
                        data: result,
                        pageLength: 5,
                        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']],
                            columns: [
                              { 'data': 'tanggal' },
                                { 'data': 'id_kunjungan' },
                                { 'data': 'kunjungan' },
                      
                                { 'data': 'image1',"render":function(data,type,row){
                                    return '<img class="box2" src="'+data+'"/>';
                                  }
                                },
                                { 'data': 'image2',"render":function(data,type,row){
                                    return '<img class="box2" src="'+data+'"/>';
                                  }
                                },
                                { 'data': 'image3',"render":function(data,type,row){
                                    return '<img class="box2" src="'+data+'"/>';
                                  }
                                },
                                { 'data': 'image4',"render":function(data,type,row){
                                    return '<img class="box2" src="'+data+'"/>';
                                  }
                                },
                                { 'data': 'ket' },
                                { "render": function (data, type) { 
                                  // Tampilkan kolom aksi
                                 
                                  let html  ='<button type="button"  class=" solusi btn btn-primary btn-sm btn-space">solusi<i class="fa-solid fa-pencil"></i></button>'

                                // html += '<button type="button" class=" open-delete  btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa-solid fa-remove"></i></button>'
                                return html;
                                 }
                                },

                             
                            ]      
                
              });
           
            }
    });      
    



};  

   

  function get_header(tahun){

    let data_headr =`
    
    <div  class="page-heading mb-3">
    <div class="page-title">
    <h5 class="text-center">kunjungan pak iwan ${tahun}</h5>
    </div></div>

    `;
    $("#header_data").html(data_headr);
  }

  function get_tables(){
      //   let id ="#"+tabel;
      //   let substr_bulan = bulan.substr(0,3);
          let dataTable =`
          <section class="section">
                  <div class="card">
                      <div class="card-body">
                      <table id="tabel1" class='display table-info'>                    
                                      <thead  id='thead'class ='thead'>
                                      <tr>
                                                  <th>Tanggal</th>
                                                  <th>Id_kunjungan</th>
                                                  <th>kunjungan</th>
                                                  <th>Gambar 1</th>
                                                  <th>Gambar 2</th>
                                                  <th>Gambar 3</th>
                                                  <th>Gambar 4</th>
                                                  <th>Keterangan</th>
                                                  <th>Action</th>       
                                      </tr>
                                      </thead>
                                      <tbody>
                                      </tbody>
                                  </table><br>
                                  </div>
                              </div>
                          </section>

          `;
      $("#tabelhead").empty().html(dataTable);
  };

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



  $( function() {
          $( "#tgl_lcg_edit" ).datepicker();
          $( "#tgl_pdk_edit" ).datepicker();
          $( "#tgl_umur_edit" ).datepicker();
    } );


  function goBack() {
      //   $("#tampildata").show();
      // $("#editdata").hide();
      window.location.href="index.php?page=solusi";
    }

    $( function() {
        $( "#tgl_solusi" ).datepicker(
          { "setDate": new Date(),
        "autoclose": true}
        );
   
  } );
</script>
<div id="editdata"> 
<?php include 'views/pages/burger.php' ?>
 <div id="main">

    <div class ="col-md-12 col-12">
    <div class="card">
      
      <div class="card-content">
        <div class="card-body">
        <button onclick="goBack()" class="btn btn-primary"><i class="fa-solid fa-rotate-left"></i></button>
        <form  id ="formedit" class ="form form-horizontal">
                <div class ="row col-md-12 mb-3">
                <label for="tgl_solusi" class="col-sm-3 col-form-label" >Tanggal Solusi</label>
                  <div class = "col-md-2">
                      <input type="hidden"  class="form-control" name ="tgl_edit" id="tgl_edit" value="" required>
                      <input type="text"  class="form-control" name ="tgl_solusi" id="tgl_solusi" value="" required>
                  </div>
                </div>
                  <div class="row col-md-12 mb-3">
                                <label for="id_kj_edit" class="col-sm-3 col-form-label">ID Kunjungan</label>
                                <div class="col-sm-2">
                                <input type="text" readonly class="form-control" name ="id_kj_edit" id="id_kj_edit" value="" required>
                                </div>
                        </div>
                      <div class="row col-md-12 mb-3">
                                <label for="kjn_edit" class="col-sm-3 col-form-label">Kunjungan</label>
                                <div class="col-sm-2">
                                <input  readonly class="form-control" name ="kjn_edit" id="kjn_edit" value="" required></input>
                                </div>
                        </div>
                        <div class="row col-md-12 mb-2">
                                <label for="image_toko" class="col-sm-3 col-form-label">Foto</label>
                            <div class=" col-md-6 row mt-1">
                              <div class="col-md-3">
                              <div class="col-md-8 row">
                                <div class="col-md-1">  
                                <input alt="" id="upload_edit1" type="file"  class="form-control border-0">
                                </div>
                                <div class="col-md-6">  
                                <label id="upload-label1" for="upload_edit1" class="font-weight-light text-muted">Upload</label>
                                <img id="kjk_Image1" src="#" class="box"  alt="1">    
                                </div>                            
                              </div>
                              </div>
                              <div class="col-md-3">
                              <div class="col-md-8 row">
                                <div class="col-md-1">  
                                <input alt="" id="upload_edit2" type="file"  class="form-control border-0">
                                </div>
                                <div class="col-md-7">  
                                <label id="upload-label1" for="upload_edit2" class="font-weight-light text-muted">Upload</label>
                                <img id="kjk_Image2" src="#" class="box" alt="2">    
                                </div>                            
                              </div>
                              </div>
                              <div class="col-md-3">
                              <div class="col-md-8 row">
                                <div class="col-md-1">  
                                <input alt="" id="upload_edit3" type="file"  class="form-control border-0">
                                </div>
                                <div class="col-md-7">  
                                <label id="upload-label" for="upload_edit3" class="font-weight-light text-muted">Upload</label>
                                <img id="kjk_Image3" src="#" class="box" alt="3">    
                                </div>                            
                              </div>
                              </div>
                              <div class="col-md-3">
                              <div class="col-md-8 row">
                                <div class="col-md-1">  
                                <input alt="" id="upload_edit4" type="file"  class="form-control border-0">
                                </div>
                                <div class="col-md-7">  
                                <label id="upload-label" for="upload_edit4" class="font-weight-light text-muted">Upload</label>
                                <img id="kjk_Image4" src="#" class="box" alt="4">    
                                </div>                            
                              </div>
                              </div>
                              
                            </div>
                            
                      </div>
    
                        <div class="row col-md-12 mb-3">  
                                <label for="ket" class="col-sm-3 col-form-label">Keterangan</label>
                                <div class="col-sm-6">
                                  <textarea readonly type="text" class="form-control"  name="ket" id="ket" value="" required> </textarea>
                                </div>
                        </div>
                        <div class="row col-md-12 mb-3">  
                                <label for="jwb_solusi" class="col-sm-3 col-form-label">Jawaban Solusi</label>
                                <div class="col-sm-6">
                                  <textarea  type="text" class="form-control"  name="jwb_solusi" id="jwb_solusi" value="" required> </textarea>
                                </div>
                        </div>
                            </div>
                            <div class="col-sm-11 d-flex justify-content-end">
                                    <button  type="sumbit" name="sumbit" class="btn btn-primary me-1 mb-3" id="Simpan_edit">Save</button>
                                    <button type="button" class="btn btn-secondary me-1 mb-3"onclick="goBack()">Close</button>
                            </div>
          </form>
        </div>

        </div>
      </div>
    </div>
</div>
</div>