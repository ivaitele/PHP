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

    //------------------------------------------------------------
    public function __construct($templatePath, $arr){
        return $this->render($templatePath, $arr);
    }

    //------------------------------------------------------------
    public function render($templatePath, $arr) {
        $nesamone = new FS('../src/html/'.templatePath.'.html');
        $content = $nesamone->getFailoTurinys();

        foreach (arr as $key => $value) {
            $content = str_replace('{{' . $key . '}}', $value, $content);
        }

        return $content;
    }
}