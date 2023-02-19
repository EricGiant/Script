<?php
include("../functions/database.php");

function addItem($array)
{
    $sql = "INSERT INTO `groceries` (`name`, `price`, `amount`) VALUES ('$array[0]', '$array[1]', '$array[2]')";
    submitData($sql);
    return "views/seeItemsPage.php";
}
?>