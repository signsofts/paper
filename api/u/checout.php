<?php
include("../../config/connectdb.php");
$data = (object) json_decode(file_get_contents('php://input'));

header('Content-Type: application/json; charset=utf-8');
$data =  $_POST;


// $target_dir = "img/slip/";
// $target_file = $target_dir . basename($_FILES["fileUpload"]["name"]);

// $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); // png
// $imageName = time() . "." . $imageFileType;

// file_get_contents($target_file);

if ($_FILES['fileUpload']['error'] == 0) {
}

// Check file size
if ($_FILES["image"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo "The file " . basename($_FILES["image"]["name"]) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

if ($data["type_play"] == 1) {
}



echo json_encode('');
