<?php
include("../../config/connectdb.php");
$data = (object) json_decode(file_get_contents('php://input'));

header('Content-Type: application/json; charset=utf-8');
$data =  $_POST;

if (empty(Database::squery("SELECT * FROM `paper_ad_account` WHERE AD_EMAIL = '{$_POST['AD_EMAIL']}' AND `AD_ID` != '{$_POST['AD_ID']}'"))) {
    echo json_encode(false);
    exit;
}

echo json_encode(Database::query("UPDATE `paper_ad_account` SET `AD_FNAME_TH` = '{$_POST['AD_FNAME_TH']}', 
                                                            `AD_LNAME_TH` = '{$_POST['AD_LNAME_TH']}', 
                                                            `AD_EMAIL` = '{$_POST['AD_EMAIL']}',
                                                            `AD_PASSWORD` = '{$_POST['AD_PASSWORD']}'
                                                             WHERE `paper_user`.`AD_ID` = '{$_POST['AD_ID']}';"));
