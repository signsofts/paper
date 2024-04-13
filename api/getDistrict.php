<?php

// print_r($_POST);

include ("../config/connectdb.php");

$data = (object) json_decode(file_get_contents('php://input'));

header('Content-Type: application/json; charset=utf-8');
echo json_encode(Database::squery("SELECT * FROM `district` WHERE province_code = '$data->key'",PDO::FETCH_OBJ,true));






?>