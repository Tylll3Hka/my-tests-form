<?php

namespace Src;

require_once 'dotenv.php';

use PDO;

class QuestionRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $db = $_ENV["DB_NAME"];
        $host = $_ENV["DB_HOST"];

        $dsn = "mysql:host=$host;dbname=$db";
        $this->pdo = new PDO($dsn, $_ENV["DB_USER"], $_ENV["DB_PASS"]);
    }

    public function create(int $testId, string $title, string $description): bool
    {
        $query = $this->pdo->prepare("INSERT INTO `questions` (`title`, `description`, `test_id`) VALUES (:title, :description, :test_id)");
        return $query->execute([
            "title" => $title,
            "test_id" => $testId,
            "description" => $description
        ]);
    }

    public function list(int $testId): bool|array
    {
        $query = $this->pdo->prepare("SELECT * FROM `questions` WHERE `test_id` = :test_id");
        $query->execute([
            'test_id' => $testId
        ]);
        return $query->fetchAll();
    }

    public function delete(int $id): bool
    {
        $query = $this->pdo->prepare("DELETE FROM `questions` WHERE `id` = :id");
        return $query->execute([
            "id" => $id
        ]);
    }

    public function findById(int $id)
    {
        $query = $this->pdo->prepare("SELECT * FROM `questions` WHERE `id` = :id");
        $query->execute([
            'id' => $id
        ]);
        return $query->fetch();
    }

    public function listQuestions(int $testId): array
    {
        $query = $this->pdo->prepare(
            "SELECT DISTINCT questions.id, questions.title, questions.description FROM `questions`
            INNER JOIN `options` ON options.question_id = questions.id
            AND (SELECT COUNT(*) FROM options WHERE options.question_id = questions.id) > 1
            AND (SELECT COUNT(*) FROM options WHERE options.question_id = questions.id AND options.is_valid = 1) > 0
            WHERE test_id = :test_id"
        );
        $query->execute([
            'test_id' => $testId
        ]);
        return $query->fetchAll();
    }

    public function update(int $id, string $title, string $description): bool
    {
        $query = $this->pdo->prepare(
            "UPDATE `questions` SET `title` = :title, `description` = :description WHERE `id` = :id"
        );
        return $query->execute([
            'id' => $id,
            'title' => $title,
            'description' => $description
        ]);
    }
}