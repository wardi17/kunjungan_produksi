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


  $query = " SELECT m.id as id, m.kode_divisi as kode, d.nama_divisi,m.nama,m.email  FROM 
  member_divisi_kunjungan as m 
  INNER JOIN  master_divisi as d  ON m.kode_divisi = d.kode_divisi
    WHERE  m.kode_divisi in($kode_div) ORDER BY  nama_divisi ASC";


$result2 = odbc_exec($connection,$query);
$data = [];
while(odbc_fetch_row($result2)){


    $data[] = array(
        "id"=>rtrim(odbc_result($result2,'id')),
        "kode"=>rtrim(odbc_result($result2,'kode')),
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
