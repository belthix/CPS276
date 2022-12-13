<?php 
    define('ROOT_PATH', realpath(dirname( __FILE__ ))); 
    require_once ROOT_PATH.'/pages/routes.php'; 
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Final Progect</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    </head>

	<body class="container">
		<?php
			echo $pageNav;
			echo $pageInfo[0]; //Acknowledgement
            echo $pageInfo[1]; //Form
		?>
	</body>
</html> 