<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <link rel="stylesheet" href="../../css/index.css">
    <link rel="stylesheet" href="../../css/update_test.css">
    <title>Главная</title>
</head>
<?php

use Src\OptionRepository;
use Src\QuestionRepository;

require_once '../../vendor/autoload.php';
auth();

$optionRep = new OptionRepository();
$questionRep = new QuestionRepository();
$question = $questionRep->findById($_GET['question_id']);
$options = $optionRep->list($_GET['question_id']);
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
            <form method="post" action="/action/question/update.php" class="form-update-test">
                <input type="hidden" name="test_id" value="<?=$_GET['test_id']?>">
                <input type="hidden" name="question_id" value="<?=$_GET['question_id']?>">
                <h3>Редактирование вопроса</h3>
                <label>
                    <input value="<?= $question['title'] ?>" name="title" placeholder="Название">
                </label>
                <label>
                    <textarea name="description" placeholder="Описание"><?= $question['description'] ?></textarea>
                </label>
                <div>
                    <button type="submit">Сохранить</button>
                    <a href="/test/option/create.php?question_id=<?=$_GET['question_id']?>&test_id=<?=$_GET['test_id']?>">Добавить ответ</a>
                </div>
            </form>
        </div>
        <div class="question-test">
            <div class="header-question">
                <h3>Список ответов</h3>
            </div>
            <?php foreach ($options as $option): ?>
                <div class="test">
                    <p><?= $option['title'] ?></p>
                    <div>
                        <a href="/test/option/update.php?option_id=<?=$option['id']?>&question_id=<?=$_GET['question_id']?>&test_id=<?=$_GET['test_id']?>">
                            <img class="icon_change" src="../../svg/pencil.svg" alt="update">
                        </a>
                        <a href="/action/option/delete.php?option_id=<?=$option['id']?>&question_id=<?=$_GET['question_id']?>&test_id=<?=$_GET['test_id']?>">
                            <img class="icon_delete" src="../../svg/recycle_bin.svg" alt="delete">
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
</body>
</html>