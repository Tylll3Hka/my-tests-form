<?php

namespace Src;

require_once 'dotenv.php';

use PDO;

class SelectedRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $db = $_ENV["DB_NAME"];
        $host = $_ENV["DB_HOST"];

        $dsn = "mysql:host=$host;dbname=$db";
        $this->pdo = new PDO($dsn, $_ENV["DB_USER"], $_ENV["DB_PASS"]);
    }

    public function createBatch(int $bgtId, array $optionIds): bool
    {
        $query = "INSERT INTO `selected` (`bgt_id`, `option_id`) VALUES ";
        $values = [];

        foreach ($optionIds as $optionId) {
            $query .= "(?, ?),";
            $values[] = $bgtId;
            $values[] = $optionId;
        }
        $query = rtrim($query, ',');
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute($values);
    }
}