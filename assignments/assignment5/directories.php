<?php

    class Directories {
        STATIC $_basePath = "dirs/";
        private $_msg;

        public function __construct()
        {
            if (count($_POST) < 2 || !(isset($_POST['folderName']) && isset($_POST['fileContents']))) {
                $this->_msg = '';
            } else {
                $dirName = $_POST['folderName'];
                $fileContent = $_POST['fileContents'];

                $path = "{$this->_basePath}{$dirName}";
                if (file_exists($path)) {
                    $this->_msg = 'A directory already exists witht hat name.';
                } else {
                    mkdir($path, 0777);
                    chmod($path, 0777);

                    $file_path = "{$path}/readme.txt";
                    touch($file_path);
                    
                    $readme = fopen($file_path, 'w');
                    fwrite($readme, $fileContent);
                    fclose($readme);

                    $this->_msg = "File and driectory were created<br>\"{$file_path}\"";
                }
            }
        }

        public function getMsg() { return $this->_msg; }
    }

?>

<?php

    class NameHandler {
        
        private static $_base_path = '/dirs/';
        private $_msg;

        public function __construct()
        {
            #Exit if no input
            if (count($_POST) || (isset($_POST['folderName']) || isset($_POST['fileContents']))) {
                $this->_names = [];
            } else {
                $this->_names = isset($_POST['nameList']) ? explode("\n", $_POST['nameList']) : [];
            
                if (isset($_POST['newName'])) {
                    $newName = explode(' ', $_POST['newName'], 2);

                    #Skip if incorrect syntax
                    if (count($newName) == 2) {
                        array_push($this->_names, "{$newName[1]}, {$newName[0]}");
                        natcasesort($this->_names);
                    }
                }
            }
        }

        public function getMsg() { return implode("\n", $this->_names); }
    }

?>