<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <link rel="stylesheet" href="../css/index.css">
    <title>Главная</title>
</head>
<?php
require_once '../vendor/autoload.php';
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
    <div class="content-home">
        <form class="form-create" action="/action/test/create.php" method="post">
            <h3>Создания теста</h3>
            <label>
                <input name="title" type="text" placeholder="Название теста">
            </label>
            <label>
                <textarea name="description" placeholder="Описание"></textarea>
            </label>
            <button type="submit">Создать</button>
        </form>
    </div>
</div>
</body>
</html>