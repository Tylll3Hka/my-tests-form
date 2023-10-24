<?php

use Src\UserRepository;

require_once "../../vendor/autoload.php";


$email = $_POST["email"];
$password = $_POST["password"];

if (trim($password) == "" and trim($email) == "")
{
    notification("Вы ввели не все данные");
    header("Location: /auth/login.php");
    exit();
}

$userModel = new UserRepository();
$user = $userModel->findByEmail($email);

if (!$user) {
    notification("Такого пользователя не существует");
    header("Location: /auth/signup.php");
    exit();
}

if (hash('sha512', $password) != $user['password']) {
    notification("Неверный пароль");
    header("Location: /auth/login.php");
    exit();
}

$_SESSION['id'] = $user['id'];
$_SESSION['email'] = $user['email'];

header("Location: /");
