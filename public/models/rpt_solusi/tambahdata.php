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
  $tanggal =test_input($_POST["tanggal"]);
  $kunjungan = test_input($_POST["kunjungan"]);
  $ket = test_input($_POST["ket"]);


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
// $foto= [$gambar1,$gambar2,$gambar3,$gambar4];
// $fotos = implode(",",$foto);

 ///cek hewan tidak boleh sama

 if(!empty($id)){
  $query = "SELECT DISTINCT * FROM kunjungan_produksi where id_kunjungan ='$id' ";
  $sql=odbc_exec($connection,$query);
  $rows= odbc_fetch_array($sql); 
 
  if($rows > 0){
        $valid=1;
    }
 
 
    if($valid == 0){
     $sql="INSERT INTO [kunjungan_produksi] (tanggal,id_kunjungan,kunjungan,image1,image2,image3,image4,ket) 
     Values ('". $tanggal ."','".$id."', '". $kunjungan ."', '". $gambar1 ."', '". $gambar2 ."','". $gambar3 ."','". $gambar4 ."','". $ket."')"; 
    
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
     $status['error']="id_kunjungan Sudah terdaftar silahkan ganti";
     }
 
     echo json_encode($status);
 }
 

