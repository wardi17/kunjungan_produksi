<?php $from = "info.kunjungan@bestmegaindustri.com";
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
        $gabung1 = 'https://27.123.222.151:886/bmi/public/kunjungan_produksi/'.$image1;
    //     $data = file_get_contents($gabung1);
    //   $data1 =base64_encode($data);
    //     $attachment = $data1;
     
        if(!empty($image1)){  $message .= '<span><img src="'.$gabung1.'" width="150" height="150" alt="Gambar1"></span>&nbsp;';
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
        $boundary = md5("random");

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
        
            $gabung1r = 'http://localhost:8080/bmi/public/kunjungan_produksi/'.$image1;
          $datar = file_get_contents($gabung1r);
          $datar = chunk_split(base64_encode($datar));
  
          $attachment = $datar;
          $email_body .= "--" . $boundary . "\r\n";
          $email_body .= "Content-Type: image/jpeg; name=\"gambar.jpg\"\r\n";
          $email_body .= "Content-Transfer-Encoding: base64\r\n";
          $email_body .= "Content-Disposition: attachment;\r\n\r\n";
          $email_body .= $attachment . "\r\n";
      
     
          
      
     
      
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
