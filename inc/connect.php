<?php

// PDO options
$opt = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8, time_zone = '+04:00'"
);
// connection
try {
    $con = new PDO('mysql:host=localhost;dbname=users_login', 'root', '', $opt);
} catch (PDOException $e) {
    echo $e->getMessage();
}
