<?php
error_reporting(-1);
header('Content-Type: text/html; charset=utf-8');
session_start();

//подключаем настройки
include_once 'config.php';

//Подключаемся к базе
$db = mysqli_connect(DB_LOCAL, DB_LOGIN, DB_PASS, DB_NAME);
mysqli_set_charset($db,'utf-8');
mysqli_query($db,"SET NAMES 'utf8'"); 
mysqli_query($db,"SET CHARACTER SET 'utf8'");
mysqli_query($db,"SET SESSION collation_connection = 'utf8_general_ci'");
?>