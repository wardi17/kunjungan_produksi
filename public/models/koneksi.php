<?php
class My_db {
    function __construct()
    {
        $this->open_connection();
    }
    public function open_connection() {
         $db ="um_db";
		$server="DESKTOP-1CEB0AJ\SQLEXPRESS";	
        //$server ="(LOCAL)";
        $user ="sa";
        $pass ="";
        $dsn = 'Driver={SQL Server};Server='.$server.';Database='. $db;

	    $connection = odbc_connect($dsn,$user,$pass);  


		return $connection;
	}
}
$database = new My_db(); 