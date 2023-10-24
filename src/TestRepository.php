<?php

namespace Src;

require_once "dotenv.php";

use PDO;

class TestRepository
{
    private PDO $pdo;

    public function __construct()
    {

        $db = $_ENV["DB_NAME"];
        $host = $_ENV["DB_HOST"];

        $dsn = "mysql:host=$host;dbname=$db";
        $this->pdo = new PDO($dsn, $_ENV["DB_USER"], $_ENV["DB_PASS"]);
    }

    public function create(string $title, string $description, int $userId): void
    {
        $query = $this->pdo->prepare("INSERT INTO `tests` (`title`, `description`, `user_id`) VALUES (:title, :description, :user_id)");
        $query->execute([
            "title" => $title,
            "user_id" => $userId,
            "description" => $description
        ]);
    }

    public function list(int $userId): bool|array
    {
        $query = $this->pdo->prepare("SELECT * FROM `tests` WHERE `user_id` = :user_id");
        $query->execute([
            'user_id' => $userId
        ]);
        return $query->fetchAll();
    }

    public function delete(int $id): bool
    {
        $query = $this->pdo->prepare("DELETE FROM `tests` WHERE `id` = :id");
        return $query->execute([
            "id" => $id
        ]);
    }

    public function findById(int $id, int $userId)
    {
        $query = $this->pdo->prepare("SELECT * FROM `tests` WHERE `id` = :id AND `user_id` = :user_id");
        $query->execute([
            'id' => $id,
            'user_id' => $userId
        ]);
        return $query->fetch();
    }

    public function find(int $id)
    {
        $query = $this->pdo->prepare("SELECT * FROM `tests` WHERE `id` = :id");
        $query->execute([
            'id' => $id
        ]);
        return $query->fetch();
    }

    public function update(int $id, int $userId, string $title, string $description): bool
    {
        $query = $this->pdo->prepare(
            "UPDATE `tests` SET `title` = :title, `description` = :description WHERE `id` = :id AND `user_id` = :user_id"
        );
        return $query->execute([
            'id' => $id,
            'user_id' => $userId,
            'title' => $title,
            'description' => $description
        ]);
    }
}