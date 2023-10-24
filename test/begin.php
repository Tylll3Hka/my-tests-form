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
use Src\OptionRepository;
use Src\QuestionRepository;
use Src\TestRepository;
use Src\UserRepository;

require_once '../vendor/autoload.php';

auth();

$userRep = new UserRepository();
$testRep = new TestRepository();
$questionRep = new QuestionRepository();
$optionRep = new OptionRepository();
$bgtRep = new BeginTestRepository();

$test = $testRep->find($_GET['id']);
$user = $userRep->findById($test['user_id']);
$questions = $questionRep->listQuestions($test['id']);
$bgt = $bgtRep->findById($test['id'], $_SESSION['id']);
?>
<body>
<header class="header">
    <p>
        <?= $_SESSION['email'] ?>
    </p>
    <div>
        <a href="/">Главная</a>
        <a href="/action/auth/exit.php">Выход</a>
    </div>
</header>
<div class="container">
    <div class="info-test">
        <h3>Тест: <?=$test['title']?></h3>
    </div>
    <form class="question-list" method="post" action="/action/begin/update.php">
        <input type="hidden" name="test_id" value="<?= $test['id'] ?>">
        <input type="hidden" name="bgt_id" value="<?= $bgt['id'] ?>">
        <ul class="list-questions">
            <?php foreach ($questions as $question): ?>
                <li>
                    <?= $question['title'] ?>
                    <p><?= $question['description'] ?></p>
                    <div class="list-options">
                        <?php foreach ($optionRep->list($question['id']) as $option): ?>
                        <div class="option">
                            <label>
                                <input type="checkbox" name="check[]" value="<?= $option['id'] ?>">
                            </label>
                            <p>
                                <?= $option['title'] ?>
                            </p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php notification();?>
        <div class="actions-btn">
            <button value="finish" name="action" type="submit">Закончить</button>
            <button value="save" name="action" type="submit">Сохранить</button>
        </div>
    </form>
</div>
</body>
</html>