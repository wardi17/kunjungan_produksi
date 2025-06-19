<?php 

require_once ("../../models/koneksi.php");
$connection =$database->open_connection();
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  };

  
  $id_kjn = test_input($_POST["id_kjn"]);
  $div_tkt = test_input($_POST["div_tkt"]);

  //die(print_r($kode_div));
  $query = "SELECT * FROM history_member_email  WHERE  id_kunjungan ='".$id_kjn."'  ORDER BY id  ASC ";
  //$result_set =odbc_exec($connection,$query);
$result2 = odbc_exec($connection,$query);
$data = [];
while(odbc_fetch_row($result2)){

    $data[] = array(
      "id"=>rtrim(odbc_result($result2,'id')),
        "nama_divisi"=>rtrim(odbc_result($result2,'nama_divisi')),
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
