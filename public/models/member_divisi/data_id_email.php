<?php 

require_once ("../../models/koneksi.php");
$connection =$database->open_connection();
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  };

  

  $query = "SELECT * FROM member_divisi_kunjungan";


$result2 = odbc_exec($connection,$query);
$data = [];
while(odbc_fetch_row($result2)){


    $data[] = array(
      "id"=>rtrim(odbc_result($result2,'id')),
        "kode_divisi"=>rtrim(odbc_result($result2,'kode_divisi')),
        "nama"=>rtrim(odbc_result($result2,'nama')),
        "email"=>rtrim(odbc_result($result2,'email')),
        "active"=>rtrim(odbc_result($result2,'active')),

    
    
    );
    
    }
if(empty($data)){
    $data = null;
  
    echo json_encode($data);
  }else{
    
    echo json_encode($data);
  }
