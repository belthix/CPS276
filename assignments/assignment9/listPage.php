<?php

    require_once './classess/NoteRetriever.php';
    $handler = new NoteRetriever();
    $output = $handler->getList();

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Notes</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <h1>Display Notes</h1>
            <a href="formPage.php" class="text-decoration-none">Add Note</a>
            <br><br>

            <form method="post" action="listPage.php" class="row-g3" enctype="multipart/form-data">

                <div class="row mb-3" id="dateInputRow">
                    <div class="col-12">
                        <label for="begDate" class="form-label">Beginning Date</label>
                        <input type="date" class="form-control" id="begDate" name="begDate">
                    </div>
                </div>


                <div class="row mb-3" id="contentInputRow">
                    <div class="col-12">
                        <label for="endDate" class="form-label">Ending Date</label>
                        <input type="date" class="form-control" id="endDate" name="endDate">
                    </div>
                </div>


                <div class="row mb-3" id="buttonRow">
                    <div class="col-md-12 inline">
                        <button type="submit" class="btn btn-primary" name="submit">Get Notes</button>
                    </div>
                </div>
            
            </form>

            <?php echo $output ?>
        </div>
    </body>
</html>