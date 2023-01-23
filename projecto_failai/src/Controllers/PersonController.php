<?php

namespace Appsas\Controllers;

use Appsas\Database;
use Appsas\View;
use Appsas\Validator;
use Appsas\Configs;

class PersonController
{
    private function query($str, $arr)
    {
        $conf = new Configs();
        $conn = new Database($conf);

        return $conn->query($str, $arr);
    }

    private function redirect($url)
    {
        header("Location: http://localhost" . $url);

    }

    public function index()
    {
        $limit = $_GET['amount'] ?? 10;
        $asmenys = $this->query('SELECT * FROM persons ORDER BY id DESC LIMIT ' . $limit, []);

        $personsRows = View::many('persons/table_row', $asmenys);
        return View::one('persons/persons', ['personsRows' => $personsRows]);
    }

    public function show()
    {
        $id = (int)$_GET['id'] ?? null;

        $person = $this->query("SELECT * FROM `persons` WHERE `id` = :id", ['id' => $id]);

        return View::one('/persons/show', $person[0]);
    }


    public function new()
    {
        return View::one('persons/create', []);
    }

    public function postNew()
    {
        $first_name = $_POST['first_name'] ?? '';
        $last_name = $_POST['last_name'] ?? '';
        $email = $_POST['email'] ?? '';
        $code = $_POST['code'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $address_id = (int)$_POST['address_id'] ?? '';

        Validator::required($first_name);
        Validator::required($last_name);
        Validator::required($code);
        Validator::numeric($code);
        Validator::asmensKodas($code);


        $this->query(
            "INSERT INTO `persons` (`first_name`, `last_name`, `email`,`code`, `phone`, `address_id`)
                    VALUES (:first_name, :last_name, :email, :code, :phone, :address_id)",
            [
                'first_name' => $first_name,
                'first_name' => $last_name,
                'email' => $email,
                'code' => $code,
                'phone' => $phone,
                'address_id' => $address_id,
            ]
        );
        header("Location: http://localhost/persons");

//        return "New record created successfully";
    }

    public function delete()
    {
        $kuris = (int)$_GET['id'] ?? null;

        Validator::required($kuris);
        Validator::numeric($kuris);
        Validator::min($kuris, 1);

        $conf = new Configs();
        $db = new Database($conf);

        $db->query("DELETE FROM `persons` WHERE `id` = :id", ['id' => $kuris]);

        return "Record deleted successfully";
    }

    public function edit()
    {
        $id = (int)$_GET['id'] ?? null;

        Validator::required($id);
        Validator::numeric($id);
        Validator::min($id, 1);

        $person = $this->query("SELECT * FROM `persons` WHERE `id` = :id", ['id' => $id]);

        return View::one('/persons/edit', $person[0]);
    }

    public function postEdit()
    {
        $data = [
            'first_name' => $_POST['first_name'] ?? '',
            'last_name' => $_POST['last_name'] ?? '',
            'email' => $_POST['email'] ?? '',
            'code' => $_POST['code'] ?? '',
            'phone' => $_POST['phone'] ?? '',
            'address_id' => $_POST['address_id'] ?? '',
            'id' => $_GET['id']
        ];

//        Validator::required($first_name);
//        Validator::required($last_name);
//        Validator::numeric($code);
//        Validator::asmensKodas($code);

        $this->query('UPDATE persons SET first_name = :first_name, last_name = :last_name, 
                   email = :email, code = :code, phone =:phone, address_id =:address_id WHERE id = :id', $data);

        $this->redirect('/persons');

//        return $this->edit();
    }


}