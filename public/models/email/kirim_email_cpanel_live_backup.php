<?php


$nama = $_POST['nama'];
$email  =$_POST['to_data'];
$cc_data = $_POST['cc_data'];
$bcc_data = $_POST['bcc_data'];

    $image1 = $_POST['image1'];
     $image2 = $_POST['image2'];
     $image3 = $_POST['image3'];
     $image4 = $_POST['image4'];
     $nama = $_POST['nama'];
    $id_kjn=$_POST['id_kjn'];
    $tujuan=$_POST['tujuan'];
    
    $pesan=$_POST['pesan'];
    $tgl=$_POST['tgl'];
    $jenis=$_POST['jenis'];
    $divisi=$_POST['divisi'];
    $peserta=$_POST['peserta'];
    $tujuan=$_POST['tujuan'];
    $temuan=$_POST['temuan'];
    $divisi_tkt=$_POST['divisi_tkt'];
    $ket=$_POST['ket'];

    ini_set( 'display_errors', 1 );
   error_reporting( E_ALL );
   $from = "info.kunjungan@bestmegaindustri.com";
        $to = $email;
        $subject = $id_kjn ." ".$tujuan;
        $message = '<p>Dear All,</p>';
        $message .= '<p>'.$pesan.'</p>';
        $message .= '<p>Berikut data kunjungan produksi by CRM yang perlu diketahui :</p>';
        $message .='

        <form>
                    <div class="row">
                      <div style= "width:50%,float:left">
                    <table>
                        <tr>
                            <td>Tanggal</td>
                            <td><a>&nbsp;: &nbsp;</a>'.$tgl.'</td>
                        </tr>
                        <tr>
                            <td>Id</td>
                            <td><a>&nbsp;: &nbsp;</a> '.$id_kjn.'</td>
                        </tr>
                          <tr>
                            <td>Jenis</td>
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
                            <td>Tujuan </td>
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
            $gmbr1 = 'https://27.123.222.151:886/bmi/public/kunjungan_produksi/'.$image1;
          $message .= '<span><img src="'.$gmbr1.'" width="150" height="150" alt="Gambar1"></span>&nbsp;';
        }
        if(!empty($image2)){
            $gmbr2 = 'https://27.123.222.151:886/bmi/public/kunjungan_produksi/'.$image2;

          $message .='<span><img src="'.$gmbr2.'" width="150" height="150" alt="Gambar2"></span>&nbsp;';
        }
        if(!empty($image3)){
            $gmbr3 = 'https://27.123.222.151:886/bmi/public/kunjungan_produksi/'.$image3;

          $message .= '<span><img src="'.$gmbr3.'" width="150" height="150"alt="Gambar3"></span>&nbsp;';
        }
        if(!empty($image4)){
            $gmbr4 = 'https://27.123.222.151:886/bmi/public/kunjungan_produksi/'.$image4;
          $message .='<span><img src="'.$gmbr4.'" width="150" height="150" alt="Gambar4"></span>';
        }
       
      
       

        $message .= '<p>Regards, </p>';
        $message .= '<p><u>'.$nama.'</u></p>';

        // Batasi karakter ke dalam batas 70 karakter per baris
        $message = wordwrap($message, 2000, "\r\n");

        // Membuat batas unik untuk email
        $boundary = md5(time());

        // Header email
        $headers = "From: $from\r\n";
        $headers .= "Cc: $cc_data \r\n";
        $headers .= "Bcc: $bcc_data \r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: multipart/mixed; boundary=\"" . $boundary . "\"\r\n";

        // Isi email dengan teks dan lampiran
        $email_body = "--" . $boundary . "\r\n";
        $email_body .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $email_body .= "Content-Transfer-Encoding: base64\r\n\r\n";
        $email_body .= chunk_split(base64_encode($message));



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

        return $result;

  


?>
