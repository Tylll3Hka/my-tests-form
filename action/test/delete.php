<?php

use Src\TestRepository;

require_once "../../vendor/autoload.php";

auth();

$testRep = new TestRepository();

$testRep->delete($_GET['test_id']);

header("Location: /");