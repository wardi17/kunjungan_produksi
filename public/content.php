<?php
$page = (isset($_GET['page']))? $_GET['page'] : '';


// View without Login
switch($page){
    case "home":
        include 'views/home.php';
        break;
        case "new":
            include 'models/new/getidkunjungan.php';
            include 'views/new.php';
            break;
        case "solusi":
            include 'views/solusi.php';
            break;
        case "rpt_solusi":
            include 'views/rpt_solusi.php';
            break;
       case "divisi":
            include 'views/divisi/divisi.php';
            break;
        case "send_email":
                include 'views/divisi/send_email.php';
                break;
        case "kunjungan":
            include 'views/kunjungan.php';
            break;
    default:
    include 'views/home.php';
    break;
}