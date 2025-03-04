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
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json($product, 200);
    }

    public function createProduct(){
        $categories = $this->categoryRepository->getAllCategories();

        return view('product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        return $this->productRepository->createProduct($request);
    }

    public function updateProduct(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'integer',
            'name' => 'string|max:255',
            'description' => 'nullable|string',
            'price' => 'numeric',
            'stock' => 'integer',
            'total_price' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        return $this->productRepository->updateProduct($request, $id);
    }

    public function deleteProduct($id)
    {
        return $this->productRepository->deleteProduct($id);
    }
}
