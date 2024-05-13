<?php
include("../../config/connectdb.php");
$data = (object) json_decode(file_get_contents('php://input'));

header('Content-Type: application/json; charset=utf-8');

function uploadImageBase641($imageBase64)
{
    // Decode the base64 string to get the image data
    $imageData = base64_decode($imageBase64);

    // Generate a unique filename for the image
    $filename = uniqid() . '.jpg'; // You can adjust the extension based on the image format

    // Specify the directory where you want to save the uploaded image
    $uploadPath = __DIR__ . "/../../img/modal/";

    // Combine the directory path and filename
    $filePath = $uploadPath . $filename;

    // Save the image data to the file
    $success = file_put_contents($filePath, $imageData);

    if ($success !== false) {
        // Image uploaded successfully
        return $filename;
    } else {
        // Failed to upload image
        return false;
    }
}

function uploadImageBase64($imageBase64)
{
    // Decode the base64 string to get the image data
    $imageData = base64_decode($imageBase64);

    // Generate a unique filename for the image
    $filename = uniqid() . '.jpg'; // You can adjust the extension based on the image format

    // Specify the directory where you want to save the uploaded image
    $uploadPath = __DIR__ . "/../../img/slip/";

    // Combine the directory path and filename
    $filePath = $uploadPath . $filename;

    // Save the image data to the file
    $success = file_put_contents($filePath, $imageData);

    if ($success !== false) {
        // Image uploaded successfully
        return $filename;
    } else {
        // Failed to upload image
        return false;
    }
}

$data =  $_POST;

$img64 = $data['img64'];
$img641 = $data['img641'];

$nameImage = time() . ".png";
$nameImage1 = "MO_" . time() . ".png";

if ($data["type_play"] == 1) {
    if (empty($img64)) {
        echo json_encode(false);
        exit;
    }
    $base64Image = explode(",", $img64)[1]; // Your base64 encoded image data
    $imageData = base64_decode($base64Image);
    file_put_contents("../../img/slip/$nameImage", $imageData);
    // $nameImage =  uploadImageBase64($imageData);
} else {
    $nameImage  = NULL;
}

if (!empty($img641)) {
    $base64Image1 = explode(",", $img641)[1]; // Your base64 encoded image data
    $imageData1 = base64_decode($base64Image1);
    // $nameImage1 =  uploadImageBase641($img641);
    file_put_contents("../../img/modal/$nameImage1", $imageData1);

    // file_put_contents(__DIR__."/../../img/modal/$nameImage", $imageData1);
}

// echo $nameImage1;
// exit;

$cart = json_decode($data['cart']);

foreach ($cart  as $key => $item) :
    $id_products = $item->id_products;

    $pro = Database::squery("SELECT * FROM `products` WHERE id_products ='$id_products'", PDO::FETCH_OBJ, false);

    if ($pro->num_stock - $item->item < 0) {
        echo json_encode(["error" => "ไม่สามารถสั่งซื้อสินค้าได้ :  สินค้าคงเหลือ {$pro->num_stock}"]);
        exit;
    }
endforeach;




Database::query("INSERT INTO `transale` (`id_transale`, `date_transale`, `US_ID`, `status_transale`, `tra_slip`, `tra_type_post`, `tra_number_tag`, `tra_modal_type`) 
                                VALUES (NULL, current_timestamp(), '{$_SESSION["id"]}', '1','$nameImage', '{$data["type_play"]}', NULL ,'{$nameImage1}' );");
$LastID = 1;
try {
    $LastID = Database::query("SELECT MAX(id_transale) AS MAXS FROM `transale`;", PDO::FETCH_OBJ)->fetch(PDO::FETCH_OBJ)->MAXS;
} catch (Exception $e) {
    $LastID = 1;
}

$cart = json_decode($data['cart']);

foreach ($cart  as $key => $item) :
    $id_products = $item->id_products;
    $pro = Database::squery("SELECT * FROM `products` WHERE id_products ='$id_products'", PDO::FETCH_OBJ, false);

    $new_stock = $pro->num_stock - $item->item;
    Database::query("UPDATE `products` SET `num_stock` = '$new_stock' WHERE `products`.`id_products` = '$id_products';");

    Database::query("INSERT INTO `transalede` (`id_transalede`, `id_transale`, `id_products`, `num_item`, `price_tran`) 
                                                VALUES (NULL, '$LastID', '{$item->id_products}', '{$item->item}', '{$item->price_unit}');");
endforeach;




echo json_encode(["error" => false, "LastID" => $LastID]);
