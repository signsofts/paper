<?php
include("../../config/connectdb.php");
$data = (object) json_decode(file_get_contents('php://input'));

header('Content-Type: application/json; charset=utf-8');
// $data =  $_POST;

$id_typepro = $data->id_typepro;



Database::query("UPDATE `typepro` SET `TY_STATUS` = '0'
                                            WHERE `id_typepro` = $id_typepro;");
echo json_encode(["error" => false]);
