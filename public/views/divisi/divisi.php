

<div id="data_divisi">
  <div id="main" style='width:50%'>
  <?php include 'views/pages/burger.php' ?>
  <section class="section">
        <div class="card">
          <div class="card-body">
          <div id="header_data"></div>
            <div class ="col-md-12 col-12">
                <!-- <h3 class="text-center">Target upload</h3> -->
                      <div class="col-md-12 text-end mb-3">
                                      <button type="button" class="btn btn-lg" data-bs-toggle="modal" data-bs-target="#TambaModal">
                                      <i class="fa-regular fa-file"></i>   
                      </div>
            </div>
      <!-- Basic Tables start -->
      <div id="tabelhead"></div>
      <!-- Basic Tables end -->
          </div>
        </div>
  </section>
 

  </div>

      <!-- Modal  tambah baru -->
      <div class="modal fade" id="TambaModal" tabindex="-1" aria-labelledby="TambahModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" id="close_tambah" aria-label="Close"></button>
              </div>
              <div class="modal-body">
              <form  id ="formtambah"  class ="form form-horizontal">
                
                          <div class="row col-md-12 mb-3">  
                                      <label for="kode_divisi" class="col-sm-3 col-form-label">Kode Divisi</label>
                                      <div class="col-sm-3">
                                        <input type="text" class="form-control"  name="kode_divisi" id="kode_divisi" value="" required>
                                      </div>
                              </div>
                              <div class="row col-md-12">  
                                      <label for="nama_divisi" class="col-sm-3 col-form-label">Nama Divisi</label>
                                      <div class="col-sm-6">
                                        <input type="text" class="form-control"  name="nama_divisi" id="nama_divisi" value="" required>
                                      </div>
                              </div>
                                
                              </div>
                                  <div class="col-sm-11 d-flex justify-content-end">
                                          <button  type="submit" name="submit" class="btn btn-primary me-1 mb-3" data-bs-dismiss="modal" id="Createdata">Save</button>
                                          <button type="button" class="btn btn-secondary me-1 mb-3" data-bs-dismiss="modal"  id="close_tambah2" >Close</button>
                                        </div>
            </form>
              </div>
      </div>
      </div>
      <!-- end modal tambah -->

        <!-- Modal delete -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class ="modal-content">
          <div class="modal-header">
              <h1 class="modal-title fs-5" id="EditModalLabel">Delete data</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" id="close_delete" aria-label="Close"></button>
            </div>
                      <div class="modal-body">
                        <form id="formdelete">
                            <div class="row col-md-12 mb-3">  
                                    <label for="kode_delete" class="col-sm-3 col-form-label">Kode Divisi</label>
                                    <div class="col-sm-3">
                                      <input disabled type="text" class="form-control"  name="kode_delete" id="kode_delete" value="" required>
                                    </div>
                            </div>
                            <div class="row col-md-12 mb-3">  
                                    <label for="div_delete" class="col-sm-3 col-form-label">Nama Divisi</label>
                                    <div class="col-sm-6">
                                      <input  disabled type="text" class="form-control "  name="div_delete" id="div_delete" value="" required>
                                    </div>
                            </div>
                          

                            <div class="col-sm-11 d-flex justify-content-end">
                                  <button  id="delete" class="btn btn-primary text-center me-1 md-3" data-bs-dismiss="modal" >Yes</button> 
                                <button  id="close_delete" type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                              </div>
                              
                        </form>
                      </div>
                    </div>
          </div>
        </div>
      <!-- end form delete  -->

      <!-- Modal  edit data  -->
      <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class ="modal-content">
          <div class="modal-header">
              <h1 class="modal-title fs-5" id="EditModalLabel">Edit data</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" id="close_edit" aria-label="Close"></button>
            </div>
                      <div class="modal-body">
                      <form  id ="formedit"  class ="form form-horizontal">
                        <div class="row col-md-12 mb-3">  
                                    <label for="kode_edit" class="col-sm-3 col-form-label">Kode Divisi</label>
                                    <div class="col-sm-3">
                                      <input disabled type="text" class="form-control"  name="kode_edit" id="kode_edit" value="" required>
                                    </div>
                            </div>
                            <div class="row col-md-12">  
                                    <label for="nama_edit" class="col-sm-3 col-form-label">Nama Divisi</label>
                                    <div class="col-sm-6">
                                      <input type="text" class="form-control"  name="nama_edit" id="nama_edit" value="" required>
                                    </div>
                            </div>
                      </div>
                              <div class="col-sm-11 d-flex justify-content-end">
                                          <button  type="submt" name="submit" class="btn btn-primary me-1 mb-3" data-bs-dismiss="modal" id="Editdata">Save</button>
                                          <button id="close_edit" type="button" class="btn btn-secondary me-1 mb-3" id="close" data-bs-dismiss="modal">Close</button>
                              </div>
                              
                        </form>
                      </div>
                    </div>
          </div>
      <!-- end modal edit -->



        <script>
            $(document).ready(function(){
              $("#member_divisi").hide();
                get_data_divisi();
                // $('input').keyup(function() {
                //     this.value = this.value.toLocaleUpperCase();
                // });
            //tambah data
              $("#Createdata").on('click',function(e){
                e.preventDefault();
            
                let kode = $("#kode_divisi").val();
                let nama = $("#nama_divisi").val();
                $.ajax({
                  url:'models/master_divisi/tambahdata.php',
                  method:'POST',
                  data:{kode:kode,nama:nama},
                  cache:true,
                  dataType:'json',
                  success:function(result){
                    let status = result.error;
                          Swal.fire({
                            position: 'top-center',
                          icon: 'success',
                          title: status,
                          // showConfirmButton: false,
                          // timer: 500000
                          }); 
                          $("#formtambah").trigger('reset');
                          get_data_divisi();
                  }
                })
              });
              //end tambah data
                // delete data 
                $(document).on("click",".open-delete",function(){
                  let row = jQuery(this).closest('tr');
                    let columns = row.find('td'); 
                
                    columns.addClass('row-highlight');
                    jQuery.each(columns, function(key, item) { 
                        switch(key){
                          case 0:
                      let kode = item.innerHTML;
                      $(".modal-body #kode_delete").val(kode);
                        break;
                        case 1:
                      let div = item.innerHTML;
                      $(".modal-body #div_delete").val(div);
                        break;
                      }
                    
                    });
                  
                


                });

                $("#delete").on("click",function(e){
                    e.preventDefault();
                    let kode = $("#kode_delete").val();
                
                    $.ajax({
                        url:"models/master_divisi/delete_data.php",
                        type:"POST",
                        data:{kode:kode},
                            dataType:'json',                  
                        success: function(result){ 
                          let status = result.error;
                          Swal.fire({
                            position: 'top-center',
                          icon: 'success',
                          title: status,
                        
                          }); 
                          get_data_divisi();
                        }
                    
                    })
                });
                //end delete data
                //edit data
                $(document).on("click",".open-edit",function(){
                
                      let row = jQuery(this).closest('tr');
                      let columns = row.find('td'); 
                      columns.addClass('row-highlight'); 
                      jQuery.each(columns, function(key, item) { 
                          switch(key){
                            case 0:
                              let kode = item.innerHTML;
                              $(".modal-body #kode_edit").val(kode);
                              break;
                            case 1:
                              let nama = item.innerHTML;
                              $(".modal-body #nama_edit").val(nama);
                              break;
                            
                          }

                });
              

            });
            
      //restet tambah
                  $("#close_tambah").on("click",function(e){
                    
                    e.preventDefault();
                    $("#formtambah").trigger("reset");
                  })
                  $("#close_tambah2").on("click",function(e){
                    
                    e.preventDefault();
                    $("#formtambah").trigger("reset");
                  })
      //reset tambah
      //restet edit
      $("#close_edit").on("click",function(e){
                    e.preventDefault();
                    $("#formedit").trigger("reset");
                  })
      //reset edit
      //restet delete
      $("#close_delete").on("click",function(e){
                    e.preventDefault();
                    $("#formedit").trigger("reset");
                  })
      //reset delete
                $("#Editdata").on("click",function(e){
                    e.preventDefault();
                  
                    let  kode = $("#kode_edit").val();
                    let  nama = $("#nama_edit").val();
                

                    $.ajax({
                        url:'models/master_divisi/edit_data.php',
                        type:'POST',
                        dataType:'json',
                        data :{kode:kode,nama:nama},
                    
                        success:function(result){
                          let status = result.error;
                          Swal.fire({
                            position: 'top-center',
                          icon: 'success',
                          title: status,
                          // showConfirmButton: false,
                          // timer: 500000
                          }); 
                          get_data_divisi();
                      
                        }
                    });
                });
            //end edit

            
            });



            function delete_row(){
            
            }

            function get_data_divisi(){


                $.ajax({
                        url:'models/master_divisi/tampildata.php',
                        method:'POST',
                        dataType:'json',      
                        success:function(response){
                        get_header();
                        get_tables();

                        $("#tabel1").DataTable({
                            
                            "ordering": false,
                            "destroy":true,
                            // dom: 'Plfrtip',
                            //     scrollCollapse: true,
                            paging:true,
                            //     "bPaginate":false,
                            //     "bLengthChange": false,
                            //     "bFilter": true,
                            //     "bInfo": false,
                            //     "bAutoWidth": false,
                            //     dom: 'lrt',
                                fixedColumns:   {
                                // left: 1,
                                    right: 1
                                },
                                pageLength: 5,
                                lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']],
                                            
                                data: response,
                                    columns: [
                                        { 'data': 'kode_divisi' },
                                        { 'data': 'nama_divisi' },
                                
                                    
                                        { "render": function ( data, type,row) { // Tampilkan kolom aksi
                                        
                                          let div = row.kode_divisi;
                                          let html  =`<button type="button"   class=" open-edit btn btn-lg btn-space" data-bs-toggle="modal" data-bs-target="#EditModal"><i class="fa-regular fa-pen-to-square"></i></button>`

                                        html += `<button type="button" class=" open-delete  btn  btn-lg" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa-regular fa-trash-can"></i></button>`
                                        html += `<button type="button" onclick ="member_div('${div}')"class="btn  btn-lg"><i class="fa-solid fa-binoculars"></i></button>`

                                        return html
                                        }
                                        },
                                    ]      
                        
                        });
                        }
                });      
            } 
            
            function get_header(){
                let data_headr =`

                <div  class="page-heading mb-3">
                <div class="page-title">
                <h4 class="text-center">Master Divisi </h4>
                </div></div>

                `;
                $("#header_data").html(data_headr);
            }
            function get_tables(){
                //   let id ="#"+tabel;
                //   let substr_bulan = bulan.substr(0,3);
                    let dataTable =`
                  
                                <table id="tabel1" class='display table-info' style='width:100%'>                    
                                                <thead  id='thead'class ='thead'>
                                                <tr>
                                                            <th style="width:2%">Kode Divisi</th>
                                                            <th style="width:3%">Nama Divisi</th>
                                                            <th style="width:2%">
                                                            <p class="text-center">Action</p></th>  
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                      

                    `;
                $("#tabelhead").empty().html(dataTable);
            };

            function member_div(div){
              getmember_divisi(div);
                $("#data_id").val(div);
                $("#data_divisi").hide();
                $("#member_divisi").show();
              
            }
        </script>
