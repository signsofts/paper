<?php include("../config/connectdb.php") ?>

<?php
if (!isset($_SESSION["type"])) {
    echo "<script>alert('กรุณาเข้าสู่ระบบ');location.assign('login.php');</script>";
}
if (isset($_SESSION["type"]) && ($_SESSION["type"] == "user" &&  $_SESSION["type"]  != "admin")) {
    echo "<script>alert('เข้าสู่ระบบสำเร็จ');location.assign('../u/index.php');</script>";
}



$U_ID = $_SESSION["id"];

$uAuccotu = Database::squery("SELECT * FROM `paper_ad_account`   WHERE AD_ID = '$U_ID'", PDO::FETCH_OBJ, false);
if (empty($uAuccotu)) {
    echo "<script>alert('กรุณาเข้าสู่ระบบ');location.assign('login.php');</script>";
}



?>


<title>NAPackging</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta name="format-detection" content="telephone=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="author" content="">
<meta name="keywords" content="">
<meta name="description" content="">

<link href="../img/logo.png" rel="icon">
<style>
    @font-face {
        font-family: 'KhaoNiawThin';
        /* src: url('KhaoNiawThin.eot'); */
        /* IE9 Compat Modes */
        src:
            url('../KhaoNiawThin.ttf') format('truetype'),
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="../css/vendor.css?v=<?php echo time() ?>">
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->

<link rel="stylesheet" type="text/css" href="../style.css?v=<?php echo time() ?>">
<!-- <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
<link href="https://fonts.googleapis.com/css2?family=KhaoNiawThin&amp;family=KhaoNiawThin:wght@300;400;500&amp;display=swap"
    rel="stylesheet"> -->
<!-- <link href="lib/DataTables/datatables.min.css" rel="stylesheet"> -->

<!-- <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=KhaoNiawThin:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet"> -->

<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/v/ju/jqc-1.12.4/dt-2.0.3/datatables.min.css" rel="stylesheet">

<style>
    * {
        font-family: 'KhaoNiawThin' !important;
    }
</style>