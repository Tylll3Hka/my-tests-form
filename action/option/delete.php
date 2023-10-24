<?php

use Src\OptionRepository;

require_once '../../vendor/autoload.php';

$optionsRep = new OptionRepository();

$optionsRep->delete($_GET['id']);

header("Location: /test/question/update.php?id=".$_GET['question_id']);