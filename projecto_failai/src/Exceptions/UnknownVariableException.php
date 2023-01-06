<?php

namespace Appsas\Exceptions;

use Exception;

class UnknownVariableException extends Exception
{
    public function __construct($arr)
    {
        $errorStr = '';
        foreach ($arr as $key => $value) {
            $errorStr = $errorStr. '<li>{{'.$key.'}} nerastas template'.'</li>';

        }
        parent::__construct( '<ul>'.$errorStr.'</ul>');
    }
}
