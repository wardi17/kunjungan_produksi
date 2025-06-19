<?php 

require_once ("../../models/koneksi.php");
$connection =$database->open_connection();
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  };

//$bulanpage = test_input($_POST['bulan']);
$tahun =test_input($_POST['tahun']);
$status =test_input($_POST['status']);

if($status == "All"){
    $query = "SELECT * FROM kunjungan_produksi where YEAR(tanggal)='".$tahun."' ORDER BY tanggal DESC";
    $result2=odbc_exec($connection,$query);
    while(odbc_fetch_row($result2)){
    $data[] = array(
      "tanggal"=>date('d-m-y',strtotime(rtrim(odbc_result($result2,'tanggal')))),
      "id_kunjungan"=>rtrim(odbc_result($result2,'id_kunjungan')),
        "tujuan"=>rtrim(odbc_result($result2,'tujuan')),
        "temuan"=>odbc_result($result2,'temuan'),
        "divisi"=>rtrim(odbc_result($result2,'divisi')),
        "peserta"=>rtrim(odbc_result($result2,'peserta')),
        "jenis_ktg"=>rtrim(odbc_result($result2,'jenis_ktg')),
        "ket"=>rtrim(odbc_result($result2,'ket')),
        "status_proses"=>rtrim(odbc_result($result2,'status_proses')),
        "ket_proses"=>rtrim(odbc_result($result2,'ket_proses')),
        "tanggal_proses"=>date('d-m-Y',strtotime(rtrim(odbc_result($result2,'tanggal_proses')))),
        "status_selesai"=>rtrim(odbc_result($result2,'status_selesai')),
        "tanggal_selesai"=>date('d-m-Y',strtotime(rtrim(odbc_result($result2,'tanggal_selesai')))),
        "ket_selesai"=>rtrim(odbc_result($result2,'ket_selesai')), 
        "divisi_terkait"=>rtrim(odbc_result($result2,'divisi_terkait')), 
        "status_email"=>rtrim(odbc_result($result2,'status_email')),
        "tanggal_email"=>date('d-m-y',strtotime(rtrim(odbc_result($result2,'tanggal_email')))),
        "pesan_email"=>rtrim(odbc_result($result2,'pesan_email')), 
    );
    }


    if(empty($data)){
      $data = null;
      echo json_encode($data);
    }else{
      echo json_encode($data);
    }
}elseif($status =="Belum Proses"){
  $st = 0;
  $query = "SELECT * FROM kunjungan_produksi where YEAR(tanggal)='".$tahun."' AND status_proses='".$st."'  ORDER BY tanggal ASC";
  $result2=odbc_exec($connection,$query);
  while(odbc_fetch_row($result2)){
  $data[] = array(
    "tanggal"=>date('d-m-y',strtotime(rtrim(odbc_result($result2,'tanggal')))),
    "id_kunjungan"=>rtrim(odbc_result($result2,'id_kunjungan')),
      "tujuan"=>rtrim(odbc_result($result2,'tujuan')),
      "temuan"=>rtrim(odbc_result($result2,'temuan')),
      "divisi"=>rtrim(odbc_result($result2,'divisi')),
      "peserta"=>rtrim(odbc_result($result2,'peserta')),
      "jenis_ktg"=>rtrim(odbc_result($result2,'jenis_ktg')),
      "ket"=>rtrim(odbc_result($result2,'ket')),
      "status_proses"=>rtrim(odbc_result($result2,'status_proses')),
      "ket_proses"=>rtrim(odbc_result($result2,'ket_proses')),
      "tanggal_proses"=>date('d-m-Y',strtotime(rtrim(odbc_result($result2,'tanggal_proses')))),
      "status_selesai"=>rtrim(odbc_result($result2,'status_selesai')),
      "tanggal_selesai"=>date('d-m-Y',strtotime(rtrim(odbc_result($result2,'tanggal_selesai')))),
      "ket_selesai"=>rtrim(odbc_result($result2,'ket_selesai')), 
      "divisi_terkait"=>rtrim(odbc_result($result2,'divisi_terkait')), 
      "status_email"=>rtrim(odbc_result($result2,'status_email')),
      "tanggal_email"=>date('d-m-y',strtotime(rtrim(odbc_result($result2,'tanggal_email')))),
      "pesan_email"=>rtrim(odbc_result($result2,'pesan_email')), 
  );
  }
  if(empty($data)){
    $data = null;
    echo json_encode($data);
  }else{
    echo json_encode($data);
  }
}
elseif($status =="Belum Selesai"){
  $st = 0;
  $query = "SELECT * FROM kunjungan_produksi where YEAR(tanggal)='".$tahun."' AND status_selesai='".$st."'  ORDER BY tanggal ASC";
  $result2=odbc_exec($connection,$query);
  while(odbc_fetch_row($result2)){
  $data[] = array(
    "tanggal"=>date('d-m-y',strtotime(rtrim(odbc_result($result2,'tanggal')))),
    "id_kunjungan"=>rtrim(odbc_result($result2,'id_kunjungan')),
      "tujuan"=>rtrim(odbc_result($result2,'tujuan')),
      "temuan"=>rtrim(odbc_result($result2,'temuan')),
      "divisi"=>rtrim(odbc_result($result2,'divisi')),
      "peserta"=>rtrim(odbc_result($result2,'peserta')),
      "jenis_ktg"=>rtrim(odbc_result($result2,'jenis_ktg')),
      "ket"=>rtrim(odbc_result($result2,'ket')),
      "status_proses"=>rtrim(odbc_result($result2,'status_proses')),
      "ket_proses"=>rtrim(odbc_result($result2,'ket_proses')),
      "tanggal_proses"=>date('d-m-Y',strtotime(rtrim(odbc_result($result2,'tanggal_proses')))),
      "status_selesai"=>rtrim(odbc_result($result2,'status_selesai')),
      "tanggal_selesai"=>date('d-m-Y',strtotime(rtrim(odbc_result($result2,'tanggal_selesai')))),
      "ket_selesai"=>rtrim(odbc_result($result2,'ket_selesai')), 
      "divisi_terkait"=>rtrim(odbc_result($result2,'divisi_terkait')), 
      "status_email"=>rtrim(odbc_result($result2,'status_email')),
      "tanggal_email"=>date('d-m-y',strtotime(rtrim(odbc_result($result2,'tanggal_email')))),
      "pesan_email"=>rtrim(odbc_result($result2,'pesan_email')), 
  );
  }
  if(empty($data)){
    $data = null;
    echo json_encode($data);
  }else{
    echo json_encode($data);
  }
}
elseif($status =="Proses"){
  $st = 1;
  $query = "SELECT * FROM kunjungan_produksi where YEAR(tanggal)='".$tahun."' AND status_proses='".$st."'  ORDER BY tanggal ASC";
  $result2=odbc_exec($connection,$query);
  while(odbc_fetch_row($result2)){
  $data[] = array(
    "tanggal"=>date('d-m-y',strtotime(rtrim(odbc_result($result2,'tanggal')))),
    "id_kunjungan"=>rtrim(odbc_result($result2,'id_kunjungan')),
      "tujuan"=>rtrim(odbc_result($result2,'tujuan')),
      "temuan"=>rtrim(odbc_result($result2,'temuan')),
      "divisi"=>rtrim(odbc_result($result2,'divisi')),
      "peserta"=>rtrim(odbc_result($result2,'peserta')),
      "jenis_ktg"=>rtrim(odbc_result($result2,'jenis_ktg')),
      "ket"=>rtrim(odbc_result($result2,'ket')),
      "status_proses"=>rtrim(odbc_result($result2,'status_proses')),
      "ket_proses"=>rtrim(odbc_result($result2,'ket_proses')),
      "tanggal_proses"=>date('d-m-Y',strtotime(rtrim(odbc_result($result2,'tanggal_proses')))),
      "status_selesai"=>rtrim(odbc_result($result2,'status_selesai')),
      "tanggal_selesai"=>date('d-m-Y',strtotime(rtrim(odbc_result($result2,'tanggal_selesai')))),
      "ket_selesai"=>rtrim(odbc_result($result2,'ket_selesai')), 
      "divisi_terkait"=>rtrim(odbc_result($result2,'divisi_terkait')), 
      "status_email"=>rtrim(odbc_result($result2,'status_email')),
      "tanggal_email"=>date('d-m-y',strtotime(rtrim(odbc_result($result2,'tanggal_email')))),
      "pesan_email"=>rtrim(odbc_result($result2,'pesan_email')), 
  );
  }
  if(empty($data)){
    $data = null;
    echo json_encode($data);
  }else{
    echo json_encode($data);
  }
}
elseif($status =="Selesai"){
  $st = 1;
  $query = "SELECT * FROM kunjungan_produksi where YEAR(tanggal)='".$tahun."' AND status_selesai='".$st."'  ORDER BY tanggal ASC";
  $result2=odbc_exec($connection,$query);
  while(odbc_fetch_row($result2)){
  $data[] = array(
    "tanggal"=>date('d-m-y',strtotime(rtrim(odbc_result($result2,'tanggal')))),
    "id_kunjungan"=>rtrim(odbc_result($result2,'id_kunjungan')),
      "tujuan"=>rtrim(odbc_result($result2,'tujuan')),
      "temuan"=>rtrim(odbc_result($result2,'temuan')),
      "divisi"=>rtrim(odbc_result($result2,'divisi')),
      "peserta"=>rtrim(odbc_result($result2,'peserta')),
      "jenis_ktg"=>rtrim(odbc_result($result2,'jenis_ktg')),
      "ket"=>rtrim(odbc_result($result2,'ket')),
      "status_proses"=>rtrim(odbc_result($result2,'status_proses')),
      "ket_proses"=>rtrim(odbc_result($result2,'ket_proses')),
      "tanggal_proses"=>date('d-m-Y',strtotime(rtrim(odbc_result($result2,'tanggal_proses')))),
      "status_selesai"=>rtrim(odbc_result($result2,'status_selesai')),
      "tanggal_selesai"=>date('d-m-Y',strtotime(rtrim(odbc_result($result2,'tanggal_selesai')))),
      "ket_selesai"=>rtrim(odbc_result($result2,'ket_selesai')), 
      "divisi_terkait"=>rtrim(odbc_result($result2,'divisi_terkait')), 
      "status_email"=>rtrim(odbc_result($result2,'status_email')),
      "tanggal_email"=>date('d-m-y',strtotime(rtrim(odbc_result($result2,'tanggal_email')))),
      "pesan_email"=>rtrim(odbc_result($result2,'pesan_email')), 
  );
  }
  if(empty($data)){
    $data = null;
    echo json_encode($data);
  }else{
    echo json_encode($data);
  }
}
elseif($status =="Sudah Email"){
  $st = 1;
  $query = "SELECT * FROM kunjungan_produksi where YEAR(tanggal)='".$tahun."' AND status_email='".$st."'  ORDER BY tanggal ASC";
  $result2=odbc_exec($connection,$query);
  while(odbc_fetch_row($result2)){
  $data[] = array(
    "tanggal"=>date('d-m-y',strtotime(rtrim(odbc_result($result2,'tanggal')))),
    "id_kunjungan"=>rtrim(odbc_result($result2,'id_kunjungan')),
      "tujuan"=>rtrim(odbc_result($result2,'tujuan')),
      "temuan"=>rtrim(odbc_result($result2,'temuan')),
      "divisi"=>rtrim(odbc_result($result2,'divisi')),
      "peserta"=>rtrim(odbc_result($result2,'peserta')),
      "jenis_ktg"=>rtrim(odbc_result($result2,'jenis_ktg')),
      "ket"=>rtrim(odbc_result($result2,'ket')),
      "status_proses"=>rtrim(odbc_result($result2,'status_proses')),
      "ket_proses"=>rtrim(odbc_result($result2,'ket_proses')),
      "tanggal_proses"=>date('d-m-Y',strtotime(rtrim(odbc_result($result2,'tanggal_proses')))),
      "status_selesai"=>rtrim(odbc_result($result2,'status_selesai')),
      "tanggal_selesai"=>date('d-m-Y',strtotime(rtrim(odbc_result($result2,'tanggal_selesai')))),
      "ket_selesai"=>rtrim(odbc_result($result2,'ket_selesai')), 
      "divisi_terkait"=>rtrim(odbc_result($result2,'divisi_terkait')), 
      "status_email"=>rtrim(odbc_result($result2,'status_email')),
      "tanggal_email"=>date('d-m-y',strtotime(rtrim(odbc_result($result2,'tanggal_email')))),
      "pesan_email"=>rtrim(odbc_result($result2,'pesan_email')), 
  );
  }
  if(empty($data)){
    $data = null;
    echo json_encode($data);
  }else{
    echo json_encode($data);
  }
}

