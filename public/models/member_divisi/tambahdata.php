<?php

//include library
require_once ("../../models/koneksi.php");
$connection =$database->open_connection();


session_start();
        
$user_log = $_SESSION['login_user'];

$class = $_SESSION['classku'];

if($user_log==""){
    header('Location: /bmi');
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


$kode_div = test_input($_POST["kode_div"]);
$nama = test_input($_POST["nama"]);
$email = test_input($_POST["email"]);
$dateEntry = date('Y-m-d H:i:s');
$username = $user_log;

$cek = 0;
$valid = 0;

if(!empty($email)){
  $query = "SELECT DISTINCT * FROM member_divisi_kunjungan where  email ='".$email."' ";
  $sql=odbc_exec($connection,$query);
  $rows= odbc_fetch_array($sql); 
 
  if($rows > 0){
        $valid=1;
    }
    if($valid == 0){
     $sql="INSERT INTO [member_divisi_kunjungan] (kode_divisi,nama,email,dateEntry,username) 
     Values ('". $kode_div ."','".$nama."','".$email."','".$dateEntry."','".$username."')"; 
    
     $result = odbc_exec($connection, $sql);
     if(!$result){
       $cek =$cek+1;
     }
   
     if ($cek==0){
       odbc_commit($connection);
       $status['nilai']=1; //bernilai benar
       $status['error']="Data Berhasil Ditambahkan";
     }else{
       odbc_rollback($connection);
       $status['nilai']=0; //bernilai benar
       $status['error']="Data Gagal Ditambahkan";
     }
     odbc_close($connection);
   
   
 
    }
    else{
     $status['nilai']= 0; //bernilai salah
     $status['error']="Email Sudah terdaftar silahkan ganti email";
     }
 
     echo json_encode($status);

}else{
  $satuts = 0;

  echo json_encode($nilai);
}