<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<style>
  .carousel-control-next-icon{
    font-size: 25px;
    color:#0079FF !important ;
  }
</style>
<div id="tampildata">
  <div id="main">
  <?php include 'views/pages/burger.php' ?>
  <!-- <div id="filter"> -->
  <div>
        <section class="section">
                    <form id="form_filter">
                        <div class=" row col-md-10">
                          <div class="col-md-2">
                               <select class ="form-control" id="filter_tahun"></select>
                            </div>
                            <div class="col-md-2">
                               <select class ="form-control" id="filter_status"></select>
                            </div>
                            <div class="col-md-2">
                            <button  type="sumbit" name="sumbit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
            </section>
  </div>

      <!-- Basic Tables start -->
      
  <div id="tabelhead"></div>
      <!-- Basic Tables end -->
  </div>
</div>
</div>
<style>
    /* .btn_proses{
      color: #000;
    } */
</style>
<script>

  function myformat(date){
    let d = date.split('-')[0];
    let m = date.split('-')[1];
    let y = date.split('-')[2];
    let format = y + "-" + m + "-" + d;
   
    return format;
  }
    function compres_date(dateObject) {
      let date_str = myformat(dateObject);
        var d = new Date(date_str);
        let day = d.getDate();
        let month = d.getMonth() + 1;
        let year = d.getFullYear();
        if (day < 10) {
            day = "0" + day;
        }
        if (month < 10) {
            month = "0" + month;
        }
        let date = month + "/" + day + "/" + year;
      
        return date;
    };
