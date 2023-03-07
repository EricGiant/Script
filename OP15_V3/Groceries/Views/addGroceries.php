<?php
include("navBar.html");
?>
<form action = "Groceries/Controller/add.php" method = "post">
    <input type = "text" name = "name" required>
    <input type = "number" step = "any" name = "price" required>
    <input type = "number" name = "amount" required>
    <input type = "submit">
</form>