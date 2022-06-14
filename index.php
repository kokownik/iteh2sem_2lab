<?php
require_once "vendor/autoload.php";
use MongoDB\Client;

$client = new \MongoDB\Client();
$db = $client->lab2->items;
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>lb2</title>
    <script src = "script.js"></script>
</head>
<body>
<form action="" method="post">
    <input type="submit" value="Перечень производителей" name="vendor"><br> <! -- поиск производителей -->

</form>
<br>
<form action="" method="post">
    <input type="submit" value="Товары, отсутствующие на складе" name="items"><br> <! -- поиск по категории -->

</form>
<br>
<form action="" method="post">
    <input placeholder="Минимальная цена:" type="text" name="min_price"> <! -- поиск по ценам -->
    <input placeholder="Максимальная цена:" type="text" name="max_price">
    <input type="submit" value="Поиск"><br>

</form>

<button onclick="PosmotretDannye()">
    Показать сохраненные данные
</button>
<button onclick="SaveDannye()">
    Сохранить данные
</button>

<div id="savedContent"></div>


<?php

if (isset($_POST["vendor"])) {
    $statement = $db->distinct("Vendor");
echo "<div id='content'>";
        echo " Производитель: ";

    foreach ($statement as $value) {
        echo " {$value} ";}
}
echo "</div>";

if (isset($_POST["items"])) {
    $statement = $db->find(["quantity" => 0]);
    echo "<div id='content'>";
    foreach ($statement->toArray() as $data) {
		
        echo "<br>Название: {$data['name']} <br> 
		Цена: {$data['price']} <br>  Количество: {$data['quantity']} <br>  
		Качество: {$data['quality']} <br> <hr>";}
}
echo "</div>";

// запрос по ценам
if (isset($_POST["min_price"])) {
    $min = intval($_POST["min_price"]);
    $max = intval($_POST["max_price"]);
    $statement = $db->find(["price" => ['$gte' => $min, '$lte' => $max ]] );
    echo "<div id='content'>";
    foreach ($statement as $data) {
        echo "<br>Название: {$data['name']} <br> 
		Цена: {$data['price']} <br>  Количество: {$data['quantity']} <br>  
		Качество: {$data['quality']} <br> <hr>";}
}
echo "</div>";
?>
</body>
</html>