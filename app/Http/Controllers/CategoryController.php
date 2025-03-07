<?php

namespace App\Http\Controllers;

use App\Contracts\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllCategories()
    {
        $categories = $this->categoryRepository->getAllCategories();

        return view('categories.index', compact('categories'));
    }

    public function getCategoryById($id)
    {
        $category = $this->categoryRepository->getCategoryById($id);

        if (!$category) {
            return redirect()->route('category')->with('error', 'Category not found');
        }

        return view('categories.show', compact('category'));
    }

    public function createCategory()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:categories',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput();
        } 

        $check = $this->categoryRepository->createCategory($request);
        if($check){
            return redirect()->route('category');
        }else{
            return redirect()->back()->withInput();
        }
    }

    public function editCategory($id)
    {
        $category = $this->categoryRepository->getCategoryById($id);
        if (!$category) {
            return redirect()->route('category')->with('error', 'Category not found');
        }

        return view('categories.edit', compact('category'));
    }

    public function updateCategory(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:255|unique:categories',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $updateResult = $this->categoryRepository->updateCategory($request, $id);

        if ($updateResult) {
            return redirect()->route('category')->with('success', 'Category updated successfully');
        }

        return redirect()->back()->with('error', 'Failed to update Category');
    }

    public function deleteCategory($id)
    {
        $category = $this->categoryRepository->deleteCategory($id);

        if (!$category) {
            return redirect()->route('category')->with('error', 'Category not found or could not be deleted.');
        }

        return redirect()->route('category')->with('success', 'Category deleted successfully.');
    }
}

