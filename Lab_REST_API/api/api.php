<?php
// 一個簡單但可以運作的 REST API，
// 物件導向與MVC課程時，再來寫進化版

$method = $_SERVER['REQUEST_METHOD'];
$url = explode("/", rtrim($_GET["url"], "/"));
//資料庫連線
$dbLink = @mysqli_connect("localhost", "root", "root") or die(mysqli_connect_error());
mysqli_query($dbLink, "set names utf8");
mysqli_select_db($dbLink, "apiDB");

switch ($method . " " . $url[0]) {
    case "POST products":
        echo "creating ...";
        break;
    case "GET products":
        if (isset($url[1]))
            getProductById($url[1]);
        else
            getProducts();
        break;
    case "PUT products":
        echo 'update ...';
        break;
    case "DELETE products":
        echo 'delete ...';
        break;
    default:
        echo "Thank you";
}
mysqli_close($dbLink);


function getProductById($id)
{
    if (!is_numeric($id))
        die("id is not a number.");

    global $dbLink;
    $result = mysqli_query(
        $dbLink,
        "select * from products where productId = " . $id
    );
    $row = mysqli_fetch_assoc($result);
    echo json_encode($row);
}

function getProducts()
{
    global $dbLink;
    $result = mysqli_query(
        $dbLink,
        "select * from products"
    );
    while ($row = mysqli_fetch_assoc($result)) {
        $datalist[] = $row;
    }
    echo json_encode($datalist);
}
