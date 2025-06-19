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



  $cek = 0;
  $valid = 0;
  
$id= test_input($_POST["id"]);
$peserta= test_input($_POST["peserta"]);
$tanggal =test_input($_POST["tanggal"]);
$tujuan= test_input($_POST["tujuan"]);
$temuan= test_input($_POST["temuan"]);
$ket = test_input($_POST["ket"]);
$divisi = test_input($_POST["divisi"]);
$divisi_trk = test_input($_POST["divisi_trk"]);

$jenis_ktg = test_input($_POST["jenis_ktg"]);


if(!empty($_FILES)){
 
    if(!empty($_FILES["image1"])){
      $fileupload      = $_FILES['image1']['tmp_name'];
      $ImageName       = $_FILES['image1']['name'];
      $ImageType       = $_FILES['image1']['type'];
      $error           = $_FILES["image1"]["error"];
      //  ganti nama
      $NewImageName = new_name($ImageName);
      if(($ImageType == "image/gif") || ($ImageType == "image/jpeg") || ($ImageType == "image/png") || ($ImageType == "image/pjpeg")){
        $filename =compress_image($fileupload, "../../uploads/" . $NewImageName, 80);
    
      }else{
        echo "Uploaded image should be jpg or gif or png.";
      }
      //  $pathupload = "https://27.123.222.151:886/bmi/public/visit/uploads/" . $newfilename;
      $gambar1 ="uploads/". $NewImageName;
      }else{
        $gambar1 ="";
      }

    if(!empty($_FILES["image2"])){
      $fileupload      = $_FILES['image2']['tmp_name'];
      $ImageName       = $_FILES['image2']['name'];
      $ImageType       = $_FILES['image2']['type'];
      $error           = $_FILES["image2"]["error"];
      //  ganti nama
        $NewImageName = new_name($ImageName);
    
        //  $newName = round(microtime(true).'.'.end($temp_name));

        if(($ImageType == "image/gif") || ($ImageType == "image/jpeg") || ($ImageType == "image/png") || ($ImageType == "image/pjpeg")){
          $filename =compress_image($fileupload, "../../uploads/" . $NewImageName, 80);
        }else{
          echo "Uploaded image should be jpg or gif or png.";
        }
        //  $pathupload = "https://27.123.222.151:886/bmi/public/visit/uploads/" . $newfilename;
        $gambar2 ="uploads/". $NewImageName;

      }else{
        $gambar2 ='';
      }

    if(!empty($_FILES["image3"])){
      $fileupload      = $_FILES['image3']['tmp_name'];
      $ImageName       = $_FILES['image3']['name'];
      $ImageType       = $_FILES['image3']['type'];
      $error           = $_FILES["image3"]["error"];
      //  ganti nama
        $NewImageName = new_name($ImageName);
    
        //  $newName = round(microtime(true).'.'.end($temp_name));

        if(($ImageType == "image/gif") || ($ImageType == "image/jpeg") || ($ImageType == "image/png") || ($ImageType == "image/pjpeg")){
          $filename =compress_image($fileupload, "../../uploads/" . $NewImageName, 80);
        }else{
          echo "Uploaded image should be jpg or gif or png.";
        }
        //  $pathupload = "https://27.123.222.151:886/bmi/public/visit/uploads/" . $newfilename;
        $gambar3 ="uploads/". $NewImageName;

      }else{
        $gambar3 ='';
      }

    if(!empty($_FILES["image4"])){
      $fileupload      = $_FILES['image4']['tmp_name'];
      $ImageName       = $_FILES['image4']['name'];
      $ImageType       = $_FILES['image4']['type'];
      $error           = $_FILES["image4"]["error"];
      //  ganti nama
        $NewImageName = new_name($ImageName);
    
        //  $newName = round(microtime(true).'.'.end($temp_name));

        if(($ImageType == "image/gif") || ($ImageType == "image/jpeg") || ($ImageType == "image/png") || ($ImageType == "image/pjpeg")){
          $filename =compress_image($fileupload, "../../uploads/" . $NewImageName, 80);
        }else{
          echo "Uploaded image should be jpg or gif or png.";
        }
        //  $pathupload = "https://27.123.222.151:886/bmi/public/visit/uploads/" . $newfilename;
        $gambar4 ="uploads/". $NewImageName;

      }else{
        $gambar4 ='';
    }
}else{
  $gambar1 ='';
  $gambar2 ='';
  $gambar3 ='';
  $gambar4 ='';
}



 if(!empty($id)){
  $query = "SELECT id_kunjungan FROM kunjungan_produksi where id_kunjungan ='".$id."' ";
  $sql1=odbc_exec($connection,$query);
  $rows= odbc_fetch_array($sql1); 
  $id_lama = $rows['id_kunjungan'];


  if($id_lama == $id){
        $valid=1;
    }
 
 
    if($valid == 0){
     $sql="INSERT INTO [kunjungan_produksi] (tanggal,id_kunjungan,tujuan,temuan,divisi,divisi_terkait,peserta,jenis_ktg,ket,image1,image2,image3,image4) 
     Values ('". $tanggal ."','".$id."', '". $tujuan ."','". $temuan."','".$divisi."','".$divisi_trk."', '".$peserta."','".$jenis_ktg."','".$ket."','". $gambar1 ."', '". $gambar2 ."','". $gambar3 ."','". $gambar4 ."')"; 
    
     $result = odbc_exec($connection, $sql);
     $st =1;
     $sql2="UPDATE [history_member_email] SET status_kode ='".$st."'  where id_kunjungan='$id' ";
     $result2 = odbc_exec($connection,$sql2);    
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
     $status['error']="id_kunjungan Sudah terdaftar silahkan ganti";
     }
 
     echo json_encode($status);
 }
 

 function compress_image($source_url, $destination_url, $quality)
 {
 
     $info = getimagesize($source_url);
     if ($info['mime'] == 'image/jpeg') 
     $image = imagecreatefromjpeg($source_url);
     elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($source_url);
     elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($source_url);
     imagejpeg($image, $destination_url, $quality);
     //echo "Image uploaded successfully.";
 }
 
 function new_name($ImageName){
   $acak           = rand(11111111, 99999999);
   $ImageExt       = substr($ImageName, strrpos($ImageName, '.'));
   $ImageExt       = str_replace('.','',$ImageExt); // Extension
   $ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
   $NewImageName   = str_replace(' ', '', $acak.'.'.$ImageExt);
 
   return $NewImageName;
 }