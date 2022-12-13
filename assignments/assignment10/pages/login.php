<?php

    require_once ROOT_PATH.'/classes/StickyForm.php';


    function init () {
        global $defaultArr;
        $stickyForm = new StickyForm;

        if (!isset($_POST['submit'])) return build($defaultArr);

        $postArr = $stickyForm->validateForm($_POST, $defaultArr);
        
        //If error build with err msgs
        if($postArr['masterStatus']['status'] != 'noerrors') return build($postArr);

        return validateCredentials();
    }

    function build($formArr, $acknowledgement = '') {
        return [
            "<h1>Login</h1>\n".$acknowledgement,
            <<< HTML
                <form method="post" action="index.php?page=login" class="row-g3" enctype="multipart/form-data">
                    <div class="row mb-3" id="emailInputRow">
                        <div class="col-12">
                            <label for="email" class="form-label">Email{$formArr['email']['errorOutput']}</label>
                            <input type="text" class="form-control" id="email" name="email" value="{$formArr['email']['value']}">
                        </div>
                    </div>

                    <div class="row mb-3" id="passwordInputRow">
                        <div class="col-12">
                            <label for="password" class="form-label">Password{$formArr['password']['errorOutput']}</label>
                            <input type="password" class="form-control" id="password" name="password" value="{$formArr['password']['value']}">
                        </div>
                    </div>

                    <div class="row mb-3" id="buttonRow">
                        <div class="col-md-12 inline">
                            <button type="submit" class="btn btn-primary" name="submit">Login</button>
                        </div>
                    </div>
                </form>
            HTML
        ];
    }

    function validateCredentials() {
        global $defaultArr;
        require_once ROOT_PATH.'/classes/Pdo_methods.php';

        //Get user from database
        $sql = <<< SQL
            select * from admins
                where email = :email;
        SQL;
        
        $bindings = [
            [':email', $_POST['email'], 'str'],
        ];

        $pdo = new PdoMethods();
        $result = $pdo->selectBinded($sql, $bindings);

        if ($result === 'error') return build($defaultArr, '<p>There was an error logging in</p>');

        //Verify exists and password match
        if (!$result || !password_verify($_POST['password'], $result[0]['password'])) return build($defaultArr, '<p>Invalid login credentials</p>');
        
        //Start session
        session_start();
        $_SESSION['access'] = 'accessGranted';
        $_SESSION['userType'] = $result[0]['status'];
        $_SESSION['userName'] = $result[0]['name'];

        //Redirect to welcome page
        header('Location: index.php?page=welcome');
    }

    /* 
    Mult-dimensional associative array that is used to contain the data and error messages for the form.   
    Updated based off of posted data and error messages.
    */
    $defaultArr = [
        'masterStatus' => [
            'status' => 'noerrors',
            'type' => 'masterStatus'
        ],
        'email' => [
            'errorMessage' => "<span style='color: red; margin-left: 15px;'>Email cannot be blank and must be written as a proper email</span>",
            'errorOutput' => '',
            'type' => 'text',
            'value' => 'jjrudolph@admin.com',
            'regex' => 'email'
        ],
        'password' => [
            'errorMessage' => "<span style='color: red; margin-left: 15px;'>Password cannot be blank</span>",
            'errorOutput' => '',
            'type' => 'text',
            'value' => 'password',
            'regex' => 'password'
        ],
    ];

?>