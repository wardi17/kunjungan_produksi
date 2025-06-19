<?php
      require_once ("../../models/koneksi.php");
      $conn =$database->open_connection();

   
    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    // $bulan = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
  
        $tahun = test_input($_POST["tahun"]);
        $bulan = test_input($_POST["bulan"]);
    
        $data_full=[];
        $query = "SELECT bulan_angka FROM bulan_kunjungan_produksi ORDER BY bulan_angka ASC";
        $result =odbc_exec($conn,$query);
        while($arr = odbc_fetch_array($result)){
          $bln_k[] = $arr['bulan_angka'];
        }; 
      
        $kategory =['kunjungan','proses','selesai','email'];
        $data_full =[];
        foreach ($kategory as $ktg){
         
          if($ktg == 'kunjungan'){
            $bln_data = data_kunjungan_bulan($conn,$tahun,$bln_k);
            $data_full[] = $bln_data;
          }
          if($ktg == 'proses'){
            $bln_data = data_proses_bulan($conn,$tahun,$bln_k);
            $data_full[] = $bln_data;
          }
          if($ktg == 'selesai'){
            $bln_data = data_selesai_bulan($conn,$tahun,$bln_k);
            $data_full[] = $bln_data;
          }
          if($ktg == 'email'){
            $bln_data = data_email_bulan($conn,$tahun,$bln_k);
            $data_full[] = $bln_data;
          }
        }
  

  $json_encode = json_encode($data_full);
 
  echo $json_encode;


 function data_kunjungan_bulan($conn,$tahun,$bln_k){
  foreach($bln_k as $bln){

       
    if($bln == 1){
          $mont = 01;
          $get_data = get_data($conn,$tahun,$mont);
          $rowdata[] = $get_data;
          
        }
        elseif($bln == 2){
          $mont = 02;
          $get_data =get_data($conn,$tahun,$mont);
          $rowdata[] = $get_data;
        }
        elseif($bln == 3){
          $mont = 03;
          $get_data =get_data($conn,$tahun,$mont);
          $rowdata[] = $get_data;

        }
        elseif($bln == 4){
          $mont = 04;
          $get_data =get_data($conn,$tahun,$mont);
          $rowdata[] = $get_data;

        }
        elseif($bln == 5){
          $mont = 05;
          $get_data =get_data($conn,$tahun,$mont);
          $rowdata[] = $get_data;

        }
        elseif($bln == 6){
          $mont = 06;
          $get_data =get_data($conn,$tahun,$mont);
          $rowdata[] = $get_data;

        }
        elseif($bln == 7){
          $mont = 07;
          $get_data =get_data($conn,$tahun,$mont);
          $rowdata[] = $get_data;

        }
        elseif($bln == 8){
          $mont = 08;
          $get_data =get_data($conn,$tahun,$mont);
          $rowdata[] = $get_data;

        }
        elseif($bln == 9){
          $mont = 09;
          $get_data =get_data($conn,$tahun,$mont);
          $rowdata[] = $get_data;

        }
        elseif($bln == 10){
          $mont = 10;
          $get_data =get_data($conn,$tahun,$mont);
          $rowdata[] = $get_data;

        }
        elseif($bln == 11){
          $mont = 11;
          $get_data =get_data($conn,$tahun,$mont);
          $rowdata[] = $get_data;

        }
        elseif($bln == 12){
          $mont = 12;
          $get_data =get_data($conn,$tahun,$mont);
          $rowdata[] = $get_data;

        }
  }  
  // die(print_r($rowdata));
  $expload = implode(",",$rowdata);
 
  $int = array_map('intval', explode(',', $expload));

  $data_array=[
    'name'=>"kunjungan",
    'data'=> $int
  ];
  return $data_array;

 }

 function data_proses_bulan($conn,$tahun,$bln_k){
  foreach($bln_k as $bln){

       
    if($bln == 1){
          $mont = 01;
          $get_data = get_proses($conn,$tahun,$mont);
          $rowdata[] = $get_data;
          
        }
        elseif($bln == 2){
          $mont = 02;
          $get_data =get_proses($conn,$tahun,$mont);
          $rowdata[] = $get_data;
        }
        elseif($bln == 3){
          $mont = 03;
          $get_data =get_proses($conn,$tahun,$mont);
          $rowdata[] = $get_data;

        }
        elseif($bln == 4){
          $mont = 04;
          $get_data =get_proses($conn,$tahun,$mont);
          $rowdata[] = $get_data;

        }
        elseif($bln == 5){
          $mont = 05;
          $get_data =get_proses($conn,$tahun,$mont);
          $rowdata[] = $get_data;

        }
        elseif($bln == 6){
          $mont = 06;
          $get_data =get_proses($conn,$tahun,$mont);
          $rowdata[] = $get_data;

        }
        elseif($bln == 7){
          $mont = 07;
          $get_data =get_proses($conn,$tahun,$mont);
          $rowdata[] = $get_data;

        }
        elseif($bln == 8){
          $mont = 08;
          $get_data =get_proses($conn,$tahun,$mont);
          $rowdata[] = $get_data;

        }
        elseif($bln == 9){
          $mont = 09;
          $get_data =get_proses($conn,$tahun,$mont);
          $rowdata[] = $get_data;

        }
        elseif($bln == 10){
          $mont = 10;
          $get_data =get_proses($conn,$tahun,$mont);
          $rowdata[] = $get_data;

        }
        elseif($bln == 11){
          $mont = 11;
          $get_data =get_proses($conn,$tahun,$mont);
          $rowdata[] = $get_data;

        }
        elseif($bln == 12){
          $mont = 12;
          $get_data =get_proses($conn,$tahun,$mont);
          $rowdata[] = $get_data;

        }
  }  
  // die(print_r($rowdata));
  $expload = implode(",",$rowdata);
 
  $int = array_map('intval', explode(',', $expload));

  $data_array=[
    'name'=>"proses",
    'data'=> $int
  ];
  return $data_array;

 }
 function data_selesai_bulan($conn,$tahun,$bln_k){
  foreach($bln_k as $bln){

    if($bln == 1){
          $mont = 01;
          $get_data = get_selesai($conn,$tahun,$mont);
          $rowdata[] = $get_data;
          
        }
        elseif($bln == 2){
          $mont = 02;
          $get_data =get_selesai($conn,$tahun,$mont);
          $rowdata[] = $get_data;
        }
        elseif($bln == 3){
          $mont = 03;
          $get_data =get_selesai($conn,$tahun,$mont);
          $rowdata[] = $get_data;

        }
        elseif($bln == 4){
          $mont = 04;
          $get_data =get_selesai($conn,$tahun,$mont);
          $rowdata[] = $get_data;

        }
        elseif($bln == 5){
          $mont = 05;
          $get_data =get_selesai($conn,$tahun,$mont);
          $rowdata[] = $get_data;

        }
        elseif($bln == 6){
          $mont = 06;
          $get_data =get_selesai($conn,$tahun,$mont);
          $rowdata[] = $get_data;

        }
        elseif($bln == 7){
          $mont = 07;
          $get_data =get_selesai($conn,$tahun,$mont);
          $rowdata[] = $get_data;

        }
        elseif($bln == 8){
          $mont = 08;
          $get_data =get_selesai($conn,$tahun,$mont);
          $rowdata[] = $get_data;

        }
        elseif($bln == 9){
          $mont = 09;
          $get_data =get_selesai($conn,$tahun,$mont);
          $rowdata[] = $get_data;

        }
        elseif($bln == 10){
          $mont = 10;
          $get_data =get_selesai($conn,$tahun,$mont);
          $rowdata[] = $get_data;

        }
        elseif($bln == 11){
          $mont = 11;
          $get_data =get_selesai($conn,$tahun,$mont);
          $rowdata[] = $get_data;

        }
        elseif($bln == 12){
          $mont = 12;
          $get_data =get_selesai($conn,$tahun,$mont);
          $rowdata[] = $get_data;

        }
  }  
  // die(print_r($rowdata));
  $expload = implode(",",$rowdata);
 
  $int = array_map('intval', explode(',', $expload));

  $data_array=[
    'name'=>"selesai",
    'data'=> $int
  ];
  return $data_array;

 }

 function data_email_bulan($conn,$tahun,$bln_k){
  foreach($bln_k as $bln){

    if($bln == 1){
          $mont = 01;
          $get_data = get_email($conn,$tahun,$mont);
          $rowdata[] = $get_data;
          
        }
        elseif($bln == 2){
          $mont = 02;
          $get_data =get_email($conn,$tahun,$mont);
          $rowdata[] = $get_data;
        }
        elseif($bln == 3){
          $mont = 03;
          $get_data =get_email($conn,$tahun,$mont);
          $rowdata[] = $get_data;

        }
        elseif($bln == 4){
          $mont = 04;
          $get_data =get_email($conn,$tahun,$mont);
          $rowdata[] = $get_data;

        }
        elseif($bln == 5){
          $mont = 05;
          $get_data =get_email($conn,$tahun,$mont);
          $rowdata[] = $get_data;

        }
        elseif($bln == 6){
          $mont = 06;
          $get_data =get_email($conn,$tahun,$mont);
          $rowdata[] = $get_data;

        }
        elseif($bln == 7){
          $mont = 07;
          $get_data =get_email($conn,$tahun,$mont);
          $rowdata[] = $get_data;

        }
        elseif($bln == 8){
          $mont = 08;
          $get_data =get_email($conn,$tahun,$mont);
          $rowdata[] = $get_data;

        }
        elseif($bln == 9){
          $mont = 09;
          $get_data =get_email($conn,$tahun,$mont);
          $rowdata[] = $get_data;

        }
        elseif($bln == 10){
          $mont = 10;
          $get_data =get_email($conn,$tahun,$mont);
          $rowdata[] = $get_data;

        }
        elseif($bln == 11){
          $mont = 11;
          $get_data =get_email($conn,$tahun,$mont);
          $rowdata[] = $get_data;

        }
        elseif($bln == 12){
          $mont = 12;
          $get_data =get_email($conn,$tahun,$mont);
          $rowdata[] = $get_data;

        }
  }  
  // die(print_r($rowdata));
  $expload = implode(",",$rowdata);
 
  $int = array_map('intval', explode(',', $expload));

  $data_array=[
    'name'=>"email",
    'data'=> $int
  ];
  return $data_array;

 }



 function get_proses($connection,$tahun,$mont){
  $query ="SELECT SUM(status_proses) as proses FROM kunjungan_produksi  WHERE YEAR(tanggal) ='".$tahun."'AND MONTH(tanggal_proses) ='".$mont."'";
  $result2 = odbc_exec($connection,$query);
  $arr = odbc_fetch_array($result2); 
  $proses = $arr['proses'];
  return $proses;

 }
