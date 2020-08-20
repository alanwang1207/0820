<?php 

header("content-type:text/html; charset=utf-8");

// 0. 請先建立 Class 資料庫 （執行 class.sql）

// 1. 連接資料庫伺服器
$link = mysqli_connect("127.0.0.1", "root", 'root') or die(mysqli_connect_error());

$result = mysqli_query("set names utf8", $link);
mysqli_select_db("class", $link);

// 2. 執行 SQL 敘述
$commandText = "select * from students";
$result = mysqli_query($commandText, $link);

// $row = mysql_fetch_assoc($result);
// $row = mysql_fetch_row($result);
// $row = mysql_fetch_array($result);

$row = mysqli_fetch_assoc($result);

$json = json_encode($row);

echo $json;
// var_dump($row);

?>