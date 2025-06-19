<?php 


require_once ("../../models/koneksi.php");
$conn =$database->open_connection();

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  };
  

$tahun = test_input($_POST['tahun']);
$bulanpage = test_input($_POST['bulan']);


$query = "SELECT TOP 4 bulan_angka FROM bulan_kunjungan_produksi where bulan_angka<='".$bulanpage."' ORDER BY bulan_angka DESC";
$result =odbc_exec($conn,$query);
while($arr = odbc_fetch_array($result)){
  $ktg[] = $arr;
}; 


$kategory =['kunjungan','proses','selesai','email'];
$data_full =[];





foreach($ktg as $bln){

   $bulan = $bln['bulan_angka'];

  if($bulan == 1){
    $ttl_kjn = total_kujungan($conn,$tahun,$bulan);
    $ttl_pss = total_proses($conn,$tahun,$bulan);
    $ttl_ssi = total_selesai($conn,$tahun,$bulan);
    $ttl_eml = total_email($conn,$tahun,$bulan);

    $data_full[] =[
      'bulan_angka' =>$bulan,
      'bulan' => bulan($bulan),
      'ttl_kunjungan'=> $ttl_kjn,
      'ttl_proses' => $ttl_pss,
      'ttl_ssi' => $ttl_ssi,
      'ttl_eml' => $ttl_eml,
      ];
  }
  if($bulan == 2){
    $ttl_kjn = total_kujungan($conn,$tahun,$bulan);
    $ttl_pss = total_proses($conn,$tahun,$bulan);
    $ttl_ssi = total_selesai($conn,$tahun,$bulan);
    $ttl_eml = total_email($conn,$tahun,$bulan);

    $data_full[] =[
      'bulan_angka' =>$bulan,
      'bulan' => bulan($bulan),
      'ttl_kunjungan'=> $ttl_kjn,
      'ttl_proses' => $ttl_pss,
      'ttl_ssi' => $ttl_ssi,
      'ttl_eml' => $ttl_eml,
      ];
  }
  if($bulan == 3){
    $ttl_kjn = total_kujungan($conn,$tahun,$bulan);
    $ttl_pss = total_proses($conn,$tahun,$bulan);
    $ttl_ssi = total_selesai($conn,$tahun,$bulan);
    $ttl_eml = total_email($conn,$tahun,$bulan);

    $data_full[] =[
      'bulan_angka' =>$bulan,
      'bulan' => bulan($bulan),
      'ttl_kunjungan'=> $ttl_kjn,
      'ttl_proses' => $ttl_pss,
      'ttl_ssi' => $ttl_ssi,
      'ttl_eml' => $ttl_eml,
      ];
  }
  if($bulan == 4){
    $ttl_kjn = total_kujungan($conn,$tahun,$bulan);
    $ttl_pss = total_proses($conn,$tahun,$bulan);
    $ttl_ssi = total_selesai($conn,$tahun,$bulan);
    $ttl_eml = total_email($conn,$tahun,$bulan);

    $data_full[] =[
      'bulan_angka' =>$bulan,
      'bulan' => bulan($bulan),
      'ttl_kunjungan'=> $ttl_kjn,
      'ttl_proses' => $ttl_pss,
      'ttl_ssi' => $ttl_ssi,
      'ttl_eml' => $ttl_eml,
      ];
  }
  if($bulan == 5){
    $ttl_kjn = total_kujungan($conn,$tahun,$bulan);
    $ttl_pss = total_proses($conn,$tahun,$bulan);
    $ttl_ssi = total_selesai($conn,$tahun,$bulan);
    $ttl_eml = total_email($conn,$tahun,$bulan);

    $data_full[] =[
      'bulan_angka' =>$bulan,
      'bulan' => bulan($bulan),
      'ttl_kunjungan'=> $ttl_kjn,
      'ttl_proses' => $ttl_pss,
      'ttl_ssi' => $ttl_ssi,
      'ttl_eml' => $ttl_eml,
      ];
  }
  if($bulan == 6){
    $ttl_kjn = total_kujungan($conn,$tahun,$bulan);
    $ttl_pss = total_proses($conn,$tahun,$bulan);
    $ttl_ssi = total_selesai($conn,$tahun,$bulan);
    $ttl_eml = total_email($conn,$tahun,$bulan);

    $data_full[] =[
      'bulan_angka' =>$bulan,
      'bulan' => bulan($bulan),
      'ttl_kunjungan'=> $ttl_kjn,
      'ttl_proses' => $ttl_pss,
      'ttl_ssi' => $ttl_ssi,
      'ttl_eml' => $ttl_eml,
      ];
  }
  if($bulan == 7){
    $ttl_kjn = total_kujungan($conn,$tahun,$bulan);
    $ttl_pss = total_proses($conn,$tahun,$bulan);
    $ttl_ssi = total_selesai($conn,$tahun,$bulan);
    $ttl_eml = total_email($conn,$tahun,$bulan);

    $data_full[] =[
      'bulan_angka' =>$bulan,
      'bulan' => bulan($bulan),
      'ttl_kunjungan'=> $ttl_kjn,
      'ttl_proses' => $ttl_pss,
      'ttl_ssi' => $ttl_ssi,
      'ttl_eml' => $ttl_eml,
      ];
  }
  if($bulan == 8){
    $ttl_kjn = total_kujungan($conn,$tahun,$bulan);
    $ttl_pss = total_proses($conn,$tahun,$bulan);
    $ttl_ssi = total_selesai($conn,$tahun,$bulan);
    $ttl_eml = total_email($conn,$tahun,$bulan);

    $data_full[] =[
      'bulan_angka' =>$bulan,
      'bulan' => bulan($bulan),
      'ttl_kunjungan'=> $ttl_kjn,
      'ttl_proses' => $ttl_pss,
      'ttl_ssi' => $ttl_ssi,
      'ttl_eml' => $ttl_eml,
      ];
  }
  if($bulan == 9){
    $ttl_kjn = total_kujungan($conn,$tahun,$bulan);
    $ttl_pss = total_proses($conn,$tahun,$bulan);
    $ttl_ssi = total_selesai($conn,$tahun,$bulan);
    $ttl_eml = total_email($conn,$tahun,$bulan);

    $data_full[] =[
      'bulan_angka' =>$bulan,
      'bulan' => bulan($bulan),
      'ttl_kunjungan'=> $ttl_kjn,
      'ttl_proses' => $ttl_pss,
      'ttl_ssi' => $ttl_ssi,
      'ttl_eml' => $ttl_eml,
      ];
  }
  if($bulan == 10){
    $ttl_kjn = total_kujungan($conn,$tahun,$bulan);
    $ttl_pss = total_proses($conn,$tahun,$bulan);
    $ttl_ssi = total_selesai($conn,$tahun,$bulan);
    $ttl_eml = total_email($conn,$tahun,$bulan);

    $data_full[] =[
      'bulan_angka' =>$bulan,
      'bulan' => bulan($bulan),
      'ttl_kunjungan'=> $ttl_kjn,
      'ttl_proses' => $ttl_pss,
      'ttl_ssi' => $ttl_ssi,
      'ttl_eml' => $ttl_eml,
      ];
  }
  if($bulan == 11){
    $ttl_kjn = total_kujungan($conn,$tahun,$bulan);
    $ttl_pss = total_proses($conn,$tahun,$bulan);
    $ttl_ssi = total_selesai($conn,$tahun,$bulan);
    $ttl_eml = total_email($conn,$tahun,$bulan);

    $data_full[] =[
      'bulan_angka' =>$bulan,
      'bulan' => bulan($bulan),
      'ttl_kunjungan'=> $ttl_kjn,
      'ttl_proses' => $ttl_pss,
      'ttl_ssi' => $ttl_ssi,
      'ttl_eml' => $ttl_eml,
      ];
  }
  if($bulan == 12){
    $ttl_kjn = total_kujungan($conn,$tahun,$bulan);
    $ttl_pss = total_proses($conn,$tahun,$bulan);
    $ttl_ssi = total_selesai($conn,$tahun,$bulan);
    $ttl_eml = total_email($conn,$tahun,$bulan);

    $data_full[] =[
      'bulan_angka' =>$bulan,
      'bulan' => bulan($bulan),
      'ttl_kunjungan'=> $ttl_kjn,
      'ttl_proses' => $ttl_pss,
      'ttl_ssi' => $ttl_ssi,
      'ttl_eml' => $ttl_eml,
      ];
  }
 




}




  if(empty($data_full)){
    $data_full = null;
  
    echo json_encode($data_full);
  }else{
    
    echo json_encode($data_full);
  }


  function total_kujungan($conn,$tahun,$bulan){
    $sql =" SELECT COUNT(id_kunjungan) as jml FROM kunjungan_produksi WHERE YEAR(tanggal) ='".$tahun."' AND
    MONTH(tanggal) ='".$bulan."'";
    $result = odbc_exec($conn,$sql);
    $arr = odbc_fetch_array($result); 
    $jml= $arr['jml'];
      return $jml;
  

  }

  function total_proses($connection,$tahun,$mont){
    $query ="SELECT SUM(status_proses) as proses FROM kunjungan_produksi  WHERE YEAR(tanggal) ='".$tahun."'AND MONTH(tanggal) ='".$mont."'";
    $result2 = odbc_exec($connection,$query);
    $arr = odbc_fetch_array($result2); 
    $proses = $arr['proses'];
    if($proses == null){
      $p = 0;
    }else{
      $p = $proses;
    }
      
    return $p;
  
   }
  function total_selesai($connection,$tahun,$mont){
    $query2 ="SELECT SUM(status_selesai) as selesai FROM kunjungan_produksi  WHERE YEAR(tanggal) ='".$tahun."'AND MONTH(tanggal) ='".$mont."'";
    $result3 = odbc_exec($connection,$query2);
    $arr = odbc_fetch_array($result3); 
    $selesai = $arr['selesai'];

    if($selesai == null){
      $s = 0;
    }else{
      $s = $selesai;
    }
    return $s;
   
  } 

  function total_email($connection,$tahun,$mont){
    $query2 ="SELECT SUM(status_email) as email FROM kunjungan_produksi  WHERE YEAR(tanggal) ='".$tahun."'AND MONTH(tanggal) ='".$mont."'";
    $result3 = odbc_exec($connection,$query2);
    $arr = odbc_fetch_array($result3); 
    $selesai = $arr['email'];

    if($selesai == null){
      $s = 0;
    }else{
      $s = $selesai;
    }
    return $s;
   
  }

  
  function bulan($bulan){
            Switch ($bulan){
              case 1 : $bulan="Januari";
                  Break;
              case 2 : $bulan="Februari";
                  Break;
              case 3 : $bulan="Maret";
                  Break;
              case 4 : $bulan="April";
                  Break;
              case 5 : $bulan="Mei";
                  Break;
              case 6 : $bulan="Juni";
                  Break;
              case 7 : $bulan="Juli";
                  Break;
              case 8 : $bulan="Agustus";
                  Break;
              case 9 : $bulan="September";
                  Break;
              case 10 : $bulan="Oktober";
                  Break;
              case 11 : $bulan="November";
                  Break;
              case 12 : $bulan="Desember";
                  Break;
              }
            return $bulan;
        }         
