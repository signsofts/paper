<?php

session_start();

if (!isset($_SESSION["type"])) {

    unset($_SESSION["type"]);
    unset($_SESSION["id"]);
    unset($_SESSION["name"]);

    session_destroy();
    echo "<script>alert('ออกจากระบบสำเร็จ');location.assign('../login.php');</script>";
    exit;
}

if ($_SESSION["type"] == 'user') {
    unset($_SESSION["type"]);
    unset($_SESSION["id"]);
    unset($_SESSION["name"]);

    session_destroy();
    echo "<script>alert('ออกจากระบบสำเร็จ');location.assign('../login.php');</script>";
    exit;
} else if ($_SESSION["type"] == 'admin') {
    unset($_SESSION["type"]);
    unset($_SESSION["id"]);
    unset($_SESSION["name"]);

    session_destroy();
    echo "<script>alert('ออกจากระบบสำเร็จ');location.assign('../a/login.php');</script>";
    exit;
}

?>