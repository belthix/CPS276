<?php

    if (count($_POST)){
        require_once 'fileUploadProc.php';
        $handler = new FileUploader();
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
        <title>File Upload</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <form method="post" action="formPage.php" class="row-g3" enctype="multipart/form-data">

                <h1>File Upload</h1>
                <a href="listPage.php" class="text-decoration-none">Show File List</a>
                <p><?php echo $output ?></p>

                <div class="row mb-3" id="nameInputRow">
                    <div class="col-12">
                        <label for="fileName" class="form-label">File Name</label>
                        <input type="text" class="form-control" id="fileName" name="fileName">
                    </div>
                </div>


                <div class="row mb-3" id="nameListRow">
                    <div class="col-12">
                        <input type="file" name="fileUpload">
                    </div>
                </div>


                <div class="row mb-3" id="buttonRow">
                    <div class="col-md-12 inline">
                        <button type="submit" class="btn btn-primary" name="submit">Upload File</button>
                    </div>
                </div>
            
            </form>
        </div>
    </body>
</html>