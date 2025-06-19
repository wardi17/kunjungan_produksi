<?php


require_once ("../../models/koneksi.php");
$connection =$database->open_connection();

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
};
$kode = test_input($_POST["data"]);

if(isset($kode)){
  delete($kode,$connection);

}





function delete($kode,$connection){
  $sql="DELETE FROM history_member_email WHERE id_kunjungan = '".$kode."'"; 
	odbc_exec($connection, $sql); 
}
