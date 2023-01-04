<?php

require __DIR__ . '/../../vendor/autoload.php';

$pageName = 'AboutUs';
$pageName = $_GET['page'];

$page = new $pageName();
$page->init();