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

        require_once ROOT_PATH.'/classes/Pdo_methods.php';

        $pdo = new PdoMethods();

        $sql = <<< SQL
            insert into contacts(name, address, city, state, phone, email, dob, contacts, age)
                values(:name, :address, :city, :state, :phone, :email, :dob, :contact, :age);
        SQL;

        $bindings = [
            [':name', $_POST['name'], 'str'],
            [':address', $_POST['address'], 'str'],
            [':city', $_POST['city'], 'str'],
            [':state', $_POST['state'], 'str'],
            [':phone', $_POST['phone'], 'str'],
            [':email', $_POST['email'], 'str'],
            [':dob', $_POST['dob'], 'str'],
            [':contact', ((isset($_POST['contact'])) ? implode(',', $_POST['contact']) : 'No contact options selected'), 'str'],
            [':age', ((isset($_POST['age'])) ? $_POST['age'] : ''), 'str']
        ];

        $result = $pdo->otherBinded($sql, $bindings);

        return build($defaultArr, ($result === 'error') ? '<p>There was an error adding the record</p>' : '<p>Contact Information Added</p>');
    }
    
    function build($formArr, $acknowledgement = ''){

        global $stickyForm;
        $options = $stickyForm->createOptions($formArr['state']);
        
        return [
            '<h1>Add Contact</h1>'.$acknowledgement, 
            <<< HTML
                <form method="post" action="index.php?page=addContact">
                    <div class="form-group">
                        <label for="name">Name (letters only){$formArr['name']['errorOutput']}</label>
                        <input type="text" class="form-control" id="name" name="name" value="{$formArr['name']['value']}" >
                    </div>

                    <div class="form-group">
                        <label for="address">Address (just number and street){$formArr['address']['errorOutput']}</label>
                        <input type="text" class="form-control" id="address" name="address" value="{$formArr['address']['value']}" >
                    </div>

                    <div class="form-group">
                        <label for="city">City{$formArr['city']['errorOutput']}</label>
                        <input type="text" class="form-control" id="city" name="city" value="{$formArr['city']['value']}" >
                    </div>

                    <div class="form-group">
                        <label for="state">State</label>
                        <select class="form-select" id="state" name="state">
                            $options
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone{$formArr['phone']['errorOutput']}</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{$formArr['phone']['value']}" >
                    </div>

                    <div class="form-group">
                        <label for="email">Email address{$formArr['email']['errorOutput']}</label>
                        <input type="text" class="form-control" id="email" name="email" value="{$formArr['email']['value']}" >
                    </div>

                    <div class="form-group">
                        <label for="dob">Date of birth{$formArr['dob']['errorOutput']}</label>
                        <input type="text" class="form-control" id="dob" name="dob" value="{$formArr['dob']['value']}" >
                    </div>

                    <p>Please check all contact types you would like (optional):</p>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="news">Newsletter</label>
                        <input class="form-check-input" type="checkbox" name="contact[]" id="news" value="newsletter" {$formArr['contact']['status']['newsletter']}>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="email">Email Updates</label>
                        <input class="form-check-input" type="checkbox" name="contact[]" id="email" value="emailUpdates" {$formArr['contact']['status']['emailUpdates']}>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="text">Text Updates</label>
                        <input class="form-check-input" type="checkbox" name="contact[]" id="text" value="textUpdates" {$formArr['contact']['status']['textUpdates']}>
                    </div>
                        
                    <p>Please select an age range (you must select one):{$formArr['age']['errorOutput']}</p>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="tenToEighteen">10-18</label>
                        <input class="form-check-input" type="radio" name="age" id="tenToEighteen" value="10-18"  {$formArr['age']['value']['10-18']}>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="nineteenToThirty">19-30</label>
                        <input class="form-check-input" type="radio" name="age" id="nineteenToThirty" value="19-30"  {$formArr['age']['value']['19-30']}>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="thirtyToFifty">30-50</label>
                        <input class="form-check-input" type="radio" name="age" id="thirtyToFifty" value="31-50"  {$formArr['age']['value']['31-50']}>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="fiftyOnePlus">51 +</label>
                        <input class="form-check-input" type="radio" name="age" id="fiftyOnePlus" value="51+"  {$formArr['age']['value']['51+']}>
                    </div>
                    
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
        'address' => [
            'errorMessage' => "<span style='color: red; margin-left: 15px;'>Address cannot be blank and must be a valid address</span>",
            'errorOutput' => '',
            'type' => 'text',
            'value' => '123 Someplace',
            'regex' => 'address'
        ],
        'city' => [
            'errorMessage' => "<span style='color: red; margin-left: 15px;'>City cannot be blank and must be a valid city</span>",
            'errorOutput' => '',
            'type' => 'text',
            'value' => 'Anywhere',
            'regex' => 'city'
        ],
        'state' => [
            'type' => 'select',
            'options' => ['MI' => 'Michigan', 'VA' => 'Virginia', 'OH' => 'Ohio', 'PA' => 'Pennslyvania', 'TX' => 'Texas'],
                'selected' => 'mi',
                'regex' => 'none'
        ],
        'phone' => [
            'errorMessage' => "<span style='color: red; margin-left: 15px;'>Phone cannot be blank and must be written as 999.999.9999</span>",
            'errorOutput' => '',
            'type' => 'text',
            'value' => '999.999.9999',
            'regex' => 'phone'
        ],
        'email' => [
            'errorMessage' => "<span style='color: red; margin-left: 15px;'>Email cannot be blank and must be written as a proper email</span>",
            'errorOutput' => '',
            'type' => 'text',
            'value' => 'jjrudolph@test.com',
            'regex' => 'email'
        ],
        'dob' => [
            'errorMessage' => "<span style='color: red; margin-left: 15px;'>Dob cannot be blank, must be a valid date and be formatted as mm/dd/yyyy</span>",
            'errorOutput' => '',
            'type' => 'text',
            'value' => '12/25/1999',
            'regex' => 'dob'
        ],
        'contact' => [
            'action' => 'notRequired',
            'type' => 'checkbox',
            'status' => ['newsletter' => '', 'emailUpdates' => '', 'textUpdates' => '']
        ],
        'age' => [
            'errorMessage' => "<span style='color: red; margin-left: 15px;'>You must select an age range</span>",
            'errorOutput' => '',
            'action' => 'required',
            'type' => 'radio',
            'value' => ['10-18' => '', '19-30' => '', '31-50' => '', '51+' => '']
        ]
    ];

?>