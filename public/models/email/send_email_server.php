<?php 

session_start();
        
$user_log = $_SESSION['login_user'];


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
  $pesan = test_input($_POST["pesan"]);
  $tgl_email = date("Y-m-d h:i:s");
  $st_email =0;
 
  

 
  $sql="UPDATE [kunjungan_produksi] SET pesan_email= '". $pesan ."', tanggal_email = '". $tgl_email ."' , status_email = '". $st_email ."' 
  WHERE id_kunjungan = '". $id_kjn ."' "; 
  $result = odbc_exec($connection, $sql);


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



 $hasil =[];
    foreach ($data as $da){

      //$nama = $da['nama'];
      $email = $da['email'];
      $datas = get_data($connection,$id_kjn);
      $send = sendmail($user_log,$email,$datas,$connection,$pesan);
      $hasil [] = [
        $send
      ];
    }


  echo json_encode($hasil);

}  



function get_data($connection,$id_kjn){
  $query = "SELECT tanggal,id_kunjungan,jenis_ktg,divisi,divisi_terkait,peserta,tujuan,temuan,ket,image1,image2,image3,image4 FROM kunjungan_produksi WHERE id_kunjungan ='".$id_kjn."'";
  $result2 = odbc_exec($connection,$query);
$data = [];
while(odbc_fetch_row($result2)){
    $data[] = array(
        "tanggal"=>date('d/m/Y',strtotime(rtrim(odbc_result($result2,'tanggal')))),
        "id_kunjungan"=>rtrim(odbc_result($result2,'id_kunjungan')),
        "jenis_ktg"=>rtrim(odbc_result($result2,'jenis_ktg')),
        "divisi"=>rtrim(odbc_result($result2,'divisi')),  
        "divisi_terkait"=>rtrim(odbc_result($result2,'divisi_terkait')),  
        "peserta"=>rtrim(odbc_result($result2,'peserta')),
        "tujuan"=>rtrim(odbc_result($result2,'tujuan')),
        "temuan"=>rtrim(odbc_result($result2,'temuan')),
        "ket"=>rtrim(odbc_result($result2,'ket')),
        "image1"=>rtrim(odbc_result($result2,'image1')),
        "image2"=>rtrim(odbc_result($result2,'image2')),
        "image3"=>rtrim(odbc_result($result2,'image3')),
        "image4"=>rtrim(odbc_result($result2,'image4'))

    );
    }
    return $data;
}


function sendmail($nama,$email,$datas,$connection,$pesan){

          $tgl ="";
          $id_kjn = "";
          $jenis = "";
          $divisi = "";
          $peserta = "";
          $tujuan = "";
          $temuan = "";
          $ket = "";
          $divisi_tkt = "";
          $image1 ="";
          $image2 ="";
          $image3 ="";
          $image4 ="";
   

        foreach($datas as $item){
          $tgl = $item['tanggal'];
          $id_kjn =$item['id_kunjungan'];
          $jenis = $item['jenis_ktg'];
          $div_rpr = $item['divisi'];
          $div_rep = reprace_data($div_rpr);
          $divisi = $div_rep;
          $div_tkt = $item['divisi_terkait'];
          $expload = get_divtkt($div_tkt,$connection);
          $divisi_tkt = $expload;
          $peserta = $item['peserta'];
          $tujuan =$item['tujuan'];
          $temuan =$item['temuan'];
          $ket =$item['ket'];
          $image1 =$item['image1'];   
          $image2 =$item['image2'];
          $image3 =$item['image3'];
          $image4 =$item['image4'];
        }
        
        $url = 'https://bestmegaindustri.com/emailkun.php';
        $data = array('email'=>$email,'nama'=>$nama,
        'image1' => $image1,'image2' => $image2,'image3' => $image3,'image4' => $image4,
        'id_kjn' =>$id_kjn,'tujuan' =>$tujuan,'pesan' =>$pesan,'tgl' =>$tgl,'jenis' =>$jenis,'divisi' =>$divisi,
        'peserta' =>$peserta,'divisi_tkt' =>$divisi_tkt,'temuan' =>$temuan,'ket' =>$ket
        );
    
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        $result = curl_exec($ch);
      
        if (curl_errno($ch)) {
          // Penanganan kesalahan jika permintaan gagal
          echo 'Error sending POST request: ' . curl_error($ch);
        } else {
          // Penanganan respons dari server
          echo $result;
        }
    
        curl_close($ch);

  
}

function  get_divtkt($div_tkt,$connection){
  $temp = explode(",",$div_tkt);
  $result = "'" . implode ( "','", $temp )."'";


  // die(print_r($result));
  $query = "SELECT nama_divisi FROM master_divisi where kode_divisi in($result) ";
  $rows = odbc_exec($connection,$query);

  
  while(odbc_fetch_row($rows)){
  
      $data[] =
       odbc_result($rows,'nama_divisi');
      }
   $json = json_encode($data);
     
          $str_replace = str_replace("["," ",$json);
          $str_replace2 = str_replace("]"," ",$str_replace);
          $str_replace3 = str_replace('"','',$str_replace2);
          $str_replace4 = str_replace(',',', ',$str_replace3);

     return $str_replace4;

        
  
   
}
function  reprace_data($div_rpr){

  $str_replace = str_replace(',',', ',$div_rpr);
  return $str_replace;

}