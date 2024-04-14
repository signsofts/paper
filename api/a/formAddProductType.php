<?php
include("../../config/connectdb.php");
$data = (object) json_decode(file_get_contents('php://input'));

header('Content-Type: application/json; charset=utf-8');
$data =  $_POST;

$checkname_products = Database::query("SELECT * FROM `typepro` WHERE name_typepro = '{$data['name_typepro']}' AND TY_STATUS IS NULL", PDO::FETCH_OBJ)->fetch(PDO::FETCH_OBJ);

if (!empty($checkname_products)) {
    echo json_encode(["error" => "คุณเคยเพิ่มประเภทสินค้าแล้ว"]);
    exit;
}


Database::query("INSERT INTO `typepro` (`id_typepro`, `name_typepro`, `detail_typepro`, `TY_STATUS`) VALUES (NULL, '{$data['name_typepro']}', '', NULL);");
echo json_encode(["error" => false]);
