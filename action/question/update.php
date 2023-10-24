<?php

use Src\QuestionRepository;

require_once '../../vendor/autoload.php';

$id = $_POST['question_id'];

$questionRep = new QuestionRepository();

if (trim($_POST['title']) == "") {
    notification("Название вопроса не может быть пустым");
    header("Location: /test/question/update.php?id=".$id);
    exit();
}

$questionRep->update($id, $_POST['title'], $_POST['description']);

header("Location: /test/update.php?test_id=".$_POST['test_id']);