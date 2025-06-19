<?php


class KunId extends My_db{
  function __construct()
  {
      $this->getid();
  }
 public function getid(){


    $connection =odbc_connect("Driver={SQL Server};Server=(LOCAL);Database=um_db;","sa","");
      $query1="SELECT  top 1 id_kunjungan FROM kunjungan_produksi ORDER BY id DESC";
      $sql1= odbc_exec($connection, $query1);
      $id_kunjungan=odbc_result($sql1,"id_kunjungan");
      $expload = explode(".",$id_kunjungan);
  
      $tahun =date("y");
      $divisi=$expload[1];
      $urutan_tk = $expload[2]; 
      $urtuan_baru = $this->setnoUrut($urutan_tk);
     
      $gabung = $tahun.".".$divisi.".".$urtuan_baru;
      odbc_close($connection);
      return $gabung;
    }
     
    
  
      public function setnoUrut($urutan_tk){
        $noumer = number_format($urutan_tk);
        $noumer = $noumer + 1;
        $sprintf = sprintf("%03d",$noumer);
        
        return $sprintf;
      }
}
$idkun = new KunId(); 