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
                <p>Название: <?= $test['title'] ?></p>
                <p>Описание: <?= $test['description'] ?></p>
                <p>Автор: <?= $user['email'] ?></p>
                <a href="/test/begin.php?id=<?=$test['id']?>">Продолжить</a>
            </div>
        <?php elseif($bgt):?>
            <form class="description" method="post" action="/action/begin/find.php">
                <input type="hidden" name="user_id" value="<?=$_SESSION['id']?>">
                <p>Название: <?= $test['title'] ?></p>
                <p>Описание: <?= $test['description'] ?></p>
                <p>Автор: <?= $user['email'] ?></p>
                <button type="submit">Проверить ответы</button>
            </form>
        <?php else:?>
            <form class="description" method="post" action="/action/begin/create.php">
                <input type="hidden" name="test_id" value="<?=$_GET['id']?>">
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