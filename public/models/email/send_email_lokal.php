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
  $st_email =1;
 
  

 
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
        $from = "info.kunjungan@bestmegaindustri.com";
        $to = $email;
        $subject = $id_kjn ." ".$tujuan;
        $message = '<p>Dear All,</p>';
        $message .= '<p>'.$pesan.'</p>';
        $message .= '<p>Berikut data kunjungan produksi yang perlu diketahui :</p>';
        $message .='

        <form>
                    <div class="row">
                      <div style= "width:50%,float:left">
                    <table>
                        <tr>
                            <td>Tgl Kunjungan</td>
                            <td><a>&nbsp;: &nbsp;</a>'.$tgl.'</td>
                        </tr>
                        <tr>
                            <td>Id Kunjungan</td>
                            <td><a>&nbsp;: &nbsp;</a> '.$id_kjn.'</td>
                        </tr>
                          <tr>
                            <td>Jenis Kunjungan</td>
                            <td><a>&nbsp;: &nbsp;</a>  '.$jenis.'</td>
                        </tr>
                        <tr>
                            <td>Divisi</td>
                            <td><a>&nbsp;: &nbsp;</a> '.$divisi.'</td>
                        </tr>
                        <tr>
                            <td>Peserta</td>
                            <td><a>&nbsp;: &nbsp;</a>  '.$peserta.'</td>
                        </tr>
                          <tr>
                            <td>Tujuan  </td>
                            <td><a>&nbsp;: &nbsp;</a> '.$tujuan.'</td>
                        </tr>
                        <tr>
                            <td>Temuan</td>
                            <td><a>&nbsp;: &nbsp;</a>  '.$temuan.'</td>
                        </tr>
                        <tr>
                            <td>Divisi Terkait</td>
                            <td><a>&nbsp;: &nbsp;</a>  '.$divisi_tkt.'</td>
                        </tr>
                        <tr>
                            <td>Catatan</td>
                            <td><a>&nbsp;: &nbsp;</a>  '.$ket.'</td>
                        </tr>
                    </table>  
                      </div>
                  </form>
        ';

        $message .= '<p>Foto Kunjungan : </p>';
        if(!empty($image1)){
          $message .= '<span><img src="gambar.jpg" width="150" height="150" alt="Gambar1"></span>&nbsp;';
        }
        if(!empty($image2)){
          $message .='<span><img src="gambar2.jpg" width="150" height="150" alt="Gambar2"></span>&nbsp;';
        }
        if(!empty($image3)){
          $message .= '<span><img src="gambar3.jpg" width="150" height="150"alt="Gambar3"></span>&nbsp;';
        }
        if(!empty($image4)){
          $message .='<span><img src="gambar4.jpg" width="150" height="150" alt="Gambar4"></span>';
        }
       
      
       

        $message .= '<p>Regards, </p>';
        $message .= '<p><u>'.$nama.'</u></p>';

        // Batasi karakter ke dalam batas 70 karakter per baris
        $message = wordwrap($message, 2000, "\r\n");

        // Membuat batas unik untuk email
        $boundary = md5(time());

        // Header email
        $headers = "From: $from\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: multipart/mixed; boundary=\"" . $boundary . "\"\r\n";

        // Isi email dengan teks dan lampiran
        $email_body = "--" . $boundary . "\r\n";
        $email_body .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $email_body .= "Content-Transfer-Encoding: base64\r\n\r\n";
        $email_body .= chunk_split(base64_encode($message));

        // Menambahkan lampiran gambar1
        
        
        if(!empty($image1)){
          $gabung1 = 'http://localhost:8080/bmi/public/kunjungan_produksi/'.$image1;
          $data = file_get_contents($gabung1);
          $data = chunk_split(base64_encode($data));
  
          $attachment = $data;
          $email_body .= "--" . $boundary . "\r\n";
          $email_body .= "Content-Type: image/jpeg; name=\"gambar.jpg\"\r\n";
          $email_body .= "Content-Transfer-Encoding: base64\r\n";
          $email_body .= "Content-Disposition: attachment;\r\n\r\n";
          $email_body .= $attachment . "\r\n";
          // $email_body .= "--" . $boundary . "--";
        }
        if(!empty($image2)){
          // Menambahkan lampiran gambar2
          $gabung2 = 'http://localhost:8080/bmi/public/kunjungan_produksi/'.$image2;
          $data2 = file_get_contents($gabung2);
          $data2 = chunk_split(base64_encode($data2));

          $attachment2 = $data2;
          $email_body .= "--" . $boundary . "\r\n";
          $email_body .= "Content-Type: image/jpeg; name=\"gambar2.jpg\"\r\n";
          $email_body .= "Content-Transfer-Encoding: base64\r\n";
          $email_body .= "Content-Disposition: attachment;\r\n\r\n";
          $email_body .= $attachment2 . "\r\n";
        }
        if(!empty($image3)){
            // Menambahkan lampiran gambar3
            $gabung3 = 'http://localhost:8080/bmi/public/kunjungan_produksi/'.$image3;
            $data3 = file_get_contents($gabung3);
            $data3 = chunk_split(base64_encode($data3));

            $attachment3 = $data3;
            $email_body .= "--" . $boundary . "\r\n";
            $email_body .= "Content-Type: image/jpeg; name=\"gambar3.jpg\"\r\n";
            $email_body .= "Content-Transfer-Encoding: base64\r\n";
            $email_body .= "Content-Disposition: attachment;\r\n\r\n";
            $email_body .= $attachment3 . "\r\n";
        }
        if(!empty($image4)){
              // Menambahkan lampiran gambar4
            $gabung4 = 'http://localhost:8080/bmi/public/kunjungan_produksi/'.$image4;
            $data4 = file_get_contents($gabung4);
            $data4 = chunk_split(base64_encode($data4));

            $attachment4 = $data4;
            $email_body .= "--" . $boundary . "\r\n";
            $email_body .= "Content-Type: image/jpeg; name=\"gambar4.jpg\"\r\n";
            $email_body .= "Content-Transfer-Encoding: base64\r\n";
            $email_body .= "Content-Disposition: attachment;\r\n\r\n";
            $email_body .= $attachment4 . "\r\n";
        }

        $email_body .= "--" . $boundary . "--";

        // Mengirim email
        $mail_sent = mail($to, $subject, $email_body, $headers);
 
        if ($mail_sent == true) {
              $result['nilai'] =1;
              $result['pesan'] ="Email berhasil dikirim.";

        } else {
          $result['nilai'] =0;
          $result['pesan'] ="Gagal mengirim email";
          
        }
 //die(var_dump($result));
        return $result;
  
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