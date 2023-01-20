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

    public function new()
    {
        return View::one('persons/create', []);
    }

    public function postNew()
    {
        $vardas = $_POST['vardas'] ?? '';
        $pavarde = $_POST['pavarde'] ?? '';
        $kodas = (int)$_POST['kodas'] ?? '';

        Validator::required($vardas);
        Validator::required($pavarde);
        Validator::required($kodas);
        Validator::numeric($kodas);
        Validator::asmensKodas($kodas);


        $this->query(
            "INSERT INTO `persons` (`first_name`, `last_name`, `code`)
                    VALUES (:vardas, :pavarde, :kodas)",
            [
                'vardas' => $vardas,
                'pavarde' => $pavarde,
                'kodas' => $kodas,
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
            'id' => $_GET['id']
        ];

        $this->query('UPDATE persons SET first_name = :first_name, last_name = :last_name WHERE id = :id', $data);

        $this->redirect('/persons');

//        return $this->edit();
    }

    public function update()
    {
        $id = (int)$_GET['id'] ?? null;

        $vardas = $_POST['vardas'] ?? '';
        $pavarde = $_POST['pavarde'] ?? '';
        $email = $_POST['email'] ?? '';
        $kodas = (int)$_POST['kodas'] ?? '';
        $tel = $_POST['tel'] ?? '';
        $addr_id = $_POST['addr_id'] ?? '';

        $conf = new Configs();
        $db = new Database($conf);

        $db->query(
            "UPDATE  `persons` 
            SET (`$vardas`, `$pavarde`, `$email`, '$kodas', '$tel', '$addr_id') WHERE id ='$id'");


    }
}