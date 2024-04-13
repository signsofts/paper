<?php
session_start();
define("DB_TYPE", "MySQL"); // MySQL & SQLite
define("DB_HOST", "localhost");

// define("DB_USERNAME", "signsoft_signsoft");
// define("DB_PASSWORD", "signsoft_signsoft");
// define("DB_NAME", "signsoft_signsoft");


define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "shrimp");

define("DB_DNS_MYSQL", "mysql:host=" . DB_HOST . "; dbname=" . DB_NAME);
?>