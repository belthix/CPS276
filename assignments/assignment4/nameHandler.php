<?php

    class NameHandler {
        
        private $_names;

        public function __construct()
        {
            #Exit if no input
            if (!count($_POST)) return;

            if (isset($_POST['clearList'])) {
                $this->_names = [];
            } else {
                $this->_names = isset($_POST['nameList']) ? explode("\n", $_POST['nameList']) : [];
            
                if (isset($_POST['newName'])) {
                    $newName = explode(' ', $_POST['newName'], 2);

                    #Skip if incorrect syntax
                    if (count($newName) == 2) {
                        array_push($this->_names, "{$newName[1]}, {$newName[0]}");
                        sort($this->_names);
                    }
                }
            }
        }

        public function getNames() { return implode("\n", $this->_names); }
    }

?>