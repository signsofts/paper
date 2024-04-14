

<?php
include("../../config/connectdb.php");
$data = (object) json_decode(file_get_contents('php://input'));

header('Content-Type: application/json; charset=utf-8');
// $data =  $_POST;

echo json_encode(Database::query("UPDATE `transale` SET `status_transale` = '4' WHERE `transale`.`id_transale` = '{$data->id_transale}';"));
