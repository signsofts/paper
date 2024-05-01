<?php
include("../../config/connectdb.php");
$data = (object) json_decode(file_get_contents('php://input'));

header('Content-Type: application/json; charset=utf-8');
$data =  $_POST;


$image_pro = $data['image_pro'];
$id_typepro = $data['id_typepro'];
$name_products = $data['name_products'];
$price_unit = $data['price_unit'];
$num_stock = $data['num_stock'];
$pro_de = $data['pro_de'];
$pro_max = $data['pro_max'];
$price_mini = $data['price_mini'];



$checkname_products = Database::query("SELECT * FROM `products` WHERE name_products = '$name_products' AND status_products = 1", PDO::FETCH_OBJ)->fetch(PDO::FETCH_OBJ);

if (!empty($checkname_products)) {
    echo json_encode(["error" => "คุณเคยเพิ่มสินค้าชิ้นนี้แล้ว"]);
    exit;
}

$nameImage = time() . ".png";

if (!empty($image_pro)) {
    $base64Image = explode(",", $image_pro)[1];
    $imageData = base64_decode($base64Image);
    file_put_contents("../../img/pro/$nameImage", $imageData);
} else {
    echo json_encode(["error" => "กรุณาเพิ่มรุปภาพ"]);
    exit;
}


// INSERT INTO `products` (`id_products`, `name_products`, `id_typepro`, `num_stock`, `price_unit`, `status_products`, `image_pro`) VALUES (NULL, 'สินค้า', '3', '12', '546', '1', '3');
Database::query("INSERT INTO `products` (`id_products`, `name_products`, `id_typepro`, `num_stock`, `price_unit`, `status_products`, `image_pro`, `pro_de`, `pro_max`, `price_mini`) 
                                        VALUES (NULL, '$name_products', '$id_typepro', '$num_stock', '$price_unit', '1', '$nameImage', '$nameImage', '$pro_max', '$price_mini');");


echo json_encode(["error" => false]);
