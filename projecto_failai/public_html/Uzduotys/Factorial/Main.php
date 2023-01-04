<?php

namespace Factorial;

use Exception;
use Factorial\FactorialCalculator;

include_once "FactorialCalculator.php";
class Main
{

    public static function run() {

        try {
            $factorialCalculator = new FactorialCalculator();
            return $factorialCalculator->calculate(4.2);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

}