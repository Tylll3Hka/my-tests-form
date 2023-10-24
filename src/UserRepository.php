<?php

namespace Src;

require_once 'dotenv.php';

use Dotenv\Dotenv;
use PDO;

class UserRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $db = $_ENV["DB_NAME"];
        $host = $_ENV["DB_HOST"];

        $dsn = "mysql:host=$host;dbname=$db";
        $this->pdo = new PDO($dsn, $_ENV["DB_USER"], $_ENV["DB_PASS"]);
    }

    public function create(string $email, string $password): bool
    {
        $hash_pass = hash("sha512", $password);
        $query = $this->pdo->prepare("INSERT INTO `users` (`email`, `password`) VALUES (:email, :password)");
        return $query->execute([
            'email' => $email,
            'password' => $hash_pass
        ]);
    }

    public function findByEmail(string $email)
    {
        $query = $this->pdo->prepare("SELECT * FROM `users` WHERE `email` = :email");
        $query->execute([
            'email' => $email
        ]);
        return $query->fetch();
    }

    public function findById(int $id)
    {
        $query = $this->pdo->prepare("SELECT * FROM `users` WHERE `id` = :id");
        $query->execute([
            'id' => $id
        ]);
        return $query->fetch();
    }
}