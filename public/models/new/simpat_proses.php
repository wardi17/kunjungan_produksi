<?php

//include library
require_once ("../../models/koneksi.php");
$connection =$database->open_connection();

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}



$kode = test_input($_POST["kode_kjn"]);
$tgl_proses = test_input($_POST["tgl_proses"]);
$ket_proses = test_input($_POST["ket_proses"]);
$status_proses = 1;

$cek = 0;
$valid = 0;

if(!empty($kode)){
  $query = "SELECT DISTINCT status_proses FROM kunjungan_produksi where id_kunjungan ='$kode' ";
  $sql=odbc_exec($connection,$query);
  $rows= odbc_fetch_array($sql); 
  $rows_status = $rows["status_proses"];

  if(empty($rows_status)){
    $sql="UPDATE [kunjungan_produksi] SET tanggal_proses='".$tgl_proses."',ket_proses='".$ket_proses."',status_proses='".$status_proses."'
    WHERE id_kunjungan ='". $kode ."'
    ";
    $result = odbc_exec($connection, $sql);
    if(!$result){
      $cek =$cek+1;
    }
  
    if ($cek==0){
      odbc_commit($connection);
      $status['nilai']=1; //bernilai benar
      $status['error']="Data Berhasil update";
    }else{
      odbc_rollback($connection);
      $status['nilai']=0; //bernilai benar
      $status['error']="Data Gagal update";
    }
    odbc_close($connection);
  }else{
    $status['nilai']= 0; //bernilai salah
    $status['error']="kunjungan sudah di proses";
  }
echo json_encode($status);
}else{
  $satuts = 0;

  echo json_encode($status);
}