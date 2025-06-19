
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
		<script src="assets/js/pdfmake.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
<!-- 
        <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap4.min.css" /> -->
<div id="tampildata">
  <div id="main">
  <?php include 'views/pages/burger.php' ?>
  
  <section class="section">
                    <div class="card">
                            <div class="card-header">
                            </div>
                        <div class="card-body">
                        <div id="grafik" class="mb-4"></div>
                        </div>
                    </div>
    </section>
 
  
  <!-- <div id="filter"> -->
      <!-- Basic Tables start -->
      
  <div id="tabelhead_sm"></div>
  <div id="tabelhead"></div>
      <!-- Basic Tables end -->
  </div>
</div>
</div>
<style>
@media print {
    @page {
      margin-top: 0;
      margin-bottom: 0;
    }

.highcharts-credits{
    display: none;
}
}
.board{
    font-weight: bold;
}
.nowrap{
    white-space: nowrap !important;
 }
</style>
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

      //untuk tabel sameri
      tabel_sameri(tahun);
      //end
    get_header(tahun);
    
    get_datagrafik(tahun,bulan);
    //end grafik
  $("#tabel_sm").on("click","tbody tr td",function(){
      
      let tahun ="";
      let status = "";
      let row = jQuery(this).closest('tr');
            let columns = row.find('td'); 
            columns.addClass('row-highlight');
            $.each(columns, function(key, item){
            switch(key){
                    case 0:
                        tahun = item.innerHTML;
                        break;
                    case 1:
                        status = item.innerHTML;
                        break;

                    }
            });
            $.ajax({
                url:'models/rpt_solusi/detail_all.php',
                method:'POST',
                data:{tahun:tahun,status:status},
                dataType:'json',
                    success:function(result){
                    $("#tabelhead_sm").hide();
                    $("#tabelhead").show();
                      get_table_detail();
                      data_detail(result)
                    }
                  });
    });

    $(document).on("click",".open-viewemail",function(){
        
        let tgl = $(this).data('tgl');
        let pesan = $(this).data('pesan');
        let open_email =`
        <table class="table">
                    <thead style="font-weight:bold">
                        <tr>
                            <td>Tanggal_Email</td>
                            <td>Pesan_Email</td>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                    <td>${tgl}</td>
                    <td>${pesan}</td>
                    </tr>
                    </tbody>
                </table>
        `;
        $("#viewemail").empty().html(open_email);
    })
//batas document ready
});

//untuk tampil head tabel sameri
    function get_head_sm(){
        
            let dataTable =`
            <section class="section">
                    <div class="card">
                            <div class="card-header">
                            </div>
                    
                        <div class="card-body">
                        <p id="title" class="page-title">
                        </p>
                        <table  style="cursor:pointer" id="tabel_sm" class='display table-info' >                    
                                        <thead  id='thead'class ='thead'>
                                        <tr>
                                                    <th>Tahun</th>
                                                    <th>Status</th>
                                                    <th>Jumlah</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table><br>
                                    </div>
                                </div>
                            </section>

            `;
        $("#tabelhead_sm").empty().html(dataTable);
    };

function tabel_sameri(tahun){
  get_head_sm();

  $.ajax({
      url:'models/rpt_solusi/report_full.php',
      method : 'POST',
      data :{tahun:tahun},
      dataType :'json',
      success : function(result){
        data_sameri(result);
      }
  });

}


