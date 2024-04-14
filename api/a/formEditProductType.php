<?php
include("../../config/connectdb.php");
$data = (object) json_decode(file_get_contents('php://input'));

header('Content-Type: application/json; charset=utf-8');
$data =  $_POST;

// echo json_encode($data);
// exit;

$id_typepro = $data['id_typepro'];
$name_typepro = $data['name_typepro'];


Database::query("UPDATE `typepro` SET `name_typepro` = '$name_typepro'
                WHERE `id_typepro` = $id_typepro;");


echo json_encode(["error" => false]);
