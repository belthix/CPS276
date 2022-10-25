<?php

    if (count($_POST)){
        require_once 'directories.php';
        $handler = new Directories();
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
        <title>Files and Directories</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <form method="post" action="formPage.php" class="row-g3">

                <h1>File and Directory Assignment</h1>
                <p>Enter a folder name and the contents of a file. Folder names should contain alpha numeric character only.</p>
                <p><?php echo $output ?></p>
                <br>

                <div class="row mb-3" id="nameInputRow">
                    <div class="col-12">
                        <label for="folderName" class="form-label">Folder Name</label>
                        <input type="text" class="form-control" id="folderName" name="folderName">
                    </div>
                </div>


                <div class="row mb-3" id="nameListRow">
                    <div class="col-12">
                        <label for="fileContent" class="form-label">File Content</label>
                        <textarea style="height: 250px;" class="form-control" id="fileContent" name="fileContent"></textarea>
                    </div>
                </div>


                <div class="row mb-3" id="buttonRow">
                    <div class="col-md-12 inline">
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </div>
                </div>
            
            </form>
        </div>
    </body>
</html>