<?php

use Src\TestRepository;

require_once '../../vendor/autoload.php';
$title = $_POST['title'];

if (trim($title) == '') {
    notification("Название теста не может быть пустым");
    header("Location: /test/update.php?test_id=".$_GET['test_id']);
    exit();
}

$testRep = new TestRepository();

$testRep->update($_POST['test_id'], $_SESSION['id'], $title, $_POST['description']);

header("Location: /");