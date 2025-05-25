<?php

require_once __DIR__ . '/../config/database.php';

class BaseDao {
    protected $conn;
    protected $table;

    public function __construct($table) {
        $this->conn = Database::getInstance()->getConnection();
        $this->table = $table;
    }

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table}");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function add($data) {
        try {
            $columns = implode(", ", array_keys($data));
            $placeholders = implode(", ", array_fill(0, count($data), "?"));
            $values = array_values($data);

            $sql = "INSERT INTO {$this->table} ($columns) VALUES ($placeholders)";
            $stmt = $this->conn->prepare($sql);

            error_log(">>> Executing SQL: $sql");
            error_log(">>> With values: " . json_encode($values));

            if (!$stmt->execute($values)) {
                error_log(">>> Insert failed in BaseDao::add()");
                throw new Exception("Insert failed in BaseDao::add()");
            }

            return true;
        } catch (Exception $e) {
            error_log(">>> EXCEPTION in BaseDao::add(): " . $e->getMessage());
            throw $e;
        }
    }

    public function update($id, $data) {
        $setClause = implode(", ", array_map(function ($key) {
            return "$key = ?";
        }, array_keys($data)));

        $stmt = $this->conn->prepare("UPDATE {$this->table} SET $setClause WHERE id = ?");
        return $stmt->execute([...array_values($data), $id]);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
