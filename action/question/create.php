<?php

use Src\QuestionRepository;

require_once '../../vendor/autoload.php';

if (trim($_POST['title']) == "") {
    notification('Вы не ввели название вопроса');
    header("Location: /test/question/create.php?test_id=".$_GET['test_id']);
    exit();
}

$questionRep = new QuestionRepository();

$questionRep->create($_POST['test_id'], $_POST['title'], $_POST['description']);

header("Location: /test/update.php?test_id=".$_POST['test_id']);