function data_sameri(result){
  $("#tabel_sm").DataTable({
                    "ordering": false,
                    "destroy":true,
                    responsive: true,
                    columnDefs: [
                                    {
                                        targets:[0,1,2],
                                        className: 'board'}
                                    ],
                        fixedColumns:   {
                        // left: 1,
                            right: 1
                        },
                    "order":[[0,'desc']],
                    'rowCallback': function(row, data, index){
                        let status = data.status;
                        if(status == "kunjungan"){
                            $(row).find('td:eq(0)').css('color', '#0dcaf0');
                            $(row).find('td:eq(1)').css('color', '#0dcaf0');
                            $(row).find('td:eq(2)').css('color', '#0dcaf0');
                        }
                        if(status == "selesai"){
                            $(row).find('td:eq(0)').css('color', '#20c997');
                            $(row).find('td:eq(1)').css('color', '#20c997');
                            $(row).find('td:eq(2)').css('color', '#20c997');
                        }
                        if(status == "proses"){
                            $(row).find('td:eq(0)').css('color', '#6610f2');
                            $(row).find('td:eq(1)').css('color', '#6610f2');
                            $(row).find('td:eq(2)').css('color', '#6610f2');
                        }
                        if(status == "email"){
                            $(row).find('td:eq(0)').css('color', '#fd7e14');
                            $(row).find('td:eq(1)').css('color', '#fd7e14');
                            $(row).find('td:eq(2)').css('color', '#fd7e14');
                        }
             
                    
                    },
                        data: result,
                        pageLength: 5,
                        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']],
                              
                 
                            columns: [
                              { 'data': 'tahun' },
                              { 'data': 'status' },
                              { 'data': 'jumlah' },
                            ]      
                
              });
           
}
//end tampil head sameri

//fungsi untuk menamilkan data detail
  function data_detail(result){

             // let titles =`<h1 style="text-align:center;color:black;">Data Report Kunjungan ${tahun}</h1>`;

              $("#tabel1").DataTable({
                    "ordering": false,
                    "destroy":true,
                    responsive: true,
                    //dom: 'Bfrtip',
                    paging:true,
                    autoWidth: false,
                    // columnDefs: [
                    //                 {
                    //                     targets:[0,1,2,3,4,5,6,7,8,9,10,11],
                    //                     className: 'nowrap'}
                    //                 ],
                        fixedColumns:   {
                        // left: 1,
                            right: 1
                        },
                    "order":[[0,'desc']],
                   
                        data: result,
                        pageLength: 5,
                        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']],
                            columns: [
                              { 'data': 'tanggal' },
                              { 'data': 'id_kunjungan' },
                              { 'data': 'jenis_ktg' },
                              { 'data': 'peserta' },
                                { 'data': 'tujuan' },
                                { 'data': 'temuan' },
                                { 'data': 'divisi_terkait' },
                                { 'data': 'ket' },
                                { 'data': 'tanggal_proses',
                                    "render":function(data,type,row){
                                       
                                       if(data == "01-01-70"){
                                           let d = null
                                           return d;
                                       }else{
                                          
                                           return data
                                       }
                                   }
                                },
                                { 'data': 'ket_proses' },
                                { 'data': 'tanggal_selesai',
                                    "render":function(data,type,row){
                                       
                                    if(data == "01-01-70"){
                                        let d = null
                                        return d;
                                    }else{
                                       
                                        return data
                                    }
                                }
                                },
                                { 'data': 'ket_selesai' },
                                {
                                    "render":function(data,type,row){
                                        let dat = row.tanggal_email;
                                        let tgl ='';
                                        if(dat== "01-01-70"){
                                            tgl=null;
                                        }else{
                                            tgl= dat;
                                        }
                                     
                                        html  =`<button type="button" data-tgl="${tgl}" data-pesan="${row.pesan_email}"
                                         class="open-viewemail  btn btn-sm  mt-1" data-bs-toggle="modal" data-bs-target="#View_emailModal"><i class="fa-regular fa-envelope"></i></button>`;
                                    
                                    return html;  
                                    }
                                }
                             
                            ]      
                
              });
           
    }


