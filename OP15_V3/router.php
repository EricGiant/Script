<?php
$request = $_SERVER["REQUEST_URI"];
switch ($request)
{
    case '/':
        require(__DIR__ . "/Groceries/Controller/show.php");
        break;
    case "/show":
        require(__DIR__ . "/Groceries/Controller/show.php");
        break;
    case "/add":
        require (__DIR__ . "/Groceries/Views/addGroceries.php");
        break;
    default:
        http_response_code(404);
        require(__DIR__ . "/404.php");
        break;
}
?>