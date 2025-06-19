<?php 

require_once ("../../models/koneksi.php");
$connection =$database->open_connection();

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  };
  
$bulanpage = test_input($_POST['bulan']);
$tahunpage =test_input($_POST['tahun']);

$query = "SELECT * FROM kunjungan_produksi where YEAR(tanggal)='".$tahunpage."'";
//$result_set =odbc_exec($connection,$query);
$result2 = odbc_exec($connection,$query);
// $arr2 = odbc_fetch_array($result2); 
while(odbc_fetch_row($result2)){


$data[] = array(
    "tanggal"=>rtrim(odbc_result($result2,'tanggal')),
    "id_kunjungan"=>rtrim(odbc_result($result2,'id_kunjungan')),
    "kunjungan"=>rtrim(odbc_result($result2,'kunjungan')),
    "ket"=>rtrim(odbc_result($result2,'ket')),
    'image1' =>rtrim(odbc_result($result2,'image1')) ,
    'image2' =>rtrim(odbc_result($result2,'image2')) ,
    'image3' =>rtrim(odbc_result($result2,'image3')) ,
    'image4' =>rtrim(odbc_result($result2,'image4')) ,
    'status' =>rtrim(odbc_result($result2,'status')) ,


);

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

