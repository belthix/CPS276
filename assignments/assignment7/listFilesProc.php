<?php
    require 'Pdo_methods.php';

    class FileList {
        private $_list;

        public function __construct()
        {
            $pdo = new PdoMethods();

            $sql = "SELECT * FROM files";

            $records = $pdo->selectNotBinded($sql);

            if($records == 'error') {
                $this->_list = 'There has been and error processing your request';
            } else {
                $this->_list = $records;
            }
            
        }

        public function getList() {
            if (is_string($this->_list))
                return $this->_list;
            
            $returnString = '';
            foreach ($this->_list as $item) {
                $returnString .= '<li><a href="'.$item['file_path'].'" class="text-decoration-none" target="_blank">'.$item['file_name'].'</a></li>';
            }
            return $returnString;
        }
    }

?>