<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>


<div id="tampildata">
  <div id="main">
  <?php include 'views/pages/burger.php' ?>
  <!-- <div id="filter"> -->
  <!-- <div>
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
  </div> -->

      <!-- Basic Tables start -->
      
  <div id="tabelhead"></div>
      <!-- Basic Tables end -->
  </div>
</div>
</div>

<script>

    $(document).ready(function(){
        get_tables()
    });
     function get_tables(){
      //   let id ="#"+tabel;
      //   let substr_bulan = bulan.substr(0,3);
          let dataTable =`
          <section class="section">
                  <div class="card">
                  <div class="card-header"></div>
                  <div  class="page-heading mb-3">
                      <div class="page-title">
                      <h5 class="text-center">Send Email</h5>
                      </div></div>
                      <div class="card-body">
                      <table id="tabel1" class="display table-info">                    
                                      <thead  id='thead'class ='thead'>
                                      <tr>      
                                                 <th style="width:8%">Tanggal</th>
                                                 <th style="width:3%">Jenis</th>
                                                  <th style="width:2%">Peserta</th>
                                                  <th style="width:29%">Tujuan</th>
                                                  <th style="width:30%">Temuan</th>
                                                  <th style="width:30%">Catatan</th>
                                                  <th style="width:15%">Foto/Edit</th>
                                                  <th style="width:20%">Action</th>       
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

</script>