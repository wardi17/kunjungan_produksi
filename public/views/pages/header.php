<?php
        session_start();
        
        $user_log = $_SESSION['login_user'];
      
        $class = $_SESSION['classku'];

      
        if($user_log==""){
            header('Location: /kunjungan_produksi');
        }
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kunjungan Produksi</title>
    
    <link rel="stylesheet" href="assets/css/main/app.css">
    <link rel="stylesheet" href="assets/css/main/app-dark.css">
   
<link rel="stylesheet" href="assets/css/shared/iconly.css">
<script src="assets/js/jquery.min.js"></script>
<link rel="stylesheet" href="assets/css/grafik.css">

<!-- <link href="assets/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous"> -->

<link href="assets/css/datatables.min.css" rel="stylesheet"/>
<script src="assets/js/datatables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<link href="assets/fontawesome/css/all.min.css"  rel="stylesheet"/>
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"  rel="stylesheet"/> -->
<!-- <script src="assets/js/bootstrap.bundle.min.js"></script> -->
<link rel="stylesheet" href="assets/css/jquery-ui.css">
  <script src="assets/js/jquery-ui.js"></script>

  <style>
    #toko_upload1{
    opacity: 0;
    }
    #toko_upload2{
    opacity: 0;
    }
    #toko_upload3{
    opacity: 0;
    }
    #toko_upload4{
    opacity: 0;
    }

    #upload_edit1 {
        opacity: 0;
    }
    #upload_edit2 {
        opacity: 0;
    }
    #upload_edit3 {
        opacity: 0;
    }
    #upload_edit4 {
        opacity: 0;
    }

    .box {
    width: 100px;
    height:100px;
    background: url(assets/images/image1.jpg);
    background-repeat: no-repeat;
    background-size: 100px 100px;
    }
    .box2 {
    width: 100px;
    height:100px;
    background:	#F0F8FF;
    background: url(assets/images/image2.jpg);
    background-repeat: no-repeat;
    background-size: 100px 100px;
    }
    .box3 {
    width: 100px;
    height:100px;
    background:	#F0F8FF;
    background: url(assets/images/image3.jpg);
    background-repeat: no-repeat;
    background-size: 100px 100px;
    }
    .box4 {
    width: 100px;
    height:100px;
    background:	#F0F8FF;
    background: url(assets/images/image4.jpg);
    background-repeat: no-repeat;
    background-size: 100px 100px;
    }

    .btn-space {
    margin-right: 10px;
}
.highcharts-credits{
    display: none;
}

</style>
<style>
    .ui-icon{
      color: black;
    }

    .ui-datepicker {
      font-size: 20px;
    }
    .ui-datepicker .ui-datepicker-next .ui-icon{
      background: url(assets/images/next.png);
      
      width: 50px;
      height: 50px;
      top: 6px;
      left: -10px;
    }
    .ui-datepicker .ui-datepicker-prev .ui-icon {
      background: url(assets/images/back.png);
      width: 50px;
      height: 50px;
      top: 6px;
      left: 6px;
    }
    .ui-datepicker div.ui-datepicker-title {
      line-height: 2.4em;
    }
</style>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>


</head>