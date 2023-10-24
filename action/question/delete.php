<?php

use Src\QuestionRepository;

require_once '../../vendor/autoload.php';

$questionRep = new QuestionRepository();

$questionRep->delete($_GET['question_id']);

header("Location: /test/update.php?test_id=".$_GET['test_id']);