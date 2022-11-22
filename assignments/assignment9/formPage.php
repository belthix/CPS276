<?php

    if (count($_POST)){
        require_once './classess/NoteStorer.php';
        $handler = new NoteStorer();
        $output = $handler->getMsg();
    } else {
        $output = '';
    }

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Add Notes</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <form method="post" action="formPage.php" class="row-g3" enctype="multipart/form-data">

                <h1>Add Notes</h1>
                <a href="listPage.php" class="text-decoration-none">Display Notes</a>
                <p><?php echo $output ?></p>

                <div class="row mb-3" id="dateInputRow">
                    <div class="col-12">
                        <label for="dateTime" class="form-label">Date and Time</label>
                        <input type="datetime-local" class="form-control" id="dateTime" name="dateTime">
                    </div>
                </div>


                <div class="row mb-3" id="contentInputRow">
                    <div class="col-12">
                        <label for="noteContent" class="form-label">Note Content</label>
                        <textarea style="height: 500px;" class="form-control" id="noteContent" name="noteContent"></textarea>
                    </div>
                </div>


                <div class="row mb-3" id="buttonRow">
                    <div class="col-md-12 inline">
                        <button type="submit" class="btn btn-primary" name="submit">Add Note</button>
                    </div>
                </div>
            
            </form>
        </div>
    </body>
</html>