$(document).ready(function(){
  var d = new Date();
  var month = d.getMonth()+1;
  var day = d.getDate();
  var output =  (day<10 ? '0' : '') + day + '/' +
    (month<10 ? '0' : '') + month + '/' +
    d.getFullYear() 
  $("#tgl_solusi").val(output);
  $("#tgl_proses").val(output);
  $("#tgl_selesai").val(output);

    const dateya = new Date();
    let bulan = dateya.getMonth()+1;
    let tahun = dateya.getFullYear();
    let status = "All";

    get_solusi(tahun,bulan,status);
    get_data_divisi();
    get_data_jenis();

    get_tahun();
    $("#filter_tahun").val(tahun);
    filter_data()
   
  // klik editdata  all
  $(document).on("click",".editdata",function()
  {
    
      let id_kjn = $(this).data('id');
     $("#tampildata").hide();
      $("#editdata").show();

   $.ajax({
            url:'models/rpt_solusi/edit_data.php',
            method:'POST',
            data:{id:id_kjn},
            dataType:'json',  
            success:function(result){
           
              $.each(result,function(key,value){
                
                let tgl = value.tanggal;
              let tgls = moment(tgl).toDate();
              let fort = moment(tgls).format('DD/MM/YYYY');
				
				
                let tgl_e = fort;
                $("#tgl_edit").val(tgl_e);
              
                let id_e = value.id_kunjungan; 
                $("#id_kjn_edit").val(id_e);
              
                let jenis_e = value.jenis_ktg;
                $("#jenis_edit").val(jenis_e);

                let div_e = value.divisi;
               
                if(div_e !== ''){
                  let div_split = div_e.split(',');
				  
                    for(let d of div_split){
                      let id_div = "#"+d;
					 
                      $(id_div).prop("checked",true);
                    }
                }
               


                let div_tkt = value.divisi_terkait;
				
                 if(div_tkt !== null){
                  let tkt_split = div_tkt.split(',');
                    for(let e of tkt_split){
                      let id_tkt2 = "#"+e+"_2";
                      $(id_tkt2).prop("checked",true);
                    }
                }
             
                 let peserta_e = value.peserta;
                 $("#peserta_edit").val(peserta_e) ;
                 
                 let tujuan_e = value.tujuan;
                 $("#tujuan_edit").val(tujuan_e);

                 let temuan_e = value.temuan;
                 $("#temuan_edit").val(temuan_e);
                 
                 let ket_e = value.ket;
                 $("#ket_edit").val(ket_e);

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
  // untuk upload image
    $('#upload_edit1').on('change', function () {
        let id ="#kjk_Image1";
        readURL(this,id);
        $("#delete_image1").show();
    });

    $('#upload_edit2').on('change', function () {
    let id ="#kjk_Image2";
        readURL(this,id);
        $("#delete_image2").show();

    });
    $('#upload_edit3').on('change', function () {
      let id ="#kjk_Image3";
        readURL(this,id);
        $("#delete_image3").show();

    });
    $('#upload_edit4').on('change', function () {
      let id ="#kjk_Image4";
        readURL(this,id);
        $("#delete_image4").show();
    });

//end upload image
  //delete image 
    $("#delete_image1").on("click",function(){
      let img =$("#kjk_Image1").attr('src');
      let newUrl ='';
      let gambar1 = $("#kjk_Image1");
      gambar1.attr('src',newUrl);
      $("#delete_image1").hide();
    });
    $("#delete_image2").on("click",function(){
        let img =$("#kjk_Image2").attr('src');
        let newUrl ='';
        let gambar2 = $("#kjk_Image2");
        gambar2.attr('src',newUrl);
        $("#delete_image2").hide();

    });
    $("#delete_image3").on("click",function(){
        let img =$("#kjk_Image3").attr('src');
        let newUrl ='';
        let gambar3 = $("#kjk_Image3");
        gambar3.attr('src',newUrl);
        $("#delete_image3").hide();

    });
    $("#delete_image4").on("click",function(){
        let img =$("#kjk_Image4").attr('src');
        let newUrl ='';
        let gambar4 = $("#kjk_Image4");
        gambar4.attr('src',newUrl);
        $("#delete_image4").hide();
    });
  //end delete image

  //simpan edit data
    $("#Simpan_edit").on('click',function(e){
          e.preventDefault();
          let tgl_db = $("#tgl_edit").val();
          let tgl_edit = myformat(tgl_db);
          let id_kjn = $("#id_kjn_edit").val();
          let jenis_kjn = $("#jenis_edit").find(":selected").val();

          let peserta = $("#peserta_edit").val();

          let tujuan = $("#tujuan_edit").val();

          let temuan = $("#temuan_edit").val();

          let ket = $("#ket_edit").val();
          //check box mulitifel divisi
          let divisi =``;
                $(".checkdivisi:checked").each(function(){
                  divisi +=$(this).val()+',';
                });
          let str_divisi = divisi.slice(0,-1);
          //end
          let divisi_tkt =``;
                $(".checkterkait:checked").each(function(){
                  divisi_tkt +=$(this).val()+',';
                });
          let str_divisi_tkt = divisi_tkt.slice(0,-1);

          //end

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
          const image3 = $('#upload_edit3').prop('files')[0]; 
          if(image3 == undefined){
            let image3_e = $("#kjk_Image3").attr('src');
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
          formData.append('divisi', str_divisi);
          formData.append('divisi_tkt',str_divisi_tkt);
          formData.append('jenis', jenis_kjn);
          formData.append('tgl_edit', tgl_edit);
          formData.append('id_kjn', id_kjn);
          formData.append('peserta', peserta);
          formData.append('tujuan', tujuan);
          formData.append('temuan', temuan);
          formData.append('ket', ket);
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
                let object = JSON.parse(result)
                let status =  object.error
                  Swal.fire(status);
                  goBack();

            
              
              }
          });

    });
  //end_simpan edit data

//untuk delete data 
  $("#Delete_data").on('click',function(e){
    e.preventDefault();
      let id_kjn = $("#id_kjn_edit").val();
      $.ajax({
            url:"models/rpt_solusi/delete_data.php",
            type:"POST",
            data:{id_kjn:id_kjn},
                dataType:'json',                  
            success: function(result){ 
              let status = result.error;
              Swal.fire({
                position: 'top-center',
              icon: 'success',
              title: status,
         
              }).then(function(){
                location.reload();
              }); 
          
          }
        
        })
  });
//end delete data

//untuk proses
    $(document).on("click",".open-proses",function(){
         let id_kjn = $(this).data('id');
        let ket  = $(this).data('ket');
		let tgl_proses = $(this).data('tgl_proses');
		

        if(ket != ''){    
          $(".modal-body #tgl_proses").attr("disabled",true);
          $(".modal-body #ket_proses").attr("disabled",true);

        }else{
          $(".modal-body #tgl_proses").attr("disabled",false);
          $(".modal-body #ket_proses").attr("disabled",false);
        }
		
		if(tgl_proses !=='01-01-1970'){
      let for_tgl = tgl_proses.split('-');
      let tgl_prs = for_tgl[0]+'/'+for_tgl[1]+'/'+for_tgl[2];
			$(".modal-body #tgl_proses").val(tgl_prs);
		}
		
      $(".modal-body #ket_proses").val(ket);
      $(".modal-body #kode_kjn").val(id_kjn);
    });

    $("#Proses").on("click",function(e){
      e.preventDefault();
        let kode_kjn = $("#kode_kjn").val();
        let tgls = $("#tgl_proses").val();
        let tgl_proses = myformat(tgls)

        let ket_proses =  $("#ket_proses").val();

        $.ajax({
          url:'models/new/simpat_proses.php',
            type:'POST',
            dataType:'json',
            data :{kode_kjn:kode_kjn,tgl_proses:tgl_proses,ket_proses:ket_proses},
        
            success:function(result){
              // let object = JSON.parse(result)
              let status =  result.error
              Swal.fire({
                position: 'top-center',
              icon: 'success',
              title: status,
              showConfirmButton: false,
              timer:2000
              }); 
              location.reload();
            }
        })
    });
//end proses
//untuk proses
  $(document).on("click",".open-selesai",function(){
    let id_kjn = $(this).data('id');
    let selesai = $(this).data('ket');
    let tgl_selesai = $(this).data('tgl_selesai')
    if(selesai != '' ){
      $(".modal-body #tgl_selesai").attr("disabled",true);
      $(".modal-body #ket_selesai").attr("disabled",true);
    }else{
      $(".modal-body #tgl_selesai").attr("disabled",false);
      $(".modal-body #ket_selesai").attr("disabled",false);
    }

    if(tgl_selesai !=='01-01-1970'){
      let for_tgl = tgl_selesai.split('-');
      let tgl_srs = for_tgl[0]+'/'+for_tgl[1]+'/'+for_tgl[2];
			$(".modal-body #tgl_selesai").val(tgl_srs);
		}

    $(".modal-body #kode_kjn").val(id_kjn);
    $(".modal-body #ket_selesai").val(selesai);


  });

    $("#Selesai").on("click",function(e){
      e.preventDefault();
        let kode_kjn = $("#kode_kjn").val();
      
        let tgls= $("#tgl_selesai").val();
        let tgl_selesai = myformat(tgls)
        let ket_selesai =  $("#ket_selesai").val();
    
        $.ajax({
          url:'models/new/simpat_selesai.php',
            type:'POST',
            dataType:'json',
            data :{kode_kjn:kode_kjn,tgl_selesai:tgl_selesai,ket_selesai:ket_selesai},
        
            success:function(result){
              // let object = JSON.parse(result)
              let status =  result.error
              Swal.fire({
                position: 'top-center',
              icon: 'success',
              title: status,
              showConfirmButton: false,
              timer: 500000
              }); 
                goBack();
            }
        });
    });
//end proses
// lihat email kirim
    $(document).on("click",".open-viewemail",function(){
      let id_kjn = $(this).data('id');
      let div_tkt = $(this).data('div_tkt');
  
      $.ajax({
        url:'models/member_divisi/view_data_email.php',
      method:'POST',
      data: {id_kjn:id_kjn,div_tkt:div_tkt},
      dataType:'json',
       success:function(result){ 
        tabelemail_view();
          $('#tabelemail_view').DataTable( {
            response:true,
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
                          //  { 'data': 'status' },

                        ],
                  
          });  
        
       }
      })
    //tabelemail()
    })
// end email kirim
    //tampil gambar 
    $(document).on("click",".open-gambar",function(){
        let id_kjn = $(this).data('id');
       

              $.ajax({
                    url:'models/rpt_solusi/edit_data.php',
                    method:'POST',
                    data:{id:id_kjn},
                    dataType:'json',  
                    success:function(result){
                      $.each(result,function(key,value){
                        
                        let image1_e = value.image1;
                        let image2_e = value.image2;
                        let image3_e = value.image3;
                        let image4_e = value.image4;
                     
                        if(image1_e !== ''){
                          $("#side_image1").attr("src",image1_e);
                        }else{
                          $("#side_image1").attr("src",'assets/images/image1.jpg');
                        }
                        if(image2_e !== ''){
                          $("#side_image2").attr("src",image2_e);
                        }else{
                          $("#side_image2").attr("src",'assets/images/image2.jpg');
                        }
                        if(image3_e !== ''){
                          $("#side_image3").attr("src",image3_e);
                        }else{
                          $("#side_image3").attr("src",'assets/images/image3.jpg');
                        }
                        if(image4_e !== ''){
                          $("#side_image4").attr("src",image4_e);
                        }else{
                          $("#side_image4").attr("src",'assets/images/image4.jpg');

                        }
                       
                     
                       
                      
                       
                       
                     
                       
                    
                      });
                
                    }
          });
      });

    //end gambar

// ini untuk filter data 
  $("#form_filter").on("submit",function(e){
     e.preventDefault();
     let tahun = $("#filter_tahun").find(":selected").val();
     let status = $("#filter_status").find(":selected").val();
     get_tables(tahun);
     $.ajax({
      url :'models/new/tampildata.php',
      method : 'POST',
      data:{tahun:tahun,status:status},
      dataType: 'json',
      success : function(result){
        let data =``;
        if(result == null){
          data =[];
        }else{
          data = result;
        }
        datatabel(data);

      }
     });
  });
//end filter data 
// data email id


  $(document).on("click",".open-sendmail",function(){
    let id = $(this).data('id');
    let pesan = $(this).data('pasan');
    let st_email = $(this).data('email');
    let tujuan = $(this).data('tujuan');
   
    $("#id_kjn_email").val(id);
    $("#st_email").val(st_email);
    if(pesan != '' ){
      $(".modal-body #pesan_email").val(pesan);
      $(".modal-body #pesan_email").attr("disabled",true);
    }else{
      $(".modal-body #pesan_email").attr("disabled",false);  
    }

    let title =`
        <h6>${id} </h6>
        <h6>Tujuan : &nbsp ${tujuan} </h6>
    `;
    $("#title_id").empty().html(title);


  });
//data emai id
//untuk reset forem message email
  $("#close_email2").on("click",function(){
      $("#pesan_email").val('');
  });
  $("#close_email").on("click",function(){
      $("#pesan_email").val('');
  })
//end message email
// ini untuk kirim email 
  $("#kirim_email").on("click",function(e){
    e.preventDefault()
    let st_email = $("#st_email").val();
    let id_kjn = $("#id_kjn_email").val();
    let pesan = $("#pesan_email").val();

      if(st_email == 1){
        Swal.fire({         
              position: 'top-center',
                icon: 'success',
                title:"Data Sudah pernah di email ..???",                    
            });
      }else{
          $.ajax({
            url:'models/email/send_email.php',
            method:'POST',
            data: {id_kjn:id_kjn,pesan:pesan},
            dataType:'json',
            beforeSend :function(){
            
              Swal.fire({
                title: 'Sedang kirim Email...',
                html: 'Please wait...',
                allowEscapeKey: false,
                allowOutsideClick: false,
                didOpen: () => {
                  Swal.showLoading()
              }
                });
            },
            success:function(result){
              console.log(result)
              $("#pesan_email").val('');
              let pesan = result.pesan;
              let nilai = result.nilai;
                  Swal.fire({         
                            position: 'top-center',
                            icon: 'success',
                            title: "Email berhasi di kirim",
                          }).then(function(){ 
                            location.reload();
                          }); 
               

            },

          });
    
      }
  });
//end kirim email


//untuk data view email
$(document).on("click", "#sendEmail",function(e){
  e.preventDefault();
let id_kjn = $("#id_kjn_edit").val();

let tit =`<div class="row col-mb-12">
            <h1 class="modal-title fs-5 col-md-4" id="Kirim_ModalLabel">Send Email</h1>
            <h1 class="modal-title fs-5 col-md-8">Id Kunjungan : ${id_kjn}</h1>
            </div>
            `;
$("#title_k").empty().html(tit);

  $("#edit_kode_email").val(id_kjn);
 $(".save_email").show();   

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
                            { 'data': 'email'},
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

});
//end data view email
  // simpan data kirim email
  $("#save_email").on("click",function(e){
      e.preventDefault();
    
      let kode_email = $("#edit_kode_email").val();
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
//ini batas document ready
});

function close_proses(){
  var d = new Date();
  var month = d.getMonth()+1;
  var day = d.getDate();
  var output =  (day<10 ? '0' : '') + day + '/' +
    (month<10 ? '0' : '') + month + '/' +
    d.getFullYear();

  $("#ket_proses").val('');
  $("#tgl_proses").val(output);
}
function close_selesai(){
  var d = new Date();
  var month = d.getMonth()+1;
  var day = d.getDate();
  var output =  (day<10 ? '0' : '') + day + '/' +
    (month<10 ? '0' : '') + month + '/' +
    d.getFullYear();

  $("#ket_proses").val('');
  $("#tgl_selesai").val(output);
}

function delete_data(kode_email){
        $.ajax({
        url:'models/member_divisi/delete_history_email.php',
              method:'POST',
              data: {data:kode_email},
              cache: false,
              dataType:'json',
            });
}


function get_tahun(){
 
 let startyear = 2020;
 let date = new Date().getFullYear();
 
 let endyear = date + 2;
 
 for(let i = startyear; i <=endyear; i++){
   var selected = (i !== date) ? 'selected' : date; 

  $("#filter_tahun").append($(`<option />`).val(i).html(i).prop('selected', selected));

 }
}

function filter_data(){
 const divisi =["All","Belum Proses","Belum Selesai","Belum Email","Proses","Selesai","Sudah Email"];
 
 for(let div of divisi){
   $("#filter_status").append($(`<option/>`).val(div).html(div));
   }
}

function myformat(date){
  
  let d = date.split('/')[0];
  let m = date.split('/')[1];
  let y = date.split('/')[2];
  let format = y + "-" + m + "-" + d;
 
  return format;
}

function get_solusi(tahun,bulan,status){

    $("#editdata").hide();
    $('#solusi').hide();
    get_tables(tahun);
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
            data:{tahun:tahun,bulan:bulan,status:status},
            dataType:'json',      
            success:function(result){

          datatabel(result);
              
           
            }
    });      
    
};  


   

function datatabel(result){
  $("#tabel1").DataTable({
                    "ordering": false,
                    "destroy":true,
                    bAutoWidth: false, 
                    "order":[[0,'desc']],
                    
                        data: result,
                        'rowCallback': function(row, data, index){
                          let proses = data.status_proses;
                          let selesai = data.status_selesai;
                          let email = data.status_email;
                                if(proses == 1){
                                  $(row).find('#btn_proses').css('background-color', 'yellow');
                                  $(row).find('#btn_proses').css('color', 'black');
                                }else{
                                  $(row).find('#btn_proses').css('background-color', 'red');
                                  $(row).find('#btn_proses').css('color', '#FFFF');
                                }
                                if(selesai == 1){
                                  $(row).find('#btn_selesai').css('background-color', '#B3C890');
                                  $(row).find('#btn_selesai').css('color', 'black');
                                }else{
                                  $(row).find('#btn_selesai').css('background-color', 'red');
                                  $(row).find('#btn_selesai').css('color', '#FFFF');

                                }  
                                if(email == 1){
                                  $(row).find("#btn_email").css('background-color','#F79327');
                                    $(row).find('#btn_email').css('color','#FFFF');
                             
                                }else{
                                  $(row).find("#btn_email").css('background-color','#448dee');
                                   $(row).find('#btn_email').css('color','#FFFF');
                                } 
                               
                                $(row).find("#btn_viewemail").css('background-color','#448dee');
                                $(row).find('#btn_viewemail').css('color', '#FFFF');
                            },
                        pageLength: 5,
                        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']],
                        "columnDefs": [
                          { "width": "3%", "targets": 2 },
                          { "width": "20%", "targets": 7 }
                          ],

                            columns: [
                              { 'data': 'tanggal' },
                              { 'data': 'id_kunjungan' },
                              { 'data': 'jenis_ktg' },
                              { 'data': 'peserta'},
                                { 'data': 'tujuan' },
                                { 'data': 'temuan' },
                                { 'data': 'ket' },
                                {
                                  "render": function (data, type,row) { 
                                  // Tampilkan kolom aksi
                                  let html  ='<button type="button" id="btn_gambar"  data-id="'+row.id_kunjungan+'" class=" open-gambar btn  btn-lg btn-space" data-bs-toggle="modal" data-bs-target="#Gambar_Modal"><i class="fa-solid fa-binoculars"></i></button>';
                                      html  +='<button type="button" data-id="'+row.id_kunjungan+'" class=" editdata btn  btn-lg btn-space"><i class="fa-regular fa-pen-to-square"></i></button>&nbsp';
                                  
                                     return html;
                                 }
                                },
                                { "render": function (data, type,row) { 
                                  let proses = row.tanggal_proses;
                                  let date_p = proses.split('-');
                                  let proses_date =date_p[0]+'-'+date_p[1]+'-'+date_p[2].slice(-2);
                                 
                                  let selesai = row.tanggal_selesai;
                                  let date_s = proses.split('-');
                                  let selesai_date =date_s[0]+'-'+date_s[1]+'-'+date_s[2].slice(-2);

                                   let leb ="";
                                   let sel = "";
                                  if(proses == "01-01-1970"){
                                    leb = "Proses";
                                  }else{
                                    leb = proses_date;
                                  }
                                  if(selesai == "01-01-1970"){
                                    sel = "Selesai";
                                  }else{
                                    sel = selesai_date;
                                  }
                                  // Tampilkan kolom aksi
                                  let html  =`<button type="button" id="btn_proses" data-tgl_proses="${proses}" data-id="${row.id_kunjungan}" data-ket="${row.ket_proses}"style="width:100px" 
                                      class=" open-proses btn btn-sm text-center " data-bs-toggle="modal" data-bs-target="#Pengerjaan_Modal">${leb}</button>`;
                                      html  +=`<button type="button" id="btn_selesai" data-tgl_selesai="${selesai}"  data-id="${row.id_kunjungan}"data-ket="${row.ket_selesai}" style="width:100px"
                                      class=" open-selesai  btn btn-sm  mt-1" data-bs-toggle="modal" data-bs-target="#Selesai_Modal">${sel}</button>`;
                                    
                                return html;
                                 }
                                },
                                {
                                  "render":function(data,type,row){
                                  
                                        let kirim = row.tanggal_email;
                                        let kir ="";
                                        if(kirim == "01-01-70"){
                                            kir = "Kirim";
                                          }else{
                                            kir = kirim;
                                          }
                                    // let html  =`<button type="button" id="btn_kirim_email"  data-id="${row.id_kunjungan}" data-div_tkt="${row.divisi_terkait}"style="width:100px" 
                                    //   class=" btn  btn-sm text-center">Kirim</button>`;
                                     let html  =`<button type="button" id="btn_email" data-email="${row.status_email}" data-id="${row.id_kunjungan}" data-pasan="${row.pesan_email}" data-tujuan="${row.tujuan}"  style="width:100px"
                                      class="open-sendmail  btn btn-sm  mt-1" data-bs-toggle="modal" data-bs-target="#Send_emailModal">${kir}</button>`;
                                      html  +=`<button type="button" id="btn_viewemail"  data-id="${row.id_kunjungan}" data-div_tkt="${row.divisi_terkait}" style="width:100px"
                                      class="open-viewemail  btn btn-sm  mt-1" data-bs-toggle="modal" data-bs-target="#View_emailModal">View Email</button>`;
                                    

                                return html;
                                  }
                                }

                             
                            ]      
                
              });
}

  function get_tables(tahun){
      //   let id ="#"+tabel;
      //   let substr_bulan = bulan.substr(0,3);
          let dataTable =`
          <section class="section">
                  <div class="card">
                  <div class="card-header"></div>
                  <div  class="page-heading mb-3">
                      <div class="page-title">
                      <h5 class="text-center">List Kunjungan Produksi</h5>
                      </div></div>
                      <div class="card-body">
                      <table id="tabel1" class="display table-info">                    
                                      <thead  id='thead'class ='thead'>
                                      <tr>      
                                                 <th style="width:10%">Tanggal</th>
                                                 <th style="width:3%">ID</th>
                                                 <th style="width:3%">Jenis</th>
                                                  <th style="width:2%">Peserta</th>
                                                  <th style="width:29%">Tujuan</th>
                                                  <th style="width:30%">Temuan</th>
                                                  <th style="width:30%">Catatan</th>
                                                  <th style="width:15%">Foto/Edit</th>
                                                  <th style="width:20%">Action</th>       
                                                  <th style="width:20%">Send Email</th>       

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
// UNTUK MENAMILKAN DATA DIVISI
function get_data_divisi(){
    $.ajax({
            url:'models/master_divisi/tampildata.php',
            method:'POST',
            dataType:'json',      
            success:function(response){
                  let data =``;
                  let datas =``;
                $.each(response,function(key,value){
                  let divisi = value.nama_divisi;
                  data +=`
                  <div class="form-check form-check-inline col-md-5">
                                  <input class="form-check-input checkdivisi" for ="${divisi}" type="checkbox" id="${divisi}"name="divisi[]" value="${divisi}" required>
                                  <label class="form-check-label" for ="${divisi}" >${divisi}</label>
                      </div>
                  `;

                });
                $("#divisi").empty().html(data);  


                $.each(response,function(k,nilai){
               
               let div = nilai.nama_divisi;
               let kode = nilai.kode_divisi;
			   let id_cek = nilai.kode_divisi + '_2';

               datas +=`
               <div class="form-check form-check-inline col-md-5">
                               <input class="form-check-input checkterkait" for ="${div}" type="checkbox" id="${id_cek}"name="divisi_tkt[]" value="${kode}" required>
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
               $("#jenis_edit").append($('<option/>').val(jenis).html(jenis));  
            });
        
        
      }

      });
}
//END DATA jenis


  $( function() {
           $( "#tgl_edit" ).datepicker(
            {dateFormat : 'dd/mm/yy'}
          );
          $( "#tgl_proses" ).datepicker(
            {dateFormat : 'dd/mm/yy'}
          );
          $( "#tgl_selesai" ).datepicker(
            {dateFormat : 'dd/mm/yy'}
          );
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
        $( "#tgl_edit" ).datepicker(
          { "setDate": new Date(),
        "autoclose": true}
        );
  } );

