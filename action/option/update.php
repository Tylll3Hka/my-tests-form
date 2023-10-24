<?php

use Src\OptionRepository;

require_once '../../vendor/autoload.php';

if (trim($_POST['title']) == "") {
    notification("Вы не ввели ответ");
    header("Location: /test/option/update.php?option_id=".$_POST['option_id']);
    exit();
}

$optionsRep = new OptionRepository();

$isCorrect = true;

if (!isset($_POST['is_correct'])) $isCorrect = false;

$optionsRep->update($_POST['option_id'], $_POST['title'], $isCorrect);

header("Location: /test/question/update.php?question_id=".$_POST['question_id']."&test_id=".$_POST['test_id']);