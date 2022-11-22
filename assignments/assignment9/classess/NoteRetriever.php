<?php
    require realpath(dirname( __FILE__ )).'/Pdo_methods.php';

    class NoteRetriever {
        private $_list;

        public function __construct()
        {
            if (count($_POST) < 1) {
                $this->_list = '';
                return;
            }

            if (!(isset($_POST['begDate']) && strlen($_POST['begDate'])) || !(isset($_POST['endDate']) && strlen($_POST['endDate']))) {
                $this->_list = 'You must enter a start and end date';
                return;
            }

            $pdo = new PdoMethods();

            $sql = "SELECT * FROM notes WHERE note_time BETWEEN :begDate AND :endDate";

            $bindings = [
                [':begDate', strtotime($_POST['begDate']), 'int'],
                [':endDate', (strtotime($_POST['endDate']) + 86400), 'int']
            ];

            $records = $pdo->selectBinded($sql, $bindings);

            if($records == 'error') {
                $this->_list = 'There has been and error processing your request';
            } else if (count($records) < 1) {
                $this->_list = 'No notes available';
            } else {
                $this->_list = $records;
            }
            
        }

        public function getList() {
            if (is_string($this->_list))
                return $this->_list;
            
            $returnString = '<table class="table table-striped">';
            $returnString .= '<tr><th>Date and Time</th><th>Note</th></tr>';
            foreach ($this->_list as $item) {
                $returnString .= '<tr><td>'.date("m\/d\/Y h\:i A", $item['note_time']).'</td><td>'.$item['note_contents'].'</td></tr>';
            }
            $returnString .= '</table>';
            return $returnString;
        }
    }

?>