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

        // return response()->json($this->category->getAllCategories(), 200);
    }

    public function getCategoryById($id)
    {

        return response()->json($this->category->getCategoryById($id), 200);
    }

    public function createCategory($request)
    {
        $data = [
            'name' => $request->input('name')
        ];

        return response()->json($this->category->createCategory($data), 200);
    }

    public function updateCategory($request, $id)
    {
        $data = [
            'name' => $request->input('name')
        ];

        return response()->json($this->category->updateCategory($data, $id), 200);
    }

    public function deleteCategory($id)
    {
        return response()->json($this->category->deleteCategory($id), 200);
    }
}

