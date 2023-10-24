<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/auth.css">
    <title>Вход</title>
</head>
<?php
require_once '../boot.php';
?>
<body>
    <div class="content">
        <form class="auth-form" method="post" action="/action/auth/login.php">
            <h2>Вход</h2>
            <?php notification(); ?>
            <label>
                <input type="email" name="email" placeholder="Почта">
            </label>
            <label>
                <input type="password" name="password" placeholder="Пароль">
            </label>
            <button type="submit">Войти</button>
            <p>У вас нету аккаунта? <a href="/auth/signup.php">Регистрация</a></p>
        </form>
    </div>
</body>
</html>