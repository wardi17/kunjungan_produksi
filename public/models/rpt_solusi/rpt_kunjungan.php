<?php 

require_once ("../../models/koneksi.php");
$conn =$database->open_connection();

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  };
  
$bulan = test_input($_POST['bulan']);
$tahun =test_input($_POST['tahun']);

if(!empty($tahun)){

  // $query = "SELECT bulan_angka FROM bulan_kunjungan_produksi  ORDER BY bulan_angka ASC";
  // $result =odbc_exec($conn,$query);
  // while($arr = odbc_fetch_array($result)){
  //   $bln_k[] = $arr['bulan_angka'];
  // };
  
  // die(print_r($bln_k));
  // foreach($bln_k as $bln){

  // }
    // $total_kjn = get_totalkjn($conn,$tahun,$bulan);
   
    // $total_proses = total_proses($conn,$tahun);
    // $total_selesai = get_selesai($conn,$tahun);

$query ="SELECT tanggal,id_kunjungan,tujuan,temuan,tanggal_proses,ket_proses,tanggal_selesai,ket_selesai
 from kunjungan_produksi
where YEAR(tanggal) ='".$tahun."'";

$result2 = odbc_exec($conn,$query);
// $arr2 = odbc_fetch_array($result2); 
while(odbc_fetch_row($result2)){


$data[] = array(
  "tanggal"=>date('d-m-Y',strtotime(rtrim(odbc_result($result2,'tanggal')))),
    "id_kunjungan"=>rtrim(odbc_result($result2,'id_kunjungan')),
    "tujuan"=>rtrim(odbc_result($result2,'tujuan')),
    "temuan"=>rtrim(odbc_result($result2,'temuan')),
    "tanggal_proses"=>date('d-m-Y',strtotime(rtrim(odbc_result($result2,'tanggal_proses')))),
    'ket_proses' =>rtrim(odbc_result($result2,'ket_proses')) ,
    "tanggal_selesai"=>date('d-m-Y',strtotime(rtrim(odbc_result($result2,'tanggal_selesai')))),
    'ket_selesai' =>rtrim(odbc_result($result2,'ket_selesai')),
);

}

}










// foreach($data as $myData){
//   print_r($myData['foto']);
// }
//   die();
  if(empty($data)){
    $data = null;
  
    echo json_encode($data);
  }else{
    
    echo json_encode($data);
  }




    function get_totalkjn($conn,$tahun,$bulan){
        $query ="SELECT COUNT (tanggal)as total FROM kunjungan_produksi where YEAR(tanggal) ='".$tahun."' AND MONTH(tanggal) ='".$bulan."'";
        $result2 = odbc_exec($conn,$query);
         $arr2 = odbc_fetch_array($result2); 
         return $arr2;
    }
    function total_proses($conn,$tahun){
      $query ="SELECT SUM(status_proses)as proses FROM kunjungan_produksi where YEAR(tanggal) ='".$tahun."'";
      $result2 = odbc_exec($conn,$query);
       $arr2 = odbc_fetch_array($result2); 
       return $arr2;
    }
    
    function get_selesai($conn,$tahun){
      $query ="SELECT SUM(status_selesai) as selesai FROM kunjungan_produksi  where YEAR(tanggal) ='".$tahun."'";
      $result2 = odbc_exec($conn,$query);
       $arr2 = odbc_fetch_array($result2); 
       return $arr2;
    }
  
function get_foto($connection,$id){
  
  $query = "SELECT * FROM kunjungan_produksi where id_kunjungan='".$id."' ";
  $result_set =odbc_exec($connection,$query);
  $data =[];

  while($datas = odbc_fetch_array($result_set)){
    $data[] =[
      'tanggal' => $datas['tanggal'],
      'id_kunjungan' => $datas['id_kunjungan'],
      'kunjungan' => $datas['kunjungan'],
      'ket' => $datas['ket'],
      'foto' =>explode(",",$datas['foto']) ,
    
    ];
  }



  return $data;
}

