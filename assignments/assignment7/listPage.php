<?php

    require_once 'listFilesProc.php';
    $handler = new FileList();
    $output = $handler->getList();

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>File List</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <h1>File List</h1>
            <a href="formPage.php" class="text-decoration-none">Add File</a>
            <br><br>
            <ul><?php echo $output ?></ul>
        </div>
    </body>
</html>