function compers_tgl(date){
  let y = date.split('-')[0];
    let m = date.split('-')[1];
    let d = date.split('-')[2];
    let format = d + "/" + m + "/" + y;
    return format;
  }

 //untuk data tabel email
 function tabelemail_view(){
        let tabel =`     <table id="tabelemail_view" class="display table-info" style="width:100%">                    
                                      <thead  id='thead'class ='thead'>
                                      <tr>      
                                                <th>Divisi</th>
                                                 <th>Nama</th>
                                                 <th>Email</th>
                                                                                               
                                      </tr>
                                      </thead>
                                      <tbody>
                                      </tbody>
                                  </table><br>`;
          $("#dataemail_view").empty().html(tabel);
      }
  //data
  //untuk data tabel email
  function tabelemail(){
        let tabel =`     <table id="tabelemail" class="display table-info" style="width:100%">                    
                                      <thead  id='thead'class ='thead'>
                                      <tr>      
                                                <th>Divisi</th>
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

   //fungsi untuk edit data email
   function editemail(id_kjn){
   
   //untuk ceheck box send email
     $.ajax({
       url:'models/member_divisi/editdata_history_email.php',
               method:'POST',
               data:{id:id_kjn},
               dataType:'json',  
               success:function(respons){
             //  console.log(respons)
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
</script>




<div id="editdata"> 
    <?php include 'views/pages/burger.php' ?>
    <div id="main">

    <div class ="col-md-12 col-12">
    <div class="card">
    <div class="card-header">
    <h5> Edit Kunjungan Produksi</h5>
    </div>
 
      <div class="card-content">
        <div class="card-body">
        <button onclick="goBack()" class="btn btn-lg mb-4"><i class="fa-solid fa-chevron-left"></i></button>
        <form  id ="formedit" class ="form form-horizontal">
        <div class="row col-md-12-col-12">
          <div class= "col-md-6">
                   <div class =" row col-md-12 mb-3">
                      <label for="tgl_edit" class="col-sm-3 col-form-label" >Tanggal</label>
                        <div class = "col-md-3">
                            <input type="text" class="form-control" name ="tgl_edit" id="tgl_edit" value="" required>
                        </div>
                    </div>
                      <div class="row col-md-12 mb-3">
                                <label for="id_kjn_edit" class="col-sm-3 col-form-label">Id Kunjungan</label>
                                <div class="col-sm-3">
                                <input type="text" disabled class="form-control" name ="id_kjn_edit" id="id_kjn_edit" value="" required>
                                </div>
                        </div>
                        <div class="row col-md-12 mb-3">
                                <label for="jenis_kunjungan" class="col-sm-3 col-form-label">Jenis kunjungan</label>
                               <div class="col-sm-5">
                               <select class="form-control" id="jenis_edit"></select>
                               </div> 

                      </div>
                  <div class ="row col-md-12 mb-2">
                        <label for="direksi" class="col-sm-3 col-form-label" >Divisi</label>
                                <div id="divisi" class ="col-md-6"></div>
                  </div>
                    <div class="row col-md-12 mb-3">
                                <label for="peserta_edit" class="col-sm-3 col-form-label">Peserta</label>
                                <div class="col-sm-8">
                                <textarea style="height:150px;" class="form-control" name ="peserta_edit" id="peserta_edit" value="" required></textarea>
                                </div>
                    </div>
                      <div class="row col-md-12 mb-3">
                                <label for="tujuan_edit" class="col-sm-3 col-form-label">Tujuan</label>
                                <div class="col-sm-8">
                                <textarea style="height:150px;" maxlength="500" class="form-control" name ="tujuan_edit" id="tujuan_edit" value="" required></textarea>
                                </div>
                        </div>
              </div>
          
          <div class= "col-md-6">
     
                        <div class="row col-md-12 mb-3">
                                <label for="temuan_edit" class="col-sm-2 col-form-label">Temuan</label>
                                <div class="col-sm-8">
                                <textarea style="height:150px;" maxlength="500" class="form-control" name ="temuan_edit" id="temuan_edit" value="" required></textarea>
                                </div>
                        </div>
                        <div class="row col-md-12">
                            <div class="col-md-10">
                              <div class ="row col-md-10">
                                  <label for="direksi" class="col-sm-3 col-form-label" >Divisi Terkait</label>
                                <div id="divisi_tkt" class ="col-md-8"></div>
                              </div>
                            </div>
                            <div class="col-md-2">
                            <!--   -->
                            <button id="sendEmail" type="button" class="btn btn-primary" style="color:#FFFF;" data-bs-toggle="modal" data-bs-target="#Kirim_Modal">
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
                                    <input alt="" id="upload_edit1" type="file"  class="form-control border-0">
                                    </div>
                                    <div class="col-md-7">  
                                    <label style="cursor:pointer" id="upload-label3" for="upload_edit1" class="font-weight-light text-muted">Upload</label>
                                    <img id="kjk_Image1" src="#" class="box md-3" > 
                                    <p style="cursor:pointer" id="delete_image1"class="mt-3"><i class="fa-regular fa-trash-can xl text-danger"></i></p>   
                                    </div> 
                                    
                                  </div>
                              </div>
                              <div class="col-md-3">
                              <div class="col-md-8 row">
                                <div class="col-md-1">  
                                <input alt="" id="upload_edit2" type="file"  class="form-control border-0">
                                </div>
                                <div class="col-md-7">  
                                <label style="cursor:pointer" id="upload-label2" for="upload_edit2" class="font-weight-light text-muted">Upload</label>
                                <img id="kjk_Image2" src="#" class="box2">    
                                <p style="cursor:pointer" id="delete_image2"class="mt-3"><i class="fa-regular fa-trash-can xl text-danger"></i></p>   
                              </div>                            
                              </div>
                              </div>
                              <div class="col-md-3">
                              <div class="col-md-8 row">
                                <div class="col-md-1">  
                                <input alt="" id="upload_edit3" type="file"  class="form-control border-0">
                                </div>
                                <div class="col-md-7">  
                                <label style="cursor:pointer" id="upload-label3" for="upload_edit3" class="font-weight-light text-muted">Upload</label>
                                <img id="kjk_Image3" src="#" class="box3" > 
                                  <p style="cursor:pointer" id="delete_image3"class="mt-3">
                                  <i class="fa-regular fa-trash-can xl text-danger"></i></p>   
                                </div>                            
                              </div>
                              </div>
                              <div class="col-md-3">
                              <div class="col-md-8 row">
                                <div class="col-md-1">  
                                <input alt="" id="upload_edit4" type="file"  class="form-control border-0">
                                </div>
                                <div class="col-md-7">  
                                <label style="cursor:pointer" id="upload-label1" for="upload_edit4" class="font-weight-light text-muted">Upload</label>
                                <img id="kjk_Image4" src="#" class="box4" >
                                  <p style="cursor:pointer" id="delete_image4"class="mt-3">
                                  <i class="fa-regular fa-trash-can xl text-danger"></i></p>                                 
                                </div>                            
                              </div>
                              </div>
                              
                            </div>
                            
                      </div>
    
                        <div class="row col-md-12 mb-3">  
                                <label for="ket_edit" class="col-sm-2 col-form-label">Catatan</label>
                                <div class="col-sm-8">
                                  <textarea  style="height:150px;" maxlength="500" type="text" class="form-control"  name="ket_edit" id="ket_edit" value="" required> </textarea>
                                </div>
                        </div>
          </div>

        </div>
           
                          </div>
                            <div class="col-sm-11 d-flex justify-content-end">
                                    <button  type="sumbit" name="sumbit" class="btn btn-primary me-1 mb-3" id="Simpan_edit">Save</button>
                                    <button  type="button" name="delete" class="btn btn-danger me-1 mb-3" id="Delete_data">Delete</button>
                                    <button type="button" class="btn btn-secondary me-1 mb-3" onclick="goBack()">Close</button>
                                  </div>
                      </form>
              </div>
            </div>
        </div>

        </div>
      </div>
  

<!-- Modal  Proses data  -->
<div class="modal fade" id="Pengerjaan_Modal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class ="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="Pengerjaan_ModalLabel">Proses</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="close_proses();" aria-label="Close"></button>
      </div>
                <div class="modal-body">
                <form  id ="formedit"  class ="form form-horizontal">
                  <input type="hidden" class ="form-control" id="kode_kjn" value="">
                  <div class="row col-md-12 mb-3">  
                              <label for="tgl_proses" class="col-sm-3 col-form-label">Tanggal Pengerjaan</label>
                              <div class="col-sm-4">
                                <input type="text" class="form-control"  name="tgl_proses" id="tgl_proses" value="" required>
                              </div>
                      </div>
                      <div class="row col-md-12">  
                              <label for="ket_proses" class="col-sm-3 col-form-label">Keterangan</label>
                              <div class="col-sm-8">
                                <textarea type="text" class="form-control ket_proses"  name="ket_proses" id="ket_proses" value="" required></textarea>
                              </div>
                      </div>
                </div>
                        <div class="col-sm-11 d-flex justify-content-end">
                                    <button  type="sumbit" name="sumbit" class="btn btn-primary me-1 mb-3" id="Proses">Save</button>
                                    <button type="button" class="btn btn-secondary me-1 mb-3" onclick="close_proses();" data-bs-dismiss="modal">Close</button>
                        </div>
                        
                  </form>
                </div>
              </div>
    </div>
<!-- end modal Proses -->

<!-- Modal  selesai data  -->
<div class="modal fade" id="Selesai_Modal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class ="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="Selesai_ModalLabel">Selesai</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="close_selesai();" aria-label="Close"></button>
      </div>
                <div class="modal-body">
                <form  id ="formedit"  class ="form form-horizontal">
                  <input type="hidden" class ="form-control" id="kode_kjn" value="">
                  <div class="row col-md-12 mb-3">  
                              <label for="tgl_selesai" class="col-sm-3 col-form-label">Tanggal Selesai</label>
                              <div class="col-sm-4">
                                <input type="text" class="form-control"  name="tgl_selesai" id="tgl_selesai" value="" required>
                              </div>
                      </div>
                      <div class="row col-md-12">  
                              <label for="ket_selesai" class="col-sm-3 col-form-label">Keterangan</label>
                              <div class="col-sm-8">
                                <textarea type="text" class="form-control"  name="ket_selesai" id="ket_selesai" value="" required></textarea>
                              </div>
                      </div>
                </div>
                        <div class="col-sm-11 d-flex justify-content-end">
                                    <button  type="sumbit" name="sumbit" class="btn btn-primary me-1 mb-3" id="Selesai">Save</button>
                                    <button type="button" onclick="close_selesai();" class="btn btn-secondary me-1 mb-3" id="close" data-bs-dismiss="modal">Close</button>
                        </div>
                        
                  </form>
                </div>
              </div>
    </div>
<!-- end modal selesai -->


<!-- Modal  selesai data  -->

<!-- end modal selesai -->

<div class="modal fade" id="Gambar_Modal" tabindex="-1" role="dialog"
  aria-labelledby="Gambar_ModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Gambar_ModalTitle">Foto Kunjungan</h5>
                <button type="button" class="close" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">

                <div id="Gallerycarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#Gallerycarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#Gallerycarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#Gallerycarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        <button type="button" data-bs-target="#Gallerycarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
                        </div>
                    <div class="carousel-inner" id="foto_kjn">
                        <div class="carousel-item active">
                            <img id="side_image1" class="d-block w-100">
                        </div>
                        <div class="carousel-item">
                            <img id="side_image2" class="d-block w-100">
                        </div>
                        <div class="carousel-item">
                            <img id="side_image3" class="d-block w-100">
                        </div>
                        <div class="carousel-item">
                            <img id="side_image4" class="d-block w-100">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#Gallerycarousel" role="button" type="button" data-bs-slide="prev">
                        <!-- <span class="carousel-control-prev-icon" aria-hidden="true"></span> -->
                        <img src="assets/images/back.png" aria-hidden="true"></span>
                      </a>
                    <a class="carousel-control-next" href="#Gallerycarousel" role="button" data-bs-slide="next">
                        <!-- <span class="carousel-control-next-icon" aria-hidden="true"></span> -->
                        <img src="assets/images/next.png" aria-hidden="true"></span>

                    </a>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- end lihat gambar -->

<!-- Modal  view email data  -->
<div class="modal fade" id="Send_emailModal" tabindex="-1" role="dialog" aria-labelledby="Send_emailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class ="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="Send_emailModalLabel">Message</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" id="close_email" aria-label="Close"></button>
      </div>
                <div class="modal-body">
                  <div id="title_id"></div>
                <input type ="hidden"  id="st_email" class ="form-control">
                <input type ="hidden"  id="id_kjn_email" class ="form-control">
                <textarea type="text" style="height:120px; font-size:18px;" class="form-control"  id="pesan_email"></textarea>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal" id="kirim_email">Send</button>
                  <button type="button" class="btn btn-secondary" id="close_email2" data-bs-dismiss="modal">Cancel</button>
                </div>
              </div>
    </div>
</div>
<!-- end modal view email data -->
<!-- Modal  view email data  -->
<div class="modal fade" id="View_emailModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class ="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="View_emailModalLabel">View Email</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal"aria-label="Close"></button>
      </div>
                <div class="modal-body">
                <input type ="hidden"  id="kode_email" class ="form-control">
                <div id="dataemail_view"></div>
                </div>
               
              </div>
    </div>
</div>
<!-- end modal view email data -->

<!-- Modal  edit  kirim email data  -->
<div class="modal fade" id="Kirim_Modal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class ="modal-content">
    <div class="modal-header">
          <span class ="col-md-8" id="title_k"></span>

        <button type="button" class="btn-close" data-bs-dismiss="modal" id="close_message" aria-label="Close"></button>
      </div>
                <div class="modal-body">
                
                <input type ="hidden"  id="edit_kode_email" class ="form-control">
                <div id="dataemail"></div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary " data-bs-dismiss="modal" id="save_email">Save</button>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
    </div>
</div>
<!-- end modal edit kirim email data -->
