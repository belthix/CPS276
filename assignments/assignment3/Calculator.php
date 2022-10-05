<?php 

    class Calculator {
        public function __construct($operator = null, $num1 = null, $num2 = null)
        {
            if ($operator && $num1 && $num2) $this->calc($operator, $num1, $num2);
        }

        public function calc($operator = null, $num1 = null, $num2 = null) {
            if (!$this->are_int([$num1, $num2]) || !is_string($operator)) {
                echo nl2br("Error: You must enter a string and two numbers\n");
                return null;
            }

            $result = $num1;
            $operation = "error";
            switch ($operator) {
                case "+":
                    $result += $num2;
                    $operation = "sum";
                    break;
                case "-":
                    $result -= $num2;
                    $operation = "difference";
                    break;
                case "*":
                    $result *= $num2;
                    $operation = "product";
                    break;
                case "/":
                    if ($num2 == 0) {
                        echo nl2br("Error: Cannot divide by zero\n");
                        return null;
                    }

                    $result /= $num2;
                    $operation = "quotient";
                    break;
                default:
                    echo nl2br("Error: Invalid operator\n");
                    return null;
            }

            echo nl2br("The {$operation} of the numbers is {$result}\n");
        } 

        private function are_int($list) {
            foreach ($list as $val)
                if (!is_int($val)) return false;
            return true;
        }
    }

?>