<?php 

require_once ("../../models/koneksi.php");
$connection =$database->open_connection();

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  };

$status = test_input($_POST['status']);
$tahun =test_input($_POST['tahun']);

if($status == "kunjungan"){
  $query = "SELECT tanggal,id_kunjungan,tujuan,temuan,divisi,divisi_terkait,peserta,jenis_ktg,ket,tanggal_proses,ket_proses,tanggal_selesai,ket_selesai,tanggal_email,pesan_email FROM kunjungan_produksi where YEAR(tanggal)='".$tahun."' ORDER BY tanggal";

}
elseif($status == "proses"){
  $st = 1;
  $query = "SELECT tanggal,id_kunjungan,tujuan,temuan,divisi,divisi_terkait,peserta,jenis_ktg,ket,tanggal_proses,ket_proses,tanggal_selesai,ket_selesai,tanggal_email,pesan_email FROM kunjungan_produksi where 
  YEAR(tanggal)='".$tahun."' AND  status_proses ='".$st."' ORDER BY tanggal ";

}
elseif($status == "selesai"){
  $st = 1;
  $query = "SELECT tanggal,id_kunjungan,tujuan,temuan,divisi,divisi_terkait,peserta,jenis_ktg,ket,tanggal_proses,ket_proses,tanggal_selesai,ket_selesai,tanggal_email,pesan_email FROM 
  kunjungan_produksi where YEAR(tanggal)='".$tahun."' AND  status_selesai ='".$st."' ORDER BY tanggal";

}
elseif($status == "email"){
  $st = 1;
  $query = "SELECT tanggal,id_kunjungan,tujuan,temuan,divisi,divisi_terkait,peserta,jenis_ktg,ket,tanggal_proses,ket_proses,tanggal_selesai,ket_selesai,tanggal_email,pesan_email FROM 
  kunjungan_produksi where YEAR(tanggal)='".$tahun."' AND  status_email ='".$st."' ORDER BY tanggal";

}
//$result_set =odbc_exec($connection,$query);
$result2 = odbc_exec($connection,$query);
// $arr2 = odbc_fetch_array($result2); 
while(odbc_fetch_row($result2)){

$data[] = array(
    "tanggal"=>date('d-m-y',strtotime(rtrim(odbc_result($result2,'tanggal')))),
    "id_kunjungan"=>rtrim(odbc_result($result2,'id_kunjungan')),
    "tujuan"=>rtrim(odbc_result($result2,'tujuan')),
    "ket"=>rtrim(odbc_result($result2,'ket')),
    'temuan' =>rtrim(odbc_result($result2,'temuan')) ,
    'divisi' =>rtrim(odbc_result($result2,'divisi')),
    'divisi_terkait' =>rtrim(odbc_result($result2,'divisi_terkait')) ,
    'peserta' =>rtrim(odbc_result($result2,'peserta')) ,
    'jenis_ktg' =>rtrim(odbc_result($result2,'jenis_ktg')) ,
    'ket' =>rtrim(odbc_result($result2,'ket')),
    'tanggal_proses' =>date('d-m-y',strtotime(rtrim(odbc_result($result2,'tanggal_proses')))),
    'ket_proses' =>rtrim(odbc_result($result2,'ket_proses')),
    'tanggal_selesai' =>date('d-m-y',strtotime(rtrim(odbc_result($result2,'tanggal_selesai')))),
    'ket_selesai' =>rtrim(odbc_result($result2,'ket_selesai')),
    'tanggal_email' =>date('d-m-y',strtotime(rtrim(odbc_result($result2,'tanggal_email')))),
    'pesan_email' =>rtrim(odbc_result($result2,'pesan_email')),
);

}





foreach($data as $datas){
  $fulldata [] =[
    'tanggal'=>$datas['tanggal'],
    'id_kunjungan'=>$datas['id_kunjungan'],
    'tujuan'=>$datas['tujuan'],
    'ket'=>$datas['ket'],
    'temuan'=>$datas['temuan'],
    'divisi'=>$datas['divisi'],
    'divisi_terkait'=>get_divtkt($datas['divisi_terkait'],$connection),
    'ket'=>$datas['ket'],
    'peserta'=>$datas['peserta'],
    'tanggal_proses'=>$datas['tanggal_proses'],
    'jenis_ktg'=>$datas['jenis_ktg'],
    'ket_proses'=>$datas['ket_proses'],
    'tanggal_selesai'=>$datas['tanggal_selesai'],
    'ket_selesai'=>$datas['ket_selesai'],
    'tanggal_email'=>$datas['tanggal'],
    'pesan_email'=>$datas['pesan_email'],
  ];


}
// echo '<pre>';
// print_r($fulldata);
// echo '</pre>';
// die();

  if(empty($fulldata)){
    $fulldata = null;
  
    echo json_encode($fulldata);
  }else{
    
    echo json_encode($fulldata);
  }

  function  get_divtkt($div_tkt,$connection){
    $temp = explode(",",$div_tkt);
    $result = "'" . implode ( "','", $temp )."'";
  
  
    //die(print_r($result));
    $query = "SELECT nama_divisi FROM master_divisi where kode_divisi in($result) ";
    $rows = odbc_exec($connection,$query);
  
    $datas=[]; 
    while(odbc_fetch_row($rows)){
    
        $datas[] =odbc_result($rows,'nama_divisi');
        }

     $json = json_encode($datas);
            $str_replace = str_replace("["," ",$json);
            $str_replace2 = str_replace("]"," ",$str_replace);
            $str_replace3 = str_replace('"','',$str_replace2);
            $str_replace4 = str_replace(',',', ',$str_replace3);
      
       return $str_replace4;
  
          
    
     
  }

  


