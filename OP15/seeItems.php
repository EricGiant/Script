<?php
include("item.php");
include("database.php");

function getList()
{
    $result = getQuery("SELECT name, price, amount FROM groceries");
    $list = array();
    for($i = 0; $i < sizeof($result); $i++)
    {
        array_push($list, new item($result[$i][0], $result[$i][1], $result[$i][2]));
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

function showItems($array)
{
    $html = "";
    for($i = 0; $i < sizeof($array); $i++)
    {
        $html .= "<tr>";
        $html .= "<th>" . $array[$i] -> name . "</th>";
        $html .= "<th>" . $array[$i] -> price . "</th>";
        $html .= "<th>" . $array[$i] -> amount . "</th>";
        $html .= "</tr>";
    }
    return $html;
}
?>