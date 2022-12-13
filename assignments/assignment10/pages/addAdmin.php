<?php

    require_once ROOT_PATH.'/classes/StickyForm.php';
    $stickyForm = new StickyForm();

    function init(){
        global $defaultArr, $stickyForm;

        if (!isset($_POST['submit'])) return build($defaultArr);

        $postArr = $stickyForm->validateForm($_POST, $defaultArr);
        
        //If error build with err msgs
        if($postArr['masterStatus']['status'] != 'noerrors') return build($postArr);

        return addDataAndBuild();
    }

    function addDataAndBuild(){
        global $defaultArr;  
        $errorMessage = '<p>There was an error adding the record</p>';
        require_once ROOT_PATH.'/classes/Pdo_methods.php';
        $pdo = new PdoMethods();

        $selectSql = <<< SQL
            select * from admins where email = (:email);
        SQL;

        $insertSql = <<< SQL
            insert into admins(name, email, password, status)
                values(:name, :email, :password, :status);
        SQL;

        $bindings = [
            [':name', $_POST['name'], 'str'],
            [':email', $_POST['email'], 'str'],
            [':password', password_hash($_POST['password'], PASSWORD_DEFAULT), 'str'],
            [':status', $_POST['status'], 'str']
        ];

        //Check if email already used
        $selectResult = $pdo->selectBinded($selectSql, [$bindings[1]]);

        if ($selectResult === 'error') return build($defaultArr, $errorMessage);
        if (count($selectResult)) return build($defaultArr, '<p>That email already exists</p>');

        //Add admin
        $result = $pdo->otherBinded($insertSql, $bindings);

        return build($defaultArr, ($result === 'error') ? $errorMessage : '<p>Admin has been added</p>');
    }
    
    function build($formArr, $acknowledgement = ''){

        global $stickyForm;
        $options = $stickyForm->createOptions($formArr['status']);
        
        return [
            '<h1>Add Admin</h1>'.$acknowledgement, 
            <<< HTML
                <form method="post" action="index.php?page=addAdmin">
                    <div class="form-group">
                        <label for="name">Name (letters only){$formArr['name']['errorOutput']}</label>
                        <input type="text" class="form-control" id="name" name="name" value="{$formArr['name']['value']}" >
                    </div>

                    <div class="form-group">
                        <label for="email">Email{$formArr['email']['errorOutput']}</label>
                        <input type="text" class="form-control" id="email" name="email" value="{$formArr['email']['value']}" >
                    </div>

                    <div class="form-group">
                        <label for="email">Password{$formArr['password']['errorOutput']}</label>
                        <input type="password" class="form-control" id="password" name="password" value="{$formArr['password']['value']}" >
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-select" id="status" name="status">
                            $options
                        </select>
                    </div>
                    <br>
                    <div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            HTML
        ];

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
        'name' => [
            'errorMessage' => "<span style='color: red; margin-left: 15px;'>Name cannot be blank, and must be a standard name</span>",
            'errorOutput' => '',
            'type' => 'text',
            'value' => 'Jire Lou',
            'regex' => 'name'
        ],
        'email' => [
            'errorMessage' => "<span style='color: red; margin-left: 15px;'>Email cannot be blank and must be written as a proper email</span>",
            'errorOutput' => '',
            'type' => 'text',
            'value' => 'jjrudolph@test.com',
            'regex' => 'email'
        ],
        'password' => [
            'errorMessage' => "<span style='color: red; margin-left: 15px;'>You must enter a password</span>",
            'errorOutput' => '',
            'type' => 'text',
            'value' => 'password',
            'regex' => 'password'
        ],
        'status' => [
            'type' => 'select',
            'options' => ['staff' => 'Staff', 'admin' => 'Admin'],
                'selected' => 'staff',
                'regex' => 'none'
        ]
    ];

?>