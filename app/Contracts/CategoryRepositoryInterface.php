<?php

namespace App\Contracts;

interface CategoryRepositoryInterface
{
    public function getAllCategories();
    public function getCategoryById($id);
    public function createCategory($request);
    public function updateCategory($request, $id);
    public function deleteCategory($id);
}

