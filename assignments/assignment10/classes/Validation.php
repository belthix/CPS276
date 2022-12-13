<?php

    class Validation {

        private $errorFlag = false;

        private static $regexMap = [
            'name' => '/^[a-z-\' ]{1,50}$/i',
            'address' => '/^\d{1,8} [a-z ]+$/i',
            'city' => '/^[a-z]+$/i',
            'phone' => '/^\d{3}.\d{3}.\d{4}$/',
            'email' => '/^[a-z\d._-]{2,}[@][a-z\d._-]{2,}[.][a-z\d._-]{2,}$/i',
            'dob' => '/^\d{2}\/\d{2}\/\d{4}$/',
            'password' => '/^\S+$/'
        ];

        public function checkFormat($value, $regexKey) {
            if (!isset(Validation::$regexMap[$regexKey])) return;

            $this->errorFlag = !preg_match(Validation::$regexMap[$regexKey], $value);

            return ($this->errorFlag) ? 'error' : '';
        }

        public function checkErrors() {
            return $this->errorFlag;
        }

    }

?>