//end data detail
  function get_rpt_solusi(tahun,bulan){
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
            url:'models/rpt_solusi/rpt_kunjungan.php',
            method:'POST',
            data:{tahun:tahun,bulan:bulan},
            dataType:'json',      
            success:function(result){
              let titles =`<h1 style="text-align:center;color:black;">Data Report Kunjungan ${tahun}</h1>`;

              $("#tabel1").DataTable({
                    "ordering": false,
                    "destroy":true,
                    dom: 'Bfrtip',
                    paging:true,
                    buttons: [
                       'copy', 'csv', 'excel', 'pdf', 'print'
                       ],
                    buttons: [
                        {extend: 'print',
                                    text: '<h6><i class="fa-solid fa-print fa-lg text-secondary"></i></h6>',
                                    messageTop: function () {
                                        return titles ;
                                    },
                                    title:" "
                        },
                 
                       ],
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
                                { 'data': 'tujuan' },
                                { 'data': 'temuan' },
                                { 'data': 'tanggal_proses' },
                                { 'data': 'ket_proses' },
                                { 'data': 'tanggal_selesai' },
                                { 'data': 'ket_selesai' },

                                
                              

                                // { "render": function (data, type) { 
                                //   // Tampilkan kolom aksi
                                 
                                //   let html  ='<button type="button"  class=" solusi btn btn-primary btn-sm btn-space">solusi<i class="fa-solid fa-pencil"></i></button>'

                                // // html += '<button type="button" class=" open-delete  btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa-solid fa-remove"></i></button>'
                                // return html;
                                //  }
                                // },

                             
                            ]      
                
              });
           
            }
    });      
    

};  

   

  function get_header(tahun){
    let data_headr =`
    <h5 class="text-center">Data Kunjungan Produksi ${tahun}</h5>
    `;
    $("#title").html(data_headr);
  }

  function get_table_detail(){
      //   let id ="#"+tabel;
      //   let substr_bulan = bulan.substr(0,3);
          let dataTable =`
          <section class="section">
                  <div class="card">
                      <div class="card-body">
                      <button onclick="goBack2()" class="btn btn-lg mb-2"><i class="fa-solid fa-arrow-left"></i></button>
                      <table id="tabel1" class='display table-info'style='width:100%'>                    
                                      <thead  id='thead'class ='thead'>
                                      <tr>
                                                  <th style="width:8%">Tgl</th>
                                                  <th>ID</th>
                                                  <th>Jenis</th>
                                                  <th>Peserta</th>
                                                  <th>Tujuan</th>
                                                  <th>Temuan</th>
                                                  <th>Divisi Terkait</th>
                                                  <th>Catatan</th>
                                                  <th style="width:8%">Tanggal Proses</th>
                                                  <th>Keterangan Proses</th>
                                                  <th style="width:8%">Tanggal Selesai</th>
                                                  <th>Keterangan Selesai</th>
                                                  <th></th>
                                                
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

  function readURL(input){
    let file = input.files[0];
    if(file){
              var reader = new FileReader();
  
              reader.onload = function(){
                  $("#imageResult").attr("src",reader.result);
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
    function goBack2() {
        $("#tabelhead_sm").show();
      $("#tabelhead").hide();
    
    }

    $( function() {
        $( "#tgl_solusi" ).datepicker(
          { "setDate": new Date(),
        "autoclose": true}
        );
   
  } );

//fungis untuk menamilkan grafik
function get_datagrafik(tahun,bulan){
        $.ajax({
                url:'models/rpt_solusi/data_grafik_full-kjn.php',
                method:'POST',
                data:{tahun:tahun,bulan:bulan},
                dataType:'json',      
                success:function(result){
                  get_grafik(result,tahun)
                }
            });

    }

function get_grafik(result,tahun){
        let text_t = 'Grafik Kunjungan Produksi '+' '+ tahun;
        Highcharts.chart('grafik', {
        title: {
            text: text_t,
            align: 'center'
        },
        subtitle: {
            text: '',
            align: 'left'
        },

        yAxis: {
            title: {
                text: ''
            }
        },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },

            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },


            plotOptions: {
                    series: {
                        cursor: 'pointer',
                        point: {
                            events: {
                                click: function() {
                                    alert ('Category: '+ this.category +', value: '+ this.y);
                                }
                            }
                        }
                    }
        },
    
    //untuk get data
            series:
                $.each(result,function(key,value){
                value
                }),
    //end get data                   
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }

    });

}
//end grafik


</script>


<!-- Modal  view email data  -->
<div class="modal fade" id="View_emailModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class ="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="View_emailModalLabel">View Email</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal"aria-label="Close"></button>
      </div>
                <div class="modal-body">
                    <div id="viewemail"></div>
       

                
           
                </div>
               
              </div>
    </div>
</div>
<!-- end modal view email data -->