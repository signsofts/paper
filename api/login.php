<?php

// print_r($_POST);

include ("../config/connectdb.php");

$US_EMAIL = $_POST["US_EMAIL"];
$US_PASSWORD = $_POST["US_PASSWORD"];

$rco = Database::squery("SELECT * FROM `paper_user` WHERE US_EMAIL = '$US_EMAIL'  AND US_PASSWORD ='$US_PASSWORD' ", PDO::FETCH_OBJ, false);
if ($rco) {
    $_SESSION["type"] = 'user';
    $_SESSION["id"] = $rco->US_ID;
    $_SESSION["name"] = $rco->US_FNAME . " " . $rco->US_LNAME;
    echo "<script>alert('เข้าสู่ระบบสำเร็จ');location.assign('../u/index.php');</script>";
    exit;
}
echo "<script>alert('เข้าสู่ระบบไม่สำเร็จ');location.assign('../login.php');</script>";










?>