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
$tgl_selesai = test_input($_POST["tgl_selesai"]);
$ket_selesai = test_input($_POST["ket_selesai"]);
$status_selesai = 1;

$cek = 0;

if(!empty($kode)){
  $query = "SELECT DISTINCT status_selesai FROM kunjungan_produksi where id_kunjungan ='$kode' ";
  $sql=odbc_exec($connection,$query);
  $rows= odbc_fetch_array($sql); 

  $rows_status = $rows["status_selesai"];

  if(empty($rows_status)){
    $sql="UPDATE [kunjungan_produksi] SET tanggal_selesai='".$tgl_selesai."',ket_selesai='".$ket_selesai."',status_selesai='".$status_selesai."'
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
    $status['error']="kunjungan sudah selesai";
  }
echo json_encode($status);
}else{
  $satuts = 0;

  echo json_encode($status);
}