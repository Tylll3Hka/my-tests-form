<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <link rel="stylesheet" href="../css/index.css">
    <title>Главная</title>
</head>
<?php

use Src\BeginTestRepository;
use Src\TestRepository;

require_once '../vendor/autoload.php';

auth();
$bgtRep = new BeginTestRepository();
$testRep = new TestRepository();
$bgtList = $bgtRep->list($_SESSION['id']);
?>
<body>
<header class="header">
    <p><?=$_SESSION['email']?></p>
    <div>
        <a href="/">Главная</a>
        <a href="/test/create.php">Создать тест</a>
        <a href="/action/auth/exit.php">Выход</a>
    </div>
</header>
<div class="container">
    <div class="content-home">
        <div class="nav">
            <h3>Список пройденых вами тестов</h3>
        </div>
        <div class="list-test">
            <?php foreach ($bgtList as $bgt):?>
                <div class="test">
                    <p><?= $testRep->find($bgt['test_id'])['title'] ?></p>
                    <div>
                        <?php if ($bgt['finished_at'] == null):?>
                            <a href="/test/begin.php?id=<?= $bgt['test_id'] ?>" >
                                <img class="icon_change" src="../svg/pencil.svg" alt="update">
                            </a>
                        <?php else:?>
                            <a href="/test.php?id=<?= $bgt['test_id'] ?>">
                                <img class="icon_change" src="../svg/exclamation_mark.svg" alt="check">
                            </a>
                        <?php endif;?>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
    </div>
</div>
</body>
</html>