function get_selesai($connection,$tahun,$mont){
  $query2 ="SELECT SUM(status_selesai) as selesai FROM kunjungan_produksi  WHERE YEAR(tanggal) ='".$tahun."'AND MONTH(tanggal_selesai) ='".$mont."'";
  $result3 = odbc_exec($connection,$query2);
  $arr = odbc_fetch_array($result3); 
  $selesai = $arr['selesai'];
  return $selesai;
}    

function get_data($connection,$tahun,$mont){
 
  $sql =" SELECT COUNT(tanggal) as jml FROM kunjungan_produksi WHERE YEAR(tanggal) ='".$tahun."'AND MONTH(tanggal) ='".$mont."'";
  $result = odbc_exec($connection,$sql);
  $arr = odbc_fetch_array($result); 
  $jml = $arr['jml'];
  return $jml;
  
  // $query2 ="SELECT $jml as kunjungan ,SUM(status_proses) as proses,SUM(status_selesai) as selesai FROM kunjungan_produksi  WHERE YEAR(tanggal) ='".$tahun."'AND MONTH(tanggal) ='".$mont."'";
  // $result3 = odbc_exec($connection,$query2);
  // $arr = odbc_fetch_array($result3); 
  // $selesai = $arr;
  
  // return $selesai;

}

function get_email($connection,$tahun,$mont){
  $query2 ="SELECT SUM(status_email) as email FROM kunjungan_produksi  WHERE YEAR(tanggal) ='".$tahun."'AND MONTH(tanggal) ='".$mont."'";
  $result3 = odbc_exec($connection,$query2);
  $arr = odbc_fetch_array($result3); 
  $selesai = $arr['email'];
  return $selesai;
}  

?>