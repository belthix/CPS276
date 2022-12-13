<?php
    
    //Get page
    session_start();
    $page = (isset($_GET) && isset($_SESSION['access'])) ? $_GET['page'] : 'login';

    //Validate page and access
    switch ($page) {
        case 'addAdmin':
        case 'deleteAdmins':
            $hasPerms = ($_SESSION['userType'] === 'admin') ? $_SESSION['userType'] : false;
            break;
        case 'addContact':
        case 'deleteContacts':
        case 'welcome':
            $hasPerms = ($_SESSION['access'] === 'accessGranted') ? $_SESSION['userType'] : false;
            break;
        case 'login':
            $hasPerms = 'guest';
            break;
    }

    //If failed redirect to login page
    if (!$hasPerms) header('Location: index.php?page=login');

    //Get and init page
    require_once ROOT_PATH."/pages/${page}.php";
    $pageInfo = init();

    //Construct navbar
    $pageNav = (function ($hasPerms) {
        if ($hasPerms === 'guest') return '';

        $nav = <<< HTML
            <nav>
                <ul class='nav'>
                    <li class='nav-item'><a href='index.php?page=addContact' class='nav-link'>Add Contact</a></li>
                    <li class='nav-item'><a href='index.php?page=deleteContacts' class='nav-link'>Delete Contact(s)</a></li>
        HTML;

        if ($hasPerms === 'admin')
        $nav .= <<< HTML
                    <li class='nav-item'><a href='index.php?page=addAdmin' class='nav-link'>Add Admin</a></li>
                    <li class='nav-item'><a href='index.php?page=deleteAdmins' class='nav-link'>Delete Admin(s)</a></li>
        HTML;

        return $nav.<<< HTML
                    <li class='nav-item'><a href='logout.php' class='nav-link'>Logout</a></li> 
                </ul>
            </nav>
        HTML;
    })($hasPerms);

?>