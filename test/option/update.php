<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <link rel="stylesheet" href="../../css/index.css">
    <title>Главная</title>
</head>
<?php

use Src\OptionRepository;

require_once '../../vendor/autoload.php';
auth();
$optionRep = new OptionRepository();
$option = $optionRep->findById($_GET['option_id']);
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
        <form class="form-create" action="/action/option/update.php" method="post">
            <input type="hidden" name="option_id" value="<?=$option['id']?>">
            <input type="hidden" name="question_id" value="<?=$_GET['question_id']?>">
            <input type="hidden" name="test_id" value="<?=$_GET['test_id']?>">
            <h3>Редактирование ответа</h3>
            <label>
                <input name="title" type="text" value="<?= $option['title'] ?>" placeholder="Ответ">
            </label>
            <div class="checkbox-correct">
                <p>Это верный ответ?</p>
                <label>
                    <input class="custom-checkbox" name="is_correct" type="checkbox" <?php if ($option['is_valid'] == 1) echo 'checked'?>
                </label>
            </div>
            <button type="submit">Сохранить</button>
        </form>
    </div>
</div>
</body>
</html>