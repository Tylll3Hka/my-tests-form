<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <link rel="stylesheet" href="../css/auth.css">
    <link rel="stylesheet" href="../css/index.css">
    <title>Регистрация</title>
</head>
<?php
require_once '../boot.php';
?>
<body>
<div class="content">
    <form class="auth-form" method="post" action="/action/auth/register.php">
        <h2>Регистрация</h2>
        <?php notification(); ?>
        <label>
            <input type="email" name="email" placeholder="Введите почту">
        </label>
        <label>
            <input type="password" name="password" placeholder="Придумайте пароль">
        </label>
        <label>
            <input type="password" placeholder="Подтвердите пароль">
        </label>
        <button type="submit">Создать</button>
        <p>У вас уже есть аккаунт? <a href="/auth/login.php">Вход</a></p>
    </form>
</div>
</body>
</html>