</div>



<!-- ================================================================================================================ -->

<!-- untuk fungsi data member divisi -->
<div id="member_divisi">

    <div id="main" style='width:50%'>
          <?php include 'views/pages/burger.php' ?>
          <section class="section">
              <div class="card">
            
                <div class="card-body">
                <div id="header_member"></div>
                  <div class ="col-md-12 col-12">
                    <!-- untuk mendapatkan data divisi -->
                      <input type="hidden" class="form-control" id="data_id" value="">
                      <!-- end id divisi -->
                      <button onclick="goBack()" class="btn btn-lg mb-4"><i class="fa-solid fa-chevron-left"></i></button>
                            <div class="col-md-12 text-end mb-3">
                                            <button type="button" class="btn btn-lg " data-bs-toggle="modal" data-bs-target="#TambaModal_divisi">
                                            <i class="fa-regular fa-file"></i>   
                            </div>
                  </div>
            <!-- Basic Tables start -->
            <div id="tables_mbr"></div>
            <!-- Basic Tables end -->
                </div>
              </div>
        </section>
    </div>


  <!-- Modal  tambah baru  member divisi-->
     <div class="modal fade" id="TambaModal_divisi" tabindex="-1" aria-labelledby="TambahModal_divisiLabel" aria-hidden="true">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah Member Divisi</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" id="close_mbr_tmb" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form  id ="formtambah_div"  class ="form form-horizontal">

                        <div class="row col-md-12 mb-3">  
                                    <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                                    <div class="col-sm-6">
                                      <input type="text" class="form-control"  name="nama" id="nama" value="" required>
                                    </div>
                            </div>
                            <div class="row col-md-12">  
                                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-6">
                                      <input type="email" class="form-control"  name="email" id="email" value="" required>
                                    </div>
                            </div>
                              
                            </div>
                                <div class="col-sm-11 d-flex justify-content-end">
                                        <button  type="submit" name="submit" class="btn btn-primary me-1 mb-3" data-bs-dismiss="modal" id="Create_member">Save</button>
                                        <button id="close_mbr_tmb" type="button" class="btn btn-secondary me-1 mb-3" data-bs-dismiss="modal">Close</button>
                                      </div>
          </form>
            </div>
    </div>
    </div>
  <!-- end tambah data member divisi-->

  <!-- Modal  edit data member_divisi -->
    <div class="modal fade" id="EditModal_Member" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog">
      <div class ="modal-content">
      <div class="modal-header">
          <h1 class="modal-title fs-5" id="EditModalLabel">Edit Member Divisi </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
                  <div class="modal-body">
                  <form  id ="formedit"  class ="form form-horizontal">
              
                                  <input type="hidden" class="form-control"  name="k_member_edt" id="k_member_edt" value="" required>
                        
                        <div class="row col-md-12 mb-3">  
                                <label for="n_member_edt" class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-6">
                                  <input type="text" class="form-control"  name="n_member_edt" id="n_member_edt" value="" required>
                                </div>
                        </div>
                        <div class="row col-md-12">  
                                <label for="e_member_edt" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-6">
                                  <input type="email" class="form-control"  name="e_member_edt" id="e_member_edt" value="" required>
                                </div>
                        </div>
                  </div>
                          <div class="col-sm-11 d-flex justify-content-end">
                                      <button  type="submit" name="submit" class="btn btn-primary me-1 mb-3" data-bs-dismiss="modal" id="Simpan_Memberedit">Save</button>
                                      <button type="button" class="btn btn-secondary me-1 mb-3"  data-bs-dismiss="modal">Close</button>
                          </div>
                          
                    </form>
                  </div>
                </div>
    </div>
  <!-- end modal edit member divisi -->

  <!-- Modal  delete data member_divisi -->
    <div class="modal fade" id="DeleteModal_Member" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog">
      <div class ="modal-content">
      <div class="modal-header">
          <h1 class="modal-title fs-5" id="DeleteModalLabel">Delete Member Divisi </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
                  <div class="modal-body">
                  <form  id ="formedit"  class ="form form-horizontal">
              
                                  <input type="hidden" class="form-control"  name="k_member_dlt" id="k_member_dlt" value="" required>
                        
                        <div class="row col-md-12 mb-3">  
                                <label for="n_member_dlt" class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-6">
                                  <input disabled type="text" class="form-control"  name="n_member_dlt" id="n_member_dlt" value="" required>
                                </div>
                        </div>
                        <div class="row col-md-12">  
                                <label for="e_member_dlt" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-6">
                                  <input  disabled type="email" class="form-control"  name="e_member_dlt" id="e_member_dlt" value="" required>
                                </div>
                        </div>
                  </div>
                          <div class="col-sm-11 d-flex justify-content-end">
                                      <button  type="submit" name="submit" class="btn btn-primary me-1 mb-3" data-bs-dismiss="modal" id="Simpan_Memberdelete">Yes</button>
                                      <button type="button" class="btn btn-secondary me-1 mb-3"  data-bs-dismiss="modal">No</button>
                          </div>
                          
                    </form>
                  </div>
                </div>
    </div>
  <!-- end modal delete -->         

    <script>
      // untuk tambah data member divisi
        $("#Create_member").on("click",function(e){
              e.preventDefault();
              let kode_div =  $("#data_id").val();
              let nama = $("#nama").val();
              let email = $("#email").val();
              
                $.ajax({
                  url:'models/member_divisi/tambahdata.php',
                  method:'POST',
                  data:{kode_div:kode_div,nama:nama,email:email},
                  cache:true,
                  dataType:'json',
                  success:function(result){
                    let status = result.error;
                        Swal.fire({
                        position: 'top-center',
                      icon: 'success',
                      title: status,
                    
                      }); 
                      $("#formtambah_div").trigger("reset");
                      getmember_divisi(kode_div);

                  }
                });
        });
      //end member tambah divisi

   $(document).on("click","#close_mbr_tmb",function(e){
    e.preventDefault();
    $("#formtambah_div").trigger("reset");
   });
      // fungsi untuk tampildata member divisi
      function getmember_divisi(kode){
        $.ajax({
                url:'models/member_divisi/tampildata.php',
                method:'POST',
                data :{kode:kode},
                dataType:'json',      
                success:function(response){

                header_mbr();
                tables_mbr();

                $("#tabel_mbr").DataTable({
                    response:true,
                    "ordering": false,
                    "destroy":true,
                    // dom: 'Plfrtip',
                    //     scrollCollapse: true,
                    paging:true,
                    //     "bPaginate":false,
                    //     "bLengthChange": false,
                    //     "bFilter": true,
                    //     "bInfo": false,
                    //     "bAutoWidth": false,
                    //     dom: 'lrt',
                        fixedColumns:   {
                        // left: 1,
                            right: 1
                        },
                        pageLength: 5,
                        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']],
                                    
                        data: response,
                            columns: [
                                { 'data': 'kode_divisi' },
                                { 'data': 'nama' },
                                { 'data': 'email' },

                            
                                { "render": function ( data, type,row) { // Tampilkan kolom aksi
                                
                                  let div = row.kode_divisi;
                                  let nama = row.nama;
                                  let email = row.email;
                                  let html  =`<button type="button" data-div="${div}" data-nama="${nama}" data-email ="${email}"  class=" open-Memberedit btn btn-lg btn-space" data-bs-toggle="modal" data-bs-target="#EditModal_Member"><i class="fa-regular fa-pen-to-square"></i></button>`
                                html += `<button type="button" data-div="${div}" data-nama="${nama}" data-email ="${email}"  class=" open-Memberdelete  btn  btn-lg" data-bs-toggle="modal" data-bs-target="#DeleteModal_Member"><i class="fa-regular fa-trash-can"></i></button>`

                                return html
                                }
                                },
                            ]      
                
                });
                }
        }); 
      }
      //end fungsi tampil divisi

      function header_mbr(){
        let data_headr =`

        <div  class="page-heading mb-3">
        <div class="page-title">
        <h4 class="text-center">Member Divisi </h4>
        </div></div>

        `;
        $("#header_member").html(data_headr);
    }

    function tables_mbr(){
        //   let id ="#"+tabel;
        //   let substr_bulan = bulan.substr(0,3);
            let dataTable =`
           
                        <table id="tabel_mbr" class='display table-info' style='width:100%'>                    
                                        <thead  id='thead'class ='thead'>
                                        <tr>
                                                    <th style="width:0%">Kode Divisi</th>
                                                    <th style="width:0%">Nama Member</th>
                                                    <th style="width:0%">Email</th>
                                                    <th style="width:0%">
                                                    <p class="text-center">Action</p></th>  
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                              

            `;
        $("#tables_mbr").empty().html(dataTable);
    };
      function goBack(){
        $("#data_divisi").show();
        $("#member_divisi").hide();
      }

  // untuk edit data member divisi
        $(document).on("click",".open-Memberedit",function(){
            let div = $(this).data('div');
            let nama = $(this).data('nama');
            let email = $(this).data('email');

           $("#k_member_edt").val(div);
           $("#n_member_edt").val(nama);
           $("#e_member_edt").val(email);

        });

        $(document).on("click","#Simpan_Memberedit",function(e){
          e.preventDefault();
          let div = $("#k_member_edt").val();
          let nama = $("#n_member_edt").val();
          let email = $("#e_member_edt").val();

          $.ajax({
                url:'models/member_divisi/edit_data.php',
                type:'POST',
                dataType:'json',
                data :{kode:div,nama:nama,email:email},
            
                success:function(result){
                  let status = result.error;
                  Swal.fire({
                    position: 'top-center',
                  icon: 'success',
                  title: status,
                  // showConfirmButton: false,
                  // timer: 500000
                  }); 
               
                  getmember_divisi(div);
                
                }
            });
           
        });
     //end edit data member divisi
// untuk delete data member divisi
        $(document).on("click",".open-Memberdelete",function(){
            let div = $(this).data('div');
            let nama = $(this).data('nama');
            let email = $(this).data('email');

           $("#k_member_dlt").val(div);
           $("#n_member_dlt").val(nama);
           $("#e_member_dlt").val(email);

        });

        $(document).on("click","#Simpan_Memberdelete",function(e){
          e.preventDefault();
          let div = $("#k_member_dlt").val();
          let nama = $("#n_member_dlt").val();
          let email = $("#e_member_dlt").val();

          $.ajax({
                url:'models/member_divisi/delete_data.php',
                type:'POST',
                dataType:'json',
                data :{kode:div,nama:nama,email:email},
            
                success:function(result){
                  let status = result.error;
                  Swal.fire({
                    position: 'top-center',
                  icon: 'success',
                  title: status,
                  // showConfirmButton: false,
                  // timer: 500000
                  }); 
               
                  getmember_divisi(div);
                
                }
            });
           
        });
     //end delete data member divisi



    </script>

</div>

<!-- and data tabel divisi -->