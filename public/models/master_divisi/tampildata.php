<?php 

require_once ("../../models/koneksi.php");
$connection =$database->open_connection();
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  };

  $query = "SELECT * FROM master_divisi  ORDER BY kode_divisi  ASC";
//$result_set =odbc_exec($connection,$query);
$result2 = odbc_exec($connection,$query);
while(odbc_fetch_row($result2)){


    $data[] = array(
        "kode_divisi"=>rtrim(odbc_result($result2,'kode_divisi')),
        "nama_divisi"=>rtrim(odbc_result($result2,'nama_divisi')),
      
    
    
    );
    
    }

if(empty($data)){
    $data = null;
  
    echo json_encode($data);
  }else{
    
    echo json_encode($data);
  }
