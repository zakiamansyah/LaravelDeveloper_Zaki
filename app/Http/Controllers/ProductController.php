<?php

namespace App\Http\Controllers;

use App\Contracts\CategoryRepositoryInterface;
use App\Contracts\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    protected $productRepository;
    protected $categoryRepository;

    public function __construct(ProductRepositoryInterface $productRepository, CategoryRepositoryInterface $categoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllProducts()
    {
        $products = $this->productRepository->getAllProducts();

        return view('product.index', compact('products'));
    }

    public function getProductById($id)
    {
        $product = $this->productRepository->getProductById($id);
        if (!$product) {
            return redirect()->route('product')->with('error', 'Product not found');
        }

        return view('product.show', compact('product'));
    }

    public function createProduct()
    {
        $categories = $this->categoryRepository->getAllCategories();

        return view('product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|integer|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $this->productRepository->createProduct($request->all());

        return redirect()->route('product')->with('success', 'Product created successfully');
    }

    public function editProduct($id)
    {
        $product = $this->productRepository->getProductById($id);
        $categories = $this->categoryRepository->getAllCategories();

        if (!$product) {
            return redirect()->route('product')->with('error', 'Product not found');
        }

        return view('product.edit', compact('product', 'categories'));
    }


    public function updateProduct(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'integer|exists:categories,id',
            'name' => 'string|max:255',
            'description' => 'nullable|string',
            'price' => 'numeric',
            'stock' => 'integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $updatedProduct = $this->productRepository->updateProduct($request->all(), $id);

        if (!$updatedProduct) {
            return redirect()->route('product')->with('error', 'Product not found');
        }

        return redirect()->route('product')->with('success', 'Product updated successfully');
    }

    public function deleteProduct($id)
    {
        $deleted = $this->productRepository->deleteProduct($id);

        if (!$deleted) {
            return redirect()->route('product')->with('error', 'Product not found');
        }

        return redirect()->route('product')->with('success', 'Product deleted successfully');
    }
}
