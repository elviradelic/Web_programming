<?php

require_once __DIR__ . '/../config/database.php';

class CategoryDao {
    private $conn;

    public function __construct() {
        $this->conn = Database::connect();
    }

    public function getAllCategories() {
        $stmt = $this->conn->prepare("SELECT * FROM categories");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategoryById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM categories WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createCategory($name) {
        $stmt = $this->conn->prepare("INSERT INTO categories (name) VALUES (:name)");
        $stmt->bindParam(":name", $name);
        return $stmt->execute();
    }

    public function updateCategory($id, $name) {
        $stmt = $this->conn->prepare("UPDATE categories SET name = :name WHERE id = :id");
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    public function deleteCategory($id) {
        $stmt = $this->conn->prepare("DELETE FROM categories WHERE id = :id");
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
