<?php

namespace App\Repositories;

use App\Contracts\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getAllCategories()
    {
        return $this->category->getAllCategories();
    }

    public function getCategoryById($id)
    {

        return $this->category->getCategoryById($id);
    }

    public function createCategory($request)
    {
        $data = [
            'name' => $request->input('name')
        ];

        return $this->category->createCategory($data);
    }

    public function updateCategory($request, $id)
    {
        $data = [
            'name' => $request->input('name')
        ];

        return $this->category->updateCategory($data, $id);
    }

    public function deleteCategory($id)
    {
        return $this->category->deleteCategory($id);
    }
}

