<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <link rel="stylesheet" href="./css/index.css">
    <title>Главная</title>
</head>
<?php
use Src\TestRepository;

require_once './vendor/autoload.php';

auth();
$testRep = new TestRepository();
$tests = $testRep->list($_SESSION['id']);
?>
<body>
<header class="header">
    <p><?=$_SESSION['email']?></p>
    <div>
        <a href="/test/passed.php">Пройденные</a>
        <a href="/test/create.php">Создать тест</a>
        <a href="/action/auth/exit.php">Выход</a>
    </div>
</header>
<div class="container">
    <div class="content-home">
        <div class="nav">
            <h3>Список созданных тестов</h3>
        </div>
        <div class="list-test">
            <?php foreach ($tests as $test):?>
                <div class="test">
                    <p><?= $test['title'] ?></p>
                    <div>
                        <a href="/test/update.php?test_id=<?= $test['id'] ?>">
                            <img class="icon_change" src="svg/pencil.svg" alt="update">
                        </a>
                        <a href="/action/test/delete.php?test_id=<?= $test['id'] ?>">
                            <img class="icon_delete" src="svg/recycle_bin.svg" alt="delete">
                        </a>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
    </div>
</div>
</body>
</html>