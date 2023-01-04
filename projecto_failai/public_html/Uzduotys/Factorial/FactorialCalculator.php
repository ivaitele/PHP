<?php

namespace Factorial;

use Factorial\Traits\PositiveNumberChecker;

include_once "PositiveNumberChecker.php";

interface Calculator {
    public function calculate($number);
    public function validate($number);
}

class FactorialCalculator implements Calculator {
    use PositiveNumberChecker;

    /**
     * @throws Exception
     */
    public function calculate($number) {
        $this->validate($number);

        if ($number <= 1) {
            return 1;
        }

        return $number * $this->calculate($number - 1);

    }

    /**
     * @throws Exception
     */
    public function validate($number) : void {
        $isPositive = $this->check($number);
        $isInteger = is_int($number);

        if (!$isPositive) {
            throw new Exception('Error, number is negative');
        }

        if (!$isInteger) {
            throw new Exception('Error, number is not integer');
        }

    }

}

