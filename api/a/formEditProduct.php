<?php
include("../../config/connectdb.php");
$data = (object) json_decode(file_get_contents('php://input'));

header('Content-Type: application/json; charset=utf-8');
$data =  $_POST;

// echo json_encode($data);
// exit;

$id_products = $data['id_products'];
$image_pro = $data['image_pro'];
$id_typepro = $data['id_typepro'];
$name_products = $data['name_products'];
$price_unit = $data['price_unit'];
$num_stock = $data['num_stock'];
// $image_pro = $data['image_pro'];
$pro_de = $data['pro_de'];
$pro_max = $data['pro_max'];
$price_mini = $data['price_mini'];


$check_products = Database::query("SELECT * FROM `products` WHERE id_products = '$id_products'", PDO::FETCH_OBJ)->fetch(PDO::FETCH_OBJ);

$nameImage = time() . ".png";
if (!empty($image_pro)) {
    try {
        @unlink("../../img/pro/$check_products->image_pro");
    } catch (Exception $e) {
       
    }
    $base64Image = explode(",", $image_pro)[1];
    $imageData = base64_decode($base64Image);
    file_put_contents("../../img/pro/$nameImage", $imageData);
    $image_pro = $nameImage;
} else {
    $image_pro = $check_products->image_pro;
}



Database::query("UPDATE `products` SET `name_products` = '$name_products', 
                                            `id_typepro` = '$id_typepro', 
                                            `num_stock` = '$num_stock', 
                                            `price_unit` = '$price_unit', 
                                            `pro_de` = '$pro_de', 
                                            `pro_max` = '$pro_max', 
                                            `price_mini` = '$price_mini', 
                                            `image_pro` = '$image_pro' 
                                            WHERE `products`.`id_products` = $id_products;");
echo json_encode(["error" => false]);
