<?php 

require_once ("../../models/koneksi.php");
$conn =$database->open_connection();

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  };
  
$tahun =test_input($_POST['tahun']);

$kategory =['kunjungan','proses','selesai','email'];
$data_full =[];
foreach ($kategory as $ktg){
 
  if($ktg == 'kunjungan'){
    $bln_data = get_data($conn,$tahun);

    $data_full[] =[
      'tahun' => $tahun,
      'status' => $ktg,
      'jumlah'  => $bln_data
    ];
  }
  if($ktg == 'proses'){
    $bln_data = get_proses($conn,$tahun);
    $data_full[] =[
      'tahun' => $tahun,
      'status' => $ktg,
      'jumlah'  => $bln_data
    ];
  }
  if($ktg == 'selesai'){
    $bln_data = get_selesai($conn,$tahun);
    $data_full[] =[
      'tahun' => $tahun,
      'status' => $ktg,
      'jumlah'  => $bln_data
    ];
  }
  if($ktg == 'email'){
    $bln_data = get_email($conn,$tahun);
    $data_full[] =[
      'tahun' => $tahun,
      'status' => $ktg,
      'jumlah'  => $bln_data
    ];
  }
}

$json_encode = json_encode($data_full);

echo $json_encode;









  function get_proses($connection,$tahun){
    $query ="SELECT SUM(status_proses) as proses FROM kunjungan_produksi  WHERE YEAR(tanggal) ='".$tahun."'";
    $result2 = odbc_exec($connection,$query);
    $arr = odbc_fetch_array($result2); 
    $proses = $arr['proses'];
    return $proses;

  }
  function get_selesai($connection,$tahun){
    $query2 ="SELECT SUM(status_selesai) as selesai FROM kunjungan_produksi  WHERE YEAR(tanggal) ='".$tahun."'";
    $result3 = odbc_exec($connection,$query2);
    $arr = odbc_fetch_array($result3); 
    $selesai = $arr['selesai'];
    return $selesai;
  }  

  function get_email($connection,$tahun){
    $query2 ="SELECT SUM(status_email) as email FROM kunjungan_produksi  WHERE YEAR(tanggal) ='".$tahun."'";
    $result3 = odbc_exec($connection,$query2);
    $arr = odbc_fetch_array($result3); 
    $email = $arr['email'];
    return $email;
  } 
  function get_data($connection,$tahun){

    $sql =" SELECT COUNT(tanggal) as jml FROM kunjungan_produksi WHERE YEAR(tanggal) ='".$tahun."'";
    $result = odbc_exec($connection,$sql);
    $arr = odbc_fetch_array($result); 
    $jml = $arr['jml'];
    return $jml;

  }




