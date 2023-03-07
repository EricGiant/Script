<?php
//submit data to DB
include(__DIR__ . "../../../Core/database.php");
$data = $_POST;
$sql = "INSERT INTO `groceries` (`name`, `price`, `amount`) VALUES ('$data[name]', '$data[price]', '$data[amount]')";
submitData($sql);

//load show
header("Location: /show");
?>