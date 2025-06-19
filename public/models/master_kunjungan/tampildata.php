<?php 

require_once ("../../models/koneksi.php");
$connection =$database->open_connection();
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  };

  $query = "SELECT * FROM master_jenis_kunjungan  ORDER BY kode_kjn  ASC";
//$result_set =odbc_exec($connection,$query);
$result2 = odbc_exec($connection,$query);
while(odbc_fetch_row($result2)){


    $data[] = array(
        "kode_kjn"=>rtrim(odbc_result($result2,'kode_kjn')),
        "nama_kunjungan"=>rtrim(odbc_result($result2,'nama_kunjungan')),
      
    
    
    );
    
    }

if(empty($data)){
    $data = null;
  
    echo json_encode($data);
  }else{
    
    echo json_encode($data);
  }
