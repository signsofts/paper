<?php

// print_r($_POST);

include ("../config/connectdb.php");

$US_EMAIL = $_POST["US_EMAIL"];
$US_PASSWORD = $_POST["US_PASSWORD"];

$rco = Database::squery("SELECT * FROM `paper_user` WHERE US_EMAIL = '$US_EMAIL'", PDO::FETCH_OBJ, false);
if (!empty($rco)) {
    echo "<script>alert('ไม่สามารถใช้ E-mail นี้ได้ ');location.assign('../login.php');</script>";
    exit;
}

$US_FNAME = $_POST["US_FNAME"];
$US_LNAME = $_POST["US_LNAME"];
$US_ADDESS = $_POST["US_ADDESS"];
$provinces_code = $_POST["provinces_code"];
$district_code = $_POST["district_code"];
$subdistrict_code = $_POST["subdistrict_code"];
$US_PHONE = $_POST["US_PHONE"];

$rcoIN = Database::query("INSERT INTO `paper_user` (`US_ID`, `US_FNAME`, `US_LNAME`, `US_EMAIL`, `US_PASSWORD`, `US_ADDESS`, `provinces_code`, `district_code`, `subdistrict_code`, `US_PHONE`, `US_STATUS`, `US_STAMP`) 
                 VALUES (NULL, '$US_FNAME', '$US_LNAME', '$US_EMAIL', '$US_PASSWORD', '$US_ADDESS', '$provinces_code', '$district_code', '$subdistrict_code', '$US_PHONE', NULL,current_timestamp());");
if ($rcoIN) {
    echo "<script>alert('สมัครสมาชิกสำเร็จ');location.assign('../login.php');</script>";
    exit;
}
echo "<script>alert('สมัครสมาชิกไม่สำเร็จ');location.assign('../login.php');</script>";












?>