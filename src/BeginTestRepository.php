<?php

namespace Src;

require_once 'dotenv.php';


use PDO;

class BeginTestRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $db = $_ENV["DB_NAME"];
        $host = $_ENV["DB_HOST"];

        $dsn = "mysql:host=$host;dbname=$db";
        $this->pdo = new PDO($dsn, $_ENV["DB_USER"], $_ENV["DB_PASS"]);
    }

    public function create(int $userId, int $testId): bool
    {
        $query = $this->pdo->prepare("INSERT INTO `begin_test` (`test_id`, `user_id`) VALUES (:test_id, :user_id)");
        return $query->execute([
            'test_id' => $testId,
            'user_id' => $userId
        ]);
    }

    public function findById(int $testId, int $userId)
    {
        $query = $this->pdo->prepare("SELECT * FROM `begin_test` WHERE `test_id` = :test_id AND `user_id` = :user_id");
        $query->execute([
            'test_id' => $testId,
            'user_id' => $userId
        ]);
        return $query->fetch();
    }

    public function finish(int $bgtId): bool
    {
        $query = $this->pdo->prepare(
            "UPDATE `begin_test` SET `finished_at` = CURRENT_TIMESTAMP WHERE `id` = :id"
        );
        return $query->execute([
            'id' => $bgtId
        ]);
    }

    public function list(int $userId): bool|array
    {
        $query = $this->pdo->prepare("SELECT * FROM `begin_test` WHERE `user_id` = :user_id");
        $query->execute([
            'user_id' => $userId
        ]);
        return $query->fetchAll();
    }
}