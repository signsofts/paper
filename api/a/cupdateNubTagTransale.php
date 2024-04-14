

<?php
include("../../config/connectdb.php");
$data = (object) json_decode(file_get_contents('php://input'));

header('Content-Type: application/json; charset=utf-8');


$tra_number_tag = $data->tra_number_tag;
echo json_encode(Database::query("UPDATE `transale` SET `status_transale` = '3' , `tra_number_tag` = '$tra_number_tag'   WHERE `transale`.`id_transale` = '{$data->id_transale}';"));
