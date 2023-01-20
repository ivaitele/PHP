<?php

namespace Appsas;

use Appsas\Exceptions\UnknownVariableException;
use Appsas\FS;

class View {
    //------------------------------------------------------------
    public function __construct($templatePath, $arr){
        return $this->render($templatePath, $arr);
    }

    //------------------------------------------------------------
    public static function one($templatePath, $arr) {
        $nesamone = new FS('../src/html/'.$templatePath.'.html');
        $content = $nesamone->getFailoTurinys();

        foreach ($arr as $key => $value) {
            $content = str_replace('{{' . $key . '}}', $value, $content);
        }

        return $content;
    }
    //------------------------------------------------------------
    public static function many($templatePath, $arr) {
        $nesamone = new FS('../src/html/'.$templatePath.'.html');
        $content = $nesamone->getFailoTurinys();

        $result = '';

        foreach($arr as $key => $item) {
            $row = $content;
            foreach ($item as $key => $value) {
                $row = str_replace('{{' . $key . '}}', $value, $row);
            }

            $result .= $row;
        }

        return $result;
    }
}