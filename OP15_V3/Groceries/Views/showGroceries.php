<?php
include("navBar.html");
?>
<table>
    <tr>
        <th>Product</th>
        <th>Prijs</th>
        <th>Aantal</th>
    </tr>
    <?php
    $html = "";
    for($i = 0; $i < sizeof($groceriesList); $i++)
    {
        $html .= "<tr>";
        for($x = 0; $x < 3; $x++)
        {
            $html .= "<th>" . $groceriesList[$i][$x] . "</th>";
        }
        $html .= "</tr>";
    }
    echo($html);
    ?>
</table>
<p>Totaal Prijs: <?= $totalPrice?></p>