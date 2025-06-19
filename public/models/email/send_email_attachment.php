<?php 
require 'class.mail.php';

require_once ("../../models/koneksi.php");
$connection =$database->open_connection();
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  };



if($_POST['id_kjn']){
  $id_kjn = test_input($_POST["id_kjn"]);
  $div_tkt = test_input($_POST["div_tkt"]);

  $query = "SELECT * FROM history_member_email  WHERE  id_kunjungan ='".$id_kjn."'  ORDER BY id  ASC";
  $result2 = odbc_exec($connection,$query);
$data = [];
while(odbc_fetch_row($result2)){
    $data[] = array(
        "nama"=>rtrim(odbc_result($result2,'nama')),
        "email"=>rtrim(odbc_result($result2,'email')),
        "status"=>rtrim(odbc_result($result2,'status')),
    );
    }

//   //die(print_r($kode_div));



// $hasil =[];
foreach ($data as $da){

  $nama = $da['nama'];
  $email = $da['email'];
   $data = get_data($connection,$id_kjn);
   $send = sendmail($nama,$email,$data);
  //echo json_encode($email);
}

//  $hasilda = $hasil[0];
//  echo json_encode($hasilda);
// if(empty($data)){
//     $data = null;
}  

//   }else{
    
//     echo json_encode($data);
//   }

function get_data($connection,$id_kjn){
  $query = "SELECT tanggal,id_kunjungan,jenis_ktg,divisi,peserta,tujuan,temuan,image1,image2,image3,image4 FROM kunjungan_produksi WHERE id_kunjungan ='".$id_kjn."'";
  $result2 = odbc_exec($connection,$query);
$data = [];
while(odbc_fetch_row($result2)){
    $data[] = array(
        "tanggal"=>date('d/m/Y',strtotime(rtrim(odbc_result($result2,'tanggal')))),
        "id_kunjungan"=>rtrim(odbc_result($result2,'id_kunjungan')),
        "jenis_ktg"=>rtrim(odbc_result($result2,'jenis_ktg')),
        "divisi"=>rtrim(odbc_result($result2,'divisi')),  
        "peserta"=>rtrim(odbc_result($result2,'peserta')),
        "tujuan"=>rtrim(odbc_result($result2,'tujuan')),
        "temuan"=>rtrim(odbc_result($result2,'temuan')),
        "image1"=>rtrim(odbc_result($result2,'image1')),
        "image2"=>rtrim(odbc_result($result2,'image2')),
        "image3"=>rtrim(odbc_result($result2,'image3')),
        "image4"=>rtrim(odbc_result($result2,'image4'))

    );
    }
    return $data;
}


function sendmail($nama,$email,$data){

  $tgl ="";
  $id_kjn = "";
  $jenis = "";
  $divisi = "";
  $peserta = "";
  $tujuan = "";
  $temuan = "";
  $image1 ="";
  $image2 ="";
  $image3 ="";
  $image4 ="";
foreach($data as $item){
   $tgl = $item['tanggal'];
   $id_kjn =$item['id_kunjungan'];
   $jenis = $item['jenis_ktg'];
   $divisi = $item['divisi'];
   $peserta = $item['peserta'];
   $tujuan =$item['tujuan'];
   $temuan =$item['temuan'];
   $image1 =$item['image1'];   
   $image2 =$item['image2'];
   $image3 =$item['image3'];
   $image4 =$item['image4'];
}



  ini_set( 'display_errors', 1 );
  error_reporting( E_ALL);
  $from = "info.kunjungan@bestmegaindustri.com";
  $to = $email;
  $subject = "Kunjungan Produksi";


  
  $headers = "From:" . $from;
  $headers .= "";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: multipart/mixed; boundary=\"boundary\"\r\n";

//$data = file_get_contents($image1);




$message ="
Tanggal :{$tgl}
Id Kunjungan :{$id_kjn} 
Jenis Kunjungan :{$jenis}
Divisi :{$divisi}
Peserta :{$peserta}
Tujuan :{$tujuan}
Temuan : {$temuan}
";


// Isi email dengan teks dan lampiran
$email_body   = "--boundary\r\n";
$email_body .= $message;

//Memasukkan data gambar sebagai attachment
$gabung1 = 'http://localhost:8080/bmi/public/kunjungan_produksi/'.$image1;
$data = file_get_contents($gabung1);
$data = chunk_split(base64_encode($data));


$email_body  .= "--boundary\r\n";

$email_body .= "Content-Type: image/jpeg; name=\"gambar.jpg\"\r\n";
$email_body .= "Content-Transfer-Encoding: base64\r\n";
$email_body .= "Content-Disposition: attachment;\r\n\r\n";
$email_body .= $data . "\r\n";

$email_body .= "--boundary--\r\n";

  mail($to,$subject,$email_body, $headers);
  echo "The email message was sent.";
}