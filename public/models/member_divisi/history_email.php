<?php

$cek = 0;
require_once ("../../models/koneksi.php");
$connection =$database->open_connection();


session_start();
$user_log = $_SESSION['login_user'];
date_default_timezone_set('Asia/Jakarta');
$tanggal = date('Y-m-d h:i:s a');


$datas = $_POST['data'];

if($datas !== null){

$expload =json_decode($datas);


$kode = $expload->kode_email;
$to = $expload->to;
if($to == true){
  $to = 1;
}else{
  $to = 0;
}

$cc = $expload->cc;
if($cc == true){
  $cc = 1;
}else{
  $cc = 0;
}
$bcc = $expload->bcc;
if($bcc == true){
  $bcc = 1;
}else{
  $bcc = 0;
}

$status_to = $to;
$status_cc =$cc;
$status_bcc = $bcc;
$nama_div = $expload->nama_divisi;
$nama =$expload->nama;
$email =$expload->email;
$id = $expload->id;

$user_login = $user_log;




$sql="INSERT INTO [history_member_email] (id,id_kunjungan,nama_divisi,nama,email,status_to,status_cc,status_bcc,user_log,tanggal_log) 
Values ('".$id."','".$kode."','". $nama_div ."','".$nama."','".$email."','".$status_to."','".$status_cc."','".$status_bcc."','".$user_login."','".$tanggal."')"; 


$result = odbc_exec($connection, $sql);
if(!$result){
  $cek =$cek+1;
}

if ($cek==0){
  odbc_commit($connection);
  $status['nilai']=1; //bernilai benar
  $status['error']="Data Email berhasi di tambah";
}else{
  odbc_rollback($connection);
  $status['nilai']=0; //bernilai benar
  $status['error']="Data Email Gagal Ditambahkan";
}
odbc_close($connection);

echo json_encode($status);
}