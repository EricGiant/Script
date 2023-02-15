<!DOCTYPE html>
<html>
    <head>
        <title>OP15</title>
    </head>
    <body>
        <?php
        include("menu.php");
        ?>
        <table>
            <tr>
                <th>Product</th>
                <th>Prijs</th>
                <th>Aantal</th>
            </tr>
                <?php
                include("seeItems.php");
                $list = getList();
                echo(showItems($list));
                ?>
        </table>
        <p>Totaal prijs:
            <?php
            $totalPrice = calculateTotal($list);
            echo($totalPrice);
            ?>
        </p>
    </body>
</html>