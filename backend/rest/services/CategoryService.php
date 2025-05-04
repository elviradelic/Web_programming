<?php

require_once __DIR__ . '/../dao/CategoryDao.php';

class CategoryService {
    private $categoryDao;

    public function __construct() {
        $this->categoryDao = new CategoryDao();
    }

    public function getAllCategories() {
        return $this->categoryDao->getAllCategories();
    }

    public function getCategoryById($id) {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("Invalid category ID.");
        }

        $category = $this->categoryDao->getCategoryById($id);
        if (!$category) {
            throw new Exception("Category not found.");
        }

        return $category;
    }

    public function createCategory($data) {
        if (empty($data['name'])) {
            throw new Exception("Category name is required.");
        }

        return $this->categoryDao->createCategory($data);
    }

    public function updateCategory($id, $data) {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("Invalid category ID.");
        }

        if (!$this->categoryDao->getCategoryById($id)) {
            throw new Exception("Category not found.");
        }

        return $this->categoryDao->updateCategory($id, $data);
    }

    public function deleteCategory($id) {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("Invalid category ID.");
        }

        if (!$this->categoryDao->getCategoryById($id)) {
            throw new Exception("Category not found.");
        }

        return $this->categoryDao->deleteCategory($id);
    }
}
