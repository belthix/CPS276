<?php

    function init(){
        require_once ROOT_PATH.'/classes/Pdo_methods.php';

        if (!isset($_POST['delete']) || !isset($_POST['chkbx'])) return build();
        return deleteAndBuild();
    }

    function build($acknowledgement = '') {
        $pageHeading = '<h1>Delete Contact(s)</h1>';

        $pdo = new PdoMethods();

        $sql = <<< SQL
            select * from contacts;
        SQL;

        $records = $pdo->selectNotBinded($sql);

        if (count($records) === 0) return [$pageHeading.'<p>There are no records to display</p>', ''];

        $tableBody = '';
        //Construct table row for each entry
        foreach($records as $row){
            $tableBody .= <<< HTML
                <tr>
                    <td>{$row['name']}</td>
                    <td>{$row['address']}</td>
                    <td>{$row['city']}</td>
                    <td>{$row['state']}</td>
                    <td>{$row['phone']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['dob']}</td>
                    <td>{$row['contacts']}</td>
                    <td>{$row['age']}</td>
                    <td><input type="checkbox" name="chkbx[]" value="{$row['id']}" /></td>
                </tr>
            HTML;
        }

        return [
            $pageHeading.$acknowledgement, 
            <<< HTML
                <form method="post" action="index.php?page=deleteContacts">
                    <input type="submit" class="btn btn-danger" name="delete" value="Delete"/>
                    <br><br>
                    
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Address</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>DOB</th>
                                <th>Contact</th>
                                <th style="width: 100px">Age</th>
                                <th style="width: 100px">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            {$tableBody}
                        </tbody>
                    </table>
                </form>
            HTML
        ];
    }

    function deleteAndBuild() {
        $pdo = new PdoMethods();

        //Creates bindings from checked boxes
        $bindings = array_map(fn ($id, $index) => [":id{$index}", $id, 'int'], $_POST['chkbx'], array_keys($_POST['chkbx']));

        $sql = <<< SQL
            delete from contacts where id in (
        SQL.implode(',', array_map(fn ($bind) => $bind[0], $bindings)).');'; //Insert comma seperated identifiers from bindings and close sql

        $result = $pdo->otherBinded($sql, $bindings);

        return build(($result === 'error') ? '<p>Could not delete the contacts</p>' : '<p>Contact(s) deleted</p>');
    }

?>