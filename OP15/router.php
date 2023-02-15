<?php
include("addItem.php");
$URL = $_POST["URL"];
switch($URL)
{
    case "addItemPage.php":
        $array = [$_POST["name"], $_POST["price"], $_POST["amount"]];
        $URL = addItem($array);
        break;
}
header("Location: " . $URL);
?>