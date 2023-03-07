<?php
//get all groceries
include(__DIR__ . "../../../Core/database.php");
$groceriesList = getQuery("SELECT name, price, amount FROM groceries");

//calculate total price
$totalPrice = 0;
for($i = 0; $i < sizeof($groceriesList); $i++)
{
    for($x = 0; $x < $groceriesList[$i][2]; $x++)
    {
        $totalPrice += $groceriesList[$i][1];
    }
}

//load page
require(__DIR__ . "../../Views/showGroceries.php");
?>