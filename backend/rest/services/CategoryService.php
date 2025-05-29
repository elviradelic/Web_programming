<?php

require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/CategoryDao.php';

class CategoryService extends BaseService {
    public function __construct() {
        parent::__construct(new CategoryDao());
    }

    // Validacija prilikom kreiranja nove kategorije
    public function add($data) {
        if (empty($data['name'])) {
            throw new Exception("Category name is required.");
        }
        return parent::add($data);  // ✅ Ispravljeno
    }

    // Validacija prilikom ažuriranja postojeće kategorije
    public function update($id, $data) {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("Invalid category ID.");
        }
        return parent::update($id, $data);
    }
}
