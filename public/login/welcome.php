
<?php 

require_once ("user.php");
$username =  addslashes($_POST["username"]);

$pass = addslashes($_POST["password"]);



$found_user = User::find_by_idku($username);
$found = $database->baca_sql($found_user);
$pass2=odbc_result($found_user,"pass");
$kode_log = addslashes($_POST["kode_log"]);
$class=odbc_result($found_user,"poin_a");


if ($pass==$pass2) {
	session_start();
	$_SESSION['login_user']= $username;
	$_SESSION['classku']= number_format($class,0,'.',',');
	$_SESSION['kode_log']= $kode_log;
	header("Location: ../index.php");
	
	
	
}
else {
	header("Location: ../../index.php?tog=0");
}

?>


