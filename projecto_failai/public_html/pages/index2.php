<?php

session_start();
//require __DIR__ . '/../../vendor/autoload.php';
require_once "./IrmisFramework.php";

require_once "./Home/Home.php";
require_once "./AboutUs/AboutUs.php";
require_once "./LoginPage/LoginPage.php";

$pageName = 'AboutUs';
$pageName = $_GET['page'];

$page = new $pageName();
$page->init();