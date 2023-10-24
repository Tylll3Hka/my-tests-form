<?php
require_once '../../vendor/autoload.php';

use Src\UserRepository;

$password = $_POST["password"];
$email = $_POST["email"];

if (trim($password) == "" and trim($email) == "")
{
    notification("Вы ввели не все данные");
    header("Location: /auth/signup.php");
    exit();
}

$userRep = new UserRepository();
$user = $userRep->findByEmail($_POST["email"]);

if ($user)
{
    notification("Пользователь с таким email уже существует");
    header("Location: /auth/login.php");
    exit();
}
$userRep->create($email, $password);

header("Location: /");