<?php

namespace Src;

require_once 'dotenv.php';

use PDO;

class OptionRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $db = $_ENV["DB_NAME"];
        $host = $_ENV["DB_HOST"];

        $dsn = "mysql:host=$host;dbname=$db";
        $this->pdo = new PDO($dsn, $_ENV["DB_USER"], $_ENV["DB_PASS"]);
    }

    public function create(int $questionId, string $title, bool $isValid): bool
    {
        $query = $this->pdo->prepare("INSERT INTO `options` (`title`, `is_valid`, `question_id`) VALUES (:title, :is_valid, :question_id)");
        return $query->execute([
            "title" => $title,
            "question_id" => $questionId,
            "is_valid" => $isValid
        ]);
    }

    public function countOptionsIsValid(int $testId)
    {
        $query = $this->pdo->prepare(
            "SELECT COUNT(*) FROM `questions`
            INNER JOIN `options` ON options.question_id = questions.id
            AND (SELECT COUNT(*) FROM options WHERE options.question_id = questions.id) > 1
            AND (SELECT COUNT(*) FROM options WHERE options.question_id = questions.id AND options.is_valid = 1) > 0
            WHERE test_id = :test_id AND options.is_valid = 1"
        );
        $query->execute([
            'test_id' => $testId
        ]);
        return $query->fetch();
    }

    public function countOptionsIsInvalid(int $testId)
    {
        $query = $this->pdo->prepare(
            "SELECT COUNT(*) FROM `questions`
            INNER JOIN `options` ON options.question_id = questions.id
            AND (SELECT COUNT(*) FROM options WHERE options.question_id = questions.id) > 1
            AND (SELECT COUNT(*) FROM options WHERE options.question_id = questions.id AND options.is_valid = 1) > 0
            WHERE test_id = :test_id AND options.is_valid = 0"
        );
        $query->execute([
            'test_id' => $testId
        ]);
        return $query->fetch();
    }

    public function list(int $questionId): bool|array
    {
        $query = $this->pdo->prepare("SELECT * FROM `options` WHERE `question_id` = :question_id");
        $query->execute([
            'question_id' => $questionId
        ]);
        return $query->fetchAll();
    }

    public function delete(int $id): bool
    {
        $query = $this->pdo->prepare("DELETE FROM `options` WHERE `id` = :id");
        return $query->execute([
            "id" => $id
        ]);
    }

    public function findById(int $id)
    {
        $query = $this->pdo->prepare("SELECT * FROM `options` WHERE `id` = :id");
        $query->execute([
            'id' => $id
        ]);
        return $query->fetch();
    }

    public function update(int $id, string $title, bool $isValid): bool
    {
        $query = $this->pdo->prepare(
            "UPDATE `options` SET `title` = :title, `is_valid` = :is_valid WHERE `id` = :id"
        );
        return $query->execute([
            'id' => $id,
            'title' => $title,
            'is_valid' => $isValid
        ]);
    }
}