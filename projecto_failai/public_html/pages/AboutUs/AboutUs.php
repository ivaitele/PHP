<?php

namespace IrmisPage;
use IrmisPage\IrmisFramework;

class AboutUs extends IrmisFramework {
    public $template = __DIR__.'/AboutUs';

    function getUsersTable() {
        $users[] = ["firstName" => "Irmis", "lastName"=>"Vaitele", "age" => 23];
        $users[] = ["firstName" => "Olesis", "lastName"=>"Vaitele", "age" => 33];


        $tableRow = $this->viewMany('tpls/table.row', $users);
        return $this->view('tpls/table', ["tableRow" => $tableRow]);
    }
    public function render() {
//        $users = $this.sql('getUserByEmail', ["email" => "aaa@bbb.com"]);


        return [
            "test" => $this->getUsersTable(),
            "header"=> "About us",
            "text" => "Loream la la la"
        ];
    }
}