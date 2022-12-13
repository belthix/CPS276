<?php

    function init(){
        require_once ROOT_PATH.'/classes/Pdo_methods.php';

        if (!isset($_POST['delete']) || !isset($_POST['chkbx'])) return build();
        return deleteAndBuild();
    }

    function build($acknowledgement = '') {
        $pageHeading = '<h1>Delete Admin(s)</h1>';

        $pdo = new PdoMethods();

        $sql = <<< SQL
            select * from admins;
        SQL;

        $records = $pdo->selectNotBinded($sql);

        if (count($records) === 0) return [$pageHeading.'<p>There are no records to display</p>', ''];

        $tableBody = '';
        //Construct table row for each entry
        foreach($records as $row){
            $tableBody .= <<< HTML
                <tr>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['password']}</td>
                    <td>{$row['status']}</td>
                    <td><input type="checkbox" name="chkbx[]" value="{$row['id']}" /></td>
                </tr>
            HTML;
        }

        return [
            $pageHeading.$acknowledgement, 
            <<< HTML
                <form method="post" action="index.php?page=deleteAdmins">
                    <input type="submit" class="btn btn-danger" name="delete" value="Delete"/>
                    <br><br>
                    
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Status</th>
                                <th></th>
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
            delete from admins where id in (
        SQL.implode(',', array_map(fn ($bind) => $bind[0], $bindings)).');'; //Insert comma seperated identifiers from bindings and close sql

        $result = $pdo->otherBinded($sql, $bindings);

        return build(($result === 'error') ? '<p>Could not delete the admins</p>' : '<p>Admin(s) deleted</p>');
    }

?>