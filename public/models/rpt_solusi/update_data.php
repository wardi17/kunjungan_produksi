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



  
  $tgl_edit= test_input($_POST["tgl_edit"]);
  $tgl_solusi =test_input($_POST["tgl_solusi"]);
  $id_kj= test_input($_POST["id_kj"]);
  $kjn_edit= test_input($_POST["kjn_edit"]);
  $ket = test_input($_POST["ket"]);
  $jwb_solusi = test_input($_POST["jwb_solusi"]);


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
    $gambar1 = test_input($_POST["image1"]); 
   
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
    $gambar2 = test_input($_POST["image2"]); 
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
    $gambar3 = test_input($_POST["image3"]);
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
    $gambar4 = test_input($_POST["image4"]);
  }
}else{
  $gambar1 = test_input($_POST["image1"]);
  $gambar2 = test_input($_POST["image2"]); 
  $gambar3 = test_input($_POST["image3"]);
  $gambar4 = test_input($_POST["image4"]);
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

 ///cek hewan tidak boleh sama

if(!empty($id_kj)){
  $query = "SELECT DISTINCT * FROM Jawaban_kunjungan_produksi where id_kunjungan ='$id_kj' ";
  $sql=odbc_exec($connection,$query);
  $rows= odbc_fetch_array($sql); 
 
  if($rows > 0){
        $valid=1;
    }
 
 
    if($valid == 0){
$st = 1;
 $sql="INSERT INTO [Jawaban_kunjungan_produksi] (tgl_kunjungan,tgl_jawaban,id_kunjungan,jawab_solusi,image1,image2,image3,image4) 
 Values ('". $tgl_edit ."','".$tgl_solusi."', '". $id_kj ."', 
 '". $jwb_solusi ."','". $gambar1 ."','". $gambar2 ."','". $gambar3 ."','". $gambar4 ."')"; 
 $result = odbc_exec($connection, $sql);

$sql2="UPDATE [kunjungan_produksi] SET status ='".$st."' WHERE id_kunjungan ='". $id_kj ."'" ; 

$result2 = odbc_exec($connection, $sql2);
    if(!$result && !$result2){
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
  
  

 

    echo json_encode($status);
  }
}