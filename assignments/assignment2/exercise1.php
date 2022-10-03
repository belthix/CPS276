<?php
    //Consts
    define("MAIN_ITEM_COUNT", 4);
    define("SUB_ITEM_COUNT", 5);

    $listString = "<ul>";

    for($i = 1; $i <= MAIN_ITEM_COUNT; $i++) {

        $listString .= "<li>{$i}<ul>";
        
        for($j = 1; $j <= SUB_ITEM_COUNT; $j++) {
            $listString .= "<li>{$j}</li>";
        }

        $listString .= "</ul></li>";

    }

    $listString .= "</ul>";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Exercise 1</title>
    </head>
    <body>
        <?php echo $listString; ?>
    </body>
</html>