<?php

use Src\TestRepository;

require_once '../../vendor/autoload.php';

$title = $_POST['title'];
$description = $_POST['description'];

if (trim($title) == "") {
    notification("Вы не ввели названия теста.");
    header("Location: /test/create.php");
    exit();
}

$testRep = new TestRepository();

$testRep->create($title, $description, $_SESSION['id']);
header("Location: /");