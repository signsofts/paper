<?php

include("../../config/connectdb.php");

$AD_EMAIL = $_POST["AD_EMAIL"];
$AD_PASSWORD = $_POST["AD_PASSWORD"];

$rco = Database::squery("SELECT * FROM `paper_ad_account` WHERE AD_EMAIL = '$AD_EMAIL'  AND AD_PASSWORD ='$AD_PASSWORD' ", PDO::FETCH_OBJ, false);

// print_r($rco );
// exit ;
if ($rco) {
    $_SESSION["type"] = 'admin';
    $_SESSION["id"] = $rco->AD_ID;
    $_SESSION["name"] = $rco->AD_FNAME_TH . " " . $rco->AD_LNAME_TH;

    // print_r($rco);
    // exit;
    echo "<script>alert('เข้าสู่ระบบสำเร็จ');location.assign('../../a/index.php');</script>";
    exit;
}
echo "<script>alert('เข้าสู่ระบบไม่สำเร็จ');location.assign('../../a/login.php');</script>";
