<?php
    define("TABLE_ROWS", 15);
    define("ROW_CELLS", 5);

    $tableHtml = '<table border="1">';

    for ($i = 1; $i <= TABLE_ROWS; $i++) {
        $tableHtml .= "<tr>";

        for ($j = 1; $j <= ROW_CELLS; $j++) {
            $tableHtml .= "<td>Row {$i} Cell {$j}</td>";
        }

        $tableHtml .= "</tr>";
    }

    $tableHtml .= "</table>";

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Exercise 3</title>
    </head>
    <body>
        <?php echo $tableHtml; ?>
    </body>
</html>