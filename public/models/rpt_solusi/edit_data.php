<?php 

require_once ("../../models/koneksi.php");
$connection =$database->open_connection();
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  };

$id_kjn = test_input($_POST['id']);

$query = "SELECT * FROM kunjungan_produksi where id_kunjungan='".$id_kjn."'";
$result_set =odbc_exec($connection,$query);
$data =[];
while($datas = odbc_fetch_array($result_set)){
  $data[] =$datas;
}

  if(empty($data)){
    $data = null;
  
    echo json_encode($data);
  }else{
    
    echo json_encode($data);
  }