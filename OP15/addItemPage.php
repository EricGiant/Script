<!DOCTYPE html>
<html>
<head>
    <title>OP15</title>
</head>
<body>
    <?php
    include("menu.php");
    ?>
    <form action = "router.php" method = "post">
        <input type = "text" name = "name" required>
        <input type = "number" step = "any" name = "price" required>
        <input type = "number" name = "amount" required>
        <input type = "submit">
        <input type = "hidden" name = "URL" value = "addItemPage.php">
    </form>
</body>
</html>