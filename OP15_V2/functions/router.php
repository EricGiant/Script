<?php
include("../controllers/addItem.php");
$URL = $_POST["URL"];
echo($URL . "<br>");
switch($URL)
{
    case "addItemPage.php":
        $array = [$_POST["name"], $_POST["price"], $_POST["amount"]];
        $URL = addItem($array); //having it return the string makes it so it doesn't need the ../ WHY
        break;
    case "index.php":
        $URL = "../views/seeItemsPage.php"; // needs ../ and i dont know why, the addItem controller doesn't need it and it works there
        break;
}
echo($URL);
header("Location: $URL");
?>