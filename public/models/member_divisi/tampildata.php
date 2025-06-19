<?php 

require_once ("../../models/koneksi.php");
$connection =$database->open_connection();
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  };

  $kode_div = test_input($_POST["kode"]);

  $query = "SELECT * FROM member_divisi_kunjungan  WHERE  kode_divisi='".$kode_div."' ORDER BY kode_divisi  ASC";
$result2 = odbc_exec($connection,$query);
while(odbc_fetch_row($result2)){


    $data[] = array(
        "kode_divisi"=>rtrim(odbc_result($result2,'kode_divisi')),
        "nama"=>rtrim(odbc_result($result2,'nama')),
        "email"=>rtrim(odbc_result($result2,'email')),

    
    
    );
    
    }

if(empty($data)){
    $data = null;
  
    echo json_encode($data);
  }else{
    
    echo json_encode($data);
  }
