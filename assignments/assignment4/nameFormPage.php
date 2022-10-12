<?php

    if (count($_POST)){
        require_once 'nameHandler.php';
        $handler = new NameHandler();
        $output = $handler->getNames();
    } else {
        $output = '';
    }

?>


<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Name List</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <form method="post" action="nameFormPage.php" class="row-g3">

                <h1>Name List</h1>

                <div class="row mb-3" id="nameInputRow">
                    <div class="col-12">
                        <label for="newName" class="form-label">New Name</label>
                        <input type="text" class="form-control" id="newName" name="newName">
                    </div>
                </div>

                <div class="row mb-3" id="buttonRow">
                    <div class="col-md-12 inline">
                        <button type="submit" class="btn btn-primary" name="addName">Add Name</button>
                        <button type="submit" class="btn btn-primary" name="clearList">Clear List</button>
                    </div>
                </div>

                <div class="row mb-3" id="nameListRow">
                    <div class="col-12">
                        <label for="nameList" class="form-label">Your List</label>
                        <textarea style="height: 500px;" class="form-control" id="namelist" name="nameList"><?php echo $output ?></textarea>
                    </div>
                </div>
            
            </form>
        </div>
    </body>
</html>