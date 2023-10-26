<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <link rel="stylesheet" href="./css/index.css">
    <title>Главная</title>
</head>
<?php

use Src\BeginTestRepository;
use Src\OptionRepository;
use Src\QuestionRepository;
use Src\SelectedRepository;
use Src\TestRepository;
use Src\UserRepository;
require_once './vendor/autoload.php';

auth();

$userRep = new UserRepository();
$testRep = new TestRepository();
$bgtRep = new BeginTestRepository();

$test = $testRep->find($_GET['id']);
$user = $userRep->findById($test['user_id']);
$bgt = $bgtRep->findById($test['id'], $_SESSION['id'])

?>
<body>
<header class="header">
    <p><?=$_SESSION['email']?></p>
    <div>
        <a href="/">Главная</a>
        <a href="/action/auth/exit.php">Выход</a>
    </div>
</header>
<div class="container">
    <div class="content-home">
        <?php if ($bgt and $bgt['finished_at'] == null): ?>
            <div class="description">
                <h3>Теста</h3>
                <p>Название: <?= $test['title'] ?></p>
                <p>Описание: <?= $test['description'] ?></p>
                <p>Автор: <?= $user['email'] ?></p>
                <a href="/test/begin.php?id=<?=$test['id']?>">Продолжить</a>
            </div>
        <?php elseif($bgt):?>
            <?php
                $optionsRep = new OptionRepository();
                $selectedRep = new SelectedRepository();

                $countValidOptions = $optionsRep->countOptionsIsValid($bgt['test_id'])[0];
                $countInvalidOptions = $optionsRep->countOptionsIsInvalid($bgt['test_id'])[0];

                $countSelectValid = $selectedRep->countSelectedIsValid($bgt['id'])[0];
                $countSelectInvalid = $selectedRep->countSelectedIsInvalid($bgt['id'])[0];

                $percent = ($countSelectValid/$countValidOptions - $countSelectInvalid/$countInvalidOptions)*100;
                $percentTotal = 0;
                if ($percent > 0) $percentTotal = $percent;
            ?>
            <div class="description">
                <input type="hidden" name="user_id" value="<?=$_SESSION['id']?>">
                <h3>Результат теста</h3>
                <p>Название: <?= $test['title'] ?></p>
                <p>Описание: <?= $test['description'] ?></p>
                <p>Автор: <?= $user['email'] ?></p>
                <p>Процент: <?=$percentTotal?>%</p>
            </div>
        <?php else:?>
            <form class="description" method="post" action="/action/begin/create.php">
                <input type="hidden" name="test_id" value="<?=$_GET['id']?>">
                <h3>Тест</h3>
                <p>Название: <?= $test['title'] ?></p>
                <p>Описание: <?= $test['description'] ?></p>
                <p>Автор: <?= $user['email'] ?></p>
                <button type="submit">Пройти тест</button>
            </form>
        <?php endif;?>
    </div>
</div>
</body>
</html>