<?php

use Src\BeginTestRepository;
use Src\SelectedRepository;

require_once '../../vendor/autoload.php';

$selected = $_POST['check'];

if ($_POST['action'] != 'finish') {
    notification("Это на этапе разработки");
    header('Location: /test/begin.php?id='.$_POST['test_id']);
    exit();
}

$bgtRep = new BeginTestRepository();
$selectedRep = new SelectedRepository();
$bgt = $bgtRep->findById($_POST['test_id'], $_SESSION['id']);

if ($bgt['finished_at'] != null) {
    header('Location: /test.php?id='.$_POST['test_id']);
    exit();
}

$bgtRep->finish($_POST['bgt_id']);
$selectedRep->createBatch($_POST['bgt_id'], $selected);
