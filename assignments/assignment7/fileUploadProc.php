<?php
    require 'Pdo_methods.php';

    class FileUploader {
        private $_msg;

        public function __construct()
        {
            if (count($_POST) < 2 || !(isset($_POST['fileName']) && isset($_FILES['fileUpload']))) {
                $this->_msg = '';
                return;
            } else {
                if ($_FILES['fileUpload']['size'] > 100000) {
                    $this->_msg = 'File is too large';
                    return;
                }
                if ($_FILES['fileUpload']['type'] != 'application/pdf' && $_FILES['fileUpload']['type'] != 'text/pdf') {
                    $this->_msg = 'File must be of type pdf'.$_POST['fileName'];
                    return;
                }

                $file_num = rand(1, 10);
                $this->_addFile('files/newsletterorform'.$file_num.'.pdf');
            }
        }

        public function getMsg() { return $this->_msg; }

        private function _addFile($path){
	
            $pdo = new PdoMethods();
    
            $sql = "INSERT INTO files (file_name, file_path) VALUES (:fileName, :filePath)";
    
            $bindings = [
                [':fileName', $_POST['fileName'], 'str'],
                [':filePath', $path, 'str']
            ];
    
            $result = $pdo->otherBinded($sql, $bindings);
    
            if($result === 'error'){
                $this->_msg = 'There was an error storing the file';
            }
            else {
                $this->_msg = 'File has been uploaded';
            }
        }
    }

?>