<!DOCTYPE html>
<html>
    <head>
        <title>OP15</title>
    </head>
    <body>
        <?php
        include("menu.html");
        ?>
        <table>
            <tr>
                <th>Product</th>
                <th>Prijs</th>
                <th>Aantal</th>
            </tr>
                <?php
                include("../controllers/seeItems.php");
                $list = getList();
                $html = "";
                for($i = 0; $i < sizeof($list); $i++)
                {
                    $html .= "<tr>";
                    $html .= "<th>" . $list[$i] -> name . "</th>";
                    $html .= "<th>" . $list[$i] -> price . "</th>";
                    $html .= "<th>" . $list[$i] -> amount . "</th>";
                    $html .= "</tr>";
                }
                echo($html);
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