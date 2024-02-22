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

    public function join(string $table, array $joins, array $conditions = [], array $order = [], $limit = -1): array
    {
        $joinClauses = '';
        foreach ($joins as $join) {
            $joinClauses .= " {$join['type']} JOIN {$join['table']} ON {$join['on']}";
        }

        $where = '';
        if (count($conditions) > 0) {
            $where = 'WHERE '.implode(' AND ', array_map(fn ($field) => "$field = :$field", array_keys($conditions)));
        }

        $sql = "SELECT * FROM $table $joinClauses $where";

        if (count($order) > 0) {
            $sql .= ' ORDER BY '.implode(', ', array_map(fn ($field, $direction) => "$field $direction", array_keys($order), $order));
        }

        if ($limit > 0) {
            $sql .= " LIMIT $limit";
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($conditions);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
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

        }

        return (int) $this->pdo->lastInsertId();
    }

    public function first(string $table, array $conditions = []): ?array
    {

        $where = '';
        if (count($conditions) > 0) {
            $where = 'WHERE '.implode(' AND ', array_map(fn ($field) => "$field = :$field", array_keys($conditions)));
        }
        $sql = "SELECT * FROM $table $where LIMIT 1";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute($conditions);

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $result ?: null;
    }

    public function get(string $table, array $conditions = [], array $order = [], $limit = -1): array
    {
        $where = '';
        if (count($conditions) > 0) {
            $where = 'WHERE '.implode(' AND ', array_map(fn ($field) => "$field = :$field", array_keys($conditions)));

        }
        $sql = "SELECT * FROM $table $where";

        if (count($order) > 0) {
            $sql .= ' ORDER BY '.implode(', ', array_map(fn ($field, $direction) => "$field $direction", array_keys($order), $order));
        }

        if ($limit > 0) {
            $sql .= " LIMIT $limit";
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($conditions);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function delete(string $table, array $conditions = [])
    {

        $where = '';
        if (count($conditions) > 0) {
            $where = 'WHERE '.implode(' AND ', array_map(fn ($field) => "$field = :$field", array_keys($conditions)));

        }

        $sql = "DELETE FROM $table $where";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($conditions);
    }

    public function update(string $table, array $data, array $conditions): void
    {
        $fields = array_keys($data);
        $set = implode(', ', array_map(fn ($field) => "$field = :$field", $fields));
        $where = '';
        if (count($conditions) > 0) {
            $where = 'WHERE '.implode(' AND ', array_map(fn ($field) => "$field = :$field", array_keys($conditions)));

        }

        // data - поле которое мы меняем ,  т.е ['name' => " test name "] а $conditions - условие , т.е id записи ['id'] => 1 по итогу
        // по итогу нам нужно смержить два массива в один
        //        array:2 [▼
        //  "name" => "Комедия2"
        //  "id" => 4
        //]

        $sql = "UPDATE $table SET $set $where";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array_merge($data, $conditions));
    }

    public function query(string $sql,$params = []):? array
    {
        $sth = $this->pdo->prepare($sql);
        $res = $sth->execute($params);

        return $sth->fetchAll();
    }
}
