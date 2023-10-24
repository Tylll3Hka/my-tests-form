<!DOCTYPE html>
<html lang="ru" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <link rel="stylesheet" href="../../css/index.css">
    <link rel="stylesheet" href="../../css/update_test.css">
    <title>Главная</title>
</head>
<?php
require_once '../../vendor/autoload.php';
auth();

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
    <form method="post" action="/action/question/create.php" class="content-home">
        <input type="hidden" name="test_id" value="<?=$_GET['test_id']?>">
        <div class="nav">
            <div class="form-update-test">
                <h3>Создания вопроса</h3>
                <?php notification(); ?>
                <label>
                    <input type="text" name="title" placeholder="Вопрос">
                </label>
                <label>
                    <textarea name="description" placeholder="Описание"></textarea>
                </label>
                <div>
                    <button type="submit">Добавить</button>
                    <a href="/test/update.php?test_id=<?= $_GET['test_id'] ?>">Отмена</a>
                </div>
            </div>
        </div>
    </form>
</div>
</body>
</html>