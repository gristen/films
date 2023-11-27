<?php

namespace App\Kernel\Database;

use App\Kernel\Config\ConfigInterface;

class Database implements DatabaseInterface
{
    private \PDO $pdo;

    public function __construct(
        private ConfigInterface $config,

    ) {
        $this->conntect();
    }

    private function conntect()
    {
        $driver = $this->config->get('database.driver');
        $host = $this->config->get('database.host');
        $port = $this->config->get('database.port');
        $database = $this->config->get('database.database');
        $username = $this->config->get('database.username');
        $password = $this->config->get('database.password');
        $charset = $this->config->get('database.charset');
        try {
            $this->pdo = new \PDO("$driver:host=$host;port=$port;dbname=$database;charset=$charset", $username, $password);
        } catch (\PDOException $exception) {
            exit('Ошибка при подключении к БД '.$exception->getMessage());
        }

    }

    public function insert(string $table, array $data): int|false
    {
        $fields = array_keys($data);
        $columns = implode(', ', $fields);
        $binds = implode(', ', array_map(fn ($fields) => ":$fields", $fields));

        $sql = "INSERT INTO $table ($columns) VALUES ($binds)";

        $stmt = $this->pdo->prepare($sql);

        try {
            $stmt->execute($data);
        } catch (\PDOException $e) {
            return false;
        }

        return (int) $this->pdo->lastInsertId();
    }
}
