<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/update_test.css">
    <title>Главная</title>
</head>
<?php

use Src\QuestionRepository;
use Src\TestRepository;

require_once '../vendor/autoload.php';
auth();
$testRep = new TestRepository();
$questionRep = new QuestionRepository();
$test = $testRep->findById($_GET['test_id'], $_SESSION['id']);
$questions = $questionRep->list($test['id']);
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
        <div class="nav">
            <form method="post" action="/action/test/update.php" class="form-update-test">
                <input type="hidden" name="test_id" value="<?= $_GET['test_id'] ?>">
                <h3>Редактирование теста</h3>
                <label>
                    <input value="<?= $test['title'] ?>" name="title" placeholder="Название">
                </label>
                <label>
                    <textarea name="description" placeholder="Описание"><?= $test['description'] ?></textarea>
                </label>
                <div>
                    <button type="submit">Сохранить</button>
                    <a href="/test/question/create.php?test_id=<?= $_GET['test_id'] ?>">Добавить вопрос</a>
                </div>
            </form>
        </div>
        <div class="question-test">
            <div class="header-question">
                <h3>Список вопросов</h3>
            </div>
            <?php foreach ($questions as $question): ?>
                <div class="test">
                    <p><?= $question['title'] ?></p>
                    <div>
                        <a href="/test/question/update.php?question_id=<?=$question['id']?>&test_id=<?=$_GET['test_id']?>">
                            <img class="icon_change" src="../svg/pencil.svg" alt="update">
                        </a>
                        <a href="/action/question/delete.php?question_id=<?=$question['id']?>&test_id=<?=$test['id']?>">
                            <img class="icon_delete" src="../svg/recycle_bin.svg" alt="delete">
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
</body>
</html>