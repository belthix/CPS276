<?php
    require realpath(dirname( __FILE__ )).'/Pdo_methods.php';

    class NoteStorer {
        private $_msg;

        public function __construct()
        {
            if (count($_POST) < 1) {
                $this->_msg = '';
                return;
            }

            if (!(isset($_POST['dateTime']) && strlen($_POST['dateTime'])) || !(isset($_POST['noteContent']) && strlen($_POST['noteContent']))) {
                $this->_msg = 'You must enter date, time, and a note';
                return;
            }

            $this->_addNote();
        }

        public function getMsg() { return $this->_msg; }

        private function _addNote(){
	
            $pdo = new PdoMethods();
    
            $sql = "INSERT INTO notes (note_time, note_contents) VALUES (:dateTime, :noteContent)";
    
            $bindings = [
                [':dateTime', strtotime($_POST['dateTime']), 'int'],
                [':noteContent', $_POST['noteContent'], 'str']
            ];
    
            $result = $pdo->otherBinded($sql, $bindings);
    
            if($result === 'error'){
                $this->_msg = 'There was an error storing the note';
            }
            else {
                $this->_msg = 'Note has been saved';
            }
        }
    }

?>