elseif($status =="Belum Email"){
  $st = 0;
  $query = "SELECT * FROM kunjungan_produksi where YEAR(tanggal)='".$tahun."' AND status_email='".$st."'  ORDER BY tanggal ASC";
  $result2=odbc_exec($connection,$query);
  while(odbc_fetch_row($result2)){
  $data[] = array(
    "tanggal"=>date('d-m-y',strtotime(rtrim(odbc_result($result2,'tanggal')))),
    "id_kunjungan"=>rtrim(odbc_result($result2,'id_kunjungan')),
      "tujuan"=>rtrim(odbc_result($result2,'tujuan')),
      "temuan"=>rtrim(odbc_result($result2,'temuan')),
      "divisi"=>rtrim(odbc_result($result2,'divisi')),
      "peserta"=>rtrim(odbc_result($result2,'peserta')),
      "jenis_ktg"=>rtrim(odbc_result($result2,'jenis_ktg')),
      "ket"=>rtrim(odbc_result($result2,'ket')),
      "status_proses"=>rtrim(odbc_result($result2,'status_proses')),
      "ket_proses"=>rtrim(odbc_result($result2,'ket_proses')),
      "tanggal_proses"=>date('d-m-Y',strtotime(rtrim(odbc_result($result2,'tanggal_proses')))),
      "status_selesai"=>rtrim(odbc_result($result2,'status_selesai')),
      "tanggal_selesai"=>date('d-m-Y',strtotime(rtrim(odbc_result($result2,'tanggal_selesai')))),
      "ket_selesai"=>rtrim(odbc_result($result2,'ket_selesai')), 
      "divisi_terkait"=>rtrim(odbc_result($result2,'divisi_terkait')), 
      "status_email"=>rtrim(odbc_result($result2,'status_email')),
      "tanggal_email"=>date('d-m-y',strtotime(rtrim(odbc_result($result2,'tanggal_email')))),
      "pesan_email"=>rtrim(odbc_result($result2,'pesan_email')), 
  );
  }
  if(empty($data)){
    $data = null;
    echo json_encode($data);
  }else{
    echo json_encode($data);
  }
}





  


