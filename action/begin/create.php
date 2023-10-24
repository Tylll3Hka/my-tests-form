<?php

use Src\BeginTestRepository;

require_once '../../vendor/autoload.php';

$bgTest = new BeginTestRepository();

$bgTest->create($_SESSION['id'], $_POST['test_id']);

header("Location: /test/begin.php?id=".$_POST['test_id']);