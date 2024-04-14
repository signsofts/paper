<?php
include("../../config/connectdb.php");
$data = (object) json_decode(file_get_contents('php://input'));

header('Content-Type: application/json; charset=utf-8');
// $data =  $_POST;

$id_products = $data->id_products;



Database::query("UPDATE `products` SET `status_products` = '0'
                                            WHERE `products`.`id_products` = $id_products;");
echo json_encode(["error" => false]);
