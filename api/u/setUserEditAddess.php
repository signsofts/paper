<?php
include("../../config/connectdb.php");
$data = (object) json_decode(file_get_contents('php://input'));

header('Content-Type: application/json; charset=utf-8');
$data =  $_POST;




echo json_encode(Database::query("UPDATE `paper_user` SET `US_ADDESS` = '{$_POST['US_ADDESS']}', 
                                                            `provinces_code` = '{$_POST['provinces_code']}', 
                                                            `district_code` = '{$_POST['district_code']}',
                                                            `subdistrict_code` = '{$_POST['subdistrict_code']}'
                                                             WHERE `paper_user`.`US_ID` = '{$_POST['US_ID']}';"));
