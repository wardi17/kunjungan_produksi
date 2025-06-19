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

  $divisi= test_input($_POST["divisi"]);
  $divisi_tkt= test_input($_POST["divisi_tkt"]);

  $jenis= test_input($_POST["jenis"]);
  $tgl_edit= test_input($_POST["tgl_edit"]);
  $id_kjn= test_input($_POST["id_kjn"]);
  $peserta= test_input($_POST["peserta"]);
  $tujuan= test_input($_POST["tujuan"]);
  $temuan= test_input($_POST["temuan"]);
  $ket = test_input($_POST["ket"]);


//die(var_dump($_FILES));
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

if(!empty($id_kjn)){

 //$st_email = 0;status_email = '". $st_email ."'
$sql="UPDATE [kunjungan_produksi] SET divisi='".$divisi."', divisi_terkait='".$divisi_tkt."',jenis_ktg ='".$jenis."',tanggal='".$tgl_edit."',tujuan ='".$tujuan."',temuan ='".$temuan."',peserta='".$peserta."',
 ket ='".$ket."',image1 ='".$gambar1."',image2 ='".$gambar2."',image3 ='".$gambar3."',image4 ='".$gambar4."'
 WHERE id_kunjungan ='". $id_kjn ."'" ; 
$result = odbc_exec($connection, $sql);
$st =1;
$sql2="UPDATE [history_member_email] SET status_kode ='".$st."'  where id_kunjungan='$id_kjn' ";
$result2 = odbc_exec($connection,$sql2);    
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
  
  

 

    echo json_encode($status);
  }
