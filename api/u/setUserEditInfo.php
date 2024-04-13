<?php
include("../../config/connectdb.php");
$data = (object) json_decode(file_get_contents('php://input'));

header('Content-Type: application/json; charset=utf-8');
$data =  $_POST;

if (empty(Database::squery("SELECT * FROM `paper_user` WHERE US_EMAIL = '{$_POST['US_EMAIL']}' AND `US_ID` != '{$_POST['US_ID']}'"))) {
    echo json_encode(false);
    exit;
}



echo json_encode(Database::query("UPDATE `paper_user` SET `US_FNAME` = '{$_POST['US_FNAME']}', 
                                                            `US_LNAME` = '{$_POST['US_LNAME']}', 
                                                            `US_EMAIL` = '{$_POST['US_EMAIL']}',
                                                            `US_PASSWORD` = '{$_POST['US_PASSWORD']}',
                                                            `US_PHONE` = '{$_POST['US_PHONE']}'
                                                             WHERE `paper_user`.`US_ID` = '{$_POST['US_ID']}';"));
