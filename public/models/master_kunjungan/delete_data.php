<?php

$cek = 0;
require_once ("../../models/koneksi.php");
$connection =$database->open_connection();

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if (!empty($_POST["kode"])) {
  $kode_kjn = test_input($_POST["kode"]);

  $sql="DELETE FROM master_jenis_kunjungan WHERE kode_kjn = '".$kode_kjn."'"; 
	$result = odbc_exec($connection, $sql); 

  if(!$result){
    $cek = $cek+1;
  }
  if ($cek==0){
    odbc_commit($connection);
    $status['nilai']=1; //bernilai benar
    $status['error']="Data Berhasil Dihapus";
  }else{
    odbc_rollback($connection);
    $status['nilai']=0; //bernilai benar
    $status['error']="Data Gagal Dihapus";
  }

  odbc_close($connection);
  echo json_encode($status);

}
