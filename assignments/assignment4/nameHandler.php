<?php

    class NameHandler {
        
        private $_nameList;

        public function __construct()
        {
            #Exit if no input
            if (!count($_POST)) return;

            if (isset($_POST['clearList'])) {
                $this->_nameList = '';
            } else {
                $this->_nameList = isset($_POST['nameList']) ? $_POST['nameList'] : '';

                #If list has text but doesnt end in a newline
                if (preg_match('/(^.+)([^(\\n)||(\\r)]$)/', $this->_nameList))
                    $this->_nameList .= "\n";
            
                if (isset($_POST['newName'])) {
                    $newName = explode(' ', $_POST['newName'], 2);
                    
                    #Skip if incorrect syntax
                    if (count($newName) == 2) {
                        $this->_nameList .= "{$newName[1]}, {$newName[0]}\n";
                    }
                }
            }
        }

        public function getNames() { return $this->_nameList; }
    }

?>