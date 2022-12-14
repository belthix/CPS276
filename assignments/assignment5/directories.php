<?php
    class Directories {
        STATIC $_basePath = "./dirs/";
        private $_msg;

        public function __construct()
        {
            $this->_msg = '';
            if (count($_POST) < 2 || !(isset($_POST['folderName']) && isset($_POST['fileContent']))) {
                return;
            } else {
                $dirName = $_POST['folderName'];
                $fileContent = $_POST['fileContent'];

                if (empty($dirName)) return;

                $path = Directories::$_basePath;
                $path .= "{$dirName}";
                if (is_dir($path)) {
                    $this->_msg = 'A directory already exists with that name.';
                } else {
                    mkdir($path, 0777);
                    chmod($path, 0777);

                    $file_path = "{$path}/readme.txt";
                    
                    $readme = fopen($file_path, 'w');
                    fwrite($readme, $fileContent);
                    fclose($readme);

                    $this->_msg = "File and driectory were created:</p><p style=\"color:dodgerblue\">{$file_path}";
                }
            }
        }

        public function getMsg() { return $this->_msg; }
    }

?>