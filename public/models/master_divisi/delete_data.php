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
  $kode_divisi = test_input($_POST["kode"]);

  $sql="DELETE FROM master_divisi WHERE kode_divisi = '".$kode_divisi."'"; 
	$result = odbc_exec($connection, $sql); 
  $sql2="DELETE FROM member_divisi_kunjungan WHERE kode_divisi = '".$kode_divisi."' "; 
	$result2 = odbc_exec($connection, $sql2); 
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
