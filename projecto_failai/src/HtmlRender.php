<?php

namespace Appsas;

use Appsas\Exceptions\UnknownVariableException;
use Appsas\FS;

class HtmlRender extends AbstractRender
{
    protected function getContent(): string
    {
        $failoSistema = new FS('../src/html/Dashboard.html');
        $failoTurinys = $failoSistema->getFailoTurinys();

        $duomMas = [
            'username' => $_SESSION['username'],
            'userType' => 'Admin',
            'loggedInDate' => date('Y-m-d H:i:s'),
            'klaida' => 'Turi ismest klaida'
        ];

        $paramsNotFound = Array();

        foreach ($duomMas as $key => $value) {
            $found = strpos($failoTurinys,'{{' . $key . '}}');

            if ($found === false) {
                $paramsNotFound[$key] = $value;
            }

            $failoTurinys = str_replace('{{' . $key . '}}', $value, $failoTurinys);
        }

//        $this->errorArr = $paramsNotFound;
       if (count($paramsNotFound)) {
            throw new UnknownVariableException($paramsNotFound);
        }

        return $failoTurinys;
    }
}