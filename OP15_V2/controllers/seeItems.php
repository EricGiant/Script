<?php
include("../classes/item.php");
include("../functions/database.php");

function getList()
{
    $result = getQuery("SELECT name, price, amount FROM groceries");
    $list = array();
    for($i = 0; $i < sizeof($result); $i++)
    {
        array_push($list, new Item($result[$i][0], $result[$i][1], $result[$i][2]));
    }
    return $list;
}

function calculateTotal($array)
{
    $total = 0;
    for($i = 0; $i < sizeof($array); $i++)
    {
        for($x = 0; $x < $array[$i] -> amount; $x++)
        {
            $total += $array[$i] -> price;
        }
    }
    return $total;
}
?>